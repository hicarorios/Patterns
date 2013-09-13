<?php

namespace RepositoryPattern\Model\Repository;

interface UserRepositoryInterface
{
    public function fetchById($id);
    public function fetchByName($name);
    public function fetchByEmail($email);
    public function fetchByRole($role);
}