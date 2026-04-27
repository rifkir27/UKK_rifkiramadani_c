@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Tambah Buku</h1>
    <p class="text-gray-600">Tambah buku baru ke perpustakaan</p>
</div>

<div class="bg-white rounded-xl shadow p-6 max-w-2xl">
    <form action="{{ route('admin.books.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Judul</label>
                <input type="text" name="title" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Penulis</label>
                <input type="text" name="author" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Penerbit</label>
                <input type="text" name="publisher" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tahun</label>
                <input type="number" name="year" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Stok</label>
                <input type="number" name="stock" required min="0" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Harga (Rp)</label>
                <input type="number" name="price" min="0" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
            </div>
            <div class="mb-4 md:col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                <select name="category_id" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4 md:col-span-2">
                <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                <textarea name="description" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none"></textarea>
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Simpan</button>
            <a href="{{ route('admin.books.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">Batal</a>
        </div>
    </form>
</div>
@endsection
