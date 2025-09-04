@extends('layouts.app')

@section('title', 'Payment List')

@section('content')
<div class="flex justify-center items-center w-full px-6 py-6">
    <div class="w-11/12 md:w-10/12 lg:w-9/12">
        
        {{-- Header --}}
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-2xl font-bold text-gray-900">Payment List</h3>
            <div class="flex gap-3">
                <a href="{{ url('/') }}"
                   class="bg-gray-500 hover:bg-gray-400 text-white px-4 py-2 rounded-lg shadow">
                    Home
                </a>
                <a href="{{ route('payments.create') }}"
                   class="bg-blue-600 hover:bg-blue-500 text-black px-4 py-2 rounded-lg shadow" style="margin-left: 20px;">
                    + Add Payment
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
                        <th class="px-4 py-3">Contract</th>
                        <th class="px-4 py-3">Payment Date</th>
                        <th class="px-4 py-3">Amount</th>
                        <th class="px-4 py-3">Method</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center w-36">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300 text-gray-900">
                    @forelse($payments as $payment)
                    <tr class="hover:bg-gray-200 transition">
                        <td class="px-4 py-3 text-center">{{ $payment->id }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $payment->contract->tenant_name ?? 'N/A' }}</td>
                        <td class="px-4 py-3 text-center">{{ \Carbon\Carbon::parse($payment->payment_date)->format('d M Y') }}</td>
                        <td class="px-4 py-3 text-center">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-center capitalize">{{ $payment->method }}</td>
                        <td class="px-4 py-3 text-center">
                            @if($payment->status === 'paid')
                                <span class="bg-green-200 text-green-700 px-2 py-1 rounded-full text-xs">Paid</span>
                            @elseif($payment->status === 'pending')
                                <span class="bg-yellow-200 text-yellow-700 px-2 py-1 rounded-full text-xs">Pending</span>
                            @else
                                <span class="bg-red-200 text-red-700 px-2 py-1 rounded-full text-xs">Unpaid</span>
                            @endif
                        </td>

                        {{-- Tombol Action --}}
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                {{-- Detail --}}
                                <a href="{{ route('payments.show', $payment->id) }}"
                                   class="bg-blue-500 hover:bg-blue-400 text-white p-2 rounded-full shadow transition-transform transform hover:scale-110"
                                   title="Lihat Detail">
                                    👁
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('payments.edit', $payment->id) }}"
                                   class="bg-yellow-400 hover:bg-yellow-300 text-black p-2 rounded-full shadow transition-transform transform hover:scale-110"
                                   title="Edit">
                                    ✏
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('payments.destroy', $payment->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin hapus pembayaran ini?')">
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
                        <td colspan="7" class="px-4 py-3 text-center text-gray-600">
                            Tidak ada data pembayaran.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginasi --}}
        <div class="mt-4 flex justify-center">
            {{ $payments->links() }}
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

    /* Kolom action fix lebarnya */
    table th:last-child, table td:last-child {
        width: 140px;
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
