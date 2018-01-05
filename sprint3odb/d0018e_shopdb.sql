-- phpMyAdmin SQL Dump
-- version 4.7.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 05, 2018 at 08:57 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `d0018e_shopdb`
--
CREATE DATABASE IF NOT EXISTS `d0018e_shopdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci;
USE `d0018e_shopdb`;

-- --------------------------------------------------------

--
-- Table structure for table `basket_tmp`
--

CREATE TABLE `basket_tmp` (
  `basket_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(45) COLLATE utf8mb4_swedish_ci NOT NULL,
  `basket_product_price` float NOT NULL,
  `product_amount` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `basket_tmp`
--

INSERT INTO `basket_tmp` (`basket_id`, `user_id`, `product_id`, `product_name`, `basket_product_price`, `product_amount`) VALUES
(35, 5, 1, 'produktnamn', 15, 14),
(36, 5, 2, 'produktnamn', 30, 2),
(37, 5, 3, 'produktnamn', 12, 2),
(38, 5, 5, 'produktnamn', 10, 2),
(41, 3, 2, 'produktnamn', 190, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_reply` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nej',
  `user_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment_date` datetime NOT NULL,
  `comment_reply_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_reply_date` datetime DEFAULT NULL,
  `comment_reply_from` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `product_id`, `user_id`, `comment_text`, `comment_reply`, `user_name`, `comment_date`, `comment_reply_text`, `comment_reply_date`, `comment_reply_from`) VALUES
(1, 1, 3, 'detta är en test kommentar med åäö', 'ja', 'test', '2017-12-13 08:12:36', 'hej', '2017-12-13 09:13:48', 'admin'),
(2, 1, 3, 'this is another test comment :D', 'ja', 'test', '2017-12-13 08:12:36', ':)', '2018-01-05 16:55:31', 'admin'),
(3, 2, 3, 'test komentar för prod 2', 'ja', 'test', '0000-00-00 00:00:00', 'jaha', '2017-12-13 18:05:24', 'admin'),
(4, 1, 3, 'haxxor', 'ja', 'bosses bilar och plåt', '2017-12-13 08:12:36', 'wooo  vilken haxxor _D', '2017-12-13 09:31:45', 'admin'),
(5, 3, 6, 'Väldigt bra produkt! ', 'ja', 'Alabaster', '2017-12-13 09:25:42', 'kul', '2017-12-13 18:07:27', 'admin'),
(6, 3, 6, 'Jag ångrade mig. Produkten var fantastiskt bra!', 'ja', 'Alabaster', '2017-12-13 09:26:25', 'fan bäst för dig de', '2017-12-13 18:08:46', 'admin'),
(7, 1, 3, 'testar att kommentera igen', 'ja', 'testaar', '2017-12-13 17:55:43', 'pk', '2018-01-05 16:12:49', 'admin'),
(8, 1, 6, 'Hamburgare är goda och enkla att tillaga. Detta är dock inte relaterat till era fantastiska produkter. ', 'ja', 'Alabaster', '2017-12-13 21:03:50', 'ok', '2018-01-05 18:18:02', 'admin'),
(9, 1, 3, 'bananer i pjyamas', 'nej', 'test', '2017-12-14 11:32:44', NULL, NULL, NULL),
(10, 1, 3, 'dom får inte vara gula', 'nej', 'hej  jag heter egon och jag gillar blåa banan', '2017-12-14 11:33:19', NULL, NULL, NULL),
(11, 2, 12, 'hej denna va bra', 'ja', 'bosse', '2017-12-14 15:22:50', 'kul för dej', '2017-12-14 15:23:29', 'admin'),
(12, 2, 12, 'sda', 'nej', 'bosse bil och plåt', '2017-12-14 15:23:49', NULL, NULL, NULL),
(13, 1, 3, 'a', 'nej', 'test', '2018-01-05 15:35:36', NULL, NULL, NULL),
(14, 1, 1, 'admin vanlig kommentar', 'ja', 'admin', '2018-01-05 16:55:04', 'svar på admin vanlig kommentar', '2018-01-05 16:55:18', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `is_liked` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'nej'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`user_id`, `product_id`, `is_liked`) VALUES
(1, 1, 'ja'),
(3, 1, 'ja'),
(3, 2, 'ja'),
(3, 3, 'ja'),
(3, 5, 'ja'),
(5, 1, 'ja'),
(5, 2, 'ja'),
(5, 3, 'ja'),
(5, 5, 'ja'),
(6, 3, 'ja'),
(12, 2, 'ja');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `order_date` datetime NOT NULL,
  `order_sent` varchar(45) COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT 'nej',
  `order_date_sent` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `order_sent`, `order_date_sent`) VALUES
(1, 3, '2017-11-29 00:00:00', 'ja', NULL),
(2, 3, '2017-11-29 00:00:00', 'ja', NULL),
(3, 3, '2017-11-29 00:00:00', 'ja', NULL),
(5, 3, '2017-11-29 00:00:00', 'ja', NULL),
(14, 3, '2017-11-29 00:00:00', 'ja', '2017-12-13 11:08:49'),
(22, 3, '2017-11-29 00:00:00', 'ja', '2017-12-13 08:14:26'),
(40, 5, '2017-12-13 14:06:09', 'ja', '2017-12-13 14:12:47'),
(42, 3, '2017-12-13 14:07:16', 'ja', '2017-12-13 14:12:49'),
(43, 3, '2017-12-13 14:07:23', 'ja', '2017-12-13 14:12:47'),
(53, 3, '2017-12-13 18:51:17', 'ja', '2017-12-13 19:31:07'),
(60, 6, '2017-12-13 19:29:22', 'ja', '2017-12-13 19:29:28'),
(62, 6, '2017-12-13 19:44:26', 'ja', '2017-12-13 19:45:58'),
(63, 11, '2017-12-14 14:40:29', 'nej', NULL),
(64, 11, '2017-12-14 14:41:08', 'ja', '2017-12-14 14:41:21'),
(65, 11, '2017-12-14 14:43:11', 'nej', NULL),
(66, 11, '2017-12-14 14:44:38', 'nej', NULL),
(69, 12, '2017-12-14 15:20:47', 'ja', '2017-12-14 15:22:28'),
(70, 12, '2017-12-14 15:30:58', 'nej', NULL),
(71, 12, '2017-12-14 15:31:32', 'nej', NULL),
(72, 3, '2018-01-05 15:01:30', 'nej', NULL),
(73, 3, '2018-01-05 15:02:48', 'nej', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_details`
--

CREATE TABLE `orders_details` (
  `order_detail_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `details_product_price` int(10) UNSIGNED NOT NULL,
  `order_amount` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Dumping data for table `orders_details`
--

INSERT INTO `orders_details` (`order_detail_id`, `product_id`, `order_id`, `details_product_price`, `order_amount`) VALUES
(1, 1, 1, 15, 1),
(2, 2, 1, 30, 1),
(3, 3, 1, 122, 1),
(4, 1, 2, 15, 10),
(5, 2, 2, 30, 100),
(6, 3, 2, 122, 1000),
(7, 1, 3, 15, 10),
(8, 2, 3, 30, 100),
(9, 3, 3, 122, 1000),
(13, 1, 5, 15, 1),
(27, 1, 14, 15, 1),
(28, 2, 14, 30, 1),
(29, 3, 14, 122, 1),
(43, 3, 22, 122, 1),
(82, 1, 40, 15, 1),
(83, 2, 40, 30, 1),
(84, 3, 40, 12, 1),
(85, 5, 40, 10, 1),
(90, 5, 42, 1, 1),
(91, 3, 42, 120, 2),
(92, 2, 42, 300, 3),
(93, 1, 42, 150, 4),
(94, 5, 43, 1, 1),
(95, 3, 43, 120, 2),
(96, 2, 43, 300, 3),
(97, 1, 43, 150, 4),
(123, 1, 53, 147, 10),
(124, 2, 53, 20, 15),
(125, 3, 53, 12, 1),
(126, 5, 53, 15, 1),
(128, 1, 60, 147, 1),
(129, 3, 60, 13, 3),
(130, 2, 60, 20, 1),
(134, 2, 62, 20, 2),
(135, 3, 62, 13, 2),
(136, 1, 63, 147, 10),
(137, 2, 63, 20, 5),
(138, 3, 63, 13, 15),
(139, 2, 64, 20, 2),
(140, 1, 64, 147, 1),
(141, 3, 64, 13, 3),
(142, 1, 65, 145, 1),
(143, 1, 66, 135, 1),
(146, 2, 69, 20, 110),
(147, 3, 69, 13, 1),
(148, 1, 70, 135, 12),
(149, 1, 71, 135, 2),
(150, 1, 72, 140, 1),
(151, 1, 73, 140, 1976);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_stock` int(10) UNSIGNED NOT NULL,
  `product_price` float NOT NULL,
  `product_live` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ja',
  `product_desc` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_info`, `product_stock`, `product_price`, `product_live`, `product_desc`) VALUES
(1, '2 tum 4 3 meter G', 'Gran 45x95x3000mm hyvlad', 1, 140, 'ja', 'hyvlad gran'),
(2, '2 tum 4 3 meter T', 'Tall 45x95x3000mm hyvlad', 3551, 195, 'ja', 'hyvlad tall'),
(3, '2 tum 4 3 meter TG', 'Gran 45x95x3000mm Tryckimpregnerad', 325227, 13, 'ja', 'Tryckimpregnerad gran'),
(5, 'test1', 'testar igen', 1678678, 150, 'nej', 'testar igen');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_address`, `user_email`, `is_admin`) VALUES
(1, 'admin', '$2y$10$y45p9prYAXqDXhMbnUb6I.jhJf75c1EikAJIe7Dv7jUSYnEQBOzhu', 'adminvägen 11', 'admin@admin.admi', b'1'),
(3, 'test', '$2y$10$JugDtUW1kv5Po/HbSKKI8uvSeoAUZ5pe7r8w4MVsyww1iGAkagx2.', 'testvägen 110', 'test@test.test', b'0'),
(4, 'egon', '$2y$10$T6eQumsOXNgxXA7TgSzpleHZdxiHhgEjJMG5D6DQgJFq9GLpen3gm', 'egonvägen110', 'egon@egon.se', b'0'),
(5, 'test2', '$2y$10$39v8eheLwqntu3rCqGLQNOd1LxgoQBODaMSjh41GP1/3ZV.s9K4Sq', 'test2vägen110', 'test2@test2.test2', b'0'),
(6, 'Alabaster', '$2y$10$pgYeudKFzhLjWu8.SF48oOoKqSkQZpJ0.c3zzv7oN4dwu0cOaUCL2', 'Sveavägen 8 74533', 'Ala.bastermin@yahoo.nu', b'0'),
(8, 'probe1', '$2y$10$Ee9OOwzxcZGpSg2VTcMWOeHqpEtBA7bsoNqnlGKVIOlNTDAnlwH4i', 'Sveavägen 8 74533', 'Ala.bastermin@yahoo.nu', b'0'),
(9, 'test3', '$2y$10$iwBhgRiPxbFArlTgWueXQOkPz0mlZfCd7XP.PVleUvT.AyOL90o1y', 'test3', 'test3', b'0'),
(11, 'b', '$2y$10$kBVsGdBk9Bte8C6zjXGp0e.51.A/J7T/vWC0CvHNhvWdoNyubk816', 'bb', 'bbb', b'0'),
(12, 'bosse', '$2y$10$6zFao5157SojsYNK5cKWKeXMoBEDqNJQgux9EHu8M5jBL7YtbIOnm', 'bosse', 'bosse', b'0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basket_tmp`
--
ALTER TABLE `basket_tmp`
  ADD PRIMARY KEY (`basket_id`),
  ADD KEY `fk_basket_tmp_user_id_idx` (`user_id`),
  ADD KEY `fk_basket_tmp_product_id_idx` (`product_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_comments_product_id_idx` (`product_id`),
  ADD KEY `fk_comments_user_id_idx` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `fk_likes_product_id_idx` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_orders_user_idx` (`user_id`);

--
-- Indexes for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `fk_orders_details_order_idx` (`order_id`),
  ADD KEY `fk_orders_details_prod_idx` (`product_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basket_tmp`
--
ALTER TABLE `basket_tmp`
  MODIFY `basket_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `orders_details`
--
ALTER TABLE `orders_details`
  MODIFY `order_detail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basket_tmp`
--
ALTER TABLE `basket_tmp`
  ADD CONSTRAINT `fk_basket_tmp_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_basket_tmp_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `fk_likes_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_likes_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `orders_details`
--
ALTER TABLE `orders_details`
  ADD CONSTRAINT `fk_orders_details_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_orders_details_prod` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
--
-- Database: `d0018e_testdb`
--
CREATE DATABASE IF NOT EXISTS `d0018e_testdb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `d0018e_testdb`;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_info` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `user_name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_password`, `user_info`, `user_name`) VALUES
(3, '$2y$10$Q1FVwkvxhHfZqgIg1btfV.Kqvw9euQnxCp8DXskh4VSyUO4xZJIR6', 'hej detta e test', 'test'),
(4, '$2y$10$FwoQjuY7GYFR7v4XiPj1GOe3obNS4xid94/DmF80puf9cyYsuMh92', 'gron', 'apple'),
(5, '$2y$10$ERt6EtHus7S/I2tb/jMb6un7YE84TeykbV9/xsc5Kvq9NrkfLU34W', 'är gula', 'banan'),
(6, '$2y$10$8wWCYEjFfCp/BvFCvFFVwO9Zu6ZB1bse2hOnc5hj6Q4o2y.MTBCFK', '1234', 'hej'),
(7, '$2y$10$wv.1Ay/iAO0Y6JjAnN05bOaUzVH.jzqfsRZQCGBPxv4KHl7/LdUyS', 'administratör', 'admin'),
(8, '$2y$10$9RsEuOQ5tdcWxNjMO98wKu2K02XJleiVhq21QqsvLKB06/zPxgWtS', 'yngve e 49 år', 'yngve'),
(9, '$2y$10$M5tF5DUpOMyT3SyNZtgOlupYSv6N.jEn2WC7gMs8omK5XdGuqy5zC', 'hej på dej', 'egon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
