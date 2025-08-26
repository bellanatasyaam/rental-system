@extends('layouts.app')

@section('title', 'Property Unit List')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Property Unit List</h3>
    <div class="d-flex">
        <button onclick="window.location.href='http://127.0.0.1:8000'" class="btn btn-secondary me-2">Home</button>
        <a href="{{ route('property_units.create') }}" class="btn btn-primary">+ Add Property Unit</a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table id="datatable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Property</th>
            <th>Unit Code</th>
            <th>Name</th>
            <th>Size (m²)</th>
            <th>Monthly Price</th>
            <th>Deposit Amount</th>
            <th>Status</th>
            <th>Notes</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($units as $unit)
        <tr>
            <td>{{ $unit->id }}</td>
            <td>{{ $unit->property->name ?? '-' }}</td>
            <td>{{ $unit->unit_code }}</td>
            <td>{{ $unit->type ?? '-' }}</td>
            <td>{{ $unit->area ?? '-' }}</td>
            <td>Rp {{ number_format($unit->monthly_price, 2, ',', '.') }}</td>
            <td>Rp {{ number_format($unit->deposit_amount, 2, ',', '.') }}</td>
            <td>{{ ucfirst($unit->status) }}</td>
            <td>{{ $unit->notes ?? '-' }}</td>
            <td>
                <a href="{{ route('property_units.show', $unit->id) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('property_units.edit', $unit->id) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('property_units.destroy', $unit->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Yakin ingin hapus property unit ini?')" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $units->links() }}
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>
@endpush
