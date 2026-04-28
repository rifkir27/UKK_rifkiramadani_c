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
        return view('student.books.index', compact('books', 'categories'));
    }

    public function show(Book $book)
    {
        $book->load('category');
        return view('student.books.show', compact('book'));
    }

    public function borrow(Request $request, Book $book)
    {
        $request->validate([
            'due_date' => 'required|date|after:today',
        ]);

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

