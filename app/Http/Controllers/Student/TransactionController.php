<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('details.book', 'fines')
            ->where('student_id', auth()->id())
            ->latest()
            ->get();
        return view('student.transactions.index', compact('transactions'));
    }
}

