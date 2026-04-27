@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
    <p class="text-gray-600">Ringkasan data perpustakaan</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Buku</p>
                <p class="text-2xl font-bold">{{ $totalBooks }}</p>
            </div>
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                <i class="fas fa-book text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-yellow-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Sedang Dipinjam</p>
                <p class="text-2xl font-bold">{{ $totalBorrowed }}</p>
            </div>
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                <i class="fas fa-hand-holding text-yellow-600 text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Siswa</p>
                <p class="text-2xl font-bold">{{ $totalStudents }}</p>
            </div>
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-users text-green-600 text-xl"></i>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-red-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Denda Belum Bayar</p>
                <p class="text-2xl font-bold">Rp {{ number_format($totalFines, 0, ',', '.') }}</p>
            </div>
            <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                <i class="fas fa-money-bill-wave text-red-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <h2 class="text-xl font-bold text-gray-800 mb-4">Transaksi Terbaru</h2>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50">
                    <th class="px-4 py-3">Kode</th>
                    <th class="px-4 py-3">Siswa</th>
                    <th class="px-4 py-3">Buku</th>
                    <th class="px-4 py-3">Tanggal Pinjam</th>
                    <th class="px-4 py-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTransactions as $t)
                <tr class="border-t">
                    <td class="px-4 py-3 font-mono text-sm">{{ $t->transaction_code }}</td>
                    <td class="px-4 py-3">{{ $t->student->name }}</td>
                    <td class="px-4 py-3">
                        @foreach($t->details as $d)
                            <span class="inline-block bg-gray-100 rounded px-2 py-1 text-xs mr-1">{{ $d->book->title }}</span>
                        @endforeach
                    </td>
                    <td class="px-4 py-3">{{ $t->borrow_date->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">
                        @if($t->status == 'borrowed')
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Dipinjam</span>
                        @elseif($t->status == 'returned')
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Dikembalikan</span>
                        @elseif($t->status == 'lost')
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Hilang</span>
                        @else
                            <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">Rusak</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada transaksi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

