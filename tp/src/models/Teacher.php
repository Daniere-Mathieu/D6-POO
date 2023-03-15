<?php

namespace models;
use generics\User;

class Teacher extends User
{
    private string $subject;

    public function __construct(string $name, string $firstname, string $email, string $password, string $subject)
    {
        parent::__construct($name, $firstname, $email, $password);
        $this->subject = $subject;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }
}
    
