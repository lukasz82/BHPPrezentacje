-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 31 Sty 2018, 18:26
-- Wersja serwera: 10.1.19-MariaDB
-- Wersja PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `bhpprezentacje`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdarzenia`
--

CREATE TABLE `zdarzenia` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `zdarzenia`
--

INSERT INTO `zdarzenia` (`id`, `nazwa`) VALUES
(1, 'Zdarzenie nr 1'),
(2, 'Zdarzenie nr 2'),
(3, 'Zdarzenie nr 3');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zdarzenie`
--

CREATE TABLE `zdarzenie` (
  `id` int(11) NOT NULL,
  `dir_filmu` text COLLATE utf8_unicode_ci,
  `id_zdarzenia` int(11) DEFAULT NULL,
  `start` time DEFAULT NULL,
  `stop` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `zdarzenie`
--

INSERT INTO `zdarzenie` (`id`, `dir_filmu`, `id_zdarzenia`, `start`, `stop`) VALUES
(1, 'powepoint.mp4', 1, '12:11:00', '13:33:00'),
(2, 'videoplayback (5).mp4', 1, '14:55:00', '16:59:00'),
(3, 'SampleVideo_1280x720_2mb.mp4', 1, '17:00:00', '19:00:00'),
(4, 'powepoint.mp4', 1, '19:00:00', '21:00:00'),
(5, 'videoplayback (5).mp4', 2, '22:22:00', '23:33:00'),
(6, 'powepoint.mp4', 2, '23:44:00', '12:22:00'),
(7, 'powepoint.mp4', 3, '20:00:00', '20:01:00'),
(8, 'SampleVideo_720x480_1mb.mp4', 3, '20:01:00', '20:02:00'),
(9, 'SampleVideo_1280x720_2mb.mp4', 3, '20:02:00', '20:03:00');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `zdarzenia`
--
ALTER TABLE `zdarzenia`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zdarzenie`
--
ALTER TABLE `zdarzenie`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `zdarzenia`
--
ALTER TABLE `zdarzenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `zdarzenie`
--
ALTER TABLE `zdarzenie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
