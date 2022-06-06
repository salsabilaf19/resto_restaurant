-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2021 at 11:49 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_restoran`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `Kode` varchar(11) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `kategori` varchar(250) NOT NULL,
  `Harga` int(11) NOT NULL,
  `statuss` varchar(10) NOT NULL,
  `desk` varchar(500) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`Kode`, `Nama`, `kategori`, `Harga`, `statuss`, `desk`, `img`) VALUES
('A01', 'Mie Ayam Pangsit', 'Makanan', 15000, 'Tersedia', 'Mie ayam dengan isian ayam dan jamur dengan tambahan pangsit', ''),
('A02', 'Nasi Goreng Seafood', 'Makanan', 24000, 'Habis', 'Nasi goreng dengan isian cumi, udang, dan ikan', ''),
('A03', 'Burger Beef', 'Makanan', 14000, '', 'Burger dengan isian daging beef', '737545_720.jpg'),
('I01', 'Milkshake Coklat', 'Minuman', 12000, 'Tersedia', 'Milkshake rasa coklat dengan toping ice cream coklat', ''),
('L01', 'Kentang goreng', 'Lainnya', 8000, 'Tersedia', 'Kentang goreng rasa original', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`Kode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
