-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 24, 2022 at 12:07 PM
-- Server version: 5.7.31
-- PHP Version: 8.1.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fourth_app_sym`
--

-- --------------------------------------------------------

--
-- Table structure for table `proizvodi`
--

DROP TABLE IF EXISTS `proizvodi`;
CREATE TABLE IF NOT EXISTS `proizvodi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_added` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `proizvodi`
--

INSERT INTO `proizvodi` (`id`, `name`, `price`, `slug`, `description`, `date_added`) VALUES
(1, 'Frižider 123 Aždaja', '28000.00', 'frižider-123-aždaja-1', 'Neki opis za firizider, vau, hladan je, sem kada nije', '2022-04-21'),
(2, 'Zamrzivac 543', '56000.00', 'zamrzivac-543-2', 'Neki opis za zamrzivac, zima zima, led', '2022-04-05'),
(3, 'Televizor 432', '68500.00', 'televizor-432-3', 'Neki opis za skup tv, slika, bitno da nije crno/beli', '2022-04-20'),
(6, 'LG Ves Masina 503', '43000.00', 'lg-ves-masina-503-6', 'Ves masina od lg-a sa a++ efikasnoscu', '2022-04-04'),
(11, 'Samsung S22 Plus', '100000.00', 'samsung-s22-plus-11', 'Samsung flagship smartphone', '2022-04-21'),
(13, 'Xiaomi Powerbank', '4000.00', 'xiaomi-powerbank', 'Xiaomi powerbank 20000mah, much power, woah', '2022-04-21'),
(14, 'Asus Gaming monitor', '25000.00', 'asus-gaming-monitor', 'Asus ips gaming monitor 144hz 24 inch size 1080p', '2022-04-21');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
