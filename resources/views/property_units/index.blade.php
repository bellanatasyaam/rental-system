{{-- resources/views/property_units/index.blade.php --}}
<x-app-layout>

    {{-- HEADER --}}
    <div class="w-full bg-white py-5 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Property Units</h1>
                <p class="text-sm text-gray-500">Kelola data unit kamar / properti.</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ url('/admin/dashboard') }}"
                    class="px-3 py-1.5 border border-gray-300 text-gray-600 rounded-md text-sm hover:bg-gray-100">
                    ← Back
                </a>

                <a href="{{ route('property_units.manage') }}"
                    class="px-3 py-1.5 bg-green-600 text-white rounded-md text-sm hover:bg-green-700 shadow-sm">
                    Manage Kamar
                </a>

                <a href="{{ route('property_units.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 shadow-sm">
                    + Add Unit
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

        {{-- CARD WRAPPER --}}
        <div class="bg-white border rounded-lg shadow-sm p-5">

            {{-- TOOLBAR --}}
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm bg-blue-100 text-blue-600 px-3 py-1 rounded-md">
                    Total Unit: <strong>{{ $units->total() }}</strong>
                </div>

                <div class="flex items-center gap-3">
                    <div class="flex items-center border rounded-md px-3 py-2 bg-white w-64">
                        <input 
                            type="text" 
                            placeholder="Search..." 
                            class="w-full border-none focus:ring-0 text-sm">
                    </div>

                </div>
            </div>

            {{-- TABLE --}}
            <div class="overflow-x-auto">
                <table class="w-full border-collapse text-sm">
                    <thead>
                        <tr class="border-b bg-gray-50 text-gray-600 text-xs uppercase">
                            <th class="py-3 px-4 text-left">ID</th>
                            <th class="py-3 px-4 text-left">Property</th>
                            <th class="py-3 px-4 text-left">Unit Code</th>
                            <th class="py-3 px-4 text-left">Name</th>
                            <th class="py-3 px-4 text-left">Size</th>
                            <th class="py-3 px-4 text-left">Monthly Price</th>
                            <th class="py-3 px-4 text-left">Deposit</th>
                            <th class="py-3 px-4 text-left">Status</th>
                            <th class="py-3 px-4 text-left hidden md:table-cell">Notes</th>
                            <th class="py-3 px-4 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-800">
                        @forelse($units as $unit)
                        <tr class="border-b hover:bg-gray-50 transition">

                            {{-- ID --}}
                            <td class="py-3 px-4">
                                <div
                                    class="w-10 h-10 bg-gray-100 rounded-md flex items-center justify-center font-semibold">
                                    {{ $unit->id }}
                                </div>
                            </td>

                            <td class="py-3 px-4">{{ $unit->property->name ?? '-' }}</td>
                            <td class="py-3 px-4">{{ $unit->unit_code }}</td>
                            <td class="py-3 px-4">{{ $unit->type ?? '-' }}</td>
                            <td class="py-3 px-4">{{ $unit->area ?? '-' }} m²</td>

                            <td class="py-3 px-4">
                                Rp {{ number_format($unit->monthly_price, 2, ',', '.') }}
                            </td>

                            <td class="py-3 px-4">
                                Rp {{ number_format($unit->deposit_amount, 2, ',', '.') }}
                            </td>

                            {{-- STATUS --}}
                            <td class="py-3 px-4">
                                @if(strtolower($unit->status) === 'available')
                                <span class="bg-green-100 text-green-700 px-2 py-1 rounded-md text-xs">
                                    Available
                                </span>
                                @elseif(strtolower($unit->status) === 'occupied')
                                <span class="bg-red-100 text-red-700 px-2 py-1 rounded-md text-xs">
                                    Occupied
                                </span>
                                @else
                                <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-md text-xs">
                                    {{ ucfirst($unit->status) }}
                                </span>
                                @endif
                            </td>

                            <td class="py-3 px-4 hidden md:table-cell">
                                {{ Str::limit($unit->notes, 40) ?? '-' }}
                            </td>

                            {{-- ACTION --}}
                            <td class="py-3 px-4 text-center">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- VIEW --}}
                                    <a href="{{ route('property_units.show', $unit->id) }}"
                                        class="px-2 py-1 border rounded-md hover:bg-gray-100 text-gray-700">
                                        🔍
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('property_units.edit', $unit->id) }}"
                                        class="px-2 py-1 border rounded-md hover:bg-gray-100 text-yellow-600">
                                        ✏️
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('property_units.destroy', $unit->id) }}"
                                        method="POST"
                                        onsubmit="return confirm('Hapus unit ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 py-1 border rounded-md hover:bg-gray-100 text-red-600">
                                            🗑
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="13" class="text-center py-5 text-gray-500">
                                Tidak ada property unit.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-5">
                {{ $units->links() }}
            </div>

        </div>
    </div>

</x-app-layout>
