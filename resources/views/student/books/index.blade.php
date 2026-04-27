@extends('layouts.app')

@section('title', 'Katalog Buku')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Katalog Buku</h1>
    <p class="text-gray-600">Cari dan pinjam buku yang tersedia</p>
</div>

<div class="bg-white rounded-xl shadow p-4 mb-6">
    <form action="{{ route('siswa.books.index') }}" method="GET" class="flex gap-3 flex-wrap">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau penulis..." class="flex-1 min-w-[200px] px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        <select name="category" class="px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
            <option value="">Semua Kategori</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
            @endforeach
        </select>
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Cari</button>
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($books as $book)
    <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">
        <div class="p-6">
            <div class="flex justify-between items-start mb-2">
                <span class="bg-indigo-100 text-indigo-800 px-2 py-1 rounded text-xs">{{ $book->category->name }}</span>
                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Stok: {{ $book->stock }}</span>
            </div>
            <h3 class="font-bold text-lg mb-1">{{ $book->title }}</h3>
            <p class="text-gray-500 text-sm mb-2">{{ $book->author }} | {{ $book->publisher }} {{ $book->year }}</p>
            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($book->description, 80) }}</p>
            <div class="flex justify-between items-center">
                <span class="font-bold text-indigo-700">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                <a href="{{ route('siswa.books.show', $book) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-sm">Pinjam</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-8 text-gray-500">Tidak ada buku tersedia</div>
    @endforelse
</div>
@endsection
