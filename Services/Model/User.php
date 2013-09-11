<?php

namespace Model;

class User extends AbstractEntity implements UserInterface
{
    const LOW_POSTER = "low";
    const MEDIUM_POSTER = "medium";
    const TOP_POSTER = "high";

    protected $id;
    protected $name;
    protected $email;
    protected $ranking;

    public function __construct($name, $email, $ranking = self::LOW_POSTER)
    {
        $this->setName($name);
        $this->setEmail($email);
        $this->setRanking($ranking);
    }

    public function setId($id)
    {
        if ($this->id !== null) {
            throw new BadMethodCallException(
                "The ID for this user has been set already.");
        }
        if (!is_int($id) || $id < 1) {
            throw new InvalidArgumentException(
                "The user ID is invalid.");
        }
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        if (strlen($name) < 2 || strlen($name) > 30) {
            throw new InvalidArgumentException(
                "The user name is invalid.");
        }
        $this->name = htmlspecialchars(trim($name), ENT_QUOTES);
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(
                "The user email is invalid.");
        }
        $this->email = $email;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setRanking($ranking)
    {
        switch ($ranking) {
            case self::LOW_POSTER:
            case self::MEDIUM_POSTER:
            case self::TOP_POSTER:
                $this->ranking = $ranking;
                break;
            default:
                throw new InvalidArgumentException(
                    "The post ranking '$ranking' is invalid.");
        }
        return $this;
    }

    public function getRanking()
    {
        return $this->ranking;
    }
}