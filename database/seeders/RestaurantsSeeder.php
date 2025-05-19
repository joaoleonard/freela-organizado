<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Restaurant::create([
            'name' => 'Boussolé Rooftop',
            'address' => 'Av. Maringá, 2247',
            'city' => 'Londrina',
            'admin_id' => 1,
        ]);
    }
}
