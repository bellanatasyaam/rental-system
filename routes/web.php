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

// === TENANTS ===
Route::get('/tenants/print', [TenantController::class, 'print'])->name('tenants.print');
Route::get('/tenants/print/{id}', [TenantController::class, 'printOne'])->name('tenants.print.one');
Route::resource('tenants', TenantController::class);

Route::resource('properties', PropertyController::class);

// === PROPERTY UNITS ===
Route::get('/property_units/manage', [PropertyUnitController::class, 'manage'])->name('property_units.manage');
Route::post('/property_units/{id}/book', [App\Http\Controllers\PropertyUnitController::class, 'book'])->name('property_units.book');
Route::resource('property_units', PropertyUnitController::class);
// Route::delete('property_units/{id}', [PropertyUnitController::class, 'destroy'])->name('property_units.destroy');

// === CONTRACTS ===
Route::get('/contracts/print', [ContractController::class, 'print'])->name('contracts.print');  
Route::get('/contracts/print/{id}', [ContractController::class, 'printOne'])->name('contracts.print.one');
Route::resource('contracts', ContractController::class);

Route::resource('payments', PaymentController::class);

Route::resource('property_unit_facilities', PropertyUnitFacilityController::class);

Route::resource('facility_usages', FacilityUsageController::class);