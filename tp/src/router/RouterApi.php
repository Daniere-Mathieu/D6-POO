<?php

namespace router;

use generics\HttpMethod;

class RouterApi {
    protected array $routes = [];
    private static ?RouterApi $instance = null;

    private function __construct() {
    }

    public static function getInstance(): RouterApi {
        if (self::$instance === null) {
            self::$instance = new RouterApi();
        }
        return self::$instance;
    }

    public function addRoute(HttpMethod $method, string $url, callable $handler) {
        $this->routes[] = [
            'method' => $method,
            'url' => $url,
            'handler' => $handler
        ];
    }

    public function route() {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestUrl = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (strpos($requestUrl, '/api') !== 0) {
            return;
        }

        foreach ($this->routes as $route) {
            $routeMethod = $route['method'];
            $routeUrl = $route['url'];
            $routeHandler = $route['handler'];

            $routeUrl = substr($routeUrl, 4);

            if ($requestMethod === $routeMethod && preg_match("#^$routeUrl$#", $requestUrl, $matches)) {
                array_shift($matches);

                return call_user_func_array($routeHandler, $matches);
            }
        }

        http_response_code(404);
    }
}
