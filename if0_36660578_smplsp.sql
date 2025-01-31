-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql212.byetcluster.com
-- Generation Time: Jun 12, 2024 at 05:58 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_36660578_smplsp`
--

-- --------------------------------------------------------

--
-- Table structure for table `library_section`
--

CREATE TABLE `library_section` (
  `ItemName` varchar(365) NOT NULL,
  `ProductNumber` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` double DEFAULT NULL,
  `DateArrival` date NOT NULL,
  `Subject` varchar(365) NOT NULL,
  `supply_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `printer_section`
--

CREATE TABLE `printer_section` (
  `ItemName` varchar(255) DEFAULT NULL,
  `ProductNumber` varchar(255) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `DateArrival` date DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `supply_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supplies`
--

CREATE TABLE `supplies` (
  `ItemName` varchar(255) NOT NULL,
  `ProductNumber` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` double NOT NULL,
  `DateArrival` date NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `Section` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `supply_section`
--

CREATE TABLE `supply_section` (
  `ItemName` varchar(12) NOT NULL,
  `ProductNumber` varchar(255) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Price` double DEFAULT NULL,
  `DateArrival` date NOT NULL,
  `Department` text NOT NULL,
  `supply_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` varchar(12) NOT NULL,
  `Password` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Username`, `Password`) VALUES
('admin', 'admin001'),
('user01', 'user123');

-- --------------------------------------------------------

--
-- Table structure for table `u_material`
--

CREATE TABLE `u_material` (
  `ItemName` varchar(255) DEFAULT NULL,
  `ProductNumber` varchar(255) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `DateArrival` date DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `supply_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `library_section`
--
ALTER TABLE `library_section`
  ADD PRIMARY KEY (`supply_id`),
  ADD UNIQUE KEY `FOREIGN` (`ProductNumber`) USING BTREE;

--
-- Indexes for table `printer_section`
--
ALTER TABLE `printer_section`
  ADD PRIMARY KEY (`supply_id`),
  ADD UNIQUE KEY `FOREIGN` (`ProductNumber`) USING BTREE;

--
-- Indexes for table `supplies`
--
ALTER TABLE `supplies`
  ADD PRIMARY KEY (`ProductNumber`);

--
-- Indexes for table `supply_section`
--
ALTER TABLE `supply_section`
  ADD PRIMARY KEY (`supply_id`),
  ADD UNIQUE KEY `FOREIGN` (`ProductNumber`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `u_material`
--
ALTER TABLE `u_material`
  ADD PRIMARY KEY (`supply_id`),
  ADD UNIQUE KEY `FOREIGN` (`ProductNumber`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `library_section`
--
ALTER TABLE `library_section`
  MODIFY `supply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `printer_section`
--
ALTER TABLE `printer_section`
  MODIFY `supply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supply_section`
--
ALTER TABLE `supply_section`
  MODIFY `supply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `u_material`
--
ALTER TABLE `u_material`
  MODIFY `supply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `library_section`
--
ALTER TABLE `library_section`
  ADD CONSTRAINT `library_section_ibfk_1` FOREIGN KEY (`ProductNumber`) REFERENCES `supplies` (`ProductNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `printer_section`
--
ALTER TABLE `printer_section`
  ADD CONSTRAINT `printer_section_ibfk_1` FOREIGN KEY (`ProductNumber`) REFERENCES `supplies` (`ProductNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `supply_section`
--
ALTER TABLE `supply_section`
  ADD CONSTRAINT `supply_section_ibfk_1` FOREIGN KEY (`ProductNumber`) REFERENCES `supplies` (`ProductNumber`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `u_material`
--
ALTER TABLE `u_material`
  ADD CONSTRAINT `u_material_ibfk_1` FOREIGN KEY (`ProductNumber`) REFERENCES `supplies` (`ProductNumber`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
