<?php

use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;

// ── USER AREA ────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/event/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/checkout/{event}', [App\Http\Controllers\CheckoutController::class, 'create'])->name('checkout.create');
Route::post('/checkout/{event}', [App\Http\Controllers\CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/my-ticket', [TicketController::class, 'show'])->name('ticket');

Route::get('/tentang', fn() => '<h1>Tentang AmikomEventHub</h1>');
Route::get('/contact',  fn() => view('contact'));
Route::get('/profil',   fn() => view('profil'));
Route::get('/katalog',  fn() => view('katalog'));
Route::get('/bantuan',  fn() => view('bantuan'));

// ── ADMIN AREA ───────────────────────────────────────
// Route::resource('events', ...) menghasilkan 7 rute CRUD sekaligus:
//  GET    /admin/events              → index()    daftar event
//  GET    /admin/events/create       → create()   form tambah
//  POST   /admin/events              → store()    simpan baru
//  GET    /admin/events/{event}/edit → edit()     form edit
//  PUT    /admin/events/{event}      → update()   simpan ubah
//  DELETE /admin/events/{event}      → destroy()  hapus
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/', [DashboardController::class, 'show'])->name('dashboard');
//     Route::resource('events', AdminEventController::class);
// });

Route::get('/login', function () {
return redirect()->route('admin.login');
})->name('login');
// Grouping untuk URL berawalan /admin
Route::prefix('admin')->name('admin.')->group(function () {
// Rute Login bebas akses
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.post');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Mengamankan Route Administrasi di balik tembok (Middleware)
Route::middleware(['auth', 'admin'])->group(function () {
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('events', AdminEventController::class);
Route::get('transactions', [\App\Http\Controllers\Admin\TransactionController::class, 'index'])->name('transactions.index');
});
});
