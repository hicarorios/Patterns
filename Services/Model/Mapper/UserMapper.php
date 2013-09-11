<?php

namespace Model\Mapper;

use Library\Database\DatabaseAdapterInterface,
    Model\UserInterface,
    Model\User;

class UserMapper implements UserMapperInterface
{
    protected $entityTable = "users";

    public function __construct(DatabaseAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function fetchById($id)
    {
        $this->adapter->select($this->entityTable,
            array("id" => $id));
        if (!$row = $this->adapter->fetch()) {
            return null;
        }
        return $this->createUser($row);
    }

    public function fetchAll(array $conditions = array())
    {
        $users = array();
        $this->adapter->select($this->entityTable, $conditions);
        $rows = $this->adapter->fetchAll();

        if ($rows) {
            foreach ($rows as $row) {
                $users[] = $this->createUser($row);
            }
        }
        return $users;
    }

    public function insert(UserInterface $user)
    {
        $user->id = $this->adapter->insert($this->entityTable, array(
                "name"    => $user->name,
                "email"   => $user->email,
                "ranking" => $user->ranking));
        return $user->id;
    }

    public function delete($id)
    {
        if ($id instanceof UserInterface) {
            $id = $id->id;
        }
        return $this->adapter->delete($this->entityTable,
            array("id = $id"));
    }

    protected function createUser(array $row)
    {
        $user = new User($row["name"], $row["email"],
            $row["ranking"]);
        $user->id = $row["id"];
        return $user;
    }
}