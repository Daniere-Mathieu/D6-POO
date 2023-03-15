<?php 

use router\Router;

$router = Router::getInstance();

$router->addRoute(HttpMethod::GET, '/teachers', 'TeacherController', 'getAll');