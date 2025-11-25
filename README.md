# E-Mading Digital

Website E-Mading Digital dengan sistem yang modern dan user-friendly untuk sekolah, menggunakan tema gradasi biru dan putih yang elegan.

## Fitur Utama

### Frontend Features
- **Homepage Modern**: Desain elegan dengan gradasi biru-putih
- **Sistem Postingan**: CRUD lengkap untuk postingan dengan kategori
- **Filter & Pencarian**: Filter berdasarkan kategori dan pencarian global
- **Responsive Design**: Tampilan yang optimal di semua perangkat
- **Sistem Komentar**: Komentar pada setiap postingan
- **Social Sharing**: Tombol share ke media sosial
- **View Counter**: Menghitung jumlah pembaca setiap postingan

### Admin Features
- **Dashboard Admin**: Statistik lengkap dan aksi cepat
- **Manajemen Postingan**: CRUD lengkap dengan editor WYSIWYG
- **Manajemen Kategori**: Kelola kategori dengan warna custom
- **Manajemen Komentar**: Moderasi komentar (approve/reject)
- **Upload Gambar**: Upload featured image untuk postingan
- **Role Management**: Sistem admin dan user biasa

### Teknologi yang Digunakan
- **Backend**: Laravel 10.x
- **Database**: MySQL 8.0+
- **Frontend**: Bootstrap 5, jQuery
- **Icons**: Font Awesome 6
- **Styling**: Custom CSS dengan gradasi biru-putih

## Persyaratan Sistem

- PHP 8.1 atau lebih tinggi
- MySQL 8.0 atau lebih tinggi
- Composer
- Node.js & NPM (untuk development)
- Web Server (Apache/Nginx)

## Instalasi

### 1. Clone Repository
```bash
git clone [url-repository]
cd emading
```

### 2. Install Dependencies
```bash
composer install
npm install
```

### 3. Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database
Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=e_mading
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Setup Database
```bash
# Buat database terlebih dahulu di MySQL
mysql -u root -p
CREATE DATABASE e_mading CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;

# Import database schema
mysql -u root -p e_mading < database_schema.sql
```

### 6. Setup Storage
```bash
php artisan storage:link
```

### 7. Build Assets (Development)
```bash
npm run dev
```

Untuk production:
```bash
npm run build
```

### 8. Jalankan Aplikasi
```bash
php artisan serve
```

Akses aplikasi di: `http://localhost:8000`

## Login Default

**Admin Account:**
- Email: `admin@emading.com`
- Password: `password`

## Struktur Database

### Tabel Utama
- **users**: Data pengguna (admin dan user biasa)
- **categories**: Kategori postingan dengan warna custom
- **posts**: Postingan dengan status (draft/published)
- **tags**: Tag untuk postingan
- **post_tag**: Relasi many-to-many posts dan tags
- **comments**: Komentar pada postingan
- **settings**: Pengaturan website

## Penggunaan

### Frontend
1. **Beranda**: Menampilkan postingan terbaru dan populer
2. **Semua Postingan**: Daftar lengkap postingan dengan filter
3. **Detail Postingan**: Baca postingan lengkap dengan komentar
4. **Kategori**: Filter postingan berdasarkan kategori

### Admin Panel
1. **Dashboard**: Lihat statistik dan aksi cepat
2. **Postingan**: Kelola semua postingan (buat, edit, hapus)
3. **Kategori**: Kelola kategori postingan
4. **Komentar**: Moderasi komentar dari pengguna

## Customization

### Warna Tema
Edit file `resources/views/layouts/app.blade.php` untuk mengubah warna gradasi:
```css
:root {
    --primary-blue: #3B82F6;    /* Ubah warna utama */
    --secondary-blue: #1E40AF;  /* Ubah warna sekunder */
    --accent-blue: #60A5FA;     /* Ubah warna aksen */
}
```

### Logo dan Branding
- Upload logo di direktori `public/images/`
- Update referensi logo di file layout

## Keamanan

- Middleware admin untuk proteksi area admin
- CSRF protection pada semua form
- SQL injection prevention dengan Eloquent ORM
- XSS protection dengan Blade templating

## Troubleshooting

### Common Issues

1. **Permission Error**
   ```bash
   sudo chmod -R 755 storage/
   sudo chmod -R 755 bootstrap/cache/
   ```

2. **Database Connection Error**
   - Pastikan MySQL berjalan
   - Cek konfigurasi `.env`
   - Pastikan user memiliki akses ke database

3. **Storage Link Error**
   ```bash
   php artisan storage:link --force
   ```

## Kontribusi

1. Fork repository
2. Buat branch fitur baru
3. Commit perubahan
4. Push ke branch
5. Buat Pull Request

## Lisensi

This project is open-sourced software licensed under the MIT license.

## Support

Untuk pertanyaan atau masalah, silakan buat issue di repository atau hubungi tim pengembang.

---

**Dibuat dengan ❤️ untuk pendidikan**