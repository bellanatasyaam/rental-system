<x-app-layout>

    {{-- HEADER --}}
    <div class="w-full bg-white py-5 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <div>
                <h1 class="text-2xl font-semibold text-gray-800">Create Property</h1>
                <p class="text-sm text-gray-500">Tambahkan data property baru ke sistem.</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="{{ route('properties.index') }}"
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

            <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- CODE --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Code</label>
                    <input type="text" name="code"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm @error('code') border-red-500 @enderror"
                        value="{{ old('code') }}" required>
                </div>

                {{-- NAME --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" name="name"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm @error('name') border-red-500 @enderror"
                        value="{{ old('name') }}" required>
                </div>

                {{-- ADDRESS --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm @error('address') border-red-500 @enderror"
                        value="{{ old('address') }}" required>
                </div>

                {{-- TYPE --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Type</label>
                    <input type="text" name="type"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm @error('type') border-red-500 @enderror"
                        value="{{ old('type') }}" required>
                </div>

                {{-- TOTAL AREA --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Total Area (m²)</label>
                    <input type="number" step="0.01" name="total_area"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm @error('total_area') border-red-500 @enderror"
                        value="{{ old('total_area') }}" required>
                </div>

                {{-- DESCRIPTION --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm @error('description') border-red-500 @enderror"
                        rows="3">{{ old('description') }}</textarea>
                </div>

                {{-- IMAGE JSON --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Image (JSON Format)</label>
                    <textarea name="image"
                        class="mt-1 w-full border rounded-lg p-2.5 text-sm @error('image') border-red-500 @enderror"
                        rows="3">{{ old('image') }}</textarea>
                </div>

                {{-- ACTIVE? --}}
                <div class="mb-4 flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" id="is_active"
                        class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                        {{ old('is_active') ? 'checked' : '' }}>
                    <label for="is_active" class="text-sm font-medium text-gray-700">Active?</label>
                </div>

                {{-- BUTTONS --}}
                <div class="flex items-center gap-3 mt-6">
                    <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 shadow">
                        Create Property
                    </button>

                    <a href="{{ route('properties.index') }}"
                        class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm hover:bg-gray-300">
                        Cancel
                    </a>
                </div>

            </form>

        </div>
    </div>

</x-app-layout>
