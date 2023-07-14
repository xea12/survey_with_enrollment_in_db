-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 14 Lip 2023, 13:02
-- Wersja serwera: 10.2.43-MariaDB-log
-- Wersja PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mbeavis_devsklep`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `survey_question`
--

CREATE TABLE `survey_question` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question` varchar(255) CHARACTER SET utf8mb4 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `survey_question`
--

INSERT INTO `survey_question` (`id`, `survey_id`, `question_id`, `question`) VALUES
(1, 1, 1, 'How would you rate your experience with us?'),
(2, 1, 2, 'Where did you hear about us?'),
(3, 1, 3, 'How likely are you to recommend us?'),
(4, 1, 4, 'How would you like us to respond to you?'),
(5, 2, 1, 'Jak oceniasz swoje doświadczenia z nami?'),
(6, 2, 2, 'Gdzie się o nas dowiedziałeś?'),
(7, 2, 3, 'Jak bardzo prawdopodobne jest, że nas polecisz?'),
(8, 2, 4, 'Jak chcesz, abyśmy Ci odpowiedzieli?');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `survey_question`
--
ALTER TABLE `survey_question`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `survey_question`
--
ALTER TABLE `survey_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
