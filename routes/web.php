<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\AdminDashboardController;
use App\Http\Controllers\Admins\PermissionController;
use App\Http\Controllers\Admins\RoleController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('home', 'home')->name('home');
    Route::view('password/update', 'auth.passwords.update')->name('passwords.update');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function() {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.index');

    Route::resource('admins', AdminDashboardController::class)->parameters(['admins' => 'user'])->only(['index', 'update']);
    //Route::resource('users', UserController::class)->except(['create', 'show', 'edit']);
    Route::resource('permissions', PermissionController::class)->except(['create', 'show', 'edit']);
    Route::resource('roles', RoleController::class)->except(['create', 'show', 'edit']);
});
