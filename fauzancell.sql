-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 17, 2024 at 05:50 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fauzancell`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `keterangan_kategori` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `keterangan_kategori`) VALUES
(2, 'Charger HP11', 'Ragam jenis charger HP dari berbagai merk11'),
(3, 'Power Bank221', 'Menjual power bank terbaik22'),
(4, 'Aksesoris HP', 'Gantunga stiker dll'),
(5, 'HP Xiaomi', 'Menjual semua merk xiaomi'),
(6, 'SIM Card 2', 'menjual sim card dari semua merk 2');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id_order` int NOT NULL,
  `order_id` varchar(125) NOT NULL,
  `id_user` int NOT NULL,
  `total_harga` int NOT NULL,
  `metode_pembayaran` varchar(50) NOT NULL,
  `status_pembayaran` varchar(50) NOT NULL,
  `jenis_pembayaran` varchar(125) NOT NULL,
  `status_pesanan` varchar(50) NOT NULL,
  `tanggal_order` datetime NOT NULL,
  `tanggal_pembayaran` datetime NOT NULL,
  `tanggal_diterima` datetime DEFAULT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id_order`, `order_id`, `id_user`, `total_harga`, `metode_pembayaran`, `status_pembayaran`, `jenis_pembayaran`, `status_pesanan`, `tanggal_order`, `tanggal_pembayaran`, `tanggal_diterima`, `keterangan`) VALUES
(17, 'ORDER-675c2b4b93aca', 1, 6504804, 'Midtrans', 'Lunas', 'bank_transfer', 'Diproses', '2024-12-13 12:40:43', '2024-12-13 19:40:48', NULL, ''),
(21, 'ORDER-675c2bab83a5f', 1, 2254654, 'Midtrans', 'Lunas', 'bank_transfer', 'Diproses', '2024-12-13 12:42:19', '2024-12-13 19:42:23', NULL, ''),
(22, 'ORDER-675c2c2e22f48', 1, 2254654, 'Midtrans', 'Lunas', 'echannel', 'Diproses', '2024-12-13 12:44:30', '2024-12-13 19:44:35', NULL, ''),
(23, 'ORDER-675c2d694575c', 1, 2131462, 'Midtrans', 'Lunas', 'bank_transfer', 'Diproses', '2024-12-13 12:49:45', '2024-12-13 19:49:48', NULL, ''),
(24, 'ORDER-675c2def07810', 1, 111111, 'Midtrans', 'Lunas', 'bank_transfer', 'Diproses', '2024-12-13 12:51:59', '2024-12-13 19:52:00', NULL, ''),
(25, 'ORDER-675c2e20760a2', 1, 123423, 'Midtrans', 'Lunas', 'bank_transfer', 'Diproses', '2024-12-13 12:52:48', '2024-12-13 19:52:49', NULL, ''),
(26, 'ORDER-675c3d07564b4', 1, 24624, 'Midtrans', 'Lunas', 'bank_transfer', 'Diproses', '2024-12-13 13:56:23', '2024-12-13 20:56:27', NULL, ''),
(27, 'ORDER-675c6b044b487', 1, 2242342, 'Midtrans', 'Lunas', 'bank_transfer', 'Diproses', '2024-12-13 17:12:36', '2024-12-14 00:12:38', NULL, ''),
(28, 'ORDER-675c7176bfb53', 1, 2242804, 'Midtrans', 'Lunas', 'qris', 'Diproses', '2024-12-13 17:40:06', '2024-12-14 00:40:24', NULL, ''),
(30, 'ORDER-675c747395d3c', 1, 2242342, 'Midtrans', 'Lunas', 'bank_transfer', 'Diproses', '2024-12-13 17:52:51', '2024-12-14 00:52:53', NULL, ''),
(31, 'ORDER-675d646a8e757', 1, 111111, 'Midtrans', 'Lunas', 'bank_transfer', 'Diproses', '2024-12-14 10:56:42', '2024-12-14 17:56:43', NULL, ''),
(32, 'ORDER-675d66e7787f6', 1, 2567015, 'Midtrans', 'Lunas', 'bank_transfer', 'Selesai', '2024-12-14 11:07:19', '2024-12-14 18:07:19', '2024-12-02 02:22:48', ''),
(40, 'ORDER-675f203ce674c', 1, 4450000, 'Midtrans', 'Lunas', 'bank_transfer', 'Diproses', '2024-12-15 18:30:20', '2024-12-16 01:30:25', NULL, ''),
(41, 'ORDER-675f21cdafa7f', 1, 4600000, 'Midtrans', 'Lunas', 'bank_transfer', 'Diproses', '2024-12-15 18:37:01', '2024-12-16 01:37:06', NULL, ''),
(42, 'ORDER-675f224a3b8dc', 1, 150000, 'Midtrans', 'Lunas', 'bank_transfer', 'Dikirim', '2024-12-15 18:39:06', '2024-12-16 01:39:10', NULL, 'pesanan dalam perjalanan'),
(43, 'ORDER-675f253fb523a', 1, 6500000, 'Midtrans', 'Lunas', 'bank_transfer', 'Dibatalkan', '2024-12-15 18:51:43', '2024-12-16 01:51:51', NULL, 'pesanan dibatalkan'),
(44, 'ORDER-675f25db52181', 1, 8500000, 'Midtrans', 'Lunas', 'bank_transfer', 'Selesai', '2024-12-15 18:54:19', '2024-12-16 01:54:22', '2024-12-16 19:11:02', 'pesanan diterima'),
(45, 'ORDER-6761b17e38d18', 2, 13600000, 'Midtrans', 'Lunas', 'bank_transfer', 'Selesai', '2024-12-17 17:14:38', '2024-12-18 00:14:40', '2024-12-17 17:19:30', 'pesanan  diterima');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id_order_item` int NOT NULL,
  `id_order` int NOT NULL,
  `id_produk` int NOT NULL,
  `jumlah` int NOT NULL,
  `harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id_order_item`, `id_order`, `id_produk`, `jumlah`, `harga`) VALUES
