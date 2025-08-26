@extends('layouts.app')

@section('title','Create Property Unit')

@section('content')
<div class="card">
    <div class="card-header">Create Property Unit</div>
    <div class="card-body">
        <form action="{{ route('property_units.store') }}" method="POST" enctype="multipart/form-data">
            @csrf  <!-- Ini wajib untuk proteksi CSRF -->

            <div class="form-group mb-3">
                <label for="property_id">Property</label>
                <select name="property_id" id="property_id" class="form-control" required>
                    <option value="">-- Pilih Property --</option>
                    @foreach($properties as $property)
                        <option value="{{ $property->id }}" {{ old('property_id') == $property->id ? 'selected' : '' }}>
                            {{ $property->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="unit_code">Unit Code</label>
                <input type="text" name="unit_code" id="unit_code" value="{{ old('unit_code') }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="name">Unit Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="type">Type</label>
                <input type="text" name="type" id="type" value="{{ old('type', 'standard') }}" class="form-control">
                <!-- Default nilai 'standard' sesuai schema -->
            </div>

            <div class="form-group mb-3">
                <label for="area">Size (m²)</label>
                <input type="number" step="0.01" name="area" id="area" value="{{ old('area') }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="monthly_price">Monthly Price</label>
                <input type="number" step="0.01" name="monthly_price" id="monthly_price" value="{{ old('monthly_price') }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="deposit_amount">Deposit Amount</label>
                <input type="number" step="0.01" name="deposit_amount" id="deposit_amount" value="{{ old('deposit_amount') }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="available" {{ old('status', 'available') == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>Occupied</option>
                    <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="notes">Notes</label>
                <textarea name="notes" id="notes" rows="3" class="form-control">{{ old('notes') }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Create</button>
            <a href="{{ route('property_units.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function(){
        $('select').select2();
    });
</script>
@endpush
