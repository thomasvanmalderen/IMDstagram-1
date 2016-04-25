-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Gegenereerd op: 23 apr 2016 om 21:47
-- Serverversie: 5.5.42
-- PHP-versie: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_imdstagram`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Posts`
--

DROP TABLE IF EXISTS `Posts`;
CREATE TABLE `Posts` (
  `id` int(11) NOT NULL,
  `picture` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `tags` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `Report` int(5) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `Posts`
--

INSERT INTO `Posts` (`id`, `picture`, `description`, `tags`, `Report`, `idUser`) VALUES
(1, 'images/posts/admin-1461439777-thegym.jpg', 'The fabled creativity gym', '#gym #thomasmore', 0, 1),
(2, 'images/posts/robinreyns-1461439899-superbrein.jpg', 'Superbrein, super programma!', '#project2 #ketnet', 0, 2),
(3, 'images/posts/antoinehendrickx-1461439979-akira.jpg', 'Akira is a great movie. ', '#akira #OVA', 0, 3),
(4, 'images/posts/jorishens-1461440193-stempeltje-fb.jpg', 'My new app: stempeltje!', '#app #goodbytes', 0, 4),
(5, 'images/posts/michaelrosen-1461440268-rosen book.jpg', 'My new book is out!', '#books #rosen', 0, 5),
(6, 'images/posts/lucina-1461440437-Awakening_Map.jpg', 'This map is huge!', '#FE #map', 0, 6),
(7, 'images/posts/chrom-1461440527-fe.jpg', 'Cover art for FE: Awakening.', '#FE #art', 0, 7),
(8, 'images/posts/bedje-1461440584-slapen.jpg', 'Want wie slaapt er nu niet graag?', '#zzz #bed', 0, 8),
(9, 'images/posts/dickladder-1461440655-meeting.jpg', 'Straks meeting. Het zit hier al vol.', '#work #busy', 0, 9),
(10, 'images/posts/thomasvanmalderen-1461440764-holhorse.jpg', 'A drawing I made.', '#art #jojo', 0, 10);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE `Users` (
  `id` int(11) unsigned NOT NULL,
  `username` varchar(255) COLLATE utf8_bin NOT NULL,
  `firstname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(400) COLLATE utf8_bin NOT NULL,
  `avatar` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `bio` varchar(400) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `Users`
--

INSERT INTO `Users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `avatar`, `bio`) VALUES
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
-- Indexen voor tabel `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `Posts`
--
ALTER TABLE `Posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT voor een tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;