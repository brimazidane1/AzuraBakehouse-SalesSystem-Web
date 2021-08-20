-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2021 at 05:58 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `azura`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id_activity` int(11) NOT NULL,
  `tgl_activity` date NOT NULL,
  `id_user` int(11) NOT NULL,
  `ket_activity` varchar(255) NOT NULL,
  `ip` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id_activity`, `tgl_activity`, `id_user`, `ket_activity`, `ip`) VALUES
(1, '2021-07-30', 2, 'menambahkan data produk dengan nama ', '::1'),
(2, '2021-07-30', 2, 'menambahkan data produk dengan nama Produk 1', '::1'),
(3, '2021-07-30', 2, 'menambahkan data produk dengan nama tes', '::1'),
(4, '2021-07-30', 2, 'menambahkan konsinyi dengan nama ', '::1'),
(5, '2021-07-30', 2, 'menambahkan produk dengan nama ', '::1'),
(6, '2021-07-30', 2, 'menambahkan konsinyi dengan nama tsee', '::1'),
(7, '2021-07-30', 2, 'menambahkan produk dengan nama Produk 1', '::1'),
(8, '2021-08-02', 2, 'menambahkan konsinyi dengan nama Azura Bakehouse', '::1'),
(9, '2021-08-02', 2, 'menambahkan konsinyi dengan nama Insyira Oleh-Oleh', '::1'),
(10, '2021-08-02', 2, 'menghapus produk dengan nama ', '::1'),
(11, '2021-08-02', 2, 'menghapus produk dengan nama ', '::1'),
(12, '2021-08-02', 2, 'menambahkan produk dengan nama Produk 1', '::1'),
(13, '2021-08-02', 2, 'menghapus produk dengan nama Produk 2', '::1'),
(14, '2021-08-02', 2, 'menambahkan persediaan produk 6', '::1'),
(15, '2021-08-02', 2, 'menghapus persediaan produk Produk 1', '::1'),
(16, '2021-08-02', 2, 'menambahkan persediaan produk Produk 1', '::1'),
(17, '2021-08-02', 2, 'mengedit persediaan produk id 6', '::1'),
(18, '2021-08-02', 2, 'mengedit persediaan produk id 6', '::1'),
(19, '2021-08-02', 2, 'menambahkan persediaan produk Produk 1', '::1'),
(20, '2021-08-02', 2, 'mengedit persediaan produk id 6', '::1'),
(21, '2021-08-02', 2, 'mengedit persediaan produk id 6', '::1'),
(22, '2021-08-02', 2, 'mengedit persediaan produk id 6', '::1'),
(23, '2021-08-02', 2, 'menambahkan persediaan produk Produk 1', '::1'),
(24, '2021-08-02', 2, 'menambahkan penjualan dengan kode PJa6839', '::1'),
(25, '2021-08-02', 2, 'menghapus penjualan dengan kode PJa6839', '::1'),
(26, '2021-08-02', 2, 'menambahkan penjualan dengan kode PJf712d', '::1'),
(27, '2021-08-02', 2, 'mengedit penjualan dengan kode PJf712d', '::1'),
(28, '2021-08-02', 2, 'menambahkan persediaan produk Produk 1', '::1'),
(29, '2021-08-02', 2, 'menghapus persediaan produk Produk 1', '::1'),
(30, '2021-08-02', 2, 'menghapus penjualan dengan kode PJf712d', '::1'),
(31, '2021-08-04', 2, 'mengedit penjualan dengan kode PJd1d83', '::1'),
(32, '2021-08-07', 2, 'menambahkan produk dengan nama Produk 2', '::1'),
(33, '2021-08-07', 2, 'menghapus persediaan produk Produk 1', '::1'),
(34, '2021-08-07', 2, 'menghapus persediaan produk Produk 1', '::1'),
(35, '2021-08-07', 2, 'menghapus persediaan produk Produk 1', '::1'),
(36, '2021-08-07', 2, 'menambahkan persediaan produk Produk 1', '::1'),
(37, '2021-08-07', 2, 'menambahkan persediaan produk Produk 1', '::1'),
(38, '2021-08-07', 2, 'menambahkan persediaan produk Produk 1', '::1'),
(39, '2021-08-07', 3, 'mengedit penjualan dengan kode PJ19a40', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `konsinyi`
--

CREATE TABLE `konsinyi` (
  `id_konsinyi` int(11) NOT NULL,
  `kode_konsinyi` varchar(50) NOT NULL,
  `nama_konsinyi` varchar(128) NOT NULL,
  `alamat_konsinyi` varchar(255) NOT NULL,
  `nohp_konsinyi` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsinyi`
--

INSERT INTO `konsinyi` (`id_konsinyi`, `kode_konsinyi`, `nama_konsinyi`, `alamat_konsinyi`, `nohp_konsinyi`) VALUES
(1, 'C5a598', 'Azura Bakehouse', 'Sidomulyo Barat, Tampan, Pekanbaru City, Riau 28294', '0812'),
(2, 'Cb26ff', 'Insyira Oleh-Oleh', 'Jalan arifin, kecamatan marpoyan damai, kelurahan sidolmulyo timur, Sidomulyo Tim., Kec. Marpoyan Damai, Kota Pekanbaru, Riau 28125', '0812');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `id_konsinyi` int(11) NOT NULL,
  `kode_penjualan` varchar(50) NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `kode_produk_penjualan` varchar(50) NOT NULL,
  `nama_produk_penjualan` varchar(128) NOT NULL,
  `jumlah_penjualan` int(50) NOT NULL,
  `satuan_penjualan` varchar(50) NOT NULL,
  `harga_produk_penjualan` int(50) NOT NULL,
  `total_penjualan` int(50) NOT NULL,
  `status_penjualan` int(1) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_konsinyi`, `kode_penjualan`, `tanggal_penjualan`, `kode_produk_penjualan`, `nama_produk_penjualan`, `jumlah_penjualan`, `satuan_penjualan`, `harga_produk_penjualan`, `total_penjualan`, `status_penjualan`, `id_user`) VALUES
(5, 2, 'PJ5c0a0', '2021-08-01', 'Pd5cd1', 'Produk 1', 5, 'pcs', 100000, 500000, 0, 2),
(6, 2, 'PJ19a40', '2021-08-01', 'Pd5cd1', 'Produk 1', 20, 'pcs', 100000, 2000000, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `persediaan`
--

CREATE TABLE `persediaan` (
  `id_persediaan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `kode_persediaan` varchar(50) NOT NULL,
  `jumlah_persediaan` int(50) NOT NULL,
  `satuan_persediaan` varchar(50) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_exp` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `persediaan`
--

INSERT INTO `persediaan` (`id_persediaan`, `id_produk`, `kode_persediaan`, `jumlah_persediaan`, `satuan_persediaan`, `tanggal_masuk`, `tanggal_exp`) VALUES
(5, 6, 'PS4b5e6', 10, 'pcs', '2021-07-01', '2021-07-31'),
(6, 6, 'PS10120', 0, 'pcs', '2021-07-01', '2021-08-31'),
(7, 6, 'PS659b5', 25, 'pcs', '2021-07-13', '2021-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(128) NOT NULL,
  `harga_produk` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama_produk`, `harga_produk`) VALUES
(6, 'Pd5cd1', 'Produk 1', 100000),
(7, 'P624ba', 'Produk 2', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role`) VALUES
(1, 'administrator'),
(2, 'pemilik'),
(3, 'karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `password`, `no_hp`, `created_at`, `id_role`) VALUES
(1, 'administrator', 'administrator', '$2y$10$tTqnCNosJEPaAmfhRBVTneTo9ljSLarF8MjHC04J1.z1D5XGCTPhG', '0', '2021-08-07 03:57:18', 1),
(2, 'pemilik', 'pemilik', '$2y$10$IFWv12WFcgQPI3.r/wEKbeXEVq.B/qLKyYCTQTMJejCthsvU4oMK6', '0', '2021-08-07 03:57:32', 2),
(3, 'karyawan', 'karyawan', '$2y$10$PBhaz44amuMm0uTcnTl5/ekD0B44vfCtHqDpBnwTx7yf1BnzDd/..', '0', '2021-08-07 03:57:39', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `id_role`, `id_menu`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'administrator'),
(2, 'pemilik'),
(3, 'karyawan');

-- --------------------------------------------------------

--
-- Table structure for table `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id_sub` int(11) NOT NULL,
  `id_user_menu` int(11) NOT NULL,
  `judul` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id_sub`, `id_user_menu`, `judul`, `url`, `icon`) VALUES
(1, 1, 'Profile', 'administrator', 'nav-icon fas fa-id-badge'),
(2, 2, 'Profile', 'pemilik', 'nav-icon fas fa-id-badge'),
(3, 3, 'Profile', 'karyawan', 'nav-icon fas fa-id-badge'),
(4, 1, 'Kelola User', 'administrator/kelola_user', 'nav-icon fas fa-users'),
(5, 1, 'Kelola Menu', 'administrator/kelola_menu', 'nav-icon fas fa-folder'),
(6, 1, 'Kelola Submenu', 'administrator/kelola_submenu', 'nav-icon fas fa-folder-open'),
(7, 1, 'Kelola Akses', 'administrator/kelola_akses', 'nav-icon fas fa-users-cog'),
(8, 2, 'Kelola User', 'pemilik/kelola_user', 'nav-icon fas fa-users'),
(9, 2, 'Data Produk', 'pemilik/data_produk', 'nav-icon fas fa-cookie-bite'),
(10, 2, 'Data Konsinyi', 'pemilik/data_konsinyi', 'nav-icon fas fa-warehouse'),
(11, 2, 'Data Persediaan', 'pemilik/data_persediaan', 'nav-icon fas fa-boxes'),
(12, 2, 'Data Penjualan', 'pemilik/data_penjualan', 'nav-icon fas fa-money-bill'),
(13, 3, 'Data Produk', 'karyawan/data_produk', 'nav-icon fas fa-cookie-bite'),
(14, 3, 'Data Konsinyi', 'karyawan/data_konsinyi', 'nav-icon fas fa-warehouse'),
(15, 3, 'Data Persediaan', 'karyawan/data_persediaan', 'nav-icon fas fa-boxes'),
(16, 3, 'Data Penjualan', 'karyawan/data_penjualan', 'nav-icon fas fa-money-bill');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id_activity`),
  ADD KEY `activity_users` (`id_user`);

--
-- Indexes for table `konsinyi`
--
ALTER TABLE `konsinyi`
  ADD PRIMARY KEY (`id_konsinyi`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`),
  ADD KEY `penjualan_konsinyi` (`id_konsinyi`),
  ADD KEY `penjualan_user` (`id_user`);

--
-- Indexes for table `persediaan`
--
ALTER TABLE `persediaan`
  ADD PRIMARY KEY (`id_persediaan`),
  ADD KEY `persediaan_produk` (`id_produk`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_role` (`id_role`);

--
-- Indexes for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `access_menu` (`id_menu`),
  ADD KEY `access_role` (`id_role`);

--
-- Indexes for table `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id_sub`),
  ADD KEY `menu` (`id_user_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id_activity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `konsinyi`
--
ALTER TABLE `konsinyi`
  MODIFY `id_konsinyi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `persediaan`
--
ALTER TABLE `persediaan`
  MODIFY `id_persediaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_konsinyi` FOREIGN KEY (`id_konsinyi`) REFERENCES `konsinyi` (`id_konsinyi`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `penjualan_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `persediaan`
--
ALTER TABLE `persediaan`
  ADD CONSTRAINT `persediaan_produk` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD CONSTRAINT `access_menu` FOREIGN KEY (`id_menu`) REFERENCES `user_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `access_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD CONSTRAINT `menu` FOREIGN KEY (`id_user_menu`) REFERENCES `user_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
