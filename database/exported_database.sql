-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Počítač: 127.0.0.1
-- Vytvořeno: Sob 16. dub 2016, 23:01
-- Verze serveru: 10.1.10-MariaDB
-- Verze PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `test`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `approved` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabulky `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`) VALUES
(13, 'Úvodní stránka', '\n\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus sit amet fringilla massa. Phasellus pharetra lacinia nisi eget faucibus. Phasellus sed mi tempus, porta nunc vel, vehicula eros. Nulla non quam fermentum est accumsan sollicitudin non porttitor orci. Donec at sem risus. Maecenas non dapibus velit, eu maximus risus. Aenean ipsum diam, auctor ac urna efficitur, egestas dignissim nulla. Curabitur ac neque ut sapien faucibus tristique. Sed hendrerit commodo erat, eu tristique magna mollis sed. Vivamus vitae venenatis orci, in sollicitudin leo. Proin luctus nibh turpis, in aliquet odio commodo vel. Nam mauris nunc, facilisis eget iaculis efficitur, venenatis vel ex.\n\nInteger malesuada erat vitae neque vehicula, vel lobortis risus laoreet. Maecenas porttitor tempor malesuada. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Phasellus imperdiet tortor ut tellus maximus, non accumsan lacus efficitur. Suspendisse convallis vitae urna vel efficitur. In vitae lorem aliquet, finibus libero vitae, ullamcorper diam. Nunc consequat nisi nisl, nec eleifend dui feugiat eu. Curabitur eu nunc odio. Integer rutrum, lorem non tempus varius, neque eros porttitor nisl, id placerat elit est at orci. Maecenas aliquam dictum mi, a rutrum justo porta a. Phasellus ut lacus sed orci posuere iaculis et ut urna.\n\nPhasellus fermentum, orci id tempor commodo, ex dui viverra arcu, non iaculis risus justo et magna. In suscipit eros non nunc vehicula, a tempus nisl congue. In hac habitasse platea dictumst. Aliquam eget est ornare, fringilla leo quis, malesuada ante. Curabitur augue turpis, cursus quis vehicula nec, vestibulum porttitor odio. Etiam iaculis ipsum sit amet fermentum auctor. Nullam eget tortor ante. Fusce rutrum quis augue ut fringilla. Nullam semper rhoncus vestibulum. Mauris nec metus at mauris viverra commodo. Proin porta libero nec tortor varius, id elementum sem laoreet. Nullam dictum sem at tincidunt semper. Nulla at turpis sollicitudin, convallis sem eget, varius lectus. Donec mattis libero at vehicula maximus. Nullam ut elit non ligula ultrices tempor id sed dui.\n\nVivamus tincidunt arcu id semper posuere. Nullam rutrum viverra odio vitae ultricies. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec mattis, lectus vel faucibus accumsan, erat quam dapibus mi, at vestibulum purus lorem id ligula. Etiam in suscipit odio, porta pulvinar neque. Pellentesque sagittis augue nibh, a convallis tellus sollicitudin sit amet. Aliquam erat volutpat. Aenean a accumsan tellus. Maecenas varius, quam eu lacinia facilisis, mi eros pellentesque velit, nec feugiat augue nibh non ante. Sed venenatis leo sit amet ornare feugiat. Donec blandit massa quis mi elementum, non feugiat sem fringilla. Ut purus quam, finibus sit amet bibendum ut, porta eget eros. Praesent tempor, dolor consectetur malesuada facilisis, risus nunc finibus nunc, vitae porta nulla mi a lacus. Nulla volutpat mi tortor, ac laoreet erat porta euismod.\n\nPhasellus nec facilisis elit. Sed tortor tortor, varius sit amet vulputate quis, feugiat et risus. Integer imperdiet nisl nec leo laoreet, a cursus mi rutrum. Ut sagittis eros quis metus vehicula egestas. Sed vel ornare nisi. Quisque tempor neque finibus erat pulvinar, nec egestas neque tristique. Praesent sed pretium dui. Donec maximus est non dictum ullamcorper. Nulla erat ligula, vestibulum eget sem sed, efficitur aliquet nunc. Maecenas odio enim, auctor et tellus commodo, tincidunt fringilla odio. Aenean pulvinar ullamcorper lectus a pretium. Etiam feugiat erat eget erat luctus, eget dignissim enim volutpat. Maecenas diam felis, consectetur in pulvinar vitae, commodo rhoncus massa. Cras vel aliquet augue, id sollicitudin risus. ', '2016-04-16 20:26:10');

-- --------------------------------------------------------

--
-- Struktura tabulky `setting`
--

CREATE TABLE `setting` (
  `onepage_layout` tinyint(4) NOT NULL,
  `id` tinyint(4) NOT NULL,
  `title` tinytext COLLATE utf8_czech_ci NOT NULL,
  `subtitle` mediumtext COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `setting`
--

INSERT INTO `setting` (`onepage_layout`, `id`, `title`, `subtitle`) VALUES
(0, 1, 'Ukázková stránka 2', 'Podtitulek, který není nikde vidět :D ');

-- --------------------------------------------------------

--
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text COLLATE utf8_czech_ci NOT NULL,
  `password` text COLLATE utf8_czech_ci NOT NULL,
  `role` text COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(2, 'admin', '$2y$10$6ZYx4..5qfaLxkmEDkx/h.xOcC./GzvDQqR2bjMOzwkm0E6zug2zq', 'admin');

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Klíče pro tabulku `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pro tabulku `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pro tabulku `setting`
--
ALTER TABLE `setting`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
