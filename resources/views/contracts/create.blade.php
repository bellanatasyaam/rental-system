@extends('layouts.app')

@section('title', 'Add Contract')

@section('content')
<div class="max-w-3xl mx-auto mt-6">
    <div class="bg-white shadow-md rounded-xl border border-gray-200">
        <!-- HEADER -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-500 rounded-t-xl">
            <h1 class="text-xl font-bold text-white">Add New Contract</h1>
        </div>

        <div class="p-6">
            <form action="{{ route('contracts.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Property Unit --}}
                <div>
                    <label class="block font-semibold text-gray-700">Select Property Unit <span class="text-red-500">*</span></label>
                    <select name="property_unit_id" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                        @error('property_unit_id') border-red-500 @enderror" required>
                        <option value="">-- Choose Unit --</option>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}" {{ old('property_unit_id') == $unit->id ? 'selected' : '' }}>
                                {{ $unit->unit_code }} - {{ $unit->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('property_unit_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tenant --}}
                <div>
                    <label class="block font-semibold text-gray-700">Select Tenant <span class="text-red-500">*</span></label>
                    <select name="tenant_id" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 
                        @error('tenant_id') border-red-500 @enderror" required>
                        <option value="">-- Choose Tenant --</option>
                        @foreach($tenants as $tenant)
                            <option value="{{ $tenant->id }}" {{ old('tenant_id') == $tenant->id ? 'selected' : '' }}>
                                {{ $tenant->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('tenant_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Payment Due Day --}}
                <div>
                    <label class="block font-semibold text-gray-700">Payment Due Day <span class="text-red-500">*</span></label>
                    <input type="number" name="payment_due_day" min="1" max="31" value="{{ old('payment_due_day') }}"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('payment_due_day') border-red-500 @enderror" required>
                    @error('payment_due_day')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Start Date --}}
                <div>
                    <label class="block font-semibold text-gray-700">Start Date <span class="text-red-500">*</span></label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('start_date') border-red-500 @enderror" required>
                    @error('start_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- End Date --}}
                <div>
                    <label class="block font-semibold text-gray-700">End Date <span class="text-red-500">*</span></label>
                    <input type="date" name="end_date" value="{{ old('end_date') }}"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('end_date') border-red-500 @enderror" required>
                    @error('end_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Monthly Rent --}}
                <div>
                    <label class="block font-semibold text-gray-700">Monthly Rent <span class="text-red-500">*</span></label>
                    <input type="number" name="monthly_rent" value="{{ old('monthly_rent') }}"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('monthly_rent') border-red-500 @enderror" required>
                    @error('monthly_rent')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Deposit --}}
                <div>
                    <label class="block font-semibold text-gray-700">Deposit <span class="text-red-500">*</span></label>
                    <input type="number" step="0.01" name="deposit_amount" value="{{ old('deposit_amount') }}"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('deposit_amount') border-red-500 @enderror" required>
                    @error('deposit_amount')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div>
                    <label class="block font-semibold text-gray-700">Status</label>
                    <select name="status" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="ended" {{ old('status') == 'ended' ? 'selected' : '' }}>Ended</option>
                    </select>
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('contracts.index') }}" class="px-5 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg">Cancel</a>
                    <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-black rounded-lg" style="margin-left: 20px;">Save Contract</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('select').select2();
    });
</script>
@endpush
