@extends('layouts.app')

@section('title','Facility List')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Facility List</h3>
    <div class="d-flex">
        <button onclick="window.location.href='http://127.0.0.1:8000'" class="btn btn-secondary me-2">Home</button>
        <a href="{{ route('facilities.create') }}" class="btn btn-primary">+ Add Facility</a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table id="datatable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Room</th>
            <th>Floor</th>
            <th>AC</th>
            <th>Type</th>
            <th>Description</th>
            <th>Cost</th>
            <th>Biling Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($facilities as $facility)
        <tr>
            <td>{{ $facility->id }}</td>
            <td>{{ $facility->name }}</td>
            <td>{{ $facility->room }}</td>
            <td>{{ $facility->floor }}</td>
            <td>{{ $facility->ac }}</td>
            <td>{{ $facility->type }}</td>
            <td>{{ $facility->description }}</td>
            <td>{{ $facility->cost }}</td>
            <td>{{ $facility->biling_type }}</td>
            <td>
                <a href="{{ route('facilities.edit', $facility) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('facilities.destroy', $facility) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Delete this facility?')" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $facilities->links() }}
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endpush
