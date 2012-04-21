-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2012 at 09:18 AM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `ikhwannews`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('4e31e504d42d8f196f8e497092522851', '127.0.0.1', 'Mozilla/5.0 (Linux; U; Android 2.2; en-us; DROID2 ', 1334710549, ''),
('143b462dbca8f5227bcd442f09988bbb', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/53', 1334706341, 'a:6:{s:8:"username";s:14:"adnanbasalamah";s:5:"email";s:17:"adnan.b@gmail.com";s:8:"group_id";s:1:"1";s:5:"token";s:0:"";s:10:"identifier";s:0:"";s:9:"logged_in";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--


-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `description` tinytext,
  `imgurl` tinytext,
  `category` varchar(50) DEFAULT NULL,
  `reporter` varchar(50) DEFAULT NULL,
  `content` text,
  `newsdate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `news`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '100',
  `token` varchar(255) NOT NULL,
  `identifier` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `group_id`, `token`, `identifier`) VALUES
(4, 'adnanbasalamah', 'adnan.b@gmail.com', '311f1fe1c2afd7e90e43100f7046ca8d863fe805be59cfdd260dc5dcf1974c92', 1, '', ''),
(5, 'affanbasalamah', 'affan@itb.ac.id', '311f1fe1c2afd7e90e43100f7046ca8d863fe805be59cfdd260dc5dcf1974c92', 100, '', ''),
(6, 'fifiyanti', 'fifi313@gmail.com', 'a4f452fd6638c0cfa836d45ba9d2f20c22ec049886effd82d50594f4b41b98b4', 100, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `video_title` varchar(50) DEFAULT NULL,
  `video_teaser` tinytext,
  `video_url` tinytext,
  `screenshoot_url` tinytext,
  `video_category` varchar(50) DEFAULT NULL,
  `video_producer` varchar(50) DEFAULT NULL,
  `video_tag` tinytext,
  `video_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`id`, `video_title`, `video_teaser`, `video_url`, `screenshoot_url`, `video_category`, `video_producer`, `video_tag`, `video_date`) VALUES
(18, 'my TVRSA video', 'salallahu ala muhammad', 'http%3A%2F%2Fvimeo.com%2F40070774', 'http%3A%2F%2Fci.adnan.net%2Fassets%2Fimg%2F160x90.gif', '4', '1', NULL, '2012-04-18'),
(3, 'ayam daging vs ayam kampung2', 'wa alaikum salam', 'http://player.vimeo.com/video/40070774', 'http://ci.adnan.net/assets/img/160x90.gif', 'clip', '4', 'clip', '2012-04-15'),
(10, 'ahlan wa sahlan', 'apa khabar', 'http://player.vimeo.com', 'http://ci.adnan.net/assets/img/160x90.gif', '1', '1', NULL, '2012-04-17'),
(5, 'test 2', 'ziarah madinah', 'player.vimeo.com', 'http://ci.adnan.net/assets/img/160x90.gif', NULL, 'Zone Pusat', NULL, NULL),
(9, 'assalamu alaikum', 'warahmatullahi wabarakatuh', 'http://player.vimeo.com', 'http://ci.adnan.net/assets/img/160x90.gif', NULL, 'Zone Pusat', NULL, '2012-04-15'),
(8, 'siapa dia', 'farsi turab', 'player.vimeo.com', 'http://ci.adnan.net/assets/img/160x90.gif', NULL, 'Zone Pusat', NULL, '2012-04-15'),
(12, 'Dialog dgn pakar SSI', 'test saja', 'http://youtube.com', 'http://ci.adnan.net/assets/img/160x90.gif', '2', '3', NULL, '2012-04-15'),
(13, 'My Video2', 'Finding Teaser yes', 'http://www.youtube.com', 'http://ci.adnan.net/assets/img/160x90.gif', '3', '3', NULL, '2012-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `video_category`
--

CREATE TABLE IF NOT EXISTS `video_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `video_category`
--

INSERT INTO `video_category` (`id`, `cat`) VALUES
(1, 'berita'),
(2, 'dialog'),
(3, 'dokumentari'),
(4, 'drama'),
(5, 'klip');

CREATE TABLE IF NOT EXISTS `news_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `video_category`
-- Terkini · Ruh Suci · Seks Suci · Luar Negara · Keajaiban · Ulasan · Foto

INSERT INTO `news_category` (`id`, `cat`) VALUES
(1, 'terkini'),
(2, 'ruh suci'),
(3, 'seks suci'),
(4, 'luar negara'),
(5, 'keajaiban'),
(6, 'ulasan'),
(7, 'foto');

-- --------------------------------------------------------

--
-- Table structure for table `video_producer`
--

CREATE TABLE IF NOT EXISTS `video_producer` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `prod` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `video_producer`
--

INSERT INTO `video_producer` (`id`, `prod`) VALUES
(1, 'zone pusat-makassar'),
(2, 'zone kedah-madinah'),
(3, 'zone ibu pejabat'),
(4, 'zone jawa 1 - sumatra 2');

-- --------------------------------------------------------

--
-- Table structure for table `video_producer`
--

CREATE TABLE IF NOT EXISTS `reporter` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `reporter` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `video_producer`
--

INSERT INTO `reporter` (`id`, `reporter`) VALUES
(1, 'zone pusat-makassar'),
(2, 'zone kedah-madinah'),
(3, 'zone ibu pejabat'),
(4, 'zone tengah'),
(5, 'zone barat'),
(6, 'zone sabah 1'),
(7, 'zone jawa 1 - sumatra 2');



