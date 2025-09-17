@extends('layouts.app')

@section('title', 'Tenant List')

@section('content')
<div class="flex justify-center items-center w-full px-6 py-6">
    <div class="w-11/12 md:w-10/12 lg:w-9/12">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-2xl font-bold text-gray-900">Tenant List</h3>
            <div class="flex gap-3">
                <a href="{{ url('/') }}"
                   class="bg-gray-500 hover:bg-gray-400 text-white px-4 py-2 rounded-lg shadow">
                    Home
                </a>
                <a href="{{ route('tenants.create') }}"
                   class="bg-blue-600 hover:bg-blue-500 text-black px-4 py-2 rounded-lg shadow">
                    + Add Tenant
                </a>
                <a href="{{ route('tenants.print') }}"
                   target="_blank"
                   class="bg-green-600 hover:bg-green-500 text-black px-4 py-2 rounded-lg shadow">
                    🖨 Print All
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
            <table id="datatable" class="min-w-full table-auto border-collapse bg-white text-gray-900 text-sm mx-auto rounded-lg">
                <thead class="bg-gray-300 text-gray-900 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Gender</th>
                        <th class="px-4 py-3">Agama</th>
                        <th class="px-4 py-3">Pekerjaan</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">No. HP</th>
                        <th class="px-4 py-3">Kontak Darurat</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">No. KTP</th>
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300 text-gray-900">
                    @forelse($tenants as $tenant)
                    <tr class="hover:bg-gray-200 transition">
                        <td class="px-4 py-3 text-center">{{ $tenant->id }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $tenant->name }}</td>
                        <td class="px-4 py-3 text-center">{{ $tenant->gender ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">{{ $tenant->religion ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $tenant->occupation ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">{{ $tenant->marital_status ?? '-' }}</td>
                        <td class="px-4 py-3">{{ Str::limit($tenant->origin_address, 30) ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">{{ $tenant->phone ?? '-' }}</td>
                        <td class="px-4 py-3">{{ Str::limit($tenant->emergency_contact, 25) ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $tenant->email ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">
                            {{ $tenant->rental_start_date ? \Carbon\Carbon::parse($tenant->rental_start_date)->format('d M Y') : '-' }}
                        </td>
                        <td class="px-4 py-3 text-center">{{ $tenant->id_card_number ?? '-' }}</td>
                        
                        {{-- Action --}}
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                {{-- Print --}}
                                <a href="{{ route('tenants.print.one', $tenant->id) }}"
                                   target="_blank"
                                   class="bg-green-500 hover:bg-green-400 text-white p-2 rounded-full shadow"
                                   title="Print">
                                    🖨
                                </a>
                                {{-- Detail --}}
                                <a href="{{ route('tenants.show', $tenant->id) }}"
                                   class="bg-blue-500 hover:bg-blue-400 text-white p-2 rounded-full shadow"
                                   title="Detail">
                                    👁
                                </a>
                                {{-- Edit --}}
                                <a href="{{ route('tenants.edit', $tenant->id) }}"
                                   class="bg-yellow-400 hover:bg-yellow-300 text-black p-2 rounded-full shadow"
                                   title="Edit">
                                    ✏
                                </a>
                                {{-- Delete --}}
                                <form action="{{ route('tenants.destroy', $tenant->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin hapus tenant ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-400 text-white p-2 rounded-full shadow"
                                            title="Delete">
                                        🗑
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="13" class="px-4 py-3 text-center text-gray-600">
                            Tidak ada tenant.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginasi --}}
        <div class="mt-4 flex justify-center">
            {{ $tenants->links() }}
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

    /* Kolom Action */
    table th:last-child, table td:last-child {
        width: 220px;
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
</script>
@endpush
