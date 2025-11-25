<?php
use App\Models\User;
use App\Models\Contract;
use App\Notifications\ContractExpiringNotification;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
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
    StaffController,
    NotificationController
};

// FCM Save Token
Route::post('/save-fcm-token', [NotificationController::class, 'saveToken']);

// Test FCM
Route::get('/test-fcm', function () {
    $factory = (new Factory)->withServiceAccount(config('services.firebase.credentials'));
    $messaging = $factory->createMessaging();

    $deviceToken = 'ISI_FCM_DEVICE_TOKEN_DISINI';

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

// Root Redirect
Route::get('/', function () {
    if (!auth()->check()) return redirect()->route('login');

    $user = auth()->user();
    switch (strtolower($user->role)) {
        case 'admin': return redirect()->route('admin.dashboard');
        case 'staff': return redirect()->route('staff.dashboard');
        case 'tenant': return redirect()->route('tenant.dashboard');
        default:
            Auth::logout();
            return redirect()->route('login');
    }
});


/* ----------------------------------
| STAFF & ADMIN → Tenant CRUD
-----------------------------------*/
Route::middleware(['auth', 'role:admin,staff'])->group(function () {
    Route::resource('tenants', TenantController::class);
});

/* ----------------------------------
| ADMIN ROUTES
-----------------------------------*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::resources([
        'users' => UserController::class,
        'companies' => CompanyController::class,
        'facilities' => FacilityController::class,
        'properties' => PropertyController::class,
        'contracts' => ContractController::class,
        'payments' => PaymentController::class,
        'reports' => ReportController::class,
    ]);
});

/* ----------------------------------
| STAFF ROUTES
-----------------------------------*/
Route::middleware(['auth', 'role:staff'])->group(function () {
    Route::get('/staff/dashboard', [StaffController::class, 'index'])->name('staff.dashboard');
});

/* ----------------------------------
| TENANT ROUTES
-----------------------------------*/
Route::middleware(['auth', 'role:tenant'])->group(function () {
    Route::post('/tenants/{tenant}/device-token', [TenantController::class, 'updateDeviceToken']);
    Route::get('/tenant/dashboard', [TenantController::class, 'dashboard'])->name('tenant.dashboard');
});

/* ----------------------------------
| SHARED AUTH ROUTES
-----------------------------------*/
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

    // Print Routes
    Route::get('/tenants-print', [TenantController::class, 'print'])->name('tenants.print');
    Route::get('/tenants-print/{id}', [TenantController::class, 'printOne'])->name('tenants.print.one');

    Route::get('/contracts-print', [ContractController::class, 'print'])->name('contracts.print');
    Route::get('/contracts-print/{id}', [ContractController::class, 'printOne'])->name('contracts.print.one');

    // Contract Reminder
    Route::get('/contracts/{id}/reminder', [ContractController::class, 'sendReminder'])->name('contracts.reminder');

    // Test Mail
    Route::get('/test-mail', function() {
        Mail::raw('Ini test email Laravel', function($message) {
            $message->to('bellanatasyaam@gmail.com')->subject('Test Email');
        });
        return 'Email berhasil dikirim!';
    });
});

/* ----------------------------------
| GOOGLE AUTH
-----------------------------------*/
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

/* ----------------------------------
| PASSWORD RESET
-----------------------------------*/
Route::get('password/forgot', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

/* ----------------------------------
| NOTIFICATION TEST
-----------------------------------*/
Route::get('/test-notif', function () {
    $admin = User::first();
    $contract = Contract::first();

    if (!$admin) return "Gagal: User belum ada!";
    if (!$contract) return "Gagal: Contract belum ada!";

    $admin->notify(new ContractExpiringNotification($contract));
    return "Notifikasi berhasil dikirim ke {$admin->name}";
});

Route::post('/notifications/read', function () {
    $admin = User::first();
    if ($admin) $admin->unreadNotifications->markAsRead();
    return back();
})->name('notifications.read');

require __DIR__ . '/auth.php';