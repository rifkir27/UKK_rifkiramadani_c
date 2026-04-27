<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Fine;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $totalBorrowed = Transaction::where('status', 'borrowed')->count();
        $totalStudents = User::where('role', 'siswa')->count();
        $totalFines = Fine::where('status', 'unpaid')->sum('amount');
        $recentTransactions = Transaction::with('student', 'details.book')
            ->latest()
            ->take(5)
            ->get();
        return view('admin.dashboard.index', compact(
            'totalBooks', 'totalBorrowed', 'totalStudents', 'totalFines', 'recentTransactions'
        ));
    }
}
