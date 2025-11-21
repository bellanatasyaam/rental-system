{{-- resources/views/companies/index.blade.php --}}
<x-app-layout>

    {{-- HEADER PUTIH SEPERTI DI DASHBOARD --}}
    <div class="w-full bg-white py-4 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <h1 class="text-xl font-bold text-gray-700">Companies</h1>

            <div class="flex items-center gap-3">
                <a href="{{ url('/admin/dashboard') }}"
                   class="px-3 py-1 bg-gray-200 text-gray-700 rounded text-sm hover:bg-gray-300">
                    ← Back
                </a>

                <a href="{{ route('companies.create') }}"
                   class="px-3 py-1 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                    + Add Company
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 mt-8">

        {{-- ALERT SUCCESS --}}
        @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded-lg shadow mb-4">
            {{ session('success') }}
        </div>
        @endif

        {{-- CARD WRAPPER --}}
        <div class="bg-white border rounded-xl shadow overflow-x-auto">

            <table class="w-full table-auto">
                <thead class="bg-blue-600 text-white text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Alamat</th>
                        <th class="px-4 py-3">Phone</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>

                <tbody class="text-gray-900 text-sm">
                    @forelse($companies as $company)
                    <tr class="border-t hover:bg-gray-100 transition">
                        <td class="px-4 py-3">{{ $company->id }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $company->name }}</td>
                        <td class="px-4 py-3">{{ Str::limit($company->address, 50) }}</td>
                        <td class="px-4 py-3">{{ $company->phone }}</td>
                        <td class="px-4 py-3">{{ $company->email }}</td>

                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('companies.edit', $company) }}"
                               class="bg-yellow-400 hover:bg-yellow-300 text-black px-3 py-1 rounded-md text-sm shadow">
                                Edit
                            </a>

                            <button data-id="{{ $company->id }}"
                                    class="btn-delete bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded-md text-sm shadow ml-2">
                                Delete
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-3 text-center text-gray-600">
                            No companies found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-4 flex justify-center">
            {{ $companies->links() }}
        </div>

    </div>

    {{-- SCRIPT DELETE --}}
    <script>
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', () => {
                if (confirm('Yakin ingin menghapus company ini?')) {
                    let id = btn.getAttribute('data-id');

                    fetch(`/companies/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(res => location.reload());
                }
            });
        });
    </script>

</x-app-layout>
