<x-app-layout>

    {{-- HEADER --}}
    <div class="w-full bg-white py-5 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Create Property Unit</h1>
                <p class="text-sm text-gray-500">Tambahkan unit baru untuk property.</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('property_units.index') }}"
                    class="px-3 py-1.5 border border-gray-300 text-gray-600 rounded-md text-sm hover:bg-gray-100">
                    ← Back
                </a>
            </div>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="max-w-4xl mx-auto px-6 mt-8">

        {{-- CARD --}}
        <div class="bg-white border rounded-lg shadow-sm p-6">

            {{-- ERROR LIST --}}
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 border border-red-300 text-red-700 rounded-lg text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('property_units.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Property --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Property</label>
                    <select name="property_id"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500 @error('property_id') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Property --</option>
                        @foreach($properties as $property)
                            <option value="{{ $property->id }}"
                                {{ old('property_id') == $property->id ? 'selected' : '' }}>
                                {{ $property->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Unit Code --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Unit Code</label>
                    <input type="text" name="unit_code"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm @error('unit_code') border-red-500 @enderror"
                        value="{{ old('unit_code') }}" required>
                </div>

                {{-- Unit Name --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Unit Name</label>
                    <input type="text" name="name"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}" required>
                </div>

                {{-- Type --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Type</label>
                    <input type="text" name="type"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm @error('type') border-red-500 @enderror"
                        value="{{ old('type', 'standard') }}">
                </div>

                {{-- Size / Area --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Size (m²)</label>
                    <input type="number" step="0.01" name="area"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm @error('area') border-red-500 @enderror"
                        value="{{ old('area') }}">
                </div>

                {{-- Monthly Price --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Monthly Price</label>
                    <input type="number" step="0.01" name="monthly_price"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm @error('monthly_price') border-red-500 @enderror"
                        value="{{ old('monthly_price') }}">
                </div>

                {{-- Deposit Amount --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Deposit Amount</label>
                    <input type="number" step="0.01" name="deposit_amount"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm @error('deposit_amount') border-red-500 @enderror"
                        value="{{ old('deposit_amount') }}">
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror"
                        required>
                        <option value="available" {{ old('status','available') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>Occupied</option>
                        <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>

                {{-- Notes --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Notes</label>
                    <textarea name="notes" rows="3"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                </div>

                {{-- BUTTONS --}}
                <div class="flex items-center gap-3 mt-6">
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 shadow">
                        Create Unit
                    </button>

                    <a href="{{ route('property_units.index') }}"
                        class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>
