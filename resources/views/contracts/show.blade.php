@extends('layouts.app')

@section('title', 'Contract Details')

@section('content')
<div class="flex justify-center mt-10">
    <div class="bg-white shadow-xl rounded-xl border border-gray-200 w-full max-w-xl mx-auto">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-600 to-blue-500 rounded-t-xl">
            <h1 class="text-lg font-semibold text-white text-center">Contract Details</h1>
        </div>

        <!-- Body -->
        <div class="p-6">
            <table class="table-auto w-full border-collapse">
                <tbody>
                    <!-- Tenant Name -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left w-1/2" style="text-align: left;">Tenant Name</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $contract->tenant->name ?? '-' }}</td>
                    </tr>
                    <!-- Tenant Phone -->
                    <tr class="border-b bg-gray-50">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Tenant Phone</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $contract->tenant->phone ?? '-' }}</td>
                    </tr>
                    <!-- Unit -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Unit</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $contract->propertyUnit->unit_code ?? '-' }}</td>
                    </tr>
                    <!-- Start Date -->
                    <tr class="border-b bg-gray-50">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Start Date</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ $contract->start_date ? \Carbon\Carbon::parse($contract->start_date)->format('d M Y') : '-' }}
                        </td>
                    </tr>
                    <!-- End Date -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">End Date</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ $contract->end_date ? \Carbon\Carbon::parse($contract->end_date)->format('d M Y') : '-' }}
                        </td>
                    </tr>
                    <!-- Monthly Rent -->
                    <tr class="border-b bg-gray-50">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Monthly Rent</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ isset($contract->monthly_rent) ? 'Rp ' . number_format($contract->monthly_rent, 0, ',', '.') : '-' }}
                        </td>
                    </tr>
                    <!-- Deposit -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Deposit</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ isset($contract->deposit) ? 'Rp ' . number_format($contract->deposit, 0, ',', '.') : '-' }}
                        </td>
                    </tr>
                    <!-- Status -->
                    <tr class="border-b bg-gray-50">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Status</th>
                        <td class="px-4 py-3 text-right">
                            <span class="px-3 py-1 rounded-full text-white text-sm
                                {{ $contract->status === 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ ucfirst($contract->status ?? '-') }}
                            </span>
                        </td>
                    </tr>
                    <!-- Created At -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Created At</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ $contract->created_at ? $contract->created_at->format('d M Y H:i') : '-' }}
                        </td>
                    </tr>
                    <!-- Updated At -->
                    <tr>
                        <th class="px-4 py-3 text-gray-800 font-semibold" style="text-align: left;">Updated At</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ $contract->updated_at ? $contract->updated_at->format('d M Y H:i') : '-' }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Back Button -->
            <div class="flex justify-center mt-6">
                <a href="{{ route('contracts.index') }}"
                   class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-black font-medium rounded-lg shadow transition duration-200">
                    ← Back
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
