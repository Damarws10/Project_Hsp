CREATE TABLE `Users` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL UNIQUE,
	`email_verified_at` TIMESTAMP,
	`password` varchar(255) NOT NULL,
	`role` enum('superuser','admin','user') NOT NULL,
	`no_tlpn` varchar(255),
	`alamat` varchar(255),
	`id_jabatan` bigint(20) UNIQUE,
	`jns_klmn` enum('laki-laki','perempuan') NOT NULL,
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
);

CREATE TABLE `kendaraan` (
	`id_kendaraan` int NOT NULL AUTO_INCREMENT,
	`no_plat` varchar(255) NOT NULL UNIQUE,
	`nama_kendaraan` varchar(255) NOT NULL,
	`mrk_kendaraan` varchar(255) NOT NULL UNIQUE,
	`foto` varchar(255) NOT NULL,
	`thn_buat` varchar(255) NOT NULL,
	`warna` varchar(255) NOT NULL,
	`tp_kendaraan` varchar(255) NOT NULL UNIQUE,
	`status` bigint NOT NULL UNIQUE,
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` DATETIME NOT NULL,
	`created_by` bigint(20) NOT NULL UNIQUE,
	`updated_by` bigint(20) NOT NULL UNIQUE,
	PRIMARY KEY (`id_kendaraan`)
);

CREATE TABLE `transaksi_kendaraan` (
	`id` bigint(20) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL UNIQUE,
	`no_plat` varchar(255) NOT NULL UNIQUE,
	`id_status` bigint NOT NULL UNIQUE,
	`created_by` bigint(20) NOT NULL,
	`update_by` bigint(20) NOT NULL,
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `jabatan` (
	`id_jabatan` bigint(20) NOT NULL AUTO_INCREMENT,
	`nama_jabatan` varchar(255) NOT NULL,
	`created_by` bigint(20) NOT NULL UNIQUE,
	`updated_by` bigint(20) NOT NULL UNIQUE,
	PRIMARY KEY (`id_jabatan`)
);

CREATE TABLE `jns_kendaraan` (
	`id_kendaraan` bigint NOT NULL AUTO_INCREMENT,
	`tp_kendaraan` varchar(255) NOT NULL UNIQUE,
	`created_by` bigint(20) NOT NULL UNIQUE,
	`updated_by` bigint(20) NOT NULL UNIQUE,
	PRIMARY KEY (`id_kendaraan`)
);

CREATE TABLE `model_kendaraan` (
	`id_model` bigint NOT NULL AUTO_INCREMENT,
	`mrk_kendaraan` varchar(255) NOT NULL UNIQUE,
	`created_by` bigint(20) NOT NULL UNIQUE,
	`updated_by` bigint(20) NOT NULL UNIQUE,
	PRIMARY KEY (`id_model`)
);

CREATE TABLE `keterangan` (
	`id_status` bigint NOT NULL AUTO_INCREMENT,
	`status` enum('Dipakai','Tidak Dipakai') NOT NULL,
	`created_by` bigint(20) NOT NULL UNIQUE,
	`updated_by` bigint(20) NOT NULL UNIQUE,
	PRIMARY KEY (`id_status`)
);

ALTER TABLE `Users` ADD CONSTRAINT `Users_fk0` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan`(`id_jabatan`);

ALTER TABLE `kendaraan` ADD CONSTRAINT `kendaraan_fk0` FOREIGN KEY (`mrk_kendaraan`) REFERENCES `model_kendaraan`(`mrk_kendaraan`);

ALTER TABLE `kendaraan` ADD CONSTRAINT `kendaraan_fk1` FOREIGN KEY (`tp_kendaraan`) REFERENCES `jns_kendaraan`(`tp_kendaraan`);

ALTER TABLE `kendaraan` ADD CONSTRAINT `kendaraan_fk2` FOREIGN KEY (`status`) REFERENCES `keterangan`(`id_status`);

ALTER TABLE `kendaraan` ADD CONSTRAINT `kendaraan_fk3` FOREIGN KEY (`created_by`) REFERENCES `Users`(`id`);

ALTER TABLE `kendaraan` ADD CONSTRAINT `kendaraan_fk4` FOREIGN KEY (`updated_by`) REFERENCES `Users`(`id`);

ALTER TABLE `transaksi_kendaraan` ADD CONSTRAINT `transaksi_kendaraan_fk0` FOREIGN KEY (`id`) REFERENCES `Users`(`id`);

ALTER TABLE `transaksi_kendaraan` ADD CONSTRAINT `transaksi_kendaraan_fk1` FOREIGN KEY (`no_plat`) REFERENCES `kendaraan`(`no_plat`);

ALTER TABLE `transaksi_kendaraan` ADD CONSTRAINT `transaksi_kendaraan_fk2` FOREIGN KEY (`id_status`) REFERENCES `keterangan`(`id_status`);

ALTER TABLE `transaksi_kendaraan` ADD CONSTRAINT `transaksi_kendaraan_fk3` FOREIGN KEY (`created_by`) REFERENCES `Users`(`id`);

ALTER TABLE `transaksi_kendaraan` ADD CONSTRAINT `transaksi_kendaraan_fk4` FOREIGN KEY (`update_by`) REFERENCES `Users`(`id`);

ALTER TABLE `jabatan` ADD CONSTRAINT `jabatan_fk0` FOREIGN KEY (`created_by`) REFERENCES `Users`(`id`);

ALTER TABLE `jabatan` ADD CONSTRAINT `jabatan_fk1` FOREIGN KEY (`updated_by`) REFERENCES `Users`(`id`);

ALTER TABLE `jns_kendaraan` ADD CONSTRAINT `jns_kendaraan_fk0` FOREIGN KEY (`created_by`) REFERENCES `Users`(`id`);

ALTER TABLE `jns_kendaraan` ADD CONSTRAINT `jns_kendaraan_fk1` FOREIGN KEY (`updated_by`) REFERENCES `Users`(`id`);

ALTER TABLE `model_kendaraan` ADD CONSTRAINT `model_kendaraan_fk0` FOREIGN KEY (`created_by`) REFERENCES `Users`(`id`);

ALTER TABLE `model_kendaraan` ADD CONSTRAINT `model_kendaraan_fk1` FOREIGN KEY (`updated_by`) REFERENCES `Users`(`id`);

ALTER TABLE `keterangan` ADD CONSTRAINT `keterangan_fk0` FOREIGN KEY (`created_by`) REFERENCES `Users`(`id`);

ALTER TABLE `keterangan` ADD CONSTRAINT `keterangan_fk1` FOREIGN KEY (`updated_by`) REFERENCES `Users`(`id`);








