-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 03, 2017 at 04:04 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookexam`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admid` int(100) NOT NULL,
  `schlname` varchar(200) NOT NULL,
  `admname` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `admemail` varchar(100) NOT NULL,
  `admpass` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `zip` int(100) NOT NULL,
  `about` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admid`, `schlname`, `admname`, `name`, `admemail`, `admpass`, `address`, `city`, `country`, `zip`, `about`) VALUES
(1, 'wmo college muttil', 'sabeelmuttil', 'sabeel km', 'sabeelmuttil@gmail.com', '1f67913d9ee5dbc9986e9684a373fcdf1f65a73ddaa02a88960e8f88d809843c', 'kmk', 'muttil', 'India', 673122, 'im &quot;sabeelmuttil&quot; pls search google then see me'),
(20, '', 'ansar', '', 'ansarbinmuhammed@gmail.com', 'c6489ebc29260274ac206e8d7cffd8c13d90596acaa415ebb1035a5ef1c189ae', '', '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `chemistry`
--

CREATE TABLE `chemistry` (
  `id` int(100) NOT NULL,
  `qid` varchar(100) NOT NULL,
  `qtion` varchar(100) NOT NULL,
  `ans` varchar(100) NOT NULL,
  `ans1` varchar(100) NOT NULL,
  `ans2` varchar(100) NOT NULL,
  `ans3` varchar(100) NOT NULL,
  `ans4` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maths`
--

CREATE TABLE `maths` (
  `id` int(100) NOT NULL,
  `qid` varchar(100) NOT NULL,
  `qtion` varchar(100) NOT NULL,
  `ans` varchar(100) NOT NULL,
  `ans1` varchar(100) NOT NULL,
  `ans2` varchar(100) NOT NULL,
  `ans3` varchar(100) NOT NULL,
  `ans4` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `physics`
--

CREATE TABLE `physics` (
  `id` int(100) NOT NULL,
  `qid` varchar(100) NOT NULL,
  `qtion` varchar(100) NOT NULL,
  `ans` varchar(100) NOT NULL,
  `ans1` varchar(100) NOT NULL,
  `ans2` varchar(100) NOT NULL,
  `ans3` varchar(100) NOT NULL,
  `ans4` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE `social` (
  `id` int(100) NOT NULL,
  `qid` varchar(100) NOT NULL,
  `qtion` varchar(100) NOT NULL,
  `ans` varchar(100) NOT NULL,
  `ans1` varchar(100) NOT NULL,
  `ans2` varchar(100) NOT NULL,
  `ans3` varchar(100) NOT NULL,
  `ans4` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(100) NOT NULL,
  `subname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subname`) VALUES
(1, 'physics'),
(2, 'maths'),
(3, 'chemistry'),
(4, 'test'),
(5, 'social');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(100) NOT NULL,
  `qid` varchar(100) NOT NULL,
  `qtion` varchar(100) NOT NULL,
  `ans` varchar(100) NOT NULL,
  `ans1` varchar(100) NOT NULL,
  `ans2` varchar(100) NOT NULL,
  `ans3` varchar(100) NOT NULL,
  `ans4` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `qid`, `qtion`, `ans`, `ans1`, `ans2`, `ans3`, `ans4`) VALUES
(11, 'sh', 'r', 'th', 'tha', 'th', 't', 'th'),
(11, 'sh', 'r', 'th', 'tha', 'th', 't', 'th'),
(12, 'sgd1', 'dvdngnhn', '1', 'nhhhnh', 'hnrnhr', 'nrhhn', 'hrghg'),
(0, 'q111', 'hdhfhgf', '2', 'ccbjkfvbfd', 'kjjjf', 'jhdsfh', 'hghd');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admid`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admid` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
