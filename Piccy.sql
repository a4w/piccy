-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 26, 2019 at 07:56 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Piccy`
--

-- --------------------------------------------------------

--
-- Table structure for table `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `CommentID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `UserID` int(10) UNSIGNED NOT NULL,
  `PictureID` int(10) UNSIGNED NOT NULL,
  `Content` varchar(255) COLLATE utf8_bin NOT NULL,
  `CreatedAt` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`CommentID`),
  KEY `Comment-UserID-FK` (`UserID`),
  KEY `Comment-PictureID-FK` (`PictureID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Country`
--

CREATE TABLE IF NOT EXISTS `Country` (
  `CountryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `CountryName` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`CountryID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Country`
--

INSERT INTO `Country` (`CountryID`, `CountryName`) VALUES
(1, 'Egypt'),
(2, 'United Kingdom'),
(3, 'United States'),
(4, 'United Arab Emirates'),
(5, 'Netherlands'),
(6, 'Georgia'),
(7, 'Sweden'),
(8, 'Switherland'),
(9, 'Germany'),
(10, 'France'),
(11, 'Hungary'),
(12, 'Greece');

-- --------------------------------------------------------

--
-- Table structure for table `EmailVerification`
--

CREATE TABLE IF NOT EXISTS `EmailVerification` (
  `EmailVerificationID` char(64) COLLATE utf8_bin NOT NULL COMMENT 'SHA256 Hash',
  `UserID` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`EmailVerificationID`),
  KEY `EmailVerfication-UserID-FK` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Follow`
--

CREATE TABLE IF NOT EXISTS `Follow` (
  `FollowID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `FollowerUserID` int(10) UNSIGNED NOT NULL,
  `FollowedUserID` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`FollowID`),
  KEY `Follow-FollowerUserID-FK` (`FollowerUserID`),
  KEY `Follow-FollowedUserID-FK` (`FollowedUserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `PasswordChangeRequest`
--

CREATE TABLE IF NOT EXISTS `PasswordChangeRequest` (
  `PasswordChangeRequestID` char(64) COLLATE utf8_bin NOT NULL COMMENT 'SHA256 Hash',
  `UserID` int(11) UNSIGNED NOT NULL,
  `CreatedAt` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`PasswordChangeRequestID`),
  KEY `PasswordChageRequest-UserID-FK` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Picture`
--

CREATE TABLE IF NOT EXISTS `Picture` (
  `PictureID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `UserID` int(10) UNSIGNED NOT NULL,
  `PicturePath` varchar(255) COLLATE utf8_bin NOT NULL,
  `CreatedAt` timestamp NULL DEFAULT current_timestamp(),
  `Description` varchar(255) COLLATE utf8_bin NOT NULL,
  `AllowComments` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`PictureID`),
  KEY `Picture-UserID-FK` (`UserID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Reaction`
--

CREATE TABLE IF NOT EXISTS `Reaction` (
  `ReactionID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `UserID` int(10) UNSIGNED NOT NULL,
  `PictureID` int(10) UNSIGNED NOT NULL,
  `Type` enum('UPVOTE','DOWNVOTE') COLLATE utf8_bin NOT NULL,
  `CreatedAt` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ReactionID`),
  KEY `Reaction-UserID-FK` (`UserID`),
  KEY `Reaction-PictureID-FK` (`PictureID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `UserID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) COLLATE utf8_bin NOT NULL,
  `Password` char(60) COLLATE utf8_bin NOT NULL COMMENT 'BCRYPT Hash',
  `CountryID` int(10) UNSIGNED NOT NULL,
  `Email` varchar(254) COLLATE utf8_bin NOT NULL,
  `Bio` text COLLATE utf8_bin DEFAULT NULL,
  `ProfilePicturePath` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`UserID`),
  UNIQUE KEY `Email` (`Email`),
  KEY `User-CountryID-FK` (`CountryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment-PictureID-FK` FOREIGN KEY (`PictureID`) REFERENCES `Picture` (`PictureID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Comment-UserID-FK` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `EmailVerification`
--
ALTER TABLE `EmailVerification`
  ADD CONSTRAINT `EmailVerfication-UserID-FK` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Follow`
--
ALTER TABLE `Follow`
  ADD CONSTRAINT `Follow-FollowedUserID-FK` FOREIGN KEY (`FollowedUserID`) REFERENCES `User` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Follow-FollowerUserID-FK` FOREIGN KEY (`FollowerUserID`) REFERENCES `User` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `PasswordChangeRequest`
--
ALTER TABLE `PasswordChangeRequest`
  ADD CONSTRAINT `PasswordChageRequest-UserID-FK` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Picture`
--
ALTER TABLE `Picture`
  ADD CONSTRAINT `Picture-UserID-FK` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Reaction`
--
ALTER TABLE `Reaction`
  ADD CONSTRAINT `Reaction-PictureID-FK` FOREIGN KEY (`PictureID`) REFERENCES `Picture` (`PictureID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Reaction-UserID-FK` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `User-CountryID-FK` FOREIGN KEY (`CountryID`) REFERENCES `Country` (`CountryID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
