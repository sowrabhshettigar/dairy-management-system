-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2024 at 02:27 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dairy`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getallcustomerinfo` ()  BEGIN
       SELECT * FROM CUSTOMER;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bratechart`
--

CREATE TABLE `bratechart` (
  `bfat` double NOT NULL,
  `brate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bratechart`
--

INSERT INTO `bratechart` (`bfat`, `brate`) VALUES
(6.1, 30),
(6.2, 35),
(6.3, 40),
(6.4, 45),
(6.5, 50),
(6.6, 55),
(6.7, 60),
(6.8, 65);

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE `collection` (
  `date` date NOT NULL,
  `time` varchar(20) NOT NULL,
  `ssn` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `qty` double NOT NULL,
  `fat` double NOT NULL,
  `rate` double NOT NULL,
  `total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`date`, `time`, `ssn`, `type`, `qty`, `fat`, `rate`, `total`) VALUES
('2023-04-01', 'Morning', 5, 'Buffalo', 23, 766, 45, 3015),
('2024-04-01', 'Morning', 5, 'Buffalo', 41, 6, 45, 135),
('2024-04-04', 'Evening', 6, 'Cow', 41, 6, 45, 135),
('2024-04-29', 'Evening', 6, 'Cow', 12, 3, 0, 0),
('2024-05-03', 'Evening', 6, 'Cow', 36, 0, 45, 360),
('2024-05-03', 'Evening', 8, 'Cow', 78, 2, 45, 3510),
('2024-05-11', 'Morning', 7, 'Buffalo', 67, 23, 45, 3015),
('2024-05-14', 'Morning', 9, 'Buffalo', 33, 3, 45, 1485),
('2024-05-17', 'Evening', 8, 'Cow', 67, 2, 45, 3015),
('2024-05-17', 'Morning', 8, 'Cow', 45, 2, 45, 2025),
('2024-05-30', 'Morning', 6, 'Cow', 233, 4, 45, 10485);

-- --------------------------------------------------------

--
-- Table structure for table `cratechart`
--

CREATE TABLE `cratechart` (
  `cfat` double NOT NULL,
  `crate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cratechart`
--

INSERT INTO `cratechart` (`cfat`, `crate`) VALUES
(5.5, 20),
(5.6, 25),
(5.7, 30),
(5.8, 35),
(5.9, 40),
(6, 45);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `ssn` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `type` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ssn`, `name`, `address`, `type`) VALUES
(0, 'Manish Shettigar', 'kochi', 'Buffalo'),
(5, 'Manish', 'mulki', 'Buffalo'),
(6, 'Jithesh', 'Yermal', 'Cow'),
(7, 'boss', 'bajaigoli', 'Buffalo'),
(8, 'aa', 'bb', 'Cow'),
(9, 'aaa bbbccccccccc', 'mulki', 'Buffalo');

-- --------------------------------------------------------

--
-- Table structure for table `export`
--

CREATE TABLE `export` (
  `liters` int(20) NOT NULL,
  `location` varchar(50) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `export`
--

INSERT INTO `export` (`liters`, `location`, `date`) VALUES
(2, 'Mulki', '2024-05-14'),
(3, 'Bangalore', '2024-05-14'),
(9, 'Padubidri', '2024-05-14'),
(3, 'Karkala', '2024-05-14'),
(5, 'kochi', '2024-05-14'),
(20, 'kochi', '2024-05-14'),
(20, 'mangalore', '2024-05-14'),
(2, 'kinnigoli', '2024-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user`, `password`) VALUES
('admin', '123456'),
('jithesh', 'jithesh'),
('manish', 'manish');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `total_qty` double DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`total_qty`) VALUES
(357);

-- --------------------------------------------------------

--
-- Stand-in structure for view `viewbill`
-- (See below for the actual view)
--
CREATE TABLE `viewbill` (
`name` varchar(20)
,`date` date
,`time` varchar(20)
,`ssn` int(11)
,`type` varchar(20)
,`qty` double
,`fat` double
,`rate` double
,`total` double
);

-- --------------------------------------------------------

--
-- Structure for view `viewbill`
--
DROP TABLE IF EXISTS `viewbill`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewbill`  AS SELECT `cu`.`name` AS `name`, `co`.`date` AS `date`, `co`.`time` AS `time`, `co`.`ssn` AS `ssn`, `co`.`type` AS `type`, `co`.`qty` AS `qty`, `co`.`fat` AS `fat`, `co`.`rate` AS `rate`, `co`.`total` AS `total` FROM (`customer` `cu` join `collection` `co` on(`cu`.`ssn` = `co`.`ssn`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bratechart`
--
ALTER TABLE `bratechart`
  ADD PRIMARY KEY (`bfat`);

--
-- Indexes for table `collection`
--
ALTER TABLE `collection`
  ADD PRIMARY KEY (`date`,`time`,`ssn`,`type`),
  ADD KEY `ssn` (`ssn`);

--
-- Indexes for table `cratechart`
--
ALTER TABLE `cratechart`
  ADD PRIMARY KEY (`cfat`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`ssn`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`ssn`) REFERENCES `customer` (`ssn`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
