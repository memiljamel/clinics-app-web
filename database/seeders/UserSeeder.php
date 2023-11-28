<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(2)
            ->create();
        User::factory()->count(2)
            ->unverified()
            ->create();
        User::factory()->count(1)
            ->administrator()
            ->create();
    }
}
