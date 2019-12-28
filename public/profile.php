<?php
include('./../inc/Autoloader.php');
use Mapper\PictureMapper;
use Mapper\UserMapper;
use View\PictureView;
use Mapper\FollowMapper;
session_start();

if (!isset($_SESSION['user']))
    header('Location: login.php');

$visitor = $_SESSION['user'];
$visitorUserID = $visitor->getUserId();
$visitedUserID = $_GET['visitedUserID'];
$visitedUser = UserMapper::get($visitedUserID);
$pictures = PictureMapper::getUserPictures($visitedUser);
?>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./vendor/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./css/styles.css">
    <style>
        .title{
            color: #FFF;
            font-size: 40pt;
            font-family: 'serif';
        }
    </style>
</head>
<body>
<div>
    <div class="container-fluid">
        <p>Username: <?= $visitedUser->getUsername()?></p>
        <p>Email: <?= $visitedUser->getEmail()?></p>
        <p>Bio: <?= $visitedUser->getBio()?></p>
        <?php $numberOfFollowers = FollowMapper::getNumberOfFollowers($visitedUser)?>
        <p id="numberOfFollowers" number="<?=$numberOfFollowers?>">Number Of Followers: </p>
        <p>Number Of Following: <?= FollowMapper::getNumberOfFollowing($visitedUser)?></p>
        <?php
            $showFollow = FollowMapper::exists($visitorUserID, $visitedUserID);
            $showUnfollow = !$showFollow;
            $showFollow &= ($visitedUserID != $visitorUserID);
            $showUnfollow &= ($visitedUserID != $visitorUserID);
            echo "<div class='col-auto'>
                <button class='btn btn-sm btn-danger' id='unfollow' followedUserID='$visitedUserID' show='$showFollow'><i class='fas fa-arrow-down'></i></button>
            </div>";
            echo "<div class='col-auto'>
                <button class='btn btn-sm btn-success' id='follow' followedUserID='$visitedUserID' show='$showUnfollow'><i class='fas fa-arrow-up'></i></button>
            </div>";
        ?>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-4">
            <h1 class="text-center title"><i class="fas fa-camera"></i>&nbsp;Piccy</h1>
            <?php
            foreach($pictures as $picture){
                (new PictureView($picture))->render();
            }
            ?>
        </div>
    </div>
</div>
<script src="./vendor/jquery/js/jquery.min.js"></script>
<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="js/follow.js"></script>
<script>
</script>
</body>
</html>
