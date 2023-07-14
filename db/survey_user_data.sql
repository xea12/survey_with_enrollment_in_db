-- phpMyAdmin SQL Dump
-- version 4.9.10
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 14 Lip 2023, 13:01
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
-- Struktura tabeli dla tabeli `survey_user_data`
--

CREATE TABLE `survey_user_data` (
  `id` int(11) NOT NULL,
  `solved` int(11) NOT NULL,
  `email` varchar(127) NOT NULL,
  `comments` varchar(10000) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `survey_user_data`
--

INSERT INTO `survey_user_data` (`id`, `solved`, `email`, `comments`, `customer_id`) VALUES
(1, 15, 'lukasz@drtusz.pl', 'fd', 198219),
(2, 16, 'lukasz@drtusz.pl', 'fgf', 198219),
(3, 17, 'lukasz@drtusz.pl', 'ds', 198219),
(4, 1, 'stankiewicz.lukasz90@gmail.com', 's', 198219),
(5, 18, 'lukasz@drtusz.pl', 's', 198219),
(6, 1, 'siema23@o2.pl', 'ds', 198219),
(7, 19, 'lukasz@drtusz.pl', 'd', 198219),
(8, 20, 'lukasz@drtusz.pl', 'ds', 198219),
(9, 21, 'lukasz@drtusz.pl', 'ds', 198219),
(10, 22, 'lukasz@drtusz.pl', 'gf', 198219),
(11, 23, 'lukasz@drtusz.pl', 'gf', 198219),
(12, 24, 'lukasz@drtusz.pl', 'ds', 198219),
(13, 1, 'admin@admin.com', 'd', 0),
(14, 25, 'lukasz@drtusz.pl', 'f', 198219),
(15, 26, 'lukasz@drtusz.pl', 'nh', 198219),
(16, 27, 'lukasz@drtusz.pl', 'fd', 198219),
(17, 28, 'lukasz@drtusz.pl', 'ds', 198219),
(18, 29, 'lukasz@drtusz.pl', 'd', 198219),
(19, 30, 'lukasz@drtusz.pl', 'f', 198219),
(20, 31, 'lukasz@drtusz.pl', 'd', 198219),
(21, 32, 'lukasz@drtusz.pl', 'd', 198219),
(22, 33, 'lukasz@drtusz.pl', 'hb', 198219),
(23, 34, 'lukasz@drtusz.pl', 'ppppp', 198219),
(24, 35, 'lukasz@drtusz.pl', 'nie !', 198219),
(25, 36, 'lukasz@drtusz.pl', 'h', 198219),
(26, 37, 'lukasz@drtusz.pl', 'd', 198219),
(27, 38, 'lukasz@drtusz.pl', 'd', 198219),
(28, 39, 'lukasz@drtusz.pl', 'dsds', 198219),
(29, 40, 'lukasz@drtusz.pl', 'ds', 198219),
(30, 41, 'lukasz@drtusz.pl', 'ds', 198219),
(31, 2, 'siema23@o2.pl', 'no mo?e byc', 0),
(32, 1, 'nicola@gmail.com', 'dsd', 0);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `survey_user_data`
--
ALTER TABLE `survey_user_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `survey_user_data`
--
ALTER TABLE `survey_user_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
