-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Mar 2021, 18:23
-- Wersja serwera: 10.4.17-MariaDB
-- Wersja PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sbd-projekt`
--

DELIMITER $$
--
-- Procedury
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `rozwiaz_umowe` (IN `numer_umowy` VARCHAR(100))  begin delete from umowy where nr_umowy = numer_umowy; end$$

--
-- Funkcje
--
CREATE DEFINER=`root`@`localhost` FUNCTION `Ile_umow` (`PESEL` VARCHAR(11)) RETURNS INT(11) begin
declare l int;
declare w int;
    select count(*) into l from umowy where Lokator = PESEL;
    select count(*) into w from umowy where Wynajmujacy = PESEL;
    return l + w;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `budynki`
--

CREATE TABLE `budynki` (
  `adres` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `typ` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Nazwa` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `budynki`
--

INSERT INTO `budynki` (`adres`, `typ`, `Nazwa`) VALUES
('Wojska Polskiego 3', 'Blok mieszkalny', 'Spółdzielnia 22'),
('Wojska Polskiego 6', 'Wieżowiec', 'Spółdzielnia 22');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Zrzut danych tabeli `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20210301025257', '2021-03-01 03:53:34', 15431),
('DoctrineMigrations\\Version20210301235741', '2021-03-02 00:58:10', 12083),
('DoctrineMigrations\\Version20210302200705', '2021-03-02 21:07:46', 3567),
('DoctrineMigrations\\Version20210303090705', '2021-03-03 10:07:31', 988);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `obiekty_najmu`
--

CREATE TABLE `obiekty_najmu` (
  `mieszkanie` int(11) NOT NULL,
  `nr_mieszkania` decimal(3,0) NOT NULL,
  `powierzchnia` decimal(7,2) NOT NULL,
  `rodzaj_obiektu` enum('Mieszkanie','Pokój') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `liczba_pokoi` decimal(2,0) DEFAULT NULL,
  `typ_mieszkania` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nr_pokoju` decimal(3,0) DEFAULT NULL,
  `Adres` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `obiekty_najmu`
--

INSERT INTO `obiekty_najmu` (`mieszkanie`, `nr_mieszkania`, `powierzchnia`, `rodzaj_obiektu`, `liczba_pokoi`, `typ_mieszkania`, `nr_pokoju`, `Adres`) VALUES
(10, '24', '300.00', 'Mieszkanie', '3', 'kawalerka', NULL, 'Wojska Polskiego 6'),
(12, '23', '13.00', 'Pokój', NULL, NULL, '1', 'Wojska Polskiego 3');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `osoby`
--

