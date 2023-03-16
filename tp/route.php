<?php

use router\Router;
use generics\HttpMethod;

$router = Router::getInstance();

$router->addRoute(HttpMethod::GET, '/teachers', 'Teacher', 'getAll');


$router->route();
