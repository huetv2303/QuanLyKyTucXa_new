-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2024 at 08:16 AM
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
-- Database: `qlktx2`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `dang_ky_dich_vu`
--

CREATE TABLE `dang_ky_dich_vu` (
  `id` int(11) NOT NULL,
  `maToa` varchar(50) NOT NULL,
  `id_room` varchar(50) NOT NULL,
  `id_service` varchar(50) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dang_ky_dich_vu`
--

INSERT INTO `dang_ky_dich_vu` (`id`, `maToa`, `id_room`, `id_service`, `month`, `year`) VALUES
(46, 'B', 'B201', 'DV05', 5, 2024);

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
-- Table structure for table `dich_vu_gui_xe`
--

CREATE TABLE `dich_vu_gui_xe` (
  `ID` varchar(10) NOT NULL,
  `studentName` varchar(40) NOT NULL,
  `roomCode` varchar(10) NOT NULL,
  `buildingCode` varchar(10) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `registerDate` date NOT NULL,
  `typeOfVehicle` varchar(50) NOT NULL,
  `plate` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dich_vu_gui_xe`
--

INSERT INTO `dich_vu_gui_xe` (`ID`, `studentName`, `roomCode`, `buildingCode`, `phoneNumber`, `email`, `registerDate`, `typeOfVehicle`, `plate`) VALUES
('123', 'trần gia bảo', 'A101', 'A', '12312312', 'tranbao@gmai.com', '2024-12-12', 'xe máy', '90B4-00871');

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
('DV02', 'Dịch vụ giặt là', 50000, 'Tháng', ''),
('DV05', 'Xe', 300000, 'Tháng', ''),
('DV08', 'TV', 323423, 'Tháng', ''),
('DV09', 'Wifi', 300000, 'Tháng', '');

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don_dich_vu`
--

CREATE TABLE `hoa_don_dich_vu` (
  `id_invoice` varchar(50) NOT NULL,
  `maToa` varchar(50) NOT NULL,
  `id_room` varchar(50) NOT NULL,
  `soDien` decimal(10,0) NOT NULL,
  `khoiNuoc` decimal(10,0) NOT NULL,
  `electricity` decimal(10,0) NOT NULL,
  `water` decimal(10,0) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `created_day` date NOT NULL,
  `ended_day` date DEFAULT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoa_don_dich_vu`
--

INSERT INTO `hoa_don_dich_vu` (`id_invoice`, `maToa`, `id_room`, `soDien`, `khoiNuoc`, `electricity`, `water`, `month`, `year`, `created_day`, `ended_day`, `status`) VALUES
('HD01', 'B', 'B201', 234, 23, 257, 50, 7, 2024, '2024-07-09', '2024-07-24', 'Chưa thanh toán'),
('HD02', 'A', 'A101', 234, 23, 257, 100, 6, 2024, '2024-07-09', '0000-00-00', 'Chưa thanh toán');

-- --------------------------------------------------------

--
-- Table structure for table `hoa_don_gui_xe`
--

CREATE TABLE `hoa_don_gui_xe` (
  `billCode` varchar(20) NOT NULL,
  `ID` varchar(20) NOT NULL,
  `studentName` varchar(50) NOT NULL,
  `month` varchar(11) NOT NULL,
  `price` varchar(10) NOT NULL,
  `invoiceDate` date NOT NULL,
  `vehicle` varchar(50) NOT NULL,
  `plate` varchar(20) NOT NULL,
  `status` varchar(50) NOT NULL,
  `note` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hoa_don_gui_xe`
--

INSERT INTO `hoa_don_gui_xe` (`billCode`, `ID`, `studentName`, `month`, `price`, `invoiceDate`, `vehicle`, `plate`, `status`, `note`) VALUES
('HD002', '2', 'phùng nghĩa minh', '2', '123345', '2024-07-03', 'xe đạp', '29AX-00000', 'Chưa thanh toán', NULL),
('HD003', '73DCTT2337', 'Tưởng văn huế', '4', '150,000', '2024-06-29', 'xe máy', '90B4-00876', 'Đã thanh toán', 'bạn huế là người đó');

-- --------------------------------------------------------

--
-- Table structure for table `hopdong`
--

CREATE TABLE `hopdong` (
  `maHopDong` varchar(50) NOT NULL,
  `MaNhanVien` varchar(50) NOT NULL,
  `maTruongNhom` varchar(50) NOT NULL,
  `maToa` varchar(50) NOT NULL,
  `maPhong` varchar(50) NOT NULL,
  `ngayBatDau` date NOT NULL,
  `ngayKetThuc` date NOT NULL,
  `tinhTrang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hopdong`
--

INSERT INTO `hopdong` (`maHopDong`, `MaNhanVien`, `maTruongNhom`, `maToa`, `maPhong`, `ngayBatDau`, `ngayKetThuc`, `tinhTrang`) VALUES
('HD001', 'NV001', 'SV001', 'A', 'A101', '2024-07-10', '2024-08-02', 'Còn hạn'),
('HD002', 'NV004', 'SV002', 'A', 'A102', '2024-07-10', '2024-07-25', 'Còn hạn');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `MaNhanVien` varchar(50) NOT NULL,
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
('NV001', 'Nguyễn Văn Đức', 'Nam', '1990-01-01', 'Hà Nội', '0901234568', 'A'),
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
-- Table structure for table `nhomsinhvien`
--

CREATE TABLE `nhomsinhvien` (
  `maNhomSinhVien` varchar(50) NOT NULL,
  `maTruongNhom` varchar(50) NOT NULL,
  `maPhong` varchar(50) NOT NULL,
  `soLuong` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nhomsinhvien`
--

INSERT INTO `nhomsinhvien` (`maNhomSinhVien`, `maTruongNhom`, `maPhong`, `soLuong`) VALUES
('1', 'SV001', 'A101', 2),
('2', 'SV002', 'A102', 1),
('3', 'SV003', 'A103', 1);

-- --------------------------------------------------------

--
-- Table structure for table `noptienphong`
--

CREATE TABLE `noptienphong` (
  `maGiaoDich` int(11) NOT NULL,
  `maToa` varchar(50) NOT NULL,
  `maPhong` varchar(50) NOT NULL,
  `tienPhong` int(50) NOT NULL,
  `thang` int(10) NOT NULL,
  `nam` int(10) NOT NULL,
  `ngayNop` date NOT NULL,
  `ngayHetHan` date NOT NULL,
  `trangThai` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `noptienphong`
--

INSERT INTO `noptienphong` (`maGiaoDich`, `maToa`, `maPhong`, `tienPhong`, `thang`, `nam`, `ngayNop`, `ngayHetHan`, `trangThai`) VALUES
(444, 'A', 'A102', 2000000, 5, 2024, '2024-07-31', '2024-07-27', 'Chưa thanh toán'),
(1111, 'A', 'A102', 2000000, 5, 2024, '2024-07-19', '2024-07-10', 'Đã thanh toán'),
(2222, 'B', 'B201', 2500000, 5, 2024, '2024-07-11', '2024-07-13', 'Đã thanh toán');

-- --------------------------------------------------------

--
-- Table structure for table `phong`
--

CREATE TABLE `phong` (
  `maPhong` varchar(50) NOT NULL,
  `maToa` varchar(50) NOT NULL,
  `soNguoi` int(50) NOT NULL,
  `tienPhong` int(50) NOT NULL,
  `trangThai` varchar(50) NOT NULL,
  `maNhomSinhVien` varchar(50) NOT NULL,
  `maHopDong` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `phong`
--

INSERT INTO `phong` (`maPhong`, `maToa`, `soNguoi`, `tienPhong`, `trangThai`, `maNhomSinhVien`, `maHopDong`) VALUES
('A101', 'A', 4, 2000000, 'Trống', '', 'HD001'),
('A102', 'A', 3, 2000000, 'Trống', '', 'HD002'),
('A103', 'A', 3, 2000000, 'Trống', '', ''),
('A104', 'A', 2, 2000000, 'Trống', '', '098765'),
('B201', 'B', 5, 2500000, 'Trống', '', ''),
('B202', 'B', 8, 2500000, 'Hết', '', ''),
('B203', 'B', 7, 2500000, 'Trống', '', ''),
('C301', 'C', 2, 3000000, 'Trống', '', ''),
('C302', 'C', 8, 3000000, 'Hết', '', ''),
('C303', 'C', 6, 3000000, 'Trống', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `thongtinsinhvien`
--

CREATE TABLE `thongtinsinhvien` (
  `maSinhVien` varchar(50) NOT NULL,
  `maNhomSinhVien` varchar(50) NOT NULL,
  `hoTen` varchar(100) NOT NULL,
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

INSERT INTO `thongtinsinhvien` (`maSinhVien`, `maNhomSinhVien`, `hoTen`, `email`, `soDienThoai`, `ngaySinh`, `gioiTinh`, `cccd`, `diaChi`) VALUES
('SV001', '1', 'Nguyễn Thị Long', 'huongnguyen@gmail.com', 901234567, '1998-05-10', 'Nam', '123456789', 'Hà Nội'),
('SV002', '2', 'Trần Văn Nam', 'namtran@gmail.com', 912345678, '1999-06-15', 'Nam', '234567890', 'Hải Phòng'),
('SV003', '3', 'Lê Thị Minh', 'minhle@gmail.com', 923456789, '1997-07-20', 'Nữ', '345678901', 'Đà Nẵng'),
('SV004', '1', 'Phạm Văn Tuấn', 'tuantuan@gmail.com', 934567890, '1998-08-25', 'Nam', '456789012', 'Huế'),
('SV005', '', 'Hoàng Thị An', 'anhoang@gmail.com', 945678901, '2000-09-30', 'Nữ', '567890123', 'Nha Trang'),
('SV006', '', 'Đỗ Văn Đức', 'ducdo@gmail.com', 956789012, '1999-10-05', 'Nam', '678901234', 'Cần Thơ'),
('SV007', '', 'Nguyễn Thị Lan', 'lannguyen@gmail.com', 967890123, '1998-11-15', 'Nữ', '789012345', 'Vũng Tàu'),
('SV008', '', 'Trần Văn Anh', 'anhtran@gmail.com', 978901234, '2001-12-20', 'Nam', '890123456', 'Đà Lạt'),
('SV009', '', 'Lê Thị Phương', 'phuongle@gmail.com', 989012345, '2000-01-25', 'Nữ', '901234567', 'Buôn Ma Thuột'),
('SV010', '', 'Phạm Văn Bình', 'binhpham@gmail.com', 990123456, '1999-02-28', 'Nam', '012345678', 'Hồ Chí Minh');

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
('C', 35),
('D', 26);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `dich_vu_gui_xe`
--
ALTER TABLE `dich_vu_gui_xe`
  ADD PRIMARY KEY (`ID`);

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
  ADD KEY `id_room` (`id_room`),
  ADD KEY `maToa` (`maToa`);

--
-- Indexes for table `hoa_don_gui_xe`
--
ALTER TABLE `hoa_don_gui_xe`
  ADD PRIMARY KEY (`billCode`);

--
-- Indexes for table `hopdong`
--
ALTER TABLE `hopdong`
  ADD PRIMARY KEY (`maHopDong`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNhanVien`),
  ADD KEY `maToa` (`maToa`);

--
-- Indexes for table `nhomsinhvien`
--
ALTER TABLE `nhomsinhvien`
  ADD PRIMARY KEY (`maNhomSinhVien`);

--
-- Indexes for table `noptienphong`
--
ALTER TABLE `noptienphong`
  ADD PRIMARY KEY (`maGiaoDich`),
  ADD KEY `maPhong` (`maPhong`);

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
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dang_ky_dich_vu`
--
ALTER TABLE `dang_ky_dich_vu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `noptienphong`
--
ALTER TABLE `noptienphong`
  MODIFY `maGiaoDich` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22223;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dang_ky_dich_vu`
--
ALTER TABLE `dang_ky_dich_vu`
  ADD CONSTRAINT `dang_ky_dich_vu_ibfk_1` FOREIGN KEY (`id_service`) REFERENCES `dich_vu_khac` (`id_service`);

--
-- Constraints for table `phong`
--
ALTER TABLE `phong`
  ADD CONSTRAINT `phong_ibfk_1` FOREIGN KEY (`maToa`) REFERENCES `toa` (`maToa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
