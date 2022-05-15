<?php

use App\Http\Controllers\Admin\Auth\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\FormulaController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShopController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\SystemController;
use App\Http\Controllers\Admin\TableController;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], '/login', [LoginController::class, 'login'])->name('admin.login');
Route::middleware('auth:admin')->group(function (){
    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

    // Product
    Route::get('/add-product', [ProductController::class, 'addProduct'])->name('admin.add-product');
    Route::post('/add-product', [ProductController::class, 'storeProduct'])->name('admin.store-product');
    Route::get('/manage-product', [ProductController::class, 'manageProduct'])->name('admin.manage-product');

    // Formular
    Route::get('/add-formula', [FormulaController::class, 'addFormula'])->name('admin.add-formula');
    Route::get('/manage-formula', [FormulaController::class, 'manageFormula'])->name('admin.manage-formula');

    // Bill
    Route::get('/online', [BillController::class, 'online'])->name('admin.online');
    Route::get('/at-table', [BillController::class, 'atTable'])->name('admin.at-table');
    Route::get('/at-counter', [BillController::class, 'atCounter'])->name('admin.at-counter');

    // Customer
    Route::get('/customer', [CustomerController::class, 'customer'])->name('admin.customer');

    // Store
    Route::get('/store', [StoreController::class, 'store'])->name('admin.store');
    Route::get('/import', [StoreController::class, 'import'])->name('admin.import');
    Route::get('/coupon', [StoreController::class, 'coupon'])->name('admin.coupon');

    // Shop
    Route::get('/revenue', [ShopController::class, 'revenue'])->name('admin.revenue');
    Route::get('/expense', [ShopController::class, 'expense'])->name('admin.expense');
    Route::get('/branch', [ShopController::class, 'branch'])->name('admin.branch');

    // Table
    Route::get('/manage-table', [TableController::class, 'table'])->name('admin.table');

    // Category
    Route::get('/category', [CategoryController::class, 'category'])->name('admin.category');
    Route::post('/category', [CategoryController::class, 'addCategory'])->name('admin.add-category');
    Route::post('/size', [CategoryController::class, 'addSize'])->name('admin.add-size');
    Route::get('/unit', [CategoryController::class, 'unit'])->name('admin.unit');
    Route::post('/unit', [CategoryController::class, 'addUnit'])->name('admin.add-unit');

    // System
    Route::get('/user', [AdminController::class, 'user'])->name('admin.user');
    Route::post('/user', [AdminController::class, 'addUser'])->name('admin.add-user');
    Route::get('/user/{id}', [AdminController::class, 'getUser'])->name('admin.get-user');
    Route::put('/user/{id}', [AdminController::class, 'roleUser'])->name('admin.role-user');
    Route::get('/user/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');

    Route::get('/role', [SystemController::class, 'role'])->name('admin.role');
    Route::post('/role', [SystemController::class, 'addRole'])->name('admin.add-role');
    Route::get('/role/{id}', [SystemController::class, 'getRole'])->name('admin.get-role');
    Route::put('/role/{id}', [SystemController::class, 'updateRole'])->name('admin.update-role');
    Route::get('/role/delete/{id}', [SystemController::class, 'deleteRole'])->name('admin.delete-role');
    Route::get('/log', [SystemController::class, 'log'])->name('admin.log');
});
