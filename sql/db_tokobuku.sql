-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Nov 2021 pada 18.38
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tokobuku`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id_buku` char(11) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `penerbit` varchar(100) NOT NULL,
  `harga` varchar(30) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `stok`, `penerbit`, `harga`, `kategori`) VALUES
('B000003', '56 Days', 99, 'Gramedia', '50000', 'Novel'),
('B000004', 'Bittersweet', 348, 'Erlanta', '50000', 'Komik'),
('B000005', 'Dont Wanna Cry', 123, 'Sinar Indi', '20000', 'Non-Fiksi'),
('B000006', 'Ohyes', 400, 'Pledis', '19000', 'Novel');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_keluar`
--

CREATE TABLE `buku_keluar` (
  `id_buku_keluar` char(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `buku_id` char(7) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku_keluar`
--

INSERT INTO `buku_keluar` (`id_buku_keluar`, `user_id`, `buku_id`, `jumlah_keluar`, `tanggal_keluar`) VALUES
('T-BK-21111700001', 1, 'B000004', 1, '2021-11-17'),
('T-BK-21111700002', 1, 'B000003', 1, '2021-11-17');

--
-- Trigger `buku_keluar`
--
DELIMITER $$
CREATE TRIGGER `update_stok_keluar` BEFORE INSERT ON `buku_keluar` FOR EACH ROW UPDATE `buku` SET `buku`.`stok` = `buku`.`stok` - NEW.jumlah_keluar WHERE `buku`.`id_buku` = NEW.buku_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku_masuk`
--

CREATE TABLE `buku_masuk` (
  `id_buku_masuk` char(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `buku_id` char(7) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `buku_masuk`
--

INSERT INTO `buku_masuk` (`id_buku_masuk`, `user_id`, `buku_id`, `jumlah_masuk`, `tanggal_masuk`) VALUES
('T-BM-21111600002', 1, 'B000003', 80, '2021-11-16'),
('T-BM-21111600004', 1, 'B000003', 20, '2021-11-16'),
('T-BM-21111600005', 1, 'B000004', 400, '2021-11-16'),
('T-BM-21111600007', 1, 'B000004', 80, '2021-11-16'),
('T-BM-21111600008', 1, 'B000004', 300, '2021-11-16'),
('T-BM-21111600009', 1, 'B000003', 500, '2021-11-16'),
('T-BM-21111600010', 1, 'B000005', 70, '2021-11-16'),
('T-BM-21111600011', 1, 'B000005', 40, '2021-11-16'),
('T-BM-21111600012', 1, 'B000003', 30, '2021-11-16'),
('T-BM-21111600013', 1, 'B000005', 10, '2021-11-16'),
('T-BM-21111600014', 1, 'B000003', 100, '2021-11-16'),
('T-BM-21111600016', 1, 'B000003', 10, '2021-11-16'),
('T-BM-21111700001', 1, 'B000006', 400, '2021-11-17'),
('T-BM-21111700002', 1, 'B000005', 3, '2021-11-17');

--
-- Trigger `buku_masuk`
--
DELIMITER $$
CREATE TRIGGER `update_stok_masuk` BEFORE INSERT ON `buku_masuk` FOR EACH ROW UPDATE `buku` SET `buku`.`stok` = `buku`.`stok` + NEW.jumlah_masuk WHERE `buku`.`id_buku` = NEW.buku_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `role` enum('admin') NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `role`, `password`, `foto`, `email`) VALUES
(1, 'Administrator', 'admin', 'admin', '$2y$10$wMgi9s3FEDEPEU6dEmbp8eAAEBUXIXUy3np3ND2Oih.MOY.q/Kpoy', 'user.png', 'admin@admin.com');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `buku_keluar`
--
ALTER TABLE `buku_keluar`
  ADD PRIMARY KEY (`id_buku_keluar`),
  ADD KEY `id_user` (`user_id`) USING BTREE,
  ADD KEY `buku_id` (`buku_id`) USING BTREE;

--
-- Indeks untuk tabel `buku_masuk`
--
ALTER TABLE `buku_masuk`
  ADD PRIMARY KEY (`id_buku_masuk`),
  ADD KEY `id_user` (`user_id`) USING BTREE,
  ADD KEY `buku_id` (`buku_id`) USING BTREE;

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `buku_keluar`
--
ALTER TABLE `buku_keluar`
  ADD CONSTRAINT `buku_keluar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buku_keluar_ibfk_2` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `buku_masuk`
--
ALTER TABLE `buku_masuk`
  ADD CONSTRAINT `buku_masuk_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `buku_masuk_ibfk_3` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
