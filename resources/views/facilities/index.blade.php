{{-- resources/views/facilities/index.blade.php --}}
<x-app-layout>

    {{-- HEADER --}}
    <div class="w-full bg-white py-5 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Facilities</h1>
                <p class="text-sm text-gray-500">Kelola fasilitas gedung.</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ url('/admin/dashboard') }}"
                    class="px-3 py-1.5 border border-gray-300 text-gray-600 rounded-md text-sm hover:bg-gray-100">
                    ← Back
                </a>

                <a href="{{ route('facilities.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 shadow-sm">
                    + Add Facility
                </a>
            </div>
        </div>
    </div>

    {{-- MAIN --}}
    <div class="max-w-7xl mx-auto px-6 mt-8">

        {{-- SUCCESS ALERT --}}
        @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-md shadow mb-4">
            {{ session('success') }}
        </div>
        @endif

        {{-- CARD --}}
        <div class="bg-white border rounded-lg shadow-sm p-5">

            {{-- TOP TOOLBAR --}}
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm bg-blue-100 text-blue-600 px-3 py-1 rounded-md">
                    Total: <strong>{{ $facilities->total() }}</strong>
                </div>

                <div class="flex items-center gap-3">
                    <div class="flex items-center border rounded-md px-3 py-2 bg-white w-64">
                        <input type="text" placeholder="Search..." class="w-full border-none focus:ring-0 text-sm">
                    </div>

                    <button class="px-3 py-2 border border-gray-300 rounded-md text-sm bg-white hover:bg-gray-100">
                        Export CSV
                    </button>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm">
                    <thead>
                        <tr class="border-b bg-gray-50 text-gray-600 text-xs uppercase">
                            <th class="py-3 px-4 text-left">ID</th>
                            <th class="py-3 px-4 text-left">Name</th>
                            <th class="py-3 px-4 text-left">Room</th>
                            <th class="py-3 px-4 text-left">Floor</th>
                            <th class="py-3 px-4 text-left">AC</th>
                            <th class="py-3 px-4 text-left">Type</th>
                            <th class="py-3 px-4 text-left hidden md:table-cell">Description</th>
                            <th class="py-3 px-4 text-left">Cost</th>
                            <th class="py-3 px-4 text-left">Billing Type</th>
                            <th class="py-3 px-4 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-800">
                        @forelse($facilities as $facility)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="py-3 px-4">
                                <div class="w-10 h-10 bg-gray-100 rounded-md flex items-center justify-center font-semibold">
                                    {{ $facility->id }}
                                </div>
                            </td>

                            <td class="py-3 px-4 font-semibold">
                                {{ $facility->name }}
                            </td>

                            <td class="py-3 px-4">{{ $facility->room }}</td>
                            <td class="py-3 px-4">{{ $facility->floor }}</td>
                            <td class="py-3 px-4">{{ $facility->ac }}</td>
                            <td class="py-3 px-4">{{ $facility->type }}</td>

                            <td class="py-3 px-4 hidden md:table-cell">
                                {{ Str::limit($facility->description, 30) }}
                            </td>

                            <td class="py-3 px-4">
                                Rp {{ number_format($facility->cost, 0, ',', '.') }}
                            </td>

                            <td class="py-3 px-4">{{ $facility->biling_type }}</td>

                            <td class="py-3 px-4 text-center">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('facilities.edit', $facility) }}"
                                        class="px-2 py-1 border rounded-md hover:bg-gray-100 text-gray-700">
                                        ✏️
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('facilities.destroy', $facility) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this facility?')"
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 py-1 border rounded-md hover:bg-gray-100 text-red-600">
                                            🗑️
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-5 text-gray-500">
                                No facilities found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-5">
                {{ $facilities->links() }}
            </div>

        </div>
    </div>

</x-app-layout>
