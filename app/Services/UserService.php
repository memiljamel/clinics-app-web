<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserService
{
    /**
     * Display a listing of the resource.
     */
    public function findAll(?string $search): LengthAwarePaginator;

    /**
     * Store a newly created resource in storage.
     */
    public function create(array $data): User;

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, array $data): ?User;

    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user): bool;
}
