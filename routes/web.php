<?php

use App\Models\User;
use App\Models\Contract;
use App\Notifications\ContractExpiringNotification;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\TenantController; 
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PropertyUnitController;
use App\Http\Controllers\PropertyUnitFacilityController;
use App\Http\Controllers\FacilityUsageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// route umum
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth'])->name('admin.dashboard');

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/contracts', [ContractController::class, 'index'])->middleware('role:Admin|Staff');

// hanya yg punya permission
Route::get('/reports', function () {
    return view('reports.index');
})->middleware('permission:view reports');

// notifikasi testing
Route::get('/test-notif', function () {
    $admin = User::first();
    $contract = Contract::first();

    if (!$admin) {
        return "Gagal: User belum ada!";
    }

    if (!$contract) {
        return "Gagal: Contract belum ada!";
    }

    $admin->notify(new ContractExpiringNotification($contract));

    return "✅ Notifikasi berhasil dikirim ke {$admin->name}";
    });

// nandai notifikasi sbg sudah dibaca
Route::post('/notifications/read', function () {
    // pakai user pertama
    $admin = User::first();
    if ($admin) {
        $admin->unreadNotifications->markAsRead();
    }
    return back();
})->name('notifications.read');

// ROUTE KHUSUS ADMIN
Route::group(['middleware' => ['role:Admin']], function() {
    Route::resource('users', UserController::class);
    Route::resource('companies', CompanyController::class);
});

// ROUTE YANG MEMBUTUHKAN AUTENTIKASI
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ROUTE KHUSUS ADMIN & STAFF
Route::get('/contracts', [ContractController::class, 'index'])->middleware('role:Admin|Staff');

// ROUTE DENGAN PERMISSION
Route::get('/reports', function () {
    return view('reports.index');
})->middleware('permission:view reports');

// ROUTE RESOURCE LAINNYA
Route::resource('reports', ReportController::class);

Route::resource('facilities', FacilityController::class);
Route::get('/facilities/reset', [FacilityController::class, 'resetFacilities'])->name('facilities.reset');

// === TENANTS ===
Route::get('/tenants/print', [TenantController::class, 'print'])->name('tenants.print');
Route::get('/tenants/print/{id}', [TenantController::class, 'printOne'])->name('tenants.print.one');
Route::resource('tenants', TenantController::class);

// === PROPERTIES ===
Route::resource('properties', PropertyController::class);

// === PROPERTY UNITS ===
Route::get('/property_units/manage', [PropertyUnitController::class, 'manage'])->name('property_units.manage');
Route::post('/property_units/{id}/book', [App\Http\Controllers\PropertyUnitController::class, 'book'])->name('property_units.book');
Route::resource('property_units', PropertyUnitController::class);
// Route::delete('property_units/{id}', [PropertyUnitController::class, 'destroy'])->name('property_units.destroy');

// === PAYMENTS ===
Route::resource('payments', PaymentController::class);

// === CONTRACTS ===
Route::get('/contracts/print', [ContractController::class, 'print'])->name('contracts.print');  
Route::get('/contracts/print/{id}', [ContractController::class, 'printOne'])->name('contracts.print.one');
Route::resource('contracts', ContractController::class);

// === PROPERTY UNIT FACILITIES ===
Route::resource('property_unit_facilities', PropertyUnitFacilityController::class);

// === FACILITY USAGES ===
Route::resource('facility_usages', FacilityUsageController::class);

require __DIR__.'/auth.php';