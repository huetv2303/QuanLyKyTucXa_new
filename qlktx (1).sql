-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 07:24 PM
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
-- Table structure for table `dang_ky_dich_vu`
--

CREATE TABLE `dang_ky_dich_vu` (
  `id` int(11) NOT NULL,
  `id_room` varchar(50) NOT NULL,
  `id_service` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dang_ky_dich_vu`
--

INSERT INTO `dang_ky_dich_vu` (`id`, `id_room`, `id_service`) VALUES
(1, 'A101', 'DV01'),
(2, 'A104', 'DV09'),
(3, 'A104', 'DV02');

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
  `unit` varchar(50) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dich_vu_khac`
--

INSERT INTO `dich_vu_khac` (`id_service`, `name_service`, `price`, `unit`, `note`) VALUES
('DV01', 'Internet', 300000, 'tháng', ''),
('DV02', 'Dịch vụ giặt là', 50000, 'Tháng', ''),
('DV08', 'TV', 323423, 'Tháng', ''),
('DV09', 'Wifi', 300000, 'Tháng', '');

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
  `ended_day` date NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoa_don_dich_vu`
--

INSERT INTO `hoa_don_dich_vu` (`id_invoice`, `id_room`, `electricity`, `water`, `created_day`, `ended_day`, `status`) VALUES
('HD01', 'A102', 6, 5, '2024-06-24', '0000-00-00', 'Chưa thanh toán'),
('HD02', 'A104', 6, 5, '2024-07-09', '0000-00-00', 'Chưa thanh toán');

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
  `MaNhanVien` varchar(10) NOT NULL,
  `TenNhanVien` varchar(50) NOT NULL,
  `GioiTinh` varchar(10) NOT NULL,
  `NgaySinh` date NOT NULL,
  `DiaChi` varchar(100) NOT NULL,
  `SoDienThoai` varchar(20) NOT NULL,
  `maToa` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`MaNhanVien`, `TenNhanVien`, `GioiTinh`, `NgaySinh`, `DiaChi`, `SoDienThoai`, `maToa`) VALUES
('NV001', 'Nguyễn Văn An', 'Nam', '1990-01-01', 'Hà Nội', '0901234567', 'A'),
('NV002', 'Trần Thị Bích', 'Nữ', '1992-02-02', 'Hải Phòng', '0912345678', 'A'),
('NV003', 'Lê Văn Cường', 'Nam', '1993-03-03', 'Đà Nẵng', '0923456789', 'B'),
('NV004', 'Phạm Thị Diễm', 'Nữ', '1994-04-04', 'Huế', '0934567890', 'B'),
('NV005', 'Hoàng Văn Đức', 'Nam', '1995-05-05', 'Nha Trang', '0945678901', 'C'),
('NV006', 'Đỗ Thị Phương', 'Nữ', '1996-06-06', 'Cần Thơ', '0956789012', 'C'),
('NV007', 'Nguyễn Văn Giang', 'Nam', '1997-07-07', 'Vũng Tàu', '0967890123', 'A'),
('NV008', 'Trần Thị Hương', 'Nữ', '1998-08-08', 'Đà Lạt', '0978901234', 'B'),
('NV009', 'Lê Văn Hải', 'Nam', '1999-09-09', 'Buôn Ma Thuột', '0989012345', 'C'),
('NV010', 'Phạm Thị Kim', 'Nữ', '2000-10-10', 'Hồ Chí Minh', '0990123456', 'A');

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

--
-- Dumping data for table `phong`
--

INSERT INTO `phong` (`maPhong`, `maToa`, `soNguoi`, `tienPhong`, `trangThai`) VALUES
('A101', 'A', 4, 2000000, 'còn'),
('A102', 'A', 3, 2000000, 'còn'),
('A103', 'A', 8, 2000000, 'đủ người'),
('A104', 'A', 6, 2000000, 'còn'),
('B201', 'B', 5, 2500000, 'còn'),
('B202', 'B', 8, 2500000, 'đủ người'),
('B203', 'B', 7, 2500000, 'còn'),
('C301', 'C', 2, 3000000, 'còn'),
('C302', 'C', 8, 3000000, 'đủ người'),
('C303', 'C', 6, 3000000, 'còn');

-- --------------------------------------------------------

--
-- Table structure for table `thongtinsinhvien`
--

CREATE TABLE `thongtinsinhvien` (
  `maSinhVien` varchar(50) NOT NULL,
  `hoTen` varchar(100) NOT NULL,
  `maToa` varchar(50) NOT NULL,
  `maPhong` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `soDienThoai` int(50) NOT NULL,
  `ngaySinh` date NOT NULL,
  `gioiTinh` varchar(50) NOT NULL,
  `cccd` varchar(50) NOT NULL,
  `diaChi` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thongtinsinhvien`
--

INSERT INTO `thongtinsinhvien` (`maSinhVien`, `hoTen`, `maToa`, `maPhong`, `email`, `soDienThoai`, `ngaySinh`, `gioiTinh`, `cccd`, `diaChi`) VALUES
('SV001', 'Nguyễn Thị Long', 'A', 'A101', 'huongnguyen@gmail.com', 901234567, '1998-05-10', 'Nữ', '123456789', 'Hà Nội'),
('SV002', 'Trần Văn Nam', 'A', 'A102', 'namtran@gmail.com', 912345678, '1999-06-15', 'Nam', '234567890', 'Hải Phòng'),
('SV003', 'Lê Thị Minh', 'A', 'A103', 'minhle@gmail.com', 923456789, '1997-07-20', 'Nữ', '345678901', 'Đà Nẵng'),
('SV004', 'Phạm Văn Tuấn', 'A', 'A104', 'tuantuan@gmail.com', 934567890, '1998-08-25', 'Nam', '456789012', 'Huế'),
('SV005', 'Hoàng Thị An', 'B', 'B201', 'anhoang@gmail.com', 945678901, '2000-09-30', 'Nữ', '567890123', 'Nha Trang'),
('SV006', 'Đỗ Văn Đức', 'B', 'B202', 'ducdo@gmail.com', 956789012, '1999-10-05', 'Nam', '678901234', 'Cần Thơ'),
('SV007', 'Nguyễn Thị Lan', 'B', 'B203', 'lannguyen@gmail.com', 967890123, '1998-11-15', 'Nữ', '789012345', 'Vũng Tàu'),
('SV008', 'Trần Văn Anh', 'C', 'C301', 'anhtran@gmail.com', 978901234, '2001-12-20', 'Nam', '890123456', 'Đà Lạt'),
('SV009', 'Lê Thị Phương', 'C', 'C302', 'phuongle@gmail.com', 989012345, '2000-01-25', 'Nữ', '901234567', 'Buôn Ma Thuột'),
('SV010', 'Phạm Văn Bình', 'C', 'C303', 'binhpham@gmail.com', 990123456, '1999-02-28', 'Nam', '012345678', 'Hồ Chí Minh');

-- --------------------------------------------------------

--
-- Table structure for table `toa`
--

CREATE TABLE `toa` (
  `maToa` varchar(50) NOT NULL,
  `soPhong` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `toa`
--

INSERT INTO `toa` (`maToa`, `soPhong`) VALUES
('A', 25),
('B', 30),
('C', 35);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dang_ky_dich_vu`
--
ALTER TABLE `dang_ky_dich_vu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_room` (`id_room`),
  ADD KEY `id_service` (`id_service`);

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
-- Indexes for table `hopdong`
--
ALTER TABLE `hopdong`
  ADD PRIMARY KEY (`maHopDong`),
  ADD KEY `maNhanVien` (`maNhanVien`),
  ADD KEY `maPhong` (`maPhong`),
  ADD KEY `maSinhVien` (`maSinhVien`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNhanVien`),
  ADD KEY `maToa` (`maToa`);

--
-- Indexes for table `phong`
--
ALTER TABLE `phong`
  ADD PRIMARY KEY (`maPhong`),
  ADD KEY `maToa` (`maToa`);

--
-- Indexes for table `thongtinsinhvien`
--
ALTER TABLE `thongtinsinhvien`
  ADD PRIMARY KEY (`maSinhVien`),
  ADD KEY `maPhong` (`maPhong`),
  ADD KEY `maToa` (`maToa`);

--
-- Indexes for table `toa`
--
ALTER TABLE `toa`
  ADD PRIMARY KEY (`maToa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dang_ky_dich_vu`
--
ALTER TABLE `dang_ky_dich_vu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dang_ky_dich_vu`
--
ALTER TABLE `dang_ky_dich_vu`
  ADD CONSTRAINT `dang_ky_dich_vu_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `phong` (`maPhong`),
  ADD CONSTRAINT `dang_ky_dich_vu_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `dich_vu_khac` (`id_service`);

--
-- Constraints for table `hoa_don_dich_vu`
--
ALTER TABLE `hoa_don_dich_vu`
  ADD CONSTRAINT `hoa_don_dich_vu_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `phong` (`maPhong`);

--
-- Constraints for table `hopdong`
--
ALTER TABLE `hopdong`
  ADD CONSTRAINT `hopdong_ibfk_1` FOREIGN KEY (`maNhanVien`) REFERENCES `nhanvien` (`MaNhanVien`),
  ADD CONSTRAINT `hopdong_ibfk_2` FOREIGN KEY (`maPhong`) REFERENCES `phong` (`maPhong`),
  ADD CONSTRAINT `hopdong_ibfk_3` FOREIGN KEY (`maSinhVien`) REFERENCES `thongtinsinhvien` (`maSinhVien`);

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `nhanvien_ibfk_1` FOREIGN KEY (`maToa`) REFERENCES `toa` (`maToa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
