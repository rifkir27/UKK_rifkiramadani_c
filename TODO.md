# Hapus Fitur Scan & Barcode, Gunakan NIS Saja

- [ ] Officer/TransactionController.php: Ubah validasi dan query pencarian siswa dari barcode ke NIS
- [ ] resources/views/officer/transactions/borrow.blade.php: Ubah label, placeholder, dan name input ke NIS
- [ ] resources/views/officer/dashboard/index.blade.php: Ubah teks deskripsi peminjaman
- [ ] Admin/UserController.php: Hapus pembuatan barcode saat create siswa
- [ ] Auth/RegisterController.php: Hapus pembuatan barcode saat register siswa
- [ ] database/seeders/DatabaseSeeder.php: Hapus barcode dari seeder siswa
- [ ] app/Models/Student.php: Hapus barcode dari $fillable

