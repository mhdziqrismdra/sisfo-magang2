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

DROP TABLE IF EXISTS `tbl_moa`;

CREATE TABLE `tbl_moa` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `mou_id` bigint(20) DEFAULT NULL,
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
  `kode_prodi` char(20) CHARACTER SET utf8mb4 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `mou_id` (`mou_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_moa` */

insert  into `tbl_moa`(`id`,`mou_id`,`kategori_moa`,`tingkat_moa`,`tanggal`,`lembaga_mitra`,`negara_id`,`provinsi_id`,`kota_kabupaten_id`,`kecamata_id`,`kelurahan_id`,`alamat`,`durasi`,`tanggal_akhir`,`dokumen1`,`dokumen2`,`dokumen3`,`kode_prodi`,`status`,`created_at`,`updated_at`) values (1,1,'Pendidikan/Pengajaran','Wilayah','2022-11-15','Nama Lembaga Mitra',2,NULL,NULL,NULL,NULL,'Nama Lembaga MitraNama Lembaga Mitra',1,'2023-11-15',NULL,NULL,NULL,'2',1,'2022-11-15 05:52:14','2022-11-17 05:53:46'),(2,1,'Penelitian','Internasional','2022-11-17','Lembaga Mitra 11',18,NULL,NULL,NULL,NULL,'tttttttttttt',1,'2023-11-17',NULL,NULL,NULL,'4',1,'2022-11-17 05:28:55','2022-11-17 06:42:40'),(3,1,'Pendidikan/Pengajaran','Wilayah','2022-11-17','Tambah Kerja Sama',3,NULL,NULL,NULL,NULL,'yyyyyyyyyy',2,'2024-11-17',NULL,NULL,NULL,'3',1,'2022-11-17 05:31:37','2022-11-17 05:43:46');

/*Table structure for table `tbl_mou` */

DROP TABLE IF EXISTS `tbl_mou`;

CREATE TABLE `tbl_mou` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
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
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `tbl_mou` */

insert  into `tbl_mou`(`id`,`periode`,`tanggal_kerja_sama`,`nama_lembaga_mitra`,`negara_id`,`provinsi_id`,`kota_kabupaten_id`,`kecamata_id`,`kelurahan_id`,`alamat`,`durasi_kerja_sama`,`tanggal_akhir_kerja_sama`,`dokumen`,`status`,`created_at`,`updated_at`) values (1,1,'2022-11-11','Nama Lembaga Mitra',2,NULL,NULL,NULL,NULL,'Nama Lembaga MitraNama Lembaga Mitra',1,'2023-11-11','Doc_MOU_1668465875.pdf',1,'2022-11-11 18:52:04','2022-11-15 05:44:35'),(2,1,'2019-11-11','Nama Lembaga Mitra tt',3,NULL,NULL,NULL,NULL,'rftyrtyrty',1,'2020-11-11',NULL,0,'2022-11-11 18:55:10','2022-11-11 18:58:29'),(3,2,'2022-11-11','Nama Lembaga Mitra tt',3,NULL,NULL,NULL,NULL,'rftyrtyrty',1,'2023-11-11',NULL,1,'2022-11-11 18:58:29','2022-11-11 18:58:29');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
