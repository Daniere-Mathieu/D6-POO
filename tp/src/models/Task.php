<?php

namespace models;

use Utils\Crud;
use \DateTime;

class Task extends Crud {
    private int $id;
    private int $mark;
    private DateTime $date;
}