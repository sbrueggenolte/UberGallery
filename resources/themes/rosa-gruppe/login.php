<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

    <head>
        <title>Rosa Gruppe</title>

        <link rel="shortcut icon" href="<?php echo THEMEPATH; ?>/img/favicon.ico" />

        <script type="text/javascript" src="//code.jquery.com/jquery-2.1.4.min.js"></script>

        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css" href="<?php echo THEMEPATH; ?>/css/login-style.css" />

        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <?php file_exists('googleAnalytics.inc') ? include('googleAnalytics.inc') : false; ?>
    </head>

    <body>

        <div class="container">
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <!-- Tabs Titles -->

                    <!-- Icon -->
                    <div class="fadeIn first">
                        <img src="resources/themes/rosa-gruppe/img/duenenweg.png" id="icon" alt="User Icon" />
                    </div>

                    <!-- Login Form -->
                    <form method="post" action="/">
                        <h2>Rosa Gruppe</h2>
                        <input type="text" id="login" class="fadeIn second" name="login" placeholder="E-Mail-Adresse">
                        <input type="text" id="password" class="fadeIn third" name="password" placeholder="Password">
                        <input type="submit" class="fadeIn fourth" value="Los geht's">
                    </form>

                    <!-- Remind Passowrd -->
                    <div id="formFooter">
                        <a class="underlineHover" href="mailto:sbrueggenolte@posteo.de">Passwort vergessen?</a>
                    </div>

                </div>
            </div>
        </div>

    </body>

</html>
