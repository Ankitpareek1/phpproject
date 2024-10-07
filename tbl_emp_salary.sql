-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2024 at 09:04 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `interview_db_fy`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_emp_salary`
--

CREATE TABLE `tbl_emp_salary` (
  `salaryId` int(11) NOT NULL,
  `empId` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `fromDate` date NOT NULL,
  `toDate` date DEFAULT NULL,
  `designationId` int(11) DEFAULT NULL,
  `dateTimeAdded` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateTimeModified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_emp_salary`
--

INSERT INTO `tbl_emp_salary` (`salaryId`, `empId`, `amount`, `fromDate`, `toDate`, `designationId`, `dateTimeAdded`, `dateTimeModified`, `status`) VALUES
(0, 1, 21000, '2024-09-01', '2024-09-30', 1, '2024-10-07 06:49:03', '2024-10-07 06:49:03', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
