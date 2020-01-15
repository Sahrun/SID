-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2020 at 03:45 AM
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

--
-- Dumping data for table `identitas_desa`
--

INSERT INTO `identitas_desa` (`identitas_id`, `identitas_key`, `identitas_titel`, `identitas_value`, `created_at`, `updated_at`) VALUES
(1, 'nama_prov', 'Nama Provinsi', 'Sumatera Selatan', NULL, '2020-01-13 04:31:36'),
(2, 'sebutan_kabupaten', 'Sebutan Kabupaten', 'Kabupaten', NULL, '2020-01-13 04:31:36'),
(3, 'sebutan_kabupaten_singkat', 'Singkatan Sebutan Kabupatan', 'Kab.', NULL, '2020-01-13 04:31:36'),
(4, 'nama_kab', 'Nama Kabupaten', 'Musi Banyuasin', NULL, '2020-01-13 04:31:36'),
(5, 'sebutan_kecamatan', 'Sebutan Kecamatan', 'Kecamatan', NULL, '2020-01-13 04:31:36'),
(6, 'sebutan_kecamatan_singkat', 'Singkatan Sebutan Kecamatan', 'Kec.', NULL, '2020-01-13 04:31:36'),
(7, 'nama_kec', 'Nama Kecamatan', 'Sungai Lilin', NULL, '2020-01-13 04:31:36'),
(8, 'sebutan_desa', 'Sebutan Desa', 'Desa', NULL, '2020-01-13 04:31:36'),
(9, 'nama_desa', 'Nama Desa', 'Mekar Jadi', NULL, '2020-01-13 04:31:36'),
(10, 'alamat_desa', 'Alamat Kantor Desa', 'Jalan poros desa Mekar Jadi No. 1', NULL, '2020-01-13 04:31:36'),
(11, 'sebutan_dusun', 'Sebutan Dusun', 'Dusun', NULL, '2020-01-13 04:31:36'),
(12, 'sebutan_camat', 'Sebutan Camat', 'Camat', NULL, '2020-01-13 04:31:36'),
(13, 'nama_bupati', 'Nama Bupati', 'Dodi Reza Alex Noerdin', NULL, '2020-01-13 04:31:36'),
(14, 'nama_wakil_bupati', 'Nama Wakil Bupati', 'Beni Hernedi', NULL, '2020-01-13 04:31:36'),
(15, 'nama_kades', 'Nama Kepala Desa', 'SADRIN, A.Md', NULL, '2020-01-13 04:31:36'),
(16, 'nama_camat', 'Nama Camat', 'Marco Setiawan., S. Sos', NULL, '2020-01-13 04:31:36'),
(17, 'nip_camat', 'NIP Camat', '19860926  201505  1  001', NULL, '2020-01-13 04:31:36'),
(18, 'kode_pos', 'Kode Pos', '54113', NULL, '2020-01-13 04:31:36');

-- --------------------------------------------------------

--
-- Table structure for table `kelahiran`
--

