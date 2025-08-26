# Tujuan
Membangun modul **Asset Management** ala Enterprise menggunakan **Laravel + Bootstrap 5 + jQuery + Select2 + SweetAlert2** untuk merekam seluruh aset perangkat kantor (laptop, printer, keyboard, mouse, monitor, komponen komputer), menempelkan **asset tag/QR**, melacak **lokasi**, **status**, **kepemilikan/assignment**, **riwayat**, dan **pemeliharaan**.

---

# Fitur Utama (versi ringkas)
- Master data aset dengan **kategori/tipe**, **brand/model**, **serial number**, **specs** (RAM, CPU, dsb), **nilai perolehan**, **tanggal beli**, **garansi**.
- **Asset Tag (QR/Barcode)** unik untuk setiap aset & komponen → scan untuk buka detail.
- **Lokasi hierarkis** (Gedung → Lantai → Ruang → Meja), **Departemen**, **Pemilik (Employee)**.
- **Workflow status**: *Draft → In Stock → Assigned → In Maintenance → Lost/Stolen → Retired/Disposed*.
- **Assignment/Check-in & Check-out** ke karyawan/lokasi, dengan bukti serah-terima (PDF opsional).
- **Komponen** (RAM, SSD, PSU, GPU, dll) melekat pada aset induk (PC) + inventory komponen lepas.
- **Riwayat status & audit trail** (siapa-apa-kapan dari perubahan penting).
- **Ticket Pemeliharaan** (preventive/corrective), vendor, biaya, parts.
- **Pencarian & filter cepat** (Select2 AJAX) per status, lokasi, tipe, pemilik.
- Notifikasi/konfirmasi aksi via **SweetAlert2**.

---

# Desain Basis Data (ERD ringkas)
```
ASSET_TYPES (id, name)
CATEGORIES   (id, name, asset_type_id)
VENDORS      (id, name, contact)
LOCATIONS    (id, code, name, parent_id)
DEPARTMENTS  (id, code, name)
EMPLOYEES    (id, code, full_name, email, department_id)
ASSETS       (id, tag_code, name, category_id, vendor_id, brand, model,
             serial_no, purchase_date, purchase_cost, warranty_months,
             status, location_id, department_id, current_employee_id,
             parent_asset_id, specs_json, notes)
COMPONENTS   (id, tag_code, name, type, brand, model, serial_no,
             status, warranty_months, purchase_date, purchase_cost,
             location_id, parent_asset_id, specs_json, notes)
ASSET_ASSIGNMENTS (id, asset_id, employee_id, location_id, assigned_at,
                   returned_at, condition_notes)
ASSET_STATUS_LOGS (id, asset_id, from_status, to_status, changed_by, changed_at, remarks)
MAINTENANCE_TICKETS (id, code, asset_id, title, description, type, priority,
                     opened_by, assigned_to, vendor_id, status, opened_at,
                     closed_at, cost)
PURCHASES (id, po_no, vendor_id, purchased_at, total)
PURCHASE_LINES (id, purchase_id, asset_id, component_id, description, qty, unit_cost)
```
Catatan: **tag_code** adalah kode yang dicetak pada label/QR.

---

# Buat project Laravel baru
```php
composer create-project laravel/laravel asset-management
cd asset-management

# Install dependencies untuk frontend
npm install
```

# Konfigurasi Environment
```php
// Edit file .env

APP_NAME="Asset Management"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=asset_management
DB_USERNAME=root
DB_PASSWORD=

# Generate app key
php artisan key:generate
```

# Install dan Konfigurasi Frontend Dependencies
```php
# Install Bootstrap 5, jQuery, Select2, SweetAlert2
npm install bootstrap @popperjs/core jquery select2 sweetalert2

# Edit file resources/js/bootstrap.js

import 'bootstrap';

import jQuery from 'jquery';
window.$ = jQuery;
window.jQuery = jQuery;

import Select2 from 'select2';
Select2.defaults = jQuery.extend(Select2.defaults, {
    width: '100%',
    theme: 'bootstrap-5'
});
window.Select2 = Select2;

import Swal from 'sweetalert2';
window.Swal = Swal;

# Edit file resources/css/app.css

@import 'bootstrap/dist/css/bootstrap.min.css';
@import 'select2/dist/css/select2.min.css';
@import 'select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.min.css';

# Edit file vite.config.js

import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
});
```

