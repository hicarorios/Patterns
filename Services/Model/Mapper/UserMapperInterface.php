<?php

namespace Model\Mapper;

use Model\UserInterface;

interface UserMapperInterface
{
    public function fetchById($id);
    public function fetchAll(array $conditions = array());

    public function insert(UserInterface $user);
    public function delete($id);
}