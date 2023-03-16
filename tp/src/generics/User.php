<?php

namespace generics;

use interfaces\IUser;
use generics\Crud;

class User extends Crud implements IUser
{
    protected int $id;
    protected string $name;
    protected string $firstname;
    protected string $email;
    protected string $password;

    public function __construct()
    {
        parent::__construct();
    }

    public function login(string $email,string $password): bool
    {
        
    }

    public function getId(): int
    {
        return $this->id;
    }
    
    public function getName(): string
    {
        return $this->name;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }


    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    public function setEmail($email): void
    {
        $this->email = $email;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getFullName(): string
    {
        return $this->name . " " . $this->firstname;
    }
}
