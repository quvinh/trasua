<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController;
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
Route::get('/danh-muc', [HomeController::class, 'category'])->name('category');
Route::get('/danh-muc/search', [HomeController::class, 'searchCategory']);
Route::get('/danh-muc/{id}', [HomeController::class, 'getCategory'])->name('get-category');

Route::get('/san-pham/{id}', [HomeController::class, 'getProduct'])->name('get-product');

Route::middleware('auth')->group(function (){
    Route::get('/home', [HomeController::class, 'needLogin']);
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::match(['get', 'post'], [OrderController::class, 'index'])->name('order');
});
