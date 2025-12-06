<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//FRONTEND CONTROLLERS
use App\Http\Controllers\Frontend\AuthController AS FrontendAuth;
use App\Http\Controllers\Frontend\FrontendController AS Frontend;

//BACKEND CONTROLLERS

// D
use App\Http\Controllers\Backend\DashboardController AS BackendDashboard;

// L
use App\Http\Controllers\Backend\LocalizationsController AS BackendLocalizations;

// N
use App\Http\Controllers\Backend\NewsController AS BackendNews;


//1 - Frontend Routes
Route::group([ 'prefix' =>'/', 'middleware' => ['setLocale']], function () {

    Route::get('/', [Frontend::class, 'index'])->name('frontend.homepage');

    Route::get('/set-localization/{lang}', [Frontend::class, 'localization'])->name('frontend.localization');


    Route::get('/sign-in', [FrontendAuth::class, 'signIn'])->name('frontend.auth.signIn');
    Route::post('/sign-in/create', [FrontendAuth::class, 'login'])->name('frontend.auth.login');
    Route::post('/sign-up/create', [FrontendAuth::class, 'store'])->name('frontend.auth.store');
    Route::post('/app-logout', [FrontendAuth::class, 'appLogout'])->name('frontend.auth.appLogout');


});



//2 - Auth Routes
Route::middleware(['auth', 'verified'])->group(function () {

    //2 - Admin Routes
    Route::group([ 'prefix' =>'admin', 'middleware' => ['isAdmin']], function () {
//        dd('admin');

        // D
        Route::get('/', [BackendDashboard::class, 'index'])->name('backend.dashboard');


        // L
        Route::get('/localizations', [BackendLocalizations::class, 'index'])->name('backend.localizations.index');
        Route::get('/localizations/create', [BackendLocalizations::class, 'create'])->name('backend.localizations.create');
        Route::get('/localizations/edit/{slug}', [BackendLocalizations::class, 'edit'])->name('backend.localizations.edit');
        Route::post('/localizations/store', [BackendLocalizations::class, 'store'])->name('backend.localizations.store');


        // N
        Route::get('/news', [BackendNews::class, 'index'])->name('backend.news.index');
        Route::get('/news/create', [BackendNews::class, 'create'])->name('backend.news.create');
        Route::get('/news/edit/{slug}', [BackendNews::class, 'edit'])->name('backend.news.edit');
        Route::post('/news/store', [BackendNews::class, 'store'])->name('backend.news.store');
        Route::post('/news/delete', [BackendNews::class, 'delete'])->name('backend.news.delete');
        Route::post('/news/slug-generator', [BackendNews::class, 'slugGenerator'])->name('backend.news.slugGenerator');
        Route::post('/news/upload-image', [BackendNews::class, 'imageUpload'])->name('backend.news.imageUpload');
        Route::post('/news/set-primary-image', [BackendNews::class, 'setPrimaryImage'])->name('backend.news.setPrimaryImage');
        Route::post('/news/image-delete', [BackendNews::class, 'deleteImage'])->name('backend.news.deleteImage');




    });


    //3 - Reservations Manager Routes
    Route::group([ 'prefix' =>'reservations', 'middleware' => ['isReservationsManager']], function () {
//        dd('isReservationsManager');
        // D
        Route::get('/', [BackendDashboard::class, 'index'])->name('backend.dashboard');


    });





    /*Route::post('/users/upload-image', [BackendUsers::class, 'imageUpload'])->name('backend.users.imageUpload');
    Route::get('/my-account', [Frontend::class, 'myAccount'])->name('frontend.myAccount');
    Route::get('/my-account/inbox', [Frontend::class, 'myAccountInbox'])->name('frontend.myAccount.myAccountInbox');
    Route::get('/my-account/subscription', [Frontend::class, 'myAccountSubscription'])->name('frontend.myAccount.myAccountSubscription');
    Route::get('/my-account/privacy', [Frontend::class, 'myAccountPrivacy'])->name('frontend.myAccount.myAccountPrivacy');
    Route::get('/my-account/customer-portal', [Frontend::class, 'myAccountCustomerPortal'])->name('frontend.myAccount.myAccountCustomerPortal');
    Route::get('/my-account/subscribe/{slug}', [Frontend::class, 'myAccountSubscribe'])->name('frontend.myAccount.myAccountSubscribe');
    Route::get('/my-account/subscription-success', [Frontend::class, 'myAccountSubscriptionSuccess'])->name('frontend.myAccount.myAccountSubscriptionSuccess');
    Route::get('/my-account/subscription-canceled', [Frontend::class, 'myAccountSubscriptionCanceled'])->name('frontend.myAccount.myAccountSubscriptionCanceled');



    Route::post('/my-account/update', [Frontend::class, 'myAccountUpdate'])->name('frontend.myAccountUpdate');
    Route::post('/my-account/privacy/update', [Frontend::class, 'myAccountPrivacyUpdate'])->name('frontend.myAccountPrivacyUpdate');
    Route::post('/my-account/subscription/update', [Frontend::class, 'myAccountSubscriptionUpdate'])->name('frontend.myAccountSubscriptionUpdate');
    Route::post('/my-account/get-inbox', [Frontend::class, 'myAccountGetMessage'])->name('frontend.myAccount.myAccountGetMessage');*/


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::fallback(function () {
    return view('errors.404');
})->middleware('setLocale');

require __DIR__.'/auth.php';
