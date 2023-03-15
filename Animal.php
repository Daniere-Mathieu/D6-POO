<?php 
require_once("./Diet.php");
require_once("./Species.php");


class Animal 
{
    private Species $species;
    private int $numberOfMembers;
    private Diet $diet;
    private int $lifeExpectancy;
    private int $gestationPeriod;

    private function __construct(int $numberOfMembers,int $gestationPeriod,int $lifeExpectancy){
        $this->species = new Species();
        $this->diet = new Diet();

        $this->numberOfMembers = $numberOfMembers;
        $this->lifeExpectancy = $lifeExpectancy;
        $this->gestationPeriod = $gestationPeriod;
    }
};

?>