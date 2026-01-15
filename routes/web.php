<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//FRONTEND CONTROLLERS
use App\Http\Controllers\Frontend\AuthController AS FrontendAuth;
use App\Http\Controllers\Frontend\FrontendController AS Frontend;

//BACKEND CONTROLLERS

// D
use App\Http\Controllers\Backend\DashboardController AS BackendDashboard;
use App\Http\Controllers\Backend\DownloadsController AS BackendDownloads;
use App\Http\Controllers\Backend\DownloadCategoriesController AS BackendDownloadCategories;
use App\Http\Controllers\Backend\DistrictOfficesController AS BackendDistrictOffices;

// L
use App\Http\Controllers\Backend\LocalizationsController AS BackendLocalizations;

// N
use App\Http\Controllers\Backend\NewsController AS BackendNews;

// P
use App\Http\Controllers\Backend\PressReleasesController AS BackendPressReleases;
use App\Http\Controllers\Backend\ProjectsController AS BackendProjects;

// S
use App\Http\Controllers\Backend\ScreensController AS BackendScreens;
use App\Http\Controllers\Backend\ServicesController AS BackendServices;
use App\Http\Controllers\Backend\ServiceFunctionsController AS BackendServiceFunctions;

// U
use App\Http\Controllers\Backend\UsersController AS BackendUsers;

