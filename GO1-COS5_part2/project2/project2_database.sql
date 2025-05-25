-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2025 at 11:26 AM
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
-- Database: `project2_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `JobRefNumber` varchar(10) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `StreetAddress` varchar(100) NOT NULL,
  `Suburb` varchar(50) NOT NULL,
  `State` varchar(3) NOT NULL,
  `Postcode` varchar(4) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Skill1` varchar(50) DEFAULT NULL,
  `Skill2` varchar(50) DEFAULT NULL,
  `Skill3` varchar(50) DEFAULT NULL,
  `Skill4` varchar(50) DEFAULT NULL,
  `Skill5` varchar(50) DEFAULT NULL,
  `OtherSkills` text DEFAULT NULL,
  `Status` enum('New','Current','Final') DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `JobRefNumber`, `FirstName`, `LastName`, `StreetAddress`, `Suburb`, `State`, `Postcode`, `Email`, `Phone`, `Skill1`, `Skill2`, `Skill3`, `Skill4`, `Skill5`, `OtherSkills`, `Status`) VALUES
(4, 'GO5', 'Jose', 'Ty', '87 Wembley Ave, Strathtulloh', 'Cobblebank', 'Vic', '3338', 'josehardyty@gmail.com', '0411046154', 'JavaScript', 'HTML', 'CSS', NULL, NULL, 'iuhoihs', 'New'),
(5, 'GO1', 'Jose', 'Ty', '87 Wembley Ave, Strathtulloh', 'Cobblebank', 'Vic', '3338', 'josehardyty@gmail.com', '0411046154', 'JavaScript', 'HTML', 'CSS', NULL, NULL, '', 'New');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