# Setup Layout Base
```php
# Buat file resources/views/layouts/app.blade.php

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Asset Management')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Asset Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('assets.index') }}">Assets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('components.index') }}">Components</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <footer class="bg-light py-3 mt-5">
        <div class="container text-center">
            <small class="text-muted">Asset Management System &copy; {{ date('Y') }}</small>
        </div>
    </footer>

    <!-- SweetAlert2 Flash Messages -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: @json(session('success')),
                timer: 1800,
                showConfirmButton: false
            });
        });
    </script>
    @endif

    @if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                html: @json(implode('<br>', $errors->all()))
            });
        });
    </script>
    @endif
</body>
</html>
```

# Setup Database dan Migrations
```php
# Buat database MySQL
mysql -u root -p -e "CREATE DATABASE asset_management;"

# Jalankan migrasi default
php artisan migrate
```

# Buat Migrations (Seperti yang Disediakan)
```php
# Buat file migrations sesuai dengan yang telah disediakan di dokumen sebelumnya:
php artisan make:migration create_basic_tables
php artisan make:migration create_assets_components

# Copy isi migrations dari dokumen sebelumnya ke file-file tersebut, lalu jalankan:
php artisan migrate
```

# Buat Models dan Controllers
```php
# Buat models:

php artisan make:model AssetType
php artisan make:model Category
php artisan make:model Vendor
php artisan make:model Location
php artisan make:model Department
php artisan make:model Employee
php artisan make:model Asset
php artisan make:model Component
php artisan make:model AssetAssignment
php artisan make:model AssetStatusLog
php artisan make:model MaintenanceTicket

# Buat controllers:

php artisan make:controller AssetController --resource
php artisan make:controller ComponentController --resource
php artisan make:controller AssignmentController
php artisan make:controller MaintenanceTicketController --resource
```

# Setup Routes
```php
# Edit routes/web.php:

<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\MaintenanceTicketController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('assets.index');
});

Route::resource('assets', AssetController::class);
Route::resource('components', ComponentController::class);
Route::post('assets/{asset}/assign', [AssignmentController::class, 'store'])->name('assets.assign');
Route::post('assets/{asset}/checkin', [AssignmentController::class, 'checkin'])->name('assets.checkin');
Route::resource('tickets', MaintenanceTicketController::class);

// AJAX Select2
Route::get('ajax/assets', [AssetController::class, 'ajaxSearch'])->name('ajax.assets');
Route::get('ajax/employees', [AssignmentController::class, 'ajaxEmployees'])->name('ajax.employees');
Route::get('ajax/locations', [AssignmentController::class, 'ajaxLocations'])->name('ajax.locations');

// QR Code Route
Route::get('assets/{asset}/qr', function(\App\Models\Asset $asset){
    $png = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(400)->margin(1)
        ->generate(route('assets.show',$asset));
    return response($png)->header('Content-Type','image/png');
})->name('assets.qr');
```

# Install Package QR Code
```php
composer require simplesoftwareio/simple-qrcode
```

# Buat Views
```php
# Buat direktori dan file views:
mkdir -p resources/views/assets
mkdir -p resources/views/components
mkdir -p resources/views/tickets

// Buat file resources/views/assets/index.blade.php dan resources/views/assets/show.blade.php dengan konten dari dokumen sebelumnya.
```

# Build Assets dan Test
```php
# Build frontend assets
npm run build

# Jalankan server development
php artisan serve
```

# Buat Seeder untuk Data Contoh
```php
php artisan make:seeder AssetSeeder

# Edit database/seeders/AssetSeeder.php dengan konten dari dokumen sebelumnya, lalu:

php artisan db:seed --class=AssetSeeder
```

# Migrations
> Buat dengan `php artisan make:migration` lalu sesuaikan. Di bawah cuplikan inti.

```php
// 2025_08_26_000001_create_basic_tables.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('asset_types', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->timestamps();
        });

        Schema::create('categories', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->foreignId('asset_type_id')->constrained()->cascadeOnDelete();
            $t->timestamps();
        });

        Schema::create('vendors', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('contact')->nullable();
            $t->timestamps();
        });

        Schema::create('locations', function (Blueprint $t) {
            $t->id();
            $t->string('code')->unique();
            $t->string('name');
            $t->foreignId('parent_id')->nullable()->constrained('locations')->nullOnDelete();
            $t->timestamps();
        });

        Schema::create('departments', function (Blueprint $t) {
            $t->id();
            $t->string('code')->unique();
            $t->string('name');
            $t->timestamps();
        });

        Schema::create('employees', function (Blueprint $t) {
            $t->id();
            $t->string('code')->unique();
            $t->string('full_name');
            $t->string('email')->nullable();
            $t->foreignId('department_id')->nullable()->constrained()->nullOnDelete();
            $t->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('employees');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('locations');
        Schema::dropIfExists('vendors');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('asset_types');
    }
};
```

