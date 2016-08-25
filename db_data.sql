-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 25, 2016 at 03:57 PM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_bimbel`
--

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'Superadmin'),
(2, 'Administrator'),
(3, 'Reseller'),
(4, 'Member');

--
-- Dumping data for table `pelajaran`
--

INSERT INTO `pelajaran` (`id`, `pelajaran`, `deskripsi`, `params`, `is_active`) VALUES
(1, 'Matematika', 'Matematika', 'fa-book', 1);

--
-- Dumping data for table `pelajaran_jawaban`
--

INSERT INTO `pelajaran_jawaban` (`id`, `id_pertanyaan`, `jawaban`, `wids`, `id_user`, `tgl_update`, `jml_like`, `jml_dislike`, `is_correct`, `user_set_correct`, `level_set_correct`, `photo`) VALUES
(3, 1, '<p>Test</p>\r\n', NULL, 2, '2016-07-15 19:54:23', 0, 0, '1', NULL, 0, NULL),
(4, 2, 'test?', 100, 4, '2016-08-09 08:19:19', 0, 0, '1', '1', 1, NULL),
(5, 2, 'kumlam', NULL, 6, '2016-08-09 08:19:34', 0, 0, '0', NULL, 0, NULL),
(6, 3, 'Hai', NULL, 9, '2016-08-09 08:20:37', 0, 0, '0', NULL, 0, NULL),
(7, 8, '<p>Loba dosa</p>\r\n', NULL, 8, '2016-08-09 08:32:37', 0, 0, '0', NULL, 0, NULL),
(8, 7, '<p>hmmm</p>\r\n', NULL, 5, '2016-08-09 08:33:10', 0, 0, '0', NULL, 0, NULL),
(9, 9, '<p>wios jang</p>\r\n', NULL, 5, '2016-08-09 08:35:08', 0, 0, '0', NULL, 0, NULL),
(10, 9, '<p>wios mangga</p>\r\n', NULL, 4, '2016-08-09 08:35:13', 0, 0, '0', NULL, 0, NULL),
(11, 9, '<p>teu kengeng</p>\r\n\r\n<p> </p>\r\n', NULL, 10, '2016-08-09 08:35:33', 0, 0, '0', NULL, 0, NULL),
(12, 9, '<p>wios a</p>\r\n\r\n<p> </p>\r\n', NULL, 6, '2016-08-09 08:35:36', 0, 0, '0', NULL, 0, NULL),
(13, 9, '<p>GANDENG LAH GANDENG</p>\r\n', NULL, 9, '2016-08-09 08:35:41', 0, 0, '0', NULL, 0, NULL),
(14, 9, '<p>Mangga</p>\r\n', NULL, 8, '2016-08-09 08:36:04', 0, 0, '0', NULL, 0, NULL),
(15, 7, '<p>Udah di benerin daa</p>\r\n', NULL, 1, '2016-08-09 08:38:12', 0, 0, '0', NULL, 0, NULL),
(16, 9, '<p>Manfaat kan aplikasi <strong>DENGAN BAIK !!!</strong></p>\r\n', NULL, 1, '2016-08-09 08:38:50', 0, 0, '0', NULL, 0, NULL),
(17, 9, '<p>SIAP KOMANDANNNN !!!!</p>\r\n', NULL, 5, '2016-08-09 08:40:06', 0, 0, '0', NULL, 0, NULL),
(18, 9, '<p>siap komandan di bagian edit coment masih ada coding nya nampak</p>\r\n\r\n<p> </p>\r\n', NULL, 4, '2016-08-09 08:40:11', 0, 0, '1', NULL, 0, NULL),
(19, 9, '<p>Sudah di perbaiki..</p>\r\n', NULL, 1, '2016-08-09 08:41:06', 0, 0, '0', NULL, 0, NULL),
(20, 11, '<p>Udah bray</p>\r\n', NULL, 1, '2016-08-09 08:42:24', 0, 0, '0', NULL, 0, NULL),
(21, 19, '<p>katjang</p>\r\n', 100, 5, '2016-08-09 08:52:59', 0, 0, '1', '1', 1, NULL),
(22, 18, '<p>Katjang</p>\r\n', NULL, 9, '2016-08-09 08:53:07', 0, 0, '1', NULL, 1, NULL),
(23, 19, '<p>Kela waa klaaa</p>\r\n', NULL, 1, '2016-08-09 08:58:05', 0, 0, '0', NULL, 0, '9c7944a940c35b277ec6a02b333340bd.png'),
(24, 32, '<p>katjang</p>\r\n', NULL, 9, '2016-08-10 05:17:41', 0, 0, '1', NULL, 1, NULL),
(26, 32, '<p>url(../namafolder/namaimage(.jpg/atau apalah)</p>\r\n', NULL, 7, '2016-08-11 04:32:18', 0, 0, '1', NULL, 1, NULL),
(27, 32, '<p>ooh</p>\r\n', NULL, 1, '2016-08-12 17:04:24', 0, 0, '0', NULL, 0, NULL),
(28, 32, '<p>Test</p>\r\n', NULL, 3, '2016-08-12 17:17:53', 0, 0, '0', NULL, 0, NULL),
(29, 31, '<p>Ohh kitu</p>\r\n', NULL, 3, '2016-08-12 17:20:24', 0, 0, '1', NULL, 0, NULL),
(30, 33, '<p>Ganti aja color nya</p>\r\n', NULL, 3, '2016-08-12 17:35:52', 0, 0, '1', NULL, NULL, NULL),
(31, 33, '<p>test</p>\r\n', NULL, 1, '2016-08-17 07:38:45', 0, 0, '1', NULL, NULL, NULL),
(32, 30, '<p>test</p>\r\n', NULL, 1, '2016-08-19 09:48:50', 0, 0, '1', NULL, NULL, 'ea0c2bb712f1493073b83080de425974.jpg'),
(33, 31, '<p>Nyoba jawab</p>\r\n', 20, 11, '2016-08-19 21:09:42', 0, 0, '1', '1', 1, NULL),
(34, 30, '<p>Nyoba jawab lagi</p>\r\n', 200, 11, '2016-08-19 21:12:25', 0, 0, '1', '1', 1, NULL),
(35, 26, '<p>Yaaa</p>\r\n', 690, 11, '2016-08-24 04:49:16', 0, 0, '1', '1', 1, NULL),
(36, 26, '<p>TEst</p>\r\n', 0, 11, '2016-08-24 05:22:18', 0, 0, '1', '3', 2, NULL),
(37, 29, '<p>Test wids</p>\r\n', 150, 11, '2016-08-25 08:03:30', 0, 0, '1', '1', 1, NULL);

--
-- Dumping data for table `pelajaran_pertanyaan`
--

INSERT INTO `pelajaran_pertanyaan` (`id`, `id_pelajaran`, `tingkat`, `pertanyaan`, `wids`, `id_user`, `tgl_update`, `jml_jawab`, `photo`) VALUES
(2, 1, 'SMK', '<p>samlekom</p>\r\n', 0, 5, '2016-08-09 15:18:51', 0, NULL),
(3, 1, 'SMK', '<p>HALLO</p>\r\n', 0, 8, '2016-08-09 15:19:57', 0, NULL),
(4, 1, 'SD', '<p>Call to a member function row_array() on boolean in <strong>/Applications/MAMP/htdocs/bimbel/application/controllers/Pertanyaan.php</strong> on line <strong>160</strong></p>\r\n', 0, 6, '2016-08-09 15:22:00', 0, NULL),
(5, 1, 'SD', '<p>http://192.168.1.18/bimbel/add_reseller</p>\r\n', 0, 9, '2016-08-09 15:28:26', 0, 'c86c5d69dad6360bd1c19c5d572c4efc.png'),
(6, 1, 'SD', '<p>http://192.168.1.18/bimbel/add_reseller</p>\r\n', 0, 9, '2016-08-09 15:28:26', 0, 'c86c5d69dad6360bd1c19c5d572c4efc.png'),
(7, 1, 'SD', '<p>http://192.168.1.18/bimbel/detail_pertanyaan/add_reseller</p>\r\n', 0, 4, '2016-08-09 15:30:21', 0, 'dadade659498eb76ac18641a78db7258.png'),
(8, 1, 'SD', '<p>http://192.168.1.18/bimbel/detail_pertanyaan/add_reseller</p>\r\n', 0, 4, '2016-08-09 15:30:21', 0, 'dadade659498eb76ac18641a78db7258.png'),
(9, 1, 'SMK', '<p>Kang abdi bade nga desain engke kirim kadie wios teu? :)</p>\r\n', 0, 7, '2016-08-09 15:34:45', 0, NULL),
(12, 1, 'SMK', '<p>Coba ajukan pertanyaan pake gambar</p>\r\n', 0, 1, '2016-08-09 15:48:49', 0, '1f229a99bc1948bca5701331e85a3d02.png'),
(11, 1, 'SD', '<p>pas ngedit comment kang</p>\r\n', 0, 9, '2016-08-09 15:40:00', 0, '500bb466140a81a02469ffa45c7b2906.png'),
(13, 1, 'SMK', '<p>Coba ajukan pertanyaan pake gambar</p>\r\n', 0, 1, '2016-08-09 15:48:49', 0, '1f229a99bc1948bca5701331e85a3d02.png'),
(16, 1, 'SD', '<p>pertanyaan bergambar</p>\r\n', 0, 9, '2016-08-09 15:51:31', 0, '0803951b9fe8f0a221aeacaf4eb9fec2.jpg'),
(23, 1, 'SD', '<p>Test2222</p>\r\n', 0, 1, '2016-08-09 16:03:26', 0, 'b41452580630487f4801e62d44189b35.png'),
(18, 1, 'SD', '<p>kang</p>\r\n\r\n<p>http://192.168.1.18/bimbel/update_password</p>\r\n\r\n<p>pas pencet kembali ga bisa</p>\r\n', 0, 5, '2016-08-09 15:51:56', 0, NULL),
(19, 1, 'SD', '<p>sekali mengirim pertanyaan bergambar<br>\r\nkekirimnya 2</p>\r\n', 0, 9, '2016-08-09 15:52:22', 0, NULL),
(22, 1, 'SD', '<p>Test22</p>\r\n', 0, 1, '2016-08-09 16:02:16', 0, 'afe1d624b9a83cb4e98d1d7916f75240.png'),
(24, 1, 'SD', '<p>Test2222</p>\r\n', 0, 1, '2016-08-09 16:03:26', 0, 'b41452580630487f4801e62d44189b35.png'),
(25, 1, 'SD', '<p>wowoww</p>\r\n', 0, 1, '2016-08-09 16:04:53', 0, NULL),
(26, 1, 'SD', '<p>Ehemm</p>\r\n', 0, 1, '2016-08-09 16:05:45', 0, 'f40a3b9fe431937fc6bf45b82a2cedce.png'),
(27, 1, 'SD', '<p>Ehemm</p>\r\n', 0, 1, '2016-08-09 16:05:45', 0, 'f40a3b9fe431937fc6bf45b82a2cedce.png'),
(28, 1, 'SD', '<p>vhjljhv</p>\r\n', 0, 1, '2016-08-09 16:06:30', 0, '92f3be18dd06cdd4261da63eff623a0d.png'),
(29, 1, 'SD', '<p>vhjljhv</p>\r\n', 0, 1, '2016-08-09 16:07:17', 0, 'a20e38b01f26d644ad5efa662d794620.png'),
(30, 1, 'SD', '<p>vhjljhv</p>\r\n', 0, 1, '2016-08-09 16:10:22', 0, 'd0182c7c13a98cb37982e536ca37ef40.png'),
(31, 1, 'SD', '<p>Persib1</p>\r\n', 0, 1, '2016-08-09 16:14:37', 0, '288f88d7ce59422e6f071c495c75c7b1.png'),
(32, 1, 'SMK', '<p>Ada yang tau cara menggunakan background gambar pada CI menggunakan Bootstrap??</p>\r\n', 0, 8, '2016-08-10 10:09:39', 0, NULL),
(33, 1, 'SD', '<p>Kang cara nge ganti warna font yang ada di navbar-header gimana? udah ngulik tapi blm ketemu</p>\r\n', 0, 7, '2016-08-11 11:33:23', 0, NULL);

--
-- Dumping data for table `reseller`
--

INSERT INTO `reseller` (`id`, `nama`, `alamat`, `no_hp`, `id_user`, `is_approved`, `tgl_update`) VALUES
(7, 'Rizky Fauzy Tahir', 'Cimahi', '08122080204', 11, 1, '2016-08-15 17:19:15');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nisn`, `nama`, `gender`, `password`, `tingkat_sekolah`, `nama_sekolah`, `kelas`, `hp`, `email`, `rekening_bank`, `avatar`, `wids`, `is_active`, `activation_code`, `level`, `user_parent`, `kode_daftar`) VALUES
(1, '111210096', 'Rizky Fauzy Tahir', 'l', '767b06fceddb23e9c6091f02049dfbd911afb52a', 'SMK', 'SMK PASIM Plus Sukabumi', 10, '08122080204', 'rizkytahir96@gmail.com', '', 'dcdfeb0dbe73d64bc67895f1a945eb57.jpg', 80, 1, NULL, 1, '', 'tc2ivaQnJW'),
(3, '0909090909', 'Rafatia Dwi Pramesti', 'l', '767b06fceddb23e9c6091f02049dfbd911afb52a', 'SMK', 'SMKN 1 Katapang', 12, '08965456256', 'rafadwi64@yahoo.com', '080808080808008', 'default-male.png', 10, 1, NULL, 2, '', ''),
(4, '123123', 'Anggiat Gustivo', 'l', '52dae2695b847510a87a2bf8c3ba7a486125c36e', 'SMK', 'CCA', 12, '0882761618719', 'anggiat.gustavo1@gmail.com', '1339611', 'b1d7f202800179dd5a2f8739ed0d8055.jpg', 1207, 1, NULL, 4, '', ''),
(5, '192168118', 'syamsul', 'l', '696d4760f924c40199340aee640f53b0e710c67b', 'SMK', 'smk pusdikhub', 10, '085284177555', 'samsul.bahari23@gmail.com', '', '74a0e59f3b2f7afe1be45ba02275dc0e.jpg', 1305, 1, NULL, 4, '', ''),
(6, '000896768', 'Fadhil Muhammad Faishal', 'l', 'fe30154863c24700d03806a10d4e29e7135c4ea4', 'SMK', 'SMK PUSDIKHUBAD CIMAHI', 10, '087823114615', 'ical1601@gmail.com', '000896768', 'default-male.png', 1007, 1, NULL, 4, '', ''),
(7, '9996547222', 'Azhar Ryad', 'l', 'c59bbdb03ba38600664f923ab44212bfc12e27d6', 'SMK', 'SMK TI Garuda Nusantara Cimahi', 12, '08977515391', 'azhar.ryad12@gmail.com', '', '5d7c5ba8cf826eb6c2610ec7620559e3.jpg', 1105, 1, NULL, 4, '', ''),
(8, '9988645812', 'Rendy Ichtiar Saputra', 'l', '49bc282c5b62de8366aa94049a83fc4c2699f8a4', 'SMK', 'SMK TI GNC', 12, '083821721484', 'rendyichtiar97@gmail.com', '', 'cde75d29dd464706dacb244b0240eff9.jpg', 1005, 1, NULL, 3, '', ''),
(9, '1001', 'Raka Bagoes Herlambang', 'l', '629fffca0eb23e22550801ad3f66841a382b611b', 'SMK', 'SMK Pusdikhubad', 10, '089648759029', 'raka.shuu9@gmail.com', '', '350b2b3162c922ec080e6585666e50f0.jpg', 1299, 1, NULL, 4, '008880888', ''),
(10, '9991457193', 'Dicki Gendra Erlangga', 'l', 'c90cddd19d82da7f55d10745a53288ed0968ff24', 'SMK', 'SMK - TI GNC', 12, '08973748775', 'dicki.gendra@gmail.com', '1110002112', 'default-male.png', 1009, 1, NULL, 4, '008880888', ''),
(11, '008880888', 'Rizky Fauzy Tahir 2', 'l', 'e9757547d65e97fb6fc8294b72fdbb9a71624c1d', 'SMK', 'SMK PASIM Plus Sukabumi', 12, '08122080204', 'tahier.gazerock@gmail.com', '', '18b38014e13f8c9026a3ae8c74f0dada.jpg', 800, 1, NULL, 4, '111210096', 'Fl7du6K4Xw');

