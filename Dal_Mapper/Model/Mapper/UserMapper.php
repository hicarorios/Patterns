<?php

namespace Model\Mapper;

use Model\UserInterface,
    Model\User;

class UserMapper extends AbstractDataMapper implements UserMapperInterface
{
    protected $entityTable = "users";

    public function insert(UserInterface $user)
    {
        $user->id = $this->adapter->insert($this->entityTable,array("name"  => $user->name,"email" => $user->email));
        return $user->id;
    }

    public function delete($id)
    {
        if ($id instanceof UserInterface) {
            $id = $id->id;
        }

        return $this->adapter->delete($this->entityTable,array("id = $id"));
    }

    protected function createEntity(array $row)
    {
        return new User($row["name"], $row["email"]);
    }
}