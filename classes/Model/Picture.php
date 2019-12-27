<?php


namespace Model;


class Picture
{
    private $pictureID;
    private $userID;
    private $picturePath;
    private $createdAt;
    private $description;
    private $allowComments;

    public function __construct($pictureID, $userID, $picturePath, $createdAt, $description, $allowComments)
    {
        $this->pictureID = $pictureID;
        $this->userID = $userID;
        $this->picturePath = $picturePath;
        $this->createdAt = $createdAt;
        $this->description = $description;
        $this->allowComments = $allowComments;
    }

    public function getPictureID()
    {
        return $this->pictureID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getPicturePath()
    {
        return $this->picturePath;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }


    public function getDescription()
    {
        return $this->description;
    }

    public function getAllowComments()
    {
        return $this->allowComments;
    }


}