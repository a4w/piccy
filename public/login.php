<?php
session_start();
if(isset($_SESSION['user']) && $_SESSION['user'] !== null)
    header('Location: wall.php');
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Login</title>
        <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./vendor/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">
        <style>
            html, body{
                height: 100%;
                background-color: #4348DB;
            }
            .title{
                color: #FFF;
                font-size: 40pt;
                font-family: 'serif';
            }
            .sub-title{
                color: #BBF;
                font-size: 20pt;
                font-family: 'sans-serif';
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center mt-5">
                <div class="col-12 col-lg-4">
                    <h1 class="text-center title"><i class="fas fa-camera"></i>&nbsp;Piccy</h1>
                    <h2 class="text-center sub-title">Login</h2>
                    <div class="form-group">
                        <label for="username">Username: </label>
                        <input id="username" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input id="password" class="form-control"/>
                    </div>
                    <a href="register.php" style="color: #FFF;text-decoration: underline;">Not a user? Register</a>
                    <span class="alert alert-danger w-100" style="display: block;" id="status"></span>
                    <button class="btn btn-dark float-right d-block" id="login"><i class="fas fa-sign-in-alt"></i>&nbsp;Login</button>
                </div>
            </div>
        </div>
        <script src="./vendor/jquery/js/jquery.min.js"></script>
        <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
        <script>
        $("#status").hide();
        $("#login").click(function(){
            $("#username").removeClass("border-danger");
            $("#password").removeClass("border-danger");
            $("#status").hide();
            $(".field-error").remove();
            if($("#username").val() === ""){
                $("#username").addClass("border-danger");
                $("#username").parent().append("<span class='field-error'>Username is Empty!</span>");
                return;
            }
            if($("#password").val() == ""){
                $("#password").addClass("border-danger");
                $("#password").parent().append("<span class ='field-error'>Passwords is Empty</span>");
                return;
            }
            $.post("controllers/user.controller.php", {
                "action" : "login",
                "username":$("#username").val(),
                "password":$("#password").val()
               }
            ).done(function(data){
                if(data.error){
                    $("#status").show();
                    $("#status").text("Incorrect username or password!");
                }else{
                    window.location.href = "wall.php";
                }
            });
        });
        </script>
    </body>
</html>
