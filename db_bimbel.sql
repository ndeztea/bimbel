-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 06, 2016 at 11:25 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_bimbel`
--

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran`
--

CREATE TABLE `pelajaran` (
  `id` int(11) NOT NULL,
  `pelajaran` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `params` text NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelajaran`
--

INSERT INTO `pelajaran` (`id`, `pelajaran`, `deskripsi`, `params`, `is_active`) VALUES
(1, 'Matematika', 'Matematika', 'fa-book', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran_jawaban`
--

CREATE TABLE `pelajaran_jawaban` (
  `id` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `jawaban` text NOT NULL,
  `wids` int(11) DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `jml_like` int(11) DEFAULT '0',
  `jml_dislike` int(11) DEFAULT '0',
  `is_correct` enum('0','1') NOT NULL DEFAULT '0',
  `photo` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelajaran_jawaban`
--

INSERT INTO `pelajaran_jawaban` (`id`, `id_pertanyaan`, `jawaban`, `wids`, `id_user`, `tgl_update`, `jml_like`, `jml_dislike`, `is_correct`, `photo`) VALUES
(3, 1, '<p>Test</p>\r\n', NULL, 2, '2016-07-15 19:54:23', 0, 0, '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran_jawaban_reponse`
--

CREATE TABLE `pelajaran_jawaban_reponse` (
  `id` int(11) NOT NULL,
  `id_jawaban` int(11) NOT NULL,
  `reponse` enum('like','unlike') NOT NULL,
  `tgl_update` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelajaran_pertanyaan`
--

CREATE TABLE `pelajaran_pertanyaan` (
  `id` int(11) NOT NULL,
  `id_pelajaran` int(11) NOT NULL,
  `tingkat` enum('SD','SMP','SMA','SMK') NOT NULL,
  `pertanyaan` text NOT NULL,
  `wids` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tgl_update` datetime NOT NULL,
  `jml_jawab` int(11) NOT NULL,
  `photo` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelajaran_pertanyaan`
--

INSERT INTO `pelajaran_pertanyaan` (`id`, `id_pelajaran`, `tingkat`, `pertanyaan`, `wids`, `id_user`, `tgl_update`, `jml_jawab`, `photo`) VALUES
(1, 1, 'SD', '<p>Test</p>\r\n', 0, 1, '2016-07-16 02:20:55', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reseller`
--

CREATE TABLE `reseller` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text,
  `no_hp` varchar(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `is_approved` int(1) NOT NULL DEFAULT '0' COMMENT 'update ini jika telah di approve',
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reseller`
--

INSERT INTO `reseller` (`id`, `nama`, `alamat`, `no_hp`, `id_user`, `is_approved`, `tgl_update`) VALUES
(1, 'Wow', 'Yes', '08122080204', NULL, 0, '2016-08-03 16:40:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nisn` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tingkat_sekolah` enum('SD','SMP','SMA','SMK') NOT NULL,
  `nama_sekolah` varchar(100) NOT NULL,
  `kelas` int(50) NOT NULL,
  `hp` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `rekening_bank` varchar(100) DEFAULT NULL,
  `avatar` varchar(50) DEFAULT 'default.jpg',
  `wids` int(11) NOT NULL DEFAULT '0',
  `is_active` int(1) NOT NULL,
  `activation_code` varchar(100) DEFAULT NULL,
  `level` int(1) NOT NULL DEFAULT '2'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nisn`, `nama`, `gender`, `password`, `tingkat_sekolah`, `nama_sekolah`, `kelas`, `hp`, `email`, `rekening_bank`, `avatar`, `wids`, `is_active`, `activation_code`, `level`) VALUES
(1, '111210096', 'Rizky Fauzy Tahir', 'l', '767b06fceddb23e9c6091f02049dfbd911afb52a', 'SMK', 'SMK PASIM Plus Sukabumi', 12, '08122080204', 'rizkytahir96@gmail.com', '', 'bdaad0d91cc05dd2ea8fe22a3aa726c9.jpg', 8, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_wids`
--

CREATE TABLE `users_wids` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `wids` int(11) NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` enum('tambah','kurang','','') NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_wids`
--

INSERT INTO `users_wids` (`id`, `id_user`, `wids`, `tgl_update`, `action`, `keterangan`) VALUES
(1, 1, 8, '2016-07-15 19:20:55', 'kurang', 'Bertanya'),
(2, 2, 30, '2016-07-15 19:51:19', 'tambah', 'Menjawab Pertanyaan'),
(3, 2, 50, '2016-07-15 19:53:44', 'tambah', 'Menjawab Pertanyaan'),
(4, 2, 50, '2016-07-15 19:54:30', 'tambah', 'Menjawab Pertanyaan'),
(5, 2, 100, '2016-07-15 19:55:35', 'tambah', 'Beli Online');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers_wids`
--

CREATE TABLE `vouchers_wids` (
  `id` int(11) NOT NULL,
  `kode_voucher` varchar(255) DEFAULT NULL,
  `wids` int(11) DEFAULT NULL,
  `telah_ditukar` int(11) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='1';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pelajaran`
--
ALTER TABLE `pelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelajaran_jawaban`
--
ALTER TABLE `pelajaran_jawaban`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `pelajaran_jawaban_reponse`
--
ALTER TABLE `pelajaran_jawaban_reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_jawaban` (`id_jawaban`);

--
-- Indexes for table `pelajaran_pertanyaan`
--
ALTER TABLE `pelajaran_pertanyaan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `reseller`
--
ALTER TABLE `reseller`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_wids`
--
ALTER TABLE `users_wids`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `vouchers_wids`
--
ALTER TABLE `vouchers_wids`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelajaran`
--
ALTER TABLE `pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pelajaran_jawaban`
--
ALTER TABLE `pelajaran_jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pelajaran_jawaban_reponse`
--
ALTER TABLE `pelajaran_jawaban_reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pelajaran_pertanyaan`
--
ALTER TABLE `pelajaran_pertanyaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `reseller`
--
ALTER TABLE `reseller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users_wids`
--
ALTER TABLE `users_wids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `vouchers_wids`
--
ALTER TABLE `vouchers_wids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;



-- ***************************
-- ***************************
-- ***************************
--   DIMAS 8 aug 2016 ---
-- ***************************
-- ***************************
ALTER TABLE `vouchers_wids` ADD `id_user` INT NOT NULL AFTER `keterangan`;

DROP TABLE IF EXISTS `reseller`;
CREATE TABLE `reseller` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `alamat` text,
  `no_hp` varchar(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `is_approved` int(1) NOT NULL DEFAULT '0' COMMENT 'update ini jika telah di approve',
  `tgl_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reseller`
--
ALTER TABLE `reseller`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reseller`
--
ALTER TABLE `reseller`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `id_user_actor` int(11) NOT NULL,
  `id_user_target` int(11) NOT NULL,
  `type` varchar(100) NOT NULL COMMENT '"jawab","betul","wids"',
  `konten` text NOT NULL,
  `tgl_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `is_emailed` int(11) NOT NULL DEFAULT '0',
  `is_viewed` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

