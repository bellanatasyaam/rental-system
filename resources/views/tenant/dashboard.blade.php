{{-- resources/views/admin/dashboard.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                <!-- Companies -->
                <a href="{{ route('companies.index') }}" 
                    class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="h-14 w-14 bg-white dark:bg-gray-700 flex items-center justify-center rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-700 dark:text-white">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 21h18M5 21V3h4v18M15 21V9h4v12" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Companies</h2>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Manage company data easily.</p>
                        </div>
                    </div>
                </a>

                <!-- Facilities -->
                <a href="{{ route('facilities.index') }}" 
                    class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="h-14 w-14 bg-white dark:bg-gray-700 flex items-center justify-center rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <circle cx="12" cy="12" r="3" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 12h2M3 12h2M12 19v2M12 3v2M16.24 7.76l1.42-1.42M6.34 17.66l1.42-1.42M16.24 16.24l1.42 1.42M6.34 6.34l1.42 1.42"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Facilities</h2>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Manage facility data efficiently.</p>
                        </div>
                    </div>
                </a>

                <!-- Tenants -->
                <a href="{{ route('tenants.index') }}" 
                    class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="h-14 w-14 bg-white dark:bg-gray-700 flex items-center justify-center rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <circle cx="12" cy="7" r="3" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 21v-2a7 7 0 0114 0v2" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Tenants</h2>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Track and manage tenants easily.</p>
                        </div>
                    </div>
                </a>

                <!-- Properties -->
                <a href="{{ route('properties.index') }}" 
                    class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                    <div class="flex items-center gap-4">
                        <div class="h-14 w-14 bg-white dark:bg-gray-700 flex items-center justify-center rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 21V12h6v9" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Properties</h2>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Manage property information.</p>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
    