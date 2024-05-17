-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 06:20 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sphereinc`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice_det`
--

CREATE TABLE `invoice_det` (
  `DET_ID` int(11) NOT NULL,
  `MST_ID` int(11) DEFAULT NULL,
  `PRODUCT_NAME` varchar(255) DEFAULT NULL,
  `AMOUNT` double(11,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `invoice_det`
--

INSERT INTO `invoice_det` (`DET_ID`, `MST_ID`, `PRODUCT_NAME`, `AMOUNT`) VALUES
(1, 1, 'DOMAIN WWW.SHINERWEB.COM', 899.00),
(2, 1, 'DATABASE MYSQL', 3499.00),
(3, 1, 'EMAIL SERVICES', 799.00),
(4, 2, 'DOMAIN WWW.GOOGLE.COM', 4500.00),
(5, 2, 'EMAIL SERVICES', 799.00),
(6, 3, 'DOMAIN WWW.FACEBOOK.COM', 7999.00);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_mst`
--

CREATE TABLE `invoice_mst` (
  `MST_ID` int(11) NOT NULL,
  `INV_NO` varchar(100) DEFAULT NULL,
  `CUSTOMER_NAME` varchar(255) DEFAULT NULL,
  `CUSTOMER_MOBILENO` varchar(10) DEFAULT NULL,
  `ADDRESS` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `invoice_mst`
--

INSERT INTO `invoice_mst` (`MST_ID`, `INV_NO`, `CUSTOMER_NAME`, `CUSTOMER_MOBILENO`, `ADDRESS`) VALUES
(1, 'INV01', 'DIVYESH PATEL', '9825121212', 'VALSAD, GUJARAT'),
(2, 'INV02', 'ROSHNI PATEL', '8457878878', 'CHIKHLI, GUJARAT'),
(3, 'INV03', 'DITYA PATEL', '7487878788', 'JESPOR, VALSAD');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `description`, `stock`, `image_path`) VALUES
(1, 'Baju Tidur', 'Baju Tidur Nyaman', 1000, NULL),
(2, 'Sepatu Sneakers', 'Sepatu Sneakers Keren', 1000, NULL),
(3, 'Meja Lipat', 'Meja Lipat Praktis', 1000, NULL),
(4, 'Laptop ASUS', 'Laptop ASUS Performa Tinggi', 1000, NULL),
(5, 'Kamera DSLR Canon', 'Kamera DSLR Canon Profesional', 1000, NULL),
(6, 'Speaker Bluetooth', 'Speaker Bluetooth Portabel', 1000, NULL),
(7, 'Jam Tangan Casio', 'Jam Tangan Casio Sporty', 1000, NULL),
(8, 'Topi Baseball', 'Topi Baseball Klasik', 1000, NULL),
(9, 'Buku Panduan Belajar Bahasa Inggris', 'Buku Panduan Belajar Bahasa Inggris Interaktif', 1000, NULL),
(10, 'Mouse Gaming', 'Mouse Gaming Presisi Tinggi', 1000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `NIK` varchar(16) DEFAULT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `device_info` varchar(255) DEFAULT NULL,
  `browser_info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `NIK`, `login_time`, `ip_address`, `device_info`, `browser_info`) VALUES
(106, '11111', '2024-05-17 16:17:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(107, '11112', '2024-05-17 16:18:24', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logout_history`
--

CREATE TABLE `logout_history` (
  `id` int(11) NOT NULL,
  `NIK` varchar(16) DEFAULT NULL,
  `logout_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_address` varchar(45) DEFAULT NULL,
  `device_info` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logout_history`
--

INSERT INTO `logout_history` (`id`, `NIK`, `logout_time`, `ip_address`, `device_info`) VALUES
(78, '11111', '2024-05-17 16:17:53', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(6) UNSIGNED NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `waybill_number` varchar(100) NOT NULL,
  `sender_address` text DEFAULT NULL,
  `order_number` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `receiver`, `sender`, `datetime`, `waybill_number`, `sender_address`, `order_number`) VALUES
(31, 'PT A', 'PT B', '2024-05-20 00:00:00', 'WB171596236061', 'BINUS', 'WB171596236061'),
(32, 'PT A', 'PT B', '2024-05-20 00:00:00', 'WB171596241226', 'BINUS', 'WB171596241226');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` int(6) UNSIGNED NOT NULL,
  `transaction_id` int(6) UNSIGNED NOT NULL,
  `item_code` varchar(100) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `total_pcs` int(6) NOT NULL,
  `description` text DEFAULT NULL,
  `waybill_number` varchar(255) DEFAULT NULL,
  `Price` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_id`, `item_code`, `item_name`, `total_pcs`, `description`, `waybill_number`, `Price`) VALUES
(40, 31, '1', 'Baju Tidur', 75, 'Pembelian Vendor', 'WB171596236061', '122222'),
(41, 31, '2', '2', 200, 'Pembelian Vendor', 'WB171596236061', '350000'),
(42, 32, '1', 'Baju Tidur', 75, 'Pembelian Vendor', 'WB171596241226', '122222'),
(43, 32, '2', 'Sepatu Sneakers', 158, 'pembelian vendor', 'WB171596241226', '366999');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `NIK` varchar(16) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `login_attempts` int(11) DEFAULT 0,
  `is_locked` tinyint(1) DEFAULT 0,
  `lockout_time` timestamp NULL DEFAULT NULL,
  `role_status` int(11) DEFAULT 1,
  `is_logged_in` tinyint(1) DEFAULT 0,
  `is_blocked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`NIK`, `username`, `email`, `dob`, `department`, `password`, `login_attempts`, `is_locked`, `lockout_time`, `role_status`, `is_logged_in`, `is_blocked`) VALUES
('11111', 'tesadmin', 'tesadmin@binus.edu', '2024-05-17', 'IT', '$2y$10$hSxlj6aDVDjjHyL51K9bk.84dq5ni5NxxuBSwjrPldheqhKzyefee', 0, 0, NULL, 1, 0, 0),
('11112', 'nonadmin', 'nonadmin@binus.edu', '2024-05-17', 'Finance', '$2y$10$ms3q6EdABjFJUWYqoc59pOLh0/1sBSXB9pocqmD4tR.XDf4BwZvla', 0, 0, NULL, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_batam`
--

CREATE TABLE `warehouse_batam` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `last_audit` date DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse_batam`
--

INSERT INTO `warehouse_batam` (`id`, `id_barang`, `nama_barang`, `jumlah_stok`, `last_audit`, `last_update`, `image_path`, `description`) VALUES
(8, 1, 'Lanyard', 10000, '0000-00-00', '2024-05-17 16:14:31', '../Assets/img/items/lanyard.jpg', 'Lanyard');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_bogor`
--

CREATE TABLE `warehouse_bogor` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `last_audit` date DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_china`
--

CREATE TABLE `warehouse_china` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `last_audit` date DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_jakarta`
--

CREATE TABLE `warehouse_jakarta` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_stok` int(11) NOT NULL,
  `last_audit` date DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice_det`
--
ALTER TABLE `invoice_det`
  ADD PRIMARY KEY (`DET_ID`);

--
-- Indexes for table `invoice_mst`
--
ALTER TABLE `invoice_mst`
  ADD PRIMARY KEY (`MST_ID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `NIK` (`NIK`);

--
-- Indexes for table `logout_history`
--
ALTER TABLE `logout_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `NIK` (`NIK`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`NIK`);

--
-- Indexes for table `warehouse_batam`
--
ALTER TABLE `warehouse_batam`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_bogor`
--
ALTER TABLE `warehouse_bogor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_china`
--
ALTER TABLE `warehouse_china`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_jakarta`
--
ALTER TABLE `warehouse_jakarta`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice_det`
--
ALTER TABLE `invoice_det`
  MODIFY `DET_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `invoice_mst`
--
ALTER TABLE `invoice_mst`
  MODIFY `MST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `logout_history`
--
ALTER TABLE `logout_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `warehouse_batam`
--
ALTER TABLE `warehouse_batam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `warehouse_bogor`
--
ALTER TABLE `warehouse_bogor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `warehouse_china`
--
ALTER TABLE `warehouse_china`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warehouse_jakarta`
--
ALTER TABLE `warehouse_jakarta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_history`
--
ALTER TABLE `login_history`
  ADD CONSTRAINT `login_history_ibfk_1` FOREIGN KEY (`NIK`) REFERENCES `users` (`NIK`);

--
-- Constraints for table `logout_history`
--
ALTER TABLE `logout_history`
  ADD CONSTRAINT `logout_history_ibfk_1` FOREIGN KEY (`NIK`) REFERENCES `users` (`NIK`);

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
