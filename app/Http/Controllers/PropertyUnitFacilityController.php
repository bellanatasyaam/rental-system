<?php

namespace App\Http\Controllers;

use App\Models\PropertyUnitFacility;
use App\Models\PropertyUnit;
use App\Models\Facility;
use Illuminate\Http\Request;

class PropertyUnitFacilityController extends Controller
{
    public function index()
    {
        $data = PropertyUnitFacility::with(['propertyUnit', 'facility'])->get();
        return view('property_unit_facilities.index', compact('data'));
    }

    public function create()
    {
        $propertyUnits = PropertyUnit::all();
        $facilities = Facility::all();
        return view('property_unit_facilities.create', compact('propertyUnits', 'facilities'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_unit_id' => 'required|exists:property_units,id',
            'facility_id' => 'required|exists:facilities,id',
            'settings' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        PropertyUnitFacility::create($validated);

        return redirect()
            ->route('property_unit_facilities.index')
            ->with('success', 'Facility added successfully.');
    }

    public function edit(PropertyUnitFacility $propertyUnitFacility)
    {
        $propertyUnits = PropertyUnit::all();
        $facilities = Facility::all();
        return view('property_unit_facilities.edit', compact('propertyUnitFacility', 'propertyUnits', 'facilities'));
    }

    public function update(Request $request, PropertyUnitFacility $propertyUnitFacility)
    {
        $validated = $request->validate([
            'property_unit_id' => 'required|exists:property_units,id',
            'facility_id'      => 'required|exists:facilities,id',
            'settings'         => 'nullable|string',
            'status'           => 'required|in:active,inactive',
        ]);

        $propertyUnitFacility->update($validated);

        return redirect()
            ->route('property_unit_facilities.index')
            ->with('success', 'Facility updated successfully!');
    }
    // {
    //     $validated = $request->validate([
    //         'property_unit_id' => 'required|integer',
    //         'facility_id' => 'required|integer',
    //         'settings' => 'nullable|string',
    //         'status' => 'required|string|in:active,inactive',
    //     ]);

    //     $facility = PropertyUnitFacility::findOrFail($id);

    //     // Debugging kalau mau tes
    //     dd($validated);

    //     $facility->update($validated);

    //     return redirect()
    //         ->route('property_unit_facilities.index')
    //         ->with('success', 'Property unit facility updated successfully!');
    // }

    public function destroy(PropertyUnitFacility $propertyUnitFacility)
    {
        $propertyUnitFacility->delete();
        return redirect()->route('property-unit-facilities.index')->with('success', 'Facility berhasil dihapus!');
    }
}
