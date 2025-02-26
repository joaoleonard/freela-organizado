<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create(
            [
                'name' => 'Musico',
                'login' => 'musico',
                'password' => '123',
                'pix' => 'musico@email.com',
                'phone' => '43999500000',
                'role_id' => 3,
            ]
        );

        User::factory()->count(10)->create();
    }
}
