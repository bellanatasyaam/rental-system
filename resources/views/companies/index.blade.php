@extends('layouts.app')

@section('title', 'Company List')

@section('content')
<div class="flex justify-center items-center w-full px-6 py-6">
    <div class="w-11/12 md:w-10/12 lg:w-8/12">
        <div class="flex justify-between items-center mb-5">
            <h3 class="text-2xl font-bold text-gray-900">Company List</h3>
            <a href="{{ route('companies.create') }}" 
               class="bg-blue-600 hover:bg-blue-500 text-black px-4 py-2 rounded-lg shadow">
               + Add Company
            </a>
        </div>
        <br>

        {{-- Alert Sukses --}}
        @if(session('success'))
        <div class="bg-green-600 text-white p-3 rounded-lg shadow mb-4">
            {{ session('success') }}
        </div>
        @endif

        {{-- Wrapper tabel --}}
        <div class="overflow-x-auto rounded-lg shadow-lg border border-gray-300">
            <table class="min-w-full table-auto border-collapse bg-gray-100">
                {{-- Header tabel --}}
                <thead class="bg-gray-300 text-gray-900 uppercase text-sm">
                    <tr>
                        <th class="px-4 py-3 text-left">ID</th>
                        <th class="px-4 py-3 text-left">Name</th>
                        <th class="px-4 py-3 text-left">Address</th>
                        <th class="px-4 py-3 text-left">Phone</th>
                        <th class="px-4 py-3 text-left">Email</th>
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>
                {{-- Body tabel --}}
                <tbody class="divide-y divide-gray-300 text-gray-900">
                    @forelse($companies as $company)
                    <tr class="hover:bg-gray-200 transition">
                        <td class="px-4 py-3 font-medium">{{ $company->id }}</td>
                        <td class="px-4 py-3 font-semibold">{{ $company->name }}</td>
                        <td class="px-4 py-3">{{ Str::limit($company->address, 50) }}</td>
                        <td class="px-4 py-3">{{ $company->phone }}</td>
                        <td class="px-4 py-3">{{ $company->email }}</td>
                        <td class="px-4 py-3 text-center space-x-2">
                            <a href="{{ route('companies.edit', $company) }}"
                               class="bg-yellow-400 hover:bg-yellow-300 text-black px-3 py-1 rounded-md text-sm shadow">
                               Edit
                            </a>
                            <button data-id="{{ $company->id }}"
                                class="btn-delete bg-red-600 hover:bg-red-500 text-white px-3 py-1 rounded-md text-sm shadow">
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

        {{-- Paginasi --}}
        <div class="mt-4 flex justify-center">
            {{ $companies->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function(){
        $('.btn-delete').click(function(){
            let id = $(this).data('id');
            Swal.fire({
                title: 'Delete this company?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/companies/' + id,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(res){
                            if(res.success){
                                Swal.fire('Deleted!', 'Company removed.', 'success')
                                    .then(() => location.reload());
                            }
                        }
                    });
                }
            });
        });
    });
</script>
@endpush
