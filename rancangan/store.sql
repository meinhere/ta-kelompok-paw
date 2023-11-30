-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 30 Nov 2023 pada 07.19
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `karyawan`
--

CREATE TABLE `karyawan` (
  `ID_KARYAWAN` int(11) NOT NULL,
  `ID_ROLE` int(11) DEFAULT NULL,
  `USERNAME_KARYAWAN` varchar(30) NOT NULL,
  `PASSWORD_KARYAWAN` varchar(256) NOT NULL,
  `NAMA_KARYAWAN` varchar(100) NOT NULL,
  `NO_TELP_KARYAWAN` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `karyawan`
--

INSERT INTO `karyawan` (`ID_KARYAWAN`, `ID_ROLE`, `USERNAME_KARYAWAN`, `PASSWORD_KARYAWAN`, `NAMA_KARYAWAN`, `NO_TELP_KARYAWAN`) VALUES
(1, 1, 'sabil123', 'ae20ef8d6f7f830ac42d2650f661fb18e0f9ff0a551a01a6356ef1a0c74798bf', 'Sabil Ahmad Hidayat', '81276492819'),
(2, 1, 'star993', 'e4bee8699d14227d5d58ef72b593233c152b1572013a8ddb8b2d6bd3b6bdc505', 'Bintang Widya Narendra', '82143759812'),
(3, 2, 'dani123', '70bd1dd456a16d9bfd51867dc1fe5182b3b53646ebd4832232ebc29cdcd7775e', 'Syaiful Rochmandani', '82634193561'),
(4, 2, 'rizky123', 'e14861dc3764d3f687da6f3a323d642cc6be4dd4e6ab55c3980f25913e4c591a', 'Rizkyan Dwi Prasetiawan', '81352957410');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `KODE_KATEGORI` int(11) NOT NULL,
  `NAMA_KATEGORI` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`KODE_KATEGORI`, `NAMA_KATEGORI`) VALUES
