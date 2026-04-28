<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Picqer\Barcode\BarcodeGeneratorPNG;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->latest('updated_at')->get();
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
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $lastId = Book::max('id') ?? 0;
        $code = 'BUKU-' . str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
        $barcode = 'BK' . str_pad($lastId + 1, 6, '0', STR_PAD_LEFT);
        $data = array_merge($request->except('cover_image'), [
            'code' => $code,
            'barcode' => $barcode,
            'status' => 'available'
        ]);
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }
        Book::create($data);
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
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = $request->except('cover_image');
        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('books', 'public');
        }
        $book->update($data);
        return redirect()->route('admin.books.index')->with('success', 'Buku ' . $book->title . ' berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        $title = $book->title;
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Berhasil menghapus buku ' . $title);
    }

    public function showBarcode(Book $book)
    {
        if (empty($book->barcode)) {
            $book->barcode = 'BK' . str_pad($book->id, 6, '0', STR_PAD_LEFT);
            $book->save();
        }
        $generator = new BarcodeGeneratorPNG();
        $barcodeImage = base64_encode($generator->getBarcode($book->barcode, $generator::TYPE_CODE_128, 2, 80));
        return view('admin.books.barcode', compact('book', 'barcodeImage'));
    }
}
