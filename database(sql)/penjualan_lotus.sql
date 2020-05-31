-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2020 at 06:04 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualan_lotus`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `barang_barcode` varchar(30) DEFAULT NULL,
  `barang_nama` varchar(100) NOT NULL,
  `barang_tipe` varchar(100) DEFAULT NULL,
  `barang_stock` int(100) DEFAULT NULL,
  `barang_panjang` int(100) DEFAULT NULL,
  `barang_lebar` int(100) DEFAULT NULL,
  `barang_harga` int(20) DEFAULT NULL,
  `barang_lokasi` int(11) NOT NULL,
  `barang_kbarcode` varchar(255) DEFAULT NULL,
  `barang_kdimensi` varchar(255) DEFAULT NULL,
  `barang_status` tinyint(1) DEFAULT NULL,
  `barang_opid` int(11) DEFAULT NULL,
  `barang_tdiubah` datetime DEFAULT NULL,
  `subkategori_id` int(11) DEFAULT NULL,
  `barang_image` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`barang_id`, `barang_barcode`, `barang_nama`, `barang_tipe`, `barang_stock`, `barang_panjang`, `barang_lebar`, `barang_harga`, `barang_lokasi`, `barang_kbarcode`, `barang_kdimensi`, `barang_status`, `barang_opid`, `barang_tdiubah`, `subkategori_id`, `barang_image`) VALUES
(1, '1001', 'Frame 4 R - Batangan Kayu', 'Barang Produksi', 10, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 10:34:10', 1, NULL),
(2, '1002', 'Frame 4 R - motif', 'Barang Produksi', 10, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 04:40:07', 1, NULL),
(3, '1009', 'Bingkai Foto Minimalis 10R', 'Barang Produksi', 10, 20, 10, 500000, 2, NULL, NULL, 2, 1, '2020-03-18 05:14:22', 3, NULL),
(5, '1003', 'Bingkai foto ukir 21 cm x 30 cm A4', 'Barang Produksi', 10, 20, 10, 500000, 1, NULL, NULL, 2, 1, '2020-03-18 10:35:23', 12, NULL),
(6, '1001', 'Frame/Bingkai A4 21X30', 'Barang Produksi', 10, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 10:34:10', 12, NULL),
(7, '1002', 'Bingkai 9Pcs 7 Inch Bingkai Foto Foto Dinding Set Bingkai', 'Barang Produksi', 10, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 04:40:07', 10, NULL),
(8, '1009', 'Lotus Frame 25x25 MF Hitam', 'Barang Produksi', 10, 20, 10, 500000, 2, NULL, NULL, 2, 1, '2020-03-18 05:14:22', 9, NULL),
(9, '1003', 'Lotus Frame 25x25 MF Putih', 'Barang Produksi', 20, 20, 10, 500000, 1, NULL, NULL, 2, 1, '2020-03-18 10:35:23', 9, NULL),
(10, '1001', 'Lotus Frame 25x25 MF Pink', 'Barang Produksi', 11, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 10:34:10', 9, NULL),
(11, '1002', 'Lotus Frame 25x25 MF Gold', 'Barang Produksi', 10, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 04:40:07', 9, NULL),
(12, '1009', 'Lotus Frame 10 R MH Hitam', 'Barang Produksi', 10, 20, 10, 500000, 2, NULL, NULL, 2, 1, '2020-03-18 05:14:22', 3, NULL),
(13, '1003', 'Lotus Frame 10 R TB+linen', 'Barang Produksi', 20, 20, 10, 500000, 1, NULL, NULL, 2, 1, '2020-03-18 10:35:23', 3, NULL),
(14, '1001', 'Lotus Frame 10 R TBS WOOD', 'Barang Produksi', 11, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 10:34:10', 3, NULL),
(15, '1002', 'Lotus Frame 5 R MB Putih', 'Barang Produksi', 10, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 04:40:07', 2, NULL),
(16, '1009', 'Lotus Frame 5 R MB Hitam', 'Barang Produksi', 10, 20, 10, 500000, 2, NULL, NULL, 2, 1, '2020-03-18 05:14:22', 2, NULL),
(17, '1003', 'Lotus Frame 16 R KT Silver', 'Barang Produksi', 20, 20, 10, 500000, 1, NULL, NULL, 2, 1, '2020-03-18 10:35:23', 7, NULL),
(18, '1001', 'Lotus Frame 16 R KT Gold', 'Barang Produksi', 11, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 10:34:10', 7, NULL),
(19, '1002', 'Lotus Frame 10 R KW Silver', 'Barang Produksi', 10, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 04:40:07', 3, NULL),
(20, '1009', 'Lotus Frame 10 R KW Putih', 'Barang Produksi', 10, 20, 10, 500000, 2, NULL, NULL, 2, 1, '2020-03-18 05:14:22', 3, NULL),
(21, '1003', 'Tinta lukis', 'Barang Jadi', 20, 20, 10, 500000, 1, NULL, NULL, 2, 1, '2020-03-18 10:35:23', 5, NULL),
(22, '1001', 'Cat Air', 'Barang Jadi', 11, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 10:34:10', 5, NULL),
(23, '1002', 'Kanvas Lukis', 'Barang Jadi', 10, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 04:40:07', 5, NULL),
(24, '1009', 'Kuas Lukis', 'Barang Jadi', 10, 20, 10, 500000, 2, NULL, NULL, 2, 1, '2020-03-18 05:14:22', 5, NULL),
(25, '1003', 'Jam Diinding Gold', 'Barang Jadi', 20, 20, 10, 500000, 1, NULL, NULL, 2, 1, '2020-03-18 10:35:23', 6, NULL),
(26, '1001', 'Bingkai Kayu Lukisan Kanvas', 'Barang Produksi', 11, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 10:34:10', 12, NULL),
(27, '1002', 'Album Foto TOP DLM KB', 'Barang Jadi', 10, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 04:40:07', 14, NULL),
(28, '1009', 'Album Foto TOP MIDI KB', 'Barang Jadi', 10, 20, 10, 500000, 2, NULL, NULL, 2, 1, '2020-03-18 05:14:22', 14, NULL),
(29, '1003', 'Lotus Frame LIPAT 3 3 R MF Hitam', 'Barang Produksi', 20, 20, 10, 500000, 1, NULL, NULL, 2, 1, '2020-03-18 10:35:23', 13, NULL),
(30, '1001', 'Lotus Frame Mahar 16 R KT', 'Barang Produksi', 11, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 10:34:10', 8, NULL),
(31, '1002', 'Jam Rollens Allah Black', 'Barang Jadi', 10, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 04:40:07', 6, NULL),
(32, '1009', 'Jam Kaligrafi', 'Barang Jadi', 20, 20, 10, 500000, 2, NULL, NULL, 2, 1, '2020-03-18 05:14:22', 6, NULL),
(33, '1003', 'Lotus Frame SHL 20x25', 'Barang Produksi', 20, 20, 10, 500000, 1, NULL, NULL, 2, 1, '2020-03-18 10:35:23', 12, NULL),
(34, '1001', 'Lotus Frame Keluarga 12 R Pink', 'Barang Produksi', 11, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 10:34:10', 4, NULL),
(35, '1002', 'Lotus Frame ST4 10 R (20x25) Putih', 'Barang Produksi', 10, 20, 10, 30000, 1, NULL, NULL, 1, 1, '2020-03-18 04:40:07', 3, NULL),
(36, '1009', 'Box 3D/Scrapbook Kayu Minimalis 3cm', 'Barang Prosuksi', 10, 20, 10, 500000, 2, NULL, NULL, 2, 1, '2020-03-18 05:14:22', 12, NULL),
(37, '1003', 'Lotus Frame 24 R (50x60cm)', 'Barang Produksi', 20, 20, 10, 500000, 1, NULL, NULL, 2, 1, '2020-03-18 10:35:23', 11, NULL),
(38, '1001', 'Lotus Frame 2D Hitam + Minimalis Merah', 'Barang Produksi', 11, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 10:34:10', 12, NULL),
(39, '1002', 'Kotak Mahar 30x40cm kayu ukiran 5cm', 'Barang Produksi', 10, 20, 10, 500000, 1, NULL, NULL, 1, 1, '2020-03-18 04:40:07', 8, NULL),
(40, '1009', 'Lotus Frame ST4 10 R (20x25) Black', 'Barang Produksi', 5, 20, 10, 30000, 2, NULL, NULL, 2, 1, '2020-03-18 05:14:22', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bayar_nota_beli`
--

