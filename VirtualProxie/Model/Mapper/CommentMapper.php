<?php

namespace Model\Mapper;

use Library\Database\DatabaseAdapterInterface,
    Model\Collection\CommentCollection,
    Model\Comment;

class CommentMapper implements CommentMapperInterface
{
    /**  @var \Library\Database\DatabaseAdapterInterface */
    protected $adapter;

    /**  @var string */
    protected $entityTable = "comments";

    /**
     * @param DatabaseAdapterInterface $adapter
     */
    public function __construct(DatabaseAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param int $id
     * @return \Model\Comment|null
     */
    public function fetchById($id)
    {
        $this->adapter->select($this->entityTable,
            array("id" => $id));

        if (!$row = $this->adapter->fetch()) {
            return null;
        }

        return $this->createComment($row);
    }

    /**
     * @param array $conditions
     * @return CommentCollection
     */
    public function fetchAll(array $conditions = array())
    {
        $collection = new CommentCollection;
        $this->adapter->select($this->entityTable, $conditions);
        $rows = $this->adapter->fetchAll();

        if ($rows) {
            foreach ($rows as $row) {
                $collection->addComment($this->createComment($row));
            }
        }

        return $collection;
    }

    /**
     * @param array $row
     * @return Comment
     */
    protected function createComment(array $row)
    {
        return new Comment($row["content"], $row["poster"]);
    }
}