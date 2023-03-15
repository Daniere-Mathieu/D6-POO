<?php

namespace interfaces;

interface IUSer
{
    public function login(string $login, string $password, array $usersList): bool;
}