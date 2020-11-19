-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 10 nov 2020 om 19:09
-- Serverversie: 10.4.11-MariaDB
-- PHP-versie: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthone`
--
CREATE DATABASE IF NOT EXISTS `healthone` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `healthone`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artsen`
--

CREATE TABLE `artsen` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `telefoon` varchar(14) NOT NULL,
  `specialisatie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `artsen`
--

INSERT INTO `artsen` (`id`, `naam`, `telefoon`, `specialisatie`) VALUES
(1, 'dhr dr. Mensa', '070-8882222', 'KNO arts');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `patienten`
--

CREATE TABLE `patienten` (
  `id` int(11) NOT NULL,
  `naam` varchar(50) NOT NULL,
  `adres` varchar(100) NOT NULL,
  `woonplaats` varchar(50) NOT NULL,
  `zknummer` varchar(12) NOT NULL,
  `geboortedatum` varchar(12) NOT NULL,
  `soortverzekering` varchar(15) NOT NULL,
  `artsid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `patienten`
--

INSERT INTO `patienten` (`id`, `naam`, `adres`, `woonplaats`, `zknummer`, `geboortedatum`, `soortverzekering`, `artsid`) VALUES
(12, 'Willem Konings', 'soestdijk', 'baarn', 'AA 1', '27-4-1967', 'small risk', 1),
(15, 'Dorkooll', 'copierlaan 8', 'Dam', 'kdneo111788', '1-1-1970', 'eigen risicos', 1),
(19, 'Jan Keizer', 'Dorpsplein 1', 'Volendam', 'Garn1000888', '1-1-1970', 'all in', 1),
(24, 'theo van gogh', 'Sarphatistraat 1', 'Amsterdam', 'zk111', '1-4-1954', 'minimaal', 1),
(25, 'anton hensbergen', 'tinburg 12', 'VOORBURG', 'zk 222', '1-1-1970', 'all in', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', 'A008BB4D28471677701431C18AB2514035D91BAE7F84F0C08FBE13D457809C2D', 'admin');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artsen`
--
ALTER TABLE `artsen`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `patienten`
--
ALTER TABLE `patienten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `arts_id` (`artsid`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artsen`
--
ALTER TABLE `artsen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `patienten`
--
ALTER TABLE `patienten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `patienten`
--
ALTER TABLE `patienten`
  ADD CONSTRAINT `fk_patient_arts` FOREIGN KEY (`artsid`) REFERENCES `artsen` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
