@extends('layouts.app')

@section('title','Add Property')

@section('content')
<div class="card">
    <div class="card-header">Add Property</div>
    <div class="card-body">
        <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('properties.form')
            <button type="submit" class="btn btn-success">Create</button>
            <a href="{{ route('properties.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
<form action="{{ route('properties.store') }}" method="POST">
    @csrf
    @include('properties.form')
    <button type="submit" class="btn btn-success">Save</button>