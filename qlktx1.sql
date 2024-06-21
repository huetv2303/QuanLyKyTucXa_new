-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 06:19 AM
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
-- Database: `qlktx`
--

-- --------------------------------------------------------

--
-- Table structure for table `dich_vu_dien_nuoc`
--

CREATE TABLE `dich_vu_dien_nuoc` (
  `id_service` varchar(50) NOT NULL,
  `name_service` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dich_vu_dien_nuoc`
--

INSERT INTO `dich_vu_dien_nuoc` (`id_service`, `name_service`, `price`, `unit`) VALUES
('Dien', 'Dịch vụ điện', 4000, 'kWh'),
('Nuoc', 'Dịch vụ nước', 15000, 'm3');

-- --------------------------------------------------------

--
-- Table structure for table `dich_vu_khac`
--

CREATE TABLE `dich_vu_khac` (
  `id_service` varchar(50) NOT NULL,
  `name_service` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `unit` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dich_vu_khac`
--

INSERT INTO `dich_vu_khac` (`id_service`, `name_service`, `price`, `unit`) VALUES
('DV01', 'Internet', 300000, 'tháng'),
('DV02', 'Dịch vụ giặt là', 50000, 'lần'),
('DV05', 'Xe', 300000, 'Tháng');

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don_dich_vu`
--

CREATE TABLE `hoa_don_dich_vu` (
  `id_invoice` varchar(50) NOT NULL,
  `id_room` varchar(50) NOT NULL,
  `electricity` double NOT NULL,
  `water` double NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoa_don_dich_vu`
--

INSERT INTO `hoa_don_dich_vu` (`id_invoice`, `id_room`, `electricity`, `water`, `status`) VALUES
('HD003', 'P002', 80, 4, 'Đã thanh toán');

-- --------------------------------------------------------

--
-- Table structure for table `hopdong`
--

CREATE TABLE `hopdong` (
  `maHopDong` varchar(50) NOT NULL,
  `maNhanVien` varchar(50) NOT NULL,
  `maSinhVien` varchar(50) NOT NULL,
  `maPhong` varchar(50) NOT NULL,
  `ngayBatDau` date NOT NULL,
  `ngayKetThuc` date NOT NULL,
  `tinhTrang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `maNhanVien` varchar(10) NOT NULL,
  `tenNhanVien` varchar(50) NOT NULL,
  `gioiTinh` varchar(10) NOT NULL,
  `ngaySinh` date NOT NULL,
  `diaChi` varchar(100) NOT NULL,
  `soDienThoai` varchar(20) NOT NULL,
  `maToa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `maPhong` varchar(50) NOT NULL,
  `maToa` varchar(50) NOT NULL,
  `soNguoi` int(50) NOT NULL,
  `tienPhong` int(50) NOT NULL,
  `trangThai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'P001', 'DV01'),
(2, 'P001', 'DV02'),
(3, 'P002', 'DV01'),
(4, 'P002', 'DV02'),
(5, 'P002', 'DV05');

-- --------------------------------------------------------

--
-- Table structure for table `thongtinsinhvien`
--

CREATE TABLE `thongtinsinhvien` (
  `maSinhVien` varchar(50) NOT NULL,
  `hoTen` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `soDienThoai` int(50) NOT NULL,
  `ngaySinh` date NOT NULL,
  `gioiTinh` varchar(50) NOT NULL,
  `cccd` varchar(50) NOT NULL,
  `diaChi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `toa`
--

CREATE TABLE `toa` (
  `maToa` varchar(50) NOT NULL,
  `soNhanVien` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `toa`
--

INSERT INTO `toa` (`maToa`, `soNhanVien`) VALUES
('MT1', 2),
('MT2', 2),
('MT3', 3);

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
  ADD PRIMARY KEY (`id_invoice`);

--
-- Indexes for table `hopdong`
--
ALTER TABLE `hopdong`
  ADD PRIMARY KEY (`maHopDong`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`maNhanVien`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`maPhong`);

--
-- Indexes for table `phong_dich_vu`
--
ALTER TABLE `phong_dich_vu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_room` (`id_room`),
  ADD KEY `id_service` (`id_service`);

--
-- Indexes for table `thongtinsinhvien`
--
ALTER TABLE `thongtinsinhvien`
  ADD PRIMARY KEY (`maSinhVien`);

--
-- Indexes for table `toa`
--
ALTER TABLE `toa`
  ADD PRIMARY KEY (`maToa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `phong_dich_vu`
--
ALTER TABLE `phong_dich_vu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
