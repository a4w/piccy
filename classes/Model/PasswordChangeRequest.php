<?php


namespace Model;


class PasswordChangeRequest
{
    private $passwordChangeRequestID;
    private $userID;
    private $createdAt;

    public function __construct($passwordChangeRequestID, $userID, $createdAt)
    {
        $this->passwordChangeRequestID = $passwordChangeRequestID;
        $this->userID = $userID;
        $this->createdAt = $createdAt;
    }

    public function getPasswordChangeRequestID()
    {
        return $this->passwordChangeRequestID;
    }

    public function getUserID()
    {
        return $this->userID;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}