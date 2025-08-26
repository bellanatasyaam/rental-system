@extends('layouts.app')

@section('title', 'Property Unit Facilities')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h3>Property Unit Facilities</h3>
    <div class="d-flex">
        <button onclick="window.location.href='http://127.0.0.1:8000'" class="btn btn-secondary me-2">Home</button>
        <a href="{{ route('property_unit_facilities.create') }}" class="btn btn-primary">+ Add Facility</a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table id="datatable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Property Unit</th>
            <th>Facility</th>
            <th>Settings</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->propertyUnit->name ?? '-' }}</td>
            <td>{{ $item->facility->name ?? '-' }}</td>
            <td>
                @if($item->settings)
                    <pre class="mb-0">{{ json_encode($item->settings, JSON_PRETTY_PRINT) }}</pre>
                @else
                    <span class="text-muted">-</span>
                @endif
            </td>
            <td>
                @if($item->status == 'active')
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif
            </td>
            <td>
                <a href="{{ route('property_unit_facilities.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $item->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });

    $('.btn-delete').click(function() {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure to delete this facility?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/property_unit_facilities/' + id,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        if (res.success) {
                            Swal.fire('Deleted!', 'Facility has been deleted.', 'success')
                                .then(() => location.reload());
                        } else {
                            Swal.fire('Error', 'Failed to delete facility', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Failed to delete request', 'error');
                    }
                });
            }
        });
    });
</script>
@endpush
