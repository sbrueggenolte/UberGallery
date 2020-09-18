<?php
session_start();

// load valid logins
$logins = [];
$loginRows = explode("\n", file_get_contents('../logins'));
foreach ($loginRows as $loginRow) {
    $loginData = explode(";", $loginRow);
    $logins[$loginData[0]] = $loginData[1];
}

function simulateSessionTimeout() {
    //Ending a php session after 30 minutes of inactivity
    $minutesBeforeSessionExpire = 0.1;
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire * 60))) {
        session_unset();     // unset $_SESSION
        session_destroy();   // destroy session data
        session_start();
    }

    $_SESSION['LAST_ACTIVITY'] = time(); // update last activity
}

// simulateSessionTimeout();

$secret1 = 'hf4930gf84f7gG=06g763r0g&=R%&)g7d0gew8/5';
$secret2 = 'u7i6df%If6O/()G/p8f568d454%)&/)(h89G&Of6';


// logout
if ($_POST['logout']) {
    unset($_SESSION['login']);
    setcookie("login", "", time() - 3600);
    setcookie("login_hash", "", time() - 3600);
    // show login form
    include($gallery->getThemePath(true) . '/login.php');
    exit;
}

// re-check credentials
if (isset($_SESSION['login'])) {
    $login = $_SESSION['login']['login'];
    $hash  = $_SESSION['login']['hash'];

    if (isset($logins[$login]) && $hash === md5($secret1 . $logins[$login] . $secret2)) {
        $_SESSION['login'] = [
            'login' => $login,
            'hash'  => $hash
        ];

        return;
    }
    unset($_SESSION['login']);
}

if (!$_SESSION['login']) {
    if (isset($_COOKIE['login'], $_COOKIE['login_hash'])) {
        $login = $_COOKIE['login'];
        $hash  = $_COOKIE['login_hash'];

        if (isset($logins[$login]) && $hash === md5($secret1 . $logins[$login] . $secret2)) {
            $_SESSION['login'] = [
                'login' => $login,
                'hash'  => $hash
            ];

            return;
        }
    }

    // try to login
    if ($_POST['login'] && $_POST['password']) {
            $login = $_POST['login'];
            $pw    = $_POST['password'];
            $hash = md5($secret1 . $pw . $secret2);

            if (isset($logins[$login]) && $hash === md5($secret1 . $logins[$login] . $secret2)) {
                $_SESSION['login'] = [
                    'login' => $login,
                    'hash'  => $hash
                ];

                // Set Cookie expiration for 1 month
                $cookie_expiration_time = time() + (30 * 24 * 60 * 60);  // for 1 month
                // Set Cookies
                setcookie("login", $login, $cookie_expiration_time);
                setcookie("login_hash", $hash, $cookie_expiration_time);

                return;
            }
    }

    // show login form
    include($gallery->getThemePath(true) . '/login.php');
    exit;
}
