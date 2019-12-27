<?php


namespace Model;


class Follow
{
    private $followerUserID;
    private $followedUserID;

    public function __construct($followerUserID, $followedUserID)
    {
        $this->followerUserID = $followerUserID;
        $this->followedUserID = $followedUserID;
    }

    public function getFollowerUserID()
    {
        return $this->followerUserID;
    }

    public function getFollowedUserID()
    {
        return $this->followedUserID;
    }

}