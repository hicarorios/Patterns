<?php

namespace Service;

use Model\Mapper\UserMapperInterface;

class UserService
{
    protected $userMapper;
    protected $encoder;

    public function __construct(UserMapperInterface $userMapper, EncoderInterface $encoder = null)
    {
        $this->userMapper = $userMapper;
        $this->encoder = $encoder;
    }

    public function setEncoder(EncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        return $this;
    }

    public function getEncoder()
    {
        if ($this->encoder === null) {
            throw new RuntimeException(
                "There is not an encoder to use.");
        }
        return $this->encoder;
    }

    public function fetchById($id)
    {
        return $this->userMapper->fetchById($id);
    }

    public function fetchAll(array $conditions = array())
    {
        return $this->userMapper->fetchAll($conditions);
    }

    public function fetchByIdEncoded($id)
    {
        $user = $this->fetchById($id);
        return $this->getEncoder()->setData(array($user))->encode();
    }

    public function fetchAllEncoded(array $conditions = array())
    {
        $users = $this->fetchAll($conditions);
        return $this->getEncoder()->setData($users)->encode($users);
    }
}