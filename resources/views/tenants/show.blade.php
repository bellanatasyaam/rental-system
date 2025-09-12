@extends('layouts.app')

@section('title', 'Tenant Details')

@section('content')
<div class="flex justify-center mt-10">
    <div class="bg-white shadow-xl rounded-xl border border-gray-200 w-full max-w-xl mx-auto">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-600 to-blue-500 rounded-t-xl">
            <h1 class="text-lg font-semibold text-white text-center">Tenant Details</h1>
        </div>

        <!-- Body -->
        <div class="p-6">
            <table class="table-auto w-full border-collapse">
                <tbody>
                    <!-- Nama -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left w-1/2" style="text-align: left;">Nama</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $tenant->name }}</td>
                    </tr>
                    <!-- Contact Name -->
                    <tr class="border-b bg-gray-50">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Contact Name</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $tenant->contact_name ?? '-' }}</td>
                    </tr>
                    <!-- Phone -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Phone</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $tenant->phone ?? '-' }}</td>
                    </tr>
                    <!-- Email -->
                    <tr class="border-b bg-gray-50">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Email</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $tenant->email ?? '-' }}</td>
                    </tr>
                    <!-- ID Card Number -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">ID Card Number</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $tenant->id_card_number ?? '-' }}</td>
                    </tr>
                    <!-- Address -->
                    <tr class="border-b bg-gray-50">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Address</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $tenant->address ?? '-' }}</td>
                    </tr>
                    <!-- Created At -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Created At</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ $tenant->created_at ? $tenant->created_at->format('d M Y H:i') : '-' }}
                        </td>
                    </tr>
                    <!-- Updated At -->
                    <tr>
                        <th class="px-4 py-3 text-gray-800 font-semibold" style="text-align: left;">Updated At</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ $tenant->updated_at ? $tenant->updated_at->format('d M Y H:i') : '-' }}
                        </td>   
                    </tr>
                </tbody>
            </table>

            <!-- Back Button -->
            <div class="flex justify-center mt-6">
                <a href="{{ route('tenants.index') }}"
                   class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-black font-medium rounded-lg shadow transition duration-200">
                    ← Back
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
