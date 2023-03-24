<?php

namespace utils;

use \PDO;

// this class return a singleton of PDO
class Database
{
    protected static ?PDO $pdo = null;

    /**
     * Constructor for Database class. Creates a PDO object and stores it in the static $pdo variable.
     */
    private function __construct()
    {
        self::$pdo = new  PDO("mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";", DB_USER, DB_PASSWORD);
    }

    /**
     * Returns a PDO object for database access.
     *
     * @return PDO|null The PDO object or null if not set.
     */
    public static function getPDO()
    {
        // If the $pdo variable is null, create a new Database object to create the PDO connection
        if(self::$pdo == null){
            new Database();
        }

        // Return the PDO object
        return self::$pdo;
    }
}
