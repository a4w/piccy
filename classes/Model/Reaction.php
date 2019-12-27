<?php


namespace Model;


class Reaction
{
    private $reactionID;
    private $userID;
    private $pictureID;
    private $type;
    private $timestamp;


    public function __construct($reactionID, $userID, $pictureID, $type, $timestamp)
    {
        $this->reactionID = $reactionID;
        $this->userID = $userID;
        $this->pictureID = $pictureID;
        $this->type = $type;
        $this->timestamp = $timestamp;
    }

    public function getReactionID()
    {
        return $this->reactionID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getPictureID()
    {
        return $this->pictureID;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }


}