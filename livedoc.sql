-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3366
-- Generation Time: May 26, 2024 at 12:23 PM
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
-- Database: `livedoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id_appointment` int(11) NOT NULL COMMENT 'Cuộc hẹn ',
  `date` date NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày hẹn',
  `hour` time NOT NULL,
  `describe_problem` varchar(225) DEFAULT NULL COMMENT 'mô tả vấn đề bệnh',
  `id_patient` int(11) NOT NULL,
  `id_staff` int(11) NOT NULL,
  `check` int(11) NOT NULL DEFAULT 0 COMMENT 'Trạng thái đã khám hay chưa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id_appointment`, `date`, `hour`, `describe_problem`, `id_patient`, `id_staff`, `check`) VALUES
(82, '2024-05-23', '09:00:00', 'Đau họng', 1, 4, 1),
(83, '2024-05-27', '11:00:00', 'Sốt, đau đầu nhẹ', 1, 4, 0),
(85, '2024-05-29', '14:30:00', 'Nghẹt, tắc mũi, ù tai', 3, 4, 0),
(86, '2024-05-29', '15:00:00', 'Đau nhức tai', 5, 4, 0),
(87, '2024-05-30', '14:00:00', 'Nhức đầu, sốt', 7, 4, 0),
(88, '2024-05-30', '09:00:00', 'Nghẹt mũi, đau họng', 9, 4, 0),
(89, '2024-06-06', '14:00:00', 'Kiểm tra sức khỏe', 1, 4, 0),
(96, '2024-06-12', '08:30:00', 'Kiểm tra sức khỏe', 1, 12, 0),
(97, '2024-06-13', '10:00:00', 'Khám sức khỏe định kỳ', 9, 12, 0),
(98, '2024-05-30', '09:00:00', 'Kiểm tra định kỳ', 7, 24, 0);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id_department` int(11) NOT NULL COMMENT 'id bộ phận',
  `department_name` varchar(50) NOT NULL COMMENT 'Tên bộ phận'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id_department`, `department_name`) VALUES
(1, 'Thần kinh'),
(2, 'Mắt'),
(3, 'Hô hấp'),
(4, 'Tim mạch'),
(5, 'Xương khớp'),
(6, 'Tai mũi họng'),
(7, 'Nhân viên bệnh viện');

-- --------------------------------------------------------

--
-- Table structure for table `medical_bill`
--

