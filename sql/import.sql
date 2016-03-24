-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Gegenereerd op: 24 mrt 2016 om 10:05
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
  `id` int(11) NOT NULL,
  `username` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `fullname` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(400) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `Users`
--

INSERT INTO `Users` (`id`, `username`, `fullname`, `email`, `password`) VALUES
(1, 'admin', 'admin', 'admin@email.com', '$2y$12$V3kQhSVz/Gwn3UxNv5tY..FINJMnSFrUrx/qmfiupf0BMMcGym/SC'),
(2, 'robinreyns', 'Robin Reyns', 'robin@email.com', '$2y$12$s/yz3ygWket2PIto8nScLOqcxOnaLXRqSz53WfoMNBn5ODe4iqfxG'),
(3, 'antoinehendrickx', 'Antoine Hendrickx', 'antoine@email.com', '$2y$12$/GM401xC.P44d4Hh2zX8ye4JU1PX0tgduEd5ndvVIOCUg1mCkOdNi'),
(4, 'thomasvanmalderen', 'Thomas Van Malderen', 'thomas@email.com', '$2y$12$NjUgANyha/qdmdzh0sB1auwb8EGPn3jVOsxW0oGptDIZRsI/cgixe'),
(5, 'jorishens', 'Joris Hens', 'joris@email.com', '$2y$12$TdPhujp1ZLkKG.B9GIRVe.Lm7IOr8VDwn/naHoAJiVmw8lo/YpZk2'),
(6, 'michaelrosen', 'Michael Rosen', 'michael@email.com', '$2y$12$OKyUh3Hx0UOTZGKegq6uHOeiWF0wKlHLA5YsChwTXQPnjtBueBg7S'),
(7, 'lucina', 'Lucina FE', 'lucina@fireemblem.com', '$2y$12$roXGNs.Uo9uAkJpepqxe1uPP1aEPChamGlDa6BHXdpxbmefPrupwW'),
(8, 'chrom', 'Chrom FE', 'chrom@fireemblem.com', '$2y$12$sFWpiYqYjqwiPU4L1gaZTOSaAZ6vppDJtT2jE.04CQwZY7uySAkbe'),
(9, 'bedje', 'Bedje', 'bedje@slapen.be', '$2y$12$MBX0gb5pSvh0ZtBtB43IL.yPrK9lqzdRhoigHXRB857RjNTriZeRO'),
(10, 'dickladder', 'Dick Ladder', 'dickladder@email.nl', '$2y$12$iOwpqypycUgvz96qODvQlu77FWldRTTqX4CvMyW4ulixzOJMheYjm');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;