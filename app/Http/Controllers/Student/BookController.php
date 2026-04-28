<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category')->where('status', 'available')->where('stock', '>', 0);

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }

        $books = $query->latest('updated_at')->get();
        $categories = Category::all();

        // Cek apakah siswa memiliki peminjaman yang sudah overdue
        $hasOverdue = Transaction::where('student_id', auth()->id())
            ->where('status', 'borrowed')
            ->whereDate('due_date', '<', now())
            ->exists();

        return view('student.books.index', compact('books', 'categories', 'hasOverdue'));
    }

    public function show(Book $book)
    {
        $book->load('category');

        $studentId = auth()->id();

        // Cek apakah siswa sedang meminjam buku ini
        $alreadyBorrowed = Transaction::where('student_id', $studentId)
            ->where('status', 'borrowed')
            ->whereHas('details', function ($q) use ($book) {
                $q->where('book_id', $book->id);
            })->exists();

        // Cek apakah siswa memiliki peminjaman yang sudah overdue
        $hasOverdue = Transaction::where('student_id', $studentId)
            ->where('status', 'borrowed')
            ->whereDate('due_date', '<', now())
            ->exists();

        return view('student.books.show', compact('book', 'alreadyBorrowed', 'hasOverdue'));
    }

    public function borrow(Request $request, Book $book)
    {
        $request->validate([
            'due_date' => 'required|date|after:today',
        ]);

        $studentId = auth()->id();

        // Cek apakah siswa sudah meminjam buku ini
        $alreadyBorrowed = Transaction::where('student_id', $studentId)
            ->where('status', 'borrowed')
            ->whereHas('details', function ($q) use ($book) {
                $q->where('book_id', $book->id);
            })->exists();

        if ($alreadyBorrowed) {
            return redirect()->route('siswa.books.show', $book)
                ->with('error', 'Anda sudah meminjam buku ini. Tidak dapat meminjam buku yang sama.');
        }

        // Cek apakah siswa memiliki peminjaman yang sudah overdue
        $hasOverdue = Transaction::where('student_id', $studentId)
            ->where('status', 'borrowed')
            ->whereDate('due_date', '<', now())
            ->exists();

        if ($hasOverdue) {
            return redirect()->route('siswa.books.show', $book)
                ->with('error', 'Anda memiliki peminjaman yang sudah lewat jatuh tempo. Segera kembalikan buku terlebih dahulu.');
        }

        $transaction = Transaction::create([
            'transaction_code' => 'TRX-' . now()->format('YmdHis') . '-' . auth()->id(),
            'student_id' => auth()->id(),
            'officer_id' => null, // Peminjaman mandiri, belum ada petugas
            'borrow_date' => now(),
            'due_date' => $request->due_date,
            'status' => 'borrowed',
        ]);

        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'book_id' => $book->id,
            'quantity' => 1,
            'condition_borrow' => 'good',
            'condition_return' => null,
            'status' => 'borrowed',
        ]);

        $book->decrement('stock');
        if ($book->stock <= 0) {
            $book->update(['status' => 'borrowed']);
        }

        return redirect()->route('siswa.transactions.index')->with('success', 'Peminjaman berhasil diajukan, tunggu konfirmasi petugas');
    }
}

