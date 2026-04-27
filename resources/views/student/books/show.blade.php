@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-2xl mx-auto">
    <div class="flex justify-between items-start mb-4">
        <div>
            <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded text-xs">{{ $book->category->name }}</span>
            <h1 class="text-2xl font-bold mt-2">{{ $book->title }}</h1>
        </div>
        <span class="bg-green-100 text-green-800 px-3 py-1 rounded text-sm">Stok: {{ $book->stock }}</span>
    </div>

    <div class="grid grid-cols-2 gap-4 mb-6 text-sm">
        <div><span class="text-gray-500">Penulis:</span> <span class="font-medium">{{ $book->author }}</span></div>
        <div><span class="text-gray-500">Penerbit:</span> <span class="font-medium">{{ $book->publisher }}</span></div>
        <div><span class="text-gray-500">Tahun:</span> <span class="font-medium">{{ $book->year }}</span></div>
        <div><span class="text-gray-500">Harga:</span> <span class="font-medium">Rp {{ number_format($book->price, 0, ',', '.') }}</span></div>
    </div>

    <p class="text-gray-600 mb-6">{{ $book->description }}</p>

    @if($book->stock > 0)
    <form action="{{ route('siswa.books.borrow', $book) }}" method="POST" class="border-t pt-6">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Tanggal Jatuh Tempo</label>
            <input type="date" name="due_date" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        </div>
        <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700">Ajukan Peminjaman</button>
    </form>
    @else
    <div class="border-t pt-6 text-center">
        <p class="text-red-600 font-medium">Buku ini sedang tidak tersedia</p>
    </div>
    @endif
</div>
@endsection
