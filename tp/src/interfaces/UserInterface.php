<?php

namespace interfaces;

interface UserInterface
{
    public function login(string $login, string $password, array $usersList): bool;
}