CREATE TABLE `osoby` (
  `pesel` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imie` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nazwisko` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nr_telefonu` varchar(9) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adres` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `osoby`
--

INSERT INTO `osoby` (`pesel`, `imie`, `nazwisko`, `nr_telefonu`, `adres`, `email`) VALUES
('12345678930', 'Jan', 'Kowalski', '123456789', 'XD 8/7', NULL),
('12345678931', 'Adam', 'Kowalski', '123456789', 'Wojska Polskiego 4/7', NULL),
('12345678939', 'Adam', 'Kowalski', '123456789', 'Wojska Polskiego 4/7', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `spoldzielnie`
--

CREATE TABLE `spoldzielnie` (
  `nazwa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adres` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nr_telefonu` decimal(9,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `spoldzielnie`
--

INSERT INTO `spoldzielnie` (`nazwa`, `adres`, `nr_telefonu`) VALUES
('Spółdzielnia 22', 'Aleje Jerozolimskie 4', '123456789'),
('Spółdzielnia 26', 'Jana Pawła', '123456789');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `umowy`
--

CREATE TABLE `umowy` (
  `id` int(11) NOT NULL,
  `nr_umowy` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wynajem_od` date NOT NULL,
  `wynajem_do` date NOT NULL,
  `data_zawarcia_umowy` date NOT NULL,
  `rodzaj_umowy` enum('Krótkoterminowe','Długoterminowe') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Lokator` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Wynajmujacy` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mieszkanie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `umowy`
--

INSERT INTO `umowy` (`id`, `nr_umowy`, `wynajem_od`, `wynajem_do`, `data_zawarcia_umowy`, `rodzaj_umowy`, `Lokator`, `Wynajmujacy`, `Mieszkanie`) VALUES
(13, '123abc', '2021-03-03', '2021-03-03', '2021-03-03', 'Krótkoterminowe', '12345678930', '12345678931', 10),
(14, '123abcd', '2021-03-03', '2021-03-03', '2021-03-03', 'Długoterminowe', '12345678930', '12345678939', 10),
(17, '123abceee', '2021-03-13', '2021-03-27', '2021-02-25', 'Krótkoterminowe', '12345678930', '12345678931', 10),
(18, '123434', '1900-12-23', '1900-12-23', '1900-12-23', 'Krótkoterminowe', '12345678930', '12345678931', 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wyposazenie`
--

CREATE TABLE `wyposazenie` (
  `id` int(11) NOT NULL,
  `nazwa` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ilosc` decimal(2,0) NOT NULL,
  `Mieszkanie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `wyposazenie`
--

INSERT INTO `wyposazenie` (`id`, `nazwa`, `ilosc`, `Mieszkanie`) VALUES
(9, 'Pralka', '3', 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zwierzeta`
--

CREATE TABLE `zwierzeta` (
  `id` int(11) NOT NULL,
  `gatunek` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ilosc` decimal(2,0) NOT NULL,
  `Id_umowy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `zwierzeta`
--

INSERT INTO `zwierzeta` (`id`, `gatunek`, `ilosc`, `Id_umowy`) VALUES
(8, 'Małpa', '4', 14),
(9, 'Pies', '4', 13);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `budynki`
--
ALTER TABLE `budynki`
  ADD PRIMARY KEY (`adres`),
  ADD KEY `IDX_5001ADE1A1D6D22A` (`Nazwa`);

--
-- Indeksy dla tabeli `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indeksy dla tabeli `obiekty_najmu`
--
ALTER TABLE `obiekty_najmu`
  ADD PRIMARY KEY (`mieszkanie`),
  ADD KEY `Adres_idx` (`Adres`);

--
-- Indeksy dla tabeli `osoby`
--
ALTER TABLE `osoby`
  ADD PRIMARY KEY (`pesel`);

--
-- Indeksy dla tabeli `spoldzielnie`
--
ALTER TABLE `spoldzielnie`
  ADD PRIMARY KEY (`nazwa`);

--
-- Indeksy dla tabeli `umowy`
--
ALTER TABLE `umowy`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_34701DC8858B0C32` (`Lokator`),
  ADD KEY `IDX_34701DC868A70A16` (`Wynajmujacy`),
  ADD KEY `IDX_34701DC831EAEC7E` (`Mieszkanie`);

--
-- Indeksy dla tabeli `wyposazenie`
--
ALTER TABLE `wyposazenie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_25B6630931EAEC7E` (`Mieszkanie`);

--
-- Indeksy dla tabeli `zwierzeta`
--
ALTER TABLE `zwierzeta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DB6C451323833EAE` (`Id_umowy`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `obiekty_najmu`
--
ALTER TABLE `obiekty_najmu`
  MODIFY `mieszkanie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `umowy`
--
ALTER TABLE `umowy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT dla tabeli `wyposazenie`
--
ALTER TABLE `wyposazenie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `zwierzeta`
--
ALTER TABLE `zwierzeta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `budynki`
--
ALTER TABLE `budynki`
  ADD CONSTRAINT `FK_5001ADE1A1D6D22A` FOREIGN KEY (`Nazwa`) REFERENCES `spoldzielnie` (`nazwa`);

--
-- Ograniczenia dla tabeli `obiekty_najmu`
--
ALTER TABLE `obiekty_najmu`
  ADD CONSTRAINT `FK_9C29F4DB9106E5EA` FOREIGN KEY (`Adres`) REFERENCES `budynki` (`adres`);

--
-- Ograniczenia dla tabeli `umowy`
--
ALTER TABLE `umowy`
  ADD CONSTRAINT `FK_34701DC831EAEC7E` FOREIGN KEY (`Mieszkanie`) REFERENCES `obiekty_najmu` (`mieszkanie`),
  ADD CONSTRAINT `FK_34701DC868A70A16` FOREIGN KEY (`Wynajmujacy`) REFERENCES `osoby` (`pesel`),
  ADD CONSTRAINT `FK_34701DC8858B0C32` FOREIGN KEY (`Lokator`) REFERENCES `osoby` (`pesel`);

--
-- Ograniczenia dla tabeli `wyposazenie`
--
ALTER TABLE `wyposazenie`
  ADD CONSTRAINT `FK_25B6630931EAEC7E` FOREIGN KEY (`Mieszkanie`) REFERENCES `obiekty_najmu` (`mieszkanie`);

--
-- Ograniczenia dla tabeli `zwierzeta`
--
ALTER TABLE `zwierzeta`
  ADD CONSTRAINT `FK_DB6C451323833EAE` FOREIGN KEY (`Id_umowy`) REFERENCES `umowy` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
