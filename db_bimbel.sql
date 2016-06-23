-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jun 24, 2016 at 03:02 AM
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
  `activation_code` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--
-- --------------------------------------------------------

--
-- Table structure for table `users_wids`
--

CREATE TABLE `users_wids` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `wids` int(11) NOT NULL,
  `tgl_update` datetime NOT NULL,
  `action` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelajaran`
--
ALTER TABLE `pelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pelajaran_jawaban`
--
ALTER TABLE `pelajaran_jawaban`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `pelajaran_jawaban_reponse`
--
ALTER TABLE `pelajaran_jawaban_reponse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pelajaran_pertanyaan`
--
ALTER TABLE `pelajaran_pertanyaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users_wids`
--
ALTER TABLE `users_wids`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;