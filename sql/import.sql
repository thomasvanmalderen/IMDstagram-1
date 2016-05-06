-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 05 mei 2016 om 09:15
-- Serverversie: 10.1.9-MariaDB
-- PHP-versie: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_imdstagram`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `comments`
--

CREATE TABLE `comments` (
  `c_id` int(11) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `idPost` int(11) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `comments`
--

INSERT INTO `comments` (`c_id`, `comment`, `idPost`, `idUser`) VALUES
(133, 'mooie zaal!', 9, 2),
(134, 'wow it''s really great!', 6, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `follows`
--

CREATE TABLE `follows` (
  `f_id` int(11) UNSIGNED NOT NULL,
  `idFollowing` int(11) NOT NULL,
  `idFollowed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `follows`
--

INSERT INTO `follows` (`f_id`, `idFollowing`, `idFollowed`) VALUES
(1, 1, 2),
(2, 10, 7),
(3, 10, 5),
(5, 10, 3),
(6, 10, 1),
(7, 1, 6),
(8, 8, 6),
(9, 8, 5),
(10, 10, 8),
(11, 5, 6),
(12, 2, 7),
(13, 2, 1),
(14, 2, 6),
(15, 2, 5),
(16, 2, 3),
(17, 2, 4),
(18, 2, 9);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `likes`
--

