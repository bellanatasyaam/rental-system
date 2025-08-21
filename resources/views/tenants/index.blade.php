@extends('layouts.app')

@section('title','Tenant List')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Tenant List</h3>
    <a href="{{ route('tenants.create') }}" class="btn btn-primary">+ Add Tenant</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table id="datatable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Contact Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>ID Card Number</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tenants as $tenant)
        <tr>
            <td>{{ $tenant->id }}</td>
            <td>{{ $tenant->name }}</td>
            <td>{{ $tenant->contact_name }}</td>
            <td>{{ $tenant->phone }}</td>
            <td>{{ $tenant->email }}</td>
            <td>{{ $tenant->id_card_number }}</td>
            <td>{{ $tenant->address }}</td>
            <td>
                <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin hapus tenant ini?')" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $tenants->links() }}
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endpush
