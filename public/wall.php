<?php
include('./../inc/Autoloader.php');
use Mapper\PictureMapper;
use Mapper\UserMapper;
use View\PictureView;

$pictures = PictureMapper::getWallPictures(UserMapper::getByUsername('ahmad'));
?>
<html>
    <head>
        <title>User Wall</title>
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
