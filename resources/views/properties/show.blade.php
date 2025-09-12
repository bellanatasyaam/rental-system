@extends('layouts.app')
@section('title', 'Detail Property')

@section('content')
<div class="flex justify-center mt-10">
    <div class="bg-white shadow-xl rounded-xl border border-gray-200 w-full max-w-3xl mx-auto">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-600 to-blue-500 rounded-t-xl">
            <h1 class="text-lg font-semibold text-white text-center">Detail Property</h1>
        </div>

        <!-- Body -->
        <div class="p-6">
            <table class="table-auto w-full border-collapse">
                <tbody>
                    <!-- Nama Properti -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left w-1/2" style="text-align: left;">Nama Properti</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $property->name ?? '-' }}</td>
                    </tr>
                    <!-- Kode -->
                    <tr class="border-b bg-gray-50">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Kode</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $property->code ?? '-' }}</td>
                    </tr>
                    <!-- Alamat -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Alamat</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $property->address ?? '-' }}</td>
                    </tr>
                    <!-- Tipe -->
                    <tr class="border-b bg-gray-50">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Tipe</th>
                        <td class="px-4 py-3 text-gray-700 text-right">{{ $property->type ?? '-' }}</td>
                    </tr>
                    <!-- Total Area -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Total Area</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ isset($property->total_area) ? number_format($property->total_area, 0, ',', '.') . ' m²' : '-' }}
                        </td>
                    </tr>
                    <!-- Status -->
                    <tr class="border-b bg-gray-50">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Status</th>
                        <td class="px-4 py-3 text-right">
                            <span class="{{ ($property->is_active ?? false) ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                                {{ ($property->is_active ?? false) ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                    </tr>
                    <!-- Created At -->
                    <tr class="border-b">
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Dibuat</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ !empty($property->created_at) ? $property->created_at->format('d M Y H:i') : '-' }}
                        </td>
                    </tr>
                    <!-- Updated At -->
                    <tr>
                        <th class="px-4 py-3 text-gray-800 font-semibold text-left" style="text-align: left;">Diubah</th>
                        <td class="px-4 py-3 text-gray-700 text-right">
                            {{ !empty($property->updated_at) ? $property->updated_at->format('d M Y H:i') : '-' }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Daftar Units -->
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Daftar Units</h3>

                @if (($property->units ?? collect())->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full border border-gray-200 rounded-lg overflow-hidden shadow-sm">
                            <thead class="bg-indigo-600 text-white">
                                <tr>
                                    <th class="px-4 py-3 text-left">Kode Unit</th>
                                    <th class="px-4 py-3 text-left">Nama</th>
                                    <th class="px-4 py-3 text-center">Luas (m²)</th>
                                    <th class="px-4 py-3 text-right">Harga / Bulan</th>
                                    <th class="px-4 py-3 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($property->units as $unit)
                                    <tr class="border-b hover:bg-gray-50 transition">
                                        <td class="px-4 py-3">{{ $unit->unit_code ?? '-' }}</td>
                                        <td class="px-4 py-3">{{ $unit->name ?? '-' }}</td>
                                        <td class="px-4 py-3 text-center">
                                            {{ isset($unit->area) ? number_format($unit->area, 0, ',', '.') : '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            {{ isset($unit->monthly_price) ? 'Rp ' . number_format($unit->monthly_price, 0, ',', '.') : '-' }}
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            @php
                                                $status = strtolower($unit->status ?? '');
                                                $isAvailable = in_array($status, ['available','tersedia']);
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-white text-sm {{ $isAvailable ? 'bg-green-500' : 'bg-red-500' }}">
                                                {{ $unit->status ? ucfirst($unit->status) : '-' }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 italic">Belum ada unit untuk properti ini.</p>
                @endif
            </div>

            <!-- Back Button -->
            <div class="flex justify-center mt-6">
                <a href="{{ route('properties.index') }}"
                   class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-black font-medium rounded-lg shadow transition duration-200">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection