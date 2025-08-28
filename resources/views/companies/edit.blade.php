@extends('layouts.app')
@section('title','Edit Company')
@section('content')
<div class="card">
    <div class="card-header">Edit Company</div>
    <div class="card-body">
        <form action="{{ route('companies.update',$company) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" value="{{ $company->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <textarea name="address" class="form-control">{{ old('address',$company->address ?? '') }}</textarea>
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" value="{{ $company->phone }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" value="{{ $company->email }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tax_number">Tax Number</label>
                <input type="text" name="tax_number" value="{{ $company->tax_number }}" class="form-control" required>
            </div>

            @include('companies.form',['company'=>$company])
            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back</a>
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

@error('name')
    <small class="text-danger">{{ $message }}</small>
@enderror

@error('address')
    <small class="text-danger">{{ $message }}</small>
@enderror

@error('phone')
    <small class="text-danger">{{ $message }}</small>
@enderror

@error('email')
    <small class="text-danger">{{ $message }}</small>
@enderror

@error('tax_number')
    <small class="text-danger">{{ $message }}</small>
@enderror