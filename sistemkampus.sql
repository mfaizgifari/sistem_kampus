-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2023 at 02:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistemkampus`
--

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `Nama` varchar(50) DEFAULT NULL,
  `NIP` int(30) NOT NULL,
  `Gelar` varchar(30) DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`Nama`, `NIP`, `Gelar`, `id_user`) VALUES
('Jawirium', 1101100, 'Dr. S.T, M.T.', NULL),
('Dimas', 1101101, 'S.T, M.T, Ph.D.', NULL),
('Andi', 1101102, 'S.T, M.T ASEAN', NULL),
('Adian', 1102111, 'S.T, M.T', NULL),
('Rayhan Khadafi', 1102113, 'S.T, M.T', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `dosen_matakuliah`
--

CREATE TABLE `dosen_matakuliah` (
  `id` int(50) NOT NULL,
  `dosen_id` int(30) DEFAULT NULL,
  `matakuliah_id` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `dosen_matakuliah`
--

INSERT INTO `dosen_matakuliah` (`id`, `dosen_id`, `matakuliah_id`) VALUES
(1, 1102111, 'TSK21233'),
(2, 1102111, 'TSK21305'),
(3, 1101101, 'TSK21305'),
(4, 1101101, 'TSK21315'),
(5, 1101101, 'TSK21285'),
(8, NULL, 'TSK21275'),
(9, NULL, 'TSK21285'),
(10, 1102113, 'TSK21286'),
(11, 1102113, 'TSK21294'),
(12, 1102111, 'TSK21295'),
(13, 1102113, 'TSK21264'),
(14, 1101101, 'TSK21325'),
(28, 1101102, 'TSK21233'),
(29, 1101102, 'TSK21285'),
(30, 1101102, 'TSK21315'),
(32, 1101100, 'TSK21233'),
(33, 1101100, 'TSK21444'),
(34, 1101100, 'TSK21234'),
(35, 1101100, 'TSK21325');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `nim` bigint(20) DEFAULT NULL,
  `kode_mk` varchar(20) DEFAULT NULL,
  `kode_kelas` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `nim`, `kode_mk`, `kode_kelas`) VALUES
(1, NULL, 'TSK21233', 'E201'),
(2, NULL, 'TSK21234', 'E201'),
(4, NULL, 'TSK21275', 'E201'),
(5, NULL, 'TSK21285', 'E201'),
(6, NULL, 'TSK21286', 'E201'),
(7, NULL, 'TSK21294', 'E201'),
(8, NULL, 'TSK21295', 'E201'),
(9, NULL, 'TSK21444', 'E201'),
(10, NULL, 'TSK21233', 'F302'),
(11, NULL, 'TSK21234', 'F302'),
(12, NULL, 'TSK21264', 'F302'),
(13, NULL, 'TSK21275', 'F302'),
(14, NULL, 'TSK21285', 'F302'),
(15, NULL, 'TSK21286', 'F302'),
(16, NULL, 'TSK21294', 'F302'),
(17, NULL, 'TSK21295', 'F302'),
(18, NULL, 'TSK21305', 'F302'),
(19, NULL, 'TSK21264', 'F302'),
(20, NULL, 'TSK21233', 'F303'),
(21, NULL, 'TSK21234', 'F303'),
(22, NULL, 'TSK21264', 'F303'),
(23, NULL, 'TSK21275', 'F303');

-- --------------------------------------------------------

--
-- Table structure for table `kelas_data`
--

CREATE TABLE `kelas_data` (
  `nama_kelas` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kelas_data`
--

INSERT INTO `kelas_data` (`nama_kelas`) VALUES
('E201'),
('E202'),
('E203'),
('F301'),
('F302'),
('F303'),
('A101'),
('A102');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `nim` bigint(20) NOT NULL,
  `nama` text DEFAULT NULL,
  `jk` varchar(10) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `id_user` bigint(20) UNSIGNED DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`nim`, `nama`, `jk`, `tempat_lahir`, `tgl_lahir`, `id_user`, `is_deleted`) VALUES
