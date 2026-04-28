# TODO: Notifikasi Overdue & Buku Sama Sudah Dipinjam

## Plan
- [x] 1. Update `BookController::show()` - Query cek buku sudah dipinjam & overdue
- [x] 2. Update `BookController::borrow()` - Validasi cek buku sudah dipinjam & overdue
- [x] 3. Update `resources/views/student/books/show.blade.php` - Tampilkan notifikasi
- [x] 4. Update `resources/views/student/books/index.blade.php` - Tampilkan notifikasi overdue global

## Dependent Files
- `app/Http/Controllers/Student/BookController.php`
- `resources/views/student/books/show.blade.php`
- `resources/views/student/books/index.blade.php`

## Followup
- Testing dengan login siswa


