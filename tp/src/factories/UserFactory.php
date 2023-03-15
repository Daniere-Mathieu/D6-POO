<?php 
namespace factories;

use generics\User;

class UserFactory {
    public static function create(string $role, string $name, string $firstname, string $email, string $password, string $classroom = null, string $subject = null):User {
        $className = 'models\\' . ucfirst($role);
        if ($classroom) {
            return new $className($name, $firstname, $email, $password, $classroom);
        } else if ($subject) {
            return new $className($name, $firstname, $email, $password, $subject);
        } else {
            return new $className($name, $firstname, $email, $password);
        }
    }
}