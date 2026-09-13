<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'check_in',
        'check_out',
        'max_guests',
        'price',
        'currency',
        'available_units',
        'expires_at',
        'import_id'
    ];

    public function import()
    {
        return $this->belongsTo(Import::class);
    }
    public function property()
    {
        return $this->hasOne(Property::class);
    }
}
