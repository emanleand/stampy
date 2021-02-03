<?php

include_once __DIR__ . '/UserController.php';
include_once __DIR__ . '../../Model/User/UserModel.php';

class RegisterUser extends UserController 
{
    function __construct()
    {                
        session_start();
        try {
            $user = $this->validate();
            $this->setUser($user);

            //return json status code 202
        } catch (\Throwable $e) {
            // return json status code 400
        }
    }

    /**
     * setUser
     * @param user
     */
    private function setUser($user) {
        $db = new UserModel;
        $db->setUser($user);
    }

    /**
     * validate
     */
    private function validate() {

        $field = UserController::FIELD_USER;
        $data = [];
        $errors = [];
        foreach ($field as $key => $value) {
            if (!isset($_POST[$value]) || empty($_POST[$value])) {                
                throw new Exception($value . " is requerided", 400);                 
            } else {
                $data[$value] = $_POST[$value];
            }
        }

        if ($data['password'] !== $data['password_repeat']) {
            throw new Exception('los password son distintos', 400);
        }

        return $data;
    }
}

new RegisterUser;
