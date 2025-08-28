@extends('layouts.app')

@section('title','Add Contract')

@section('content')
<div class="container">
    <h3>Add New Contract</h3>
    <form action="{{ route('contracts.store') }}" method="POST">
        @csrf

        <!-- PILIH PROPERTY UNIT -->
        <div class="mb-3">
            <label class="form-label">Select Property Unit</label>
            <select name="property_unit_id" class="form-control" required>
                <option value="">-- Choose Unit --</option>
                @foreach($units as $unit)
                    <option value="{{ $unit->id }}">{{ $unit->unit_code }} - {{ $unit->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- PILIH TENANT -->
        <div class="mb-3">
            <label class="form-label">Select Tenant</label>
            <select name="tenant_id" class="form-control" required>
                <option value="">-- Choose Tenant --</option>
                @foreach($tenants as $tenant)
                    <option value="{{ $tenant->id }}">{{ $tenant->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- NOMOR KONTRAK -->
        <div class="mb-3">
            <label class="form-label">Contract Number</label>
            <input type="text" name="contract_number" class="form-control" required>
        </div>

        <!-- PAYMENT DUE DAY -->
        <div class="mb-3">
            <label class="form-label">Payment Due Day</label>
            <input type="number" name="payment_due_day" min="1" max="31" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Monthly Rent</label>
            <input type="number" name="monthly_rent" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="deposit_amount">Deposit</label>
            <input type="number" step="0.01" class="form-control" id="deposit_amount"
                name="deposit_amount"
                value="{{ old('deposit_amount') }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="ended">Ended</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Save Contract</button>
        <a href="{{ route('contracts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
