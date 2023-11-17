-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 08:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ta-paw2`
--

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `ID_KARYAWAN` int(11) NOT NULL,
  `ID_ROLE` int(11) DEFAULT NULL,
  `USERNAME_KARYAWAN` varchar(30) NOT NULL,
  `PASSWORD_KARYAWAN` varchar(256) NOT NULL,
  `NAMA_KARYAWAN` varchar(100) NOT NULL,
  `NO_TELP_KARYAWAN` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`ID_KARYAWAN`, `ID_ROLE`, `USERNAME_KARYAWAN`, `PASSWORD_KARYAWAN`, `NAMA_KARYAWAN`, `NO_TELP_KARYAWAN`) VALUES
(1, 1, 'Sabil', 'b88bee669722c4d019e376cfae43af114a1170802a93cb52da702e41d70299ec', 'Sabil Ahmad Hidayat', '089785867496'),
(2, 2, 'Dani', 'db96f9a4e73f39c88edd56be2cbd90b2d9aaaaf12e3440ca53d5dc2bb10af29f', 'Syaiful Dani', '082345278654');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `KODE_KATERGORI` int(11) NOT NULL,
  `NAMA_KATEGORI` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`KODE_KATERGORI`, `NAMA_KATEGORI`) VALUES
(1, 'ramen'),
(2, 'sushi'),
(3, 'onigiri'),
(4, 'udon'),
(5, 'sashimi');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `KODE_PELANGGAN` int(11) NOT NULL,
  `KODE_MAKANAN` int(11) NOT NULL,
  `QTY` int(11) NOT NULL,
  `STATUS_K` int(11) NOT NULL,
  `CREATED_AT_K` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATE_AT_M` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `makanan`
--

CREATE TABLE `makanan` (
  `KODE_MAKANAN` int(11) NOT NULL,
  `ID_SUPPLIER` int(11) DEFAULT NULL,
  `KODE_KATERGORI` int(11) DEFAULT NULL,
  `NAMA_MAKANAN` varchar(100) NOT NULL,
  `GAMBAR_MAKANAN` varchar(255) NOT NULL,
  `HARGA_MAKANAN` int(11) NOT NULL,
  `STOK_PRODUK` int(11) NOT NULL,
  `CREATED_AT_M` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATE_AT_M` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `makanan`
--

INSERT INTO `makanan` (`KODE_MAKANAN`, `ID_SUPPLIER`, `KODE_KATERGORI`, `NAMA_MAKANAN`, `GAMBAR_MAKANAN`, `HARGA_MAKANAN`, `STOK_PRODUK`, `CREATED_AT_M`, `UPDATE_AT_M`) VALUES
(1, 1, 1, 'miso ramen', 'miso.png', 40000, 100, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(2, 1, 1, 'shio ramen', 'shio.png', 50000, 80, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(3, 1, 1, 'shoyu ramen', 'shoyu.png', 43000, 50, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(4, 1, 1, 'tantan ramen', 'tantan.png', 45000, 30, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(5, 1, 1, 'tonkotsu ramen', 'tonkotsu.png', 44000, 60, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(6, 1, 1, 'tsukemen', 'tsukemen.png', 52000, 55, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(7, 2, 2, 'chirashi sushi', 'chirashi.png', 50000, 55, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(8, 2, 2, 'futomaki sushi', 'futomaki.png', 45000, 100, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(9, 2, 2, 'gunkan sushi', 'gunkan.png', 47000, 69, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(10, 2, 2, 'inarizushi sushi', 'inarizushi.png', 43000, 90, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(11, 2, 2, 'nigiri sushi', 'nigiri.png', 55000, 87, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(12, 2, 2, 'norimaki sushi', 'norimaki.png', 50000, 60, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(13, 2, 2, 'oshizushi sushi', 'oshizushi.png', 430000, 81, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(14, 2, 2, 'temaki sushi', 'temaki.png', 45000, 67, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(15, 2, 2, 'uramaki sushi', 'uramaki.png', 50000, 72, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(16, 3, 3, 'mentaiko onigiri', 'mentaiko.png', 20000, 50, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(17, 3, 3, 'kombu onigiri', 'kombu.png', 23000, 40, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(18, 3, 3, 'okaka onigiri', 'okaka.png', 26000, 65, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(19, 3, 3, 'salmon onigiri', 'salmon.png', 30000, 77, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(20, 3, 3, 'torako onigiri', 'torako.png', 22000, 62, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(21, 3, 3, 'tuna-mayo onigiri', 'tuna-mayo.png', 32000, 45, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(22, 3, 3, 'umeboshi onigiri', 'umeboshi.png', 19000, 38, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(23, 3, 4, 'kari udon', 'kari.png', 70000, 70, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(24, 3, 4, 'su udon', 'su.png', 60000, 95, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(25, 3, 4, 'tanuki udon', 'tanuki.png', 70000, 55, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(26, 3, 4, 'tempura udon', 'tempura.png', 75000, 60, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(27, 3, 4, 'tororo udon', 'tororo.png', 80000, 85, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(28, 3, 4, 'tsukimi udon', 'tsukimi.png', 650000, 90, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(29, 2, 5, 'hirame udon', 'hirame.png', 100000, 99, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(30, 2, 5, 'hamachi', 'hamachi.png', 12000, 100, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(31, 2, 5, 'katsuo', 'katsuo.png', 12500, 110, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(32, 2, 5, 'maguro', 'maguro.png', 15000, 88, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(33, 2, 5, 'saba', 'saba.png', 95000, 150, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(34, 2, 5, 'sake', 'sake.png', 145000, 130, '0000-00-00 00:00:00', '2023-11-17 04:18:31');

-- --------------------------------------------------------

--
-- Table structure for table `metode_bayar`
--

CREATE TABLE `metode_bayar` (
  `ID_METODE` int(11) NOT NULL,
  `KODE_PELANGGAN` int(11) DEFAULT NULL,
  `NAMA_METODE` varchar(20) NOT NULL,
  `NO_REKENING` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `KODE_PELANGGAN` int(11) NOT NULL,
  `USERNAME_PELANGGAN` varchar(30) NOT NULL,
  `PASSWORD_PELANGGAN` varchar(256) NOT NULL,
  `NAMA_PELANGGAN` varchar(50) NOT NULL,
  `NO_TELP_PELANGGAN` varchar(15) NOT NULL,
  `ALAMAT_PELANGGAN` text NOT NULL,
  `JENIS_KELAMIN` enum('L','P') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`KODE_PELANGGAN`, `USERNAME_PELANGGAN`, `PASSWORD_PELANGGAN`, `NAMA_PELANGGAN`, `NO_TELP_PELANGGAN`, `ALAMAT_PELANGGAN`, `JENIS_KELAMIN`) VALUES
(1, 'Surip', 'ed7e7c4c077fbb21bef567066d282ce964a8bb4ba6042ca25e17a69dbfb5fd38', 'Surip Sugiono', '0893277367423', 'Desa clumprit simogirang', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `ID_ROLE` int(11) NOT NULL,
  `NAMA_ROLE` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ID_ROLE`, `NAMA_ROLE`) VALUES
