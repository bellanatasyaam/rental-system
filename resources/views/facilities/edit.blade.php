@extends('layouts.app')

@section('title', 'Edit Facility')

@section('content')
<div class="container mt-4">
    <h2>Edit Facility</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('facilities.update', $facility->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" 
                   class="form-control @error('name') is-invalid @enderror" 
                   id="name" name="name" 
                   value="{{ old('name', $facility->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <input type="text" 
                   class="form-control @error('type') is-invalid @enderror" 
                   id="type" name="type" 
                   value="{{ old('type', $facility->type) }}" required>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control @error('description') is-invalid @enderror" 
                      id="description" name="description" rows="3">{{ old('description', $facility->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cost" class="form-label">Cost</label>
            <input type="number" step="0.01" 
                   class="form-control @error('cost') is-invalid @enderror" 
                   id="cost" name="cost" 
                   value="{{ old('cost', $facility->cost) }}" required>
            @error('cost')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="biling_type" class="form-label">Biling Type</label>
            <input type="text" 
                   class="form-control @error('biling_type') is-invalid @enderror" 
                   id="biling_type" name="biling_type" 
                   value="{{ old('biling_type', $facility->biling_type) }}" required>
            @error('biling_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Update Facility</button>
        <a href="{{ route('facilities.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
