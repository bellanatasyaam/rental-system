<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Tenant;
use App\Models\PropertyUnit;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Tampilkan daftar kontrak.
     */
    public function index()
    {
        $contracts = Contract::with(['tenant', 'propertyUnit'])->paginate(10);
        return view('contracts.index', compact('contracts'));
    }

    /**
     * Form tambah kontrak baru.
     */
    public function create()
    {
    $units = PropertyUnit::all();
    $tenants = Tenant::all();
    return view('contracts.create', compact('units', 'tenants'));
    }

    /**
     * Simpan kontrak baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_unit_id' => 'required|exists:property_units,id',
            'tenant_id' => 'required|exists:tenants,id',
            'contract_number' => 'required|string|max:50',
            'payment_due_day' => 'required|integer|min:1|max:31',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'monthly_rent' => 'required|numeric',
            'deposit' => 'required|numeric',
            'status' => 'required|in:active,ended'
        ]);

        Contract::create($validated);

        return redirect()->route('contracts.index')->with('success', 'Contract created successfully!');
    }

    /**
     * Lihat detail kontrak.
     */
    public function show($id)
    {
        $contract = Contract::with(['tenant', 'propertyUnit', 'payments'])->findOrFail($id);
        return view('contracts.show', compact('contract'));
    }

    /**
     * Form edit kontrak.
     */
    public function edit(Contract $contract)
    {
        $tenants = Tenant::all();
        $units = PropertyUnit::all();

        return view('contracts.edit', compact('contract', 'tenants', 'units'));
    }

    /**
     * Update kontrak.
     */
    
    public function update(Request $request, Contract $contract)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|exists:tenants,id',
            'property_unit_id' => 'required|exists:property_units,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'monthly_rent' => 'required|numeric|min:0',
            'deposit' => 'required|numeric|min:0',
            'status' => 'required|in:active,ended',
        ]);

        $contract->update($validated);

        return redirect()
            ->route('contracts.index')
            ->with('success', 'Contract updated successfully!');
    }

    /**
     * Hapus kontrak.
     */
    public function destroy($id)
    {
        $contract = Contract::findOrFail($id); // <- ambil model dulu
        $contract->delete();

        return redirect()
            ->route('contracts.index')
            ->with('success', 'Contract deleted successfully!');
    }
}
