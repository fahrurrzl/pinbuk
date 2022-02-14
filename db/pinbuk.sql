-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2022 at 03:35 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinbuk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(50) NOT NULL DEFAULT '',
  `tempat_lahir` varchar(15) NOT NULL DEFAULT '',
  `tl` date NOT NULL,
  `jk` varchar(15) NOT NULL DEFAULT '',
  `tlp` varchar(15) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `alamat` text NOT NULL,
  `username` varchar(25) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `poto` varchar(50) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `tempat_lahir`, `tl`, `jk`, `tlp`, `email`, `alamat`, `username`, `password`, `poto`) VALUES
(2, 'admin1', 'Kediri', '1998-12-12', 'perempuan', '085784693875', 'rizal.voice57@gmail.com', 'Ds.Wanengpaten Kec. Gampengrejo Kab. Kediri', 'admin1', '$2y$10$dzGezTYEqqSakjlNGCJ8vuQI9.h9NNJ9MTna2F5d5j2dEfKe0KhDe', '6208bc998d7e3.jpg'),
(4, 'admin', 'Kediri', '1998-07-05', 'laki-laki', '085784693875', 'rizal.voice57@gmail.com', 'Ds.Wanengpaten Kec. Gampengrejo Kab. Kediri', 'admin', '$2y$10$ly5Xx06a82wqeiQ.McxQsuGUWTDpp/aybxSx7syCbAyxaSkaXXwj2', '6208e0d6a91e2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL DEFAULT '',
  `tahun_terbit` varchar(4) NOT NULL DEFAULT '',
  `sampul` varchar(50) DEFAULT '',
  `isbn` varchar(15) NOT NULL,
  `sinopsis` text NOT NULL,
  `id_penerbit` int(11) NOT NULL,
  `id_pengarang` int(11) NOT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `tahun_terbit`, `sampul`, `isbn`, `sinopsis`, `id_penerbit`, `id_pengarang`, `id_kategori`, `jumlah`) VALUES
(20, 'pemrograman dasar', '2022', '620860a988a09.jpg', '050298', 'pemrograman dasar', 1, 1, 1, 8),
(22, 'coba', '2020', '62085d0c97f8e.jpg', '12121', 'dfdf', 1, 1, 3, 30),
(32, 'language course', '2020', '6209abf13320e.jpg', '22222222', 'language course', 4, 1, 2, 90),
(33, 'manual report', '2020', '6209ac241d8bf.jpg', '444444444', 'contoh sinopsis', 1, 1, 2, 42),
(34, 'cona tambah buku', '2022', '6209b1205e4c3.jpg', '5555555', 'coba tanbah buku', 1, 9, 2, 20),
(35, 'online course', '2020', '6209b2bca028f.jpg', '666666', 'online course', 1, 9, 1, 0),
(36, 'coba tambah buku', '2020', '6209b5b60ec00.jpg', '123', 'coba sinopsis', 4, 1, 1, 22);

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjam`
--

CREATE TABLE `detail_peminjam` (
  `id_detail` int(11) NOT NULL,
  `id_peminjam` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `status` varchar(15) DEFAULT '',
  `tgl_dikembalikan` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_peminjam`
--

INSERT INTO `detail_peminjam` (`id_detail`, `id_peminjam`, `id_buku`, `tgl_pinjam`, `tgl_kembali`, `status`, `tgl_dikembalikan`) VALUES
(80, 24, 34, '2022-02-14', '2022-02-21', 'pinjam', '0000-00-00'),
(81, 25, 35, '2022-02-14', '2022-02-21', 'pinjam', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'informatika'),
(2, 'psikolog'),
(3, 'ekonomi');

-- --------------------------------------------------------

--
-- Table structure for table `peminjam`
--

