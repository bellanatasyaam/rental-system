@extends('layouts.app')

@section('title', 'Property Unit Details')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Property Unit Details</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>Unit Code</th>
                <td>{{ $propertyUnit->unit_code }}</td>
            </tr>
            <tr>
                <th>Unit Name</th>
                <td>{{ $propertyUnit->name }}</td>
            </tr>
            <tr>
                <th>Property</th>
                <td>{{ $propertyUnit->property->name ?? '-' }}</td>
            </tr>
            <tr>
                <th>Area</th>
                <td>{{ $propertyUnit->area }} m²</td>
            </tr>
            <tr>
                <th>Monthly Price</th>
                <td>Rp {{ number_format($propertyUnit->monthly_price, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Deposit Amount</th>
                <td>Rp {{ number_format($propertyUnit->deposit_amount, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($propertyUnit->status) }}</td>
            </tr>
            <tr>
                <th>Notes</th>
                <td>{{ $propertyUnit->notes }}</td>
            </tr>
        </table>
        <a href="{{ route('property_units.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
