<a href="/admin/dashboard" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('admin/dashboard') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-tachometer-alt w-6"></i>Dashboard
</a>
<a href="/admin/categories" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('admin/categories*') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-tags w-6"></i>Kategori
</a>
<a href="/admin/books" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('admin/books*') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-book w-6"></i>Buku
</a>
<a href="/admin/rayons" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('admin/rayons*') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-map-marker-alt w-6"></i>Rayon
</a>
<a href="/admin/rombels" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('admin/rombels*') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-users-class w-6"></i>Rombel
</a>
<a href="/admin/users" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('admin/users*') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-user-cog w-6"></i>Pengguna
</a>
<a href="/admin/transactions" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('admin/transactions*') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-exchange-alt w-6"></i>Transaksi
</a>
<a href="/admin/reports" class="block px-6 py-3 hover:bg-indigo-800 {{ request()->is('admin/reports*') ? 'bg-indigo-800' : '' }}">
    <i class="fas fa-file-alt w-6"></i>Laporan
</a>

