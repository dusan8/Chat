-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2020 at 11:24 PM
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
-- Database: `chatbox`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `banned` int(1) NOT NULL DEFAULT 0,
  `admin` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `banned`, `admin`) VALUES
(56, 'dule', '1', 0, 1),
(57, 'test', '1', 0, 0),
(58, 'a', '1', 0, 0),
(62, 'testt', '1', 0, 0),
(63, 'dsadsad', '1', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) NOT NULL,
  `username` varchar(40) NOT NULL,
  `msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `username`, `msg`) VALUES
(126, 'dule', 'test'),
(130, 'dule', 'dsadsadsada'),
(131, 'dule', 'dsadsadsadaasdsadas'),
(132, 'dule', 'dsadsadsadaasdsadas'),
(133, 'dule', 'dsadsadsadaasdsadas'),
(134, 'dule', 'dsadsadsadaasdsadas'),
(135, 'dule', 'dsadsadsadaasdsadas');

-- --------------------------------------------------------

--
-- Table structure for table `personalinfo`
--

CREATE TABLE `personalinfo` (
  `id` int(100) NOT NULL,
  `username` varchar(25) NOT NULL,
  `name` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `email` varchar(25) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `city` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personalinfo`
--

INSERT INTO `personalinfo` (`id`, `username`, `name`, `lastname`, `email`, `age`, `gender`, `city`) VALUES
(58, 'a', 'a', 'a', 'not set', 0, 'not set', 'not set'),
(63, 'dsadsad', 'dsadsa', 'dsadsad', 'not set', 0, 'not set', 'not set'),
(56, 'dule', 'Dusan', 'Martinovic', 'not set', 0, 'not set', 'not set'),
(57, 'test', 't', 't', 'not set', 0, 'not set', 'not set'),
(62, 'testt', 't', 't', 'not set', 0, 'not set', 'not set');

-- --------------------------------------------------------

--
-- Table structure for table `userip`
--

CREATE TABLE `userip` (
  `id` int(11) NOT NULL,
  `ipaddress` varchar(20) DEFAULT NULL,
  `banned` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userip`
--

INSERT INTO `userip` (`id`, `ipaddress`, `banned`) VALUES
(1439, '::1', 0),
(1440, '::1', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personalinfo`
--
ALTER TABLE `personalinfo`
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `userip`
--
ALTER TABLE `userip`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `userip`
--
ALTER TABLE `userip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1441;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
