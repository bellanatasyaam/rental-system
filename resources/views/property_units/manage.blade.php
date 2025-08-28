@extends('layouts.app')

@section('title', 'Manage Kamar')

@section('content')
<div class="container mx-auto px-4">

    {{-- FILTER PROPERTI --}}
    <form method="GET" action="{{ route('property_units.manage') }}" class="mb-6">
        <div class="flex items-center gap-4">
            <label class="font-semibold">Pilih Properti:</label>
            <select name="property_id" onchange="this.form.submit()" class="p-2 border rounded-lg">
                <option value="">Semua Properti</option>
                @foreach($properties as $property)
                    <option value="{{ $property->id }}" {{ $propertyId == $property->id ? 'selected' : '' }}>
                        {{ $property->name }}
                    </option>
                @endforeach
            </select>
            <a href="{{ route('property_units.index') }}" class="btn btn-secondary me-2">Back to List</a>
        </div>
    </form>

    {{-- INFO STATUS --}}
    <div class="flex items-center gap-6 mb-6">
        <span class="flex items-center gap-2">
            <span class="w-4 h-4 bg-green-500 inline-block rounded"></span> Kosong
        </span>
        <span class="flex items-center gap-2">
            <span class="w-4 h-4 bg-red-500 inline-block rounded"></span> Terisi
        </span>
        <span class="flex items-center gap-2">
            <span class="w-4 h-4 bg-gray-400 inline-block rounded"></span> Nonaktif
        </span>
    </div>

    {{-- GRID KAMAR --}}
    @if($units->count() > 0)
        <div class="grid grid-cols-6 gap-4">
            @foreach($units as $unit)
                <button 
                    class="p-4 rounded-xl shadow-md font-bold transition relative
                    {{ $unit->status === 'occupied' ? 'bg-red-500 cursor-not-allowed text-white' : 
                       ($unit->status === 'available' ? 'bg-green-500 hover:bg-green-600 text-white' : 'bg-gray-400 cursor-not-allowed text-white') }}"
                    onclick="bookUnit({{ $unit->id }})"
                    {{ $unit->status !== 'available' ? 'disabled' : '' }}
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


<style>
    /* Styling kotak kamar */
    .room-box {
        width: 100%;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        border: 2px solid #e5e7eb;
        transition: all 0.2s ease-in-out;
    }

    .room-box:hover {
        transform: scale(1.05);
        border-color: #4ade80;
    }

    /* Warna status */
    .bg-green-500 {
        background-color: #22c55e;
    }

    .bg-red-500 {
        background-color: #ef4444;
    }

    .bg-gray-400 {
        background-color: #9ca3af;
    }
</style>

<script>
    function bookUnit(unitId) {
        if(!confirm("Apakah kamu yakin ingin booking kamar ini?")) return;

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
            if(data.error){
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


