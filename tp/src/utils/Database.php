<?php

namespace utils;

use \PDO;

class Database
{
    protected static ?PDO $pdo = null;
    protected $dbUser = "Rihyette";
    protected $dbDatabase = "classroom";
    protected $dbPassword = "password";
    protected $dbHost = "database";


    private function __construct()
    {
        $this->pdo = new PDO("mysql:dbname=" . $this->dbDatabase . ";host=" . $this->dbHost . ";", $this->dbUser, $this->dbPassword);
    }

    /**
     * this method return the pdo object
     */
    public static function getPDO()
    {
        if(self::$pdo == null){
            $pdo = new Database();
        }
        return self::$pdo;
    }
}
