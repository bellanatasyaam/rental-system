<?php

namespace App\Models;

use App\Http\Controllers\FacilityUsageController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FacilityUsage extends Model
{
    use HasFactory;

    protected $table = 'facility_usages';

    protected $fillable = [
        'property_unit_facility_id',
        'contract_id',
        'period_start',
        'period_end',
        'usage_value',
        'rate',
        'total_cost',
        'invoiced',
    ];

    public function propertyUnitFacility()
    {
        return $this->belongsTo(PropertyUnitFacility::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
