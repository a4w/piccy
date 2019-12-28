<?php
include('../../inc/Autoloader.php');
session_start();

header('Content-Type: application/json;');

use Mapper\FollowMapper;
use Model\Follow;

$action = $_POST['action'] ?? null; /// if(!isset($_POST['action']) $action = null;
if (!array_key_exists('user', $_SESSION) || $_SESSION['user'] === NULL) {
    header('Location: login.php');
    exit();
}


$output = array("error" => false);
$user = $_SESSION['user'];
$userID = $user->getUserId();

switch($action){
    case 'follow':
		$followedUserID = $_POST['FollowedUserID'];
        $follow = new Follow($userID, $followedUserID);
        FollowMapper::add($follow);
        break;
    case 'unfollow':
        $unfollowedUserID = $_POST['UnfollowedUserID'];
        $follow = new Follow($userID, $unfollowedUserID);
        FollowMapper::delete($follow);
        break;
}

echo json_encode($output);
