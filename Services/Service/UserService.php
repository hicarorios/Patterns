<?php

namespace Service;

use Model\Mapper\UserMapperInterface;

class UserService
{
    protected $userMapper;
    protected $encoder;

    /**
     * @param UserMapperInterface $userMapper
     * @param EncoderInterface $encoder
     */
    public function __construct(UserMapperInterface $userMapper, EncoderInterface $encoder = null)
    {
        $this->userMapper = $userMapper;
        $this->encoder = $encoder;
    }

    /**
     * @param EncoderInterface $encoder
     * @return $this
     */
    public function setEncoder(EncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        return $this;
    }

    /**
     * @return EncoderInterface
     * @throws \RuntimeException
     */
    public function getEncoder()
    {
        if ($this->encoder === null) {
            throw new \RuntimeException("There is not an encoder to use.");
        }
        return $this->encoder;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function fetchById($id)
    {
        return $this->userMapper->fetchById($id);
    }

    /**
     * @param array $conditions
     * @return mixed
     */
    public function fetchAll(array $conditions = array())
    {
        return $this->userMapper->fetchAll($conditions);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function fetchByIdEncoded($id)
    {
        $user = $this->fetchById($id);
        return $this->getEncoder()->setData(array($user))->encode();
    }

    /**
     * @param array $conditions
     * @return mixed
     */
    public function fetchAllEncoded(array $conditions = array())
    {
        $users = $this->fetchAll($conditions);
        return $this->getEncoder()->setData($users)->encode($users);
    }
}