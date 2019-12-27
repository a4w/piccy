<?php

use Mapper\CommentMapper;
use Mapper\PasswordChangeRequestMapper;
use Mapper\PictureMapper;
use Mapper\UserMapper;
use Model\Comment;
use Model\PasswordChangeRequest;
use Model\Picture;
use Model\Reaction;
use Model\User;

include('inc/Autoloader.php');
    $picture = PictureMapper::get(2);
    $comments[] = CommentMapper::getAllComments($picture);
    var_dump($comments);
?>
