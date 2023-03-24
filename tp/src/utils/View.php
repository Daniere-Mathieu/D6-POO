<?php

namespace utils;

use utils\Verification;

/**
 * The View class contains methods related to rendering views, redirecting pages,
 * and handling flash messages.
 */
class View
{
    /**
     * Render a view and pass in any data as an array.
     *
     * @param string $viewName The name of the view to render.
     * @param array $data An array of data to pass to the view.
     * @throws \Exception If the view file cannot be found.
     */
    public static function render(string $viewName, array $data = []): void
    {
        try {
            // Extract the data array so its keys become variables in the view file.
            extract($data);

            // Get the path to the view file.
            $path = $_SERVER['DOCUMENT_ROOT'] . '/src/views/' . $viewName . '.php';

            // Check if the view file exists and require it.
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

    /**
     * Render a view without extracting any data.
     *
     * @param string $viewName The name of the view to render.
     * @param array $data An array of data to pass to the view.
     * @throws \Exception If the view file cannot be found.
     */
    public static function renderWithoutExtract(string $viewName, array $data = []): void
    {
        try {
            // Get the path to the view file.
            $path = $_SERVER['DOCUMENT_ROOT'] . '/src/views/' . $viewName . '.php';

            // Check if the view file exists and require it.
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

    /**
     * Redirect the user to a new page.
     *
     * @param string $path The path of the page to redirect to.
     */
    public static function redirect(string $path): void
    {
        header('Location: ' . $path);
        die();
    }

    /**
     * Set a flash message to be displayed on the next page.
     *
     * @param string $message The message to display.
     * @param string $type The type of message (default: 'isSuccess').
     */
    public static function setFlashMessage(string $message, string $type = 'isSuccess'): void
    {
        $_SESSION['flashMessage'] = [
            'message' => $message,
            'type' => $type
        ];
    }

    /**
     * Get the flash message and display it on the page.
     */
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
