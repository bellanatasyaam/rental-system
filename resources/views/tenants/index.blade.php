{{-- resources/views/tenants/index.blade.php --}}
<x-app-layout>

    {{-- HEADER --}}
    <div class="w-full bg-white py-5 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Tenants</h1>
                <p class="text-sm text-gray-500">Kelola data penghuni / penyewa.</p>
            </div>

            <div class="flex items-center gap-3">

                {{-- BACK --}}
                <a href="{{ url('/admin/dashboard') }}"
                    class="px-3 py-1.5 border border-gray-300 text-gray-600 rounded-md text-sm hover:bg-gray-100">
                    ← Back
                </a>

                {{-- PRINT ALL --}}
                <a href="{{ route('tenants.print') }}"
                    target="_blank"
                    class="px-3 py-1.5 bg-green-600 text-white rounded-md text-sm hover:bg-green-700 shadow-sm">
                    🖨 Print All
                </a>

                {{-- ADD --}}
                <a href="{{ route('tenants.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 shadow-sm">
                    + Add Tenant
                </a>
            </div>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="w-full px-6 mt-8">

        {{-- SUCCESS ALERT --}}
        @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-md shadow mb-4">
            {{ session('success') }}
        </div>
        @endif

        {{-- CARD WRAPPER --}}
        <div class="bg-white border rounded-lg shadow-sm px-8 py-6">

            {{-- TOP TOOLBAR --}}
            <div class="flex items-center justify-between mb-4">

                {{-- TOTAL --}}
                <div class="text-sm bg-blue-100 text-blue-600 px-3 py-1 rounded-md">
                    Total: <strong>{{ $tenants->total() }}</strong>
                </div>

                {{-- SEARCH + EXPORT --}}
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
            <div class="overflow-x-visible">
                <table class="w-full border-collapse text-sm">
                    <thead>
                        <tr class="border-b bg-gray-50 text-gray-600 text-xs uppercase">
                            <th class="py-3 px-4 text-left">ID</th>
                            <th class="py-3 px-4 text-left">Nama</th>
                            <th class="py-3 px-4 text-left">Gender</th>
                            <th class="py-3 px-4 text-left">Agama</th>
                            <th class="py-3 px-4 text-left hidden md:table-cell">Pekerjaan</th>
                            <th class="py-3 px-4 text-left">Status</th>
                            <th class="py-3 px-4 text-left hidden md:table-cell">Alamat</th>
                            <th class="py-3 px-4 text-left">No. HP</th>
                            <th class="py-3 px-4 text-left hidden md:table-cell">Kontak Darurat</th>
                            <th class="py-3 px-4 text-left hidden md:table-cell">Email</th>
                            <th class="py-3 px-4 text-left">Tanggal</th>
                            <th class="py-3 px-4 text-left hidden md:table-cell">No. KTP</th>
                            <th class="py-3 px-4 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-800">

                        @forelse($tenants as $tenant)
                        <tr class="border-b hover:bg-gray-50 transition">

                            {{-- ID --}}
                            <td class="py-3 px-4">
                                <div class="w-10 h-10 bg-gray-100 rounded-md flex items-center justify-center font-semibold">
                                    {{ $tenant->id }}
                                </div>
                            </td>

                            {{-- NAME --}}
                            <td class="py-3 px-4 font-semibold">
                                {{ $tenant->name }}
                            </td>

                            <td class="py-3 px-4">{{ $tenant->gender ?? '-' }}</td>
                            <td class="py-3 px-4">{{ $tenant->religion ?? '-' }}</td>
                            <td class="py-3 px-4 hidden md:table-cell">{{ $tenant->occupation ?? '-' }}</td>
                            <td class="py-3 px-4">{{ $tenant->marital_status ?? '-' }}</td>
                            <td class="py-3 px-4 hidden md:table-cell">{{ Str::limit($tenant->address, 30) }}</td>
                            <td class="py-3 px-4">{{ $tenant->phone ?? '-' }}</td>
                            <td class="py-3 px-4 hidden md:table-cell">{{ Str::limit($tenant->emergency_contact, 30) }}</td>
                            <td class="py-3 px-4 hidden md:table-cell">{{ $tenant->email ?? '-' }}</td>

                            {{-- RENTAL DATE --}}
                            <td class="py-3 px-4">
                                {{ $tenant->rental_start_date
                                    ? \Carbon\Carbon::parse($tenant->rental_start_date)->format('d M Y')
                                    : '-' }}
                            </td>

                            {{-- KTP --}}
                            <td class="py-3 px-4 hidden md:table-cell">
                                {{ $tenant->id_card_number ?? '-' }}
                            </td>

                            {{-- ACTION --}}
                            <td class="py-3 px-4 text-center">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- PRINT --}}
                                    <a href="{{ route('tenants.print.one', $tenant->id) }}" target="_blank"
                                        class="px-2 py-1 border rounded-md hover:bg-gray-100 text-green-600">
                                        🖨
                                    </a>

                                    {{-- DETAIL --}}
                                    <a href="{{ route('tenants.show', $tenant->id) }}"
                                        class="px-2 py-1 border rounded-md hover:bg-gray-100 text-gray-700">
                                        👁
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('tenants.edit', $tenant->id) }}"
                                        class="px-2 py-1 border rounded-md hover:bg-gray-100 text-yellow-600">
                                        ✏️
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('tenants.destroy', $tenant->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus tenant ini?')">
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
                                Tidak ada tenant.
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-5">
                {{ $tenants->links() }}
            </div>

        </div>
    </div>

</x-app-layout>
