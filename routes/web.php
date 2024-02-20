<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyOfferController;

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
})->name('home');

Route::prefix('company')->group(function () {
    Route::get('/', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies');
    Route::get('/{id}', [App\Http\Controllers\CompanyController::class, 'single'])->name('company');
    Route::get('/offer/{id}', [App\Http\Controllers\CompanyOfferController::class, 'single']);
});

/* Auth */
Route::get('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'doLogin']);
Route::get('/register', [App\Http\Controllers\AuthController::class, 'register'])->name('auth.register');
Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');

/* Dashboard */
Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    /* GET */
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/company', [App\Http\Controllers\DashboardController::class, 'viewCompany'])->name('dashboard.company');
    Route::get('/offers', [App\Http\Controllers\DashboardController::class, 'viewOffersByCompany'])->name('dashboard.offers');
    Route::get('/offer/{id}', [App\Http\Controllers\DashboardController::class, 'viewSingleOfferByCompany'])->name('dashboard.offer');
    /* POST */
    Route::post('/update_company/{id}', [App\Http\Controllers\CompanyController::class, 'update'])->name('dashboard.company.update');
});


