@extends('layouts.app')

@section('title','Company List')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Company List</h3>
    <div class="d-flex">
        <button onclick="window.location.href='http://127.0.0.1:8000'" class="btn btn-secondary me-2">Home</button>
    <a href="{{ route('companies.create') }}" class="btn btn-primary">+ Add Company</a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table id="datatable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th><th>Name</th><th>Phone</th><th>Email</th><th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
        <tr>
            <td>{{ $company->id }}</td>
            <td>{{ $company->name }}</td>
            <td>{{ $company->phone }}</td>
            <td>{{ $company->email }}</td>
            <td>
                <a href="{{ route('companies.edit',$company) }}" class="btn btn-sm btn-warning">Edit</a>
                <button class="btn btn-sm btn-danger btn-delete" data-id="{{ $company->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $companies->links() }}
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
            title: 'Delete this company?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/companies/'+id,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res){
                        if(res.success){
                            Swal.fire('Deleted!','Company removed.','success')
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

<script>
    $(document).ready(function() {
        $('#datatable').DataTable();
    });
</script>