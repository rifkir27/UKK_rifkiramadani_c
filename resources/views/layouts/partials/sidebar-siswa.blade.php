<a href="/siswa/dashboard" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('siswa/dashboard') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-tachometer-alt w-6"></i>Dashboard
</a>
<a href="/siswa/books" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('siswa/books*') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-book w-6"></i>Katalog Buku
</a>
<a href="/siswa/transactions" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('siswa/transactions*') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-history w-6"></i>Riwayat Pinjam
</a>
<a href="/siswa/fines" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('siswa/fines*') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-money-bill-wave w-6"></i>Denda
</a>

