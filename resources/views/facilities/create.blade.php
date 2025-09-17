@extends('layouts.app')

@section('title', 'Add New Facility')

@section('content')
<div class="max-w-3xl mx-auto mt-6">
    <div class="bg-white shadow-md rounded-xl border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-500 rounded-t-xl">
            <h1 class="text-xl font-bold text-white">Add New Facility</h1>
        </div>

        <div class="p-6">
            <form action="{{ route('facilities.store') }}" method="POST" class="space-y-5">
                @csrf

                {{-- Name --}}
                <div>
                    <label for="name" class="block font-semibold text-gray-700">Name <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name') }}" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror" 
                        required
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- AC --}}
                <div>
                    <label for="ac" class="block font-semibold text-gray-700">AC <span class="text-red-500">*</span></label>
                    <select 
                        name="ac" 
                        id="ac" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('ac') border-red-500 @enderror" 
                        required
                    >
                        <option value="AC" {{ old('ac') == 'AC' ? 'selected' : '' }}>AC</option>
                        <option value="No AC" {{ old('ac') == 'No AC' ? 'selected' : '' }}>No AC</option>
                    </select>
                    @error('ac')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Room --}}
                <div>
                    <label for="room" class="block font-semibold text-gray-700">Room</label>
                    <input 
                        type="text" 
                        name="room" 
                        value="{{ old('room') }}" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                {{-- Floor --}}
                <div>
                    <label for="floor" class="block font-semibold text-gray-700">Floor</label>
                    <input 
                        type="text" 
                        name="floor" 
                        value="{{ old('floor') }}" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>

                {{-- Type --}}
                <div>
                    <label for="type" class="block font-semibold text-gray-700">Type <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        name="type" 
                        value="{{ old('type') }}" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('type') border-red-500 @enderror" 
                        required
                    >
                    @error('type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div>
                    <label for="description" class="block font-semibold text-gray-700">Description</label>
                    <textarea 
                        name="description" 
                        rows="3" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >{{ old('description') }}</textarea>
                </div>

                {{-- Cost --}}
                <div>
                    <label for="cost" class="block font-semibold text-gray-700">Cost <span class="text-red-500">*</span></label>
                    <input 
                        type="number" 
                        step="0.01" 
                        name="cost" 
                        value="{{ old('cost') }}" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('cost') border-red-500 @enderror" 
                        required
                    >
                    @error('cost')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Billing Type --}}
                <div>
                    <label for="biling_type" class="block font-semibold text-gray-700">Billing Type <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        name="biling_type" 
                        value="{{ old('biling_type') }}" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('biling_type') border-red-500 @enderror" 
                        required
                    >
                    @error('biling_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('facilities.index') }}" class="px-5 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg">Cancel</a>
                    <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-black rounded-lg" style="margin-left: 20px;">Save Facility</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
