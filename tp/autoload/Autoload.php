<?php

namespace Autoload;

/**
 * 
 */
class Autoloader
{
    /**
     * this static method allow to register an autoload module
     */
    public static function register(): void
    {
        spl_autoload_register(function($className) {
            $filePath = str_replace('\\', '/', $className) . '.php';
            $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/src/' . $filePath;
        
            if (file_exists($fullPath)) {
                require_once $fullPath;
            }
        });
    }

}