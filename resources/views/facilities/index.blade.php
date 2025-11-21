{{-- resources/views/facilities/index.blade.php --}}
<x-app-layout>

    {{-- Header putih --}}
    <div class="w-full bg-white py-4 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <h1 class="text-xl font-bold text-gray-700">Facilities</h1>

            <div class="flex items-center gap-3">
                <a href="{{ url('/admin/dashboard') }}"
                   class="px-3 py-1 bg-gray-200 text-gray-700 rounded text-sm hover:bg-gray-300">
                    ← Back
                </a>

                <a href="{{ route('facilities.create') }}"
                   class="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                    + Add Facility
                </a>
            </div>
        </div>
    </div>


    <div class="max-w-7xl mx-auto px-6 mt-8">

        {{-- Alert sukses --}}
        @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-lg shadow mb-4">
            {{ session('success') }}
        </div>
        @endif

        {{-- Table Wrapper Card --}}
        <div class="bg-white border rounded-xl shadow overflow-x-auto">

            <table class="w-full table-auto">
                <thead class="bg-blue-600 text-white text-sm uppercase">
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

                <tbody class="text-gray-900 text-sm">
                    @forelse($facilities as $facility)
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="px-4 py-3">{{ $facility->id }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $facility->name }}</td>
                        <td class="px-4 py-3">{{ $facility->room }}</td>
                        <td class="px-4 py-3">{{ $facility->floor }}</td>
                        <td class="px-4 py-3">{{ $facility->ac }}</td>
                        <td class="px-4 py-3">{{ $facility->type }}</td>
                        <td class="px-4 py-3">{{ Str::limit($facility->description, 50) }}</td>
                        <td class="px-4 py-3">{{ number_format($facility->cost, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">{{ $facility->biling_type }}</td>

                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('facilities.edit', $facility) }}"
                               class="bg-yellow-400 hover:bg-yellow-300 text-black px-3 py-1 rounded-md text-sm shadow">
                                Edit
                            </a>

                            <form action="{{ route('facilities.destroy', $facility) }}"
                                  method="POST" class="inline-block"
                                  onsubmit="return confirm('Delete this facility?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded-md text-sm shadow ml-2">
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

        {{-- Pagination --}}
        <div class="mt-4 flex justify-center">
            {{ $facilities->links() }}
        </div>

    </div>

</x-app-layout>