CREATE TABLE `bayar_nota_beli` (
  `id_bayar` bigint(20) NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `no_nota_beli` varchar(35) DEFAULT NULL,
  `jenis` enum('Transfer','Tunai','Retur','Giro') DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `pengirim_bank` varchar(50) DEFAULT NULL,
  `pengirim_nama` varchar(100) DEFAULT NULL,
  `pengirim_no` varchar(20) DEFAULT NULL,
  `penerima_bank` varchar(50) DEFAULT NULL,
  `penerima_nama` varchar(100) DEFAULT NULL,
  `penerima_no` varchar(20) DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `keterangan` text,
  `sisa` double DEFAULT NULL,
  `status_giro` tinyint(1) DEFAULT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `no_retur_beli` varchar(35) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bayar_nota_jual`
--

CREATE TABLE `bayar_nota_jual` (
  `id_bayar` bigint(20) NOT NULL,
  `tgl_bayar` date DEFAULT NULL,
  `transaksi_id` varchar(20) DEFAULT NULL,
  `jenis` enum('Transfer','Tunai') DEFAULT NULL,
  `jumlah` double DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `pengirim_bank` varchar(50) DEFAULT NULL,
  `pengirim_nama` varchar(100) DEFAULT NULL,
  `pengirim_no` varchar(20) DEFAULT NULL,
  `penerima_bank` varchar(50) DEFAULT NULL,
  `penerima_nama` varchar(100) DEFAULT NULL,
  `penerima_no` varchar(20) DEFAULT NULL,
  `jatuh_tempo` date DEFAULT NULL,
  `keterangan` text,
  `status_giro` tinyint(1) DEFAULT NULL,
  `sisa` double NOT NULL,
  `id_karyawan` int(11) DEFAULT NULL,
  `no_retur_jual` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bayar_nota_jual`
--

INSERT INTO `bayar_nota_jual` (`id_bayar`, `tgl_bayar`, `transaksi_id`, `jenis`, `jumlah`, `status`, `pengirim_bank`, `pengirim_nama`, `pengirim_no`, `penerima_bank`, `penerima_nama`, `penerima_no`, `jatuh_tempo`, `keterangan`, `status_giro`, `sisa`, `id_karyawan`, `no_retur_jual`) VALUES
(14, '2020-05-29', 'NJ-200328-001', '', 2000000, 0, '', '', '', '', '', '', NULL, NULL, NULL, 500000, 0, NULL),
(15, '2020-05-29', 'NJ-200328-001', '', 500000, 1, '', '', '', '', '', '', NULL, NULL, NULL, 0, 0, NULL),
(16, '2020-05-29', 'NJ-200401-001', '', 500000, 0, '', '', '', '', '', '', NULL, NULL, NULL, 2000000, 0, NULL),
(18, '2020-05-29', 'NJ-200401-001', '', 250000, 0, '', '', '', '', '', '', NULL, NULL, NULL, 1750000, 0, NULL),
(19, '2020-05-29', 'NJ-200401-002', '', 20000, 0, '', '', '', '', '', '', NULL, NULL, NULL, 4980000, 0, NULL),
(20, '2020-05-29', 'NJ-200401-001', '', 1700000, 0, '', '', '', '', '', '', NULL, NULL, NULL, 50000, 0, NULL),
(21, '2020-05-30', 'NJ-200404-001', '', 7500000, 1, '', '', '', '', '', '', NULL, NULL, NULL, 0, 0, NULL),
(22, '2020-05-30', 'NJ-200401-001', '', 50000, 1, '', '', '', '', '', '', NULL, NULL, NULL, 0, 0, NULL),
(23, '2020-05-30', 'NJ-200401-002', '', 200000, 0, '', '', '', '', '', '', NULL, NULL, NULL, 4780000, 0, NULL),
(24, '2020-05-30', 'NJ-200401-002', '', 500000, 0, '', '', '', '', '', '', NULL, NULL, NULL, 4280000, 0, NULL),
(25, '2020-05-30', 'NJ-200401-002', '', 4280000, 1, '', '', '', '', '', '', NULL, NULL, NULL, 0, 0, NULL),
(26, '2020-05-30', 'NJ-200401-002', '', 0, 1, '', '', '', '', '', '', NULL, NULL, NULL, 0, 0, NULL),
(27, '2020-05-30', 'NJ-200401-002', '', 0, 1, '', '', '', '', '', '', NULL, NULL, NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blok`
--

CREATE TABLE `blok` (
  `blok_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `blok_nama` varchar(100) NOT NULL,
  `blok_tipe` varchar(100) DEFAULT NULL,
  `blok_status` tinyint(1) NOT NULL,
  `blok_opid` int(11) DEFAULT NULL,
  `blok_tdiubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blok`
--

INSERT INTO `blok` (`blok_id`, `unit_id`, `blok_nama`, `blok_tipe`, `blok_status`, `blok_opid`, `blok_tdiubah`) VALUES
(1, 1, 'Dummy blok 1', 'Blok bahan baku', 1, 1, '2020-04-09 09:32:14'),
(2, 2, 'Dummy blok 2', 'Blok Barang Produksi', 1, 1, '2020-04-09 09:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `hakakses`
--

CREATE TABLE `hakakses` (
  `hakakses_id` int(11) NOT NULL,
  `karyawan_id` int(11) NOT NULL,
  `hakakses_level` int(11) DEFAULT NULL,
  `hakakses_access` varchar(300) DEFAULT NULL,
  `user_lihat` tinyint(4) DEFAULT '0',
  `user_tambah` tinyint(4) DEFAULT '0',
  `user_ubah` tinyint(4) DEFAULT '0',
  `user_hapus` tinyint(4) DEFAULT '0',
  `android` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hakakses`
--

INSERT INTO `hakakses` (`hakakses_id`, `karyawan_id`, `hakakses_level`, `hakakses_access`, `user_lihat`, `user_tambah`, `user_ubah`, `user_hapus`, `android`) VALUES
(31, 4, 0, '1', 1, 1, 1, 0, 0),
(32, 3, 0, '1', 1, 0, 0, 0, 0),
(33, 3, 0, '4', 1, 0, 1, 0, 0),
(34, 3, 0, '19', 1, 1, 1, 1, 0),
(35, 5, 0, '1', 1, 1, 0, 0, 0),
(36, 5, 0, '3', 1, 1, 0, 0, 0),
(37, 6, 0, '1', 1, 1, 1, 1, 0),
(38, 6, 0, '2', 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `karyawan_id` int(11) NOT NULL,
  `karyawan_nama` varchar(100) NOT NULL,
  `karyawan_user` varchar(12) NOT NULL,
  `karyawan_pass` varchar(50) NOT NULL,
  `karyawan_iplokasi` varchar(30) DEFAULT NULL,
  `karyawan_job` varchar(20) DEFAULT NULL,
  `hakakses_level` tinyint(1) NOT NULL,
  `karyawan_ktp` varchar(17) DEFAULT NULL,
  `karyawan_nohp` varchar(100) DEFAULT NULL,
  `karyawan_gbulanan` double DEFAULT NULL,
  `karyawan_gharian` double DEFAULT NULL,
  `karyawan_status` tinyint(1) DEFAULT NULL,
  `karyawan_opid` int(11) DEFAULT NULL,
  `karyawan_tdiubah` datetime DEFAULT NULL,
  `karyawan_alamat` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`karyawan_id`, `karyawan_nama`, `karyawan_user`, `karyawan_pass`, `karyawan_iplokasi`, `karyawan_job`, `hakakses_level`, `karyawan_ktp`, `karyawan_nohp`, `karyawan_gbulanan`, `karyawan_gharian`, `karyawan_status`, `karyawan_opid`, `karyawan_tdiubah`, `karyawan_alamat`) VALUES
(1, 'Arnold', 'developer', 'developer1234', NULL, 'DEVELOPER', 0, NULL, NULL, NULL, NULL, 0, NULL, '2020-03-06 00:00:00', NULL),
(2, 'Arnold', 'tester', 'developer1234', NULL, 'TESTER', 0, NULL, NULL, NULL, NULL, 0, NULL, '2020-03-06 00:00:00', NULL),
(3, 'Gallery', 'gallery', '123', NULL, 'Gallery', 1, NULL, NULL, NULL, NULL, 1, 1, '2020-03-23 07:44:31', NULL),
(4, 'Gudang', 'gudang', '123', '1', 'Gudang', 1, '', '', 0, 0, 1, 1, '2020-03-13 11:15:30', NULL),
(5, 'Sales', 'sales', '123', NULL, 'Sales', 1, NULL, NULL, NULL, NULL, 1, 3, '2020-03-23 08:27:45', NULL),
(6, 'Admin Web', 'admin', '123', NULL, 'Admin', 0, '', '', 0, 0, 1, 3, '2020-03-23 09:09:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL,
  `kategori_kode` varchar(10) NOT NULL,
  `kategori_nama` varchar(100) NOT NULL,
  `kategori_status` tinyint(1) NOT NULL,
  `kategori_opid` int(11) DEFAULT NULL,
  `kategori_tdiubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `kategori_kode`, `kategori_nama`, `kategori_status`, `kategori_opid`, `kategori_tdiubah`) VALUES
(2, 'K-001', 'Frame / Bingkai', 1, 1, '2020-03-23 11:13:53'),
(3, 'K-002', 'Album Foto', 1, 1, '2020-03-23 11:19:00'),
(4, 'K-003', 'Tinta', 1, 1, '2020-03-23 09:28:32'),
(5, 'K-004', 'Lukis', 1, 1, '2020-03-03 12:12:12'),
(6, 'K-005', 'Jam', 1, 1, '2020-03-03 12:12:12'),
(7, 'K-006', 'Kotak Mahar', 1, 1, '2020-03-03 12:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `komposisi`
--

CREATE TABLE `komposisi` (
  `komposisi_id` int(255) NOT NULL,
  `barang_barcode` int(255) NOT NULL,
  `material_barcode` int(255) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `komposisi_panjang` int(255) DEFAULT NULL,
  `komposisi_lebar` int(255) DEFAULT NULL,
  `komposisi_tinggi` int(255) DEFAULT NULL,
  `komposisi_berat` int(255) DEFAULT NULL,
  `komposisi_qty` double DEFAULT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `komposisi_edit` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komposisi`
--

INSERT INTO `komposisi` (`komposisi_id`, `barang_barcode`, `material_barcode`, `material_id`, `komposisi_panjang`, `komposisi_lebar`, `komposisi_tinggi`, `komposisi_berat`, `komposisi_qty`, `barang_id`, `komposisi_edit`) VALUES
(1, 1001, 1001, 1, 120, 40, 50, 40, 2, 1, 1),
(2, 1001, 1002, 2, 20, 22, 3, 0, 1, 1, 1),
(3, 1005, 1001, 1, 233, 45, 73, 89, 1, 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `material_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `material_barcode` varchar(30) DEFAULT NULL,
  `material_lokasi` varchar(15) DEFAULT NULL,
  `material_nama` varchar(100) NOT NULL,
  `material_tipe` varchar(40) DEFAULT NULL,
  `satuan_id` tinyint(4) DEFAULT NULL,
  `material_panjang` double DEFAULT NULL,
  `material_lebar` double DEFAULT NULL,
  `material_tinggi` double DEFAULT NULL,
  `material_berat` double DEFAULT NULL,
  `material_stok` int(100) DEFAULT NULL,
  `material_status` tinyint(1) DEFAULT NULL,
  `material_opid` int(11) DEFAULT NULL,
  `material_tdiubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_id`, `supplier_id`, `material_barcode`, `material_lokasi`, `material_nama`, `material_tipe`, `satuan_id`, `material_panjang`, `material_lebar`, `material_tinggi`, `material_berat`, `material_stok`, `material_status`, `material_opid`, `material_tdiubah`) VALUES
(1, 1, '1001', '1', 'Kayu', 'Bahan Baku', 1, 400, 15, 15, 4000, 12, 1, 1, '2020-03-18 04:44:57'),
(2, 2, '1002', '2', 'Kaca', 'Bahan Baku', 1, 100, 100, 15, 1000, 11, 1, 1, '2020-03-18 04:59:37'),
(3, 1, '1003', '1', 'Paku', 'Bahan Baku', 2, 200, 100, 20, 2000, 13, NULL, 1, '2020-03-18 10:29:52'),
(4, 2, '1004', '1', 'Tali', 'Bahan Baku', 1, 400, 15, 15, 4000, 10, 0, 1, '2020-03-17 09:15:55'),
(5, 2, '1005', '1', 'Pengait', 'Bahan Baku', 4, 100, 100, 15, 1000, 5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_utamahakakses`
--

CREATE TABLE `menu_utamahakakses` (
  `id_menu_utama` int(11) NOT NULL,
  `nama_menu` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu_utamahakakses`
--

INSERT INTO `menu_utamahakakses` (`id_menu_utama`, `nama_menu`) VALUES
(1, 'Master'),
(2, 'Konfirmasi'),
(3, 'Nota'),
(4, 'Unit'),
(5, 'Transaksi'),
(6, 'Keuangan'),
(7, 'Aktifitas'),
(8, 'Laporan');

-- --------------------------------------------------------

--
-- Table structure for table `mst_hakakses`
--

CREATE TABLE `mst_hakakses` (
  `id_akses` int(11) NOT NULL,
  `menu` varchar(225) NOT NULL,
  `lihat` tinyint(1) NOT NULL,
  `tambah` tinyint(1) NOT NULL,
  `ubah` tinyint(1) NOT NULL,
  `hapus` tinyint(1) NOT NULL,
  `android` tinyint(1) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mst_hakakses`
--

INSERT INTO `mst_hakakses` (`id_akses`, `menu`, `lihat`, `tambah`, `ubah`, `hapus`, `android`, `id_menu`) VALUES
(1, 'Master Karyawan', 1, 1, 1, 1, 0, 1),
(2, 'Master Hak Akses', 1, 1, 1, 1, 0, 1),
(3, 'Master Barang', 1, 1, 1, 1, 0, 1),
(4, 'Master Supplier', 1, 1, 1, 1, 0, 1),
(5, 'Master Pelanggan', 1, 1, 1, 1, 0, 1),
(6, 'Master Satuan', 1, 1, 1, 1, 0, 1),
(7, 'Master Kategori', 1, 1, 1, 1, 0, 1),
(8, 'Master Sub Kategori', 1, 1, 1, 1, 0, 1),
(9, 'Master Rekening', 1, 1, 1, 1, 0, 1),
(10, 'Master Unit', 1, 1, 1, 1, 0, 1),
(11, 'Master Produksi', 1, 1, 1, 1, 0, 1),
(12, 'Master Perusahaan', 1, 1, 1, 1, 0, 1),
(13, 'Konfirmasi', 1, 1, 1, 1, 0, 2),
(14, 'Tutup Nota', 1, 1, 1, 1, 0, 3),
(15, 'Riwayat Tutup Nota', 1, 1, 1, 1, 0, 3),
(16, 'Gudang Material', 1, 1, 1, 1, 0, 4),
(17, 'Gudang Barang Jadi', 1, 1, 1, 1, 0, 4),
(18, 'Gallery', 1, 1, 1, 1, 0, 4),
(19, 'Transaksi Pembelian', 1, 1, 1, 1, 0, 5),
(20, 'Transaksi Retur Beli', 1, 1, 1, 1, 0, 5),
(21, 'Transaksi Bayar Nota Beli', 1, 1, 1, 1, 0, 5),
(22, 'Transaksi Pencaran Giro Beli', 1, 1, 1, 1, 0, 5),
(23, 'Transaksi Penjualan', 1, 1, 1, 1, 0, 5),
(24, 'Transaksi Retur Jual', 1, 1, 1, 1, 0, 5),
(25, 'Transaksi Bayar Nota Jual', 1, 1, 1, 1, 0, 5),
(26, 'Transaksi Pencairan Giro Jual', 1, 1, 1, 1, 0, 5),
(27, 'Transaksi POS', 1, 1, 1, 1, 0, 5),
(28, 'Transaksi Void Pembatalan', 1, 1, 1, 1, 0, 5),
(29, 'Transaksi Setoran POS', 1, 1, 1, 1, 0, 5),
(30, 'Kas Kecil', 1, 1, 1, 1, 0, 6),
(31, 'Master Komposisi', 1, 1, 0, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mutasi_retur`
--

CREATE TABLE `mutasi_retur` (
  `id_mutasi_retur` int(11) NOT NULL,
  `id_retur_jual` int(11) DEFAULT NULL,
  `id_retur_jual_detail` int(11) DEFAULT NULL,
  `penyimpanan_id` int(11) DEFAULT NULL,
  `qty_simpan` double DEFAULT NULL,
  `operator_id` int(11) DEFAULT '0',
  `tanggal` datetime DEFAULT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int(11) NOT NULL,
  `pelanggan_nama` varchar(100) NOT NULL,
  `pelanggan_alamat` text NOT NULL,
  `pelanggan_bank` varchar(30) DEFAULT NULL,
  `pelanggan_rekening` varchar(30) DEFAULT NULL,
  `pelanggan_kontak` varchar(15) NOT NULL,
  `pelanggan_cpnama` varchar(100) NOT NULL,
  `pelanggan_cptelpon` varchar(15) NOT NULL,
  `pelanggan_status` tinyint(1) NOT NULL,
  `pelanggan_opid` int(11) NOT NULL,
  `pelanggan_tdiubah` datetime NOT NULL,
  `pelanggan_plafon` double DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `pelanggan_nama`, `pelanggan_alamat`, `pelanggan_bank`, `pelanggan_rekening`, `pelanggan_kontak`, `pelanggan_cpnama`, `pelanggan_cptelpon`, `pelanggan_status`, `pelanggan_opid`, `pelanggan_tdiubah`, `pelanggan_plafon`) VALUES
(1, 'Pelanggan Umum', '-', '-', '-', '-', '-', '-', 1, 1, '2020-03-16 10:10:10', 10000000),
(2, 'Toko Amanah', 'Lampung', '9', '9y9', 'knk', 'jbjb', '99', 0, 1, '2020-03-23 15:26:44', 10000000),
(3, 'Studio Foto Bunga', 'Bandar Lampung', '1', '1', '1', '1', '1', 1, 1, '2020-03-03 12:12:12', 10000000),
(4, 'H. Ahmad Junaidi', 'Langkapura', '2', '2', '2', '2', '2', 1, 1, '2020-03-22 12:12:12', 10000000),
(5, 'Toko Maya', 'Kemiling', '4', '4', '3', '4', '4', 1, 1, '2020-03-02 12:12:12', 10000000),
(6, 'Gallery Arjuna', 'Way Halim', '4', '4', '3', '4', '4', 1, 1, '2020-03-02 12:12:12', 10000000),
(7, 'The Art Studio', 'Way Halim', '4', '4', '3', '4', '4', 1, 1, '2020-03-02 12:12:12', 10000000),
(8, 'Toserba Budi', 'Way Halim', '4', '4', '3', '4', '4', 1, 1, '2020-03-02 12:12:12', 10000000),
(9, 'Toko Yanti', 'Kedaton', '4', '4', '3', '4', '4', 1, 1, '2020-03-02 12:12:12', 10000000),
(10, 'Toko Barokah', 'Kedaton', '4', '4', '3', '4', '4', 1, 1, '2020-03-02 12:12:12', 10000000);

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `pembelian_id` int(11) NOT NULL,
  `pembelian_tipe` tinyint(1) DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `pembelian_expedisi` varchar(30) DEFAULT NULL,
  `karyawan_id` int(11) DEFAULT NULL,
  `pembelian_dimensi` int(100) DEFAULT NULL,
  `pembelian_jumlah` int(30) NOT NULL,
  `pembelian_harga` double DEFAULT '0',
  `pembelian_diskon` double DEFAULT '0',
  `pembelian_status` tinyint(1) DEFAULT NULL,
  `pembelian_opid` int(11) DEFAULT NULL,
  `pembelian_tdiubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`pembelian_id`, `pembelian_tipe`, `transaksi_id`, `supplier_id`, `material_id`, `pembelian_expedisi`, `karyawan_id`, `pembelian_dimensi`, `pembelian_jumlah`, `pembelian_harga`, `pembelian_diskon`, `pembelian_status`, `pembelian_opid`, `pembelian_tdiubah`) VALUES
(1, 1, 1, 5, 1, NULL, NULL, NULL, 2, 12000, 2, 0, 1, '2020-03-27 11:41:02'),
(2, 1, 9, 8, 1, NULL, NULL, NULL, 22, 2000, 0, 0, 1, '2020-03-27 23:14:18'),
(3, 1, 10, 5, 1, NULL, NULL, NULL, 23, 6000, 0, 0, 1, '2020-03-27 23:17:34'),
(7, 1, 13, 8, 1, NULL, NULL, NULL, 22, 2000, 0, 0, 1, '2020-03-28 10:16:55'),
(8, 1, 13, 8, 2, NULL, NULL, NULL, 10, 10000, 5, 0, 1, '2020-03-28 10:18:44'),
(9, 1, 15, 8, 1, NULL, NULL, NULL, 222, 10000, 0, 0, 1, '2020-03-28 10:26:21'),
(13, 1, 16, 5, 1, NULL, NULL, NULL, 200, 12000, 0, 0, 1, '2020-03-28 10:33:09'),
(14, 1, 17, 10, 1, NULL, NULL, NULL, 20, 2000, 0, 0, 1, '2020-03-30 10:37:49'),
(18, 1, 18, 8, 6, NULL, NULL, NULL, 30, 4000, 0, 0, 1, '2020-03-30 20:15:28'),
(19, 1, 18, 8, 1, NULL, NULL, NULL, 444, 6000, 0, 0, 1, '2020-03-30 20:26:19'),
(20, 1, 19, 11, 1, NULL, NULL, NULL, 2, 2000, 0, 0, 1, '2020-04-01 11:06:41'),
(21, 1, 19, 11, 6, NULL, NULL, NULL, 120, 4000, 0, 0, 1, '2020-04-01 11:10:50'),
(22, 1, 19, 11, 2, NULL, NULL, NULL, 30, 10000, 0, 0, 1, '2020-04-01 11:14:40'),
(23, 1, 19, 11, 4, NULL, NULL, NULL, 2, 10000, 0, 0, 1, '2020-04-01 11:14:48'),
(24, 1, 20, 2, 1, NULL, NULL, NULL, 22, 2222, 0, 0, 1, '2020-04-01 12:20:37'),
(25, 1, 21, 8, 1, NULL, NULL, NULL, 20, 2000, 0, 0, 1, '2020-04-01 16:02:54'),
(26, 1, 21, 8, 2, NULL, NULL, NULL, 4, 6000, 0, 0, 1, '2020-04-01 16:04:00'),
(27, 1, 21, 8, 7, NULL, NULL, NULL, 20, 3000, 0, 0, 1, '2020-04-01 16:04:17'),
(28, 1, 23, 11, 1, NULL, NULL, NULL, 22, 2222, 0, 0, 1, '2020-04-04 00:51:09'),
(29, 1, 18, 8, 2, NULL, NULL, NULL, 20, 10000, 0, 0, 1, '2020-04-04 07:58:47'),
(30, 1, 25, 5, 1, NULL, NULL, NULL, 100, 29000, 0, 0, 1, '2020-04-04 13:47:25'),
(31, 1, 26, 5, 1, NULL, NULL, NULL, 2, 2, 0, 0, 1, '2020-04-14 10:56:11'),
(32, 1, 26, 5, 2, NULL, NULL, NULL, 2, 2, 0, 0, 1, '2020-04-14 10:56:15'),
(33, 1, 26, 5, 3, NULL, NULL, NULL, 2, 2, 0, 0, 1, '2020-04-14 10:56:16'),
(34, 1, 26, 5, 4, NULL, NULL, NULL, 2, 2, 0, 0, 1, '2020-04-14 10:56:17'),
(35, 1, 27, 9, 1, NULL, NULL, NULL, 20, 12000, 0, 0, 1, '2020-04-17 06:35:27'),
(36, 1, 27, 9, 2, NULL, NULL, NULL, 12, 10000, 5, 0, 1, '2020-04-17 06:35:59');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `penjualan_id` int(11) NOT NULL,
  `penjualan_tipe` tinyint(1) DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `pelanggan_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `penjualan_proses` tinyint(1) DEFAULT NULL,
  `karyawan_id` int(11) DEFAULT NULL,
  `penjualan_dimensi` int(100) DEFAULT NULL,
  `penjualan_jumlah` int(30) NOT NULL,
  `penjualan_status` tinyint(1) DEFAULT NULL,
  `penjualan_opid` int(11) DEFAULT NULL,
  `penjualan_tdiubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`penjualan_id`, `penjualan_tipe`, `transaksi_id`, `pelanggan_id`, `barang_id`, `penjualan_proses`, `karyawan_id`, `penjualan_dimensi`, `penjualan_jumlah`, `penjualan_status`, `penjualan_opid`, `penjualan_tdiubah`) VALUES
(1, 1, 16, 2, 1, 0, 1, NULL, 5, 1, 1, NULL),
(3, 1, 19, 4, 1, 0, 1, NULL, 5, 1, 1, NULL),
(4, 1, 21, 5, 1, 0, 1, NULL, 5, 1, 1, NULL),
(5, 1, 23, 6, 1, 0, 1, NULL, 15, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `penyimpanan`
--

CREATE TABLE `penyimpanan` (
  `penyimpanan_id` int(11) NOT NULL,
  `barang_id` int(11) DEFAULT NULL,
  `blok_id` int(11) DEFAULT NULL,
  `qty` double DEFAULT NULL,
  `tanggal_buat` datetime DEFAULT NULL,
  `tanggal_edit` datetime DEFAULT NULL,
  `operator_edit_terakhir` int(11) DEFAULT NULL,
  `status_penyimpanan` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyimpanan`
--

INSERT INTO `penyimpanan` (`penyimpanan_id`, `barang_id`, `blok_id`, `qty`, `tanggal_buat`, `tanggal_edit`, `operator_edit_terakhir`, `status_penyimpanan`) VALUES
(1, 1, 2, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(2, 2, 2, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(3, 3, 2, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(4, 5, 2, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(5, 6, 2, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(6, 7, 2, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(7, 8, 2, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(8, 9, 2, 20, '2020-04-25 14:07:37', NULL, NULL, 0),
(9, 10, 2, 11, '2020-04-25 14:07:37', NULL, NULL, 0),
(10, 11, 2, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(11, 12, 2, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(12, 13, 2, 20, '2020-04-25 14:07:37', NULL, NULL, 0),
(13, 14, 2, 11, '2020-04-25 14:07:37', NULL, NULL, 0),
(14, 15, 2, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(15, 16, 2, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(16, 17, 2, 20, '2020-04-25 14:07:37', NULL, NULL, 0),
(17, 18, 2, 11, '2020-04-25 14:07:37', NULL, NULL, 0),
(18, 19, 2, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(19, 20, 2, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(20, 21, 2, 20, '2020-04-25 14:07:37', NULL, NULL, 0),
(21, 22, 1, 11, '2020-04-25 14:07:37', NULL, NULL, 0),
(22, 23, 1, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(23, 24, 1, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(24, 25, 1, 20, '2020-04-25 14:07:37', NULL, NULL, 0),
(25, 26, 1, 11, '2020-04-25 14:07:37', NULL, NULL, 0),
(26, 27, 1, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(27, 28, 1, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(28, 29, 1, 20, '2020-04-25 14:07:37', NULL, NULL, 0),
(29, 30, 1, 11, '2020-04-25 14:07:37', NULL, NULL, 0),
(30, 31, 1, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(31, 32, 1, 20, '2020-04-25 14:07:37', NULL, NULL, 0),
(32, 33, 1, 20, '2020-04-25 14:07:37', NULL, NULL, 0),
(33, 34, 1, 11, '2020-04-25 14:07:37', NULL, NULL, 0),
(34, 35, 1, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(35, 36, 1, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(36, 37, 1, 20, '2020-04-25 14:07:37', NULL, NULL, 0),
(37, 38, 1, 11, '2020-04-25 14:07:37', NULL, NULL, 0),
(38, 39, 1, 10, '2020-04-25 14:07:37', NULL, NULL, 0),
(39, 40, 1, 5, '2020-04-25 14:07:37', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pesanancustom`
--

CREATE TABLE `pesanancustom` (
  `pesanan_id` int(255) NOT NULL,
  `penjualan_id` int(11) DEFAULT NULL,
  `pesanan_panjang` int(255) DEFAULT NULL,
  `pesanan_lebar` int(255) DEFAULT NULL,
  `pesanan_qty` double DEFAULT NULL,
  `pesanan_harga` double DEFAULT NULL,
  `pesanan_status` tinyint(1) NOT NULL,
  `pesanan_opid` int(11) NOT NULL,
  `pesanan_tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanancustom`
--

INSERT INTO `pesanancustom` (`pesanan_id`, `penjualan_id`, `pesanan_panjang`, `pesanan_lebar`, `pesanan_qty`, `pesanan_harga`, `pesanan_status`, `pesanan_opid`, `pesanan_tanggal`) VALUES
(1, NULL, 120, 40, NULL, NULL, 0, 0, '0000-00-00 00:00:00'),
(2, NULL, 20, 22, NULL, NULL, 0, 0, '0000-00-00 00:00:00'),
(3, NULL, 233, 45, NULL, NULL, 0, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `rekening_id` int(11) NOT NULL,
  `rekening_pemilik` varchar(100) DEFAULT NULL,
  `rekening_bank` varchar(100) DEFAULT NULL,
  `rekening_nomor` varchar(35) NOT NULL,
  `rekening_jenis` tinyint(1) DEFAULT NULL,
  `rekening_status` tinyint(1) DEFAULT NULL,
  `rekening_opid` int(11) DEFAULT NULL,
  `rekening_tdiubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`rekening_id`, `rekening_pemilik`, `rekening_bank`, `rekening_nomor`, `rekening_jenis`, `rekening_status`, `rekening_opid`, `rekening_tdiubah`) VALUES
(1, 'Owner Rekening', 'Bank BCA', '10384810122', 1, 1, 1, '2020-03-24 09:49:22'),
(2, 'Lotus Frame Gallery', 'Bank BCA', '13534567845634536', 1, 1, 1, '2020-03-20 10:49:22'),
(19, 'Toko Amanah', 'Bank BCA', '45544466', 3, 1, 1, '2020-04-02 12:12:12'),
(20, 'Studio Foto Bunga', 'Bank BCA', '4546565', 3, 1, 1, '2020-04-02 12:12:12'),
(21, 'H. Ahmad Junaidi', 'Bank BCA', '56565656', 3, 1, 1, '2020-04-02 12:12:12'),
(22, 'Toko Maya', 'Bank BCA', '6867674675', 3, 1, 1, '2020-04-02 12:12:12'),
(23, 'Gallery Arjuna', 'Bank BCA', '5765754747', 3, 1, 1, '2020-04-02 12:12:12'),
(24, 'The Art Studio', 'Bank BCA', '65756756458', 3, 1, 1, '2020-04-02 12:12:12'),
(25, 'Toserba Budi', 'Bank BCA', '42343243', 3, 1, 1, '2020-04-02 12:12:12'),
(26, 'Toko Yanti', 'Bank BCA', '56567544', 3, 1, 1, '2020-04-02 12:12:12'),
(27, 'Toko Barokah', 'Bank BCA', '4099998775', 3, 1, 1, '2020-04-02 12:12:12'),
(33, 'Adi jaya', 'Bank BCA', '42343243', 2, 1, 1, '2020-04-02 12:12:12'),
(34, 'Abadi', 'Bank BCA', '42343243', 2, 1, 1, '2020-04-02 12:12:12'),
(35, 'Berkah Selalu', 'Bank BCA', '42343243', 2, 1, 1, '2020-04-02 12:12:12'),
(36, 'Supplier x', 'Bank BCA', '42343243', 2, 1, 1, '2020-04-02 12:12:12'),
(37, 'Supplier BDL', 'Bank BCA', '42343243', 2, 1, 1, '2020-04-02 12:12:12'),
(38, 'DBL Supply', 'Bank BCA', '42343243', 2, 1, 1, '2020-04-02 12:12:12'),
(39, 'Eka sentosa', 'Bank BCA', '42343243', 2, 1, 1, '2020-04-02 12:12:12'),
(40, 'Mandiri Perkasa', 'Bank BCA', '42343243', 2, 1, 1, '2020-04-02 12:12:12'),
(41, 'Duta jaya', 'Bank BCA', '42343243', 2, 1, 1, '2020-04-02 12:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `retur_jual`
--

CREATE TABLE `retur_jual` (
  `id_retur_jual` int(11) NOT NULL,
  `no_nota_retur_jual` varchar(15) DEFAULT NULL,
  `tanggal_retur` datetime DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `status_retur` int(11) DEFAULT NULL,
  `operator_retur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `retur_jual_detail`
--

CREATE TABLE `retur_jual_detail` (
  `id_retur_jual_detail` int(11) NOT NULL,
  `id_retur_jual` int(11) DEFAULT NULL,
  `qty_retur` double DEFAULT NULL,
  `harga_retur` double DEFAULT NULL,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `satuan_id` int(11) NOT NULL,
  `satuan_nama` varchar(10) NOT NULL,
  `satuan_opid` int(11) DEFAULT NULL,
  `satuan_tdiubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`satuan_id`, `satuan_nama`, `satuan_opid`, `satuan_tdiubah`) VALUES
(1, 'CM', 1, '2020-03-16 14:07:22'),
(2, 'KG', 1, '2020-03-16 14:08:11'),
(3, 'Frame', 1, '2020-03-03 12:12:12'),
(4, 'Pcs', 1, '2020-02-02 12:12:12'),
(5, 'Meter', 1, '2020-03-03 12:12:12'),
(6, 'Ons', 1, '2020-03-03 12:12:12'),
(7, 'Lembar', 1, '2020-03-03 12:12:12'),
(8, 'Biji', 1, '2020-03-03 12:12:12'),
(9, 'Batang', 1, '2020-03-03 12:12:12'),
(10, 'Gram', 1, '2020-03-03 12:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(20) NOT NULL,
  `karyawan_id` int(20) DEFAULT NULL,
  `setting_plt` varchar(10) DEFAULT NULL,
  `setting_b` varchar(10) DEFAULT NULL,
  `setting_opid` int(11) DEFAULT NULL,
  `setting_tdiubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `karyawan_id`, `setting_plt`, `setting_b`, `setting_opid`, `setting_tdiubah`) VALUES
(1, 1, 'CM', 'KG', NULL, NULL),
(2, 1, 'CM', 'G', NULL, NULL),
(3, 464, 'CM', 'G', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_opname`
--

CREATE TABLE `stock_opname` (
  `id_so` int(11) NOT NULL,
  `no_so` varchar(50) NOT NULL,
  `tanggal_so` datetime NOT NULL,
  `operator_so` int(11) NOT NULL,
  `status_so` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_opname_detail`
--

CREATE TABLE `stock_opname_detail` (
  `id_so_detail` int(11) NOT NULL,
  `no_so` varchar(50) DEFAULT NULL,
  `id_item` int(11) DEFAULT NULL,
  `nama_item` varchar(50) DEFAULT NULL,
  `barcode_item` varchar(50) DEFAULT NULL,
  `stok_item` double DEFAULT NULL,
  `qty_opname_item` double DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `status_item` int(11) DEFAULT '0',
  `lokasi_item` varchar(100) DEFAULT NULL,
  `konfirmasi_status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subkategori`
--

CREATE TABLE `subkategori` (
  `subkategori_id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `subkategori_kode` varchar(10) NOT NULL,
  `subkategori_nama` varchar(100) NOT NULL,
  `subkategori_status` tinyint(1) NOT NULL,
  `subkategori_opid` int(11) DEFAULT NULL,
  `subkategori_tdiubah` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkategori`
--

INSERT INTO `subkategori` (`subkategori_id`, `kategori_id`, `subkategori_kode`, `subkategori_nama`, `subkategori_status`, `subkategori_opid`, `subkategori_tdiubah`) VALUES
(1, 2, 'SK-001', 'Frame / Bingkai 4 R', 1, 1, '2020-03-16 12:29:06'),
(2, 2, 'SK-002', 'Frame / Bingkai 5 R', 1, 1, '2020-03-23 11:20:09'),
(3, 2, 'SK-003', 'Frame / Bingkai 10 R', 1, 1, '2020-03-23 15:28:44'),
(4, 2, 'SK-004', 'Frame / Bingkai 12 R', 1, 1, '2020-03-23 09:29:18'),
(5, 5, 'SK-005', 'Lukis', 1, 1, '2020-03-03 12:12:12'),
(6, 6, 'SK-006', 'Jam Dinding', 1, 1, '2020-03-03 12:12:12'),
(7, 1, 'SK-007', 'Frame / Bingkai 16 R', 1, 1, '2020-03-03 12:12:12'),
(8, 2, 'SK-008', 'Frame / Bingkai Mahar', 1, 1, '2020-03-03 12:12:12'),
(9, 2, 'SK-009', 'Frame / Bingkai 25x25 MF', 1, 1, '2020-03-03 12:12:12'),
(10, 2, 'SK-010', 'Frame / Bingkai Set', 1, 1, '2020-03-03 12:12:12'),
(11, 2, 'SK-011', 'Frame / Bingkai 24 R', 1, 1, '2020-03-03 12:12:12'),
(12, 2, 'SK-012', 'Frame / Bingkai Lainnya', 1, 1, '2020-03-03 12:12:12'),
(13, 2, 'SK-013', 'Frame / Bingkai 3 R', 1, 1, '2020-03-03 12:12:12'),
(14, 3, 'SK-014', 'Album Foto', 1, 1, '2020-03-03 12:12:12');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_nama` varchar(17) NOT NULL,
  `supplier_bank` varchar(30) DEFAULT NULL,
  `supplier_rekening` varchar(30) DEFAULT NULL,
  `supplier_alamat` text NOT NULL,
  `supplier_kontak` varchar(15) NOT NULL,
  `supplier_cpnama` varchar(20) DEFAULT NULL,
  `supplier_cptelpon` varchar(15) DEFAULT NULL,
  `supplier_status` tinyint(1) NOT NULL,
  `supplier_opid` int(11) DEFAULT NULL,
  `supplier_tdiubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_nama`, `supplier_bank`, `supplier_rekening`, `supplier_alamat`, `supplier_kontak`, `supplier_cpnama`, `supplier_cptelpon`, `supplier_status`, `supplier_opid`, `supplier_tdiubah`) VALUES
(2, 'Adi jaya', 'BRI', '234324', 'BDL', '43534', 'agus', '4535', 1, 1, '2020-03-16 07:33:49'),
(4, 'Abadi', 'BRI', '234', 'BDL', '5345', 'adi', '3534', 0, 1, '2020-03-17 09:00:00'),
(5, 'Berkah Selalu', 'BNI', '4234', 'BDL', '43534', 'aan', '5345', 0, 1, '2020-03-16 08:57:33'),
(6, 'Supplier x', 'BCA', '23423', 'BDL', '53453', 'hadi', '34534', 1, 1, '2020-03-14 03:43:41'),
(7, 'Supplier BDL', 'BCA', '234', 'BDL', '543534', 'huda', '5345', 1, 1, '2020-03-14 14:39:30'),
(8, 'DBL Supply', 'MANDIRI', '4234', 'BDL', '4535', 'ina', '34534', 1, 1, '2020-03-14 14:39:32'),
(9, 'Eka sentosa', 'BNA', '23423', 'BDL', '5345', 'tia', '5345', 1, 1, '2020-03-14 14:39:33'),
(10, 'Mandiri Perkasa', 'BRI', '24234', 'BDL', '34534', 'tito', '345', 1, 1, '2020-03-23 15:21:54'),
(11, 'Duta jaya', 'Arnold', '324234', 'BDL', 'Arnold', 'karman', '3453', 1, 1, '2020-03-23 09:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_tipe` tinyint(1) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `pelanggan_id` int(11) DEFAULT NULL,
  `transaksi_ppn` double DEFAULT '0',
  `transaksi_diskon` double DEFAULT '0',
  `transaksi_tanggal` datetime NOT NULL,
  `transaksi_status` tinyint(1) NOT NULL,
  `transaksi_opid` int(11) NOT NULL,
  `transaksi_tdiubah` datetime NOT NULL,
  `transaksi_nota` varchar(15) NOT NULL,
  `transaksi_proses` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_tipe`, `supplier_id`, `pelanggan_id`, `transaksi_ppn`, `transaksi_diskon`, `transaksi_tanggal`, `transaksi_status`, `transaksi_opid`, `transaksi_tdiubah`, `transaksi_nota`, `transaksi_proses`) VALUES
(16, 1, NULL, 2, 5, 5, '2020-03-28 10:27:13', 1, 1, '2020-03-28 10:27:13', 'NJ-200328-001', 2),
(18, 1, NULL, 3, 5, 5, '2020-03-30 19:36:50', 2, 1, '2020-03-30 19:36:50', 'NJ-200330-001', 1),
(19, 1, NULL, 4, 5, 5, '2020-04-01 11:05:35', 1, 1, '2020-04-01 11:05:35', 'NJ-200401-001', 3),
(21, 1, NULL, 5, 5, 5, '2020-04-01 16:02:46', 1, 1, '2020-04-01 16:02:46', 'NJ-200401-002', 1),
(23, 1, NULL, 6, 5, 5, '2020-04-04 00:51:01', 1, 1, '2020-04-04 00:51:01', 'NJ-200404-001', 3);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `unit_nama` varchar(100) NOT NULL,
  `unit_tipe` varchar(100) NOT NULL,
  `unit_alamat` varchar(100) DEFAULT NULL,
  `unit_status` tinyint(1) NOT NULL,
  `unit_opid` int(11) DEFAULT NULL,
  `unit_tdiubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `unit_nama`, `unit_tipe`, `unit_alamat`, `unit_status`, `unit_opid`, `unit_tdiubah`) VALUES
(1, 'Gudang Lokal', 'Gudang', '-', 1, 1, '2020-03-23 11:26:21'),
(2, 'gudang Rumah', 'Gudang', '-', 1, 1, '2020-03-23 09:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `void_jual`
--

CREATE TABLE `void_jual` (
  `id_void_jual` int(11) NOT NULL,
  `tgl_void` date DEFAULT NULL,
  `transaksi_id` int(11) DEFAULT NULL,
  `operator_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `void_jual_detail`
--

CREATE TABLE `void_jual_detail` (
  `id_void_jual_detail` int(11) NOT NULL,
  `id_void_jual` int(11) DEFAULT NULL,
  `penjualan_id` int(11) DEFAULT NULL,
  `qty_void` double DEFAULT NULL,
  `max_qty_void` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD KEY `FK_barang` (`barang_lokasi`);

--
-- Indexes for table `bayar_nota_beli`
--
ALTER TABLE `bayar_nota_beli`
  ADD PRIMARY KEY (`id_bayar`);

--
-- Indexes for table `bayar_nota_jual`
--
ALTER TABLE `bayar_nota_jual`
  ADD PRIMARY KEY (`id_bayar`),
  ADD KEY `FK_bayar_nota_jual` (`transaksi_id`);

--
-- Indexes for table `blok`
--
ALTER TABLE `blok`
  ADD PRIMARY KEY (`blok_id`),
  ADD KEY `FK_blok` (`unit_id`);

--
-- Indexes for table `hakakses`
--
ALTER TABLE `hakakses`
  ADD PRIMARY KEY (`hakakses_id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`karyawan_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `menu_utamahakakses`
--
ALTER TABLE `menu_utamahakakses`
  ADD PRIMARY KEY (`id_menu_utama`);

--
-- Indexes for table `mst_hakakses`
--
ALTER TABLE `mst_hakakses`
  ADD PRIMARY KEY (`id_akses`),
  ADD KEY `id_menu` (`id_menu`);

--
-- Indexes for table `mutasi_retur`
--
ALTER TABLE `mutasi_retur`
  ADD PRIMARY KEY (`id_mutasi_retur`),
  ADD KEY `FK_mutasi_retur` (`id_retur_jual`),
  ADD KEY `FK_mutasi_returx` (`id_retur_jual_detail`),
  ADD KEY `FK_mutasi_returx2` (`penyimpanan_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`pembelian_id`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`penjualan_id`),
  ADD KEY `FK_penjualanx2` (`pelanggan_id`),
  ADD KEY `FK_penjualanx` (`barang_id`),
  ADD KEY `FK_penjualan` (`transaksi_id`);

--
-- Indexes for table `penyimpanan`
--
ALTER TABLE `penyimpanan`
  ADD PRIMARY KEY (`penyimpanan_id`),
  ADD KEY `FK_penyimpananx` (`blok_id`),
  ADD KEY `FK_penyimpanan` (`barang_id`);

--
-- Indexes for table `pesanancustom`
--
ALTER TABLE `pesanancustom`
  ADD PRIMARY KEY (`pesanan_id`),
  ADD KEY `FK_pesanancustom` (`penjualan_id`);

--
-- Indexes for table `retur_jual`
--
ALTER TABLE `retur_jual`
  ADD PRIMARY KEY (`id_retur_jual`),
  ADD KEY `FK_retur_jual` (`transaksi_id`);

--
-- Indexes for table `retur_jual_detail`
--
ALTER TABLE `retur_jual_detail`
  ADD PRIMARY KEY (`id_retur_jual_detail`),
  ADD KEY `FK_retur_jual_detail` (`id_retur_jual`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`satuan_id`);

--
-- Indexes for table `stock_opname`
--
ALTER TABLE `stock_opname`
  ADD PRIMARY KEY (`id_so`);

--
-- Indexes for table `stock_opname_detail`
--
ALTER TABLE `stock_opname_detail`
  ADD PRIMARY KEY (`id_so_detail`);

--
-- Indexes for table `subkategori`
--
ALTER TABLE `subkategori`
  ADD PRIMARY KEY (`subkategori_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`),
  ADD KEY `FK_transaksi` (`pelanggan_id`),
  ADD KEY `NewIndex1` (`transaksi_nota`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `void_jual`
--
ALTER TABLE `void_jual`
  ADD PRIMARY KEY (`id_void_jual`);

--
-- Indexes for table `void_jual_detail`
--
ALTER TABLE `void_jual_detail`
  ADD PRIMARY KEY (`id_void_jual_detail`),
  ADD KEY `FK_void_jual_detail` (`id_void_jual`),
  ADD KEY `FK_void_jual_detailx` (`penjualan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `bayar_nota_beli`
--
ALTER TABLE `bayar_nota_beli`
  MODIFY `id_bayar` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `bayar_nota_jual`
--
ALTER TABLE `bayar_nota_jual`
  MODIFY `id_bayar` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `blok`
--
ALTER TABLE `blok`
  MODIFY `blok_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `hakakses`
--
ALTER TABLE `hakakses`
  MODIFY `hakakses_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `karyawan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `menu_utamahakakses`
--
ALTER TABLE `menu_utamahakakses`
  MODIFY `id_menu_utama` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `mst_hakakses`
--
ALTER TABLE `mst_hakakses`
  MODIFY `id_akses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `mutasi_retur`
--
ALTER TABLE `mutasi_retur`
  MODIFY `id_mutasi_retur` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `pembelian_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `penjualan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `penyimpanan`
--
ALTER TABLE `penyimpanan`
  MODIFY `penyimpanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `pesanancustom`
--
ALTER TABLE `pesanancustom`
  MODIFY `pesanan_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `retur_jual`
--
ALTER TABLE `retur_jual`
  MODIFY `id_retur_jual` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `retur_jual_detail`
--
ALTER TABLE `retur_jual_detail`
  MODIFY `id_retur_jual_detail` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `satuan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `stock_opname`
--
ALTER TABLE `stock_opname`
  MODIFY `id_so` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `stock_opname_detail`
--
ALTER TABLE `stock_opname_detail`
  MODIFY `id_so_detail` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subkategori`
--
ALTER TABLE `subkategori`
  MODIFY `subkategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `void_jual`
--
ALTER TABLE `void_jual`
  MODIFY `id_void_jual` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `void_jual_detail`
--
ALTER TABLE `void_jual_detail`
  MODIFY `id_void_jual_detail` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
