-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2018 at 12:45 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emergency`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'อุบัติเหตุ'),
(2, 'เจ็บป่วยทั่วไป');

-- --------------------------------------------------------

--
-- Table structure for table `department_tel`
--

CREATE TABLE `department_tel` (
  `id` int(11) NOT NULL,
  `Department_name` varchar(150) NOT NULL,
  `Department_tel` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department_tel`
--

INSERT INTO `department_tel` (`id`, `Department_name`, `Department_tel`) VALUES
(1, 'พิทักกาญ', '0345846215'),
(2, 'พิทักกาญ2', '0345512213'),
(3, 'สิทรสมุทร', '0386659412'),
(4, 'ตำรวจ', '191'),
(5, 'โรงพายาลพหล', '1669'),
(6, 'กู้ภัยบ่อพลอย', '1112'),
(7, 'กู้ภัยท่าม่วง', '1150'),
(8, 'กู้ภัยไทรโยก', '1120'),
(9, 'โรงพยาบาลธนกาน', '1780'),
(10, 'โรงพยาบาลบ่อพลอย', '7777'),
(11, 'โรงพยาบาลไทรโยก', '0344512154'),
(12, 'โรงพยาบาลพนมทวน', '1663'),
(13, 'กู้ภัยพนมทวน', '1336');

-- --------------------------------------------------------

--
-- Table structure for table `emergency`
--

CREATE TABLE `emergency` (
  `emergency_id` int(11) NOT NULL,
  `emergency_name` varchar(150) NOT NULL,
  `emergency_category` int(11) NOT NULL,
  `emergency_detail` varchar(500) NOT NULL,
  `emergency_date` datetime NOT NULL,
  `emergency_location` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `emergency`
--

INSERT INTO `emergency` (`emergency_id`, `emergency_name`, `emergency_category`, `emergency_detail`, `emergency_date`, `emergency_location`, `user_id`, `status`) VALUES
(22, 'ง่วงนอนมาก', 0, 'ยังไม่ได้นอน', '2018-05-28 05:42:26', 'บ้าน', 888888888, 0),
(21, 'โปรเจค บาดเจ็บสาหัด', 3, 'ยังไม่ได้นอนจนจะ 10 โมงเช้า', '2018-05-28 05:40:32', 'ห้องนอน', 983023001, 1),
(20, 'test', 1, '123456', '2018-05-28 02:30:28', '111222', 983023001, 2);

-- --------------------------------------------------------

--
-- Table structure for table `emergency_type`
--

CREATE TABLE `emergency_type` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `status_emergency`
--

CREATE TABLE `status_emergency` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `status_emergency`
--

INSERT INTO `status_emergency` (`status_id`, `status_name`) VALUES
(0, 'รอการช่วยเหลือ'),
(1, 'ได้รับการช่วยแล้ว'),
(2, 'ได้รับการช่วยเหลือเเล้ว/ลงบันทึกเรียบร้อย');

-- --------------------------------------------------------

--
-- Table structure for table `task_history`
--

CREATE TABLE `task_history` (
  `acknowledge_id` int(11) NOT NULL,
  `emergency_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `detail` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task_history`
--

INSERT INTO `task_history` (`acknowledge_id`, `emergency_id`, `user_id`, `date`, `detail`) VALUES
(9, 20, 23, '2018-05-28 02:39:59', 'อาการสาหัด ส่ง รพ. เเล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `title`
--

CREATE TABLE `title` (
  `title_id` int(11) NOT NULL,
  `title_name` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `title`
--

INSERT INTO `title` (`title_id`, `title_name`) VALUES
(1, 'นาย'),
(2, 'นาง'),
(3, 'นางสาว');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL,
  `title_name` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `number_phone` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `title_name`, `firstname`, `lastname`, `number_phone`, `status`) VALUES
(35, 'a@a.a', '123456', 0, 'dddd', 'ffff', '', 2),
(36, '555@555.555', '123456', 0, 'aaa', 'ffff', '', 2),
(20, 'kunthida@gmail.com', '123456', 3, 'kunthida', 'naiyanid', '0983023001', 2),
(23, 'admin@a.a', '123456', 1, 'teerapon', 'sangkhaphaiwan', '0983023001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`status_id`, `status_name`) VALUES
(1, 'ผู้ดูแลระบบ'),
(2, 'ผู้ใช้งาน'),
(3, 'เจ้าหน้าที่กู้ภัย');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `department_tel`
--
ALTER TABLE `department_tel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency`
--
ALTER TABLE `emergency`
  ADD PRIMARY KEY (`emergency_id`);

--
-- Indexes for table `emergency_type`
--
ALTER TABLE `emergency_type`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `status_emergency`
--
ALTER TABLE `status_emergency`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `task_history`
--
ALTER TABLE `task_history`
  ADD PRIMARY KEY (`acknowledge_id`);

--
-- Indexes for table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department_tel`
--
ALTER TABLE `department_tel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `emergency`
--
ALTER TABLE `emergency`
  MODIFY `emergency_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `emergency_type`
--
ALTER TABLE `emergency_type`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_history`
--
ALTER TABLE `task_history`
  MODIFY `acknowledge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `title`
--
ALTER TABLE `title`
  MODIFY `title_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
