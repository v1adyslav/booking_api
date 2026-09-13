<?php

namespace Database\Seeders;

use App\Models\Import;
use App\Models\Offer;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $import = Import::query()->firstOrFail();

        // Offer::query()->firstOrCreate(
        //     ['external_id' => 'offer-a-10001'],
        //     [
        //         'import_id' => $import->id,
        //         'check_in' => '2026-10-10',
        //         'check_out' => '2026-10-15',
        //         'max_guests' => 4,
        //         'price' => 72500,
        //         'currency' => 'EUR',
        //         'available_units' => 2,
        //         'expires_at' => '2026-09-10 23:59:59',
        //     ]
        // );
    }
}
