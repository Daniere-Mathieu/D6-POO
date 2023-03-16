<?php

namespace models;

use generics\Crud;

class Classroom extends Crud
{

    private int $id;
    private string $name;

    public function __construct(int $id, string $name)
    {
        parent::__construct();
        $this->id = $id;
        $this->name = $name;
    }
}
