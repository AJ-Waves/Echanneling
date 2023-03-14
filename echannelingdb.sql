-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 24, 2018 at 06:28 PM
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
-- Table structure for table `center_admin`
--

DROP TABLE IF EXISTS `center_admin`;
CREATE TABLE IF NOT EXISTS `center_admin` (
  `center_reg_no` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_address` varchar(250) NOT NULL,
  `admin_phone` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `center_admin`
--

INSERT INTO `center_admin` (`center_reg_no`, `user_name`, `admin_name`, `admin_email`, `admin_address`, `admin_phone`) VALUES
('12345', 'hadmin1', 'Sanath', 'hemas_admin@hemas.com', 'Colombo 12', '0775272759');

-- --------------------------------------------------------

--
-- Table structure for table `center_charges`
--

DROP TABLE IF EXISTS `center_charges`;
CREATE TABLE IF NOT EXISTS `center_charges` (
  `center_reg_no` varchar(30) NOT NULL,
  `center_fee` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `center_charges`
--

INSERT INTO `center_charges` (`center_reg_no`, `center_fee`) VALUES
('12345', 500);

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `hospitalid` varchar(30) NOT NULL,
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

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`hospitalid`, `fname`, `lname`, `nic`, `speciality`, `email`, `phone`, `address`, `profile`) VALUES
('12345', 'Dasun', 'Balasuriya', '912620509v', 'Clinical Hypnotist', 'dasun@gmail.com', '771234569', 'Kurunagala', 'Test 3');

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
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorspecialty`
--

INSERT INTO `doctorspecialty` (`no`, `specialty`, `description`) VALUES
(1, 'Allergy And Immunology', 'A Physician specializing in the aspects of immunity including allergy and phenomenon connected with the body defense mechanism.'),
(2, 'Allergy Specialist', 'A Physician specializing in the aspects of immunity including allergy and phenomenon connected with the body defense mechanism.'),
(3, 'Lactation (Breast Feeding) Consultant', 'A pediatrician or a medical person who specializes in guiding mother for successful breast feeding.'),
(4, 'Cardiac Electrophysiologist', 'A Cardiologist who specializes on the electrical process of the heart.'),
(5, 'Cardiaothoracic Surgeon', 'A thoracic surgeon who specializes in the surgical intervention for the treatment of heart disorders.'),
(6, 'Cardiologist', 'A physician specializing in the structure, functions, and diseases of the heart and blood vessels.'),
(7, 'Chest Physician', 'A physician specializing in the diseases of the respiratory system (breathing system) including the lungs.'),
(8, 'Chest Specialist', 'A physician specializing in the diseases of the respiratory system (breathing system) including the lungs.'),
(9, 'Child Psychiatrist', 'A psychiatrist who specializes in the study and treatment of mental disorders and behavioral abnormalities in children.'),
(10, 'Clinical Hypnotist', 'Medical practitioner or non - medical person who specializes in artificially, inducing sleep in an person, to make the mind most receptive to suggestions & memories of past events. A form of psychotherapy.'),
(11, 'Consultant Dental Surgeon And Prosthodontist', 'A Dental surgeon who has specialized in the provision of dentures bridges and implant retained prostheses.'),
(12, 'Consultant Judicial Medicine', 'A physician who specializes with the scientific investigation of the causes of injury and death specially in criminal activity.'),
(13, 'Counseling Psychologist', 'A medical or non-medical practitioner who specializes in the methods for the treatment of psychological problems and mental disorders.'),
(14, 'Counselling', 'A Medical or non-medical person who specializes in using methods of approaching psychological difficulties in adjustment that aims to help the client work out his own problems.'),
(15, 'Dental Surgeon', 'A general practitioner of dentistry.'),
(16, 'Dermatologist', 'A Medical Specialist concerned with the diagnosis & treatment of skin disorders including hairs.'),
(17, 'Dermatologist and Hair Clinic', 'A Medical Specialist concerned with the diagnosis & treatment of skin disorders including hairs.'),
(18, 'Dietician', 'A Medical Practitioner or a non-medical person qualified in art & science of dietetics. the study of food & nutritional properties. The design & advice on special diets for ill patients and people with risk of developing various diseases.'),
(19, 'Dietician and Nutrition', 'A Medical Practitioner or a non-medical person qualified in art & science of dietetics. the study of food & nutritional properties. The design & advice on special diets for ill patients and people with risk of developing various diseases.'),
(20, 'Embryologist', 'A Medical practitioner who specialized about the growth and development of the embryo & fetus from fertilization of the ovum until birth.'),
(21, 'Test case one', 'This is test data updated passe 2');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_appointments`
--

DROP TABLE IF EXISTS `doctor_appointments`;
CREATE TABLE IF NOT EXISTS `doctor_appointments` (
  `center_reg_no` varchar(30) NOT NULL,
  `doctor_nic` varchar(12) NOT NULL,
  `date` date NOT NULL,
  `start_time` time(6) NOT NULL,
  `end_time` time(6) NOT NULL,
  `no_of_appointments` int(11) NOT NULL DEFAULT '0',
  `booked_appointments` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_appointments`
--

INSERT INTO `doctor_appointments` (`center_reg_no`, `doctor_nic`, `date`, `start_time`, `end_time`, `no_of_appointments`, `booked_appointments`) VALUES
('12345', '912620509v', '2018-05-23', '10:00:00.000000', '13:00:00.000000', 15, 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_charges`
--

DROP TABLE IF EXISTS `doctor_charges`;
CREATE TABLE IF NOT EXISTS `doctor_charges` (
  `center_reg_no` varchar(30) NOT NULL,
  `doctor_nic` varchar(12) NOT NULL,
  `doctor_fee` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor_charges`
--

INSERT INTO `doctor_charges` (`center_reg_no`, `doctor_nic`, `doctor_fee`) VALUES
('12345', '912620509v', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `handling_payment`
--

DROP TABLE IF EXISTS `handling_payment`;
CREATE TABLE IF NOT EXISTS `handling_payment` (
  `pay_id` int(11) NOT NULL AUTO_INCREMENT,
  `gust_patient_pay` float NOT NULL DEFAULT '0',
  `member_bonus` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`pay_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `handling_payment`
--

INSERT INTO `handling_payment` (`pay_id`, `gust_patient_pay`, `member_bonus`) VALUES
(1, 100, 20);

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
('12345b', 'Hospital', 'Hemas', 'Kandy', '0812345678', '0812345679', 'hemaskandy@hemas.com'),
('12345', 'Hospital', 'Hemas', 'Malabe', '0775272757', '0112345679', 'hemas@gmail.com'),
('12345a', 'Hospital', 'Hemas', 'Kaduwela', '0112345678', '0112345679', 'henaskaduwela@hemas.com'),
('123a', 'Channeling', 'Arogya', 'Kegalle', '0352345678', '0352666555', 'arogya@gmail.com'),
('123b', 'Channeling', 'Arogya', 'Kadugannawa', '0812345678', '0812666555', 'arogyab@gmail.com'),
('123456', 'Hospital', 'Asiri', 'Kegalle', '0352345678', '0352212345', 'asiri@gmail.com');

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
('12345', 'yes', 'yes', 'yes', '', 'yes', 'yes', '', '', '', '', '', '', 'yes'),
('12345a', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', '', 'yes', 'yes', 'yes', '', 'yes'),
('12345b', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes'),
('123a', 'yes', 'yes', '', '', '', '', '', '', '', '', '', '', ''),
('123b', 'yes', 'yes', '', '', '', '', '', '', '', '', '', '', ''),
('123456', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `login_levels`
--

DROP TABLE IF EXISTS `login_levels`;
CREATE TABLE IF NOT EXISTS `login_levels` (
  `user_name` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_level` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_levels`
--

INSERT INTO `login_levels` (`user_name`, `password`, `user_level`) VALUES
('admin', '$2y$10$VTwlG1Ik7QehdOkf/mbFWuBbrI5/WXz.41Hfrjk/arFuXsMuWTtZ.', '1'),
('saman', '123456', '3'),
('acj@gmail.com', '12345678', '4'),
('abs@yahoo.com', '1234567', '4'),
('buwa005@gmail.com', 'b1234567', '4'),
('abheetha.acj@gmail.com', '123456', '4'),
('kamal@gmail.com', '$2y$10$6rD9f7CEReoknWTOPyyDAOc01eVX16GRGbIPj5vt.9O4xA.uv4c.2', '4'),
('saman@gmail.com', '123456', '4'),
('Sunil@gmail.com', '123456', '4'),
('hadmin1', '$2y$10$uPPhKlCz6AJwRdbRroFocOQx70UDJJNbK3/pTc6sVVMjyCLLb0H5a', '2'),
('samantha@gmail.com', '$2y$10$2HW4ud4ZkFMTmg82YCJW5e2BVN/6ipXNpU/5zJd.WND.6Y/ZWOhdO', '4'),
('chanaka@gmail.com', '$2y$10$UB4NHWEOTaYxf3t8Crx4jOItwONsPZ/u.SNA9UZwjDdp0.XxEm9I2', '4'),
('huser1', '$2y$10$8Lv50TLH7/Q2uejbKRP8WOAND1kYQ3nAP/sS7w5QhJNghrZShX1eq', '3'),
('admin2', '$2y$10$Ic/4MXaSUFZFpRLATxhNNu.BjsKJig/vbcMTkRi9AktqHxVSbZDxC', '3');

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
  `land` varchar(10) DEFAULT NULL,
  `fee` int(11) NOT NULL,
  PRIMARY KEY (`emails`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`salutation`, `fname`, `lname`, `initials`, `emails`, `birthday`, `nic`, `country`, `address`, `mobile`, `land`, `fee`) VALUES
('Mr', 'Chamara', 'Jayamanna', 'A A', 'abheetha.acj@gmail.com', '1989-02-17', '890480616V', 'Sri Lanka', 'Malabe, Kaduwela', '0775272757', '', 500),
('Mr', 'Kamal', 'Rana', 'S S', 'kamal@gmail.com', '2011-01-14', '890480616V', 'Sri Lanka', 'Colombo', '0712345678', '', 500),
('Mr', 'Saman', 'Amal', 'D D', 'saman@gmail.com', '2018-05-04', '890480616V', 'Sri Lanka', 'Kandy', '0775272757', '0112345679', 500),
('Mr', 'Sunil', 'Dasun', 'A S', 'Sunil@gmail.com', '2018-05-19', '800480616V', 'Sri Lanka', 'Kollupitiya', '0775272757', '0112345679', 500),
('Mrs', 'Samantha', 'Liyanage', 'S A', 'samantha@gmail.com', '2008-02-20', '890480616V', 'Sri Lanka', 'Kegalle', '0712345678', '0352212345', 500),
('Mr', 'chanaka', 'gajanayaka', 'GM', 'chanaka@gmail.com', '1991-05-09', '912620509v', 'Sri Lanka', 'no 39\r\nMount lavinia', '0777666555', '0112666555', 500);

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
-- Table structure for table `site_admin`
--

DROP TABLE IF EXISTS `site_admin`;
CREATE TABLE IF NOT EXISTS `site_admin` (
  `user_name` varchar(100) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_address` varchar(250) NOT NULL,
  `admin_phone` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `site_admin`
--

INSERT INTO `site_admin` (`user_name`, `admin_name`, `admin_email`, `admin_address`, `admin_phone`) VALUES
('admin', 'Chamara', 'abheetha.acj@gmail.com', 'Kegalle, Rambukkana', '0775272757');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `center_reg_no` varchar(100) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_address` varchar(250) NOT NULL,
  `user_phone` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`center_reg_no`, `user_name`, `emp_name`, `user_email`, `user_address`, `user_phone`) VALUES
('12345', 'huser1', 'Rumesh', 'rumesh@hemas.com', 'Kandy', '0712345678'),
('12345', 'admin2', 'Chanaka', 'chanaka@gmail.com', 'Colombo 12', '0712345678');

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
