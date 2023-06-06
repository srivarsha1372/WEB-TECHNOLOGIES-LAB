-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 24, 2023 at 07:03 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `timetablegen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `aid` int(3) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dob` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`aid`, `name`, `username`, `password`, `dob`) VALUES
(1, 'Bose Babu', 'bosebabu', '12345', '2002-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `coordinator`
--

CREATE TABLE `coordinator` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordinator`
--

INSERT INTO `coordinator` (`username`, `password`) VALUES
('admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `fid` int(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `dob` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`fid`, `name`, `username`, `password`, `dob`) VALUES
(1, 'Bose Babu', 'bosebabu', '12345', '2002-11-28');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `year` varchar(10) NOT NULL,
  `section` varchar(20) NOT NULL,
  `day` varchar(50) NOT NULL,
  `hour` varchar(10) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `faculty` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`year`, `section`, `day`, `hour`, `subject`, `faculty`) VALUES
('3', 'C', 'Tuesday', '1', 'ML', 'Rohini'),
('3', 'C', 'Tuesday', '2', 'OOSE', 'Preeti'),
('3', 'C', 'Tuesday', '3', 'CNS', 'Usha Bala'),
('3', 'C', 'Tuesday', '4', 'NNDL', 'Anusha'),
('3', 'C', 'Tuesday', '5', 'OOSE LAB', 'Preeti'),
('3', 'C', 'Tuesday', '6', 'OOSE LAB', 'Preeti'),
('3', 'C', 'Tuesday', '7', 'OOSE LAB', 'Preeti'),
('3', 'C', 'Tuesday', '8', 'OOSE LAB', 'Preeti'),
('3', 'C', 'Monday', '1', 'WT LAB', 'Bose Babu'),
('3', 'C', 'Monday', '2', 'WT LAB', 'Bose Babu'),
('3', 'C', 'Monday', '3', 'WT LAB', 'Bose Babu'),
('3', 'C', 'Monday', '4', 'WT LAB', 'Bose Babu'),
('3', 'C', 'Monday', '5', 'NNDL', 'Anusha'),
('3', 'C', 'Monday', '6', 'WT', 'Bose Babu'),
('3', 'C', 'Monday', '7', 'WT', 'Bose Babu'),
('3', 'C', 'Monday', '8', 'ML', 'Rohini'),
('3', 'C', 'Wednesday', '1', 'CNS', 'Usha Bala'),
('3', 'C', 'Wednesday', '2', 'OOSE', 'Preeti'),
('3', 'C', 'Wednesday', '3', 'ITRE', 'Prakash'),
('3', 'C', 'Wednesday', '4', 'Library', '*'),
('3', 'C', 'Wednesday', '5', 'VA', 'Yashodhara'),
('3', 'C', 'Wednesday', '6', 'VA', 'Yashodhara'),
('3', 'C', 'Wednesday', '7', 'WT', 'Bose Babu'),
('3', 'C', 'Wednesday', '8', 'Sports', '*'),
('3', 'C', 'Thursday', '1', 'ITRE', 'Prakash'),
('3', 'C', 'Thursday', '2', 'QA', 'Kamesh'),
('3', 'C', 'Thursday', '3', 'QA', 'Kamesh'),
('3', 'C', 'Thursday', '4', 'WT', 'Bose Babu'),
('3', 'C', 'Thursday', '5', 'OOSE', 'Preeti'),
('3', 'C', 'Thursday', '6', 'OOSE', 'Preeti'),
('3', 'C', 'Thursday', '7', 'NNDL', 'Anusha'),
('3', 'C', 'Thursday', '8', 'NNDL', 'Anusha'),
('3', 'C', 'Friday', '1', 'NNDL', 'Anusha'),
('3', 'C', 'Friday', '2', 'ITRE', 'Prakash'),
('3', 'C', 'Friday', '3', 'ITRE', 'Prakash'),
('3', 'C', 'Friday', '4', 'OOSE', 'Preeti'),
('3', 'C', 'Friday', '5', 'ML', 'Rohini'),
('3', 'C', 'Friday', '6', 'ML', 'Rohini'),
('3', 'C', 'Friday', '7', 'CNS', 'Usha Bala'),
('3', 'C', 'Friday', '8', 'Counselling', '*'),
('3', 'C', 'Saturday', '1', 'OOSE', 'Preeti'),
('3', 'C', 'Saturday', '2', 'CNS', 'Usha Bala'),
('3', 'C', 'Saturday', '3', 'CNS', 'Usha Bala'),
('3', 'C', 'Saturday', '4', 'ML', 'Rohini'),
('3', 'C', 'Saturday', '5', '-', '-'),
('3', 'C', 'Saturday', '6', '-', '-'),
('3', 'C', 'Saturday', '7', '-', '-'),
('3', 'C', 'Saturday', '8', '-', '-');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`fid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `aid` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `fid` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
