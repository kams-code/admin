<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V2</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/vendor/select2/select2.min.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="login/css/util.css">
    <link rel="stylesheet" type="text/css" href="login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
    <style type="text/css">
        footer{
            display: none;
        }
    </style>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" action="loginController/login" method="POST">
                    <span class="login100-form-title p-b-48">
                        <img src="assets/img/logo.png">
                    </span>

                    <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                        <input class="input100" type="text" name="login">
                        <span class="focus-input100" data-placeholder="Login"></span>
                    </div>

                    <div class="wrap-input100 validate-input" style="margin-bottom: 10px" data-validate="Enter password">
                        <span class="btn-show-pass">
                            <i class="zmdi zmdi-eye"></i>
                        </span>
                        <input class="input100" type="password" name="pass">
                        <span class="focus-input100" data-placeholder="mot de passe"></span>
                    </div>
                    <div class="col-md-12" style="text-align: right;padding: 0px">
                        <a href="javascript:;">Mot de passe oublié?</a>
                    </div>
                    

                    <div class="container-login100-form-btn" style="margin-top: 50px">
                        <p style="text-align: center;color: red"><?=isset($_REQUEST['error']) ? $_REQUEST['error'] : ''?></p>
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
                                Connexion
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<!--===============================================================================================-->
    <script src="login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="login/vendor/bootstrap/js/popper.js"></script>
    <script src="login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="login/vendor/daterangepicker/moment.min.js"></script>
    <script src="login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>
</html>