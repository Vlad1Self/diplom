<?php


use App\Http\Controllers\BasketController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
require __DIR__ . '/user.php';

Route::view('/', 'home.index')->name('home');

Route::redirect('/home', '/')->name('home.redirect');


Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register.store');

    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login.store');
});

Route::get('shop', [ShopController::class, 'index'])->name('shop');
Route::get('shop/{post}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/basket', [BasketController::class, 'index'])->name('basket.index');
Route::get('/basket/order', [BasketController::class, 'checkout'])->name('basket.checkout');

Route::post('/basket/add/{id}', [BasketController::class, 'add'])
    ->where('id', '[0-9]+')
    ->name('basket.add');