CREATE TABLE `medical_bill` (
  `id_record` int(11) NOT NULL COMMENT 'id hồ sơ bệnh án',
  `date_create` datetime NOT NULL COMMENT 'thời gian tạo hồ sơ',
  `advice` varchar(225) DEFAULT NULL COMMENT 'Lời dặn của BS',
  `diagnose` varchar(225) DEFAULT NULL COMMENT 'Chuẩn đoán bênh',
  `id_appointment` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_bill`
--

INSERT INTO `medical_bill` (`id_record`, `date_create`, `advice`, `diagnose`, `id_appointment`) VALUES
(66, '2024-05-25 16:34:36', 'Uống thuốc đầy đủ ', 'Viên họng', 82);

-- --------------------------------------------------------

--
-- Table structure for table `medical_bill_detail`
--

CREATE TABLE `medical_bill_detail` (
  `id_record` int(11) NOT NULL,
  `id_medicine` int(11) NOT NULL,
  `quantity` int(11) NOT NULL COMMENT 'số lượng thuốc',
  `instructions` varchar(225) DEFAULT NULL COMMENT 'Hướng dẫn sử dụng thuốc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medical_bill_detail`
--

INSERT INTO `medical_bill_detail` (`id_record`, `id_medicine`, `quantity`, `instructions`) VALUES
(66, 3, 2, '3 lần/ngày, 2 viên/lần'),
(66, 12, 5, '1 ngày 1 ống');

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id_medicine` int(11) NOT NULL COMMENT 'id thuốc',
  `name_medicine` varchar(100) NOT NULL COMMENT 'tên thuốc',
  `date_manufacture` date NOT NULL COMMENT 'Ngày sản xuất',
  `expiry` date NOT NULL COMMENT 'Hạn sử dụng',
  `unit` varchar(20) NOT NULL COMMENT 'Đơn vị thuốc',
  `medicine_price` int(11) NOT NULL COMMENT 'giá mỗi đơn vị',
  `id_type_medicine` int(11) NOT NULL COMMENT 'id loại thuốc',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT 'Trạng thái tồn tại của thuốc',
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id_medicine`, `name_medicine`, `date_manufacture`, `expiry`, `unit`, `medicine_price`, `id_type_medicine`, `status`, `quantity`) VALUES
(1, 'Amoxicillin', '2024-02-01', '2026-02-01', 'Vỉ', 30000, 2, 1, 1000),
(2, 'Cephalexin', '2024-02-01', '2026-02-01', 'Hộp', 120000, 2, 1, 1000),
(3, 'Paracetamol', '2024-02-01', '2026-02-01', 'Vỉ', 40000, 1, 1, 1000),
(6, 'Clopheniramin', '2024-05-10', '2026-10-05', 'Hộp', 35000, 3, 1, 1000),
(7, 'Cetirizin', '2024-05-17', '2025-10-28', 'Vỉ', 20000, 3, 1, 2000),
(8, 'Hidrasec', '2024-05-11', '2026-10-25', 'Hộp', 210000, 4, 1, 1000),
(9, 'Sorbitol', '2024-05-01', '2025-02-25', 'Gói', 2100, 4, 1, 5000),
(10, 'Amlodipin', '2024-05-09', '2026-09-25', 'Viên', 3000, 5, 1, 10000),
(11, 'Nifedipin ', '2024-05-09', '2025-06-04', 'Hộp', 60000, 5, 1, 10000),
(12, 'Calcium', '2024-05-03', '2025-05-25', 'Ống', 6100, 6, 1, 20000),
(13, 'Ferrovit', '2024-05-01', '2026-07-25', 'Hộp', 105000, 6, 1, 1000),
(14, ' Efticol', '2024-05-09', '2027-02-10', 'Lọ', 5000, 7, 1, 1000),
(15, 'Sanlein', '2024-05-02', '2025-10-25', 'Lọ', 61000, 7, 1, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id_message` int(11) NOT NULL COMMENT 'id tin nhắn',
  `id_patient` int(11) DEFAULT NULL,
  `id_staff` int(11) DEFAULT NULL,
  `id_sender` int(11) NOT NULL,
  `content` text NOT NULL,
  `send_date` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id_patient` int(11) NOT NULL COMMENT 'id bệnh nhân',
  `full_name` varchar(50) NOT NULL COMMENT 'Họ tên bệnh nhân',
  `email` varchar(50) NOT NULL COMMENT 'Email bệnh nhân',
  `password` varchar(225) NOT NULL COMMENT 'Mật khẩu bệnh nhân',
  `phone` varchar(10) NOT NULL COMMENT 'Số điện thoại bệnh nhân',
  `address` varchar(225) NOT NULL COMMENT 'Địa chỉ bệnh nhân',
  `birthday` date DEFAULT NULL COMMENT 'Ngày sinh bệnh nhân',
  `gender` varchar(20) NOT NULL COMMENT 'Giới tính bệnh nhân',
  `image` varchar(225) DEFAULT 'user_account.png' COMMENT 'Ảnh bệnh nhân',
  `blood_group` varchar(10) DEFAULT NULL COMMENT 'Nhóm máu',
  `weight` int(11) DEFAULT NULL COMMENT 'cân nặng',
  `height` int(11) DEFAULT NULL COMMENT 'chiều cao',
  `BMI` float DEFAULT NULL COMMENT 'Chỉ số BMI',
  `id_role` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT 'Trạng thái tồn tại của tài khoản'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id_patient`, `full_name`, `email`, `password`, `phone`, `address`, `birthday`, `gender`, `image`, `blood_group`, `weight`, `height`, `BMI`, `id_role`, `status`) VALUES
(1, 'Nguyễn Hồ Minh Huân', 'm.huan190102@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0362449211', 'TPHCM', '2022-01-19', 'Nam', 'user_account.png', NULL, NULL, NULL, NULL, 5, 1),
(3, 'Nguyen Tien Thanh', 'ntt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0362448211', 'TPHCM', '2002-01-01', 'Nam', 'user_account.png', NULL, NULL, NULL, NULL, 5, 1),
(5, 'Luong Anh Duc', 'lad@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0362459211', 'TPHCM', '2002-01-01', 'Nam', 'user_account.png', NULL, NULL, NULL, NULL, 5, 1),
(7, 'Hồ Trần Bảo Trân', 'baotran062000@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0362559211', 'TPHCM', '2000-06-04', 'Nữ', 'user_account.png', NULL, NULL, NULL, NULL, 5, 1),
(9, 'Hoàng Nhật Linh', 'linhhoang0602@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0379204219', 'TPHCM', '2002-06-10', 'Nữ', 'user_account.png', NULL, NULL, NULL, NULL, 5, 1);

--
-- Triggers `patient`
--
DELIMITER $$
CREATE TRIGGER `patient_before_insert` BEFORE INSERT ON `patient` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    SET next_id = (SELECT MAX(id_patient) FROM patient);
    IF next_id IS NULL THEN
        SET next_id = 1;
    ELSE
        SET next_id = next_id + 2;
    END IF;
    SET NEW.id_patient = next_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `postcontents`
--

CREATE TABLE `postcontents` (
  `id_content` int(11) NOT NULL COMMENT ' Mã cho mỗi phần nội dung của bài viết',
  `content` text DEFAULT NULL COMMENT 'Nội dung của của bài viết',
  `id_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `title` varchar(225) NOT NULL COMMENT 'tiêu đề bài viết',
  `created_at` date NOT NULL COMMENT 'ngày tạo bài viết',
  `id_staff` int(11) NOT NULL COMMENT 'Người viết bài'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `name_role` varchar(50) NOT NULL COMMENT 'Tên quyền'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `name_role`) VALUES
