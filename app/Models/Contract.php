<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_unit_id',
        'tenant_id',
        'contract_number',
        'start_date',
        'end_date',
        'monthly_rent',
        'deposit_amount',
        'payment_due_day',
        'status'
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function propertyUnit()
    {
        return $this->belongsTo(PropertyUnit::class);
    }

    public function unit()
    {
        return $this->belongsTo(PropertyUnit::class, 'property_unit_id');
    }

}