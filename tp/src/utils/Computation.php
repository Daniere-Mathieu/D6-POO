<?php

namespace utils;

class Computation
{
    public static function averageCalculation(array $numbers): float
    {
        $sum = 0;
        foreach ($numbers as $number) {
            $sum += $number;
        }
        return $sum / count($numbers);
    }
}