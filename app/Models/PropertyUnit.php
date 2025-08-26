<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyUnit extends Model
{
    use HasFactory;

    protected $table = 'property_units';

    protected $fillable = [
        'property_id',
        'unit_code',
        'name',
        'type',
        'area',
        'monthly_price',
        'deposit_amount',
        'status',
        'notes',
    ];

    // relasi kebalikannnya
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'property_unit_id');
    }
    

}
