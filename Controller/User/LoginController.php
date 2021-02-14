<?php

include_once __DIR__ . '/UserController.php';
include_once __DIR__ . '../../../Model/User/UserModel.php';

/**
 * LoginController
 */
class LoginController extends UserController
{
    function __construct()
    {
        session_start();
        $this->loginAction();
    }

    /**
     * The data of an account is registered in session
     */
    private function loginAction()
    {
        try {
            $input = json_decode(file_get_contents('php://input'), 1);

            $error = $this->validateInput($input);
            if (!empty($error)) {
                $this->createResponseFailer(400, json_encode($error));
            }

            $db = new UserModel;
            $data = $db->findOne(['username' => $input['username']]);
            $user = $data[0];
            if (empty($user)) {
                $this->createResponseFailer(403, 'Username not found');
            }

            if (!$this->verificateHash($input['password'], $user['password'])) {
                $this->createResponseFailer(400, 'Password incorrect');
            };

            $_SESSION['username'] = $user['username'];
            $_SESSION['id'] = $user['id'];

            $this->createResponseSuccess(['data' => $user]);
        } catch (Exception $e) {
            $this->createResponseFailer(409, 'Conflict');
        } catch (Throwable $e) {
            $this->createResponseFailer(409, 'Conflict');
        }
    }
}

new LoginController();
