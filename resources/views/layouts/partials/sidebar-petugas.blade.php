<a href="/petugas/dashboard" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('petugas/dashboard') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-tachometer-alt w-6"></i>Dashboard
</a>
<a href="/petugas/transactions/borrow" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('petugas/transactions/borrow*') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-hand-holding w-6"></i>Peminjaman
</a>
<a href="/petugas/transactions/return" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('petugas/transactions/return*') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-undo w-6"></i>Pengembalian
</a>
<a href="/petugas/fines" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('petugas/fines*') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-money-bill-wave w-6"></i>Denda
</a>
<a href="/petugas/transactions" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('petugas/transactions') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-history w-6"></i>Riwayat
</a>