<?php

namespace factories;

use generics\User;

class UserFactory {
    /**
     * Create a new instance of a User with the specified role, name, firstname, email, password, and optionally classroom or subject.
     * @param string $role The role of the User to create.
     * @return User The newly created User instance.
     */
    public static function create(string $role): User {
        // Build the fully-qualified class name for the specified role
        $className = 'models\\' . ucfirst($role);

        // Instantiate a new User instance with the specified parameters
        if ($classroom) {
            return new $className();
        } 
    }
}
