@extends('layouts.app')
@section('title','Edit Tenant')
@section('content')
<div class="card">
    <div class="card-header">Edit Tenant</div>
    <div class="card-body">
        <form action="{{ route('tenants.update', $tenant) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $tenant->name }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="contact_name">Contact Name</label>
                <input type="text" name="contact_name" value="{{ $tenant->contact_name }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="phone">Phone</label>
                <input type="text" name="phone" value="{{ $tenant->phone }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ $tenant->email }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="id_card_number">ID Card Number</label>
                <input type="text" name="id_card_number" value="{{ $tenant->id_card_number }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="address">Address</label>
                <textarea name="address" class="form-control" rows="3">{{ $tenant->address }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
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