--
-- Dumping data for table `users_wids`
--

INSERT INTO `users_wids` (`id`, `id_user`, `wids`, `tgl_update`, `action`, `keterangan`) VALUES
(1, 1, 8, '2016-07-15 19:20:55', 'kurang', 'Bertanya'),
(2, 2, 30, '2016-07-15 19:51:19', 'tambah', 'Menjawab Pertanyaan'),
(3, 2, 50, '2016-07-15 19:53:44', 'tambah', 'Menjawab Pertanyaan'),
(4, 2, 50, '2016-07-15 19:54:30', 'tambah', 'Menjawab Pertanyaan'),
(5, 2, 100, '2016-07-15 19:55:35', 'tambah', 'Beli Online'),
(6, 5, 8, '2016-08-09 08:18:51', 'kurang', 'Bertanya'),
(7, 8, 8, '2016-08-09 08:19:57', 'kurang', 'Bertanya'),
(8, 6, 8, '2016-08-09 08:22:00', 'kurang', 'Bertanya'),
(9, 5, 999, '2016-08-09 08:27:48', 'tambah', 'Beli Online'),
(10, 8, 999, '2016-08-09 08:28:21', 'tambah', 'Beli Online'),
(11, 9, 8, '2016-08-09 08:28:26', 'kurang', ''),
(12, 9, 999, '2016-08-09 08:28:40', 'tambah', 'Beli Online'),
(13, 6, 999, '2016-08-09 08:28:58', 'tambah', 'Beli Online'),
(14, 10, 999, '2016-08-09 08:29:13', 'tambah', 'Beli Online'),
(15, 7, 999, '2016-08-09 08:29:30', 'tambah', 'Beli Online'),
(16, 4, 999, '2016-08-09 08:29:47', 'tambah', 'Beli Online'),
(17, 4, 1007, '2016-08-09 08:30:21', 'kurang', ''),
(18, 7, 1007, '2016-08-09 08:34:45', 'kurang', 'Bertanya'),
(19, 9, 1005, '2016-08-09 08:40:00', 'kurang', ''),
(20, 4, 100, '2016-08-09 08:40:54', 'tambah', 'Menjawab Pertanyaan'),
(21, 1, 6, '2016-08-09 08:48:49', 'kurang', ''),
(22, 9, 1003, '2016-08-09 08:49:43', 'kurang', ''),
(23, 9, 1001, '2016-08-09 08:51:31', 'kurang', ''),
(24, 5, 1005, '2016-08-09 08:51:56', 'kurang', 'Bertanya'),
(25, 9, 999, '2016-08-09 08:52:22', 'kurang', 'Bertanya'),
(26, 1, 4, '2016-08-09 08:59:05', 'kurang', ''),
(27, 1, 2, '2016-08-09 09:03:26', 'kurang', ''),
(28, 1, 0, '2016-08-09 09:04:53', 'kurang', 'Bertanya'),
(29, 1, 1000, '2016-08-09 09:05:24', 'tambah', 'Pembelian Voucher'),
(30, 1, 998, '2016-08-09 09:05:45', 'kurang', ''),
(31, 8, 1005, '2016-08-10 03:09:39', 'kurang', 'Bertanya'),
(32, 7, 1005, '2016-08-11 04:33:23', 'kurang', 'Bertanya'),
(33, 9, 100, '2016-08-12 17:36:25', 'tambah', 'Menjawab Pertanyaan'),
(34, 5, 200, '2016-08-12 17:40:42', 'tambah', 'Menjawab Pertanyaan'),
(35, 7, 100, '2016-08-12 17:42:30', 'tambah', 'Menjawab Pertanyaan'),
(36, 9, 200, '2016-08-15 17:44:11', 'tambah', 'Menjawab Pertanyaan'),
(37, 4, 100, '2016-08-17 07:41:15', 'tambah', 'Menjawab Pertanyaan'),
(38, 5, 100, '2016-08-19 10:26:42', 'tambah', 'Menjawab Pertanyaan'),
(39, 11, 20, '2016-08-19 21:10:07', 'tambah', 'Menjawab Pertanyaan'),
(40, 11, 20, '2016-08-19 21:11:32', 'tambah', 'Menjawab Pertanyaan'),
(41, 11, 85, '2016-08-19 21:12:58', 'tambah', 'Menjawab Pertanyaan'),
(42, 11, 100, '2016-08-19 22:00:20', 'tambah', 'Update Wids Jawaban'),
(43, 11, 50, '2016-08-19 22:01:03', 'kurang', 'Update Wids Jawaban'),
(44, 11, 200, '2016-08-19 22:05:51', 'tambah', 'Update Wids Jawaban'),
(45, 11, 40, '2016-08-24 04:50:19', 'tambah', 'Menjawab Pertanyaan'),
(46, 11, 40, '2016-08-24 04:52:52', '', 'Update Wids Jawaban'),
(47, 11, 500, '2016-08-24 04:55:47', 'tambah', 'Update Wids Jawaban'),
(48, 11, 500, '2016-08-24 04:57:14', '', 'Update Wids Jawaban'),
(49, 11, 540, '2016-08-24 04:57:35', 'tambah', 'Update Wids Jawaban'),
(50, 11, 640, '2016-08-24 04:58:05', 'tambah', 'Update Wids Jawaban'),
(51, 11, 690, '2016-08-24 05:20:56', 'tambah', 'Update Wids Jawaban'),
(52, 11, 100, '2016-08-25 08:03:50', 'tambah', 'Menjawab Pertanyaan'),
(53, 11, 150, '2016-08-25 08:04:07', 'tambah', 'Update Wids Jawaban');

--
-- Dumping data for table `vouchers_wids`
--

INSERT INTO `vouchers_wids` (`id`, `kode_voucher`, `peruntukan`, `wids`, `telah_ditukar`, `tgl_update`, `keterangan`) VALUES
(1, 'XRwEFAgksw', '', 1000, 1, '2016-08-09 16:05:24', 'Beli paket'),
(2, 'fprjwZMkgu', '', 100, 0, '2016-08-16 01:04:49', 'Untuk dijual kembali'),
(3, '788MFV4xWM', '11', 3000, 0, '2016-08-16 01:08:57', 'Dijual kembali');
