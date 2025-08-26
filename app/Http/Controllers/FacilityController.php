<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    // Tampilkan semua data fasilitas
    public function index()
    {
        $facilities = Facility::paginate(10); // ambil 10 data per halaman
        return view('facilities.index', compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('facilities.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'room' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:255',
            'ac' => 'required|in:AC,No AC',
            'description' => 'nullable|string',
            'cost' => 'required|numeric',
            'biling_type' => 'required|string|max:255',
        ]);

        Facility::create($validatedData);

        return redirect()->route('facilities.index')
                        ->with('success', 'Facility created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Facility $facility)
    {
        return view('facilities.edit', compact('facility'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'room' => 'nullable|string|max:255',
            'floor' => 'nullable|string|max:255',
            'ac' => 'required|in:AC,No AC',
            'description' => 'nullable|string',
            'cost' => 'required|numeric',
            'biling_type' => 'required|string|max:255',
        ]);

        $facility->update($request->all());

        return redirect()->route('facilities.index')
                         ->with('success', 'Facility updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        $facility->delete();

        return redirect()->route('facilities.index')
                         ->with('success', 'Facility deleted successfully.');
    }
}
