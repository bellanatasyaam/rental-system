<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Tenant;
use App\Models\PropertyUnit;
use Illuminate\Http\Request;
use App\Services\FCMService;

class ContractController extends Controller
{
    /**
     * Tampilkan semua contract
     */
    public function index()
    {
        $contracts = Contract::with(['tenant', 'propertyUnit'])->latest()->paginate(10);
        return view('contracts.index', compact('contracts'));
    }

    /**
     * Form create contract
     */
    public function create()
    {
        $tenants = Tenant::all();
        $units = PropertyUnit::all();
        return view('contracts.create', compact('tenants', 'units'));
    }

    /**
     * Simpan contract baru + kirim notif
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_unit_id' => 'required|exists:property_units,id',
            'tenant_id' => 'required|exists:tenants,id',
            'payment_due_day' => 'required|integer|min:1|max:31',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'monthly_rent' => 'required|numeric',
            'deposit_amount' => 'required|numeric',
            'status' => 'required|in:active,ended'
        ]);

        // Generate nomor kontrak
        $validated['contract_number'] = 'CTR-' . str_pad(Contract::max('id') + 1, 5, '0', STR_PAD_LEFT);

        $contract = Contract::create($validated);

        // Kirim push notif ke tenant
        $tenant = Tenant::find($validated['tenant_id']);
        if ($tenant && $tenant->device_token) {
            FCMService::sendNotification(
                $tenant->device_token,
                'New Contract Created',
                "Hai {$tenant->name}, kontrak baru #{$contract->contract_number} berhasil dibuat."
            );
        }

        return redirect()->route('contracts.index')->with('success', 'Contract created successfully!');
    }

    /**
     * Cek kontrak yang mau habis, kirim notif reminder
     */
    public function checkExpiringContracts()
    {
        $expiringContracts = Contract::where('end_date', '<=', now()->addDays(7))
            ->where('status', 'active')
            ->with('tenant')
            ->get();

        foreach ($expiringContracts as $contract) {
            if ($contract->tenant && $contract->tenant->device_token) {
                FCMService::sendNotification(
                    $contract->tenant->device_token,
                    'Contract Reminder',
                    "Halo {$contract->tenant->name}, kontrak #{$contract->contract_number} akan berakhir pada {$contract->end_date}."
                );
            }
        }

        return response()->json(['message' => 'Reminders sent']);
    }
}
