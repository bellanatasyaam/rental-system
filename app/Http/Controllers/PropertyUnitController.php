<?php

namespace App\Http\Controllers;

use App\Models\PropertyUnit;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyUnitController extends Controller
{
    public function index()
    {
        $units = PropertyUnit::with('property')->paginate(10);
        return view('property_units.index', compact('units'));
    }

    public function create()
    {
        $properties = Property::all();
        return view('property_units.create', compact('properties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'property_id'     => 'required|exists:properties,id',   // relasi ke properties
            'unit_code'       => 'required|string|max:100',
            'name'            => 'required|string|max:255',
            'type'            => 'nullable|string|max:100',        // ubah ke string, sesuai fillable
            'area'            => 'nullable|numeric',               // decimal → pakai numeric
            'monthly_price'   => 'nullable|numeric',               // decimal → pakai numeric
            'deposit_amount'  => 'nullable|numeric',               // decimal → pakai numeric
            'status'          => 'required|string|max:50',
            'notes'           => 'nullable|string',                // text → pakai string
        ]);

            $data = $request->all();

        // Beri nilai default kalau 'type' kosong
        if (empty($data['type'])) {
            $data['type'] = 'default';  // ganti 'default' sesuai kebutuhan
        }

        PropertyUnit::create($data);

        return redirect()->route('property_units.index')->with('success', 'Property unit added successfully!');
    }

    public function show($id)
    {
        $propertyUnit = PropertyUnit::with('property')->findOrFail($id);
        return view('property_units.show', compact('propertyUnit'));
    }

    public function edit($id)
    {
        $propertyUnit = PropertyUnit::findOrFail($id);
        $properties = Property::all();
        return view('property_units.edit', compact('propertyUnit', 'properties'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'unit_code' => 'required|string|max:100',
            'name' => 'required|string|max:255',
            'type' => 'nullable|string|max:100',
            'area' => 'nullable|numeric',
            'monthly_price' => 'nullable|numeric',
            'deposit_amount' => 'nullable|numeric',
            'status' => 'required|string|max:50',
            'notes' => 'nullable|string',
        ]);

        $propertyUnit = PropertyUnit::findOrFail($id);
        $propertyUnit->update($request->all()); // pastikan kolom fillable di model sudah benar

        return redirect()->route('property_units.index')->with('success', 'Property unit updated successfully!');
    }

    public function destroy($id)
    {
        $propertyUnit = PropertyUnit::findOrFail($id);
        $propertyUnit->delete();

        return redirect()->route('property_units.index')->with('success', 'Property unit deleted successfully!');
    }
}
