<?php

include_once __DIR__ . '/UserController.php';
include_once __DIR__ . '../../../Model/User/UserModel.php';

/**
 * Class UpdateController 
 */
class UpdateController extends UserController
{
    function __construct()
    {
        session_start();
        $this->updateUserAction();
    }

    /**
     * This updates the data of an account
     */
    private function updateUserAction()
    {
        try {
            $input = json_decode(file_get_contents('php://input'), 1);
            $error = $this->validateInput($input);

            if (!isset($_GET['id']) || empty($_GET['id'])) {
                $this->createResponseFailer(400, 'Bad Request');
            }
            $id = $_GET['id'];

            if (!empty($error)) {
                $this->createResponseFailer(400, json_encode($error));
            }

            if ($input['password'] !== $input['password_repeat']) {
                $this->createResponseFailer(400, 'Different password');
            }
            
            $db = new UserModel;
            $username = $db->findOne(['username' => $input['username']], $id);
            if (!empty($username)) {
                $this->createResponseFailer(400, 'Duplicate username');
            }

            $email = $db->findOne(['email' => $input['email']], $id);
            if (!empty($email)) {
                $this->createResponseFailer(400, 'Duplicate email');
            }

            $db->updateUser($input, $id);

            $_SESSION['username'] = $input['username'];
            $_SESSION['id'] = $input['id'];

            $this->createResponseSuccess(['data' => $input]);
        } catch (Exception $e) {
            $this->createResponseFailer(409, 'Conflict');
        } catch (Throwable $e) {
            $this->createResponseFailer(409, 'Conflict');
        }
    }
}

new UpdateController;
