-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 20, 2024 at 10:58 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlktx1`
--

-- --------------------------------------------------------

--
-- Table structure for table `dich_vu_dien_nuoc`
--

CREATE TABLE `dich_vu_dien_nuoc` (
  `id_service` varchar(50) NOT NULL,
  `name_service` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dich_vu_dien_nuoc`
--

INSERT INTO `dich_vu_dien_nuoc` (`id_service`, `name_service`, `price`, `unit`) VALUES
('Dien', 'Dịch vụ điện', 4000.00, 'kWh'),
('Nuoc', 'Dịch vụ nước', 15000.00, 'm3');

-- --------------------------------------------------------

--
-- Table structure for table `dich_vu_khac`
--

CREATE TABLE `dich_vu_khac` (
  `id_service` varchar(50) NOT NULL,
  `name_service` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dich_vu_khac`
--

INSERT INTO `dich_vu_khac` (`id_service`, `name_service`, `price`, `unit`, `note`) VALUES
('DV01', 'internet', 300000.00, 'Tháng', ''),
('DV02', 'Rác', 40000.00, 'Tháng', ''),
('DV03', 'Giặt là', 20000.00, 'Tháng', ''),
('DV05', 'Xe', 300000.00, 'Tháng', ''),
('DV08', 'TV', 1000000.00, 'Tháng', '');

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don_dich_vu`
--

CREATE TABLE `hoa_don_dich_vu` (
  `id_invoice` varchar(50) NOT NULL,
  `id_room` varchar(50) NOT NULL,
  `electricity` decimal(10,0) NOT NULL,
  `water` decimal(10,0) NOT NULL,
  `created_day` date NOT NULL,
  `ended_day` date DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoa_don_dich_vu`
--

INSERT INTO `hoa_don_dich_vu` (`id_invoice`, `id_room`, `electricity`, `water`, `created_day`, `ended_day`, `status`) VALUES
('HD003', 'P003', 5, 6, '2024-06-19', '2024-06-20', 'Chưa thanh toán'),
('HD004', 'P004', 5, 5, '2024-06-15', '2024-06-20', 'Chưa thanh toán'),
('HD01', 'P002', 5, 5, '0000-00-00', '0000-00-00', 'Chưa thanh toán'),
('HD10', 'P001', 30, 4, '2024-07-23', '2024-07-30', 'Chưa thanh toán');

-- --------------------------------------------------------

--
-- Table structure for table `phong_dich_vu`
--

CREATE TABLE `phong_dich_vu` (
  `id` int(11) NOT NULL,
  `id_room` varchar(50) NOT NULL,
  `id_service` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phong_dich_vu`
--

INSERT INTO `phong_dich_vu` (`id`, `id_room`, `id_service`) VALUES
(24, 'P003', 'DV03'),
(25, 'P003', 'DV02'),
(28, 'P001', 'DV01'),
(29, 'P001', 'DV05'),
(30, 'P002', 'DV01'),
(32, 'P004', 'DV01'),
(33, 'P004', 'DV01'),
(34, 'P004', 'DV01');

-- --------------------------------------------------------

--
-- Table structure for table `phong_ky_tuc_xa`
--

CREATE TABLE `phong_ky_tuc_xa` (
  `id_room` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phong_ky_tuc_xa`
--

INSERT INTO `phong_ky_tuc_xa` (`id_room`) VALUES
('P001'),
('P002'),
('P003'),
('P004');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dich_vu_dien_nuoc`
--
ALTER TABLE `dich_vu_dien_nuoc`
  ADD PRIMARY KEY (`id_service`);

--
-- Indexes for table `dich_vu_khac`
--
ALTER TABLE `dich_vu_khac`
  ADD PRIMARY KEY (`id_service`);

--
-- Indexes for table `hoa_don_dich_vu`
--
ALTER TABLE `hoa_don_dich_vu`
  ADD PRIMARY KEY (`id_invoice`),
  ADD KEY `id_room` (`id_room`);

--
-- Indexes for table `phong_dich_vu`
--
ALTER TABLE `phong_dich_vu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_room` (`id_room`),
  ADD KEY `id_service` (`id_service`);

--
-- Indexes for table `phong_ky_tuc_xa`
--
ALTER TABLE `phong_ky_tuc_xa`
  ADD PRIMARY KEY (`id_room`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phong_dich_vu`
--
ALTER TABLE `phong_dich_vu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hoa_don_dich_vu`
--
ALTER TABLE `hoa_don_dich_vu`
  ADD CONSTRAINT `hoa_don_dich_vu_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `phong_ky_tuc_xa` (`id_room`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `phong_dich_vu`
--
ALTER TABLE `phong_dich_vu`
  ADD CONSTRAINT `phong_dich_vu_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `phong_ky_tuc_xa` (`id_room`),
  ADD CONSTRAINT `phong_dich_vu_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `dich_vu_khac` (`id_service`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
