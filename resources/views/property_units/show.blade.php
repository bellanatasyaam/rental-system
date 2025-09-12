@extends('layouts.app')

@section('title', 'Property Unit Details')

@section('content')
<div class="flex justify-center mt-10">
    <div class="bg-white shadow-xl rounded-xl border border-gray-200 w-full max-w-xl mx-auto">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-600 to-blue-500 rounded-t-xl">
            <h1 class="text-lg font-semibold text-white text-center">Property Unit Details</h1>
        </div>

        <!-- Body -->
        <div class="p-6">
            <table class="table-auto w-full border-collapse">
                <tbody>
                    <!-- Unit Code -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left w-1/2" style="text-align: left;">Unit Code</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $propertyUnit->unit_code ?? '-' }}</td>
                    </tr>
                    <!-- Unit Name -->
                    <tr class="border-b bg-gray-50">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Unit Name</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $propertyUnit->name ?? '-' }}</td>
                    </tr>
                    <!-- Property -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Property</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $propertyUnit->property->name ?? '-' }}</td>
                    </tr>
                    <!-- Area -->
                    <tr class="border-b bg-gray-50">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Area</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ isset($propertyUnit->area) ? number_format($propertyUnit->area, 0, ',', '.') . ' m²' : '-' }}
                        </td>
                    </tr>
                    <!-- Monthly Price -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Monthly Price</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ isset($propertyUnit->monthly_price) ? 'Rp ' . number_format($propertyUnit->monthly_price, 0, ',', '.') : '-' }}
                        </td>
                    </tr>
                    <!-- Deposit Amount -->
                    <tr class="border-b bg-gray-50">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Deposit Amount</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ isset($propertyUnit->deposit_amount) ? 'Rp ' . number_format($propertyUnit->deposit_amount, 0, ',', '.') : '-' }}
                        </td>
                    </tr>
                    <!-- Status -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Status</th>
                        <td class="px-4 py-3 text-right">
                            @php
                                $status = strtolower($propertyUnit->status ?? '');
                                $isAvailable = in_array($status, ['available', 'tersedia']);
                            @endphp
                            <span class="px-3 py-1 rounded-full text-white text-sm {{ $isAvailable ? 'bg-green-500' : 'bg-red-500' }}">
                                {{ $propertyUnit->status ? ucfirst($propertyUnit->status) : '-' }}
                            </span>
                        </td>
                    </tr>
                    <!-- Notes -->
                    <tr class="border-b bg-gray-50">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Notes</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $propertyUnit->notes ?: '-' }}</td>
                    </tr>
                    <!-- Created At -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Created At</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ $propertyUnit->created_at ? $propertyUnit->created_at->format('d M Y H:i') : '-' }}
                        </td>
                    </tr>
                    <!-- Updated At -->
                    <tr>
                        <th class="px-4 py-3 text-gray-800 font-semibold" style="text-align: left;">Updated At</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ $propertyUnit->updated_at ? $propertyUnit->updated_at->format('d M Y H:i') : '-' }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Back Button -->
            <div class="flex justify-center mt-6">
                <a href="{{ route('property_units.index') }}"
                   class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-black font-medium rounded-lg shadow transition duration-200">
                    ← Back
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
