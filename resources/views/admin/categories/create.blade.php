@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Tambah Kategori</h1>
    <p class="text-gray-600">Tambah kategori buku baru</p>
</div>

<div class="bg-white rounded-xl shadow p-6 max-w-lg">
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nama Kategori</label>
            <input type="text" name="name" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none"></textarea>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Simpan</button>
            <a href="{{ route('admin.categories.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">Batal</a>
        </div>
    </form>
</div>
@endsection
