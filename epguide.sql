-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Vert: localhost
-- Generert den: 05. Feb, 2014 18:15 PM
-- Tjenerversjon: 5.5.16
-- PHP-Versjon: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `epguide`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `actor`
--

CREATE TABLE IF NOT EXISTS `actor` (
  `actor_id` int(10) NOT NULL DEFAULT '0',
  `imdb_id` int(10) NOT NULL,
  `poster_url` varchar(100) NOT NULL,
  `name` varchar(75) NOT NULL,
  PRIMARY KEY (`actor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `channel`
--

CREATE TABLE IF NOT EXISTS `channel` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `country_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `character`
--

CREATE TABLE IF NOT EXISTS `character` (
  `actor_id` int(10) DEFAULT NULL,
  `character_name` varchar(50) NOT NULL,
  `show_id` int(5) NOT NULL,
  `season` int(5) NOT NULL,
  `episode` int(5) NOT NULL,
  `importance` int(5) NOT NULL,
  KEY `actor_id` (`actor_id`),
  KEY `show_id` (`show_id`),
  KEY `season` (`season`),
  KEY `episode` (`episode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  `language` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dataark for tabell `country`
--

INSERT INTO `country` (`id`, `name`, `language`) VALUES
(10, 'Norway', 'Norway');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `episode`
--

CREATE TABLE IF NOT EXISTS `episode` (
  `show_id` int(10) NOT NULL,
  `season` int(5) NOT NULL,
  `episode` int(5) NOT NULL,
  `name` varchar(50) NOT NULL,
  `summary` varchar(250) NOT NULL,
  PRIMARY KEY (`show_id`,`season`,`episode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `parameter`
--

CREATE TABLE IF NOT EXISTS `parameter` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `key` varchar(40) NOT NULL,
  `value` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` varchar(50) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `show`
--

CREATE TABLE IF NOT EXISTS `show` (
  `id` int(10) NOT NULL,
  `imdb_id` int(25) NOT NULL,
  `zap2_id` int(25) NOT NULL,
  `channel_id` int(25) NOT NULL,
  `banner_url` varchar(100) NOT NULL,
  `pilot_date` date NOT NULL DEFAULT '0000-00-00',
  `name` varchar(50) NOT NULL,
  `summary` varchar(200) NOT NULL,
  `lang` varchar(25) NOT NULL,
  `rating` int(10) NOT NULL,
  `lst_update` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`),
  KEY `channel_id` (`channel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `show`
--

INSERT INTO `show` (`id`, `imdb_id`, `zap2_id`, `channel_id`, `banner_url`, `pilot_date`, `name`, `summary`, `lang`, `rating`, `lst_update`) VALUES
(10, 1, 1, 1, 'www', '2014-02-05', 'Big Bang Theory', 'Summary...', 'En', 1, '2014-02-05');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `subtitle`
--

CREATE TABLE IF NOT EXISTS `subtitle` (
  `show_id` int(10) NOT NULL,
  `season` int(10) NOT NULL,
  `episode` int(10) NOT NULL,
  `url` varchar(100) NOT NULL,
  PRIMARY KEY (`show_id`,`season`,`episode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `url`
--

CREATE TABLE IF NOT EXISTS `url` (
  `show_id` int(10) NOT NULL,
  `season` int(10) NOT NULL,
  `episode` int(10) NOT NULL,
  `url` varchar(150) NOT NULL,
  PRIMARY KEY (`show_id`,`season`,`episode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role_id` varchar(20) NOT NULL,
  `country_id` int(25) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `user_show`
--

CREATE TABLE IF NOT EXISTS `user_show` (
  `user_id` int(10) NOT NULL,
  `show_id` int(10) NOT NULL,
  `is_favorite` int(10) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `show_id` (`show_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Begrensninger for dumpede tabeller
--

--
-- Begrensninger for tabell `channel`
--
ALTER TABLE `channel`
  ADD CONSTRAINT `channel_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Begrensninger for tabell `character`
--
ALTER TABLE `character`
  ADD CONSTRAINT `character_ibfk_2` FOREIGN KEY (`actor_id`) REFERENCES `actor` (`actor_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `character_ibfk_1` FOREIGN KEY (`show_id`) REFERENCES `show` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Begrensninger for tabell `episode`
--
ALTER TABLE `episode`
  ADD CONSTRAINT `episode_ibfk_1` FOREIGN KEY (`show_id`) REFERENCES `show` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Begrensninger for tabell `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`);

--
-- Begrensninger for tabell `user_show`
--
ALTER TABLE `user_show`
  ADD CONSTRAINT `user_show_ibfk_2` FOREIGN KEY (`show_id`) REFERENCES `show` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_show_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
