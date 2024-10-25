<?php

use App\Livewire\TestComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BusinessProfileController;
use App\Http\Controllers\InvestorProfileController;
use App\Http\Controllers\InvestorsAndBuyersController;
use App\Http\Controllers\SellerRegistrationController;
use App\Http\Controllers\InvestorRegistrationController;

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

Route::get('test',TestComponent::class)->name('teat');





Route::get('/about', function () {
    return view('about');
})->name('about');

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

Route::group(['controller' => InvestorRegistrationController::class], function () {
    Route::get('/make-payments', 'makePayment')
        ->name('investor.pay');
    Route::get('/register-business-investor', 'create')
        ->name('investor.create');
    Route::post('/register-business-investor', 'store')
        ->name('investor.store');
});

// Route::get('register-business-investor', function () {
//     return view('guests.register-business-investor');
// })->name('registerInvestor');

Route::group(['controller' => BusinessProfileController::class], function () {
    Route::get('/business-profile-registration', 'create')
        ->name('business.profile.create');
        Route::get('/seller-profile-overview/{id}', 'show')
        ->name('sellerProfileOverview');
        Route::get('verification-call-page', function () {
            return view('seller.verification-call-page');
        })->name('businessVerificationCallPage');
    Route::post('/business-profile-registration', 'store')
        ->name('business.profile.store');
});
Route::group(['controller' => InvestorProfileController::class], function () {
    Route::get('/investor-profile-registration', 'create')
        ->name('investor.profile.create');
        Route::get('investor-verification-call-page', function () {
            return view('buyer.buyer-verification-call');
        })->name('investorVerificationCallPage');
        Route::get('/business-buyer-profile-overview/{id}', 'show')
        ->name('buyer.buyer-profile');
    Route::post('/investor-profile-registration', 'store')
        ->name('investor.profile.store');
});





// Route::get('profile-overview', function () {
//     return view('seller.profile-overview');
// })->name('sellerProfileOverview');

// Route::get('investors-and-buyers', function () {
//     return view('seller.investors-and-buyers');
// })->name('investorsAndBuyers');

Route::get('investors-and-buyers', [InvestorsAndBuyersController::class, 'index'])->name('investorsAndBuyers');

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


// Route::get('business-buyer-profile-overview', function () {
//     return view('buyer.buyer-profile');
// })->name('buyerProfile');



// Route to generate access token (optional, for testing)
Route::get('/payment/token', [PaymentController::class, 'generateAccessToken']);

// Route to register IPN
Route::get('/payment/register-ipn', [PaymentController::class, 'registerIPN']);

// Route to submit an order
Route::post('/payment/submit-order', [PaymentController::class, 'submitOrder']);

// Route to check transaction status
Route::get('/payment/status', [PaymentController::class, 'getTransactionStatus']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});





Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


require __DIR__ . '/auth.php';
