<?php

include_once __DIR__ . '../../AppModel.php';

/**
 * @Class UserModel
 * 
 * @Description Here all the queries in the database related to the user controller are defined
 * 
 */
class UserModel extends AppModel
{
    /**
     * Register a new user account
     * 
     * @param Array $user
     * 
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
                '{$user['password']}')
                ";

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
            ";

        if ($this->getConection()) {
            return $this->getData($query);
        }
    }

    /**
     * This retrieves all accounts except the current one in session.
     * 
     */
    public function findWithoutUsingUserCurrent()
    {
        if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
            return [];
        }

        $id = $_SESSION['id'];
        $query =
            "SELECT * FROM user
            WHERE id <> '{$id}'
        ";

        if ($this->getConection()) {
            return $this->getData($query);
        }
    }

    /**
     * Here a specific user account is deleted
     * 
     * @param int $id
     * 
     */
    public function removeUser(int $id)
    {
        $query =
            "DELETE FROM user
            WHERE id = {$id}
        ";

        if ($this->getConection()) {
            return $this->executeQuery($query);
        }
        return false;
    }

    /**
     * 
     * This searches for a specific user account.
     * 
     * @param int $id
     */
    public function find(int $id = null)
    {
        $filter = ($id)? "WHERE id = {$id}": ""; 
        $query =
            "SELECT * FROM user " . $filter
        ;

        if ($this->getConection()) {
            return $this->getData($query);
        }
        return false;
    }

    /**
     * 
     * Here a specific user account is updated
     * 
     * @param Array $user 
     * @param int $id
     * 
     */
    public function updateUser(array $user, int $id)
    {
        $query =
            "UPDATE user SET 
                first_name = '{$user['first_name']}', 
                last_name = '{$user['last_name']}', 
                username = '{$user['username']}', 
                email = '{$user['email']}', 
                password = '{$user['password']}'
            WHERE id = {$id}
        ";

        if ($this->getConection()) {
            return $this->executeQuery($query);
        }
        return false;
    }
}