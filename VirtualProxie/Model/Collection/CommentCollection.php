<?php

namespace Model\Collection;

use Model\CommentInterface;

class CommentCollection implements CommentCollectionInterface
{
    /** @var array */
    protected $comments = array();

    /**
     * @param array $comments
     */
    public function __construct(array $comments = array())
    {
        if ($comments) {
            foreach($comments as $comment) {
                $this->addComment($comment);
            }
        }
    }

    /**
     * @param CommentInterface $comment
     * @return $this
     */
    public function addComment(CommentInterface $comment)
    {
        $this->comments[] = $comment;
        return $this;
    }

    /**
     * @return array
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->comments);
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->comments);
    }
}