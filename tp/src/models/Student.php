<?php

namespace models;

use generics\User;


class Student  extends User {


    public function __construct(string $name = "", string $firstname = "", string $email= "", string $password= "")
    {
        parent::__construct($name, $firstname, $email, $password);
    }

    public function getByEmail($email):mixed{
        $db = Database::getInstance();
        $query = $db->prepare("SELECT * FROM teacher WHERE email = :email");
        $query->bindParam(':email', $email);
        $query->execute();
        return $query->fetchObject($this->className);
    }

}