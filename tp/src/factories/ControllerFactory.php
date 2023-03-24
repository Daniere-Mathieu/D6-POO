<?php

namespace factories;

use interfaces\IController;

class ControllerFactory
{
    /**
     * Create a new instance of the specified controller.
     *
     * @param string $controllerName The name of the controller to create.
     *
     * @return IController The newly created controller instance.
     */
    public static function create(string $controllerName): IController
    {
        // Build the fully-qualified class name for the specified controller
        $className = 'controllers\\' . ucfirst($controllerName) . 'Controller';

        // Instantiate the specified controller and return it
        return new $className();
    }
}
