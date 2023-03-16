<?php 

class Hash
{
    public static function hashPassword(string $password): string
    {
        return password_hash($password,PASSWORD_BCRYPT);
    }

    public static function verifyPassword(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}