<?php
include('./../inc/Autoloader.php');
use Mapper\PictureMapper;
use Mapper\UserMapper;
use View\PictureView;
session_start();

if (!isset($_SESSION['user']))
    header('Location: login.php');

$user = $_SESSION['user'];
$userID = $user->getUserId();
$pictures = PictureMapper::getWallPictures($user);
?>
<html>
    <head>
        <title>User Wall</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./vendor/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">
        <style>
            .title{
                color: #FFF;
                font-size: 20pt;
                font-family: 'serif';
            }
            .topbar{
                padding: 5px;
                z-index: 5;
                width: 100%;
                position: fixed;
                height: 50px;
                background-color: #007bff;
            }
            .footer-nav{
                height: 35px;
                padding: 5px;
                bottom: 0;
                z-index: 5;
                width: 100%;
                position: fixed;
                background-color: #007bff;
                font-size: 18pt;
            }
            .active-place{
                color: #444;
            }
            .hidden_link{
                color: #FFF;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row footer-nav justify-content-center">
                <div class="col-3 text-center">
                    <a class='hidden_link' href="wall.php"><i class="fas fa-home active-place"></i></a>
                </div>
                <div class="col-3 text-center">
                    <a class="hidden_link" href="#"><i class="fas fa-search"></i></a>
                </div>
                <div class="col-3 text-center">
                    <a class="hidden_link" href="upload_pic.php"><i class="fas fa-plus"></i></a>
                </div>
                <div class="col-3 text-center">
                    <a class="hidden_link" href="profile.php?visitedUserID=<?= $user->getUserID() ?>"><i class="fas fa-user"></i></a>
                </div>
            </div>
            <div class="row topbar justify-content-center">
                <div class="col-auto">
                    <span class="title"> <i class="fas fa-camera"></i>&nbsp;Piccy</span>
                </div>
            </div>
            <div style="height: 50px"></div>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-4">
<?php
foreach($pictures as $picture){
    (new PictureView($picture))->render();
}
?>
                </div>
            </div>
        </div>
        <div style="height: 35px"></div>
        <script src="./vendor/jquery/js/jquery.min.js"></script>
        <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="js/picturereactions.js"></script>
        <script>
        </script>
    </body>
</html>
