<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Perpustakaan Digital')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased">
    @auth
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-indigo-900 text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 border-b border-indigo-800">
                <h1 class="text-xl font-bold"><i class="fas fa-book-reader mr-2"></i>Perpustakaan</h1>
                <p class="text-xs text-indigo-300 mt-1">Digital Management</p>
            </div>
            <nav class="flex-1 overflow-y-auto py-4">
                @if(auth()->user()->isAdmin())
                    @include('layouts.partials.sidebar-admin')
                @elseif(auth()->user()->isPetugas())
                    @include('layouts.partials.sidebar-petugas')
                @else
                    @include('layouts.partials.sidebar-siswa')
                @endif
            </nav>
            <div class="p-4 border-t border-indigo-800">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-700 flex items-center justify-center">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-indigo-300 capitalize">{{ auth()->user()->role }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="w-full text-left text-sm text-red-300 hover:text-red-200">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- Mobile header -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm md:hidden">
                <div class="px-4 py-3 flex justify-between items-center">
                    <h1 class="font-bold text-indigo-900">Perpustakaan Digital</h1>
                    <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="text-indigo-900">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
                <div id="mobile-menu" class="hidden bg-indigo-900 text-white px-4 pb-4">
                    @if(auth()->user()->isAdmin())
                        @include('layouts.partials.sidebar-admin')
                    @elseif(auth()->user()->isPetugas())
                        @include('layouts.partials.sidebar-petugas')
                    @else
                        @include('layouts.partials.sidebar-siswa')
                    @endif
                </div>
            </header>

            <main class="flex-1 overflow-y-auto p-6">
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
    @else
        <main>
            @yield('content')
        </main>
    @endauth
</body>
</html>

