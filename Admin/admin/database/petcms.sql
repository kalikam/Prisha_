-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 07, 2012 at 06:27 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `petcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

CREATE TABLE IF NOT EXISTS `admin_info` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`admin_id`, `first_name`, `last_name`, `email`, `username`, `password`, `status`) VALUES
(1, 'admin', 'admin', 'admin@indyainfotech.com', 'admin', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `pageid` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(255) NOT NULL,
  `parent_page` int(11) NOT NULL,
  `page_slug` varchar(255) NOT NULL,
  `page_meta_title` varchar(255) NOT NULL,
  `page_meta_keyword` varchar(255) NOT NULL,
  `page_meta_description` text NOT NULL,
  `page_position` varchar(255) NOT NULL,
  `page_content` text NOT NULL,
  `page_status` tinyint(1) NOT NULL,
  PRIMARY KEY (`pageid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pageid`, `page_name`, `parent_page`, `page_slug`, `page_meta_title`, `page_meta_keyword`, `page_meta_description`, `page_position`, `page_content`, `page_status`) VALUES
(1, 'about us by shiv', 0, 'about_us_by_shiv', 'about us by shiv', 'about us by shiv', 'about us by shiv', 'header', '&lt;p&gt;\r\n	about us by shiv&lt;/p&gt;', 1),
(2, 'contact us content', 1, 'contact_us_content', 'contact us content', 'contact us content', 'contact us content', 'header', '&lt;p&gt;\r\n	contact us content&lt;/p&gt;', 1),
(3, 'thirdf dkfjdfdfkl', 2, 'thirdf_dkfjdfdfkl', 'thirdf dkfjdfdfkl', 'thirdf dkfjdfdfkl', 'thirdf dkfjdfdfkl', 'header', '&lt;p&gt;\r\n	thirdf dkfjdfdfkl&lt;/p&gt;', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
