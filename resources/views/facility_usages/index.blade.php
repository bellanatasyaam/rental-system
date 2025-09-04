@extends('layouts.app')

@section('title','Facility Usage List')

@section('content')
<div class="flex justify-center items-center w-full px-6 py-6">
    <div class="w-11/12 md:w-10/12 lg:w-9/12">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-2xl font-bold text-gray-900">Facility Usage List</h3>
            <div class="flex gap-3">
                <a href="{{ url('/') }}"
                   class="bg-gray-500 hover:bg-gray-400 text-white px-4 py-2 rounded-lg shadow">
                    Home
                </a>
                <a href="{{ route('facility_usages.create') }}"
                   class="bg-blue-600 hover:bg-blue-500 text-black px-4 py-2 rounded-lg shadow" style="margin-left: 20px;">
                    + Add Usage
                </a>
            </div>
        </div>
        <br>

        {{-- Alert sukses --}}
        @if(session('success'))
        <div class="bg-green-600 text-white p-3 rounded-lg shadow mb-4">
            {{ session('success') }}
        </div>
        @endif

        {{-- Table Wrapper --}}
        <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-300">
            <table id="datatable" class="min-w-full table-auto border-collapse bg-gray-100 text-gray-900 text-sm mx-auto rounded-lg">
                <thead class="bg-gray-300 text-gray-900 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3 text-center">ID</th>
                        <th class="px-4 py-3">Unit Facility</th>
                        <th class="px-4 py-3">Contract</th>
                        <th class="px-4 py-3">Period Start</th>
                        <th class="px-4 py-3">Period End</th>
                        <th class="px-4 py-3">Usage Value</th>
                        <th class="px-4 py-3">Rate</th>
                        <th class="px-4 py-3">Total Cost</th>
                        <th class="px-4 py-3 text-center">Invoiced</th>
                        <th class="px-4 py-3 text-center w-32">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300 text-gray-900">
                    @forelse($usages as $usage)
                    <tr class="hover:bg-gray-200 transition">
                        <td class="px-4 py-3 text-center font-medium">{{ $usage->id }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $usage->propertyUnitFacility->name ?? '-' }}</td>
                        <td class="px-4 py-3">Contract #{{ $usage->contract->id ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $usage->period_start }}</td>
                        <td class="px-4 py-3">{{ $usage->period_end }}</td>
                        <td class="px-4 py-3">{{ $usage->usage_value }}</td>
                        <td class="px-4 py-3">Rp {{ number_format($usage->rate, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">Rp {{ number_format($usage->total_cost, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-center">
                            @if($usage->invoiced)
                                <span class="bg-green-200 text-green-700 px-2 py-1 rounded-full text-xs">Yes</span>
                            @else
                                <span class="bg-red-200 text-red-700 px-2 py-1 rounded-full text-xs">No</span>
                            @endif
                        </td>

                        {{-- Tombol Action --}}
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                {{-- Edit --}}
                                <a href="{{ route('facility_usages.edit', $usage) }}"
                                   class="bg-yellow-400 hover:bg-yellow-300 text-black p-2 rounded-full shadow transition-transform transform hover:scale-110"
                                   title="Edit">
                                    ✏
                                </a>

                                {{-- Delete --}}
                                <button class="bg-red-500 hover:bg-red-400 text-white p-2 rounded-full shadow transition-transform transform hover:scale-110 btn-delete"
                                        data-id="{{ $usage->id }}"
                                        title="Delete">
                                    🗑
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="px-4 py-3 text-center text-gray-600">
                            Tidak ada data penggunaan fasilitas.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    table th, table td {
        white-space: nowrap;
        vertical-align: middle;
    }

    /* Kolom Action fix lebarnya */
    table th:last-child,
    table td:last-child {
        width: 130px;
        text-align: center;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "pageLength": 10
        });
    });

    // SweetAlert untuk Delete
    $('.btn-delete').click(function() {
        let id = $(this).data('id');
        Swal.fire({
            title: 'Apakah kamu yakin?',
            text: "Data penggunaan fasilitas ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e3342f',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/facility_usages/' + id,
                    type: 'DELETE',
                    data: { _token: '{{ csrf_token() }}' },
                    success: function(res) {
                        if (res.success) {
                            Swal.fire('Terhapus!', 'Data penggunaan fasilitas berhasil dihapus.', 'success')
                                .then(() => location.reload());
                        } else {
                            Swal.fire('Gagal', 'Tidak dapat menghapus data.', 'error');
                        }
                    },
                    error: function() {
                        Swal.fire('Error', 'Gagal memproses permintaan.', 'error');
                    }
                });
            }
        });
    });
</script>
@endpush
