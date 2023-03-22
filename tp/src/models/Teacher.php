<?php

namespace models;

use generics\User;

class Teacher extends User
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getFullName(): string
    {
        return $this->name . " " . $this->firstname;
    }
}
