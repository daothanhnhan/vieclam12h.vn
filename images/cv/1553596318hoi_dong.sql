-- phpMyAdmin SQL Dump
-- version 4.4.15
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2018 at 09:35 AM
-- Server version: 5.5.31
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tkwgbvn_phuclocbds`
--

-- --------------------------------------------------------

--
-- Table structure for table `hoi_dong`
--

CREATE TABLE IF NOT EXISTS `hoi_dong` (
  `id` int(11) NOT NULL,
  `name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hoi_dong`
--

INSERT INTO `hoi_dong` (`id`, `name`, `position`, `sex`, `image`) VALUES
(1, 'Nguyễn Thanh Hùng', 'Giám đốc', 'Ông', 'updated 2-01.png'),
(2, 'Nguyễn Khắc Long ', 'Phó Giám Đốc', 'Ông', 'updated 2-01.png'),
(3, 'Trần Quang Khánh ', 'Phó Giám Đốc ', 'Ông', 'updated 2-01.png'),
(4, 'Nguyễn Văn A', 'Trưởng nhóm kinh doanh ', 'Ông', 'updated image-01.png'),
(5, 'Nguyễn Văn A', 'Trưởng nhóm kinh doanh ', 'Ông', 'updated image-01.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hoi_dong`
--
ALTER TABLE `hoi_dong`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hoi_dong`
--
ALTER TABLE `hoi_dong`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
