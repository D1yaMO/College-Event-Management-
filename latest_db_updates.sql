-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 20, 2026 at 09:50 AM
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
-- Table structure for table `equipment_requests`
--

DROP TABLE IF EXISTS `equipment_requests`;
CREATE TABLE IF NOT EXISTS `equipment_requests` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_name` varchar(255) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `notes` text,
  `requested_by` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `equipment_requests`
--

INSERT INTO `equipment_requests` (`id`, `event_name`, `item_name`, `quantity`, `notes`, `requested_by`, `status`, `created_at`) VALUES
(1, 'Test Event 1', 'Speakers', 3, 'extra cables ', 'Diya', 'pending', '2026-04-20 09:12:53');

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

DROP TABLE IF EXISTS `queries`;
CREATE TABLE IF NOT EXISTS `queries` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_name` varchar(100) DEFAULT NULL,
  `sender_role` varchar(50) DEFAULT NULL,
  `message` text,
  `reply` text,
  `status` varchar(20) DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrations`
--

DROP TABLE IF EXISTS `registrations`;
CREATE TABLE IF NOT EXISTS `registrations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_id` int NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `student_email` varchar(255) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `registered_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
