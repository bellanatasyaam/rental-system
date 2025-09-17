@extends('admin.layouts.app')

@section('title', 'Edit Tenant')

@section('content')
<div class="flex justify-center items-center w-full px-6 py-6">
    <div class="w-11/12 md:w-10/12 lg:w-8/12">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
            
            {{-- Header --}}
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-500 rounded-t-xl">
                <h1 class="text-xl font-bold text-black">Edit Tenant</h1>
            </div>

            {{-- Form --}}
            <form action="{{ route('tenants.update', $tenant->id) }}" method="POST" class="px-6 py-6 space-y-5">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div>
                    <label class="block font-semibold mb-1">Nama <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name', $tenant->name) }}" 
                           class="w-full border-gray-300 rounded-lg shadow-sm @error('name') border-red-500 @enderror" required>
                    @error('name') 
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                    @enderror
                </div>

                {{-- Gender --}}
                <div>
                    <label class="block font-semibold mb-1">Gender</label>
                    <select name="gender" class="w-full border-gray-300 rounded-lg shadow-sm">
                        <option value="">-- Pilih Gender --</option>
                        <option value="Laki-laki" {{ $tenant->gender == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $tenant->gender == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                {{-- Agama --}}
                <div>
                    <label class="block font-semibold mb-1">Agama</label>
                    <select name="religion" class="w-full border-gray-300 rounded-lg shadow-sm">
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
                <div>
                    <label class="block font-semibold mb-1">Pekerjaan</label>
                    <input type="text" name="occupation" value="{{ old('occupation', $tenant->occupation) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                {{-- Status Perkawinan --}}
                <div>
                    <label class="block font-semibold mb-1">Status Perkawinan</label>
                    <select name="marital_status" class="w-full border-gray-300 rounded-lg shadow-sm">
                        <option value="">-- Pilih Status --</option>
                        <option value="Belum Kawin" {{ $tenant->marital_status == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                        <option value="Menikah" {{ $tenant->marital_status == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                        <option value="Cerai" {{ $tenant->marital_status == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                    </select>
                </div>

                {{-- Alamat --}}
                <div>
                    <label class="block font-semibold mb-1">Alamat Rumah Asal</label>
                    <textarea name="origin_address" rows="3"
                              class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('origin_address', $tenant->origin_address) }}</textarea>
                </div>

                {{-- No HP --}}
                <div>
                    <label class="block font-semibold mb-1">No. Telp / HP</label>
                    <input type="text" name="phone" value="{{ old('phone', $tenant->phone) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                {{-- Kontak Darurat --}}
                <div>
                    <label class="block font-semibold mb-1">Kontak Darurat (Nama & Hubungan)</label>
                    <input type="text" name="emergency_contact" value="{{ old('emergency_contact', $tenant->emergency_contact) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                {{-- Email --}}
                <div>
                    <label class="block font-semibold mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $tenant->email) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                {{-- Tanggal Mulai --}}
                <div>
                    <label class="block font-semibold mb-1">Tanggal Mulai Huni/Sewa</label>
                    <input type="date" name="rental_start_date" value="{{ old('rental_start_date', $tenant->rental_start_date) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                {{-- KTP --}}
                <div>
                    <label class="block font-semibold mb-1">No. KTP</label>
                    <input type="text" name="id_card_number" value="{{ old('id_card_number', $tenant->id_card_number) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('tenants.index') }}" 
                       class="bg-gray-500 hover:bg-gray-400 text-white px-4 py-2 rounded-lg shadow">
                       Cancel
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-500 text-black px-4 py-2 rounded-lg shadow" style="margin-left: 20px;">
                        Update Tenant
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
