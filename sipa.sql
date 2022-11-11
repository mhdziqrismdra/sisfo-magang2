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
/*Table structure for table `tbl_mou` */

CREATE TABLE `tbl_mou` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `periode` int(11) DEFAULT NULL,
  `tanggal_kerja_sama` date DEFAULT NULL,
  `nama_lembaga_mitra` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `negara_id` int(11) DEFAULT NULL,
  `provinsi_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kota_kabupaten_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kecamata_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kelurahan_id` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `durasi_kerja_sama` int(11) DEFAULT NULL,
  `tanggal_akhir_kerja_sama` date DEFAULT NULL,
  `dokumen` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_mou` */

insert  into `tbl_mou`(`id`,`periode`,`tanggal_kerja_sama`,`nama_lembaga_mitra`,`negara_id`,`provinsi_id`,`kota_kabupaten_id`,`kecamata_id`,`kelurahan_id`,`alamat`,`durasi_kerja_sama`,`tanggal_akhir_kerja_sama`,`dokumen`,`status`,`created_at`,`updated_at`) values (1,1,'2022-11-11','Nama Lembaga Mitra',2,NULL,NULL,NULL,NULL,'Nama Lembaga MitraNama Lembaga Mitra',1,'2023-11-11',NULL,1,'2022-11-11 18:52:04','2022-11-11 18:52:04'),(2,1,'2019-11-11','Nama Lembaga Mitra tt',3,NULL,NULL,NULL,NULL,'rftyrtyrty',1,'2020-11-11',NULL,0,'2022-11-11 18:55:10','2022-11-11 18:58:29'),(3,2,'2022-11-11','Nama Lembaga Mitra tt',3,NULL,NULL,NULL,NULL,'rftyrtyrty',1,'2023-11-11',NULL,1,'2022-11-11 18:58:29','2022-11-11 18:58:29');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
