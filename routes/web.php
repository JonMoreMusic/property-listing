<?php

// Backend
use App\Http\Controllers\Admin\LocationController as AdminLocationController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\MessageController as AdminMessageController;
use App\Http\Controllers\Admin\PropertyController as AdminPropertyController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DashboardController;
use App\Models\User;
use App\Http\Controllers\TwoFactorAuthenticationController;

// Frontend
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Fortify\Fortify;



Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    // Home
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Property
    Route::resource('property', PropertyController::class);
    // Property Enquire
    Route::post('/property/enquire/{id}', [PropertyController::class, 'enquire'])->name('enquireform');
    // Page
    Route::get('/page/{slug}', [HomeController::class, 'pages'])->name('page');
    // Currency Change
    Route::get('/currency-change/{code}', [HomeController::class, 'currencyConverter'])->name('currency');
    //Two factor authentication
    Route::post('/two-factor-challenge', [TwoFactorAuthenticationController::class, 'checkTwoFactorAuthentication'])->name('verify.two-factor-authentication');
});


Route::prefix('dashboard')->middleware('auth')->group(function () {
    // Dashboard/Admin Panel
    Route::get('/', [DashboardController::class,'index'])->name('dashboard');
    // Property
    Route::resource('properties', AdminPropertyController::class);
    // Delete Media
    Route::get('properties/delete-media/{id}', [AdminPropertyController::class, 'destroyMedia'])->name('deleteMedia');
    // Location
    Route::resource('location', AdminLocationController::class);
    // Page
    Route::resource('pages', AdminPageController::class);
    // User
    Route::resource('user', UserController::class);
    // Message
    Route::resource('message', AdminMessageController::class);

    // Define a route for enabling two-factor authentication
/*    Route::post('user/{user}/enable-two-factor-authentication', function ($user) {
        $user = User::findOrFail($user); // Find the user by ID
        $user->enableTwoFactorAuthentication(); // Enable two-factor authentication for the user

        return redirect()->back()->with('status', 'two-factor-authentication-enabled');
    })->name('user.enable-two-factor-authentication');

    // Route for generating 2FA secret
    Route::get('user/generate-2fa-secret', [TwoFactorAuthenticationController::class, 'generate2FASecret'])
        ->name('user.generate-2fa-secret');

    // Route for enabling 2FA
    Route::post('user/enable-2fa', [TwoFactorAuthenticationController::class, 'enable2FA'])
        ->name('user.enable-2fa');*/


});


require __DIR__.'/auth.php';






// Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
//   // Home
//   Route::get('/', [HomeController::class, 'home'])->name('home');
//   // Property
//   Route::get('/property/{id}', [PropertyController::class, 'singleProperty'])->name('single-property');
//   Route::post('/property/enquire/{id}', [PropertyEnquireController::class,'enquire'])->name('enquireform');
//   Route::get('/properties', [PropertyController::class, 'index'])->name('properties');
//   // Page
//   Route::get('/page/{slug}', [PageController::class, 'single'])->name('page');
// });


// Route::prefix('dashboard')->middleware('auth')->group(function () {
//   Route::get('/', [DashboardController::class,'index'])->name('dashboard');
//   Route::get('properties', [DashboardController::class,'properties'])->name('adminProperties');
//   Route::get('properties/addnew', [DashboardController::class,'createProperty'])->name('createProperty');
//   Route::get('properties/edit/{id}', [DashboardController::class, 'editProperty'])->name('editProperty');
//   Route::put('properties/update/{id}', [DashboardController::class, 'updateProperty'])->name('updateProperty');
//   Route::delete('properties/destroy/{id}', [DashboardController::class, 'destroyProperty'])->name('destroyProperty');
//   Route::post('properties/store', [DashboardController::class, 'storeProperty'])->name('storeProperty');

//   Route::get('properties/delete-media/{id}', [DashboardController::class, 'deleteMedia'])->name('deleteMedia');

//   // Locations
//   Route::get('locations', [LocationController::class, 'index'])->name('adminLocations');
//   Route::get('locations/create', [LocationController::class, 'create'])->name('createLocation');
//   Route::post('locations/create/new', [LocationController::class, 'store'])->name('storeLocation');
//   Route::get('location/edit/{id}', [LocationController::class, 'edit'])->name('editLocation');
//   Route::put('location/update/{id}', [LocationController::class, 'update'])->name('updateLocation');
//   Route::delete('location/delete/{id}', [LocationController::class, 'destroy'])->name('deleteLocation');
// });