```php
// 2025_08_26_000002_create_assets_components.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('assets', function (Blueprint $t) {
            $t->id();
            $t->string('tag_code')->unique(); // untuk QR/Barcode
            $t->string('name');
            $t->foreignId('category_id')->constrained();
            $t->foreignId('vendor_id')->nullable()->constrained()->nullOnDelete();
            $t->string('brand')->nullable();
            $t->string('model')->nullable();
            $t->string('serial_no')->nullable()->index();
            $t->date('purchase_date')->nullable();
            $t->decimal('purchase_cost', 18, 2)->nullable();
            $t->unsignedInteger('warranty_months')->default(0);
            $t->enum('status', ['draft','in_stock','assigned','maintenance','lost','retired'])->default('draft');
            $t->foreignId('location_id')->nullable()->constrained('locations')->nullOnDelete();
            $t->foreignId('department_id')->nullable()->constrained('departments')->nullOnDelete();
            $t->foreignId('current_employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $t->foreignId('parent_asset_id')->nullable()->constrained('assets')->nullOnDelete(); // untuk aset ber-induk
            $t->json('specs_json')->nullable();
            $t->text('notes')->nullable();
            $t->timestamps();
        });

        Schema::create('components', function (Blueprint $t) {
            $t->id();
            $t->string('tag_code')->unique();
            $t->string('name');
            $t->string('type')->nullable(); // RAM/SSD/PSU/Keyboard/Mouse/Monitor
            $t->string('brand')->nullable();
            $t->string('model')->nullable();
            $t->string('serial_no')->nullable()->index();
            $t->enum('status', ['in_stock','installed','maintenance','lost','retired'])->default('in_stock');
            $t->unsignedInteger('warranty_months')->default(0);
            $t->date('purchase_date')->nullable();
            $t->decimal('purchase_cost', 18, 2)->nullable();
            $t->foreignId('location_id')->nullable()->constrained('locations')->nullOnDelete();
            $t->foreignId('parent_asset_id')->nullable()->constrained('assets')->nullOnDelete();
            $t->json('specs_json')->nullable();
            $t->text('notes')->nullable();
            $t->timestamps();
        });

        Schema::create('asset_assignments', function (Blueprint $t) {
            $t->id();
            $t->foreignId('asset_id')->constrained('assets')->cascadeOnDelete();
            $t->foreignId('employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $t->foreignId('location_id')->nullable()->constrained('locations')->nullOnDelete();
            $t->timestamp('assigned_at');
            $t->timestamp('returned_at')->nullable();
            $t->text('condition_notes')->nullable();
            $t->timestamps();
        });

        Schema::create('asset_status_logs', function (Blueprint $t) {
            $t->id();
            $t->foreignId('asset_id')->constrained('assets')->cascadeOnDelete();
            $t->string('from_status')->nullable();
            $t->string('to_status');
            $t->foreignId('changed_by')->nullable()->constrained('users')->nullOnDelete();
            $t->timestamp('changed_at');
            $t->text('remarks')->nullable();
            $t->timestamps();
        });

        Schema::create('maintenance_tickets', function (Blueprint $t) {
            $t->id();
            $t->string('code')->unique();
            $t->foreignId('asset_id')->constrained('assets')->cascadeOnDelete();
            $t->string('title');
            $t->text('description')->nullable();
            $t->enum('type', ['preventive','corrective']);
            $t->enum('priority', ['low','medium','high','urgent'])->default('medium');
            $t->foreignId('opened_by')->nullable()->constrained('users')->nullOnDelete();
            $t->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $t->foreignId('vendor_id')->nullable()->constrained('vendors')->nullOnDelete();
            $t->enum('status', ['open','in_progress','on_hold','closed'])->default('open');
            $t->timestamp('opened_at');
            $t->timestamp('closed_at')->nullable();
            $t->decimal('cost', 18, 2)->nullable();
            $t->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('maintenance_tickets');
        Schema::dropIfExists('asset_status_logs');
        Schema::dropIfExists('asset_assignments');
        Schema::dropIfExists('components');
        Schema::dropIfExists('assets');
    }
};
```

---

