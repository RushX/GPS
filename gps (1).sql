-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2023 at 10:43 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gps`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth`
--

CREATE TABLE `auth` (
  `uid` bigint(12) NOT NULL,
  `email` varchar(40) NOT NULL,
  `uname` varchar(40) NOT NULL,
  `bid` bigint(40) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auth`
--

INSERT INTO `auth` (`uid`, `email`, `uname`, `bid`, `password`, `type`) VALUES
(1, 'admin@gps.com', 'Admin', 1673170676, '$2y$10$NNufNYeXFcXcVsskuwcUsuPgI4/26FCQK27urRuLTvKEo86aR0xiW', 0),
(1673169985, 'admin2@gps.com', 'Admin', 0, '$2y$10$6zWR0tNV7k3WZ7XIELpScOnulNqk9cVyGWv1JypHPIb0I6FGW5ON.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `bikes`
--

CREATE TABLE `bikes` (
  `bid` bigint(40) NOT NULL,
  `bike_gps_number` varchar(100) NOT NULL,
  `bike_name` varchar(100) NOT NULL,
  `bike_model_number` varchar(50) NOT NULL,
  `insurance_number` varchar(50) NOT NULL,
  `registration_number` bigint(40) NOT NULL,
  `status` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bikes`
--

INSERT INTO `bikes` (`bid`, `bike_gps_number`, `bike_name`, `bike_model_number`, `insurance_number`, `registration_number`, `status`) VALUES
(1673170670, '12', '12', '1212', '12', 12, 3),
(1673170676, '3', '123', '3', '3', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `geo_data`
--

CREATE TABLE `geo_data` (
  `tid` bigint(40) NOT NULL,
  `bid` bigint(40) NOT NULL,
  `createdat` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedat` datetime NOT NULL DEFAULT current_timestamp(),
  `battery` smallint(3) NOT NULL,
  `status` varchar(40) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `route` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`route`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `geo_data`
--

INSERT INTO `geo_data` (`tid`, `bid`, `createdat`, `updatedat`, `battery`, `status`, `latitude`, `longitude`, `route`) VALUES
(1, 1673170676, '2023-01-08 15:12:14', '2023-01-08 15:13:05', 0, '', 0, 0, '{\"source\":{\"latitude\":\"17.332752994009482\",\"longitude\":\"78.42054273935048\",\"address\":\"Pune, Maharashtra\"},\"destination\":{\"latitude\":\"17.383872168640067\",\"longitude\":\"78.5654249414988\",\"address\":\"213\"}}');

--
-- Triggers `geo_data`
--
DELIMITER $$
CREATE TRIGGER `update_bike_status_del` AFTER DELETE ON `geo_data` FOR EACH ROW BEGIN
    UPDATE bikes SET status = 1 WHERE bid = OLD.bid;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_bike_status_ins` AFTER INSERT ON `geo_data` FOR EACH ROW BEGIN
    UPDATE bikes SET status = 0 WHERE bid = NEW.bid;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `geo_history`
--

CREATE TABLE `geo_history` (
  `bid` bigint(40) NOT NULL,
  `bike_name` varchar(100) NOT NULL,
  `trip_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`trip_info`)),
  `trip_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `bikes`
--
ALTER TABLE `bikes`
  ADD PRIMARY KEY (`bid`);

--
-- Indexes for table `geo_data`
--
ALTER TABLE `geo_data`
  ADD PRIMARY KEY (`tid`),
  ADD KEY `bidConst` (`bid`);

--
-- Indexes for table `geo_history`
--
ALTER TABLE `geo_history`
  ADD KEY `bidConst2` (`bid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth`
--
ALTER TABLE `auth`
  MODIFY `uid` bigint(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1673169986;

--
-- AUTO_INCREMENT for table `bikes`
--
ALTER TABLE `bikes`
  MODIFY `bid` bigint(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1673170677;

--
-- AUTO_INCREMENT for table `geo_data`
--
ALTER TABLE `geo_data`
  MODIFY `tid` bigint(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `geo_data`
--
ALTER TABLE `geo_data`
  ADD CONSTRAINT `bidConst` FOREIGN KEY (`bid`) REFERENCES `bikes` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `geo_history`
--
ALTER TABLE `geo_history`
  ADD CONSTRAINT `bidConst2` FOREIGN KEY (`bid`) REFERENCES `bikes` (`bid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
