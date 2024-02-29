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

Route::prefix('entreprise')->group(function () {
    Route::get('/', [App\Http\Controllers\CompanyController::class, 'index'])->name('companies');
    Route::get('/{slug}/{id}', [App\Http\Controllers\CompanyController::class, 'single'])->name('company');
    Route::get('/offre/{slug}/{id}', [App\Http\Controllers\CompanyOfferController::class, 'single'])->name('company.offers');
});
/* Offers */
Route::get('/offres', [App\Http\Controllers\CompanyOfferController::class, 'index'])->name('offers');
Route::get('/offres/search', [App\Http\Controllers\CompanyOfferController::class, 'search'])->name('offers.search');
Route::post('/favorite/add/{id}', [App\Http\Controllers\CompanyOfferController::class, 'addFavoriteOffer'])->name('offer.add.favorite')->middleware(['auth']);
Route::delete('/favorite/remove/{id}', [App\Http\Controllers\CompanyOfferController::class, 'removeFavoriteOffer'])->name('offer.remove.favorite')->middleware(['auth']);

/* Apply */
Route::post('/offre/apply', [App\Http\Controllers\CompanyOfferController::class, 'apply'])->name('offers.apply')->middleware(['auth']);
Route::put('/offer/{id}/status', [App\Http\Controllers\CompanyOfferController::class, 'updateStatus'])->name('offer.update.status');

/* User */
Route::get('/candidat/{id}', [App\Http\Controllers\UserController::class, 'single'])->name('user.panel')->middleware(['auth']);

/* Auth */
/* Login */
Route::get('/connexion', [App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::post('/connexion', [App\Http\Controllers\AuthController::class, 'doLogin']);

/* Register Company */
Route::get('/inscription_entreprise', [App\Http\Controllers\AuthController::class, 'registerCompany'])->name('auth.register.company');
Route::post('/inscription_entreprise', [App\Http\Controllers\AuthController::class, 'doRegisterCompany']);

/* Register User */
Route::get('/inscription_candidat', [App\Http\Controllers\AuthController::class, 'registerUser'])->name('auth.register.user');
Route::post('/inscription_candidat', [App\Http\Controllers\AuthController::class, 'doRegisterUser']);

/* Logout */
Route::get('/déconnexion', [App\Http\Controllers\AuthController::class, 'logout'])->name('auth.logout');

/* Verify Email */
Route::get('/verify_email/{email}', [App\Http\Controllers\AuthController::class, 'verify'])->name('verification.verify');
/* Message */
Route::post('/conversation/message', [App\Http\Controllers\ConversationController::class, 'createMessage'])->name('conversation.message.create');
/* Dashboard */
Route::prefix('dashboard')->middleware(['auth','checkrole'])->group(function () {
    /* GET */
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/entreprise', [App\Http\Controllers\DashboardController::class, 'viewCompany'])->name('dashboard.company');
    Route::get('/offres', [App\Http\Controllers\DashboardController::class, 'viewOffersByCompany'])->name('dashboard.offers');
    Route::get('/offre/{slug}/{id}', [App\Http\Controllers\DashboardController::class, 'viewSingleOfferByCompany'])->name('dashboard.offer');
    Route::get('/candidatures', [App\Http\Controllers\DashboardController::class, 'offerApply'])->name('dashboard.apply');

    /* POST */
    Route::post('/modification_entreprise/{id}', [App\Http\Controllers\CompanyController::class, 'update'])->name('dashboard.company.update');
    Route::post('/offres', [App\Http\Controllers\CompanyOfferController::class, 'store'])->name('dashboard.offers.store');
    Route::post('/modification_offre/{id}', [App\Http\Controllers\CompanyOfferController::class, 'update'])->name('dashboard.offers.update');
    /* Conversation */
    Route::get('/conversation', [App\Http\Controllers\ConversationController::class, 'showAdmin'])->name('conversations.show');
    Route::post('/conversation', [App\Http\Controllers\ConversationController::class, 'store'])->name('conversation.store');
    /* DELETE */
    Route::delete('/offre/{id}', [App\Http\Controllers\CompanyOfferController::class, 'delete'])->name('dashboard.offers.delete');
});


