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
    private string $comment;
    private DateTime $deadline;
    public function __construct(int $id,int $mark,string $name,string $description,string $comment,DateTime $deadline)
    {
        parent::__construct();
        $this->id = $id;
        $this->mark = $mark;
        $this->name = $name;
        $this->description = $description;
        $this->comment = $comment;
        $this->deadline = $deadline;
    }
}
