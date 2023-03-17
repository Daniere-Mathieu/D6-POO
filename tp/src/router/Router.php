<?php

namespace router;

use generics\HttpMethod;
use utils\View;
use factories\ControllerFactory;

class Router
{
    protected array $routes = [];
    private static ?Router $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): Router
    {
        if (self::$instance === null) {
            self::$instance = new Router();
        }
        return self::$instance;
    }

    public function addRoute(string $method, string $url, string $controllerName, string $methodName)
    {
        $this->routes[] = [
            'method' => $method,
            'url' => $url,
            'controller' => $controllerName,
            'methodName' => $methodName
        ];
    }

    public function route()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        foreach ($this->routes as $route) {
            $routeMethod = $route['method'];
            $routeUrl = $route['url'];
            $controllerName = $route['controller'];
            $methodName = $route['methodName'];

            $routeUrl = preg_replace('/:([^\/]+)/', '(?P<$1>[\w\d]+)', $routeUrl);

            if (strpos($requestUrl, '/api') === 0) {
                return;
            }


            if ($requestMethod === $routeMethod && preg_match("#^$routeUrl$#", $requestUrl, $matches)) {
                array_shift($matches);

                $routeParams = array();
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $routeParams[$key] = $value;
                    }
                }

                if ($requestMethod === HttpMethod::POST) {
                    $routeParams[] = $_POST;
                }


                $controller = ControllerFactory::create($controllerName);
                if (count($routeParams) === 1) {
                    $arg = reset($routeParams);
                    return call_user_func_array([$controller, $methodName], [$arg]);
                } else {
                    return call_user_func_array([$controller, $methodName], [$routeParams]);
                }
            }
        }

        View::render('404');
    }
}
