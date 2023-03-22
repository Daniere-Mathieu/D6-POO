<?php

namespace utils;

class Verification
{
    /**
     * this static method check if a value exist and if she is not null
     * @param mixed $value the value i need to if the value is not set,null or is empty
     */
    public static function verifyIfNotExistAndIsEmpty(mixed $value): bool
    {
        return !isset($value)  || is_null($value) || empty($value);
    }

    /**
     * this static method check if all the keys is in a array and if they are not empty
     * @param array $keys array of key who need to check if exist on array
     * @param array $array array of value
     */
    public static function arrayKeysExistAndNotEmpty(array $keys, array $array): bool
    {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $array) || empty($array[$key])) return false;
        }
        return true;
    }

    /**
     * this static method check if all value exist and if all is not null
     * @param array $array array of value
     */
    public static function verifyIfAllExistAndNotIsEmpty(array $values): bool
    {
        foreach ($values as $value) {
            if (!isset($value)  || is_null($value) || empty($value)) return false;
        }
        return true;
    }

    public static function isLogged(): bool
    {
        return isset($_SESSION['logged']) && !empty($_SESSION['logged']) && $_SESSION['logged'] === true;
    }

    public static function isTeacher(): bool
    {
        return isset($_SESSION['role']) && !empty($_SESSION['role']) && $_SESSION['role'] === "teacher";
    
    }
    public static function isStudent(): bool
    {
        echo $_SESSION['role'];
        return isset($_SESSION['role']) && !empty($_SESSION['role']) && $_SESSION['role'] === "student";
    }

    public static function isIdEquivalent(int $id): bool
    {
        return isset($_SESSION['id']) && !empty($_SESSION['id']) && $_SESSION['id'] === $id;
    }
}