(1, 'ramen'),
(2, 'sushi'),
(3, 'onigiri'),
(4, 'udon'),
(5, 'sashimi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keranjang`
--

CREATE TABLE `keranjang` (
  `ID_PELANGGAN` int(11) NOT NULL,
  `KODE_MAKANAN` int(11) NOT NULL,
  `QTY` int(11) NOT NULL,
  `CREATED_AT_K` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATE_AT_M` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `makanan`
--

CREATE TABLE `makanan` (
  `KODE_MAKANAN` int(11) NOT NULL,
  `ID_SUPPLIER` int(11) DEFAULT NULL,
  `KODE_KATEGORI` int(11) DEFAULT NULL,
  `NAMA_MAKANAN` varchar(100) NOT NULL,
  `GAMBAR_MAKANAN` varchar(255) NOT NULL,
  `HARGA_MAKANAN` int(11) NOT NULL,
  `STOK_PRODUK` int(11) NOT NULL,
  `CREATED_AT_M` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATE_AT_M` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `makanan`
--

INSERT INTO `makanan` (`KODE_MAKANAN`, `ID_SUPPLIER`, `KODE_KATEGORI`, `NAMA_MAKANAN`, `GAMBAR_MAKANAN`, `HARGA_MAKANAN`, `STOK_PRODUK`, `CREATED_AT_M`, `UPDATE_AT_M`) VALUES
(1, 1, 1, 'Miso Ramen', 'miso.png', 40000, 98, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(2, 1, 1, 'Shio Ramen', 'shio.png', 50000, 69, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(3, 1, 1, 'Shoyu Ramen', 'shoyu.png', 43000, 7, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(4, 1, 1, 'Tantan Ramen', 'tantan.png', 45000, 28, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(5, 1, 1, 'Tonkotsu Ramen', 'tonkotsu.png', 44000, 47, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(6, 1, 1, 'Tsukemen', 'tsukemen.png', 52000, 35, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(8, 2, 2, 'Futomaki Sushi', 'futomaki.png', 45000, 100, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(9, 2, 2, 'Gunkan Sushi', 'gunkan.png', 47000, 70, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(10, 2, 2, 'Inarizushi Sushi', 'inarizushi.png', 43000, 90, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(11, 2, 2, 'Nigiri Sushi', 'nigiri.png', 55000, 87, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(12, 2, 2, 'Norimaki Sushi', 'norimaki.png', 50000, 60, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(13, 2, 2, 'Oshizushi Sushi', 'oshizushi.png', 430000, 81, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(14, 2, 2, 'Temaki Sushi', 'temaki.png', 45000, 67, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(15, 2, 2, 'Uramaki Sushi', 'uramaki.png', 50000, 72, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(16, 3, 3, 'Mentaiko Onigiri', 'mentaiko.png', 20000, 50, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(17, 3, 3, 'Kombu Onigiri', 'kombu.png', 23000, 37, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(18, 3, 3, 'Okaka Onigiri', 'okaka.png', 26000, 64, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(19, 3, 3, 'Salmon Onigiri', 'salmon.png', 30000, 77, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(20, 3, 3, 'Tarako Onigiri', 'tarako.png', 22000, 62, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(21, 3, 3, 'Tuna Mayo Onigiri', 'tuna-mayo.png', 32000, 45, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(22, 3, 3, 'Umeboshi Onigiri', 'umeboshi.png', 19000, 38, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(23, 3, 4, 'Kari Udon', 'kari.png', 70000, 70, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(24, 3, 4, 'Su Udon', 'su.png', 60000, 95, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(25, 3, 4, 'Tanuki Udon', 'tanuki.png', 70000, 55, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(26, 3, 4, 'Tempura Udon', 'tempura.png', 75000, 60, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(27, 3, 4, 'Tororo Udon', 'tororo.png', 80000, 85, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(28, 3, 4, 'Tsukimi Udon', 'tsukimi.png', 650000, 90, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(29, 2, 5, 'Hirame Udon', 'hirame.png', 100000, 95, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(30, 2, 5, 'Hamachi', 'hamachi.png', 12000, 96, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(31, 2, 5, 'Katsuo', 'katsuo.png', 12500, 108, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(32, 2, 5, 'Maguro', 'maguro.png', 15000, 87, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(33, 2, 5, 'Saba', 'saba.png', 95000, 150, '0000-00-00 00:00:00', '2023-11-17 04:18:31'),
(34, 2, 5, 'Sake', 'sake.png', 145000, 129, '0000-00-00 00:00:00', '2023-11-17 04:18:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `metode_bayar`
--

CREATE TABLE `metode_bayar` (
  `ID_METODE` int(11) NOT NULL,
  `ID_PELANGGAN` int(11) NOT NULL,
  `NAMA_METODE` varchar(20) NOT NULL,
  `NO_REKENING` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `metode_bayar`
--

INSERT INTO `metode_bayar` (`ID_METODE`, `ID_PELANGGAN`, `NAMA_METODE`, `NO_REKENING`) VALUES
(1, 1, 'Rekening BRI', '12378171'),
(1, 2, 'Rekening BRI', '912831237'),
(1, 3, 'Rekening BRI', '123123'),
(2, 1, 'Rekening BCA', '9012312311'),
(2, 4, 'Rekening BCA', '81293217'),
(3, 2, 'Digital DANA', '123213213'),
(3, 4, 'Digital DANA', '12931222'),
(4, 2, 'Digital OVO', '123712312');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `ID_PELANGGAN` int(11) NOT NULL,
  `USERNAME_PELANGGAN` varchar(30) NOT NULL,
  `PASSWORD_PELANGGAN` varchar(256) NOT NULL,
  `NAMA_PELANGGAN` varchar(50) NOT NULL,
  `NO_TELP_PELANGGAN` varchar(15) NOT NULL,
  `ALAMAT_PELANGGAN` text NOT NULL,
  `JENIS_KELAMIN` enum('L','P') CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`ID_PELANGGAN`, `USERNAME_PELANGGAN`, `PASSWORD_PELANGGAN`, `NAMA_PELANGGAN`, `NO_TELP_PELANGGAN`, `ALAMAT_PELANGGAN`, `JENIS_KELAMIN`) VALUES
(1, 'alpa123', '4c6f62976457dcc9b65bfd1f6a27e1bcd860abf626987d527b6e644422927c89', 'Alpa Ruins', '8123172361', 'Jalan Petirihan 16, Sumenep', 'L'),
(2, 'beta123', '7b4eb297e64e2392401880b09662f0095fdaabd0c1afb3e74d2866dc099d1988', 'Beta Rose', '8127312361', 'Jalan Tegal Barat 3, Bandung', 'P'),
(3, 'carli123', 'd30849bf129d9a02959932d0e39b8546aaa447c7b1ca79ff717d850a23b874ca', 'Carli Merialdi', '1982310238', 'Jalan Batu Merah Jambu 10, Jambi', 'L'),
(4, 'delta123', 'ce9fafaec9daa37718a414689f2993d12771a49d35389277fc4cd5e92e35e67b', 'Delta Ria', '192310238', 'Jalan Ujung Tembok 9, Surabaya', 'P'),
(5, 'ema123', '91e8c110f85818cc3181a8e7d247f3e79991060ac197b786e6a51870a4005548', 'Ema Perlanto', '123123123', 'Jalan Putih Abu 12, Pati', 'P');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `ID_ROLE` int(11) NOT NULL,
  `NAMA_ROLE` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`ID_ROLE`, `NAMA_ROLE`) VALUES
(1, 'admin'),
(2, 'manager');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `ID_SUPPLIER` int(11) NOT NULL,
  `NAMA_SUPPLIER` varchar(100) NOT NULL,
  `NO_TELP_SUPPLIER` varchar(15) NOT NULL,
  `ALAMAT_SUPPLIER` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`ID_SUPPLIER`, `NAMA_SUPPLIER`, `NO_TELP_SUPPLIER`, `ALAMAT_SUPPLIER`) VALUES
(1, 'RamenKu', '8721361232', 'Surabaya'),
(2, 'HamachiRuko', '7128371236', 'Mojokerto'),
(3, 'SushiStar', '6125361235123', 'Nganjuk'),
(6, 'Juironesha', '1923812371', 'Blitar');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `KODE_TRANSAKSI` int(11) NOT NULL,
  `ID_PELANGGAN` int(11) NOT NULL,
  `TANGGAL_PESAN` datetime NOT NULL DEFAULT current_timestamp(),
  `TOTAL` int(11) NOT NULL,
  `STATUS` int(11) NOT NULL,
  `WAKTU_BAYAR` datetime DEFAULT NULL,
  `METODE_BAYAR` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`KODE_TRANSAKSI`, `ID_PELANGGAN`, `TANGGAL_PESAN`, `TOTAL`, `STATUS`, `WAKTU_BAYAR`, `METODE_BAYAR`) VALUES
(1, 1, '2023-11-22 23:33:28', 240450, 1, '2023-11-27 21:08:02', NULL),
(2, 3, '2023-11-23 22:27:18', 99750, 0, NULL, NULL),
(3, 1, '2023-11-24 18:56:03', 284550, 1, '2023-11-24 18:56:51', NULL),
(4, 1, '2023-11-24 19:03:09', 208950, 0, NULL, NULL),
(5, 1, '2023-11-27 20:55:10', 152250, 0, NULL, NULL),
(7, 1, '2023-11-27 21:06:38', 143850, 1, '2023-11-27 21:08:21', NULL),
(8, 2, '2023-11-27 21:12:22', 546000, 1, '2023-11-27 21:12:27', NULL),
(9, 2, '2023-11-27 21:12:42', 829500, 0, NULL, NULL),
(10, 4, '2023-11-27 21:13:12', 319200, 1, '2023-11-27 21:13:49', NULL),
(11, 4, '2023-11-27 21:13:27', 601650, 0, NULL, NULL),
(12, 4, '2023-11-27 21:14:27', 911400, 0, NULL, NULL),
(13, 4, '2023-11-27 21:14:44', 93450, 0, NULL, NULL),
(14, 3, '2023-11-27 21:18:15', 160650, 0, NULL, NULL),
(15, 3, '2023-11-27 21:18:34', 135450, 0, NULL, NULL),
(16, 3, '2023-11-27 21:18:58', 187950, 0, NULL, NULL),
(17, 1, '2023-11-28 16:10:46', 99750, 0, NULL, NULL),
(18, 1, '2023-11-28 16:11:07', 182700, 0, NULL, NULL),
(19, 1, '2023-11-28 21:09:18', 152250, 1, '2023-11-28 21:12:48', NULL),
(23, 1, '2023-11-30 12:40:59', 154350, 1, '2023-11-30 12:41:06', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `KODE_TRANSAKSI` int(11) NOT NULL,
  `KODE_MAKANAN` int(11) NOT NULL,
  `HARGA_MAKANAN` int(11) NOT NULL,
  `QTY` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`KODE_TRANSAKSI`, `KODE_MAKANAN`, `HARGA_MAKANAN`, `QTY`) VALUES
(1, 2, 50000, 2),
(1, 3, 43000, 3),
(2, 3, 43000, 1),
(2, 6, 52000, 1),
(3, 3, 43000, 1),
(3, 5, 44000, 4),
(3, 6, 52000, 1),
(4, 3, 43000, 1),
(4, 6, 52000, 3),
(5, 2, 50000, 1),
(5, 3, 43000, 1),
(5, 6, 52000, 1),
(7, 1, 40000, 1),
(7, 4, 45000, 1),
(7, 6, 52000, 1),
(8, 6, 52000, 1),
(8, 17, 23000, 3),
(8, 18, 26000, 1),
(8, 29, 100000, 3),
(8, 30, 12000, 4),
(8, 31, 12500, 2),
(9, 24, 60000, 1),
(9, 27, 80000, 1),
(9, 28, 650000, 1),
(10, 5, 44000, 1),
(10, 29, 100000, 1),
(10, 32, 15000, 1),
(10, 34, 145000, 1),
(11, 8, 45000, 1),
(11, 10, 43000, 1),
(11, 11, 55000, 1),
(11, 13, 430000, 1),
(12, 9, 47000, 1),
(12, 10, 43000, 1),
(12, 11, 55000, 1),
(12, 12, 50000, 1),
(12, 13, 430000, 1),
(12, 17, 23000, 1),
(12, 18, 26000, 1),
(12, 19, 30000, 1),
(12, 20, 22000, 1),
(12, 21, 32000, 1),
(12, 32, 15000, 1),
(12, 33, 95000, 1),
(13, 1, 40000, 1),
(13, 17, 23000, 1),
(13, 18, 26000, 1),
(14, 10, 43000, 1),
(14, 11, 55000, 1),
(14, 17, 23000, 1),
(14, 21, 32000, 1),
(15, 5, 44000, 1),
(15, 17, 23000, 1),
(15, 19, 30000, 1),
(15, 21, 32000, 1),
(16, 16, 20000, 1),
(16, 22, 19000, 1),
(16, 24, 60000, 1),
(16, 27, 80000, 1),
(17, 16, 20000, 1),
(17, 17, 23000, 1),
(17, 19, 30000, 1),
(17, 20, 22000, 1),
(18, 8, 45000, 1),
(18, 9, 47000, 1),
(18, 12, 50000, 1),
(18, 21, 32000, 1),
(19, 2, 50000, 1),
(19, 3, 43000, 1),
(19, 6, 52000, 1),
(23, 3, 43000, 1),
(23, 6, 52000, 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`ID_KARYAWAN`),
  ADD KEY `FK_MEMILIKI5` (`ID_ROLE`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`KODE_KATEGORI`);

--
-- Indeks untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`ID_PELANGGAN`,`KODE_MAKANAN`),
  ADD KEY `FK_MEMPUNYAI5` (`KODE_MAKANAN`);

--
-- Indeks untuk tabel `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`KODE_MAKANAN`),
  ADD KEY `FK_MENYEDIAKAN` (`ID_SUPPLIER`),
  ADD KEY `FK_BERISI` (`KODE_KATEGORI`);

--
-- Indeks untuk tabel `metode_bayar`
--
ALTER TABLE `metode_bayar`
  ADD PRIMARY KEY (`ID_METODE`,`ID_PELANGGAN`),
  ADD KEY `FK_MEMPUNYAI9` (`ID_PELANGGAN`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`ID_PELANGGAN`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID_ROLE`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`ID_SUPPLIER`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`KODE_TRANSAKSI`),
  ADD KEY `FK_MELAKUKAN` (`ID_PELANGGAN`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`KODE_TRANSAKSI`,`KODE_MAKANAN`),
  ADD KEY `FK_TERDAPAT` (`KODE_MAKANAN`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `ID_KARYAWAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `KODE_KATEGORI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `makanan`
--
ALTER TABLE `makanan`
  MODIFY `KODE_MAKANAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `ID_PELANGGAN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `role`
--
ALTER TABLE `role`
  MODIFY `ID_ROLE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `ID_SUPPLIER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `KODE_TRANSAKSI` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `FK_MEMILIKI5` FOREIGN KEY (`ID_ROLE`) REFERENCES `role` (`ID_ROLE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `keranjang`
--
ALTER TABLE `keranjang`
  ADD CONSTRAINT `FK_MEMPUNYAI` FOREIGN KEY (`ID_PELANGGAN`) REFERENCES `pelanggan` (`ID_PELANGGAN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MEMPUNYAI5` FOREIGN KEY (`KODE_MAKANAN`) REFERENCES `makanan` (`KODE_MAKANAN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `makanan`
--
ALTER TABLE `makanan`
  ADD CONSTRAINT `FK_BERISI` FOREIGN KEY (`KODE_KATEGORI`) REFERENCES `kategori` (`KODE_KATEGORI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_MENYEDIAKAN` FOREIGN KEY (`ID_SUPPLIER`) REFERENCES `supplier` (`ID_SUPPLIER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `metode_bayar`
--
ALTER TABLE `metode_bayar`
  ADD CONSTRAINT `FK_MEMPUNYAI9` FOREIGN KEY (`ID_PELANGGAN`) REFERENCES `pelanggan` (`ID_PELANGGAN`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `FK_MELAKUKAN` FOREIGN KEY (`ID_PELANGGAN`) REFERENCES `pelanggan` (`ID_PELANGGAN`);

--
-- Ketidakleluasaan untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `FK_MEMILIKI2` FOREIGN KEY (`KODE_TRANSAKSI`) REFERENCES `transaksi` (`KODE_TRANSAKSI`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TERDAPAT` FOREIGN KEY (`KODE_MAKANAN`) REFERENCES `makanan` (`KODE_MAKANAN`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
