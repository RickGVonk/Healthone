-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2021 at 11:20 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthone`
--

-- --------------------------------------------------------

--
-- Table structure for table `artsen`
--

CREATE TABLE `artsen` (
  `id` int(11) NOT NULL,
  `naam` varchar(100) NOT NULL,
  `telefoon` varchar(14) NOT NULL,
  `specialisatie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artsen`
--

INSERT INTO `artsen` (`id`, `naam`, `telefoon`, `specialisatie`) VALUES
(1, 'dhr dr. Mensa', '070-8882222', 'KNO arts');

-- --------------------------------------------------------

--
-- Table structure for table `bezorger`
--

CREATE TABLE `bezorger` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phonenumber` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bezorger`
--

INSERT INTO `bezorger` (`id`, `name`, `phonenumber`) VALUES
(1, 'henk', '+316222222');

-- --------------------------------------------------------

--
-- Table structure for table `medicijnen`
--

CREATE TABLE `medicijnen` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `verzekerd` tinyint(1) NOT NULL,
  `werking` text NOT NULL,
  `bijwerking` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicijnen`
--

INSERT INTO `medicijnen` (`id`, `name`, `verzekerd`, `werking`, `bijwerking`) VALUES
(2, 'levonctirizine', 1, 'anti-histamine', 'vermoeidheid'),
(3, 'pantaprozol', 0, 'werking', 'bijwerking'),
(12, 'Vitamine D', 0, 'energie', ''),
(13, 'ibruprufen', 1, 'tegen hoofdpijn', ''),
(14, 'wajong', 1, 'zorgt ervoor dat je beterslaapt', 'hoofdpijn'),
(2, 'levonctirizine', 1, 'anti-histamine', 'vermoeidheid'),
(3, 'pantaprozol', 0, 'werking', 'bijwerking'),
(12, 'Vitamine D', 0, 'energie', ''),
(13, 'ibruprufen', 1, 'tegen hoofdpijn', ''),
(14, 'wajong', 1, 'zorgt ervoor dat je beterslaapt', 'hoofdpijn');

-- --------------------------------------------------------

--
-- Table structure for table `patienten`
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
-- Dumping data for table `patienten`
--

INSERT INTO `patienten` (`id`, `naam`, `adres`, `woonplaats`, `zknummer`, `geboortedatum`, `soortverzekering`, `artsid`) VALUES
(12, 'Willem Konings', 'soestdijk', 'baarn', 'AA 1', '27-4-1967', 'small risk', 1),
(15, 'Dorkooll', 'copierlaan 8', 'Dam', 'kdneo111788', '1-1-1970', 'eigen risicos', 1),
(19, 'Jan Keizer', 'Dorpsplein 1', 'Volendam', 'Garn1000888', '1-1-1970', 'all in', 1),
(24, 'theo van gogh', 'Sarphatistraat 1', 'Amsterdam', 'zk111', '1-4-1954', 'minimaal', 1),
(25, 'anton hensbergen', 'tinburg 12', 'VOORBURG', 'zk 222', '1-1-1970', 'all in', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '0876dfca6d6fedf99b2ab87b6e2fed4bd4051ede78a8a9135b500b2e94d99b88', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artsen`
--
ALTER TABLE `artsen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patienten`
--
ALTER TABLE `patienten`
  ADD PRIMARY KEY (`id`),
  ADD KEY `arts_id` (`artsid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artsen`
--
ALTER TABLE `artsen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patienten`
--
ALTER TABLE `patienten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patienten`
--
ALTER TABLE `patienten`
  ADD CONSTRAINT `fk_patient_arts` FOREIGN KEY (`artsid`) REFERENCES `artsen` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
