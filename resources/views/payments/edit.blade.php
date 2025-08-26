@extends('layouts.app')

@section('title', 'Edit Payment')

@section('content')
<div class="container mt-4">
    <h2>Edit Payment</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
               <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('payments.update', $payment) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="contract_id" class="form-label">Contract</label>
            <select name="contract_id" id="contract_id" 
                class="form-control @error('contract_id') is-invalid @enderror" required>
                @foreach($contracts as $contract)
                    <option value="{{ $contract->id }}" {{ old('contract_id', $payment->contract_id) == $contract->id ? 'selected' : '' }}>
                        {{ $contract->tenant_name }} - {{ $contract->unit->unit_code ?? '' }}
                    </option>
                @endforeach
            </select>
            @error('contract_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="payment_date" class="form-label">Payment Date</label>
            <input type="date" name="payment_date" id="payment_date" 
                class="form-control @error('payment_date') is-invalid @enderror" 
                value="{{ old('payment_date', $payment->payment_date) }}" required>
            @error('payment_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" name="amount" id="amount" 
                class="form-control @error('amount') is-invalid @enderror" 
                value="{{ old('amount', $payment->amount) }}" required>
            @error('amount')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="method" class="form-label">Payment Method</label>
            <select name="method" id="method" 
                class="form-control @error('method') is-invalid @enderror" required>
                <option value="cash" {{ old('method', $payment->method) == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="transfer" {{ old('method', $payment->method) == 'transfer' ? 'selected' : '' }}>Bank Transfer</option>
            </select>
            @error('method')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" 
                class="form-control @error('status') is-invalid @enderror" required>
                <option value="pending" {{ old('status', $payment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="paid" {{ old('status', $payment->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="failed" {{ old('status', $payment->status) == 'failed' ? 'selected' : '' }}>Failed</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Payment</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
