@extends('layouts.app')

@section('title', 'Proses Pengembalian')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Proses Pengembalian</h1>
    <p class="text-gray-600">Pilih transaksi dan update kondisi buku</p>
</div>

<div class="bg-white rounded-xl shadow p-6">
    @forelse($transactions as $transaction)
    <div class="border rounded-xl p-4 mb-4">
        <div class="flex justify-between items-start mb-3">
            <div>
                <p class="font-bold text-lg">{{ $transaction->transaction_code }}</p>
                <p class="text-gray-600">{{ $transaction->student->name }} | Jatuh tempo: <span class="{{ \Carbon\Carbon::parse($transaction->due_date)->isPast() ? 'text-red-600 font-bold' : '' }}">{{ $transaction->due_date->format('d/m/Y') }}</span></p>
            </div>
            <form action="{{ route('petugas.transactions.return.store') }}" method="POST" class="text-right">
                @csrf
                <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                <div class="mb-3">
                    @foreach($transaction->details as $detail)
                    <div class="mb-2 text-left">
                        <p class="text-sm font-medium">{{ $detail->book->title }}</p>
                        <select name="book_conditions[{{ $detail->id }}]" class="px-3 py-1 rounded border text-sm">
                            <option value="good">Baik</option>
                            <option value="damaged">Rusak</option>
                            <option value="lost">Hilang</option>
                        </select>
                    </div>
                    @endforeach
                </div>
                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 text-sm">Konfirmasi Kembali</button>
            </form>
        </div>
    </div>
    @empty
    <p class="text-center text-gray-500 py-8">Tidak ada peminjaman aktif</p>
    @endforelse
</div>
@endsection
