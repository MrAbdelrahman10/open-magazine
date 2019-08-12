<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="utf-8">
        <title><?php echo $_SignIn; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo ADM_CURRENT_URL_TEMPLATE; ?>css/signin.css" />

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>

        <!--Inspired by http://tutorialzine.com/2012/02/apple-like-login-form/ - Apple-like Login Form with CSS 3D Transforms -->

        <div class="container">
            <div class="row">
                <div class="container" id="formContainer">

                    <form class="form-signin" id="login" role="form" action="<?php echo ADM_BASE . 'Home/SignIn' ?>" method="POST">
                        <h3 class="form-signin-heading"><?php echo $_SignIn; ?></h3>
<!--                        <a href="#" id="flipToRecover" class="flipLink">
                            <div id="triangle-topright"></div>
                        </a>-->
                        <input type="text" class="form-control" placeholder="<?php echo $_UserName; ?>" name="UserName" id="UserName" required autofocus />
                        <br />
                        <input type="password" class="form-control" placeholder="<?php echo $_Password; ?>" name="Password" id="Password" required />
                        <br />
                        <button class="btn btn-lg btn-submit btn-block" type="submit"><?php echo $_SignIn; ?></button>
                    </form>

                </div> <!-- /container -->
            </div>
        </div>
<script src="<?php echo APP_PUBLIC; ?>Scripts/JQuery.min.js" type="text/javascript"></script>
    </body>
</html>