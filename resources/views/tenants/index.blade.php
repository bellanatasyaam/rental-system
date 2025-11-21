{{-- resources/views/tenants/index.blade.php --}}
<x-app-layout>

    {{-- TOP HEADER --}}
    <div class="w-full bg-white py-4 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <h1 class="text-xl font-bold text-gray-700">Tenants</h1>

            <div class="flex items-center gap-3">
                <a href="{{ url('/admin/dashboard') }}"
                   class="px-3 py-1 bg-gray-200 text-gray-700 rounded text-sm hover:bg-gray-300">
                    ← Back
                </a>

                <a href="{{ route('tenants.print') }}" 
                   target="_blank"
                   class="px-3 py-1 bg-green-600 text-white rounded text-sm hover:bg-green-700">
                    🖨 Print All
                </a>

                <a href="{{ route('tenants.create') }}"
                   class="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                    + Add Tenant
                </a>
            </div>
        </div>
    </div>


    <div class="max-w-7xl mx-auto px-6 mt-8">

        {{-- ALERT --}}
        @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-lg shadow mb-4">
            {{ session('success') }}
        </div>
        @endif


        {{-- TABLE WRAPPER --}}
        <div class="bg-white border rounded-xl shadow overflow-x-auto">

            <table class="w-full table-auto">
                <thead class="bg-blue-600 text-white text-sm uppercase">
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

                <tbody class="text-gray-900 text-sm">

                    @forelse($tenants as $tenant)
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="px-4 py-3 text-center">{{ $tenant->id }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $tenant->name }}</td>
                        <td class="px-4 py-3 text-center">{{ $tenant->gender ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">{{ $tenant->religion ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $tenant->occupation ?? '-' }}</td>
                        <td class="px-4 py-3 text-center">{{ $tenant->marital_status ?? '-' }}</td>
                        <td class="px-4 py-3">{{ Str::limit($tenant->origin_address, 30) }}</td>
                        <td class="px-4 py-3 text-center">{{ $tenant->phone ?? '-' }}</td>
                        <td class="px-4 py-3">{{ Str::limit($tenant->emergency_contact, 25) }}</td>
                        <td class="px-4 py-3">{{ $tenant->email ?? '-' }}</td>

                        <td class="px-4 py-3 text-center">
                            {{ $tenant->rental_start_date
                                ? \Carbon\Carbon::parse($tenant->rental_start_date)->format('d M Y')
                                : '-' }}
                        </td>

                        <td class="px-4 py-3 text-center">{{ $tenant->id_card_number ?? '-' }}</td>


                        {{-- ACTION --}}
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
                                <form action="{{ route('tenants.destroy', $tenant->id) }}"
                                      method="POST"
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

        {{-- Pagination --}}
        <div class="mt-4 flex justify-center">
            {{ $tenants->links() }}
        </div>

    </div>

</x-app-layout>
