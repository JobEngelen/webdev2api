-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Gegenereerd op: 31 mrt 2022 om 12:21
-- Serverversie: 10.6.5-MariaDB-1:10.6.5+maria~focal
-- PHP-versie: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'wasdroger'),
(3, 'wasmachine');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` varchar(8000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `description`, `image`, `category_id`) VALUES
(6, 'Wasdroger3000', '499.99', 'Droogt de was goed. Wast de was droger dan toen de was in de winkel was.', 'https://helpmijnwasisnat.herokuapp.com/img/wasdroger3000.png', 1),
(7, 'Wasdroger4000', '800.00', 'Nieuwere versie van de Wasdroger3000. Droogt de was nu 110% beter dan vorige versies.', 'https://helpmijnwasisnat.herokuapp.com/img/wasdroger4000.png', 1),
(8, 'Kapotte wasdroger', '10.00', 'Deze wasdroger is defect. Als je niet te veel wil uitgeven en zelf wil kijken of je een wasdroger kan repareren dan is dit product een uitstekende keus.', 'https://helpmijnwasisnat.herokuapp.com/img/kapotte-wasdroger.png', 1),
(9, 'Droog-oven', '400.00', 'De droog-oven is een wasdroger dat ook als een oven kan functioneren. Perfect voor als je van droge was en van koken houdt!', 'https://helpmijnwasisnat.herokuapp.com/img/droog-oven.png', 1),
(10, 'Kleren droger', '549.95', 'De kleren droger is speciaal ontwikkeld om natte of vochtige kleding droog te maken. (Kleren zijn inbegrepen).', 'https://helpmijnwasisnat.herokuapp.com/img/klerendroger.png', 1),
(11, 'Wasmachine', '399.99', 'De wasmachine is speciaal ontwikkeld om vuil uit kleren te wassen. (Waarschuwing: Maakt kleren nat).', 'https://helpmijnwasisnat.herokuapp.com/img/wasmachine.png', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `userType` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `userType`) VALUES
(1, 'username', '$2y$10$DQlV0u9mFmtOWsOdxXX9H.4kgzEB3E8o97s.S.Pdy4klUAdBvtVh.', 'username@password.com', 0),
(2, 'admin', '$2y$10$RxPfZXVxG0JEXDlfSh3bQOlhBduQLk/PCG5H6ttbBpNHtC.TE7e4q', 'admin@email.com', 1);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category` (`category_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT voor een tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
