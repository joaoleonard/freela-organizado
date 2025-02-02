<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Role::factory()->createMany([
            ['type' => 'master'],
            ['type' => 'admin'],
            ['type' => 'musician'],
        ]);

        User::factory()->create(
            [
                'name' => 'User Master',
                'login' => 'master',
                'password' => config('app.master_password'),
                'pix' => '',
                'phone' => '',
                'role_id' => 1,
            ]
        );
    }
}