(1, 2, 9, 2, 111111),
(2, 3, 8, 1, 2131231),
(3, 3, 9, 2, 111111),
(4, 4, 8, 1, 2131231),
(5, 4, 9, 2, 111111),
(6, 5, 8, 1, 2131231),
(7, 5, 9, 2, 111111),
(8, 6, 8, 1, 2131231),
(9, 6, 9, 2, 111111),
(10, 7, 8, 1, 2131231),
(11, 7, 9, 2, 111111),
(12, 8, 8, 1, 2131231),
(13, 8, 9, 2, 111111),
(14, 9, 5, 4, 12312),
(15, 10, 9, 1, 111111),
(16, 10, 7, 1, 231),
(17, 11, 9, 1, 111111),
(18, 11, 7, 1, 231),
(19, 12, 9, 1, 111111),
(20, 12, 7, 1, 231),
(21, 13, 9, 1, 111111),
(22, 13, 7, 1, 231),
(23, 14, 9, 1, 111111),
(24, 14, 8, 3, 2131231),
(25, 15, 9, 1, 111111),
(26, 15, 8, 3, 2131231),
(27, 16, 9, 1, 111111),
(28, 16, 8, 3, 2131231),
(29, 17, 9, 1, 111111),
(30, 17, 8, 3, 2131231),
(31, 18, 9, 1, 111111),
(32, 18, 8, 3, 2131231),
(33, 19, 9, 1, 111111),
(34, 19, 8, 3, 2131231),
(35, 20, 9, 1, 111111),
(36, 20, 8, 3, 2131231),
(37, 21, 5, 1, 12312),
(38, 21, 9, 1, 111111),
(39, 21, 8, 1, 2131231),
(40, 22, 5, 1, 12312),
(41, 22, 9, 1, 111111),
(42, 22, 8, 1, 2131231),
(43, 23, 8, 1, 2131231),
(44, 23, 7, 1, 231),
(45, 24, 9, 1, 111111),
(46, 25, 9, 1, 111111),
(47, 25, 5, 1, 12312),
(48, 26, 5, 2, 12312),
(49, 27, 9, 1, 111111),
(50, 27, 8, 1, 2131231),
(51, 28, 9, 1, 111111),
(52, 28, 8, 1, 2131231),
(53, 28, 7, 2, 231),
(54, 29, 9, 1, 111111),
(55, 29, 8, 1, 2131231),
(56, 30, 9, 1, 111111),
(57, 30, 8, 1, 2131231),
(58, 31, 9, 1, 111111),
(59, 32, 9, 2, 111111),
(60, 32, 8, 1, 2131231),
(61, 32, 7, 1, 231),
(62, 32, 6, 1, 213331),
(63, 33, 8, 1, 2131231),
(64, 34, 8, 1, 2131231),
(65, 35, 8, 1, 2131231),
(66, 35, 7, 1, 231),
(67, 36, 8, 1, 2131231),
(68, 36, 7, 1, 231),
(69, 37, 8, 1, 2131231),
(70, 37, 7, 1, 231),
(71, 38, 8, 1, 2131231),
(72, 38, 7, 1, 231),
(73, 39, 8, 1, 2131231),
(74, 39, 7, 1, 231),
(75, 40, 9, 2, 2000000),
(76, 40, 8, 3, 150000),
(77, 41, 9, 2, 2000000),
(78, 41, 8, 4, 150000),
(79, 42, 8, 1, 150000),
(80, 43, 9, 1, 2000000),
(81, 43, 7, 1, 3000000),
(82, 43, 6, 1, 1500000),
(83, 44, 9, 2, 2000000),
(84, 44, 7, 1, 3000000),
(85, 44, 6, 1, 1500000),
(86, 45, 8, 4, 150000),
(87, 45, 7, 3, 3000000),
(88, 45, 9, 2, 2000000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `id_kategori` int NOT NULL,
  `nama_produk` varchar(125) NOT NULL,
  `harga_produk` int NOT NULL,
  `stok_produk` int NOT NULL,
  `image` text NOT NULL,
  `keterangan_produk` text NOT NULL,
  `create_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `id_kategori`, `nama_produk`, `harga_produk`, `stok_produk`, `image`, `keterangan_produk`, `create_at`) VALUES
(5, 2, 'HP 3', 200000, 30, 'adsa2.png', '23ewe\r\nas\r\ndas\r\nd\r\nasd', '2024-12-15 11:29:12'),
(6, 3, 'HP 1', 1500000, 8, 'dasdasds.jpg', '1231223\r\n23123123', '2024-12-15 11:28:54'),
(7, 2, 'HP 2', 3000000, 10, 'vivox100.jpg', 'dsadas\r\nsadasda\r\nsdasda', '2024-12-15 11:28:37'),
(8, 2, 'Mouser', 150000, 20, 'mouselogitetch.jpg', '2312\r\n123\r\n123\r\n2133', '2024-12-15 11:28:08'),
(9, 3, 'GPU RGB', 2000000, 15, 'coolersistem.jpg', '12121\r\n121212\r\n1212\r\n12121', '2024-12-15 11:27:44');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(125) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `level` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `username`, `password`, `no_telp`, `alamat`, `level`, `status`) VALUES
(1, 'Aqil22', 'Aqil2@gmail.com', 'aqil', '$2y$10$P0B98Mq28f4gGHVQYqTu0eD5fnPWwg4Vd1l73cDXSAlPV1bt.ybK6', '09999999', 'Saruaso2', 'user', '0'),
(2, 'hafiz', 'hafiz@gmail.com', 'hafiz', '$2y$10$RfrOdntAEicJi9FBv0GBKO3Y.CjUA47EbU6f1e5YFweqwpoARzkt.', '8901897', 'Pariaman', 'user', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id_order_item`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id_order_item` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
