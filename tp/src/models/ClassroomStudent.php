<?php


namespace models;

use generics\Crud;

class ClassroomStudent extends Crud
{

    private int $id;
    private int $classroom;
    private int $student;
    private bool $isValidate;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getClassroom(): int
    {
        return $this->classroom;
    }
    public function getStudent(): int
    {
        return $this->student;
    }
    public function getIsValidate(): bool
    {
        return $this->isValidate;
    }
    public function setIsValidate(bool $isValidate): void
    {
        $this->isValidate = $isValidate;
    }



}
