<?php

namespace App\Http\Controllers;

use App\Mail\ContractReminderMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Contract;
use App\Models\Tenant;
use App\Models\PropertyUnit;
use Illuminate\Http\Request;
use App\Contracts\PdfGeneratorInterface;

class ContractController extends Controller
{
    protected $pdfGenerator;

    public function __construct(PdfGeneratorInterface $pdfGenerator)
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    public function sendReminder($id)
    {
    // Ambil data kontrak + tenant
    $contract = Contract::with('tenant')->findOrFail($id);

    // Pastikan tenant punya email
    if (!$contract->tenant || !$contract->tenant->email) {
        return redirect()->back()->with('error', 'Tenant tidak memiliki email.');
    }

    // Kirim email pengingat
    Mail::raw(
        "Halo {$contract->tenant->name},\n\n".
        "Ini adalah pengingat untuk pembayaran kontrak sewa Anda.\n".
        "Tanggal jatuh tempo: {$contract->end_date}.\n\n".
        "Mohon segera lakukan pembayaran sebelum tanggal tersebut.\n\n".
        "Terima kasih.",
        function ($message) use ($contract) {
            $message->to($contract->tenant->email)
                    ->subject('Pengingat Pembayaran Kontrak');
        }
    );

    return redirect()->back()->with('success', 'Email pengingat berhasil dikirim!');
    }
    
    /**
     * Tampilkan daftar kontrak.
     */
    public function index()
    {
        $contracts = Contract::with(['tenant', 'propertyUnit'])->paginate(10);
        return view('contracts.index', compact('contracts'));
    }

    // Print semua contract
    public function print()
    {
        // Ambil semua kontrak lengkap dengan relasinya
        $contracts = Contract::with(['propertyUnit', 'tenant'])->get();

        // Generate PDF dari view contracts/print.blade.php
        $pdf = \PDF::loadView('contracts.print', compact('contracts'))
                ->setPaper('A4', 'landscape');

        // Tampilkan PDF di browser
        return $pdf->stream('contracts.pdf');
    }

    // Print 1 contract
    public function printOne($id)
    {
        try {
            return $this->pdfGenerator->generatePdf($id);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to generate PDF: ' . $e->getMessage());
        }
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
            'deposit_amount' => 'required|numeric', // ✅ hanya pakai deposit_amount
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
            'property_unit_id' => 'required|exists:property_units,id',
            'tenant_id' => 'required|exists:tenants,id',
            'contract_number' => 'nullable|string|max:50',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'monthly_rent' => 'required|numeric|min:0',
            'deposit_amount' => 'required|numeric|min:0',
            'payment_due_day' => 'nullable|integer|min:1|max:31',
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

    public function checkExpiringContracts()
    {
        $today = Carbon::today();
        $upcomingContracts = Contract::whereDate('end_date', '<=', $today->copy()->addDays(7))->get();

        foreach ($upcomingContracts as $contract) {
            // Ambil admin (atau user tertentu)
            $user = User::where('role', 'admin')->first();

            if ($user) {
                $user->notify(new ContractExpiringNotification($contract));
            }
        }

        return response()->json(['message' => 'Notifikasi kontrak berhasil dikirim']);
    }
}
