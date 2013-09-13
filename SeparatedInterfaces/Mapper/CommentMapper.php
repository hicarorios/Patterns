<?php

namespace SeparatedInterfaces\Mapper;

use SeparatedInterfaces\Library\Database\DatabaseAdapterInterface,
    SeparatedInterfaces\Model\CommentFinderInterface,
    SeparatedInterfaces\Model\NullComment,
    SeparatedInterfaces\Model\Comment;

class CommentMapper implements CommentFinderInterface
{
    protected $adapter;
    protected $entityTable = "comments";

    public function __construct(DatabaseAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function findById($id)
    {
        $this->adapter->select($this->entityTable,
            array("id" => $id));
        if (!$row = $this->adapter->fetch()) {
            return null;
        }
        return $this->loadComment($row);
    }

    public function findAll(array $conditions = array())
    {
        $this->adapter->select($this->entityTable, $conditions);
        $rows = $this->adapter->fetchAll();
        return $this->loadComments($rows);
    }

    protected function loadComment(array $row)
    {
        return new Comment($row["content"], $row["author"]);
    }

    protected function loadComments(array $rows)
    {
        $comments = array();
        foreach ($rows as $row) {
            $comments[] = $this->loadComment($row);
        }
        return $comments;
    }
}