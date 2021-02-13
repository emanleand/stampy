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
                '{$user['firstName']}', 
                '{$user['lastName']}',
                '{$user['username']}',
                '{$user['email']}',
                '{$user['password']}')
                ";

        if ($this->getConection()) {
            return $this->executeQuery($query);
        }
        return false;
    }

    /**
     * This retrieves all accounts except the current one in session.
     * 
     */
    public function findWithoutUsingUserCurrent(
        Int $id,
        Int $left,
        Int $right,
        String $keyInputUser = null,
        String $valueInputUser = null
    ) {
        $filter = "";
        if ($keyInputUser && $valueInputUser) {
            $filter = ' AND ' . $keyInputUser . " LIKE '%{$valueInputUser}%'";
        }

        $query =
            "SELECT * FROM user
            WHERE id <> {$id}
            $filter 
            ORDER BY id LIMIT {$left} , {$right}
        ";
        if ($this->getConection()) {
            return $this->getData($query);
        }
    }

    /**
     * @return Int | null 
     */
    public function getNumberOfUsers($keyInputUser = null, $valueInputUser = null)
    {
        $filter = "";
        if ($keyInputUser && $valueInputUser) {
            $filter = "WHERE " . $keyInputUser . " LIKE '%{$valueInputUser}%'";
        }

        $query = "SELECT * FROM user " . $filter;
        return $this->getConection()->query($query)->num_rows;
    }

    /**
     * Here a specific user account is deleted
     * 
     * @param Int $id
     * 
     * @return Bool
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
     * @param Int $id
     * 
     * @return Bool
     */
    public function find(int $id = null)
    {
        $filter = ($id) ? "WHERE id = {$id}" : "";
        $query =
            "SELECT id, first_name, last_name, username, email FROM user " . $filter;

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
     * @param Int $id
     * 
     * @return Bool
     * 
     */
    public function updateUser(array $user, int $id)
    {
        $query =
            "UPDATE user SET 
                first_name = '{$user['firstName']}', 
                last_name = '{$user['lastName']}', 
                username = '{$user['username']}', 
                email = '{$user['email']}'
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
     * @param Array $user 
     * @param int $id
     * 
     * @return Array
     *  
     */
    public function findOne(array $user = [], $id = null)
    {
        if (empty($user) || count($user) > 1) {
            return [];
        }

        $filter = "";
        foreach ($user as $key => $value) {
            $filter = $key . " = '{$value}'";
        }

        $filterAditional = "";
        if ($id !== null) {
            $filterAditional = " AND id <> {$id}";
        }

        $query = "SELECT * FROM user WHERE " . $filter . $filterAditional;

        if ($this->getConection()) {
            return $this->getData($query);
        }
        return [];
    }
}