<?php

namespace Model;

use Model\Collection\CommentCollectionInterface;

class Post implements PostInterface
{
    protected $id;
    protected $title;
    protected $content;
    protected $comments;

    /**
     * @param String $title
     * @param String $content
     * @param CommentCollectionInterface $comments
     */
    public function __construct($title, $content, CommentCollectionInterface $comments = null)
    {
        $this->setTitle($title);
        $this->setContent($content);
        $this->comments = $comments;
    }

    /**
     * @param int $id
     * @throws \BadMethodCallException
     * @throws \InvalidArgumentException
     * @return $this
     */
    public function setId($id)
    {
        if ($this->id !== null) {
            throw new \BadMethodCallException("The ID for this post has been set already.");
        }

        if (!is_int($id) || $id < 1) {
            throw new \InvalidArgumentException( "The post ID is invalid.");
        }

        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param String $title
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setTitle($title)
    {
        if (!is_string($title)
            || strlen($title) < 2
            || strlen($title) > 100) {
            throw new \InvalidArgumentException("The post title is invalid.");
        }

        $this->title = htmlspecialchars(trim($title), ENT_QUOTES);
        return $this;
    }

    /**
     * @return String
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param String $content
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setContent($content)
    {
        if (!is_string($content) || strlen($content) < 2) {
            throw new \InvalidArgumentException("The post content is invalid.");
        }

        $this->content = htmlspecialchars(trim($content), ENT_QUOTES);
        return $this;
    }

    /**
     * @return String
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param CommentCollectionInterface $comments
     * @return $this
     */
    public function setComments(CommentCollectionInterface $comments)
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @return CommentCollectionInterface
     */
    public function getComments()
    {
        return $this->comments;
    }
}