-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2022 at 07:07 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek_perpus`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buku`
--

CREATE TABLE `tbl_buku` (
  `id_buku` int(11) NOT NULL,
  `buku_id` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_rak` int(11) NOT NULL,
  `sampul` varchar(255) DEFAULT NULL,
  `isbn` varchar(255) DEFAULT NULL,
  `lampiran` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `penerbit` varchar(255) DEFAULT NULL,
  `pengarang` varchar(255) DEFAULT NULL,
  `thn_buku` varchar(255) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `jml` int(11) DEFAULT NULL,
  `tgl_masuk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_buku`
--

INSERT INTO `tbl_buku` (`id_buku`, `buku_id`, `id_kategori`, `id_rak`, `sampul`, `isbn`, `lampiran`, `title`, `penerbit`, `pengarang`, `thn_buku`, `isi`, `jml`, `tgl_masuk`) VALUES
(15, 'BK002', 0, 1, 'sampul21.jpg', '2555-255-021', 'apa yaa', 'sedih yang membawa bahagia', 'arifi khofiar', 'kholida magfirah', '2020', '200', 10, '29-11-2020'),
(16, 'BK001', 0, 1, 'sampul21.jpg', '2555-255-627', 'ga ada', 'sedih yang membawa bahagia', 'arifi khofiar', 'kholida maghfirah', '2020', '250', 10, '29-11-2020'),
(17, 'BK003', 0, 1, 'sampul1221.jpg', '2555-255-212', 'ga dulu deh', 'cinta berujung di padang', 'arifi khofiar', 'kholida maghfirah', '2021', '100', 3, '29-11-2020'),
(18, 'BK006', 2, 1, 'sampul241.jpg', '2555-132-121', 'ada ', 'persiapan menuju kehidupan yang abadi', 'arifi khofiar', NULL, '2019', '350', 10, '15-12-2020'),
(19, 'BK007', 2, 1, 'sampul2221.jpg', '2555-0129-121', 'ada gak yaa', 'cint berawl dari instagram', 'arifi khofiar', NULL, '2020', '100', 10, '15-12-2020'),
(20, 'BK008', 2, 1, 'sampul0021.jpg', '2555-0129-2121', 'ada gak yaa', 'nikah yuk !!', 'khofiar child', 'kholida maghfirah', '2020', '200', 15, '22-12-2020'),
(21, 'BK008', 1, 1, 'sampul1001.jpg', '2555-111-212', 'ga ah', 'dia yang kutunggu', 'arifi khofiar', 'kholida maghfirah', '2021', '80', 30, '29-12-2020');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_denda`
--

CREATE TABLE `tbl_denda` (
  `id_denda` int(11) NOT NULL,
  `pinjam_id` varchar(255) NOT NULL,
  `denda` varchar(255) NOT NULL,
  `lama_waktu` int(11) NOT NULL,
  `tgl_denda` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_denda`
--

INSERT INTO `tbl_denda` (`id_denda`, `pinjam_id`, `denda`, `lama_waktu`, `tgl_denda`) VALUES
(7, 'PJ002', '10000', 5, '2022-12-21'),
(8, 'PJ002', '5000', 5, '2022-12-21'),
(9, 'PJ002', '5000', 5, '2022-12-21'),
(10, 'PJ003', '10000', 10, '2022-10-20'),
(11, 'PJ004', '15000', 8, '2022-11-19'),
(12, 'PJ005', '25000', 25, '2022-10-19'),
(13, 'PJ006', '20000', 20, '2022-10-20'),
(14, 'PJ005', '20000', 20, '2022-8-22'),
(15, 'PJ006', '5000', 4, '2022-9-22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id_login` int(11) NOT NULL,
  `anggota_id` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `level` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(255) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenkel` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `telepon` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tgl_bergabung` date NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id_login`, `anggota_id`, `user`, `pass`, `level`, `nama`, `tempat_lahir`, `tgl_lahir`, `jenkel`, `alamat`, `telepon`, `email`, `tgl_bergabung`, `foto`) VALUES
(5, 'AG005', 'Wulan', '202cb962ac59075b964b07152d234b70', 'Anggota', 'Wulan Nur Annisah', 'Cirebon', '2001-03-07', 'Perempuan', 'cirebon', '08142626772', 'wulan123@gmail.com', '2022-01-20', 'user_1642654498.JPG'),
(6, 'AG006', 'anto', '202cb962ac59075b964b07152d234b70', 'Anggota', 'Anto', 'PKU', '2020-11-10', 'Laki-Laki', 'PKU', '08142626772', 'anto@gmail.com', '2022-01-21', 'user_1642773058.JPG'),
(7, 'AG007', 'yunto', '202cb962ac59075b964b07152d234b70', 'Anggota', 'yunto', 'ciamis', '2001-12-19', 'laki-laki', 'bandung', '082121221', 'yunto@gmail.com', '2022-01-22', 'user_1642773058.JPG'),
(8, 'AG008', 'yahya', '202cb962ac59075b964b07152d234bj89', 'Anggota', 'yahya', 'purwakarta', '2003-12-19', 'laki-laki', 'purwakarta', '082121333', 'yahyaS@gmail.com', '2022-01-22', 'user_16427730988.JPG'),
(9, 'AG009', 'puput', '202cb962ac59075b964b07152d234bj89', 'Anggota', 'putri', 'purwakarta', '2003-10-19', 'perempuan', 'jakarta', '082121321', 'putri@gmail.com', '2022-02-22', 'user_16427730981.JPG'),
(10, 'AG010', 'ira', '202cb962ac59075b964b07152d234bj89', 'Anggota', 'fira', 'padang', '2001-10-16', 'perempuan', 'payakumbuh', '081226994610', 'fira123@gmail.com', '2022-02-21', 'user_16427730981.JPG'),
(11, 'AG011', 'lalan', '202cb962ac59075b964b07152d234bj89', 'Anggota', 'pulanah', 'cirebon', '2001-09-11', 'perempuan', 'garut', '081226994918', 'pulanah@gmail.com', '2022-03-21', 'user_16427730981.JPG');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinjam`
--

CREATE TABLE `tbl_pinjam` (
  `id_pinjam` int(11) NOT NULL,
  `pinjam_id` varchar(255) NOT NULL,
  `anggota_id` varchar(255) NOT NULL,
  `nama_buku` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `tgl_pinjam` varchar(255) NOT NULL,
  `lama_pinjam` int(11) NOT NULL,
  `tgl_balik` varchar(255) NOT NULL,
  `tgl_kembali` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pinjam`
--

INSERT INTO `tbl_pinjam` (`id_pinjam`, `pinjam_id`, `anggota_id`, `nama_buku`, `status`, `tgl_pinjam`, `lama_pinjam`, `tgl_balik`, `tgl_kembali`) VALUES
(11, 'PJ001', 'AG005', 'cinta berujung di padang', 'Di Kembalikan', '2022-01-21', 1, '2022-01-22', '2022-01-21'),
(13, 'PJ002', 'AG005', 'cinta bersemi di patok tenda', 'Di pinjam (has change)', '2022-02-21', 2, '2022-2-01', '2022-01-21'),
(14, 'PJ006', 'AG006', 'cinta berujung di padang', 'Di pinjam', '2022-05-22', 6, '2022-3-21', ''),
(15, 'PJ007', 'AG006', 'cinta berawal dari instagram', 'dikembalikan', '2022-02-22', 6, '2022-02-26', '2022-06-21'),
(16, 'PJ008', 'AG007', 'cinta berawal dari instagram', 'dipinjam', '2022-12-22', 6, '2022-12-26', ''),
(17, 'PJ009', 'AG007', 'nikah yuk !!', 'dipinjam', '2022-01-22', 6, '2022-01-26', ''),
(18, 'PJ010', 'AG008', 'cinta terhalang laut dan gunung', 'dikembalikan', '2022-05-22', 6, '2022-05-26', '2022-05-26'),
(19, 'PJ011', 'AG008', 'cinta berujung di padang', 'dikembalikan', '2022-12-20', 6, '2022-12-29', '2022-12-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `tbl_denda`
--
ALTER TABLE `tbl_denda`
  ADD PRIMARY KEY (`id_denda`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  ADD PRIMARY KEY (`id_pinjam`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_buku`
--
ALTER TABLE `tbl_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_denda`
--
ALTER TABLE `tbl_denda`
  MODIFY `id_denda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_pinjam`
--
ALTER TABLE `tbl_pinjam`
  MODIFY `id_pinjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
