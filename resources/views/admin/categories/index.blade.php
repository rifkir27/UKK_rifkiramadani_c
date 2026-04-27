@extends('layouts.app')

@section('title', 'Kelola Kategori')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Kelola Kategori</h1>
        <p class="text-gray-600">Daftar kategori buku perpustakaan</p>
    </div>
    <a href="{{ route('admin.categories.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
        <i class="fas fa-plus mr-2"></i>Tambah Kategori
    </a>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead><tr class="bg-gray-50"><th class="px-4 py-3">No</th><th class="px-4 py-3">Nama</th><th class="px-4 py-3">Slug</th><th class="px-4 py-3">Deskripsi</th><th class="px-4 py-3">Aksi</th></tr></thead>
            <tbody>
                @forelse($categories as $i => $cat)
                <tr class="border-t">
                    <td class="px-4 py-3">{{ $i+1 }}</td>
                    <td class="px-4 py-3 font-medium">{{ $cat->name }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $cat->slug }}</td>
                    <td class="px-4 py-3">{{ Str::limit($cat->description, 50) }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.categories.edit', $cat) }}" class="text-blue-600 hover:underline mr-3"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty<tr><td colspan="5" class="px-4 py-6 text-center text-gray-500">Belum ada kategori</td></tr>@endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
