<?php

include_once __DIR__ . '../AppModel.php';

/**
 * @Class UserModel
 */
class UserModel extends AppModel
{   
    /**
     * setUser
     * @param $user
     */
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
                '{$user['password']}')"
            ;
            
        if ($this->getConection()) {
            return $this->conexion->query($query);
        }
        return false;
    }
}

?>