-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2023 at 12:56 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_xpeedstudio`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_buyers`
--

CREATE TABLE `tbl_buyers` (
  `id` bigint(20) NOT NULL,
  `amount` int(10) DEFAULT NULL,
  `buyer` varchar(255) DEFAULT NULL,
  `receipt_id` varchar(20) DEFAULT NULL,
  `buyer_email` varchar(50) DEFAULT NULL,
  `buyer_ip` varchar(20) DEFAULT NULL,
  `note` text CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `hash_key` varchar(255) DEFAULT NULL,
  `entry_at` date NOT NULL,
  `entry_by` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_buyers`
--

INSERT INTO `tbl_buyers` (`id`, `amount`, `buyer`, `receipt_id`, `buyer_email`, `buyer_ip`, `note`, `city`, `phone`, `hash_key`, `entry_at`, `entry_by`) VALUES
(1, 12, 'Noushadur Rahman', 'abcd', 'noushadur.rahman@gmail.com', '::1', 'টেস্ট', 'Dhaka', '+8801789687067', '0fe74eb52be6c8a74dfcf6f08ad13adb2057ab03b86bd7c6e21c8032f5d3473e89aee2675e7a297b10f6e38e4d018f12d901eccb65c378f5b2e78d15a4a6a28b', '2023-05-19', 123);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE `tbl_items` (
  `id` bigint(20) NOT NULL,
  `buyer_id` bigint(20) NOT NULL,
  `item` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_items`
--

INSERT INTO `tbl_items` (`id`, `buyer_id`, `item`) VALUES
(1, 1, 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_buyers`
--
ALTER TABLE `tbl_buyers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_items`
--
ALTER TABLE `tbl_items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_buyers`
--
ALTER TABLE `tbl_buyers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_items`
--
ALTER TABLE `tbl_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
