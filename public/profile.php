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
        <p>Number Of Followers: <?= FollowMapper::getNumberOfFollowers($visitedUser)?></p>
        <p>Number Of Following: <?= FollowMapper::getNumberOfFollowing($visitedUser)?></p>
        <?php
        if ($visitedUser->getUserId() !== $visitor->getUserId()){
            if (FollowMapper::exists($visitor->getUserId(), $visitedUser->getUserId())){
                echo '<div class="col-auto">
                    <button class="btn btn-sm btn-danger unfollow"><i class="fas fa-arrow-up"></i></button>
                </div>';
            }
            else{
                echo '<div class="col-auto">
                    <button class="btn btn-sm btn-success follow"><i class="fas fa-arrow-up"></i></button>
                </div>';
            }
        }
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
<script src="js/picturereactions.js"></script>
<script>
</script>
</body>
</html>
