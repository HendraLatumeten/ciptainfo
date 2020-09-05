-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Nov 2018 pada 07.16
-- Versi server: 10.1.36-MariaDB
-- Versi PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gegestore`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `fullname` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `fullname`) VALUES
(4, 'fahri', 'fahri', 'fahri ramadhan'),
(5, 'admin', 'admin', 'admin admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `nama_brand` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `brand`
--

INSERT INTO `brand` (`brand_id`, `nama_brand`) VALUES
(1, 'asus'),
(2, 'acer'),
(3, 'msi'),
(4, 'gigabyte'),
(5, 'corsair'),
(6, 'razer'),
(7, 'logitech'),
(8, 'steelseries'),
(9, 'dazumba');

-- --------------------------------------------------------

--
-- Struktur dari tabel `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `email_customer` varchar(50) NOT NULL,
  `password_customer` varchar(100) NOT NULL,
  `alamat_customer` text NOT NULL,
  `tlp_customer` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `email_customer`, `password_customer`, `alamat_customer`, `tlp_customer`) VALUES
(30, 'fahri ramadhan', 'fahri@gmail.com', 'fahri123', 'ciputat', '089922827261'),
(47, 'rizky', 'rizky@gmail.com', 'rizky123', 'pamulang', '0817171717272'),
(46, 'jajang', 'jajang@gmail.com', 'jajang123', 'pamulang', '082918291918'),
(48, 'hata', 'hata@gmail.com', 'hata123', 'pamulang', '08272717171717'),
(49, 'Dita Amalia', 'dita@gmail.com', 'dita123', 'jl.ciputat', '082717176252'),
(51, 'hendra', 'hendra@gmail.com', '290697', 'dava', '345243457645321');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` int(11) NOT NULL,
  `nama_mitra` varchar(25) NOT NULL,
  `email_mitra` varchar(25) NOT NULL,
  `password_mitra` varchar(25) NOT NULL,
  `alamat_mitra` text NOT NULL,
  `tlp_mitra` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `nama_mitra`, `email_mitra`, `password_mitra`, `alamat_mitra`, `tlp_mitra`) VALUES
(1, 'Asus Indonesia', 'supplier@asus.com', 'asus', 'jl.kebon mangga', '089922717272'),
(2, 'Acer Indonesia', 'supplier@acer.com', 'acer', 'sebelah kantor asus', '08291171721'),
(3, 'Razer', 'supplier@razer.com', 'razer', 'jl.kebayoran lama', '081726261728'),
(4, 'MSI Indonesia', 'supplier@msi.com', 'msi', 'Jl.kebon sirih', '081727271625'),
(5, 'Logitech', 'supplier@logitech.com', 'logitech', 'jl. Makmur', '081927171612');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ongkir`
--

