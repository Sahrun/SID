-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: sid
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.34-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `identitas_desa`
--

DROP TABLE IF EXISTS `identitas_desa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `identitas_desa` (
  `identitas_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `identitas_key` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identitas_titel` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identitas_value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`identitas_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `identitas_desa`
--

LOCK TABLES `identitas_desa` WRITE;
/*!40000 ALTER TABLE `identitas_desa` DISABLE KEYS */;
/*!40000 ALTER TABLE `identitas_desa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kelahiran`
--

DROP TABLE IF EXISTS `kelahiran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kelahiran` (
  `kelahiran_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_anak` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_ibu` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_ayah` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `pob` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tob` time DEFAULT NULL,
  `hob` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kondisi_lahir` enum('normal','cacat') COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat` int(11) DEFAULT NULL,
  `tinggi` int(11) DEFAULT NULL,
  `keluarga_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kelahiran_id`),
  KEY `kelahiran_keluarga_id_foreign` (`keluarga_id`),
  CONSTRAINT `kelahiran_keluarga_id_foreign` FOREIGN KEY (`keluarga_id`) REFERENCES `keluarga` (`keluarga_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kelahiran`
--

LOCK TABLES `kelahiran` WRITE;
/*!40000 ALTER TABLE `kelahiran` DISABLE KEYS */;
/*!40000 ALTER TABLE `kelahiran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keluarga`
--

DROP TABLE IF EXISTS `keluarga`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keluarga` (
  `keluarga_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kepala_keluarga` int(10) unsigned DEFAULT NULL,
  `no_kk` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wilayah_dusun` int(10) unsigned DEFAULT NULL,
  `wilayah_rw` int(10) unsigned DEFAULT NULL,
  `wilayah_rt` int(10) unsigned DEFAULT NULL,
  `alamat_keluarga` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`keluarga_id`),
  KEY `keluarga_wilayah_id_foreign` (`wilayah_dusun`),
  CONSTRAINT `keluarga_wilayah_id_foreign` FOREIGN KEY (`wilayah_dusun`) REFERENCES `wilayah` (`wilayah_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keluarga`
--

LOCK TABLES `keluarga` WRITE;
/*!40000 ALTER TABLE `keluarga` DISABLE KEYS */;
INSERT INTO `keluarga` VALUES (4,4,'21412124223432',79,80,85,'lrbka bulus','2019-12-15 03:25:18','2019-12-15 03:45:55');
/*!40000 ALTER TABLE `keluarga` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kematian`
--

DROP TABLE IF EXISTS `kematian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kematian` (
  `kematian_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tgl_kematian` date NOT NULL,
  `jam_kematian` time NOT NULL,
  `tempat_kematian` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sebab_kematian` enum('Usia Tua','Sakit','Lainnya') COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kematian_id`),
  KEY `kematian_penduduk_id_foreign` (`penduduk_id`),
  CONSTRAINT `kematian_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`penduduk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kematian`
--

LOCK TABLES `kematian` WRITE;
/*!40000 ALTER TABLE `kematian` DISABLE KEYS */;
/*!40000 ALTER TABLE `kematian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (81,'2013_10_09_162406_create_user_role_table',1),(82,'2014_10_12_000000_create_users_table',1),(83,'2014_10_12_100000_create_password_resets_table',1),(84,'2019_12_10_161957_create_wilayah_table',1),(85,'2019_12_10_162037_create_keluarga_table',1),(86,'2019_12_11_161929_create_penduduk_table',1),(94,'2019_12_11_162009_create_staff_table',2),(95,'2019_12_11_162010_create_surat_table',2),(96,'2019_12_11_162023_create_identitas_desa_table',2),(97,'2019_12_11_162046_create_kelahiran_table',2),(98,'2019_12_11_162100_create_kematian_table',2),(99,'2019_12_11_162112_create_penduduk_pindah_table',2),(100,'2019_12_11_162125_create_pendatang_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pendatang`
--

DROP TABLE IF EXISTS `pendatang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pendatang` (
  `pendatang_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tgl_datang` datetime NOT NULL,
  `alamat_datang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan_datang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pendatang_id`),
  KEY `pendatang_penduduk_id_foreign` (`penduduk_id`),
  CONSTRAINT `pendatang_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`penduduk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pendatang`
--

LOCK TABLES `pendatang` WRITE;
/*!40000 ALTER TABLE `pendatang` DISABLE KEYS */;
/*!40000 ALTER TABLE `pendatang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penduduk`
--

DROP TABLE IF EXISTS `penduduk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penduduk` (
  `penduduk_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kk` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wilayah_dusun` int(10) unsigned NOT NULL,
  `wilayah_rt` int(10) unsigned NOT NULL,
  `wilayah_rw` int(10) unsigned NOT NULL,
  `keluarga_id` int(10) unsigned DEFAULT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jekel` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_perkawinan` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan_darah` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_kependudukan` enum('Tetap','Pendatang','Tidak tetap') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `hubungan_keluarga` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`penduduk_id`),
  KEY `penduduk_keluarga_id_foreign` (`keluarga_id`),
  KEY `penduduk_wilayah_id_foreign` (`wilayah_dusun`),
  KEY `wilayah_rt` (`wilayah_rt`),
  KEY `wilayah_rw` (`wilayah_rw`),
  CONSTRAINT `penduduk_ibfk_1` FOREIGN KEY (`wilayah_rt`) REFERENCES `wilayah` (`wilayah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penduduk_ibfk_2` FOREIGN KEY (`wilayah_rw`) REFERENCES `wilayah` (`wilayah_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `penduduk_keluarga_id_foreign` FOREIGN KEY (`keluarga_id`) REFERENCES `keluarga` (`keluarga_id`),
  CONSTRAINT `penduduk_wilayah_id_foreign` FOREIGN KEY (`wilayah_dusun`) REFERENCES `wilayah` (`wilayah_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penduduk`
--

LOCK TABLES `penduduk` WRITE;
/*!40000 ALTER TABLE `penduduk` DISABLE KEYS */;
INSERT INTO `penduduk` VALUES (4,'3306060208956666',NULL,79,85,80,4,'Sahrun',NULL,'1995-08-02',NULL,'- Pilih -',NULL,NULL,NULL,NULL,NULL,'2019-12-15 03:12:17','2019-12-15 03:45:55','KEPALA KELUARGA'),(5,'2131312321',NULL,79,85,80,4,'Rini',NULL,'1998-06-16',NULL,'- Pilih -',NULL,NULL,NULL,NULL,NULL,'2019-12-15 03:12:45','2019-12-15 03:30:31','MENANTU'),(8,'423434343',NULL,79,85,80,4,'Rindu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2019-12-15 03:20:59','2019-12-15 03:29:09','ISTRI');
/*!40000 ALTER TABLE `penduduk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `penduduk_pindah`
--

DROP TABLE IF EXISTS `penduduk_pindah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `penduduk_pindah` (
  `pindah_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tgl_pindah` datetime NOT NULL,
  `alamat_pindah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alasan_pindah` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`pindah_id`),
  KEY `penduduk_pindah_penduduk_id_foreign` (`penduduk_id`),
  CONSTRAINT `penduduk_pindah_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`penduduk_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `penduduk_pindah`
--

LOCK TABLES `penduduk_pindah` WRITE;
/*!40000 ALTER TABLE `penduduk_pindah` DISABLE KEYS */;
/*!40000 ALTER TABLE `penduduk_pindah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `staff_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_staff` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_nip` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_nik` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_posisi` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surat`
--

DROP TABLE IF EXISTS `surat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surat` (
  `surat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nama_surat` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` datetime NOT NULL,
  `hal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surat_filename` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `penduduk_id` int(10) unsigned DEFAULT NULL,
  `staff_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`surat_id`),
  KEY `surat_penduduk_id_foreign` (`penduduk_id`),
  KEY `surat_staff_id_foreign` (`staff_id`),
  CONSTRAINT `surat_penduduk_id_foreign` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`penduduk_id`),
  CONSTRAINT `surat_staff_id_foreign` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surat`
--

LOCK TABLES `surat` WRITE;
/*!40000 ALTER TABLE `surat` DISABLE KEYS */;
/*!40000 ALTER TABLE `surat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role`
--

DROP TABLE IF EXISTS `user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role` (
  `user_role_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_role_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role`
--

LOCK TABLES `user_role` WRITE;
/*!40000 ALTER TABLE `user_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role_id` int(10) unsigned DEFAULT NULL,
  `api_token` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_api_token_unique` (`api_token`),
  KEY `users_user_role_id_foreign` (`user_role_id`),
  CONSTRAINT `users_user_role_id_foreign` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`user_role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','admin@localhost',NULL,'$2y$10$fkLLwL2IIX5.BEa0dy8XF.t8EX7.FU8HXTmHUMtSRKJA.ikYHQz9S',NULL,NULL,NULL,NULL,NULL,'2019-12-22 06:17:42','2019-12-22 06:17:42');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wilayah`
--

DROP TABLE IF EXISTS `wilayah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wilayah` (
  `wilayah_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `wilayah_part` int(11) DEFAULT NULL,
  `wilayah_dusun` int(11) DEFAULT NULL,
  `wilayah_rw` int(11) DEFAULT NULL,
  `wilayah_rt` int(11) DEFAULT NULL,
  `wilayah_nama` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `penduduk_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`wilayah_id`),
  KEY `penduduk_id` (`penduduk_id`),
  CONSTRAINT `wilayah_ibfk_1` FOREIGN KEY (`penduduk_id`) REFERENCES `penduduk` (`penduduk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wilayah`
--

LOCK TABLES `wilayah` WRITE;
/*!40000 ALTER TABLE `wilayah` DISABLE KEYS */;
INSERT INTO `wilayah` VALUES (52,2,51,NULL,NULL,'-','2019-12-12 03:48:20','2019-12-12 03:48:20',NULL),(53,3,51,52,NULL,'-','2019-12-12 03:48:20','2019-12-12 03:48:20',NULL),(55,2,54,NULL,NULL,'-','2019-12-12 03:48:31','2019-12-12 03:48:31',NULL),(56,3,54,55,NULL,'-','2019-12-12 03:48:31','2019-12-12 03:48:31',NULL),(58,2,57,NULL,NULL,'-','2019-12-11 21:09:17','2019-12-11 21:09:17',NULL),(59,3,57,58,NULL,'-','2019-12-11 21:09:17','2019-12-11 21:09:17',NULL),(61,2,60,NULL,NULL,'RW 3','2019-12-11 21:14:48','2019-12-15 02:51:35',NULL),(62,3,60,61,NULL,'RT 3','2019-12-11 21:14:48','2019-12-15 02:51:35',NULL),(63,2,57,NULL,NULL,'RW 04','2019-12-12 19:16:33','2019-12-12 19:16:33',NULL),(65,3,57,64,NULL,'-','2019-12-12 19:17:19','2019-12-12 19:17:19',NULL),(66,2,57,NULL,NULL,'RW 05','2019-12-12 19:18:43','2019-12-12 19:18:43',NULL),(67,3,57,66,NULL,'-','2019-12-12 19:18:43','2019-12-12 19:18:43',NULL),(68,2,57,NULL,NULL,'RW 10','2019-12-12 19:20:24','2019-12-12 20:09:26',NULL),(69,3,57,68,NULL,'-','2019-12-12 19:20:24','2019-12-12 19:20:24',NULL),(71,3,57,70,NULL,'-','2019-12-12 19:22:27','2019-12-12 19:22:27',NULL),(72,3,57,68,NULL,'RT 03','2019-12-12 19:52:00','2019-12-12 20:06:45',NULL),(74,3,57,68,NULL,'RT 05','2019-12-12 19:56:55','2019-12-12 20:10:01',NULL),(75,3,57,66,NULL,'rt 5','2019-12-13 22:34:54','2019-12-13 22:34:54',NULL),(77,2,76,NULL,NULL,'-','2019-12-14 03:21:40','2019-12-14 03:21:40',NULL),(78,3,76,77,NULL,'-','2019-12-14 03:21:40','2019-12-14 03:21:40',NULL),(79,1,NULL,NULL,NULL,'Dusun 01','2019-12-15 02:52:42','2019-12-15 03:18:49',4),(80,2,79,NULL,NULL,'-','2019-12-15 02:52:42','2019-12-15 03:19:02',5),(81,3,79,80,NULL,'-','2019-12-15 02:52:42','2019-12-15 02:52:42',NULL),(82,1,NULL,NULL,NULL,'Dusun 2','2019-12-15 02:54:33','2019-12-15 02:54:33',NULL),(83,2,82,NULL,NULL,'-','2019-12-15 02:54:33','2019-12-15 02:54:33',NULL),(84,3,82,83,NULL,'-','2019-12-15 02:54:33','2019-12-15 02:54:33',NULL),(85,3,79,80,NULL,'RT 1','2019-12-15 02:54:59','2019-12-15 03:19:25',NULL),(86,3,79,80,NULL,'RT 2','2019-12-15 02:59:43','2019-12-15 02:59:43',NULL),(87,3,79,80,NULL,'RT 3','2019-12-15 03:02:36','2019-12-15 03:02:36',NULL);
/*!40000 ALTER TABLE `wilayah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'sid'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-22 20:36:46
