<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::Resource('companies', CompanyController::class);

Route::resource('facilities', FacilityController::class);

Route::get('/facilities/reset', [FacilityController::class, 'resetFacilities'])->name('facilities.reset');

Route::resource('tenants', TenantController::class);
Route::put('/tenants/{tenant}', [TenantController::class, 'update'])->name('tenants.update');

Route::resource('properties', PropertyController::class);

Route::resource('property_units', PropertyUnitController::class);
// Route::delete('property_units/{id}', [PropertyUnitController::class, 'destroy'])->name('property_units.destroy');

Route::resource('contracts', ContractController::class);

Route::resource('payments', PaymentController::class);

Route::resource('property_unit_facilities', PropertyUnitFacilityController::class);

Route::resource('facility_usages', FacilityUsageController::class);
