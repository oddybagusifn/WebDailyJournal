-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2025 at 10:55 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webdailyjournal`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `judul` text DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(1, 'Perpustakaan Kampus', 'Perpustakaan yang ada di kampus Udinus', '20250112161101.jpg', '2025-01-12 16:11:01', NULL),
(2, 'Ruang Kelas', 'Ruang kelas yang rapi dan bagus yang ada di Udinus.', '20250112161312.jpg', '2025-01-12 16:13:12', NULL),
(4, 'Auditorium', 'Auditorium yang ada di kampus Udinus', '20250112161029.jpg', '2025-01-12 16:10:29', NULL),
(7, 'Ruang Labs', 'Ruang Labs', '20250112160754.jpg', '2025-01-12 16:07:54', NULL),
(9, 'Aula', 'Aula yang ada di Udinus', '20250112160718.jpg', '2025-01-12 16:07:18', NULL),
(11, 'Gedung H', 'Ini merupakan gedung untuk Fakultas Ilmu Komputer', '20250112160631.jpg', '2025-01-12 16:06:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `desc` text NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `image`, `desc`, `tanggal`) VALUES
(1, '20250112162140.jpeg', 'Sulap Makanan Kaki Lima jadi Ala Resto, Mahasiswi FIB Udinus Kantongi Juara', '2025-01-11 20:44:47'),
(3, '20250112162220.jpeg', 'RMIK Udinus Sukses Raih Juara di Berbagai Kategori pada Medical Record Olympic', '2025-01-11 20:44:47'),
(4, '20250112162102.jpg', 'Bukakata.Id Dari Udinus Berhasil Dapatkan Pendanaan $6500 Dollar', '2025-01-11 20:45:06'),
(9, '20250112162002.jpg', 'Angkat Industri Kreatif lewat Animasi, Tim Mahasiswa Animasi Udinus Raih Juara 1', '2025-01-11 21:30:00'),
(15, '20250112161828.jpeg', 'Clean Sheet di 5 Pertandingan, Atlet Sepak Bola Udinus Raih Juara di Humanion Cup 2024', '2025-01-11 22:02:29'),
(16, '20250112161628.jpeg', 'UKM Karate Udinus Tutup Kalender 2024 Sumbangkan 17 Medali di WTA Championship Piala Kemenpora 2024', '2025-01-11 22:04:46');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `foto` text NOT NULL,
  `role` enum('admin','user','guest','') NOT NULL DEFAULT 'user',
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `foto`, `role`, `description`) VALUES
(3, 'oddybagusifn', '827ccb0eea8a706c4c34a16891f84e7b', '20250112162527.jpg', 'admin', ''),
(4, 'danny', '21232f297a57a5a743894a0e4a801fc3', '20250112162618.jpeg', 'admin', ''),
(7, 'bambang', '827ccb0eea8a706c4c34a16891f84e7b', '433559453_1430332434264265_5318608047335424388_n.png', 'user', '12345'),
(8, 'Megawati', '174a3f4fa44c7bb22b3b6429cb4ea44c', '20250112162853.jpg', 'user', ''),
(9, 'prabowo', '827ccb0eea8a706c4c34a16891f84e7b', '20250112162647.png', 'user', ''),
(10, 'jokowi', '827ccb0eea8a706c4c34a16891f84e7b', '20250112162740.jpeg', 'user', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
