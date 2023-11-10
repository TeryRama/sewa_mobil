<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Car::create([
            'brand' => 'Toyota',
            'model' => 'Avanza',
            'license_plate' => 'B 1234 ABC',
            'rental_rate' => 100000,
        ]);

        Car::create([
            'brand' => 'Honda',
            'model' => 'Jazz',
            'license_plate' => 'B 5678 DEF',
            'rental_rate' => 120000,
        ]);


        // Tambahkan data dummy lainnya di sini
    }
}