(1, 'Quản trị viên'),
(2, 'Nhân viên tiếp nhận'),
(3, 'Nhân viên quầy thuốc'),
(4, 'Bác sĩ'),
(5, 'Bệnh nhân');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id_staff` int(11) NOT NULL COMMENT 'id nhân viên',
  `full_name` varchar(50) NOT NULL COMMENT 'Họ tên nhân viên',
  `email` varchar(50) NOT NULL COMMENT 'Email nhân viên',
  `password` varchar(225) NOT NULL COMMENT 'Mật khẩu nhân viên',
  `phone` varchar(10) NOT NULL COMMENT 'Số điện thoại nhân viên',
  `birthday` date NOT NULL COMMENT 'Ngày sinh nhân viên',
  `gender` varchar(20) NOT NULL COMMENT 'Giới tính nhân viên',
  `image` varchar(225) DEFAULT 'user_account.png' COMMENT 'Ảnh nhân viên',
  `id_department` int(11) DEFAULT NULL COMMENT 'Chuyên khoa',
  `certificate` varchar(225) DEFAULT NULL COMMENT 'Bằng cấp',
  `experience` varchar(225) DEFAULT NULL COMMENT 'Kinh nghiệm làm việc',
  `description` varchar(225) DEFAULT NULL COMMENT 'Mô tả',
  `id_role` int(11) NOT NULL COMMENT 'Quyền nhân viên',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT 'Trạng thái tồn tại của tài khoản'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id_staff`, `full_name`, `email`, `password`, `phone`, `birthday`, `gender`, `image`, `id_department`, `certificate`, `experience`, `description`, `id_role`, `status`) VALUES
