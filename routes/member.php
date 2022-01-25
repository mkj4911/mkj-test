<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Member\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Member\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Member\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Member\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Member\Auth\NewPasswordController;
use App\Http\Controllers\Member\Auth\PasswordResetLinkController;
use App\Http\Controllers\Member\Auth\RegisteredUserController;
use App\Http\Controllers\Member\Auth\VerifyEmailController;
use App\Http\Controllers\Member\ImageController;
use App\Http\Controllers\Member\ProductController;
use App\Http\Controllers\Member\TimeController;
use App\Http\Controllers\Member\SalesController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('member.welcome');
// });

Route::get('/dashboard', function () {
    return view('member.dashboard');
})->middleware(['auth:members'])->name('dashboard');

Route::resource('images', ImageController::class)
    ->middleware('auth:members')->except(['show']);

Route::resource('products', ProductController::class)
    ->middleware('auth:members')->except(['show']);

Route::prefix('deleted')->middleware('auth:members')->group(function () {
    Route::get('index', [ProductController::class, 'deletedProductIndex'])->name('deleted.index');
    Route::post('destroy/{item}', [ProductController::class, 'deletedProductDestroy'])->name('deleted.destroy');
    Route::post('update/{item}', [ProductController::class, 'deletedProductUpdate'])->name('deleted.update');
});

Route::prefix('time')->middleware('auth:members')->group(function () {
    Route::get('index', [TimeController::class, 'index'])->name('time.index');
    Route::post('timein', [TimeController::class, 'timein'])->name('time.timein');
    Route::post('timeout', [TimeController::class, 'timeout'])->name('time.timeout');
    Route::post('update', [TimeController::class, 'update'])->name('time.update');
});

Route::prefix('sales')->middleware('auth:members')->group(function () {
    Route::get('index', [SalesController::class, 'index'])->name('sales.index');
    Route::get('edit/{sale}', [SalesController::class, 'edit'])->name('sales.edit');
    Route::post('update/{sale}', [SalesController::class, 'update'])->name('sales.update');
    Route::post('destroy/{sale}', [salesController::class, 'destroy'])->name('sales.destroy');
});

// Route::get('/register', [RegisteredUserController::class, 'create'])
//     ->middleware('guest')
//     ->name('register');

// Route::post('/register', [RegisteredUserController::class, 'store'])
//     ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
    ->middleware('auth:members')
    ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth:members', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth:members', 'throttle:6,1'])
    ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->middleware('auth:members')
    ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
    ->middleware('auth:members');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:members')
    ->name('logout');
