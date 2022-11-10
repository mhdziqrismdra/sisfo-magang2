/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.12-MariaDB-log 
*********************************************************************
*/
/*!40101 SET NAMES utf8 */;

create table `tbl_mou` (
	`id` bigint (20),
	`tanggal_kerja_sama` date ,
	`nama_lembaga_mitra` varchar (765),
	`negara_id` int (11),
	`provinsi_id` varchar (75),
	`kota_kabupaten_id` varchar (75),
	`kecamata_id` varchar (75),
	`kelurahan_id` varchar (75),
	`alamat` text ,
	`durasi_kerja_sama` int (11),
	`tanggal_akhir_kerja_sama` date ,
	`dokumen` varchar (1050),
	`status` int (11),
	`created_at` timestamp ,
	`updated_at` timestamp 
); 
insert into `tbl_mou` (`id`, `tanggal_kerja_sama`, `nama_lembaga_mitra`, `negara_id`, `provinsi_id`, `kota_kabupaten_id`, `kecamata_id`, `kelurahan_id`, `alamat`, `durasi_kerja_sama`, `tanggal_akhir_kerja_sama`, `dokumen`, `status`, `created_at`, `updated_at`) values('2','2022-10-01','Nama Lembaga Mitra','4',NULL,NULL,NULL,NULL,'AlamatAlamatAlamatAlamat','4','2026-10-01','Doc_MOU_1667717718.pdf','1','2022-10-23 03:38:47','2022-11-09 06:35:16');
insert into `tbl_mou` (`id`, `tanggal_kerja_sama`, `nama_lembaga_mitra`, `negara_id`, `provinsi_id`, `kota_kabupaten_id`, `kecamata_id`, `kelurahan_id`, `alamat`, `durasi_kerja_sama`, `tanggal_akhir_kerja_sama`, `dokumen`, `status`, `created_at`, `updated_at`) values('3','2022-11-09','Nama Lembaga Mitra','102','11','11.12','11.12.06','11.12.06.2013','yyyyyyyyyyyyyyyyyyyy','2','2024-11-09',NULL,'1','2022-11-08 23:11:44','2022-11-09 06:35:10');
insert into `tbl_mou` (`id`, `tanggal_kerja_sama`, `nama_lembaga_mitra`, `negara_id`, `provinsi_id`, `kota_kabupaten_id`, `kecamata_id`, `kelurahan_id`, `alamat`, `durasi_kerja_sama`, `tanggal_akhir_kerja_sama`, `dokumen`, `status`, `created_at`, `updated_at`) values('4','2021-12-01','Nama Lembaga MitraNama Lembaga MitraNama Lembaga Mitra','102','17','17.01','17.01.10','17.01.10.2002','AlamatAlamatAlamat','1','2022-12-01',NULL,'1','2022-11-09 06:37:17','2022-11-09 20:18:48');
insert into `tbl_mou` (`id`, `tanggal_kerja_sama`, `nama_lembaga_mitra`, `negara_id`, `provinsi_id`, `kota_kabupaten_id`, `kecamata_id`, `kelurahan_id`, `alamat`, `durasi_kerja_sama`, `tanggal_akhir_kerja_sama`, `dokumen`, `status`, `created_at`, `updated_at`) values('5','1995-11-01','Nama Lembaga Mitra','1',NULL,NULL,NULL,NULL,'zdfdsfsdfsdfsd','3','1998-11-01',NULL,'1','2022-11-09 06:39:07','2022-11-09 06:39:07');
