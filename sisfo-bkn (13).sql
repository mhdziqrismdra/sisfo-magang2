-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2022 at 02:00 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sisfo-bkn`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(4, '2021_03_05_063246_create_tb_pegawai_table', 1),
(5, '2021_03_16_022955_create_tb_penilaian_create', 1),
(6, '2021_03_16_023850_create_tb_dokumen_table', 1),
(65, '2013_04_29_150405_create_tb_pegawai_table', 2),
(91, '2014_10_12_000000_create_users_table', 3),
(92, '2014_10_12_100000_create_password_resets_table', 3),
(93, '2019_08_19_000000_create_failed_jobs_table', 3),
(94, '2021_04_29_150405_create_tb_pegawai_table', 3),
(95, '2021_04_29_170211_create_tb_penilaian_table', 3),
(96, '2021_05_03_055754_create_tb_dokumen_table', 3),
(97, '2021_05_04_231118_create_penggunas_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('rimyfadli@gmail.com', 'aELX67LPpSFBL8guNVH5E2CJrz1RDtuVJ4WbvLwzAkhUqjEKWNwZp4xFdfEX', '2021-06-16 03:13:02'),
('ziqriziqri1@gmail.com', 'M9ojadiktQlEW6L4DqQrAny5CS1924jfMjDO12PBfwUpLuDGjhCtQNJcFKcH', '2021-06-16 03:13:58'),
('ziqriziqri1@gmail.com', '5iN1qGL3H7JOuWh7ah3m9FwRK9UJyTKPAhF5mwMBOGTnpBqf2IpsVhUKYSRf', '2021-06-16 03:15:56');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `name`, `nip`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(13, 'Dona Anggraini', '19348576', 'donaanggraini@gmail.com', NULL, '$2y$10$3HZFC9ownGPKMBVNPjQngewS1g3hS/mqaBKOIP4aOcETVVMI7RF6q', 'Pegawai', NULL, '2021-07-08 18:37:18', '2021-07-08 18:37:18'),
(14, 'Anggi Wijaksono', '12484594', 'anggi@gmail.com', NULL, '$2y$10$GFfPCCGgiOcr9V9WfKRs5ejxe2Wa4uo4XVFuKXIQvEE2LObFS3MFm', 'Pegawai', NULL, '2021-07-08 19:22:11', '2021-07-08 19:22:11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_dokumen`
--

CREATE TABLE `tb_dokumen` (
  `id_dokumen` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_dokumen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_dokumen`
--

INSERT INTO `tb_dokumen` (`id_dokumen`, `nip`, `judul_dokumen`, `file_dokumen`, `created_at`, `updated_at`) VALUES
(9, '12484594', 'Surat Perjalanan', 'Surat Perjalanan-09072021091520.pdf', '2021-07-09 02:15:20', '2021-07-09 02:15:20');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pegawai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `golongan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`nip`, `nama_pegawai`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `jabatan`, `golongan`, `alamat`) VALUES
('12484594', 'Anggi Wijaksono', 'Laki-laki', 'Duri', '1989-09-12', 'Kabag Kepegawaian', 'III D', 'Jl. Karya 2'),
('19343487', 'Sandra Frida', 'Perempuan', 'Pekanbaru', '1992-07-29', 'Sekretaris Inka', 'II C', 'Jl. Sepakat'),
('1934587', 'Rona Farida', 'Laki-laki', 'Jakrta', '1990-02-19', 'Kabag Administrasi', 'II C', 'Jl. Karya 1'),
('19348576', 'Dona Anggraini', 'Perempuan', 'Jakarta', '1993-05-27', 'Sekretaris Keuangan', 'III C', 'Jl. Bukit Barisan'),
('19545648', 'Bernat Alamsyah', 'Laki-laki', 'Medan', '1995-02-12', 'Administrasi', 'II C', 'Jl. Kaharudin Nasution');

-- --------------------------------------------------------

--
-- Table structure for table `tb_penilaian`
--

CREATE TABLE `tb_penilaian` (
  `id_penilaian` bigint(20) UNSIGNED NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atasan_langsung` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atasan_pejabat_penilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `capaian_kerja` int(11) NOT NULL,
  `orientasi_pelayanan` int(11) NOT NULL,
  `integritas` int(11) NOT NULL,
  `komitmen` int(11) NOT NULL,
  `disiplin` int(11) NOT NULL,
  `kerjasama` int(11) NOT NULL,
  `kepemimpinan` int(11) NOT NULL,
  `jumlah` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_penilaian`
--

INSERT INTO `tb_penilaian` (`id_penilaian`, `nip`, `atasan_langsung`, `atasan_pejabat_penilai`, `periode_awal`, `periode_akhir`, `capaian_kerja`, `orientasi_pelayanan`, `integritas`, `komitmen`, `disiplin`, `kerjasama`, `kepemimpinan`, `jumlah`) VALUES
(10, '12484594', 'Farhan', 'Mutiara', '2021-01-01', '2021-12-31', 80, 90, 87, 88, 85, 80, 87, 82.47);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$10$W1GQb9vE4e8eNtSUwuXoFuRkgj9uKo0iuiNih2KL9EdayAOy0ohFO', 'Admin', '8Xq86vHnnOYRgwD7T7VXwAa8eURyMfbbCSPWKkMflYkcT7icsjtHeH9YCMDe', '2021-05-07 04:36:44', '2021-05-07 04:36:44'),
(2, 'Sandro, S.Ikom', 'sandro113@gmail.com', NULL, '$2y$10$d6rAT6AFiYi/DcMDgayqfOC/hBN9V7rhG5bwa.fetBFhBTtUkVgtW', 'Admin', 'uNq3upcScsJxVBrTdwHUwuvF33xBi7KjL69PkrBCAK1Sh5iDEdPBDOitsBTj', '2021-07-08 18:31:00', '2021-07-08 18:31:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengguna_email_unique` (`email`),
  ADD KEY `pengguna_nip_foreign` (`nip`);

--
-- Indexes for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `tb_dokumen_nip_foreign` (`nip`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `tb_penilaian_nip_foreign` (`nip`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  MODIFY `id_dokumen` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  MODIFY `id_penilaian` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_nip_foreign` FOREIGN KEY (`nip`) REFERENCES `tb_pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_dokumen`
--
ALTER TABLE `tb_dokumen`
  ADD CONSTRAINT `tb_dokumen_nip_foreign` FOREIGN KEY (`nip`) REFERENCES `tb_pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_penilaian`
--
ALTER TABLE `tb_penilaian`
  ADD CONSTRAINT `tb_penilaian_nip_foreign` FOREIGN KEY (`nip`) REFERENCES `tb_pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