CREATE TABLE `peminjam` (
  `id_peminjam` int(11) NOT NULL,
  `nama_peminjam` varchar(50) NOT NULL DEFAULT '',
  `tempat_lahir` varchar(15) NOT NULL DEFAULT '',
  `tl` date NOT NULL,
  `jk` varchar(15) NOT NULL DEFAULT '',
  `tlp` varchar(15) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `alamat` varchar(50) NOT NULL DEFAULT '',
  `username` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `poto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjam`
--

INSERT INTO `peminjam` (`id_peminjam`, `nama_peminjam`, `tempat_lahir`, `tl`, `jk`, `tlp`, `email`, `alamat`, `username`, `password`, `poto`) VALUES
(22, 'Citra Krisma Negara', 'Kediri', '1998-11-02', 'perempuan', '085784693875', 'citra@gmail.com', 'Kandangan                  ', 'citra', '$2y$10$I5t642KCc.G.Rif7QEiZIOFy0JkUgiJkN1RZf1cOJf2QycLxtiD1O', '6209a190e1f86.jpg'),
(23, 'user', 'kediri', '1998-11-11', 'laki-laki', '085784693875', 'rizal.voice57@gmail.com', 'kediri', 'user', '$2y$10$.dDbXXfzU6N8EpOL4gQGvuHXnH2Uv/4X9Qyz3g54jXAGU8Zx/X3Ni', 'nopoto.jpg'),
(24, 'coba user', 'Kediri', '1998-01-01', 'laki-laki', '085784693875', 'rizal.voice57@gmail.com', 'kediri                  ', 'coba', '$2y$10$XLwVn8W02NZuIYwDRITm9eZvtWy1mq9PEdclBLyjc4YUFDc2Orpem', '6209af71162b1.jpg'),
(25, 'M. Fahrur Rizal', 'Kediri', '1998-01-01', 'laki-laki', '085784693875', 'rizal.voice57@gmail.com', 'kediri                  ', 'rizal57', '$2y$10$mH7pNqCdkJn13fS3y67trOLwqrfs13I/UO7thCKmzQHxsxlfm1W26', '6209b5310caa2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) NOT NULL,
  `nama_penerbit` varchar(50) NOT NULL DEFAULT '',
  `tlp` varchar(15) NOT NULL DEFAULT '',
  `alamat` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`id_penerbit`, `nama_penerbit`, `tlp`, `alamat`) VALUES
(1, 'informatika', '012345', 'kediri'),
(4, 'penerbit buku', '085784693875', 'kediri');

-- --------------------------------------------------------

--
-- Table structure for table `pengarang`
--

CREATE TABLE `pengarang` (
  `id_pengarang` int(11) NOT NULL,
  `nama_pengarang` varchar(50) NOT NULL DEFAULT '',
  `tempat_lahir` varchar(15) NOT NULL DEFAULT '',
  `tl` date NOT NULL,
  `jk` varchar(15) NOT NULL DEFAULT '',
  `tlp` varchar(15) NOT NULL DEFAULT '',
  `alamat` varchar(50) NOT NULL DEFAULT '',
  `poto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengarang`
--

INSERT INTO `pengarang` (`id_pengarang`, `nama_pengarang`, `tempat_lahir`, `tl`, `jk`, `tlp`, `alamat`, `poto`) VALUES
(1, 'M. Fahrur Rizal', 'Kediri', '1998-07-05', 'laki-laki', '085784693875', 'kediri', '62087846940d2.jpg'),
(9, 'pengarang', 'kediri', '1997-01-01', 'perempuan', '0812345678', 'kediri', 'nopoto.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`) USING BTREE,
  ADD KEY `id_pengarang_fk` (`id_pengarang`),
  ADD KEY `id_penerbit_fk` (`id_penerbit`),
  ADD KEY `id_kategori_fk` (`id_kategori`);

--
-- Indexes for table `detail_peminjam`
--
ALTER TABLE `detail_peminjam`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_peminjam_fk` (`id_peminjam`),
  ADD KEY `id_buku_fk` (`id_buku`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`) USING BTREE;

--
-- Indexes for table `peminjam`
--
ALTER TABLE `peminjam`
  ADD PRIMARY KEY (`id_peminjam`) USING BTREE;

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`id_penerbit`) USING BTREE;

--
-- Indexes for table `pengarang`
--
ALTER TABLE `pengarang`
  ADD PRIMARY KEY (`id_pengarang`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `detail_peminjam`
--
ALTER TABLE `detail_peminjam`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peminjam`
--
ALTER TABLE `peminjam`
  MODIFY `id_peminjam` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `id_penerbit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pengarang`
--
ALTER TABLE `pengarang`
  MODIFY `id_pengarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `id_kategori_fk` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_penerbit_fk` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_pengarang_fk` FOREIGN KEY (`id_pengarang`) REFERENCES `pengarang` (`id_pengarang`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `detail_peminjam`
--
ALTER TABLE `detail_peminjam`
  ADD CONSTRAINT `id_buku_fk` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_peminjam_fk` FOREIGN KEY (`id_peminjam`) REFERENCES `peminjam` (`id_peminjam`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
