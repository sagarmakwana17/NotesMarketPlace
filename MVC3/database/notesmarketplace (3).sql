-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2021 at 03:58 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notesmarketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `CountryCode` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`ID`, `Name`, `CountryCode`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'india\r\n', '+91', '2021-03-17 12:35:06', 1, NULL, NULL, b'1'),
(2, 'usa', '+1', '2021-03-17 12:35:35', 1, NULL, NULL, b'1'),
(3, 'russia', '10', '2021-04-10 14:22:58', 1, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `Seller` int(100) NOT NULL,
  `Downloader` int(11) NOT NULL,
  `IsSellerHasAllowedDownload` bit(1) NOT NULL,
  `AttachmentPath` varchar(255) DEFAULT NULL,
  `IsAttachmentDownloaded` bit(1) NOT NULL,
  `AttachmentDownloadedDate` datetime DEFAULT NULL,
  `IsPaid` bit(1) NOT NULL,
  `PurchasedPrice` decimal(10,0) DEFAULT NULL,
  `NoteTitle` varchar(100) NOT NULL,
  `NoteCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`ID`, `NoteID`, `Seller`, `Downloader`, `IsSellerHasAllowedDownload`, `AttachmentPath`, `IsAttachmentDownloaded`, `AttachmentDownloadedDate`, `IsPaid`, `PurchasedPrice`, `NoteTitle`, `NoteCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES
(1, 15, 16, 16, b'0', NULL, b'1', NULL, b'0', '0', '', '', '2021-03-14 12:46:01', NULL, NULL, NULL),
(7, 16, 16, 16, b'1', NULL, b'1', '2021-03-22 13:57:57', b'1', NULL, 'html', 'SOCIAL STUDIES', '2021-03-22 13:57:57', NULL, NULL, NULL),
(8, 16, 16, 16, b'1', NULL, b'1', '2021-03-22 13:58:05', b'1', NULL, 'html', 'SOCIAL STUDIES', '2021-03-22 13:58:05', NULL, NULL, NULL),
(25, 16, 16, 16, b'1', NULL, b'1', '2021-03-22 14:07:19', b'1', NULL, 'html', 'SOCIAL STUDIES', '2021-03-22 14:07:19', NULL, NULL, NULL),
(26, 16, 16, 16, b'1', NULL, b'1', '2021-03-22 14:34:14', b'1', NULL, 'html', 'SOCIAL STUDIES', '2021-03-22 14:34:14', NULL, NULL, NULL),
(27, 16, 16, 16, b'1', NULL, b'1', '2021-03-22 14:34:30', b'1', NULL, 'html', 'SOCIAL STUDIES', '2021-03-22 14:34:30', NULL, NULL, NULL),
(28, 16, 16, 16, b'1', NULL, b'1', '2021-03-22 14:35:52', b'1', NULL, 'html', 'SOCIAL STUDIES', '2021-03-22 14:35:52', NULL, NULL, NULL),
(29, 15, 2, 15, b'1', NULL, b'1', '2021-03-22 15:47:46', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-03-22 15:47:46', NULL, NULL, NULL),
(30, 15, 2, 15, b'1', NULL, b'1', '2021-03-22 15:49:27', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-03-22 15:49:27', NULL, NULL, NULL),
(31, 15, 2, 15, b'1', NULL, b'1', '2021-03-22 15:51:08', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-03-22 15:51:08', NULL, NULL, NULL),
(33, 15, 2, 15, b'0', NULL, b'0', '2021-03-22 15:53:28', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-03-22 15:53:28', NULL, NULL, NULL),
(36, 15, 16, 16, b'1', NULL, b'0', '2021-03-25 12:00:02', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-03-25 12:00:02', NULL, NULL, NULL),
(40, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 12:58:07', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 12:58:07', NULL, NULL, NULL),
(41, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 12:58:25', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 12:58:25', NULL, NULL, NULL),
(42, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:00:43', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:00:43', NULL, NULL, NULL),
(43, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:01:05', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:01:05', NULL, NULL, NULL),
(44, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:01:20', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:01:20', NULL, NULL, NULL),
(45, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:05:26', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:05:26', NULL, NULL, NULL),
(46, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:06:24', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:06:24', NULL, NULL, NULL),
(47, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:07:10', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:07:10', NULL, NULL, NULL),
(48, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:08:40', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:08:40', NULL, NULL, NULL),
(49, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:09:27', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:09:27', NULL, NULL, NULL),
(50, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:10:56', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:10:56', NULL, NULL, NULL),
(51, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:12:42', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:12:42', NULL, NULL, NULL),
(52, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:17:49', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:17:49', NULL, NULL, NULL),
(53, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:26:29', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:26:29', NULL, NULL, NULL),
(54, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:27:42', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:27:42', NULL, NULL, NULL),
(55, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:31:04', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:31:04', NULL, NULL, NULL),
(56, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:32:16', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:32:16', NULL, NULL, NULL),
(57, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:32:37', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:32:37', NULL, NULL, NULL),
(58, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:33:35', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:33:35', NULL, NULL, NULL),
(59, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:33:52', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:33:52', NULL, NULL, NULL),
(60, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:34:04', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:34:04', NULL, NULL, NULL),
(61, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:35:03', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:35:03', NULL, NULL, NULL),
(62, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:35:34', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:35:34', NULL, NULL, NULL),
(63, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:35:56', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:35:56', NULL, NULL, NULL),
(64, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:36:09', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:36:09', NULL, NULL, NULL),
(65, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:36:32', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:36:32', NULL, NULL, NULL),
(66, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:38:33', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:38:33', NULL, NULL, NULL),
(67, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:39:08', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:39:08', NULL, NULL, NULL),
(68, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:39:16', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:39:16', NULL, NULL, NULL),
(69, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:40:08', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:40:08', NULL, NULL, NULL),
(70, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:40:52', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:40:52', NULL, NULL, NULL),
(71, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:42:21', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:42:21', NULL, NULL, NULL),
(72, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:42:44', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:42:44', NULL, NULL, NULL),
(73, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:42:59', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:42:59', NULL, NULL, NULL),
(74, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:44:56', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:44:56', NULL, NULL, NULL),
(75, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:45:07', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:45:07', NULL, NULL, NULL),
(76, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:46:39', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:46:39', NULL, NULL, NULL),
(77, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:47:30', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:47:30', NULL, NULL, NULL),
(78, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:55:58', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:55:58', NULL, NULL, NULL),
(79, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 13:56:20', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 13:56:20', NULL, NULL, NULL),
(80, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:01:58', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:01:58', NULL, NULL, NULL),
(81, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:02:13', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:02:13', NULL, NULL, NULL),
(82, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:03:21', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:03:21', NULL, NULL, NULL),
(83, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:07:32', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:07:32', NULL, NULL, NULL),
(84, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:10:13', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:10:13', NULL, NULL, NULL),
(85, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:10:46', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:10:46', NULL, NULL, NULL),
(86, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:11:16', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:11:16', NULL, NULL, NULL),
(87, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:11:28', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:11:28', NULL, NULL, NULL),
(88, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:18:14', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:18:14', NULL, NULL, NULL),
(89, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:18:59', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:18:59', NULL, NULL, NULL),
(90, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:19:56', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:19:56', NULL, NULL, NULL),
(91, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:20:07', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:20:07', NULL, NULL, NULL),
(92, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:20:37', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:20:37', NULL, NULL, NULL),
(93, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:21:02', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:21:02', NULL, NULL, NULL),
(94, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:21:09', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:21:09', NULL, NULL, NULL),
(95, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:21:16', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:21:16', NULL, NULL, NULL),
(96, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:22:44', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:22:44', NULL, NULL, NULL),
(97, 15, 16, 16, b'0', NULL, b'0', '2021-04-12 14:23:11', b'1', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '2021-04-12 14:23:11', NULL, NULL, NULL),
(98, 18, 22, 16, b'1', NULL, b'1', '2021-04-12 18:21:56', b'1', NULL, 'History of Gujarat', 'SOCIAL STUDIES', '2021-04-12 18:21:56', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notecategories`
--

CREATE TABLE `notecategories` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDated` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notecategories`
--

INSERT INTO `notecategories` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDated`, `ModifiedBy`, `IsActive`) VALUES
(15, 'computer', 'Notes related to computer science', '2021-03-05 18:56:41', 1, '2021-04-11 14:11:13', 1, b'0'),
(17, 'IT', 'Notes related to computer science', '2021-03-10 21:45:32', 1, '2021-04-11 14:11:13', 1, b'1'),
(18, 'computer', 'Notes related to computer science', '2021-04-10 14:08:28', 1, '2021-04-11 14:11:13', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `notetypes`
--

CREATE TABLE `notetypes` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notetypes`
--

INSERT INTO `notetypes` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(15, 'printed', 'printed', '2021-03-05 19:04:56', 1, NULL, NULL, b'1'),
(17, 'handwritten', 'printed', '2021-03-10 21:44:32', 1, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `referencedata`
--

CREATE TABLE `referencedata` (
  `ID` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `DataValue` varchar(100) NOT NULL,
  `RefCategory` varchar(100) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referencedata`
--

INSERT INTO `referencedata` (`ID`, `value`, `DataValue`, `RefCategory`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'inreview', 'inreview', 'inreview', '2021-03-05 18:49:11', NULL, NULL, NULL, b'1'),
(2, '', '', 'draft', '2021-03-08 13:25:57', NULL, NULL, NULL, b'1'),
(15, '', '', 'submitted', '2021-03-08 13:27:03', NULL, NULL, NULL, b'1'),
(17, '', '', 'draft', '2021-03-10 21:46:15', NULL, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotes`
--

CREATE TABLE `sellernotes` (
  `ID` int(11) NOT NULL,
  `SellerID` int(11) NOT NULL,
  `Status` varchar(15) DEFAULT NULL,
  `ActionedBy` int(11) DEFAULT NULL,
  `AdminRemarks` varchar(255) DEFAULT NULL,
  `PublishedDate` datetime DEFAULT NULL,
  `Title` varchar(100) NOT NULL,
  `Category` varchar(30) DEFAULT NULL,
  `DisplayPicture` varchar(500) DEFAULT NULL,
  `FilePath` varchar(100) NOT NULL,
  `NoteType` varchar(20) DEFAULT NULL,
  `NumberofPages` int(11) DEFAULT NULL,
  `Description` varchar(255) NOT NULL,
  `UniversityName` varchar(200) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `Course` varchar(100) DEFAULT NULL,
  `CourseCode` varchar(100) DEFAULT NULL,
  `Professor` varchar(100) DEFAULT NULL,
  `IsPaid` varchar(10) NOT NULL,
  `SellingPrice` decimal(10,0) DEFAULT NULL,
  `NotesPreview` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellernotes`
--

INSERT INTO `sellernotes` (`ID`, `SellerID`, `Status`, `ActionedBy`, `AdminRemarks`, `PublishedDate`, `Title`, `Category`, `DisplayPicture`, `FilePath`, `NoteType`, `NumberofPages`, `Description`, `UniversityName`, `Country`, `Course`, `CourseCode`, `Professor`, `IsPaid`, `SellingPrice`, `NotesPreview`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(15, 16, 'published', NULL, 'inappropriate', NULL, 'Bootstrap & Css', 'COMPUTER SCIENCE', '', '', 'printed', 4, 'this course is for bootstrap & css', 'BVM', 'usa', 'php', '306', 'prof shah', 'yes', '80', 'uploads/notes_uploaded/bet report.pdf', '2021-03-05 19:09:07', NULL, NULL, NULL, b'1'),
(16, 2, 'published', NULL, NULL, NULL, 'html', 'SOCIAL STUDIES', '', '', 'printed', 552, 'this course is for bootstrap & css', 'msu', 'uk', 'javascript', 'hgsj44', 'prof shah', 'no', '15', 'uploads/notes_uploaded/bet report.pdf', '2021-03-08 14:56:36', NULL, NULL, NULL, b'1'),
(17, 2, 'submitted', NULL, NULL, NULL, 'Data Structure', 'science', '', '', 'handwritten', 454, 'hello', 'gtu', 'india', 'php', '545', 'jghsgj', 'no', '50', 'uploads/notes_uploaded/bet report.pdf', '2021-03-09 11:53:02', NULL, '2021-03-10 22:06:49', NULL, b'1'),
(18, 22, 'submitted', NULL, NULL, NULL, 'History of Gujarat', 'SOCIAL STUDIES', 'uploads/note_display_pictures/search1.png', 'uploads/notes_uploaded/srs onlije.pdf', 'type 1', 45, 'This book contains breif history of gujarat', 'GEC bhavnagar', 'INDIA', 'History', '54', 'Mr pandya', 'no', '0', 'uploads/notes_uploaded/srs onlije.pdf', '2021-04-12 18:13:21', NULL, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesattachements`
--

CREATE TABLE `sellernotesattachements` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `FileName` varchar(100) NOT NULL,
  `FilePath` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesreportedissues`
--

CREATE TABLE `sellernotesreportedissues` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `ReportedByID` int(11) NOT NULL,
  `AgainstDownloadID` int(11) NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesreviews`
--

CREATE TABLE `sellernotesreviews` (
  `ID` int(11) NOT NULL,
  `NoteID` int(11) NOT NULL,
  `ReviewedByID` int(11) NOT NULL,
  `AgainstDownloadsID` int(11) NOT NULL,
  `Ratings` decimal(10,0) NOT NULL,
  `Comments` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellernotesreviews`
--

INSERT INTO `sellernotesreviews` (`ID`, `NoteID`, `ReviewedByID`, `AgainstDownloadsID`, `Ratings`, `Comments`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 15, 1, 1, '2', 'Awesome !', '2021-03-14 12:46:48', NULL, NULL, NULL, b'1'),
(13, 16, 16, 27, '2', 'very good !', '2021-03-28 11:37:04', NULL, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `systemconfigurations`
--

CREATE TABLE `systemconfigurations` (
  `ID` int(11) NOT NULL,
  `KeyName` varchar(100) NOT NULL,
  `Value` varchar(255) NOT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DOB` datetime DEFAULT NULL,
  `Gender` int(11) DEFAULT NULL,
  `SecondaryEmailAddress` varchar(100) DEFAULT NULL,
  `PhoneNumber_CountryCode` varchar(5) NOT NULL,
  `PhoneNumber` varchar(20) NOT NULL,
  `ProfilePicture` varchar(500) DEFAULT NULL,
  `AddressLine1` varchar(100) NOT NULL,
  `AddressLine2` varchar(100) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `ZipCode` varchar(50) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `University` varchar(100) DEFAULT NULL,
  `College` varchar(100) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`ID`, `UserID`, `DOB`, `Gender`, `SecondaryEmailAddress`, `PhoneNumber_CountryCode`, `PhoneNumber`, `ProfilePicture`, `AddressLine1`, `AddressLine2`, `City`, `State`, `ZipCode`, `Country`, `University`, `College`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`) VALUES
(1, 16, NULL, NULL, NULL, '', '545454545', NULL, '', '', '', '', '', '', NULL, NULL, '2021-03-26 12:51:22', NULL, NULL, NULL),
(4, 15, '0000-00-00 00:00:00', 0, 'abcd@gmail.com', '91', '9099826577', NULL, 'bjhjh', 'hjjhjh', 'ghgh', 'sdsd', '6', 'hjhjh', 'dsdsds', 'dsdsdsds', '2021-03-27 13:32:46', NULL, NULL, NULL),
(5, 1, NULL, NULL, 'ak@gmail.com', '91', '9099826577', '../uploads/user_profile_pictures/customer-1.png', '', '', '', '', '', '', NULL, NULL, '2021-04-11 17:14:17', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`ID`, `Name`, `Description`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`) VALUES
(1, 'admin', 'administrator', '2021-02-09 15:08:12', NULL, NULL, NULL, b'1'),
(2, 'member', NULL, '2021-02-27 15:04:34', NULL, NULL, NULL, b'1'),
(3, 'super admin', NULL, '2021-04-11 12:36:10', NULL, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `RoleID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `EmailID` varchar(100) NOT NULL,
  `Password` varchar(24) NOT NULL,
  `IsEmailVerified` bit(1) NOT NULL DEFAULT b'0',
  `CreatedDate` datetime DEFAULT current_timestamp(),
  `CreatedBy` int(11) DEFAULT NULL,
  `ModifiedDate` datetime DEFAULT NULL,
  `ModifiedBy` int(11) DEFAULT NULL,
  `IsActive` bit(1) DEFAULT b'1',
  `vkey` varchar(255) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `RoleID`, `FirstName`, `LastName`, `EmailID`, `Password`, `IsEmailVerified`, `CreatedDate`, `CreatedBy`, `ModifiedDate`, `ModifiedBy`, `IsActive`, `vkey`) VALUES
(1, 1, 'sagar', 'makwana', 'abc@gmail.com', 'Sagar@17', b'0', '2021-02-16 15:09:18', NULL, NULL, NULL, b'1', '2fcd3a8bcb6fd2160b3bff4f3ec1dbbc'),
(15, 2, 'malhar', 'mak', 'a@gmail.com', 'Akash@17', b'1', '2021-02-28 22:49:50', NULL, NULL, NULL, b'0', '2fcd3a8bcb6fd2160b3bff4f3ec1dbbc'),
(16, 2, 'malhar', 'mak', 'abcd@gmail.com', 'Sagar@17', b'1', '2021-02-28 23:29:38', NULL, NULL, NULL, b'1', '2fcd3a8bcb6fd2160b3bff4f3ec1dbbc'),
(22, 2, 'sagar', 'makwana', 'skywalker4073@gmail.com', 'Sagar@17', b'1', '2021-04-03 11:17:16', NULL, NULL, NULL, b'1', 'd70d60541a20c13ea6d3fcef6195f39e'),
(23, 1, 'akash', 'makwana', 'malhar2@gmail.com', 'Admin@123', b'1', '2021-04-10 13:48:35', NULL, NULL, NULL, b'0', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `Downloader` (`Downloader`);

--
-- Indexes for table `notecategories`
--
ALTER TABLE `notecategories`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `notetypes`
--
ALTER TABLE `notetypes`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `referencedata`
--
ALTER TABLE `referencedata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `sellernotes`
--
ALTER TABLE `sellernotes`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `SellerID` (`SellerID`),
  ADD KEY `ActionedBy` (`ActionedBy`);

--
-- Indexes for table `sellernotesattachements`
--
ALTER TABLE `sellernotesattachements`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`);

--
-- Indexes for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `ReportedByID` (`ReportedByID`),
  ADD KEY `AgainstDownloadID` (`AgainstDownloadID`);

--
-- Indexes for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NoteID` (`NoteID`),
  ADD KEY `ReviewedByID` (`ReviewedByID`),
  ADD KEY `AgainstDownloadsID` (`AgainstDownloadsID`);

--
-- Indexes for table `systemconfigurations`
--
ALTER TABLE `systemconfigurations`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `Gender` (`Gender`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `EmailID` (`EmailID`),
  ADD KEY `RoleID` (`RoleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `notecategories`
--
ALTER TABLE `notecategories`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notetypes`
--
ALTER TABLE `notetypes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `referencedata`
--
ALTER TABLE `referencedata`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sellernotes`
--
ALTER TABLE `sellernotes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sellernotesattachements`
--
ALTER TABLE `sellernotesattachements`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `systemconfigurations`
--
ALTER TABLE `systemconfigurations`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`),
  ADD CONSTRAINT `downloads_ibfk_3` FOREIGN KEY (`Downloader`) REFERENCES `users` (`ID`);

--
-- Constraints for table `sellernotesattachements`
--
ALTER TABLE `sellernotesattachements`
  ADD CONSTRAINT `sellernotesattachements_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`);

--
-- Constraints for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`),
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_2` FOREIGN KEY (`ReportedByID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_3` FOREIGN KEY (`AgainstDownloadID`) REFERENCES `downloads` (`ID`);

--
-- Constraints for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  ADD CONSTRAINT `sellernotesreviews_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`),
  ADD CONSTRAINT `sellernotesreviews_ibfk_2` FOREIGN KEY (`ReviewedByID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `sellernotesreviews_ibfk_3` FOREIGN KEY (`AgainstDownloadsID`) REFERENCES `downloads` (`ID`);

--
-- Constraints for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD CONSTRAINT `userprofile_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`RoleID`) REFERENCES `userroles` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
