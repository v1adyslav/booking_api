<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Property::query()->firstOrCreate(
        //     ['code' => 'BCN-0001'],
        //     [
        //         'name' => 'Apartment near Sagrada Familia',
        //         'city' => 'Barcelona'
        //     ]
        // );
    }
}
