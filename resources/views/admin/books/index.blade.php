@extends('layouts.app')

@section('title', 'Kelola Buku')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Kelola Buku</h1>
        <p class="text-gray-600">Daftar buku perpustakaan</p>
    </div>
    <a href="{{ route('admin.books.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
        <i class="fas fa-plus mr-2"></i>Tambah Buku
    </a>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead><tr class="bg-gray-50"><th class="px-4 py-3">Kode</th><th class="px-4 py-3">Judul</th><th class="px-4 py-3">Penulis</th><th class="px-4 py-3">Kategori</th><th class="px-4 py-3">Stok</th><th class="px-4 py-3">Harga</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Aksi</th></tr></thead>
            <tbody>
                @forelse($books as $book)
                <tr class="border-t">
                    <td class="px-4 py-3 font-mono text-sm">{{ $book->code }}</td>
                    <td class="px-4 py-3 font-medium">{{ $book->title }}</td>
                    <td class="px-4 py-3">{{ $book->author }}</td>
                    <td class="px-4 py-3">{{ $book->category->name ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $book->stock }}</td>
                    <td class="px-4 py-3">Rp {{ number_format($book->price, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">
                        @if($book->status == 'available')<span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Tersedia</span>
                        @elseif($book->status == 'borrowed')<span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Dipinjam</span>
                        @elseif($book->status == 'damaged')<span class="bg-orange-100 text-orange-800 px-2 py-1 rounded text-xs">Rusak</span>
                        @else<span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Hilang</span>@endif
                    </td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.books.edit', $book) }}" class="text-blue-600 hover:underline mr-3"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.books.destroy', $book) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty<tr><td colspan="8" class="px-4 py-6 text-center text-gray-500">Belum ada buku</td></tr>@endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
