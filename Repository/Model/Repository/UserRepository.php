<?php

namespace Repository\Model\Repository;

class UserRepository implements UserRepositoryInterface
{
    protected $userMapper;

    public function __construct(UserMapperInterface $userMapper)
    {
        $this->userMapper = $userMapper;
    }

    public function fetchById($id)
    {
        return $this->userMapper->fetchById($id);
    }

    public function fetchByName($name)
    {
        return $this->fetch(array("name" => $name));
    }

    public function fetchByEmail($email)
    {
        return $this->fetch(array("email" => $email));
    }

    public function fetchByRole($role)
    {
        return $this->fetch(array("role" => $role));
    }

    protected function fetch(array $conditions)
    {
        return $this->userMapper->fetchAll($conditions);
    }
}