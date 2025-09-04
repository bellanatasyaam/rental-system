@extends('layouts.app')

@section('title', 'Edit Tenant')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 85vh;">
    <div class="col-lg-6 col-md-8 col-sm-10">
        <div class="card shadow border-0 rounded-4">
            <div class="card-header bg-primary text-white text-center rounded-top-4">
                <h5 class="mb-0">Edit Data Tenant</h5>
            </div>
            <div class="card-body px-4 py-4">
                <form action="{{ route('tenants.update', $tenant->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama</label>
                        <input type="text" name="name" value="{{ $tenant->name }}" class="form-control" required>
                    </div>

                    {{-- Gender --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Gender</label>
                        <select name="gender" class="form-select" required>
                            <option value="">-- Pilih Gender --</option>
                            <option value="Laki-laki" {{ $tenant->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ $tenant->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>

                    {{-- Agama --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Agama</label>
                        <select name="religion" class="form-select">
                            <option value="">-- Pilih Agama --</option>
                            <option value="Islam" {{ $tenant->religion == 'Islam' ? 'selected' : '' }}>Islam</option>
                            <option value="Kristen" {{ $tenant->religion == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                            <option value="Katolik" {{ $tenant->religion == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                            <option value="Hindu" {{ $tenant->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                            <option value="Buddha" {{ $tenant->religion == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                            <option value="Konghucu" {{ $tenant->religion == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                        </select>
                    </div>

                    {{-- Pekerjaan --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pekerjaan</label>
                        <input type="text" name="occupation" value="{{ $tenant->occupation }}" class="form-control">
                    </div>

                    {{-- Status Perkawinan --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status Perkawinan</label>
                        <select name="marital_status" class="form-select">
                            <option value="">-- Pilih Status --</option>
                            <option value="Belum Kawin" {{ $tenant->marital_status == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                            <option value="Menikah" {{ $tenant->marital_status == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                            <option value="Cerai" {{ $tenant->marital_status == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                        </select>
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat Rumah Asal</label>
                        <textarea name="origin_address" class="form-control" rows="3">{{ $tenant->origin_address }}</textarea>
                    </div>

                    {{-- No HP --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">No. Telp / HP</label>
                        <input type="text" name="phone" value="{{ $tenant->phone }}" class="form-control">
                    </div>

                    {{-- Kontak Darurat --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kontak Darurat (Nama & Hubungan)</label>
                        <input type="text" name="emergency_contact" value="{{ $tenant->emergency_contact }}" class="form-control">
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" value="{{ $tenant->email }}" class="form-control">
                    </div>

                    {{-- Tanggal Mulai --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tanggal Mulai Huni/Sewa</label>
                        <input type="date" name="rental_start_date" value="{{ $tenant->rental_start_date }}" class="form-control">
                    </div>

                    {{-- KTP --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold">No. KTP</label>
                        <input type="text" name="id_card_number" value="{{ $tenant->id_card_number }}" class="form-control">
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tenants.index') }}" class="btn btn-secondary px-4">Kembali</a>
                        <button type="submit" class="btn btn-success px-4">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
