<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
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

    public function exportPDF()
    {
        $tenants = Tenant::all();

        // Untuk daftar semua tenant
        $pdf = Pdf::loadView('tenants.export', compact('tenants'))
                ->setPaper('a4', 'landscape'); // kalau mau portrait, ganti 'portrait'

        return $pdf->stream('tenant-list.pdf');
    }

    public function exportTenantPDF($id)
    {
        $tenant = Tenant::findOrFail($id);

        // Untuk detail 1 tenant
        $pdf = Pdf::loadView('tenants.export-detail', compact('tenant'))
                ->setPaper('a4', 'portrait');

        return $pdf->stream('tenant-detail-' . $tenant->name . '.pdf');
    }

    public function print()
    {
        $tenants = Tenant::with('contracts')->get();

        $pdf = Pdf::loadView('tenants.print', compact('tenants'))
                ->setPaper('A4', 'landscape');

        return $pdf->stream('tenants.pdf');
    }

    public function printOne($id)
    {
        $tenant = \App\Models\Tenant::with('contracts.propertyUnit')->findOrFail($id);

        $pdf = Pdf::loadView('tenants.print_one', compact('tenant'))
                ->setPaper('A4', 'portrait');

        return $pdf->stream('tenant-'.$tenant->name.'.pdf');
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
            'name' => 'nullable|string|max:255',
            'gender' => 'nullable|in:Laki-laki,Perempuan',
            'religion' => 'nullable|string|max:50',
            'occupation' => 'nullable|string|max:100',
            'marital_status' => 'nullable|string|max:50',
            'origin_address' => 'nullable|string',
            'contact_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'emergency_contact' => 'nullable|string|max:255',
            // 'rental_start_date' => 'nullable|date',
            // 'email' => 'nullable|email|max:255',
            'id_card_number' => 'nullable|string|max:50',
            'address' => 'nullable|string',
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
