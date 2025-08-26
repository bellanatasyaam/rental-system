<?php

namespace App\Http\Controllers;

use App\Models\FacilityUsage;
use App\Models\PropertyUnitFacility;
use App\Models\Contract;
use Illuminate\Http\Request;

class FacilityUsageController extends Controller
{
    public function index()
    {
        $usages = FacilityUsage::with(['propertyUnitFacility', 'contract'])->get();
        return view('facility_usages.index', compact('usages'));
    }

    public function create()
    {
        $unitFacilities = PropertyUnitFacility::all();
        $contracts = Contract::all();
        return view('facility_usages.create', compact('unitFacilities', 'contracts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_unit_facility_id' => 'required|exists:property_unit_facilities,id',
            'contract_id' => 'required|exists:contracts,id',
            'period_start' => 'required|date',
            'period_end' => 'required|date|after_or_equal:period_start',
            'usage_value' => 'required|numeric|min:0',
            'rate' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
            'invoiced' => 'required|boolean',
        ]);

        FacilityUsage::create($request->all());

        return redirect()->route('facility_usages.index')
                        ->with('success', 'Facility usage created successfully.');
    }

    public function edit(FacilityUsage $facilityUsage)
    {
        $unitFacilities = PropertyUnitFacility::all();
        $contracts = Contract::all();
        return view('facility_usages.edit', compact('facilityUsage', 'unitFacilities', 'contracts'));
    }

    public function update(Request $request, FacilityUsage $facilityUsage)
    {
        $request->validate([
            'property_unit_facility_id' => 'required|exists:property_unit_facilities,id',
            'contract_id' => 'required|exists:contracts,id',
            'usage_date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'nullable',
            'status' => 'required|string',
        ]);

        $facilityUsage->update($request->all());

        return redirect()->route('facility_usages.index')->with('success', 'Facility usage updated.');
    }

    public function destroy(FacilityUsage $facilityUsage)
    {
        $facilityUsage->delete();
        return redirect()->route('facility_usages.index')->with('success', 'Facility usage deleted.');
    }
}
