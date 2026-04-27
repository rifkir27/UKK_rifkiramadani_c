@extends('layouts.app')

@section('title', 'Denda Saya')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Denda Saya</h1>
    <p class="text-gray-600">Daftar denda yang harus dibayar</p>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead><tr class="bg-gray-50"><th class="px-4 py-3">Jenis</th><th class="px-4 py-3">Jumlah</th><th class="px-4 py-3">Deskripsi</th><th class="px-4 py-3">Status</th></tr></thead>
            <tbody>
                @forelse($fines as $fine)
                <tr class="border-t">
                    <td class="px-4 py-3 capitalize">{{ $fine->type }}</td>
                    <td class="px-4 py-3">Rp {{ number_format($fine->amount, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">{{ $fine->description }}</td>
                    <td class="px-4 py-3">
                        @if($fine->status == 'paid')<span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Lunas</span>
                        @else<span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Belum Lunas</span>@endif
                    </td>
                </tr>
                @empty<tr><td colspan="4" class="px-4 py-6 text-center text-gray-500">Tidak ada denda</td></tr>@endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
