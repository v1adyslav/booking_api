<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::query()->firstOrCreate(
            ['name' => 'supplier-a'],
            [
                'email' => 'supplier-a@example.com',
                'phone' => '+123456789',
                'address' => '123 Market St',
                'city' => 'Berlin',
                'country' => 'Germany',
                'notes' => 'Primary sample supplier',
            ]
        );
    }
}
