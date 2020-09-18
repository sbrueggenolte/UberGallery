<?php

    // Include the UberGallery class
    include('resources/UberGallery.php');

    // Initialize the UberGallery object
    $gallery = new UberGallery();

    // Define theme path
    if (!defined('THEMEPATH')) {
        define('THEMEPATH', $gallery->getThemePath());
    }

    // Login check
    include('loginCheck.php');

    // Initialize the gallery array
    $imageDirectory = '../gallery-images';

    $galleries = array_map(static function($dir) use ($imageDirectory) {
        return str_replace($imageDirectory . '/', '', $dir);
    }, array_filter(glob($imageDirectory . '/*'), 'is_dir'));

    if (isset($_GET['gallery']) && is_string($_GET['gallery']) && '' !== $_GET['gallery']) {
        $imageDirectory .= '/' . str_replace('.', '', str_replace('/', '', $_GET['gallery']));
    }

    $galleryArray = $gallery->readImageDirectory($imageDirectory);

    $zip = glob($imageDirectory . '/*.zip');

    // Set path to theme index
    $themeIndex = $gallery->getThemePath(true) . '/index.php';

    // Initialize the theme
    if (file_exists($themeIndex)) {
        include($themeIndex);
    } else {
        die('ERROR: Failed to initialize theme');
    }
