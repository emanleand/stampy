<?php

include_once __DIR__ . '../../AppController.php';

/**
 * Class UserController
 * 
 * @Description This class is used to unify the processes common to user.
 * 
 */
class UserController extends AppController
{   
    /**
     * This validates that all the data of an account was sent
     * 
     * @param Array $input
     * @return Array | null
     * 
     */
    protected function validate($input)
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
