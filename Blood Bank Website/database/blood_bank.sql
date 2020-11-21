-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2020 at 03:44 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blood_bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `hospital`
--

CREATE TABLE `hospital` (
  `hid` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `hos_name` varchar(200) DEFAULT NULL,
  `hos_phone_no` varchar(15) DEFAULT NULL,
  `address_line` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `state` varchar(200) DEFAULT NULL,
  `a_positive` int(11) NOT NULL DEFAULT 0,
  `a_negative` int(11) NOT NULL DEFAULT 0,
  `b_positive` int(11) NOT NULL DEFAULT 0,
  `b_negative` int(11) NOT NULL DEFAULT 0,
  `o_positive` int(11) NOT NULL DEFAULT 0,
  `o_negative` int(11) NOT NULL DEFAULT 0,
  `ab_positive` int(11) NOT NULL DEFAULT 0,
  `ab_negative` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hospital`
--

INSERT INTO `hospital` (`hid`, `email`, `password`, `hos_name`, `hos_phone_no`, `address_line`, `city`, `state`, `a_positive`, `a_negative`, `b_positive`, `b_negative`, `o_positive`, `o_negative`, `ab_positive`, `ab_negative`) VALUES
(34, 'rubygeneral@gmail.com', 'cnVieWdlbmVyYWw=', 'Ruby General Hospital', '8888543636', 'Ruby golpark, anandapur more, Postal Code - 700107', 'Kolkata', 'West Bengal', 12, 33, 0, 0, 0, 6, 35, 0),
(35, 'amri@gmail.com', 'YW1yaTEyMw==', 'AMRI', '9073849474', '24/B Dhakuria, Golpark, Postal Code - 700023', 'Kolkata', 'West Bengal', 0, 4, 0, 0, 0, 2, 5, 0),
(36, 'fortis@gmail.com', 'Zm9ydGlzMTIz', 'Fortis', '9073849474', '34 Phool Bagan, Kada Para, Salt lake, Postal Code - 700089', 'Kolkata', 'West Bengal', 0, 4, 23, 0, 8, 0, 0, 7),
(38, 'sn@gmail.com', 'c24xMjM0', 'S.N Blood Bank', '9887553422', '107 Canaught Place, Postal Code - 110876', 'Delhi', 'Delhi', 0, 0, 0, 0, 56, 0, 0, 0),
(39, 'wcb@gmail.com', 'd2NiMTIz', 'White Cross Blood Bank', '9073849474', 'A Block, East of Kailash, New Delhi, Postal Code - 110065', 'New Delhi', 'Delhi', 3, 0, 8, 0, 5, 5, 0, 4),
(40, 'lbb@gmail.com', 'bGJiMTIz', 'Lions Blood Bank', '9073849474', '100, Block AK, Poorbi Shalimar Bag, Shalimar Bagh, Postal Code - 110088', 'New Delhi', 'Delhi', 0, 0, 10, 0, 0, 101, 0, 24),
(41, 'bbb@gmail.com', 'YmJiMTIz', 'Borivali Blood Bank', '9073849474', 'Vitthal Apartment, Ground, Sardar Vallabhbhai Patel Rd, near Ram Mandir, Borivali West, Postal Code - 400103', 'Mumbai', 'Maharashtra', 0, 0, 16, 0, 0, 7, 6, 0),
(43, 'jbb@gmail.com', 'amJiMTIz', 'Jankalyan Blood Bank', '9073849474', 'Gadgil Patangan, Nalegaon, Ahmednagar, Postal Code - 414001', 'Ahmednagar', 'Maharashtra', 5, 9, 3, 2, 9, 0, 4, 0),
(44, 'ghbc@rediff.com', 'Z2hiYzEyMw==', 'St. George Hospital Blood Centre', '9073849474', 'Fort. Behine General Post Office P.D.Mello Road, Postal Code - 400001', 'Mumbai', 'Maharashtra', 0, 6, 5, 0, 7, 5, 10, 0),
(45, 'bht@gmail.com', 'Ymh0MTIz', 'Bombay Hospital Trust Blood Bank', '9073849474', 'MRC, Bombay Hospital 12, New Marine Lines, Postal Code - 400020', 'Mumbai', 'Maharashtra', 7, 0, 0, 0, 0, 5, 3, 3),
(46, 'hbc@gmail.com', 'aGJjMTIz', 'Dr. Hegdewar Blood Centre', '9073849474', 'Audumbar Apartment,Dharmpeth, Nagpur, Postal Code - 441002', 'Nagpur', 'Maharashtra', 5, 0, 3, 0, 0, 3, 0, 20),
(47, 'rbb@gmail.com', 'cmJiMTIz', 'Rotary blood bank', '9073849474', 'Medavakkam Main Rd, Vanuvampet, Madipakkam, Postal Code - 600091', 'Chennai', 'Tamil Nadu', 4, 0, 10, 7, 4, 0, 0, 0),
(48, 'spl@gmail.com', 'c3BsMTIz', 'Saharias Path Lab & Blood Bank', '9073849474', 'GS Rd, Byelane 3, Ananda Nagar, Bhangagarh, Guwahati, Postal Code - 781005', 'Guwahati', 'Assam', 0, 11, 7, 0, 0, 0, 0, 8),
(49, 'babb@gmail.com', 'YmJiMTIz', 'Bark Blood Bank', '9073849474', 'Central Rd, Tarapur, Kanakpur Part-II, Postal Code - 788005', 'Guwahati', 'Assam', 0, 0, 8, 6, 10, 0, 0, 5),
(50, 'carvin@gmail.com', 'MTIzNDU2', 'carvin', '7894561231', 'sdfsdafsdfa, Postal Code - 789456', 'sdfdsfsd', 'Jharkhand', 18, 23, 20, 11, 10, 12, 69, 15);

-- --------------------------------------------------------

--
-- Table structure for table `receiver`
--

CREATE TABLE `receiver` (
  `uid` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone_no` varchar(15) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `address_line` varchar(200) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `receiver`
--

INSERT INTO `receiver` (`uid`, `name`, `phone_no`, `email`, `password`, `address_line`, `blood_group`) VALUES
(19, 'Akash Modak', '9073849474', 'akashmodak97@gmail.com', 'YWthc2gxMjM=', 'C/o Shanti Bera, Nabagram, Kolkata, West Bengal, 700152', 'AB+'),
(32, 'Ranajit Hore', '7003985296', 'ranajithore@gmail.com', 'MTIzNDU2', '34/1 S. C. DEY LANE, PODDAR GHAT, BAIDYABATI, West Bengal, 712222', 'B+'),
(33, 'Rishi Mahato', '9903399103', 'rm@gmail.com', 'YW0xMjM0', 'Garia, Sonarpur, Kolkata, Madhya Pradesh, 110256', 'A+'),
(34, 'Ashish Chanchlani', '9654123654', 'asish@gmail.com', 'YXNpc2hAMTIz', '1234 main street, Kolkata, West Bengal, 700001', 'AB+'),
(35, 'Akash', '9073849474', 'am@gmail.com', 'YWthc2gxMjM=', 'Garia station, Kolkata, West Bengal, 700152', 'O+'),
(36, 'Akash', '9073849474', 'am97@gmail.com', 'YWthc2gxMjM=', 'Garia station, Kolkata, West Bengal, 700152', 'O-'),
(37, 'taychi', '7894561231', 'carvin@gmail.com', 'MTIzNDU2', 'dh kjkdk kjdskfj, Jerusalem, Maharashtra, 789456', 'AB+'),
(38, 'taychi', '7894561231', 'taychi@gmail.com', 'MTIzNDU2', 'dh kjkdk kjdskfj, Jerusalem, Maharashtra, 789456', 'AB+'),
(39, 'Akash Modak', '9073849474', 'akashmodak9@gmail.com', 'YWthc2gxMjM=', 'C/o Shanti Bera, Nabagram, 1No Middle Block, Garia Station, Kolkata, West Bengal, 700152', 'O+');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `rid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `hid` int(11) NOT NULL,
  `patient_name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `blood_group` varchar(20) DEFAULT NULL,
  `bottles` int(11) DEFAULT NULL,
  `status` varchar(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`rid`, `uid`, `hid`, `patient_name`, `email`, `blood_group`, `bottles`, `status`) VALUES
(1, 1, 34, 'fvgf', 'akashmodak97@gmail.com', 'a_positive', 1, '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hospital`
--
ALTER TABLE `hospital`
  ADD PRIMARY KEY (`hid`,`email`);

--
-- Indexes for table `receiver`
--
ALTER TABLE `receiver`
  ADD PRIMARY KEY (`uid`,`email`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`rid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hospital`
--
ALTER TABLE `hospital`
  MODIFY `hid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `receiver`
--
ALTER TABLE `receiver`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
