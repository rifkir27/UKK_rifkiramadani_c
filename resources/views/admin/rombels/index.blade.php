@extends('layouts.app')

@section('title', 'Kelola Rombel')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Kelola Rombel</h1>
    <p class="text-gray-600">Daftar rombel siswa</p>
</div>

<div class="bg-white rounded-xl shadow p-6 mb-6 max-w-lg">
    <form action="{{ route('admin.rombels.store') }}" method="POST">
        @csrf
        <div class="flex gap-3 mb-3">
            <input type="text" name="name" placeholder="Nama Rombel" required class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        </div>
        <div class="flex gap-3">
            <select name="rayon_id" required class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
                <option value="">Pilih Rayon</option>
                @foreach($rayons as $r)
                    <option value="{{ $r->id }}">{{ $r->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Tambah</button>
        </div>
    </form>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead><tr class="bg-gray-50"><th class="px-4 py-3">No</th><th class="px-4 py-3">Nama</th><th class="px-4 py-3">Rayon</th><th class="px-4 py-3">Aksi</th></tr></thead>
            <tbody>
                @forelse($rombels as $i => $r)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $i+1 }}</td>
                    <td class="px-4 py-3 font-medium">{{ $r->name }}</td>
                    <td class="px-4 py-3">{{ $r->rayon->name ?? '-' }}</td>
                    <td class="px-4 py-3">
                        <form action="{{ route('admin.rombels.destroy', $r) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty<tr><td colspan="4" class="px-4 py-6 text-center text-gray-500">Belum ada rombel</td></tr>@endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