CREATE TABLE `kelahiran` (
  `kelahiran_id` int(10) UNSIGNED NOT NULL,
  `penduduk_id` int(10) UNSIGNED NOT NULL,
  `anak_ke` int(11) DEFAULT NULL,
  `id_penduduk_ibu` int(10) UNSIGNED DEFAULT NULL,
  `id_penduduk_ayah` int(10) UNSIGNED DEFAULT NULL,
  `tob` time DEFAULT NULL,
  `hob` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi_lahir` enum('Normal','Cacat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat` float DEFAULT NULL,
  `panjang` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `jenis_kelahiran` enum('Normal','Caesar') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kelahiran`
--

INSERT INTO `kelahiran` (`kelahiran_id`, `penduduk_id`, `anak_ke`, `id_penduduk_ibu`, `id_penduduk_ayah`, `tob`, `hob`, `kondisi_lahir`, `berat`, `panjang`, `created_at`, `updated_at`, `jenis_kelahiran`) VALUES
(9, 55, 2, 34, 33, '02:00:00', 'Dokter', 'Normal', 3.5, 45, '2020-01-11 19:16:19', '2020-01-11 19:16:19', 'Normal'),
(10, 56, 3, 43, 42, '07:30:00', 'Dokter', 'Normal', 3.45, 47.5, '2020-01-13 04:35:21', '2020-01-13 04:35:21', 'Normal');

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
(8, 33, '1606061104080317', 100, 109, 111, 'Jalan poros Desa Mekar Jadi', '2020-01-12 02:52:49', '2020-01-12 02:52:49'),
(9, 36, '1606061104080619', 100, 109, 111, 'Gang semar No 3', '2020-01-12 03:04:34', '2020-01-12 03:04:34'),
(10, 40, '1606061609160001', 100, 109, 112, 'Gang bagong no 24', '2020-01-12 03:09:25', '2020-01-12 03:09:25'),
(11, 42, '1606062305160001', 100, 117, 119, 'Jalan poros desa Mekar Jadi no 5', '2020-01-12 03:18:18', '2020-01-12 03:18:18'),
(12, 46, '1606061911090005', 103, 113, 121, 'Gang petruk no 12', '2020-01-12 03:31:03', '2020-01-12 03:31:03'),
(13, 50, '1606061104080251', 103, 115, 123, 'Jalan poros desa Mekar Jadi', '2020-01-12 03:38:56', '2020-01-12 03:38:56'),
(14, 57, '1606062506140005', 103, 115, 124, 'Gang semar no 14', '2020-01-13 04:41:59', '2020-01-13 04:41:59');

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
(5, '2020-01-10', '00:45:00', 'Rumah', 'Usia Tua', 50, '2020-01-12 03:56:35', '2020-01-12 03:56:35');

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
  `tgl_datang` date NOT NULL,
  `alamat_datang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan_datang` enum('Pekerjaan','Transmigrasi','Lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pendatang`
--

INSERT INTO `pendatang` (`pendatang_id`, `tgl_datang`, `alamat_datang`, `alasan_datang`, `penduduk_id`, `created_at`, `updated_at`) VALUES
(7, '2020-01-12', 'Palembang', 'Pekerjaan', 54, '2020-01-12 03:59:22', '2020-01-12 04:07:21'),
(8, '2020-01-13', 'Palembang', 'Pekerjaan', 57, '2020-01-13 04:38:05', '2020-01-13 04:38:05'),
(9, '2020-01-13', 'Palembang', 'Pekerjaan', 58, '2020-01-13 04:39:32', '2020-01-13 04:39:32'),
(10, '2020-01-13', 'Palembang', 'Pekerjaan', 59, '2020-01-13 04:41:11', '2020-01-13 04:41:11');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `penduduk_id` int(10) UNSIGNED NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wilayah_dusun` int(10) UNSIGNED DEFAULT NULL,
  `wilayah_rt` int(10) UNSIGNED DEFAULT NULL,
  `wilayah_rw` int(10) UNSIGNED DEFAULT NULL,
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
  `status_kependudukan` enum('Tetap','Pendatang','Tidak tetap','Meninggal','Pindah') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hubungan_keluarga` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ktp_elektronik` enum('Belum','Sudah') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_akta_kelahiran` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_warganegara` enum('WNI','WNA','Dua Kewarganegaraan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_paspor` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_kitas_kitap` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ayah` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`penduduk_id`, `nik`, `wilayah_dusun`, `wilayah_rt`, `wilayah_rw`, `keluarga_id`, `full_name`, `tempat_lahir`, `tanggal_lahir`, `jekel`, `agama`, `pendidikan`, `pekerjaan`, `status_perkawinan`, `golongan_darah`, `status_kependudukan`, `hubungan_keluarga`, `alamat`, `ktp_elektronik`, `no_akta_kelahiran`, `status_warganegara`, `no_paspor`, `no_kitas_kitap`, `nama_ayah`, `nama_ibu`, `created_at`, `updated_at`) VALUES
