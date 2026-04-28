# TODO - Pemisahan Tambah Petugas & Siswa

- [x] 1. Update `resources/views/admin/users/index.blade.php` — ganti tombol jadi 2: Tambah Petugas & Tambah Siswa
- [x] 2. Create `resources/views/admin/users/create-petugas.blade.php`
- [x] 3. Create `resources/views/admin/users/create-siswa.blade.php`
- [x] 4. Update `app/Http/Controllers/Admin/UserController.php` — tambah method createPetugas, createSiswa, storePetugas, storeSiswa
- [x] 5. Update `routes/web.php` — tambah route untuk petugas dan siswa
- [x] 6. Create `resources/views/admin/users/index-petugas.blade.php` — halaman daftar petugas terpisah
- [x] 7. Create `resources/views/admin/users/index-siswa.blade.php` — halaman daftar siswa terpisah
- [x] 8. Update `app/Http/Controllers/Admin/UserController.php` — tambah indexPetugas & indexSiswa
- [x] 9. Update `routes/web.php` — tambah route index petugas & siswa
- [x] 10. Update `resources/views/layouts/partials/sidebar-admin.blade.php` — menu terpisah
- [x] 11. Update `app/Http/Controllers/Admin/UserController.php` — notifikasi update siswa/petugas dengan nama

