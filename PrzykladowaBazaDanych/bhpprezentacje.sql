-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Lut 2018, 08:52
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
-- Struktura tabeli dla tabeli `aktywnezdarzenie`
--

CREATE TABLE `aktywnezdarzenie` (
  `id` int(11) NOT NULL,
  `id_zdarzenia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `aktywnezdarzenie`
--

INSERT INTO `aktywnezdarzenie` (`id`, `id_zdarzenia`) VALUES
(1, 1);

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
(3, 'Zdarzenie nr 3'),
(4, 'Zdarzenie nr 4'),
(5, 'Zdarzenie nr 5'),
(6, 'Zdarzenie nr 6'),
(7, 'Zdarzenie nr 7'),
(8, 'Zdarzenie nr 8'),
(9, 'Zdarzenie nr 9'),
(10, 'Zdarzenie nr 10'),
(11, 'Zdarzenie nr 11'),
(12, 'Zdarzenie nr 12'),
(13, 'Zdarzenie nr 13'),
(14, 'Zdarzenie nr 14'),
(15, 'Zdarzenie nr 15'),
(16, 'Zdarzenie nr 16');

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
(9, 'SampleVideo_1280x720_2mb.mp4', 3, '20:02:00', '20:03:00'),
(10, 'SampleVideo_640x360_1mb.mp4', 4, '11:11:00', '11:22:00'),
(11, 'powepoint.mp4', 4, '22:22:00', '23:33:00'),
(12, 'SampleVideo_1280x720_2mb.mp4', 4, '04:44:00', '04:55:00'),
(13, 'videoplayback (5).mp4', 4, '04:54:00', '05:45:00'),
(14, 'SampleVideo_1280x720_1mb.mp4', 4, '06:25:00', '03:59:00'),
(15, 'SampleVideo_1280x720_1mb.mp4', 4, '16:36:00', '14:34:00'),
(16, 'SampleVideo_1280x720_1mb.mp4', 4, '04:34:00', '04:14:00'),
(17, 'SampleVideo_1280x720_1mb.mp4', 4, '05:35:00', '04:54:00'),
(18, 'SampleVideo_1280x720_1mb.mp4', 4, '05:15:00', '06:41:00'),
(19, 'powepoint.mp4', 5, '20:40:00', '20:45:00'),
(20, 'SampleVideo_1280x720_1mb.mp4', 5, '20:45:00', '20:47:00'),
(21, 'SampleVideo_1280x720_2mb.mp4', 5, '20:50:00', '20:55:00'),
(22, 'SampleVideo_1280x720_1mb.mp4', 6, '20:43:00', '20:44:00'),
(23, 'SampleVideo_1280x720_1mb.mp4', 7, '20:48:00', '20:49:00'),
(24, 'SampleVideo_1280x720_1mb.mp4', 7, '20:49:00', '20:49:00'),
(25, 'SampleVideo_1280x720_2mb.mp4', 8, '21:00:00', '21:10:00'),
(26, 'videoplayback (5).mp4', 9, '21:02:00', '21:05:00'),
(27, 'powepoint.mp4', 10, '06:10:00', '06:11:00'),
(28, 'SampleVideo_1280x720_1mb.mp4', 10, '06:11:00', '06:12:00'),
(29, 'SampleVideo_720x480_1mb.mp4', 10, '06:13:00', '06:14:00'),
(30, 'powepoint.mp4', 10, '06:15:00', '06:16:00'),
(31, 'powepoint.mp4', 11, '12:35:00', '12:55:00'),
(32, 'powepoint.mp4', 12, '13:16:00', '13:16:00'),
(33, 'SampleVideo_1280x720_1mb.mp4', 12, '13:17:00', '13:17:00'),
(34, 'SampleVideo_1280x720_2mb.mp4', 12, '13:18:00', '13:18:00'),
(35, 'powepoint.mp4', 13, '13:29:00', '13:33:00'),
(36, 'SampleVideo_1280x720_1mb.mp4', 13, '13:30:00', '13:33:00'),
(37, 'SampleVideo_1280x720_2mb.mp4', 13, '13:31:00', '13:33:00'),
(38, 'powepoint.mp4', 14, '13:49:00', '13:50:00'),
(39, 'SampleVideo_1280x720_1mb.mp4', 14, '13:50:00', '13:50:00'),
(40, 'videoplayback (5).mp4', 14, '13:51:00', '13:52:00'),
(41, 'SampleVideo_1280x720_1mb.mp4', 15, '18:53:00', '18:53:00'),
(42, 'SampleVideo_640x360_1mb.mp4', 15, '18:54:00', '18:54:00'),
(43, 'videoplayback (5).mp4', 15, '18:59:00', '18:58:00'),
(44, 'SampleVideo_1280x720_1mb.mp4', 16, '18:43:00', '18:43:00'),
(45, 'SampleVideo_640x360_1mb.mp4', 16, '18:45:00', '18:45:00'),
(46, 'videoplayback (5).mp4', 16, '18:47:00', '18:47:00');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `aktywnezdarzenie`
--
ALTER TABLE `aktywnezdarzenie`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT dla tabeli `aktywnezdarzenie`
--
ALTER TABLE `aktywnezdarzenie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT dla tabeli `zdarzenia`
--
ALTER TABLE `zdarzenia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT dla tabeli `zdarzenie`
--
ALTER TABLE `zdarzenie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