CREATE TABLE `likes` (
  `l_id` int(11) UNSIGNED NOT NULL,
  `likerID` int(11) NOT NULL,
  `postLikedId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `likes`
--

INSERT INTO `likes` (`l_id`, `likerID`, `postLikedId`) VALUES
(1, 2, 1),
(2, 3, 1),
(3, 2, 10),
(4, 3, 10),
(5, 5, 10),
(6, 1, 1),
(8, 5, 1),
(11, 1, 1),
(21, 1, 6),
(22, 1, 2),
(23, 10, 1),
(25, 10, 7),
(26, 10, 5),
(27, 8, 6),
(28, 8, 8),
(29, 8, 5),
(30, 8, 1),
(31, 10, 3),
(32, 10, 10),
(33, 10, 8),
(34, 5, 5),
(35, 5, 6),
(36, 2, 6);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE `posts` (
  `p_id` int(11) NOT NULL,
  `picture` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `posttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Report` int(5) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `posts`
--

INSERT INTO `posts` (`p_id`, `picture`, `description`, `posttime`, `Report`, `idUser`) VALUES
(1, 'images/posts/admin-1461439777-thegym.jpg', 'The fabled creativity gym', '2016-04-15 22:00:00', 0, 1),
(2, 'images/posts/robinreyns-1461439899-superbrein.jpg', 'Superbrein, super programma!', '2016-04-16 22:00:00', 0, 2),
(3, 'images/posts/antoinehendrickx-1461439979-akira.jpg', 'Akira is a great movie. ', '2016-04-17 22:00:00', 0, 3),
(4, 'images/posts/jorishens-1461440193-stempeltje-fb.jpg', 'My new app: stempeltje!', '2016-04-18 22:00:00', 0, 4),
(5, 'images/posts/michaelrosen-1461440268-rosen book.jpg', 'My new book is out!', '2016-04-19 22:00:00', 0, 5),
(6, 'images/posts/lucina-1461440437-Awakening_Map.jpg', 'This map is huge!', '2016-04-20 22:00:00', 0, 6),
(7, 'images/posts/chrom-1461440527-fe.jpg', 'Cover art for FE: Awakening.', '2016-04-21 22:00:00', 0, 7),
(8, 'images/posts/bedje-1461440584-slapen.jpg', 'Want wie slaapt er nu niet graag?', '2016-04-22 22:00:00', 0, 8),
(9, 'images/posts/dickladder-1461440655-meeting.jpg', 'Straks meeting. Het zit hier al vol.', '2016-04-23 22:00:00', 0, 9),
(10, 'images/posts/thomasvanmalderen-1461440764-holhorse.jpg', 'A drawing I made.', '2016-04-24 22:00:00', 0, 10),
(11, 'images/posts/robinreyns-1462362975-bass 1.jpg', 'sdqqsq', '2016-05-04 11:56:15', 0, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `u_id` int(11) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(400) COLLATE utf8_bin NOT NULL,
  `avatar` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `bio` varchar(400) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`u_id`, `username`, `firstname`, `lastname`, `email`, `password`, `avatar`, `bio`) VALUES
(1, 'admin', 'IMDstagram', 'admin', 'admin@email.com', '$2y$12$E3eqUj3m7BqYPp33ib5qz.U.aQUOD1KRRF5dCmpQ0L580q1.FGqB6', 'images/avatars/basic_avatar.jpg', 'This is the official page of IMDstagram. Try posting some pictures!'),
(2, 'robinreyns', 'Robin', 'Reyns', 'robin@email.com', '$2y$12$.FarmgfPWxYVtvw/YWMP3eTphLeLZZ16G7NV.b.2W7ndCifpO63ny', 'images/avatars/robinreyns-1461439863-robin.jpg', 'Robin Reyns from Thomas MORE. Hello!'),
(3, 'antoinehendrickx', 'Antoine', 'Hendrickx', 'antoine@email.com', '$2y$12$eIrRKIO6n.FsslGlSxpjju8oifTRnXsJUOREc40TU3gUQy1HtfsZ6', 'images/avatars/antoinehendrickx-1461439948-antoinehendrickx-1461312837-me.jpg', 'Antoine here. I love loempia''s! '),
(4, 'jorishens', 'Joris', 'Hens', 'joris@email.com', '$2y$12$BWKfcUJOWQ0zjzzaens/N.9MKKXh7lvWKZSL0XXhFds.qgZB4w55K', 'images/avatars/jorishens-1461440167-goodbytes_thumb.jpg', 'Joris Hens, also known as Goodbytes. Now on IMDstagram!'),
(5, 'michaelrosen', 'Michael', 'Rosen', 'michael@email.com', '$2y$12$MxVW78l.if/6EhdvftPh1.LoWAEFF/xspIN77/VM56TCkNVNhxWwy', 'images/avatars/michaelrosen-1461440246-michael.png', 'Michael rosen. Child books author extraordinaire.'),
(6, 'lucina', 'Lucina', 'FE', 'lucina@fireemblem.com', '$2y$12$xuyzVnWyqkdm0QXY/z8lGe3o5.d9S.EX8AUoCim02tOpOmDRczLeq', 'images/avatars/lucina-1461440322-lucina.jpg', 'Lucina from Fire Emblem Awakening. '),
(7, 'chrom', 'Chrom', 'FE', 'chrom@fireemblem.com', '$2y$12$qOdzwvyOtMtvxEUJxB5/JOWp4BAyEbffWkO9tF0qK65uW7nZaEPIG', 'images/avatars/chrom-1461440497-chrom.png', 'Yllisean prince Chrom. Go Shepherds!'),
(8, 'bedje', 'Bedje', 'Slapen', 'bedje@slapen.be', '$2y$12$4urHq36IYfo/MO9z/R8gMOptdramH2bIG.8wuu0AngxE9c5OxR5hq', 'images/avatars/bedje-1461440558-bedje.jpg', 'Because Slapen is life.'),
(9, 'dickladder', 'Dick', 'Ladder', 'dickladder@email.nl', '$2y$12$luNw7BZl3SskmV.nuAHEyeo4eO3jFzSSTNdrU.m2KXhIwN4jfcYKq', 'images/avatars/dickladder-1461440624-dickladder.jpg', 'CEO of Dutchie Enterprises.'),
(10, 'thomasvanmalderen', 'Thomas', 'Van Malderen', 'thomas@email.com', '$2y$12$A8GZ7ssyRlHf3mEnf3X5ieG18n4nl/rX6fsE6GeopwX7LfOH5H2xm', 'images/avatars/thomasvanmalderen-1461440731-thomas.jpg', 'Tokke, de coolste jongen ooit');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexen voor tabel `follows`
--
ALTER TABLE `follows`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexen voor tabel `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`l_id`);

--
-- Indexen voor tabel `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT voor een tabel `follows`
--
ALTER TABLE `follows`
  MODIFY `f_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT voor een tabel `likes`
--
ALTER TABLE `likes`
  MODIFY `l_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT voor een tabel `posts`
--
ALTER TABLE `posts`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
