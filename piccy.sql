-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 28, 2019 at 11:57 PM
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

DROP TABLE IF EXISTS `Comment`;
CREATE TABLE `Comment` (
  `CommentID` int(10) UNSIGNED NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `PictureID` int(10) UNSIGNED NOT NULL,
  `Content` varchar(255) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Comment`
--

INSERT INTO `Comment` (`CommentID`, `UserID`, `PictureID`, `Content`, `CreatedAt`) VALUES
(41, 3, 18, '🤩', '2019-12-28 23:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `Country`
--

DROP TABLE IF EXISTS `Country`;
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

DROP TABLE IF EXISTS `EmailVerification`;
CREATE TABLE `EmailVerification` (
  `EmailVerificationID` char(64) COLLATE utf8_bin NOT NULL COMMENT 'SHA256 Hash',
  `UserID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Follow`
--

DROP TABLE IF EXISTS `Follow`;
CREATE TABLE `Follow` (
  `FollowerUserID` int(10) UNSIGNED NOT NULL,
  `FollowedUserID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Follow`
--

INSERT INTO `Follow` (`FollowerUserID`, `FollowedUserID`) VALUES
(2, 3),
(3, 2),
(3, 4),
(3, 5),
(3, 6),
(3, 7),
(4, 3),
(5, 2),
(5, 6),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 7),
(7, 2),
(7, 3),
(7, 4),
(7, 5),
(7, 6);

-- --------------------------------------------------------

--
-- Table structure for table `PasswordChangeRequest`
--

DROP TABLE IF EXISTS `PasswordChangeRequest`;
CREATE TABLE `PasswordChangeRequest` (
  `PasswordChangeRequestID` char(64) COLLATE utf8_bin NOT NULL COMMENT 'SHA256 Hash',
  `UserID` int(11) UNSIGNED NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
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

DROP TABLE IF EXISTS `Picture`;
CREATE TABLE `Picture` (
  `PictureID` int(10) UNSIGNED NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `PicturePath` varchar(255) COLLATE utf8_bin NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `Description` varchar(255) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `AllowComments` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Picture`
--

INSERT INTO `Picture` (`PictureID`, `UserID`, `PicturePath`, `CreatedAt`, `Description`, `AllowComments`) VALUES
(6, 2, 'user_pictures/user_Newa/6', '2019-12-28 22:22:59', '', 1),
(7, 4, 'user_pictures/user_Random/7', '2019-12-28 22:58:23', '', 1),
(9, 3, 'user_pictures/user_wesso/9', '2019-12-28 23:18:47', 'Braaad', 1),
(11, 3, 'user_pictures/user_wesso/11', '2019-12-28 23:19:18', '', 1),
(14, 6, 'user_pictures/user_Abdo/14', '2019-12-28 23:27:50', '', 1),
(15, 7, 'user_pictures/user_Marawan/15', '2019-12-28 23:41:28', '', 1),
(16, 7, 'user_pictures/user_Marawan/16', '2019-12-28 23:43:41', '', 1),
(17, 7, 'user_pictures/user_Marawan/17', '2019-12-28 23:44:24', '', 1),
(18, 7, 'user_pictures/user_Marawan/18', '2019-12-28 23:44:49', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Reaction`
--

DROP TABLE IF EXISTS `Reaction`;
CREATE TABLE `Reaction` (
  `ReactionID` int(10) UNSIGNED NOT NULL,
  `UserID` int(10) UNSIGNED NOT NULL,
  `PictureID` int(10) UNSIGNED NOT NULL,
  `Type` enum('UPVOTE','DOWNVOTE') COLLATE utf8_bin NOT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `Reaction`
--

INSERT INTO `Reaction` (`ReactionID`, `UserID`, `PictureID`, `Type`, `CreatedAt`) VALUES
(14, 3, 4, 'UPVOTE', '2019-12-28 22:26:53'),
(23, 2, 4, 'UPVOTE', '2019-12-28 22:28:11'),
(92, 2, 5, 'UPVOTE', '2019-12-28 22:43:05'),
(95, 3, 5, 'DOWNVOTE', '2019-12-28 22:55:16'),
(98, 4, 7, 'UPVOTE', '2019-12-28 22:58:36'),
(99, 4, 5, 'DOWNVOTE', '2019-12-28 23:00:47'),
(105, 5, 8, 'UPVOTE', '2019-12-28 23:15:59'),
(106, 5, 13, 'UPVOTE', '2019-12-28 23:20:54'),
(108, 3, 7, 'UPVOTE', '2019-12-28 23:24:08'),
(113, 6, 11, 'UPVOTE', '2019-12-28 23:32:10'),
(114, 6, 9, 'UPVOTE', '2019-12-28 23:32:12'),
(118, 7, 11, 'UPVOTE', '2019-12-28 23:33:18'),
(120, 5, 14, 'DOWNVOTE', '2019-12-28 23:34:31'),
(121, 6, 7, 'DOWNVOTE', '2019-12-28 23:40:12'),
(123, 6, 6, 'UPVOTE', '2019-12-28 23:40:17'),
(124, 3, 14, 'UPVOTE', '2019-12-28 23:44:34'),
(125, 7, 14, 'UPVOTE', '2019-12-28 23:47:06'),
(126, 7, 9, 'UPVOTE', '2019-12-28 23:48:59'),
(127, 7, 6, 'UPVOTE', '2019-12-28 23:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE `User` (
  `UserID` int(10) UNSIGNED NOT NULL,
  `Username` varchar(50) COLLATE utf8_bin NOT NULL,
  `Password` char(60) COLLATE utf8_bin NOT NULL COMMENT 'BCRYPT Hash',
  `CountryID` int(10) UNSIGNED NOT NULL,
  `Email` varchar(254) COLLATE utf8_bin NOT NULL,
  `Bio` text CHARACTER SET utf16 COLLATE utf16_bin DEFAULT NULL,
  `ProfilePicturePath` varchar(255) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`UserID`, `Username`, `Password`, `CountryID`, `Email`, `Bio`, `ProfilePicturePath`) VALUES
(2, 'Newa', '$2y$10$ba6enA7Fn1iP2m9JOiGzv.UeMAD0xJMO5pP2w/nOtf2b.MoVwz0Y.', 1, 'Emaio@yahoo.com', '䅡', NULL),
(3, 'wesso', '$2y$10$eO.ZIkTINTX8tA0Cz6qcu.f5AfWBM6/dGeLdWkV18VayRAkotw1ce', 1, 'Ahmed.wessam.1999@gmail.com', '䕤楴慢汥', NULL),
(4, 'Random', '$2y$10$rqckUhkubJAm0SsNVsOF9uUIKiflBcfOVdikIgEeRqIEJyM1hdt0K', 1, 'Bad@boy.com', 'K歫歫', NULL),
(5, 'spot', '$2y$10$7jgx1wXhoFRR0oJisBNVPue3mAggVuSNW8LRgLKeG93IAbiY/P6P2', 1, 'okhaled9@gmail.com', '扯', NULL),
(6, 'Abdo', '$2y$10$TfQbjDiyDOqPLhb33BqoGO4pknjv/oRaWHbzTB5TeEYGjBkpsPFsm', 1, 'abduelabied2221@gmail.com', '', NULL),
(7, 'Marawan', '$2y$10$E7fzn3g21PNZfhZbG6EYGuLonWJpDeFRP1ZIm3g5tGzy2t7xNrjL6', 1, 'Marawan.wesam@gmail.com', '', NULL);

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
  MODIFY `CommentID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `Country`
--
ALTER TABLE `Country`
  MODIFY `CountryID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Picture`
--
ALTER TABLE `Picture`
  MODIFY `PictureID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `Reaction`
--
ALTER TABLE `Reaction`
  MODIFY `ReactionID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `UserID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- Constraints for table `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `User-CountryID-FK` FOREIGN KEY (`CountryID`) REFERENCES `Country` (`CountryID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
