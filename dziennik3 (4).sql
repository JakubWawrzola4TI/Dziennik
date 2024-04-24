-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 10:43 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dziennik3`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klasa`
--

CREATE TABLE `klasa` (
  `Id_klasy` int(11) NOT NULL,
  `Nazwa_klasy` varchar(50) DEFAULT NULL,
  `Wychowawca` int(11) DEFAULT NULL,
  `plan_klasy_poniedzialek` int(11) DEFAULT NULL,
  `plan_klasy_wtorek` int(11) DEFAULT NULL,
  `plan_klasy_sroda` int(11) DEFAULT NULL,
  `plan_klasy_czwartek` int(11) DEFAULT NULL,
  `plan_klasy_piatek` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klasa`
--

INSERT INTO `klasa` (`Id_klasy`, `Nazwa_klasy`, `Wychowawca`, `plan_klasy_poniedzialek`, `plan_klasy_wtorek`, `plan_klasy_sroda`, `plan_klasy_czwartek`, `plan_klasy_piatek`) VALUES
(1, '1A', 1, 1, 2, 3, 4, 5),
(2, '1B', 2, 6, 7, 8, 9, 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nauczyciele`
--

CREATE TABLE `nauczyciele` (
  `Id_nauczyciela` int(11) NOT NULL,
  `Imie` varchar(50) DEFAULT NULL,
  `Nazwisko` varchar(50) DEFAULT NULL,
  `Pesel` varchar(11) DEFAULT NULL,
  `Numer_telefonu` varchar(15) DEFAULT NULL,
  `Login` varchar(50) DEFAULT NULL,
  `Haslo` varchar(50) DEFAULT NULL,
  `id_szkoly` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nauczyciele`
--

INSERT INTO `nauczyciele` (`Id_nauczyciela`, `Imie`, `Nazwisko`, `Pesel`, `Numer_telefonu`, `Login`, `Haslo`, `id_szkoly`) VALUES
(1, 'Anna', 'Kowalska', '06250601211', '123456789', 'akowalska', 'haslo123', 1),
(2, 'Tomasz', 'Nowak', '06250601212', '234567890', 'tnowak', 'haslo456', 1),
(3, 'Katarzyna', 'Wójcik', '06250601213', '345678901', 'kwojcik', 'haslo789', 1),
(4, 'Michał', 'Lis', '06250601214', '456789012', 'mlis', 'haslo012', 1),
(5, 'Magdalena', 'Szymańska', '06250601215', '567890123', 'mszymanska', 'haslo345', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `obecnosc`
--

CREATE TABLE `obecnosc` (
  `Id_obecnosci` int(11) NOT NULL,
  `Id_przedmiotu` int(11) DEFAULT NULL,
  `Id_ucznia` int(11) DEFAULT NULL,
  `Data` date DEFAULT NULL,
  `Godzina` time DEFAULT NULL,
  `Czy_obecny` enum('tak','nie') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `obecnosc`
--

INSERT INTO `obecnosc` (`Id_obecnosci`, `Id_przedmiotu`, `Id_ucznia`, `Data`, `Godzina`, `Czy_obecny`) VALUES
(1, 1, 1, '2024-03-20', '08:00:00', 'tak'),
(2, 2, 1, '2024-03-20', '09:00:00', 'tak'),
(3, 1, 2, '2024-03-20', '08:00:00', 'tak'),
(4, 2, 2, '2024-03-20', '09:00:00', 'tak'),
(5, 1, 1, '2024-03-24', '17:28:18', 'nie'),
(6, 1, 1, '2024-03-20', '08:00:00', 'tak'),
(7, 2, 1, '2024-03-20', '09:00:00', 'tak'),
(8, 1, 1, '2024-03-21', '08:00:00', 'tak'),
(9, 2, 1, '2024-03-21', '09:00:00', 'tak'),
(10, 1, 1, '2024-03-22', '08:00:00', 'tak'),
(11, 2, 1, '2024-03-22', '09:00:00', 'tak'),
(12, 1, 1, '2024-03-23', '08:00:00', 'tak'),
(13, 2, 1, '2024-03-23', '09:00:00', 'tak'),
(14, 1, 1, '2024-03-24', '08:00:00', 'nie'),
(15, 2, 1, '2024-03-24', '09:00:00', 'tak'),
(16, 1, 1, '2024-03-25', '08:00:00', 'tak'),
(17, 2, 1, '2024-03-25', '09:00:00', 'tak'),
(18, 1, 1, '2024-03-26', '08:00:00', 'tak'),
(19, 2, 1, '2024-03-26', '09:00:00', 'tak'),
(20, 1, 1, '2024-03-27', '08:00:00', 'tak'),
(21, 2, 1, '2024-03-27', '09:00:00', 'tak'),
(22, 3, 5, '2024-03-24', '17:28:18', 'tak'),
(23, 3, 5, '2024-03-24', '17:28:18', 'tak'),
(24, 3, 5, '2024-03-24', '17:28:18', 'nie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `oceny`
--

CREATE TABLE `oceny` (
  `Id_oceny` int(11) NOT NULL,
  `Id_przedmiotu` int(11) DEFAULT NULL,
  `Id_ucznia` int(11) DEFAULT NULL,
  `Nazwa_oceny` varchar(50) DEFAULT NULL,
  `Opis_oceny` varchar(255) DEFAULT NULL,
  `Wartosc_oceny` int(11) DEFAULT NULL CHECK (`Wartosc_oceny` >= 1 and `Wartosc_oceny` <= 6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `oceny`
--

INSERT INTO `oceny` (`Id_oceny`, `Id_przedmiotu`, `Id_ucznia`, `Nazwa_oceny`, `Opis_oceny`, `Wartosc_oceny`) VALUES
(1, 1, 1, 'Sprawdzian', 'Sprawdzian z matematyki', 5),
(2, 1, 2, 'Sprawdzian', 'Sprawdzian z matematyki', 4),
(3, 2, 1, 'Kartkówka', 'Kartkówka z historii', 4),
(4, 2, 2, 'Kartkówka', 'Kartkówka z historii', 3),
(5, 3, 1, 'Sprawdzian', 'Sprawdzian z chemii', 5),
(6, 4, 2, 'Kartkówka', 'Kartkówka z biologii', 5),
(7, 5, 3, 'Odpowiedź ustna', 'Odpowiedź ustna z historii', 6),
(8, 2, 4, 'Sprawdzian', 'Sprawdzian z języka polskiego', 4),
(9, 1, 5, 'Kartkówka', 'Kartkówka z matematyki', 3),
(10, 3, 1, 'Kartkówka', 'Kartkówka z chemii', 4),
(11, 1, 1, 'Sprawdzian', 'Sprawdzian z matematyki', 4),
(12, 2, 1, 'Kartkówka', 'Kartkówka z języka polskiego', 5),
(13, 3, 2, 'Sprawdzian', 'Sprawdzian z chemii', 3),
(14, 4, 2, 'Kartkówka', 'Kartkówka z biologii', 4),
(15, 5, 3, 'Odpowiedź ustna', 'Odpowiedź ustna z historii', 6),
(16, 1, 3, 'Sprawdzian', 'Sprawdzian z matematyki', 5),
(17, 2, 4, 'Sprawdzian', 'Sprawdzian z języka polskiego', 4),
(18, 3, 4, 'Kartkówka', 'Kartkówka z chemii', 3),
(19, 4, 5, 'Odpowiedź ustna', 'Odpowiedź ustna z biologii', 4),
(20, 5, 5, 'Sprawdzian', 'Sprawdzian z historii', 5),
(21, 1, 16, 'Sprawdzian', 'Sprawdzian z matematyki', 4),
(22, 2, 16, 'Kartkówka', 'Kartkówka z języka polskiego', 5),
(23, 3, 16, 'Sprawdzian', 'Sprawdzian z chemii', 3),
(24, 4, 16, 'Kartkówka', 'Kartkówka z biologii', 4),
(25, 5, 16, 'Odpowiedź ustna', 'Odpowiedź ustna z historii', 6),
(26, 1, 17, 'Sprawdzian', 'Sprawdzian z matematyki', 5),
(27, 2, 17, 'Kartkówka', 'Kartkówka z języka polskiego', 4),
(28, 3, 17, 'Sprawdzian', 'Sprawdzian z chemii', 3),
(29, 4, 17, 'Kartkówka', 'Kartkówka z biologii', 5),
(30, 5, 17, 'Odpowiedź ustna', 'Odpowiedź ustna z historii', 4),
(31, 1, 18, 'Sprawdzian', 'Sprawdzian z matematyki', 3),
(32, 2, 18, 'Kartkówka', 'Kartkówka z języka polskiego', 4),
(33, 3, 18, 'Sprawdzian', 'Sprawdzian z chemii', 5),
(34, 4, 18, 'Kartkówka', 'Kartkówka z biologii', 4),
(35, 5, 18, 'Odpowiedź ustna', 'Odpowiedź ustna z historii', 5),
(36, 1, 19, 'Sprawdzian', 'Sprawdzian z matematyki', 4),
(37, 2, 19, 'Kartkówka', 'Kartkówka z języka polskiego', 3),
(38, 3, 19, 'Sprawdzian', 'Sprawdzian z chemii', 6),
(39, 4, 19, 'Kartkówka', 'Kartkówka z biologii', 4),
(40, 5, 19, 'Odpowiedź ustna', 'Odpowiedź ustna z historii', 5),
(41, 1, 20, 'Sprawdzian', 'Sprawdzian z matematyki', 5),
(42, 2, 20, 'Kartkówka', 'Kartkówka z języka polskiego', 4),
(43, 3, 20, 'Sprawdzian', 'Sprawdzian z chemii', 3),
(44, 4, 20, 'Kartkówka', 'Kartkówka z biologii', 5),
(45, 5, 20, 'Odpowiedź ustna', 'Odpowiedź ustna z historii', 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `plan_godzinowy`
--

CREATE TABLE `plan_godzinowy` (
  `Id_planu_g` int(11) NOT NULL,
  `Lekcja1` varchar(15) DEFAULT NULL,
  `Lekcja2` varchar(15) DEFAULT NULL,
  `Lekcja3` varchar(15) DEFAULT NULL,
  `Lekcja4` varchar(15) DEFAULT NULL,
  `Lekcja5` varchar(15) DEFAULT NULL,
  `Lekcja6` varchar(15) DEFAULT NULL,
  `Lekcja7` varchar(15) DEFAULT NULL,
  `Lekcja8` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan_godzinowy`
--

INSERT INTO `plan_godzinowy` (`Id_planu_g`, `Lekcja1`, `Lekcja2`, `Lekcja3`, `Lekcja4`, `Lekcja5`, `Lekcja6`, `Lekcja7`, `Lekcja8`) VALUES
(1, '7:30-8:15', '8:20-9:05', '9:10-9:55', '10:00-10:45', '10:50-11:35', '11:40-12:25', '12:30-13:15', '13:20-14:05'),
(2, '7:30-8:10', '8:15-8:55', '9:00-9:40', '9:45-10:25', '10:30-11:10', '11:15-11:55', '12:00-12:40', '12:45-13:25'),
(3, '7:30-8:05', '8:10-8:45', '8:50-9:25', '9:30-10:05', '10:10-10:45', '10:50-11:25', '11:30-12:05', '12:10-12:45');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `plan_klasy`
--

CREATE TABLE `plan_klasy` (
  `Id_Planu_Klasy` int(11) NOT NULL,
  `Id_Planu_g` int(11) DEFAULT NULL,
  `Id_Planu_l` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan_klasy`
--

INSERT INTO `plan_klasy` (`Id_Planu_Klasy`, `Id_Planu_g`, `Id_Planu_l`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4),
(5, 1, 5),
(6, 1, 6),
(7, 1, 7),
(8, 1, 8),
(9, 1, 9),
(10, 1, 10);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `plan_lekcjowy`
--

CREATE TABLE `plan_lekcjowy` (
  `Id_planu_l` int(11) NOT NULL,
  `Lekcja1_P` int(11) DEFAULT NULL,
  `Lekcja2_P` int(11) DEFAULT NULL,
  `Lekcja3_P` int(11) DEFAULT NULL,
  `Lekcja4_P` int(11) DEFAULT NULL,
  `Lekcja5_P` int(11) DEFAULT NULL,
  `Lekcja6_P` int(11) DEFAULT NULL,
  `Lekcja7_P` int(11) DEFAULT NULL,
  `Lekcja8_P` int(11) DEFAULT NULL,
  `dzien_tygodnia` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan_lekcjowy`
--

INSERT INTO `plan_lekcjowy` (`Id_planu_l`, `Lekcja1_P`, `Lekcja2_P`, `Lekcja3_P`, `Lekcja4_P`, `Lekcja5_P`, `Lekcja6_P`, `Lekcja7_P`, `Lekcja8_P`, `dzien_tygodnia`) VALUES
(1, NULL, 2, 1, 3, 3, 4, 5, NULL, 'Poniedziałek'),
(2, NULL, 4, 5, 1, 2, NULL, NULL, NULL, 'Wtorek'),
(3, 5, 1, 3, 4, 3, NULL, NULL, NULL, 'Środa'),
(4, NULL, NULL, 5, 1, 2, 5, 1, NULL, 'Czwartek'),
(5, NULL, 3, 4, 5, 5, 1, NULL, NULL, 'Piątek'),
(6, 2, 2, 1, 3, 3, NULL, NULL, NULL, 'Poniedziałek'),
(7, NULL, NULL, 5, 2, 1, 3, 4, NULL, 'Wtorek'),
(8, NULL, 2, 2, 1, 3, 4, NULL, NULL, 'Środa'),
(9, NULL, 2, 4, 5, 2, 5, 5, NULL, 'Czwartek'),
(10, 1, 1, 3, 4, 5, 2, NULL, NULL, 'Piątek');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pomieszczenia`
--

CREATE TABLE `pomieszczenia` (
  `Id_pomieszczenia` int(11) NOT NULL,
  `Pojemnosc` int(11) DEFAULT NULL,
  `Przeznaczenie_pomieszczenia` varchar(50) DEFAULT NULL,
  `Id_szkoly` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pomieszczenia`
--

INSERT INTO `pomieszczenia` (`Id_pomieszczenia`, `Pojemnosc`, `Przeznaczenie_pomieszczenia`, `Id_szkoly`) VALUES
(1, 30, 'Język Polski', 1),
(2, 30, 'Matematyka', 1),
(3, 30, 'Angielski', 1),
(4, 30, 'Biologia', 1),
(5, 30, 'Chemia', 1),
(6, 30, 'Geografia', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przedmioty`
--

CREATE TABLE `przedmioty` (
  `Id_przedmiotu` int(11) NOT NULL,
  `Nazwa_przedmiotu` varchar(50) DEFAULT NULL,
  `Id_nauczyciela` int(11) DEFAULT NULL,
  `Id_Pomieszczenia` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `przedmioty`
--

INSERT INTO `przedmioty` (`Id_przedmiotu`, `Nazwa_przedmiotu`, `Id_nauczyciela`, `Id_Pomieszczenia`) VALUES
(1, 'Matematyka', 2, 2),
(2, 'Język Polski', 1, 1),
(3, 'Chemia', 4, 5),
(4, 'Biologia', 3, 4),
(5, 'Historia', 5, 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzice`
--

CREATE TABLE `rodzice` (
  `Id_rodzica` int(11) NOT NULL,
  `Imie` varchar(50) DEFAULT NULL,
  `Nazwisko` varchar(50) DEFAULT NULL,
  `Pesel` varchar(11) DEFAULT NULL,
  `Numer_telefonu` varchar(15) DEFAULT NULL,
  `Login` varchar(50) DEFAULT NULL,
  `Haslo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rodzice`
--

INSERT INTO `rodzice` (`Id_rodzica`, `Imie`, `Nazwisko`, `Pesel`, `Numer_telefonu`, `Login`, `Haslo`) VALUES
(1, 'Anna', 'Nowak', '98765432109', '987654321', 'anowak', 'haslo456'),
(2, 'Magdalena', 'Lis', '91020345678', '111222333', 'mlis', 'haslo321'),
(3, 'Tomasz', 'Szymański', '80050998765', '999888777', 'tszymanski', 'haslo987'),
(4, 'Monika', 'Nowacka', '85071287654', '444333222', 'mnowacka', 'haslo654'),
(5, 'Monika', 'Nowacka', '85071287654', '444333222', 'mnowacka', 'haslo654'),
(6, 'Kamil', 'Wójcik', '90010565432', '777888999', 'kwojcik', 'haslo012');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `szkola`
--

CREATE TABLE `szkola` (
  `Id_szkoly` int(11) NOT NULL,
  `Nazwa_szkoly` varchar(255) DEFAULT NULL,
  `Adres_szkoly` varchar(255) DEFAULT NULL,
  `Numer_telefonu` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `szkola`
--

INSERT INTO `szkola` (`Id_szkoly`, `Nazwa_szkoly`, `Adres_szkoly`, `Numer_telefonu`) VALUES
(1, 'Szkoła Podstawowa Nr 1', 'ul. Szkolna 1, 00-001 Warszawa', '123456789'),
(2, 'Szkoła Podstawowa Nr 4', 'ul. Wieniawskiego 2, 73-110 Stargard', '513483192');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczniowie`
--

CREATE TABLE `uczniowie` (
  `Id_ucznia` int(11) NOT NULL,
  `Imie` varchar(50) DEFAULT NULL,
  `Nazwisko` varchar(50) DEFAULT NULL,
  `Pesel` varchar(11) DEFAULT NULL,
  `Numer_telefonu` varchar(15) DEFAULT NULL,
  `Id_rodzica` int(11) DEFAULT NULL,
  `Login` varchar(50) DEFAULT NULL,
  `Haslo` varchar(50) DEFAULT NULL,
  `id_klasy` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uczniowie`
--

INSERT INTO `uczniowie` (`Id_ucznia`, `Imie`, `Nazwisko`, `Pesel`, `Numer_telefonu`, `Id_rodzica`, `Login`, `Haslo`, `id_klasy`) VALUES
(1, 'Jan', 'Kowalski', '01234567891', '111222333', 1, 'jan', 'kowalski', 1),
(2, 'Anna', 'Nowak', '12345678901', '222333444', 2, 'anna', 'nowak', 1),
(3, 'Piotr', 'Wiśniewski', '23456789012', '333444555', 3, 'piotr', 'wisniewski', 1),
(4, 'Katarzyna', 'Dąbrowska', '34567890123', '444555666', 4, 'katarzyna', 'dabrowska', 1),
(5, 'Maciej', 'Lewandowski', '45678901234', '555666777', 5, 'maciej', 'lewandowski', 1),
(16, 'Aleksandra', 'Wójcik', '56789012345', '666777888', 3, 'aleksandra', 'wojcik', 2),
(17, 'Bartosz', 'Kamiński', '67890123456', '777888999', 5, 'bartosz', 'kaminski', 2),
(18, 'Magdalena', 'Kowalczyk', '78901234567', '888999000', 1, 'magdalena', 'kowalczyk', 2),
(19, 'Kamil', 'Zieliński', '89012345678', '999000111', 2, 'kamil', 'zielinski', 2),
(20, 'Natalia', 'Szymańska', '90123456789', '000111222', 4, 'natalia', 'szymanska', 2);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `klasa`
--
ALTER TABLE `klasa`
  ADD PRIMARY KEY (`Id_klasy`),
  ADD KEY `Wychowawca` (`Wychowawca`),
  ADD KEY `Plan_klasy` (`plan_klasy_poniedzialek`),
  ADD KEY `FK_wtorek` (`plan_klasy_wtorek`),
  ADD KEY `FK_sroda` (`plan_klasy_sroda`),
  ADD KEY `FK_czwartek` (`plan_klasy_czwartek`),
  ADD KEY `FK_piatek` (`plan_klasy_piatek`);

--
-- Indeksy dla tabeli `nauczyciele`
--
ALTER TABLE `nauczyciele`
  ADD PRIMARY KEY (`Id_nauczyciela`),
  ADD KEY `fk_nauczyciele_szkola` (`id_szkoly`);

--
-- Indeksy dla tabeli `obecnosc`
--
ALTER TABLE `obecnosc`
  ADD PRIMARY KEY (`Id_obecnosci`),
  ADD KEY `Id_przedmiotu` (`Id_przedmiotu`),
  ADD KEY `Id_ucznia` (`Id_ucznia`);

--
-- Indeksy dla tabeli `oceny`
--
ALTER TABLE `oceny`
  ADD PRIMARY KEY (`Id_oceny`),
  ADD KEY `Id_przedmiotu` (`Id_przedmiotu`),
  ADD KEY `Id_ucznia` (`Id_ucznia`);

--
-- Indeksy dla tabeli `plan_godzinowy`
--
ALTER TABLE `plan_godzinowy`
  ADD PRIMARY KEY (`Id_planu_g`);

--
-- Indeksy dla tabeli `plan_klasy`
--
ALTER TABLE `plan_klasy`
  ADD PRIMARY KEY (`Id_Planu_Klasy`),
  ADD KEY `Id_Planu_g` (`Id_Planu_g`),
  ADD KEY `Id_Planu_l` (`Id_Planu_l`);

--
-- Indeksy dla tabeli `plan_lekcjowy`
--
ALTER TABLE `plan_lekcjowy`
  ADD PRIMARY KEY (`Id_planu_l`),
  ADD KEY `Lekcja1_P` (`Lekcja1_P`),
  ADD KEY `Lekcja2_P` (`Lekcja2_P`),
  ADD KEY `Lekcja3_P` (`Lekcja3_P`),
  ADD KEY `Lekcja4_P` (`Lekcja4_P`),
  ADD KEY `Lekcja5_P` (`Lekcja5_P`),
  ADD KEY `Lekcja6_P` (`Lekcja6_P`),
  ADD KEY `Lekcja7_P` (`Lekcja7_P`),
  ADD KEY `Lekcja8_P` (`Lekcja8_P`);

--
-- Indeksy dla tabeli `pomieszczenia`
--
ALTER TABLE `pomieszczenia`
  ADD PRIMARY KEY (`Id_pomieszczenia`),
  ADD KEY `Id_szkoly` (`Id_szkoly`);

--
-- Indeksy dla tabeli `przedmioty`
--
ALTER TABLE `przedmioty`
  ADD PRIMARY KEY (`Id_przedmiotu`),
  ADD UNIQUE KEY `Id_Pomieszczenia` (`Id_Pomieszczenia`),
  ADD UNIQUE KEY `Id_nauczyciela` (`Id_nauczyciela`);

--
-- Indeksy dla tabeli `rodzice`
--
ALTER TABLE `rodzice`
  ADD PRIMARY KEY (`Id_rodzica`);

--
-- Indeksy dla tabeli `szkola`
--
ALTER TABLE `szkola`
  ADD PRIMARY KEY (`Id_szkoly`);

--
-- Indeksy dla tabeli `uczniowie`
--
ALTER TABLE `uczniowie`
  ADD PRIMARY KEY (`Id_ucznia`),
  ADD KEY `Id_rodzica` (`Id_rodzica`),
  ADD KEY `fk_uczniowie_klasa` (`id_klasy`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `klasa`
--
ALTER TABLE `klasa`
  MODIFY `Id_klasy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nauczyciele`
--
ALTER TABLE `nauczyciele`
  MODIFY `Id_nauczyciela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `obecnosc`
--
ALTER TABLE `obecnosc`
  MODIFY `Id_obecnosci` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `oceny`
--
ALTER TABLE `oceny`
  MODIFY `Id_oceny` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `plan_godzinowy`
--
ALTER TABLE `plan_godzinowy`
  MODIFY `Id_planu_g` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `plan_klasy`
--
ALTER TABLE `plan_klasy`
  MODIFY `Id_Planu_Klasy` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `plan_lekcjowy`
--
ALTER TABLE `plan_lekcjowy`
  MODIFY `Id_planu_l` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pomieszczenia`
--
ALTER TABLE `pomieszczenia`
  MODIFY `Id_pomieszczenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `przedmioty`
--
ALTER TABLE `przedmioty`
  MODIFY `Id_przedmiotu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rodzice`
--
ALTER TABLE `rodzice`
  MODIFY `Id_rodzica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `szkola`
--
ALTER TABLE `szkola`
  MODIFY `Id_szkoly` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `uczniowie`
--
ALTER TABLE `uczniowie`
  MODIFY `Id_ucznia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `klasa`
--
ALTER TABLE `klasa`
  ADD CONSTRAINT `FK_czwartek` FOREIGN KEY (`plan_klasy_czwartek`) REFERENCES `plan_klasy` (`Id_Planu_Klasy`),
  ADD CONSTRAINT `FK_piatek` FOREIGN KEY (`plan_klasy_piatek`) REFERENCES `plan_klasy` (`Id_Planu_Klasy`),
  ADD CONSTRAINT `FK_sroda` FOREIGN KEY (`plan_klasy_sroda`) REFERENCES `plan_klasy` (`Id_Planu_Klasy`),
  ADD CONSTRAINT `FK_wtorek` FOREIGN KEY (`plan_klasy_wtorek`) REFERENCES `plan_klasy` (`Id_Planu_Klasy`),
  ADD CONSTRAINT `klasa_ibfk_1` FOREIGN KEY (`Wychowawca`) REFERENCES `nauczyciele` (`Id_nauczyciela`),
  ADD CONSTRAINT `klasa_ibfk_2` FOREIGN KEY (`plan_klasy_poniedzialek`) REFERENCES `plan_klasy` (`Id_Planu_Klasy`);

--
-- Constraints for table `nauczyciele`
--
ALTER TABLE `nauczyciele`
  ADD CONSTRAINT `fk_nauczyciele_szkola` FOREIGN KEY (`id_szkoly`) REFERENCES `szkola` (`Id_szkoly`);

--
-- Constraints for table `obecnosc`
--
ALTER TABLE `obecnosc`
  ADD CONSTRAINT `obecnosc_ibfk_1` FOREIGN KEY (`Id_przedmiotu`) REFERENCES `przedmioty` (`Id_przedmiotu`),
  ADD CONSTRAINT `obecnosc_ibfk_2` FOREIGN KEY (`Id_ucznia`) REFERENCES `uczniowie` (`Id_ucznia`);

--
-- Constraints for table `oceny`
--
ALTER TABLE `oceny`
  ADD CONSTRAINT `oceny_ibfk_1` FOREIGN KEY (`Id_przedmiotu`) REFERENCES `przedmioty` (`Id_przedmiotu`),
  ADD CONSTRAINT `oceny_ibfk_2` FOREIGN KEY (`Id_ucznia`) REFERENCES `uczniowie` (`Id_ucznia`);

--
-- Constraints for table `plan_klasy`
--
ALTER TABLE `plan_klasy`
  ADD CONSTRAINT `plan_klasy_ibfk_1` FOREIGN KEY (`Id_Planu_g`) REFERENCES `plan_godzinowy` (`Id_planu_g`),
  ADD CONSTRAINT `plan_klasy_ibfk_2` FOREIGN KEY (`Id_Planu_l`) REFERENCES `plan_lekcjowy` (`Id_planu_l`);

--
-- Constraints for table `plan_lekcjowy`
--
ALTER TABLE `plan_lekcjowy`
  ADD CONSTRAINT `plan_lekcjowy_ibfk_1` FOREIGN KEY (`Lekcja1_P`) REFERENCES `przedmioty` (`Id_przedmiotu`),
  ADD CONSTRAINT `plan_lekcjowy_ibfk_2` FOREIGN KEY (`Lekcja2_P`) REFERENCES `przedmioty` (`Id_przedmiotu`),
  ADD CONSTRAINT `plan_lekcjowy_ibfk_3` FOREIGN KEY (`Lekcja3_P`) REFERENCES `przedmioty` (`Id_przedmiotu`),
  ADD CONSTRAINT `plan_lekcjowy_ibfk_4` FOREIGN KEY (`Lekcja4_P`) REFERENCES `przedmioty` (`Id_przedmiotu`),
  ADD CONSTRAINT `plan_lekcjowy_ibfk_5` FOREIGN KEY (`Lekcja5_P`) REFERENCES `przedmioty` (`Id_przedmiotu`),
  ADD CONSTRAINT `plan_lekcjowy_ibfk_6` FOREIGN KEY (`Lekcja6_P`) REFERENCES `przedmioty` (`Id_przedmiotu`),
  ADD CONSTRAINT `plan_lekcjowy_ibfk_7` FOREIGN KEY (`Lekcja7_P`) REFERENCES `przedmioty` (`Id_przedmiotu`),
  ADD CONSTRAINT `plan_lekcjowy_ibfk_8` FOREIGN KEY (`Lekcja8_P`) REFERENCES `przedmioty` (`Id_przedmiotu`);

--
-- Constraints for table `pomieszczenia`
--
ALTER TABLE `pomieszczenia`
  ADD CONSTRAINT `pomieszczenia_ibfk_1` FOREIGN KEY (`Id_szkoly`) REFERENCES `szkola` (`Id_szkoly`);

--
-- Constraints for table `przedmioty`
--
ALTER TABLE `przedmioty`
  ADD CONSTRAINT `fk_pomieszczenia_przedmioty` FOREIGN KEY (`Id_Pomieszczenia`) REFERENCES `pomieszczenia` (`Id_pomieszczenia`),
  ADD CONSTRAINT `przedmioty_ibfk_1` FOREIGN KEY (`Id_nauczyciela`) REFERENCES `nauczyciele` (`Id_nauczyciela`);

--
-- Constraints for table `uczniowie`
--
ALTER TABLE `uczniowie`
  ADD CONSTRAINT `fk_uczniowie_klasa` FOREIGN KEY (`id_klasy`) REFERENCES `klasa` (`Id_klasy`),
  ADD CONSTRAINT `uczniowie_ibfk_1` FOREIGN KEY (`Id_rodzica`) REFERENCES `rodzice` (`Id_rodzica`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
