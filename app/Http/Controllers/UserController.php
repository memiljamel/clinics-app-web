<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct(protected UserService $userService)
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $page = $request->query('page');
        $search = $request->query('search');

        $users = $this->userService->findAll($search);

        if ($page > $users->lastPage() && $page > 1) {
            abort(404);
        }

        return view('users.index', [
            'users' => $users,
            'search' => $search,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->userService->create([
            'avatar' => $request->file('avatar'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'phone_number' => $request->input('phone_number'),
            'role' => $request->input('role'),
            'date_of_birth' => $request->input('date_of_birth'),
            'status' => $request->input('status'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
        ]);

        return redirect()->route('users.index')
            ->with('message', 'The User has been created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('users.show', [
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('users.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->userService->update($user, [
            'avatar' => $request->file('avatar'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'phone_number' => $request->input('phone_number'),
            'role' => $request->input('role'),
            'date_of_birth' => $request->input('date_of_birth'),
            'status' => $request->input('status'),
            'address' => $request->input('address'),
            'gender' => $request->input('gender'),
        ]);

        return redirect()->route('users.index')
            ->with('message', 'The User has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $this->userService->delete($user);

        return redirect()->route('users.index')
            ->with('message', 'The User has been deleted.');
    }
}
