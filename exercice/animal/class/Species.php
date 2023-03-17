<?php

namespace MyClass;

class Species
{
    private string $name;

    /**
     * overide of the constructor.
     * @param string $name The name of the species
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Method to get the name of the species
     * @return string The name of the species
     */
    public function getSpeciesName(): string
    {
        return $this->name;
    }
}
