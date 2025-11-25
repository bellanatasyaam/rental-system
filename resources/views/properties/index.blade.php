{{-- resources/views/properties/index.blade.php --}}
<x-app-layout>

    {{-- HEADER --}}
    <div class="w-full bg-white py-5 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Properties</h1>
                <p class="text-sm text-gray-500">Kelola data properti yang tersedia.</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ url('/admin/dashboard') }}"
                    class="px-3 py-1.5 border border-gray-300 text-gray-600 rounded-md text-sm hover:bg-gray-100">
                    ← Back
                </a>

                <a href="{{ route('properties.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 shadow-sm">
                    + Add Property
                </a>
            </div>
        </div>
    </div>


    {{-- MAIN CONTENT --}}
    <div class="max-w-7xl mx-auto px-6 mt-8">

        {{-- SUCCESS ALERT --}}
        @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-md shadow mb-4">
            {{ session('success') }}
        </div>
        @endif

        {{-- CARD --}}
        <div class="bg-white border rounded-lg shadow-sm p-5">

            {{-- TOOLBAR --}}
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm bg-blue-100 text-blue-600 px-3 py-1 rounded-md">
                    Total: <strong>{{ $properties->total() }}</strong>
                </div>

                <div class="flex items-center gap-3">
                    <div class="flex items-center border rounded-md px-3 py-2 bg-white w-64">
                        <input type="text" placeholder="Search..." class="w-full border-none focus:ring-0 text-sm">
                    </div>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm">
                    <thead>
                        <tr class="border-b bg-gray-50 text-gray-600 text-xs uppercase">
                            <th class="py-3 px-4 text-left">ID</th>
                            <th class="py-3 px-4 text-left">Code</th>
                            <th class="py-3 px-4 text-left">Name</th>
                            <th class="py-3 px-4 text-left">Address</th>
                            <th class="py-3 px-4 text-left">Type</th>
                            <th class="py-3 px-4 text-left">Area</th>
                            <th class="py-3 px-4 text-center">Active</th>
                            <th class="py-3 px-4 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-800">
                        @forelse($properties as $property)
                        <tr class="border-b hover:bg-gray-50 transition">

                            <td class="py-3 px-4">{{ $property->id }}</td>
                            <td class="py-3 px-4">{{ $property->code }}</td>

                            <td class="py-3 px-4">
                                <div class="font-semibold">{{ $property->name }}</div>
                                <div class="text-xs text-gray-500">
                                    {{ Str::limit($property->address, 25) }}
                                </div>
                            </td>

                            <td class="py-3 px-4 hidden md:table-cell">{{ $property->address }}</td>

                            <td class="py-3 px-4 hidden md:table-cell">{{ $property->type }}</td>

                            <td class="py-3 px-4 hidden md:table-cell">
                                {{ $property->total_area }}
                            </td>

                            <td class="py-3 px-4 text-center">
                                @if($property->is_active)
                                    <span class="bg-green-200 text-green-700 px-2 py-1 rounded-full text-xs">Active</span>
                                @else
                                    <span class="bg-red-200 text-red-700 px-2 py-1 rounded-full text-xs">Inactive</span>
                                @endif
                            </td>

                            <td class="py-3 px-4 text-center">
                                <div class="flex justify-center gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('properties.edit', $property->id) }}"
                                        class="px-2 py-1 border rounded-md hover:bg-gray-100 text-gray-700">
                                        ✏️
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('properties.destroy', $property->id) }}" method="POST"
                                          onsubmit="return confirm('Hapus property ini?')">
                                        @csrf @method('DELETE')
                                        <button class="px-2 py-1 border rounded-md hover:bg-gray-100 text-red-600">
                                            🗑️
                                        </button>
                                    </form>

                                    {{-- VIEW --}}
                                    <a href="{{ route('properties.show', $property->id) }}"
                                        class="px-2 py-1 border rounded-md hover:bg-gray-100 text-gray-700">
                                        🔍
                                    </a>

                                </div>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-5 text-gray-500">
                                No properties found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-5">
                {{ $properties->links() }}
            </div>

        </div> {{-- END CARD --}}
    </div>

</x-app-layout>
