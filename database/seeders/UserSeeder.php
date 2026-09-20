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
        // creamos 10 usuarios sin el email verificado para que te las vaciles
        User::factory()
            ->count(10)
            ->unverified()
            ->create();

        // poblamiento real de usuarios en la db
        User::factory()
            ->count(100)
            ->create();
    }
}
