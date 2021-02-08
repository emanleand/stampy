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
            if (empty($input['username']) || empty($input['password'])) {
                $this->createResponseFailer(400, 'BadRequest');
            }

            $db = new UserModel;
            $data = $db->findUser($input);
            $user = $data[0];
            if (empty($user)) {
                $this->createResponseFailer(403, 'Resource not found');
            }

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
