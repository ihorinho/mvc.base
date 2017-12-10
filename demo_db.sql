-- Adminer 4.3.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `feedback` (`id`, `username`, `email`, `message`, `ip_address`) VALUES
(1,	'ihor.pelekhatyy',	'ihor.pelekhatyy@plumrocket.com',	'TEst rgregregerg',	'127.0.0.1');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` char(32) NOT NULL,
  `is_active` char(32) NOT NULL DEFAULT 'NULL',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `email`, `password`, `is_active`) VALUES
(1,	'ihorinho@gmail.com',	'c965640ee54338f361f208ddaca9d77b',	'1'),
(2,	'sasha@mail.com',	'bb7814516a055488bfad98843dced4aa',	'1');

-- 2017-12-10 21:54:29
