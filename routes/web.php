<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SellerRegistrationController;
use Illuminate\Support\Facades\Route;

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
    return view('homepage');
});

Route::middleware(['throttle:api'])->post('/login/authenticate', [LoginController::class, 'auth'])
    ->name('authenticate');

Route::post('/account/create', [RegisterController::class, 'createAccount'])
    ->name('account.create');

Route::group(['controller' => SellerRegistrationController::class], function () {
    Route::get('/register-business-seller', 'create')
        ->name('business.create');
    Route::post('/register-business-seller', 'store')
        ->name('business.store');
});

Route::get('register-business-investor', function () {
    return view('guests.register-business-investor');
})->name('registerInvestor');

Route::group(['controller' => BusinessProfileController::class], function () {
    Route::get('/business-profile-registration', 'create')
        ->name('business.profile.create');
    Route::post('/business-profile-registration', 'store')
        ->name('business.profile.store');
});

Route::get('verification-call-page', function () {
    return view('seller.verification-call-page');
})->name('businessVerificationCallPage');

Route::get('profile-overview', function () {
    return view('seller.profile-overview');
})->name('sellerProfileOverview');

Route::get('investors-and-buyers', function () {
    return view('seller.investors-and-buyers');
})->name('investorsAndBuyers');

Route::get('active-introductions', [ProfileController::class, 'index'])
    ->name('activeIntro');

Route::get('seller-inbox', function () {
    return view('seller.inbox');
})->name('inbox');
Route::get('seller-notifications', function () {
    return view('seller.notifications');
})->name('notifications');
Route::get('blogs', function () {
    return view('blog');
})->name('blog');
Route::get('blog/{id}', function () {
    return view('single-blog');
})->name('singleBlog');


Route::get('business-buyer-profile-overview', function () {
    return view('buyer.buyer-profile');
})->name('buyerProfile');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
