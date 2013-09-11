<?php

namespace Model\Proxy;

use Model\Collection\CommentCollectionInterface,
    Model\Mapper\CommentMapperInterface;

class CommentCollectionProxy implements CommentCollectionInterface
{
    /** @var String*/
    protected $comments;

    /** @var int */
    protected $postId;

    /** @var CommentMapperInterface */
    protected $commentMapper;

    /**
     * @param $postId
     * @param CommentMapperInterface $commentMapper
     */
    public function __construct($postId, CommentMapperInterface $commentMapper)
    {
        $this->postId = $postId;
        $this->commentMapper = $commentMapper;
    }

    /**
     * @return mixed
     * @throws \UnexpectedValueException
     */
    public function getComments()
    {
        if ($this->comments === null) {

            if(!$this->comments = $this->commentMapper->fetchAll(array("post_id" => $this->postId))) {
                throw new \UnexpectedValueException("Unable to fetch the comments.");
            }
        }

        return $this->comments;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->getComments());
    }

    /**
     * @return mixed
     */
    public function getIterator()
    {
        return $this->getComments();
    }
}