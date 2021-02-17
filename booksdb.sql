-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:3306
-- Tid vid skapande: 17 feb 2021 kl 10:42
-- Serverversion: 5.7.24
-- PHP-version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `booksdb`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `authors`
--

CREATE TABLE `authors` (
  `authors_id` int(11) NOT NULL,
  `author` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `authors`
--

INSERT INTO `authors` (`authors_id`, `author`) VALUES
(1, 'Frida Skattberg'),
(2, 'Fredrik Nylén'),
(3, 'Zeina Mourtada'),
(4, 'Jamie Oliver');

-- --------------------------------------------------------

--
-- Tabellstruktur `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `address`, `tel`, `email`) VALUES
(7, 'Jovana', 'adress 1', '12345', 'jovana.hurra@gmail.com'),
(8, 'robert', 'adress 2', '0000', 'test@test.test'),
(9, 'sadasd', 'adress 3', '12345', 'test@test.test'),
(10, 'sadasd', 'adress 3', '12345', 'test@test.test'),
(11, 'Jovana3', 'adress 5', '1234', 'test@test.test'),
(12, 'Jovana', 'kjsadksa', '0000', 'test@test.test'),
(13, 'Jovana', 'kjsadksa', '0000', 'test@test.test'),
(14, 'Jovana3', 'kjshdksa', '654', 'abc@abs.se'),
(15, 'Jovana', 'kjhkjh', '123455674896', 'jovana.hurra@yh.nackademin.se'),
(16, 'Jovana5', 'address vet ej nummer', '123456789', 'abc@abs.se'),
(17, 'Jovana5', 'address vet ej nummer', '123456789', 'abc@abs.se'),
(18, 'sadasd', 'rsdgsd', '12345', 'test@test.test'),
(19, 'sadasd', 'rsdgsd', '12345', 'test@test.test'),
(20, 'Jovana', 'ewtstfgdg', '123455674896', 'jovana.hurra@gmail.com'),
(21, 'Jovana3', 'lkhkjghjk', '32432', 'test@test.test'),
(22, 'Jovana3', 'lkhkjghjk', '32432', 'test@test.test'),
(23, 'Jovana3', 'lkhkjghjk', '32432', 'test@test.test'),
(24, 'Jovana3', 'lkhkjghjk', '32432', 'test@test.test'),
(25, 'Jovana3', 'lkhkjghjk', '32432', 'test@test.test'),
(26, 'Jovana3', 'lkhkjghjk', '32432', 'test@test.test'),
(27, 'Jovana3', 'lkhkjghjk', '32432', 'test@test.test'),
(28, 'Jovana3', 'lkhkjghjk', '32432', 'test@test.test'),
(29, 'Jovana3', 'lkhkjghjk', '32432', 'test@test.test'),
(30, 'sadasd', 'asdas', '1234', 'jovana.hurrayh@nackademin.se'),
(31, 'sadasd', 'asdas', '1234', 'jovana.hurrayh@nackademin.se'),
(32, 'sadasd', 'asdas', '1234', 'jovana.hurrayh@nackademin.se'),
(33, 'sadasd', 'asdas', '1234', 'jovana.hurrayh@nackademin.se'),
(34, 'sadasd', 'asdas', '1234', 'jovana.hurrayh@nackademin.se');

-- --------------------------------------------------------

--
-- Tabellstruktur `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `info` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `messages`
--

INSERT INTO `messages` (`message_id`, `name`, `email`, `info`) VALUES
(1, 'jovana', 'test@test.test', 'hej hej');

-- --------------------------------------------------------

--
-- Tabellstruktur `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `orders`
--

INSERT INTO `orders` (`order_id`, `customer`, `product`) VALUES
(2, 7, 2),
(3, 8, 2),
(4, 9, 12),
(5, 10, 12),
(6, 12, 12),
(7, 13, 12),
(8, 14, 1),
(9, 15, 1),
(10, 16, 1),
(11, 17, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `author` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'no-image.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`product_id`, `title`, `author`, `price`, `description`, `image`) VALUES
(1, 'Baka i långpanna deluxe', 1, 177, 'Sveriges bakdrottning Frida Skattberg är tillbaka med en ny bok, och den här gången bjuder hon på enkla bakverk för många. Allt bakas i långpanna!', 'baka-i-langpanna-deluxe.jpg'),
(2, 'Kladdkakor deluxe', 1, 199, 'Kladdkakor extra allt för chokladälskarenVill du bjuda på något riktigt smaskigt utan att tillbringa flera timmar i köket? Då är Kladdkakor deluxe boken för dig.', 'kladdkakor-deluxe.jpg'),
(3, 'Matbröd', 2, 75, 'I Matbröd har Fredrik Nylén samlat sina godaste matbröd för alla tillfällen.', 'matbrod-fran-tekakor.jpg'),
(4, 'Baka med choklad', 2, 105, 'Fredrik Nylén, bloggare på Fredriks fika och känd från Hela Sverige bakar, kommer ut med en ny bok om att baka med choklad!', 'baka-med-choklad.jpg'),
(5, 'Fredriks fika', 2, 169, 'Välkommen till Fredriks glada bakvärld!Här bjuder Fredrik Nylén på klassiskt fikabröd, sådant där som man tar fram när man ska bjuda någon på riktig fika.', 'fredriks-fika-bakat-med-gladje.jpg'),
(6, 'Baka bullar', 2, 210, 'Bullen är förmodligen det bakverk vi bakar mest av hemma, och det finns mer än vanliga kanel- och kardemummabullar att baka.', 'baka-bullar.jpg'),
(7, 'Zeinas green kitchen', 3, 109, 'Mat med mångfald! Zeina Mourtada är tillbaka med en ny kokbok, denna gång med skön och grön mat från olika delar av världen.', 'zeinas-green-kitchen.jpg'),
(8, 'Veckans matsedel', 3, 159, 'Zeina är tillbaka! I denna hennes tredje bok ligger fokus på vardagsmat som funkar.', 'veckans-matsedel-middagsrecept.jpg'),
(9, 'Zeinas kitchen', 3, 111, 'I den här boken koncentrerar sig dock Zeina på mat från Mellanöstern och länderna där omkring.', 'zeinas-kitchen-recept.jpg'),
(10, 'Vego', 4, 231, 'Enkla & goda rätter för allaJamie Oliver – den internationellt bästsäljande kokboksförfattaren – är tillbaka med VEGO, en bok med fantastiska växtbaserade rätter.', 'vego-enkla-goda-ratter-for-alla.jpg'),
(11, 'Jamie lagar Italien', 4, 139, 'Här finner han den enkla, goda och vällagade maten utan krusiduller.', 'jamie-lagar-italien.jpg'),
(12, 'Jamies supermat', 4, 231, 'I sin nya kokbok berättar Jamie Oliver personligt om sin omställning till en ny och mer hälsosam livsstil, och om hur han har blivit medveten om hur han ska äta för att må så bra som möjligt.', 'jamies-supermat.jpg');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `authors`
--
ALTER TABLE `authors`
  ADD PRIMARY KEY (`authors_id`);

--
-- Index för tabell `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Index för tabell `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Index för tabell `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer` (`customer`),
  ADD KEY `product` (`product`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `author` (`author`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `authors`
--
ALTER TABLE `authors`
  MODIFY `authors_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT för tabell `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT för tabell `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `customer` FOREIGN KEY (`customer`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restriktioner för tabell `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `author` FOREIGN KEY (`author`) REFERENCES `authors` (`authors_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
