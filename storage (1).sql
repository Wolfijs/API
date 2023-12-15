-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2023 at 04:22 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `storage`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `regNumber` varchar(11) NOT NULL,
  `companyName` varchar(255) NOT NULL,
  `sia` varchar(255) NOT NULL,
  `rekviziti` varchar(255) NOT NULL,
  `juridiskaAdrese` varchar(255) NOT NULL,
  `faktiskaAdrese` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `regNumber`, `companyName`, `sia`, `rekviziti`, `juridiskaAdrese`, `faktiskaAdrese`) VALUES
(1, '12345678901', 'hdbj', 'SIA  jknabnasf', 'b hvhvb', 'jb bjj', 'n nb'),
(2, '12345678901', 'EDHKK', 'sia', ' SJDAJ', 'EQWJ', 'EQWLJ'),
(3, '12345678901', 'CryptoMafia', 'AS SVAGERIS', 'HABA202123', 'Cesis Valmieras iela 19', 'Cesis Valmieras iela 19');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `order_company_name` varchar(255) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `statuss` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `product`, `order_company_name`, `quantity`, `statuss`) VALUES
(31, 'sdahkashkksa', 'hdbj', 4, 'Accepted'),
(32, 'dshasd', 'hdbj', 3, 'Delivered'),
(37, 'eqwjbqewbh', 'EDHKK', 1, 'Delivered'),
(38, '213', 'EDHKK', 121, 'Delivered');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_company_name` (`order_company_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
