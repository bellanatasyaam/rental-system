@extends('layouts.app')

@section('title', 'Edit Company')

@section('content')
<div class="max-w-3xl mx-auto mt-6">
    <div class="bg-white shadow-md rounded-xl border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-600 to-blue-500 rounded-t-xl">
            <h1 class="text-xl font-bold text-white">Edit Company</h1>
        </div>

        <div class="p-6">
            <form action="{{ route('companies.update', $company) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Name --}}
                <div>
                    <label for="name" class="block font-semibold text-gray-700">Name <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        name="name" 
                        value="{{ old('name', $company->name) }}" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror" 
                        required
                    >
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Address --}}
                <div>
                    <label for="address" class="block font-semibold text-gray-700">Address</label>
                    <textarea 
                        name="address" 
                        rows="3" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('address') border-red-500 @enderror"
                    >{{ old('address', $company->address ?? '') }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Phone --}}
                <div>
                    <label for="phone" class="block font-semibold text-gray-700">Phone <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        name="phone" 
                        value="{{ old('phone', $company->phone) }}" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('phone') border-red-500 @enderror" 
                        required
                    >
                    @error('phone')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block font-semibold text-gray-700">Email <span class="text-red-500">*</span></label>
                    <input 
                        type="email" 
                        name="email" 
                        value="{{ old('email', $company->email) }}" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror" 
                        required
                    >
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tax Number --}}
                <div>
                    <label for="tax_number" class="block font-semibold text-gray-700">Tax Number <span class="text-red-500">*</span></label>
                    <input 
                        type="text" 
                        name="tax_number" 
                        value="{{ old('tax_number', $company->tax_number) }}" 
                        class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tax_number') border-red-500 @enderror" 
                        required
                    >
                    @error('tax_number')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Include Additional Form Fields --}}
                @include('companies.form', ['company' => $company])

                {{-- Buttons --}}
                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('companies.index') }}" class="px-5 py-2 bg-gray-300 hover:bg-gray-400 text-gray-800 rounded-lg">Back</a>
                    <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-black rounded-lg" style="margin-left: 20px;">Update</button>
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
