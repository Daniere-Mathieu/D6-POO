<?php

namespace utils;

use utils\View;

class PublicFile
{
    /**
     * Check if a file exists, is a file and return its content as an image
     * @param string $filename The path to the file to return
     * @return void
     */
    public static function returnImage($filename)
    {
        if (!file_exists($filename) || !is_file($filename)) {
            View::render('404');
            return;
        }

        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $mime_types = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
        ];
        $mime_type = isset($mime_types[$extension]) ? $mime_types[$extension] : 'application/octet-stream';

        header('Content-Type: ' . $mime_type);
        readfile($filename);
    }

    /**
     * Check if a file exists, is a file and return its content as a CSS style file
     * @param string $filename The path to the file to return
     * @return void
     */
    public static function returnStyle($filename)
    {
        if (!file_exists($filename) || !is_file($filename)) {
            View::render('404');
            return;
        }
        header('Content-Type: text/css');

        readfile($filename);
    }

    /**
     * Get the path to a style file
     * @param string $filename The name of the style file
     * @return string The path to the style file
     */
    public static function getStyleFile($filename)
    {
        return "http://" . $_SERVER['HTTP_HOST'] . '/public/styles/' . $filename . ".css";
    }

    /**
     * Get the path to an image file
     * @param int $id The ID of the image
     * @return string The path to the image file
     */
    public static function getImageFile(int $id): string
    {
        return "http://" . $_SERVER['HTTP_HOST'] . "/public/images/teacher/" . $id . ".png";
    }
}
