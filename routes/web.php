<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\TricycleDriverController;
use App\Http\Controllers\Users\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/users', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('users');
Route::get('/users/create', [UserController::class, 'create'])->middleware(['auth', 'verified'])->name('users.create');
Route::post('/users/create', [UserController::class, 'store'])->middleware(['auth', 'verified'])->name('users.store');
Route::get('/users/{id}', [UserController::class, 'show'])->middleware(['auth', 'verified'])->name('users.show');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->middleware(['auth', 'verified'])->name('users.edit');
Route::post('/users/{id}', [UserController::class, 'update'])->middleware(['auth', 'verified'])->name('users.update');
Route::post('/users/{id}/destroy', [UserController::class, 'destroy'])->middleware(['auth', 'verified'])->name('users.destroy');
Route::get('/download/{qr code}', 'DownloadController@download')->name('download');

/* Admin routes */
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('admin');
Route::get('/admin/create', [AdminController::class, 'create'])->middleware(['auth', 'verified'])->name('admin.create');
Route::post('/admin/create', [AdminController::class, 'store'])->middleware(['auth', 'verified'])->name('admin.store');




/* Guard routes */
Route::get('/guard', [GuardController::class, 'index'])->middleware(['auth', 'verified'])->name('guard');
Route::get('/guard/create', [GuardController::class, 'create'])->middleware(['auth', 'verified'])->name('guard.create');
Route::post('/guard/create', [GuardController::class, 'store'])->middleware(['auth', 'verified'])->name('guard.store');

/* Resident routes */
Route::get('/resident', [ResidentController::class, 'index'])->middleware(['auth', 'verified'])->name('resident');
Route::get('/resident/create', [ResidentController::class, 'create'])->middleware(['auth', 'verified'])->name('resident.create');
Route::post('/resident/create', [ResidentController::class, 'store'])->middleware(['auth', 'verified'])->name('resident.store');

/* Tricycle Driver routes */
Route::get('/tricycledriver', [TricycleDriverController::class, 'index'])->middleware(['auth', 'verified'])->name('tricycledriver');
Route::get('/tricycledriver/create', [TricycleDriverController::class, 'create'])->middleware(['auth', 'verified'])->name('tricycledriver.create');
Route::post('/tricycledriver/create', [TricycleDriverController::class, 'store'])->middleware(['auth', 'verified'])->name('tricycledriver.store');

require __DIR__ . '/auth.php';
