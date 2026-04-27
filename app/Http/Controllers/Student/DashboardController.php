<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Fine;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $studentId = auth()->id();

        $activeLoans = Transaction::with('details.book')
            ->where('student_id', $studentId)
            ->where('status', 'borrowed')
            ->get();

        $overdueLoans = $activeLoans->filter(function ($transaction) {
            return Carbon::parse($transaction->due_date)->isPast();
        });

        $dueSoonLoans = $activeLoans->filter(function ($transaction) {
            $daysUntilDue = Carbon::now()->diffInDays(Carbon::parse($transaction->due_date), false);
            return $daysUntilDue <= 3 && $daysUntilDue >= 0;
        });

        $totalFines = Fine::whereHas('transaction', function ($q) use ($studentId) {
            $q->where('student_id', $studentId);
        })->where('status', 'unpaid')->sum('amount');

        $loanHistory = Transaction::with('details.book')
            ->where('student_id', $studentId)
            ->latest()
            ->take(5)
            ->get();

        return view('student.dashboard.index', compact(
            'activeLoans', 'overdueLoans', 'dueSoonLoans', 'totalFines', 'loanHistory'
        ));
    }
}

