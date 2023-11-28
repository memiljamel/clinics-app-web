<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepository
{
    /**
     * Display a listing of the resource.
     */
    public function find(?string $search): LengthAwarePaginator;

    /**
     * Display the specified resource based on the given conditions.
     */
    public function findOneWhere(array $where, $columns = ['*']): ?User;

    /**
     * Store a newly created resource in storage.
     */
    public function save(array $data): User;

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user, array $data): ?User;

    /**
     * Remove the specified resource from storage.
     */
    public function delete(User $user): bool;

    /**
     * Remove the specified resource from storage based on the given conditions.
     */
    public function deleteWhere(array $where): bool;
}
