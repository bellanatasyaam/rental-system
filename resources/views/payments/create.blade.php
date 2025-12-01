<x-app-layout>

    {{-- HEADER --}}
    <div class="w-full bg-white py-5 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Create Payment</h1>
                <p class="text-sm text-gray-500">Tambahkan pembayaran baru untuk kontrak.</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('payments.index') }}"
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

            <form action="{{ route('payments.store') }}" method="POST">
                @csrf

                {{-- Contract --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Contract</label>
                    <select name="contract_id"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500 @error('contract_id') border-red-500 @enderror"
                        required>
                        <option value="">-- Select Contract --</option>
                        @foreach($contracts as $contract)
                            <option value="{{ $contract->id }}"
                                {{ old('contract_id') == $contract->id ? 'selected' : '' }}>
                                {{ $contract->tenant_name }} - {{ $contract->unit->unit_code ?? '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Payment Date --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Payment Date</label>
                    <input type="date" name="payment_date"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500 @error('payment_date') border-red-500 @enderror"
                        value="{{ old('payment_date') }}" required>
                </div>

                {{-- Amount --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Amount</label>
                    <input type="number" name="amount"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500 @error('amount') border-red-500 @enderror"
                        value="{{ old('amount') }}" required>
                </div>

                {{-- Payment Method --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <select name="method"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500 @error('method') border-red-500 @enderror"
                        required>
                        <option value="cash" {{ old('method') == 'cash' ? 'selected' : '' }}>Cash</option>
                        <option value="transfer" {{ old('method') == 'transfer' ? 'selected' : '' }}>Bank Transfer</option>
                    </select>
                </div>

                {{-- Status --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror"
                        required>
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ old('status') == 'failed' ? 'selected' : '' }}>Failed</option>
                    </select>
                </div>

                {{-- BUTTONS --}}
                <div class="flex items-center gap-3 mt-6">
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 shadow">
                        Save Payment
                    </button>

                    <a href="{{ route('payments.index') }}"
                        class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>
