<?php


namespace Mapper;

use \Model\Picture;
use PDOStatement;
use Mapper\DatabaseConnection as DB;

class PictureMapper
{
    private static function bindPictureParameters(Picture &$picture, PDOStatement &$stmt){
        $pictureid = $picture->getPictureID();
        $userid = $picture->getUserID();
        $picturePath = $picture->getPicturePath();
        $createdAt = $picture->getCreatedAt();
        $description = $picture->getDescription();
        $allowComments = $picture->getAllowComments();

        $stmt->bindParam(':pictureid', $pictureid);
        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':picturePath', $picturePath);
        $stmt->bindParam(':createdAt', $createdAt);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':allowComments', $allowComments);

    }
    static function add(Picture $picture){
        $stmt = DB::prepare('INSERT INTO Picture VALUES (:pictureid, :userid, :picturePath, :createdAt, :description, :allowComments)');
        PictureMapper::bindPictureParameters($picture, $stmt);
        $stmt->execute();
    }
    static function get($pictureid){
        $stmt = DB::prepare('SELECT * FROM Picture WHERE PictureID=:pictureid');
        $stmt->bindParam(':pictureid', $pictureid);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $picture = null;
        if($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            $picture = new Picture($row['PictureID'], $row['UserID'], $row['PicturePath'], $row['CreatedAt'], $row['Description'], $row['AllowComments']);
        }
        return $picture;
    }
}