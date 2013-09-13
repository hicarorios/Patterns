<?php

namespace RepositoryPattern\Mapper;

use RepositoryPattern\Model\Repository\UserMapperInterface,
    RepositoryPattern\Model\User;

class UserMapper implements UserMapperInterface
{
    protected $entityTable = "users";
    protected $collection;

    public function __construct(DatabaseAdapterInterface $adapter, UserCollectionInterface $collection)
    {
        $this->adapter = $adapter;
        $this->collection = $collection;
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
        $this->adapter->select($this->entityTable, $conditions);
        $rows = $this->adapter->fetchAll();
        return $this->createUserCollection($rows);

    }

    protected function createUser(array $row)
    {
        $user = new User($row["name"], $row["email"],
            $row["role"]);
        $user->setId($row["id"]);
        return $user;
    }

    protected function createUserCollection(array $rows)
    {
        $this->collection->clear();
        if ($rows) {
            foreach ($rows as $row) {
                $this->collection[] = $this->createUser($row);
            }
        }
        return $this->collection;
    }
}