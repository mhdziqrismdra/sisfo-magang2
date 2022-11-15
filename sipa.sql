/*
SQLyog Ultimate
MySQL - 10.4.12-MariaDB-log : Database - sisfo-bkn
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `tbl_moa` */

CREATE TABLE `tbl_moa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kategori_moa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tingkat_moa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `lembaga_mitra` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `negara_id` int(11) DEFAULT NULL,
  `provinsi_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_kabupaten_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamata_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durasi` int(11) DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `dokumen1` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen2` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dokumen3` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kode_prodi` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_moa` */

insert  into `tbl_moa`(`id`,`kategori_moa`,`tingkat_moa`,`tanggal`,`lembaga_mitra`,`negara_id`,`provinsi_id`,`kota_kabupaten_id`,`kecamata_id`,`kelurahan_id`,`alamat`,`durasi`,`tanggal_akhir`,`dokumen1`,`dokumen2`,`dokumen3`,`kode_prodi`,`status`,`created_at`,`updated_at`) values (1,'Pendidikan/Pengajaran','Wilayah','2022-11-15','Nama Lembaga Mitra',2,NULL,NULL,NULL,NULL,'Nama Lembaga MitraNama Lembaga Mitra',1,'2023-11-15',NULL,NULL,NULL,NULL,1,'2022-11-15 05:52:14','2022-11-15 05:52:14');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
