<?php
// this file is my entrypoint and is my router

// i start globally my session
session_start();

use \Autoload\Autoloader;
use \utils\{Database, View, Verification};

require_once('autoload/Autoload.php');
require_once('./config.php');


// i register my autoload
Autoloader::register();

require_once('./route.php');
require_once('./routeApi.php');


// $explodeURI = explode('/', $_SERVER["REQUEST_URI"]);

// $firstParts = $explodeURI[1];

// switch ($firstParts) {
//     case 'api':
//         break;
//     case '':
//         require_once('views/index.php');
//         break;
//     default:
//         View::render('404');
// }
