<?php

use App\Http\Controllers\accommodationController;
use App\Http\Controllers\Admin\accommodationsController;
use App\Http\Controllers\Admin\commentsController;
use App\Http\Controllers\Admin\dasboardController;
use App\Http\Controllers\Admin\reportsController;
use App\Http\Controllers\Admin\reserveController;
use App\Http\Controllers\Admin\usersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cityController;
use App\Http\Controllers\detailAccommodationController;
use App\Http\Controllers\homeController;

use App\Http\Controllers\user\AuthController;
use App\Http\Controllers\user\dashboardController;
use App\Http\Controllers\user\profileController;

Route::get('/', [homeController::class, 'index'])->name("home");
Route::get('/detailaccmmodation/{id}', [detailAccommodationController::class, 'index'])->name("details");

Route::get('/city/{id}', [cityController::class, 'index'])->name('city');

Route::get('/accommodations', [accommodationController::class, 'index'])->name("accommodations");
Route::get('/register', [AuthController::class, 'registerShow'])->name('user.register.show');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
Route::get('/login', [AuthController::class, 'loginShow'])->name('user.login.show');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');

Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [dashboardController::class, 'show'])->name('user.dashboard');
    Route::get('/user/profile', [profileController::class, 'index'])->name('user.profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/user/profile/{id}/edit', [ProfileController::class, 'edit'])->name('user.edit');
    Route::post('/user/profile/update', [ProfileController::class, 'update'])->name('user.update');
    Route::get('/user/reserve', [dashboardController::class, 'reserve'])->name('user.reserve');
    Route::get('/user/comment', [dashboardController::class, 'comment'])->name('user.comment');
    Route::get('/user/favorite', [dashboardController::class, 'favorite'])->name('user.favorite');
    Route::get('/user/logout', [dashboardController::class, 'logout'])->name('user.logout');
});

Route::get('/dashboard', [dasboardController::class, 'index'])->name("admin.dashboard");
Route::get('/reserve', [reserveController::class, 'index'])->name("admin.reserve");
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/accommodation', [AccommodationsController::class, 'index'])->name('accommodation');
    Route::get('/accommodation/add', [AccommodationsController::class, 'add'])->name('accommodation.add');
    Route::post('/accommodation/store', [AccommodationsController::class, 'store'])->name('accommodation.store');
    Route::get('/accommodation/{id}', [AccommodationsController::class, 'show'])->name('accommodation.show');
    Route::get('/accommodation/{id}/edit', [AccommodationsController::class, 'edit'])->name('accommodation.edit');
    Route::put('/accommodation/{id}', [AccommodationsController::class, 'update'])->name('accommodation.update');
    Route::delete('/accommodation/{id}', [AccommodationsController::class, 'destroy'])->name('accommodation.destroy');
    Route::get('/accommodation/export/excel', [AccommodationsController::class, 'export'])->name('accommodation.export');
    Route::get('/accommodation/report', [AccommodationsController::class, 'report'])->name('accommodation.report');
});

Route::get('/users', [usersController::class, 'index'])->name("admin.users");
Route::get('/reports', [reportsController::class, 'index'])->name("admin.reports");
Route::get('/comments', [commentsController::class, 'index'])->name("admin.comments");





// Route::post('/otp/send', 'App\Http\Controllers\Auth\OtpController@send');

// Route::post('/otp/verify', 'App\Http\Controllers\Auth\OtpController@verify');
