-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 07:25 AM
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
(5, 'Apin', 'Gacor Kang, 2jam', 0, '../Assets/img/4f4a9c53-3a71-4a0e-b8fb-c31102d231e4.jpg'),
(101, 'Baju Tidur', 'Pakaian nyaman untuk tidur', 0, NULL),
(102, 'Celana Tidur', 'Celana panjang untuk tidur', 70, NULL),
(103, 'Kaos Olahraga', 'Kaos untuk kegiatan olahraga', 30, NULL),
(104, 'Lanyard', 'Lanyard Warna Warni', 0, '../Assets/img/lanyard.jpg');

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
(55, '11119', '2024-05-15 09:02:41', '192.168.0.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 OPR/109.0.0.0', NULL),
(56, '11119', '2024-05-15 09:12:44', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 OPR/109.0.0.0', NULL),
(57, '11116', '2024-05-15 09:33:00', '192.168.0.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(58, '11116', '2024-05-15 09:39:34', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(59, '11116', '2024-05-15 09:45:36', '192.168.0.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 OPR/109.0.0.0', NULL),
(60, '11116', '2024-05-15 11:40:31', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(61, '11116', '2024-05-15 11:59:44', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(62, '11116', '2024-05-15 12:01:32', '192.168.0.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(63, '11116', '2024-05-15 12:20:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(64, '11117', '2024-05-15 12:29:46', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(65, '11117', '2024-05-15 12:32:23', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(66, '11117', '2024-05-15 12:36:06', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(67, '11116', '2024-05-15 14:15:27', '192.168.0.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', NULL),
(68, '11116', '2024-05-15 14:16:36', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', NULL),
(69, '11116', '2024-05-15 15:11:43', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(70, '11116', '2024-05-15 15:30:28', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', NULL),
(71, '11116', '2024-05-17 04:33:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(72, '11116', '2024-05-17 04:44:34', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', NULL),
(73, '11116', '2024-05-17 04:54:30', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', NULL),
(74, '11116', '2024-05-17 05:01:53', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', NULL),
(75, '11116', '2024-05-17 05:13:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', NULL),
(76, '11116', '2024-05-17 05:14:58', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', NULL),
(77, '11117', '2024-05-17 05:19:39', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', NULL),
(78, '11120', '2024-05-17 05:20:49', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0', NULL);

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
(40, '11119', '2024-05-15 09:02:15', '192.168.0.105', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36 OPR/109.0.0.0'),
(41, '11116', '2024-05-15 11:38:47', '192.168.0.104', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(42, '11116', '2024-05-15 11:41:57', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(43, '11116', '2024-05-15 12:19:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(44, '11116', '2024-05-15 12:29:20', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(45, '11116', '2024-05-15 15:15:23', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(46, '11116', '2024-05-17 04:50:42', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0'),
(47, '11116', '2024-05-17 04:54:39', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0'),
(48, '11116', '2024-05-17 05:06:47', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(49, '11116', '2024-05-17 05:07:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0'),
(50, '11116', '2024-05-17 05:14:28', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0'),
(51, '11116', '2024-05-17 05:17:23', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0'),
(52, '11117', '2024-05-17 05:20:04', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0'),
(53, '11120', '2024-05-17 05:21:28', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36 Edg/124.0.0.0');

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
(9, 'Egbert Hung', 'Calvin Stephen', '2024-05-16 00:00:00', 'WB1715704205747044', 'kos keluarga 39dd', 'WB1715704205747044'),
(10, 'PT ASG', 'PT CCS', '2024-05-16 12:44:00', 'WB171575198813', 'PIK 2', 'WB171575198813'),
(11, 'PT Juan MS', 'PT EgB', '2024-05-15 13:31:00', 'WB17157546810', 'wbb', 'WB17157546810'),
(12, 'PT Juan MS', 'PT EgB', '2024-05-15 13:31:00', 'WB171575474788', 'wbb', 'WB171575474788'),
(13, 'PT Juan MS', 'PT EgB', '2024-05-15 13:31:00', 'WB171575493689', 'wbb', 'WB171575493689'),
(14, 'egb', 'calvin', '2024-05-15 13:40:00', 'WB171575522993', 'lol', 'WB171575522993'),
(15, 'asu', 'asyu', '2024-05-15 13:42:00', 'WB171575538366', 'syu', 'WB171575538366'),
(16, 'tod', 'ngen', '2024-05-15 13:49:00', 'WB171575579763', 'todlah', 'WB171575579763');

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
(19, 9, 'binus003', 'fiesta chicken nugget', 10, 'ayam fiesta', 'WB1715704205747044', '85000'),
(20, 10, 'PIK001', 'Batako', 5000, 'Batako Hijau', 'WB171575198813', '1250'),
(21, 10, 'PIK002', 'Semen 3 Roda', 1000, 'Semen', 'WB171575198813', '35000'),
(22, 10, 'PIK003', 'Paving Block', 500, 'Paving Block China', 'WB171575198813', '27500'),
(23, 11, '101', 'Baju Tidur', 2, 'bajuy tidur', 'WB17157546810', '120000'),
(24, 12, '101', 'Baju Tidur', 2, 'bajuy tidur', 'WB171575474788', '120000'),
(25, 13, '101', 'Baju Tidur', 14, 'bajuy tidur', 'WB171575493689', '120000'),
(26, 14, '5', 'Apin', 1, 'apin ', 'WB171575522993', '10.000.000'),
(27, 15, '101', 'Baju Tidur', 4994, 'Asyu', 'WB171575538366', '1000000'),
(28, 16, '104', '104', 1500, 'lanyard mang', 'WB171575579763', '2500');

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
  `is_logged_in` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`NIK`, `username`, `email`, `dob`, `department`, `password`, `login_attempts`, `is_locked`, `lockout_time`, `role_status`, `is_logged_in`) VALUES
('11111', 'juan', 'juan.saputro@binus.edu', '2024-05-14', 'Finance', '$2y$10$GrUW8LF/leSpr/lEW2fZReiPqjsvaWQNPJCiivuzMTu0h8e.wbyjC', 1, 0, NULL, 1, 0),
('11112', 'christopher', 'christopher023@binus.ac.id', '2024-05-14', 'Finance', '$2y$10$QV2tFe3up/HZDaXYcndTF.we/B1UOQ12eavfILFx6ckMOsf4dVOnS', 0, 0, NULL, 1, 0),
('11113', 'egbert', 'egbert@binus.edu', '2024-05-14', 'Finance', '$2y$10$h8nssc0nk5Mzic.5df.nEeX7QfgZ/brhFs19EYhWFmLVNiNHQfcbu', 1, 0, NULL, 1, 0),
('11114', 'Silvanus', 'Silvanus.Suryadi@binus.edu', '2024-05-14', 'IT', '$2y$10$332CSEzaEprYjbKc6pbtSOH5dtMNaHPWMrvxcvH9zXSAjKRmPwIES', 0, 0, NULL, 1, 0),
('11115', 'christopher-', 'christopher-23@binus.ac.id', '2024-05-14', 'IT', '$2y$10$Z2NE6rvPJg384WhDhukCieyeiFqleAen78DOaIyu.VKhc7mPR5Eoi', 0, 0, NULL, 1, 0),
('11116', 'tesadmin', 'tesadmin@binus.edu', '2024-05-14', 'IT', '$2y$10$wdHAHes0SQ1v41wkz4CRCupKbDEzx7d6QIqfOMcIP..z3HNpqLOBG', 3, 1, '2024-05-17 05:18:38', 1, 0),
('11117', 'bocahkontol', 'bocahkontol@binus.edu', '2024-05-14', 'Finance', '$2y$10$QOF/XMbl9E.iB9zBeKa07eL.qSpXxo1SVlkXVlBiZ6WrQaZi8uehi', 0, 0, NULL, 1, 0),
('11118', 'adminlagi', 'adminlagi@binus.edu', '2024-05-15', 'IT', '$2y$10$xox7tqFoMZ.fdyZT4oC2.uLSavEOR82ZxY.yeOw5e/uqB/Ucf1gbW', 0, 0, NULL, 1, 0),
('11119', 'egbert', 'egbert09@gmail.com', '2024-05-15', 'IT', '$2y$10$JlBBWBMdLQf2anL3qyFoYeC6IUm8naNTDpY7CZ8i8C4OLROF9b41m', 0, 0, NULL, 1, 0),
('11120', 'nonadmin', 'nonadmin@binus.edu', '2024-05-17', 'IT', '$2y$10$NeWq8zSxE5CDIqquKENBUOIP8sTCzBR8f2Tdp1SSYpb5v1xtEvcZu', 0, 0, NULL, 2, 0);

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
(1, 106, 'Penggaris', 11100, '2024-05-10', '2024-05-15 10:49:21', NULL, NULL),
(2, 107, 'Stabilo', 3350, '2024-05-11', '2024-05-15 10:49:26', NULL, NULL),
(3, 8, 'tissue basah', 10000, '0000-00-00', '2024-05-15 06:26:37', '../Assets/img/items/download.jpeg', 'tisu basah'),
(4, 9, 'tissue kering', 10990, '0000-00-00', '2024-05-15 06:27:05', '../Assets/img/items/download.jpeg', 'tisu kering'),
(5, 9, 'lanyard', 1000, '0000-00-00', '2024-05-15 06:28:03', '../Assets/img/items/lanyard.jpg', 'lanyard'),
(6, 122312, 'Kondom', 100, '0000-00-00', '2024-05-15 07:30:23', '../Assets/img/items/gambar.jpeg', 'sutra'),
(7, 999, 'babi', 100, '0000-00-00', '2024-05-15 10:32:03', '../Assets/img/items/fcn.jpeg', 'babi');

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

--
-- Dumping data for table `warehouse_bogor`
--

INSERT INTO `warehouse_bogor` (`id`, `id_barang`, `nama_barang`, `jumlah_stok`, `last_audit`, `last_update`, `image_path`, `description`) VALUES
(1, 108, 'Lem', 4400, '2024-05-12', '2024-05-15 11:10:24', NULL, NULL),
(2, 109, 'Penggaris Segitiga', 100000, '2024-05-13', '2024-05-15 11:10:28', NULL, NULL);

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

--
-- Dumping data for table `warehouse_china`
--

INSERT INTO `warehouse_china` (`id`, `id_barang`, `nama_barang`, `jumlah_stok`, `last_audit`, `last_update`, `image_path`, `description`) VALUES
(1, 101, 'Pensil', 500, '2024-05-10', '2024-05-14 01:30:00', NULL, NULL),
(2, 102, 'Buku Tulis', 300, '2024-05-08', '2024-05-14 02:45:00', NULL, NULL),
(3, 103, 'Penghapus', 700, '2024-05-12', '2024-05-14 03:20:00', NULL, NULL),
(4, 104, 'Kondom', 300, '0000-00-00', '2024-05-15 05:14:29', '../Assets/img/items/fcn.jpeg', 'Fiesta Chicken nugget');

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
-- Dumping data for table `warehouse_jakarta`
--

INSERT INTO `warehouse_jakarta` (`id`, `id_barang`, `nama_barang`, `jumlah_stok`, `last_audit`, `last_update`, `image_path`, `description`) VALUES
(1, 104, 'Spidol', 23422, '2024-05-11', '2024-05-15 11:34:32', NULL, NULL),
(2, 105, 'Pensil Warna', 2900, '2024-05-09', '2024-05-15 11:33:22', NULL, NULL),
(3, 109, 'Kondom', 14512, '0000-00-00', '2024-05-15 11:33:23', '../Assets/img/items/fcn.jpeg', 'Fiesta Chicken Nugget');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `logout_history`
--
ALTER TABLE `logout_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `warehouse_batam`
--
ALTER TABLE `warehouse_batam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