# Eloquent Models (inti)
```php
// app/Models/Asset.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'tag_code','name','category_id','vendor_id','brand','model','serial_no',
        'purchase_date','purchase_cost','warranty_months','status','location_id',
        'department_id','current_employee_id','parent_asset_id','specs_json','notes'
    ];

    protected $casts = [
        'specs_json' => 'array',
        'purchase_date' => 'date',
    ];

    public function category(){ return $this->belongsTo(Category::class); }
    public function vendor(){ return $this->belongsTo(Vendor::class); }
    public function location(){ return $this->belongsTo(Location::class); }
    public function department(){ return $this->belongsTo(Department::class); }
    public function employee(){ return $this->belongsTo(Employee::class, 'current_employee_id'); }
    public function components(){ return $this->hasMany(Component::class, 'parent_asset_id'); }
    public function parent(){ return $this->belongsTo(Asset::class, 'parent_asset_id'); }
    public function assignments(){ return $this->hasMany(AssetAssignment::class); }
    public function statusLogs(){ return $this->hasMany(AssetStatusLog::class); }
}
```

```php
// app/Models/Component.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    protected $fillable = [
        'tag_code','name','type','brand','model','serial_no','status','warranty_months',
        'purchase_date','purchase_cost','location_id','parent_asset_id','specs_json','notes'
    ];

    protected $casts = [ 'specs_json' => 'array', 'purchase_date' => 'date' ];

    public function asset(){ return $this->belongsTo(Asset::class, 'parent_asset_id'); }
    public function location(){ return $this->belongsTo(Location::class); }
}
```

```php
// app/Models/AssetAssignment.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AssetAssignment extends Model
{
    protected $fillable = ['asset_id','employee_id','location_id','assigned_at','returned_at','condition_notes'];
    protected $casts = ['assigned_at' => 'datetime', 'returned_at' => 'datetime'];

    public function asset(){ return $this->belongsTo(Asset::class); }
    public function employee(){ return $this->belongsTo(Employee::class); }
    public function location(){ return $this->belongsTo(Location::class); }
}
```

---

# Routes
```php
// routes/web.php
use App\Http\Controllers\AssetController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\MaintenanceTicketController;

Route::resource('assets', AssetController::class);
Route::resource('components', ComponentController::class);
Route::post('assets/{asset}/assign', [AssignmentController::class, 'store'])->name('assets.assign');
Route::post('assets/{asset}/checkin', [AssignmentController::class, 'checkin'])->name('assets.checkin');
Route::resource('tickets', MaintenanceTicketController::class);

// AJAX Select2
Route::get('ajax/assets', [AssetController::class, 'ajaxSearch'])->name('ajax.assets');
Route::get('ajax/employees', [AssignmentController::class, 'ajaxEmployees'])->name('ajax.employees');
Route::get('ajax/locations', [AssignmentController::class, 'ajaxLocations'])->name('ajax.locations');
```

---

