@extends('layouts.app')

@section('title','Edit Property Unit')

@section('content')
<div class="card">
    <div class="card-header">Edit Property Unit</div>
    <div class="card-body">
        <form action="{{ route('property_units.update', $propertyUnit) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="property_id">Property</label>
                <select name="property_id" id="property_id" class="form-control" required>
                    @foreach($properties as $property)
                        <option value="{{ $property->id }}" {{ old('property_id', $propertyUnit->property_id) == $property->id ? 'selected' : '' }}>
                            {{ $property->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="unit_code">Unit Code</label>
                <input type="text" name="unit_code" id="unit_code" value="{{ old('unit_code', $propertyUnit->unit_code) }}" class="form-control" required> 
            </div>

            <div class="form-group mb-3">
                <label for="name">Unit Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $propertyUnit->name) }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="area">Size (m²)</label>
                <input type="number" step="0.01" name="area" id="area" value="{{ old('area', $propertyUnit->area) }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="monthly_price">Monthly Price</label>
                <input type="number" step="0.01" name="monthly_price" id="monthly_price" value="{{ old('monthly_price', $propertyUnit->monthly_price) }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="deposit_amount">Deposit Amount</label>
                <input type="number" step="0.01" name="deposit_amount" id="deposit_amount" value="{{ old('deposit_amount', $propertyUnit->deposit_amount) }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="available" {{ old('status', $propertyUnit->status) == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="occupied" {{ old('status', $propertyUnit->status) == 'occupied' ? 'selected' : '' }}>Occupied</option>
                    <option value="maintenance" {{ old('status', $propertyUnit->status) == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $propertyUnit->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
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
