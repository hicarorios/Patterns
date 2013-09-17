<?php

namespace Repository\Model;

class User implements UserInterface
{
    const ADMINISTRATOR_ROLE = "Administrator";
    const GUEST_ROLE         = "Guest";

    protected $id;
    protected $name;
    protected $email;
    protected $role;

    /**
     * @param $name
     * @param $email
     * @param string $role
     */
    public function __construct($name, $email, $role = self::GUEST_ROLE)
    {
        $this->setName($name);
        $this->setEmail($email);
        $this->setRole($role);
    }

    /**
     * @param $id
     * @return $this
     * @throws \InvalidArgumentException
     * @throws \BadMethodCallException
     */
    public function setId($id)
    {
        if ($this->id !== null) {
            throw new \BadMethodCallException("The ID for this user has been set already.");
        }
        if (!is_int($id) || $id < 1) {
            throw new \InvalidArgumentException("The user ID is invalid.");
        }
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $name
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setName($name)
    {
        if (strlen($name) < 2 || strlen($name) > 30) {
            throw new \InvalidArgumentException("The user name is invalid.");
        }
        $this->name = htmlspecialchars(trim($name), ENT_QUOTES);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $email
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("The user email is invalid.");
        }
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $role
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setRole($role)
    {
        if ($role !== self::ADMINISTRATOR_ROLE
            && $role !== self::GUEST_ROLE) {
            throw new \InvalidArgumentException("The user role is invalid.");
        }
        $this->role = $role;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }
}