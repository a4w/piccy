<?php


namespace Model;


class User
{
    private $userID;
    private $username;
    private $password;
    private $countryID;
    private $email;
    private $bio;
    private $profilePicturePath;

    public function __construct($userID, $username, $password, $countryID, $email, $bio, $profilePicturePath)
    {
        $this->userID = $userID;
        $this->username = $username;
        $this->password = $password;
        $this->countryID = $countryID;
        $this->email = $email;
        $this->bio = $bio;
        $this->profilePicturePath = $profilePicturePath;
    }

    public function getUserID(){
        return $this->userID;
    }
    public function getUsername(){
        return $this->username;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getCountryID(){
        return $this->countryID;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getBio(){
        return $this->bio;
    }
    public function getProfilePicturePath(){
        return $this->profilePicturePath;
    }
}

?>