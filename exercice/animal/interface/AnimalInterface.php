<?php

namespace MyInterface;

interface AnimalInterface
{
    /**
     * This is the passAway method, which takes a single parameter named $diet.
     *
     * @param mixed $diet The diet parameter represents the cause of death or the type of food the animal consumed.
     * 
     * @return void The method does not return any value.
     */
    public function passAway();
}
