<?php

include_once __DIR__ . '../../AppModel.php';

/**
 * @Class UserModel
 */
class UserModel extends AppModel
{
    public function setUser($user)
    {
        $query = "INSERT INTO user
            (
                first_name, 
                last_name, 
                username, 
                email, 
                password
            ) 
            VALUES (
                '{$user['first_name']}', 
                '{$user['last_name']}',
                '{$user['username']}',
                '{$user['email']}',
                '{$user['password']}')
                "
            ;

        if ($this->getConection()) {
            return $this->executeQuery($query);
        }
        return false;
    }

    public function findUser($user = []) 
    {
        $query = 
            "SELECT * 
                FROM user
                WHERE username = '{$user['username']}' AND 
                password = '{$user['password']}'
            "
        ;

        if ($this->getConection()) {
            return $this->getData($query);
        }
    }

    public function findAll() 
    {
        $query = 
            "SELECT * FROM userlogin"
        ;

        if ($this->getConection()) {
            return $this->getData($query);
        }
    }
}

?>