@extends('layouts.app')

@section('title', 'Login - Perpustakaan Digital')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-900 to-blue-800 px-4">
    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-book-reader text-2xl text-indigo-700"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Perpustakaan Digital</h2>
            <p class="text-gray-500 mt-1">Silakan login ke akun Anda</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <input type="email" name="email" id="email" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                    placeholder="email@example.com" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="password">Password</label>
                <input type="password" name="password" id="password" required
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 outline-none transition"
                    placeholder="********">
            </div>

            <button type="submit"
                class="w-full bg-indigo-700 text-white font-bold py-3 rounded-lg hover:bg-indigo-800 transition duration-200">
                Login
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-600 text-sm">Belum punya akun siswa?
                <a href="{{ route('register') }}" class="text-indigo-700 font-semibold hover:underline">Daftar di sini</a>
            </p>
        </div>
    </div>
</div>
@endsection

