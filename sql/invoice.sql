-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Maj 2020, 21:35
-- Wersja serwera: 5.6.26
-- Wersja PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `invoice`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `NIP` bigint(20) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `company`
--

INSERT INTO `company` (`id`, `name`, `NIP`, `address`) VALUES
(1, 'Elektrolux', 912123123, 'Babilońska 12A, Gdańsk'),
(2, 'Bracia wright z nami polecisz s z o.o.', 6664445551, 'Ohayo 10, Dayton'),
(3, 'Fresh look', 1112223334, 'Kosowo 1/3, Kraków'),
(4, 'Czmiel overflow', 9998887771, 'Piaskowa 7, Gdańsk'),
(5, 'Cristal stal', 9217778889, 'Hutnicza  20B, Gdynia'),
(6, 'Saguaro sp. z o.o.', 1112223334, 'Krzemowa 1 ,Wrocław');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `customer`
--

INSERT INTO `customer` (`id`, `name`, `surname`, `phone`, `address`) VALUES
(1, 'Krzysztof', 'Łęcina', '512666781', ''),
(2, 'Hanna', 'Montanna', '784445631', 'Hoolly wood 10'),
(3, 'Kamil', 'Ślimak', '643512314', 'Skorupkowa 7, Warszawa'),
(4, 'Celina', 'Boyke', '123456789', '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `invoice`
--

CREATE TABLE `invoice` (
  `id` int(11) NOT NULL,
  `invoice_number` varchar(50) NOT NULL,
  `id_company` int(11) NOT NULL,
  `id_purchase` int(11) NOT NULL,
  `id_worker` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `invoice`
--

INSERT INTO `invoice` (`id`, `invoice_number`, `id_company`, `id_purchase`, `id_worker`) VALUES
(1, 'IN_0001', 1, 1, 2),
(2, 'IN_0002', 3, 2, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `invoice_item`
--

CREATE TABLE `invoice_item` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `invoice_item`
--

INSERT INTO `invoice_item` (`id`, `id_invoice`, `id_item`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 2, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price_per_unit` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `item`
--

INSERT INTO `item` (`id`, `name`, `price_per_unit`) VALUES
(1, 'Orawa okularowa Dolce & Gabbana', 699),
(2, 'Oprawa okularowa Rayban', 499),
(3, 'Okulary przeciwsłoneczne Tommy Hilfiger', 749),
(4, 'Etui okularowe', 24),
(5, 'Soczewka okularowa Hoya Hilux 1.6', 153.49),
(6, 'Etui okularowe', 24.99),
(7, 'Płyn czyszczący', 15.99),
(8, 'Sciereczka', 20);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `perm_administrator` tinyint(1) NOT NULL,
  `perm_orders` tinyint(1) NOT NULL,
  `perm_invoice` tinyint(1) NOT NULL,
  `perm_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `permission`
--

INSERT INTO `permission` (`id`, `perm_administrator`, `perm_orders`, `perm_invoice`, `perm_active`) VALUES
(1, 0, 1, 1, 0),
(2, 0, 1, 0, 1),
(3, 1, 1, 1, 1),
(4, 0, 1, 1, 1),
(5, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `date_of_order` date NOT NULL,
  `id_worker` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `purchase`
--

INSERT INTO `purchase` (`id`, `date_of_order`, `id_worker`, `id_customer`) VALUES
(1, '2020-05-11', 2, 1),
(2, '2020-05-19', 1, 1),
(3, '2020-05-16', 3, 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `purchase_item`
--

CREATE TABLE `purchase_item` (
  `id` int(11) NOT NULL,
  `id_orders` int(11) NOT NULL,
  `id_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `purchase_item`
--

INSERT INTO `purchase_item` (`id`, `id_orders`, `id_item`) VALUES
(1, 1, 2),
(2, 1, 3),
(3, 1, 5),
(4, 1, 5),
(5, 2, 3),
(6, 3, 7),
(7, 3, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `worker`
--

CREATE TABLE `worker` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `salary` float NOT NULL,
  `permission_id` int(11) NOT NULL,
  `work_position` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `worker`
--

INSERT INTO `worker` (`id`, `name`, `surname`, `phone`, `salary`, `permission_id`, `work_position`) VALUES
(1, 'Tomasz', 'Zakole', '456654456', 4100, 1, 'Optometrysta'),
(2, 'Sylwia', 'Siwek', '', 3000, 2, 'Sekretrka'),
(3, 'Andrzej', 'Śliwa', '999122333', 10000, 3, 'Boss'),
(4, 'Kamila', 'Zaradkiewicz', '644123654', 3000, 4, 'Sprzedawca'),
(5, 'Sywia', 'Niemrawa', '', 2100, 5, 'sprzedawca');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `purchase_item`
--
ALTER TABLE `purchase_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `purchase_item`
--
ALTER TABLE `purchase_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `worker`
--
ALTER TABLE `worker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
