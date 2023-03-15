<?php

namespace utils;


class View
{
    /**
     * this static method render a view
     * @param string $viewName the name of the view
     * @param array $data the data who need to be send to the view
     */
    public static function render(string $viewName, array $data = []): void
    {
        try {
            extract($data);
            $path = $_SERVER['DOCUMENT_ROOT'] . '/src/views/' . $viewName . '.php';
            if(file_exists($path)){
                require_once($path);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    public static function redirect(string $path): void
    {
        header('Location: ' . $path);
    }
}