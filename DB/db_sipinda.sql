-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_sipinda
DROP DATABASE IF EXISTS `db_sipinda`;
CREATE DATABASE IF NOT EXISTS `db_sipinda` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `db_sipinda`;

-- Dumping structure for table db_sipinda.tb_marketing
DROP TABLE IF EXISTS `tb_marketing`;
CREATE TABLE IF NOT EXISTS `tb_marketing` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_marketing` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nama_marketing` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kode_cabang` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `unit_head` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_sipinda.tb_marketing: ~0 rows (approximately)
DELETE FROM `tb_marketing`;
INSERT INTO `tb_marketing` (`id`, `no_marketing`, `nama_marketing`, `kode_cabang`, `unit_head`, `created_at`) VALUES
	(1, 'S000076323', 'Helda', '11272', '52153', 1699710254),
	(2, 'S000035559', 'Kintan', '30264', '83774', 1699710624),
	(3, 'S000024376', 'Rini', '69903', '75908', 1699710632),
	(4, 'S000066886', 'Fitri', '71185', '62841', 1699710640);

-- Dumping structure for table db_sipinda.tb_peminjam
DROP TABLE IF EXISTS `tb_peminjam`;
CREATE TABLE IF NOT EXISTS `tb_peminjam` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `no_telp` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `da_motor` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `dicairkan_oleh` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `top` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `angsuran` double NOT NULL,
  `no_kontrak` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `total_pinjaman` double NOT NULL,
  `jenis_pencairan` enum('CASH','TRANSFER') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_sipinda.tb_peminjam: ~0 rows (approximately)
DELETE FROM `tb_peminjam`;

-- Dumping structure for table db_sipinda.tb_users
DROP TABLE IF EXISTS `tb_users`;
CREATE TABLE IF NOT EXISTS `tb_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(60) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','operator') COLLATE utf8mb4_general_ci NOT NULL,
  `terakhir_login` int NOT NULL DEFAULT '0',
  `terakhir_logout` int NOT NULL DEFAULT '0',
  `total_login` int NOT NULL DEFAULT '0',
  `created_at` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table db_sipinda.tb_users: ~0 rows (approximately)
DELETE FROM `tb_users`;
INSERT INTO `tb_users` (`id`, `email`, `username`, `password`, `role`, `terakhir_login`, `terakhir_logout`, `total_login`, `created_at`) VALUES
	(5, 'admin@gmail.com', 'khadijah', '$2y$10$ObRhOxIkjizZ2R5PWH0nB.e22y1VTzaMf68LOYLxsOhtGDbWOkMRG', 'admin', 1699750586, 1699712204, 4, 1699707725),
	(7, 'robianoor2002@gmail.com', 'robianoor', '$2y$10$tozhjrB2KnwoFCuwzxhikOP1p9URr4TrOUy.qufrrYs7.NbA7iW.y', 'operator', 1699712208, 1699712213, 1, 1699711270);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
