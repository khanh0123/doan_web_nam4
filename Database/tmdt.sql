-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2018 at 08:03 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `cart` text COLLATE utf8_unicode_ci NOT NULL,
  `lastactive` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `password`, `email`, `role`, `info`, `cart`, `lastactive`) VALUES
(1, 'admin', '23cf7becf4f9776bc93f6de8c615433e13e4c8bda4b160883421280ed93a928d', 'khanhit197@gmail.com', 'admin', '', '', 1527855944),
(2, 'khanh', 'fb54fa4898d04c18809206a434ff02c14de1cf42ba0a9fed44c8805dcb2c78fd', 'test1234@gmail.com', 'mod', '', '[]', 1526914985),
(3, 'guest', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'test1235@gmail.com', 'member', '', '[]', 1526239300),
(5, 'test123123', 'abe2cc7bfdb33cf7e1530165054e6cb4896b34d5c2d792beb0330a79a0d7731d', 'test123123@gmail.com', 'member', '', '[{\"code\":\"Nguyen Ngoc Khanh\",\"num\":\"2\",\"color\":\"\\u0110\\u1ecf\",\"size\":12},{\"code\":\"AQ4129-600\",\"num\":1,\"color\":\"\\u0111en\",\"size\":32}]', 1527087016);

-- --------------------------------------------------------

--
-- Table structure for table `captcha`
--

CREATE TABLE `captcha` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `publickey` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `privatekey` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `captcha`
--

INSERT INTO `captcha` (`id`, `email`, `publickey`, `privatekey`) VALUES
(1, 'khanhit197@gmail.com', '6Lf03TsUAAAAAFsmQSBaPm-oXwT9h7CBfdl4hL52', '6Lf03TsUAAAAAJ3QZmKT5dSfds9N2fy5OGra97Al');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `organization` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `organization`, `email`, `subject`, `message`, `ip`, `datetime`) VALUES
(1, 'Khanh Nguyen', 'STU', 'khanhpro20145@gmail.com', '123', '123', '::1', 1526185896),
(2, 'Nguyen Ngoc Khanh', '123', 'khanhpro20145@gmail.com', '123', '123', '::1', 1526408933),
(3, 'Nguyen Ngoc Khanh', '123', 'khanhpro20145@gmail.com', '123', '123', '::1', 1526408969),
(4, 'Nguyen Khanh', 'Hacking', 'khanhpro20145@gmail.com', '123', '123', '::1', 1526410271),
(5, 'Nguyen Ngoc Khanh', 'te4sst', 'khanhpro20145@gmail.com', '12312312', '12312312312', '::1', 1527351999),
(6, 'Nguyen Ngoc Khanh', '123', 'khanhpro20145@gmail.com', '123', 'test', '::1', 1527352181),
(7, 'Nguyen Ngoc Khanh', 'STU', 'khanhpro20145@gmail.com', 'Công nghệ thông tin', 'test mail', '::1', 1527525060);

--
-- Triggers `contact`
--
DELIMITER $$
CREATE TRIGGER `insert-date-auto-contact` BEFORE INSERT ON `contact` FOR EACH ROW BEGIN
	SET new.datetime  = UNIX_TIMESTAMP();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `homepage`
--

CREATE TABLE `homepage` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `homepage`
--

INSERT INTO `homepage` (`id`, `name`, `value`) VALUES
(1, 'banner', '[{\"stt\":1,\"title\":\"adidas\",\"url\":\"http:\\/\\/giaystore.tk\\/assets\\/images\\/banner\\/banner1.jpg\"},{\"stt\":2,\"title\":\"nike\",\"url\":\"http:\\/\\/giaystore.tk\\/assets\\/images\\/banner\\/banner2.jpg\"},{\"stt\":3,\"title\":\"adidas\",\"url\":\"http:\\/\\/giaystore.tk\\/assets\\/images\\/banner\\/banner3.jpg\"}]'),
(2, 'optionsproduct', '{\"listnew\":[1,2,9,10,11,12],\"listseller\":[3,4,5,6],\"listsale\":[13]}'),
(3, 'passmail', '23cf7becf4f9776bc93f6de8c615433e13e4c8bda4b160883421280ed93a928d');

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `account` int(11) NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `payment` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `datetime` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `account`, `detail`, `payment`, `status`, `datetime`) VALUES
(1, 1, '{\"info_payment\":{\"name\":\"Khanh Nguyen\",\"email\":\"khanhpro20145@gmail.com\",\"phone\":\"982520605\",\"address\":\"C6\\/15G Ph\\u1ea1m H\\u00f9ng\"},\"cart\":[{\"code\":\"41\",\"num\":1,\"color\":\"4124\",\"size\":124},{\"code\":\"AQ4129-600\",\"num\":1,\"color\":\"\\u0111en\",\"size\":32}],\"shipping\":40000,\"total_money\":2003241}', 4, 8, 1527855971);

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `auto insert datetime in orders` BEFORE INSERT ON `orders` FOR EACH ROW BEGIN
	set new.datetime = UNIX_TIMESTAMP();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `code` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(11) NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `lastchange` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `category`, `detail`, `lastchange`) VALUES
