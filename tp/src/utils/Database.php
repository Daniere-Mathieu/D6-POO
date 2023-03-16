<?php

namespace utils;

use \PDO;

class Database
{
    protected static ?PDO $pdo = null;


    private function __construct()
    {
        self::$pdo = new  PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";", DB_USER, DB_PASSWORD);
    }

    /**
     * this method return the pdo object
     */
    public static function getPDO()
    {
        if(self::$pdo == null){
            new Database();
        }
        return self::$pdo;
    }
}
