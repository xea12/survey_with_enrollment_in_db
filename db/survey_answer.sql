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
-- Struktura tabeli dla tabeli `survey_answer`
--

CREATE TABLE `survey_answer` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `sort_id` int(11) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `survey_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `survey_answer`
--

INSERT INTO `survey_answer` (`id`, `question_id`, `sort_id`, `answer`, `survey_id`) VALUES
(1, 1, 1, 'Very Unsatisfied', 1),
(2, 1, 2, 'Unsatisfied', 1),
(3, 1, 3, 'Neutral', 1),
(4, 1, 4, 'Satisfied', 1),
(5, 1, 5, 'Very Satisfied', 1),
(6, 2, 1, 'Search Engine', 1),
(7, 2, 2, 'Newsletter', 1),
(8, 2, 3, 'Advertisements', 1),
(9, 2, 4, 'Social Media', 1),
(10, 4, 1, 'Email', 1),
(11, 4, 2, 'Phone', 1),
(12, 4, 3, 'Post', 1),
(13, 3, 1, 'Very Unlikely', 1),
(14, 3, 2, 'Unlikely', 1),
(15, 3, 3, 'Neutral', 1),
(16, 3, 4, 'Likely', 1),
(17, 3, 5, 'Very Likely', 1),
(18, 1, 1, 'Bardzo niezadowolony', 2),
(19, 1, 2, 'Niezadowolony', 2),
(20, 1, 3, 'Neutralnie', 2),
(21, 1, 4, 'Zadowolony', 2),
(22, 1, 5, 'Bardzo Zadowolony', 2),
(23, 2, 1, 'Wyszukiwarka', 2),
(24, 2, 2, 'Newsletter', 2),
(25, 2, 3, 'Reklamy', 2),
(26, 2, 4, 'Social Media', 2),
(27, 4, 1, 'Email', 2),
(28, 4, 2, 'Telefon', 2),
(29, 4, 3, 'Listem', 2),
(30, 3, 1, 'Bardzo ma?o prawdopodobne', 2),
(31, 3, 2, 'Ma?o prawdopodobne', 2),
(32, 3, 3, 'Mo?e', 2),
(33, 3, 4, 'Prawdopodobnie', 2),
(34, 3, 5, 'Bardzo Prawdopodobne', 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `survey_answer`
--
ALTER TABLE `survey_answer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `survey_answer`
--
ALTER TABLE `survey_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
