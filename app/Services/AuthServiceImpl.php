<?php

namespace App\Services;

use App\Enums\Role;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthServiceImpl implements AuthService
{
    /**
     * Create a new service instance.
     */
    public function __construct(protected UserRepository $userRepository)
    {
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(string $email, string $password, ?Role $role, bool $remember = false): bool
    {
        return Auth::attempt([
            'email' => $email,
            'password' => $password,
            'role' => $role,
        ], $remember);
    }

    /**
     * Handle send password reset link.
     */
    public function forgot(string $email, ?Role $role): string
    {
        return Password::sendResetLink([
            'email' => $email,
            'role' => $role,
        ]);
    }

    /**
     * Handle check if user token exists.
     */
    public function tokenExists(?string $token, ?string $email, ?Role $role): bool
    {
        $user = $this->userRepository->findOneWhere([
            ['email', '=', $email],
            ['role', '=', $role],
        ]);

        return ! is_null($user) && Password::tokenExists($user, $token);
    }

    /**
     * Handle user password reset.
     */
    public function reset(string $token, string $email, string $password, ?Role $role): mixed
    {
        return Password::reset([
            'token' => $token,
            'email' => $email,
            'password' => $password,
            'role' => $role,
        ], function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password),
            ])->setRememberToken(Str::random(60));
            $user->save();

            event(new PasswordReset($user));
        });
    }

    /**
     * Handle user logout.
     */
    public function logout(): void
    {
        Auth::logout();
    }
}
