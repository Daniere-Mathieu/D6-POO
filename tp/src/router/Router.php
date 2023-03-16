<?php

namespace router;

use generics\HttpMethod;
use Utils\View;
use Factories\ControllerFactory;

class Router {
    protected array $routes = [];
    private static ?Router $instance = null;

    private function __construct() {
    }

    public static function getInstance(): Router {
        if (self::$instance === null) {
            self::$instance = new Router();
        }
        return self::$instance;
    }

    public function addRoute(string $method, string $url, string $controllerName, string $methodName) {
        $this->routes[] = [
            'method' => $method,
            'url' => $url,
            'controller' => $controllerName,
            'methodName' => $methodName
        ];
    }

    public function route() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            $routeMethod = $route['method'];
            $routeUrl = $route['url'];
            $controllerName = $route['controller'];
            $methodName = $route['methodName'];

            
            if ($requestMethod === $routeMethod && preg_match("#^$routeUrl$#", $requestUrl, $matches)) {
                array_shift($matches);
                
                $controller = ControllerFactory::create($controllerName);
                return call_user_func_array([$controller, $methodName], $matches);
            }
        }

        View::render('404');
    }

}
