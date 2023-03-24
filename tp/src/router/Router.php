<?php

namespace router;

use generics\HttpMethod; // Import HttpMethod class
use utils\View; // Import View class
use factories\ControllerFactory; // Import ControllerFactory class

class Router
{
    protected array $routes = []; // Array of registered routes
    private static ?Router $instance = null; // Singleton instance of Router class

    private function __construct()
    {
        // Private constructor to prevent direct instantiation
    }

    public static function getInstance(): Router
    {
        if (self::$instance === null) {
            self::$instance = new Router(); // Create a new instance if none exists
        }
        return self::$instance;
    }

    public function addRoute(string $method, string $url, string $controllerName, string $methodName)
    {
        $this->routes[] = [
            'method' => $method, // HTTP method (e.g. GET, POST)
            'url' => $url, // URL pattern (e.g. "/users/:id")
            'controller' => $controllerName, // Name of controller class
            'methodName' => $methodName // Name of controller method
        ];
    }

    public function route()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD']; // Get the current HTTP request method (e.g. GET, POST)
        $requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Get the current request URL

        foreach ($this->routes as $route) { // Loop through each registered route
            $routeMethod = $route['method']; // Get the HTTP method for the current route
            $routeUrl = $route['url']; // Get the URL pattern for the current route
            $controllerName = $route['controller']; // Get the name of the controller class for the current route
            $methodName = $route['methodName']; // Get the name of the controller method for the current route

            $routeUrl = preg_replace('/:([^\/]+)/', '(?P<$1>[\w\d]+)', $routeUrl); // Replace any URL parameters with regular expression placeholders

            if (strpos($requestUrl, '/api') === 0) {
                return; // If the request starts with "/api", return without routing
            }

            if ($requestMethod === $routeMethod && preg_match("#^$routeUrl$#", $requestUrl, $matches)) {
                // If the request method matches the route method and the request URL matches the route URL pattern
                array_shift($matches); // Remove the first match (the entire URL)

                $routeParams = array();
                foreach ($matches as $key => $value) {
                    if (is_string($key)) {
                        $routeParams[$key] = $value; // Add each URL parameter and its value to the $routeParams array
                    }
                }

                if ($requestMethod === HttpMethod::POST) {
                    $routeParams[] = $_POST; // If the request method is POST, add the $_POST data to the $routeParams array
                }

                $controller = ControllerFactory::create($controllerName); // Create a new instance of the controller class
                if (count($routeParams) === 1) { // If there is only one parameter, pass it as an argument to the controller method
                    $arg = reset($routeParams);
                    return call_user_func_array([$controller, $methodName], [$arg]);
                } else { // If there are multiple parameters, pass them as an array to the controller method
                    return call_user_func_array([$controller, $methodName], [$routeParams]);
                }
            }
        }

        View::render('404'); // If no routes match the request, render the 404 view
    }
}