// V
use App\Http\Controllers\Backend\VideosController AS BackendVideos;


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

        Route::get('/downloads', [BackendDownloads::class, 'index'])->name('backend.downloads.index');
        Route::get('/downloads/create', [BackendDownloads::class, 'create'])->name('backend.downloads.create');
        Route::get('/downloads/edit/{slug}', [BackendDownloads::class, 'edit'])->name('backend.downloads.edit');
        Route::post('/downloads/store', [BackendDownloads::class, 'store'])->name('backend.downloads.store');
        Route::post('/downloads/delete', [BackendDownloads::class, 'delete'])->name('backend.downloads.delete');
        Route::post('/downloads/slug-generator', [BackendDownloads::class, 'slugGenerator'])->name('backend.downloads.slugGenerator');
        Route::post('/downloads/upload-file', [BackendDownloads::class, 'fileUpload'])->name('backend.downloads.fileUpload');

        Route::get('/download-categories', [BackendDownloadCategories::class, 'index'])->name('backend.downloadCategories.index');
        Route::post('/download-categories/store', [BackendDownloadCategories::class, 'store'])->name('backend.downloadCategories.store');
        Route::post('/download-categories/get', [BackendDownloadCategories::class, 'get'])->name('backend.downloadCategories.get');
        Route::post('/download-categories/status', [BackendDownloadCategories::class, 'status'])->name('backend.downloadCategories.status');
        Route::post('/download-categories/slug-generator', [BackendDownloadCategories::class, 'slugGenerator'])->name('backend.downloadCategories.slugGenerator');

        Route::get('/district-offices', [BackendDistrictOffices::class, 'index'])->name('backend.districtOffices.index');
        Route::get('/district-offices/create', [BackendDistrictOffices::class, 'create'])->name('backend.districtOffices.create');
        Route::get('/district-offices/edit/{slug}', [BackendDistrictOffices::class, 'edit'])->name('backend.districtOffices.edit');
        Route::post('/district-offices/store', [BackendDistrictOffices::class, 'store'])->name('backend.districtOffices.store');
        Route::post('/district-offices/delete', [BackendDistrictOffices::class, 'delete'])->name('backend.districtOffices.delete');
        Route::post('/district-offices/slug-generator', [BackendDistrictOffices::class, 'slugGenerator'])->name('backend.districtOffices.slugGenerator');


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


        // P
        Route::get('/press-releases', [BackendPressReleases::class, 'index'])->name('backend.pressReleases.index');
        Route::get('/press-releases/create', [BackendPressReleases::class, 'create'])->name('backend.pressReleases.create');
        Route::get('/press-releases/edit/{slug}', [BackendPressReleases::class, 'edit'])->name('backend.pressReleases.edit');
        Route::post('/press-releases/store', [BackendPressReleases::class, 'store'])->name('backend.pressReleases.store');
        Route::post('/press-releases/delete', [BackendPressReleases::class, 'delete'])->name('backend.pressReleases.delete');
        Route::post('/press-releases/slug-generator', [BackendPressReleases::class, 'slugGenerator'])->name('backend.pressReleases.slugGenerator');
        Route::post('/press-releases/upload-image', [BackendPressReleases::class, 'imageUpload'])->name('backend.pressReleases.imageUpload');
        Route::post('/press-releases/set-primary-image', [BackendPressReleases::class, 'setPrimaryImage'])->name('backend.pressReleases.setPrimaryImage');
        Route::post('/press-releases/image-delete', [BackendPressReleases::class, 'deleteImage'])->name('backend.pressReleases.deleteImage');


        Route::get('/projects', [BackendProjects::class, 'index'])->name('backend.projects.index');
        Route::get('/projects/create', [BackendProjects::class, 'create'])->name('backend.projects.create');
        Route::get('/projects/edit/{slug}', [BackendProjects::class, 'edit'])->name('backend.projects.edit');
        Route::post('/projects/store', [BackendProjects::class, 'store'])->name('backend.projects.store');
        Route::post('/projects/delete', [BackendProjects::class, 'delete'])->name('backend.projects.delete');
        Route::post('/projects/slug-generator', [BackendProjects::class, 'slugGenerator'])->name('backend.projects.slugGenerator');
        Route::post('/projects/upload-image', [BackendProjects::class, 'imageUpload'])->name('backend.projects.imageUpload');
        Route::post('/projects/set-primary-image', [BackendProjects::class, 'setPrimaryImage'])->name('backend.projects.setPrimaryImage');
        Route::post('/projects/image-delete', [BackendProjects::class, 'deleteImage'])->name('backend.projects.deleteImage');


        // S

        Route::get('/screens', [BackendScreens::class, 'index'])->name('backend.screens.index');
        Route::post('/screens/store', [BackendScreens::class, 'store'])->name('backend.screens.store');
        Route::post('/screens/get', [BackendScreens::class, 'get'])->name('backend.screens.get');
        Route::post('/screens/status', [BackendScreens::class, 'status'])->name('backend.screens.status');
        Route::post('/screens/slug-generator', [BackendScreens::class, 'slugGenerator'])->name('backend.screens.slugGenerator');

        Route::get('/services', [BackendServices::class, 'index'])->name('backend.services.index');
        Route::post('/services/store', [BackendServices::class, 'store'])->name('backend.services.store');

        Route::get('/service-functions', [BackendServiceFunctions::class, 'index'])->name('backend.serviceFunctions.index');
        Route::get('/service-functions/create', [BackendServiceFunctions::class, 'create'])->name('backend.serviceFunctions.create');
        Route::get('/service-functions/edit/{slug}', [BackendServiceFunctions::class, 'edit'])->name('backend.serviceFunctions.edit');
        Route::post('/service-functions/store', [BackendServiceFunctions::class, 'store'])->name('backend.serviceFunctions.store');
        Route::post('/service-functions/delete', [BackendServiceFunctions::class, 'delete'])->name('backend.serviceFunctions.delete');
        Route::post('/service-functions/slug-generator', [BackendServiceFunctions::class, 'slugGenerator'])->name('backend.serviceFunctions.slugGenerator');


        // U
        Route::get('/users', [BackendUsers::class, 'index'])->name('backend.users.index');
        Route::get('/users/create', [BackendUsers::class, 'create'])->name('backend.users.create');
        Route::get('/users/edit/{slug}', [BackendUsers::class, 'edit'])->name('backend.users.edit');
        Route::get('/users/screens/{slug}', [BackendUsers::class, 'screens'])->name('backend.users.screens');
        Route::post('/users/store', [BackendUsers::class, 'store'])->name('backend.users.store');
        Route::post('/users/delete', [BackendUsers::class, 'delete'])->name('backend.users.delete');
        Route::post('/users/user-screen/set', [BackendUsers::class, 'setUserScreen'])->name('backend.users.setUserScreen');


        // V

        Route::get('/videos', [BackendVideos::class, 'index'])->name('backend.videos.index');
        Route::get('/videos/create', [BackendVideos::class, 'create'])->name('backend.videos.create');
        Route::get('/videos/edit/{slug}', [BackendVideos::class, 'edit'])->name('backend.videos.edit');
        Route::post('/videos/store', [BackendVideos::class, 'store'])->name('backend.videos.store');
        Route::post('/videos/delete', [BackendVideos::class, 'delete'])->name('backend.videos.delete');
        Route::post('/videos/slug-generator', [BackendVideos::class, 'slugGenerator'])->name('backend.videos.slugGenerator');

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
