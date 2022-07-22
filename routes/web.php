<?php

use App\Http\Controllers\User\Auth\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\CustomerController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\OrderController;

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

Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('login');
Route::match(['get', 'post'], '/register', [LoginController::class, 'register'])->name('register');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/dang-ky', [LoginController::class, 'register'])->name('register');
Route::get('/danh-muc', [HomeController::class, 'category'])->name('category');
Route::get('/danh-muc/search', [HomeController::class, 'searchCategory']);
Route::get('/danh-muc/{id}', [HomeController::class, 'getCategory'])->name('get-category');

Route::get('/san-pham/{id}', [HomeController::class, 'getProduct'])->name('get-product');

Route::middleware('auth')->group(function (){
    Route::get('/home', [HomeController::class, 'needLogin']);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::match(['get', 'post'], '/gio-hang', [OrderController::class, 'index'])->name('order');
    Route::get('/gio-hang/xoa/{id}', [OrderController::class, 'removeOrder'])->name('remove-order');
    Route::post('/gio-hang/xu-ly', [OrderController::class, 'progressOrder'])->name('progress-order');
    Route::get('/gio-hang/thanh-toan', [OrderController::class, 'checkoutOrder'])->name('checkout-order');
    Route::put('/gio-hang/thanh-toan/dia-chi', [OrderController::class, 'checkoutAddress'])->name('checkout-address');
    Route::get('/gio-hang/thanh-toan/giao-hang', [OrderController::class, 'checkoutDelivery'])->name('checkout-delivery');
    Route::get('/gio-hang/thanh-toan/tien-hang', [OrderController::class, 'checkoutPayment'])->name('checkout-payment');
    Route::get('/gio-hang/thanh-toan/tong-quan', [OrderController::class, 'checkoutReview'])->name('checkout-review');

    Route::get('/khach-hang', [CustomerController::class, 'ordersHistory'])->name('orders-history');
    Route::get('/khach-hang/{id}', [CustomerController::class, 'orderHistory'])->name('order-history');
    Route::get('/tai-khoan', [CustomerController::class, 'customerAccount'])->name('customer-account');

    Route::put('/mat-khau', [AccountController::class, 'changePassword'])->name('change-password');
});
