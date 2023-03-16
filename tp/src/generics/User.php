<?php 

namespace generics;

use interfaces\IUser;
use Utils\Crud;

class User extends Crud implements IUser {
    private int $id;
    private string $name;
    private string $firstname;
    private string $email;
    private string $password;

    public function __construct(string $name, string $firstname, string $email, string $password)
    {
        parent::__construct();
        $this->name = $name;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->password = $password;
    }

    public function login(string $login, string $password, array $usersList): bool
    {
        foreach ($usersList as $user) {
            if ($user->getEmail() === $login && $user->getPassword() === $password) {
                return true;
            }
        }
        return false;
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
}