<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = [
        'code', 'name', 'address', 'type', 'total_area', 'description', 'image', 'is_active'
    ];

    protected $casts = [
        'image' => 'array',
        'is_active' => 'boolean',
        'total_area' => 'decimal:2',
    ];

    public function units()
    {
        return $this->hasMany(PropertyUnit::class, 'property_id');
    }
}