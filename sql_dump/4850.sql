-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 03, 2012 at 11:36 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `4850`
--

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `report_id` int(11) NOT NULL AUTO_INCREMENT,
  `tech` int(4) NOT NULL COMMENT 'user_id',
  `reporter` int(4) NOT NULL COMMENT 'user_id',
  `description` longtext NOT NULL,
  `location` varchar(200) NOT NULL,
  `submissionDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `completionDate` timestamp NULL DEFAULT NULL,
  `feedback` longtext,
  `isRepaired` int(1) NOT NULL,
  PRIMARY KEY (`report_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`report_id`, `tech`, `reporter`, `description`, `location`, `submissionDate`, `completionDate`, `feedback`, `isRepaired`) VALUES
(1, 0, 0, 'I have issues', 'In my head', '0000-00-00 00:00:00', NULL, NULL, 1),
(2, 0, 0, 'I have issues', 'In my head', '0000-00-00 00:00:00', NULL, NULL, 1),
(3, 0, 0, 'Tons of issues', 'Everywhere', '0000-00-00 00:00:00', NULL, NULL, 1),
(4, 0, 0, 'Tons of issues', 'Everywhere', '0000-00-00 00:00:00', NULL, NULL, 1),
(5, 6, 0, 'Problem', 'Basement', '0000-00-00 00:00:00', NULL, NULL, 1),
(6, 6, 0, 'Test', 'Test Location', '0000-00-00 00:00:00', NULL, NULL, 1),
(7, 6, 5, 'Test 2', 'Test Location 2', '0000-00-00 00:00:00', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `speciality`
--

CREATE TABLE IF NOT EXISTS `speciality` (
  `speciality_id` int(4) NOT NULL AUTO_INCREMENT,
  `desc` varchar(100) NOT NULL,
  `name` varchar(10) NOT NULL,
  PRIMARY KEY (`speciality_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `techs`
--

CREATE TABLE IF NOT EXISTS `techs` (
  `user_id` int(4) NOT NULL,
  `speciality_id` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(4) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `password` varchar(40) NOT NULL,
  `role` enum('admin','tech','patron') NOT NULL,
  `authenticated` tinyint(1) NOT NULL,
  `auth_key` varchar(15) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `firstName`, `lastName`, `email`, `phone`, `password`, `role`, `authenticated`, `auth_key`) VALUES
(2, 'test', 'ben', 'ben@gmail.com', NULL, '3da541559918a808c2402bba5012f6c60b27661c', 'patron', 0, ''),
(3, 'ben', 'ben', 'ben@ben.com', NULL, '92429d82a41e930486c6de5ebda9602d55c39986', 'patron', 0, ''),
(4, 'asdf', 'asdf', 'asdf@asdf.com', NULL, '3da541559918a808c2402bba5012f6c60b27661c', 'patron', 0, ''),
(5, 'Kyle', 'Sanders', 'abc@abc.com', NULL, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'patron', 0, 'FFZZ1OUdULWj4fY'),
(6, 'Test', 'Techie', 'tech@tech.com', NULL, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'tech', 0, ''),
(8, 'Ad', 'min', 'admin@admin.com', NULL, 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', 'admin', 1, '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
