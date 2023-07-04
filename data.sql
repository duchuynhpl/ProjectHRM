-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 08, 2023 lúc 09:39 AM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `test`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `business`
--

CREATE TABLE `business` (
  `id_business` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `addressbn` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `departuredate` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `returndate` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_faculty` int(11) NOT NULL,
  `statustrip` varchar(50) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Đang đổ dữ liệu cho bảng `business`
--

INSERT INTO `business` (`id_business`, `content`, `addressbn`, `departuredate`, `returndate`, `id_user`, `id_faculty`, `statustrip`) VALUES
(1, 'Đi công tác', 'Cần Thơ', '29-04-2023', '29-05-2023', 1, 1, 'Đang đi'),
(2, 'Đi học thạc sĩ', 'Hà Nôi', '1-6-2023', '1-9-2024', 1, 1, 'Chuẩn bị đi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `discipline`
--

CREATE TABLE `discipline` (
  `id_discipline` int(11) NOT NULL,
  `code_discipline` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `decision_number` int(11) NOT NULL,
  `decision_day` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `name_discipline` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `id_user` int(11) NOT NULL,
  `type_discipline` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `content_discipline` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `statuskl` varchar(50) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Đang đổ dữ liệu cho bảng `discipline`
--

INSERT INTO `discipline` (`id_discipline`, `code_discipline`, `decision_number`, `decision_day`, `name_discipline`, `id_user`, `type_discipline`, `content_discipline`, `statuskl`) VALUES
(1, 'KL643534', 12, '2023-05-03', 'Cảnh cáo vi phạm', 1, 'Cảnh cáo', 'Cảnh cáo vi phạm', 'Xem xét');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `faculty`
--

CREATE TABLE `faculty` (
  `idfaculty` int(11) NOT NULL,
  `namefaculty` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `faculty`
--

INSERT INTO `faculty` (`idfaculty`, `namefaculty`) VALUES
(1, 'Công nghệ thông tin'),
(2, 'Công nghệ phần mềm'),
(3, 'Hệ thống thông tin'),
(4, 'Học máy tính'),
(5, 'Máy tính và truyền thông'),
(6, 'Truyền thông đa phương tiện');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reward`
--

CREATE TABLE `reward` (
  `id_reward` int(11) NOT NULL,
  `code_reward` varchar(11) COLLATE utf8mb4_bin NOT NULL,
  `decision_number` varchar(50) COLLATE utf8mb4_bin NOT NULL,
  `decision_day` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `name_reward` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `id_user` int(11) NOT NULL,
  `type_reward` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `content_reward` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `statuskt` varchar(50) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Đang đổ dữ liệu cho bảng `reward`
--

INSERT INTO `reward` (`id_reward`, `code_reward`, `decision_number`, `decision_day`, `name_reward`, `id_user`, `type_reward`, `content_reward`, `statuskt`) VALUES
(1, 'KT012541', '104', '30-04-2023', 'Cá nhân xuất sắc trường', 1, 'Khen thưởng đột xuất', 'Đạt thành tích tốt trong trường', 'Xem xét'),
(3, 'KT76462 ', '45', '2023-05-11', 'Thi đua đạt hạng 2', 18, 'Khen thưởng theo thành tích', 'Đã có thành tích xuất sắc trong thi đua giảng dạy', 'Xem xét');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `salary`
--

CREATE TABLE `salary` (
  `idsalary` int(11) NOT NULL,
  `code_salary` varchar(20) NOT NULL,
  `payday` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `workday` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `monthsalary` varchar(255) NOT NULL,
  `allowance` varchar(255) NOT NULL,
  `salaryadvance` varchar(255) NOT NULL,
  `realsalary` varchar(255) NOT NULL,
  `timepayday` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `salary`
--

INSERT INTO `salary` (`idsalary`, `code_salary`, `payday`, `workday`, `monthsalary`, `allowance`, `salaryadvance`, `realsalary`, `timepayday`, `id_user`) VALUES
(1, 'L561405', '500000', '28', '1000000', '200000', '0', '1000000', '2023-04-15', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hoten` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `degree` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `level` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `speciality` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cccd` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `datecccd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `placebirth` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_faculty` int(11) NOT NULL,
  `typeemployee` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `national` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `nation` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `religion` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idcv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `employee_id`, `avatar`, `hoten`, `degree`, `level`, `speciality`, `cccd`, `datecccd`, `sex`, `birthday`, `placebirth`, `id_faculty`, `typeemployee`, `national`, `nation`, `religion`, `username`, `password`, `phone`, `email`, `address`, `status`, `idcv`) VALUES
(1, 'CTUCB476251', 'cict.jpg', 'Hà Đức Huỳnh', 'Cử nhân', 'Giáo sư', 'Công nghệ thông tin', '1245876321', '2023-04-16', 'Nam', '2023-04-14', 'Phước Long - Bạc Liêu', 1, '', 'Việt Nam', 'Kinh', 'Không', 'duchuynh', '123', '0912123', 'duchuynh@gmail.com', 'Cái Răng - Cần Thơ', 'Đang làm việc', 1),
(18, 'CTUCB476252', 'dat.jpg', 'Nguyễn Phát Đạt', 'Kỹ Sư', 'Giáo Sư', 'Công Nghệ Thông Tin', '369852147', '2020-11-05', 'Nam', '1999-07-13', 'Cần Thơ', 1, 'Nhân Viên Chính Thức', 'Việt Nam', 'Không', 'Kinh', 'dat123', '123', '09352148563', 'dat@gmail.com', 'Cần Thơ', 'Đang làm việc', 1),
(25, 'CTUCB732329', 'dang.jpg', 'Nguyễn Hải Đăng', 'Thạc Sĩ', 'Thạc Sĩ', 'Công Nghệ Thông Tin', '369852147', '2023-05-19', 'Nam', '2000-03-09', 'Cà Mau', 2, 'Nhân Viên Chính Thức', 'Việt Nam', 'Không', 'Kinh', NULL, NULL, '0936852147', 'dangnguyen@gmail.com', 'Cần Thơ', 'Đang làm việc', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `work`
--

CREATE TABLE `work` (
  `idcv` int(11) NOT NULL,
  `tencv` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `work`
--

INSERT INTO `work` (`idcv`, `tencv`) VALUES
(1, 'Hiệu Trưởng'),
(2, 'Phó Hiệu Trưởng'),
(3, 'Trưởng Khoa'),
(4, 'Phó Trưởng Khoa'),
(5, 'nhân viên');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `business`
--
ALTER TABLE `business`
  ADD PRIMARY KEY (`id_business`),
  ADD KEY `ID_USERR` (`id_user`),
  ADD KEY `ID_FACULTYY` (`id_faculty`);

--
-- Chỉ mục cho bảng `discipline`
--
ALTER TABLE `discipline`
  ADD PRIMARY KEY (`id_discipline`),
  ADD KEY `ID_USERKL` (`id_user`);

--
-- Chỉ mục cho bảng `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`idfaculty`);

--
-- Chỉ mục cho bảng `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`id_reward`),
  ADD KEY `REWARD_ID` (`id_user`);

--
-- Chỉ mục cho bảng `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`idsalary`),
  ADD KEY `ID_USER` (`id_user`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Work ID_CV` (`idcv`),
  ADD KEY `ID_FACULTY` (`id_faculty`);

--
-- Chỉ mục cho bảng `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`idcv`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `business`
--
ALTER TABLE `business`
  MODIFY `id_business` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `discipline`
--
ALTER TABLE `discipline`
  MODIFY `id_discipline` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `reward`
--
ALTER TABLE `reward`
  MODIFY `id_reward` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `salary`
--
ALTER TABLE `salary`
  MODIFY `idsalary` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `business`
--
ALTER TABLE `business`
  ADD CONSTRAINT `ID_FACULTYY` FOREIGN KEY (`id_faculty`) REFERENCES `faculty` (`idfaculty`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ID_USERR` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `discipline`
--
ALTER TABLE `discipline`
  ADD CONSTRAINT `ID_USERKL` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `reward`
--
ALTER TABLE `reward`
  ADD CONSTRAINT `REWARD_ID` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `salary`
--
ALTER TABLE `salary`
  ADD CONSTRAINT `ID_USER` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Các ràng buộc cho bảng `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `ID_FACULTY` FOREIGN KEY (`id_faculty`) REFERENCES `faculty` (`idfaculty`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `Work ID_CV` FOREIGN KEY (`idcv`) REFERENCES `work` (`idcv`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
