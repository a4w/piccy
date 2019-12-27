<?php


namespace Model;


class Account
{
    private $userID;
    private $username;
    private $password;
    private $countryID;
    private $email;
    private $bio;
    private $profilePicturePath;

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