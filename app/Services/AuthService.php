<?php

namespace App\Services;

interface AuthService
{
    /**
     * Handle an authentication attempt.
     */
    public function login(string $email, string $password, string $type, bool $remember = false): bool;

    /**
     * Handle send password reset link.
     */
    public function forgot(string $email, string $type): string;

    /**
     * Handle check if user token exists.
     */
    public function tokenExists(?string $token, ?string $email, string $type): bool;

    /**
     * Handle user password reset.
     */
    public function reset(string $token, string $email, string $password, string $type): mixed;
}