(4, 'Nguyễn Tất Cường', 'ntc@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456789', '1984-12-19', 'nam', 'nguyentatcuong.jpg', 6, 'Tốt nghiệp đại học Y Dược thành phố Hồ Chí Minh (2019)\r\n', '2019-2022: Bác sĩ nội trú bệnh viện Chợ Rẫy, bệnh viện Đại học Y Dược thành phố Hồ Chí Minh. 2020-2022: Thạc sĩ, Bác sĩ chuyên khoa I Tai Mũi Họng đại học Y Dược thành phố Hồ Chí Minh.', 'Phẫu thuật nội soi mũi xoang.\r\nPhẫu thuật họng-thanh quản.', 4, 1),
(8, 'Đinh Tiến Trung', 'dtt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456788', '1974-01-30', 'Nam', 'dinhtientrung.jpg', 6, 'Tốt nghiệp Thạc sĩ Tai Mũi Họng - Đại học Y Dược Thành phố Hồ Chí Minh (2013). Tốt nghiệp Bác sĩ đa khoa - Đại học Y Dược Thành phố Hồ Chí Minh (2009).', 'Chứng chỉ Phẫu thuật Nội soi Tai và Xương thái dương - Cấy điện cực ốc tai - Bệnh viện Đa khoa Changi (CGH), Hội nghị Tai Mũi Họng và Đầu Mặt Cổ Asean, Singapore ( 25 – 29/08/2019 )\r\nChứng chỉ Phẫu thuật Đầu Mặt Cổ – Tổ chức ', 'Bệnh lý Mũi xoang\r\nPhẫu thuật nội soi Tai\r\nPhẫu thuật Họng, Thanh quản và vùng Cổ', 4, 1),
(10, 'Nguyễn Thị Thu Thủy ', 'nttt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456787', '1970-12-12', 'Nữ', 'nguyenthithuthuy.jpg', 4, 'Tốt nghiệp Bác sĩ Đại học Y Dược (1985).', 'Từ 1986 - 2014: Bác sĩ Tim mạch tại Bệnh viện Đa khoa Nguyễn Trãi\r\nTừ năm 2015 đến nay: Bác sĩ điều trị PKĐK Quốc tế Sài Gòn', 'Bác sĩ CKI Nội Tổng quát (2002)', 4, 1),
(12, 'Lê Thị Diệu Hồng', 'ltdh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456786', '1969-01-01', 'Nữ', 'lethidieuhong.jpg', 4, 'Tốt nghiệp Đại học Y Dược TP. Hồ Chí Minh.', 'Phó Trưởng Khoa Tim mạch Bệnh viện An Bình', 'Bác sĩ Chuyên khoa cấp I Chuyên ngành Nội Tổng Quát – Đại học Y Dược Tp.HCM.\r\nChứng chỉ Siêu âm Tim và Bệnh lý Tim mạch – Viện Tim Tp.HCM.\r\n31 năm kinh nghiệ làm việc trong lĩnh vực Nội khoa Tim mạch.', 4, 1),
(14, 'Huỳnh Tấn Phong', 'htp@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456785', '1970-12-01', 'Nam', 'htp.jpg', 2, 'Đại Học Y Dược TP.HCM', 'Phó Giám đốc	Bệnh viện Mắt Sài Gòn (chi nhánh Hà Nội)\r\nTrưởng khoa Mắt Bệnh viện Quốc tế Hoàn Mỹ Đồng Nai', 'Bằng tâm huyết đem lại đôi mắt sáng cho người bệnh, bác sĩ đã tiếp cận những kiến thức hiện đại và đã đạt được các chứng chỉ trong việc khám và điều trị trong lĩnh vực nhãn khoa. Bác sĩ Phong là một chuyên gia trong các lĩnh ', 4, 1),
(16, 'Nguyễn Thị Phương Hà', 'ntph@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456784', '1979-01-01', 'Nam', 'ntph.jpg', 2, 'Đại Học Y Khoa Phạm Ngọc Thạch', 'Bác sĩ chuyên khoa Mắt Bệnh viện quận 1\r\nBác sĩ chuyên khoa Mắt	Phòng khám Quốc Tế Hoàn Mỹ Thảo Điền\r\nBác sĩ chuyên khoa Mắt	Trung tâm Mắt Kỹ thuật cao Bệnh viện 30-4', 'Trong hơn 15 năm trong ngành Nhãn khoa, Bác sĩ Phương Hà đã ghi dấu bước chân của mình với một loạt các thành tựu đáng kể. Bác sĩ Nguyễn Thị Phương Hà luôn mong muốn cung cấp dịch vụ chăm sóc mắt tốt nhất cho tất cả bệnh nhân', 4, 1),
(18, 'Trần Hoàng Ngọc Anh', 'thna@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456783', '1968-12-12', 'Nam', 'thna.png', 1, 'Đại Học Y Khoa Phạm Ngọc Thạch', 'Nội trú tại khoa Ngoại thần kinh - Bệnh viện Chợ Rẫy.\r\nBS phó khoa ngoại thần kinh - Bệnh viện Nhân dân Gia Định, Phó chủ nhiệm bộ môn Ngoại thần kinh - Đại học Y Dược TP. HCM.', 'TS. BS. Trần Hoàng Ngọc Anh nguyên là Giảng viên, phó bộ môn Phẫu thuật Thần kinh, Đại học Y dược TP. HCM, Phó trưởng khoa Ngoại thần kinh, Bệnh viện Nhân Dân Gia Định.\r\nBS Ngọc Anh xuất thân từ BS nội trú ĐHYD TP. HCM sau đó', 4, 1),
(20, 'Nguyễn Thị Minh Phương', 'ntmp@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456782', '1967-12-12', 'Nữ', 'ntmp.png', 1, 'Đại Học Y Khoa Phạm Ngọc Thạch', 'Khoa Thần kinh - Bệnh viện Hữu Nghị\r\nKhoa Nội – BV Đa khoa Quốc tế Vinmec', 'hS. BS Nguyễn Thị Minh Phương đã có trên 20 năm kinh nghiệm trong lĩnh vực chẩn đoán và điều trị các bệnh lý Nội thần kinh. Tốt nghiệp loại giỏi Viện hàn lâm Y học Sofia- Bungaria, BS Phương luôn cập nhật các kiến thức mới và', 4, 1),
(22, 'Nguyễn Văn Thọ', 'nvt@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456781', '1967-12-01', 'Nam', 'nvt.png', 3, 'Đại Học Y Khoa Phạm Ngọc Thạch', 'ơn 33 năm kinh nghiệm trong lĩnh vực Nội Phổi \r\nNguyên Trưởng Khoa, Khoa Lao Nữ, Bệnh Viện Phạm Ngọc Thạch \r\nNguyên Trưởng khoa, Khoa Bệnh phổi tắc nghẽn TP. HCM\r\nGiảng viên Bộ môn Nội Tổng quát, Đại học Y Khoa Phạm Ngọc Thạc', 'Hiện tại, bác sĩ Nguyễn Văn Thọ có lịch khám tại Bệnh viện FV 6 Nguyễn Lương Bằng, Nam Sài Gòn (Phú Mỹ Hưng),Quận 7.\r\nBệnh viện FV cũng là một cơ sở y tế khám chữa bệnh nói chung và khám Phổi - Hô hấp đáng tin cậy với trang t', 4, 1),
(24, 'Đỗ Thị Tường Oanh', 'dtto@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456780', '1970-11-11', 'Nữ', 'user_account.png', 3, 'Đại Học Y Khoa Phạm Ngọc Thạch', 'Nguyên Phó Trưởng khoa Hô hấp - Bệnh viện Nhân dân Gia Định\r\nTốt nghiệp Bác sĩ Đa khoa, BS.CKI, BS.CKII Nội Hô hấp - Đại học Y Dược TP.HCM \r\nChứng chỉ Soi phế quản - Bệnh viện Chợ Rẫy\r\nChứng chỉ Quản lý hen và COPD trong cộng', 'Hơn 33 năm kinh nghiệm trong lĩnh vực Nội Phổi \r\nNguyên Trưởng Khoa, Khoa Lao Nữ, Bệnh Viện Phạm Ngọc Thạch \r\nNguyên Trưởng khoa, Khoa Bệnh phổi tắc nghẽn TP. HCM\r\nGiảng viên Bộ môn Nội Tổng quát, Đại học Y Khoa Phạm Ngọc Thạ', 4, 1),
(26, 'Nguyễn Thị Ngọc Lan', 'ntnl@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456779', '1970-12-12', 'Nữ', 'ntnl.png', 5, 'Đại Học Y Khoa Phạm Ngọc Thạch', 'Bác sĩ nội trú - Bệnh viện La Conception và tham gia khoá đào tạo chuyên khoa sâu về Thấp khớp học (La formation spécialisée approfondie de Rhumatologie) - Trường Đại học Marseille, Cộng hoà Pháp', 'PGS. TS. BS Nguyễn Thị Ngọc Lan đã có hơn 30 năm kinh nghiệm trong lĩnh vực Nội cơ xương khớp. Bà nguyên là Trưởng khoa Cơ xương khớp - BV Bạch Mai Hà Nội. Bà hiện là giảng viên cao cấp bộ môn Nội tổng hợp - Đại', 4, 1),
(28, 'Nguyễn Thị Thu Hà', 'ntth@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456778', '1970-12-11', 'Nữ', 'ntth.png', 5, 'Đại Học Y Khoa Phạm Ngọc Thạch', 'Trưởng khoa Khám bệnh & Nội khoa - Bệnh viện Đa khoa Quốc tế Vinmec Central Park\r\n', 'ThS. BSCK II Nguyễn Thị Thu Hà trên 30 năm kinh nghiệm trong lĩnh vực Nội khoa. Bà là thành viên của Hội Thận học châu Á - Thái Bình Dương, Hội Tiết niệu và Thận học Việt Nam.\r\nThS. BSCKII Nguyễn Thị Thu Hà hiện là Trưở', 4, 1),
(30, 'Nguyễn Hồ Minh Huân', 'minh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2132', '0000-00-00', '', 'user_account.png', NULL, NULL, NULL, NULL, 1, 1),
(32, 'Nguyễn Tiến Thành', 'ntthanh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0462449211', '2002-01-01', 'Nam', 'user_account.png', 7, 'Đại học Công nghiệp TPHCM', 'Chưa có', 'Làm việc tại TPHCM', 2, 1);

