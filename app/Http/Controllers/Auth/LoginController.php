<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
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
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(LoginRequest $request): RedirectResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->boolean('remember');

        if ($this->authService->login($email, $password, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
