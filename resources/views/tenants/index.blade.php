@extends('layouts.app')

@section('title','Tenant List')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h3>Tenant List</h3>
    <div class="d-flex">
        <button onclick="window.location.href='{{ url('/') }}'" class="btn btn-secondary me-2">Home</button>
        <div class="d-flex justify-content-center gap-2">
        <td><a href="{{ route('tenants.create') }}" class="btn btn-primary">+ Add Tenant</a></td>
        <td><a href="{{ route('tenants.print') }}" class="btn btn-primary">Print Tenant</a></td>
        </div>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="table-responsive">
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
                    <a href="{{ route('tenants.print.one', $tenant->id) }}" class="btn btn-sm btn-primary" target="_blank">🖨 Print</a>
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

    <div id="datatable-footer" class="d-flex justify-content-between mt-2">
        <div id="datatable-info"></div>
        <div id="datatable-paginate"></div>
    </div>

</div>

<a>{{ $tenants->links() }}</a> 


@push('styles')
<style>
.table-fixed {
    table-layout: fixed;
    width: 100%;
}
table th, table td {
    vertical-align: middle;
    text-align: center;
    white-space: nowrap;
}

/* Set lebar kolom */
table th:nth-child(1), table td:nth-child(1) { width: 50px; }
table th:nth-child(2), table td:nth-child(2) { width: 150px; }
table th:nth-child(3), table td:nth-child(3) { width: 80px; }
table th:nth-child(4), table td:nth-child(4) { width: 100px; }
table th:nth-child(5), table td:nth-child(5) { width: 120px; }
table th:nth-child(6), table td:nth-child(6) { width: 120px; }
table th:nth-child(7), table td:nth-child(7) { width: 200px; }
table th:nth-child(8), table td:nth-child(8) { width: 120px; }
table th:nth-child(9), table td:nth-child(9) { width: 200px; }
table th:nth-child(10), table td:nth-child(10) { width: 120px; }
table th:nth-child(11), table td:nth-child(11) { width: 120px; }
table th:nth-child(12), table td:nth-child(12) { width: 180px; }
</style>
@endpush

@push('styles')
<style>
table th, table td {
    vertical-align: middle;
    text-align: center;
}
table td:first-child {
    text-align: center;
}
table td:nth-child(2),
table td:nth-child(7) {
    text-align: left;
}
.btn-sm {
    min-width: 60px;
}
</style>
@endpush



@endsection

<!-- @push('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "paging": false,
            "info": false,
            "searching": true
        });
    });
</script>
@endpush -->
