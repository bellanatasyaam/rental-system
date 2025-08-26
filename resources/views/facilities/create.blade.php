@extends('layouts.app')

@section('title', 'Add New Facility')

@section('content')
<div class="container mt-4">
    <h2>Add New Facility</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('facilities.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="ac" class="form-label">AC</label>
            <select name="ac" id="ac" class="form-control" required>
                <option value="AC" {{ old('ac') == 'AC' ? 'selected' : '' }}>AC</option>
                <option value="No AC" {{ old('ac') == 'No AC' ? 'selected' : '' }}>No AC</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="room" class="form-label">Room</label>
            <input type="text" class="form-control" id="room" name="room" value="{{ old('room') }}">
        </div>

        <div class="mb-3">
            <label for="floor" class="form-label">Floor</label>
            <input type="text" class="form-control" id="floor" name="floor" value="{{ old('floor') }}">
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" class="form-control" id="type" name="type" value="{{ old('type') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="cost" class="form-label">Cost</label>
            <input type="number" step="0.01" class="form-control" id="cost" name="cost" value="{{ old('cost') }}" required>
        </div>

        <div class="mb-3">
            <label for="biling_type" class="form-label">Biling Type</label>
            <input type="text" class="form-control" id="biling_type" name="biling_type" value="{{ old('biling_type') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Facility</button>
        <a href="{{ route('facilities.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
