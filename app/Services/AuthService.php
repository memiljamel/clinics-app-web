<?php

namespace App\Services;

interface AuthService
{
    public function login(string $email, string $password, bool $remember = false): bool;
}
