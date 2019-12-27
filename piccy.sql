-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 27, 2019 at 06:36 PM
-- Server version: 5.7.28-0ubuntu0.18.04.4
-- PHP Version: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE `Comment` (
  `CommentID` int(10) UNSIGNED NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `PictureID` int(10) UNSIGNED NOT NULL,
  `Content` varchar(255) COLLATE utf8_bin NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Country`
--

CREATE TABLE `Country` (
  `CountryID` int(10) UNSIGNED NOT NULL,
  `CountryName` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

CREATE TABLE `EmailVerification` (
  `EmailVerificationID` char(64) COLLATE utf8_bin NOT NULL COMMENT 'SHA256 Hash',
  `UserID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Follow`
--

CREATE TABLE `Follow` (
  `FollowerUserID` int(10) UNSIGNED NOT NULL,
  `FollowedUserID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `PasswordChangeRequest`
--

CREATE TABLE `PasswordChangeRequest` (
  `PasswordChangeRequestID` char(64) COLLATE utf8_bin NOT NULL COMMENT 'SHA256 Hash',
  `UserID` int(11) UNSIGNED NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `PasswordChangeRequest`
--

INSERT INTO `PasswordChangeRequest` (`PasswordChangeRequestID`, `UserID`, `CreatedAt`) VALUES
('321321321', 1, '2019-12-26 22:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Picture`
--

CREATE TABLE `Picture` (
  `PictureID` int(10) UNSIGNED NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `PicturePath` varchar(255) COLLATE utf8_bin NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Description` varchar(255) COLLATE utf8_bin NOT NULL,
  `AllowComments` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Picture`
--

INSERT INTO `Picture` (`PictureID`, `UserID`, `PicturePath`, `CreatedAt`, `Description`, `AllowComments`) VALUES
(2, 2, 'new directoy', '2019-12-27 15:01:11', 'newewewew', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Reaction`
--

CREATE TABLE `Reaction` (
  `ReactionID` int(10) UNSIGNED NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `PictureID` int(10) UNSIGNED NOT NULL,
  `Type` enum('UPVOTE','DOWNVOTE') COLLATE utf8_bin NOT NULL,
  `CreatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `UserID` int(10) UNSIGNED NOT NULL,
  `Username` varchar(50) COLLATE utf8_bin NOT NULL,
  `Password` char(60) COLLATE utf8_bin NOT NULL COMMENT 'BCRYPT Hash',
  `CountryID` int(10) UNSIGNED NOT NULL,
  `Email` varchar(254) COLLATE utf8_bin NOT NULL,
  `Bio` text COLLATE utf8_bin,
  `ProfilePicturePath` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UserID`, `Username`, `Password`, `CountryID`, `Email`, `Bio`, `ProfilePicturePath`) VALUES
(1, 'ahmad', '$2y$10$sfst9/70VG5rthe1AEUASunWodv6wXO56M4mRQ2yOaBp80XwzMxPO', 1, 'ahmad@protonmail', 'boy', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Comment`
--
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `Comment-UserID-FK` (`UserID`),
  ADD KEY `Comment-PictureID-FK` (`PictureID`);

--
-- Indexes for table `Country`
--
ALTER TABLE `Country`
  ADD PRIMARY KEY (`CountryID`);

--
-- Indexes for table `EmailVerification`
--
ALTER TABLE `EmailVerification`
  ADD PRIMARY KEY (`EmailVerificationID`),
  ADD KEY `EmailVerfication-UserID-FK` (`UserID`);

--
-- Indexes for table `Follow`
--
ALTER TABLE `Follow`
  ADD PRIMARY KEY (`FollowerUserID`,`FollowedUserID`),
  ADD KEY `Follow-FollowerUserID-FK` (`FollowerUserID`),
  ADD KEY `Follow-FollowedUserID-FK` (`FollowedUserID`);

--
-- Indexes for table `PasswordChangeRequest`
--
ALTER TABLE `PasswordChangeRequest`
  ADD PRIMARY KEY (`PasswordChangeRequestID`),
  ADD KEY `PasswordChageRequest-UserID-FK` (`UserID`);

--
-- Indexes for table `Picture`
--
ALTER TABLE `Picture`
  ADD PRIMARY KEY (`PictureID`),
  ADD KEY `Picture-UserID-FK` (`UserID`);

--
-- Indexes for table `Reaction`
--
ALTER TABLE `Reaction`
  ADD PRIMARY KEY (`ReactionID`),
  ADD KEY `Reaction-UserID-FK` (`UserID`),
  ADD KEY `Reaction-PictureID-FK` (`PictureID`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `User-CountryID-FK` (`CountryID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `CommentID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `Country`
--
ALTER TABLE `Country`
  MODIFY `CountryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `Picture`
--
ALTER TABLE `Picture`
  MODIFY `PictureID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `Reaction`
--
ALTER TABLE `Reaction`
  MODIFY `ReactionID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `UserID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment-PictureID-FK` FOREIGN KEY (`PictureID`) REFERENCES `Picture` (`PictureID`) ON DELETE CASCADE ON UPDATE CASCADE;

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
