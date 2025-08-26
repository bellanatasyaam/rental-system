<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'name','gender','religion','occupation','marital_status',
        'origin_address','contact_name','phone','emergency_contact',
        'rental_start_date','email','id_card_number','address'
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'tenant_id');
    }
}
