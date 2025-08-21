@extends('layouts.app')
@section('title','Edit Company')
@section('content')
<div class="card">
    <div class="card-header">Edit Company</div>
    <div class="card-body">
        <form action="{{ route('companies.update',$company) }}" method="POST">
            @csrf @method('PUT')
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