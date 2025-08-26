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

    // public function unit()
    // {
    //     return $this->belongsTo(PropertyUnit::class, 'property_unit_id');
    // }

    // Relasi ke tenant
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    // // Relasi ke property unit
    // public function unit()
    // {
    //     return $this->belongsTo(PropertyUnit::class, 'property_unit_id'); // pastikan kolom foreign key sesuai di tabel contracts
    // }

    public function propertyUnit()
    {
        return $this->belongsTo(PropertyUnit::class);
    }
}