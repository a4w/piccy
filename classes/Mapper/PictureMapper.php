<?php
namespace Mapper;

use \Model\Picture;
use \Model\User;
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

    static function update(Picture $picture){
        $stmt = DB::prepare('UPDATE Picture SET UserID = :userid, PicturePath = :picturePath,
                            CreatedAt = :createdAt, Description = :description, AllowComments = :allowComments WHERE PictureID = :pictureid');
        PictureMapper::bindPictureParameters($picture, $stmt);
        $stmt->execute();

    }
    static function delete(Picture $picture){
        $pictureid = $picture->getPictureID();
        $stmt = DB::prepare('DELETE FROM Picture WHERE PictureID = :pictureid');
        $stmt->bindParam(':pictureid', $pictureid);
        $stmt->execute();
    }

    static function getWallPictures(User $user){
        $stmt = DB::prepare('SELECT * FROM Picture WHERE UserID 
                                      IN(SELECT FollowedUserID FROM Follow WHERE FollowerUserID = :userid)
                                       ORDER BY CreatedAt DESC');
        $user_id = $user->getUserID();
        $stmt->bindParam(':userid', $user_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $pictures = [];
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                $picture = new Picture($row['PictureID'], $row['UserID'], $row['PicturePath'], $row['CreatedAt'], $row['Description'], $row['AllowComments']);
                $pictures[] = $picture;
            }
        }
        return $pictures;
    }

    static function getUserPictures(User $user){
        $stmt = DB::prepare('SELECT * FROM Picture
                                        WHERE UserID=:userid 
                                       ORDER BY CreatedAt DESC');
        $user_id = $user->getUserID();
        $stmt->bindParam(':userid', $user_id);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $pictures = [];
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                $picture = new Picture($row['PictureID'], $row['UserID'], $row['PicturePath'], $row['CreatedAt'], $row['Description'], $row['AllowComments']);
                $pictures[] = $picture;
            }
        }
        return $pictures;

    }
}
