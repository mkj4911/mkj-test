<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Admin\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Admin\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\Auth\RegisteredUserController;
use App\Http\Controllers\Admin\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\ManagementController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SalesController;


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
//     return view('admin.welcome');
// });

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth:admin'])->name('dashboard');

Route::resource('members', MemberController::class)
    ->middleware('auth:admin')->except(['show']);

Route::prefix('expired-members')->middleware('auth:admin')->group(function () {
    Route::get('index', [MemberController::class, 'expiredMemberIndex'])->name('expired-members.index');
    Route::post('destroy/{member}', [MemberController::class, 'expiredMemberDestroy'])->name('expired-members.destroy');
    Route::post('update/{member}', [MemberController::class, 'expiredMemberUpdate'])->name('expired-members.update');
});

Route::prefix('shops')->middleware('auth:admin')->group(function () {
    Route::get('index', [ShopController::class, 'index'])->name('shops.index');
    Route::get('edit/{shop}', [ShopController::class, 'edit'])->name('shops.edit');
    Route::post('update/{shop}', [ShopController::class, 'update'])->name('shops.update');
});

Route::prefix('holiday')->middleware('auth:admin')->group(function () {
    Route::get('index', [CalendarController::class, 'index'])->name('holiday.index');
    Route::get('update/{holiday}', [CalendarController::class, 'update'])->name('holiday.update');
    Route::post('update/{holiday}', [CalendarController::class, 'update'])->name('holiday.update');
});

Route::prefix('management')->middleware('auth:admin')->group(function () {
    Route::get('index', [ManagementController::class, 'index'])->name('management.index');
    Route::get('show/{item}', [ManagementController::class, 'show'])->name('management.show');
});

Route::prefix('sales')->middleware('auth:admin')->group(function () {
    Route::get('index', [SalesController::class, 'index'])->name('sales.index');
});

Route::prefix('categories')->middleware('auth:admin')->group(function () {
    Route::get('index', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('store', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('edit/{primary}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('update/{primary}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('destroy/{primary}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('subindex/{primary}', [CategoryController::class, 'subindex'])->name('categories.subindex');
    Route::post('substore/{primary}', [CategoryController::class, 'substore'])->name('categories.substore');
    Route::delete('subdestroy/{secondary}', [CategoryController::class, 'subdestroy'])->name('categories.subdestroy');
});

Route::get('/register', [RegisteredUserController::class, 'create'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->middleware('guest');

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
    ->middleware('auth:admin')
    ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth:admin', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware(['auth:admin', 'throttle:6,1'])
    ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->middleware('auth:admin')
    ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
    ->middleware('auth:admin');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:admin')
    ->name('logout');
