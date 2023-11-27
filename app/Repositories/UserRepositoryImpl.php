<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepositoryImpl implements UserRepository
{
    /**
     * Create a new repository instance.
     */
    public function __construct(protected User $user)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function find(?string $search): LengthAwarePaginator
    {
        return $this->user->newQuery()
            ->when($search, function (Builder $query, ?string $search) {
                $query->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('phone_number', 'LIKE', "%{$search}%");
            })
            ->latest()
            ->paginate()
            ->withQueryString();
    }

    /**
     * Display the specified resource based on the given conditions.
     */
    public function findOneWhere(array $where, $columns = ['*']): ?User
    {
        return $this->user->newQuery()
            ->where($where)
            ->first($columns);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function save(array $data): User
    {
        $user = User::create([
            'avatar' => $data['avatar'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'phone_number' => $data['phone_number'],
            'role' => $data['role'],
        ]);

        $user->profile()->create([
            'date_of_birth' => $data['date_of_birth'],
            'address' => $data['address'],
            'status' => $data['status'],
            'gender' => $data['gender'],
        ]);

        return $user;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, array $data): ?User
    {
        $user->update([
            'avatar' => $data['avatar'],
            'name' => $data['name'],
            'password' => $data['password'],
            'phone_number' => $data['phone_number'],
            'role' => $data['role'],
        ]);

        $user->profile()->updateOrCreate([
            'user_id' => $user->id,
        ], [
            'date_of_birth' => $data['date_of_birth'],
            'address' => $data['address'],
            'status' => $data['status'],
            'gender' => $data['gender'],
        ]);

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user): bool
    {
        return $user->delete();
    }
}
