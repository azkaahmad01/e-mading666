<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Create users
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@emading.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Pembina OSIS',
            'email' => 'pembina@emading.com',
            'password' => Hash::make('pembina123'),
            'role' => 'pembina',
        ]);

        User::create([
            'name' => 'Siswa Contoh',
            'email' => 'siswa@emading.com',
            'password' => Hash::make('siswa123'),
            'role' => 'siswa',
        ]);

        // Create default categories
        $categories = [
            ['name' => 'Prestasi', 'slug' => 'prestasi', 'color' => '#EF4444', 'description' => 'Prestasi siswa dan sekolah'],
            ['name' => 'Hari Nasional', 'slug' => 'hari-nasional', 'color' => '#10B981', 'description' => 'Peringatan hari nasional'],
            ['name' => 'Informasi Kegiatan', 'slug' => 'informasi-kegiatan', 'color' => '#F59E0B', 'description' => 'Informasi kegiatan sekolah'],
            ['name' => 'Informasi Sekolah', 'slug' => 'informasi-sekolah', 'color' => '#8B5CF6', 'description' => 'Informasi umum sekolah'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}