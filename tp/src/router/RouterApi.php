<?php

namespace router;

use generics\HttpMethod;
use factories\ControllerFactory;

class RouterApi
{
    // An array that holds all the routes.
    protected array $routes = [];
    // The single instance of the router.
    private static ?RouterApi $instance = null;

    private function __construct()
    {
    }

    // Returns the single instance of the router.
    public static function getInstance(): RouterApi
    {
        if (self::$instance === null) {
            self::$instance = new RouterApi();
        }
        return self::$instance;
    }

    // Adds a new route to the router.
    public function addRoute(string $method, string $url, string $controllerName, string $methodName)
    {
        $this->routes[] = [
            'method' => $method,
            'url' => $url,
            'controller' => $controllerName,
            'methodName' => $methodName
        ];
    }

    // Routes the incoming request to the corresponding controller method.
    public function route()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // If the request doesn't start with "/api", do nothing.
        if (strpos($requestUrl, '/api') !== 0) {
            return;
        }

        // Set the Content-Type header to application/json.
        header('Content-Type: application/json');

        // Loop through all the routes.
        foreach ($this->routes as $route) {
            $routeMethod = $route['method'];
            $routeUrl = $route['url'];
            $controllerName = $route['controller'];
            $methodName = $route['methodName'];

            // Replace all the named parameters in the route URL with a regex pattern.
            $routeUrl = preg_replace('/:([^\/]+)/', '(?P<$1>[\w\d]+)', $routeUrl);

            // If the request method and URL match the current route, call the corresponding controller method.
            if ($requestMethod === $routeMethod && preg_match("#^$routeUrl$#", $requestUrl, $matches)) {
                // Remove the first element (which is the full URL) from the matches array.
                array_shift($matches);

                $routeParams = array();
                foreach ($matches as $key => $value) {
                    // Only add the named parameters to the route parameters array.
                    if (is_string($key)) {
                        $routeParams[$key] = $value;
                    }
                }

                // If the request method is POST, add the POST data to the route parameters array.
                if ($requestMethod === HttpMethod::POST) {
                    $routeParams[] = $_POST;
                }

                // Create an instance of the controller using the factory method.
                $controller = ControllerFactory::create($controllerName);

                // Call the corresponding controller method with the route parameters.
                if (count($routeParams) === 1) {
                    $arg = reset($routeParams);
                    return call_user_func_array([$controller, $methodName], [$arg]);
                } else {
                    return call_user_func_array([$controller, $methodName], [$routeParams]);
                }
            }
        }

        // If no matching route is found, return a 404 error with a JSON response.
        http_response_code(404);
        echo json_encode(['error' => 'Not found']);
    }
}
