<?php

namespace models;
use generics\User;
use Utils\Database;

class Teacher extends User
{

    public function __construct(string $name = "", string $firstname= "", string $email= "", string $password= "")
    {
        parent::__construct($name, $firstname, $email, $password);
    }

}
    
