<?php

// Define the path to the .env file
$path = __DIR__ . '/.env';

// If the .env file exists, parse its contents and define the database constants
if (file_exists($path)) {
    $env = parse_ini_file($path);

    // Define the database host constant
    DEFINE('DB_HOST', $env['DB_HOST']);

    // Define the database user constant
    DEFINE('DB_USER', $env['DB_USER']);

    // Define the database password constant
    DEFINE('DB_PASSWORD', $env['DB_PASSWORD']);

    // Define the database name constant
    DEFINE('DB_NAME', $env['DB_NAME']);

// If the .env file does not exist, throw an exception
} else {
    throw new Exception('File .env not found');
}
