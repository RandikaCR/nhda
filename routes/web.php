<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//FRONTEND CONTROLLERS
use App\Http\Controllers\Frontend\FrontendController AS Frontend;

//1 - Frontend Routes
Route::group([ 'prefix' =>'/'], function () {

    Route::get('/', [Frontend::class, 'index'])->name('frontend.homepage');


    Route::post('/app-logout', [Frontend::class, 'appLogout'])->name('frontend.appLogout');


});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
