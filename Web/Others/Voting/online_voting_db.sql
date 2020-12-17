-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 16, 2020 at 03:58 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_voting_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate_data_tb`
--

CREATE TABLE `candidate_data_tb` (
  `id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `partylist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `candidate_tb`
--

CREATE TABLE `candidate_tb` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `year_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `partylist_tb`
--

CREATE TABLE `partylist_tb` (
  `id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `partylist` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `position_tb`
--

CREATE TABLE `position_tb` (
  `id` int(11) NOT NULL,
  `priority` int(11) DEFAULT 999999999,
  `position` varchar(50) NOT NULL,
  `filter_by_year` tinyint(1) NOT NULL DEFAULT 0,
  `number_of_candidates` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `system_tb`
--

CREATE TABLE `system_tb` (
  `id` int(11) NOT NULL,
  `action` text NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_tb`
--

INSERT INTO `system_tb` (`id`, `action`, `value`) VALUES
(2, 'system', 'true'),
(3, 'system-pwd', 'aEzaKME');

-- --------------------------------------------------------

--
-- Table structure for table `votes_tb`
--

CREATE TABLE `votes_tb` (
  `id` int(11) NOT NULL,
  `voter_id_number` int(11) NOT NULL,
  `candidate_data_id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate_data_tb`
--
ALTER TABLE `candidate_data_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_tb`
--
ALTER TABLE `candidate_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partylist_tb`
--
ALTER TABLE `partylist_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_tb`
--
ALTER TABLE `position_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_tb`
--
ALTER TABLE `system_tb`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `votes_tb`
--
ALTER TABLE `votes_tb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate_data_tb`
--
ALTER TABLE `candidate_data_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `candidate_tb`
--
ALTER TABLE `candidate_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `partylist_tb`
--
ALTER TABLE `partylist_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `position_tb`
--
ALTER TABLE `position_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `system_tb`
--
ALTER TABLE `system_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `votes_tb`
--
ALTER TABLE `votes_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
