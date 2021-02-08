<?php

include_once __DIR__ . '/UserController.php';
include_once __DIR__ . '../../../Model/User/UserModel.php';

class ListController extends UserController
{
    function __construct()
    {
        
    }

    public function getUsers()
    {
        $db = new UserModel;
        return $db->findWithoutUsingUserCurrent();
    }
}

new ListController;