CREATE TABLE `ongkir` (
  `id_ongkir` int(5) NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ongkir`
--

INSERT INTO `ongkir` (`id_ongkir`, `nama_kota`, `tarif`) VALUES
(1, 'jakarta', 20000),
(2, 'banten', 25000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_pembelian`, `nama`, `bank`, `jumlah`, `tanggal`, `bukti`) VALUES
(3, 28, 'fahrie dwiki ramadhan', 'BCA', 720000, '2018-11-17', '20181117021948aa.jpg'),
(4, 29, 'fahrie', 'mandiri', 4025000, '2018-11-17', '20181117022403batman.jpg'),
(5, 30, 'Dita Amalia', 'BCA', 8025000, '2018-11-17', '2018111712572788706.jpg'),
(6, 31, 'Dita Amalia', 'MANDIRI', 53025000, '2018-11-17', '20181117133617beatles_abbey_road.jpg'),
(7, 32, 'Dita Amalia', 'BCA', 37025000, '2018-11-18', '20181118091105Venom.jpg'),
(8, 33, 'Dita Amalia', 'BCA', 1825000, '2018-11-18', '20181118091846aa.jpg'),
(9, 34, 'fahrie dwiki ramadhan', 'BCA', 45020000, '2018-11-19', '20181119015831intel.jpg'),
(10, 36, 'fahri', 'BCA', 12025000, '2018-11-19', '20181119031909kraken.jpg'),
(11, 37, 'fahrie ramadhan', 'BRI', 3425000, '2018-11-20', '20181120061549f.jpg'),
(12, 38, 'fahri', 'MANDIRI', 2425000, '2018-11-20', '20181120083930FFP.JPG'),
(13, 35, 'Hendra', 'BTN', 12020000, '2018-11-20', '20181120091101W7..22.jpg'),
(14, 42, 'Fahri', 'BCA', 2420000, '2018-11-21', '20181121104753web dev.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_ongkir` int(11) NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `nama_kota` varchar(100) NOT NULL,
  `tarif` int(11) NOT NULL,
  `status_pembelian` varchar(100) NOT NULL DEFAULT 'pending',
  `no_resi` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_customer`, `id_ongkir`, `tanggal_pembelian`, `total_pembelian`, `alamat`, `nama_kota`, `tarif`, `status_pembelian`, `no_resi`) VALUES
(21, 46, 1, '2018-11-10', 820000, '', 'jakarta', 20000, 'pending', ''),
(22, 46, 1, '2018-11-10', 5020000, 'jl.ciputat', 'jakarta', 20000, 'pending', ''),
(30, 49, 2, '2018-11-17', 8025000, 'jl.ciputat', 'banten', 25000, 'sudah kirim pembayaran', ''),
(31, 49, 2, '2018-11-17', 53025000, 'cipayung', 'banten', 25000, 'sudah kirim pembayaran', ''),
(32, 49, 2, '2018-11-18', 37025000, 'pamulang', 'banten', 25000, 'sudah kirim pembayaran', ''),
(33, 49, 2, '2018-11-18', 1825000, 'cimandiri', 'banten', 25000, 'sudah kirim pembayaran', ''),
(35, 51, 1, '2018-11-19', 12020000, 'adasdda', 'jakarta', 20000, 'Finish', 'J&T1109238'),
(36, 30, 2, '2018-11-19', 12025000, 'ciputat', 'banten', 25000, 'Finish', 'TIKI12123'),
(37, 30, 2, '2018-11-20', 3425000, 'jl. cimandiri rt5', 'banten', 25000, 'Finish', 'JNE123456'),
(38, 30, 2, '2018-11-20', 2425000, 'cipayung', 'banten', 25000, 'Finish', 'JNE10102910'),
(39, 49, 1, '2018-11-20', 520000, 'cimandiri', 'jakarta', 20000, 'pending', ''),
(42, 30, 1, '2018-11-21', 2420000, 'pamulang', 'jakarta', 20000, 'Finish', 'JNE001923129'),
(45, 30, 1, '2018-11-22', 420000, 'asdfghjk', 'jakarta', 20000, 'pending', ''),
(46, 49, 1, '2018-11-22', 4020000, 'asdasfasd', 'jakarta', 20000, 'pending', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_produk`
--

CREATE TABLE `pembelian_produk` (
  `id_pembelian_produk` int(11) NOT NULL,
  `id_pembelian` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `subberat` int(11) NOT NULL,
  `subharga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pembelian_produk`
--

INSERT INTO `pembelian_produk` (`id_pembelian_produk`, `id_pembelian`, `id_produk`, `jumlah`, `nama`, `harga`, `berat`, `subberat`, `subharga`) VALUES
(17, 19, 66, 2, 'Steelseries Siberia 100', 1200000, 1200, 2400, 2400000),
(18, 19, 63, 1, 'Steelseries Apex', 200000, 400, 400, 200000),
(19, 20, 63, 2, 'Steelseries Apex', 500000, 400, 800, 1000000),
(20, 20, 69, 1, 'AMD Ryzen 7', 5000000, 300, 300, 5000000),
(21, 21, 67, 2, 'Casing Dazumba', 400000, 2000, 4000, 800000),
(22, 22, 69, 1, 'AMD Ryzen 7', 5000000, 300, 300, 5000000),
(23, 0, 69, 2, 'AMD Ryzen 7', 5000000, 300, 600, 10000000),
(24, 23, 70, 2, 'PC dekstop ASUS', 45000000, 10000, 20000, 90000000),
(25, 28, 59, 1, 'Headphone Razer', 700000, 500, 500, 700000),
(26, 29, 62, 1, 'VGA MSI GTX 750 Ti', 4000000, 700, 700, 4000000),
(27, 30, 58, 2, 'Motherboard Asus X99', 4000000, 800, 1600, 8000000),
(28, 31, 68, 2, 'Intel I7 Gen 7th', 4000000, 300, 600, 8000000),
(29, 31, 70, 1, 'PC dekstop ASUS', 45000000, 10000, 10000, 45000000),
(30, 32, 68, 3, 'Intel I7 Gen 7th', 4000000, 300, 900, 12000000),
(31, 32, 69, 5, 'AMD Ryzen 7', 5000000, 300, 1500, 25000000),
(32, 33, 71, 9, 'Mouse X7', 200000, 300, 2700, 1800000),
(33, 0, 67, 1, 'Casing Dazumba', 400000, 2000, 2000, 400000),
(34, 34, 70, 1, 'PC dekstop ASUS', 45000000, 10000, 10000, 45000000),
(35, 35, 62, 3, 'VGA MSI GTX 750 Ti', 4000000, 700, 2100, 12000000),
(36, 36, 68, 3, 'Intel I7 Gen 7th', 4000000, 300, 900, 12000000),
(37, 37, 66, 2, 'Steelseries Siberia 100', 1200000, 1200, 2400, 2400000),
(38, 37, 63, 2, 'Steelseries Apex', 500000, 400, 800, 1000000),
(39, 38, 66, 2, 'Steelseries Siberia 100', 1200000, 1200, 2400, 2400000),
(40, 39, 63, 1, 'Steelseries Apex', 500000, 400, 400, 500000),
(41, 40, 59, 2, 'Headphone Razer', 700000, 500, 1000, 1400000),
(42, 41, 59, 2, 'Headphone Razer', 700000, 500, 1000, 1400000),
(43, 42, 59, 2, 'Headphone Razer', 700000, 500, 1000, 1400000),
(44, 43, 59, 2, 'Headphone Razer', 700000, 500, 1000, 1400000),
(45, 44, 59, 2, 'Headphone Razer', 700000, 500, 1000, 1400000),
(46, 40, 63, 2, 'Steelseries Apex', 500000, 400, 800, 1000000),
(47, 0, 59, 2, 'Headphone Razer', 700000, 500, 1000, 1400000),
(48, 42, 66, 2, 'Steelseries Siberia 100', 1200000, 1200, 2400, 2400000),
(49, 43, 70, 2, 'PC dekstop ASUS', 45000000, 10000, 20000, 90000000),
(50, 0, 67, 1, 'Casing Dazumba', 400000, 2000, 2000, 400000),
(51, 45, 67, 1, 'Casing Dazumba', 400000, 2000, 2000, 400000),
(52, 43, 65, 1, 'Mouse Logitech', 100000, 200, 200, 100000),
(53, 43, 63, 1, 'Steelseries Apex', 500000, 400, 400, 500000),
(54, 44, 63, 1, 'Steelseries Apex', 500000, 400, 400, 500000),
(55, 44, 65, 1, 'Mouse Logitech', 100000, 200, 200, 100000),
(56, 45, 67, 1, 'Casing Dazumba', 400000, 2000, 2000, 400000),
(57, 46, 62, 1, 'VGA MSI GTX 750 Ti', 4000000, 700, 700, 4000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(100) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `kategori_produk` varchar(25) NOT NULL,
  `brand_produk` varchar(25) NOT NULL,
  `harga_produk` int(100) NOT NULL,
  `berat_produk` int(11) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `deskripsi_produk` text NOT NULL,
  `foto_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `kategori_produk`, `brand_produk`, `harga_produk`, `berat_produk`, `stok_produk`, `deskripsi_produk`, `foto_produk`) VALUES
(58, 'Motherboard Asus X99', 'motherboard', 'Asus', 4000000, 800, 90, 'Motherboard Terbaru dari Asus										', 'ASUS_ROG_Strix_X99_Gaming_600.jpg'),
(59, 'Headphone Razer', 'headphone', 'Razer', 700000, 500, 48, '						Headphone bagus				', 'headset.jpg'),
(62, 'VGA MSI GTX 750 Ti', 'vga', 'Msi', 4000000, 700, 66, 'GTX 750/1gb,/ddr5/128bit, MSI...no power...\r\nVga hemat listrik,barang baru,minus box aja...\r\nBUKA SEGEL plastik HANYA TEST AJA..\r\nGARANSI PERSON 3X24JAM			', 'vga.jpg'),
(63, 'Steelseries Apex', 'keyboard', 'Steelseries', 500000, 400, 43, '			qwertyui		', 'keyboard.png'),
(65, 'Mouse Logitech', 'mouse', 'Logitech', 100000, 200, 188, 'mouse gaming terbaru				', 'mouse.jpg'),
(66, 'Steelseries Siberia 100', 'headphone', 'Steelseries', 1200000, 1200, 74, 'Headphone beragaransi 2 tahun		', 'siberia.jpg'),
(67, 'Casing Dazumba', 'casing', 'Dazumba', 400000, 2000, 6, 'Casing Bergaransai resmi 3 tahun ', 'casing.jpg'),
(68, 'Intel I7 Gen 7th', 'processor', 'Intel', 4000000, 300, 44, 'Intel I7 generasi ke-7', 'inteli7.jpg'),
(69, 'AMD Ryzen 7', 'processor', 'Amd', 5000000, 300, 50, '			- Graphics Model: Discrete Graphics Card Required\r\n- CPU Cores: 8 \r\n- Threads: 16 \r\n- Max Boost Clock: 4.1GHz \r\n- Base Clock: 3.2GHz \r\n- Thermal Solution: Wraith Spire with RGB LED \r\n- Default TDP / TDP: 65W										', 'ryzen7.jpg'),
(70, 'PC dekstop ASUS', 'dekstop', 'Asus', 45000000, 10000, 77, 'PC terbaru dari asus', 'dekstopasus.jpg'),
(71, 'Mouse X7', 'mouse', 'Logitech', 200000, 300, 60, 'mouse baru', '1.jpg'),
(72, 'Razer Deathadder', 'mouse', 'Razer', 500000, 1000, 0, 'Razer Baru dari razer', 'razer deathadder.jpg'),
(73, 'Razer Kraken Pewdiepie', 'headphone', 'Razer', 1200000, 1000, 0, 'Razer Kraver Pewdiepie Edition', 'kraken merah.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indeks untuk tabel `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indeks untuk tabel `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indeks untuk tabel `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indeks untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id_ongkir`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indeks untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_ongkir` (`id_ongkir`);

--
-- Indeks untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  ADD PRIMARY KEY (`id_pembelian_produk`);

--
-- Indeks untuk tabel `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id_ongkir` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `pembelian_produk`
--
ALTER TABLE `pembelian_produk`
  MODIFY `id_pembelian_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT untuk tabel `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_ongkir`) REFERENCES `ongkir` (`id_ongkir`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
