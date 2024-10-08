-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Paź 08, 2024 at 09:24 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `szama`
--

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `city`, `street`, `street_number`) VALUES
(1, 'Częstochowa', 'Dekabrystów', '34');

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

--
-- Dumping data for table `poi`
--

INSERT INTO `poi` (`id`, `lat`, `lon`, `restaurant_details_id`) VALUES
(123423, '50.8254239', '19.1129694', 2);

--
-- Dumping data for table `restaurant_details`
--

INSERT INTO `restaurant_details` (`id`, `name_restaurant`, `average_opinion`, `min_purchase_amount`, `min_delivery_amount`, `logo`, `slug`, `address_id`) VALUES
(2, 'Mega pizza', 3.4, 40.00, 8, NULL, 'mega_pizza', 1);

--
-- Dumping data for table `restaurant_details_category_kitchen`
--

INSERT INTO `restaurant_details_category_kitchen` (`restaurant_details_id`, `category_kitchen_id`) VALUES
(2, 2),
(2, 5);

--
-- Dumping data for table `restaurant_details_restaurant_opinions`
--

INSERT INTO `restaurant_details_restaurant_opinions` (`restaurant_details_id`, `restaurant_opinions_id`) VALUES
(2, 1),
(2, 2),
(2, 3);

--
-- Dumping data for table `restaurant_opinions`
--

INSERT INTO `restaurant_opinions` (`id`, `nick`, `data`, `opinion`, `stars`) VALUES
(1, 'suchy', '2024-10-08 21:13:58', 'Wspaniała pizza', 5),
(2, 'paula', '2024-10-08 21:14:56', 'Dobra pizza', 5),
(3, 'ciapaty', '2024-10-08 21:15:17', 'najlepsza', 5);
COMMIT;
