-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 29, 2018 at 06:32 AM
-- Server version: 10.1.31-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `TMDT`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `cart` text COLLATE utf8_unicode_ci NOT NULL,
  `lastactive` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `email`, `role`, `info`, `cart`, `lastactive`) VALUES
(1, 'admin', '207568141f098d80411c16d04da5a281326ca993dcb17056761f507b0a860b8a', 'khanhit197@gmail.com', 'admin', '', '[]', 1527587309);

-- --------------------------------------------------------

--
-- Table structure for table `bainop`
--

CREATE TABLE IF NOT EXISTS `bainop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_upload` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `bainop`
--

INSERT INTO `bainop` (`id`, `title`, `file`, `date_upload`) VALUES
(15, 'Bài nộp phần SEO - 07/04/2018', 'http://giaystore.tk/assets/files/SEO.docx', 1524116321),
(16, 'Bài nộp chữ kí số', 'http://giaystore.tk/assets/files/chukiso.docx', 1524853320);

--
-- Triggers `bainop`
--
DROP TRIGGER IF EXISTS `insert date auto`;
DELIMITER //
CREATE TRIGGER `insert date auto` BEFORE INSERT ON `bainop`
 FOR EACH ROW BEGIN
	SET NEW.date_upload = UNIX_TIMESTAMP();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE IF NOT EXISTS `captcha` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `publickey` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `privatekey` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`id`, `email`, `publickey`, `privatekey`) VALUES
(1, 'khanhit197@gmail.com', '6Lf03TsUAAAAAFsmQSBaPm-oXwT9h7CBfdl4hL52', '6Lf03TsUAAAAAJ3QZmKT5dSfds9N2fy5OGra97Al');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Nike'),
(2, 'Adidas'),
(3, 'Bitis');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `organization` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Triggers `contact`
--
DROP TRIGGER IF EXISTS `insert-date-auto-contact`;
DELIMITER //
CREATE TRIGGER `insert-date-auto-contact` BEFORE INSERT ON `contact`
 FOR EACH ROW BEGIN
	SET new.datetime  = UNIX_TIMESTAMP();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `homepage`
--

CREATE TABLE IF NOT EXISTS `homepage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `homepage`
--

INSERT INTO `homepage` (`id`, `name`, `value`) VALUES
(1, 'banner', '[{"stt":1,"title":"Giay The Thao Banner","url":"http:\\/\\/giaystore.tk\\/assets\\/images\\/banner\\/banner1.jpg"},{"stt":2,"title":"Banner Nike giay the thao","url":"http:\\/\\/giaystore.tk\\/assets\\/images\\/banner\\/banner2-1.jpg"},{"stt":3,"title":"banner adidas giay the thao","url":"http:\\/\\/giaystore.tk\\/assets\\/images\\/banner\\/banner3.jpg"},{"stt":4,"title":"Banner cua hang giay giaystore.tk","url":"http:\\/\\/giaystore.tk\\/assets\\/images\\/banner\\/banner4-1.jpg"}]'),
(2, 'optionsproduct', '{"listnew":[5,6,7,8,9,10,11,24],"listseller":[12,13,14,25,15,16,23],"listsale":[27,17,18,19,20,21,22]}'),
(3, 'passmail', '23cf7becf4f9776bc93f6de8c615433e13e4c8bda4b160883421280ed93a928d');

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `email`, `title`, `name`, `message`, `status`) VALUES
(10, 'khanhit197@gmail.com', 'Thông báo tài khoản', 'admin', 'Bạn vừa đổi mật khẩu tài khoản tại website http://giaystore.tk/', 'done');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(11) NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `payment` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `datetime` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_orders_payment` (`payment`),
  KEY `fk_orders_account` (`account`),
  KEY `fk_orders_status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=356123224 ;

--
-- Triggers `orders`
--
DROP TRIGGER IF EXISTS `auto insert datetime in orders`;
DELIMITER //
CREATE TRIGGER `auto insert datetime in orders` BEFORE INSERT ON `orders`
 FOR EACH ROW BEGIN
	set new.datetime = UNIX_TIMESTAMP();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `name`, `status`) VALUES
(1, 'Thanh toán khi nhận hàng', 'enable'),
(2, 'Thanh toán bằng thẻ tín dụng', 'disabled'),
(3, 'Thanh toán bằng thẻ ATM', 'disabled'),
(4, 'Thanh toán qua Ngân Lượng', 'enable');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `lastchange` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_product_category` (`category`),
  KEY `index_product` (`id`,`code`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=28 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `category`, `detail`, `lastchange`) VALUES
