<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function index()
    {
        $fines = Fine::whereHas('transaction', function ($q) {
            $q->where('student_id', auth()->id());
        })->with('transaction')->latest()->get();
        return view('student.fines.index', compact('fines'));
    }
}

