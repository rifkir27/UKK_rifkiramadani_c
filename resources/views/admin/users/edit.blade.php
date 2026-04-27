@extends('layouts.app')

@section('title', 'Edit Pengguna')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Edit Pengguna</h1>
    <p class="text-gray-600">Ubah data pengguna</p>
</div>

<div class="bg-white rounded-xl shadow p-6 max-w-lg">
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nama</label>
            <input type="text" name="name" value="{{ $user->name }}" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Email</label>
            <input type="email" name="email" value="{{ $user->email }}" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Password Baru (kosongkan jika tidak diubah)</label>
            <input type="password" name="password" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Role</label>
            <select name="role" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Telepon</label>
            <input type="text" name="phone" value="{{ $user->phone }}" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Update</button>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">Batal</a>
        </div>
    </form>
</div>
@endsection
