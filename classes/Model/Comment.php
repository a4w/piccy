<?php


namespace Model;


class Comment
{
    private $commentID;
    private $userID;
    private $pictureID;
    private $content;
    private $createdAt;

    public function __construct($commentID, $userID, $pictureID, $content, $createdAt)
    {
        $this->commentID = $commentID;
        $this->userID = $userID;
        $this->pictureID = $pictureID;
        $this->content = $content;
        $this->createdAt = $createdAt;
    }

    public function getCommentID()
    {
        return $this->commentID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getPictureID()
    {
        return $this->pictureID;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}