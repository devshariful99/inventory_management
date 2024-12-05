<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductManagement\CategoryController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::group(['middleware' => 'auth', 'prefix' => 'admin-dashboard'], function () {

    Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

    //Admin Management Route
    Route::resource('/admin', AdminController::class);
    Route::get('/admin/status/{id}', [AdminController::class, 'status'])->name('admin.status');

    Route::group(['prefix' => 'product-management'], function () {
        Route::resource('/category', CategoryController::class);
        Route::get('/category/status/{id}', [CategoryController::class, 'status'])->name('category.status');
    });
});
