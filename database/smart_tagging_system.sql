-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2018 at 06:07 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_tagging_system`
--
CREATE DATABASE IF NOT EXISTS `smart_tagging_system` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `smart_tagging_system`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(15) NOT NULL,
  `admin_username` varchar(15) NOT NULL,
  `admin_email` varchar(30) NOT NULL,
  `admin_phone` int(10) NOT NULL,
  `admin_password` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_email`, `admin_phone`, `admin_password`) VALUES
('111111', 'admin1', 'admin1@gmail.com', 137663521, '$2y$10$SjecZ1Uyml2lX5XiP6OsA.xb25vYPEVPIeMFIgTc4Zf6zFvM9iO0u'),
('111112', 'admin2', 'admin2@gmail.com', 123456789, '$2y$10$UFWj//x6YnSsgoWRHcEET.bh4/SbBgFVYRiR3b9ZsS75gK.xNh2Pm');

-- --------------------------------------------------------

--
-- Table structure for table `locker`
--

CREATE TABLE `locker` (
  `locker_id` varchar(15) NOT NULL,
  `locker_status` varchar(15) NOT NULL,
  `locker_price` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locker`
--

INSERT INTO `locker` (`locker_id`, `locker_status`, `locker_price`) VALUES
('A100100', 'Booked', 1),
('A100101', 'Available', 1),
('A100102', 'Available', 1),
('A100103', 'Available', 1),
('A100104', 'Damage', 1),
('A100105', 'Booked', 1),
('A100106', 'Booked', 1),
('A100107', 'Booked', 1);

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `record_id` int(11) NOT NULL,
  `record_start` varchar(10) DEFAULT NULL,
  `record_end` varchar(10) DEFAULT NULL,
  `record_price` int(11) DEFAULT NULL,
  `record_item` varchar(255) DEFAULT NULL,
  `record_status` varchar(10) NOT NULL DEFAULT 'pending',
  `record_sub` varchar(10) NOT NULL DEFAULT 'expired',
  `record_approved_by` varchar(15) NOT NULL,
  `student_id` varchar(15) NOT NULL,
  `locker_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`record_id`, `record_start`, `record_end`, `record_price`, `record_item`, `record_status`, `record_sub`, `record_approved_by`, `student_id`, `locker_id`) VALUES
(25, '2018-05-04', '2018-05-25', 21, 'img/uploads/5aec7e0603a902.02044713.png', 'approved', 'active', 'admin2', '01dns14f1030', 'A100100');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` varchar(15) NOT NULL,
  `student_username` varchar(15) NOT NULL,
  `student_pwd` char(70) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_department` varchar(5) NOT NULL,
  `student_email` varchar(30) NOT NULL,
  `student_phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `student_username`, `student_pwd`, `student_name`, `student_department`, `student_email`, `student_phone`) VALUES
('01dns14f1030', 'naruto', '$2y$10$kT/hsvf1m6Lqmy6ObD6Jbut5FmQJjMD3JzHAodUxu0XMrKrxq4hR6', 'uzumaki naruto', 'FTMK', 'naruto@gmail.com', '012345678'),
('01dns14f1031', 'sasuke', '$2y$10$z0/6ndKoAFwvWEFckt27iO1efR5ODdKlR25hNxs8gUYhb1/uw4bd.', 'uchiha sasuke', 'FKE', 'sasuke@gmail.com', '1234567890'),
('01dns14f1032', 'sakura', '$2y$10$KoL0UeDjrc2ROuMFBDSzS.Q71sGsU0BqhO7QtBcptGiVeokYg9Ete', 'haruno sakura', 'FKEKK', 'sakura@gmail.com', '1234567890'),
('01dns14f1033', 'boruto', '$2y$10$AUu5QPhvJqFh1/GgIk3i6uH0DAHIKCnu2ABQTmcnlIQef5.IMTO46', 'uzumaki boruto', 'FTP', 'boruto@gmail.com', '1234567890'),
('01dns14f1034', 'sarada', '$2y$10$nSYtYnVDO.PQmUT6Io8JxeO0zBlPg7vIEfB3VXsrBpeRTnlsq0OgC', 'uchiha sarada', 'FPTT', 'sarada@gmail.com', '1234567890'),
('01dns14f1035', 'mitsuki', '$2y$10$El85Y8pqZxRTYH/TqguWYO82gDqMuaj95RTmfnSZL46CzTYUa6wuq', 'mitsuki', 'FKM', 'mitsuki@gmail.com', '1234567890'),
('01dns14f1036', 'konohamaru', '$2y$10$SaUlgmuSHYnD3netNByOSOub.ZdltRvcXV5ZyqKiWR5uppSzVTbVO', 'sarutobi konohamaru', 'FKP', 'konohamaru@gmail.com', '1234567890'),
('01dns14f1037', 'kakashi', '$2y$10$YmOseJISVK0kkd.3EYQOTOtDl37XGRBtFkV.UBnpXLig5WyCQW2Xm', 'hatake kakashi', 'FKEKK', 'kakashi@gmail.com', '1234567890'),
('01dns14f1038', 'itachi', '$2y$10$ZCR7XTHyioHvDjbVLsZr9eakYtlIBCMbIO9CjmkD6paAAyMz/0H3u', 'uchiha itachi', 'FKE', 'itachi@gmail.com', '1234567890'),
('01dns14f1039', 'lee', '$2y$10$/FY0epCTNn7FXmaaSfQXxOu6afcl855lfITGjCzHM7n7suRqUhxui', 'rock lee', 'FKE', 'lee@gmail.com', '1234567890'),
('01dns14f1040', 'hinata', '$2y$10$0EselfSALGPsPCgVfElrhuxBKm/CkPp1Oi7Wd6nD2zyYWq9slsrQi', 'hyuga hinata', 'FTMK', 'hinata@gmail.com', '137663521');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `locker`
--
ALTER TABLE `locker`
  ADD PRIMARY KEY (`locker_id`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD PRIMARY KEY (`record_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `record`
--
ALTER TABLE `record`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
