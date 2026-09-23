<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $primaryKey = 'external_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'external_id',
        'property_code',
        'check_in',
        'check_out',
        'max_guests',
        'price',
        'currency',
        'available_units',
        'expires_at',
        'import_id',
    ];

    public function import()
    {
        return $this->belongsTo(Import::class);
    }
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_code', 'code');
    }
}
