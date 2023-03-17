<?php

namespace Entity;

class Specie
{

    /**
     * @var string $diet The diet of the species
     */
    protected $diet;
    
    /**
     * @var int $membersNumber The number of members of the species
     */
    protected $membersNumber;

    /**
     * Specie constructor.
     *
     * @param string $diet The diet of the species
     * @param int $membersNumber The number of members of the species
     */
    public function __construct($diet, $membersNumber)
    {
        $this->diet = $diet;
        $this->membersNumber = $membersNumber;
    }

    // Getters

    public function getDiet()
    {
        return $this->diet;
    }

    public function getMembersNumber()
    {
        return $this->membersNumber;
    }

    // Setters

    public function setDiet($diet)
    {
        $this->diet = $diet;
    }

    public function setMembersNumber($membersNumber)
    {
        $this->membersNumber = $membersNumber;
    }
}