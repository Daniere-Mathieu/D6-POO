<?php

namespace models;
use generics\User;
use Utils\Database;

class Teacher extends User
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getByEmail($email):mixed{
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM teacher WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        return $query->fetchObject($this->className);
    }

    public function getImage():string{
        return $_SERVER['HTTP_HOST'] . "/public/images/teacher/" . $this->id . ".jpg";
    }

    public function getId(): int
    {
        return $this->id;
    }
}
    
