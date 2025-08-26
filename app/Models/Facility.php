<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    // Tentukan kolom yang boleh diisi massal
    protected $fillable = [
        'name',
        'type',
        'description',
        'cost',
        'biling_type',
        'room',
        'floor',
        'ac'
    ];
}
