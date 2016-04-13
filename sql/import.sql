-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Gegenereerd op: 13 apr 2016 om 20:06
-- Serverversie: 5.5.42
-- PHP-versie: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `db_imdstagram`
--

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `Users`
--

INSERT INTO `Users` (`id`, `username`, `firstname`, `lastname`, `email`, `password`, `avatar`, `bio`) VALUES
(1, 'admin', 'IMDstagram', 'admin', 'admin@email.com', '$2y$12$5CgRiUwfb7ulIY1bgoaUnOKdUi0CFb7gNx5dTZjDsTPMB3DvViWYO', NULL, NULL),
(2, 'robinreyns', 'Robin', 'Reyns', 'robin@email.com', '$2y$12$Mk1e.lGaU/R894D.89UYrOS1c3MRKtGEhO3i/ibsu0bVAhme/g1Yu', NULL, NULL),
(3, 'antoinehendrickx', 'Antoine', 'Hendrickx', 'antoine@email.com', '$2y$12$fRvEzri7f3GZ4aujwZUZWe75u3mc2MKFrvM21eX0.cFpayjDFNkKO', NULL, NULL),
(4, 'jorishens', 'Joris', 'Hens', 'joris@email.com', '$2y$12$abem1GYOSWxGOTAYCBzjjOuxH1MTcuxWpCNnp9/RQSOVRye2AvSta', NULL, NULL),
(5, 'michaelrosen', 'Michael', 'Rosen', 'michael@email.com', '$2y$12$InHmZq.HsNjPhbeliwS69uGPZDFy7cj5EnjWe3oPuPYgqt1x0St3O', NULL, NULL),
(6, 'lucina', 'Lucina', 'FE', 'lucina@fireemblem.com', '$2y$12$B6knAfi7aXiAChqKz1Rs1O.q23AdKYaN2NmqdiiGzCBT4jOURLkSm', NULL, NULL),
(7, 'chrom', 'Chrom', 'FE', 'chrom@fireemblem.com', '$2y$12$2ZD/YnkUHFZ7SLPrhhiideIqr8cWQTnuULFflyR5AnomtfbDibOTq', NULL, NULL),
(8, 'bedje', 'Bedje', 'Slapen', 'bedje@slapen.be', '$2y$12$38bE3Igqz1/0M0KUwFJFHODdiGaLu5bXmpLJ60zgtvkepOZH7CF3S', NULL, NULL),
(9, 'dickladder', 'Dick', 'Ladder', 'dickladder@email.nl', '$2y$12$KyPbJNRa04cz/WvweVVk3uhr/Fw3CUv4AEv00xeCUySB6rmS0YWNi', NULL, NULL),
(10, 'thomasvanmalderen', 'Thomas', 'Van Malderen', 'thomas@email.com', '$2y$12$M9dxn6DOQafKYMHyqanGIeesFjOVUO5K8uBQlcCGGxDYZbsBM4GPK', NULL, NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;