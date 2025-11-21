{{-- resources/views/admin/dashboard.blade.php --}}
<x-app-layout>

    <div class="w-full bg-white py-4 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <h1 class="text-xl font-bold text-gray-700">CRM</h1>
            <div class="flex items-center gap-3">
                <span class="text-sm text-gray-700">
                    {{ Auth::user()->role }} ({{ Auth::user()->email }})
                </span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="px-3 py-1 bg-red-500 text-white rounded text-sm hover:bg-red-600">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>

    <br><br>

    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Master Data Menu</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            {{-- CARD COMPONENT --}}
            @php
                $cards = [
                    ['route'=>'companies.index','title'=>'Companies','desc'=>'Manage company data easily.'],
                    ['route'=>'facilities.index','title'=>'Facilities','desc'=>'Manage and organize all your facility data efficiently.'],
                    ['route'=>'tenants.index','title'=>'Tenants','desc'=>'Easily track and handle tenant details in one place.'],
                    ['route'=>'properties.index','title'=>'Properties','desc'=>'Oversee and update property information seamlessly.'],
                    ['route'=>'property_units.index','title'=>'Property Units','desc'=>'Easily manage and track individual property units with precision.'],
                    ['route'=>'contracts.index','title'=>'Contracts','desc'=>'Organize and oversee contracts efficiently for seamless management.'],
                    ['route'=>'payments.index','title'=>'Payments','desc'=>'Track, process, and manage payments securely and effortlessly.'],
                    ['route'=>'property_unit_facilities.index','title'=>'Property Unit Facilities','desc'=>'Manage and organize individual property units and their facilities efficiently.'],
                    ['route'=>'facility_usages.index','title'=>'Facility Usages','desc'=>'Manage and organize facility usage accurately.'],
                ];
            @endphp

            @foreach ($cards as $card)
            <a href="{{ route($card['route']) }}"
               class="bg-white border rounded-xl shadow hover:shadow-lg transition p-6 flex flex-col">

                <h3 class="text-lg font-semibold text-gray-800 mb-3">
                    {{ $card['title'] }}
                </h3>

                <p class="text-gray-600 text-sm mb-4">
                    {{ $card['desc'] }}
                </p>

                <button class="mt-auto px-3 py-2 rounded bg-blue-600 text-white text-sm hover:bg-blue-700">
                    Go to {{ $card['title'] }}
                </button>
            </a>
            @endforeach

        </div>
    </div>


    {{-- FIREBASE SCRIPT LU GUA BIARIN UTUH KAYAK SEMULA --}}
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

        const app = initializeApp(firebaseConfig);
        const messaging = getMessaging(app);

        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register('/firebase-messaging-sw.js')
                .then((registration) => {
                    navigator.serviceWorker.ready.then((reg) => {
                        getToken(messaging, {
                            vapidKey: "BG7UKoAwXVJ1siLRqR0aTGPs_oBtnxoYtSrQml82AF1ytluccrT2xQLNJmDgVHh8IRtfS-jQ5GDnyFtemEq6BKY",
                            serviceWorkerRegistration: reg
                        }).then((currentToken) => {
                            if (currentToken) {
                                axios.post(`/tenants/${tenantId}/device-token`, {
                                    device_token: currentToken
                                });
                            }
                        });
                    });
                });
        }

        onMessage(messaging, (payload) => {
            alert(`Notifikasi: ${payload.notification.title} - ${payload.notification.body}`);
        });
    </script>

</x-app-layout>
