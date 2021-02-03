<?php

include_once __DIR__ . '../AppController.php';

// class UserController extends AppController
class UserController
{   
    /** @var array */
    const FIELD_USER = [
        'first_name', 
        'last_name', 
        'username', 
        'email', 
        'password', 
        'password_repeat'
    ];
}

?>