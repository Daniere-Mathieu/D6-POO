<?php

namespace models;

use generics\User;

// Student class inherits from the User class
class Student extends User
{
    // Class properties
    private int $classroom;

    // Constructor
    public function __construct()
    {
        // Call parent constructor
        parent::__construct();
    }

    // Getter method for classroom property
    public function getClassroom(): int
    {
        return $this->classroom;
    }

    // Setter method for classroom property
    public function setClassroom(int $classroom): void
    {
        $this->classroom = $classroom;
    }
}
