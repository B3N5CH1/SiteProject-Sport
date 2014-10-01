-- phpMyAdmin SQL Dump
-- version 4.2.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2014 at 10:02 AM
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
  `website` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `sportart`, `continent`, `reach`, `adress`, `zip`, `city`, `jahr`, `monat`, `tag`, `stunde`, `minute`, `website`) VALUES
(16, 'TestEvent', 'TestEventDescr', 'Andere', 'Europa', 'Lokal', 'Teststrasse 25', 1234, 'Testdorf', 2014, 10, 1, 12, 0, ''),
(17, 'TestEvent2', 'TestEventDescr', 'Andere', 'Europa', 'Lokal', 'Teststrasse 25', 12345, 'Testdorf', 2014, 10, 1, 12, 0, ''),
(18, '', '', 'Fussball', 'Europa', 'Lokal', '', 0, '', 0, 0, 0, 12, 0, ''),
(19, '', '', 'Fussball', 'Europa', 'Lokal', '', 0, '', 0, 0, 0, 20, 0, ''),
(20, '', '', 'Fussball', 'Europa', 'Lokal', '', 0, '', 0, 0, 0, 12, 34, ''),
(21, 'TestEvent3', 'TestEventDescr', 'Andere', 'Europa', 'Lokal', 'Teststrasse 25', 3400, 'Testdorf', 2014, 10, 1, 12, 15, '');

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
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
