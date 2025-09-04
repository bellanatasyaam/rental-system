@extends('layouts.app')

@section('title', 'Property List')

@section('content')
<div class="flex justify-center items-center w-full px-6 py-6">
    <div class="w-11/12 md:w-10/12 lg:w-9/12">
        
        {{-- Header --}}
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-2xl font-bold text-gray-900">Property List</h3>
            <div class="flex gap-3">
                <a href="{{ url('/') }}"
                   class="bg-gray-500 hover:bg-gray-400 text-white px-4 py-2 rounded-lg shadow" style="margin-left: 20px;">
                    Home
                </a>
                <a href="{{ route('properties.create') }}"
                   class="bg-blue-600 hover:bg-blue-500 text-black px-4 py-2 rounded-lg shadow" style="margin-left: 20px;">
                    + Add Property
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
                        <th class="px-4 py-3">Code</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Address</th>
                        <th class="px-4 py-3">Type</th>
                        <th class="px-4 py-3">Total Area</th>
                        <th class="px-4 py-3">Active</th>
                        <th class="px-4 py-3 text-center w-36">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300 text-gray-900">
                    @forelse($properties as $property)
                    <tr class="hover:bg-gray-200 transition">
                        <td class="px-4 py-3 text-center">{{ $property->id }}</td>
                        <td class="px-4 py-3">{{ $property->code }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $property->name }}</td>
                        <td class="px-4 py-3">{{ Str::limit($property->address, 40) }}</td>
                        <td class="px-4 py-3 text-center">{{ $property->type }}</td>
                        <td class="px-4 py-3 text-center">{{ $property->total_area }}</td>
                        <td class="px-4 py-3 text-center">
                            @if($property->is_active)
                                <span class="bg-green-200 text-green-700 px-2 py-1 rounded-full text-xs">Active</span>
                            @else
                                <span class="bg-red-200 text-red-700 px-2 py-1 rounded-full text-xs">Inactive</span>
                            @endif
                        </td>

                        {{-- Tombol Action --}}
                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                {{-- Detail --}}
                                <a href="{{ route('properties.show', $property->id) }}"
                                   class="bg-blue-500 hover:bg-blue-400 text-white p-2 rounded-full shadow transition-transform transform hover:scale-110"
                                   title="Lihat Detail">
                                    👁
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('properties.edit', $property->id) }}"
                                   class="bg-yellow-400 hover:bg-yellow-300 text-black p-2 rounded-full shadow transition-transform transform hover:scale-110"
                                   title="Edit">
                                    ✏
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('properties.destroy', $property->id) }}" method="POST"
                                      onsubmit="return confirm('Yakin ingin hapus property ini?')">
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
                        <td colspan="8" class="px-4 py-3 text-center text-gray-600">
                            Tidak ada property.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginasi --}}
        <div class="mt-4 flex justify-center">
            {{ $properties->links() }}
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

    /* Kolom action dikunci lebarnya */
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
