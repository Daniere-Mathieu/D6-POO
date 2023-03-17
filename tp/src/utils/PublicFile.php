<?php

namespace utils;

use utils\View;

class PublicFile
{
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

    public static function returnStyle($filename)
    {
        // Check that the file exists and is a file
        if (!file_exists($filename) || !is_file($filename)) {
            View::render('404');
            return;
        }
        header('Content-Type: text/css');

        readfile($filename);
    }

    public static function getStyleFile($filename)
    {
        return "http://" . $_SERVER['HTTP_HOST'] . '/public/styles/' . $filename . ".css";
    }

    public static function getImageFile(int $id): string
    {
        return "http://" . $_SERVER['HTTP_HOST'] . "/public/images/teacher/" . $id . ".png";
    }
}
