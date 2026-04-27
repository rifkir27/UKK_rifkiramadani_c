@extends('layouts.app')

@section('title', 'Detail Transaksi')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Detail Transaksi</h1>
    <p class="text-gray-600">{{ $transaction->transaction_code }}</p>
</div>

<div class="bg-white rounded-xl shadow p-6 max-w-2xl">
    <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
        <div><span class="text-gray-500">Siswa:</span> <span class="font-medium">{{ $transaction->student->name ?? '-' }}</span></div>
        <div><span class="text-gray-500">Tanggal Pinjam:</span> <span class="font-medium">{{ $transaction->borrow_date?->format('d/m/Y') }}</span></div>
        <div><span class="text-gray-500">Jatuh Tempo:</span> <span class="font-medium">{{ $transaction->due_date?->format('d/m/Y') }}</span></div>
        <div><span class="text-gray-500">Tanggal Kembali:</span> <span class="font-medium">{{ $transaction->return_date?->format('d/m/Y') ?? '-' }}</span></div>
        <div><span class="text-gray-500">Status:</span> <span class="font-medium capitalize">{{ $transaction->status }}</span></div>
    </div>
    <h3 class="font-bold mt-6 mb-3">Buku yang Dipinjam</h3>
    <ul class="space-y-2">
        @foreach($transaction->details as $d)
        <li class="border rounded-lg p-3">
            <p class="font-medium">{{ $d->book->title }}</p>
            <p class="text-sm text-gray-500">Kondisi Pinjam: {{ $d->condition_borrow }} | Kondisi Kembali: {{ $d->condition_return ?? '-' }}</p>
        </li>
        @endforeach
    </ul>
    @if($transaction->fines->count() > 0)
    <h3 class="font-bold mt-6 mb-3">Denda</h3>
    <ul class="space-y-2">
        @foreach($transaction->fines as $fine)
        <li class="border rounded-lg p-3 flex justify-between">
            <div>
                <p class="font-medium capitalize">{{ $fine->type }} - {{ $fine->description }}</p>
            </div>
            <span class="font-bold text-red-600">Rp {{ number_format($fine->amount, 0, ',', '.') }}</span>
        </li>
        @endforeach
    </ul>
    @endif
    <div class="mt-6">
        <a href="{{ route('petugas.transactions.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Kembali</a>
    </div>
</div>
@endsection
