<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Rayon;
use App\Models\Rombel;
use App\Models\Category;
use App\Models\Book;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@perpus.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '081234567890',
            'status' => 'active',
        ]);

        // Petugas
        User::create([
            'name' => 'Petugas Perpustakaan',
            'email' => 'petugas@perpus.com',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
            'phone' => '082345678901',
            'status' => 'active',
        ]);

        // Rayon
        $rayons = ['Cibedug 1', 'Cibedug 2', 'Cicurug 1', 'Cicurug 2', 'Cisarua', 'Sukasari', 'Tajur'];
        foreach ($rayons as $r) {
            Rayon::create(['name' => $r]);
        }

        // Rombel
        $rombels = ['X PPLG ', 'XI PPLG 2', 'XII PPLG', 'X TKJ 1', 'XI TKJ 2', 'XII TKJ '];
        foreach ($rombels as $index => $r) {
            Rombel::create(['name' => $r, 'rayon_id' => ($index % 7) + 1]);
        }

        // Kategori
        $categories = [
            'Fiksi' => 'Buku cerita fiksi',
            'Non-Fiksi' => 'Buku non fiksi',
            'Teknologi' => 'Buku tentang teknologi',
            'Sejarah' => 'Buku sejarah',
            'Matematika' => 'Buku matematika',
            'Sains' => 'Buku sains',
            'Bahasa' => 'Buku bahasa',
            'Agama' => 'Buku agama',
        ];
        foreach ($categories as $name => $desc) {
            Category::create(['name' => $name, 'slug' => \Illuminate\Support\Str::slug($name), 'description' => $desc]);
        }

        // Buku
        $books = [
            ['Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 10, 75000, 1],
            ['5 CM', 'Donny Dhirgantoro', 'Grasindo', 2005, 8, 65000, 1],
            ['Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia', 2009, 12, 85000, 1],
            ['Dilan 1990', 'Pidi Baiq', 'Mizan', 2014, 15, 55000, 1],
            ['Clean Code', 'Robert C. Martin', 'Prentice Hall', 2008, 5, 120000, 3],
            ['The Pragmatic Programmer', 'Andrew Hunt', 'Addison-Wesley', 1999, 4, 150000, 3],
            ['Sejarah Indonesia', 'Sartono Kartodirdjo', 'Gramedia', 2010, 7, 90000, 4],
            ['Kalkulus', 'Purcell', 'Erlangga', 2012, 6, 110000, 5],
            ['Fisika Dasar', 'Halliday', 'Erlangga', 2011, 8, 130000, 6],
            ['Bahasa Indonesia', 'Gorys Keraf', 'Gramedia', 2013, 10, 60000, 7],
            ['Al-Quran dan Terjemah', 'Kemenag', 'Kemenag', 2020, 20, 100000, 8],
            ['Atomic Habits', 'James Clear', 'Gramedia', 2018, 7, 95000, 2],
        ];
        foreach ($books as $index => $b) {
            Book::create([
                'category_id' => $b[6],
                'code' => 'BUKU-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT),
                'title' => $b[0],
                'author' => $b[1],
                'publisher' => $b[2],
                'year' => $b[3],
                'stock' => $b[4],
                'price' => $b[5],
                'description' => 'Buku ' . $b[0] . ' karya ' . $b[1],
                'status' => 'available',
            ]);
        }

        // Siswa demo
        $studentUser = User::create([
            'name' => 'Nor Rifki Ramadani',
            'email' => 'Rifki@siswa.com',
            'password' => Hash::make('Rifki123'),
            'role' => 'siswa',
            'phone' => '083456789012',
            'status' => 'active',
        ]);
        Student::create([
            'user_id' => $studentUser->id,
            'nis' => '1234567890',
            'rayon_id' => 1,
            'rombel_id' => 1,
            'address' => 'Jl. Mawar No. 1, Bogor',
            'barcode' => 'SISWA-00001',
        ]);

        $this->command->info('Seeder berhasil dijalankan!');
        $this->command->info('Login Admin: admin@perpus.com / admin123');
        $this->command->info('Login Petugas: petugas@perpus.com / petugas123');
        $this->command->info('Login Siswa: budi@siswa.com / siswa123');
    }
}
