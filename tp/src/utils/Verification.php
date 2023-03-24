<?php

namespace utils;

class Verification
{
    /**
     * This static method checks if a value exists and is not null or empty.
     * @param mixed $value The value to check.
     * @return bool True if the value does not exist or is null/empty, false otherwise.
     */
    public static function verifyIfNotExistAndIsEmpty(mixed $value): bool
    {
        return !isset($value) || is_null($value) || empty($value);
    }

    /**
     * This static method checks if all keys exist in an array and if they are not empty.
     * @param array $keys The keys to check in the array.
     * @param array $array The array to check the keys in.
     * @return bool True if all keys exist in the array and are not empty, false otherwise.
     */
    public static function arrayKeysExistAndNotEmpty(array $keys, array $array): bool
    {
        foreach ($keys as $key) {
            if (!array_key_exists($key, $array) || empty($array[$key])) {
                return false;
            }
        }
        return true;
    }

    /**
     * This static method checks if all values exist and are not null or empty.
     * @param array $values The values to check.
     * @return bool True if all values exist and are not null or empty, false otherwise.
     */
    public static function verifyIfAllExistAndNotIsEmpty(array $values): bool
    {
        foreach ($values as $value) {
            if (!isset($value) || is_null($value) || empty($value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * This static method checks if a user is logged in.
     * @return bool True if the user is logged in, false otherwise.
     */
    public static function isLogged(): bool
    {
        return isset($_SESSION['logged']) && !empty($_SESSION['logged']) && $_SESSION['logged'] === true;
    }

    /**
     * This static method checks if a user is a teacher.
     * @return bool True if the user is a teacher, false otherwise.
     */
    public static function isTeacher(): bool
    {
        return isset($_SESSION['role']) && !empty($_SESSION['role']) && $_SESSION['role'] === "teacher";
    }

    /**
     * This static method checks if a user is a student.
     * @return bool True if the user is a student, false otherwise.
     */
    public static function isStudent(): bool
    {
        return isset($_SESSION['role']) && !empty($_SESSION['role']) && $_SESSION['role'] === "student";
    }

    /**
     * This static method checks if a given ID is equivalent to the ID of the currently logged in user.
     * @param int $id The ID to check.
     * @return bool True if the ID is equivalent to the ID of the logged in user, false otherwise.
     */
    public static function isIdEquivalent(int $id): bool
    {
        return isset($_SESSION['id']) && !empty($_SESSION['id']) && $_SESSION['id'] === $id;
    }
}
