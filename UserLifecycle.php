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


    public function isAdmin($username) : bool
    {
        $query = "SELECT role FROM players WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        $row = $stmt->fetch();
        return $row['role'] == 'ADMIN';
    }

    /**
     * @return Generator
     */
    public function getAllUsers(): Generator
    {
        $query = "SELECT username, fullname, role FROM players";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        while ($row = $stmt->fetchObject(\DTO\AllUsersDTO::class)) {
            yield $row;
        }
    }

    public function getBirthday(string $username) : string
    {
        $query = "SELECT birthday FROM players WHERE username = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$username]);
        $row = $stmt->fetch();
        return $row['birthday'];
    }

    public function edit(string $username, array $inputData,
                         array &$userInfo,
                         bool $isForeignEdit) : bool
    {
        $password = $inputData['password'];
        $confirm = $inputData['confirm_password'];
        if (!$isForeignEdit && ($password != $confirm || strlen($password) < 3)) {
            throw new \Exception("Password validation mismatch");
        }
        $newUsername = $inputData['username'];
        $oldUsername = $username;
        $info = $this->getUserInfo($username);


        if ($newUsername == $oldUsername) {
            // no change of the key
            return $this->changeUserData($inputData, $info, $isForeignEdit);

        } else {
//            //change the key
//            if (array_key_exists($newUsername, $this->users)) {
//                throw new \Exception("Username is already taken");
//            }

            $result = $this->changeUserData($inputData, $info, $isForeignEdit);
            if ($result) {
                if (!$isForeignEdit) {
                    $userInfo['user'] = $newUsername;
                }
                return true;
            }

        }
        return false;
    }


    /**
     * @param array $data
     * @param $info
     */
    private function changeUserData(array $data, \DTO\UserEditDTO &$info, bool $isForeingEdit) : bool
    {
        $query = "UPDATE players SET username = ?, email = ?, birthday = ?";
        $preparedArgs = [$data['username'], $data['email'], $data['birthday']];
        if (!$isForeingEdit) {
            $query .= ", password = ?";
            $preparedArgs [] = $data['password'];
        }
        $query .= "WHERE username = ?";
        $preparedArgs [] = $info->getUsername();
        $stmt = $this->db->prepare($query);
        return $stmt->execute($preparedArgs);
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

    public function hasAdmin()
    {
        $users = $this->users;
        foreach ($users as $username => $user) {
            if ($this->isAdmin($username)) {
                return true;
            }
        }
        return false;
    }
}


