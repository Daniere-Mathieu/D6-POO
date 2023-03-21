<?php

namespace utils;

use utils\Verification;

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
            else {
                throw new \Exception("File not found: $path");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    public static function renderWithoutExtract(string $viewName, array $data = []): void
    {
        try {
            $path = $_SERVER['DOCUMENT_ROOT'] . '/src/views/' . $viewName . '.php';
            if(file_exists($path)){
                require_once($path);
            }
            else {
                throw new \Exception("File not found: $path");
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        
    }

    public static function redirect(string $path): void
    {
        header('Location: ' . $path);
    }

    public static function setFlashMessage(string $message, string $type = 'isSuccess'): void
    {
        $_SESSION['flashMessage'] = [
            'message' => $message,
            'type' => $type
        ];
    }

    public static function getFlashMessage(): void
    {
        if(array_key_exists('flashMessage',$_SESSION) && !Verification::verifyIfNotExistAndIsEmpty($_SESSION['flashMessage'])){
            $flashMessage = $_SESSION['flashMessage'];
            unset($_SESSION['flashMessage']);
            echo "<div class='flashCard shadow {$flashMessage['type']}'>{$flashMessage['message']}</div>";
        }
        return;
    }
}