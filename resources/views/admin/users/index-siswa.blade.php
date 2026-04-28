@extends('layouts.app')

@section('title', 'Kelola Siswa')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-800">Kelola Siswa</h1>
        <p class="text-gray-600">Daftar siswa perpustakaan</p>
    </div>
    <a href="{{ route('admin.users.create-siswa') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
        <i class="fas fa-plus mr-2"></i>Tambah Siswa
    </a>
</div>

<div class="bg-white rounded-xl shadow p-6">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead><tr class="bg-gray-50"><th class="px-4 py-3">Nama</th><th class="px-4 py-3">Email</th><th class="px-4 py-3">NIS</th><th class="px-4 py-3">Rayon</th><th class="px-4 py-3">Rombel</th><th class="px-4 py-3">Telepon</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Aksi</th></tr></thead>
            <tbody>
                @forelse($users as $user)
                <tr class="border-t">
                    <td class="px-4 py-3 font-medium">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    <td class="px-4 py-3 font-mono text-sm">{{ $user->student->nis ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $user->student->rayon->name ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $user->student->rombel->name ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $user->phone ?? '-' }}</td>
                    <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">{{ $user->status }}</span></td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.users.edit', $user) }}" class="text-blue-600 hover:underline mr-3"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty<tr><td colspan="8" class="px-4 py-6 text-center text-gray-500">Belum ada siswa</td></tr>@endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

