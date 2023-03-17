<?php
// this file is my entrypoint and is my router

// i start globally my session
session_start();

use autoload\Autoloader;
use utils\{PublicFile};

require_once('autoload/Autoload.php');
require_once('./config.php');


Autoloader::register();

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (!preg_match('#^/public/(.*)$#', $url, $matches)) {
    require_once('./route.php');
    require_once('./routeApi.php');
} else {
    $filename = __DIR__ . '/src/public/' . $matches[1];
    if (preg_match('#^images/(.*)$#', $matches[1])) {

        PublicFile::returnImage($filename);
    } elseif (preg_match('#^styles/(.*)$#', $matches[1])) {
        PublicFile::returnStyle($filename);
    }
}
