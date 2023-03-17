<?php

namespace models;

use generics\Crud;

class CourseModule extends Crud
{

    private int $id;
    private string $name;
    private int $classroom;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getClassroom(): int
    {
        return $this->classroom;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function setClassroom(int $classroom): void
    {
        $this->classroom = $classroom;
    }
}
