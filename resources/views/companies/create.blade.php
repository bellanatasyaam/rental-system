@extends('layouts.app')

@section('title','Add Company')

@section('content')
<div class="container">
    <h3>Add New Company</h3>
    <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Company Name -->
        <div class="mb-3">
            <label class="form-label">Company Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <!-- Company Address -->
        <div class="mb-3">
            <label class="form-label">Company Address</label>
            <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
        </div>

        <!-- Jika ada form tambahan di companies.form -->
        @include('companies.form', ['company' => null])

        <!-- Buttons -->
        <button type="submit" class="btn btn-primary">Save Company</button>
        <a href="{{ route('companies.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    });
    $(function(){
        $('select').select2();
    });
</script>
@endpush
