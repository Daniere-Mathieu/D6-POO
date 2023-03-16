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
        $db = Database::getPDO();
        $query = $db->prepare("SELECT * FROM teacher WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        return $query->fetchObject($this->className);
    }

    public function login(string $email,string $password): bool
    {
      $teacher = $this->getByEmail($email);
        if($teacher){
            if(password_verify($password,$teacher->getPassword())){
            return true;
            }
        }
        else {
            return false;
        }
    }

}
    
