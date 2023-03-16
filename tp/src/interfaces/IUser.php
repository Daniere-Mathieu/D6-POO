<?php

namespace interfaces;

interface IUSer
{
    public function login(string $email,string $password): bool;
}