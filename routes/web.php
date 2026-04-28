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
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Student\BookController as StudentBook;
use App\Http\Controllers\Student\TransactionController as StudentTransaction;
use App\Http\Controllers\Student\FineController as StudentFine;


// Public
Route::get('/', function () {
    return view('landing');
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
    Route::get('/books/{book}/barcode', [BookController::class, 'showBarcode'])->name('books.barcode');
    Route::resource('rayons', RayonController::class);
    Route::resource('rombels', RombelController::class);
    Route::resource('users', UserController::class);
    Route::get('/petugas', [UserController::class, 'indexPetugas'])->name('petugas.index');
    Route::get('/siswa', [UserController::class, 'indexSiswa'])->name('siswa.index');
    Route::get('/users/petugas/create', [UserController::class, 'createPetugas'])->name('users.create-petugas');
    Route::post('/users/petugas', [UserController::class, 'storePetugas'])->name('users.store-petugas');
    Route::get('/users/siswa/create', [UserController::class, 'createSiswa'])->name('users.create-siswa');
    Route::post('/users/siswa', [UserController::class, 'storeSiswa'])->name('users.store-siswa');
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

// Student Routes
Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/dashboard', [StudentDashboard::class, 'index'])->name('dashboard');
    Route::get('/books', [StudentBook::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [StudentBook::class, 'show'])->name('books.show');
    Route::post('/books/{book}/borrow', [StudentBook::class, 'borrow'])->name('books.borrow');
    Route::get('/transactions', [StudentTransaction::class, 'index'])->name('transactions.index');
    Route::get('/fines', [StudentFine::class, 'index'])->name('fines.index');
    Route::get('/barcode', [StudentDashboard::class, 'showBarcode'])->name('barcode');
});
