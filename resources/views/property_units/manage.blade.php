@extends('layouts.app')

@section('title', 'Manage Kamar')

@section('content')
<div class="container mx-auto px-4 py-4">

    {{-- FILTER PROPERTI --}}
    <form method="GET" action="{{ route('property_units.manage') }}" class="mb-6">
        <div class="flex items-center gap-4">
            <label class="font-semibold">Pilih Properti:</label>
            <select name="property_id" onchange="this.form.submit()" class="p-2 border rounded-lg">
                <option value="">Semua Properti </option>
                @foreach($properties as $property)
                    <option value="{{ $property->id }}" {{ $propertyId == $property->id ? 'selected' : '' }}>
                        {{ $property->name }}
                    </option>
                @endforeach
            </select>

            <a href="{{ route('property_units.index') }}"
            class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 transition">
                Back to List
            </a>
        </div>
    </form>

    {{-- INFO STATUS --}}
    <div class="flex items-center gap-6 mb-6 text-sm">
        <span class="flex items-center gap-2">
            <span class="w-4 h-4 bg-green-500 inline-block rounded"></span> Kosong
        </span>
        <span class="flex items-center gap-2">
            <span class="w-4 h-4 bg-red-500 inline-block rounded"></span> Terisi
        </span>
        <span class="flex items-center gap-2">
            <span class="w-4 h-4 room-gray inline-block rounded"></span> Under Maintenance
        </span>
    </div>

    {{-- GRID KAMAR --}}
    @if($units->count() > 0)
        <div class="grid grid-cols-6 gap-4">
            @foreach($units as $unit)

            @php
                $s = strtolower(trim($unit->status));
            @endphp

            <button 
                class="p-4 rounded-xl shadow-md font-bold transition relative
                    {{ $s === 'available' ? 'bg-green-500 hover:bg-green-600 text-white' : '' }}
                    {{ $s === 'occupied' ? 'bg-red-500 text-white cursor-not-allowed' : '' }}
                    {{ $s === 'maintenance' ? 'room-gray text-white cursor-not-allowed' : '' }}"
                
                @if($s !== 'available') disabled @endif

                onclick="bookUnit({{ $unit->id }})"

                title="Kamar: {{ $unit->name }}&#10;Harga: Rp{{ number_format($unit->monthly_price,0,',','.') }}&#10;Status: {{ ucfirst($unit->status) }}"
            >
                {{ $unit->unit_code }}
            </button>

            @endforeach
        </div>
    @else
        <div class="mt-6 text-center text-gray-500">
            Belum ada unit untuk properti ini.
        </div>
    @endif
</div>

{{-- CUSTOM STYLE --}}
<style>
    .room-gray {
        background-color: #6b7280 !important;
        color: white !important;
    }

    .bg-red-500 {
        background-color: #ef4444 !important;
        color: white !important;
    }

    .bg-green-500 {
        background-color: #22c55e !important;
        color: white !important;
    }
</style>

{{-- SCRIPT BOOKING --}}
<script>
    function bookUnit(unitId) {
        if (!confirm("Apakah kamu yakin ingin booking kamar ini?")) return;

        fetch(`/property-units/${unitId}/book`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                alert(data.success);
                location.reload();
            }
        })
        .catch(err => {
            console.error(err);
            alert("Terjadi kesalahan. Coba lagi!");
        });
    }
</script>
@endsection
