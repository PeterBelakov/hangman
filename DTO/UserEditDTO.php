<?php
namespace DTO;
class UserEditDTO
{
    private $isForeignEdit;
    private $username;
    private $password;
    private $email;
    private $id;


    /**
     * @param mixed $isForeignEdit
     */
    public function setForeignEdit($isForeignEdit)
    {
        $this->isForeignEdit = $isForeignEdit;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function isForeignEdit()
    {
        return $this->isForeignEdit;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

}