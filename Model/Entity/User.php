<?php

namespace Model\Entity;

class User extends BaseEntity
{
    private $name;
    private $email;
    private $password;
    private $role;

    public function __construct()
    {
        $this->role = 'ROLE_USER';
    }
    /**
     * Get the value of user
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of user
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role !== null ? $role : ROLE_USER;

        return $this;
    }

}
