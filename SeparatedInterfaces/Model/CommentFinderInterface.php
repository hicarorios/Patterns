<?php

namespace SeparatedInterfaces\Model;

interface CommentFinderInterface
{
    public function findById($id);
    public function findAll(array $conditions = array());
}