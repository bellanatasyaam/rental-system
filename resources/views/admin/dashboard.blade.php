{{-- resources/views/admin/dashboard.blade.php --}}
<x-app-layout>

    <div class="w-full bg-white py-4 shadow-sm border-b">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6">
            <h1 class="text-xl font-bold text-gray-700">RENTAL SYSTEM</h1>
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
            <div 
                x-data="{ open: false }"
                class="relative bg-white border rounded-xl shadow hover:shadow-lg transition p-6 flex flex-col"
            >
                {{-- Tombol Info --}}
                <button 
                    @click.stop="open = !open"
                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl leading-none"
                >
                    ℹ️
                </button>

                {{-- Popover Info --}}
                <div 
                    x-show="open"
                    @click.outside="open = false"
                    x-transition
                    class="absolute top-10 right-3 w-64 bg-white border rounded-lg shadow p-3 text-xs text-gray-700 z-20"
                >
                    <strong class="text-gray-900">{{ $card['title'] }}</strong>
                    <p class="mt-1 text-gray-600">
                        {{ $card['desc'] }}
                    </p>
                </div>

                {{-- Card Content --}}
                <h3 class="text-lg font-semibold text-gray-800 mb-3">
                    {{ $card['title'] }}
                </h3>

                <p class="text-gray-600 text-sm mb-4">
                    {{ $card['desc'] }}
                </p>

                <a href="{{ route($card['route']) }}"
                   class="mt-auto px-3 py-2 rounded bg-blue-600 text-white text-sm hover:bg-blue-700 text-center">
                    Go to {{ $card['title'] }}
                </a>
            </div>
            @endforeach

        </div>
    </div>

    <div class="mt-10 bg-white border rounded-xl p-6 shadow-sm">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Penjelasan Menu di Dashboard</h2>

        <div class="space-y-8 text-gray-700 text-sm leading-relaxed">

            {{-- ========== FULL EXPLANATIONS ========== --}}
            {{-- (Tidak aku ubah sama sekali) --}}

            <!-- COMPANIES -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900">1. Companies</h3>
                <p class="mt-1">
                    Menu ini berisi informasi perusahaan pemilik atau pengelola properti.
                    Meski tidak terlihat di ERD, biasanya digunakan untuk mencatat:
                </p>
                <ul class="list-disc ml-6 mt-1">
                    <li>Nama perusahaan</li>
                    <li>Alamat perusahaan</li>
                    <li>Kontak perusahaan</li>
                    <li>Data pendukung lainnya</li>
                </ul>
                <p class="mt-1">
                    Dipakai untuk sistem yang mengelola banyak properti milik beberapa perusahaan berbeda.
                </p>
            </div>

            <!-- FACILITIES -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900">2. Facilities</h3>
                <p class="mt-1">Mengacu pada tabel <strong>FACILITIES</strong>.</p>
                <p class="mt-1">Menu ini berisi master data fasilitas, seperti:</p>
                <ul class="list-disc ml-6 mt-1">
                    <li>Nama fasilitas (wifi, listrik, air, parkir, gym, dll)</li>
                    <li>Tipe fasilitas (metered, non-metered, fixed charge)</li>
                    <li>Deskripsi fasilitas</li>
                    <li>Tarif atau cost</li>
                    <li>Billing type (per penggunaan, flat rate)</li>
                </ul>
                <p class="mt-1">
                    Menu ini hanya mendefinisikan jenis fasilitas secara umum, 
                    dan belum terhubung ke properti atau unit tertentu.
                </p>
            </div>

            <!-- TENANTS -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900">3. Tenants</h3>
                <p class="mt-1">Mengacu pada tabel <strong>TENANTS</strong>.</p>
                <p class="mt-1">Menu ini menyimpan data penyewa, termasuk:</p>
                <ul class="list-disc ml-6 mt-1">
                    <li>Nama tenant</li>
                    <li>Contact person</li>
                    <li>Nomor telepon</li>
                    <li>Email</li>
                    <li>ID card / KTP</li>
                    <li>Alamat lengkap</li>
                </ul>
                <p class="mt-1">Data ini digunakan ketika membuat <strong>contract</strong>.</p>
            </div>

            <!-- PROPERTIES -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900">4. Properties</h3>
                <p class="mt-1">Mengacu pada tabel <strong>PROPERTIES</strong>.</p>
                <p class="mt-1">Menu ini mencatat data master properti, seperti:</p>
                <ul class="list-disc ml-6 mt-1">
                    <li>Kode dan nama properti</li>
                    <li>Alamat properti</li>
                    <li>Tipe (residential, office, warehouse, dll)</li>
                    <li>Total area</li>
                    <li>Deskripsi</li>
                    <li>Status aktif / nonaktif</li>
                    <li>Foto properti (dalam bentuk JSON)</li>
                </ul>
                <p class="mt-1">Setiap properti dapat memiliki banyak <strong>property units</strong>.</p>
            </div>

            <!-- PROPERTY UNITS -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900">5. Property Units</h3>
                <p class="mt-1">Mengacu pada tabel <strong>PROPERTY_UNITS</strong>.</p>
                <p class="mt-1">Menu ini menyimpan detail unit yang berada dalam suatu properti:</p>
                <ul class="list-disc ml-6 mt-1">
                    <li>Property ID (relasi ke PROPERTIES)</li>
                    <li>Unit code / nomor unit</li>
                    <li>Nama unit</li>
                    <li>Tipe unit (studio, booth, warehouse space, dll)</li>
                    <li>Area</li>
                    <li>Monthly price</li>
                    <li>Deposit amount</li>
                    <li>Status (available, occupied, maintenance)</li>
                    <li>Catatan unit</li>
                </ul>
                <p class="mt-1">Unit dipilih tenant saat membuat <strong>contract</strong>.</p>
            </div>

            <!-- CONTRACTS -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900">6. Contracts</h3>
                <p class="mt-1">Mengacu pada tabel <strong>CONTRACTS</strong>.</p>
                <p class="mt-1">Menu ini menyimpan seluruh perjanjian sewa:</p>
                <ul class="list-disc ml-6 mt-1">
                    <li>Property ID</li>
                    <li>Property Unit ID</li>
                    <li>Tenant ID</li>
                    <li>Contract number</li>
                    <li>Start date & end date</li>
                    <li>Monthly rent</li>
                    <li>Deposit amount</li>
                    <li>Payment due day</li>
                    <li>Status contract (active, completed, terminated)</li>
                </ul>
                <p class="mt-1">
                    Kontrak akan menghasilkan <strong>facility usage</strong> per periode.
                </p>
            </div>

            <!-- PAYMENTS -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900">7. Payments</h3>
                <p class="mt-1">Walaupun tabel detail tidak terlihat, menu ini umumnya digunakan untuk:</p>
                <ul class="list-disc ml-6 mt-1">
                    <li>Mencatat pembayaran dari tenant</li>
                    <li>Menghubungkan pembayaran ke kontrak</li>
                    <li>Menampilkan riwayat pembayaran tenant</li>
                </ul>
                <p class="mt-1">
                    Bisa juga menampilkan charge fasilitas yang sudah di-invoice.
                </p>
            </div>

            <!-- PROPERTY UNIT FACILITIES -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900">8. Property Unit Facilities</h3>
                <p class="mt-1">Mengacu pada tabel <strong>PROPERTY_UNIT_FACILITIES</strong>.</p>
                <p class="mt-1">Menu ini mengatur fasilitas apa saja yang ada di suatu unit:</p>
                <ul class="list-disc ml-6 mt-1">
                    <li>Relasi unit ke fasilitas</li>
                    <li>Settings (JSON)</li>
                    <li>Status (active / inactive)</li>
                </ul>
                <p class="mt-1">Contoh: Unit 101 memiliki listrik, air, wifi, dll.</p>
            </div>

            <!-- FACILITY USAGES -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900">9. Facility Usages</h3>
                <p class="mt-1">Mengacu pada tabel <strong>FACILITY_USAGES</strong>.</p>
                <p class="mt-1">Menu ini mencatat pemakaian fasilitas per periode:</p>
                <ul class="list-disc ml-6 mt-1">
                    <li>Property Unit Facility ID</li>
                    <li>Contract ID</li>
                    <li>Periode pemakaian</li>
                    <li>Usage value (misal 350 kWh)</li>
                    <li>Rate</li>
                    <li>Total cost</li>
                    <li>Status invoiced atau belum</li>
                </ul>
                <p class="mt-1">
                    Biasanya digenerate otomatis setiap periode (bulanan).
                </p>
            </div>

        </div>
    </div>


    {{-- FIREBASE SCRIPT (Tidak Diubah) --}}
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
