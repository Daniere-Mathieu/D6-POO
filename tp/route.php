<?php

use router\Router;
use generics\HttpMethod;

$router = Router::getInstance();

$router->addRoute(HttpMethod::GET, '/', 'Home', 'index');

$router->addRoute(HttpMethod::GET, '/teachers', 'Teacher', 'getAll');
$router->addRoute(HttpMethod::GET, '/teacher/get/:id', 'Teacher', 'get');
$router->addRoute(HttpMethod::GET, '/teacher/log', 'Teacher', 'log');
$router->addRoute(HttpMethod::GET, '/teacher/logout', 'Teacher', 'logout');
$router->addRoute(HttpMethod::GET, '/teacher/delete/:id', 'Teacher', 'deleteView');
$router->addRoute(HttpMethod::GET, '/teacher/update/:id', 'Teacher', 'updateView');


$router->addRoute(HttpMethod::POST, '/teacher/create', 'Teacher', 'create');
$router->addRoute(HttpMethod::POST, '/teacher/login', 'Teacher', 'login');
$router->addRoute(HttpMethod::POST, '/teacher/delete', 'Teacher', 'delete');
$router->addRoute(HttpMethod::POST, '/teacher/update', 'Teacher', 'update');


$router->addRoute(HttpMethod::GET, '/students', 'Student', 'getAll');
$router->addRoute(HttpMethod::GET, '/student/get/:id', 'Student', 'get');
$router->addRoute(HttpMethod::GET, '/student/log', 'Student', 'log');
$router->addRoute(HttpMethod::GET, '/student/logout', 'Student', 'logout');
$router->addRoute(HttpMethod::GET, '/student/delete/:id', 'Student', 'deleteView');
$router->addRoute(HttpMethod::GET, '/student/update/:id', 'Student', 'updateView');

$router->addRoute(HttpMethod::POST, '/student/create', 'Student', 'create');
$router->addRoute(HttpMethod::POST, '/student/login', 'Student', 'login');
$router->addRoute(HttpMethod::POST, '/student/delete', 'Student', 'delete');
$router->addRoute(HttpMethod::POST, '/student/update', 'Student', 'update');



$router->route();
