-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Lis 06, 2024 at 07:54 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `szama`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `street_number` varchar(62) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `city`, `street`, `street_number`) VALUES
(1, 'Częstochowa', 'Dekabrystów', '34'),
(2, 'Częstochowa', 'Wojska polskiego', '117'),
(3, 'Częstochowa', 'Niepodlegosci', '34'),
(6, 'Częstochowa', NULL, NULL),
(7, NULL, NULL, NULL),
(8, 'sad', NULL, NULL),
(9, NULL, NULL, NULL),
(11, NULL, NULL, NULL),
(13, NULL, NULL, NULL),
(15, 'Częstochowa', 'Aleja niepodleglosc', NULL),
(16, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `restaurant_details_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `price_delivery` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart_cart_item`
--

CREATE TABLE `cart_cart_item` (
  `cart_id` int(11) NOT NULL,
  `cart_item_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart_item`
--

CREATE TABLE `cart_item` (
  `id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `comments` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart_item_product`
--

CREATE TABLE `cart_item_product` (
  `cart_item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category_kitchen`
--

CREATE TABLE `category_kitchen` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_kitchen`
--

INSERT INTO `category_kitchen` (`id`, `name`, `logo`, `is_active`) VALUES
(1, 'Kebab', NULL, 1),
(2, 'Pizza', NULL, 1),
(3, 'Indyjska', NULL, 1),
(4, 'Burgery', NULL, 1),
(5, 'Włoska', NULL, 1),
(6, 'Chińska', NULL, 1),
(7, 'Sushi', NULL, 1),
(8, 'Amerykańska', NULL, 1),
(9, 'Polska', NULL, 1),
(10, 'Śniadanie', NULL, 1),
(11, 'Makaron', NULL, 1),
(12, 'Tajska', NULL, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `nick` varchar(64) DEFAULT NULL,
  `customer_type` varchar(64) NOT NULL,
  `is_subaccount` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `nick`, `customer_type`, `is_subaccount`) VALUES
(1, 'suchy', 'owner', 0),
(2, 'paulix', 'owner', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `free_extras`
--

CREATE TABLE `free_extras` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `restaurant_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `free_extras`
--

INSERT INTO `free_extras` (`id`, `name`, `description`, `restaurant_category_id`) VALUES
(1, 'asd', NULL, 20),
(2, 'Sos pomidorowy', NULL, 42),
(3, 'Sos curry', NULL, 42);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_addon` tinyint(1) NOT NULL,
  `restaurant_category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `name`, `is_addon`, `restaurant_category_id`) VALUES
(12, 'salami', 0, 5),
(13, 'szynka', 0, 5),
(14, 'ser', 0, 5),
(15, 'Wołowina', 0, 6),
(16, 'TEST', 0, 20),
(17, 'test', 0, 27),
(18, 'wołowina', 0, 28),
(19, 'Sałata', 0, 28),
(20, 'kurczak', 0, NULL),
(21, 'dsfsdf', 0, 29),
(22, 'asd', 0, 36),
(23, 'makaron', 1, 37),
(24, 'makaron', 0, 38),
(25, 'asd', 0, 39),
(26, 'sad', 0, 20),
(27, 'asd', 0, 20),
(28, 'kurczak', 0, 41),
(29, 'majonez', 0, 41),
(30, 'Szynka', 0, 42),
(31, 'Salami', 0, 42),
(32, 'Sera', 0, 42),
(33, 'Ananas', 0, 42),
(34, 'ser', 1, 43);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ingredients_prices_ingredient`
--

CREATE TABLE `ingredients_prices_ingredient` (
  `ingredients_id` int(11) NOT NULL,
  `prices_ingredient_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredients_prices_ingredient`
--

INSERT INTO `ingredients_prices_ingredient` (`ingredients_id`, `prices_ingredient_id`) VALUES
(12, 4),
(12, 5),
(13, 4),
(13, 5),
(14, 5),
(18, 6),
(21, 7),
(22, 8),
(28, 9),
(34, 10),
(34, 11);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messenger_messages`
--

INSERT INTO `messenger_messages` (`id`, `body`, `headers`, `queue_name`, `created_at`, `available_at`, `delivered_at`) VALUES
(1, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:169:\\\"http://localhost:8000/verify/email?expires=1728814917&signature=R%2BRcZdGrpOoXLtw%2B2jGJAmSII79UidnfGF7HjixQRWk%3D&token=nK%2Bf6egN0yEljB8VyPfGoAhJN2E1qdua1OqaZkrsAbU%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:20:\\\"suchanskib@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:10:\\\"Rejstracja\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:20:\\\"suchanskib@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2024-10-13 09:21:57', '2024-10-13 09:21:57', NULL),
(2, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:165:\\\"http://localhost:8000/verify/email?expires=1729708012&signature=vDouyFtom0WqmHbR6K62HciXLZwIAH8kiZW1lbW69eY%3D&token=iTRRprKcvIh8mvOyI8JOYOnhBSNza3lZ2BoVRas3%2FRM%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:20:\\\"suchanskib@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:10:\\\"Rejstracja\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:14:\\\"paaulaax@wp.pl\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2024-10-23 17:26:53', '2024-10-23 17:26:53', NULL),
(3, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:165:\\\"http://localhost:8000/verify/email?expires=1730921927&signature=yuKXLdTTeCHeD2xHGzpv4cjcHvke%2FosBPfWrGZqvbOQ%3D&token=KBzmigt3ZByZw7YVwfHAZlAofUesyg1tAx250ODKciw%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:20:\\\"suchanskib@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:10:\\\"Rejstracja\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:12:\\\"kuba@onet.pl\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2024-11-06 18:38:49', '2024-11-06 18:38:49', NULL),
(4, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:171:\\\"http://localhost:8000/verify/email?expires=1730922048&signature=GiCPAO1w2uWeXHN2CdvylbgqfUpl%2FQWc%2BsphSk7Bbqs%3D&token=8a1%2BkyNDXHcIse79duOlJmjA47%2FiBQI7qnM4Euyp7Xc%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:20:\\\"suchanskib@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:10:\\\"Rejstracja\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:12:\\\"kuba@onet.pl\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2024-11-06 18:40:48', '2024-11-06 18:40:48', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `poi`
--

CREATE TABLE `poi` (
  `id` bigint(20) NOT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lon` varchar(255) DEFAULT NULL,
  `restaurant_details_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `poi`
--

INSERT INTO `poi` (`id`, `lat`, `lon`, `restaurant_details_id`) VALUES
(123423, '50.8254239', '19.1129694', 2),
(2342349, '123', '123', NULL),
(2342350, '1234245', '123', 13),
(2342351, '122', '123', 12);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `prices_ingredient`
--

CREATE TABLE `prices_ingredient` (
  `id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `restaurant_category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices_ingredient`
--

INSERT INTO `prices_ingredient` (`id`, `price`, `restaurant_category_id`) VALUES
(1, 8.00, NULL),
(2, 10.00, NULL),
(3, 23.00, NULL),
(4, 23.00, 5),
(5, 23.00, 5),
(6, 34.00, 28),
(7, 23.00, 29),
(8, 20.00, 36),
(9, 2.00, 41),
(10, 8.00, 43),
(11, 10.00, 43);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `prices_ingredient_size_product`
--

CREATE TABLE `prices_ingredient_size_product` (
  `prices_ingredient_id` int(11) NOT NULL,
  `size_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prices_ingredient_size_product`
--

INSERT INTO `prices_ingredient_size_product` (`prices_ingredient_id`, `size_product_id`) VALUES
(4, 1),
(5, 1),
(6, 5),
(7, 8),
(8, 9),
(9, 13),
(10, 18),
(11, 19);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `prices_product`
--

CREATE TABLE `prices_product` (
  `id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `restaurant_category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`) VALUES
(5, 'Amigo', NULL),
(6, 'test', NULL),
(7, 'asd', NULL),
(8, 'Margarita', NULL),
(9, 'asd', NULL),
(10, 'salatka kebab', NULL),
(11, 'Hawajska', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product_ingredients`
--

CREATE TABLE `product_ingredients` (
  `product_id` int(11) NOT NULL,
  `ingredients_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_ingredients`
--

INSERT INTO `product_ingredients` (`product_id`, `ingredients_id`) VALUES
(5, 12),
(5, 13),
(6, 18),
(6, 20),
(7, 21),
(8, 22),
(9, 16),
(9, 26),
(10, 28),
(10, 29),
(11, 30),
(11, 32),
(11, 33);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `product_prices_product`
--

CREATE TABLE `product_prices_product` (
  `product_id` int(11) NOT NULL,
  `prices_product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restaurant_category`
--

CREATE TABLE `restaurant_category` (
  `id` int(11) NOT NULL,
  `name_category` varchar(64) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `quantity_free` int(11) DEFAULT NULL,
  `type_size` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_category`
--

INSERT INTO `restaurant_category` (`id`, `name_category`, `image`, `is_active`, `quantity_free`, `type_size`) VALUES
(5, 'Pizza', NULL, 1, NULL, NULL),
(6, 'Burger', NULL, 1, NULL, 'kg'),
(17, 'Makarony', NULL, 0, NULL, NULL),
(18, 'asdf', NULL, 0, NULL, NULL),
(19, 'DSF', NULL, 0, NULL, NULL),
(20, 'SAD', NULL, 1, 2, 'gram'),
(21, 'zxczxc', NULL, 0, NULL, NULL),
(22, 'xzc', NULL, 0, NULL, NULL),
(23, 'dsfsdfdsf', NULL, 0, NULL, NULL),
(24, 'sdf', NULL, 0, NULL, NULL),
(25, 'asd', NULL, 0, NULL, NULL),
(26, 'sadasd', NULL, 0, NULL, NULL),
(27, 'test', NULL, 0, NULL, NULL),
(28, 'Kebab', NULL, 0, NULL, NULL),
(29, 'rtesd', NULL, 0, NULL, NULL),
(30, 'Pizza', NULL, 0, NULL, NULL),
(31, 'test', NULL, 0, NULL, NULL),
(32, 'dsfg', NULL, 0, NULL, NULL),
(33, 'dcv', NULL, 0, NULL, NULL),
(34, 'dupa', NULL, 0, NULL, NULL),
(35, 'dupa', NULL, 0, NULL, NULL),
(36, 'zdfasd', NULL, 1, NULL, NULL),
(37, 'Makarony', NULL, 1, NULL, NULL),
(38, 'dsf', NULL, 0, NULL, NULL),
(39, 'Makarony', NULL, 1, NULL, NULL),
(40, 'test', NULL, 0, NULL, NULL),
(41, 'Sałatki', NULL, 0, NULL, 'gram'),
(42, 'Pizza', NULL, 0, 2, 'kg'),
(43, 'Pizza', NULL, 0, NULL, 'kg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restaurant_category_product`
--

CREATE TABLE `restaurant_category_product` (
  `restaurant_category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_category_product`
--

INSERT INTO `restaurant_category_product` (`restaurant_category_id`, `product_id`) VALUES
(5, 5),
(20, 9),
(28, 6),
(29, 7),
(36, 8),
(41, 10),
(42, 11);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restaurant_contact_details`
--

CREATE TABLE `restaurant_contact_details` (
  `id` int(11) NOT NULL,
  `tin` varchar(64) DEFAULT NULL,
  `phone_sms` varchar(16) NOT NULL,
  `phone_sms2` varchar(16) DEFAULT NULL,
  `phone_owner` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_contact_details`
--

INSERT INTO `restaurant_contact_details` (`id`, `tin`, `phone_sms`, `phone_sms2`, `phone_owner`) VALUES
(1, '123456789', '731210396', '519104891', '731210396'),
(4, '1233432', '5012134325', NULL, '123234532'),
(5, NULL, '123456789', NULL, '987654321'),
(7, '123', '123455678', NULL, NULL),
(8, '234', '324324234', NULL, NULL),
(9, '2134', '123', NULL, NULL),
(10, 'asd', '123432', NULL, NULL),
(11, NULL, '1234', NULL, NULL),
(12, NULL, '123', NULL, NULL),
(13, NULL, '12345', NULL, NULL),
(14, NULL, '1234', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restaurant_details`
--

CREATE TABLE `restaurant_details` (
  `id` int(11) NOT NULL,
  `name_restaurant` varchar(255) NOT NULL,
  `average_opinion` double DEFAULT NULL,
  `min_purchase_amount` decimal(10,2) DEFAULT NULL,
  `min_delivery_amount` decimal(10,0) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `address_id` int(11) DEFAULT NULL,
  `restaurant_contact_details_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_details`
--

INSERT INTO `restaurant_details` (`id`, `name_restaurant`, `average_opinion`, `min_purchase_amount`, `min_delivery_amount`, `logo`, `slug`, `address_id`, `restaurant_contact_details_id`) VALUES
(2, 'Mega pizza', 3.4, 40.00, 8, NULL, 'mega_pizza', 1, 1),
(12, 'Strefa dobrej pizzy', NULL, 30.00, 2, NULL, 'Strefa_dobrej_pizzy', 15, 13),
(13, 'czr', NULL, NULL, NULL, NULL, 'czr', 16, 14);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restaurant_details_category_kitchen`
--

CREATE TABLE `restaurant_details_category_kitchen` (
  `restaurant_details_id` int(11) NOT NULL,
  `category_kitchen_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_details_category_kitchen`
--

INSERT INTO `restaurant_details_category_kitchen` (`restaurant_details_id`, `category_kitchen_id`) VALUES
(2, 2),
(2, 3),
(2, 4),
(2, 5),
(13, 2),
(13, 5),
(13, 6),
(13, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restaurant_details_restaurant_category`
--

CREATE TABLE `restaurant_details_restaurant_category` (
  `restaurant_details_id` int(11) NOT NULL,
  `restaurant_category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_details_restaurant_category`
--

INSERT INTO `restaurant_details_restaurant_category` (`restaurant_details_id`, `restaurant_category_id`) VALUES
(2, 5),
(2, 6),
(2, 20),
(2, 27),
(2, 28),
(2, 36),
(2, 37),
(2, 38),
(2, 40),
(2, 41),
(2, 42),
(12, 43),
(13, 39);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restaurant_details_restaurant_opening_hours`
--

CREATE TABLE `restaurant_details_restaurant_opening_hours` (
  `restaurant_details_id` int(11) NOT NULL,
  `restaurant_opening_hours_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_details_restaurant_opening_hours`
--

INSERT INTO `restaurant_details_restaurant_opening_hours` (`restaurant_details_id`, `restaurant_opening_hours_id`) VALUES
(2, 3),
(2, 4),
(2, 5),
(2, 6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restaurant_details_restaurant_opinions`
--

CREATE TABLE `restaurant_details_restaurant_opinions` (
  `restaurant_details_id` int(11) NOT NULL,
  `restaurant_opinions_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_details_restaurant_opinions`
--

INSERT INTO `restaurant_details_restaurant_opinions` (`restaurant_details_id`, `restaurant_opinions_id`) VALUES
(2, 1),
(2, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restaurant_details_type_payment`
--

CREATE TABLE `restaurant_details_type_payment` (
  `restaurant_details_id` int(11) NOT NULL,
  `type_payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_details_type_payment`
--

INSERT INTO `restaurant_details_type_payment` (`restaurant_details_id`, `type_payment_id`) VALUES
(2, 1),
(2, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restaurant_opening_hours`
--

CREATE TABLE `restaurant_opening_hours` (
  `id` int(11) NOT NULL,
  `start` time NOT NULL,
  `finish` time NOT NULL,
  `day` int(11) DEFAULT NULL,
  `all_day` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_opening_hours`
--

INSERT INTO `restaurant_opening_hours` (`id`, `start`, `finish`, `day`, `all_day`) VALUES
(1, '11:00:00', '22:00:00', 1, 1),
(2, '11:00:00', '23:00:00', 5, 0),
(3, '11:00:00', '22:00:00', 1, 1),
(4, '11:00:00', '23:00:00', 5, 0),
(5, '11:00:00', '00:00:00', 6, 0),
(6, '12:00:00', '22:00:00', 7, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `restaurant_opinions`
--

CREATE TABLE `restaurant_opinions` (
  `id` int(11) NOT NULL,
  `nick` varchar(64) NOT NULL,
  `data` datetime NOT NULL,
  `opinion` varchar(255) DEFAULT NULL,
  `stars` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `restaurant_opinions`
--

INSERT INTO `restaurant_opinions` (`id`, `nick`, `data`, `opinion`, `stars`) VALUES
(1, 'suchy', '2024-10-08 21:13:58', 'Wspaniała pizza', 5),
(2, 'paula', '2024-10-08 21:14:56', 'Dobra pizza', 5),
(3, 'ciapaty', '2024-10-08 21:15:17', 'najlepsza', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `size_product`
--

CREATE TABLE `size_product` (
  `id` int(11) NOT NULL,
  `size` varchar(64) NOT NULL,
  `restaurant_category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `size_product`
--

INSERT INTO `size_product` (`id`, `size`, `restaurant_category_id`) VALUES
(1, '50', 5),
(2, '70', 6),
(3, '23', NULL),
(4, '25', 28),
(5, '35', 28),
(6, '50', 28),
(7, '70', 28),
(8, '200', 29),
(9, '50', 36),
(10, '23', 39),
(11, '23', 39),
(12, '30', 20),
(13, '34', 41),
(14, '22', 42),
(15, '35', 42),
(16, '50', 42),
(17, '70', 42),
(18, '22', 43),
(19, '44', 43),
(20, '55', 43);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `social_media`
--

CREATE TABLE `social_media` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link_url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `type_payment`
--

CREATE TABLE `type_payment` (
  `id` int(11) NOT NULL,
  `type` varchar(32) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_payment`
--

INSERT INTO `type_payment` (`id`, `type`, `is_active`) VALUES
(1, 'Gotówką przy odbiorze', 1),
(2, 'Blikiem przy odbiorze', 1),
(3, 'Kartą przy odbiorze', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `is_verified` tinyint(1) NOT NULL,
  `restaurant_details_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `is_verified`, `restaurant_details_id`) VALUES
(2, 'suchanskib@gmail.com', '[\"ROLE_OWNER_RESTAURANT\"]', '$2y$13$xZuisYTRTIMdoByF6WRj6u3tobOJs3wHTi23QhuXpjA7N..eSAyo.', 0, 2),
(3, 'paaulaax@wp.pl', '[\"ROLE_OWNER_RESTAURANT\"]', '$2y$13$Hpv01w0X6gDSLN.qcPxIleQr24mt6.oxNvnsV1i81cxLT6.UBjJdm', 0, 13),
(5, 'kuba@onet.pl', '[\"ROLE_OWNER_RESTAURANT\"]', '$2y$13$5YG5Rr1nxsgDIAVTdM/D1OPrd0Xwnrql4TMTDwqeH8h4OBIYgqfIC', 0, 12);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BA388B71E202713` (`restaurant_details_id`),
  ADD KEY `IDX_BA388B767B3B43D` (`users_id`);

--
-- Indeksy dla tabeli `cart_cart_item`
--
ALTER TABLE `cart_cart_item`
  ADD PRIMARY KEY (`cart_id`,`cart_item_id`),
  ADD KEY `IDX_2A0002B81AD5CDBF` (`cart_id`),
  ADD KEY `IDX_2A0002B8E9B59A59` (`cart_item_id`);

--
-- Indeksy dla tabeli `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `cart_item_product`
--
ALTER TABLE `cart_item_product`
  ADD PRIMARY KEY (`cart_item_id`,`product_id`),
  ADD KEY `IDX_AE98B090E9B59A59` (`cart_item_id`),
  ADD KEY `IDX_AE98B0904584665A` (`product_id`);

--
-- Indeksy dla tabeli `category_kitchen`
--
ALTER TABLE `category_kitchen`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `free_extras`
--
ALTER TABLE `free_extras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_ED618F2A433DA7F8` (`restaurant_category_id`);

--
-- Indeksy dla tabeli `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4B60114F433DA7F8` (`restaurant_category_id`);

--
-- Indeksy dla tabeli `ingredients_prices_ingredient`
--
ALTER TABLE `ingredients_prices_ingredient`
  ADD PRIMARY KEY (`ingredients_id`,`prices_ingredient_id`),
  ADD KEY `IDX_2FE832B53EC4DCE` (`ingredients_id`),
  ADD KEY `IDX_2FE832B54A378264` (`prices_ingredient_id`);

--
-- Indeksy dla tabeli `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indeksy dla tabeli `poi`
--
ALTER TABLE `poi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_7DBB1FD61E202713` (`restaurant_details_id`);

--
-- Indeksy dla tabeli `prices_ingredient`
--
ALTER TABLE `prices_ingredient`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_12065267433DA7F8` (`restaurant_category_id`);

--
-- Indeksy dla tabeli `prices_ingredient_size_product`
--
ALTER TABLE `prices_ingredient_size_product`
  ADD PRIMARY KEY (`prices_ingredient_id`,`size_product_id`),
  ADD KEY `IDX_452377F4A378264` (`prices_ingredient_id`),
  ADD KEY `IDX_452377F9F6BE52F` (`size_product_id`);

--
-- Indeksy dla tabeli `prices_product`
--
ALTER TABLE `prices_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A171AF70433DA7F8` (`restaurant_category_id`);

--
-- Indeksy dla tabeli `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD PRIMARY KEY (`product_id`,`ingredients_id`),
  ADD KEY `IDX_E74F8F504584665A` (`product_id`),
  ADD KEY `IDX_E74F8F503EC4DCE` (`ingredients_id`);

--
-- Indeksy dla tabeli `product_prices_product`
--
ALTER TABLE `product_prices_product`
  ADD PRIMARY KEY (`product_id`,`prices_product_id`),
  ADD KEY `IDX_F218D15C4584665A` (`product_id`),
  ADD KEY `IDX_F218D15C3C2D4C4D` (`prices_product_id`);

--
-- Indeksy dla tabeli `restaurant_category`
--
ALTER TABLE `restaurant_category`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `restaurant_category_product`
--
ALTER TABLE `restaurant_category_product`
  ADD PRIMARY KEY (`restaurant_category_id`,`product_id`),
  ADD KEY `IDX_5A503891433DA7F8` (`restaurant_category_id`),
  ADD KEY `IDX_5A5038914584665A` (`product_id`);

--
-- Indeksy dla tabeli `restaurant_contact_details`
--
ALTER TABLE `restaurant_contact_details`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `restaurant_details`
--
ALTER TABLE `restaurant_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_B86D57FFF5B7AF75` (`address_id`),
  ADD UNIQUE KEY `UNIQ_B86D57FFE75F00E7` (`restaurant_contact_details_id`);

--
-- Indeksy dla tabeli `restaurant_details_category_kitchen`
--
ALTER TABLE `restaurant_details_category_kitchen`
  ADD PRIMARY KEY (`restaurant_details_id`,`category_kitchen_id`),
  ADD KEY `IDX_C6C7F2E1E202713` (`restaurant_details_id`),
  ADD KEY `IDX_C6C7F2E799BD07A` (`category_kitchen_id`);

--
-- Indeksy dla tabeli `restaurant_details_restaurant_category`
--
ALTER TABLE `restaurant_details_restaurant_category`
  ADD PRIMARY KEY (`restaurant_details_id`,`restaurant_category_id`),
  ADD KEY `IDX_E743E1C81E202713` (`restaurant_details_id`),
  ADD KEY `IDX_E743E1C8433DA7F8` (`restaurant_category_id`);

--
-- Indeksy dla tabeli `restaurant_details_restaurant_opening_hours`
--
ALTER TABLE `restaurant_details_restaurant_opening_hours`
  ADD PRIMARY KEY (`restaurant_details_id`,`restaurant_opening_hours_id`),
  ADD KEY `IDX_24BB18A21E202713` (`restaurant_details_id`),
  ADD KEY `IDX_24BB18A280EBF12A` (`restaurant_opening_hours_id`);

--
-- Indeksy dla tabeli `restaurant_details_restaurant_opinions`
--
ALTER TABLE `restaurant_details_restaurant_opinions`
  ADD PRIMARY KEY (`restaurant_details_id`,`restaurant_opinions_id`),
  ADD KEY `IDX_5FA080D91E202713` (`restaurant_details_id`),
  ADD KEY `IDX_5FA080D91B3C8723` (`restaurant_opinions_id`);

--
-- Indeksy dla tabeli `restaurant_details_type_payment`
--
ALTER TABLE `restaurant_details_type_payment`
  ADD PRIMARY KEY (`restaurant_details_id`,`type_payment_id`),
  ADD KEY `IDX_6C3EA6861E202713` (`restaurant_details_id`),
  ADD KEY `IDX_6C3EA68619C0759E` (`type_payment_id`);

--
-- Indeksy dla tabeli `restaurant_opening_hours`
--
ALTER TABLE `restaurant_opening_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `restaurant_opinions`
--
ALTER TABLE `restaurant_opinions`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `size_product`
--
ALTER TABLE `size_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3627D6D5433DA7F8` (`restaurant_category_id`);

--
-- Indeksy dla tabeli `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `type_payment`
--
ALTER TABLE `type_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`),
  ADD KEY `IDX_8D93D6491E202713` (`restaurant_details_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_kitchen`
--
ALTER TABLE `category_kitchen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `free_extras`
--
ALTER TABLE `free_extras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `poi`
--
ALTER TABLE `poi`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2342352;

--
-- AUTO_INCREMENT for table `prices_ingredient`
--
ALTER TABLE `prices_ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `prices_product`
--
ALTER TABLE `prices_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `restaurant_category`
--
ALTER TABLE `restaurant_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `restaurant_contact_details`
--
ALTER TABLE `restaurant_contact_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `restaurant_details`
--
ALTER TABLE `restaurant_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `restaurant_opening_hours`
--
ALTER TABLE `restaurant_opening_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `restaurant_opinions`
--
ALTER TABLE `restaurant_opinions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `size_product`
--
ALTER TABLE `size_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_payment`
--
ALTER TABLE `type_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_BA388B71E202713` FOREIGN KEY (`restaurant_details_id`) REFERENCES `restaurant_details` (`id`),
  ADD CONSTRAINT `FK_BA388B767B3B43D` FOREIGN KEY (`users_id`) REFERENCES `user` (`id`);

--
-- Constraints for table `cart_cart_item`
--
ALTER TABLE `cart_cart_item`
  ADD CONSTRAINT `FK_2A0002B81AD5CDBF` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2A0002B8E9B59A59` FOREIGN KEY (`cart_item_id`) REFERENCES `cart_item` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_item_product`
--
ALTER TABLE `cart_item_product`
  ADD CONSTRAINT `FK_AE98B0904584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_AE98B090E9B59A59` FOREIGN KEY (`cart_item_id`) REFERENCES `cart_item` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `free_extras`
--
ALTER TABLE `free_extras`
  ADD CONSTRAINT `FK_ED618F2A433DA7F8` FOREIGN KEY (`restaurant_category_id`) REFERENCES `restaurant_category` (`id`);

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `FK_4B60114F433DA7F8` FOREIGN KEY (`restaurant_category_id`) REFERENCES `restaurant_category` (`id`);

--
-- Constraints for table `ingredients_prices_ingredient`
--
ALTER TABLE `ingredients_prices_ingredient`
  ADD CONSTRAINT `FK_2FE832B53EC4DCE` FOREIGN KEY (`ingredients_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2FE832B54A378264` FOREIGN KEY (`prices_ingredient_id`) REFERENCES `prices_ingredient` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `poi`
--
ALTER TABLE `poi`
  ADD CONSTRAINT `FK_7DBB1FD61E202713` FOREIGN KEY (`restaurant_details_id`) REFERENCES `restaurant_details` (`id`);

--
-- Constraints for table `prices_ingredient`
--
ALTER TABLE `prices_ingredient`
  ADD CONSTRAINT `FK_12065267433DA7F8` FOREIGN KEY (`restaurant_category_id`) REFERENCES `restaurant_category` (`id`);

--
-- Constraints for table `prices_ingredient_size_product`
--
ALTER TABLE `prices_ingredient_size_product`
  ADD CONSTRAINT `FK_452377F4A378264` FOREIGN KEY (`prices_ingredient_id`) REFERENCES `prices_ingredient` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_452377F9F6BE52F` FOREIGN KEY (`size_product_id`) REFERENCES `size_product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prices_product`
--
ALTER TABLE `prices_product`
  ADD CONSTRAINT `FK_A171AF70433DA7F8` FOREIGN KEY (`restaurant_category_id`) REFERENCES `restaurant_category` (`id`);

--
-- Constraints for table `product_ingredients`
--
ALTER TABLE `product_ingredients`
  ADD CONSTRAINT `FK_E74F8F503EC4DCE` FOREIGN KEY (`ingredients_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E74F8F504584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_prices_product`
--
ALTER TABLE `product_prices_product`
  ADD CONSTRAINT `FK_F218D15C3C2D4C4D` FOREIGN KEY (`prices_product_id`) REFERENCES `prices_product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F218D15C4584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurant_category_product`
--
ALTER TABLE `restaurant_category_product`
  ADD CONSTRAINT `FK_5A503891433DA7F8` FOREIGN KEY (`restaurant_category_id`) REFERENCES `restaurant_category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5A5038914584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurant_details`
--
ALTER TABLE `restaurant_details`
  ADD CONSTRAINT `FK_B86D57FFE75F00E7` FOREIGN KEY (`restaurant_contact_details_id`) REFERENCES `restaurant_contact_details` (`id`),
  ADD CONSTRAINT `FK_B86D57FFF5B7AF75` FOREIGN KEY (`address_id`) REFERENCES `address` (`id`);

--
-- Constraints for table `restaurant_details_category_kitchen`
--
ALTER TABLE `restaurant_details_category_kitchen`
  ADD CONSTRAINT `FK_C6C7F2E1E202713` FOREIGN KEY (`restaurant_details_id`) REFERENCES `restaurant_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C6C7F2E799BD07A` FOREIGN KEY (`category_kitchen_id`) REFERENCES `category_kitchen` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurant_details_restaurant_category`
--
ALTER TABLE `restaurant_details_restaurant_category`
  ADD CONSTRAINT `FK_E743E1C81E202713` FOREIGN KEY (`restaurant_details_id`) REFERENCES `restaurant_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_E743E1C8433DA7F8` FOREIGN KEY (`restaurant_category_id`) REFERENCES `restaurant_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurant_details_restaurant_opening_hours`
--
ALTER TABLE `restaurant_details_restaurant_opening_hours`
  ADD CONSTRAINT `FK_24BB18A21E202713` FOREIGN KEY (`restaurant_details_id`) REFERENCES `restaurant_details` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_24BB18A280EBF12A` FOREIGN KEY (`restaurant_opening_hours_id`) REFERENCES `restaurant_opening_hours` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurant_details_restaurant_opinions`
--
ALTER TABLE `restaurant_details_restaurant_opinions`
  ADD CONSTRAINT `FK_5FA080D91B3C8723` FOREIGN KEY (`restaurant_opinions_id`) REFERENCES `restaurant_opinions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_5FA080D91E202713` FOREIGN KEY (`restaurant_details_id`) REFERENCES `restaurant_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `restaurant_details_type_payment`
--
ALTER TABLE `restaurant_details_type_payment`
  ADD CONSTRAINT `FK_6C3EA68619C0759E` FOREIGN KEY (`type_payment_id`) REFERENCES `type_payment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_6C3EA6861E202713` FOREIGN KEY (`restaurant_details_id`) REFERENCES `restaurant_details` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `size_product`
--
ALTER TABLE `size_product`
  ADD CONSTRAINT `FK_3627D6D5433DA7F8` FOREIGN KEY (`restaurant_category_id`) REFERENCES `restaurant_category` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D6491E202713` FOREIGN KEY (`restaurant_details_id`) REFERENCES `restaurant_details` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
