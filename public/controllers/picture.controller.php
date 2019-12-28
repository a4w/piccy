<?php
include('../../inc/Autoloader.php');
session_start();

header('Content-Type: application/json;');

use Mapper\ReactionMapper;
use Model\Reaction;
use Model\Comment;
use Mapper\CommentMapper;
use Mapper\PictureMapper;
use Model\Picture;
use Model\REACTION_TYPE;

$action = $_POST['action'] ?? null;
if (!array_key_exists('user', $_SESSION) || $_SESSION['user'] === NULL) {
    header('Location: ../login.php');
    exit();
}

$output = array("error" => false);
$user = $_SESSION['user'];
$userID = $user->getUserID();
switch($action){
    case 'upvote':
        $pictureID = $_POST['PictureID'] ?? null;
        $reaction = new Reaction(null, $userID, $pictureID, REACTION_TYPE::UPVOTE,null);
        ReactionMapper::add($reaction);
        $output['numberOfUpvotes'] = ReactionMapper::getNumberOfReactsTypeByPicture(PictureMapper::get($pictureID), REACTION_TYPE::UPVOTE);
        break;
    case 'downvote':
        $pictureID = $_POST['PictureID'] ?? null;
        $reaction = new Reaction(null, $userID, $pictureID, REACTION_TYPE::DOWNVOTE,null);
        ReactionMapper::add($reaction);
        $output['numberOfDownvotes'] = ReactionMapper::getNumberOfReactsTypeByPicture(PictureMapper::get($pictureID), REACTION_TYPE::DOWNVOTE);
        break;
    case 'addcomment':
        $pictureID = $_POST['PictureID'] ?? null;
        $content = $_POST['comment'] ?? null;
        $comment = new Comment(null, $userID, $pictureID, $content, null);
        CommentMapper::add($comment);
        break;
    case 'upload_picture':
        var_dump($_FILES);
        // Upload picture
        if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
            $description = $_POST['description'] ?? null;
            $pic_path = 'user_pictures/user_' . $user->getUsername() . '/';
            $file_name = $_FILES['picture']['name'];
            $file_size = $_FILES['picture']['size'];
            $file_tmp = $_FILES['picture']['tmp_name'];
            $picture_obj = new Picture(null, $userID, $pic_path, null, $description, true);
            $picture_obj = PictureMapper::add($picture_obj);
            $pic_path = $picture_obj->getPicturePath() . $picture_obj->getPictureID();
            $picture_obj->setPicturePath($pic_path);
            PictureMapper::update($picture_obj);
            move_uploaded_file($file_tmp, __DIR__ . '/../'. $pic_path);
            // header('Location: ../wall.php');
        }
        break;
}

echo json_encode($output);
