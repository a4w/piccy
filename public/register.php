<html>
    <head>
        <title>Registrtion</title>
        <link rel="stylesheet" href="./vendor/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./vendor/fontawesome/css/all.min.css">
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
                        <label for="bio">Bio: </label>
                        <textarea id="bio" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-dark float-right" id="save"><i class="fas fa-check"></i>&nbsp;Register</button>
                </div>
            </div>
        </div>
        <script src="./vendor/jquery/js/jquery.min.js"></script>
        <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>
