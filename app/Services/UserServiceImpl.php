<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserServiceImpl implements UserService
{
    /**
     * Create a new service instance.
     */
    public function __construct(protected UserRepository $userRepository)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function findAll(?string $search): LengthAwarePaginator
    {
        return $this->userRepository->find($search);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create(array $data): User
    {
        if (isset($data['avatar'])) {
            $data['avatar'] = Storage::disk('public')->put('avatar', $data['avatar']);
        }

        $data['password'] = Hash::make($data['password']);

        return $this->userRepository->save($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, array $data): ?User
    {
        if (isset($data['avatar'])) {
            Storage::disk('public')->delete($user->avatar);

            $data['avatar'] = Storage::disk('public')->put('avatar', $data['avatar']);
        }

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            $data['password'] = $user->password;
        }

        return $this->userRepository->update($user, $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user): bool
    {
        Storage::disk('public')->delete($user->avatar);

        return $this->userRepository->delete($user);
    }
}
