<?php

namespace Model\Mapper;

interface CommentMapperInterface
{
    public function fetchById($id);

    public function fetchAll(array $conditions = array());
}