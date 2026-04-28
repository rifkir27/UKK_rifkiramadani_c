@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Dashboard Siswa</h1>
    <p class="text-gray-600">Selamat datang, {{ auth()->user()->name }}</p>
</div>

<!-- Alarm Section -->
@if($overdueLoans->count() > 0)
<div class="mb-6 bg-red-100 border-l-4 border-red-500 rounded-lg p-4">
    <div class="flex items-center">
        <i class="fas fa-exclamation-triangle text-red-600 text-2xl mr-3"></i>
        <div>
            <h3 class="font-bold text-red-800">Peringatan!</h3>
            <p class="text-red-700">Anda memiliki {{ $overdueLoans->count() }} peminjaman yang sudah terlambat. Segera kembalikan atau hubungi petugas!</p>
        </div>
    </div>
</div>
@endif

@if($dueSoonLoans->count() > 0)
<div class="mb-6 bg-orange-100 border-l-4 border-orange-500 rounded-lg p-4">
    <div class="flex items-center">
        <i class="fas fa-clock text-orange-600 text-2xl mr-3"></i>
        <div>
            <h3 class="font-bold text-orange-800">Jatuh Tempo Dekat</h3>
            <p class="text-orange-700">{{ $dueSoonLoans->count() }} peminjaman akan jatuh tempo dalam 3 hari ke depan.</p>
        </div>
    </div>
</div>
@endif

<!-- Barcode Card -->
@if($studentBarcode)
<div class="mb-6 bg-white rounded-xl shadow p-6 border-l-4 border-indigo-500">
    <div class="flex justify-between items-center">
        <div>
            <p class="text-gray-500 text-sm">Kode Peminjaman</p>
            <p class="text-xl font-bold font-mono">{{ $studentBarcode }}</p>
            <p class="text-xs text-gray-400 mt-1">Tunjukkan QR Code ini ke petugas saat meminjam buku</p>
        </div>
        <a href="{{ route('siswa.barcode') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 text-sm">
            <i class="fas fa-qrcode mr-2"></i>Lihat QR Code
        </a>
    </div>
</div>
@endif

<!-- Stats -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-500">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Peminjaman Aktif</p>
                <p class="text-3xl font-bold">{{ $activeLoans->count() }}</p>
            </div>
            <i class="fas fa-book text-blue-500 text-3xl"></i>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-red-500">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Terlambat</p>
                <p class="text-3xl font-bold">{{ $overdueLoans->count() }}</p>
            </div>
            <i class="fas fa-exclamation-circle text-red-500 text-3xl"></i>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow p-6 border-l-4 border-yellow-500">
        <div class="flex justify-between items-center">
            <div>
                <p class="text-gray-500 text-sm">Denda Belum Bayar</p>
                <p class="text-3xl font-bold">Rp {{ number_format($totalFines, 0, ',', '.') }}</p>
            </div>
            <i class="fas fa-money-bill-wave text-yellow-500 text-3xl"></i>
        </div>
    </div>
</div>

<!-- Active Loans Detail -->
@if($activeLoans->count() > 0)
<div class="bg-white rounded-xl shadow overflow-hidden mb-6">
    <div class="px-6 py-4 border-b bg-gray-50">
        <h2 class="text-lg font-bold">Peminjaman Aktif</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase text-sm">
                <tr>
                    <th class="px-6 py-3">Kode</th>
                    <th class="px-6 py-3">Buku</th>
                    <th class="px-6 py-3">Jatuh Tempo</th>
                    <th class="px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($activeLoans as $t)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 font-medium">{{ $t->transaction_code }}</td>
                    <td class="px-6 py-3">
                        @foreach($t->details as $d)
                            <span class="block text-sm">{{ $d->book->title }}</span>
                        @endforeach
                    </td>
                    <td class="px-6 py-3">{{ $t->due_date->format('d/m/Y') }}</td>
                    <td class="px-6 py-3">
                        @php
                            $daysUntilDue = \Carbon\Carbon::now()->diffInDays($t->due_date, false);
                        @endphp
                        @if($daysUntilDue < 0)
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-red-400 text-white">Terlambat {{ abs($daysUntilDue) }} hari</span>
                        @elseif($daysUntilDue <= 3)
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-orange-400 text-white">{{ $daysUntilDue }} hari lagi</span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-400 text-white">Aman</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

<!-- Loan History -->
<div class="bg-white rounded-xl shadow overflow-hidden">
    <div class="px-6 py-4 border-b bg-gray-50">
        <h2 class="text-lg font-bold">Riwayat Peminjaman Terbaru</h2>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase text-sm">
                <tr>
                    <th class="px-6 py-3">Kode</th>
                    <th class="px-6 py-3">Buku</th>
                    <th class="px-6 py-3">Tanggal</th>
                    <th class="px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($loanHistory as $t)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 font-medium">{{ $t->transaction_code }}</td>
                    <td class="px-6 py-3">{{ $t->details->first()?->book?->title ?? '-' }}</td>
                    <td class="px-6 py-3">{{ $t->borrow_date->format('d/m/Y') }}</td>
                    <td class="px-6 py-3">
                        <span class="px-3 py-1 rounded-full text-xs font-bold
                            {{ $t->status == 'returned' ? 'bg-green-100 text-green-800' : ($t->status == 'borrowed' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800') }}">
                            {{ $t->status }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-6 text-center text-gray-500">Belum ada riwayat peminjaman</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
