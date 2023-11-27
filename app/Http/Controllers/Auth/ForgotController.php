<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class ForgotController extends Controller
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
    public function index(): View
    {
        return view('auth.forgot');
    }

    /**
     * Handle send password reset link.
     */
    public function send(ForgotRequest $request): RedirectResponse
    {
        $email = $request->input('email');

        $role = Role::ADMINISTRATOR;

        $message = $this->authService->forgot($email, $role);

        return $message === Password::RESET_LINK_SENT
            ? back()->with(['message' => __($message)])
            : back()->withErrors(['email' => __($message)])->onlyInput('email');
    }
}
