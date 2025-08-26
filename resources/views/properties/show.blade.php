@extends('layouts.app') {{-- Kalau pakai layout utama --}}
@section('content')
<div class="container">
    <h1>Detail Property: {{ $property->name }}</h1>
    <p><strong>Kode:</strong> {{ $property->code }}</p>
    <p><strong>Alamat:</strong> {{ $property->address }}</p>
    <p><strong>Tipe:</strong> {{ $property->type }}</p>
    <p><strong>Total Area:</strong> {{ $property->total_area }} m²</p>
    <p><strong>Status:</strong> {{ $property->is_active ? 'Aktif' : 'Nonaktif' }}</p>

    <hr>

    <h3>Daftar Units</h3>
    @if($property->units->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode Unit</th>
                    <th>Nama</th>
                    <th>Luas (m²)</th>
                    <th>Harga / Bulan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($property->units as $unit)
                <tr>
                    <td>{{ $unit->unit_code }}</td>
                    <td>{{ $unit->name }}</td>
                    <td>{{ $unit->area }}</td>
                    <td>Rp {{ number_format($unit->monthly_price, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($unit->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada unit untuk property ini.</p>
    @endif
</div>

<tbody>
    @foreach($property->units as $unit)
    <tr>
        <td>{{ $unit->unit_code }}</td>
        <td>{{ $unit->name }}</td>
        <td>{{ $unit->area }} m²</td>
        <td>Rp {{ number_format($unit->monthly_price, 0, ',', '.') }}</td>
        <td>{{ ucfirst($unit->status) }}</td>
        <td>
            @if($unit->contract)
                <a href="{{ route('contracts.show', $unit->contract->id) }}" class="btn btn-sm btn-primary">
                    Lihat Kontrak
                </a>
            @else
                <a href="{{ route('contracts.create', ['unit_id' => $unit->id]) }}" class="btn btn-sm btn-success">
                    Buat Kontrak
                </a>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>
@endsection
