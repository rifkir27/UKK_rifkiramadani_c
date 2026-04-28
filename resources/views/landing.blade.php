<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan Sekolah — SMK Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white text-slate-800">

    <!-- Navbar -->
    <nav class="fixed w-full bg-white/95 backdrop-blur border-b border-slate-200 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-blue-700 rounded-lg flex items-center justify-center">
                        <i class="fas fa-school text-white text-sm"></i>
                    </div>
                    <span class="font-bold text-slate-900">Perpustakaan SMK</span>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="text-slate-600 hover:text-blue-700 font-medium text-sm px-4 py-2">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-5 py-2 rounded-lg font-medium text-sm transition">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="pt-28 pb-16 lg:pt-36 lg:pb-24">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-10 items-center">
                <div class="text-center lg:text-left">
                    <h1 class="text-4xl lg:text-5xl font-extrabold text-slate-900 leading-tight mb-5">
                        Perpustakaan Digital<br>
                        <span class="text-blue-700">Untuk Sekolah</span>
                    </h1>
                    <p class="text-slate-600 mb-8 max-w-md mx-auto lg:mx-0">
                        Kelola peminjaman buku, data siswa, rombel, dan rayon secara modern. 
                        Cocok untuk SMK dan sekolah menengah.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-lg font-semibold text-sm transition">
                            Mulai Sekarang
                        </a>
                        <a href="#fitur" class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-6 py-3 rounded-lg font-semibold text-sm transition">
                            Lihat Fitur
                        </a>
                    </div>
                </div>
                <div class="flex justify-center">
                    <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 w-full max-w-sm">
                        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="fas fa-id-card text-blue-700"></i>
                            </div>
                            <div>
                                <div class="font-bold text-slate-900 text-sm">Kartu Anggota</div>
                                <div class="text-xs text-slate-500">Perpustakaan SMK</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 mb-5">
                            <div class="w-14 h-14 bg-slate-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user text-slate-400 text-xl"></i>
                            </div>
                            <div>
                                <div class="font-bold text-slate-900">Ahmad Rizky</div>
                                <div class="text-xs text-slate-500 mt-0.5">NIS: 21001 &middot; XII-RPL-1</div>
                                <div class="text-xs text-slate-500">Cicurug-1</div>
                            </div>
                        </div>
                        <div class="bg-slate-900 rounded-lg p-3 text-center">
                            <div class="text-[10px] text-slate-400 mb-1">SISWA-00021</div>
                            <div class="h-6 bg-white rounded flex items-center justify-center">
                                <svg class="w-40 h-4" viewBox="0 0 160 16" fill="none">
                                    <rect x="0" y="0" width="2" height="16" fill="#1e293b"/>
                                    <rect x="4" y="0" width="1" height="16" fill="#cbd5e1"/>
                                    <rect x="8" y="0" width="3" height="16" fill="#1e293b"/>
                                    <rect x="14" y="0" width="1" height="16" fill="#94a3b8"/>
                                    <rect x="18" y="0" width="4" height="16" fill="#1e293b"/>
                                    <rect x="26" y="0" width="1" height="16" fill="#cbd5e1"/>
                                    <rect x="30" y="0" width="2" height="16" fill="#1e293b"/>
                                    <rect x="36" y="0" width="2" height="16" fill="#64748b"/>
                                    <rect x="42" y="0" width="1" height="16" fill="#cbd5e1"/>
                                    <rect x="46" y="0" width="3" height="16" fill="#1e293b"/>
                                    <rect x="52" y="0" width="1" height="16" fill="#94a3b8"/>
                                    <rect x="56" y="0" width="4" height="16" fill="#1e293b"/>
                                    <rect x="64" y="0" width="1" height="16" fill="#cbd5e1"/>
                                    <rect x="68" y="0" width="2" height="16" fill="#1e293b"/>
                                    <rect x="74" y="0" width="1" height="16" fill="#94a3b8"/>
                                    <rect x="78" y="0" width="3" height="16" fill="#1e293b"/>
                                    <rect x="84" y="0" width="1" height="16" fill="#cbd5e1"/>
                                    <rect x="88" y="0" width="2" height="16" fill="#64748b"/>
                                    <rect x="94" y="0" width="1" height="16" fill="#1e293b"/>
                                    <rect x="98" y="0" width="3" height="16" fill="#94a3b8"/>
                                    <rect x="104" y="0" width="2" height="16" fill="#1e293b"/>
                                    <rect x="110" y="0" width="1" height="16" fill="#cbd5e1"/>
                                    <rect x="114" y="0" width="4" height="16" fill="#1e293b"/>
                                    <rect x="122" y="0" width="1" height="16" fill="#94a3b8"/>
                                    <rect x="126" y="0" width="2" height="16" fill="#1e293b"/>
                                    <rect x="132" y="0" width="2" height="16" fill="#64748b"/>
                                    <rect x="138" y="0" width="1" height="16" fill="#1e293b"/>
                                    <rect x="142" y="0" width="3" height="16" fill="#cbd5e1"/>
                                    <rect x="148" y="0" width="2" height="16" fill="#1e293b"/>
                                    <rect x="154" y="0" width="2" height="16" fill="#94a3b8"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

   

    <!-- Features -->
    <section id="fitur" class="py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-slate-900">Fitur Perpustakaan Sekolah</h2>
                <p class="text-slate-500 mt-2 text-sm">Dirancang sesuai struktur organisasi SMK</p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                <div class="p-5 rounded-xl border border-slate-100 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center mb-3">
                        <i class="fas fa-book text-blue-700 text-sm"></i>
                    </div>
                    <h3 class="font-semibold text-slate-900 text-sm mb-1">Kelola Buku</h3>
                    <p class="text-slate-500 text-sm">Katalog lengkap dengan kategori dan stok real-time.</p>
                </div>
                <div class="p-5 rounded-xl border border-slate-100 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center mb-3">
                        <i class="fas fa-exchange-alt text-blue-700 text-sm"></i>
                    </div>
                    <h3 class="font-semibold text-slate-900 text-sm mb-1">Peminjaman & Pengembalian</h3>
                    <p class="text-slate-500 text-sm">Transaksi cepat dengan pencatatan otomatis.</p>
                </div>
                <div class="p-5 rounded-xl border border-slate-100 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center mb-3">
                        <i class="fas fa-barcode text-blue-700 text-sm"></i>
                    </div>
                    <h3 class="font-semibold text-slate-900 text-sm mb-1">Barcode Siswa</h3>
                    <p class="text-slate-500 text-sm">Kartu anggota dengan barcode unik per siswa.</p>
                </div>
                <div class="p-5 rounded-xl border border-slate-100 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center mb-3">
                        <i class="fas fa-users text-blue-700 text-sm"></i>
                    </div>
                    <h3 class="font-semibold text-slate-900 text-sm mb-1">Rombel & Rayon</h3>
                    <p class="text-slate-500 text-sm">Pengelompokan siswa sesuai struktur sekolah.</p>
                </div>
                <div class="p-5 rounded-xl border border-slate-100 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center mb-3">
                        <i class="fas fa-file-invoice-dollar text-blue-700 text-sm"></i>
                    </div>
                    <h3 class="font-semibold text-slate-900 text-sm mb-1">Denda Otomatis</h3>
                    <p class="text-slate-500 text-sm">Perhitungan denda keterlambatan otomatis.</p>
                </div>
                <div class="p-5 rounded-xl border border-slate-100 hover:shadow-md transition">
                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center mb-3">
                        <i class="fas fa-user-shield text-blue-700 text-sm"></i>
                    </div>
                    <h3 class="font-semibold text-slate-900 text-sm mb-1">Multi Hak Akses</h3>
                    <p class="text-slate-500 text-sm">Admin, Petugas, dan Siswa dengan hak terpisah.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Roles -->
    <section class="py-16 bg-slate-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-slate-900">Pengguna Sistem</h2>
                <p class="text-slate-500 mt-2 text-sm">Tiga peran utama dalam ekosistem perpustakaan</p>
            </div>
            <div class="grid md:grid-cols-3 gap-5">
                <div class="bg-white rounded-xl p-6 border border-slate-100 text-center">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-user-cog text-blue-700"></i>
                    </div>
                    <h3 class="font-semibold text-slate-900 text-sm">Administrator</h3>
                    <p class="text-slate-500 text-sm mt-1">Mengelola data master, pengguna, dan laporan.</p>
                </div>
                <div class="bg-white rounded-xl p-6 border border-slate-100 text-center">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-user-tie text-blue-700"></i>
                    </div>
                    <h3 class="font-semibold text-slate-900 text-sm">Petugas</h3>
                    <p class="text-slate-500 text-sm mt-1">Memproses peminjaman, pengembalian, dan denda.</p>
                </div>
                <div class="bg-white rounded-xl p-6 border border-slate-100 text-center">
                    <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-user-graduate text-blue-700"></i>
                    </div>
                    <h3 class="font-semibold text-slate-900 text-sm">Siswa</h3>
                    <p class="text-slate-500 text-sm mt-1">Melihat buku, riwayat, dan kartu barcode.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="py-16">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-bold text-slate-900 mb-3">Siap Mengelola Perpustakaan?</h2>
            <p class="text-slate-500 text-sm mb-6">Daftar sekarang dan gunakan sistem perpustakaan digital untuk sekolah Anda.</p>
            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                <a href="{{ route('register') }}" class="bg-blue-700 hover:bg-blue-800 text-white px-6 py-2.5 rounded-lg font-semibold text-sm transition">
                    Daftar Gratis
                </a>
                <a href="{{ route('login') }}" class="bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 px-6 py-2.5 rounded-lg font-semibold text-sm transition">
                    Masuk
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-blue-700 rounded-md flex items-center justify-center">
                        <i class="fas fa-school text-white text-xs"></i>
                    </div>
                    <span class="font-semibold text-white text-sm">Perpustakaan SMK</span>
                </div>
                <div class="text-xs">
                    &copy; {{ date('Y') }} SMK Digital. Hak Cipta Dilindungi.
                </div>
            </div>
        </div>
    </footer>

</body>
</html>

