-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2018 at 03:13 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `privellage` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`, `created_by`, `active`, `privellage`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2018-12-11 20:24:57', 1, 1, '{\"ads\":{\"open\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\",\"comments\":\"1\",\"approve\":\"1\"},\"admins\":{\"open\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\"},\"report\":{\"open\":\"1\"}}'),
(2, 'ahmed', 'e10adc3949ba59abbe56e057f20f883e', '2018-12-11 20:24:57', 1, 1, '{\"ads\":{\"open\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"1\",\"comments\":\"1\",\"approve\":\"0\"},\"admins\":{\"open\":\"1\",\"add\":\"1\",\"edit\":\"1\",\"delete\":\"0\"},\"report\":{\"open\":\"1\"}}');

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `image`, `description`, `created_at`, `created_by`) VALUES
(8, 'Hydrangeas.jpg', 'test 1', '2018-12-17 22:00:00', 11),
(9, 'Lighthouse.jpg', 'test2', '2018-12-12 00:28:03', 0),
(10, 'Koala.jpg', 'test 3', '2018-12-12 00:37:45', 0),
(11, 'Hydrangeas.jpg', 'tst 4', '2018-12-12 00:38:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `ads_id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` varchar(500) NOT NULL,
  `approve` tinyint(1) NOT NULL,
  `approved_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=ucs2;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `ads_id`, `username`, `created_at`, `comment`, `approve`, `approved_by`) VALUES
(1, 8, 'mahmoud', '2018-12-10 21:44:00', 'test', 1, 1),
(2, 8, 'mahmoud', '2018-12-10 21:44:05', 'test', 0, 1),
(3, 8, 'masa', '2018-12-11 00:18:46', 'eifijdijeif', 0, 0),
(4, 8, 'masa', '2018-12-11 00:20:54', 'eifijdijeif', 0, 0),
(5, 8, 'masa', '2018-12-11 00:21:33', 'eifijdijeif', 0, 0),
(6, 8, 'masa', '2018-12-11 00:21:34', 'eifijdijeif', 0, 0),
(7, 8, 'masa', '2018-12-11 00:22:16', 'eifijdijeif', 0, 0),
(8, 8, 'Mahmoud Ramadan', '2018-12-11 00:26:40', 'nirigvjioerjijrijiorjobjiobiojgioerioioer', 0, 0),
(9, 8, 'Mahmoud Ramadan', '2018-12-11 00:29:23', 'nirigvjioerjijrijiorjobjiobiojgioerioioer', 0, 0),
(10, 8, 'Mahmoud Ramadan', '2018-12-11 00:29:25', 'nirigvjioerjijrijiorjobjiobiojgioerioioer', 0, 0),
(11, 8, 'Mahmoud Ramadan', '2018-12-11 00:29:34', 'jijiijijijiji irw fi rfirjiwjio', 0, 0),
(12, 8, 'Mahmoud Ramadan', '2018-12-11 00:30:04', 'ierjgioeio ire ieri eri vioerjvi reiv ierjv ', 0, 0),
(13, 8, 'Mahmoud Ramadan', '2018-12-11 00:30:06', 'ierjgioeio ire ieri eri vioerjvi reiv ierjv ', 0, 0),
(14, 8, 'Mahmoud Ramadan', '2018-12-11 00:30:17', 'ierjgioeio ire ieri eri vioerjvi reiv ierjv ', 0, 0),
(15, 8, 'Mahmoud Ramadan', '2018-12-11 00:30:18', 'ierjgioeio ire ieri eri vioerjvi reiv ierjv ', 0, 0),
(16, 8, 'Mahmoud Ramadan', '2018-12-11 00:31:11', 'iejioj  gierigjirej ioerj erio ', 0, 0),
(17, 8, 'Mahmoud Ramadan', '2018-12-11 00:31:13', 'iejioj  gierigjirej ioerj erio ', 0, 0),
(18, 8, 'Mahmoud Ramadan', '2018-12-11 00:31:14', 'iejioj  gierigjirej ioerj erio ', 0, 0),
(19, 8, 'Mahmoud Ramadan', '2018-12-11 00:31:37', 'jjijifj ei wiefj iewjf weifj ewij iewjifewiofj iejfiejifj ', 0, 0),
(20, 8, 'Mahmoud Ramadan', '2018-12-11 00:32:02', 'ijjiijijiiokoookokokooko', 0, 0),
(21, 8, 'Mahmoud Ramadan', '2018-12-11 00:32:38', 'iiojivji rfi erigji erireij erij vierji', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
