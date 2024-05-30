-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 26 Des 2023 pada 22.40
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `indesa`
--

DELIMITER $$
--
-- Fungsi
--
CREATE DEFINER=`root`@`localhost` FUNCTION `kode_automatis` (`kode` INT) RETURNS CHAR(7) CHARSET latin1  BEGIN
DECLARE kodebaru CHAR(7);
DECLARE urut INT;
 
SET urut = IF(kode IS NULL, 1, kode + 1);
SET kodebaru = CONCAT("TRX", LPAD(urut, 4, 0));
 
RETURN kodebaru;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `kode_automatis2` (`kode` INT) RETURNS CHAR(7) CHARSET latin1  BEGIN
DECLARE kodebaru CHAR(7);
DECLARE urut INT;
 
SET urut = IF(kode IS NULL, 1, kode + 1);
SET kodebaru = CONCAT("TRF", LPAD(urut, 4, 0));
 
RETURN kodebaru;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemasukkan`
--

CREATE TABLE `pemasukkan` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(30) NOT NULL,
  `sumber` varchar(30) NOT NULL,
  `jumlah` varchar(250) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemasukkan`
--

INSERT INTO `pemasukkan` (`id`, `tanggal`, `keterangan`, `sumber`, `jumlah`, `username`) VALUES
(40, '2023-12-06', 'Bantuan Pemerintah', 'UMKM Desa', '12.121', 'bb'),
(41, '2023-12-23', 'Bantuan Pemerintah', 'APBN', '10.000.000', 'ula');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `keperluan` varchar(30) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id`, `tanggal`, `keterangan`, `keperluan`, `jumlah`, `username`) VALUES
(18, '2023-12-24', 'Bantuan untuk palestina', 'Kemanusiaan', '5.000.000', 'ula');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening_keluar`
--

CREATE TABLE `rekening_keluar` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `aksi` varchar(10) NOT NULL DEFAULT 'keluar',
  `tanggal` date NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `rekening_keluar`
--
DELIMITER $$
CREATE TRIGGER `tg_kodekeluar` BEFORE INSERT ON `rekening_keluar` FOR EACH ROW BEGIN
DECLARE s VARCHAR(8);
DECLARE i INTEGER;
 
SET i = (SELECT SUBSTRING(kode,4,4) AS Nomer
FROM rekening_keluar ORDER BY Nomer DESC LIMIT 1);
 
SET s = (SELECT kode_automatis2(i));
 
IF(NEW.kode IS NULL OR NEW.kode = '')
 THEN SET NEW.kode =s;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rekening_masuk`
--

CREATE TABLE `rekening_masuk` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `jumlah` varchar(255) NOT NULL,
  `aksi` varchar(20) NOT NULL DEFAULT 'masuk',
  `tanggal` date NOT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `rekening_masuk`
--
DELIMITER $$
CREATE TRIGGER `tg_kodemasuk` BEFORE INSERT ON `rekening_masuk` FOR EACH ROW BEGIN
DECLARE s VARCHAR(8);
DECLARE i INTEGER;
 
SET i = (SELECT SUBSTRING(kode,4,4) AS Nomer
FROM rekening_masuk ORDER BY Nomer DESC LIMIT 1);
 
SET s = (SELECT kode_automatis(i));
 
IF(NEW.kode IS NULL OR NEW.kode = '')
 THEN SET NEW.kode =s;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'aktif',
  `level` varchar(10) NOT NULL DEFAULT 'user',
  `no_rek` char(12) NOT NULL,
  `awal_buat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `paket` varchar(20) NOT NULL,
  `nama_desa` varchar(20) NOT NULL,
  `order_id` int(20) NOT NULL,
  `biaya` float NOT NULL,
  `transaction_status` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `email`, `username`, `password`, `status`, `level`, `no_rek`, `awal_buat`, `paket`, `nama_desa`, `order_id`, `biaya`, `transaction_status`, `transaction_id`) VALUES
