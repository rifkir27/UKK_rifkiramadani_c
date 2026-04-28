@extends('layouts.app')

@section('title', 'QR Code Peminjaman')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">QR Code Peminjaman</h1>
    <p class="text-gray-600">Tunjukkan QR Code ini ke petugas perpustakaan saat meminjam buku</p>
</div>

<div class="max-w-md mx-auto">
    <div class="bg-white rounded-xl shadow-lg p-8 text-center">
        <div class="mb-4">
            <i class="fas fa-id-card text-indigo-500 text-4xl"></i>
        </div>
        
        <h2 class="text-xl font-bold text-gray-800 mb-1">{{ auth()->user()->name }}</h2>
        <p class="text-sm text-gray-500 mb-6">{{ $student->nis }}</p>
        
        <!-- QR Code Image -->
        <div class="bg-white border-2 border-gray-200 rounded-lg p-4 mb-4 inline-block">
            <img src="data:image/png;base64,{{ $qrImage }}" alt="QR Code" class="mx-auto" style="max-width: 100%; height: auto;">
        </div>
        
        <p class="text-lg font-mono font-bold text-gray-800 tracking-wider">{{ $student->barcode }}</p>
        
        <div class="mt-6 text-xs text-gray-400">
            <p>QR Code ini dapat discan oleh petugas perpustakaan</p>
            <p>untuk memproses peminjaman buku</p>
        </div>
        
        <div class="mt-6">
            <a href="{{ route('siswa.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 text-sm">
                <i class="fas fa-arrow-left mr-1"></i>Kembali ke Dashboard
            </a>
        </div>
    </div>
</div>
@endsection

