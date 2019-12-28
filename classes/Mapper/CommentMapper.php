<?php
namespace Mapper;

use \Model\Comment;
use Model\Picture;
use PDOStatement;
use Mapper\DatabaseConnection as DB;

/**
 * Maps a comment object to a database row
 * This acts as storage manager for the Comment entity
 */
class CommentMapper{
    private static function bindCommentParameters(Comment &$comment, PDOStatement &$stmt){
        // Getters functions return value
        // We are extracting variables from getters because the bindParam() second argument is passed by reference
        $id = $comment->getCommentID();
        $stmt->bindParam(':commentid', $id);
        $userid = $comment->getUserID();
        $stmt->bindParam(':userid', $userid);
        $pictureid = $comment->getPictureID();
        $stmt->bindParam(':pictureid', $pictureid);
        $content = $comment->getContent();
        $stmt->bindParam(':content', $content);
        $createdat = $comment->getCreatedAt();
        $stmt->bindParam(':createdat', $createdat);
    }
    static function add(Comment $comment){
        $stmt = DB::prepare('INSERT INTO `Comment` (`CommentID`, `UserID`, `PictureID`, `Content`, `CreatedAt`) VALUES (:commentid, :userid, :pictureid, :content, :createdat)');
        CommentMapper::bindCommentParameters($comment, $stmt);
        $stmt->execute();
    }
    static function get($commentid){
        $stmt = DB::prepare('SELECT * FROM Comment WHERE CommentID = :commentid');
        $stmt->bindParam(':commentid', $commentid);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $comment = null;
        if($stmt->rowCount() > 0){
            $row = $stmt->fetch();
            $comment = new Comment($row['CommentID'], $row['UserID'], $row['PictureID'], $row['Content'], $row['CreatedAt']);
        }
        return $comment;

    }
    static function getAllComments(Picture $picture){
        $pictureid = $picture->getPictureID();
        $stmt = DB::prepare('SELECT * FROM Comment WHERE PictureID = :pictureid ORDER BY `CreatedAt` ASC');
        $stmt->bindParam(':pictureid', $pictureid);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $comments = [];
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                $comment = new Comment($row['CommentID'], $row['UserID'], $row['PictureID'], $row['Content'], $row['CreatedAt']);
                $comments[] = $comment;
            }
        }
        return $comments;
    }
    static function update(Comment $comment){
        $stmt = DB::prepare('UPDATE `Comment` SET `UserID` = :userid, `PictureID` = :pictureid,
            `Content` = :content, `CreatedAt` = :createdat WHERE `CommentID` = :commentid');
        CommentMapper::bindCommentParameters($comment, $stmt);
        $stmt->execute();
    }
    static function delete(Comment $comment){
        $stmt = DB::prepare('DELETE FROM `Comment` WHERE `CommentID` = :comment');
        $id = $comment->getCommentID();
        $stmt->bindParam(':commentid', $id);
        $stmt->execute();
    }
}
