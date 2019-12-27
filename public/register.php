<html>
    <head>
        <title>Registrtion</title>
        <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./vendor/fontawesome/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">
        <style>
            html, body{
                height: 100%;
                background-color: #5454EC;
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
            <div class="row justify-content-center">
                <div class="col-12 col-lg-4">
                    <h1 class="text-center title"><i class="fas fa-camera"></i>&nbsp;Piccy</h1>
                    <h2 class="text-center sub-title">Registration</h2>
                    <div class="form-group">
                        <label for="username">Username: </label>
                        <input id="username" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="password">Password: </label>
                        <input id="password" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password: </label>
                        <input id="confirm_password" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email: </label>
                        <input id="email" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="country">Country: </label>
                        <select id="country">
                        
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="bio">Bio: </label>
                        <textarea id="bio" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-dark float-right" id="register"><i class="fas fa-check"></i>&nbsp;Register</button>
                </div>
            </div>
        </div>
        <script src="./vendor/jquery/js/jquery.min.js"></script>
        <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
        <script>
        $("#register").click(function(){
            $("#username").removeClass("border-danger");
            $("#password").removeClass("border-danger");
            $("#email").removeClass("border-danger");
            $(".field-error").remove();
            if($("#username").val() === ""){
                $("#username").addClass("border-danger");
                $("#username").parent().append("<span class='field-error'>Username is Empty!</span>");
                return;
            }
            if($("#username").val().length < 4 || $("#username").val().length > 10){
                $("#username").addClass("border-danger");
                $("#username").parent().append("<span class ='field-error'>Username Must be between 4-10</span>");
                return;
            }
            if($("#password").val() != $("#confirm_password").val()){
                $("#password").addClass("border-danger");
                $("#password").parent().append("<span class ='field-error'>Passwords do not match</span>");
                return;
            }
            if($("#password").val().length < 8 || $("#password").val().length > 16){
                $("#password").addClass("border-danger");
                $("#password").parent().append("<span class ='field-error'>Passwords between 8-16</span>");
                return;
            }
            if($("#email").val() === ""){
                $("#email").addClass("border-danger");
                $("#email").parent().append("<span class ='field-error'>Email Is Empty!</span>");
                return;
            }
            $.post("controllers/user.controller.php", {
                "action" : "register",
                "username":$("#username").val(),
                "password":$("#password").val(),
                "bio":$("#bio").val(),
                "email":$("#email").val()}
            ).done(function(data){
                if(data.error){
                    $("#username").addClass("border-danger");
                    $("#username").parent().append("<span class ='field-error'>Already Exist</span>");
                }else{
            
                }
            });
        });
        </script>
    </body>
</html>
