@extends('layouts.app')

@section('title', 'Semua Transaksi')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Semua Transaksi</h1>
    <p class="text-gray-600">Riwayat peminjaman dan pengembalian</p>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead><tr class="bg-gray-50"><th class="px-4 py-3">Kode</th><th class="px-4 py-3">Siswa</th><th class="px-4 py-3">Buku</th><th class="px-4 py-3">Pinjam</th><th class="px-4 py-3">Kembali</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Denda</th></tr></thead>
            <tbody>
                @forelse($transactions as $t)
                <tr class="border-t">
                    <td class="px-4 py-3 font-mono text-sm">{{ $t->transaction_code }}</td>
                    <td class="px-4 py-3">{{ $t->student->name ?? '-' }}</td>
                    <td class="px-4 py-3">@foreach($t->details as $d)<span class="inline-block bg-gray-100 rounded px-2 py-1 text-xs mr-1">{{ $d->book->title }}</span>@endforeach</td>
                    <td class="px-4 py-3">{{ $t->borrow_date?->format('d/m/Y') }}</td>
                    <td class="px-4 py-3">{{ $t->return_date?->format('d/m/Y') ?? '-' }}</td>
                    <td class="px-4 py-3">
                        @if($t->status == 'borrowed')<span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">Dipinjam</span>
                        @elseif($t->status == 'returned')<span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Dikembalikan</span>
                        @elseif($t->status == 'lost')<span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Hilang</span>
                        @else<span class="bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">Rusak</span>@endif
                    </td>
                    <td class="px-4 py-3">Rp {{ number_format($t->fines->where('status','unpaid')->sum('amount'), 0, ',', '.') }}</td>
                </tr>
                @empty<tr><td colspan="7" class="px-4 py-6 text-center text-gray-500">Belum ada transaksi</td></tr>@endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
