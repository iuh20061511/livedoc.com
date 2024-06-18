<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');


if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $web_root = 'https://' . $_SERVER['HTTP_HOST'];
} else {
    $web_root = 'http://' . $_SERVER['HTTP_HOST'];
}

$folder = str_replace((strtolower($_SERVER['DOCUMENT_ROOT'])), '', strtolower(str_replace('\\', '/', __DIR__)));

$web_root = $web_root . $folder;

define('_WEB_ROOT', $web_root);


require_once "./app/Bridge.php";








$myApp = new App();

?>