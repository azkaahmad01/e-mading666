<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@emading.com')->first();
        $category = Category::where('slug', 'pengumuman')->first();

        Post::create([
            'title' => 'Selamat Datang di E-Mading Digital Sekolah',
            'slug' => 'selamat-datang-di-e-mading-digital-sekolah',
            'content' => 'Dengan bangga kami memperkenalkan platform E-Mading Digital yang baru untuk sekolah kita. Platform ini dirancang khusus untuk memudahkan penyebaran informasi dan komunikasi antara sekolah, siswa, dan orang tua.

Fitur-fitur unggulan yang tersedia:
- Sistem postingan yang mudah digunakan
- Kategori yang terorganisir dengan baik
- Pencarian yang cepat dan akurat
- Tampilan yang responsif di semua perangkat
- Sistem komentar untuk interaksi

E-Mading Digital ini akan menjadi pusat informasi utama untuk semua kegiatan sekolah, mulai dari pengumuman penting, berita terkini, hingga prestasi siswa-siswi kita.

Mari bersama-sama memanfaatkan teknologi ini untuk menciptakan komunikasi yang lebih efektif dan transparan di lingkungan sekolah kita.',
            'excerpt' => 'Memperkenalkan platform E-Mading Digital yang baru untuk memudahkan penyebaran informasi dan komunikasi di sekolah dengan fitur-fitur modern dan user-friendly.',
            'status' => 'published',
            'published_at' => now(),
            'view_count' => 25,
            'category_id' => $category->id,
            'user_id' => $admin->id,
        ]);
    }
}