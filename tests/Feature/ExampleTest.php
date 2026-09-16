<?php

namespace Tests\Feature;

use App\Models\Import;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    // public function test_the_application_returns_a_successful_response(): void
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }
    
    // public function test_imports_can_be_created_with_nested_offers(): void
    // {
    //     $supplier = Supplier::create([
    //         'name' => 'Acme Travel',
    //         'email' => 'ops@acme.test',
    //         'phone' => '123456789',
    //         'address' => 'Main Street 1',
    //         'city' => 'Paris',
    //         'country' => 'FR',
    //         'notes' => 'Sample supplier',
    //     ]);

    //     Sanctum::actingAs(User::factory()->create());

    //     $response = $this->postJson('/api/imports', [
    //         'supplier' => 'Acme Travel',
    //         'external_import_id' => 'import-001',
    //         'status' => 'pending',
    //         'sent_at' => '2026-09-16 12:00:00',
    //         'offers' => [[
    //             'external_id' => 'offer-001',
    //             'check_in' => '2026-09-20',
    //             'check_out' => '2026-09-24',
    //             'max_guests' => 2,
    //             'price' => 125.50,
    //             'currency' => 'USD',
    //             'available_units' => 3,
    //             'expires_at' => '2026-09-18 18:00:00',
    //         ]],
    //     ]);

    //     $response->assertStatus(202);

    //     $import = Import::query()->where('external_import_id', 'import-001')->firstOrFail();

    //     $this->assertDatabaseHas('imports', [
    //         'id' => $import->id,
    //         'supplier_id' => $supplier->id,
    //         'external_import_id' => 'import-001',
    //     ]);

    //     $this->assertDatabaseHas('offers', [
    //         'external_id' => 'offer-001',
    //         'import_id' => $import->id,
    //         'currency' => 'USD',
    //     ]);
    // }
}
