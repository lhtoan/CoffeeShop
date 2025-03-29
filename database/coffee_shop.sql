-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 29, 2025 lúc 01:49 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `coffee_shop`
--
create database coffee_shop character set 'utf8';
use coffee_shop;
-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `ma_hd` varchar(30) NOT NULL,
  `ma_sp` int(11) NOT NULL,
  `soluong` int(11) DEFAULT NULL,
  `dongia` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chitiethoadon`
--

INSERT INTO `chitiethoadon` (`ma_hd`, `ma_sp`, `soluong`, `dongia`) VALUES
('HD04052024203619', 3, 1, 32000.00),
('HD04052024203619', 4, 1, 37000.00),
('HD04052024203619', 6, 1, 30000.00),
('HD04052024224112', 1, 1, 20000.00),
('HD04052024224112', 2, 1, 25000.00),
('HD04052024224112', 3, 1, 32000.00),
('HD04052024230501', 2, 1, 25000.00),
('HD04052024230501', 3, 1, 32000.00),
('HD04052024230501', 4, 1, 37000.00),
('HD04052024230501', 6, 1, 30000.00),
('HD05052024094234', 3, 1, 32000.00),
('HD05052024094234', 5, 1, 25000.00),
('HD05052024094234', 6, 1, 30000.00),
('HD05052024094234', 7, 1, 25000.00),
('HD05052024211828', 1, 1, 20000.00),
('HD05052024211828', 3, 1, 32000.00),
('HD05052024211828', 4, 2, 74000.00),
('HD05052024212107', 10, 1, 37000.00),
('HD05052024212107', 13, 1, 17000.00),
('HD05052024212514', 1, 2, 50000.00),
('HD05052024212514', 2, 1, 25000.00),
('HD05052024212514', 3, 1, 32000.00),
('HD05052024212514', 4, 1, 37000.00),
('HD05052024212514', 5, 1, 25000.00),
('HD06052024080850', 3, 1, 32000.00),
('HD06052024080850', 4, 1, 37000.00),
('HD06052024083350', 2, 1, 25000.00),
('HD06052024083350', 3, 1, 32000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `ma_hd` varchar(30) NOT NULL,
  `ngaylap_hd` datetime DEFAULT NULL,
  `tong_tien` decimal(10,2) DEFAULT NULL,
  `ma_kh` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`ma_hd`, `ngaylap_hd`, `tong_tien`, `ma_kh`) VALUES
('HD01', '2024-01-12 13:20:30', 600000.00, 'lhtoan'),
('HD010', '2024-04-24 13:20:30', 400000.00, NULL),
('HD02', '2024-02-12 13:20:30', 231000.00, 'lhtoan'),
('HD03', '2024-03-12 13:20:30', 540000.00, 'lhtoan'),
('HD04', '2024-04-11 13:20:30', 300000.00, 'lhtoan'),
('HD04052024203619', '2024-05-04 20:36:19', 99000.00, NULL),
('HD04052024224112', '2024-05-04 22:41:12', 77000.00, NULL),
('HD04052024230501', '2024-05-04 23:05:01', 124000.00, NULL),
('HD05', '2024-04-06 13:20:30', 120000.00, 'lhtoan'),
('HD05052024094234', '2024-05-05 09:42:34', 112000.00, 'KHTTD05052024094231'),
('HD05052024211828', '2024-05-05 21:18:28', 126000.00, 'lhtoan'),
('HD05052024212107', '2024-05-05 21:21:07', 54000.00, 'tva'),
('HD05052024212514', '2024-05-05 21:25:14', 169000.00, 'KHNTF05052024212511'),
('HD06', '2024-04-07 13:20:30', 500000.00, 'lhtoan'),
('HD06052024080850', '2024-05-06 08:08:50', 69000.00, NULL),
('HD06052024083350', '2024-05-06 08:33:50', 57000.00, 'lhtoan'),
('HD07', '2024-04-08 13:20:30', 680000.00, 'lhtoan'),
('HD08', '2024-04-09 13:20:30', 790000.00, 'lhtoan'),
('HD09', '2024-04-10 13:20:30', 400000.00, 'lhtoan');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `ma_kh` varchar(20) NOT NULL,
  `ten_kh` varchar(100) DEFAULT NULL,
  `sdt` varchar(12) DEFAULT NULL,
  `gioitinh` varchar(10) DEFAULT NULL,
  `ngay_sinh` date DEFAULT NULL,
  `diemtichluy` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`ma_kh`, `ten_kh`, `sdt`, `gioitinh`, `ngay_sinh`, `diemtichluy`) VALUES
('KHNTF05052024212511', 'Nguyễn Thị F', '0982783675', 'Nữ', '2024-05-20', 16.9),
('KHTTD05052024094231', 'Trần Thị D', '0781627836', 'Nữ', '2024-05-20', 11.2),
('lhtoan', 'Lê Huy Toàn', '0918726736', 'Nam', '2003-08-13', 18.3),
('tva', 'Trần Văn A', '0918726167', 'Nam', '2003-08-13', 5.4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `ma_sp` int(11) NOT NULL,
  `ten_sp` varchar(255) NOT NULL,
  `gia` decimal(10,2) NOT NULL,
  `donvitinh` varchar(10) NOT NULL,
  `hinhanh_sp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`ma_sp`, `ten_sp`, `gia`, `donvitinh`, `hinhanh_sp`) VALUES
(1, 'Cà phê đá', 30000.00, 'Ly', 'sp7.jpg'),
(2, 'Cà phê sữa', 25000.00, 'Ly', 'sp13.jpg'),
(3, 'Matcha sữa', 32000.00, 'Ly', 'sp8.jpg'),
(4, 'Matcha ba tầng', 37000.00, 'Ly', 'sp9.jpg'),
(5, 'Trà chanh', 25000.00, 'Ly', 'sp10.jpg'),
(6, 'Soda nhiệt đới', 30000.00, 'Ly', 'sp12.jpg'),
(7, 'Trà đào', 25000.00, 'Ly', 'sp14.jpg'),
(8, 'Soda dâu', 30000.00, 'Ly', 'sp16.jpg'),
(9, 'Cacao sữa', 30000.00, 'Ly', 'sp11.jpg'),
(10, 'Cacao đá xây', 37000.00, 'Ly', 'sp17.jpg'),
(11, 'Trà thái xanh', 27000.00, 'Ly', 'sp15.jpg'),
(12, 'Dâu tây đá xây', 40000.00, 'Ly', 'sp18.jpg'),
(13, 'Bánh mì', 17000.00, 'Cái', 'sp21.jpg'),
(14, 'Banh', 30000.00, 'Cái', 'sp22.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`ma_hd`,`ma_sp`),
  ADD KEY `ma_sp` (`ma_sp`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`ma_hd`),
  ADD KEY `ma_kh` (`ma_kh`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`ma_kh`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`ma_sp`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `ma_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `chitiethoadon_ibfk_1` FOREIGN KEY (`ma_hd`) REFERENCES `hoadon` (`ma_hd`),
  ADD CONSTRAINT `chitiethoadon_ibfk_2` FOREIGN KEY (`ma_sp`) REFERENCES `sanpham` (`ma_sp`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_1` FOREIGN KEY (`ma_kh`) REFERENCES `khachhang` (`ma_kh`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
