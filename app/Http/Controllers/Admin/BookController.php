<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->latest()->get();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|integer',
            'stock' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
        ]);
        $code = 'BUKU-' . str_pad(Book::count() + 1, 4, '0', STR_PAD_LEFT);
        Book::create(array_merge($request->all(), ['code' => $code, 'status' => 'available']));
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'year' => 'nullable|integer',
            'stock' => 'required|integer|min:0',
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'status' => 'required|in:available,borrowed,damaged,lost',
        ]);
        $book->update($request->all());
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus');
    }
}

