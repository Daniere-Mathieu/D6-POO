<?php

namespace generics;

use interfaces\IUser;
use generics\Crud;

/**
 * The User class represents a generic user with common properties and methods.
 * This class extends the Crud class to provide basic CRUD functionality for user data.
 * This class also implements the IUser interface to ensure the class has a getFullName() method.
 */
class User extends Crud implements IUser
{
    protected int $id;
    protected string $name;
    protected string $firstname;
    protected string $email;
    protected string $password;

    /**
     * Constructs a new User object with default values.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Gets the user's ID.
     * @return int The user's ID.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Gets the user's name.
     * @return string The user's name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets the user's first name.
     * @return string The user's first name.
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * Gets the user's email address.
     * @return string The user's email address.
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Gets the user's password.
     * @return string The user's password.
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Sets the user's name.
     * @param string $name The user's name.
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Sets the user's first name.
     * @param string $firstname The user's first name.
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * Sets the user's email address.
     * @param string $email The user's email address.
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Sets the user's password.
     * @param string $password The user's password.
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Gets the user's full name.
     * @return string The user's full name.
     */
    public function getFullName(): string
    {
        return $this->name . " " . $this->firstname;
    }

    /**
     * Returns a JSON representation of the user object.
     * @return string A JSON string.
     */
    public function getJSONEncode(): string
    {
        return json_encode(get_object_vars($this));
    }

    /**
     * Removes the user's password from the object.
     */
    public function destroyPassword(): void
    {
        unset($this->password);
    }

    /**
     * Removes the class name from the object.
     */
    public function destroyClassName(): void
    {
        unset($this->className);
    }

    /**
     * Removes the user's password and class name from the object.
     */
    public function destroyPrivateProperties(): void
    {
        $this->destroyPassword();
        $this->destroyClassName();
    }

    /**
     * Returns the user's full name.
     * @return string The user's full name.
     */
     public function __toString()
    {
        return $this->getFullName();
    }
}