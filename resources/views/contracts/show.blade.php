@extends('layouts.app')

@section('title','Contract Details')

@section('content')
<div class="container">
    <h3>Contract Details</h3>
    <div class="card">
        <div class="card-body">
            <p><strong>Tenant Name:</strong> {{ $contract->tenant_name }}</p>
            <p><strong>Tenant Phone:</strong> {{ $contract->tenant_phone }}</p>
            <p><strong>Unit:</strong> {{ $contract->unit->unit_code ?? '-' }}</p>
            <p><strong>Start Date:</strong> {{ $contract->start_date }}</p>
            <p><strong>End Date:</strong> {{ $contract->end_date }}</p>
            <p><strong>Monthly Rent:</strong> Rp {{ number_format($contract->monthly_rent, 0, ',', '.') }}</p>
            <p><strong>Deposit:</strong> Rp {{ number_format($contract->deposit, 0, ',', '.') }}</p>
            <p><strong>Status:</strong> 
                @if($contract->status === 'active')
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Ended</span>
                @endif
            </p>
        </div>
    </div>

    <a href="{{ route('contracts.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
