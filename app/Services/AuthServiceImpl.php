<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthServiceImpl implements AuthService
{
    /**
     * Handle an authentication attempt.
     */
    public function login(string $email, string $password, string $type, bool $remember = false): bool
    {
        return Auth::attempt([
            'email' => $email,
            'password' => $password,
            'type' => $type,
        ], $remember);
    }

    /**
     * Handle send password reset link.
     */
    public function forgot(string $email, string $type): string
    {
        return Password::sendResetLink([
            'email' => $email,
            'type' => $type,
        ]);
    }

    /**
     * Handle check if user token exists.
     */
    public function tokenExists(?string $token, ?string $email, string $type): bool
    {
        $user = User::ofType($type)->where('email', $email)->first();

        return ! is_null($user) && Password::tokenExists($user, $token);
    }

    /**
     * Handle user password reset.
     */
    public function reset(string $token, string $email, string $password, string $type): mixed
    {
        return Password::reset([
            'token' => $token,
            'email' => $email,
            'password' => $password,
            'type' => $type,
        ], function (User $user, string $password) {
            $user->forceFill([
                'password' => $password,
            ])->setRememberToken(Str::random(60));
            $user->save();

            event(new PasswordReset($user));
        });
    }
}
