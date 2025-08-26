@extends('layouts.app')

@section('title', 'Edit Facility Usage')

@section('content')
<div class="container mt-4">
    <h2>Edit Facility Usage</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('facility_usages.update', $facilityUsage->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="property_unit_facility_id" class="form-label">Unit Facility</label>
            <select name="property_unit_facility_id" id="property_unit_facility_id" class="form-control" required>
                @foreach($unitFacilities as $facility)
                <option value="{{ $facility->id }}" {{ $facilityUsage->property_unit_facility_id == $facility->id ? 'selected' : '' }}>
                    {{ $facility->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="contract_id" class="form-label">Contract</label>
            <select name="contract_id" id="contract_id" class="form-control" required>
                @foreach($contracts as $contract)
                <option value="{{ $contract->id }}" {{ $facilityUsage->contract_id == $contract->id ? 'selected' : '' }}>
                    Contract #{{ $contract->id }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="period_start" class="form-label">Period Start</label>
            <input type="date" name="period_start" id="period_start" class="form-control" value="{{ old('period_start', $facilityUsage->period_start) }}" required>
        </div>

        <div class="mb-3">
            <label for="period_end" class="form-label">Period End</label>
            <input type="date" name="period_end" id="period_end" class="form-control" value="{{ old('period_end', $facilityUsage->period_end) }}" required>
        </div>

        <div class="mb-3">
            <label for="usage_value" class="form-label">Usage Value</label>
            <input type="number" step="0.01" name="usage_value" id="usage_value" class="form-control" value="{{ old('usage_value', $facilityUsage->usage_value) }}" required>
        </div>

        <div class="mb-3">
            <label for="rate" class="form-label">Rate</label>
            <input type="number" step="0.01" name="rate" id="rate" class="form-control" value="{{ old('rate', $facilityUsage->rate) }}" required>
        </div>

        <div class="mb-3">
            <label for="total_cost" class="form-label">Total Cost</label>
            <input type="number" step="0.01" name="total_cost" id="total_cost" class="form-control" value="{{ old('total_cost', $facilityUsage->total_cost) }}" required>
        </div>

        <div class="mb-3">
            <label for="invoiced" class="form-label">Invoiced</label>
            <select name="invoiced" id="invoiced" class="form-control" required>
                <option value="0" {{ $facilityUsage->invoiced == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ $facilityUsage->invoiced == 1 ? 'selected' : '' }}>Yes</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Usage</button>
        <a href="{{ route('facility_usages.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
