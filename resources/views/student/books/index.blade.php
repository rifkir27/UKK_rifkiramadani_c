@extends('layouts.app')

@section('title', 'Katalog Buku')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Katalog Buku</h1>
    <p class="text-gray-600">Cari dan pinjam buku yang tersedia</p>
</div>

{{-- Notifikasi Overdue Global --}}
@if($hasOverdue)
<div class="mb-6 bg-red-100 border-l-4 border-red-500 rounded-lg p-4">
    <div class="flex items-center">
        <i class="fas fa-exclamation-triangle text-red-600 text-2xl mr-3"></i>
        <div>
            <h3 class="font-bold text-red-800">Peringatan!</h3>
            <p class="text-red-700">Anda memiliki peminjaman yang sudah lewat jatuh tempo. Segera kembalikan buku terlebih dahulu sebelum meminjam buku lain.</p>
        </div>
    </div>
</div>
@endif

<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 mb-8">
    <form action="{{ route('siswa.books.index') }}" method="GET" class="flex gap-3 flex-wrap items-center">
        <div class="flex-1 min-w-[200px] relative">
            <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul atau penulis..." class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition-all">
        </div>
        <div class="relative">
            <i class="fas fa-filter absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
            <select name="category" class="pl-10 pr-8 py-2.5 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition-all bg-white appearance-none cursor-pointer">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2.5 rounded-lg hover:bg-indigo-700 transition-colors font-medium flex items-center gap-2">
            <i class="fas fa-search text-sm"></i> Cari
        </button>
        @if(request('search') || request('category'))
            <a href="{{ route('siswa.books.index') }}" class="text-gray-500 hover:text-gray-700 px-3 py-2.5 transition-colors" title="Reset filter">
                <i class="fas fa-times"></i>
            </a>
        @endif
    </form>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($books as $book)
    <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden flex flex-col">
        {{-- Cover Image --}}
        <div class="aspect-[4/3] bg-gray-50 flex items-center justify-center overflow-hidden relative group">
            @if($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover {{ $book->title }}" class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
            @else
                <div class="text-center text-gray-300">
                    <div class="w-20 h-20 mx-auto mb-3 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-book text-3xl text-gray-300"></i>
                    </div>
                    <p class="text-sm font-medium">Tidak Ada Cover</p>
                </div>
            @endif
        </div>
        <div class="p-5 flex-1 flex flex-col">
            <div class="flex justify-between items-start mb-3">
                <span class="bg-indigo-50 text-indigo-700 px-2.5 py-1 rounded-md text-xs font-medium">{{ $book->category->name }}</span>
                <span class="bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-md text-xs font-medium">Stok: {{ $book->stock }}</span>
            </div>
            <h3 class="font-bold text-lg text-gray-900 mb-1 line-clamp-2">{{ $book->title }}</h3>
            <p class="text-gray-500 text-sm mb-3">{{ $book->author }}</p>
            <p class="text-gray-600 text-sm mb-4 flex-1 line-clamp-3">{{ Str::limit($book->description, 100) }}</p>
            <div class="flex items-center justify-between mt-auto pt-4 border-t border-gray-100">
                <span class="font-semibold text-indigo-600 text-sm">Rp {{ number_format($book->price, 0, ',', '.') }}</span>
                <a href="{{ route('siswa.books.show', $book) }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-sm font-medium transition-colors">Lihat Detail</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full flex flex-col items-center justify-center py-12 text-gray-400">
        <i class="fas fa-book-open text-5xl mb-4 text-gray-300"></i>
        <p class="text-lg font-medium text-gray-500">Tidak ada buku tersedia</p>
        <p class="text-sm">Coba ubah filter pencarian Anda</p>
    </div>
    @endforelse
</div>
@endsection
