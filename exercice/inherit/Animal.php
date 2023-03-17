<?php

namespace MyClass;

use MyClass\Specie;

require 'Specie.php';

class Animal extends Specie
{
    protected $lifeExpectancy;
    protected $gestationTime;

    /**
     * Animal constructor.
     * @param string $diet The diet of the animal.
     * @param int $membersNumber The number of members in the animal group.
     * @param int $lifeExpectancy The average life expectancy of the animal in years.
     * @param int $gestationTime The gestation time of the animal in months.
     */
    public function __construct($diet, $membersNumber, $lifeExpectancy, $gestationTime)
    {
        parent::__construct($diet, $membersNumber);
        $this->lifeExpectancy = $lifeExpectancy;
        $this->gestationTime = $gestationTime;
    }

    // Getters

    public function getLifeExpectancy()
    {
        return $this->lifeExpectancy;
    }

    public function getGestationTime()
    {
        return $this->gestationTime;
    }

    // Setters

    public function setLifeExpectancy($lifeExpectancy)
    {
        $this->lifeExpectancy = $lifeExpectancy;
    }

    public function setGestationTime($gestationTime)
    {
        $this->gestationTime = $gestationTime;
    }
}
