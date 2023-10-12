<?php

namespace App\Services;

interface AuthService
{
    public function login(string $email, string $password, string $type, bool $remember = false): bool;
}