(1, 'admin'),
(2, 'manager');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `ID_SUPPLIER` int(11) NOT NULL,
  `NAMA_SUPPLIER` varchar(100) NOT NULL,
  `NO_TELP_SUPPLIER` varchar(15) NOT NULL,
  `ALAMAT_SUPPLIER` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`ID_SUPPLIER`, `NAMA_SUPPLIER`, `NO_TELP_SUPPLIER`, `ALAMAT_SUPPLIER`) VALUES
(1, 'RamenKu\r\n', '081233527891', 'Tanggerang'),
(2, 'ShusiStar', '081232768991', 'Bandung'),
(3, 'Marugame Restourant', '084599778930', 'Nganjuk');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `KODE_TRANSAKSI` int(11) NOT NULL,
  `KODE_PELANGGAN` int(11) DEFAULT NULL,
  `TANGGAL_PESAN` datetime NOT NULL,
  `TOTAL` int(11) NOT NULL,
  `STATUS` int(11) NOT NULL,
  `WAKTU_BAYAR` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `KODE_TRANSAKSI` int(11) NOT NULL,
  `KODE_MAKANAN` int(11) NOT NULL,
  `HARGA_MAKANAN` int(11) NOT NULL,
  `QTY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`ID_KARYAWAN`),
  ADD KEY `FK_MEMILIKI5` (`ID_ROLE`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`KODE_KATERGORI`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`KODE_PELANGGAN`,`KODE_MAKANAN`),
  ADD KEY `FK_MEMPUNYAI5` (`KODE_MAKANAN`);

--
-- Indexes for table `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`KODE_MAKANAN`),
  ADD KEY `FK_MENYEDIAKAN` (`ID_SUPPLIER`),
  ADD KEY `FK_BERISI` (`KODE_KATERGORI`);

--
-- Indexes for table `metode_bayar`
--
ALTER TABLE `metode_bayar`
  ADD PRIMARY KEY (`ID_METODE`),
  ADD KEY `FK_MEMPUNYAI9` (`KODE_PELANGGAN`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`KODE_PELANGGAN`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID_ROLE`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID_SUPPLIER`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`KODE_TRANSAKSI`),
  ADD KEY `FK_MELAKUKAN` (`KODE_PELANGGAN`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`KODE_TRANSAKSI`,`KODE_MAKANAN`),
  ADD KEY `FK_TERDAPAT` (`KODE_MAKANAN`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `ID_KARYAWAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `KODE_KATERGORI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `makanan`
--
ALTER TABLE `makanan`
  MODIFY `KODE_MAKANAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `metode_bayar`
--
ALTER TABLE `metode_bayar`
  MODIFY `ID_METODE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `KODE_PELANGGAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ID_ROLE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `ID_SUPPLIER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `KODE_TRANSAKSI` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `FK_MEMILIKI5` FOREIGN KEY (`ID_ROLE`) REFERENCES `role` (`ID_ROLE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `FK_MEMPUNYAI` FOREIGN KEY (`KODE_PELANGGAN`) REFERENCES `pelanggan` (`KODE_PELANGGAN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MEMPUNYAI5` FOREIGN KEY (`KODE_MAKANAN`) REFERENCES `makanan` (`KODE_MAKANAN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `makanan`
--
ALTER TABLE `makanan`
  ADD CONSTRAINT `FK_BERISI` FOREIGN KEY (`KODE_KATERGORI`) REFERENCES `kategori` (`KODE_KATERGORI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MENYEDIAKAN` FOREIGN KEY (`ID_SUPPLIER`) REFERENCES `supplier` (`ID_SUPPLIER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `metode_bayar`
--
ALTER TABLE `metode_bayar`
  ADD CONSTRAINT `FK_MEMPUNYAI9` FOREIGN KEY (`KODE_PELANGGAN`) REFERENCES `pelanggan` (`KODE_PELANGGAN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `FK_MELAKUKAN` FOREIGN KEY (`KODE_PELANGGAN`) REFERENCES `pelanggan` (`KODE_PELANGGAN`);

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `FK_MEMILIKI2` FOREIGN KEY (`KODE_TRANSAKSI`) REFERENCES `transaksi` (`KODE_TRANSAKSI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TERDAPAT` FOREIGN KEY (`KODE_MAKANAN`) REFERENCES `makanan` (`KODE_MAKANAN`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
