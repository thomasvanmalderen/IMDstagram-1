-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Gegenereerd op: 17 mrt 2016 om 12:35
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
  `email` varchar(300) COLLATE utf8_bin DEFAULT NULL,
  `password` varchar(400) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`);