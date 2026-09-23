<?php

namespace App\Jobs;

use App\Models\Import;
use App\Models\Property;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, SerializesModels;

    public function __construct(public Import $import, public array $offers)
    {
        //
    }

    public function handle(): void
    {
        $this->import->update([
            'status' => 'processing',
        ]);

        try {
            if (! empty($this->offers)) {
                foreach ($this->offers as $offerData) {
                    $property = Property::query()->firstOrCreate(
                        ['code' => $offerData['property']['code']],
                        [
                            'name' => $offerData['property']['name'],
                            'city' => $offerData['property']['city'],
                        ]
                    );
                    dump("Property {$offerData['property']['name']} was created or found");

                    dump('Processing offer: ' . $offerData['external_id']);

                    $this->import->offers()->create([
                        'external_id' => $offerData['external_id'],
                        'property_code' => $property->code,
                        'check_in' => $offerData['check_in'],
                        'check_out' => $offerData['check_out'],
                        'max_guests' => $offerData['max_guests'],
                        'price' => $offerData['price'],
                        'currency' => $offerData['currency'],
                        'available_units' => $offerData['available_units'] ?? 1,
                        'expires_at' => $offerData['expires_at'] ?? null,
                    ]);
                }
            }
        } catch (\Exception $e) {
            dump('Error processing import: ' . $e->getMessage());

            $this->import->update([ 
                'status' => 'failed',
            ]);
            return;
        }
        
        // var_dump($this->offers);
        // $this->import->offers

        $this->import->update([
            'status' => 'completed',
        ]);
    }
}