# Controller (inti)
```php
// app/Http/Controllers/AssetController.php
namespace App\Http\Controllers;
use App\Models\{Asset, Category, Department, Employee, Location, Vendor};
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssetController extends Controller
{
    public function index(Request $r)
    {
        $q = Asset::with(['category','location','employee','department'])
            ->when($r->status, fn($qq)=>$qq->where('status', $r->status))
            ->when($r->location_id, fn($qq)=>$qq->where('location_id', $r->location_id))
            ->when($r->category_id, fn($qq)=>$qq->where('category_id', $r->category_id))
            ->when($r->employee_id, fn($qq)=>$qq->where('current_employee_id', $r->employee_id))
            ->orderBy('id','desc');

        $assets = $q->paginate(20);
        return view('assets.index', compact('assets'));
    }

    public function create(){
        return view('assets.create', [
            'categories' => Category::orderBy('name')->get(),
            'vendors' => Vendor::orderBy('name')->get(),
            'locations' => Location::orderBy('name')->get(),
            'departments' => Department::orderBy('name')->get(),
        ]);
    }

    public function store(Request $r){
        $data = $r->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable',
            'model' => 'nullable',
            'serial_no' => 'nullable',
            'purchase_date' => 'nullable|date',
            'purchase_cost' => 'nullable|numeric',
            'warranty_months' => 'nullable|integer',
            'location_id' => 'nullable|exists:locations,id',
            'department_id' => 'nullable|exists:departments,id',
            'specs_json' => 'nullable',
            'notes' => 'nullable',
        ]);

        $data['tag_code'] = $r->tag_code ?: strtoupper(Str::random(10));
        $data['status'] = 'in_stock';
        $data['specs_json'] = $r->specs_json ? json_decode($r->specs_json, true) : null;
        $asset = Asset::create($data);

        return redirect()->route('assets.show', $asset)->with('success','Asset created');
    }

    public function show(Asset $asset){
        $asset->load(['category','vendor','location','department','employee','components','assignments' => fn($q)=>$q->latest()]);
        return view('assets.show', compact('asset'));
    }

    public function edit(Asset $asset){
        return view('assets.edit', [
            'asset'=>$asset,
            'categories' => Category::orderBy('name')->get(),
            'vendors' => Vendor::orderBy('name')->get(),
            'locations' => Location::orderBy('name')->get(),
            'departments' => Department::orderBy('name')->get(),
        ]);
    }

    public function update(Request $r, Asset $asset){
        $data = $r->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable',
            'model' => 'nullable',
            'serial_no' => 'nullable',
            'purchase_date' => 'nullable|date',
            'purchase_cost' => 'nullable|numeric',
            'warranty_months' => 'nullable|integer',
            'location_id' => 'nullable|exists:locations,id',
            'department_id' => 'nullable|exists:departments,id',
            'specs_json' => 'nullable',
            'notes' => 'nullable',
        ]);
        if ($r->tag_code) $data['tag_code'] = $r->tag_code;
        $data['specs_json'] = $r->specs_json ? json_decode($r->specs_json, true) : null;
        $asset->update($data);

        return back()->with('success','Updated');
    }

    public function destroy(Asset $asset){
        $asset->delete();
        return back()->with('success','Deleted');
    }

    // Select2 AJAX (search by tag, serial, name)
    public function ajaxSearch(Request $r){
        $term = $r->q;
        $items = Asset::query()
            ->select('id','tag_code','name','serial_no')
            ->when($term, function($q) use ($term){
                $q->where(function($qq) use ($term){
                    $qq->where('name','like',"%$term%")
                       ->orWhere('tag_code','like',"%$term%")
                       ->orWhere('serial_no','like',"%$term%\");
                });
            })
            ->limit(20)->get()
            ->map(fn($a)=>['id'=>$a->id,'text'=>"{$a->tag_code} — {$a->name}" ]);
        return response()->json(['results'=>$items]);
    }
}
```

```php
// app/Http/Controllers/AssignmentController.php
namespace App\Http\Controllers;
use App\Models\{Asset, Employee, Location, AssetAssignment, AssetStatusLog};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    public function store(Request $r, Asset $asset)
    {
        $data = $r->validate([
            'employee_id' => 'nullable|exists:employees,id',
            'location_id'  => 'nullable|exists:locations,id',
        ]);

        AssetAssignment::create([
            'asset_id' => $asset->id,
            'employee_id' => $data['employee_id'] ?? null,
            'location_id' => $data['location_id'] ?? null,
            'assigned_at' => Carbon::now(),
            'condition_notes' => $r->condition_notes,
        ]);

        $asset->update([
            'current_employee_id' => $data['employee_id'] ?? null,
            'location_id' => $data['location_id'] ?? $asset->location_id,
            'status' => 'assigned',
        ]);

        AssetStatusLog::create([
            'asset_id'=>$asset->id,
            'from_status'=> 'in_stock',
            'to_status'  => 'assigned',
            'changed_by' => optional(Auth::user())->id,
            'changed_at' => Carbon::now(),
            'remarks'    => 'Assigned via web',
        ]);

        return back()->with('success','Asset assigned');
    }

    public function checkin(Request $r, Asset $asset)
    {
        $last = $asset->assignments()->latest()->first();
        if ($last && !$last->returned_at) {
            $last->update(['returned_at' => now()]);
        }
        $asset->update([
            'current_employee_id' => null,
            'status' => 'in_stock',
        ]);

        AssetStatusLog::create([
            'asset_id'=>$asset->id,
            'from_status'=> 'assigned',
            'to_status'  => 'in_stock',
            'changed_by' => optional(auth()->user())->id,
            'changed_at' => now(),
            'remarks'    => 'Check-in',
        ]);

        return back()->with('success','Asset checked-in');
    }

    // Select2 AJAX
    public function ajaxEmployees(Request $r){
        $term = $r->q;
        $items = Employee::query()
            ->select('id','code','full_name')
            ->when($term, fn($q)=>$q->where('full_name','like',"%$term%"))
            ->limit(20)->get()
            ->map(fn($e)=>['id'=>$e->id,'text'=>"{$e->code} — {$e->full_name}"]);
        return response()->json(['results'=>$items]);
    }

    public function ajaxLocations(Request $r){
        $term = $r->q;
        $items = Location::query()
            ->select('id','code','name')
            ->when($term, fn($q)=>$q->where('name','like',"%$term%"))
            ->limit(20)->get()
            ->map(fn($l)=>['id'=>$l->id,'text'=>"{$l->code} — {$l->name}"]);
        return response()->json(['results'=>$items]);
    }
}
```
---

