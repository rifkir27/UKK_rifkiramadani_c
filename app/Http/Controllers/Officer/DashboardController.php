<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Transaction;
use App\Models\Fine;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();
        $todayBorrowed = Transaction::whereDate('created_at', today())->count();
        $todayReturned = Transaction::whereDate('return_date', today())->count();
        $pendingFines = Fine::where('status', 'unpaid')->count();
        $recentTransactions = Transaction::with('student', 'details.book')
            ->latest()
            ->take(5)
            ->get();
        return view('officer.dashboard.index', compact(
            'totalBooks', 'todayBorrowed', 'todayReturned', 'pendingFines', 'recentTransactions'
        ));
    }
}

