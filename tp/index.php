<?php

// Start the session to enable session variables
session_start();

// Import the Autoloader and PublicFile classes using namespaces
use autoload\Autoloader;
use utils\{PublicFile};

// Require the Autoload.php file and the config.php file
require_once('autoload/Autoload.php');
require_once('./config.php');

// Register the Autoloader
Autoloader::register();

// Get the requested URL path
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// If the requested URL is not for a public file (i.e. it's a route), handle it
if (!preg_match('#^/public/(.*)$#', $url, $matches)) {

    // Require the route.php and routeApi.php files to handle the request
    require_once('./route.php');
    require_once('./routeApi.php');

// If the requested URL is for a public file, handle it
} else {

    // Get the full file path for the requested file
    $filename = __DIR__ . '/src/public/' . $matches[1];

    // If the requested file is an image, return it using the PublicFile class
    if (preg_match('#^images/(.*)$#', $matches[1])) {
        PublicFile::returnImage($filename);

    // If the requested file is a style sheet, return it using the PublicFile class
    } elseif (preg_match('#^styles/(.*)$#', $matches[1])) {
        PublicFile::returnStyle($filename);
    }
}

