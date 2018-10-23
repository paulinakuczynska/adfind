-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 24 Paź 2018, 00:34
-- Wersja serwera: 5.7.20-0ubuntu0.16.04.1
-- Wersja PHP: 7.2.11-2+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Baza danych: `adfind`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Category`
--

CREATE TABLE `Category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Category`
--

INSERT INTO `Category` (`id`, `name`) VALUES
(1, 'Photos'),
(2, 'Pictograms'),
(3, 'Illustrations'),
(4, 'Documents');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `File`
--

CREATE TABLE `File` (
  `id` int(11) NOT NULL,
  `name_add` varchar(255) NOT NULL,
  `name_view` varchar(255) DEFAULT NULL,
  `name_hash` varchar(255) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Format`
--

CREATE TABLE `Format` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Format`
--

INSERT INTO `Format` (`id`, `name`) VALUES
(1, 'jpeg'),
(2, 'png'),
(3, 'svg'),
(4, 'eps'),
(5, 'txt'),
(6, 'doc'),
(7, 'ppt'),
(8, 'xls');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `MapFormat`
--

CREATE TABLE `MapFormat` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `format_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `MapTag`
--

CREATE TABLE `MapTag` (
  `id` int(11) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Subcategory`
--

CREATE TABLE `Subcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Tag`
--

CREATE TABLE `Tag` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `File`
--
ALTER TABLE `File`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `Format`
--
ALTER TABLE `Format`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `MapFormat`
--
ALTER TABLE `MapFormat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_id` (`file_id`),
  ADD KEY `format_id` (`format_id`);

--
-- Indexes for table `MapTag`
--
ALTER TABLE `MapTag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_id` (`file_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `Subcategory`
--
ALTER TABLE `Subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `Tag`
--
ALTER TABLE `Tag`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `Category`
--
ALTER TABLE `Category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT dla tabeli `File`
--
ALTER TABLE `File`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `Format`
--
ALTER TABLE `Format`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT dla tabeli `MapFormat`
--
ALTER TABLE `MapFormat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `MapTag`
--
ALTER TABLE `MapTag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `Subcategory`
--
ALTER TABLE `Subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT dla tabeli `Tag`
--
ALTER TABLE `Tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `File`
--
ALTER TABLE `File`
  ADD CONSTRAINT `File_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `Subcategory` (`id`);

--
-- Ograniczenia dla tabeli `MapFormat`
--
ALTER TABLE `MapFormat`
  ADD CONSTRAINT `MapFormat_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `File` (`id`),
  ADD CONSTRAINT `MapFormat_ibfk_2` FOREIGN KEY (`format_id`) REFERENCES `Format` (`id`);

--
-- Ograniczenia dla tabeli `MapTag`
--
ALTER TABLE `MapTag`
  ADD CONSTRAINT `MapTag_ibfk_1` FOREIGN KEY (`file_id`) REFERENCES `File` (`id`),
  ADD CONSTRAINT `MapTag_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `Tag` (`id`);

--
-- Ograniczenia dla tabeli `Subcategory`
--
ALTER TABLE `Subcategory`
  ADD CONSTRAINT `Subcategory_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `Category` (`id`);

