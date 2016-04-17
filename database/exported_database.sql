-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `comments` (`id`, `post_id`, `name`, `content`, `created_at`, `approved`) VALUES
(5,	5,	'Pavelik',	'kmvijyjsvnfnhjb kigkagvkidgvkdkgbkdhbn iniafisrafnhjagh',	'2016-04-17 12:21:23',	1);

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`) VALUES
(5,	'Pepík Úvodní stránka',	'Hlavní stránka, která je hlavní safmsdfsnadvxcv',	'2016-04-17 12:20:57');

CREATE TABLE `setting` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `onepage_layout` tinyint(4) NOT NULL,
  `title` tinytext COLLATE utf8_czech_ci NOT NULL,
  `subtitle` mediumtext COLLATE utf8_czech_ci NOT NULL,
  `comments` char(1) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `setting` (`id`, `onepage_layout`, `title`, `subtitle`, `comments`) VALUES
(1,	0,	'Ukázka maturitní práce',	'Cermak Pavel',	'1');

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text COLLATE utf8_czech_ci NOT NULL,
  `password` text COLLATE utf8_czech_ci NOT NULL,
  `role` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(2,	'admin',	'$2y$10$6ZYx4..5qfaLxkmEDkx/h.xOcC./GzvDQqR2bjMOzwkm0E6zug2zq',	'admin');

-- 2016-04-17 15:14:48
