<?php


namespace Model;


class EmailVerification
{
    private $emailVerificationID;
    private $userID;

    public function __construct($emailVerificationID, $userID)
    {
        $this->emailVerificationID = $emailVerificationID;
        $this->userID = $userID;
    }

    public function getEmailVerificationID()
    {
        return $this->emailVerificationID;
    }

    public function getUserID()
    {
        return $this->userID;
    }
}