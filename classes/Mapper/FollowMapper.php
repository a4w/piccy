<?php
namespace Mapper;

use \Model\Follow;
use PDOStatement;
use Mapper\DatabaseConnection as DB;

class FollowMapper
{
    private static function bindPictureParameters(Follow &$follow, PDOStatement &$stmt){
        $follower = $follow->getFollowerUserID();
        $followed = $follow->getFollowedUserID();
        $stmt->bindParam(':follower', $follower);
        $stmt->bindParam(':followed', $followed);
    }
}
