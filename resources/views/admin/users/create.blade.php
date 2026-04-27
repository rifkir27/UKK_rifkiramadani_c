@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Tambah Pengguna</h1>
    <p class="text-gray-600">Tambah petugas atau siswa baru</p>
</div>

<div class="bg-white rounded-xl shadow p-6 max-w-lg">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Nama</label>
            <input type="text" name="name" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Email</label>
            <input type="email" name="email" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Password</label>
            <input type="password" name="password" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Role</label>
            <select name="role" id="role" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none" onchange="toggleStudentFields()">
                <option value="petugas">Petugas</option>
                <option value="siswa">Siswa</option>
            </select>
        </div>

        {{-- Student fields --}}
        <div id="student-fields" class="hidden">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">NIS</label>
                <input type="text" name="nis" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Rayon</label>
                <select name="rayon_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
                    <option value="">Pilih Rayon</option>
                    @foreach($rayons as $rayon)
                        <option value="{{ $rayon->id }}">{{ $rayon->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Rombel</label>
                <select name="rombel_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
                    <option value="">Pilih Rombel</option>
                    @foreach($rombels as $rombel)
                        <option value="{{ $rombel->id }}">{{ $rombel->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Alamat</label>
                <textarea name="address" rows="3" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none"></textarea>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Telepon</label>
            <input type="text" name="phone" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
        </div>
        <div class="flex gap-3">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700">Simpan</button>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400">Batal</a>
        </div>
    </form>
</div>

<script>
    function toggleStudentFields() {
        const role = document.getElementById('role').value;
        const studentFields = document.getElementById('student-fields');
        if (role === 'siswa') {
            studentFields.classList.remove('hidden');
        } else {
            studentFields.classList.add('hidden');
        }
    }
</script>
@endsection

