<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthServiceImpl implements AuthService
{
    public function login(string $email, string $password, string $type, bool $remember = false): bool
    {
        return Auth::attempt([
            'email' => $email,
            'password' => $password,
            'type' => $type,
        ], $remember);
    }
}
