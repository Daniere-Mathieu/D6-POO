<?php 

namespace utils;

class Hash
{
    /**
     * Hashes a password using the BCRYPT algorithm.
     *
     * @param string $password The password to hash.
     *
     * @return string The hashed password.
     */
    public static function hashPassword(string $password): string
    {
        return password_hash($password,PASSWORD_BCRYPT);
    }

    /**
     * Verifies if a password matches a given hash.
     *
     * @param string $password The password to verify.
     * @param string $hash The hash to verify the password against.
     *
     * @return bool True if the password matches the hash, false otherwise.
     */
    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}
