-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 09, 2014 at 09:30 AM
-- Server version: 5.6.20
-- PHP Version: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
`id` int(10) NOT NULL,
  `title` text,
  `description` text,
  `sportart` text,
  `continent` text,
  `reach` text,
  `adress` text,
  `zip` int(6) NOT NULL,
  `city` text,
  `jahr` int(11) NOT NULL,
  `monat` int(11) NOT NULL,
  `tag` int(11) NOT NULL,
  `stunde` int(11) NOT NULL,
  `minute` int(11) NOT NULL,
  `website` text NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `sportart`, `continent`, `reach`, `adress`, `zip`, `city`, `jahr`, `monat`, `tag`, `stunde`, `minute`, `website`, `lat`, `lng`) VALUES
(36, 'TestEventIF2', 'Event Description', 'Fussball', 'Europa', 'Lokal', '', 0, '', 2014, 10, 12, 12, 34, '', 46.7775, 7.29166),
(37, 'TestEventIF2', 'Event Description', 'Fussball', 'Europa', 'Lokal', '', 0, '', 2014, 10, 12, 12, 34, '', 47.1926, 7.70481),
(38, 'TestE', 'TestDescr', 'Andere', 'Europa', 'Lokal', '', 0, '', 2014, 12, 12, 12, 34, '', 47.2044, 7.54259),
(39, 'asdf', 'sadf', 'Fussball', 'Europa', 'Lokal', NULL, 0, NULL, 2014, 2, 12, 11, 15, '', 46.5966, 8.7858),
(40, 'sadf', 'ASF', 'Fussball', 'Europa', 'Lokal', NULL, 0, NULL, 2015, 12, 30, 12, 15, '', 47.5024, 7.69815),
(41, 'qwer', 'qwer', 'Fussball', 'Europa', 'Lokal', NULL, 0, NULL, 2016, 2, 29, 12, 35, '', 46.8602, 7.90689);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`id`), ADD FULLTEXT KEY `title` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
