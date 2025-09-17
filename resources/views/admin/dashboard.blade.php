{{-- resources/views/admin/dashboard.blade.php --}}
<x-app-layout>
<br><br>
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                
            <a href="{{ route('companies.index') }}" 
                            class="scale-100 p-6 bg-gray-100 rounded-lg shadow-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-grey-500">
                                <div>
                                    <div class="h-16 w-16 bg-white flex items-center justify-center rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                                            stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                                        <path stroke-linecap="round" stroke-linejoin="round" 
                                                d="M3 21h18M5 21V3h4v18M15 21V9h4v12" />
                                        </svg>
                                    </div>
                                    
                                    <h2 class="mt-6 text-xl font-semibold text-gray-900">Companies</h2>
                                    <p class="mt-4 text-gray-700 text-sm leading-relaxed">
                                        Manage company data easily.
                                    </p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 w-6 h-6 mx-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                </svg>
                                </a>

            <a href="{{ route('facilities.index') }}" 
                                class="scale-100 p-6 bg-gray-100 rounded-lg shadow-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-grey-500">
                                    <div>
                                        <div class="h-16 w-16 bg-white flex items-center justify-center rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none"  viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                            <circle cx="12" cy="12" r="20" fill="white" stroke="none"/>
                                            <circle cx="12" cy="12" r="3" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 12h2M3 12h2M12 19v2M12 3v2M16.24 7.76l1.42-1.42M6.34 17.66l1.42-1.42M16.24 16.24l1.42 1.42M6.34 6.34l1.42 1.42"/>
                                            </svg>
                                        </div>
                                        
                                        <h2 class="mt-6 text-xl font-semibold text-gray-900">Facilities</h2>
                                        <p class="mt-4 text-gray-700 text-sm leading-relaxed">
                                            Manage and organize all your facility data efficiently.
                                        </p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 w-6 h-6 mx-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                    </svg>
                                </a>

            <a href="{{ route('tenants.index') }}" 
                                class="scale-100 p-6 bg-gray-100 rounded-lg shadow-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-grey-500">
                                    <div>
                                        <div class="h-16 w-16 bg-white flex items-center justify-center rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none"  viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                            <circle cx="12" cy="12" r="20" fill="white" stroke="none"/>
                                            <circle cx="12" cy="7" r="3" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 21v-2a7 7 0 0114 0v2"/>
                                            </svg>
                                        </div>
                                        
                                        <h2 class="mt-6 text-xl font-semibold text-gray-900">Tenants</h2>
                                        <p class="mt-4 text-gray-700 text-sm leading-relaxed">
                                            Easily track and handle tenant details in one place.   
                                        </p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 w-6 h-6 mx-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                    </svg>
                                </a>

            <a href="{{ route('properties.index') }}" 
                                class="scale-100 p-6 bg-gray-100 rounded-lg shadow-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-grey-500">
                                    <div>
                                        <div class="h-16 w-16 bg-white flex items-center justify-center rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none"  viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                            <circle cx="12" cy="12" r="20" fill="white" stroke="none"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 21V12h6v9" />
                                            </svg>
                                        </div>
                                        
                                        <h2 class="mt-6 text-xl font-semibold text-gray-900">Properties</h2>
                                        <p class="mt-4 text-gray-700 text-sm leading-relaxed">
                                            Oversee and update property information seamlessly.
                                        </p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 w-6 h-6 mx-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                    </svg>
                                </a>

            <a href="{{ route('property_units.index') }}" 
                                class="scale-100 p-6 bg-gray-100 rounded-lg shadow-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-grey-500">
                                    <div>
                                        <div class="h-16 w-16 bg-white flex items-center justify-center rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none"  viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                                <circle cx="12" cy="12" r="20" fill="white" stroke="none"/>
                                                <rect x="6" y="8" width="4" height="8" rx="1" />
                                                <rect x="14" y="8" width="4" height="8" rx="1" />
                                                <rect x="11" y="14" width="2" height="4" rx="0.5"/>
                                            </svg>
                                        </div>
                                        
                                        <h2 class="mt-6 text-xl font-semibold text-gray-900">Property Units</h2>
                                        <p class="mt-4 text-gray-700 text-sm leading-relaxed">
                                            Easily manage and track individual property units with precision.
                                        </p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 w-6 h-6 mx-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                    </svg>
                                </a>

            <a href="{{ route('contracts.index') }}" 
                                class="scale-100 p-6 bg-gray-100 rounded-lg shadow-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-grey-500">
                                    <div>
                                        <div class="h-16 w-16 bg-white flex items-center justify-center rounded-full">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none"  viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                                <circle cx="12" cy="12" r="20" fill="white" stroke="none"/>
                                                <rect x="7" y="5" width="10" height="14" rx="1" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 9h6M9 13h6M9 17h4" />
                                            </svg>
                                        </div>
                                        
                                        <h2 class="mt-6 text-xl font-semibold text-gray-900">Contracts</h2>
                                        <p class="mt-4 text-gray-700 text-sm leading-relaxed">
                                            Organize and oversee contracts efficiently for seamless management.
                                        </p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 w-6 h-6 mx-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                    </svg>
                                </a>

            <a href="{{ route('payments.index') }}" 
                                class="scale-100 p-6 bg-gray-100 rounded-lg shadow-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-grey-500">
                                    <div>
                                        <div class="h-16 w-16 bg-white flex items-center justify-center rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none"  viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                            <circle cx="12" cy="12" r="20" fill="white" stroke="none"/>
                                            <rect x="4" y="8" width="16" height="8" rx="2" />
                                            <line x1="4" y1="12" x2="20" y2="12" stroke-linecap="round"/>
                                            <rect x="6" y="10" width="4" height="4" rx="0.5" />
                                        </svg>
                                        </div>
                                        
                                        <h2 class="mt-6 text-xl font-semibold text-gray-900">Payments</h2>
                                        <p class="mt-4 text-gray-700 text-sm leading-relaxed">
                                            Track, process, and manage payments securely and effortlessly.
                                        </p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 w-6 h-6 mx-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                    </svg>
                                </a>

            <a href="{{ route('property_unit_facilities.index') }}" 
                                class="scale-100 p-6 bg-gray-100 rounded-lg shadow-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-grey-500">
                                    <div>
                                        <div class="h-16 w-16 bg-white flex items-center justify-center rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none"  viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                        <circle cx="12" cy="12" r="20" fill="white" stroke="none"/>
                                        <!-- Property Unit: 2 blok persegi -->
                                        <rect x="6" y="8" width="4" height="8" rx="1" />
                                        <rect x="14" y="8" width="4" height="8" rx="1" />
                                        <!-- Facilities: roda gear kecil -->
                                        <circle cx="12" cy="7" r="3" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 7h1M9 7h1M12 4v1M12 10v1"/>
                                        </svg>
                                        </div> 
                                        <h2 class="mt-6 text-xl font-semibold text-gray-900">Property Unit Facilities</h2>
                                        <p class="mt-4 text-gray-700 text-sm leading-relaxed">
                                            Manage and organize individual property units and their facilities efficiently.
                                        </p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 w-6 h-6 mx-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                    </svg>
                                </a>

            <a href="{{ route('facility_usages.index') }}" 
                    class="scale-100 p-6 bg-gray-100 rounded-lg shadow-lg shadow-2xl shadow-gray-500/20 flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-grey-500">
                            <div>
                                <div class="h-16 w-16 bg-white flex items-center justify-center rounded-full">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="none"  viewBox="0 0 24 24" stroke-width="1" stroke="currentColor">
                                <circle cx="12" cy="12" r="20" fill="white" stroke="none"/>
                                <!-- Property Unit: 2 blok persegi -->
                                <rect x="6" y="8" width="4" height="8" rx="1" />
                                <rect x="14" y="8" width="4" height="8" rx="1" />
                                <!-- Facilities: roda gear kecil -->
                                <circle cx="12" cy="7" r="3" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 7h1M9 7h1M12 4v1M12 10v1"/>
                                </svg>
                                </div> 
                                <h2 class="mt-6 text-xl font-semibold text-gray-900">Facility Usages</h2>
                                <p class="mt-4 text-gray-700 text-sm leading-relaxed">
                                    Manage and organize individual property units and their facilities efficiently.
                                </p>
                            </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" class="self-center shrink-0 w-6 h-6 mx-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75" />
                                </svg>
                </a>

            </div>
        </div>
    </div>

     <!-- {{-- 🔹 Tambahin script Firebase di bawah ini --}} -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
        import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-messaging.js";

        const firebaseConfig = {
            apiKey: "AIzaSyCJOANDFcHCxQbdRE80toyI1RjxpHMZ87Q",
            authDomain: "rental-system-833a9.firebaseapp.com",
            projectId: "rental-system-833a9",
            storageBucket: "rental-system-833a9.firebasestorage.app",
            messagingSenderId: "121485908783",
            appId: "1:121485908783:web:ce0be2285988d021df1fda",
            measurementId: "G-HNJKB85YH8"
        };

        // ✅ Init Firebase
        const app = initializeApp(firebaseConfig);
        const messaging = getMessaging(app);

        // ✅ Register Service Worker
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/firebase-messaging-sw.js')
                .then((registration) => {
                    console.log('✅ Service Worker terdaftar:', registration);

                    // 🔹 Tunggu SW benar-benar aktif
                    navigator.serviceWorker.ready.then((reg) => {
                        getToken(messaging, {
                            vapidKey: "BG7UKoAwXVJ1siLRqR0aTGPs_oBtnxoYtSrQml82AF1ytluccrT2xQLNJmDgVHh8IRtfS-jQ5GDnyFtemEq6BKY",
                            serviceWorkerRegistration: reg
                        })
                        .then((currentToken) => {
                            if (currentToken) {
                                console.log("✅ Token device:", currentToken);
                                axios.post(`/tenants/${tenantId}/device-token`, {
                                    device_token: currentToken
                                })
                                .then(res => console.log('✅ Token tenant tersimpan di DB'))
                                .catch(err => console.error('❌ Gagal simpan token', err));
                            } else {
                                console.log("⚠️ Token tidak tersedia, minta izin notif lagi");
                            }
                        })
                        .catch((err) => {
                            console.error("❌ Gagal ambil token:", err);
                        });
                    });
                })
                .catch((err) => {
                    console.error('❌ Service Worker gagal:', err);
                });
        }

        // ✅ Listener pesan saat web sedang terbuka
        onMessage(messaging, (payload) => {
            console.log("📩 Pesan foreground diterima:", payload);
            alert(`Notifikasi: ${payload.notification.title} - ${payload.notification.body}`);
        });
    </script>


</x-app-layout>
