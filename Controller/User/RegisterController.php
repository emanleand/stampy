<?php

include_once __DIR__ . '/UserController.php';
include_once __DIR__ . '../../../Model/User/UserModel.php';

/**
 * Class RegisterController 
 */
class RegisterController extends UserController
{
    function __construct()
    {
        session_start();
        $this->registerUserAction();
    }

    /**
     * This registers a new account.
     * 
     */
    private function registerUserAction()
    {
        try {
            $input = json_decode(file_get_contents('php://input'), 1);
            $error = $this->validateInput($input);
            if (!empty($error)) {
                $this->createResponseFailer(400, json_encode($error));
            }

            if ($input['password'] !== $input['password_repeat']) {
                $this->createResponseFailer(400, 'Different password');
            }

            $db = new UserModel;
            $username = $db->findOne(['username' => $input['username']]);
            if (!empty($username)) {
                $this->createResponseFailer(400, 'Duplicate username');
            }

            $email = $db->findOne(['email' => $input['email']]);
            if (!empty($email)) {
                $this->createResponseFailer(400, 'Duplicate email');
            }

            $db->setUser($input);

            $this->createResponseSuccess(['message' => 'success']);
        } catch (Exception $e) {
            $this->createResponseFailer(409, 'Conflict');
        } catch (Throwable $e) {
            $this->createResponseFailer(409, 'Conflict');
        }
    }
}

new RegisterController;
