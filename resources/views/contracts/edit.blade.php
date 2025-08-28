@extends('layouts.app')

@section('title','Edit Contract')

@section('content')
<div class="container">
    <h3>Edit Contract</h3>
    <form action="{{ route('contracts.update', $contract->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Select Tenant</label>
            <select name="tenant_id" class="form-control" required>
                @foreach($tenants as $tenant)
                    <option value="{{ $tenant->id }}" {{ $contract->tenant_id == $tenant->id ? 'selected' : '' }}>
                        {{ $tenant->name }} - {{ $tenant->phone }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Select Property Unit</label>
            <select name="property_unit_id" class="form-control" required>
                @foreach($units as $unit)
                    <option value="{{ $unit->id }}" {{ $contract->property_unit_id == $unit->id ? 'selected' : '' }}>
                        {{ $unit->unit_code }} - {{ $unit->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" value="{{ $contract->start_date }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" value="{{ $contract->end_date }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Monthly Rent</label>
            <input type="number" name="monthly_rent" value="{{ $contract->monthly_rent }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="deposit_amount">Deposit</label>
            <input type="number" step="0.01" class="form-control" id="deposit_amount"
                name="deposit_amount"
                value="{{ old('deposit_amount', $contract->deposit_amount) }}"
                required>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="active" {{ $contract->status === 'active' ? 'selected' : '' }}>Active</option>
                <option value="ended" {{ $contract->status === 'ended' ? 'selected' : '' }}>Ended</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Contract</button>
        <a href="{{ route('contracts.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
