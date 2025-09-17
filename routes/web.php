<?php

use App\Models\User;
use App\Models\Contract;
use App\Notifications\ContractExpiringNotification;
use Illuminate\Support\Facades\Route;
use Kreait\Firebase\Factory;

use App\Http\Controllers\Auth\{
    ForgotPasswordController,
    ResetPasswordController,
    GoogleController,
    LoginController
};

use App\Http\Controllers\{
    CompanyController,
    FacilityController,
    TenantController,
    PropertyController,
    ContractController,
    PaymentController,
    PropertyUnitController,
    PropertyUnitFacilityController,
    FacilityUsageController,
    UserController,
    ReportController,
    DashboardController,
    ProfileController,
    AdminController,
    StaffController
};

// routes/web.php
Route::post('/save-fcm-token', [App\Http\Controllers\NotificationController::class, 'saveToken']);

Route::get('/test-fcm', function () {
    $factory = (new Factory)->withServiceAccount(config('services.firebase.credentials'));
    $messaging = $factory->createMessaging();

    $deviceToken = 'ISI_FCM_DEVICE_TOKEN_DISINI'; // ganti token dari device user

    $message = [
        'token' => $deviceToken,
        'notification' => [
            'title' => 'Hello from Laravel 🚀',
            'body' => 'Push notification berhasil dikirim!',
        ],
    ];

    try {
        $messaging->send($message);
        return 'Notification sent!';
    } catch (\Throwable $e) {
        return 'Error: ' . $e->getMessage();
    }
}); 

// Login & Logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

        
// Redirect to login
Route::get('/', function () {
    if (!auth()->check()) {
        return redirect()->route('login');
    }

    $user = auth()->user();

    switch (strtolower($user->role)) {
        case 'admin':
            return redirect()->route('admin.dashboard');
        case 'staff':
            return redirect()->route('staff.dashboard');
        case 'tenant':
            return redirect()->route('tenant.dashboard');
        default:
            Auth::logout(); // role aneh, logout saja
            return redirect()->route('login');
    }
});

// STAFF DAN ADMIN - akses tenant
Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::resource('tenants', TenantController::class)->only(['index', 'show', 'create', 'store', 'edit', 'update', 'destroy']);
});


// ADMIN - bisa akses semua
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resource('users', UserController::class);
    Route::resource('companies', CompanyController::class);
    Route::resource('facilities', FacilityController::class);
    Route::resource('properties', PropertyController::class);
    Route::resource('contracts', ContractController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('reports', ReportController::class);
});

// STAFF - akses terbatas
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
});

// TENANT - akses dashboard pribadi
Route::middleware(['auth', 'role:tenant'])->group(function () {
    Route::post('/tenants/{tenant}/device-token', [TenantController::class, 'updateDeviceToken']);
    Route::get('/tenant/dashboard', [TenantController::class, 'dashboard'])->name('tenant.dashboard');
});


/*
|--------------------------------------------------------------------------
| SHARED ROUTES (SEMUA ROLE)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Property Units
    Route::get('/property_units/manage', [PropertyUnitController::class, 'manage'])->name('property_units.manage');
    Route::post('/property_units/{id}/book', [PropertyUnitController::class, 'book'])->name('property_units.book');
    Route::resource('property_units', PropertyUnitController::class);

    // Property Unit Facilities
    Route::resource('property_unit_facilities', PropertyUnitFacilityController::class);

    // Facility Usages
    Route::resource('facility_usages', FacilityUsageController::class);

    // Tenants Print
    Route::get('/tenants-print', [TenantController::class, 'print'])->name('tenants.print');
    Route::get('/tenants-print/{id}', [TenantController::class, 'printOne'])->name('tenants.print.one');

    // Contracts Print
    Route::get('/contracts-print', [ContractController::class, 'print'])->name('contracts.print');
    Route::get('/contracts-print/{id}', [ContractController::class, 'printOne'])->name('contracts.print.one');


    // Contract Reminder
    Route::get('/contracts/{id}/reminder', [ContractController::class, 'sendReminder'])->name('contracts.reminder');
    Route::get('/test-mail', function() {
    Mail::raw('Ini test email Laravel', function($message) {
        $message->to('bellanatasyaam@gmail.com')  // ganti dengan email kamu sendiri
                ->subject('Test Email');
    });
    return 'Email berhasil dikirim!';
    });
});

// Google OAuth Routes
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Form untuk minta reset password
Route::get('password/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Form untuk reset password via token
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

/*
|--------------------------------------------------------------------------
| NOTIFICATIONS
|--------------------------------------------------------------------------
*/
Route::get('/test-notif', function () {
    $admin = User::first();
    $contract = Contract::first();

    if (!$admin) return "Gagal: User belum ada!";
    if (!$contract) return "Gagal: Contract belum ada!";

    $admin->notify(new ContractExpiringNotification($contract));
    return "✅ Notifikasi berhasil dikirim ke {$admin->name}";
});

Route::post('/notifications/read', function () {
    $admin = User::first();
    if ($admin) $admin->unreadNotifications->markAsRead();
    return back();
})->name('notifications.read');

require __DIR__ . '/auth.php';