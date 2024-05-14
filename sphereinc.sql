-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2024 at 07:39 PM
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
(1, '11111', '2024-05-13 16:05:17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(2, '11112', '2024-05-13 16:06:29', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(3, '11115', '2024-05-13 16:14:17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(4, '11116', '2024-05-13 16:19:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(5, '11117', '2024-05-13 16:22:38', '192.168.0.103', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4.1 Mobile/15E148 Safari/604.1', NULL),
(6, '11117', '2024-05-13 16:26:57', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(7, '11117', '2024-05-13 16:29:14', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(8, '11117', '2024-05-13 16:35:11', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(9, '11117', '2024-05-13 16:36:38', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(10, '11117', '2024-05-13 16:36:50', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(11, '11117', '2024-05-13 16:40:17', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(12, '11117', '2024-05-13 16:40:36', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(13, '11118', '2024-05-13 16:42:53', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL),
(14, '11117', '2024-05-13 16:47:18', '192.168.0.103', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4.1 Mobile/15E148 Safari/604.1', NULL),
(15, '11118', '2024-05-13 16:49:13', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36', NULL);

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
(1, '11117', '2024-05-13 16:40:19', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(2, '11117', '2024-05-13 16:40:37', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(3, '11118', '2024-05-13 16:43:38', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36'),
(4, '11117', '2024-05-13 16:47:34', '192.168.0.103', 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_4_1 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.4.1 Mobile/15E148 Safari/604.1'),
(5, '11118', '2024-05-13 16:49:32', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36');

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
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`NIK`, `username`, `email`, `dob`, `department`, `password`) VALUES
('11111', 'chris', 'chris@binus.edu', '2024-05-13', 'IT', '$2y$10$knY29myoGhx3NLtMCqlq3eLNKHGnS9C3yASAJSyg44aMc5R6k6JYW'),
('11112', 'juanbigbeng', 'juan@binus.edu', '2024-05-13', 'Finance', '$2y$10$eXppf76M9ptNJhr2eFYKcO9T4Io8yDR6IDr17bDwd0P4Jsvip9l0G'),
('11113', 'egbert', 'egbert@binus.edu', '2024-05-13', 'Marketing', '$2y$10$sA5MkOCbQbNYN5oW6CfAbuw5jEiHqPzszEfSPCYMPSW95njjS.SLa'),
('11114', 'calstep', 'calvinstephen@binus.edu', '2024-05-13', 'IT', '$2y$10$EIMC4LRSvVYxH1JIa2y3oO3FYa/l3AraLQD2DqqCrrgJcrAszPZuS'),
('11115', 'calsur', 'calvinsuryadi@binus.edu', '2024-05-13', 'Finance', '$2y$10$Wbvjx7j2A2tBtdI4qpYFrOAUwy3B60V1bVxLyBoVQbIvAmUzVDo/S'),
('11116', 'fandi', 'fandi@binus.ac.id', '2024-05-13', 'HR', '$2y$10$SKj5Ue87d16/Rysw6Uc50eRrR.CEW0WQ/esOSnrr/iNlDRt/k//O6'),
('11117', 'chrisbagus', 'chrisbagus@gmail.com', '2024-05-13', 'IT', '$2y$10$XXoJQrbDxQV3i0SyO.5zcu57h0Ovz4xs4w4JFLIvos89gFF3drYaG'),
('11118', 'rubil', 'rubil@binus.ac.id', '2024-05-13', 'IT', '$2y$10$FXigySImNogunZ66vHD6Nu/xcND9OOgAxY6uf1KvwiyGBp4UoB/De');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`NIK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `logout_history`
--
ALTER TABLE `logout_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
