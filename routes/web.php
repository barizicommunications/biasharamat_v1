<?php

use App\Livewire\TestComponent;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IntroductionController;
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

Route::get('frequently-asked-questions', function () {
    return view('faqs');
})->name('faqs');

Route::get('test',TestComponent::class)->name('test');

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
    Route::get('/register-business-investor', 'create')
        ->name('investor.create');
    Route::post('/register-business-investor', 'store')
        ->name('investor.store');
});

// Add these routes to your web.php file

// Introduction Request Routes
Route::middleware('auth')->group(function () {
    // Show introduction request form
    Route::get('/request-introduction', [IntroductionController::class, 'show'])
        ->name('introduction.request');

    // Show introduction request form with pre-filled data (this matches the route used in profile pages)
    Route::get('/request-introduction/{type}/{id}', [IntroductionController::class, 'show'])
        ->name('request.introduction')
        ->where(['type' => 'business|investor', 'id' => '[0-9]+']);

    // Handle introduction request submission
    Route::post('/request-introduction', [IntroductionController::class, 'store'])
        ->name('introduction.request.submit');

    // Admin routes for managing introduction requests
    Route::prefix('admin')->middleware(['auth', 'role:Admin'])->group(function () {
        Route::get('/introduction-requests', [IntroductionController::class, 'index'])
            ->name('admin.introduction.requests');
        Route::patch('/introduction-requests/{id}/approve', [IntroductionController::class, 'approve'])
            ->name('admin.introduction.approve');
        Route::patch('/introduction-requests/{id}/reject', [IntroductionController::class, 'reject'])
            ->name('admin.introduction.reject');
    });
});

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
    Route::get('/investors', 'index')
        ->name('investors');
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

// Message routes
Route::post('/messages/send/{recipient}', [MessageController::class, 'sendMessage'])->name('messages.send')->middleware('auth');
Route::post('/messages/reply/{conversation}', [MessageController::class, 'replyMessage'])->name('messages.reply')->middleware('auth');

Route::get('investment-opportunities', [InvestorsAndBuyersController::class, 'index'])->name('investorsAndBuyers');

Route::get('active-introductions', [ProfileController::class, 'index'])
    ->name('activeIntro');

Route::get('/active-introductions', [ProfileController::class, 'inbox'])
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

Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';