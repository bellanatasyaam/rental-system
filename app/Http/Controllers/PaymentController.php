<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Contract;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('contract')->paginate(10);
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $contracts = Contract::all();
        return view('payments.create', compact('contracts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'contract_id' => 'required|exists:contracts,id',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric',
            'method' => 'required|string|max:255',
            'status' => 'required|string'
        ]);

        Payment::create($validated);

        return redirect()->route('payments.index')->with('success', 'Payment added successfully!');
    }

    public function show(Payment $payment)
    {
        return view('payments.show', compact('payment'));
    }

    public function edit(Payment $payment)
    {
        \Log::info('Editing payment', ['payment' => $payment]);
        $contracts = Contract::with(['tenant', 'unit'])->get();
        \Log::info('Contracts loaded', ['contracts' => $contracts]);
        return view('payments.edit', compact('payment', 'contracts'));
    }

    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'contract_id' => 'required|exists:contracts,id',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric',
            'method' => 'required|string|max:255',
            'status' => 'required|string'
        ]);

        $payment->update($validated);

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully!');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully');
    }
}
