<?php

namespace models;

use generics\User;


class Student  extends User {


    public function __construct(string $name = "", string $firstname = "", string $email= "", string $password= "")
    {
        parent::__construct($name, $firstname, $email, $password);
    }


}