--
-- Triggers `staff`
--
DELIMITER $$
CREATE TRIGGER `staff_before_insert` BEFORE INSERT ON `staff` FOR EACH ROW BEGIN
    DECLARE next_id INT;
    SET next_id = (SELECT MAX(id_staff) FROM staff);
    IF next_id IS NULL THEN
        SET next_id = 2; -- Start with the first even number
    ELSE
        SET next_id = next_id + 2;
    END IF;
    SET NEW.id_staff = next_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `type_medicine`
--

CREATE TABLE `type_medicine` (
  `id_type_medicine` int(11) NOT NULL COMMENT 'id loại thuốc',
  `name_type_medicine` varchar(50) NOT NULL COMMENT 'Tên loại thuốc'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_medicine`
--

INSERT INTO `type_medicine` (`id_type_medicine`, `name_type_medicine`) VALUES
(1, 'Giảm đau và hạ sốt'),
(2, 'Kháng sinh'),
(3, 'Chống dị ứng'),
(4, 'Tiêu hóa'),
(5, 'Huyết áp tim mạch'),
(6, 'Vitamin – khoáng chất'),
(7, 'Thuốc mắt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id_appointment`),
  ADD KEY `id_patient` (`id_patient`),
  ADD KEY `id_staff` (`id_staff`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id_department`);

--
-- Indexes for table `medical_bill`
--
ALTER TABLE `medical_bill`
  ADD PRIMARY KEY (`id_record`),
  ADD KEY `id_appointment` (`id_appointment`);

--
-- Indexes for table `medical_bill_detail`
--
ALTER TABLE `medical_bill_detail`
  ADD KEY `id_medicine` (`id_medicine`),
  ADD KEY `id_record` (`id_record`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id_medicine`),
  ADD KEY `medicine_ibfk_2` (`id_type_medicine`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_message`),
  ADD KEY `message_ibfk_2` (`id_staff`),
  ADD KEY `message_ibfk_4` (`id_patient`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id_patient`),
  ADD KEY `patient_ibfk_1` (`id_role`);

