<?php


use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\User\PostController;
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

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});

/*Изменение только пароля*/
Route::get('/password-change', [PasswordController::class, 'showChangePasswordForm'])->name('password-change');
Route::post('/password-change', [PasswordController::class, 'changePassword'] )->name('password-update');
Route::get('/password-reset', [PasswordController::class, 'PasswordReset'])->name('password-reset');
Route::post('/password-reset', [PasswordController::class, 'PasswordResetUpdate'])->name('password-reset.update');

/*Сброс пароля через почту*/
Route::get('/password/email', [PasswordController::class, 'showPasswordResetForm'])->name('password-request');
Route::post('/password/email', [PasswordController::class, 'sendPasswordResetEmail'])->name('password-email');
Route::get('/password/email/reset/{token}', [PasswordController::class, 'showPasswordResetFormReset'])->name('password-request-reset');
Route::post('/password/email/reset/{token}', [PasswordController::class, 'sendPasswordResetEmailReset'])->name('password-email-reset');

Route::get('shop', [ShopController::class, 'index'])->name('shop');
Route::get('shop/{post}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/dashboard', [CartController::class, 'index']);
Route::get('/shopping-cart', [CartController::class, 'bookCart'])->name('shopping.cart');
Route::get('/book/{id}', [CartController::class, 'addBooktoCart'])->name('addbook.to.cart');
Route::patch('/update-shopping-cart', [CartController::class, 'updateCart'])->name('update.shopping.cart');
Route::delete('/delete-cart-product', [CartController::class, 'deleteProduct'])->name('delete.cart.product');

Route::get('/payment', [StripeController::class, 'index'])->name('index');
Route::post('/payment', [StripeController::class, 'store'])->name('payment.store');
Route::post('/checkout', [StripeController::class, 'checkout'])->name('checkout');
Route::get('success', [StripeController::class, 'success'])->name('success');

