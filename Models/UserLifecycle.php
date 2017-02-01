<?php

use Drivers\Database;

class UserLifecycle
{
    /**
     * @var Database
     */
    private $db;

    public function __construct(Database $db)
    {

        $this->db = $db;

    }

    public function getEmail(string $username) : string
    {
        $query = "SELECT email FROM players WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        $row = $stmt->fetch();
        return $row['email'];
    }

    public function getPassword(string $username) : string
    {
        $query = "SELECT password FROM players WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        $row = $stmt->fetch();
        return $row['password'];
    }

    /**
     * @param $username
     * @return \DTO\UserEditDTO
     */
    public function getUserInfo($username)
    {
        $query = "SELECT id, username, password, email FROM 
            users WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        $row = $stmt->fetchObject(\DTO\UserEditDTO::class);
        return $row ;
    }


    public function login(string $username, string $password): bool
    {
        $info = $this->getUserInfo($username);
        if ($info && $info->getPassword() == $password) {

            return true;
        }
        return false;
    }

    public function register(array $userData)
    {
        $existingUsers = $this->db;

        $newUsername = $userData['username'];


        if (strlen($newUsername) < 3) {
            throw new \Exception("User validation mismatch");

        }
        if (array_key_exists($newUsername, $existingUsers)) {
            throw new \Exception("Username is already taken");

        }
        $password = $userData['password'];
        $confirm = $userData['confirm_password'];
        if ($password != $confirm || strlen($password) < 3) {
            throw new \Exception("Password validation mismatch");
        }
        $email = trim($userData['email']);
        if (strlen($email) < 3) {
            throw new \Exception("Invalid email!");
        }
        $query = "INSERT INTO `users` (`username`, `password`, `email`) VALUES (?, ?, ?);";
        $userArgs = [$newUsername, $password, $email];
        $stmt = $this->db->prepare($query);
        $stmt->execute($userArgs);
        return $stmt;
//        if(array_key_exists($role, $this->data['username']))
    }

}


