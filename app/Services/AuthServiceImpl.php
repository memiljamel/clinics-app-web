<?php

namespace App\Services;

use App\Enums\Role;
use Illuminate\Support\Facades\Auth;

class AuthServiceImpl implements AuthService
{
    public function login(string $email, string $password, bool $remember = false): bool
    {
        return Auth::attempt([
            'email' => $email,
            'password' => $password,
            'role' => Role::Administrator->value,
        ], $remember);
    }
}
