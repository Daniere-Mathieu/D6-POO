<?php


namespace models;

use generics\Crud;

class TaskStudent extends Crud
{

    private int $id;
    private int $task;
    private int $student;
    private int $mark;
    private bool $isFinish;
    private string $comment;


    public function __construct()
    {
        parent::__construct();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTask(): int
    {
        return $this->task;
    }
    public function getStudent(): int
    {
        return $this->student;
    }
    public function getMark(): int
    {
        return $this->mark;
    }
    public function getIsFinish(): bool
    {
        return $this->isFinish;
    }
    public function getComment(): string
    {
        return $this->comment;
    }
    public function setMark(int $mark): void
    {
        $this->mark = $mark;
    }
    public function setIsFinish(bool $isFinish): void
    {
        $this->isFinish = $isFinish;
    }
    public function setComment(string $comment): void
    {
        $this->comment = $comment;
    }
}
