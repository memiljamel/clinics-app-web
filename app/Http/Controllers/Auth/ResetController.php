<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\ResetRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ResetController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(protected AuthService $authService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View|RedirectResponse
    {
        $token = $request->input('token');
        $email = $request->input('email');

        $role = Role::ADMINISTRATOR;

        if ($this->authService->tokenExists($token, $email, $role)) {
            return view('auth.reset', [
                'token' => $token,
                'email' => $email,
            ]);
        }

        return redirect()->route('forgot.index')
            ->with('message', __('passwords.token'));
    }

    /**
     * Handle user password reset.
     */
    public function recovery(ResetRequest $request): RedirectResponse
    {
        $token = $request->input('token');
        $email = $request->input('email');
        $password = $request->input('password');

        $role = Role::ADMINISTRATOR;

        $message = $this->authService->reset($token, $email, $password, $role);

        return $message === Password::PASSWORD_RESET
            ? redirect()->route('login.index')->with('message', __($message))
            : back()->withErrors(['email' => __($message)])->onlyInput('email');
    }
}
