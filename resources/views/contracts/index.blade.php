@extends('layouts.app')

@section('title', 'Contracts List')

@section('content')
<div class="flex justify-center items-center w-full px-6 py-6">
    <div class="w-11/12 md:w-10/12 lg:w-9/12">

        {{-- Header --}}
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-2xl font-bold text-gray-900">Contracts List</h3>
            <div class="flex gap-3">
                <a href="{{ url('/') }}"
                   class="bg-gray-500 hover:bg-gray-400 text-white px-4 py-2 rounded-lg shadow">
                    Home
                </a>
                <a href="{{ route('contracts.create') }}"
                   class="bg-blue-600 hover:bg-blue-500 text-black px-4 py-2 rounded-lg shadow" style="margin-left: 20px;">
                    + Add Contract
                </a>
                <a href="{{ route('contracts.print') }}"
                   target="_blank"
                   class="bg-green-600 hover:bg-green-500 text-black px-4 py-2 rounded-lg shadow" style="margin-left: 20px;">
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
            <table id="datatable" class="min-w-full table-auto border-collapse bg-gray-100 text-gray-900 text-sm mx-auto rounded-lg">
                <thead class="bg-gray-300 text-gray-900 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Property Unit</th>
                        <th class="px-4 py-3">Tenant</th>
                        <th class="px-4 py-3">Start Date</th>
                        <th class="px-4 py-3">End Date</th>
                        <th class="px-4 py-3">Monthly Rent</th>
                        <th class="px-4 py-3">Deposit</th>
                        <th class="px-4 py-3">Payment Due</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center w-44">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300 text-gray-900">
                    @forelse($contracts as $contract)
                    <tr class="hover:bg-gray-200 transition">
                        <td class="px-4 py-3 text-center">{{ $contract->id }}</td>
                        <td class="px-4 py-3">
                            <span class="font-semibold">{{ $contract->propertyUnit->unit_code ?? '-' }}</span>
                            <br>
                            <small class="text-gray-500">{{ $contract->propertyUnit->name ?? '-' }}</small>
                        </td>
                        <td class="px-4 py-3">{{ $contract->tenant->name ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">{{ \Carbon\Carbon::parse($contract->start_date)->format('d M Y') }}</td>
                        <td class="px-4 py-3 text-center">{{ \Carbon\Carbon::parse($contract->end_date)->format('d M Y') }}</td>
                        <td class="px-4 py-3 text-right">Rp {{ number_format($contract->monthly_rent, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-right">Rp {{ number_format($contract->deposit_amount, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-center">{{ $contract->payment_due_day }}</td>
                        <td class="px-4 py-3 text-center">
                        <td>
                            <a href="{{ route('contracts.reminder', $contract->id) }}" class="btn btn-warning btn-sm">
                                Kirim Email Pengingat
                            </a>
                        </td>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($contract->status === 'active')
                                <span class="bg-green-200 text-green-700 px-2 py-1 rounded-full text-xs">Active</span>
                            @elseif($contract->status === 'ended')
                                <span class="bg-gray-300 text-gray-700 px-2 py-1 rounded-full text-xs">Ended</span>
                            @else
                                <span class="bg-yellow-200 text-yellow-700 px-2 py-1 rounded-full text-xs">Pending</span>
                            @endif
                        </td>

                        {{-- Tombol Action --}}
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                {{-- Detail --}}
                                <a href="{{ route('contracts.show', $contract->id) }}"
                                   class="bg-blue-500 hover:bg-blue-400 text-white p-2 rounded-full shadow transition-transform transform hover:scale-110"
                                   title="Detail">
                                    👁
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('contracts.edit', $contract->id) }}"
                                   class="bg-yellow-400 hover:bg-yellow-300 text-black p-2 rounded-full shadow transition-transform transform hover:scale-110"
                                   title="Edit">
                                    ✏
                                </a>

                                {{-- Print --}}
                                <a href="{{ route('contracts.print.one', $contract->id) }}"
                                   target="_blank"
                                   class="bg-green-500 hover:bg-green-400 text-white p-2 rounded-full shadow transition-transform transform hover:scale-110"
                                   title="Print">
                                    🖨
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('contracts.destroy', $contract->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin hapus kontrak ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-500 hover:bg-red-400 text-white p-2 rounded-full shadow transition-transform transform hover:scale-110"
                                            title="Delete">
                                        🗑
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="px-4 py-3 text-center text-gray-600">
                            Tidak ada kontrak.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginasi --}}
        <div class="mt-4 flex justify-center">
            {{ $contracts->links() }}
        </div>
    </div>
</div>
@endsection

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@push('style')
<style>
    table th, table td {
        white-space: nowrap;
        vertical-align: middle;
    }

    /* Kolom action dikunci lebarnya */
    table th:last-child, table td:last-child {
        width: 170px;
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
