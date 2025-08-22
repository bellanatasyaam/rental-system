@extends('layouts.app')

@section('title','Edit Property')

@section('content')
<div class="card">
    <div class="card-header">Edit Property</div>
    <div class="card-body">
        <form action="{{ route('properties.update', $property) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="code">Code</label>
                <input type="text" name="code" id="code" value="{{ old('code', $property->code) }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $property->name) }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="address">Address</label>
                <input type="text" name="address" id="address" value="{{ old('address', $property->address) }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="type">Type</label>
                <input type="text" name="type" id="type" value="{{ old('type', $property->type) }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="total_area">Total Area (m²)</label>
                <input type="number" step="0.01" name="total_area" id="total_area" value="{{ old('total_area', $property->total_area) }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" rows="3" class="form-control">{{ old('description', $property->description) }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="image">Image (JSON format)</label>
                <textarea name="image" id="image" rows="3" class="form-control">{{ old('image', $property->image ? json_encode($property->image) : '') }}</textarea>
            </div>

            <div class="form-group form-check mb-3">
                <input type="checkbox" name="is_active" id="is_active" value="1" class="form-check-input" {{ old('is_active', $property->is_active) ? 'checked' : '' }}>
                <label for="is_active" class="form-check-label">Active?</label>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('properties.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>

<!-- <form action="{{ route('properties.update', $property) }}" method="POST">
    @csrf
    @method('PUT')

    <button type="submit" class="btn btn-success">Update</button>
</form> -->

@endsection

@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
    $(function(){
        $('select').select2(); // Jika ada select2 yang digunakan, remove jika tidak ada
    });
</script>
@endpush