(33, '1606062510640001', 100, 111, 109, 8, 'AMAN', 'MUSI BANYUASIN', '1964-02-25', 'Laki-laki', 'ISLAM', 'SLTP/SEDERAJAT', 'PETANI/PEKEBUN', 'KAWIN', 'A', 'Tetap', 'KEPALA KELUARGA', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'ABU HASAN', 'ZAINAB', '2020-01-12 02:48:30', '2020-01-12 02:52:49'),
(34, '1606066012670001', 100, 111, 109, 8, 'ANITA', 'MUSI BANYUASIN', '1967-05-12', 'Perempuan', 'ISLAM', 'TAMAT SD / SEDERAJAT', 'MENGURUS RUMAH TANGGA', 'KAWIN', 'O', 'Tetap', 'ISTRI', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'KANASIN', 'NORSIA', '2020-01-12 02:49:56', '2020-01-12 02:53:09'),
(35, '1606066908040002', 100, 111, 109, 8, 'AGUSTINA', 'Toman', '2004-07-01', 'Perempuan', 'ISLAM', 'BELUM TAMAT SD/SEDERAJAT', 'PELAJAR/MAHASISWA', 'BELUM KAWIN', 'O', 'Tetap', 'ANAK', NULL, 'Belum', NULL, 'WNI', NULL, NULL, 'AMAN', 'ANITA', '2020-01-12 02:51:59', '2020-01-12 02:53:20'),
(36, '1606062710760001', 100, 111, 109, 9, 'FRANS KINARTO', 'MUSI BANYUASIN', '1976-04-23', 'Laki-laki', 'ISLAM', 'SLTP/SEDERAJAT', 'PETANI/PEKEBUN', 'KAWIN', 'O', 'Tetap', 'KEPALA KELUARGA', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'AHMAD', 'PATMA WATI', '2020-01-12 02:58:42', '2020-01-12 03:04:34'),
(37, '1606064706880003', 100, 111, 109, 9, 'YUNITA RAHAYU', 'TOMAN', '1988-08-23', 'Perempuan', 'ISLAM', 'SLTP/SEDERAJAT', 'PERDAGANGAN', 'KAWIN', 'O', 'Tetap', 'ISTRI', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'RAMADANI', 'NURIA', '2020-01-12 03:00:33', '2020-01-12 03:04:56'),
(38, '1606064106050005', 100, 111, 109, 9, 'INTAN SAHARA', 'Mekar Jadi', '2005-03-11', 'Perempuan', 'ISLAM', 'TIDAK / BELUM SEKOLAH', 'BELUM/TIDAK BEKERJA', 'BELUM KAWIN', 'O', 'Tetap', 'ANAK', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'FRANS KINARTO', 'YUNITA RAHAYU', '2020-01-12 03:02:09', '2020-01-12 03:05:12'),
(39, '1606061402100001', 100, 111, 109, 9, 'MARCELL PALENTINO LEFRAN', 'Mekar Jadi', '2010-09-12', 'Laki-laki', 'ISLAM', 'TIDAK / BELUM SEKOLAH', 'BELUM/TIDAK BEKERJA', 'BELUM KAWIN', 'O', 'Tetap', 'ANAK', NULL, 'Belum', NULL, 'WNI', NULL, NULL, 'FRANS KINARTO', 'YUNITA RAHAYU', '2020-01-12 03:03:22', '2020-01-12 03:05:20'),
(40, '1606066501590001', 100, 112, 109, 10, 'BASILA', 'LUBUK BUAH', '1959-06-10', 'Laki-laki', 'KRISTEN', 'SLTA / SEDERAJAT', 'GURU', 'KAWIN', 'B', 'Tetap', 'KEPALA KELUARGA', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'USMAN', 'RAKIMA', '2020-01-12 03:06:57', '2020-01-12 03:09:25'),
(41, '1606060910020006', 100, 112, 109, 10, 'HASBI', 'MUSI BANYUASIN', '2002-11-22', 'Perempuan', 'KRISTEN', 'SLTP/SEDERAJAT', 'PERDAGANGAN', 'KAWIN', 'AB', 'Tetap', 'ANAK', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'SALIM', 'BASILA', '2020-01-12 03:08:35', '2020-01-12 19:48:58'),
(42, '1803200508870001', 100, 119, 117, 11, 'ANTON BALA IBJA', 'Mekar Jadi', '1987-02-11', 'Laki-laki', 'ISLAM', 'SLTP/SEDERAJAT', 'PETANI/PEKEBUN', 'KAWIN', 'O', 'Tetap', 'KEPALA KELUARGA', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'JUSMAN RS', 'SRI YATUN', '2020-01-12 03:11:24', '2020-01-12 03:18:18'),
(43, '1803206008880002', 100, 119, 117, 11, 'NI KADEK YARMI NINGSIH', 'LAMPUNG', '1988-10-25', 'Perempuan', 'ISLAM', 'SLTP/SEDERAJAT', 'PERANGKAT DESA', 'KAWIN', 'A', 'Tetap', 'ISTRI', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'I KOMANG SUDAR SANE', 'NI WAYAN SUPRI', '2020-01-12 03:13:06', '2020-01-12 03:18:53'),
(44, '1803204505110002', 100, 119, 117, 11, 'WIDURI', 'CAHAYA MAKMUR', '2011-01-14', 'Perempuan', 'ISLAM', 'TIDAK / BELUM SEKOLAH', 'BELUM/TIDAK BEKERJA', 'BELUM KAWIN', 'O', 'Tetap', 'ANAK', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'ANTON BALA IBJA', 'NI KADEK YARMI NINGSIH', '2020-01-12 03:14:21', '2020-01-12 03:19:06'),
(45, '1606062405180001', 100, 119, 117, 11, 'AHBAB', 'Musi Banyuasin', '2018-12-05', 'Laki-laki', 'ISLAM', 'TIDAK / BELUM SEKOLAH', 'BELUM/TIDAK BEKERJA', 'BELUM KAWIN', 'AB', 'Tetap', 'ANAK', NULL, 'Belum', NULL, 'WNI', NULL, NULL, 'ANTON BALA IBJA', 'NI KADEK YARMI NINGSIH', '2020-01-12 03:15:31', '2020-01-12 03:19:23'),
(46, '1606062208880003', 103, 121, 113, 12, 'RUBIANSYAH', 'Musi Banyuasin', '1988-10-05', 'Laki-laki', 'HINDU', 'DIPLOMA IV/ STRATA I', 'PEGAWAI NEGERI SIPIL (PNS)', 'KAWIN', 'AB', 'Tetap', 'KEPALA KELUARGA', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'ROZALI', 'ROHAYA', '2020-01-12 03:26:00', '2020-01-12 03:31:03'),
(47, '1606065308890005', 103, 122, 113, 12, 'EKA INDERI GUSTINI', 'Mekar Jadi', '1989-02-11', 'Perempuan', 'HINDU', 'SLTA / SEDERAJAT', 'PERDAGANGAN', 'KAWIN', 'B', 'Tetap', 'ISTRI', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'SAMSIR', 'SITI ZAHARA', '2020-01-12 03:27:16', '2020-01-12 03:31:17'),
(48, '1606066210080004', 103, 121, 113, 12, 'MOZZA SALSABILA', 'Mekar Jadi', '2008-01-01', 'Perempuan', 'HINDU', 'TIDAK / BELUM SEKOLAH', 'BELUM/TIDAK BEKERJA', 'BELUM KAWIN', 'B', 'Tetap', 'ANAK', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'RUBIANSYAH', 'EKA INDERI GUSTINI', '2020-01-12 03:28:37', '2020-01-12 03:31:31'),
(49, '1606061509140001', 103, 121, 113, 12, 'MUHAMAD HAFIS WIJAYA', 'Mekar Jadi', '2014-12-03', 'Laki-laki', 'HINDU', 'TIDAK / BELUM SEKOLAH', 'BELUM/TIDAK BEKERJA', 'BELUM KAWIN', 'AB', 'Tetap', 'ANAK', NULL, 'Belum', NULL, 'WNI', NULL, NULL, 'RUBIANSYAH', 'EKA INDERI GUSTINI', '2020-01-12 03:30:18', '2020-01-12 03:31:39'),
(50, '1606061802460001', 103, 123, 115, 13, 'M PAKO', 'Musi Banyuasin', '1946-11-22', 'Laki-laki', 'KRISTEN', 'SLTA / SEDERAJAT', 'GURU', 'KAWIN', 'O', 'Meninggal', 'KEPALA KELUARGA', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'MANALI', 'CEK MENA', '2020-01-12 03:35:41', '2020-01-12 03:56:35'),
(51, '1606066511600002', 103, 123, 115, 13, 'ZALEHA', 'Musi Banyasin', '1960-06-11', 'Perempuan', 'KRISTEN', 'TAMAT SD / SEDERAJAT', 'MENGURUS RUMAH TANGGA', 'KAWIN', 'A', 'Tetap', 'ISTRI', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'SAKBAN', 'ENDOT', '2020-01-12 03:37:03', '2020-01-12 03:39:10'),
(52, '1606066404020003', 103, 123, 115, 13, 'DESI APRIANI', 'Mekar Jadi', '2002-08-12', 'Perempuan', 'KRISTEN', 'TAMAT SD / SEDERAJAT', 'BELUM/TIDAK BEKERJA', 'BELUM KAWIN', 'O', 'Pindah', 'ANAK', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'M PAKO', 'ZALEHA', '2020-01-12 03:38:20', '2020-01-12 04:08:20'),
(54, '1606062512920002', 103, 122, 113, NULL, 'ZEF ROLLEIS', 'Palembang', '1992-10-22', 'Laki-laki', 'KATHOLIK', 'AKADEMI/ DIPLOMA III/S. MUDA', 'KEPOLISIAN RI (POLRI)', 'BELUM KAWIN', 'A', 'Pendatang', NULL, NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'ZAIPUR', 'HOIRANI', '2020-01-12 03:59:22', '2020-01-12 04:07:21'),
(55, '1606060208160001', 100, 111, 109, 8, 'AL IQRAM GUSTIAWAN', 'Mekar Jadi', '2020-01-12', 'Laki-laki', 'ISLAM', NULL, NULL, NULL, 'TIDAK TAHU', 'Tetap', 'ANAK', NULL, 'Belum', NULL, 'WNI', NULL, NULL, 'AMAN', 'ANITA', '2020-01-11 19:16:19', '2020-01-11 19:16:19'),
(56, '1606060312160001', 100, 119, 117, 11, 'GHIFFARI RAFASYAH BANI CUSMA', 'Mekar Jadi', '2020-01-13', 'Laki-laki', 'ISLAM', NULL, NULL, NULL, 'TIDAK TAHU', 'Tetap', 'ANAK', NULL, 'Belum', NULL, 'WNI', NULL, NULL, 'ANTON BALA IBJA', 'NI KADEK YARMI NINGSIH', '2020-01-13 04:35:21', '2020-01-13 04:35:21'),
(57, '1606061901480001', 103, 124, 115, 14, 'RUSLI', 'Musi Banyuasin', '1946-02-08', 'Laki-laki', 'KATHOLIK', 'SLTA / SEDERAJAT', 'TENTARA NASIONAL INDONESIA (TNI)', 'KAWIN', 'A', 'Pendatang', 'KEPALA KELUARGA', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'BADUWI', 'NURSIDA', '2020-01-13 04:38:05', '2020-01-13 04:41:59'),
(58, '1606065101480001', 103, 124, 115, 14, 'ROHANA', 'Lampung', '1951-01-23', 'Perempuan', 'KATHOLIK', 'SLTP/SEDERAJAT', 'MENGURUS RUMAH TANGGA', 'KAWIN', 'AB', 'Pendatang', 'ISTRI', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'IBRAHIM', 'MINA', '2020-01-13 04:39:32', '2020-01-13 04:42:13'),
(59, '1606060501700005', 103, 124, 115, 14, 'ISKANDAR', 'Palembang', '1970-06-15', 'Laki-laki', 'KATHOLIK', 'SLTA / SEDERAJAT', 'GURU', 'BELUM KAWIN', 'AB', 'Pendatang', 'ANAK', NULL, 'Sudah', NULL, 'WNI', NULL, NULL, 'RUSLI', 'ROHANA', '2020-01-13 04:41:11', '2020-01-13 04:42:22');

