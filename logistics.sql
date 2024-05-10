-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2024 at 01:28 PM
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
-- Database: `logistics`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `branchID` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `branchPhoneNumber` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branchID`, `name`, `address`, `branchPhoneNumber`) VALUES
(1, 'North Dagon', 'Pin lone Road, No(712)', '09253598042'),
(2, 'South Dagon', 'Si Pin Road', '095257523'),
(4, 'Okklapa', 'ThitSar Road', '09586558445'),
(5, 'Hlaing', 'Than Lan', '018599557');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `jobID` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `hazardous` tinyint(1) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `jobVehicleID` int(11) DEFAULT NULL,
  `originBranchID` int(11) DEFAULT NULL,
  `destinationBranchID` int(11) DEFAULT NULL,
  `status` enum('completed','in progress') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`jobID`, `quantity`, `weight`, `size`, `hazardous`, `startDate`, `deadline`, `jobVehicleID`, `originBranchID`, `destinationBranchID`, `status`) VALUES
(1, 2, 20, 2, 0, '2024-05-08', '2024-05-09', 2, 1, 2, 'in progress'),
(2, 1, 2, 2, 0, '2024-05-01', '2024-05-02', 3, 1, 2, 'completed'),
(3, 10, 20, 5, 0, '0000-00-00', '0000-00-00', 5, 4, 2, 'in progress'),
(4, 8, 20, 32, 0, '2024-05-02', '2024-05-08', 3, 1, 5, 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `username`, `password`) VALUES
(3, 'shaung', 'shaung'),
(4, 'shaung', 'paung'),
(5, 'shaung', 'paung'),
(6, 'shaung', 'paung'),
(7, 'shuang', 'shaung');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicleID` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `maximumCarryingWeight` int(11) DEFAULT NULL,
  `maximumAvailableSpace` int(11) DEFAULT NULL,
  `homeBranchID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicleID`, `type`, `maximumCarryingWeight`, `maximumAvailableSpace`, `homeBranchID`) VALUES
(2, 'Vans', 23, 20, 1),
(3, 'Turck', 23, 20, 2),
(5, '4wheels truck', 150, 130, 4),
(6, 'Vans', 45, 38, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branchID`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`jobID`),
  ADD KEY `jobVehicleID` (`jobVehicleID`),
  ADD KEY `originBranchID` (`originBranchID`),
  ADD KEY `destinationBranchID` (`destinationBranchID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicleID`),
  ADD KEY `homeBranchID` (`homeBranchID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `jobID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jobs`
--
ALTER TABLE `jobs`
  ADD CONSTRAINT `jobs_ibfk_1` FOREIGN KEY (`jobVehicleID`) REFERENCES `vehicles` (`vehicleID`),
  ADD CONSTRAINT `jobs_ibfk_2` FOREIGN KEY (`originBranchID`) REFERENCES `branches` (`branchID`),
  ADD CONSTRAINT `jobs_ibfk_3` FOREIGN KEY (`destinationBranchID`) REFERENCES `branches` (`branchID`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`homeBranchID`) REFERENCES `branches` (`branchID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
