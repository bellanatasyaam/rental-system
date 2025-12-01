<x-app-layout>

    {{-- HEADER --}}
    <div class="w-full bg-white py-5 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Add Facility Usage</h1>
                <p class="text-sm text-gray-500">Tambahkan penggunaan fasilitas untuk unit.</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('facility_usages.index') }}"
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

            <form action="{{ route('facility_usages.store') }}" method="POST">
                @csrf

                {{-- Unit Facility --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Unit Facility</label>
                    <select name="property_unit_facility_id"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                        @foreach($unitFacilities as $facility)
                            <option value="{{ $facility->id }}">
                                {{ $facility->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Contract --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Contract</label>
                    <select name="contract_id"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                        @foreach($contracts as $contract)
                            <option value="{{ $contract->id }}">
                                Contract #{{ $contract->id }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Period Start --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Period Start</label>
                    <input type="date" name="period_start"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                {{-- Period End --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Period End</label>
                    <input type="date" name="period_end"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                {{-- Usage Value --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Usage Value</label>
                    <input type="number" step="0.01" name="usage_value"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                {{-- Rate --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Rate</label>
                    <input type="number" step="0.01" name="rate"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                {{-- Total Cost --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Total Cost</label>
                    <input type="number" step="0.01" name="total_cost"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                </div>

                {{-- Invoiced --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Invoiced</label>
                    <select name="invoiced"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500"
                        required>
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>

                {{-- BUTTONS --}}
                <div class="flex items-center gap-3 mt-6">
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 shadow">
                        Save Usage
                    </button>

                    <a href="{{ route('facility_usages.index') }}"
                        class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>
