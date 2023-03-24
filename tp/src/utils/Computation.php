<?php

namespace utils;

class Computation
{
    /**
     * Calculates the average of an array of numbers.
     *
     * @param array $numbers An array of numbers.
     *
     * @return float The average of the numbers in the array.
     */
    public static function averageCalculation(array $numbers): float
    {
        // Calculate the sum of the numbers in the array
        $sum = 0;
        foreach ($numbers as $number) {
            $sum += $number;
        }

        // Calculate and return the average of the numbers
        return $sum / count($numbers);
    }
}
