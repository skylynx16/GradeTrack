-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2018 at 05:27 PM
-- Server version: 10.2.12-MariaDB
-- PHP Version: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id5604476_dbgradetrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblaudittrail`
--

CREATE TABLE `tblaudittrail` (
  `ID` int(11) NOT NULL,
  `Username` varchar(30) NOT NULL,
  `UserType` int(1) DEFAULT NULL,
  `ActionDone` varchar(255) NOT NULL,
  `DateTimeActionMade` datetime DEFAULT NULL,
  `ip_address` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbldeadlines`
--

CREATE TABLE `tbldeadlines` (
  `ID` int(11) NOT NULL,
  `deadlineDateTime` datetime DEFAULT NULL,
  `Sem` char(1) NOT NULL,
  `SY` int(11) NOT NULL,
  `datetimeSet` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ProfAccountsDisabled` int(1) NOT NULL DEFAULT 0,
  `manualOverride` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldeadlines`
--

INSERT INTO `tbldeadlines` (`ID`, `deadlineDateTime`, `Sem`, `SY`, `datetimeSet`, `ProfAccountsDisabled`, `manualOverride`) VALUES
(1, NULL, '', 0, '2018-05-02 19:56:41', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblenrollment`
--

CREATE TABLE `tblenrollment` (
  `ID` int(11) NOT NULL,
  `SY` varchar(4) NOT NULL,
  `CourseCode` varchar(15) NOT NULL,
  `YearLevel` smallint(2) NOT NULL,
  `Sem` char(1) NOT NULL,
  `ParentSection` varchar(20) NOT NULL,
  `SectCode` varchar(20) NOT NULL,
  `SubjCode` varchar(255) NOT NULL,
  `ESubjCode` varchar(15) NOT NULL,
  `StudNo` varchar(15) NOT NULL,
  `FinalGrade` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblenrollment`
--

INSERT INTO `tblenrollment` (`ID`, `SY`, `CourseCode`, `YearLevel`, `Sem`, `ParentSection`, `SectCode`, `SubjCode`, `ESubjCode`, `StudNo`, `FinalGrade`) VALUES
(1, '1718', '3025A', 4, 'A', '4ITMW01', '3025A 4-4ITMW01', 'INTE_204', 'INTE_204', '2000300001', ''),
(2, '1718', '3025A', 4, 'A', '4ITMW01', '3025A 4-4ITMW01', 'INTE_204', 'INTE_204', '2014301168', ''),
(3, '1718', '3025B', 4, 'A', '4ITSE01', '3025B 4-4ITSE01', 'INTE_203', 'INTE_203', '2000300002', ''),
(4, '1718', '3025B', 4, 'A', '4ITSE01', '3025B 4-4ITSE01', 'INTE_203', 'INTE_203', '2013300322', ''),
(5, '1718', '3025C', 4, 'A', '4ITMA01', '3025C 4-4ITMA01', 'INTE_603', 'INTE_603', '2014300323', ''),
(6, '1718', '3025C', 4, 'A', '4ITMA01', '3025C 4-4ITMA01', 'INTE_603', 'INTE_603', '2001300414', ''),
(7, '1718', '3025A', 4, 'A', '4ITMW01', '3025A 4-4ITMW01', 'INTE.204', 'INTE.204', '2000300001', ''),
(8, '1718', '3025A', 4, 'A', '4ITMW01', '3025A 4-4ITMW01', 'INTE.204', 'INTE.204', '2014301168', ''),
(9, '1718', '3025B', 4, 'A', '4ITSE01', '3025B 4-4ITSE01', 'INTE.203', 'INTE.203', '2000300002', ''),
(10, '1718', '3025B', 4, 'A', '4ITSE01', '3025B 4-4ITSE01', 'INTE.203', 'INTE.203', '2013300322', ''),
(11, '1718', '3025C', 4, 'A', '4ITMA01', '3025C 4-4ITMA01', 'INTE.603', 'INTE.603', '2014300323', ''),
(12, '1718', '3025C', 4, 'A', '4ITMA01', '3025C 4-4ITMA01', 'INTE.603', 'INTE.603', '2001300414', ''),
(13, '1718', '3025B', 4, 'B', '4ITSE01', '3025B 4-4ITSE01', 'INTE_212', 'INTE_212', '2013300322', ''),
(14, '1718', '3025B', 4, 'B', '4ITSE01', '3025B 4-4ITSE01', 'INTE_212', 'INTE_212', '2000300002', ''),
(15, '1718', '3025B', 4, 'B', '4ITSE01', '3025B 4-4ITSE01', 'INTE.212', 'INTE.212', '2013300322', ''),
(16, '1718', '3025B', 4, 'B', '4ITSE01', '3025B 4-4ITSE01', 'INTE.212', 'INTE.212', '2000300002', ''),
(17, '1718', '3025B', 4, 'C', '4ITSE01', '3025B 4-4ITSE01', 'INTE_218', 'INTE_218', '2013300322', ''),
(18, '1718', '3025B', 4, 'C', '4ITSE01', '3025B 4-4ITSE01', 'INTE_218', 'INTE_218', '2000300002', ''),
(19, '1718', '3025B', 4, 'C', '4ITSE01', '3025B 4-4ITSE01', 'INTE.218', 'INTE.218', '2013300322', ''),
(20, '1718', '3025B', 4, 'C', '4ITSE01', '3025B 4-4ITSE01', 'INTE.218', 'INTE.218', '2000300002', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblfacultyprofile`
--

CREATE TABLE `tblfacultyprofile` (
  `FCode` varchar(30) DEFAULT NULL,
  `LName` varchar(40) DEFAULT NULL,
  `FName` varchar(30) DEFAULT NULL,
  `MName` varchar(30) DEFAULT NULL,
  `CityAddr` varchar(80) DEFAULT NULL,
  `BDate` date DEFAULT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfacultyprofile`
--

INSERT INTO `tblfacultyprofile` (`FCode`, `LName`, `FName`, `MName`, `CityAddr`, `BDate`, `picture`) VALUES
('12-000-000', 'Robles', 'Andreu Vinzent', 'Florendo', 'Mandaluyong City', '1996-03-16', 'resources/images/profilepic/userprofilepicmale.png'),
('12-000-001', 'Lopez', 'Mirriam', 'Mendoza', 'Antipolo City', '1980-04-21', 'resources/images/profilepic/userprofilepicfemale.png'),
('12-000-002', 'Perez', 'Jamie', 'Bermudez', 'Pasig City', '1981-02-01', 'resources/images/profilepic/userprofilepicfemale.png'),
('12-000-003', 'Gomez', 'Stephen', 'Zamora', 'Marikina City', '1975-12-30', 'resources/images/profilepic/userprofilepicmale.png'),
('12-000-004', 'Hernandes', 'Cherry', 'Veneracion', 'Muntinlupa City', '1984-05-07', 'resources/images/profilepic/userprofilepicfemale.png'),
('12-000-005', 'Romulo', 'Romualdo', 'Valdez', 'Pasay City', '1965-07-20', 'resources/images/profilepic/userprofilepicmale.png'),
('12-000-006', 'Juliano', 'Bernadine', 'Boncay', 'Quezon City', '1996-06-19', 'resources/images/profilepic/userprofilepicfemale.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblpaymentstrail`
--

CREATE TABLE `tblpaymentstrail` (
  `StudNo` varchar(15) NOT NULL,
  `SY` varchar(4) NOT NULL,
  `Sem` char(1) NOT NULL,
  `Balance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpaymentstrail`
--

INSERT INTO `tblpaymentstrail` (`StudNo`, `SY`, `Sem`, `Balance`) VALUES
('2000300001', '1718', 'A', 0),
('2000300002', '1718', 'A', 0),
('2001300414', '1718', 'A', 0),
('2013300322', '1718', 'A', 0),
('2014300323', '1718', 'A', 0),
('2014301168', '1718', 'A', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblschedule`
--

CREATE TABLE `tblschedule` (
  `SY` varchar(4) NOT NULL,
  `CourseCode` varchar(15) NOT NULL,
  `YearLevel` smallint(1) NOT NULL,
  `Sem` char(1) NOT NULL,
  `ParentSection` varchar(20) NOT NULL,
  `SectCode` varchar(20) NOT NULL,
  `SubjCode` varchar(15) NOT NULL,
  `FCode` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblschedule`
--

INSERT INTO `tblschedule` (`SY`, `CourseCode`, `YearLevel`, `Sem`, `ParentSection`, `SectCode`, `SubjCode`, `FCode`) VALUES
('1718', '3025B', 4, 'A', '4ITSE01', '3025B 4-4ITSE01', 'INTE.203', '12-000-000'),
('1718', '3025B', 4, 'A', '4ITMW01', '3025A 4-4ITMW01', 'INTE.204', '12-000-001'),
('1718', '3025B', 4, 'B', '4ITSE01', '3025B 4-4ITSE01', 'INTE.212', '12-000-000'),
('1718', '3025B', 4, 'C', '4ITSE01', '3025B 4-4ITSE01', 'INTE.218', '12-000-000'),
('1718', '3025B', 4, 'A', '4ITMA01', '3025C 4-4ITMA01', 'INTE.603', '12-000-006'),
('1718', '3025B', 4, 'A', '4ITSE01', '3025B 4-4ITSE01', 'INTE_203', '12-000-000'),
('1718', '3025B', 4, 'A', '4ITMW01', '3025A 4-4ITMW01', 'INTE_204', '12-000-001'),
('1718', '3025B', 4, 'B', '4ITSE01', '3025B 4-4ITSE01', 'INTE_212', '12-000-000'),
('1718', '3025B', 4, 'C', '4ITSE01', '3025B 4-4ITSE01', 'INTE_218', '12-000-000'),
('1718', '3025B', 4, 'A', '4ITMA01', '3025C 4-4ITMA01', 'INTE_603', '12-000-006');

-- --------------------------------------------------------

--
-- Table structure for table `tblsetsysemgp`
--

CREATE TABLE `tblsetsysemgp` (
  `ID` int(11) NOT NULL,
  `SY` varchar(4) NOT NULL,
  `Sem` char(1) NOT NULL,
  `GradingPeriod` varchar(20) NOT NULL,
  `datetime_updated` datetime NOT NULL,
  `prevSem` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentguardian`
--

CREATE TABLE `tblstudentguardian` (
  `StudNo` varchar(15) NOT NULL,
  `Guardian` varchar(50) NOT NULL,
  `Mobile` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudentguardian`
--

INSERT INTO `tblstudentguardian` (`StudNo`, `Guardian`, `Mobile`) VALUES
('2000300002', 'Jessie Perez', '09991234567'),
('2001300414', 'Linda Flores', '09991234567'),
('2003300001', 'Jose Mercado', '09991234567'),
('2013300322', 'Lourdes F. Robles', '09211234567'),
('2014300323', 'Larry Tolentino', '09991234567'),
('2014301168', 'Lily Juliano', '09987654321');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudentpersonaldata`
--

CREATE TABLE `tblstudentpersonaldata` (
  `StudNo` varchar(15) NOT NULL,
  `LName` varchar(30) NOT NULL,
  `FName` varchar(40) NOT NULL,
  `MName` varchar(30) NOT NULL,
  `BDate` date NOT NULL,
  `Mobile` varchar(15) NOT NULL,
  `CityAddr` varchar(80) NOT NULL,
  `CourseCode` varchar(15) NOT NULL,
  `SectCode` varchar(15) NOT NULL,
  `YearLevel` char(1) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudentpersonaldata`
--

INSERT INTO `tblstudentpersonaldata` (`StudNo`, `LName`, `FName`, `MName`, `BDate`, `Mobile`, `CityAddr`, `CourseCode`, `SectCode`, `YearLevel`, `picture`) VALUES
('2000300001', 'Mercado', 'Jose', 'Velasco', '1997-03-15', '09991234567', 'Quezon City', '3025A', '3025A 4-4ITMW01', '4', 'resources/images/profilepic/userprofilepicmale.png'),
('2000300002', 'Perez', 'Kate', 'Sanchez', '1995-04-09', '09991234567', 'Antipolo City', '3025B', '3025B 4-4ITSE01', '4', 'resources/images/profilepic/userprofilepicfemale.png'),
('2001300414', 'Flores', 'Michelle', 'Vince-Cruz', '1996-03-01', '09991234567', 'Quezon City', '3025C', '3025C 4-4ITMA01', '4', 'resources/images/profilepic/userprofilepicfemale.png'),
('2013300322', 'Robles', 'Andreu Vinzent', 'Florendo', '1996-03-16', '09161234567', 'Mandaluyong City', '3025B', '3025B 4-4ITSE01', '4', 'resources/images/profilepic/userprofilepicmale.png'),
('2014300323', 'Tolentino', 'Mike', 'Reyes', '1994-11-21', '09991234567', 'Makati City', '3025C', '3025C 4-4ITMA01', '4', 'resources/images/profilepic/userprofilepicmale.png'),
('2014301168', 'Juliano', 'Bernadine', 'Boncay', '1996-06-19', '09061633137', 'Quezon City', '3025A', '3025A 4-4ITMW01', '4', 'resources/images/profilepic/userprofilepicfemale.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubject`
--

CREATE TABLE `tblsubject` (
  `SubjCode` varchar(15) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubject`
--

INSERT INTO `tblsubject` (`SubjCode`, `Description`) VALUES
('INTE.203', 'Basic Networking (Laboratory)'),
('INTE.204', 'Systems Analysis and Design (Laboratory)'),
('INTE.212', 'Database Management Systems 1 (Laboratory)'),
('INTE.218', 'Operating Systems (Laboratory)'),
('INTE.603', 'Advanced Multimedia Systems (Laboratory)'),
('INTE_203', 'Basic Networking (Lecture)'),
('INTE_204', 'Systems Analysis and Design (Lecture)'),
('INTE_212', 'Database Management Systems 1 (Lecture)'),
('INTE_218', 'Operating Systems (Lecture)'),
('INTE_603', 'Advanced Multimedia Systems (Lecture)');

-- --------------------------------------------------------

--
-- Table structure for table `tbltokens`
--

CREATE TABLE `tbltokens` (
  `ID` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `timeStamp` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbltokens`
--

INSERT INTO `tbltokens` (`ID`, `token`, `UserID`, `timeStamp`) VALUES
(1, 'cf5e553d3355481e206f99471faf77', 1, '2018-04-07 16:00:00'),
(2, '29655ab532e78bf8c71666916e4910', 2, '2018-04-08 16:00:00'),
(3, '8ac5cbc8a679f52315d067d8619cd4', 3, '2018-04-08 16:00:00'),
(4, '870417df91daecc4e82a1bed6c1b3d', 4, '2018-04-09 16:00:00'),
(5, '1996dae363abae2419d0984629789a', 5, '2018-04-10 16:00:00'),
(6, 'f921ce48ef094fb87f19c87db6bd77', 7, '2018-04-17 16:00:00'),
(7, '3479a8970166aeabc5c649d9976d00', 7, '2018-04-30 16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(30) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `UserTypeID` varchar(30) DEFAULT NULL,
  `lastlogin` datetime NOT NULL,
  `status` varchar(100) NOT NULL,
  `IDCode` varchar(30) DEFAULT NULL,
  `LName` varchar(40) DEFAULT NULL,
  `FName` varchar(30) DEFAULT NULL,
  `MName` varchar(30) DEFAULT NULL,
  `isactive` int(1) DEFAULT NULL,
  `passresetreq` varchar(20) DEFAULT NULL,
  `isloggedin` int(1) NOT NULL DEFAULT 0,
  `parentNotif` int(1) NOT NULL DEFAULT 0,
  `parentNotifIsSet` int(1) NOT NULL DEFAULT 0,
  `profilePic` varchar(255) DEFAULT NULL,
  `deadlineTrigger` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`UserID`, `Username`, `Email`, `Password`, `UserTypeID`, `lastlogin`, `status`, `IDCode`, `LName`, `FName`, `MName`, `isactive`, `passresetreq`, `isloggedin`, `parentNotif`, `parentNotifIsSet`, `profilePic`, `deadlineTrigger`) VALUES
(1, 'gradetrackadmin', 'gradetrack.official@gmail.com', 'e480dd6f0fb0590ad3fd32c0bfd55077ae2f2146984f14115199338dd88d87f4fb83194cc5699d3a7145742f9c02f326162455b1744a394cd4046ef07d286559U1XH9eCxeh85/7/LQzuLIqNrZXMRQK20cMeIY0n47YQ=', '3', '2018-05-02 11:36:43', 'confirmed', NULL, 'Admin', 'Grade', 'Track', 1, NULL, 0, 0, 0, NULL, 0),
(2, 'skylynx', 'afrobles@tua.edu.ph', 'e6f11531f06f6eba56247a40c88a8a12517a654422b44f4639aa678351219c0acfb80a70f4670d7db8848743cfe17b61f3e63c64d7e75985b31823f9eb62d7bdRETHnJabRzfmlaRrvy6syrvfSsoGZDQL4YcGyUSh1HU=', '1', '2018-05-02 11:02:36', 'confirmed', '12-000-000', 'Robles', 'Andreu Vinzent', 'Florendo', 1, NULL, 0, 0, 0, 'resources/images/profilepic/userprofilepicmale.png', 0),
(3, 'lopez01', 'lopez01@gmail.com', '7930e7c4517d706bd6ba67aa72ed1879a5f59e43758b9cbe82ddeb5e9ab483e61e46512c2f14f843e5a30947c6d246538238d818388c08d9c641b6c196b8e1b35sJ1C+HyV6nRV0ld1xZiHEifiFUbTS+uLi2ZKqGsx8I=', '1', '2018-04-13 06:03:37', 'confirmed', '12-000-001', 'Lopez', 'Mirriam', 'Mendoza', 1, NULL, 0, 0, 0, 'resources/images/profilepic/userprofilepicfemale.png', 0),
(4, 'perez01', 'perez01@yahoo.com', 'fc8a9a9605a6d0e0d3275357527eaa7e313fb30b2b01c1a8d85c62f8d1e7217413cbbd081399bc843d49f8a1c664e1596e903d3a47764c1aff2515c272135526IJyX2x3YONJKwssPt+Gl2uTWtgcOqRjzL7FRbo5kf+8=', '1', '2018-04-13 06:04:07', 'confirmed', '12-000-002', 'Perez', 'Jamie', 'Bermudez', 1, NULL, 0, 0, 0, 'resources/images/profilepic/userprofilepicfemale.png', 0),
(5, 'skylynx16', 'andreurobles1416@gmail.com', 'dc89dd6d5d989837540a2466ad1af3820d0baefc9d51c96fa73526d53e73e46b88952479bbded85e3ae1a727f47933236c181d5caf375a3be33c8e3b8b4e175fq6G8lyUpfkahtJK9jiMbw/g4oHaCXhPbRyOtpzhTGqA=', '2', '2018-05-01 17:57:46', 'confirmed', '2013300322', 'Robles', 'Andreu Vinzent', 'Florendo', 1, NULL, 0, 0, 0, 'resources/images/profilepic/userprofilepicmale.png', 0),
(6, 'nadinejuliano', 'bernadinejuliano@gmail.com', '270f84c2d588043893945340a9b6f7b551e403ff6990ddfbfbd91ff290a0b7ae0169ea06a9f6dde93085ec0b4ffe4f4ffb2f8079b974d6921b2ac7aa6d7e63ceAd/lEo07emA6oWfG10pzD2REk9AQU71eMpu2ty56lNk=', '1', '2018-04-11 08:41:56', 'confirmed', '12-000-006', 'Juliano', 'Bernadine', 'Boncay', 1, NULL, 0, 0, 0, 'resources/images/profilepic/userprofilepicfemale.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblusertypes`
--

CREATE TABLE `tblusertypes` (
  `ID` int(11) NOT NULL,
  `UserTypeID` int(11) DEFAULT NULL,
  `UserTypeDesc` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusertypes`
--

INSERT INTO `tblusertypes` (`ID`, `UserTypeID`, `UserTypeDesc`) VALUES
(1, 1, 'professor'),
(2, 2, 'student'),
(3, 3, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `tblaudittrail`
--
ALTER TABLE `tblaudittrail`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbldeadlines`
--
ALTER TABLE `tbldeadlines`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblenrollment`
--
ALTER TABLE `tblenrollment`
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Indexes for table `tblfacultyprofile`
--
ALTER TABLE `tblfacultyprofile`
  ADD UNIQUE KEY `FCode` (`FCode`);

--
-- Indexes for table `tblpaymentstrail`
--
ALTER TABLE `tblpaymentstrail`
  ADD UNIQUE KEY `StudNo` (`StudNo`);

--
-- Indexes for table `tblschedule`
--
ALTER TABLE `tblschedule`
  ADD UNIQUE KEY `SubjCode` (`SubjCode`);

--
-- Indexes for table `tblsetsysemgp`
--
ALTER TABLE `tblsetsysemgp`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblstudentguardian`
--
ALTER TABLE `tblstudentguardian`
  ADD UNIQUE KEY `StudNo` (`StudNo`);

--
-- Indexes for table `tblstudentpersonaldata`
--
ALTER TABLE `tblstudentpersonaldata`
  ADD UNIQUE KEY `StudNo` (`StudNo`);

--
-- Indexes for table `tblsubject`
--
ALTER TABLE `tblsubject`
  ADD UNIQUE KEY `SubjCode` (`SubjCode`);

--
-- Indexes for table `tbltokens`
--
ALTER TABLE `tbltokens`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `tblusertypes`
--
ALTER TABLE `tblusertypes`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblaudittrail`
--
ALTER TABLE `tblaudittrail`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbldeadlines`
--
ALTER TABLE `tbldeadlines`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblenrollment`
--
ALTER TABLE `tblenrollment`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblsetsysemgp`
--
ALTER TABLE `tblsetsysemgp`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbltokens`
--
ALTER TABLE `tbltokens`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblusertypes`
--
ALTER TABLE `tblusertypes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
