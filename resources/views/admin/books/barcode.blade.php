@extends('layouts.app')

@section('title', 'Barcode Buku')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Barcode Buku</h1>
    <p class="text-gray-600">{{ $book->title }}</p>
</div>

<div class="max-w-md mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-8 text-center">
        <div class="mb-4">
            <i class="fas fa-barcode text-indigo-500 text-4xl"></i>
        </div>

        <h2 class="text-xl font-bold text-gray-800 mb-1">{{ $book->title }}</h2>
        <p class="text-sm text-gray-500 mb-6">{{ $book->author }}</p>

        <div class="bg-white border-2 border-gray-200 rounded-lg p-4 mb-4 inline-block">
            <img src="data:image/png;base64,{{ $barcodeImage }}" alt="Barcode" class="mx-auto" style="max-width: 100%; height: auto;">
        </div>

        <p class="text-lg font-mono font-bold text-gray-800 tracking-wider">{{ $book->barcode }}</p>

        <div class="mt-6 text-xs text-gray-400">
            <p>Barcode ini dapat discan menggunakan scanner</p>
            <p>untuk memproses peminjaman buku</p>
        </div>

        <div class="mt-6 flex justify-center gap-3">
            <a href="{{ route('admin.books.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                <i class="fas fa-arrow-left mr-1"></i>Kembali
            </a>
            <button onclick="window.print()" class="text-gray-600 hover:text-gray-800 text-sm">
                <i class="fas fa-print mr-1"></i>Cetak
            </button>
        </div>
    </div>
</div>
@endsection