# Blade: App + Filter (Bootstrap 5, Select2)
```blade
{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Asset Management')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Asset Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('assets.index') }}">Assets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('components.index') }}">Components</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    <footer class="bg-light py-3 mt-5">
        <div class="container text-center">
            <small class="text-muted">Asset Management System &copy; {{ date('Y') }}</small>
        </div>
    </footer>

    <!-- SweetAlert2 Flash Messages -->
    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: @json(session('success')),
                timer: 1800,
                showConfirmButton: false
            });
        });
    </script>
    @endif

    @if($errors->any())
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                html: @json(implode('<br>', $errors->all()))
            });
        });
    </script>
    @endif
</body>
</html>

```

---

# Blade: Index + Filter (Bootstrap 5, Select2)
```blade
{{-- resources/views/assets/index.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="d-flex align-items-center mb-3">
  <h4 class="me-auto">Assets</h4>
  <a class="btn btn-primary" href="{{ route('assets.create') }}">Create</a>
</div>

<form method="get" class="row g-2 mb-3">
  <div class="col-12 col-md-3">
    <select name="status" class="form-select select2" data-placeholder="Status">
      <option value="">All Status</option>
      @foreach(['draft','in_stock','assigned','maintenance','lost','retired'] as $s)
        <option value="{{ $s }}" {{ request('status')==$s?'selected':'' }}>{{ strtoupper($s) }}</option>
      @endforeach
    </select>
  </div>
  <div class="col-12 col-md-4">
    <select name="employee_id" class="form-select select2-ajax" data-url="{{ route('ajax.employees') }}" data-placeholder="Pemilik (Employee)"></select>
  </div>
  <div class="col-12 col-md-4">
    <select name="location_id" class="form-select select2-ajax" data-url="{{ route('ajax.locations') }}" data-placeholder="Lokasi"></select>
  </div>
  <div class="col-12 col-md-1">
    <button class="btn btn-outline-secondary w-100">Filter</button>
  </div>
</form>

<div class="table-responsive">
<table class="table table-hover align-middle">
  <thead class="table-light">
    <tr>
      <th>Tag</th><th>Nama</th><th>Kategori</th><th>Lokasi</th>
      <th>Pemilik</th><th>Status</th><th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($assets as $a)
    <tr>
      <td><span class="badge text-bg-dark">{{ $a->tag_code }}</span></td>
      <td>
        <a href="{{ route('assets.show',$a) }}">{{ $a->name }}</a><br>
        <small class="text-muted">{{ $a->brand }} {{ $a->model }} • SN: {{ $a->serial_no }}</small>
      </td>
      <td>{{ optional($a->category)->name }}</td>
      <td>{{ optional($a->location)->name }}</td>
      <td>{{ optional($a->employee)->full_name ?: '-' }}</td>
      <td><span class="badge text-bg-{{ $a->status=='assigned'?'primary':($a->status=='in_stock'?'success':($a->status=='maintenance'?'warning':'secondary')) }}">{{ strtoupper($a->status) }}</span></td>
      <td class="text-end">
        <a href="{{ route('assets.edit',$a) }}" class="btn btn-sm btn-outline-warning">Edit</a>
        <button type="button" class="btn btn-sm btn-outline-danger btn-delete" data-url="{{ route('assets.destroy',$a) }}">Delete</button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>

{{ $assets->withQueryString()->links() }}

@endsection

@push('scripts')
<script>
$(function(){
  $('.select2').select2({ allowClear:true, placeholder: function(){return $(this).data('placeholder')} });
  $('.select2-ajax').each(function(){
    $(this).select2({
      allowClear:true, placeholder: $(this).data('placeholder'),
      ajax: {
        url: $(this).data('url'), delay: 250, dataType:'json',
        data: params => ({ q: params.term }),
        processResults: data => data
      }
    });
  });

  $('.btn-delete').on('click', function(){
    const url = $(this).data('url');
    Swal.fire({
      title:'Hapus asset?', icon:'warning', showCancelButton:true,
      confirmButtonText:'Ya, hapus', cancelButtonText:'Batal'
    }).then((res)=>{ if(res.isConfirmed){
      const form = $('<form>',{method:'POST',action:url});
      form.append('@csrf'); form.append('@method("DELETE")');
      $('body').append(form); form.submit();
    }})
  })
})
</script>
@endpush
```

