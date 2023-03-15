<?php 
namespace factories;

use interfaces\Controller;
class ControllerFactory {
    public static function create(string $controllerName): Controller {
        $className = 'controllers\\' . ucfirst($controllerName) . 'Controller';
        return new $className();
    }
}