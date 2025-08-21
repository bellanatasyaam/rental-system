@extends('layouts.app')
@section('title','Add Company')
@section('content')
<div class="card">
    <div class="card-header">Add Company</div>
    <div class="card-body">
        <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('companies.form')
            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('companies.index') }}" class="btn btn-secondary">Back</a>
        </form>
        
    </div>
</div>
@endsection