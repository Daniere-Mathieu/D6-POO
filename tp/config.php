<?php
$path = __DIR__ . '/.env';
if(file_exists($path)) {
    $env = parse_ini_file($path);

    DEFINE('DB_HOST', $env['DB_HOST']);
    DEFINE('DB_USER', $env['DB_USER']);
    DEFINE('DB_PASSWORD', $env['DB_PASSWORD']);
    DEFINE('DB_NAME', $env['DB_NAME']);
}
else {
    throw new Exception('File .env not found');
}
