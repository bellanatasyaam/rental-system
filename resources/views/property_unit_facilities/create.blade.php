<x-app-layout>

    {{-- HEADER --}}
    <div class="w-full bg-white py-5 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Add Property Unit Facility</h1>
                <p class="text-sm text-gray-500">Tambahkan fasilitas untuk property unit.</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('property_unit_facilities.index') }}"
                    class="px-3 py-1.5 border border-gray-300 text-gray-600 rounded-md text-sm hover:bg-gray-100">
                    ← Back
                </a>
            </div>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="max-w-5xl mx-auto px-6 mt-8">

        {{-- CARD --}}
        <div class="bg-white border rounded-lg shadow-sm p-6">

            <form action="{{ route('property_unit_facilities.store') }}" method="POST">
                @csrf

                {{-- Property Unit --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Property Unit</label>
                    <select name="property_unit_id"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="">-- Pilih Property Unit --</option>
                        @foreach($propertyUnits as $unit)
                            <option value="{{ $unit->id }}"
                                {{ old('property_unit_id') == $unit->id ? 'selected' : '' }}>
                                {{ $unit->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Facility --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Facility</label>
                    <select name="facility_id"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="">-- Pilih Fasilitas --</option>
                        @foreach($facilities as $facility)
                            <option value="{{ $facility->id }}"
                                {{ old('facility_id') == $facility->id ? 'selected' : '' }}>
                                {{ $facility->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Settings (JSON) --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Settings (Optional)</label>
                    <textarea name="settings" rows="3"
                        placeholder='Contoh: {"capacity": 2, "extra_bed": true}'
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500">{{ old('settings') }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Isi dalam format JSON jika diperlukan.</p>
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                    </select>
                </div>

                {{-- BUTTONS --}}
                <div class="flex items-center gap-3 mt-6">
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 shadow">
                        Create Facility
                    </button>

                    <a href="{{ route('property_unit_facilities.index') }}"
                        class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>
