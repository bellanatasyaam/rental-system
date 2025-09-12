@extends('layouts.app')

@section('title', 'Edit Facility')

@section('content')
<div class="max-w-4xl mx-auto mt-6">
    <div class="bg-white shadow-md rounded-xl border border-gray-200">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-indigo-600 to-blue-500 rounded-t-xl">
            <h1 class="text-xl font-bold text-white">Edit Facility</h1>
        </div>

        <!-- Body -->
        <div class="p-6">
            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded-lg mb-4">
                    <p class="font-semibold">Please fix the following errors:</p>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('facilities.update', $facility->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block font-semibold text-gray-700">Name <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name"
                            value="{{ old('name', $facility->name) }}"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                            required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- AC -->
                    <div>
                        <label for="ac" class="block font-semibold text-gray-700">AC</label>
                        <select id="ac" name="ac"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="AC" {{ old('ac', $facility->ac) == 'AC' ? 'selected' : '' }}>AC</option>
                            <option value="No AC" {{ old('ac', $facility->ac) == 'No AC' ? 'selected' : '' }}>No AC</option>
                        </select>
                    </div>

                    <!-- Room -->
                    <div>
                        <label for="room" class="block font-semibold text-gray-700">Room</label>
                        <input type="text" id="room" name="room"
                            value="{{ old('room', $facility->room) }}"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Floor -->
                    <div>
                        <label for="floor" class="block font-semibold text-gray-700">Floor</label>
                        <input type="text" id="floor" name="floor"
                            value="{{ old('floor', $facility->floor) }}"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Type -->
                    <div>
                        <label for="type" class="block font-semibold text-gray-700">Type <span class="text-red-500">*</span></label>
                        <input type="text" id="type" name="type"
                            value="{{ old('type', $facility->type) }}"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('type') border-red-500 @enderror"
                            required>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Cost -->
                    <div>
                        <label for="cost" class="block font-semibold text-gray-700">Cost <span class="text-red-500">*</span></label>
                        <input type="number" step="0.01" id="cost" name="cost"
                            value="{{ old('cost', $facility->cost) }}"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('cost') border-red-500 @enderror"
                            required>
                        @error('cost')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Biling Type -->
                    <div>
                        <label for="biling_type" class="block font-semibold text-gray-700">Billing Type <span class="text-red-500">*</span></label>
                        <input type="text" id="biling_type" name="biling_type"
                            value="{{ old('biling_type', $facility->biling_type) }}"
                            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('biling_type') border-red-500 @enderror"
                            required>
                        @error('biling_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block font-semibold text-gray-700">Description</label>
                    <textarea id="description" name="description" rows="3"
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $facility->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('facilities.index') }}"
                        class="px-5 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg transition">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-5 py-2 bg-indigo-600 hover:bg-indigo-700 text-black rounded-lg shadow transition" style="margin-left: 20px;">
                        Update Facility
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
