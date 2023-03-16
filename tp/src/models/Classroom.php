<?php 

namespace models;
use Utils\Crud;

class Classroom extends Crud {

    private int $id;
    private string $name;
    
    public function __construct() {
        parent::__construct();
    }

}