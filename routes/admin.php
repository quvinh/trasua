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
    Route::get('/get-product', [ProductController::class, 'getProduct']);
    Route::get('/add-product', [ProductController::class, 'addProduct'])->name('admin.add-product');
    Route::post('/add-product', [ProductController::class, 'storeProduct'])->name('admin.store-product');
    Route::get('/manage-product', [ProductController::class, 'manageProduct'])->name('admin.manage-product');
    Route::get('/edit-product/{id}', [ProductController::class, 'editProduct'])->name('admin.edit-product');
    Route::put('/update-product/{id}', [ProductController::class, 'updateProduct'])->name('admin.update-product');
    Route::put('/update-visible/{id}', [ProductController::class, 'updateVisibleProduct']);
    Route::delete('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('admin.delete-product');

    // Formular
    Route::get('/add-formula', [FormulaController::class, 'addFormula'])->name('admin.add-formula');
    Route::post('/store-formula', [FormulaController::class, 'storeFormula'])->name('admin.store-formula');
    Route::get('/edit-formula/{id}', [FormulaController::class, 'editFormula'])->name('admin.edit-formula');
    Route::post('/update-formula/{id}', [FormulaController::class, 'updateFormula'])->name('admin.update-formula');
    Route::get('/manage-formula', [FormulaController::class, 'manageFormula'])->name('admin.manage-formula');
    Route::get('/delete-formula/{id}', [FormulaController::class, 'deleteFormula'])->name('admin.delete-formula');
    Route::delete('/remove-structure/{id}', [FormulaController::class, 'removeStructure']);

    // Bill
    Route::get('/order-product', [BillController::class, 'orderProduct']);
    Route::get('/search-product', [BillController::class, 'searchProduct']);
    Route::get('/online', [BillController::class, 'online'])->name('admin.online');
    Route::get('/at-table', [BillController::class, 'atTable'])->name('admin.at-table');

    Route::get('/at-counter', [BillController::class, 'atCounter'])->name('admin.at-counter');
    Route::post('/save-bill-counter', [BillController::class, 'saveBillCounter'])->name('admin.at-counter.save-bill');

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

    Route::get('/revenue/date/{d}', [ShopController::class, 'revenueDate']);
    Route::get('/revenue/month/{m}', [ShopController::class, 'revenueMonth']);
    Route::get('/revenue/year/{y}', [ShopController::class, 'revenueYear']);

    // Table
    Route::get('/manage-table', [TableController::class, 'table'])->name('admin.table');
    Route::get('/get-table', [TableController::class, 'getTable'])->name('admin.get-table');
    Route::post('/manage-table', [TableController::class, 'storeTable'])->name('admin.store-table');
    Route::get('/edit-table/{id}', [TableController::class, 'editTable'])->name('admin.edit-table');
    Route::put('/update-table/{id}', [TableController::class, 'updateTable'])->name('admin.update-table');
    Route::delete('/delete-table/{id}', [TableController::class, 'deleteTable'])->name('admin.delete-table');

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
    Route::delete('/user/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.delete-user');

    Route::get('/role', [SystemController::class, 'role'])->name('admin.role');
    Route::post('/role', [SystemController::class, 'addRole'])->name('admin.add-role');
    Route::get('/role/{id}', [SystemController::class, 'getRole'])->name('admin.get-role');
    Route::put('/role/{id}', [SystemController::class, 'updateRole'])->name('admin.update-role');
    Route::delete('/role/delete/{id}', [SystemController::class, 'deleteRole'])->name('admin.delete-role');
    Route::get('/log', [SystemController::class, 'log'])->name('admin.log');
});
