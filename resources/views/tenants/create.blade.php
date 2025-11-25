{{-- resources/views/tenants/create.blade.php --}}
<x-app-layout>

    {{-- HEADER --}}
    <div class="w-full bg-white py-5 shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">

            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Tambah Tenant</h1>
                <p class="text-sm text-gray-500">Tambahkan data penghuni / penyewa baru.</p>
            </div>

            <a href="{{ route('tenants.index') }}"
               class="px-3 py-1.5 border border-gray-300 rounded-md text-sm text-gray-600 hover:bg-gray-100">
                ← Back
            </a>

        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="w-full px-6 mt-8">

        {{-- ERROR ALERT --}}
        @if($errors->any())
            <div class="bg-red-500 text-white p-3 rounded-md shadow mb-4">
                <ul class="list-disc ml-5 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- CARD --}}
        <div class="bg-white border rounded-lg shadow-sm px-8 py-6">

            <form action="{{ route('tenants.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- NAMA --}}
                <div>
                    <label class="block font-semibold mb-1">Nama <span class="text-red-500">*</span></label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>

                {{-- GENDER --}}
                <div>
                    <label class="block font-semibold mb-1">Gender</label>
                    <select name="gender" class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Pilih Gender --</option>
                        <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                {{-- AGAMA --}}
                <div>
                    <label class="block font-semibold mb-1">Agama</label>
                    <select name="religion" class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Pilih Agama --</option>
                        <option value="Islam" {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                        <option value="Kristen" {{ old('religion') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                        <option value="Katolik" {{ old('religion') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                        <option value="Hindu" {{ old('religion') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                        <option value="Buddha" {{ old('religion') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                        <option value="Konghucu" {{ old('religion') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                    </select>
                </div>

                {{-- PEKERJAAN --}}
                <div>
                    <label class="block font-semibold mb-1">Pekerjaan</label>
                    <input type="text" name="occupation" value="{{ old('occupation') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- STATUS --}}
                <div>
                    <label class="block font-semibold mb-1">Status Perkawinan</label>
                    <select name="marital_status" class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">-- Pilih Status --</option>
                        <option value="Belum Kawin" {{ old('marital_status') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                        <option value="Menikah" {{ old('marital_status') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                        <option value="Cerai" {{ old('marital_status') == 'Cerai' ? 'selected' : '' }}>Cerai</option>
                    </select>
                </div>

                {{-- ALAMAT --}}
                <div>
                    <label class="block font-semibold mb-1">Alamat Domisili</label>
                    <textarea name="address" rows="3"
                        class="w-full border-gray-300 rounded-md shadow-sm">{{ old('address') }}</textarea>
                </div>

                {{-- HP --}}
                <div>
                    <label class="block font-semibold mb-1">No. Telp / HP</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- DARURAT --}}
                <div>
                    <label class="block font-semibold mb-1">Kontak Darurat</label>
                    <input type="text" name="emergency_contact" value="{{ old('emergency_contact') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- EMAIL --}}
                <div>
                    <label class="block font-semibold mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- TANGGAL --}}
                <div>
                    <label class="block font-semibold mb-1">Tanggal Mulai Huni/Sewa</label>
                    <input type="date" name="rental_start_date"
                        value="{{ old('rental_start_date') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- KTP --}}
                <div>
                    <label class="block font-semibold mb-1">No. KTP</label>
                    <input type="text" name="id_card_number" value="{{ old('id_card_number') }}"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                </div>

                {{-- BUTTON --}}
                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('tenants.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-400">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Tambah Tenant
                    </button>
                </div>

            </form>

        </div>

    </div>

</x-app-layout>
