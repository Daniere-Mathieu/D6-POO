<?php

namespace models;

use generics\Crud;
use \DateTime;

class Task extends Crud
{
    private int $id;
    private int $mark;
    private string $name;
    private string $description;
    private DateTime $deadline;

    public function __construct()
    {
        parent::__construct();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getMark(): int
    {
        return $this->mark;
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
    public function getDeadline(): DateTime
    {
        return $this->deadline;
    }


    public function setMark(int $mark): void
    {
        $this->mark = $mark;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
    public function setDeadline(DateTime $deadline): void
    {
        $this->deadline = $deadline;
    }
}