(21120121130047, 'Faiz Gifari', 'Laki-laki', 'Kota Semarang', '2003-11-11', NULL, 0),
(21120121130068, 'Zahirsyah Wangsaffyah', 'Laki-laki', 'Bekasi', '2002-09-11', NULL, 0),
(21120121130090, 'Rachel Sola', 'Laki-laki', 'Jaksel', '1991-12-11', NULL, 0),
(21120121130149, 'Feri Syahrul', 'Laki-laki', 'Jakarta Selatan', '2003-12-11', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `kode` varchar(20) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jumlah_sks` int(10) DEFAULT NULL,
  `is_deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`kode`, `nama`, `jumlah_sks`, `is_deleted`) VALUES
('TK111112', 'Jaringan Komputer Lanjutan', 3, 0),
('TSK21233', 'Jaringan Komputer', 3, 0),
('TSK21234', 'Arsitektur Komputer', 2, 0),
('TSK21264', 'Kriptografi', 3, 0),
('TSK21275', 'Metode Numerik', 2, 0),
('TSK21285', 'Probabilitas dan Statistik', 2, 0),
('TSK21286', 'Multimedia', 2, 0),
('TSK21294', 'Sistem Basis Data', 2, 0),
('TSK21295', 'Rekayasa Perangkat Lunak', 2, 0),
('TSK21305', 'Robotika', 3, 0),
('TSK21315', 'Sistem Digital Lanjut', 2, 0),
('TSK21325', 'Sistem Tertanam', 2, 0),
('TSK21444', 'Praktikum Robotika', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `is_admin`, `updated_at`, `created_at`, `email`) VALUES
(1, 'admin', '$2y$12$04.Hrw151MITM/O8t1aPF.cVKMrT1//amzE7kOiiNUE50nyJKql7m', 1, '2023-12-07 05:57:40', '2023-12-07 05:57:40', 'admin@gmail.com'),
(2, 'Arif', '$2y$10$SZQbw2tj9ZT.HO/DwO6Hi.vP0V0QoZYr6qmLvvaIwm.cQo8IuOfKm', 0, '2022-03-07 19:39:00', '2022-03-07 19:39:00', 'arif@gmail.com'),
(3, 'Budi Ramadhan', '$2y$10$PwfP/3QeANLJVsJgru4kXuXHbIwdgwJ9Mj9r9xj/31tn4iOtWyqQe', 0, '2022-04-22 06:28:10', '2022-04-22 06:28:10', 'budi@sia.com'),
(4, 'Fadilah Amaliyanisa', '$2y$10$b/864yq.u9H/R.eSKlxqlOFKXJTJ4nXa2IaiJDN6gWLlGtPSrwBfC', 0, '2022-04-22 07:50:17', '2022-04-22 07:50:17', 'dila@sia.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`NIP`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `dosen_matakuliah`
--
ALTER TABLE `dosen_matakuliah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dosen_matakuliah_dosen_NIP_fk` (`dosen_id`),
  ADD KEY `dosen_matakuliah_matakuliah_kode_fk` (`matakuliah_id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelas_mahasiswa_nim_fk` (`nim`),
  ADD KEY `kelas_matakuliah_kode_fk` (`kode_mk`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`nim`),
  ADD KEY `id` (`id_user`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `dosen_matakuliah`
--
ALTER TABLE `dosen_matakuliah`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dosen`
--
ALTER TABLE `dosen`
  ADD CONSTRAINT `dosen_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `dosen_matakuliah`
--
ALTER TABLE `dosen_matakuliah`
  ADD CONSTRAINT `dosen_matakuliah_dosen_NIP_fk` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`NIP`) ON DELETE SET NULL,
  ADD CONSTRAINT `dosen_matakuliah_matakuliah_kode_fk` FOREIGN KEY (`matakuliah_id`) REFERENCES `matakuliah` (`kode`) ON DELETE SET NULL;

--
-- Constraints for table `kelas`
--
ALTER TABLE `kelas`
  ADD CONSTRAINT `kelas_mahasiswa_nim_fk` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`) ON DELETE SET NULL,
  ADD CONSTRAINT `kelas_matakuliah_kode_fk` FOREIGN KEY (`kode_mk`) REFERENCES `matakuliah` (`kode`) ON DELETE SET NULL;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
