<?php
namespace Mapper;

use \Model\Reaction;
use PDOStatement;
use Mapper\DatabaseConnection as DB;

/**
 * Maps a Reaction object to a database row
 * This acts as storage manager for the Reaction entity
 */
class ReactionMapper{
    private static function bindReactionParameters(Reaction &$reaction, PDOStatement &$stmt){
        // Getters functions return value
        // We are extracting variables from getters because the bindParam() second argument is passed by reference
        $id = $reaction->getReactionID();
        $stmt->bindParam(':reactionid', $id);
        $userid = $reaction->getUserID();
        $stmt->bindParam(':userid', $userid);
        $pictureid = $reaction->getPictureID();
        $stmt->bindParam(':pictureid', $pictureid);
        $reactionType = $reaction->getType();
        $stmt->bindParam(':reactionType', $reactionType); // using reactionType because type is reserved keyword
        $createdat = $reaction->getCreatedAt();
        $stmt->bindParam(':createdat', $createdat);
    }
    static function add(Reaction $reaction){
        $stmt = DB::prepare('INSERT INTO `Reaction` (`ReactionID`, `UserID`, `PictureID`, `Type`, `CreatedAt`) VALUES (:reactionid, :userid, :pictureid, :reactionType, :createdat)');
        ReactionMapper::bindReactionParameters($reaction, $stmt);
        $stmt->execute();
    }
    static function update(Reaction $reaction){
        $stmt = DB::prepare('UPDATE `Reaction` SET `ReactionID` = :reactionid, `UserID` = :userid, `PictureID` = :pictureid,
            `Type` = :reactionType, `CreatedAt` = :createdat WHERE `ReactionID` = :reactionid');
        ReactionMapper::bindReactionParameters($reaction, $stmt);
        $stmt->execute();
    }
    static function delete(Reaction $reaction){
        $stmt = DB::prepare('DELETE FROM `Reaction` WHERE `ReactionID` = :reactionid');
        $id = $reaction->getReactionId();
        $stmt->bindParam(':reactionid', $id);
        $stmt->execute();
    }
}
