-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2018 at 02:47 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deliveroo`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `is_avail` tinyint(4) NOT NULL DEFAULT '1',
  `ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `afm` varchar(150) NOT NULL,
  `AMKA` varchar(150) NOT NULL,
  `IBAN` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `surname` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`is_avail`, `ID`, `user_ID`, `lat`, `lng`, `afm`, `AMKA`, `IBAN`, `name`, `surname`) VALUES
(1, 1, 4, 38.250929334601906, 21.7990279374917, '1234567891', '29118523654', 'GR4648923784034423478422984', 'giorgos', 'Abcdef'),
(1, 2, 5, 37.9838096, 23.727538800000048, '9999567891', '40218523654', 'FR464892344444423478422984', 'Paulos', 'Qwerty');

-- --------------------------------------------------------

--
-- Table structure for table `manages`
--

CREATE TABLE `manages` (
  `afm` varchar(150) NOT NULL,
  `AMKA` varchar(150) NOT NULL,
  `IBAN` varchar(150) NOT NULL,
  `man_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `surname` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `manages`
--

INSERT INTO `manages` (`afm`, `AMKA`, `IBAN`, `man_id`, `store_id`, `name`, `surname`) VALUES
('123123', '234', '123123123', 2, 1, 'man1', 'manager1'),
('12423123', '212434', '5671231123', 3, 2, 'man2', 'manager2');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `price` decimal(4,2) NOT NULL,
  `prod_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`price`, `prod_name`) VALUES
('1.00', 'bagel'),
('1.70', 'cake'),
('1.50', 'cappuccino'),
('2.00', 'cheese pie'),
('1.40', 'espresso'),
('1.00', 'filter coffee'),
('1.30', 'frappe'),
('1.10', 'greek coffee'),
('1.50', 'tost'),
('2.00', 'vegetable Pie');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `store_id` int(11) NOT NULL,
  `ID` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `is_delivered` tinyint(4) NOT NULL DEFAULT '0',
  `delivery_guy` int(11) NOT NULL,
  `placed_order` datetime NOT NULL,
  `total_price` float DEFAULT NULL,
  `distance` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`store_id`, `ID`, `lat`, `lng`, `is_delivered`, `delivery_guy`, `placed_order`, `total_price`, `distance`) VALUES
