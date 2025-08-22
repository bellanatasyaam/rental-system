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

                <!-- form upload logo -->
            <div class="form-group">
                <label for="logo">Company Logo</label>
                <input type="file" name="logo" class="form-control">

                <!-- @if($company->logo)
                    <p>Current Logo:</p>
                    <img src="{{ asset('uploads/logos/'.$company->logo) }}" width="120">
                @endif -->
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