(1, 'bb61671', 2, '{\"name\":\"ULTRABOOST SHOES\",\"price\":3000000,\"number\":50,\"material\":\"Da\",\"color\":[\"Xanh\",\"Tr\\u1eafng\"],\"size\":[\"41\",\"42\"],\"origin\":\"M\\u1ef9\",\"seo-title\":\"ULTRABOOST SHOES gi\\u00e0y th\\u1ec3 thao\",\"seo-description\":\"B\\u00e1n gi\\u00e0y th\\u1ec3 thao adidas\",\"images\":[\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/ALPHABOUNCE_13.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/HUMAN_RACE_04.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/HUMAN_RACE_05.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/HUMAN_RACE_06.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/HUMAN_RACE_07.jpg\"],\"seo-link\":\"Giay-Adidas-UtrabooST\",\"seo-keywords\":[\"giaystore\",\"giaythethao\",\"adidas-hello\"]}', 1525156798),
(2, 'AQ4129-600', 1, '{\"name\":\"Nike Air Max 95 SE\",\"price\":2000000,\"number\":30,\"material\":\"da\",\"color\":[\"\\u0111en\",\"tr\\u1eafng\"],\"size\":[\"32\",\"43\"],\"origin\":\"Trung Qu\\u1ed1c\",\"seo-title\":\"what the fuck\",\"seo-description\":\"abc\",\"images\":[\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/AIRMAX_FURY_01.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/AIRMAX_FURY_05.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/AIRMAX_FURY_02.jpg\"],\"seo-link\":\"Nike-Air-Max-95-SE-html\",\"seo-keywords\":[\"Gi\\u00e0y-Th\\u1ec3-Thao\",\"Gi\\u00e0y-Nike\",\"Giaystore\",\"Nike-Air\"]}', 1525181665),
(3, 'TEST1', 1, '{\"name\":\"TEST\",\"price\":4000000,\"number\":300,\"material\":\"V\\u1ea3i\",\"color\":[\"\\u0110en\"],\"size\":[\"41\"],\"origin\":\"Hoa K\\u1ef3\",\"seo-title\":\"Giay VIP\",\"seo-description\":\"giay adidas chat luong cao, chinh hang\",\"seo-link\":\"giay-test-vip\",\"images\":[\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/ASICS_2.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/ASICS_3.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/ASICS_4.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/ASICS_5.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/ASICS_6.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/ASICS_7.jpg\"],\"seo-keywords\":[\"nike-giaytheothao-giaystore\"]}', 1525753267),
(4, 'test', 1, '{\"name\":\"test\",\"price\":123,\"number\":23,\"material\":\"\",\"color\":[\"\\u0110en\"],\"size\":[\"45\"],\"origin\":\"\",\"seo-title\":\"\",\"seo-description\":\"\",\"seo-link\":\"test-thoi\",\"seo-keywords\":[\"test-giay-nike\"],\"images\":[\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/32777293_2225776807649625_4170273129697902592_n.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/banner1.jpg\"]}', 1526583808),
(5, 'Nguyen Ngoc Khanh', 2, '{\"name\":\"NIKE\",\"price\":123123123,\"number\":12,\"material\":\"Nguyen Ngoc Khanh\",\"color\":[\"\\u0110\\u1ecf\"],\"size\":[\"12\"],\"origin\":\"123\",\"seo-title\":\"\",\"seo-description\":\"\",\"seo-link\":\"nike-giay\",\"seo-keywords\":[\"nike\"],\"images\":[\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Adidas\\/PROPHERE_04.jpg\"]}', 1526669609),
(6, '123123', 1, '{\"name\":\"Nguyen Ngoc Khanh\",\"price\":123,\"number\":13123,\"material\":\"123\",\"color\":[\"12312\"],\"size\":[\"123\"],\"origin\":\"123\",\"seo-title\":\"\",\"seo-description\":\"\",\"seo-link\":\"\",\"seo-keywords\":[\"\"],\"images\":[\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/PROPHERE_05.jpg\"]}', 1526669623),
(7, '3123', 1, '{\"name\":\"12312\",\"price\":312312,\"number\":1231,\"material\":\"23123\",\"color\":[\"123\"],\"size\":[\"123\"],\"origin\":\"123\",\"seo-title\":\"\",\"seo-description\":\"\",\"seo-link\":\"abc-khanhdeptrai\",\"seo-keywords\":[\"giaystore-giay-nike\"],\"images\":[\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/PROPHERE_06.jpg\"]}', 1526669632),
(8, '123', 1, '{\"name\":\"123\",\"price\":1231,\"number\":123123,\"material\":\"1321\",\"color\":[\"3312\"],\"size\":[\"123\"],\"origin\":\"\",\"seo-title\":\"\",\"seo-description\":\"\",\"seo-link\":\"giay-store\",\"seo-keywords\":[\"nike\"],\"images\":[\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/STAN_SMITH_08.jpg\"]}', 1526669646),
(9, '123123323', 1, '{\"name\":\"123\",\"price\":123,\"number\":123,\"material\":\"123\",\"color\":[\"123\"],\"size\":[\"123\"],\"origin\":\"123\",\"seo-title\":\"\",\"seo-description\":\"\",\"seo-link\":\"\",\"seo-keywords\":[\"\"],\"images\":[\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/STAN_SMITH_09.jpg\"]}', 1526669659),
(10, '12312312414', 1, '{\"name\":\"123\",\"price\":12312343,\"number\":124234324,\"material\":\"23423\",\"color\":[\"4234234\"],\"size\":[\"234234\"],\"origin\":\"\",\"seo-title\":\"\",\"seo-description\":\"\",\"seo-link\":\"giay-store\",\"seo-keywords\":[\"nike\"],\"images\":[\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/ULTRABOOST_22.jpg\"]}', 1526669675),
(11, '234234', 1, '{\"name\":\"312423\",\"price\":234,\"number\":234,\"material\":\"234\",\"color\":[\"234234\"],\"size\":[\"234\"],\"origin\":\"23423\",\"seo-title\":\"234\",\"seo-description\":\"234\",\"seo-link\":\"234234-nike\",\"seo-keywords\":[\"nike\"],\"images\":[\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/PROPHERE_03.jpg\"]}', 1526669690),
(12, '123124', 1, '{\"name\":\"234\",\"price\":12414,\"number\":141,\"material\":\"124\",\"color\":[\"23\"],\"size\":[\"124124\"],\"origin\":\"\",\"seo-title\":\"\",\"seo-description\":\"\",\"seo-link\":\"\",\"seo-keywords\":[\"\"],\"images\":[\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/PROPHERE_04.jpg\"]}', 1526669701),
(13, '41', 1, '{\"name\":\"23423\",\"price\":3241,\"number\":412,\"material\":\"4124\",\"color\":[\"4124\"],\"size\":[\"124\"],\"origin\":\"124\",\"seo-title\":\"124\",\"seo-description\":\"124\",\"seo-link\":\"1124\",\"seo-keywords\":[\"124\"],\"images\":[\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/HUMAN_RACE_06.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/HUMAN_RACE_07.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/HUMAN_RACE_08.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/JEZZY_04.jpg\",\"http:\\/\\/giaystore.tk\\/assets\\/images\\/product\\/Nike\\/PROPHERE_01.jpg\"]}', 1526669732);

--
-- Triggers `product`
--
DELIMITER $$
CREATE TRIGGER `insert_lastchange_auto` BEFORE INSERT ON `product` FOR EACH ROW BEGIN
	SET NEW.lastchange = UNIX_TIMESTAMP();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `captcha`
--
ALTER TABLE `captcha`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homepage`
--
ALTER TABLE `homepage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_payment` (`payment`),
  ADD KEY `fk_orders_account` (`account`),
  ADD KEY `fk_orders_status` (`status`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_category` (`category`),
  ADD KEY `index_product` (`id`,`code`) USING BTREE;

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `captcha`
--
ALTER TABLE `captcha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `homepage`
--
ALTER TABLE `homepage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