(1, 1, 37.93692, 23.944799999999987, 1, 1, '2018-07-14 13:53:11', 10.1, 0),
(2, 2, 37.9838096, 23.727538800000048, 1, 2, '2018-07-14 13:53:19', 200.1, 0),
(2, 3, 37.9838096, 23.727538800000048, 1, 2, '2018-07-15 16:46:36', 2, 0),
(2, 4, 37.9838096, 23.727538800000048, 1, 2, '2018-07-15 16:47:19', 2, 0),
(2, 5, 37.9838096, 23.727538800000048, 1, 2, '2018-07-15 16:49:22', 2, 0),
(1, 6, 37.9838096, 23.727538800000048, 1, 1, '2018-07-15 16:50:38', 2, 0),
(1, 7, 38.2466395, 21.734574000000066, 1, 1, '2018-07-15 16:51:43', 14, 0),
(1, 8, 38.25904425622811, 21.75285102709131, 1, 1, '2018-07-15 16:57:02', 2, 0),
(2, 9, 38.25904425622811, 21.75285102709131, 1, 1, '2018-07-15 17:08:05', 4, 0),
(1, 10, 37.9838096, 23.727538800000048, 1, 2, '2018-07-17 12:31:21', 2, 0),
(1, 11, 37.9838096, 23.727538800000048, 1, 2, '2018-07-17 12:32:31', 2, 0),
(1, 12, 37.9838096, 23.727538800000048, 1, 2, '2018-07-17 12:35:01', 2, 0),
(1, 13, 37.93692, 23.944799999999987, 1, 2, '2018-07-17 12:36:12', 2, 0),
(1, 14, 37.9838096, 23.727538800000048, 1, 2, '2018-07-17 12:38:07', 2, 0),
(1, 15, 37.9838096, 23.727538800000048, 1, 2, '2018-07-17 12:38:39', 2, 0),
(1, 16, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 12:38:51', 0, 0),
(1, 17, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 12:40:04', 6.6, 0),
(1, 18, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 12:41:03', 3.3, 0),
(1, 19, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 12:46:40', 3.3, 0),
(1, 20, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 12:50:23', 3.9, 0),
(1, 21, 38.255108, 21.73681499999998, 1, 1, '2018-07-17 12:54:02', 1.1, 0),
(2, 22, 37.9838096, 23.727538800000048, 1, 2, '2018-07-17 13:08:03', 1.1, 0),
(1, 23, 38.255108, 21.73681499999998, 1, 1, '2018-07-17 13:08:49', 1.1, 0),
(1, 24, 38.255108, 21.73681499999998, 1, 1, '2018-07-17 13:11:56', 1.3, 0),
(1, 25, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 13:15:39', 1.1, 0),
(1, 26, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 13:16:27', 1.1, 0),
(1, 27, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 13:16:36', 1.1, 0),
(1, 28, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 13:16:48', 1.1, 0),
(2, 29, 37.9838096, 23.727538800000048, 1, 2, '2018-07-17 13:20:16', 1.1, 0),
(1, 30, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 13:34:50', 1.1, 0),
(1, 31, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 13:35:56', 1.1, 0),
(1, 32, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 13:36:13', 1.1, 0),
(1, 33, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 13:36:31', 1.1, 0),
(1, 34, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 13:36:54', 1.1, 0),
(2, 35, 37.9838096, 23.727538800000048, 1, 2, '2018-07-17 13:43:11', 1.5, 0),
(2, 36, 37.9838096, 23.727538800000048, 1, 2, '2018-07-17 13:44:16', 9, 0),
(2, 37, 37.9838096, 23.727538800000048, 0, 2, '2018-07-17 13:44:28', 1.1, 0),
(2, 38, 37.9838096, 23.727538800000048, 1, 2, '2018-07-17 13:44:56', 1.5, 0),
(2, 39, 37.9838096, 23.727538800000048, 1, 2, '2018-07-17 13:45:41', 1.5, 0),
(1, 40, 38.255108, 21.73681499999998, 1, 1, '2018-07-17 13:46:14', 3, 0),
(1, 41, 38.255108, 21.73681499999998, 1, 1, '2018-07-17 13:46:26', 3, 0),
(1, 42, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 13:46:56', 1.1, 0),
(2, 43, 37.9838096, 23.727538800000048, 1, 2, '2018-07-17 13:47:39', 1.1, 0),
(1, 44, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 13:47:56', 1.1, 0),
(1, 45, 38.2466395, 21.734574000000066, 1, 1, '2018-07-17 13:58:20', 1.5, 0),
(1, 46, 40.46366700000001, -3.7492200000000366, 1, 1, '2018-07-17 14:00:09', 9.8, 0),
(2, 47, 38.25904425622811, 21.74890281542139, 1, 1, '2018-07-18 11:50:51', 8, 0),
(1, 74, 0, 0, 1, 1, '2018-07-18 21:34:13', 0, 0),
(1, 75, 38.2466395, 21.734574000000066, 1, 1, '2018-07-18 23:40:33', 1.1, 0),
(1, 76, 38.237231666077996, 21.772420424063966, 1, 1, '2018-07-18 23:41:24', 1.4, 4818),
(2, 77, 38.47476642897845, 23.139118817902272, 1, 2, '2018-07-18 23:41:48', 4.5, 113857),
(2, 78, 37.0801857, 22.476828699999942, 1, 2, '2018-07-19 11:07:37', 4.5, 214683),
(2, 79, 38.0549562, 23.807655000000068, 1, 2, '2018-07-19 11:08:00', 5.2, 18891),
(1, 80, 38.068508619171915, 21.521594620908218, 1, 1, '2018-07-19 11:09:10', 4.5, 37049),
(1, 81, 37.81742972995964, 21.288119304005477, 1, 1, '2018-07-19 11:48:56', 1.5, 76455),
(2, 82, 38.35586478779748, 23.505413947420266, 1, 2, '2018-07-19 11:49:14', 1.5, 71339),
(1, 83, 38.162027480974565, 21.66671470784354, 1, 1, '2018-07-19 12:15:10', 3, 12858),
(1, 84, 38.250929334601906, 21.7990279374917, 1, 1, '2018-07-19 12:16:23', 3, 20926),
(2, 85, 38.11807754041835, 23.95364651552154, 1, 2, '2018-07-21 11:51:13', 1.5, 48648),
(1, 86, 37.7967917, 21.350758100000007, 0, 1, '2018-07-21 12:02:39', 4.5, 94936),
(1, 87, 38.2586937958584, 21.76933051927881, 0, 1, '2018-09-10 03:48:48', 1.3, 14367),
(2, 88, 38.2466395, 21.734574000000066, 0, 1, '2018-09-10 03:49:27', 2, 0),
(1, 89, 38.21209458940897, 21.855161207755373, 0, 1, '2018-09-13 15:43:59', 108, 29457),
(1, 90, 38.118567386930664, 21.933919940376654, 0, 1, '2018-09-13 15:44:34', 140, 51953),
(2, 91, 38.364374488256104, 23.23806274704657, 0, 2, '2018-09-13 15:45:06', 280, 93330),
(1, 92, 38.242127, 21.736061999999947, 0, 1, '2018-09-13 15:45:42', 1.5, 10863),
(1, 93, 40.6400629, 22.944419100000005, 0, 1, '2018-09-13 15:45:55', 10.1, 475984);

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `ID` int(11) NOT NULL,
  `delivery_guy` int(11) NOT NULL,
  `start_sh` datetime DEFAULT NULL,
  `end_sh` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`ID`, `delivery_guy`, `start_sh`, `end_sh`) VALUES
(8, 1, '2018-07-19 11:05:16', '2018-07-19 11:05:32'),
(9, 2, '2018-07-21 11:50:20', '2018-07-21 11:51:37'),
(10, 2, '2018-09-10 01:56:46', '2018-09-10 01:57:07');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `store_id` int(11) NOT NULL,
  `prod_name_st` varchar(25) NOT NULL,
  `qnt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`store_id`, `prod_name_st`, `qnt`) VALUES
(1, 'bagel', 31),
(1, 'cake', 8),
(1, 'cappuccino', 36),
(1, 'cheese pie', 11),
(1, 'filter coffee', 33),
(1, 'greek coffee', 95),
(1, 'tost', 11),
(1, 'vegetable Pie', -6),
(2, 'bagel', 6),
(2, 'cake', 10),
(2, 'cappuccino', 10),
(2, 'cheese pie', 10),
(2, 'filter coffee', 10),
(2, 'greek coffee', 1),
(2, 'tost', 5),
(2, 'vegetable Pie', -7);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `address` varchar(25) NOT NULL,
  `ID` int(11) NOT NULL,
  `lat` double NOT NULL,
  `lng` double NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`address`, `ID`, `lat`, `lng`, `name`) VALUES
('dieyth 1', 1, 38.24664, 21.734574, 'patra'),
('dieyth 2 ', 2, 37.98381, 23.727539, 'athina');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `atrr` int(5) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pass` varchar(150) NOT NULL,
  `tel` int(25) NOT NULL,
  `username` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`atrr`, `email`, `pass`, `tel`, `username`, `user_id`) VALUES
(0, 'fotis@admin.com', 'fotis', 1234567890, 'fotis', 1),
(2, 'man1@man1.com', 'man1', 1234567891, 'man1', 2),
(2, 'man2@man2.com', 'man2', 1234567892, 'man2', 3),
(3, 'del1@del1.com', 'del1', 1234567893, 'del1', 4),
(3, 'del2@del1.com', 'del2', 1234567894, 'del2', 5),
(1, 'pel1@pel1.com', 'pel1', 1111231231, 'pel1', 6),
(1, 'foti@fo.com', 'fffasd12', 2147483647, 'fffotis', 7),
(1, 'pel2@gmail.com', 'fotisfotis', 2147483647, 'pel2', 8),
(1, 'pel3@pel3.com', 'fotisfoits', 1111231232, 'pel3', 9),
(1, 'foti@fosss.com', 'del1', 2147483647, 'pel11', 10),
(1, 'del1@sd.com', 'del1', 1111231231, 'sssss1', 11),
(1, 'del1@d.com', 'del1', 1111231236, 'pel112', 12),
(1, 'ss@d.com', 'del1', 1111231230, 'wdwda', 13),
(1, 'd123el1@dasds.com', 'del1', 1111231999, 'pel12222', 14),
(1, 'adm223in@bo23ss.com', 'admin', 2147483647, 'pel231311', 15),
(1, 'del12@ew.com', 'del1', 2147483647, 'sssss123123', 16),
(1, 'admi22n@bos22s.com', 'admin', 384736272, 'sssss241', 17),
(1, 'ad2mi22n@bos22s.com', 'asdasd2', 384736272, 'sssss2241', 18),
(1, 'ad223mi22n@b2os22s.com', 'del1', 383736272, 'sssss222341', 19);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_delivery_users` (`user_ID`);

--
-- Indexes for table `manages`
--
ALTER TABLE `manages`
  ADD PRIMARY KEY (`man_id`),
  ADD KEY `fk_manages_stores` (`store_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`prod_name`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_stores_orders` (`store_id`),
  ADD KEY `fk_orders_delivery` (`delivery_guy`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_shifts_delivery` (`delivery_guy`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`store_id`,`prod_name_st`),
  ADD KEY `fk_stock_menu` (`prod_name_st`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `fk_delivery_users` FOREIGN KEY (`user_ID`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manages`
--
ALTER TABLE `manages`
  ADD CONSTRAINT `fk_manages_stores` FOREIGN KEY (`store_id`) REFERENCES `stores` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_manages_users` FOREIGN KEY (`man_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_delivery` FOREIGN KEY (`delivery_guy`) REFERENCES `delivery` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_stores_orders` FOREIGN KEY (`store_id`) REFERENCES `stores` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shifts`
--
ALTER TABLE `shifts`
  ADD CONSTRAINT `fk_shifts_delivery` FOREIGN KEY (`delivery_guy`) REFERENCES `delivery` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_stock_menu` FOREIGN KEY (`prod_name_st`) REFERENCES `menu` (`prod_name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_stock_stores` FOREIGN KEY (`store_id`) REFERENCES `stores` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
