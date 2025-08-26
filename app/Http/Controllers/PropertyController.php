<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $properties = Property::paginate(10); // ambil 10 data per halaman
        return view('properties.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'type' => 'required|string',
            'total_area' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|json',
            'is_active' => 'boolean',
        ]);

        Property::create($validated);

        return redirect()->route('properties.index')->with('success', 'Property created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $property = Property::with('units')->findOrFail($id);
        return view('properties.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $property = Property::findOrFail($id); // Ambil record property berdasarkan id

        return view('properties.edit', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)    
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'type' => 'required|string',
            'total_area' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|json',
            'is_active' => 'boolean',
        ]);

        $property->update($validated);

        return redirect()->route('properties.index')->with('success', 'Property updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('properties.index')->with('success', 'Property deleted successfully');
    }
    
}
