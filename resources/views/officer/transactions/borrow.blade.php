@extends('layouts.app')

@section('title', 'Proses Peminjaman')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Proses Peminjaman</h1>
    <p class="text-gray-600">Scan barcode/NIS siswa dan pilih buku</p>
</div>

<div class="bg-white rounded-xl shadow p-6 max-w-2xl">
    <form action="{{ route('petugas.transactions.borrow.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Barcode / NIS Siswa</label>
            <input type="text" name="student_barcode" required placeholder="Scan atau ketik barcode/NIS" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Pilih Buku</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-64 overflow-y-auto border rounded-lg p-3">
                @foreach($books as $book)
                <label class="flex items-center gap-3 p-3 border rounded-lg hover:bg-gray-50 cursor-pointer">
                    <input type="checkbox" name="book_ids[]" value="{{ $book->id }}">
                    <div>
                        <p class="font-medium text-sm">{{ $book->title }}</p>
                        <p class="text-xs text-gray-500">{{ $book->author }} | Stok: {{ $book->stock }}</p>
                    </div>
                </label>
                @endforeach
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Tanggal Jatuh Tempo</label>
            <input type="date" name="due_date" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        </div>
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Proses Peminjaman</button>
    </form>
</div>
@endsection
