<?php
include('../../inc/Autoloader.php');

header('Content-Type: application/json;');

use Mapper\ReactionMapper;
use Model\Reaction;
use Mapper\Comment;
use Model\CommentMapper;
$action = $_POST['action'] ?? null;


$output = array("error" => false);

switch($action){
    case 'upvote':
		$pictureID = $_POST['PictureID'] ?? null;
		// TODO: get user id from session
        $reaction = new Reaction(null, $userID, $pictureID, "UPVOTE",null);
        ReactionMapper::add($reaction);
        break;
    case 'downvote':
        $pictureID = $_POST['PictureID'] ?? null;
        $reaction = new Reaction(null, $userID, $pictureID, "DOWNVOTE",null);
        ReactionMapper::add($reaction);
        break;
	case 'comment':
		$pictureID = $_POST['PictureID'] ?? null;
		$content = $_POST['content'] ?? null;
		$comment = new Comment(null, $userID, $pictureID, $content, null);
		CommentMapper::add($comment);
}

echo json_encode($output);
