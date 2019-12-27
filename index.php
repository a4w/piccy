<?php

use Mapper\PasswordChangeRequestMapper;
use Mapper\PictureMapper;
use Mapper\UserMapper;
use Model\PasswordChangeRequest;
use Model\Picture;
use Model\User;

include('inc/Autoloader.php');


    $picture = PictureMapper::get(1);
    if($picture === null) echo "can't find picture 1<br>";
    else{
        echo $picture->getPictureID();
        echo "<br>";

        echo $picture->getUserID();
        echo "<br>";

        echo $picture->getPicturePath();
        echo "<br>";

        echo $picture->getCreatedAt();
        echo "<br>";

        echo $picture->getDescription();
        echo "<br>";

        echo $picture->getAllowComments();
        echo "<br>";
    }
    $picture2 = PictureMapper::get(1);
    if($picture2 === null) echo "can't find picture <br>";
?>
