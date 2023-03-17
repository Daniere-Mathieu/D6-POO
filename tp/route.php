<?php

use router\Router;
use generics\HttpMethod;

$router = Router::getInstance();

$router->addRoute(HttpMethod::GET, '/', 'Home', 'index');

$router->addRoute(HttpMethod::GET, '/teachers', 'Teacher', 'getAll');
$router->addRoute(HttpMethod::GET, '/teacher/get/:id', 'Teacher', 'get');
$router->addRoute(HttpMethod::GET, '/teacher/log', 'Teacher', 'log');
$router->addRoute(HttpMethod::GET, '/teacher/logout', 'Teacher', 'logout');

$router->addRoute(HttpMethod::POST, '/teacher/create', 'Teacher', 'create');
$router->addRoute(HttpMethod::POST, '/teacher/login', 'Teacher', 'login');


$router->addRoute(HttpMethod::PUT, '/teacher/update/:id', 'Teacher', 'update');

$router->addRoute(HttpMethod::DELETE, '/teacher/delete/:id', 'Teacher', 'delete');



$router->route();
