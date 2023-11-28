<?php

namespace App\Services;

use App\Enums\Role;

interface AuthService
{
    /**
     * Handle an authentication attempt.
     */
    public function login(string $email, string $password, ?Role $role, bool $remember = false): bool;

    /**
     * Handle send password reset link.
     */
    public function forgot(string $email, ?Role $role): string;

    /**
     * Handle check if user token exists.
     */
    public function tokenExists(?string $token, ?string $email, ?Role $role): bool;

    /**
     * Handle user password reset.
     */
    public function reset(string $token, string $email, string $password, ?Role $role): mixed;

    /**
     * Handle user logout.
     */
    public function logout(): void;
}
