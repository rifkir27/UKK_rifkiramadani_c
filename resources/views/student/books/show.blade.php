@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="bg-white rounded-xl shadow p-6 max-w-2xl mx-auto">
    {{-- Notifikasi Overdue --}}
    @if($hasOverdue)
    <div class="mb-6 bg-red-100 border-l-4 border-red-500 rounded-lg p-4">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle text-red-600 text-xl mr-3"></i>
            <div>
                <h3 class="font-bold text-red-800">Peringatan!</h3>
                <p class="text-red-700 text-sm">Anda memiliki peminjaman yang sudah lewat jatuh tempo. Segera kembalikan buku terlebih dahulu sebelum meminjam buku lain.</p>
            </div>
        </div>
    </div>
    @endif

    {{-- Notifikasi Buku Sudah Dipinjam --}}
    @if($alreadyBorrowed)
    <div class="mb-6 bg-yellow-100 border-l-4 border-yellow-500 rounded-lg p-4">
        <div class="flex items-center">
            <i class="fas fa-info-circle text-yellow-600 text-xl mr-3"></i>
            <div>
                <h3 class="font-bold text-yellow-800">Informasi</h3>
                <p class="text-yellow-700 text-sm">Anda sedang meminjam buku ini. Tidak dapat meminjam buku yang sama sebelum dikembalikan.</p>
            </div>
        </div>
    </div>
    @endif

    <div class="flex flex-col md:flex-row gap-6">
        {{-- Cover Image --}}
        <div class="flex-shrink-0 mx-auto md:mx-0">
            @if($book->cover_image)
                <img src="{{ asset('storage/' . $book->cover_image) }}" alt="Cover {{ $book->title }}" class="w-40 h-56 object-cover rounded-lg shadow-lg">
            @else
                <div class="w-40 h-56 bg-gray-200 rounded-lg shadow-lg flex items-center justify-center text-gray-400">
                    <div class="text-center">
                        <i class="fas fa-book text-4xl mb-2"></i>
                        <p class="text-sm">No Cover</p>
                    </div>
                </div>
            @endif
        </div>

        {{-- Book Details --}}
        <div class="flex-1">
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

            @if($book->stock > 0 && !$alreadyBorrowed && !$hasOverdue)
            <form action="{{ route('siswa.books.borrow', $book) }}" method="POST" class="border-t pt-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Tanggal Jatuh Tempo</label>
                    <input type="date" name="due_date" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
                </div>
                <button type="submit" class="w-full bg-indigo-600 text-white font-bold py-3 rounded-lg hover:bg-indigo-700">Ajukan Peminjaman</button>
            </form>
            @elseif($alreadyBorrowed)
            <div class="border-t pt-6 text-center">
                <p class="text-yellow-600 font-medium"><i class="fas fa-info-circle mr-2"></i>Anda sedang meminjam buku ini</p>
            </div>
            @elseif($hasOverdue)
            <div class="border-t pt-6 text-center">
                <p class="text-red-600 font-medium"><i class="fas fa-exclamation-triangle mr-2"></i>Selesaikan peminjaman terlambat terlebih dahulu</p>
            </div>
            @else
            <div class="border-t pt-6 text-center">
                <p class="text-red-600 font-medium">Buku ini sedang tidak tersedia</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

