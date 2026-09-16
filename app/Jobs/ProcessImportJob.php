<?php

namespace App\Jobs;

use App\Models\Import;
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
            if (! empty($offers)) {
                $this->import->offers()->createMany(
                    array_map(function (array $offer): array {
                        $property = $offer['property'];
                    
                        if (Property::query()->where('code', $property['code'])->doesntExist()) {
                            Property::query()->create([
                                'code' => $property['code'],
                                'name' => $property['name'],
                                'city' => $property['city'],
                            ]);
                        }
                        
                        return [
                            'external_id' => $offer['external_id'],
                            'check_in' => $offer['check_in'],
                            'check_out' => $offer['check_out'],
                            'max_guests' => $offer['max_guests'],
                            'price' => $offer['price'],
                            'currency' => $offer['currency'],
                            'available_units' => $offer['available_units'] ?? 1,
                            'expires_at' => $offer['expires_at'] ?? null,
                            'property_id' => Property::query()->where('code', $property['code'])->value('id'),
                        ];
                    }, $offers)
                );
            }
        } catch (\Exception $e) {
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
