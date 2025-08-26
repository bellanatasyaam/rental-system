@extends('layouts.app')

@section('title','Tenant List')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Tenant List</h3>
    <div class="d-flex">
        <button onclick="window.location.href='{{ url('/') }}'" class="btn btn-secondary me-2">Home</button>
        <a href="{{ route('tenants.create') }}" class="btn btn-primary">+ Add Tenant</a>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<table id="datatable" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Gender</th>
            <th>Agama</th>
            <th>Pekerjaan</th>
            <th>Status Perkawinan</th>
            <th>Alamat Rumah Asal</th>
            <th>No. Telp/HP</th>
            <th>No. Kontak Darurat - Nama & Hubungan</th>
            <th>Tanggal Mulai Huni/Sewa</th>
            <th>No. KTP</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($tenants as $tenant)
        <tr>
            <td>{{ $tenant->id }}</td>
            <td>{{ $tenant->name }}</td>
            <td>{{ $tenant->gender ?? '-' }}</td>
            <td>{{ $tenant->religion ?? '-' }}</td>
            <td>{{ $tenant->occupation ?? '-' }}</td>
            <td>{{ $tenant->marital_status ?? '-' }}</td>
            <td>{{ $tenant->origin_address ?? '-' }}</td>
            <td>{{ $tenant->phone ?? '-' }}</td>
            <td>{{ $tenant->emergency_contact ?? '-' }}</td>
            <td>{{ $tenant->rental_start_date ? \Carbon\Carbon::parse($tenant->rental_start_date)->format('d M Y') : '-' }}</td>
            <td>{{ $tenant->id_card_number ?? '-' }}</td>
            <td class="text-center">
                <div class="d-flex justify-content-center gap-2">
                    <a href="{{ route('tenants.show', $tenant->id) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route('tenants.edit', $tenant->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST" onsubmit="return confirm('Yakin ingin hapus tenant ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<a>{{ $tenants->links() }}</a> 

{{-- Pagination Laravel --}}
<div class="d-flex justify-content-between align-items-center mt-3"></div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "paging": false,
            "info": false,
            "searching": true
        });
    });
</script>
@endpush
