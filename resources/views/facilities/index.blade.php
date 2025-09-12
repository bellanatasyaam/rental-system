@extends('admin.layouts.app')

@section('title','Facility List')

@section('content')
<div class="flex justify-center items-center w-full px-6 py-6">
    <div class="w-11/12 md:w-10/12 lg:w-9/12">
        {{-- Header --}}
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-2xl font-bold text-gray-900" style="font-size: 36px;">Facility List</h3>
            <div class="flex gap-3">
                <a href="{{ url('/') }}"
                   class="bg-gray-500 hover:bg-gray-400 text-white px-4 py-2 rounded-lg shadow">
                    Home 
                </a>
                <a href="{{ route('facilities.create') }}"
                   class="bg-blue-600 hover:bg-blue-500 text-black px-4 py-2 rounded-lg shadow">
                    + Add Facility
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
            <table id="datatable" class="min-w-full table-auto border-collapse bg-gray-100">
                <thead class="bg-gray-300 text-gray-900 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Room</th>
                        <th class="px-4 py-3 text-left">Floor</th>
                        <th class="px-4 py-3 text-left">AC</th>
                        <th class="px-4 py-3 text-left">Type</th>
                        <th class="px-4 py-3 text-left">Description</th>
                        <th class="px-4 py-3 text-left">Cost</th>
                        <th class="px-4 py-3 text-left">Billing Type</th>
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300 text-gray-900">
                    @forelse($facilities as $facility)
                    <tr class="hover:bg-gray-200 transition">
                        <td class="px-4 py-3 font-medium">{{ $facility->id }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $facility->name }}</td>
                        <td class="px-4 py-3">{{ $facility->room }}</td>
                        <td class="px-4 py-3">{{ $facility->floor }}</td>
                        <td class="px-4 py-3">{{ $facility->ac }}</td>
                        <td class="px-4 py-3">{{ $facility->type }}</td>
                        <td class="px-4 py-3">{{ Str::limit($facility->description, 50) }}</td>
                        <td class="px-4 py-3">{{ number_format($facility->cost, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $facility->biling_type }}</td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <a href="{{ route('facilities.edit', $facility) }}"
                               class="bg-yellow-400 hover:bg-yellow-300 text-black px-3 py-1 rounded-md text-sm shadow">
                                Edit
                            </a>
                            <form action="{{ route('facilities.destroy', $facility) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Delete this facility?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded-md text-sm shadow" style="margin-left: 10px;">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="px-4 py-3 text-center text-gray-600">
                            No facilities found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginasi --}}
        <div class="mt-4 flex justify-center">
            {{ $facilities->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "pageLength": 10
        });
    });
</script>
@endpush
