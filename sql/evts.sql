-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2014 at 03:47 PM
-- Server version: 5.5.25
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `evts`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` text,
  `description` text,
  `sportart` text,
  `continent` text,
  `reach` text,
  `adress` text,
  `zip` int(6) NOT NULL,
  `city` text,
  `location` text,
  `datum` date DEFAULT NULL,
  `zeit` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `sportart`, `continent`, `reach`, `adress`, `zip`, `city`, `location`, `datum`, `zeit`) VALUES
(1, '', '', '', '', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(2, '6454', '64654', 'Football', 'Europa', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(3, '6454', '64654', 'Football', 'Europa', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(4, 'SSHD Disk', 'Es beschleunigt sich', 'Volleyball', 'America', NULL, NULL, 0, NULL, NULL, NULL, NULL),
(5, 'SSHD Disk', 'Es beschleunigt sich', 'Volleyball', 'America', 'National', 'Hjjkstrasse 23', 6757, 'Dern', NULL, NULL, NULL),
(6, 'Gaming X-Treme', 'Skyrim', 'Luge', 'America', 'Weltweit', 'Klkjkstrasse 35', 89898, 'Dern', NULL, NULL, NULL),
(7, 'sdfg', 'dfgg', 'Football', 'Europa', 'Lokal', 'dgjfgj', 1314, 'vhkv', NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
