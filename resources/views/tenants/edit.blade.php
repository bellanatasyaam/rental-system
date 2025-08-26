@extends('layouts.app')

@section('title','Edit Tenant')

@section('content')
<div class="card">
    <div class="card-header">Edit Tenant</div>
    <div class="card-body">
        <form action="{{ route('tenants.update', $tenant->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="name">Nama</label>
                <input type="text" name="name" value="{{ $tenant->name }}" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="gender">Gender</label>
                <select name="gender" id="gender" class="form-control" required>
                    <option value="">-- Pilih Gender --</option>
                    <option value="Laki-laki" {{ $tenant->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $tenant->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="religion">Agama</label>
                <select name="religion" id="religion" class="form-control">
                    <option value="">-- Pilih Agama --</option>
                    <option value="Islam" {{ $tenant->religion == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ $tenant->religion == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ $tenant->religion == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ $tenant->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ $tenant->religion == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ $tenant->religion == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="occupation">Pekerjaan</label>
                <input type="text" name="occupation" value="{{ $tenant->occupation }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="marital_status">Status Perkawinan</label>
                <select name="marital_status" id="marital_status" class="form-control">
                    <option value="">-- Pilih Status --</option>
                    <option value="Belum Kawin" {{ $tenant->marital_status == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                    <option value="Menikah" {{ $tenant->marital_status == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                    <option value="Cerai" {{ $tenant->marital_status == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="origin_address">Alamat Rumah Asal</label>
                <textarea name="origin_address" class="form-control" rows="2">{{ $tenant->origin_address }}</textarea>
            </div>

            <div class="form-group mb-3">
                <label for="phone">No. Telp / HP</label>
                <input type="text" name="phone" value="{{ $tenant->phone }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="emergency_contact">Kontak Darurat (Nama & Hubungan)</label>
                <input type="text" name="emergency_contact" value="{{ $tenant->emergency_contact }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="rental_start_date">Tanggal Mulai Huni/Sewa</label>
                <input type="date" name="rental_start_date" value="{{ $tenant->rental_start_date }}" class="form-control">
            </div>

            <div class="form-group mb-3">
                <label for="id_card_number">No. KTP</label>
                <input type="text" name="id_card_number" value="{{ $tenant->id_card_number }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
