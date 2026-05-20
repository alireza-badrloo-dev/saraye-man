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
use App\Http\Controllers\User\FavouriteController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\user\profileController;
use App\Http\Controllers\user\reservationsController;

Route::get('/', [homeController::class, 'index'])->name("home");
Route::get('/detailaccmmodation/{id}', [detailAccommodationController::class, 'index'])->name("details");
Route::post('/detailaccmmodation/{id}/comment/store', [detailAccommodationController::class, 'storeComment'])->name('comment.store');

Route::get('/city/{id}', [cityController::class, 'index'])->name('city');

Route::get('/accommodations', [accommodationController::class, 'index'])->name("accommodations");
Route::get('/register', [AuthController::class, 'registerShow'])->name('user.register.show');
Route::post('/register', [AuthController::class, 'register'])->name('user.register');
Route::get('/login', [AuthController::class, 'loginShow'])->name('user.login.show');
Route::post('/login', [AuthController::class, 'login'])->name('user.login');

Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [dashboardController::class, 'show'])->name('user.dashboard');
    Route::get('/user/profile', [profileController::class, 'index'])->name('user.profile');
    Route::put('/profile', [profileController::class, 'update'])->name('profile.update');
    Route::get('/user/profile/{id}/edit', [profileController::class, 'edit'])->name('user.edit');
    Route::post('/user/profile/update', [profileController::class, 'update'])->name('user.update');
    Route::get('/user/reservation', [reservationsController::class, 'index'])->name('user.reserve');
    Route::post('/payment/process', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/payment/{reservation_id}', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment/confirm/{reservation_id}', [PaymentController::class, 'confirm'])->name('payment.confirm');
    Route::get('/reservation/{room_id}', [reservationsController::class, 'create'])->name('user.reserve.create');
    Route::post('/reservation/store', [reservationsController::class, 'store'])->name('user.reserve.store');
    Route::get('/user/comment', [dashboardController::class, 'comment'])->name('user.comment');
    Route::get('/user/favourites', [FavouriteController::class, 'index'])->name('user.favourite');
    Route::post('/user/favourite/{id}/toggle', [FavouriteController::class, 'toggle'])->name('favourite.toggle');
    Route::get('/user/logout', [dashboardController::class, 'logout'])->name('user.logout');
});

// روت‌های پرداخت (خارج از middleware auth برای callback)


// روت‌های ادمین
Route::get('/dashboard', [dasboardController::class, 'index'])->name("admin.dashboard");
Route::get('/reserve', [reserveController::class, 'index'])->name("admin.reserve");
Route::get('/users', [usersController::class, 'index'])->name("admin.users");
Route::get('/reports', [reportsController::class, 'index'])->name("admin.reports");
Route::get('/comments', [commentsController::class, 'index'])->name("admin.comments");

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/accommodation', [accommodationsController::class, 'index'])->name('accommodation');
    Route::get('/accommodation/add', [accommodationsController::class, 'add'])->name('accommodation.add');
    Route::post('/accommodation/store', [accommodationsController::class, 'store'])->name('accommodation.store');
    Route::get('/accommodation/{id}', [accommodationsController::class, 'show'])->name('accommodation.show');
    Route::get('/accommodation/{id}/edit', [accommodationsController::class, 'edit'])->name('accommodation.edit');
    Route::put('/accommodation/{id}', [accommodationsController::class, 'update'])->name('accommodation.update');
    Route::delete('/accommodation/{id}', [accommodationsController::class, 'destroy'])->name('accommodation.destroy');
    Route::get('/accommodation/export', [accommodationsController::class, 'downloadExcel'])->name('accommodation.export');
});

Route::get('/test-export', function () {
    return 'test ok';
});
