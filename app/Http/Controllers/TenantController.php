<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    /**
     * Display a listing of tenants.
     */
    public function index()
    {
        $tenants = Tenant::paginate(10); 
        return view('tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new tenant.
     */
    public function create()
    {
        return view('tenants.create');
    }

    /**
     * Store a newly created tenant in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Male,Female',
            'religion' => 'nullable|string|max:50',
            'occupation' => 'nullable|string|max:100',
            'marital_status' => 'nullable|string|max:50',
            'origin_address' => 'nullable|string',
            'contact_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'emergency_contact' => 'nullable|string|max:255',
            'rental_start_date' => 'nullable|date',
            'email' => 'required|email|max:255',
            'id_card_number' => 'required|string|max:50',
            'address' => 'required|string',
        ]);

        Tenant::create($request->all());

        return redirect()->route('tenants.index')->with('success', 'Tenant created successfully.');
    }

    /**
     * Display the specified tenant.
     */
    public function show(string $id)
    {
        $tenant = Tenant::findOrFail($id);
        return view('tenants.show', compact('tenant'));
    }

    /**
     * Show the form for editing the specified tenant.
     */
    public function edit(string $id)
    {
        $tenant = Tenant::findOrFail($id);
        return view('tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified tenant in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'religion' => 'nullable|string|max:50',
            'occupation' => 'nullable|string|max:100',
            'marital_status' => 'nullable|string|max:50',
            'origin_address' => 'nullable|string',
            'contact_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'emergency_contact' => 'nullable|string|max:255',
            'rental_start_date' => 'nullable|date',
            'email' => 'required|email|max:255',
            'id_card_number' => 'required|string|max:50',
            'address' => 'required|string',
        ]);
        
        
    $tenant = Tenant::findOrFail($id);
    $tenant->update($request->all());
    return redirect()->route('tenants.index')->with('success', 'Tenant updated!');
    }

    /**
     * Remove the specified tenant from storage.
     */
    public function destroy(string $id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->delete();

        return redirect()->route('tenants.index')->with('success', 'Tenant deleted successfully.');
    }
}
