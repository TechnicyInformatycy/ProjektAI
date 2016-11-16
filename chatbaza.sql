-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Lis 2016, 12:51
-- Wersja serwera: 10.1.16-MariaDB
-- Wersja PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `chatbaza`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `chat_account`
--

CREATE TABLE `chat_account` (
  `id` int(11) NOT NULL,
  `login` varchar(50) NOT NULL,
  `haslo` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `aktywny` tinyint(1) NOT NULL DEFAULT '0',
  `avatar` varchar(450) NOT NULL DEFAULT 'http://forum.wegierskie.com/images/avatars/default_avatar.png?dateline=1339801919'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `chat_account`
--

INSERT INTO `chat_account` (`id`, `login`, `haslo`, `email`, `aktywny`, `avatar`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'bronek1342@gmail.com', 1, 'http://forum.wegierskie.com/images/avatars/default_avatar.png?dateline=1339801919'),
(2, 'adminek', '21232f297a57a5a743894a0e4a801fc3', 'bronek111@gmail.com', 0, 'http://forum.wegierskie.com/images/avatars/default_avatar.png?dateline=1339801919');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `chat_message`
--

CREATE TABLE `chat_message` (
  `id` int(11) NOT NULL,
  `wiadomosc` varchar(500) NOT NULL,
  `idusera` int(11) NOT NULL,
  `data` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `chat_message`
--

INSERT INTO `chat_message` (`id`, `wiadomosc`, `idusera`, `data`) VALUES
(1, 'Siemka co tam u ciebie ? ', 1, '2016-15-11 15:55'),
(2, 'a nic ok', 1, '2016-15-15'),
(3, 'fsfdsse', 1, '2016-15-15'),
(4, 'gerreerger', 1, '2016-15-15'),
(5, 'fefee', 1, '2016-15-15'),
(6, 'feffewsfgwefw', 1, '2016-15-15'),
(7, 'ewefwfwe', 1, '2016-15-15'),
(8, '2016-15-15terger', 1, '2016-15-15'),
(9, '2016-15-15', 1, '2016-15-15');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `chat_account`
--
ALTER TABLE `chat_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `chat_account`
--
ALTER TABLE `chat_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
