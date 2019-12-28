<?php
include('../../inc/Autoloader.php');

header('Content-Type: application/json;');

use Mapper\	FollowMapper;
use Model\Follow;

$action = $_POST['action'] ?? null;


$output = array("error" => false);

switch($action){
    case 'follow':
		// TODO: get follower id from session
		$followedUserID = $_POST['followedUserID'] ?? null;
        $follow = new Follow($followedUserID,$followerUserID);
        FollowMapper::add($follow);
        break;
    
}

echo json_encode($output);
