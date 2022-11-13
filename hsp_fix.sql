-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 05:42 AM
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
(1, 'IT Programmer', 1, 1),
(4, 'CEO', 1, 1);

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
(1, 'SUV', 1, 1),
(2, 'mpv', 1, 1),
(3, 'Crossover', 1, 1),
(4, 'Hatchback', 1, 1),
(5, 'sedan', 1, 1),
(6, 'Sport sedan', 1, 1),
(7, 'Conovertible', 1, 1),
(8, 'Station Wagon', 1, 1),
(9, 'Off Road', 1, 1),
(10, 'Pickup Truck', 1, 1),
(11, 'Mobil Listrik', 1, 1),
(12, 'Hybrid', 1, 1),
(13, 'Mobil LCGC', 1, 1);

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
  `tp_kendaraan` varchar(255) NOT NULL,
  `status` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `updated_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`id_kendaraan`, `no_plat`, `nama_kendaraan`, `mrk_kendaraan`, `foto`, `thn_buat`, `warna`, `tp_kendaraan`, `status`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(5, 'b 1193 cf', 'jazz', 'Daihatsu', 'ziYvZyBNfuh08xPklfobJQU3NlTjWOhB2Ns0nZnh.jpg', '2050', 'Putih', 'Crossover', 4, '2022-11-10 08:00:54', '2022-11-10 15:00:00', NULL, 1),
(6, 'b 1193 ch', 'Grandmax', 'Honda', '1QTlxnHA6GOGnpHpEFYdksdTCpuR9o470uuGkz76.jpg', '2000', 'hitam', 'SUV', 3, '2022-11-08 06:25:40', NULL, NULL, NULL),
(7, 'B 1011 cfg', 'Grandmax', 'Daihatsu', 'YAj7mvxP81w9CUJwcOfvYNw3CFjX4XYf3PxRJlql.jpg', '2001', 'Putih', 'Hatchback', 3, '2022-11-10 08:00:32', '2022-11-10 15:00:00', 1, 1),
(8, 'b 11111 fds', 'Xenia', 'Honda', 'RY53jbO0ift3ZD0kmIqZ3V3EaJBxvvO2xIG9R9gH.jpg', '1997', 'Putih', 'SUV', 2, '2022-11-10 07:30:35', '2022-11-10 14:30:00', 1, 1),
(9, 'b 11111 fdg', 'Grandmax', 'Honda', '5Q50qXzy2IMyXvXZ5SngzMeQO1dDTnnEU8Oq19cX.jpg', '2019', 'hitam', 'SUV', 2, '2022-11-11 04:33:27', NULL, 1, NULL);

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
(1, 'Perpanjang STNK', 1, 1),
(2, 'Balik Nama BPKB', 1, 1),
(3, 'Pembuatan STNK', 1, 1),
(4, 'Perpanjang STNk & Ganti Plat', 1, 1),
(5, 'Dipakai', 1, 1),
(6, 'Tidak Dipakai', 1, 1),
(7, 'Diservice', 1, 1),
(8, 'Pengajuan', 1, 1);

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
(1, 'Honda', 1, 1),
(2, 'Suzuki', 1, 1),
(3, 'Daihatsu', 1, 1),
(4, 'Mitsubishi', 1, 1),
(5, 'Nissan', 1, 1),
(6, 'KIA', 1, 1),
(7, 'BMW', 1, 1),
(8, 'Datsun', 1, 1),
(9, 'Isuzu', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_kendaraan`
--

CREATE TABLE `transaksi_kendaraan` (
  `id_transaksi` int(11) NOT NULL,
  `id` bigint(20) NOT NULL,
  `no_plat` varchar(255) NOT NULL,
  `tgl_peminjaman` datetime DEFAULT NULL,
  `keterangan` bigint(20) DEFAULT NULL,
  `created_by` bigint(20) DEFAULT NULL,
  `update_by` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_kendaraan`
--

INSERT INTO `transaksi_kendaraan` (`id_transaksi`, `id`, `no_plat`, `tgl_peminjaman`, `keterangan`, `created_by`, `update_by`, `created_at`, `updated_at`) VALUES
(2, 1, 'b 1193 cf', '2022-11-11 14:34:00', 5, 1, 1, '2022-11-11 08:56:26', '2022-11-11 15:56:00');

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
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `no_tlpn`, `alamat`, `id_jabatan`, `jns_klmn`, `created_at`, `updated_at`) VALUES
(1, 'Muhamad Damar Wahyu Suseno', 'muhamaddamar10@gmail.com', '2022-11-01 06:49:55', '$2y$10$5l1l8CssU.lyw0l1HxxgEObivApBrzY.jvcXRjXJOwhzLd0JxpODS', 'superuser', '0895636181447', '0895636181447', 1, 'laki-laki', '2022-10-31 23:46:41', '2022-11-01 06:46:41'),
(2, 'khairul', 'khairulahmadfauzi@gmail.com', '2022-11-10 04:41:06', '$2y$10$FinE6SziV/m.H/hP1sY6Gu1BOePrKSsw51HcmtvgSAKcQIb89/NEi', 'admin', '9098776667', 'ddddddddddddddd', 4, 'perempuan', '2022-11-04 10:07:17', '2022-11-10 11:41:00'),
(3, 'Muhamad Damar', 'damarwahyu1006@gmail.com', '2022-11-10 06:13:30', '$2y$10$VS/ichIU5hkWnmKELfneo.izuypEvgohQmJFsndyCqd0fR2Xd5qj6', 'superuser', '089765', 'woke', 4, 'laki-laki', '2022-11-10 04:06:39', '2022-11-10 13:13:00');

--
-- Indexes for dumped tables
--

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
  ADD KEY `status_2` (`status`);

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
  ADD KEY `transaksi_kendaraan_fk3` (`created_by`),
  ADD KEY `transaksi_kendaraan_fk4` (`update_by`),
  ADD KEY `id` (`id`),
  ADD KEY `keterangan` (`keterangan`);

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
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jns_kendaraan`
--
ALTER TABLE `jns_kendaraan`
  MODIFY `id_kendaraan` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `kendaraan`
--
ALTER TABLE `kendaraan`
  MODIFY `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `keterangan`
--
ALTER TABLE `keterangan`
  MODIFY `id_status` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `model_kendaraan`
--
ALTER TABLE `model_kendaraan`
  MODIFY `id_model` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaksi_kendaraan`
--
ALTER TABLE `transaksi_kendaraan`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `kendaraan_fk4` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

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
  ADD CONSTRAINT `transaksi_kendaraan_fk3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transaksi_kendaraan_fk4` FOREIGN KEY (`update_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transaksi_kendaraan_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `transaksi_kendaraan_ibfk_2` FOREIGN KEY (`keterangan`) REFERENCES `keterangan` (`id_status`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Users_fk0` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
