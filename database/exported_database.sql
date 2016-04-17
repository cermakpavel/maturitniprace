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
(6,	6,	'Milan',	'Ahoj,<br>\nToto je první komentář :)',	'2016-04-17 17:01:24',	0),
(7,	7,	'Jakub',	'Anooo, mám první komentář!! ',	'2016-04-17 17:02:00',	0);

CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`) VALUES
(6,	'Lorem ipsum',	'<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Maecenas lorem. Nullam dapibus fermentum ipsum. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Nullam rhoncus aliquam metus. Phasellus faucibus molestie nisl. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Integer lacinia. Maecenas libero. Nullam sit amet magna in magna gravida vehicula. Aliquam ante. Cras pede libero, dapibus nec, pretium sit amet, tempor quis. Phasellus faucibus molestie nisl.</p>\n\n<p>Aliquam erat volutpat. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo. Nullam lectus justo, vulputate eget mollis sed, tempor sed magna. Mauris dolor felis, sagittis at, luctus sed, aliquam non, tellus. Quisque tincidunt scelerisque libero. Mauris metus. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Aliquam erat volutpat. Mauris dictum facilisis augue. Duis viverra diam non justo. In dapibus augue non sapien. Nulla non arcu lacinia neque faucibus fringilla.</p>\n\n<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Et harum quidem rerum facilis est et expedita distinctio. Aliquam erat volutpat. Nullam dapibus fermentum ipsum. Etiam posuere lacus quis dolor. Integer malesuada. Nullam faucibus mi quis velit. Morbi scelerisque luctus velit. Aenean fermentum risus id tortor. Suspendisse sagittis ultrices augue. Integer in sapien.</p>\n\n<p>Nam quis nulla. Fusce tellus. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Pellentesque arcu. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Nullam lectus justo, vulputate eget mollis sed, tempor sed magna. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Sed convallis magna eu sem. Aenean placerat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. In enim a arcu imperdiet malesuada. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Etiam dui sem, fermentum vitae, sagittis id, malesuada in, quam. Etiam ligula pede, sagittis quis, interdum ultricies, scelerisque eu. In sem justo, commodo ut, suscipit at, pharetra vitae, orci. Mauris elementum mauris vitae tortor. Nulla turpis magna, cursus sit amet, suscipit a, interdum id, felis. Sed elit dui, pellentesque a, faucibus vel, interdum nec, diam. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>\n\n<p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Mauris dictum facilisis augue. In convallis. Curabitur bibendum justo non orci. Integer tempor. Curabitur ligula sapien, pulvinar a vestibulum quis, facilisis vel sapien. Donec vitae arcu. Aenean id metus id velit ullamcorper pulvinar. Quisque porta. Donec ipsum massa, ullamcorper in, auctor et, scelerisque sed, est. Pellentesque ipsum. Nulla non lectus sed nisl molestie malesuada. Aliquam erat volutpat. In sem justo, commodo ut, suscipit at, pharetra vitae, orci. Maecenas aliquet accumsan leo. Nullam eget nisl. Duis bibendum, lectus ut viverra rhoncus, dolor nunc faucibus libero, eget facilisis enim ipsum id lacus. Vivamus ac leo pretium faucibus. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Maecenas fermentum, sem in pharetra pellentesque, velit turpis volutpat ante, in pharetra metus odio a lectus.</p>',	'2016-04-17 16:29:11'),
(7,	'Curabitur',	'<p>Curabitur sagittis hendrerit ante. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Sed ac dolor sit amet purus malesuada congue. Curabitur ligula sapien, pulvinar a vestibulum quis, facilisis vel sapien. Maecenas aliquet accumsan leo. Nunc auctor. Sed convallis magna eu sem. Nullam justo enim, consectetuer nec, ullamcorper ac, vestibulum in, elit. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Praesent dapibus. Phasellus et lorem id felis nonummy placerat. Nullam sit amet magna in magna gravida vehicula. Sed vel lectus. Donec odio tempus molestie, porttitor ut, iaculis quis, sem. Sed convallis magna eu sem.</p>\n\n<p>In laoreet, magna id viverra tincidunt, sem odio bibendum justo, vel imperdiet sapien wisi sed libero. Curabitur ligula sapien, pulvinar a vestibulum quis, facilisis vel sapien. Quisque porta. Mauris dictum facilisis augue. In rutrum. Nullam at arcu a est sollicitudin euismod. Quisque porta. Praesent id justo in neque elementum ultrices. Praesent in mauris eu tortor porttitor accumsan. In enim a arcu imperdiet malesuada. Duis risus. Nullam rhoncus aliquam metus.</p>\n\n<p>Mauris dictum facilisis augue. Nulla est. Duis condimentum augue id magna semper rutrum. Proin in tellus sit amet nibh dignissim sagittis. Duis viverra diam non justo. Fusce tellus. Maecenas sollicitudin. Maecenas aliquet accumsan leo. Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? Vivamus ac leo pretium faucibus. Proin pede metus, vulputate nec, fermentum fringilla, vehicula vitae, justo.</p>\n',	'2016-04-17 16:50:07');

CREATE TABLE `setting` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `onepage_layout` tinyint(4) NOT NULL,
  `title` tinytext COLLATE utf8_czech_ci NOT NULL,
  `subtitle` mediumtext COLLATE utf8_czech_ci NOT NULL,
  `comments` char(1) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `setting` (`id`, `onepage_layout`, `title`, `subtitle`, `comments`) VALUES
(1,	1,	'Maturitní práce',	'Cermak Pavel',	'1');

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

-- 2016-04-17 17:22:58
