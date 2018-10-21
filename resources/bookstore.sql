-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 17, 2018 at 12:48 PM
-- Server version: 5.7.20
-- PHP Version: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--
CREATE DATABASE IF NOT EXISTS `bookstore` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bookstore`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `username` varchar(32) NOT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`username`, `gender`, `password`, `name`) VALUES
('apple', 'male', '$2y$10$5R5QAN/bOSz0/ARxAzB/meUnjC9PVMHBoMbGp.O1PgXiOxQSarAZu', 'Apple TAN'),
('orange', 'female', '$2y$10$sxy4yfGsVZER6rylbaMaI.rGubMg/ituRBaJ3vY..eSRakPsS74VC', 'Orange TAN'),
('pear', 'male', '$2y$10$DpCQXba9AwA086Et7yAq.Ok9ihHy1uNvawvb3bvdTMw26nyS0JLae', 'Pear TAN');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `title` varchar(64) NOT NULL,
  `isbn13` char(13) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `availability` int(11) DEFAULT NULL,
  `dsfs` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`title`, `isbn13`, `price`, `availability`, `dsfs`) VALUES
('SQL in Nutshell', '9781129474251', '21.50', 2, NULL),
('Understanding People', '9781349471231', '99.40', 25, NULL),
('Happy in Workplace', '9781434474234', '94.00', 1, NULL),
('PHP Soup', '9781442374221', '20.50', 2, NULL),
('Brief History of Time', '9781449474211', '20.00', 23, NULL),
('It', '9781449474212', '1.00', 2, NULL),
('Founder of Php', '9781449474221', '34.00', 1, NULL),
('Albert Enstein\'s Works', '9781449474223', '18.00', 7, NULL),
('Interstellar', '9781449474254', '10.00', 4, NULL),
('Milk and Honey', '9781449474256', '25.00', 18, NULL),
('Cooking Book', '9781449474323', '99.90', 4, NULL),
('The Gathering', '9781449474342', '20.00', 50, NULL),
('Tale of Zelda', '9781449474453', '33.40', 21, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`isbn13`);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
CREATE DATABASE IF NOT EXISTS `bookstore2` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bookstore2`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `username` varchar(32) NOT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`username`, `gender`, `password`, `name`) VALUES
('apple', 'male', '$2y$10$5R5QAN/bOSz0/ARxAzB/meUnjC9PVMHBoMbGp.O1PgXiOxQSarAZu', 'Apple TAN'),
('orange', 'female', '$2y$10$sxy4yfGsVZER6rylbaMaI.rGubMg/ituRBaJ3vY..eSRakPsS74VC', 'Orange TAN'),
('pear', 'male', '$2y$10$DpCQXba9AwA086Et7yAq.Ok9ihHy1uNvawvb3bvdTMw26nyS0JLae', 'Pear TAN');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `title` varchar(64) NOT NULL,
  `isbn13` char(13) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `availability` int(11) DEFAULT NULL,
  `dsfs` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`title`, `isbn13`, `price`, `availability`, `dsfs`) VALUES
('SQL in Nutshell', '9781129474251', '2.50', 20, NULL),
('Understanding People', '9781349471231', '9.40', 250, NULL),
('Happy in Workplace', '9781434474234', '9.00', 10, NULL),
('PHP Soup', '9781442374221', '20.50', 20, NULL),
('Brief History of Time', '9781449474211', '2.00', 230, NULL),
('It', '9781449474212', '1.00', 2, NULL),
('Founder of Php', '9781449474221', '3.00', 1, NULL),
('Albert Enstein\'s Works', '9781449474223', '1.00', 70, NULL),
('Interstellar', '9781449474254', '2.00', 4, NULL),
('Milk and Honey', '9781449474256', '2.00', 180, NULL),
('Cooking Book', '9781449474323', '80.90', 40, NULL),
('The Gathering', '9781449474342', '2.00', 500, NULL),
('Tale of Zelda', '9781449474453', '3.40', 210, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`isbn13`);

CREATE DATABASE IF NOT EXISTS `bookstore3` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bookstore3`;

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `username` varchar(32) NOT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`username`, `gender`, `password`, `name`) VALUES
('apple', 'male', '$2y$10$5R5QAN/bOSz0/ARxAzB/meUnjC9PVMHBoMbGp.O1PgXiOxQSarAZu', 'Apple TAN'),
('orange', 'female', '$2y$10$sxy4yfGsVZER6rylbaMaI.rGubMg/ituRBaJ3vY..eSRakPsS74VC', 'Orange TAN'),
('pear', 'male', '$2y$10$DpCQXba9AwA086Et7yAq.Ok9ihHy1uNvawvb3bvdTMw26nyS0JLae', 'Pear TAN');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `title` varchar(64) NOT NULL,
  `isbn13` char(13) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `availability` int(11) DEFAULT NULL,
  `dsfs` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`title`, `isbn13`, `price`, `availability`, `dsfs`) VALUES
('SQL in Nutshell', '9781129474251', '20000.50', 20, NULL),
('Understanding People', '9781349471231', '9.40', 250, NULL),
('Happy in Workplace', '9781434474234', '9000.00', 10, NULL),
('PHP Soup', '9781442374221', '20000.50', 20, NULL),
('Brief History of Time', '9781449474211', '20000.00', 230, NULL),
('It', '9781449474212', '1.00', 2, NULL),
('Founder of Php', '9781449474221', '3000.00', 1, NULL),
('Albert Enstein\'s Works', '9781449474223', '1000.00', 70, NULL),
('Interstellar', '9781449474254', '2000.00', 4, NULL),
('Milk and Honey', '9781449474256', '200.00', 180, NULL),
('Cooking Book', '9781449474323', '80000.90', 40, NULL),
('The Gathering', '9781449474342', '2000.00', 500, NULL),
('Tale of Zelda', '9781449474453', '3000.40', 210, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`isbn13`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

