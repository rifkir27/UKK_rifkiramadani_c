<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\RayonController;
use App\Http\Controllers\Admin\RombelController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Officer\DashboardController as OfficerDashboard;
use App\Http\Controllers\Officer\TransactionController as OfficerTransaction;
use App\Http\Controllers\Officer\FineController as OfficerFine;


// Public
Route::get('/', function () {
    return redirect('/login');
});

// Auth Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
     Route::resource('categories', CategoryController::class);
    Route::resource('books', BookController::class);
    Route::resource('rayons', RayonController::class);
    Route::resource('rombels', RombelController::class);
    Route::resource('users', UserController::class);
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/data', [ReportController::class, 'data'])->name('reports.data');
    Route::get('/reports/pdf', [ReportController::class, 'pdf'])->name('reports.pdf');
    });

    // Officer Routes
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard', [OfficerDashboard::class, 'index'])->name('dashboard');
    Route::get('/transactions', [OfficerTransaction::class, 'index'])->name('transactions.index');
    Route::get('/transactions/borrow', [OfficerTransaction::class, 'borrowForm'])->name('transactions.borrow');
    Route::post('/transactions/borrow', [OfficerTransaction::class, 'processBorrow'])->name('transactions.borrow.store');
    Route::get('/transactions/return', [OfficerTransaction::class, 'returnForm'])->name('transactions.return');
    Route::post('/transactions/return', [OfficerTransaction::class, 'processReturn'])->name('transactions.return.store');
    Route::get('/transactions/{transaction}', [OfficerTransaction::class, 'show'])->name('transactions.show');
    Route::get('/fines', [OfficerFine::class, 'index'])->name('fines.index');
    Route::post('/fines/{fine}/pay', [OfficerFine::class, 'pay'])->name('fines.pay');
});

