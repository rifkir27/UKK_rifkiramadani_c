@extends('layouts.app')

@section('title', 'Register - Perpustakaan Digital')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-900 to-blue-800 px-4 py-8">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-lg">
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-plus text-2xl text-indigo-700"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Akun Siswa</h2>
            <p class="text-gray-500 mt-1">Isi data Anda dengan lengkap</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                    <input type="text" name="name" required value="{{ old('name') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <input type="email" name="email" required value="{{ old('email') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">NIS</label>
                    <input type="text" name="nis" required value="{{ old('nis') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">No. Telepon</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Rayon</label>
                    <select name="rayon_id" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
                        <option value="">Pilih Rayon</option>
                        @foreach($rayons as $rayon)
                            <option value="{{ $rayon->id }}" {{ old('rayon_id') == $rayon->id ? 'selected' : '' }}>{{ $rayon->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Rombel</label>
                    <select name="rombel_id" required class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
                        <option value="">Pilih Rombel</option>
                        @foreach($rombels as $rombel)
                            <option value="{{ $rombel->id }}" {{ old('rombel_id') == $rombel->id ? 'selected' : '' }}>{{ $rombel->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Alamat</label>
                <textarea name="address" rows="2" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-indigo-500 outline-none">{{ old('address') }}</textarea>
            </div>

            <button type="submit"
                class="w-full bg-indigo-700 text-white font-bold py-3 rounded-lg hover:bg-indigo-800 transition duration-200">
                Daftar
            </button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-gray-600 text-sm">Sudah punya akun?
                <a href="{{ route('login') }}" class="text-indigo-700 font-semibold hover:underline">Login di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection

