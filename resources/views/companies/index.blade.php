{{-- resources/views/companies/index.blade.php --}}
<x-app-layout>

    {{-- HEADER --}}
    <div class="w-full bg-white py-5 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Companies</h1>
                <p class="text-sm text-gray-500">Kelola data perusahaan penyewa.</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ url('/admin/dashboard') }}"
                    class="px-3 py-1.5 border border-gray-300 text-gray-600 rounded-md text-sm hover:bg-gray-100">
                    ← Back
                </a>

                <a href="{{ route('companies.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700 shadow-sm">
                    + Add Company
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

            {{-- TOP TOOLBAR --}}
            <div class="flex items-center justify-between mb-4">
                <div class="text-sm bg-blue-100 text-blue-600 px-3 py-1 rounded-md">
                    Total: <strong>{{ $companies->total() }}</strong>
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
                            <th class="py-3 px-4 text-left">Nama</th>
                            <th class="py-3 px-4 text-left hidden md:table-cell">Alamat</th>
                            <th class="py-3 px-4 text-left hidden md:table-cell">Phone</th>
                            <th class="py-3 px-4 text-left hidden md:table-cell">Email</th>
                            <th class="py-3 px-4 text-center">Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-800">
                        @forelse($companies as $company)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="py-3 px-4">
                                <div class="w-10 h-10 bg-gray-100 rounded-md flex items-center justify-center font-semibold">
                                    {{ $company->id }}
                                </div>
                            </td>

                            <td class="py-3 px-4">
                                <div class="font-semibold">{{ $company->name }}</div>
                                <div class="text-xs text-gray-500">{{ Str::limit($company->address, 20) }}</div>
                            </td>

                            <td class="py-3 px-4 hidden md:table-cell">{{ $company->address }}</td>
                            <td class="py-3 px-4 hidden md:table-cell">{{ $company->phone }}</td>
                            <td class="py-3 px-4 hidden md:table-cell">{{ $company->email }}</td>

                            <td class="py-3 px-4 text-center">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- EDIT --}}
                                    <a href="{{ route('companies.edit', $company) }}"
                                        class="px-2 py-1 border rounded-md hover:bg-gray-100 text-gray-700">
                                        ✏️
                                    </a>

                                    {{-- DELETE --}}
                                    <button data-id="{{ $company->id }}"
                                        class="btn-delete px-2 py-1 border rounded-md hover:bg-gray-100 text-red-600">
                                        🗑️
                                    </button>

                                    {{-- VIEW --}}
                                    <a href="{{ route('companies.show', $company) }}"
                                        class="px-2 py-1 border rounded-md hover:bg-gray-100 text-gray-700">
                                        🔍
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-gray-500">No companies found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="mt-5">
                {{ $companies->links() }}
            </div>

        </div>
    </div>

    {{-- DELETE SCRIPT --}}
    <script>
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', () => {
                if(confirm('Yakin ingin menghapus company ini?')) {
                    let id = btn.getAttribute('data-id');
                    fetch(`/companies/${id}`, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                    }).then(res => location.reload());
                }
            });
        });
    </script>

</x-app-layout>
