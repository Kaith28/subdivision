<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\BulletinBoardController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\GuardController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\TricycleDriverController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\RelativesController;
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

/* Announcement */
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/announcement', [AnnouncementController::class, 'index'])->name('announcement');
    Route::get('/announcement/create', [AnnouncementController::class, 'create'])->name('announcement.create');
    Route::post('/announcement/create', [AnnouncementController::class, 'store'])->name('announcement.store');
    Route::get('/announcement/{id}', [AnnouncementController::class, 'show'])->name('announcement.show');
    Route::get('/announcement/{id}/edit', [AnnouncementController::class, 'edit'])->name('announcement.edit');
    Route::post('/announcement/{id}', [AnnouncementController::class, 'update'])->name('announcement.update');
    Route::post('/announcement/{id}/destroy', [AnnouncementController::class, 'destroy'])->name('announcement.destroy');
});

/**
 * Dashboard
 */
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

/**
 * Billing
 */
Route::get('/billing', [BillingController::class, 'index'])->name('billing');
Route::get('/billing/extend', [BillingController::class, 'extend'])->name('billing.extend');
Route::get('/billing/success', [BillingController::class, 'success'])->name('billing.success');
Route::get('/billing/cancel', [BillingController::class, 'cancel'])->name('billing.cancel');

/**
 * Admin routes
 */

Route::middleware(['auth', 'verified', 'owner'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/create', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/{id}', [AdminController::class, 'update'])->name('admin.update');
    Route::post('/admin/{id}/destroy', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::post('/admin/{id}/change-photo', [AdminController::class, 'changePhoto'])->name('admin.change.photo');

    Route::get('/admin/add-relatives', [AdminController::class, 'showAddRelativesForm'])->name('admin.show_add_relatives_form');
    Route::post('/admin/store-relatives', [AdminController::class, 'storerelatives'])->name('admin.store_relativest');
    Route::get('/admin/relatives-list', [AdminController::class, 'relativesList'])->name('admin.relatives_list');
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
    Route::post('/guard/{id}/change-photo', [GuardController::class, 'changePhoto'])->name('guard.change.photo');
});

/**
 * Resident routes
 */
Route::middleware(['auth', 'verified', 'guard'])->group(function () {
    Route::get('/resident/{id}/guest/create', [ResidentController::class, 'createGuest'])->name('resident.guest.create');
    Route::post('/resident/{id}/guest/create', [ResidentController::class, 'storeGuest'])->name('resident.guest.create');
    Route::post('/resident/{id}/guest/destroy', [ResidentController::class, 'destroy'])->middleware(['admin'])->name('guest.destroy');
    /* Route::post('/resident/{id}/realatives/create', [ResidentController::class, 'storeGuest'])->name('resident.relatives.create'); */
    Route::get('/resident', [ResidentController::class, 'index'])->name('resident');
    Route::get('/resident/create', [ResidentController::class, 'create'])->middleware(['admin'])->name('resident.create');
    Route::post('/resident/create', [ResidentController::class, 'store'])->middleware(['admin'])->name('resident.store');
    Route::get('/resident/{id}', [ResidentController::class, 'show'])->name('resident.show');
    Route::get('/resident/{id}/edit', [ResidentController::class, 'edit'])->middleware(['admin'])->name('resident.edit');
    Route::post('/resident/{id}', [ResidentController::class, 'update'])->middleware(['admin'])->name('resident.update');
    Route::post('/resident/{id}/in', [ResidentController::class, 'enter'])->name('resident.in');
    Route::post('/resident/{id}/out', [ResidentController::class, 'exit'])->name('resident.out');
    Route::post('/resident/{id}/destroy', [ResidentController::class, 'destroy'])->middleware(['admin'])->name('resident.destroy');
    Route::post('/resident/{id}/change-photo', [ResidentController::class, 'changePhoto'])->name('resident.change.photo');
});

/**
 * Guest routes
 */
Route::middleware(['auth', 'verified', 'guard'])->group(function () {
    Route::get('/guest', [GuestController::class, 'index'])->middleware(['auth', 'verified'])->name('guest');
    /*  Route::get('/guest/create', [GuestController::class, 'create'])->middleware(['admin'])->name('guest.create');
    Route::post('/guest/create', [GuestController::class, 'store'])->middleware(['admin'])->name('guest.store'); */
    Route::get('/guest/{id}', [GuestController::class, 'show'])->name('guest.show');
    Route::post('/guest/{id}/out', [GuestController::class, 'out'])->name('guest.out');
});

/**
 * Events routes
 */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/events', [EventsController::class, 'index'])->name('events');
    Route::post('/events/create', [EventsController::class, 'store'])->name('events.store');
    Route::get('/events/{id}', [EventsController::class, 'show'])->name('events.show');
    Route::get('/events/{id}/edit', [EventsController::class, 'edit'])->name('events.edit');
    Route::post('/events/{id}', [EventsController::class, 'update'])->name('events.update');
    Route::get('/events/{id}/add-guest', [EventsController::class, 'createGuest'])->name('events.guest.create');
    Route::post('/events/{id}/add-guest', [EventsController::class, 'storeGuest'])->name('events.guest.store');
    Route::post('/events/{id}/destroy', [EventsController::class, 'destroy'])->name('events.destroy');
});

Route::post('/store-date', 'DateController@store')->name('store_date');


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
    Route::post('/tricycledriver/{id}/in', [TricycleDriverController::class, 'enter'])->name('tricycledriver.in');
    Route::post('/tricycledriver/{id}/out', [TricycleDriverController::class, 'exit'])->name('tricycledriver.out');
    Route::post('/tricycledriver/{id}/destroy', [TricycleDriverController::class, 'destroy'])->middleware(['admin'])->name('tricycledriver.destroy');
    Route::post('/tricycledriver/{id}/change-photo', [TricycleDriverController::class, 'changePhoto'])->name('tricycledriver.change.photo');
    /*  Route::get('/download/{qr code}', 'DownloadController@download')->name('download');; */
});

/**
 * Record routes
 */
Route::middleware(['auth', 'verified', 'guard'])->group(function () {
    Route::get('/records', [RecordController::class, 'index'])->name('record');
});

/**
 * All Record route for download
 */
Route::get('/download-records', [RecordController::class, 'downloadRecords'])->name('download.records');

require __DIR__ . '/auth.php';

/**
 * Bulletin Board
 */
Route::get('/{slug}', [BulletinBoardController::class, 'index'])->name('bulletin-board.index');
Route::get('/{slug}/{id}', [BulletinBoardController::class, 'show'])->name('bulletin-board.show');
