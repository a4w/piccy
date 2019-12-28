<?php
include('./../inc/Autoloader.php');
use Mapper\PictureMapper;
use Mapper\UserMapper;
use View\PictureView;
use Mapper\FollowMapper;
session_start();

if (!isset($_SESSION['user']))
    header('Location: login.php');

$user = $_SESSION['user'];
$visitorUserID = $user->getUserId();
$visitedUserID = $_GET['id'];
$visitedUser = UserMapper::get($visitedUserID);
$pictures = PictureMapper::getUserPictures($visitedUser);
$numberOfFollowers = FollowMapper::getNumberOfFollowers($visitedUser);
$numberOfFollowing = FollowMapper::getNumberOfFollowing($visitedUser);
$showFollow = FollowMapper::exists($visitorUserID, $visitedUserID);
$showUnfollow = !$showFollow;
$showFollow &= ($visitedUserID != $visitorUserID);
$showUnfollow &= ($visitedUserID != $visitorUserID);
?>
<html lang="en">
    <head>
        <title>User Profile</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <style>
        .username{
            font-size: 25pt;
            display: block;
        }
        .followers{
            font-size: 20pt;
        }
        .following{
            font-size: 20pt;
        }
        .f-title{
            display: block;
        }
        .email{
            display: block;
        }
        .bio{
            display: block;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row footer-nav justify-content-center">
        <div class="col-3 text-center">
            <a class='hidden_link' href="wall.php"><i class="fas fa-home "></i></a>
        </div>
        <div class="col-3 text-center">
            <a class="hidden_link" href="search.php"><i class="fas fa-search"></i></a>
        </div>
        <div class="col-3 text-center">
            <a class="hidden_link" href="upload_pic.php"><i class="fas fa-plus"></i></a>
        </div>
        <div class="col-3 text-center">
            <a class="hidden_link" href="profile.php?id=<?= htmlspecialchars($user->getUserID()) ?>"><i class="fas fa-user active-place"></i></a>
        </div>
    </div>
    <div class="row topbar justify-content-center">
        <div class="col-auto">
            <span class="title"> <i class="fas fa-camera"></i>&nbsp;Piccy</span>
        </div>
    </div>
    <div style="height: 55px"></div>
    <div class="row">
        <div class="col-6">
            <span class="username"><?=htmlspecialchars($visitedUser->getUsername())?></span>
            <a href="mailto:<?=htmlspecialchars($visitedUser->getEmail())?>" class="email"><?=htmlspecialchars($visitedUser->getEmail())?></a>
        </div>
        <div class="col-3">
            <span class="f-title">Followers</span>
            <span number="<?=htmlspecialchars($numberOfFollowers)?>" class="followers" id="numberOfFollowers"><?=htmlspecialchars($numberOfFollowers)?></span>
        </div>
        <div class="col-3">
            <span class="f-title">Following</span>
            <span class="following"><?=htmlspecialchars($numberOfFollowing) ?></span>
        </div>
        <div class="col-6">
            <span class="bio"><?=htmlspecialchars($visitedUser->getBio())?></span>
        </div>
        <div class="col-6">
            <?php
                echo "<button class='btn btn-sm btn-dark w-100' id='unfollow' followedUserID='$visitedUserID' show='$showFollow'><i class='fas fa-user-minus'></i>&nbsp;Unfollow</button>";
                echo "<button class='btn btn-sm btn-light w-100' id='follow' followedUserID='$visitedUserID' show='$showUnfollow'><i class='fas fa-user-plus'></i>&nbsp;Follow</button>";
            ?>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12 col-lg-4">
            <?php
            foreach($pictures as $picture){
                (new PictureView($picture))->render();
            }
            ?>
        </div>
    </div>
    <div style="height: 35px"></div>
</div>
<script src="./vendor/jquery/js/jquery.min.js"></script>
<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/follow.js"></script>
<script src="./js/picturereactions.js"></script>
<script>
</script>
</body>
</html>
