<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DashboardController;
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


});