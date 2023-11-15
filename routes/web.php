<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuardController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\TricycleDriverController;
use App\Http\Controllers\Users\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Welcome
 */

Route::get('/', function () {
    return view('welcome');
});

/**
 * Profile
 */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Dashboard
 */

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

/**
 * Users - TODO: Remove
 */

Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('users');
Route::get('/users/create', [UserController::class, 'create'])->middleware(['auth', 'verified'])->name('users.create');
Route::post('/users/create', [UserController::class, 'store'])->middleware(['auth', 'verified'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->middleware(['auth', 'verified'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->middleware(['auth', 'verified'])->name('users.edit');
Route::post('/users/{id}', [UserController::class, 'update'])->middleware(['auth', 'verified'])->name('users.update');
Route::post('/users/{id}/destroy', [UserController::class, 'destroy'])->middleware(['auth', 'verified'])->name('users.destroy');
Route::get('/download/{qr code}', 'DownloadController@download')->name('download');

/**
 * Admin routes
 */

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('admin');
    Route::get('/admin/create', [AdminController::class, 'create'])->middleware(['auth', 'verified'])->name('admin.create');
    Route::post('/admin/create', [AdminController::class, 'store'])->middleware(['auth', 'verified'])->name('admin.store');
    Route::get('/admin/{id}', [AdminController::class, 'show'])->middleware(['auth', 'verified'])->name('admin.show');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->middleware(['auth', 'verified'])->name('admin.edit');
    Route::post('/admin/{id}', [AdminController::class, 'update'])->middleware(['auth', 'verified'])->name('admin.update');
    Route::post('/admin/{id}/destroy', [AdminController::class, 'destroy'])->middleware(['auth', 'verified'])->name('admin.destroy');
});

/**
 * Guard routes
 */
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/guard', [GuardController::class, 'index'])->middleware(['auth', 'verified'])->name('guard');
    Route::get('/guard/create', [GuardController::class, 'create'])->middleware(['auth', 'verified'])->name('guard.create');
    Route::post('/guard/create', [GuardController::class, 'store'])->middleware(['auth', 'verified'])->name('guard.store');
    Route::get('/guard/{id}', [GuardController::class, 'show'])->middleware(['auth', 'verified'])->name('guard.show');
    Route::get('/guard/{id}/edit', [GuardController::class, 'edit'])->middleware(['auth', 'verified'])->name('guard.edit');
    Route::post('/guard/{id}', [GuardController::class, 'update'])->middleware(['auth', 'verified'])->name('guard.update');
    Route::post('/guard/{id}/destroy', [GuardController::class, 'destroy'])->middleware(['auth', 'verified'])->name('guard.destroy');
    Route::get('/download/{qr code}', 'DownloadController@download')->name('download');;
});

/**
 * Resident routes
 */
Route::middleware(['auth', 'verified', 'guard'])->group(function () {
    Route::get('/resident', [ResidentController::class, 'index'])->name('resident');
    Route::get('/resident/create', [ResidentController::class, 'create'])->middleware(['admin'])->name('resident.create');
    Route::post('/resident/create', [ResidentController::class, 'store'])->middleware(['admin'])->name('resident.store');
    Route::get('/resident/{id}', [ResidentController::class, 'show'])->middleware(['auth', 'verified'])->name('resident.show');
    Route::get('/resident/{id}/edit', [ResidentController::class, 'edit'])->middleware(['admin'])->name('resident.edit');
    Route::post('/resident/{id}', [ResidentController::class, 'update'])->middleware(['admin'])->name('resident.update');
    Route::post('/resident/{id}/destroy', [ResidentController::class, 'destroy'])->middleware(['admin'])->name('resident.destroy');
    Route::get('/download/{qr code}', 'DownloadController@download')->name('download');;
});

/**
 * Guest routes
 */
Route::middleware(['auth', 'verified', 'guard'])->group(function () {
    Route::get('/guest', [GuestController::class, 'index'])->middleware(['auth', 'verified'])->name('guest');
    Route::get('/guest/create', [GuestController::class, 'create'])->middleware(['admin'])->name('guest.create');
    Route::post('/guest/create', [GuestController::class, 'store'])->middleware(['admin'])->name('guest.store');
});

/**
 * Tricycle Driver routes
 */
Route::middleware(['auth', 'verified', 'guard'])->group(function () {
    Route::get('/tricycledriver', [TricycleDriverController::class, 'index'])->name('tricycledriver');
    Route::get('/tricycledriver/create', [TricycleDriverController::class, 'create'])->middleware(['admin'])->name('tricycledriver.create');
    Route::post('/tricycledriver/create', [TricycleDriverController::class, 'store'])->middleware(['admin'])->name('tricycledriver.store');
    Route::get('/tricycledriver/{id}', [TricycleDriverController::class, 'show'])->middleware(['auth', 'verified'])->name('tricycledriver.show');
    Route::get('/tricycledriver/{id}/edit', [TricycleDriverController::class, 'edit'])->middleware(['admin'])->name('tricycledriver.edit');
    Route::post('/tricycledriver/{id}', [TricycleDriverController::class, 'update'])->middleware(['admin'])->name('tricycledriver.update');
    Route::post('/tricycledriver/{id}/destroy', [TricycleDriverController::class, 'destroy'])->middleware(['admin'])->name('tricycledriver.destroy');
    Route::get('/download/{qr code}', 'DownloadController@download')->name('download');;
});


require __DIR__ . '/auth.php';
