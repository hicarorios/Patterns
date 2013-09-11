<?php

namespace Model;

class Comment implements CommentInterface
{
    protected $id;
    protected $content;
    protected $poster;

    /**
     * @param String $content
     * @param String $poster
     */
    public function __construct($content, $poster)
    {
        $this->setContent($content);
        $this->setPoster($poster);
    }

    /**
     * @param int $id
     * @return $this
     * @throws \BadMethodCallException
     * @throws \InvalidArgumentException
     */
    public function setId($id)
    {
        if ($this->id !== null) {
            throw new \BadMethodCallException("The ID for this comment has been set already.");
        }

        if (!is_int($id) || $id < 1) {
            throw new \InvalidArgumentException("The comment ID is invalid.");
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
     * @param String $content
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setContent($content)
    {
        if (!is_string($content) || strlen($content) < 2) {
            throw new \InvalidArgumentException("The content of the comment is invalid.");
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
     * @param String $poster
     * @return $this
     * @throws \InvalidArgumentException
     */
    public function setPoster($poster)
    {
        if (!is_string($poster)
            || strlen($poster) < 2
            || strlen($poster) > 30) {
            throw new \InvalidArgumentException("The poster is invalid.");
        }

        $this->poster = htmlspecialchars(trim($poster), ENT_QUOTES);
        return $this;
    }

    /**
     * @return String
     */
    public function getPoster()
    {
        return $this->poster;
    }
}