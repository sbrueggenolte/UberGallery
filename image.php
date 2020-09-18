<?php

// Login check
include('loginCheck.php');

$imgPath = __DIR__ . '/' . $_GET['image'];
$filename = basename($imgPath);
$file_extension = strtolower(substr(strrchr($filename,"."),1));

switch( $file_extension ) {
    case "gif": $ctype="image/gif"; break;
    case "png": $ctype="image/png"; break;
    case "jpeg":
    case "jpg": $ctype="image/jpeg"; break;
    case "svg": $ctype="image/svg+xml"; break;
    default:
}

header('Content-type: ' . $ctype);
echo file_get_contents($imgPath);