<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function index()
    {
        $fines = Fine::with('transaction.student')->latest()->get();
        return view('officer.fines.index', compact('fines'));
    }

    public function pay(Fine $fine)
    {
        $fine->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);
        return back()->with('success', 'Denda berhasil dibayar');
    }
}
