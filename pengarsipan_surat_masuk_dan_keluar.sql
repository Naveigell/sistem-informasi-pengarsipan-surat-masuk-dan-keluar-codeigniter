-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2021 at 02:19 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengarsipan_surat_masuk_dan_keluar`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbuser`
--

CREATE TABLE `tbuser` (
  `user_id` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `role` enum('admin','pegawai') NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(64) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbuser`
--

INSERT INTO `tbuser` (`user_id`, `username`, `password`, `nama_lengkap`, `email`, `phone`, `role`, `last_login`, `photo`, `created_at`, `is_active`) VALUES
(1, 'pegawai', '$2y$10$g1a1JE8luJfz/Z9v9IPVY.4kTwqHULwpx5jufenD6ZVHcZF87BLeC', 'Bill Gates', 'pegawai123@gmail.com', '082340800182', 'pegawai', '2021-07-22 06:15:58', '60dbf22260a1a.png', '2021-06-29 11:06:45', 1),
(3, 'admin12345', '$2y$10$oIly.nIQ2gPRZOz7cm3zSu6KwsfZXq2O8Eh0NYxt55MV.MFjfCbYC', 'Elon Musk', 'admin@gmail.com1', '083119646837', 'admin', '2021-06-29 22:28:19', '60dbf39a21a3c.png', '2021-06-29 11:06:45', 1),
(7, 'tokohp900', '$2y$10$HE6OoVdbT9pPhVrcKCg.Uu1mtetd8dVQBNOKt8tLkxCdTeVysevE6', 'Steve Jobs', 'tokohp90@gmail.com', '085155392431', 'pegawai', '2021-07-22 05:56:10', '60dbf3baad686.png', '2021-06-30 04:30:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_suratkeluar`
--

CREATE TABLE `tb_suratkeluar` (
  `id_sk` int(11) NOT NULL,
  `no_surat` varchar(64) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `pengirim` varchar(64) NOT NULL,
  `tanggal_sk` date NOT NULL,
  `tujuan` varchar(255) NOT NULL,
  `lampiran` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_suratkeluar`
--

INSERT INTO `tb_suratkeluar` (`id_sk`, `no_surat`, `perihal`, `pengirim`, `tanggal_sk`, `tujuan`, `lampiran`) VALUES
(4, 'SK/SK/10/1999', 'Surat surat keluar', 'not implemented yet nowwowwowowowo', '2021-06-30', 'WHO Big Pharma', '60db0aedcd0c420210629135837.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tb_suratmasuk`
--

CREATE TABLE `tb_suratmasuk` (
  `id_sm` int(11) NOT NULL,
  `no_surat` varchar(64) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `pengirim_id` int(11) NOT NULL,
  `penerima_id` int(11) NOT NULL,
  `no_hp` varchar(64) NOT NULL,
  `tanggal_sm` date NOT NULL DEFAULT current_timestamp(),
  `dibaca` tinyint(1) NOT NULL DEFAULT 0,
  `lampiran` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_suratmasuk`
--

INSERT INTO `tb_suratmasuk` (`id_sm`, `no_surat`, `perihal`, `pengirim_id`, `penerima_id`, `no_hp`, `tanggal_sm`, `dibaca`, `lampiran`) VALUES
(30, 'SM/SM/8/2/2/2', 'Permohonan depopulasi', 1, 7, '08192378124', '2021-07-14', 0, '60f909d4e1ef320210807012256.pdf'),
(31, 'SK/SK/10/2021', 'Permohonan depopulasi', 7, 7, '0985552231314', '2021-07-09', 1, '60f9618ce1fe620210722141612.pdf'),
(32, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '0985552231314', '2021-07-17', 1, '60f90baf9b71320210807092251.pdf'),
(33, 'SM/SM/8/2/2/2', 'Permohonan depopulasi', 7, 1, '08192378124', '2021-07-01', 1, '60f911d69381f20210807362206.pdf'),
(34, 'SM/SM/8/2/2/2', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-08', 0, '60f9134ce6ce820210807422220.pdf'),
(35, 'SM/SM/1/1999', 'perihal adalah sebuah perihal', 7, 1, '08192378124', '2021-07-23', 1, '60f913ca7e90a20210807442226.pdf'),
(36, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-19', 1, '60f914179714920210807452243.pdf'),
(37, 'SM/SM/8/2/2/2', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-10', 0, '60f914368ee3420210807462214.pdf'),
(38, 'SM/SM/8/2/2/2', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-10', 0, '60f91478441e520210807472220.pdf'),
(39, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-16', 1, '60f91592b6f2520210807522202.pdf'),
(40, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-16', 1, '60f915b24193b20210807522234.pdf'),
(41, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-16', 0, '60f915d17010920210807532205.pdf'),
(42, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-16', 0, '60f9161e8eccd20210807542222.pdf'),
(43, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-16', 0, '60f9171fe86de20210807582239.pdf'),
(44, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-16', 0, '60f917695e37c20210807592253.pdf'),
(45, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-16', 0, '60f918130aecf20210907022243.pdf'),
(46, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-16', 0, '60f918410399620210907032229.pdf'),
(47, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-16', 0, '60f918d95cf9e20210907062201.pdf'),
(48, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-16', 0, '60f9194b8678520210907072255.pdf'),
(49, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-16', 0, '60f919819648a20210907082249.pdf'),
(50, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-16', 0, '60f919b2d43fc20210907092238.pdf'),
(51, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-16', 0, '60f91b08b01ce20210907152220.pdf'),
(52, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-16', 0, '60f91b7a39e9920210907172214.pdf'),
(53, 'SM/SM/1/1999', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-16', 0, '60f91bcba407b20210907182235.pdf'),
(54, 'SM/SM/8/2/2/2', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-09', 0, '60f95cebca18820211307562227.pdf'),
(55, 'SM/SM/8/2/2/2', 'Permohonan depopulasi', 7, 1, '08192374154', '2021-07-09', 0, '60f95d169d9f320211307572210.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `telegram_users`
--

CREATE TABLE `telegram_users` (
  `id_telegram_users` bigint(20) UNSIGNED NOT NULL,
  `chat_id` bigint(20) UNSIGNED NOT NULL,
  `id_tbuser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `telegram_users`
--

INSERT INTO `telegram_users` (`id_telegram_users`, `chat_id`, `id_tbuser`) VALUES
(9, 1661356833, 7),
(11, 1800304707, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbuser`
--
ALTER TABLE `tbuser`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `tb_suratkeluar`
--
ALTER TABLE `tb_suratkeluar`
  ADD PRIMARY KEY (`id_sk`);

--
-- Indexes for table `tb_suratmasuk`
--
ALTER TABLE `tb_suratmasuk`
  ADD PRIMARY KEY (`id_sm`);

--
-- Indexes for table `telegram_users`
--
ALTER TABLE `telegram_users`
  ADD PRIMARY KEY (`id_telegram_users`),
  ADD UNIQUE KEY `chat_id` (`chat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbuser`
--
ALTER TABLE `tbuser`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tb_suratkeluar`
--
ALTER TABLE `tb_suratkeluar`
  MODIFY `id_sk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_suratmasuk`
--
ALTER TABLE `tb_suratmasuk`
  MODIFY `id_sm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `telegram_users`
--
ALTER TABLE `telegram_users`
  MODIFY `id_telegram_users` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