---

# Blade: Show (QR, Assign, Components)
```blade
{{-- resources/views/assets/show.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="row g-3">
  <div class="col-lg-8">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-1">{{ $asset->name }} <span class="badge text-bg-secondary">{{ $asset->tag_code }}</span></h5>
        <div class="text-muted mb-3">{{ $asset->brand }} {{ $asset->model }} • SN: {{ $asset->serial_no }}</div>
        <dl class="row mb-0">
          <dt class="col-3">Kategori</dt><dd class="col-9">{{ optional($asset->category)->name }}</dd>
          <dt class="col-3">Lokasi</dt><dd class="col-9">{{ optional($asset->location)->name }}</dd>
          <dt class="col-3">Pemilik</dt><dd class="col-9">{{ optional($asset->employee)->full_name ?: '-' }}</dd>
          <dt class="col-3">Status</dt><dd class="col-9"><span class="badge text-bg-primary">{{ strtoupper($asset->status) }}</span></dd>
        </dl>
      </div>
    </div>

    <div class="card mt-3">
      <div class="card-header">Komponen Terpasang</div>
      <div class="card-body p-0">
        <table class="table table-sm mb-0">
          <thead><tr><th>Tag</th><th>Nama</th><th>SN</th><th>Status</th></tr></thead>
          <tbody>
            @forelse($asset->components as $c)
              <tr>
                <td><span class="badge text-bg-dark">{{ $c->tag_code }}</span></td>
                <td>{{ $c->name }}</td>
                <td>{{ $c->serial_no }}</td>
                <td>{{ strtoupper($c->status) }}</td>
              </tr>
            @empty
              <tr><td colspan="4" class="text-center text-muted">Belum ada komponen</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div class="card mt-3">
      <div class="card-header">Riwayat Assignment</div>
      <div class="card-body p-0">
        <table class="table table-sm mb-0">
          <thead><tr><th>Tanggal</th><th>Pemilik</th><th>Lokasi</th><th>Returned</th></tr></thead>
          <tbody>
            @foreach($asset->assignments as $a)
            <tr>
              <td>{{ $a->assigned_at }}</td>
              <td>{{ optional($a->employee)->full_name }}</td>
              <td>{{ optional($a->location)->name }}</td>
              <td>{{ $a->returned_at ?: '-' }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header">QR / Asset Tag</div>
      <div class="card-body text-center">
        {{-- Generate QR via package (lihat catatan) --}}
        <img src="{{ route('assets.qr',$asset) }}" alt="QR" class="img-fluid" style="max-width:220px">
        <div class="small text-muted mt-2">Scan untuk buka detail</div>
      </div>
    </div>

    <div class="card mt-3">
      <div class="card-header">Assign / Check-in</div>
      <div class="card-body">
        <form method="post" action="{{ route('assets.assign',$asset) }}" id="frm-assign">
          @csrf
          <div class="mb-2">
            <label class="form-label">Employee</label>
            <select name="employee_id" class="form-select select2-ajax" data-url="{{ route('ajax.employees') }}"></select>
          </div>
          <div class="mb-2">
            <label class="form-label">Lokasi</label>
            <select name="location_id" class="form-select select2-ajax" data-url="{{ route('ajax.locations') }}"></select>
          </div>
          <div class="mb-2">
            <textarea name="condition_notes" class="form-control" placeholder="Catatan kondisi (opsional)"></textarea>
          </div>
          <button class="btn btn-primary w-100">Assign</button>
        </form>
        <hr>
        <button class="btn btn-outline-secondary w-100" id="btn-checkin">Check-in</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
$(function(){
  $('.select2-ajax').each(function(){
    $(this).select2({ajax:{url: $(this).data('url'), data: p=>({q:p.term}), processResults: d=>d}, width:'100%'});
  });
  $('#btn-checkin').on('click', function(){
    Swal.fire({title:'Check-in asset?', icon:'question', showCancelButton:true}).then(res=>{
      if(res.isConfirmed){
        const form = $('<form>', {method:'POST', action:'{{ route('assets.checkin',$asset) }}'});
        form.append('@csrf');
        $('body').append(form); form.trigger('submit');
      }
    })
  })
});
</script>
@endpush
```

