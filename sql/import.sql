-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Gegenereerd op: 17 mrt 2016 om 22:12
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

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `username` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `fullname` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(400) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Gegevens worden geëxporteerd voor tabel `Users`
--

INSERT INTO `Users` (`id`, `username`, `fullname`, `email`, `password`) VALUES
(1, 'thomasvanmalderen', 'Thomas Van Malderen', 'Thomas@email.com', '$2y$12$SPnOX5Cm.CtFXDzSVMVIeuYKNhoO39Tc5kjxTHGsQx0Vn4lzDw28e'),
(2, 'Chrom', 'Chrom FE', 'chrom@fireemblem.com', '$2y$12$EdYGBer5qGO2OqhXLkf.ZeocfqvMKKUyIJgyhCWqA6LeNz/lWe9fK'),
(3, 'thomasmiller', 'Thomas Miller', 'thomasmiller@email.com', '$2y$12$wwsDJu6yvncYtUxN6o5HR.dDdZECEerwOvZc5aDIwIFEdZFQkbwK.'),
(4, 'michaelrosen', 'Michael Rosen', 'michaelrosen@poems.com', '$2y$12$R6ZNEs8IQSNzt0.sJQLTfeY98/Qr/2fy0rnlQ292P5F8AOtb.sHvS'),
(5, 'Lucina', 'Lucina FE', 'lucina@fireemblem.com', '$2y$12$ygmX5i7iN5kcVtan21wL7eC/5Vo.6.VrURmM51U4ilz1M2OPtwX/K');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;