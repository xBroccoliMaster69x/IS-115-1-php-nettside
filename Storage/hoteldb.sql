-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2024 at 09:23 PM
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
-- Database: `hoteldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `ID` int(11) NOT NULL,
  `room_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `customer_ID` int(11) NOT NULL,
  `bookingDateBeginning` date NOT NULL,
  `bookingDateEnd` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `ID` int(11) NOT NULL,
  `roomNumber` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `roomType` int(11) NOT NULL,
  `aCapacity` int(11) NOT NULL,
  `cCapacity` int(11) NOT NULL,
  `closeToElevator` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`ID`, `roomNumber`, `floor`, `roomType`, `aCapacity`, `cCapacity`, `closeToElevator`) VALUES
(1, 101, 1, 1, 2, 1, 1),
(2, 102, 1, 1, 2, 1, 1),
(3, 103, 1, 1, 2, 1, 1),
(4, 104, 1, 1, 2, 1, 1),
(5, 105, 1, 1, 2, 1, 1),
(6, 106, 1, 1, 2, 1, 0),
(7, 107, 1, 1, 2, 1, 0)
(8, 108, 1, 1, 2, 1, 0),
(9, 109, 1, 1, 2, 1, 0),
(10, 110, 1, 1, 2, 1, 0),
(11, 201, 2, 1, 2, 1, 1),
(12, 202, 2, 1, 2, 1, 1),
(13, 203, 2, 2, 3, 2, 1),
(14, 204, 2, 2, 3, 2, 1),
(15, 205, 2, 2, 3, 2, 1),
(16, 206, 2, 2, 3, 2, 0),
(17, 207, 2, 2, 3, 2, 0),
(18, 208, 2, 2, 3, 2, 0),
(19, 209, 2, 2, 3, 2, 0),
(20, 210, 2, 2, 3, 2, 0),
(21, 301, 3, 3, 3, 3, 1),
(22, 302, 3, 3, 3, 3, 1),
(23, 303, 3, 3, 3, 3, 1),
(24, 304, 3, 3, 3, 3, 0),
(25, 305, 3, 3, 3, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `roomstatus`
--

CREATE TABLE `roomstatus` (
  `ID` int(11) NOT NULL,
  `room_ID` int(11) NOT NULL,
  `booking_ID` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `fornavn` varchar(20) NOT NULL,
  `etternavn` varchar(20) NOT NULL,
  `mobilnummer` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `adresse` text NOT NULL,
  `brukernavn` varchar(50) NOT NULL,
  `passord` varchar(50) NOT NULL,
  `registreringsdato` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RoomID` (`room_ID`),
  ADD KEY `UserID` (`user_ID`);
--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `roomstatus`
--
ALTER TABLE `roomstatus`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `RoomID` (`room_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roomstatus`
--
ALTER TABLE `roomstatus`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `RoomID` FOREIGN KEY (`room_ID`) REFERENCES `rooms` (`ID`),
  ADD CONSTRAINT `UserID` FOREIGN KEY (`user_ID`) REFERENCES `users` (`ID`);
COMMIT;

--
-- Constraints for table `booking`
--
ALTER TABLE `roomstatus`
  ADD CONSTRAINT `RoomID` FOREIGN KEY (`room_ID`) REFERENCES `rooms` (`ID`);
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
