-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2022 at 08:36 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hsp`
--

-- --------------------------------------------------------

--
-- Table structure for table `histori_kendaraan`
--

CREATE TABLE `histori_kendaraan` (
  `id` int(11) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `no_plat` varchar(255) NOT NULL,
  `tanggal_request` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approve_request` datetime DEFAULT NULL,
  `tanggal_pengembalian` datetime DEFAULT NULL,
  `approve_pengembalian` datetime DEFAULT NULL,
  `keterangan` bigint(20) DEFAULT NULL,
  `created_by` bigint(50) DEFAULT NULL,
  `updated_by` bigint(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `histori_kendaraan`
--

INSERT INTO `histori_kendaraan` (`id`, `id_user`, `no_plat`, `tanggal_request`, `approve_request`, `tanggal_pengembalian`, `approve_pengembalian`, `keterangan`, `created_by`, `updated_by`) VALUES
(1, 9, 'b 1122 ch', '2022-12-14 14:58:00', '2022-12-14 15:15:00', '2022-12-16 14:58:00', '2022-12-14 15:19:00', 9, 9, 7),
(2, 10, 'b 1122 ch', '2022-12-14 15:22:00', '2022-12-14 15:24:00', '2022-12-18 15:22:00', '2022-12-14 15:25:00', 9, 10, 7),
(3, 10, 'b 111 fgs', '2022-12-14 15:46:00', NULL, '2022-12-16 15:46:00', NULL, 10, 10, 7),
(4, 9, 'b 1122 ch', '2022-12-14 16:03:00', '2022-12-14 16:04:00', '2022-12-17 16:03:00', '2022-12-14 17:33:00', 9, 9, 7),
(5, 10, 'b 111 fgs', '2022-12-15 08:00:00', NULL, '2022-12-17 08:00:00', NULL, 10, 10, 7),
(6, 10, 'b 1122 ch', '2022-12-15 08:01:00', NULL, '2022-12-24 08:01:00', NULL, 10, 10, 7),
(7, 8, 'B 1011 cfg', '2022-12-15 13:09:00', '2022-12-15 13:25:00', '2022-12-17 13:10:00', '2022-12-15 13:27:00', 9, 8, 7),
(8, 8, 'b 9999 fds', '2022-12-15 13:31:00', NULL, '2022-12-18 13:32:00', NULL, 10, 8, 7),
(9, 8, 'b 111 fgs', '2022-12-15 15:35:00', '2022-12-16 13:30:00', '2022-12-22 15:35:00', '2022-12-16 13:30:00', 9, 8, 7),
(10, 8, 'b 1193 ch', '2022-12-19 15:12:00', NULL, '2022-12-21 15:12:00', NULL, 10, 8, 6),
(11, 8, 'b 111 fgs', '2022-12-19 15:16:00', NULL, '2022-12-20 15:16:00', NULL, 10, 8, 6),
(12, 8, 'b 111 fgs', '2022-12-21 11:51:00', NULL, '2022-12-22 11:51:00', NULL, 10, 8, 7),
(13, 8, 'b 111 fgs', '2022-12-27 10:42:00', '2022-12-27 10:49:00', '2022-12-29 10:42:00', '2022-12-27 11:16:00', 9, 8, 7),
(14, 8, 'b 1193 ch', '2022-12-27 11:18:00', '2022-12-27 13:47:00', '2022-12-29 11:18:00', '2022-12-27 14:05:00', 9, 8, 7),
(15, 8, 'b 111 fgs', '2022-12-27 11:21:00', '2022-12-27 13:50:00', '2022-12-29 11:21:00', '2022-12-27 14:06:00', 9, 8, 7);

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` bigint(20) NOT NULL,
  `nama_jabatan` varchar(255) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `created_by`, `updated_by`) VALUES
(1, 'IT Programmer', 6, 6),
(4, 'CEO', 6, 6),
(5, 'Finance', 6, 6),
(6, 'Security', 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `jns_kendaraan`
--

CREATE TABLE `jns_kendaraan` (
  `id_kendaraan` bigint(20) NOT NULL,
  `tp_kendaraan` varchar(255) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jns_kendaraan`
--

INSERT INTO `jns_kendaraan` (`id_kendaraan`, `tp_kendaraan`, `created_by`, `updated_by`) VALUES
(1, 'SUV', 6, 6),
(2, 'mpv', 6, 6),
(3, 'Crossover', 6, 6),
(4, 'Hatchback', 6, 6),
(5, 'sedan', 6, 6),
(6, 'Sport sedan', 6, 6),
(7, 'Conovertible', 6, 6),
(8, 'Station Wagon', 6, 6),
(9, 'Off Road', 6, 6),
(10, 'Pickup Truck', 6, 6),
(11, 'Mobil Listrik', 6, 6),
(12, 'Hybrid', 6, 6),
(13, 'Mobil LCGC', 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `id_kendaraan` int(11) NOT NULL,
  `no_plat` varchar(255) NOT NULL,
  `nama_kendaraan` varchar(255) NOT NULL,
  `mrk_kendaraan` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `thn_buat` varchar(255) NOT NULL,
  `warna` varchar(255) NOT NULL,
  `tipe` enum('Mobil','Motor') DEFAULT NULL,
  `tp_kendaraan` varchar(255) NOT NULL,
  `status` bigint(20) NOT NULL,
  `id_ketPinjam` bigint(20) DEFAULT NULL,
  `tgl_pajak` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `no_plat`, `nama_kendaraan`, `mrk_kendaraan`, `foto`, `thn_buat`, `warna`, `tipe`, `tp_kendaraan`, `status`, `id_ketPinjam`, `tgl_pajak`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(6, 'b 1193 ch', 'Grandmax', 'Honda', '1QTlxnHA6GOGnpHpEFYdksdTCpuR9o470uuGkz76.jpg', '2000', 'hitam', 'Mobil', 'SUV', 3, 6, '2023-01-05 15:27:00', '2022-12-27 07:05:55', '2022-12-15 13:46:00', 6, 7),
(7, 'B 1011 cfg', 'Grandmax', 'Mitsubishi', 'YAj7mvxP81w9CUJwcOfvYNw3CFjX4XYf3PxRJlql.jpg', '2001', 'Putih', 'Motor', 'Hatchback', 3, 6, '2023-11-30 15:48:00', '2022-12-15 06:27:15', '2022-11-26 02:45:00', 6, 6),
(9, 'b 11111 fdg', 'Grandmax', 'Honda', '5Q50qXzy2IMyXvXZ5SngzMeQO1dDTnnEU8Oq19cX.jpg', '2019', 'hitam', 'Mobil', 'SUV', 2, 6, '2022-12-10 01:29:00', '2022-12-07 06:25:36', '2022-11-26 01:29:00', 6, 6),
(12, 'b 111 fgs', 'Alphard', 'Honda', '1669264109_tulip-1290351_1920.jpg', '2050', 'hitam', 'Mobil', 'SUV', 1, 6, NULL, '2022-12-27 07:06:13', NULL, 6, NULL),
(14, 'b 11111 fdgs', 'Alphard', 'Honda', '1670320844_okeee.jpg', '2019', 'Kuning', 'Mobil', 'SUV', 1, 6, '2022-12-31 17:00:00', '2022-12-07 06:25:37', NULL, 6, NULL),
(15, 'b 1122 ch', 'lamborghini', 'Nissan', '1670321329_okeee.jpg', '1997', 'Kuning', 'Mobil', 'Sport sedan', 1, 6, '2023-12-06 17:08:00', '2022-12-15 02:20:04', NULL, 6, NULL),
(16, 'b 9999 fds', 'Brio', 'Honda', '1670570305_okeee.jpg', '2000', 'Kuning', 'Mobil', 'Sport sedan', 1, 6, '2025-12-09 14:18:00', '2022-12-15 06:39:21', NULL, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `keterangan`
--

CREATE TABLE `keterangan` (
  `id_status` bigint(20) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `keterangan`
--

INSERT INTO `keterangan` (`id_status`, `status`, `created_by`, `updated_by`) VALUES
(1, 'Perpanjang STNK', 6, 6),
(2, 'Balik Nama BPKB', 6, 6),
(3, 'Pembuatan STNK', 6, 6),
(4, 'Perpanjang STNk & Ganti Plat', 6, 6),
(5, 'Digunakan', 6, 6),
(6, 'Tidak Dipakai', 6, 6),
(7, 'Pengajuan Diservice', 6, 6),
(8, 'Pengajuan Peminjaman', 6, 6),
(9, 'Disetujui', 6, 6),
(10, 'Tidak Disetujui', 6, 6),
(11, 'Request', 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `model_kendaraan`
--

CREATE TABLE `model_kendaraan` (
  `id_model` bigint(20) NOT NULL,
  `mrk_kendaraan` varchar(255) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model_kendaraan`
--

INSERT INTO `model_kendaraan` (`id_model`, `mrk_kendaraan`, `created_by`, `updated_by`) VALUES
(1, 'Honda', 6, 6),
(2, 'Suzuki', 6, 6),
(3, 'Daihatsu', 6, 6),
(4, 'Mitsubishi', 6, 6),
(5, 'Nissan', 6, 6),
(6, 'KIA', 6, 6),
(7, 'BMW', 6, 6),
(8, 'Datsun', 6, 6),
(9, 'Isuzu', 6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_kendaraan`
--

CREATE TABLE `transaksi_kendaraan` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `no_plat` varchar(255) NOT NULL,
  `tgl_peminjaman` datetime DEFAULT NULL,
  `tgl_pengembalian` datetime DEFAULT NULL,
  `keterangan` bigint(20) DEFAULT NULL,
  `status_approve` bigint(20) DEFAULT NULL,
  `status_pengembalian` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `update_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `password` varchar(255) NOT NULL,
  `role` enum('superuser','admin','user') NOT NULL,
  `no_tlpn` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `id_jabatan` bigint(20) DEFAULT NULL,
  `jns_klmn` enum('laki-laki','perempuan') NOT NULL,
  `foto_user` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `no_tlpn`, `alamat`, `id_jabatan`, `jns_klmn`, `foto_user`, `created_at`, `updated_at`) VALUES
(6, 'super user', 'superadmin@gmail.com', '2022-12-15 06:51:51', '$2y$10$v5rJ71iXFPNDVFwRgP1P/OpfRYq81rQwcoX7WW77RZ4aBaASs1Y3i', 'superuser', '000000', 'xxxxxxxxxxxxx', 1, 'laki-laki', '1671087111_batuk.jpg', '2022-12-07 06:21:09', NULL),
(7, 'Admin', 'admin@gmail.com', '2022-12-07 06:44:43', '$2y$10$ADE/InbvhMKEc.SZAtJUke.v78Po1L6.503rCexZfKMHYvaj4mNeC', 'admin', '0000000', 'xxxxxxx', 6, 'laki-laki', NULL, '2022-12-07 06:41:12', '2022-12-07 13:44:00'),
(8, 'User', 'user@gmail.com', '2022-12-07 06:50:41', '$2y$10$GZzYTrbZk6uAHJ1TDrLaDegKKqu/KqBHeZarChdGjs0l2.qfENvMu', 'user', '0000000', 'xxxxxxxxxxxx', 4, 'laki-laki', '1670395841_user3-128x128.jpg', '2022-12-07 06:44:24', NULL),
(9, 'khairul ahmad', 'user1@gmail.com', '2022-12-14 07:37:09', '$2y$10$wxXNc3Zv6tBDdn.hhcfSqO8AG9W1w0RSgCswBNt9gQnc/NcJT88fW', 'user', '098765', 'ddddddddddddddd', 5, 'laki-laki', NULL, '2022-12-14 07:37:09', NULL),
(10, 'Najib', 'user2@gmail.com', '2022-12-14 07:37:52', '$2y$10$D0VG0a52oEVQnNBoVq54i.36Th1hCx58QEEXGVF3c.CjxzsGbq21K', 'user', '9098776667', 'ddddddddddddddd', 4, 'laki-laki', NULL, '2022-12-14 07:37:52', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `histori_kendaraan`
--
ALTER TABLE `histori_kendaraan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `no_plat` (`no_plat`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `keterangan` (`keterangan`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`),
  ADD KEY `created_by_2` (`created_by`),
  ADD KEY `updated_by_2` (`updated_by`);

--
-- Indexes for table `jns_kendaraan`
--
ALTER TABLE `jns_kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD UNIQUE KEY `tp_kendaraan` (`tp_kendaraan`),
  ADD KEY `created_by_2` (`created_by`),
  ADD KEY `updated_by_2` (`updated_by`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`id_kendaraan`),
  ADD UNIQUE KEY `no_plat` (`no_plat`),
  ADD KEY `created_by_2` (`created_by`),
  ADD KEY `updated_by_2` (`updated_by`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `mrk_kendaraan_2` (`mrk_kendaraan`),
  ADD KEY `tp_kendaraan_2` (`tp_kendaraan`),
  ADD KEY `status_2` (`status`),
  ADD KEY `id_ketPinjam` (`id_ketPinjam`);

--
-- Indexes for table `keterangan`
--
ALTER TABLE `keterangan`
  ADD PRIMARY KEY (`id_status`),
  ADD KEY `created_by_2` (`created_by`),
  ADD KEY `updated_by_2` (`updated_by`);

--
-- Indexes for table `model_kendaraan`
--
ALTER TABLE `model_kendaraan`
  ADD PRIMARY KEY (`id_model`),
  ADD UNIQUE KEY `mrk_kendaraan` (`mrk_kendaraan`),
  ADD KEY `created_by_2` (`created_by`),
  ADD KEY `updated_by_2` (`updated_by`);

--
-- Indexes for table `transaksi_kendaraan`
--
ALTER TABLE `transaksi_kendaraan`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD UNIQUE KEY `no_plat` (`no_plat`),
  ADD KEY `id` (`id_user`),
  ADD KEY `keterangan` (`keterangan`),
  ADD KEY `status_approve` (`status_approve`),
  ADD KEY `transaksi_kendaraan_fk3` (`created_by`),
  ADD KEY `transaksi_kendaraan_fk4` (`update_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_jabatan_2` (`id_jabatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `histori_kendaraan`
--
ALTER TABLE `histori_kendaraan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jns_kendaraan`
--
ALTER TABLE `jns_kendaraan`
  MODIFY `id_kendaraan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `keterangan`
--
ALTER TABLE `keterangan`
  MODIFY `id_status` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `model_kendaraan`
--
ALTER TABLE `model_kendaraan`
  MODIFY `id_model` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi_kendaraan`
--
ALTER TABLE `transaksi_kendaraan`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `histori_kendaraan`
--
ALTER TABLE `histori_kendaraan`
  ADD CONSTRAINT `histori_kendaraan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `histori_kendaraan_ibfk_2` FOREIGN KEY (`no_plat`) REFERENCES `kendaraan` (`no_plat`),
  ADD CONSTRAINT `histori_kendaraan_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `histori_kendaraan_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `histori_kendaraan_ibfk_5` FOREIGN KEY (`keterangan`) REFERENCES `keterangan` (`id_status`) ON DELETE CASCADE;

--
-- Constraints for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD CONSTRAINT `jabatan_fk0` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `jabatan_fk1` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `jns_kendaraan`
--
ALTER TABLE `jns_kendaraan`
  ADD CONSTRAINT `jns_kendaraan_fk0` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `jns_kendaraan_fk1` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD CONSTRAINT `kendaraan_fk0` FOREIGN KEY (`mrk_kendaraan`) REFERENCES `model_kendaraan` (`mrk_kendaraan`),
  ADD CONSTRAINT `kendaraan_fk1` FOREIGN KEY (`tp_kendaraan`) REFERENCES `jns_kendaraan` (`tp_kendaraan`),
  ADD CONSTRAINT `kendaraan_fk2` FOREIGN KEY (`status`) REFERENCES `keterangan` (`id_status`),
  ADD CONSTRAINT `kendaraan_fk3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kendaraan_fk4` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `kendaraan_ibfk_1` FOREIGN KEY (`id_ketPinjam`) REFERENCES `keterangan` (`id_status`);

--
-- Constraints for table `keterangan`
--
ALTER TABLE `keterangan`
  ADD CONSTRAINT `keterangan_fk0` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `keterangan_fk1` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `model_kendaraan`
--
ALTER TABLE `model_kendaraan`
  ADD CONSTRAINT `model_kendaraan_fk0` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `model_kendaraan_fk1` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `transaksi_kendaraan`
--
ALTER TABLE `transaksi_kendaraan`
  ADD CONSTRAINT `transaksi_kendaraan_fk1` FOREIGN KEY (`no_plat`) REFERENCES `kendaraan` (`no_plat`),
  ADD CONSTRAINT `transaksi_kendaraan_fk3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_kendaraan_fk4` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_kendaraan_ibfk_2` FOREIGN KEY (`keterangan`) REFERENCES `keterangan` (`id_status`),
  ADD CONSTRAINT `transaksi_kendaraan_ibfk_3` FOREIGN KEY (`status_approve`) REFERENCES `keterangan` (`id_status`),
  ADD CONSTRAINT `transaksi_kendaraan_ibfk_4` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Users_fk0` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
