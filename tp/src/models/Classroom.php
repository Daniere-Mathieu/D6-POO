<?php


namespace models;

use generics\Crud;

class Classroom extends Crud
{

    private int $id;
    private string $name;

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


    public function setName(string $name): void
    {
        $this->name = $name;
    }
}
