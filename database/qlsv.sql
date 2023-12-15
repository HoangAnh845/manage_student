-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th7 30, 2023 lúc 10:38 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qlsv`
--

-- --------------------------------------------------------

CREATE TABLE `tbl_danhgnhap` (
  `id` bigint(20) UNSIGNED,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
);

-- INSERT INTO `tbl_danhgnhap` (`email`, `password`) VALUES
-- (1721050251, 7080116, 7, 6, 6),
-- (1721050409, 7080116, 0, 0, 6),
-- (1821050160, 7080116, 8, 9, 10),

--
-- Cấu trúc bảng cho bảng `tbl_diemhocphan`
--

CREATE TABLE `tbl_diemhocphan` (
  `Mã sinh viên` int(50) NOT NULL,
  `Mã học phần` int(50) NOT NULL,
  `A` smallint(10) NOT NULL,
  `B` smallint(10) NOT NULL,
  `C` smallint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_diemhocphan`
--

INSERT INTO `tbl_diemhocphan` (`Mã sinh viên`, `Mã học phần`, `A`, `B`, `C`) VALUES
(1721050251, 7080116, 7, 6, 6),
(1721050409, 7080116, 0, 0, 6),
(1821050160, 7080116, 8, 9, 10),
(1821050161, 7080116, 0, 0, 8),
(1821050709, 7080116, 8, 7, 10),
(1821050942, 7080116, 7, 8, 8),
(1821051099, 7080116, 6, 9, 10),
(1921050080, 7080116, 8, 8, 8),
(1921050114, 7080116, 5, 7, 6),
(1921050195, 7080116, 5, 7, 6),
(1921050206, 7080116, 8, 8, 8),
(1921050245, 7080116, 0, 0, 6),
(1921050346, 7080116, 8, 9, 10),
(1921050563, 7080116, 8, 6, 10),
(1921050700, 7080116, 8, 7, 8),
(1921050769, 7080116, 6, 8, 7),
(2021050113, 7080116, 6, 7, 6),
(2021050151, 7080116, 6, 8, 8),
(2021050153, 7080116, 7, 8, 8),
(2021050160, 7080116, 8, 8, 9),
(2021050181, 7080116, 0, 0, 6),
(2021050206, 7080116, 5, 9, 10),
(2021050222, 7080116, 5, 9, 10),
(2021050233, 7080116, 8, 9, 10),
(2021050246, 7080116, 8, 8, 9),
(2021050266, 7080116, 5, 7, 6),
(2021050270, 7080116, 8, 9, 10),
(2021050312, 7080116, 8, 8, 9),
(2021050319, 7080116, 6, 8, 9),
(2021050326, 7080116, 8, 9, 10),
(2021050343, 7080116, 8, 9, 10),
(2021050344, 7080116, 8, 8, 8),
(2021050352, 7080116, 7, 7, 6),
(2021050362, 7080116, 7, 7, 6),
(2021050363, 7080116, 0, 0, 6),
(2021050367, 7080116, 6, 8, 9),
(2021050372, 7080116, 8, 9, 10),
(2021050373, 7080116, 5, 7, 6),
(2021050377, 7080116, 8, 8, 8),
(2021050406, 7080116, 8, 8, 9),
(2021050437, 7080116, 0, 0, 6),
(2021050482, 7080116, 7, 9, 10),
(2021050483, 7080116, 0, 7, 6),
(2021050545, 7080116, 8, 8, 9),
(2021050548, 7080116, 9, 7, 9),
(2021050633, 7080116, 8, 6, 10),
(2021050852, 7080116, 0, 0, 6),
(2021050855, 7080116, 0, 0, 6),
(2024011376, 7080116, 7, 7, 9),
(2121050140, 7080116, 10, 10, 10),
(2121050151, 7080116, 0, 0, 6),
(2121050152, 7080116, 0, 8, 9),
(2121050169, 7080116, 6, 7, 6),
(2121050190, 7080116, 6, 7, 7),
(2121050405, 7080116, 5, 8, 6),
(2121050765, 7080116, 6, 8, 9),
(2121050769, 7080116, 6, 7, 6),
(2121051087, 7080116, 6, 8, 9),
(2121051137, 7080116, 7, 7, 6),
(2121051194, 7080116, 0, 7, 6),
(2121051196, 7080116, 0, 7, 6),
(2121051293, 7080116, 6, 8, 8),
(2121051410, 7080116, 0, 7, 6),
(2121051416, 7080116, 5, 8, 8),
(2121051437, 7080116, 0, 7, 6),
(2121051472, 7080116, 0, 0, 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_hocphan`
--

CREATE TABLE `tbl_hocphan` (
  `Mã học phần` int(10) NOT NULL,
  `Tên học phần` varchar(50) NOT NULL,
  `Tín chỉ` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_hocphan`
--

INSERT INTO `tbl_hocphan` (`Mã học phần`, `Tên học phần`, `Tín chỉ`) VALUES
(7080112, 'Trí tuệ nhân tạo', 3),
(7080116, 'Phát triển ứng dụng web + BTL', 4),
(7080118, 'Thiết kế website', 2),
(7080206, 'Cấu trúc dữ liệu&Giải thuật', 3),
(7080319, 'Trực quan hóa dữ liệu', 3),
(7080323, 'Dịch vụ dựa trên địa điểm', 3),
(7080403, 'Đồ án CNTT Địa học', 2),
(7080410, 'Nhập môn nghành Khoa học Dữ liệu', 3),
(7080512, 'Lập trình hướng đối tượng với Java', 3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_khoa`
--

CREATE TABLE `tbl_khoa` (
  `Mã khoa` int(4) NOT NULL,
  `Tên khoa` varchar(39) NOT NULL,
  `Điện thoại` varchar(18) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_khoa`
--

INSERT INTO `tbl_khoa` (`Mã khoa`, `Tên khoa`, `Điện thoại`) VALUES
(7060, 'Dầu khí', '(84-24) 3838-7570'),
(7080, 'Công nghệ thông tin', '(84-24) 3838-7570'),
(7100, 'Xây dựng', '(84-43) 8387-5681'),
(8050, 'Trắc địa - Bản đồ và quản lý đất đai', '(84-24) 8767-5441'),
(8070, 'Kinh tế & QTKD', '(84-26) 7678-5221');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_lopchuyennganh`
--

CREATE TABLE `tbl_lopchuyennganh` (
  `Mã lớp` varchar(20) NOT NULL,
  `Tên lớp` varchar(50) NOT NULL,
  `Niên khóa` varchar(5) NOT NULL,
  `Sĩ số` int(50) NOT NULL,
  `Mã khoa` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_lopchuyennganh`
--

INSERT INTO `tbl_lopchuyennganh` (`Mã lớp`, `Tên lớp`, `Niên khóa`, `Sĩ số`, `Mã khoa`) VALUES
('DCCTCT63', 'Đại học - Công nghệ thông tin_K63', 'K63', 26, 7080),
('DCCTCT65B1', 'Đại học_Công nghệ thông tin B1_K65', 'K65', 30, 7080),
('DCCTCT66A1', 'Đại học_Công nghệ thông tin_K66A1', 'K66', 67, 7080),
('DCCTCT66B1', 'Đại học_Công nghệ thông tin_K66B1', 'K66', 62, 7080),
('DCCTCT66C2', 'Đại học_Công nghệ thông tin_K66C2', 'K66', 36, 7080),
('DCCTCT66D1', 'Đại học_Công nghệ thông tin_K66D1', 'K66', 64, 7080),
('DCCTCT66H1', 'Đại học_Công nghệ thông tin_K66H1', 'K66', 61, 7080),
('DCCTCT66I1', 'Đại học_Công nghệ thông tin_K66I1', 'K66', 68, 7080),
('DCCTCT66K1', 'Đại học_Công nghệ thông tin_K66K1', 'K66', 60, 7080),
('DCCTCT66L1', 'Đại học_Công nghệ thông tin_K66L1', 'K66', 62, 7080),
('DCCTCT66M1', 'Đại học_Công nghệ thông tin_K66M1', 'K66', 65, 7080),
('DCCTDH63A', 'Đại học - Công nghệ thông tin địa học A - K63', 'K63', 25, 7080),
('DCCTDH64', 'Đại học - Công ngệ thông tin địa học - K64', 'K64', 28, 7080),
('DCCTDH65A', 'Đại học - Công nghệ thông tin địa học A - K65', 'K65', 27, 7080),
('DCCTDH65B', 'Đại học - Công nghệ thông tin địa học B - K65', 'K65', 32, 7080),
('DCCTHT63B', 'Đại học - Hệ thống thông tin B - K63', 'K63', 40, 7080),
('DCCTHT65A', 'Đại học - Hệ thông thông tin A- K65', 'K65', 35, 7080),
('DCCTHT65B', 'Đại học - Hệ thông thông tin B- K65', 'K65', 30, 7080),
('DCCTKH64A', 'Đại học - Khoa học máy tính ứng dụng A- K64', 'K64', 39, 7080),
('DCCTKH64B', 'Đại học - Khoa học máy tính ứng dụng B- K64', 'K64', 36, 7080),
('DCCTKH65A', 'Đại học - Khoa học máy tính ứng dụng A- K65', 'K65', 38, 7080),
('DCCTKH65B', 'Đại học - Khoa học máy tính ứng dụng B- K65', 'K65', 34, 7080),
('DCCTKT62', 'Đại học - Tin học Kinh tế - K62', 'K62', 40, 7080),
('DCCTKT63A', 'Đại học - Tin học kinh tế A - K63', 'K63', 42, 7080),
('DCCTKT64A', 'Đại học - Tin học kinh tế A- K64', 'K64', 46, 7080),
('DCCTKT65A', 'Đại học - Tin học kinh tế A- K65', 'K65', 41, 7080),
('DCCTKT65B', 'Đại học - Tin học kinh tế B- K65', 'K65', 40, 7080),
('DCCTMM63C', 'Đại học - Mạng máy tính C - K63', 'K63', 36, 7080),
('DCCTMM65A', 'Đại học - Mạng máy tính A- K65', 'K65', 38, 7080),
('DCCTMM65B', 'Đại học - Mạng máy tính B- K65', 'K65', 37, 7080),
('DCCTPM62A', 'Đại học - Công nghệ phần mềm A - K62', 'K62', 42, 7080),
('DCCTPM63A', 'Đại học - Công nghệ phần mềm A - K63', 'K63', 45, 7080),
('DCCTPM64A', 'Đại học - Công nghệ phần mềm A- K64', 'K64', 48, 7080),
('DCCTPM65A', 'Đại học - Công nghệ phần mềm A- K65', 'K65', 48, 7080),
('DCCTPM65B', 'Đại học - Công nghệ phần mềm B- K65', 'K65', 50, 7080),
('DCCTPM65C', 'Đại học - Công nghệ phần mềm C- K65', 'K65', 52, 7080);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_lophocphan`
--

CREATE TABLE `tbl_lophocphan` (
  `Mã lớp` varchar(20) NOT NULL,
  `Mã học phần` int(11) NOT NULL,
  `Nhóm` int(11) NOT NULL,
  `Học kỳ` smallint(10) NOT NULL,
  `Năm học` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_lophocphan`
--

INSERT INTO `tbl_lophocphan` (`Mã lớp`, `Mã học phần`, `Nhóm`, `Học kỳ`, `Năm học`) VALUES
('DCCTCT66A1', 7080116, 1, 3, '2022-2023'),
('DCCTCT66B1', 7080116, 1, 3, '2022-2024'),
('DCCTCT66D1', 7080116, 1, 3, '2022-2025'),
('DCCTCT66H1', 7080116, 1, 3, '2022-2026'),
('DCCTCT66I1', 7080116, 1, 3, '2022-2027'),
('DCCTCT66K1', 7080116, 1, 3, '2022-2028'),
('DCCTCT66L1', 7080116, 1, 3, '2022-2029'),
('DCCTCT66M1', 7080116, 1, 3, '2022-2030'),
('DCCTDH63A', 7080116, 1, 3, '2022-2031'),
('DCCTDH64', 7080116, 1, 3, '2022-2032'),
('DCCTDH65A', 7080116, 1, 3, '2022-2033'),
('DCCTHT63B', 7080116, 1, 3, '2022-2034'),
('DCCTHT65A', 7080116, 1, 3, '2022-2035'),
('DCCTHT65B', 7080116, 1, 3, '2022-2036'),
('DCCTKH64A', 7080116, 1, 3, '2022-2037'),
('DCCTKH64B', 7080116, 1, 3, '2022-2038'),
('DCCTKH65A', 7080116, 1, 3, '2022-2039'),
('DCCTKH65B', 7080116, 1, 3, '2022-2040'),
('DCCTKT62', 7080116, 1, 3, '2022-2041'),
('DCCTKT63A', 7080116, 1, 3, '2022-2042'),
('DCCTKT64A', 7080116, 1, 3, '2022-2043'),
('DCCTKT65A', 7080116, 1, 3, '2022-2044'),
('DCCTKT65B', 7080116, 1, 3, '2022-2045'),
('DCCTMM63C', 7080116, 1, 3, '2022-2046'),
('DCCTMM65C', 7080116, 1, 3, '2022-2047'),
('DCCTMM65B', 7080116, 1, 3, '2022-2048'),
('DCCTPM62A', 7080116, 1, 3, '2022-2049'),
('DCCTPM63A', 7080116, 1, 3, '2022-2050'),
('DCCTPM64A', 7080116, 1, 3, '2022-2051'),
('DCCTPM65C', 7080116, 1, 3, '2022-2052');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_sinhvien`
--

CREATE TABLE `tbl_sinhvien` (
  `Mã sinh viên` int(20) NOT NULL,
  `Họ lót` varchar(20) NOT NULL,
  `Tên` varchar(10) NOT NULL,
  `Điện thoại` int(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Mã lớp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_sinhvien`
--

INSERT INTO `tbl_sinhvien` (`Mã sinh viên`, `Họ lót`, `Tên`, `Điện thoại`, `Email`, `Mã lớp`) VALUES
(1721050251, 'Hoàng Minh', 'Quang', 1636365887, '1721050251@student.humg.edu.vn', 'DCCTPM62A'),
(1721050409, 'Lại Hồng', 'Phong', 977015622, '1721050409@student.humg.edu.vn', 'DCCTKT62'),
(1821050160, 'Đinh Tiến', 'Long', 964654781, '1821050160@student.humg.edu.vn', 'DCCTKT63A'),
(1821050161, 'Chử Thành', 'Luân', 966828454, '1821050161@student.humg.edu.vn', 'DCCTPM63A'),
(1821050709, 'Hoàng Văn', 'Thịnh', 868779612, '1821050709@student.humg.edu.vn', 'DCCTMM63C'),
(1821050942, 'Cao Văn', 'Đức', 1638811658, '1821050942@student.humg.edu.vn', 'DCCTDH63A'),
(1821051099, 'Lâm Minh', 'Đức', 989966325, '1821051099@student.humg.edu.vn', 'DCCTHT63B'),
(1921050080, 'Trần Phú', 'Anh', 383173158, '1921050080@student.humg.edu.vn', 'DCCTKH64A'),
(1921050114, 'Nguyễn Duyên', 'Cường', 367976335, '1921050114@student.humg.edu.vn', 'DCCTKT64A'),
(1921050195, 'Nguyễn Tài', 'Đức', 333427252, '1921050195@student.humg.edu.vn', 'DCCTKT64A'),
(1921050206, 'Nguyễn Trường', 'Giang', 354117902, '1921050206@student.humg.edu.vn', 'DCCTKH64A'),
(1921050245, 'Nguyễn Văn', 'Hiếu', 366387512, '1921050245@student.humg.edu.vn', 'DCCTKH64A'),
(1921050346, 'Dương Xuân', 'Lâm', 973216132, '1921050346@student.humg.edu.vn', 'DCCTKH64B'),
(1921050563, 'Nguyễn Văn', 'Thắng', 344484165, '1921050563@student.humg.edu.vn', 'DCCTPM64A'),
(1921050700, 'Võ Tuấn', 'Vũ', 934428104, '1921050700@student.humg.edu.vn', 'DCCTPM64A'),
(1921050769, 'Nguyễn Xuân', 'Trường', 961340778, '1921050769@student.humg.edu.vn', 'DCCTDH64'),
(2021050113, 'Trần Hải', 'Châu', 865510928, '2021050113@student.humg.edu.vn', 'DCCTMM65B'),
(2021050151, 'Lê Minh', 'Duy', 965155701, '2021050151@student.humg.edu.vn', 'DCCTHT65B'),
(2021050153, 'Nguyễn Hải', 'Duy', 354959566, '2021050153@student.humg.edu.vn', 'DCCTHT65A'),
(2021050160, 'Hà Hoàng Đức', 'Dương', 386936806, '2021050160@student.humg.edu.vn', 'DCCTHT65A'),
(2021050181, 'Nguyễn Tiến', 'Đạt', 367936202, '2021050181@student.humg.edu.vn', 'DCCTMM65A'),
(2021050206, 'Ngô Văn', 'Đức', 355899098, '2021050206@student.humg.edu.vn', 'DCCTKT65A'),
(2021050222, 'Nguyễn Trường', 'Giang', 702020831, '2021050222@student.humg.edu.vn', 'DCCTKH65B'),
(2021050233, 'Bùi Phúc', 'Hải', 928478620, 'kichirango2742@gmail.com', 'DCCTKH65B'),
(2021050246, 'Vũ Trung', 'Hậu', 971786693, '2021050246@student.humg.edu.vn', 'DCCTKT65B'),
(2021050266, 'Phạm Công', 'Hiếu', 906243117, '2021050266@student.humg.edu.vn', 'DCCTMM65A'),
(2021050270, 'Vũ Đức', 'Hiếu', 337483956, '2021050270@student.humg.edu.vn', 'DCCTMM65B'),
(2021050312, 'Nguyễn Quang', 'Huy', 399570205, '2021050312@student.humg.edu.vn', 'DCCTKH65A'),
(2021050319, 'Ninh Quang', 'Huy', 972950629, '2021050319@student.humg.edu.vn', 'DCCTKH65B'),
(2021050326, 'Nguyễn Thị', 'Huyền', 342694913, '2021050326@student.humg.edu.vn', 'DCCTHT65B'),
(2021050343, 'Trần Văn', 'Khá', 362871914, '2021050343@student.humg.edu.vn', 'DCCTKH65B'),
(2021050344, 'Nguyễn Thiện', 'Khải', 914097128, '2021050344@student.humg.edu.vn', 'DCCTKH65A'),
(2021050352, 'Nguyễn Văn', 'Khánh', 943568008, '2021050352@student.humg.edu.vn', 'DCCTHT65A'),
(2021050362, 'Nguyễn Ngọc', 'Kiên', 972562320, '2021050362@student.humg.edu.vn', 'DCCTKH65A'),
(2021050363, 'Nguyễn Trung', 'Kiên', 382917017, '2021050363@student.humg.edu.vn', 'DCCTKT65B'),
(2021050367, 'Vũ Văn', 'Kiên', 963527160, '2021050367@student.humg.edu.vn', 'DCCTKH65B'),
(2021050372, 'Bùi Duy', 'Lâm', 356448298, '2021050372@student.humg.edu.vn', 'DCCTMM65A'),
(2021050373, 'Bùi Đức', 'Lâm', 354810133, '2021050373@student.humg.edu.vn', 'DCCTPM65C'),
(2021050377, 'Nguyễn Trọng', 'Lâm', 377382374, '2021050377@student.humg.edu.vn', 'DCCTPM65C'),
(2021050406, 'Nguyễn Đình', 'Long', 971063820, '2021050406@student.humg.edu.vn', 'DCCTMM65B'),
(2021050437, 'Nguyễn Đức', 'Mạnh', 384584911, '2021050437@student.humg.edu.vn', 'DCCTMM65A'),
(2021050482, 'Lê Huy', 'Nguyên', 587392619, '2021050482@student.humg.edu.vn', 'DCCTMM65B'),
(2021050483, 'Lưu Ngọc', 'Nguyên', 839016636, '2021050483@student.humg.edu.vn', 'DCCTHT65A'),
(2021050545, 'Nguyễn Minh', 'Quân', 963418764, '2021050545@student.humg.edu.vn', 'DCCTDH65A'),
(2021050548, 'Trần Ngọc', 'Quân', 924023211, '2021050548@student.humg.edu.vn', 'DCCTPM65C'),
(2021050633, 'Nguyễn Đức', 'Tiến', 969009287, '2021050633@student.humg.edu.vn', 'DCCTHT65A'),
(2021050852, 'Cao Thế', 'Anh', 702275926, '2021050852@student.humg.edu.vn', 'DCCTPM65C'),
(2021050855, 'Đinh Mạnh', 'Phong', 904857210, '2021050855@student.humg.edu.vn', 'DCCTKT65A'),
(2024011376, 'Trần Tiến', 'Thành', 975258802, '2024011376@student.humg.edu.vn', 'DCCTMM65A'),
(2121050140, 'Đặng Ngọc', 'Tường', 965019276, '2121050140@student.humg.edu.vn', 'DCCTCT66B1'),
(2121050151, 'Nguyễn Trường', 'Giang', 357161432, '2121050151@student.humg.edu.vn', 'DCCTCT66B1'),
(2121050152, 'Đinh Tiến', 'Hải', 862695123, '2121050152@student.humg.edu.vn', 'DCCTCT66B1'),
(2121050169, 'Nguyễn Tuấn', 'Hưng', 585827635, '2121050169@student.humg.edu.vn', 'DCCTCT66B1'),
(2121050190, 'Đỗ Đức', 'Tuệ', 353355472, '2121050190@student.humg.edu.vn', 'DCCTCT66B1'),
(2121050405, 'Vũ Hà Huy', 'Tuấn', 337693183, '2121050405@student.humg.edu.vn', 'DCCTCT66D1'),
(2121050765, 'Vũ Trọng', 'Nghĩa', 977753965, '2121050765@student.humg.edu.vn', 'DCCTCT66H1'),
(2121050769, 'Tô Việt', 'Anh', 835118142, '2121050769@student.humg.edu.vn', 'DCCTCT66H1'),
(2121051087, 'Hoàng Đình', 'Dương', 332290626, '2121051087@student.humg.edu.vn', 'DCCTCT66I1'),
(2121051137, 'Lý Ngọc', 'Bách', 865351633, '2121051137@student.humg.edu.vn', 'DCCTCT66K1'),
(2121051194, 'Nguyễn Đình', 'Đức', 967388003, '2121051194@student.humg.edu.vn', 'DCCTCT66K1'),
(2121051196, 'Hồ Duy', 'Anh', 339762136, '2121051196@student.humg.edu.vn', 'DCCTCT66K1'),
(2121051293, 'Nguyễn Tùng', 'Phương', 934331652, '2121051293@student.humg.edu.vn', 'DCCTCT66L1'),
(2121051410, 'Vũ Ngọc', 'Đạt', 868336018, '2121051410@student.humg.edu.vn', 'DCCTCT66M1'),
(2121051416, 'Nguyễn Mạnh', 'Dũng', 347215326, '2121051416@student.humg.edu.vn', 'DCCTCT66M1'),
(2121051437, 'Lê Đức', 'Ngọc', 374301581, '2121051437@student.humg.edu.vn', 'DCCTCT66M1'),
(2121051472, 'Vũ Tiến', 'Phúc', 902062909, '2121051472@student.humg.edu.vn', 'DCCTCT66A1');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_diemhocphan`
--
ALTER TABLE `tbl_diemhocphan`
  ADD PRIMARY KEY (`Mã sinh viên`),
  ADD KEY `ma_hoc_phan` (`Mã học phần`);

--
-- Chỉ mục cho bảng `tbl_hocphan`
--
ALTER TABLE `tbl_hocphan`
  ADD PRIMARY KEY (`Mã học phần`);

--
-- Chỉ mục cho bảng `tbl_khoa`
--
ALTER TABLE `tbl_khoa`
  ADD PRIMARY KEY (`Mã khoa`);

--
-- Chỉ mục cho bảng `tbl_lopchuyennganh`
--
ALTER TABLE `tbl_lopchuyennganh`
  ADD PRIMARY KEY (`Mã lớp`),
  ADD KEY `ma_khoa` (`Mã khoa`);

--
-- Chỉ mục cho bảng `tbl_sinhvien`
--
ALTER TABLE `tbl_sinhvien`
  ADD PRIMARY KEY (`Mã sinh viên`),
  ADD KEY `ma_lop` (`Mã lớp`);

--
-- Các ràng buộc cho các bảng đã đổhttps://cdn.fbsbx.com/v/t59.2708-21/364935098_155418887524922_363823616106553899_n.php/tra_cuu_diem.php?_nc_cat=108&ccb=1-7&_nc_sid=0cab14&_nc_ohc=7qyBa6gkBQEAX_mr4gn&_nc_ht=cdn.fbsbx.com&oh=03_AdTjI8FVnxwCw-lJ9CF1MM_hNuH3y2EQWgcYum1IQLp9GQ&oe=64CAACCF&dl=1
--

--
-- Các ràng buộc cho bảng `tbl_diemhocphan`
--
ALTER TABLE `tbl_diemhocphan`
  ADD CONSTRAINT `ma_hoc_phan` FOREIGN KEY (`Mã học phần`) REFERENCES `tbl_hocphan` (`Mã học phần`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_lopchuyennganh`
--
ALTER TABLE `tbl_lopchuyennganh`
  ADD CONSTRAINT `ma_khoa` FOREIGN KEY (`Mã khoa`) REFERENCES `tbl_khoa` (`Mã khoa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `tbl_sinhvien`
--
ALTER TABLE `tbl_sinhvien`
  ADD CONSTRAINT `msv` FOREIGN KEY (`Mã sinh viên`) REFERENCES `tbl_diemhocphan` (`Mã sinh viên`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
