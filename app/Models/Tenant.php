<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'name',
        'contact_name',
        'phone',
        'email',
        'id_card_number',
        'address'
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'tenant_id');
    }
}
