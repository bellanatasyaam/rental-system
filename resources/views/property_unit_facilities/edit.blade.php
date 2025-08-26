@extends('layouts.app')

@section('title','Edit Property Unit Facility')

@section('content')
<div class="card">
    <div class="card-header">Edit Property Unit Facility</div>
    <div class="card-body">
        <form action="{{ route('property_unit_facilities.update', $propertyUnitFacility->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="property_unit_id">Property Unit</label>
                <select name="property_unit_id" id="property_unit_id" class="form-control" required>
                    @foreach($propertyUnits as $unit)
                        <option value="{{ $unit->id }}" {{ old('property_unit_id', $propertyUnitFacility->property_unit_id) == $unit->id ? 'selected' : '' }}>
                            {{ $unit->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="facility_id">Facility</label>
                <select name="facility_id" id="facility_id" class="form-control" required>
                    @foreach($facilities as $facility)
                        <option value="{{ $facility->id }}" {{ old('facility_id', $propertyUnitFacility->facility_id) == $facility->id ? 'selected' : '' }}>
                            {{ $facility->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="settings">Settings (Optional)</label>
                <textarea name="settings" id="settings" rows="3" class="form-control" placeholder='Contoh: {"capacity": 2, "extra_bed": true}'>{{ old('settings', json_encode($propertyUnitFacility->settings)) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="active" {{ old('status', $propertyUnitFacility->status) == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $propertyUnitFacility->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('property_unit_facilities.index') }}" class="btn btn-secondary">Back</a>
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
