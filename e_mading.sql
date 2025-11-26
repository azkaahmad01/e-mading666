-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Nov 2025 pada 02.08
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_mading`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#3B82F6',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `color`, `created_at`, `updated_at`) VALUES
(1, 'Prestasi', 'prestasi', 'Prestasi siswa dan sekolah', '#ef4444', '2025-11-11 01:44:03', '2025-11-17 16:36:08'),
(2, 'Hari Nasional', 'hari-nasional', 'Peringatan hari nasional', '#10B981', '2025-11-11 01:44:03', '2025-11-11 01:44:03'),
(3, 'Informasi Kegiatan', 'informasi-kegiatan', 'Informasi kegiatan sekolah', '#F59E0B', '2025-11-11 01:44:03', '2025-11-11 01:44:03'),
(4, 'Informasi Sekolah', 'informasi-sekolah', 'Informasi umum sekolah', '#8B5CF6', '2025-11-11 01:44:03', '2025-11-11 01:44:03'),
(5, 'eskul', 'eskul', 'kategori eskul', '#e719f5', '2025-11-17 16:35:57', '2025-11-17 16:35:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guest_name` varchar(255) DEFAULT NULL,
  `guest_email` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `guest_name`, `guest_email`, `content`, `status`, `created_at`, `updated_at`) VALUES
(2, 10, 8, NULL, NULL, 'bagus banget', 'approved', '2025-11-17 03:08:25', '2025-11-17 03:08:25'),
(3, 10, 7, NULL, NULL, 'mbg enak', 'approved', '2025-11-19 13:33:26', '2025-11-19 13:33:26'),
(4, 10, 7, NULL, NULL, 'good', 'approved', '2025-11-20 06:17:13', '2025-11-20 06:17:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `likes`
--

CREATE TABLE `likes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `guest_id` varchar(255) DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `guest_id`, `post_id`, `created_at`, `updated_at`) VALUES
(12, 8, NULL, 10, '2025-11-18 02:09:04', '2025-11-18 02:09:04'),
(13, 8, NULL, 14, '2025-11-18 02:10:26', '2025-11-18 02:10:26'),
(19, 7, NULL, 10, '2025-11-20 06:17:06', '2025-11-20 06:17:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_01_01_000003_create_categories_table', 1),
(5, '2024_01_01_000004_create_tags_table', 1),
(6, '2024_01_01_000005_create_posts_table', 1),
(7, '2024_01_01_000006_create_post_tag_table', 1),
(8, '2024_01_01_000007_create_comments_table', 1),
(9, '2024_01_01_000008_add_role_to_users_table', 1),
(10, '2024_01_01_000009_update_users_role_enum', 1),
(12, '2024_01_01_000010_fix_user_passwords', 2),
(13, '2025_11_12_111136_create_notifications_table', 3),
(15, '2025_11_17_085748_create_likes_table', 4),
(16, '2025_11_18_003216_add_missing_columns_to_notifications_table', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'info',
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `post_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `type`, `is_read`, `created_at`, `updated_at`, `post_id`) VALUES
(1, 5, 'Artikel Disetujui', 'Artikel Anda \"PPDB\" telah disetujui dan dipublikasikan.', 'success', 0, '2025-11-13 00:59:49', '2025-11-13 00:59:49', NULL),
(2, 5, 'Artikel Disetujui', 'Artikel Anda \"bazar\" telah disetujui dan dipublikasikan.', 'success', 0, '2025-11-13 00:59:54', '2025-11-13 00:59:54', NULL),
(3, 5, 'Artikel Disetujui', 'Artikel Anda \"mempringati hari guru\" telah disetujui dan dipublikasikan.', 'success', 0, '2025-11-13 00:59:58', '2025-11-13 00:59:58', NULL),
(4, 5, 'Artikel Disetujui', 'Artikel Anda \"lomba badmin\" telah disetujui dan dipublikasikan.', 'success', 1, '2025-11-13 01:00:02', '2025-11-13 04:53:07', NULL),
(5, 5, 'Selamat Datang!', 'Selamat datang di E-Mading Digital. Mulai buat artikel pertama Anda!', 'success', 1, '2025-11-13 04:24:09', '2025-11-13 04:53:02', NULL),
(6, 5, 'Tips Menulis Artikel', 'Gunakan judul yang menarik dan konten yang informatif untuk artikel Anda.', 'info', 1, '2025-11-13 04:24:09', '2025-11-13 04:53:06', NULL),
(7, 5, 'Artikel Menunggu Review', 'Artikel Anda sedang dalam proses review oleh admin.', 'info', 1, '2025-11-13 04:24:09', '2025-11-13 04:52:56', NULL),
(8, 5, 'Selamat Datang!', 'Selamat datang di E-Mading Digital. Mulai buat artikel pertama Anda!', 'info', 1, '2025-11-13 04:51:02', '2025-11-13 04:53:00', NULL),
(9, 8, 'Artikel Berhasil Dibuat', 'Artikel \"program mbg\" berhasil dibuat dan menunggu persetujuan pembina.', 'info', 1, '2025-11-13 16:27:19', '2025-11-17 04:28:57', NULL),
(10, 8, 'Artikel Berhasil Dibuat', 'Artikel \"jurusan pplg\" berhasil dibuat dan menunggu persetujuan pembina.', 'info', 1, '2025-11-13 16:29:07', '2025-11-17 04:28:20', NULL),
(11, 8, 'Artikel Berhasil Dibuat', 'Artikel \"jurusan akuntansi\" berhasil dibuat dan menunggu persetujuan pembina.', 'info', 1, '2025-11-13 16:31:12', '2025-11-14 00:45:55', NULL),
(12, 8, 'Artikel Disetujui', 'Artikel Anda \"jurusan akuntansi\" telah disetujui dan dipublikasikan.', 'success', 1, '2025-11-13 16:37:45', '2025-11-14 00:45:57', NULL),
(13, 8, 'Artikel Disetujui', 'Artikel Anda \"jurusan pplg\" telah disetujui dan dipublikasikan.', 'success', 1, '2025-11-13 16:37:49', '2025-11-17 04:28:14', NULL),
(14, 8, 'Artikel Disetujui', 'Artikel Anda \"program mbg\" telah disetujui dan dipublikasikan.', 'success', 1, '2025-11-13 16:37:53', '2025-11-17 04:28:12', NULL),
(15, 8, 'Artikel Berhasil Dibuat', 'Artikel \"Reva Dan Revo\" berhasil dibuat dan menunggu persetujuan pembina.', 'info', 1, '2025-11-14 00:44:33', '2025-11-14 00:46:00', NULL),
(16, 8, 'Artikel Disetujui', 'Artikel Anda \"Reva Dan Revo\" telah disetujui dan dipublikasikan.', 'success', 1, '2025-11-14 00:49:45', '2025-11-17 04:28:09', NULL),
(17, 8, 'Artikel Disetujui', 'Artikel \"eskul badminton\" telah disetujui dan dipublikasikan!', 'success', 1, '2025-11-17 17:56:49', '2025-11-18 02:03:23', 14),
(31, 8, 'Artikel Disetujui', 'Artikel \"futsal\" telah disetujui dan dipublikasikan!', 'success', 1, '2025-11-20 08:01:56', '2025-11-20 08:02:40', 29);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `posts`
--

