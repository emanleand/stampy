<?php

include_once __DIR__ . '/UserController.php';
include_once __DIR__ . '../../../Model/User/UserModel.php';

class LoginController extends UserController 
{
    function __construct()
    {                
        session_start();
        try {
            $user = $this->validate();
            if (empty($this->getUser($user))) {
                // return json 403
            }

            return $this->getUser($user);            
        } catch (\Throwable $e) {
            var_dump($e);die();
            // return json status code 400
        }
    }

    /**
     * getUser
     * @param user
     */
    private function getUser($user) {
        $db = new UserModel;
        return $db->findUser($user);
    }

    /**
     * validate
     */
    private function validate() {

        $field = UserController::LOGIN_USER;
        $data = [];

        foreach ($field as $key => $value) {
            if (!isset($_POST[$value]) || empty($_POST[$value])) {                
                throw new Exception($value . " is requerided", 400);                 
            } else {
                $data[$value] = $_POST[$value];
            }
        }

        return $data;
    }
}

new LoginController;
