--
-- Table structure for table `video`
--
-- structure database
-- 1. ID
-- 2. Datetime
-- 3. Title
-- 4. description
-- 5. Reporter
-- 6. Content
-- 7. Category

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


INSERT INTO `video` (`id`, `title`, `description`, `imgurl`, `category`, `reporter`, `content`, `newsdate`) VALUES
(1, 'ikhwannews', 'salallahu ala muhammad', 'http%3A%2F%2Fci.adnan.net%2Fassets%2Fimg%2F160x90.gif', '4', '1', 'assalamu alaikum<br>br>', '2012-04-18'),
(2, 'ikhwannews', 'salallahu ala muhammad', 'http%3A%2F%2Fci.adnan.net%2Fassets%2Fimg%2F160x90.gif', '4', '1', 'assalamu alaikum<br>br>', '2012-04-18');
