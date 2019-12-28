<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user'] === null)
    header('Location: login.php');
?>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Upload picture</title>
        <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./vendor/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">
        <style>
            html, body{
                height: 100%;
                background-color: #FFF;
            }
            .title{
                color: #000;
                font-size: 40pt;
                font-family: 'serif';
            }
            .sub-title{
                color: #CCC;
                font-size: 20pt;
                font-family: 'sans-serif';
            }
        </style>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-4">
                    <form action="controllers/picture.controller.php" enctype="multipart/form-data" method="POST">
                        <input type="hidden" name="action" value="upload_picture" />
                        <h2 class="text-center sub-title">Upload picture</h2>
                        <input type="file" name="picture" id="picture_uploaded" style="display: none" />
                        <div class="w-100 d-flex justify-content-center align-items-center" id="upload_picture" style="border: 1px solid #AAA;width: 300px; height: 360px;border-radius: 6px;">
                            <i class="fas fa-plus" style="font-size: 100pt; color: #BBB;position: absolute;"></i>
                            <img src="./images/transparent.png" id="upload_preview" style="z-index: 2; max-height: 358px; max-width: 298px;" />
                        </div>
                        <div class="form-group mt-2">
                            <textarea placeholder="Description" name="description" class="form-control"></textarea>
                        </div>
                        <button class="btn btn-primary w-100" type="submit" id="post_picture"><i class="fas fa-upload"></i>&nbsp;Post!</button>
                    </form>
                </div>
            </div>
        </div>
        <script src="./vendor/jquery/js/jquery.min.js"></script>
        <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
        <script>
            $("#picture_uploaded").change(function(){
                // Preview image
                let file = $(this)[0].files[0];
                let reader = new FileReader();
                reader.onloadend = function(){
                    $("#upload_preview").attr("src", reader.result);
                };
                if(file){
                    reader.readAsDataURL(file);
                }
            });
            $("#upload_picture").click(function(){
                $("#picture_uploaded").trigger('click');
            });

        </script>
    </body>
</html>
