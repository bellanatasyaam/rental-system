@extends('layouts.app')

@section('title', 'Property List')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Property List</h3>
    <a href="{{ route('properties.create') }}" class="btn btn-primary">+ Add Property</a>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table id="datatable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th><th>Code</th><th>Name</th><th>Address</th><th>Type</th><th>Total Area</th><th>Active</th><th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($properties as $property)
        <tr>
            <td>{{ $property->id }}</td>
            <td>{{ $property->code }}</td>
            <td>{{ $property->name }}</td>
            <td>{{ $property->address }}</td>
            <td>{{ $property->type }}</td>
            <td>{{ $property->total_area }}</td>
            <td>{{ $property->is_active ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('properties.edit', $property) }}" class="btn btn-sm btn-warning">Edit</a>
                <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $property->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $properties->links() }}
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });

    $(function(){
        $('.btn-delete').click(function(){
            let id = $(this).data('id');
            Swal.fire({
                title: 'Delete this property?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/properties/'+id,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(res){
                            if(res.success){
                                Swal.fire('Deleted!','Property removed.','success')
                                    .then(()=> location.reload());
                            }
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
