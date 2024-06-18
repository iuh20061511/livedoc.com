<?php

$currentURL = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

$web_root = _WEB_ROOT;



if ($currentURL == $web_root . '/') {
    $check = true;
} else if (rtrim(dirname($currentURL), "/") == $web_root . '/account') {
    $check = true;
} elseif (rtrim(dirname($currentURL), "/") == $web_root . '/account/newPassword') {
    $check = true;

} else {

    if (!isset($_SESSION['is_login'])) {
        header("Location: $web_root");
    }

}


require "./app/Core/Authorization.php";

foreach ($access_rights as $url => $required_roles) {
    if ($currentURL === $url) { // exact match
        $user_role = $_SESSION['is_login']['id_role'];
        if (in_array($user_role, (array) $required_roles)) {
            return true;
        } else {
            header("Location: $web_root/home/error");
            exit;
        }
    }
}