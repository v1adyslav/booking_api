<?php

namespace Database\Seeders;

use App\Models\Import;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class ImportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $supplier = Supplier::query()->firstOrFail();

        // Import::query()->firstOrCreate(
        //     [
        //         'supplier_id' => $supplier->id,
        //         'external_import_id' => 'import-2026-09-01-001',
        //     ],
        //     [
        //         'sent_at' => '2026-09-01 10:00:00',
        //     ]
        // );
    }
}
