@extends('admin.layouts.app')

@section('title', 'Edit Contract')

@section('content')
<div class="flex justify-center items-center w-full px-6 py-6">
    <div class="w-11/12 md:w-10/12 lg:w-8/12">
        <div class="bg-white rounded-xl shadow-lg border border-gray-200">
            
            {{-- Header --}}
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-500 rounded-t-xl">
                <h1 class="text-xl font-bold text-black">Edit Contract</h1>
            </div>

            {{-- Form --}}
            <form action="{{ route('contracts.update', $contract->id) }}" method="POST" class="px-6 py-6 space-y-5">
                @csrf
                @method('PUT')

                {{-- Tenant --}}
                <div>
                    <label class="block font-semibold mb-1">Select Tenant</label>
                    <select name="tenant_id" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        @foreach($tenants as $tenant)
                            <option value="{{ $tenant->id }}" {{ $contract->tenant_id == $tenant->id ? 'selected' : '' }}>
                                {{ $tenant->name }} - {{ $tenant->phone }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Property Unit --}}
                <div>
                    <label class="block font-semibold mb-1">Select Property Unit</label>
                    <select name="property_unit_id" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}" {{ $contract->property_unit_id == $unit->id ? 'selected' : '' }}>
                                {{ $unit->unit_code }} - {{ $unit->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Start Date --}}
                <div>
                    <label class="block font-semibold mb-1">Start Date</label>
                    <input type="date" name="start_date" value="{{ $contract->start_date }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm" required>
                </div>

                {{-- End Date --}}
                <div>
                    <label class="block font-semibold mb-1">End Date</label>
                    <input type="date" name="end_date" value="{{ $contract->end_date }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm" required>
                </div>

                {{-- Monthly Rent --}}
                <div>
                    <label class="block font-semibold mb-1">Monthly Rent</label>
                    <input type="number" name="monthly_rent" value="{{ $contract->monthly_rent }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm" required>
                </div>

                {{-- Deposit --}}
                <div>
                    <label class="block font-semibold mb-1">Deposit</label>
                    <input type="number" step="0.01" name="deposit_amount"
                           value="{{ old('deposit_amount', $contract->deposit_amount) }}"
                           class="w-full border-gray-300 rounded-lg shadow-sm" required>
                </div>

                {{-- Status --}}
                <div>
                    <label class="block font-semibold mb-1">Status</label>
                    <select name="status" class="w-full border-gray-300 rounded-lg shadow-sm">
                        <option value="active" {{ $contract->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="ended" {{ $contract->status === 'ended' ? 'selected' : '' }}>Ended</option>
                    </select>
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('contracts.index') }}" 
                       class="bg-gray-500 hover:bg-gray-400 text-white px-4 py-2 rounded-lg shadow">
                       Cancel
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-500 text-black px-4 py-2 rounded-lg shadow" style ="margin-left: 20px;">
                        Update Contract
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
