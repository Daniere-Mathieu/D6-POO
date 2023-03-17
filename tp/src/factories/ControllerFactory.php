<?php

namespace factories;

use interfaces\IController;

class ControllerFactory
{
    public static function create(string $controllerName): IController
    {
        $className = 'controllers\\' . ucfirst($controllerName) . 'Controller';
        return new $className();
    }
}
