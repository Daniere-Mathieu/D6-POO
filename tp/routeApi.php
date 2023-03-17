<?php

use router\RouterApi;
use generics\HttpMethod;


$router = RouterApi::getInstance();

$router->addRoute(HttpMethod::GET, '/api/teachers', 'Teacher', 'getAllTeachersJson');

$router->route();