--
-- Indexes for table `postcontents`
--
ALTER TABLE `postcontents`
  ADD PRIMARY KEY (`id_content`),
  ADD KEY `postcontents_ibfk_1` (`id_post`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_staff` (`id_staff`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`),
  ADD KEY `staff_ibfk_1` (`id_role`),
  ADD KEY `id_department` (`id_department`);

--
-- Indexes for table `type_medicine`
--
ALTER TABLE `type_medicine`
  ADD PRIMARY KEY (`id_type_medicine`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id_appointment` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Cuộc hẹn ', AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id_department` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id bộ phận', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `medical_bill`
--
ALTER TABLE `medical_bill`
  MODIFY `id_record` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id hồ sơ bệnh án', AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id_medicine` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id thuốc', AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id_message` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id tin nhắn', AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id_patient` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id bệnh nhân', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id nhân viên', AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `type_medicine`
--
ALTER TABLE `type_medicine`
  MODIFY `id_type_medicine` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id loại thuốc', AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`id_staff`) REFERENCES `staff` (`id_staff`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id_patient`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medical_bill`
--
ALTER TABLE `medical_bill`
  ADD CONSTRAINT `medical_bill_ibfk_1` FOREIGN KEY (`id_appointment`) REFERENCES `appointment` (`id_appointment`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medical_bill_detail`
--
ALTER TABLE `medical_bill_detail`
  ADD CONSTRAINT `medical_bill_detail_ibfk_1` FOREIGN KEY (`id_medicine`) REFERENCES `medicine` (`id_medicine`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `medical_bill_detail_ibfk_2` FOREIGN KEY (`id_record`) REFERENCES `medical_bill` (`id_record`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `medicine`
--
ALTER TABLE `medicine`
  ADD CONSTRAINT `medicine_ibfk_1` FOREIGN KEY (`id_type_medicine`) REFERENCES `type_medicine` (`id_type_medicine`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`id_patient`) REFERENCES `patient` (`id_patient`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_3` FOREIGN KEY (`id_staff`) REFERENCES `staff` (`id_staff`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `postcontents`
--
ALTER TABLE `postcontents`
  ADD CONSTRAINT `postcontents_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id_post`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_staff`) REFERENCES `staff` (`id_staff`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`id_department`) REFERENCES `department` (`id_department`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
