<?php

namespace models;

use generics\User;


class Student  extends User
{


    private int $classroom;


    public function __construct()
    {
        parent::__construct();
    }

    public function getClassroom(): int
    {
        return $this->classroom;
    }
    public function setClassroom(int $classroom): void
    {
        $this->classroom = $classroom;
    }
}
