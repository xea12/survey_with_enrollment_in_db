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
-- Struktura tabeli dla tabeli `survey_responses`
--

CREATE TABLE `survey_responses` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `survey_responses`
--

INSERT INTO `survey_responses` (`id`, `survey_id`, `customer_id`, `question_id`, `answer`) VALUES
(1, 1, 198219, 1, 'Satisfied'),
(2, 1, 198219, 2, 'Newsletter'),
(3, 1, 198219, 3, 'Likely'),
(4, 1, 198219, 4, 'Phone'),
(5, 1, 198219, 1, 'Neutral'),
(6, 1, 198219, 2, 'Advertisements'),
(7, 1, 198219, 3, 'Likely'),
(8, 1, 198219, 4, 'Phone'),
(9, 1, 198219, 1, '3'),
(10, 1, 198219, 2, '7'),
(11, 1, 198219, 3, '16'),
(12, 1, 198219, 4, '11,12'),
(13, 1, 198219, 1, 'Satisfied'),
(14, 1, 198219, 2, 'Newsletter'),
(15, 1, 198219, 3, 'Likely'),
(16, 1, 198219, 4, 'Phone'),
(17, 1, 198219, 1, 'Neutral'),
(18, 1, 198219, 2, 'Search Engine'),
(19, 1, 198219, 3, 'Neutral'),
(20, 1, 198219, 4, 'Phone,Post'),
(21, 1, 198219, 1, 'Satisfied'),
(22, 1, 198219, 2, 'Newsletter'),
(23, 1, 198219, 3, 'Neutral'),
(24, 1, 198219, 4, 'Phone,Post'),
(25, 1, 198219, 1, 'Satisfied'),
(26, 1, 198219, 2, 'Newsletter'),
(27, 1, 198219, 3, 'Neutral'),
(28, 1, 198219, 4, 'Phone,Post'),
(29, 2, 0, 1, 'Neutralnie'),
(30, 2, 0, 2, 'Newsletter'),
(31, 2, 0, 3, 'Prawdopodobnie'),
(32, 2, 0, 4, 'Telefon,Listem'),
(33, 1, 0, 1, 'Neutral'),
(34, 1, 0, 2, 'Newsletter'),
(35, 1, 0, 3, 'Likely'),
(36, 1, 0, 4, 'Phone');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `survey_responses`
--
ALTER TABLE `survey_responses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `survey_responses`
--
ALTER TABLE `survey_responses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
