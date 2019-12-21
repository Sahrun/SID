-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2019 at 03:03 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sid`
--

-- --------------------------------------------------------

--
-- Table structure for table `identitas_desa`
--

CREATE TABLE `identitas_desa` (
  `identitas_id` int(10) UNSIGNED NOT NULL,
  `identitas_key` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identitas_titel` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identitas_value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kelahiran`
--

CREATE TABLE `kelahiran` (
  `kelahiran_id` int(10) UNSIGNED NOT NULL,
  `penduduk_id` int(10) UNSIGNED NOT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `nik_ibu` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_ayah` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tob` time DEFAULT NULL,
  `hob` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi_lahir` enum('normal','cacat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat` float DEFAULT NULL,
  `panjang` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenis_kelahiran` enum('normal','caesar') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelahiran`
--

INSERT INTO `kelahiran` (`kelahiran_id`, `penduduk_id`, `anak_ke`, `nik_ibu`, `nik_ayah`, `tob`, `hob`, `kondisi_lahir`, `berat`, `panjang`, `created_at`, `updated_at`, `jenis_kelahiran`) VALUES
(1, 12, 1, '3306060208956666', '2131312321', '01:01:00', 'Dockter', 'normal', 13, 40, '2019-12-21 03:09:28', '2019-12-21 03:09:28', 'normal'),
(2, 13, 3, '3306060208956666', '2131312321', '01:01:00', 'Dockter', 'normal', 34, 40, '2019-12-21 03:12:53', '2019-12-21 03:12:53', 'normal');

-- --------------------------------------------------------

--
-- Table structure for table `keluarga`
--

CREATE TABLE `keluarga` (
  `keluarga_id` int(10) UNSIGNED NOT NULL,
  `kepala_keluarga` int(10) UNSIGNED DEFAULT NULL,
  `no_kk` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wilayah_dusun` int(10) UNSIGNED DEFAULT NULL,
  `wilayah_rw` int(10) UNSIGNED DEFAULT NULL,
  `wilayah_rt` int(10) UNSIGNED DEFAULT NULL,
  `alamat_keluarga` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `keluarga`
--

INSERT INTO `keluarga` (`keluarga_id`, `kepala_keluarga`, `no_kk`, `wilayah_dusun`, `wilayah_rw`, `wilayah_rt`, `alamat_keluarga`, `created_at`, `updated_at`) VALUES
(4, 4, '21412124223432', 79, 80, 85, 'lrbka bulus', '2019-12-15 03:25:18', '2019-12-15 03:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `kematian`
--

CREATE TABLE `kematian` (
  `kematian_id` int(10) UNSIGNED NOT NULL,
  `tgl_kematian` date NOT NULL,
  `jam_kematian` time NOT NULL,
  `tempat_kematian` enum('Rumah','Rumah Sakit','Lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `sebab_kematian` enum('Usia Tua','Sakit','Lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kematian`
--

INSERT INTO `kematian` (`kematian_id`, `tgl_kematian`, `jam_kematian`, `tempat_kematian`, `sebab_kematian`, `penduduk_id`, `created_at`, `updated_at`) VALUES
(1, '2019-12-26', '12:08:07', 'Rumah', 'Usia Tua', 12, '2019-12-24 17:00:00', '2019-12-20 17:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(81, '2013_10_09_162406_create_user_role_table', 1),
(82, '2014_10_12_000000_create_users_table', 1),
(83, '2014_10_12_100000_create_password_resets_table', 1),
(84, '2019_12_10_161957_create_wilayah_table', 1),
(85, '2019_12_10_162037_create_keluarga_table', 1),
(86, '2019_12_11_161929_create_penduduk_table', 1),
(87, '2019_12_11_162009_create_staff_table', 1),
(88, '2019_12_11_162010_create_surat_table', 1),
(89, '2019_12_11_162023_create_identitas_desa_table', 1),
(90, '2019_12_11_162046_create_kelahiran_table', 1),
(91, '2019_12_11_162100_create_kematian_table', 1),
(92, '2019_12_11_162112_create_penduduk_pindah_table', 1),
(93, '2019_12_11_162125_create_pendatang_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pendatang`
--

CREATE TABLE `pendatang` (
  `pendatang_id` int(10) UNSIGNED NOT NULL,
  `tgl_datang` datetime NOT NULL,
  `alamat_datang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan_datang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `penduduk_id` int(10) UNSIGNED NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kk` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wilayah_dusun` int(10) UNSIGNED NOT NULL,
  `wilayah_rt` int(10) UNSIGNED NOT NULL,
  `wilayah_rw` int(10) UNSIGNED NOT NULL,
  `keluarga_id` int(10) UNSIGNED DEFAULT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jekel` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_perkawinan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan_darah` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_kependudukan` enum('Tetap','Pendatang','Tidak tetap','Mati','Pindah') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hubungan_keluarga` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`penduduk_id`, `nik`, `no_kk`, `wilayah_dusun`, `wilayah_rt`, `wilayah_rw`, `keluarga_id`, `full_name`, `tempat_lahir`, `tanggal_lahir`, `jekel`, `agama`, `pendidikan`, `pekerjaan`, `status_perkawinan`, `golongan_darah`, `status_kependudukan`, `created_at`, `updated_at`, `hubungan_keluarga`) VALUES
(4, '3306060208956666', NULL, 79, 85, 80, 4, 'Sahrun', NULL, '1995-08-02', NULL, '- Pilih -', NULL, NULL, NULL, NULL, NULL, '2019-12-15 03:12:17', '2019-12-15 03:45:55', 'KEPALA KELUARGA'),
(5, '2131312321', NULL, 79, 85, 80, 4, 'Rini', NULL, '1998-06-16', NULL, '- Pilih -', NULL, NULL, NULL, NULL, NULL, '2019-12-15 03:12:45', '2019-12-15 03:30:31', 'MENANTU'),
(12, '3343423', '21412124223432', 79, 85, 80, 4, 'asas', 'asasas', '2019-12-27', 'Laki-laki', 'ISLAM', NULL, NULL, NULL, 'AB+', 'Mati', '2019-12-21 03:09:28', '2019-12-21 03:09:28', 'ANAK'),
(13, '2454533232', '21412124223432', 79, 86, 80, 4, 'Joko', 'asasas', '2019-12-26', 'Laki-laki', 'ISLAM', NULL, NULL, NULL, 'B', NULL, '2019-12-21 03:12:53', '2019-12-21 03:12:53', 'ANAK');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk_pindah`
--

CREATE TABLE `penduduk_pindah` (
  `pindah_id` int(10) UNSIGNED NOT NULL,
  `tgl_pindah` datetime NOT NULL,
  `alamat_pindah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan_pindah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(10) UNSIGNED NOT NULL,
  `nama_staff` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_nip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_nik` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_posisi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `surat_id` int(10) UNSIGNED NOT NULL,
  `nama_surat` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `hal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_filename` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` int(10) UNSIGNED DEFAULT NULL,
  `staff_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_email_verified_at` timestamp NULL DEFAULT NULL,
  `user_password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role_id` int(10) UNSIGNED DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int(10) UNSIGNED NOT NULL,
  `user_role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wilayah`
--

CREATE TABLE `wilayah` (
  `wilayah_id` int(10) UNSIGNED NOT NULL,
  `wilayah_part` int(11) DEFAULT NULL,
  `wilayah_dusun` int(11) DEFAULT NULL,
  `wilayah_rw` int(11) DEFAULT NULL,
  `wilayah_rt` int(11) DEFAULT NULL,
  `wilayah_nama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `penduduk_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wilayah`
--

INSERT INTO `wilayah` (`wilayah_id`, `wilayah_part`, `wilayah_dusun`, `wilayah_rw`, `wilayah_rt`, `wilayah_nama`, `created_at`, `updated_at`, `penduduk_id`) VALUES
(52, 2, 51, NULL, NULL, '-', '2019-12-12 03:48:20', '2019-12-12 03:48:20', NULL),
(53, 3, 51, 52, NULL, '-', '2019-12-12 03:48:20', '2019-12-12 03:48:20', NULL),
(55, 2, 54, NULL, NULL, '-', '2019-12-12 03:48:31', '2019-12-12 03:48:31', NULL),
(56, 3, 54, 55, NULL, '-', '2019-12-12 03:48:31', '2019-12-12 03:48:31', NULL),
(58, 2, 57, NULL, NULL, '-', '2019-12-11 21:09:17', '2019-12-11 21:09:17', NULL),
(59, 3, 57, 58, NULL, '-', '2019-12-11 21:09:17', '2019-12-11 21:09:17', NULL),
(61, 2, 60, NULL, NULL, 'RW 3', '2019-12-11 21:14:48', '2019-12-15 02:51:35', NULL),
(62, 3, 60, 61, NULL, 'RT 3', '2019-12-11 21:14:48', '2019-12-15 02:51:35', NULL),
(63, 2, 57, NULL, NULL, 'RW 04', '2019-12-12 19:16:33', '2019-12-12 19:16:33', NULL),
(65, 3, 57, 64, NULL, '-', '2019-12-12 19:17:19', '2019-12-12 19:17:19', NULL),
(66, 2, 57, NULL, NULL, 'RW 05', '2019-12-12 19:18:43', '2019-12-12 19:18:43', NULL),
(67, 3, 57, 66, NULL, '-', '2019-12-12 19:18:43', '2019-12-12 19:18:43', NULL),
(68, 2, 57, NULL, NULL, 'RW 10', '2019-12-12 19:20:24', '2019-12-12 20:09:26', NULL),
(69, 3, 57, 68, NULL, '-', '2019-12-12 19:20:24', '2019-12-12 19:20:24', NULL),
(71, 3, 57, 70, NULL, '-', '2019-12-12 19:22:27', '2019-12-12 19:22:27', NULL),
(72, 3, 57, 68, NULL, 'RT 03', '2019-12-12 19:52:00', '2019-12-12 20:06:45', NULL),
(74, 3, 57, 68, NULL, 'RT 05', '2019-12-12 19:56:55', '2019-12-12 20:10:01', NULL),
(75, 3, 57, 66, NULL, 'rt 5', '2019-12-13 22:34:54', '2019-12-13 22:34:54', NULL),
(77, 2, 76, NULL, NULL, '-', '2019-12-14 03:21:40', '2019-12-14 03:21:40', NULL),
(78, 3, 76, 77, NULL, '-', '2019-12-14 03:21:40', '2019-12-14 03:21:40', NULL),
(79, 1, NULL, NULL, NULL, 'Dusun 01', '2019-12-15 02:52:42', '2019-12-15 03:18:49', 4),
(80, 2, 79, NULL, NULL, '-', '2019-12-15 02:52:42', '2019-12-15 03:19:02', 5),
(81, 3, 79, 80, NULL, '-', '2019-12-15 02:52:42', '2019-12-15 02:52:42', NULL),
(82, 1, NULL, NULL, NULL, 'Dusun 2', '2019-12-15 02:54:33', '2019-12-15 02:54:33', NULL),
(83, 2, 82, NULL, NULL, '-', '2019-12-15 02:54:33', '2019-12-15 02:54:33', NULL),
(84, 3, 82, 83, NULL, '-', '2019-12-15 02:54:33', '2019-12-15 02:54:33', NULL),
(85, 3, 79, 80, NULL, 'RT 1', '2019-12-15 02:54:59', '2019-12-15 03:19:25', NULL),
(86, 3, 79, 80, NULL, 'RT 2', '2019-12-15 02:59:43', '2019-12-15 02:59:43', NULL),
(87, 3, 79, 80, NULL, 'RT 3', '2019-12-15 03:02:36', '2019-12-15 03:02:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `identitas_desa`
--
ALTER TABLE `identitas_desa`
  ADD PRIMARY KEY (`identitas_id`);

--
-- Indexes for table `kelahiran`
--
ALTER TABLE `kelahiran`
  ADD PRIMARY KEY (`kelahiran_id`),
  ADD KEY `penduduk_id` (`penduduk_id`);

--
-- Indexes for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD PRIMARY KEY (`keluarga_id`),
  ADD KEY `keluarga_wilayah_id_foreign` (`wilayah_dusun`);

--
-- Indexes for table `kematian`
--
ALTER TABLE `kematian`
  ADD PRIMARY KEY (`kematian_id`),
  ADD KEY `kematian_penduduk_id_foreign` (`penduduk_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pendatang`
--
ALTER TABLE `pendatang`
  ADD PRIMARY KEY (`pendatang_id`),
  ADD KEY `pendatang_penduduk_id_foreign` (`penduduk_id`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`penduduk_id`),
  ADD KEY `penduduk_keluarga_id_foreign` (`keluarga_id`),
  ADD KEY `penduduk_wilayah_id_foreign` (`wilayah_dusun`),
  ADD KEY `wilayah_rt` (`wilayah_rt`),
  ADD KEY `wilayah_rw` (`wilayah_rw`);

--
-- Indexes for table `penduduk_pindah`
--
ALTER TABLE `penduduk_pindah`
  ADD PRIMARY KEY (`pindah_id`),
  ADD KEY `penduduk_pindah_penduduk_id_foreign` (`penduduk_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`surat_id`),
  ADD KEY `surat_penduduk_id_foreign` (`penduduk_id`),
  ADD KEY `surat_staff_id_foreign` (`staff_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`),
  ADD KEY `users_user_role_id_foreign` (`user_role_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- Indexes for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD PRIMARY KEY (`wilayah_id`),
  ADD KEY `penduduk_id` (`penduduk_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `identitas_desa`
--
ALTER TABLE `identitas_desa`
  MODIFY `identitas_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kelahiran`
--
ALTER TABLE `kelahiran`
  MODIFY `kelahiran_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `keluarga`
--
ALTER TABLE `keluarga`
  MODIFY `keluarga_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kematian`
--
ALTER TABLE `kematian`
  MODIFY `kematian_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `pendatang`
--
ALTER TABLE `pendatang`
  MODIFY `pendatang_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `penduduk_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `penduduk_pindah`
--
ALTER TABLE `penduduk_pindah`
  MODIFY `pindah_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `surat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `wilayah_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kelahiran`
--
ALTER TABLE `kelahiran`
  ADD CONSTRAINT `kelahiran_ibfk_1` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`penduduk_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keluarga`
--
ALTER TABLE `keluarga`
  ADD CONSTRAINT `keluarga_wilayah_id_foreign` FOREIGN KEY (`wilayah_dusun`) REFERENCES `wilayah` (`wilayah_id`);

--
-- Constraints for table `kematian`
--
ALTER TABLE `kematian`
  ADD CONSTRAINT `kematian_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`penduduk_id`);

--
-- Constraints for table `pendatang`
--
ALTER TABLE `pendatang`
  ADD CONSTRAINT `pendatang_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`penduduk_id`);

--
-- Constraints for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `penduduk_ibfk_1` FOREIGN KEY (`wilayah_rt`) REFERENCES `wilayah` (`wilayah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penduduk_ibfk_2` FOREIGN KEY (`wilayah_rw`) REFERENCES `wilayah` (`wilayah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penduduk_keluarga_id_foreign` FOREIGN KEY (`keluarga_id`) REFERENCES `keluarga` (`keluarga_id`),
  ADD CONSTRAINT `penduduk_wilayah_id_foreign` FOREIGN KEY (`wilayah_dusun`) REFERENCES `wilayah` (`wilayah_id`);

--
-- Constraints for table `penduduk_pindah`
--
ALTER TABLE `penduduk_pindah`
  ADD CONSTRAINT `penduduk_pindah_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`penduduk_id`);

--
-- Constraints for table `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `surat_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`penduduk_id`),
  ADD CONSTRAINT `surat_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_user_role_id_foreign` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`user_role_id`);

--
-- Constraints for table `wilayah`
--
ALTER TABLE `wilayah`
  ADD CONSTRAINT `wilayah_ibfk_1` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`penduduk_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
