-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2024 at 06:46 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.39

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pkl`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_admin`
--

CREATE TABLE `data_admin` (
  `id_pengguna` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_admin`
--

INSERT INTO `data_admin` (`id_pengguna`, `username`, `password`) VALUES
(1, '1', '1'),
(2, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `data_pegawai`
--

CREATE TABLE `data_pegawai` (
  `nomor` int(100) NOT NULL,
  `nip` int(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_pegawai`
--

INSERT INTO `data_pegawai` (`nomor`, `nip`, `nama`, `jabatan`) VALUES
(1, 1111, 'abdullah', 'kepala');

-- --------------------------------------------------------

--
-- Table structure for table `input_kwitansi`
--

CREATE TABLE `input_kwitansi` (
  `nomor` int(100) NOT NULL,
  `id_surat` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `kepada` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `jumlah_bayar` varchar(100) NOT NULL,
  `upload` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `input_kwitansi`
--

INSERT INTO `input_kwitansi` (`nomor`, `id_surat`, `tanggal`, `kepada`, `keterangan`, `jumlah_bayar`, `upload`) VALUES
(1, '111', '2024-06-21', 'abc', 'abc', '200', ''),
(2, '222', '2024-06-22', 'cde', 'cde', '100', 'uploads/Gambar WhatsApp 2023-10-21 pukul 00.18.33_f4a08ecf.jpg'),
(3, '000402', '2024-06-23', 'kumham', 'kumham', '100', 'uploads/Gambar WhatsApp 2024-01-31 pukul 17.43.14_43fd5a3a.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_admin`
--
ALTER TABLE `data_admin`
  ADD PRIMARY KEY (`id_pengguna`);

--
-- Indexes for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  ADD PRIMARY KEY (`nomor`);

--
-- Indexes for table `input_kwitansi`
--
ALTER TABLE `input_kwitansi`
  ADD PRIMARY KEY (`nomor`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_admin`
--
ALTER TABLE `data_admin`
  MODIFY `id_pengguna` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_pegawai`
--
ALTER TABLE `data_pegawai`
  MODIFY `nomor` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `input_kwitansi`
--
ALTER TABLE `input_kwitansi`
  MODIFY `nomor` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
