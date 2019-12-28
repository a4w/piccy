<?php
namespace Mapper;

use \Model\Follow;
use Model\User;
use PDOStatement;
use Mapper\DatabaseConnection as DB;

class FollowMapper
{
    private static function bindParameters(Follow &$follow, PDOStatement &$stmt){
        $follower = $follow->getFollowerUserID();
        $followed = $follow->getFollowedUserID();
        $stmt->bindParam(':follower', $follower);
        $stmt->bindParam(':followed', $followed);
    }
    static function add($follow){
        $stmt = DB::prepare('INSERT INTO Follow VALUES (:follower, :followed)');
        self::bindParameters($follow,$stmt);
        $stmt->execute();
    }
    static function get($followerid, $followedid){
        $stmt = DB::prepare('SELECT * FROM Follow WHERE FollowerUserID = :follower AND FollowedUserID = :followed');
        $stmt->bindParam(':follower', $followerid);
        $stmt->bindParam(':followed', $followedid);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $follow = null;
        if($stmt->rowCount() > 0){
            $row = $stmt->fetch();
            $follow = new Follow($row['FollowerUserID'], $row['FollowedUserID']);
        }
        return $follow;
    }
    /**
     * @param User $user
     * returns an array of $follow objects [Follower, Followed]
     * for $user where the 'Follower' is $user
     * @return array $follows
     */
    static function getAllFollowsByUser(User $user)
    {
        $userid = $user->getUserID();
        $stmt = DB::prepare('SELECT * FROM Follow WHERE FollowerUserID = :userid');
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $follows = [];
        if ($stmt->rowCount() > 0){
            while ($row = $stmt->fetch()) {
                $follow = new Follow($row['FollowerUserID'], $row['FollowedUserID']);
                $follows[] = $follow;
            }
        }
        return $follows;
    }
    static function delete(Follow $follow){
        $stmt = DB::prepare('DELETE FROM Follow WHERE FollowerUserID = :follower AND FollowedUserID = :followed');
        self::bindParameters( $follow, $stmt);
        $stmt->execute();
    }

    static function getNumberOfFollowing(User $user){
        return sizeof(FollowMapper::getAllFollowsByUser($user));
    }

    static function getAllUserFollowers($user){
        $userid = $user->getUserID();
        $stmt = DB::prepare('SELECT * FROM Follow WHERE FollowedUserID = :userid');
        $stmt->bindParam(':userid', $userid);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        $follows = [];
        if ($stmt->rowCount() > 0){
            while ($row = $stmt->fetch()) {
                $follow = new Follow($row['FollowerUserID'], $row['FollowedUserID']);
                $follows[] = $follow;
            }
        }
        return $follows;
    }

    static function getNumberOfFollowers(User $user){
        return sizeof(FollowMapper::getAllUserFollowers($user));
    }

    static function exists($followerID, $followedID){
        return FollowMapper::get($followerID, $followedID) !== NULL;
    }
}