CREATE TABLE `posts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `excerpt` text DEFAULT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `view_count` int(11) NOT NULL DEFAULT 0,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `content`, `excerpt`, `featured_image`, `status`, `published_at`, `view_count`, `category_id`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 'lomba badmin', 'lomba-badmin', 'menang badmin menang badminmenang badmin menang badminmenang badmin', 'siswa memenangkan lomba badmin', 'posts/yAJU5RNl5gVZkRiXIvq23g6nBSF57576fnbDD0F3.jpg', 'published', '2025-11-13 01:00:02', 6, 1, 5, '2025-11-13 00:56:05', '2025-11-20 06:08:09'),
(8, 'bazar', 'bazar', 'bazarbazarbazarbazarbazarbazarbazarbazarbazarbazarbazarbazarbazarbazarbazar', 'bazar', 'posts/YfRD38q1WCzUYshFWiOMxai7QzSbXpScUpsirb7D.jpg', 'published', '2025-11-13 00:59:54', 2, 3, 5, '2025-11-13 00:57:51', '2025-11-21 16:19:16'),
(9, 'PPDB', 'ppdb', 'PPDBPPDBPPDBPPDBPPDBPPDBPPDBPPDBPPDBPPDBPPDB', 'pembukaan PPDB', 'posts/388VcoT0TG6eaeiuUf7P3ZMoo4WDv6argwa9spZp.png', 'published', '2025-11-13 02:39:08', 3, 4, 5, '2025-11-13 00:58:35', '2025-11-20 06:07:39'),
(10, 'program mbg 666', 'program-mbg-666', 'Program Makan Bergizi Gratis dari Presiden RI kini hadir di SMK Bakti Nusantara 666 🍽️✨\r\n\r\n✨ Ayo dukung gerakan ini dengan kebiasaan baik:\r\n✅ Bawa alat makan pribadi\r\n✅ Bawa botol minum sendiri\r\n✅ Jaga kebersihan dan kurangi sampah plastik!\r\n\r\nKarena makan bergizi adalah hak semua pelajar, dan kebiasaan kecil bisa membawa perubahan besar!\r\n\r\nTerima kasih atas perhatian nyata untuk pendidikan dan kesehatan generasi muda 🇮🇩', 'program makan bergizi gratis', 'posts/BGPmeDwXEfnu9jQePE82N959AI5xe2luELBrhZfb.png', 'published', '2025-11-19 13:33:01', 27, 3, 8, '2025-11-13 16:27:19', '2025-11-21 15:55:19'),
(12, 'jurusan akuntansi', 'jurusan-akuntansi', 'Siapa bilang akuntansi itu cuma angka-angka yang bikin pusing? Di jurusan Akuntansi & Keuangan Lembaga SMK Bakti Nusantara 666, kami membuktikan kalau akuntansi itu seru, menantang, dan punya masa depan cerah! 🤑📚 Kami belajar gimana cara ngelola keuangan, bikin laporan yang akurat, sampai bisa menganalisis data bisnis layaknya detektif keuangan.\r\n\r\nSkill ini penting banget di dunia kerja, lho! Dari perusahaan besar, startup, sampai buka bisnis sendiri, lulusan Akuntansi punya banyak banget kesempatan. Jadi, kalau kamu teliti, suka detail, dan pengen jadi ahli keuangan yang diandalkan, inilah tempatnya!', 'akuntansi nih', 'posts/fYO04mAbHaEoG1d20iuobsT5Y671Zs7LMuWqiQ9R.png', 'published', '2025-11-13 16:37:45', 8, 4, 8, '2025-11-13 16:31:12', '2025-11-21 16:19:43'),
(14, 'eskul badminton', 'eskul-badminton', 'eskul badminton adalah eskul badmin', 'eskul badminton', 'posts/QPzPIlmqh5yQaxiPsB1nSbChyaKs2QqVohOssa38.jpg', 'published', '2025-11-17 17:56:49', 8, 5, 8, '2025-11-17 16:38:46', '2025-11-21 16:19:30'),
(29, 'futsal', 'futsal', 'futsal', 'futsal', 'posts/jfBScfCISnobpUPFKfGxoZfR14JWj9rMrVQ9lSNW.jpg', 'published', '2025-11-20 08:01:56', 2, 5, 8, '2025-11-20 08:00:30', '2025-11-20 08:01:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `post_tag`
--

CREATE TABLE `post_tag` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `post_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','pembina','siswa') DEFAULT 'siswa',
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'azka', 'azka@gmail.com', NULL, '$2y$12$5LC4RrEH9tD8r9imVCpmvun.CMqr2VvL7.IOha21BkWMk3uzZZ0i2', 'siswa', NULL, '8AmSc9iey5c8FBMyZm6XKtR64iNubnp5a4jZR73SzSGTNGC7JezVsS5wvAO0', '2025-11-12 04:23:54', '2025-11-12 04:23:54'),
(7, 'Admin', 'admin@gmail.com', NULL, '$2y$12$3h9F08bd3MlyfhmjSHSP5OJ6/Kw7MTBaw090OFY5QT9bovTdND6Oi', 'admin', NULL, 'L7XKwrA01y1eG2UP8kpZGAoNff8T9wwAsBThHxCccNeqEeMeJi6eiVHEZrGx', '2025-11-12 04:26:27', '2025-11-12 04:26:27'),
(8, 'dilan', 'dilan@gmail.com', NULL, '$2y$12$sigU0tosmD3cTmyiX4zqBOvKRUPoW9Ew2n4Gh2lSphsMRE4jG0bQC', 'siswa', NULL, NULL, '2025-11-13 16:25:11', '2025-11-13 16:25:11'),
(10, 'bu cantik', 'cantik@gmail.com', NULL, '$2y$12$U8C13bGM/lghsuajqGtM6Ox5n4fDoxkoyNJ.tSeXrh4bLcOet7zkq', 'pembina', NULL, NULL, '2025-11-17 16:35:15', '2025-11-19 13:28:27'),
(12, 'pembina', 'pembina@gmail.com', NULL, '$2y$12$DlYzXAFSa5anLJCQh39zKubCJ.TwoPtz8DccUOb4xy.y1ooznzlQe', 'pembina', NULL, NULL, '2025-11-19 16:40:09', '2025-11-19 16:40:09'),
(13, 'siswa', 'siswa@gmail.com', NULL, '$2y$12$1Zw0QeAMIHw8YwAND8vJt.h9qSxwPc5jNO2dHLpJNLGfS9G/3WQhW', 'siswa', NULL, NULL, '2025-11-19 16:57:41', '2025-11-19 16:57:41'),
(15, 'azka ahmad', 'ahmad@gmail.com', NULL, '$2y$12$gD4ZfPGV1EtJy/C3RvvnIeZtNywHF2IK/ro6WdxLPszMyjwYraGWm', 'siswa', NULL, NULL, '2025-11-20 06:09:17', '2025-11-20 06:09:17');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_post_id_foreign` (`post_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_post_id_foreign` (`post_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_tag_post_id_foreign` (`post_id`),
  ADD KEY `post_tag_tag_id_foreign` (`tag_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT untuk tabel `post_tag`
--
ALTER TABLE `post_tag`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
