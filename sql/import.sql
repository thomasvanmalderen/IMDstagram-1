-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Gegenereerd op: 21 apr 2016 om 15:29
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
(1, 'admin', 'IMDstagram', 'admin', 'admin@email.com', '$2y$12$5CgRiUwfb7ulIY1bgoaUnOKdUi0CFb7gNx5dTZjDsTPMB3DvViWYO', 'images/avatars/basic_avatar.jpg', NULL),
(2, 'robinreyns', 'Robin', 'Reyns', 'robin@email.com', '$2y$12$Mk1e.lGaU/R894D.89UYrOS1c3MRKtGEhO3i/ibsu0bVAhme/g1Yu', 'images/avatars/basic_avatar.jpg', NULL),
(3, 'antoinehendrickx', 'Antoine', 'Hendrickx', 'antoine@email.com', '$2y$12$fRvEzri7f3GZ4aujwZUZWe75u3mc2MKFrvM21eX0.cFpayjDFNkKO', 'images/avatars/basic_avatar.jpg', NULL),
(4, 'jorishens', 'Joris', 'Hens', 'joris@email.com', '$2y$12$abem1GYOSWxGOTAYCBzjjOuxH1MTcuxWpCNnp9/RQSOVRye2AvSta', 'images/avatars/basic_avatar.jpg', NULL),
(5, 'michaelrosen', 'Michael', 'Rosen', 'michael@email.com', '$2y$12$InHmZq.HsNjPhbeliwS69uGPZDFy7cj5EnjWe3oPuPYgqt1x0St3O', 'images/avatars/basic_avatar.jpg', NULL),
(6, 'lucina', 'Lucina', 'FE', 'lucina@fireemblem.com', '$2y$12$B6knAfi7aXiAChqKz1Rs1O.q23AdKYaN2NmqdiiGzCBT4jOURLkSm', 'images/avatars/basic_avatar.jpg', NULL),
(7, 'chrom', 'Chrom', 'FE', 'chrom@fireemblem.com', '$2y$12$2ZD/YnkUHFZ7SLPrhhiideIqr8cWQTnuULFflyR5AnomtfbDibOTq', 'images/avatars/basic_avatar.jpg', NULL),
(8, 'bedje', 'Bedje', 'Slapen', 'bedje@slapen.be', '$2y$12$38bE3Igqz1/0M0KUwFJFHODdiGaLu5bXmpLJ60zgtvkepOZH7CF3S', 'images/avatars/basic_avatar.jpg', NULL),
(9, 'dickladder', 'Dick', 'Ladder', 'dickladder@email.nl', '$2y$12$KyPbJNRa04cz/WvweVVk3uhr/Fw3CUv4AEv00xeCUySB6rmS0YWNi', 'images/avatars/basic_avatar.jpg', NULL),
(10, 'thomasvanmalderen', 'Thomas', 'Van Malderen', 'thomas@email.com', '$2y$12$nTROvXtEF2AEV7nTtm1FbO4HeE0Q.OWaWj0vRYtRX9da/XPcHLgd6', 'images/avatars/thomasvanmalderen-1461156950-bord.jpg', 'Tokke, de coolste jongen ooit');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;