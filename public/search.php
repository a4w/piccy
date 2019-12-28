<?php
include('./../inc/Autoloader.php');
session_start();

if (!isset($_SESSION['user']))
    header('Location: login.php');

$user = $_SESSION['user'];
$userID = $user->getUserId();
?>
<html>
    <head>
        <title>User Wall</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./vendor/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">
<style>
.search-result{
    border-bottom: 1px solid #AAA;
    padding: 5px;
    margin: 5px;
}
</style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row footer-nav justify-content-center">
                <div class="col-3 text-center">
                    <a class='hidden_link' href="wall.php"><i class="fas fa-home"></i></a>
                </div>
                <div class="col-3 text-center">
                    <a class="hidden_link" href="search.php"><i class="fas fa-search active-place"></i></a>
                </div>
                <div class="col-3 text-center">
                    <a class="hidden_link" href="upload_pic.php"><i class="fas fa-plus"></i></a>
                </div>
                <div class="col-3 text-center">
                    <a class="hidden_link" href="profile.php?id=<?= $user->getUserID() ?>"><i class="fas fa-user"></i></a>
                </div>
            </div>
            <div class="row topbar justify-content-center">
                <div class="col-auto">
                    <span class="title"> <i class="fas fa-camera"></i>&nbsp;Piccy</span>
                </div>
            </div>
            <div style="height: 60px"></div>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-4">
                    <div class="input-group">
                        <input class="form-control" id="search" placeholder="Search ..." />
                        <div class="input-group-append">
                            <button class="btn btn-info" id="search_btn"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div id="results" class="col-12 col-lg-4">
                </div>
            </div>
        </div>
        <div style="height: 35px"></div>
        <script src="./vendor/jquery/js/jquery.min.js"></script>
        <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
        <script>
            $("#search").keyup(function(){
                $("#results").empty();
                if($("#search").val() === "")
                    return;
                $.post("controllers/search.controller.php", {'sought-username' : $("#search").val(), action: 'search'}).done(function(data){
                    $("#results").empty();
                    for(let i = 0; i < data.users.length; ++i){
                        $("#results").append(" <div class='search-result'> <a href='profile.php?id="+data.users[i].userid+"'>" + data.users[i].username + "</a> </div>");
                    }
                });
            });
        </script>
    </body>
</html>