(5, '0001', 2, '{"name":"ALPHABOUNCE_13","price":500000,"number":20,"material":"v\\u1ea3i","color":["tr\\u1eafng","\\u0111en","xanh"],"size":["41","42"],"origin":"m\\u1ef9","seo-title":"ALPHABOUNCE_13","seo-description":"ALPHABOUNCE_13","seo-link":"adidas-ALPHABOUNCE","seo-keywords":["ALPHABOUNCE_13","giaythethao","adidas","giaygiare","giaystore","giaydep"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/ALPHABOUNCE_13.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/HUMAN_RACE_04.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/HUMAN_RACE_05.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/HUMAN_RACE_06.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/HUMAN_RACE_07.jpg"]}', 1526656752),
(6, '0002', 2, '{"name":"HUMAN_RACE_04","price":550000,"number":5,"material":"da, v\\u1ea3i","color":["tr\\u1eafng"," \\u0111en"],"size":["40","41","42"],"origin":"L\\u00e0o","seo-title":"HUMAN_RACE_04","seo-description":"HUMAN_RACE_04","seo-link":"adidas-HUMAN-RACE-04","seo-keywords":["HUMANRACE-giay-giaythethao-giayadias"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/HUMAN_RACE_04.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/HUMAN_RACE_08.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/JEZZY_04.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/PROPHERE_01.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/PROPHERE_02.jpg"]}', 1526656987),
(7, '0003', 2, '{"name":"HUMAN_RACE_06","price":600000,"number":12,"material":"da","color":["tr\\u1eafng","\\u0111en","v\\u00e0ng"],"size":["40","41"],"origin":"Thailan","seo-title":"HUMAN_RACE_06","seo-description":"HUMAN_RACE_06","seo-link":"HUMAN-RACE-06","seo-keywords":["HUMAN_RACE_06"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/HUMAN_RACE_06.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/PROPHERE_03.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/PROPHERE_04.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/PROPHERE_05.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/PROPHERE_06.jpg"]}', 1526657064),
(8, '0004', 2, '{"name":"STAN_SMITH_08","price":530000,"number":5,"material":"v\\u1ea3i","color":["tr\\u1eafng"," \\u0111en","h\\u1ed3ng"],"size":["40","41","42"],"origin":"campuchia","seo-title":"STAN_SMITH_08","seo-description":"STAN_SMITH_08","seo-link":"STAN-SMITH-08","seo-keywords":["STAN_SMITH_08"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/STAN_SMITH_08.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/STAN_SMITH_09.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/ULTRABOOST_22.jpg"]}', 1526658379),
(9, '0005', 1, '{"name":"AIRMAX_FURY_01","price":450000,"number":5,"material":"v\\u1ea3i","color":["x\\u00e1m"," \\u0111en","t\\u00edm"],"size":["40","41","42"],"origin":"campuchia","seo-title":"AIRMAX_FURY_01","seo-description":"AIRMAX_FURY_01","seo-link":"AIRMAX-FURY-01","seo-keywords":["AIRMAX_FURY_01"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/AIRMAX_FURY_01.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/AIRMAX_FURY_02.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/AIRMAX_FURY_03.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/AIRMAX_FURY_04.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/AIRMAX_FURY_05.jpg"]}', 1526658578),
(10, '0006', 1, '{"name":"AIRMAX_FURY_06","price":600000,"number":7,"material":"v\\u1ea3i","color":["x\\u00e1m"," \\u0111en"],"size":["40","41","42"],"origin":"campuchia","seo-title":"AIRMAX_FURY_06","seo-description":"AIRMAX_FURY_06","seo-link":"AIRMAX-FURY-06","seo-keywords":["AIRMAX_FURY_06"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/AIRMAX_FURY_06.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/AIRMAX_FURY_07.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/AIRMAX_FURY_08.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/NIKE_STRUCTURE_01.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/NIKE_STRUCTURE_02.jpg"]}', 1526658659),
(11, '0007', 1, '{"name":"NIKE_STRUCTURE_03","price":450000,"number":20,"material":"v\\u1ea3i","color":["x\\u00e1m","\\u0111en","t\\u00edm","xanh"],"size":["40","42"],"origin":"dongtimo","seo-title":"NIKE_STRUCTURE_03","seo-description":"NIKE_STRUCTURE_03","seo-link":"NIKE-STRUCTURE-03","seo-keywords":["NIKE_STRUCTURE_03"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/NIKE_STRUCTURE_03.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/NIKE_STRUCTURE_04.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/NIKE_STRUCTURE_05.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/NIKE_STRUCTURE_06.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/UPTEMPO_07.jpg"]}', 1526658753),
(12, '0008', 1, '{"name":"AIRMAX_FURY_08","price":500000,"number":10,"material":"da,v\\u1ea3i","color":["xanh","\\u0111en","x\\u00e1m"],"size":["40","41","42"],"origin":"campuchia","seo-title":"AIRMAX_FURY_07","seo-description":"AIRMAX_FURY_07","seo-link":"AIRMAX-FURY-07","seo-keywords":["AIRMAX_FURY_07"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (2).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (3).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (4).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (5).jpg"]}', 1526659280),
(13, '0009', 1, '{"name":"AIRMAX_FURY_08","price":450000,"number":10,"material":"v\\u1ea3i","color":["x\\u00e1m","tr\\u1eafng","n\\u00e2u"],"size":["40","41"],"origin":"thailand","seo-title":"AIRMAX_FURY_08","seo-description":"AIRMAX_FURY_08","seo-link":"AIRMAX-FURY-08","seo-keywords":["AIRMAX_FURY_08"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (6).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (7).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (8).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (9).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (10).jpg"]}', 1526659342),
(14, '0010', 1, '{"name":"AIRMAX_FURY_09","price":600000,"number":15,"material":"v\\u1ea3i","color":["\\u0111en","t\\u00edm"],"size":["40","41"],"origin":"m\\u1ef9","seo-title":"AIRMAX_FURY_09","seo-description":"AIRMAX_FURY_09","seo-link":"AIRMAX-FURY-09","seo-keywords":["AIRMAX_FURY_09"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (11).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (12).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (13).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (14).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (15).jpg"]}', 1526659409),
(15, '0011', 1, '{"name":"AIRMAX_FURY_10","price":520000,"number":10,"material":"v\\u1ea3i","color":["\\u0111en","h\\u1ed3ng","tr\\u1eafng"],"size":["40","41"],"origin":"vietnam","seo-title":"AIRMAX_FURY_10","seo-description":"AIRMAX_FURY_10","seo-link":"AIRMAX-FURY-10","seo-keywords":["AIRMAX_FURY_10"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (16).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (17).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (18).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (19).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (20).jpg"]}', 1526659491),
(16, '0012', 1, '{"name":"AIRMAX_FURY_11","price":420000,"number":10,"material":"v\\u1ea3i","color":["\\u0111en","h\\u1ed3ng"],"size":["40","41","42"],"origin":"vietnam","seo-title":"AIRMAX_FURY_11","seo-description":"AIRMAX_FURY_11","seo-link":"AIRMAX-FURY-11","seo-keywords":["AIRMAX_FURY_11"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (21).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (22).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (23).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (24).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (25).jpg"]}', 1526659567),
(17, '0013', 1, '{"name":"AIRMAX_FURY_12","price":650000,"number":15,"material":"v\\u1ea3i","color":["\\u0111en","tr\\u1eafng"],"size":["40","41","42"],"origin":"vietnam","seo-title":"AIRMAX_FURY_12","seo-description":"AIRMAX_FURY_12","seo-link":"AIRMAX-FURY-12","seo-keywords":["AIRMAX_FURY_12"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (26).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (27).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (28).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (29).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (30).jpg"]}', 1526659653),
(18, '0014', 1, '{"name":"AIRMAX_FURY_13","price":450000,"number":5,"material":"v\\u1ea3i","color":["\\u0111en"],"size":["40","41"],"origin":"vietnam","seo-title":"AIRMAX_FURY_13","seo-description":"AIRMAX_FURY_13","seo-link":"AIRMAX-FURY-13","seo-keywords":["AIRMAX_FURY_13"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (31).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (32).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (33).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (34).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (35).jpg"]}', 1526659715),
(19, '0015', 1, '{"name":"AIRMAX_FURY_14","price":560000,"number":5,"material":"v\\u1ea3i","color":["\\u0111en","h\\u1ed3ng","xanh"],"size":["40","42"],"origin":"vietnam","seo-title":"AIRMAX_FURY_14","seo-description":"AIRMAX_FURY_14","seo-link":"AIRMAX-FURY-14","seo-keywords":["AIRMAX_FURY_14"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (36).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (37).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (38).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (39).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (40).jpg"]}', 1526659782),
(20, '0016', 1, '{"name":"AIRMAX_FURY_15","price":460000,"number":5,"material":"v\\u1ea3i","color":["n\\u00e2u","tr\\u1eafng","\\u0111en"],"size":["41","42"],"origin":"vietnam","seo-title":"AIRMAX_FURY_15","seo-description":"AIRMAX_FURY_15","seo-link":"AIRMAX-FURY-15","seo-keywords":["AIRMAX_FURY_15"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (41).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (42).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (43).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (44).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (45).jpg"]}', 1526659855),
(21, '0017', 1, '{"name":"AIRMAX_FURY_16","price":620000,"number":3,"material":"v\\u1ea3i","color":["\\u0111en","x\\u00e1m","xanh"],"size":["41","42"],"origin":"vietnam","seo-title":"AIRMAX_FURY_16","seo-description":"AIRMAX_FURY_16","seo-link":"AIRMAX-FURY-16","seo-keywords":["AIRMAX_FURY_16"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (46).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (47).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (48).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (49).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (50).jpg"]}', 1526659945),
(22, '0018', 1, '{"name":"AIRMAX_FURY_17","price":650000,"number":4,"material":"v\\u1ea3i","color":["xanh","\\u0111\\u1ecf","tr\\u1eafng","\\u0111en"],"size":["40","41"],"origin":"vietnam","seo-title":"AIRMAX_FURY_17","seo-description":"AIRMAX_FURY_17","seo-link":"AIRMAX-FURY-17","seo-keywords":["AIRMAX_FURY_17"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (51).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (52).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (53).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (54).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (55).jpg"]}', 1526660032),
(23, '0019', 1, '{"name":"AIRMAX_FURY_18","price":620000,"number":6,"material":"v\\u1ea3i,da","color":["\\u0111en","xanh","tr\\u1eafng"],"size":["40","41"],"origin":"vietnam","seo-title":"AIRMAX_FURY_18","seo-description":"AIRMAX_FURY_18","seo-link":"AIRMAX-FURY-18","seo-keywords":["AIRMAX_FURY_18"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (56).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (57).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (58).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (59).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (60).jpg"]}', 1526660131),
(24, '0020', 1, '{"name":"AIRMAX_FURY_19","price":530000,"number":16,"material":"v\\u1ea3i","color":["v\\u00e0ng","\\u0111en","tr\\u1eafng"],"size":["40","41"],"origin":"vietnam","seo-title":"AIRMAX_FURY_19","seo-description":"AIRMAX_FURY_19","seo-link":"AIRMAX-FURY-19","seo-keywords":["AIRMAX_FURY_19"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (61).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (62).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (63).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (64).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/images (65).jpg"]}', 1526660198),
(25, '0030', 3, '{"name":"Biti''s Hunter Dark Tribal","price":420000,"number":10,"material":"v\\u1ea3i,da","color":["\\u0111\\u1ecf \\u0111\\u00f4","cam"],"size":["40","41"],"origin":"Vi\\u1ec7t Nam","seo-title":"Biti''s Hunter Dark Tribal","seo-description":"Biti''s Hunter Dark Tribal","seo-link":"Biti-s-Hunter-Dark-Tribal","seo-keywords":["Biti''s-Hunter-Dark-Tribal","giay","-giaybitis","giaysontung"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Bitis\\/images (1).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Bitis\\/images (2).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Bitis\\/images (3).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Bitis\\/images (4).jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Bitis\\/images (5).jpg"]}', 1526660861),
(26, '0031', 1, '{"name":"Biti''s Hunter Dark Tribal 2","price":460000,"number":6,"material":"da,v\\u1ea3i","color":["xanh "," tr\\u1eafng","\\u0111en"],"size":["41","42"],"origin":"vietnam","seo-title":"Biti''s Hunter Dark Tribal 2","seo-description":"Biti''s Hunter Dark Tribal 2","seo-link":"Biti-s-Hunter-Dark-Tribal-2","seo-keywords":["Biti''s-Hunter-Dark-Tribal-2"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/32777293_2225776807649625_4170273129697902592_n.jpg"]}', 1526660912),
(27, 'g001', 2, '{"name":"Gi\\u1ea7y adidas Neo DAILY AW4568","price":1255000,"number":14,"material":"","color":["X\\u00e1m nh\\u1ea1t"],"size":["40"],"origin":"","seo-title":"adidas Neo nam Ch\\u00ednh H\\u00e3ng DAILY AW4568","seo-description":"giaydep giayadidas giaystore cuahanggiay giaythethao giaygiare","seo-link":"Giay-adidas-Neo-nam-Chinh-Hang-DAILY-AW4568","seo-keywords":["giaydep","giayadidas","giaystore","cuahanggiay","giaythethao","giaydichoi"],"images":["http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/adidas-neo-01.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/adidas-neo-02.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/adidas-neo-03.jpg","http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/adidas-neo-04.jpg"]}', 1527101794);

--
-- Triggers `product`
--
DROP TRIGGER IF EXISTS `insert_lastchange_auto`;
DELIMITER //
CREATE TRIGGER `insert_lastchange_auto` BEFORE INSERT ON `product`
 FOR EACH ROW BEGIN
	SET NEW.lastchange = UNIX_TIMESTAMP();
END
//
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(1, 'Chờ xác nhận'),
(2, 'Đã xác nhận'),
(3, 'Đang giao hàng'),
(4, 'Đã giao hàng'),
(5, 'Đang hoàn hàng'),
(6, 'Đã hoàn hàng'),
(7, 'Đã hủy'),
(8, 'Chờ thanh toán');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_account` FOREIGN KEY (`account`) REFERENCES `account` (`id`),
  ADD CONSTRAINT `fk_orders_payment` FOREIGN KEY (`payment`) REFERENCES `payment` (`id`),
  ADD CONSTRAINT `fk_orders_status` FOREIGN KEY (`status`) REFERENCES `status` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_category` FOREIGN KEY (`category`) REFERENCES `category` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
