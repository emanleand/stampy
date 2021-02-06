<?php

include_once __DIR__ . '/UserController.php';
include_once __DIR__ . '../../../Model/User/UserModel.php';

class RegisterUser extends UserController
{
    function __construct()
    {
        session_start();
        $this->registerUserAction();
    }

    /**
     * 
     */
    private function registerUserAction()
    {
        try {
            $input = json_decode(file_get_contents('php://input'), 1);
            $error = $this->validate($input);

            if (!empty($error)) {
                $this->createResponseFailer(400, 'BadRequest');
            }

            if ($input['password'] !== $input['password_repeat']) {
                $this->createResponseFailer(400, 'BadRequest');
            }

            $db = new UserModel;
            $db->setUser($input);

            $this->createResponseSuccess(['message' => 'success']);
        } catch (Exception $e) {
            $this->createResponseFailer(409, 'Conflict');
        } catch (Throwable $e) {
            $this->createResponseFailer(409, 'Conflict');
        }
    }

    /**
     * validate
     * @param $input
     */
    private function validate($input)
    {
        $error = [];
        foreach ($input as $key => $value) {
            if (!isset($value) || empty($value)) {
                $error[$key] = $value;
            }
        }

        return $error;
    }
}

new RegisterUser;
