-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2020 at 12:58 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `swarakalibata_marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `rb_penjualan`
--

CREATE TABLE `rb_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `kode_transaksi` varchar(50) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL DEFAULT 0,
  `status_pembeli` enum('reseller','konsumen') NOT NULL,
  `status_penjual` enum('admin','reseller') NOT NULL,
  `kurir` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `ongkir` int(11) NOT NULL,
  `waktu_transaksi` datetime NOT NULL,
  `proses` enum('0','1','2','3') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rb_penjualan`
--

INSERT INTO `rb_penjualan` (`id_penjualan`, `kode_transaksi`, `id_pembeli`, `id_penjual`, `status_pembeli`, `status_penjual`, `kurir`, `service`, `ongkir`, `waktu_transaksi`, `proses`) VALUES
(2, 'TRX-0002', 2, 1, 'reseller', 'admin', '', '', 0, '2017-05-28 08:23:40', '1'),
(3, 'TRX-0003', 3, 1, 'reseller', 'admin', '', '', 0, '2017-05-28 09:00:33', '0'),
(4, 'TRX-0004', 2, 1, 'reseller', 'admin', '', '', 0, '2017-05-30 10:50:55', '1'),
(12, 'TRX-20170531115350', 1, 1, 'konsumen', 'reseller', '', '', 0, '2017-05-31 11:53:50', '0'),
(14, 'TRX-20170601121916', 2, 1, 'reseller', 'admin', '', '', 0, '2017-06-01 12:19:16', '1'),
(15, 'TRX-20170601171840', 2, 1, 'reseller', 'admin', '', '', 0, '2017-06-01 17:18:40', '0'),
(20, 'TRX-20170602152730', 1, 1, 'konsumen', 'reseller', '', '', 0, '2017-06-02 15:27:30', '0'),
(73, 'TRX-20190216111223', 1, 2, 'konsumen', 'reseller', 'pos', 'Express Next Day Barang', 17000, '2019-02-16 11:12:51', '0'),
(74, 'TRX-20190216112320', 1, 2, 'konsumen', 'reseller', 'jne', 'YES', 17000, '2019-02-16 11:23:38', '0'),
(42, 'TRX-20170604112343', 3, 1, 'reseller', 'admin', '', '', 0, '2017-06-04 11:23:47', '1'),
(43, 'TRX-20170604112516', 3, 3, 'konsumen', 'reseller', '', '', 0, '2017-06-04 11:25:16', '1'),
(75, 'TRX-20190220070740', 2, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-02-20 07:07:40', '1'),
(76, 'TRX-20190220070746', 2, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-02-20 07:07:46', '1'),
(77, 'TRX-20190220072137', 2, 1, 'reseller', 'admin', '', '', 0, '2019-02-20 07:21:37', '1'),
(53, 'TRX-20180725083202', 1, 2, 'konsumen', 'reseller', 'pos', 'Paket Kilat Khusus', 76500, '2018-07-25 08:32:02', '0'),
(79, 'TRX-20190223150806', 1, 2, 'konsumen', 'reseller', 'pos', 'Express Next Day Barang', 34000, '2019-02-23 15:08:06', '1'),
(58, 'TRX-20180912144318', 2, 1, 'reseller', 'admin', '', '', 0, '2018-09-12 14:43:18', '2'),
(61, 'TRX-20181223070005', 1, 2, 'konsumen', 'reseller', 'tiki', 'ONS', 10000, '2018-12-23 07:00:16', '2'),
(62, 'TRX-20181223080117', 1, 2, 'konsumen', 'reseller', 'pos', 'Paket Kilat Khusus', 8000, '2018-12-23 08:01:17', '0'),
(63, 'TRX-20181223080145', 26, 2, 'konsumen', 'reseller', 'tiki', 'ONS', 17000, '2018-12-23 08:09:17', '0'),
(67, 'TRX-20181226072823', 2, 1, 'reseller', 'admin', '', '', 0, '2018-12-26 07:28:23', '0'),
(68, 'TRX-20181226073542', 2, 1, 'reseller', 'admin', '', '', 0, '2018-12-26 07:35:42', '2'),
(81, 'TRX-20190321080106', 2, 1, 'reseller', 'admin', '', 'TRX-20190220072137', 0, '2019-03-21 08:01:06', '1'),
(91, 'TRX-20190322062742', 1, 1, 'reseller', 'admin', '', '', 0, '2019-03-22 06:27:42', '1'),
(82, 'TRX-20190321114415', 2, 1, 'reseller', 'admin', '', '', 0, '2019-03-21 11:44:15', '1'),
(83, 'TRX-20190321115249', 2, 1, 'reseller', 'admin', '', 'TRX-20190321114415', 0, '2019-03-21 11:52:49', '1'),
(85, 'TRX-20190321120328', 1, 2, 'konsumen', 'reseller', 'jne', 'YES', 17000, '2019-03-21 12:03:28', '1'),
(86, 'TRX-20190321120745', 1, 2, 'konsumen', 'reseller', 'pos', 'Paket Kilat Khusus', 11000, '2019-03-21 12:07:45', '1'),
(87, 'TRX-20190321121109', 2, 2, 'konsumen', 'reseller', 'pos', 'Express Next Day Barang', 17000, '2019-03-21 12:11:09', '2'),
(88, 'TRX-20190322062417', 1, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-03-22 06:24:17', '1'),
(89, 'TRX-20190322062422', 1, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-03-22 06:24:22', '1'),
(90, 'TRX-20190322062426', 1, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-03-22 06:24:26', '1'),
(92, 'TRX-20190322063729', 1, 1, 'reseller', 'admin', '', 'TRX-20190322062742', 0, '2019-03-22 06:37:29', '1'),
(93, 'TRX-20190322063829', 1, 1, 'reseller', 'admin', '', '', 0, '2019-03-22 06:38:29', '1'),
(94, 'TRX-20190322063914', 1, 1, 'reseller', 'admin', '', 'TRX-20190322063829', 0, '2019-03-22 06:39:14', '1'),
(95, 'TRX-20190324101735', 3, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-03-24 10:17:35', '1'),
(96, 'TRX-20190324101739', 3, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-03-24 10:17:39', '1'),
(97, 'TRX-20190324101743', 3, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-03-24 10:17:43', '1'),
(98, 'TRX-20190324101747', 3, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-03-24 10:17:47', '1'),
(99, 'TRX-20190324101751', 3, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-03-24 10:17:51', '1'),
(100, 'TRX-20190324110240', 1, 1, 'konsumen', 'reseller', '', '', 0, '2019-03-24 11:16:41', '0'),
(101, 'TRX-20190325103704', 1, 2, 'konsumen', 'reseller', 'pos', 'Express Next Day Barang', 17000, '2019-03-25 10:38:02', '0'),
(105, 'TRX-20190703062416', 1, 1, 'konsumen', 'reseller', 'pos', 'Express Sameday Barang', 18000, '2019-07-03 06:24:16', '2'),
(106, 'TRX-20190703074508', 1, 2, 'konsumen', 'reseller', 'pos', 'Express Next Day Barang', 17000, '2019-07-03 07:45:08', '1'),
(107, 'TRX-20190817071150', 1, 3, 'konsumen', 'reseller', '', '', 0, '2019-08-17 07:11:50', '0'),
(108, 'TRX-20190831204112', 1, 3, 'konsumen', 'reseller', 'tiki', 'REG', 216000, '2019-08-31 20:41:12', '0'),
(109, 'TRX-20190901064338', 1, 1, 'konsumen', 'reseller', '', '', 0, '2019-09-01 06:52:03', '0'),
(110, 'TRX-20190912060351', 1, 3, 'konsumen', 'reseller', '', '', 0, '2019-09-12 06:03:51', '0'),
(111, 'TRX-20190912062459', 1, 3, 'konsumen', 'reseller', 'cod', 'Cash on delivery', 1, '2019-09-12 06:24:59', '0'),
(112, 'TRX-20190918161815', 1, 3, 'konsumen', 'reseller', 'cod', '1', 1000, '2019-09-18 16:18:15', '0'),
(113, 'TRX-20190918164426', 1, 3, 'konsumen', 'reseller', '', '', 0, '2019-09-18 16:44:26', '0'),
(114, 'TRX-20190919060658', 1, 1, 'konsumen', 'reseller', 'cod', 'Cash on delivery', 6500, '2019-09-19 06:06:58', '0'),
(115, 'TRX-20190919064148', 1, 1, 'konsumen', 'reseller', '', '', 0, '2019-09-19 06:41:48', '0'),
(116, 'TRX-20191119131430', 1, 3, 'konsumen', 'reseller', 'tiki', 'REG', 7000, '2019-11-19 13:14:54', '0'),
(117, 'TRX-20191119215502', 10, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-11-19 21:55:02', '1'),
(118, 'TRX-20191119220055', 10, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-11-19 22:00:55', '1'),
(119, 'TRX-20191119220344', 27, 10, 'konsumen', 'reseller', 'jne', 'CTC', 7000, '2019-11-19 22:04:36', '1'),
(120, 'TRX-20191119221145', 10, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-11-19 22:11:45', '1'),
(121, 'TRX-20191119222253', 10, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-11-19 22:22:53', '1'),
(122, 'TRX-20191119222318', 10, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-11-19 22:23:18', '1'),
(123, 'TRX-20191119222706', 10, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-11-19 22:27:06', '1'),
(124, 'TRX-20191119223149', 27, 10, 'konsumen', 'reseller', 'pos', 'Express Next Day Barang', 10000, '2019-11-19 22:31:49', '1'),
(125, 'TRX-20191120152923', 27, 10, 'konsumen', 'reseller', 'jne', 'CTC', 7000, '2019-11-20 15:29:23', '1'),
(126, 'TRX-20191120162718', 10, 0, 'reseller', 'admin', '', '', 0, '2019-11-20 16:27:23', '2'),
(127, 'TRX-20191120210432', 27, 10, 'konsumen', 'reseller', 'tiki', 'ECO', 16000, '2019-11-20 21:04:53', '1'),
(128, 'TRX-20191121123200', 11, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-11-21 12:32:00', '1'),
(129, 'TRX-20191121131830', 11, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-11-21 13:18:30', '1'),
(130, 'TRX-20191121140454', 27, 10, 'konsumen', 'reseller', 'tiki', 'ECO', 8000, '2019-11-21 14:04:54', '1'),
(132, 'TRX-20191121141422', 27, 10, 'konsumen', 'reseller', 'cod', 'Cash on deliveryddd', 2000, '2019-11-21 14:14:22', '0'),
(133, 'TRX-20191121142127', 27, 10, 'konsumen', 'reseller', '', '', 0, '2019-11-21 14:21:27', '0'),
(134, 'TRX-20191203164105', 10, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-12-03 16:41:05', '1'),
(135, 'TRX-20191203164152', 10, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-12-03 16:41:52', '1'),
(136, 'TRX-20191203164253', 10, 1, 'reseller', 'admin', '', 'Stok Otomatis (Pribadi)', 0, '2019-12-03 16:42:53', '1'),
(137, 'TRX-20191207163937', 27, 11, 'konsumen', 'reseller', '', '', 0, '2019-12-07 16:39:37', '0'),
(138, 'TRX-20191210104616', 27, 10, 'konsumen', 'reseller', 'jne', '', 7000, '2019-12-10 10:46:16', '1'),
(142, 'TRX-20191210182742', 27, 10, 'konsumen', 'reseller', 'cod', '', 2000, '2019-12-10 18:31:35', '0'),
(143, 'TRX-20191210183657', 27, 11, 'konsumen', 'reseller', 'jne', '', 5000, '2019-12-10 18:36:57', '2'),
(144, 'TRX-20191210183959', 27, 11, 'konsumen', 'reseller', 'jne', 'OKE', 5000, '2019-12-10 18:39:59', '2'),
(145, 'TRX-20191210184620', 27, 10, 'konsumen', 'reseller', 'cod', 'Cash on delivery', 2000, '2019-12-10 18:46:20', '0'),
(146, 'TRX-20191210185422', 27, 10, 'konsumen', 'reseller', 'cod', 'Cash on delivery', 2000, '2019-12-10 18:54:22', '0'),
(147, 'TRX-20191210190026', 27, 10, 'konsumen', 'reseller', 'cod', 'Cash on delivery', 2000, '2019-12-10 19:00:26', '0'),
(148, 'TRX-20191210190618', 27, 10, 'konsumen', 'reseller', 'cod', 'Cash on delivery', 2000, '2019-12-10 19:06:18', '0'),
(163, 'TRX-20200101160754', 27, 11, 'konsumen', 'reseller', '', '', 0, '2020-01-01 16:07:54', '0'),
(150, 'TRX-20191210191452', 27, 10, 'konsumen', 'reseller', 'cod', '', 2000, '2019-12-10 19:14:52', '0'),
(151, 'TRX-20191210191539', 27, 10, 'konsumen', 'reseller', 'cod', '', 2000, '2019-12-10 19:15:39', '0'),
(152, 'TRX-20191210191649', 27, 10, 'konsumen', 'reseller', 'cod', '', 2000, '2019-12-10 19:16:49', '0'),
(153, 'TRX-20191210191804', 27, 10, 'konsumen', 'reseller', 'cod', '', 2000, '2019-12-10 19:18:04', '1'),
(154, 'TRX-20191211093640', 27, 10, 'konsumen', 'reseller', 'cod', '', 2000, '2019-12-11 09:36:40', '1'),
(164, 'TRX-20200107174605', 27, 10, 'konsumen', 'reseller', '', '', 0, '2020-01-07 17:46:05', '0'),
(165, 'TRX-20200107182051', 27, 10, 'konsumen', 'reseller', '', '', 0, '2020-01-07 18:20:51', '0'),
(158, 'TRX-20191213230815', 27, 11, 'konsumen', 'reseller', '', '', 0, '2019-12-13 23:08:15', '0'),
(159, 'TRX-20191214062141', 27, 11, 'konsumen', 'reseller', 'jne', '', 8000, '2019-12-14 06:21:41', '0'),
(166, 'TRX-20200108104031', 27, 10, 'konsumen', 'reseller', '', '', 0, '2020-01-08 10:40:31', '0'),
(167, 'TRX-20200108104239', 27, 11, 'konsumen', 'reseller', '', '', 0, '2020-01-08 10:42:39', '0'),
(168, 'TRX-20200108104254', 27, 11, 'konsumen', 'reseller', '', '', 0, '2020-01-08 10:42:54', '0'),
(171, 'TRX-20200108121004', 27, 10, 'konsumen', 'reseller', '', '', 0, '2020-01-08 12:10:04', '0'),
(172, 'TRX-20200108145240', 27, 10, 'konsumen', 'reseller', '', '', 0, '2020-01-08 14:52:40', '0'),
(173, 'TRX-20200109131238', 27, 10, 'konsumen', 'reseller', '', '', 0, '2020-01-09 13:12:38', '0'),
(175, 'TRX-20200110162113', 27, 10, 'konsumen', 'reseller', '', '', 0, '2020-01-10 16:21:13', '0'),
(179, 'TRX-20200110211122', 27, 10, 'konsumen', 'reseller', '', '', 0, '2020-01-10 21:11:22', '0'),
(180, 'TRX-20200111182634', 27, 10, 'konsumen', 'reseller', '', '', 0, '2020-01-11 18:26:34', '0'),
(182, 'TRX-20200112140533', 27, 10, 'konsumen', 'reseller', 'JET Express', 'Regular', 78000, '2020-01-12 14:05:33', '0'),
(183, 'TRX-20200116165524', 27, 10, 'konsumen', 'reseller', 'POS Indonesia (POS)', 'Paket Kilat Khusus', 64000, '2020-01-16 16:55:24', '0'),
(184, 'TRX-20200116165908', 27, 10, 'konsumen', 'reseller', 'SiCepat Express', 'Layanan Reguler', 62000, '2020-01-16 16:59:08', '0'),
(185, 'TRX-20200116170002', 27, 11, 'konsumen', 'reseller', '', '', 0, '2020-01-16 17:00:02', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rb_penjualan`
--
ALTER TABLE `rb_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rb_penjualan`
--
ALTER TABLE `rb_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
