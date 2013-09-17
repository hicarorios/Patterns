<?php

namespace Repository\Model\Repository;

interface UserMapperInterface
{
    public function fetchById($id);
    public function fetchAll(array $conditions = array());
}