-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2016 at 11:59 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.6.18-1+deb.sury.org~trusty+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cake3-kendoui`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE IF NOT EXISTS `bookmarks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(200) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `url` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bookmark_tags`
--

CREATE TABLE IF NOT EXISTS `bookmark_tags` (
  `bookmark_id` int(11) NOT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `phinxlog`
--

CREATE TABLE IF NOT EXISTS `phinxlog` (
  `version` bigint(20) NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `phinxlog`
--

INSERT INTO `phinxlog` (`version`, `start_time`, `end_time`) VALUES
(20150511074427, '2015-06-02 12:53:15', '2015-06-02 12:53:16'),
(20150511122747, '2015-06-02 12:53:16', '2015-06-02 12:53:16'),
(20150512100522, '2015-06-02 12:53:16', '2015-06-02 12:53:17');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `created`, `updated`) VALUES
(1, 'Tag1', '2015-06-27 07:04:13', NULL),
(2, 'Tag 2', '2015-06-27 07:04:29', NULL),
(3, 'Tag 3', '2015-06-27 07:04:37', NULL),
(4, 'Tag 5', '2016-02-27 18:29:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '1',
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `gender`, `email`, `password`, `created`, `updated`, `active`) VALUES
(2, 'Pushpa', 'Ghadge', 0, 'pushpa@gmail.com', '$2y$10$C9awlIKRuTruGr0gAX9/peekJIRdAK75OGsCZZNqKBDhD2ZFyA1sq', '2015-06-27 08:01:42', NULL, 1),
(3, 'SandipS', 'GhadgeS', 1, 'ghadagesandip@gmail.com', '$2y$10$Wt67VSfTM9K7RUJnfFnJB.ay7qGzSxOghtr4P/XQKJ8c4ocjcfncq', '2015-11-08 11:20:29', NULL, 1),
(4, 'Sandipa', 'Ghadgea', 1, 'ghadagepushpa@gmail.com', '$2y$10$v70r1gWL1FwP0fIpRMkGDuA8umdBzVWhlaNYx8f/2r42FHiMve9J6', '2015-11-08 11:43:58', NULL, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
