<?php

namespace App\Http\Controllers\Officer;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Book;
use App\Models\User;
use App\Models\Fine;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('student', 'details.book')->latest()->get();
        return view('officer.transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('student', 'details.book', 'fines');
        return view('officer.transactions.show', compact('transaction'));
    }

    public function borrowForm()
    {
        $books = Book::where('status', 'available')->where('stock', '>', 0)->get();
        return view('officer.transactions.borrow', compact('books'));
    }

    public function processBorrow(Request $request)
    {
        $request->validate([
            'student_barcode' => 'required|string',
            'book_ids' => 'required|array',
            'book_ids.*' => 'exists:books,id',
            'due_date' => 'required|date|after:today',
        ]);

        $student = User::whereHas('student', function ($q) use ($request) {
            $q->where('barcode', $request->student_barcode)->orWhere('nis', $request->student_barcode);
        })->first();

        if (!$student) {
            return back()->with('error', 'Siswa tidak ditemukan. Periksa barcode atau NIS.');
        }

        $transaction = Transaction::create([
            'transaction_code' => 'TRX-' . now()->format('YmdHis') . '-' . $student->id,
            'student_id' => $student->id,
            'officer_id' => auth()->id(),
            'borrow_date' => now(),
            'due_date' => $request->due_date,
            'status' => 'borrowed',
        ]);

        foreach ($request->book_ids as $bookId) {
            $book = Book::find($bookId);
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'book_id' => $bookId,
                'quantity' => 1,
                'condition_borrow' => 'good',
                'condition_return' => null,
                'status' => 'borrowed',
            ]);
            $book->decrement('stock');
            if ($book->stock <= 0) {
                $book->update(['status' => 'borrowed']);
            }
        }

        return redirect()->route('petugas.transactions.index')->with('success', 'Peminjaman berhasil dicatat');
    }

    public function returnForm()
    {
        $transactions = Transaction::with('student', 'details.book')
            ->where('status', 'borrowed')
            ->latest()
            ->get();
        return view('officer.transactions.return', compact('transactions'));
    }

    public function processReturn(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'book_conditions' => 'required|array',
        ]);

        $transaction = Transaction::with('details')->findOrFail($request->transaction_id);

        foreach ($transaction->details as $detail) {
            $condition = $request->book_conditions[$detail->id] ?? 'good';
            $detail->update([
                'condition_return' => $condition,
                'status' => $condition === 'good' ? 'returned' : $condition,
            ]);

            $book = Book::find($detail->book_id);
            if ($condition === 'good') {
                $book->increment('stock');
                $book->update(['status' => 'available']);
            } elseif ($condition === 'damaged') {
                $book->update(['status' => 'damaged']);
                Fine::create([
                    'transaction_id' => $transaction->id,
                    'type' => 'damaged',
                    'amount' => $book->price * 0.5,
                    'description' => 'Buku rusak: ' . $book->title,
                    'status' => 'unpaid',
                ]);
            } elseif ($condition === 'lost') {
                $book->update(['status' => 'lost']);
                Fine::create([
                    'transaction_id' => $transaction->id,
                    'type' => 'lost',
                    'amount' => $book->price,
                    'description' => 'Buku hilang: ' . $book->title,
                    'status' => 'unpaid',
                ]);
            }
        }

        $transaction->update([
            'return_date' => now(),
            'status' => 'returned',
        ]);

        if (Carbon::parse($transaction->due_date)->isPast()) {
            $daysLate = Carbon::parse($transaction->due_date)->diffInDays(now());
            Fine::create([
                'transaction_id' => $transaction->id,
                'type' => 'late',
                'amount' => $daysLate * 1000,
                'description' => 'Terlambat ' . $daysLate . ' hari',
                'status' => 'unpaid',
            ]);
        }

        return redirect()->route('petugas.transactions.index')->with('success', 'Pengembalian berhasil diproses');
    }
}

