<?php

namespace models;

use generics\User;


class Student  extends User {

    private string $classroom;

    public function __construct(string $name, string $firstname, string $email, string $password, string $classroom)
    {
        parent::__construct($name, $firstname, $email, $password);
        $this->classroom = $classroom;
    }

    public function getClassroom(): string
    {
        return $this->classroom;
    }

    public function setClassroom($classroom): void
    {
        $this->classroom = $classroom;
    }

}