---

# QR/Barcode Asset Tag
**Opsi 1 (QR Code gambar):** gunakan package `simplesoftwareio/simple-qrcode`.
- Install: `composer require simplesoftwareio/simple-qrcode`
- Route tambahan untuk render QR PNG:
```php
// routes/web.php
Route::get('assets/{asset}/qr', function(\App\Models\Asset $asset){
    $png = \SimpleSoftwareIO\QrCode\Facades\QrCode::format('png')->size(400)->margin(1)
        ->generate(route('assets.show',$asset));
    return response($png)->header('Content-Type','image/png');
})->name('assets.qr');
```
**Opsi 2 (Barcode Code128 untuk tag_code):** `milon/barcode` atau cetak via thermal label printer.

---

# SweetAlert2 Global Flash
Tambahkan di layout agar sukses/error tampil cantik.
```blade
@if(session('success'))
<script>Swal.fire({icon:'success', title:@json(session('success')), timer:1800, showConfirmButton:false});</script>
@endif
@if($errors->any())
<script>Swal.fire({icon:'error', title:'Gagal', html:@json(implode('<br>',$errors->all()))});</script>
@endif
```

---

# Seeder
```php
// database/seeders/AssetSeed.php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{AssetType, Category, Location, Department, Employee, Asset};
use Illuminate\Support\Str;

class AssetSeed extends Seeder
{
    public function run(): void
    {
        $it = AssetType::firstOrCreate(['name'=>'IT Equipment']);
        $catLaptop = Category::firstOrCreate(['name'=>'Laptop','asset_type_id'=>$it->id]);
        $hq = Location::firstOrCreate(['code'=>'HQ-1F-IT','name'=>'HQ Lantai 1 - IT']);
        $dep = Department::firstOrCreate(['code'=>'IT','name'=>'Information Technology']);
        $emp = Employee::firstOrCreate(['code'=>'E001'], ['full_name'=>'Budi Setiawan']);

        Asset::create([
            'tag_code'=> strtoupper(Str::random(10)),
            'name'=>'Laptop Admin Gudang',
            'category_id'=>$catLaptop->id,
            'brand'=>'Lenovo','model'=>'ThinkPad X1','serial_no'=>'SN12345',
            'status'=>'in_stock','location_id'=>$hq->id,'department_id'=>$dep->id,
            'specs_json'=>['cpu'=>'i7','ram'=>'16GB','ssd'=>'512GB']
        ]);
    }
}
```

---

# Praktik Baik & Ekstensi (opsional)
- **DataTables** untuk tabel besar (server-side dengan AJAX) → cepat dan familiar.
- **Policies/Permissions** (spatie/laravel-permission) untuk kontrol akses (IT only edit, user view own).
- **Import Excel** (maatwebsite/excel) untuk bulk upload aset.
- **Cetak Label**: buat blade khusus label (ukuran 50×25mm) dengan QR & tag_code → print PDF/thermal.
- **API untuk Mobile Scan** (Laravel Sanctum) → scan QR buka detail + quick action (check-in/out).
- **Reminder Garansi**: scheduler memeriksa garansi mau habis → kirim email/telegram.
- **Integrasi Purchase**: kaitkan dengan modul Pembelian/PO untuk asal aset.
- **Stock Komponen**: mutasi komponen (in/out) seperti inventory sederhana.

---

# Alur Kerja
1. **Buat kategori & lokasi** dasar.
2. **Create Asset** (manual/import), sistem otomatis **tag_code**.
3. Cetak **QR/Tag** dan tempel di perangkat.
4. **Assign** ke karyawan/lokasi → status jadi *assigned*.
5. **Check-in** saat dikembalikan → status *in_stock*.
6. Buat **Ticket maintenance** jika rusak → status *maintenance*.
7. **Retire/Dispose** bila afkir → status *retired* (arsip riwayat tetap).

---

# Catatan Integrasi UI
- **Bootstrap 5** untuk layout.
- **jQuery** untuk event ringan.
- **Select2** untuk field pencarian AJAX (employee, lokasi, asset).
- **SweetAlert2** untuk konfirmasi & flash.

> Dokumen ini adalah kerangka siap-implementasi. Anda bisa copy–paste bertahap ke project Laravel Anda dan menyesuaikan naming/namespace sesuai standar tim.

