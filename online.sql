-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 04:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webherbal`
--

-- --------------------------------------------------------

--
-- Table structure for table `online`
--

CREATE TABLE `online` (
  `Name` text NOT NULL,
  `Email` varchar(40) NOT NULL,
  `PlantName` text NOT NULL,
  `Price` varchar(10) NOT NULL,
  `Adress` varchar(25) NOT NULL,
  `Contact` varchar(12) NOT NULL,
  `Upi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `online`
--

INSERT INTO `online` (`Name`, `Email`, `PlantName`, `Price`, `Adress`, `Contact`, `Upi`) VALUES
('prince verma', 'deepansuverma123@gmail.com', 'Mint', '199', 'kanpur ,naubasta 199', '5674564748', '123456789876'),
('pranjal sharma', 'pranjal123@gmail.com', 'Mint', '500', 'shuklaganj', '6388108590', '467704968215'),
('pranjal', 'pranjal123@gmail.com', 'Basil', '200', 'unnao 199 ', '7233840567', '123456789012');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
