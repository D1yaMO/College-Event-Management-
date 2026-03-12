-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 12, 2026 at 06:24 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','faculty','club_admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'trial', 'trial@gmail.com', '$2y$10$DsDB4akUB1i2hOA1pxiRCeFadYhsXKmtzBh4ORdZUEdW8BWn.gujC', 'student'),
(11, 'ca', 'ca@gmail.com', '$2y$10$6Alska4BewpRd21G7/dymuXiyiSTS2rofRvKTSSoT5NgeQPHV4SFq', 'club_admin'),
(4, 'lia', 'lia@gmai.com', '$2y$10$jCU.QDAAQ0KAvev5.g8SQ.4quEGoacnp3k3eT8TG/EQ89fQo5Q6y2', 'student'),
(5, 'ttt', 'tt@gmail.com', '$2y$10$bn99YRd9k6Edd1bxvBQ7ouqsqSDFFl38gkqZ4KH.ajFd/o6CJW2qq', 'student'),
(6, 'anu', 'anu@gmail.com', '$2y$10$UH.gZChbqHKIO89X3v5UUuK.nh6rPGcB78.jTgxg/RTWWtqJATv2C', 'student'),
(9, 'fac', 'fac@gmail.com', '$2y$10$b3sTrxAk1AliQJ.bD4adk.oXHTInoBRQJHnUt5.HoPSkcF4IuCdfS', 'faculty'),
(12, 'trial1', 'trial1@gmail.com', '$2y$10$udUsfb8fBFqQU4dsVnoHlOdCeIZaIY4lmLNPbu7lOrpNyP1nhN16m', 'student'),
(13, 'ruu', 'ruu@gmail.com', '$2y$10$ktbnI6G1C/veht5Twta9ve2dGBfW5vlyq83x.RICGCi5MNEZRSUjm', 'student'),
(14, 'ruu', 'ruu1@gmail.com', '$2y$10$MbfWzEEsbZXOKzz2hmpEwO5f82lv3EzNNZLe8DNkA870.N9NUtBvu', 'student'),
(15, 'pam', 'pam@gmail.com', '$2y$10$NLBDdqO7pcweEM68Y19j4el9zOt5KknGiRtmS8RzEXXof2Pv2JXVO', 'student');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