(2, 'admin@gmail.com', 'admin', '$2y$10$JyNJABETyzlZl.l0mGs1BuXFJE7RXCa/x/9p/HWIr/whXkFyJ.5F2', 'aktif', 'admin', '', '2023-11-23 06:34:44', '', '', 0, 0, 0, 0),
(58, 'cina@gmail.com', 'cina', '$2y$10$ep4d.o1Sf3QAnEg7l1yhiOjCSx6YY40EgePboq/X/5zhvDt4ZPi1q', 'aktif', 'user', '7uM96wMs40Jd', '2023-12-06 12:48:05', 'PREMIUM 1', 'Cina', 181595123, 100000, 1, 0),
(59, 'o', 'q', '$2y$10$6GNsph5psSon22Oj2v4rP.hPQN/1z3AUIOZ2983/.8D95c5lCQVym', 'aktif', 'user', 'mSdDDU14zcV2', '2023-12-06 13:32:13', 'PREMIUM 1', '123', 1358058314, 100000, 1, 0),
(60, 'j@gmail.com', 'jj', '$2y$10$1EbWmED/aOXumZVu.oWhduBCSQJzB9q02oKgWiXAZ7o1wP8Sj2Ps2', 'aktif', 'user', 'Wv1rQ5Th0X5x', '2023-12-06 13:33:14', 'PREMIUM 1', 'aaa', 1909523459, 100000, 1, 0),
(61, '2', '2', '$2y$10$bMGMwQLDGY1KbZr0rA3D/uOTGMCGyWP3P5adJn73/35mn/J83NiBa', 'aktif', 'user', 's9c2i6lNcDu9', '2023-12-06 13:53:25', 'PREMIUM 1', '2', 938998714, 100000, 1, 0),
(62, '9', '9', '$2y$10$8/cyXZLkr7WE/QHm36/IVOiaBAPs3KsJICJswTxAbAbdI0yb7Eiia', 'aktif', 'user', 'uXUVtXiqnaXt', '2023-12-06 15:16:02', 'PREMIUM 1', 'ww', 56366845, 100000, 1, 0),
(63, 'jidan@gmail.com', 'jidan', '$2y$10$CXks8tdO57avxOMUoul4buBtSCG/lkZkl/MJMWWy1xsPligsGs5Ru', 'aktif', 'user', 'YX22DirZZysF', '2023-12-06 15:17:08', 'PREMIUM 1', 'sleman', 60481472, 100000, 1, 0),
(64, 'ul@gmail.com', 'ula', '$2y$10$7dPg7ddNIvSW6oe1Dy42E.9THhPkmI6batyF3Yl2pgjZy3vkH.Ryu', 'aktif', 'user', 'gcyGrhj970Mh', '2023-12-06 15:18:54', 'PREMIUM 1', 'Sleman', 2111502524, 100000, 1, 0),
(65, 'ppp@gmail.com', 'ppp', '$2y$10$IaLhMTUzODgQo51CRTmR8O4gKCan9x/XFLXcLQVEd3.6MCbXDlPka', 'aktif', 'user', '2TI9OUn2cydg', '2023-12-06 15:21:44', 'PREMIUM 1', 'ppp', 1847235011, 100000, 1, 0),
(66, 'bb', 'bb', '$2y$10$Yp20VnyCLRjhOLuOLyYuP.i.YzdT.ftSLYTGJD3qR8cFyBA7OR7jm', 'aktif', 'user', 'YCVF8X6xECgY', '2023-12-06 19:23:05', 'PREMIUM 1', 'qwqw', 1495742497, 100000, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pemasukkan`
--
ALTER TABLE `pemasukkan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_username_masuk` (`username`);

--
-- Indeks untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_username_keluar` (`username`);

--
-- Indeks untuk tabel `rekening_keluar`
--
ALTER TABLE `rekening_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_username_rekening_keluar` (`username`);

--
-- Indeks untuk tabel `rekening_masuk`
--
ALTER TABLE `rekening_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_username_rekening_masuk` (`username`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `username` (`username`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pemasukkan`
--
ALTER TABLE `pemasukkan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `rekening_keluar`
--
ALTER TABLE `rekening_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `rekening_masuk`
--
ALTER TABLE `rekening_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pemasukkan`
--
ALTER TABLE `pemasukkan`
  ADD CONSTRAINT `fk_username_masuk` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `fk_username_keluar` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekening_keluar`
--
ALTER TABLE `rekening_keluar`
  ADD CONSTRAINT `fk_username_rekening_keluar` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rekening_masuk`
--
ALTER TABLE `rekening_masuk`
  ADD CONSTRAINT `fk_username_rekening_masuk` FOREIGN KEY (`username`) REFERENCES `users` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