-- --------------------------------------------------------

--
-- Table structure for table `penduduk_pindah`
--

CREATE TABLE `penduduk_pindah` (
  `pindah_id` int(10) UNSIGNED NOT NULL,
  `tgl_pindah` date NOT NULL,
  `alamat_pindah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan_pindah` enum('Pekerjaan','Transmigrasi','Lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penduduk_pindah`
--

INSERT INTO `penduduk_pindah` (`pindah_id`, `tgl_pindah`, `alamat_pindah`, `alasan_pindah`, `penduduk_id`, `created_at`, `updated_at`) VALUES
(7, '2020-01-12', 'Kec. Kenten Laut. Palembang', 'Lainnya', 52, '2020-01-12 04:08:20', '2020-01-12 04:08:20');

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

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `nama_staff`, `staff_nip`, `staff_nik`, `staff_posisi`, `created_at`, `updated_at`) VALUES
(2, 'SADRIN, A.Md', NULL, '1606070403800004', 'KEPALA DESA', '2020-01-12 04:16:09', '2020-01-12 04:16:09'),
(3, 'BUDIONO', NULL, '1606070805840001', 'SEKRETARIS DESA', '2020-01-12 04:16:44', '2020-01-12 04:16:44'),
(4, 'SISKA DEWI SINTA', NULL, '1606077107970003', 'KASI PELAYANAN', '2020-01-12 04:17:13', '2020-01-12 04:17:13'),
(5, 'SUDARNO', NULL, '1606072905890003', 'BENDAHARA DESA', '2020-01-12 04:17:39', '2020-01-12 04:17:39'),
(6, 'TRISNA', NULL, '1606070308660002', 'KASIH PEMERINTAHAN', '2020-01-12 04:18:03', '2020-01-12 04:18:03'),
(7, 'ATEN MURTAFI\'AH', NULL, '1606075405930002', 'KASIH KESEJAHTERAAN', '2020-01-12 04:18:26', '2020-01-12 04:18:26'),
(8, 'ENDAH IRMAYANTI', NULL, '1606076301950001', 'KAUR PERENCANAAN', '2020-01-12 04:18:54', '2020-01-12 04:18:54'),
(9, 'A.MAHFUD', NULL, '1606071202710005', 'KAUR TATAUSAHA USAHA & UMUM', '2020-01-12 04:19:13', '2020-01-12 04:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `surat_id` int(10) UNSIGNED NOT NULL,
  `nama_surat` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `hal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_filename` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` int(10) UNSIGNED DEFAULT NULL,
  `staff_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surat`
--

INSERT INTO `surat` (`surat_id`, `nama_surat`, `tanggal`, `hal`, `surat_filename`, `penduduk_id`, `staff_id`, `created_at`, `updated_at`) VALUES
(28, 'Surat Keterangan Kelahiran', '2020-01-13', 'Membuat akta lahir', 'Surat Keterangan Kelahiran_20200113112415.doc', 55, 2, '2020-01-13 04:24:15', '2020-01-13 04:24:15'),
(29, 'Surat Keterangan Kematian', '2020-01-13', 'Mengurus asuransi kematian', 'Surat Keterangan Kematian_20200113112838.doc', 50, 2, '2020-01-13 04:28:38', '2020-01-13 04:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role_id` int(10) UNSIGNED DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_picture`, `user_role_id`, `api_token`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(2, 'Administrator', 'admin@example.com', NULL, '$2y$10$u3cyv3l9qI9jjy.u0A0BBO9N2LT2hc6sJboQfRugnmbhlSkgWgY8m', NULL, 1, NULL, NULL, NULL, '2020-01-11 21:43:37', '2020-01-11 21:43:37'),
(3, 'Staff', 'staff@example.com', NULL, '$2y$10$gV.WRtZoL8TggqJ3hjjq4OBLNDe19KU2cFmtmMSjed5q755q5JjxK', NULL, 2, NULL, 'FuEM267qR4AOiqUZBgGnsu1JLGhpqQBj4K5mtGQfNyP5NthOX8M81iiCcB69', NULL, '2020-01-11 21:47:15', '2020-01-11 21:47:15');

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

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `user_role_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Staff', NULL, NULL);

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
(100, 1, NULL, NULL, NULL, 'Dusun 1', '2020-01-12 02:33:47', '2020-01-12 03:51:32', 33),
(103, 1, NULL, NULL, NULL, 'Dusun 2', '2020-01-12 02:33:58', '2020-01-12 03:51:42', 46),
(109, 2, 100, NULL, NULL, 'RW 1', '2020-01-12 02:34:16', '2020-01-12 02:37:13', NULL),
(111, 3, 100, 109, NULL, 'RT 1', '2020-01-12 02:34:36', '2020-01-12 02:34:36', NULL),
(112, 3, 100, 109, NULL, 'RT 2', '2020-01-12 02:37:42', '2020-01-12 02:37:42', NULL),
(113, 2, 103, NULL, NULL, 'RW 3', '2020-01-12 02:38:15', '2020-01-12 02:38:15', NULL),
(115, 2, 103, NULL, NULL, 'RW 4', '2020-01-12 02:38:27', '2020-01-12 02:38:27', NULL),
(117, 2, 100, NULL, NULL, 'RW 2', '2020-01-12 02:38:45', '2020-01-12 02:38:45', NULL),
(119, 3, 100, 117, NULL, 'RT 3', '2020-01-12 02:39:01', '2020-01-12 02:39:01', NULL),
(120, 3, 100, 117, NULL, 'RT 4', '2020-01-12 02:39:09', '2020-01-12 02:39:09', NULL),
(121, 3, 103, 113, NULL, 'RT 5', '2020-01-12 02:39:48', '2020-01-12 02:39:48', NULL),
(122, 3, 103, 113, NULL, 'RT 6', '2020-01-12 02:39:58', '2020-01-12 02:39:58', NULL),
(123, 3, 103, 115, NULL, 'RT 7', '2020-01-12 02:40:12', '2020-01-12 02:40:12', NULL),
(124, 3, 103, 115, NULL, 'RT 8', '2020-01-12 02:40:20', '2020-01-12 02:40:20', NULL);

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
  ADD PRIMARY KEY (`id`),
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
  MODIFY `identitas_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `kelahiran`
--
ALTER TABLE `kelahiran`
  MODIFY `kelahiran_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `keluarga`
--
ALTER TABLE `keluarga`
  MODIFY `keluarga_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kematian`
--
ALTER TABLE `kematian`
  MODIFY `kematian_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `pendatang`
--
ALTER TABLE `pendatang`
  MODIFY `pendatang_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `penduduk_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `penduduk_pindah`
--
ALTER TABLE `penduduk_pindah`
  MODIFY `pindah_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `surat_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wilayah`
--
ALTER TABLE `wilayah`
  MODIFY `wilayah_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

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
