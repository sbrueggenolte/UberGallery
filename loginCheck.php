<?php
session_start();

// load valid logins
$logins    = [];
$loginRows = explode("\n", file_get_contents(__DIR__ . '/../logins'));
foreach ($loginRows as $loginRow) {
    $loginData      = explode(";", $loginRow);
    $email          = strtolower(trim($loginData[2]));
    $logins[$email] = trim($loginData[3]);
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
if ($_GET['logout']) {
    unset($_SESSION['login']);
    setcookie("email", "", time() - 3600);
    setcookie("login_hash", "", time() - 3600);
    // show login form
    include($gallery->getThemePath(true) . '/login.php');
    exit;
}

// re-check credentials
if (isset($_SESSION['login'])) {
    $email = $_SESSION['login']['email'];
    $hash  = $_SESSION['login']['hash'];

    if (isset($logins[$email]) && $hash === md5($secret1 . $logins[$email] . $secret2)) {
        $_SESSION['login'] = [
            'email' => $email,
            'hash'  => $hash
        ];

        return;
    }
    unset($_SESSION['login']);
}

if (!$_SESSION['login']) {
    if (isset($_COOKIE['email'], $_COOKIE['login_hash'])) {
        $email = $_COOKIE['email'];
        $hash  = $_COOKIE['login_hash'];

        if (isset($logins[$email]) && $hash === md5($secret1 . $logins[$email] . $secret2)) {
            $_SESSION['login'] = [
                'email' => $email,
                'hash'  => $hash
            ];

            return;
        }
    }

    // try to login
    if ($_POST['email'] && $_POST['password']) {
        http_response_code(401);
        $email = strtolower(trim($_POST['email']));
        $pw    = $_POST['password'];
        $hash  = md5($secret1 . $pw . $secret2);
        $now   = (new DateTime())->getTimestamp();

        $failedLoginFile = __DIR__ . '/../failed_logins/' . str_replace('@', '_at_', $email);
        if (is_file($failedLoginFile)) {
            $failedLogins             = explode("\n", file_get_contents($failedLoginFile));
            array_pop($failedLogins);
            $lastFailedLogin          = end($failedLogins);
            $timeSinceLastFailedLogin = $now - $lastFailedLogin;
            $lockedUntil              = 0;
            $failedLoginCount         = count($failedLogins);

            for ($i = 20; $i > 0; $i--) {
                $lockTime = $i * $i * 60;
                if ($now - $lastFailedLogin < $lockTime && $i * 5 <= $failedLoginCount) {
                    $lockedUntil = $lastFailedLogin + $lockTime;
                    break;
                }
            }

            if ($lockedUntil > 0) {
                http_response_code(423);
                echo ceil(($lockedUntil - $now) / 60);
                return;
            }
        }

        if (isset($logins[$email]) && $hash === md5($secret1 . $logins[$email] . $secret2)) {
            $_SESSION['login'] = [
                'email' => $email,
                'hash'  => $hash
            ];

            // Set Cookie expiration for 1 month
            $cookie_expiration_time = time() + (30 * 24 * 60 * 60);  // for 1 month
            // Set Cookies
            setcookie("email", $email, $cookie_expiration_time);
            setcookie("login_hash", $hash, $cookie_expiration_time);

            file_put_contents($failedLoginFile, '');
            http_response_code(200);
            return;
        }


        file_put_contents($failedLoginFile, $now . "\n", FILE_APPEND);
        return;
    }

    // show login form
    include($gallery->getThemePath(true) . '/login.php');
    exit;
}
