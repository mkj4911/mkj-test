<?php

use App\Http\Controllers\MkjController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ItemController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\HistoryController;
use App\Http\Controllers\User\ProfileController;

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
//     return view('/mkj/welcome');
// });

Route::get('/', [MkjController::class, 'index'])->name('mkj.index');
Route::get('mkj/show/{item}', [MkjController::class, 'show'])->name('mkj.show');

// Route::get('/dashboard', function () {
//     return view('user.dashboard');
// })->middleware(['auth:users'])->name('dashboard');

Route::middleware('auth:users')->group(function () {
    Route::get('item', [ItemController::class, 'index'])->name('items.index');
    Route::get('shop', [ItemController::class, 'shop'])->name('items.shop');
    Route::get('show/{item}', [ItemController::class, 'show'])->name('items.show');
});

Route::prefix('cart')->middleware('auth:users')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('add', [CartController::class, 'add'])->name('cart.add');
    Route::post('delete/{item}', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('checkout-cash', [CartController::class, 'checkoutCash'])->name('cart.checkout.cash');
    Route::get('checkout-card', [CartController::class, 'checkoutCard'])->name('cart.checkout.card');
    Route::get('success', [CartController::class, 'success'])->name('cart.success');
    Route::get('cancel', [CartController::class, 'cancel'])->name('cart.cancel');
});

Route::prefix('history')->middleware('auth:users')->group(function () {
    Route::get('/', [HistoryController::class, 'index'])->name('history.index');
    Route::get('/edit/{sale_id}', [HistoryController::class, 'edit'])->name('history.edit');
    Route::post('/update/{sale_id}', [HistoryController::class, 'update'])->name('history.update');
});



Route::prefix('profiles')->middleware('auth:users')->group(function () {
    Route::get('index', [ProfileController::class, 'index'])->name('profiles.index');
    Route::post('update', [ProfileController::class, 'update'])->name('profiles.update');
});

require __DIR__ . '/auth.php';
