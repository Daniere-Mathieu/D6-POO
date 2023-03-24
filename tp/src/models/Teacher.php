<?php

namespace models;

use generics\User;

/**
 * Represents a teacher user.
 */
class Teacher extends User
{

    /**
     * Constructs a new Teacher object.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Returns the full name of the teacher.
     *
     * @return string The full name of the teacher.
     */
    public function getFullName(): string
    {
        return $this->name . " " . $this->firstname;
    }
}
