<?php

namespace SeparatedInterfaces\Model;

class Post extends AbstractEntity implements PostInterface
{
    protected $title;
    protected $content;
    protected $comments;
    protected $commentFinder;

    public function __construct($title, $content, CommentFinderInterface $commentFinder)
    {
        $this->setTitle($title);
        $this->setContent($content);
        $this->commentFinder = $commentFinder;
    }

    public function setTitle($title)
    {
        $this->title = $this->sanitizeString($title);
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setContent($content)
    {
        $this->content = $this->sanitizeString($content);
        return $this;
    }

    public function getContent() {
        return $this->content;
    }

    public function getComments()
    {
        if ($this->comments === null) {
            $this->comments = $this->commentFinder->findAll(
                array("post_id" => $this->id));
        }
        return $this->comments;
    }
}