-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 06:31 PM
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
(26, '11113', '2024-05-14 09:51:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(27, '11113', '2024-05-14 09:51:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(28, '11112', '2024-05-14 09:53:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(29, '11111', '2024-05-14 09:53:15', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(30, '11112', '2024-05-14 09:56:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(31, '11112', '2024-05-14 09:58:38', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(32, '11114', '2024-05-14 10:02:33', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(33, '11115', '2024-05-14 10:35:16', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(34, '11116', '2024-05-14 10:42:13', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(35, '11116', '2024-05-14 10:44:26', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(36, '11117', '2024-05-14 13:03:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(37, '11116', '2024-05-14 13:27:23', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(38, '11116', '2024-05-14 13:27:57', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(39, '11116', '2024-05-14 13:36:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(40, '11116', '2024-05-14 14:32:21', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(41, '11116', '2024-05-14 16:28:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL);

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
(16, '11113', '2024-05-14 09:51:20', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(17, '11113', '2024-05-14 09:51:54', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(18, '11112', '2024-05-14 09:53:05', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(19, '11111', '2024-05-14 09:53:17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(20, '11112', '2024-05-14 09:58:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(21, '11112', '2024-05-14 09:59:07', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(22, '11114', '2024-05-14 10:02:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(23, '11115', '2024-05-14 10:39:02', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(24, '11116', '2024-05-14 10:44:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(25, '11116', '2024-05-14 10:44:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(26, '11117', '2024-05-14 13:03:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(27, '11116', '2024-05-14 13:27:26', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(28, '11116', '2024-05-14 13:28:00', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(29, '11116', '2024-05-14 13:36:03', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36');

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
(1, 'PT Juan Mencari Cinta', 'PT Chris Data Abadi', '2024-05-14 22:40:00', 'WB1715701285260848', 'cda binus', 'WB1715701285260848'),
(2, 'PT Abeng Cinta Sejati', '{T Chris Mega Data', '2024-05-14 22:41:00', 'WB1715701352899244', 'chris megadata', 'WB1715701352899244'),
(3, 'PT Rafah ', 'PT Isra', '2024-05-14 22:44:00', 'WB1715701481446447', 'isra', 'WB1715701481446447'),
(4, 'PT CHRISTOPHER', 'PT JUAN PRIYA', '2024-05-14 22:55:00', 'WB1715702173371273', 'BINUS', 'WB1715702173371273'),
(5, 'PT CHRISTOPHER', 'PT JUAN PRIYA', '2024-05-14 22:55:00', 'WB1715702216440578', 'BINUS', 'WB1715702216440578'),
(6, 'PT CHRISTOPHER', 'PT JUAN PRIYA', '2024-05-14 22:55:00', 'WB1715702248255069', 'BINUS', 'WB1715702248255069'),
(7, 'PT CHRISTOPHER', 'PT JUAN PRIYA', '2024-05-14 22:55:00', 'WB1715702285531499', 'BINUS', 'WB1715702285531499'),
(8, 'PT CHRISTOPHER', 'PT JUAN PRIYA', '2024-05-14 22:55:00', 'WB1715702436918766', 'BINUS', 'WB1715702436918766'),
(9, 'Egbert Hung', 'Calvin Stephen', '2024-05-16 00:00:00', 'WB1715704205747044', 'kos keluarga 39dd', 'WB1715704205747044');

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
(1, 1, 'binus001', 'baju binus ', 100, 'binus123', NULL, NULL),
(2, 1, 'binus002', 'lanyard binus', 120, 'binus321', NULL, NULL),
(3, 2, 'megadata001', 'hardisk 100tb', 10, 'purchase server', NULL, NULL),
(4, 2, 'megadata002', 'ssd nvme pcie gen 4 ', 8, 'pruchase server', NULL, NULL),
(5, 3, 'isra001', 'isra', 10, 'isra', 'WB1715701481446447', NULL),
(6, 3, 'isra002', 'isratem', 18, 'isradefense', 'WB1715701481446447', NULL),
(7, 4, 'BINUS001', 'BAJU TIDUR', 120, 'BAJU TIDUR', 'WB1715702173371273', ''),
(8, 4, 'BINUS002', 'CELANA TIDUR', 120, 'BAJU TIDUR', 'WB1715702173371273', ''),
(9, 5, 'BINUS001', 'BAJU TIDUR', 120, 'BAJU TIDUR', 'WB1715702216440578', ''),
(10, 5, 'BINUS002', 'CELANA TIDUR', 120, 'BAJU TIDUR', 'WB1715702216440578', ''),
(11, 6, 'BINUS001', 'BAJU TIDUR', 120, 'BAJU TIDUR', 'WB1715702248255069', 'Array'),
(12, 6, 'BINUS002', 'CELANA TIDUR', 120, 'BAJU TIDUR', 'WB1715702248255069', 'Array'),
(13, 7, 'BINUS001', 'BAJU TIDUR', 120, 'BAJU TIDUR', 'WB1715702285531499', 'Array'),
(14, 7, 'BINUS002', 'CELANA TIDUR', 120, 'BAJU TIDUR', 'WB1715702285531499', 'Array'),
(15, 8, 'BINUS001', 'BAJU TIDUR', 120, 'BAJU TIDUR', 'WB1715702436918766', '125000'),
(16, 8, 'BINUS002', 'CELANA TIDUR', 120, 'BAJU TIDUR', 'WB1715702436918766', '125000'),
(17, 9, 'binus001', 'kondom', 100, 'penjualan warung', 'WB1715704205747044', '15000'),
(18, 9, 'binus002', 'pelumas', 200, 'pelumas licin', 'WB1715704205747044', '30000'),
(19, 9, 'binus003', 'fiesta chicken nugget', 10, 'ayam fiesta', 'WB1715704205747044', '85000');

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
  `lockout_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`NIK`, `username`, `email`, `dob`, `department`, `password`, `login_attempts`, `is_locked`, `lockout_time`) VALUES
('11111', 'juan', 'juan.saputro@binus.edu', '2024-05-14', 'Finance', '$2y$10$GrUW8LF/leSpr/lEW2fZReiPqjsvaWQNPJCiivuzMTu0h8e.wbyjC', 1, 0, NULL),
('11112', 'christopher', 'christopher023@binus.ac.id', '2024-05-14', 'Finance', '$2y$10$QV2tFe3up/HZDaXYcndTF.we/B1UOQ12eavfILFx6ckMOsf4dVOnS', 0, 0, NULL),
('11113', 'egbert', 'egbert@binus.edu', '2024-05-14', 'Finance', '$2y$10$h8nssc0nk5Mzic.5df.nEeX7QfgZ/brhFs19EYhWFmLVNiNHQfcbu', 1, 0, NULL),
('11114', 'Silvanus', 'Silvanus.Suryadi@binus.edu', '2024-05-14', 'IT', '$2y$10$332CSEzaEprYjbKc6pbtSOH5dtMNaHPWMrvxcvH9zXSAjKRmPwIES', 0, 0, NULL),
('11115', 'christopher-', 'christopher-23@binus.ac.id', '2024-05-14', 'IT', '$2y$10$Z2NE6rvPJg384WhDhukCieyeiFqleAen78DOaIyu.VKhc7mPR5Eoi', 0, 0, NULL),
('11116', 'tesadmin', 'tesadmin@binus.edu', '2024-05-14', 'IT', '$2y$10$wdHAHes0SQ1v41wkz4CRCupKbDEzx7d6QIqfOMcIP..z3HNpqLOBG', 0, 0, NULL),
('11117', 'bocahkontol', 'bocahkontol@binus.edu', '2024-05-14', 'Finance', '$2y$10$QOF/XMbl9E.iB9zBeKa07eL.qSpXxo1SVlkXVlBiZ6WrQaZi8uehi', 1, 0, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `logout_history`
--
ALTER TABLE `logout_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
