<?php
namespace Mapper;

use \Model\User;
use PDOStatement;
use Mapper\DatabaseConnection as DB;

class UserMapper{
    private static function bindUserParameters(User &$user, PDOStatement &$stmt){
        // Getters functions return value
        // We are extracting variables from getters because the bindParam() second argument is passed by reference
        $id = $user->getUserID();
        $stmt->bindParam(':userid', $id);
        $username = $user->getUsername();
        $stmt->bindParam(':username', $username);
        $password = $user->getPassword();
        $stmt->bindParam(':password', $password);
        $countryid = $user->getCountryID();
        $stmt->bindParam(':countryid', $countryid);
        $email = $user->getEmail();
        $stmt->bindParam(':email', $email);
        $bio = $user->getBio();
        $stmt->bindParam(':bio', $bio);
        $profile_pic = $user->getProfilePicturePath();
        $stmt->bindParam(':profilePic', $profile_pic);
    }
    static function add(User $user){
        $stmt = DB::prepare('INSERT INTO `User` (`UserID`, `Username`, `Password`, `CountryID`, `Email`, `Bio`, `ProfilePicturePath`) VALUES (:userid, :username, :password, :countryid, :email, :bio, :profilePic)');
        UserMapper::bindUserParameters($user, $stmt);
        $stmt->execute();
    }
    static function update(User $user){
        $stmt = DB::prepare('UPDATE `User` SET `Username` = :username, `Password` = :password, `CountryID` = :countryid,
            `Bio` = :bio, `email` = :email, `ProfilePicturePath` = :profilePic WHERE `UserID` = :userid');
        UserMapper::bindUserParameters($user, $stmt);
        $stmt->execute();
    }
    static function delete(User $user){
        $stmt = DB::prepare('DELETE FROM `User` WHERE `UserID` = :userid');
        $id = $user->getUserID();
        $stmt->bindParam(':userid', $id);
        $stmt->execute();
    }
}
