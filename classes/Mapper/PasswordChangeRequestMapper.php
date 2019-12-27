<?php


namespace Mapper;

use \Model\PasswordChangeRequest;
use PDOStatement;
use Mapper\DatabaseConnection as DB;


class PasswordChangeRequestMapper
{
    private static function bindParameters(PasswordChangeRequest &$passwordChangeRequest, PDOStatement &$stmt){
        $passwordChangeRequestID = $passwordChangeRequest->getPasswordChangeRequestID();
        $userID = $passwordChangeRequest->getUserID();
        $createdAt = $passwordChangeRequest->getCreatedAt();

        $stmt->bindParam(':requestID', $passwordChangeRequestID);
        $stmt->bindParam(':userID', $userID);
        $stmt->bindParam(':createdAt', $createdAt);
    }

    public static function add(PasswordChangeRequest $passwordChangeRequest){
        $stmt = DB::prepare('INSERT INTO PasswordChangeRequest (PasswordChangeRequestID, UserID, CreatedAt) VALUES (:requestID,:userID,:createdAt)');
        PasswordChangeRequestMapper::bindParameters($passwordChangeRequest, $stmt);
        $stmt->execute();
    }
    public static function get($requestID){
        $stmt = DB::prepare('SELECT * FROM PasswordChangeRequest WHERE PasswordChangeRequestID=:requestid');
        $stmt->bindParam(':requestid', $requestID);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $row = $stmt->fetch();


        /// TODO check $row has content
        $passwordChangeRequest = new PasswordChangeRequest($row['PasswordChangeRequestID'], $row['UserID'], $row['CreatedAt']);
        return $passwordChangeRequest;
    }
}