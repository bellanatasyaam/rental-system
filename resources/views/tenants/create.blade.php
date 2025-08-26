@extends('layouts.app')

@section('title', 'Tambah Tenant')

@section('content')
<div class="container">
    <h3 class="mb-3">Tambah Tenant Baru</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tenants.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="gender">Gender</label>
            <select name="gender" id="gender" class="form-control" required>
                <option value="">-- Pilih Gender --</option>
                <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="religion">Agama</label>
            <select name="religion" id="religion" class="form-control">
                <option value="">-- Pilih Agama --</option>
                <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ old('religion') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ old('religion') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Buddha" {{ old('religion') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                <option value="Konghucu" {{ old('religion') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="occupation" class="form-label">Pekerjaan</label>
            <input type="text" name="occupation" id="occupation" class="form-control" value="{{ old('occupation') }}">
        </div>

        <div class="mb-3">
            <label for="marital_status" class="form-label">Status Perkawinan</label>
            <select name="marital_status" id="marital_status" class="form-control">
                <option value="">-- Pilih Status --</option>
                <option value="Belum Kawin" {{ old('marital_status') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                <option value="Menikah" {{ old('marital_status') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                <option value="Cerai" {{ old('marital_status') == 'Cerai' ? 'selected' : '' }}>Cerai</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="origin_address" class="form-label">Alamat Rumah Asal</label>
            <textarea name="origin_address" id="origin_address" class="form-control" rows="2">{{ old('origin_address') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">No. Telp / HP</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label for="emergency_contact" class="form-label">Kontak Darurat (Nama & Hubungan)</label>
            <input type="text" name="emergency_contact" id="emergency_contact" class="form-control" value="{{ old('emergency_contact') }}">
        </div>

        <div class="mb-3">
            <label for="rental_start_date" class="form-label">Tanggal Mulai Huni/Sewa</label>
            <input type="date" name="rental_start_date" id="rental_start_date" class="form-control" value="{{ old('rental_start_date') }}">
        </div>

        <div class="mb-3">
            <label for="id_card_number" class="form-label">No. KTP</label>
            <input type="text" name="id_card_number" id="id_card_number" class="form-control" value="{{ old('id_card_number') }}">
        </div>

        <div class="mb-3">
            <label for="address" class="form-label">Alamat Domisili Saat Ini</label>
            <textarea name="address" id="address" class="form-control" rows="2">{{ old('address') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('tenants.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
