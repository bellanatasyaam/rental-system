<x-app-layout>

    {{-- HEADER --}}
    <div class="w-full bg-white py-5 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Add Company</h1>
                <p class="text-sm text-gray-500">Tambahkan data perusahaan baru.</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('companies.index') }}"
                    class="px-3 py-1.5 border border-gray-300 text-gray-600 rounded-md text-sm hover:bg-gray-100">
                    ← Back
                </a>
            </div>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="max-w-3xl mx-auto px-6 mt-8">

        {{-- CARD --}}
        <div class="bg-white border rounded-lg shadow-sm p-6">

            <form action="{{ route('companies.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Company Name --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Company Name</label>
                    <input type="text" name="name"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500"
                        value="{{ old('name') }}" required>
                </div>

                {{-- Company Address --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Company Address</label>
                    <textarea name="address" rows="3"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm focus:ring-blue-500 focus:border-blue-500">{{ old('address') }}</textarea>
                </div>

                {{-- Extra Form Fields --}}
                @include('companies.form', ['company' => null])

                {{-- BUTTONS --}}
                <div class="flex items-center gap-3 mt-6">
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 shadow">
                        Save Company
                    </button>

                    <a href="{{ route('companies.index') }}"
                        class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>
