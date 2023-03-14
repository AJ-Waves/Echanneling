-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 09, 2017 at 06:02 AM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `echannelingdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hodpitalid` varchar(30) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `speciality` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(300) NOT NULL,
  `profile` varchar(1000) NOT NULL,
  PRIMARY KEY (`nic`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `doctorspecialty`
--

DROP TABLE IF EXISTS `doctorspecialty`;
CREATE TABLE IF NOT EXISTS `doctorspecialty` (
  `no` int(11) NOT NULL AUTO_INCREMENT,
  `specialty` varchar(200) NOT NULL,
  `description` varchar(2000) NOT NULL,
  PRIMARY KEY (`no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

DROP TABLE IF EXISTS `hospital`;
CREATE TABLE IF NOT EXISTS `hospital` (
  `hospitalID` varchar(30) NOT NULL,
  `Type` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `Phone1` varchar(10) NOT NULL,
  `Phone2` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`hospitalID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hospitalID`, `Type`, `name`, `address`, `Phone1`, `Phone2`, `email`) VALUES
('123456', 'Hospital', 'ABC', 'Kandy', '0775272725', '0811111111', 'aj@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `labfacility`
--

DROP TABLE IF EXISTS `labfacility`;
CREATE TABLE IF NOT EXISTS `labfacility` (
  `regNo` varchar(30) NOT NULL,
  `fbc` varchar(30) DEFAULT NULL,
  `ufr` varchar(30) DEFAULT NULL,
  `liverProfile` varchar(30) DEFAULT NULL,
  `esr` varchar(30) DEFAULT NULL,
  `ecg` varchar(30) DEFAULT NULL,
  `tsh` varchar(30) DEFAULT NULL,
  `chestXray` varchar(30) DEFAULT NULL,
  `lipidProfile` varchar(30) DEFAULT NULL,
  `vdrl` varchar(30) DEFAULT NULL,
  `sgpt` varchar(30) DEFAULT NULL,
  `creatinine` varchar(30) DEFAULT NULL,
  `serumCholesterol` varchar(30) DEFAULT NULL,
  `hemodialysis` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`regNo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labfacility`
--

INSERT INTO `labfacility` (`regNo`, `fbc`, `ufr`, `liverProfile`, `esr`, `ecg`, `tsh`, `chestXray`, `lipidProfile`, `vdrl`, `sgpt`, `creatinine`, `serumCholesterol`, `hemodialysis`) VALUES
('123456', 'yes', 'yes', '', 'yes', '', '', '', '', '', '', '', '', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `login_levels`
--

DROP TABLE IF EXISTS `login_levels`;
CREATE TABLE IF NOT EXISTS `login_levels` (
  `user_name` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_level` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_levels`
--

INSERT INTO `login_levels` (`user_name`, `password`, `user_level`) VALUES
('admin', 'admin1234', 3),
('saman', '123456', 3),
('acj@gmail.com', '12345678', 4),
('abs@yahoo.com', '1234567', 4),
('buwa005@gmail.com', 'b1234567', 4);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `salutation` varchar(20) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `initials` varchar(100) NOT NULL,
  `emails` varchar(100) NOT NULL,
  `birthday` varchar(100) NOT NULL,
  `nic` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `land` varchar(100) NOT NULL,
  `fee` int(11) NOT NULL,
  PRIMARY KEY (`emails`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`salutation`, `fname`, `lname`, `initials`, `emails`, `birthday`, `nic`, `country`, `address`, `mobile`, `land`, `fee`) VALUES
('Mr', 'buwaneka', 'seneviratne', '', 'buwa005@gmail.com', '1984-08-09', '840963510V', 'Sri Lanka', '47/51 kandy rd ampitiya', '0712807170', '0822435536', 500);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `paymentID` varchar(10) NOT NULL,
  `patientID` varchar(10) DEFAULT NULL,
  `staffID` varchar(10) DEFAULT NULL,
  `hospitalID` varchar(10) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`paymentID`),
  KEY `fk_ppatientID` (`patientID`),
  KEY `fk_pstaffID` (`staffID`),
  KEY `fk_phospitalID` (`hospitalID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `email` varchar(30) DEFAULT NULL,
  `username` varchar(15) NOT NULL,
  `empname` varchar(200) NOT NULL,
  `empaddress` varchar(1000) NOT NULL,
  `phone` varchar(10) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_levels`
--

DROP TABLE IF EXISTS `user_levels`;
CREATE TABLE IF NOT EXISTS `user_levels` (
  `level_id` int(11) NOT NULL AUTO_INCREMENT,
  `Level_name` varchar(200) NOT NULL,
  `description` varchar(1000) NOT NULL,
  PRIMARY KEY (`level_id`),
  UNIQUE KEY `Level_name` (`Level_name`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_levels`
--

INSERT INTO `user_levels` (`level_id`, `Level_name`, `description`) VALUES
(1, 'Site Admin', 'Person who handle website'),
(2, 'Center Admin', 'Person who assign users for channeling center'),
(3, 'center user', 'Person who mange doctor and channeling data'),
(4, 'Member', 'Front end user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
