@extends('admin.layouts.app')

@section('title', 'Edit Property Unit')

@section('content')
<div class="flex justify-center items-center w-full px-6 py-6">
    <div class="w-11/12 md:w-10/12 lg:w-8/12">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
            
            {{-- HEADER --}}
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-500 rounded-t-xl">
                <h1 class="text-xl font-bold text-black">Edit Property Unit</h1>
            </div>

            <form action="{{ route('property_units.update', $propertyUnit->id) }}" 
                  method="POST" class="px-6 py-6 space-y-5">
                @csrf
                @method('PUT')

                {{-- SELECT PROPERTY --}}
                <div>
                    <label class="block font-semibold mb-1">Property</label>
                    <select name="property_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                        @foreach($properties as $property)
                            <option value="{{ $property->id }}"
                                {{ old('property_id', $propertyUnit->property_id) == $property->id ? 'selected' : '' }}>
                                {{ $property->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- UNIT CODE --}}
                <div>
                    <label class="block font-semibold mb-1">Unit Code</label>
                    <input type="text" name="unit_code" 
                           value="{{ old('unit_code', $propertyUnit->unit_code) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                {{-- UNIT NAME --}}
                <div>
                    <label class="block font-semibold mb-1">Unit Name</label>
                    <input type="text" name="name" 
                           value="{{ old('name', $propertyUnit->name) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                {{-- SIZE --}}
                <div>
                    <label class="block font-semibold mb-1">Size (m²)</label>
                    <input type="number" step="0.01" name="area" 
                           value="{{ old('area', $propertyUnit->area) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                {{-- PRICE --}}
                <div>
                    <label class="block font-semibold mb-1">Monthly Price</label>
                    <input type="number" step="0.01" name="monthly_price"
                           value="{{ old('monthly_price', $propertyUnit->monthly_price) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                {{-- DEPOSIT --}}
                <div>
                    <label class="block font-semibold mb-1">Deposit Amount</label>
                    <input type="number" step="0.01" name="deposit_amount"
                           value="{{ old('deposit_amount', $propertyUnit->deposit_amount) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm">
                </div>

                {{-- STATUS --}}
                <div>
                    <label class="block font-semibold mb-1">Status</label>
                    <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm">
                        <option value="available"   {{ $propertyUnit->status == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="occupied"    {{ $propertyUnit->status == 'occupied' ? 'selected' : '' }}>Occupied</option>
                        <option value="maintenance" {{ $propertyUnit->status == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>

                {{-- DESCRIPTION --}}
                <div>
                    <label class="block font-semibold mb-1">Description</label>
                    <textarea name="description" rows="3"
                        class="w-full border-gray-300 rounded-lg shadow-sm">{{ old('description', $propertyUnit->description) }}</textarea>
                </div>

                {{-- BUTTONS --}}
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('property_units.index') }}" 
                        class="bg-gray-500 hover:bg-gray-400 text-white px-4 py-2 rounded-lg shadow">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg shadow">
                        Update Unit
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
