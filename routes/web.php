<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\accommodationController;
use App\Http\Controllers\Admin\accommodationsController;
use App\Http\Controllers\admin\AdminContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CityController as AdminCityController;
use App\Http\Controllers\Admin\commentsController;

use App\Http\Controllers\Admin\dasboardController;
use App\Http\Controllers\Admin\reportsController;
use App\Http\Controllers\Admin\reserveController;
use App\Http\Controllers\Admin\usersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\cityController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\detailAccommodationController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\user\AuthController;
use App\Http\Controllers\user\dashboardController;
use App\Http\Controllers\User\FavouriteController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\user\profileController;
use App\Http\Controllers\user\reservationsController;

Route::get('/', [homeController::class, 'index'])->name("home");
Route::get('/detailaccmmodation/{id}', [detailAccommodationController::class, 'index'])->name("details");
Route::post('/detailaccmmodation/{id}/comment/store', [detailAccommodationController::class, 'storeComment'])->name('comment.store');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/city/{id}', [cityController::class, 'index'])->name('city');

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

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


Route::get('/reports', [reportsController::class, 'index'])->name("admin.reports");

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/accommodation', [accommodationsController::class, 'index'])->name('accommodation');
    Route::get('/accommodation/add', [accommodationsController::class, 'add'])->name('accommodation.add');
    Route::post('/accommodation/store', [accommodationsController::class, 'store'])->name('accommodation.store');
    Route::get('/accommodation/{id}/show', [accommodationsController::class, 'show'])->name('accommodation.show');
    Route::get('/accommodation/{id}/edit', [accommodationsController::class, 'edit'])->name('accommodation.edit');
    Route::put('/accommodation/{id}', [accommodationsController::class, 'update'])->name('accommodation.update');
    Route::delete('/accommodation/{id}', [accommodationsController::class, 'destroy'])->name('accommodation.destroy');
    Route::get('/accommodation/export', [accommodationsController::class, 'downloadExcel'])->name('accommodation.export');


    Route::get('/comments', [CommentsController::class, 'index'])->name('comments');
    Route::get('/comments/{id}', [CommentsController::class, 'show'])->name('comments.show');
    Route::put('/comments/{id}/status', [CommentsController::class, 'updateStatus'])->name('comments.update-status');
    Route::delete('/comments/{id}', [CommentsController::class, 'destroy'])->name('comments.destroy');


    Route::get('/reserve', [reserveController::class, 'index'])->name('reserve');
    Route::get('/reserve/{id}', [reserveController::class, 'show'])->name('reserve.show');
    Route::patch('/reserve/{id}/status', [reserveController::class, 'updateStatus'])->name('reserve.update-status');
    Route::delete('/reserve/{id}', [reserveController::class, 'destroy'])->name('reserve.destroy');


    Route::get('/users', [usersController::class, 'index'])->name('users');
    Route::get('/users/{id}', [usersController::class, 'show'])->name('users.show');
    Route::delete('/users/{id}', [usersController::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/{id}/status', [usersController::class, 'toggleStatus'])->name('users.toggle-status');

    Route::get('/cities', [AdminCityController::class, 'index'])->name('cities.index');
    Route::get('/cities/create', [AdminCityController::class, 'create'])->name('cities.create');
    Route::post('/cities', [AdminCityController::class, 'store'])->name('cities.store');
    Route::get('/cities/{id}/edit', [AdminCityController::class, 'edit'])->name('cities.edit');
    Route::put('/cities/{id}', [AdminCityController::class, 'update'])->name('cities.update');
    Route::delete('/cities/{id}', [AdminCityController::class, 'destroy'])->name('cities.destroy');


    Route::middleware('role:super_admin')->group(function () {
        Route::get('/admins', [AdminController::class, 'index'])->name('admins');
        Route::get('/admins/create', [AdminController::class, 'create'])->name('admins.create');
        Route::post('/admins', [AdminController::class, 'store'])->name('admins.store');
        Route::get('/admins/{id}', [AdminController::class, 'show'])->name('admins.show');
        Route::get('/admins/{id}/edit', [AdminController::class, 'edit'])->name('admins.edit');
        Route::put('/admins/{id}', [AdminController::class, 'update'])->name('admins.update');
        Route::delete('/admins/{id}', [AdminController::class, 'destroy'])->name('admins.destroy');
        Route::patch('/admins/{id}/status', [AdminController::class, 'toggleStatus'])->name('admins.toggle-status');


        Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
        Route::get('/contacts/{id}', [AdminContactController::class, 'show'])->name('contacts.show');
        Route::delete('/contacts/{id}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
        Route::put('/contacts/{id}/toggle-read', [AdminContactController::class, 'toggleRead'])->name('contacts.toggle-read');
    });
});

Route::get('/test-export', function () {
    return 'test ok';
});
