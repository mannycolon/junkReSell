-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2016 at 06:45 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `junkReSell_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `shipAddressID` int(11) DEFAULT NULL,
  `billingAddressID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `email`, `password`, `firstname`, `lastname`, `shipAddressID`, `billingAddressID`) VALUES
(7, 'colonmanuel7@gmail.com', 'mama', 'Manuel', 'Colon', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Table structure for table `category`
-- 
CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) NOT NULL,
  PRIMARY KEY (categoryID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 
 
--
-- Dumping data for table `category`
--
INSERT INTO `category`(`categoryID`, `categoryName`) VALUES 
(1,'Electronics')
(2,'Sporting Goods'),
(3,'Home and Garden'),
(4,'Clothing'),
(5,'Other');

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryID` int(11) NOT NULL,
  `productName` varchar(100) NOT NULL,
  `productPrice` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `dateAdded` date NOT NULL,
  PRIMARY KEY (productID)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `productPrice`, `description`, `dateAdded`) VALUES
(1, 1, 'Samsung 720p LED TV (2014 Model)', '650.00', 'Ideal for placement in a bedroom or dorm room, this 
 720p Samsung HDTV delivers a wide variety of colors and clarity, allowing you to relax and enjoy your 
 favorite movies and shows. Connect your USB device directly for access to your photos, videos and music.', '2016-09-23');
 
ALTER TABLE product ADD abbrvName VARCHAR(60) AFTER productName;
UPDATE product SET abbrvName='samsungTV'WHERE productID=1;

INSERT INTO `product` (`productID`, `categoryID`, `productName`, `abbrvName`, `productPrice`, `description`, `dateAdded`) VALUES
(2, 1, 'Apple iPad Air 16GB WiFi', 'iPad', '379.00', 'For tech connoisseurs, the lighter and thinner the design, the more desirable 
  that piece of hardware is. Designed for true techies, the Apple iPad Air is 20 percent thinner than the standard iPad, 
  and weighs just one pound, so it feels unbelievably light in your hand. It comes with a 9.7" Retina display, the A7 
  chip with 64-bit architecture, ultrafast wireless, powerful apps, and up to 10 hours of battery life. And over 475,000 
  apps in the App Store are just a tap away on the Apple iPad Air. ', '2016-10-06');
 
