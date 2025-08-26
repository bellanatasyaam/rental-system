<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyUnitFacility extends Model
{
    use HasFactory;

    protected $table = 'property_unit_facilities';
    
    protected $fillable = [
        'property_unit_id',
        'facility_id',
        'settings',
        'status',
    ];

    protected $casts = [
        'settings' => 'array',
    ];

    public function propertyUnit()
    {
        return $this->belongsTo(PropertyUnit::class);
    }

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }
}
