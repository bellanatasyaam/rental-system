@extends('layouts.app')

@section('title','Create Property Unit Facility')

@section('content')
<div class="card">
    <div class="card-header">Create Property Unit Facility</div>
    <div class="card-body">
        <form action="{{ route('property_unit_facilities.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="property_unit_id">Property Unit</label>
                <select name="property_unit_id" id="property_unit_id" class="form-control" required>
                    <option value="">-- Pilih Property Unit --</option>
                    @foreach($propertyUnits as $unit)
                        <option value="{{ $unit->id }}" {{ old('property_unit_id') == $unit->id ? 'selected' : '' }}>
                            {{ $unit->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="facility_id">Facility</label>
                <select name="facility_id" id="facility_id" class="form-control" required>
                    <option value="">-- Pilih Fasilitas --</option>
                    @foreach($facilities as $facility)
                        <option value="{{ $facility->id }}" {{ old('facility_id') == $facility->id ? 'selected' : '' }}>
                            {{ $facility->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="settings">Settings (Optional)</label>
                <textarea name="settings" id="settings" rows="3" class="form-control" placeholder='Contoh: {"capacity": 2, "extra_bed": true}'>{{ old('settings') }}</textarea>
                <small class="text-muted">Isi format JSON jika perlu.</small>
            </div>

            <div class="form-group mb-3">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Create</button>
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
