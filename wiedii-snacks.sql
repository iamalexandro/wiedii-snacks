-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 26, 2019 at 09:44 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wiedii-snacks`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(5) NOT NULL,
  `id_product` int(3) NOT NULL,
  `code` varchar(255) NOT NULL,
  `id_user` int(3) NOT NULL,
  `amount` int(3) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `name`, `price`, `id_product`, `code`, `id_user`, `amount`) VALUES
(442, 'gomitas', 800, 4, '2', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(5) NOT NULL,
  `code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `code`) VALUES
(1, 'cocosette', 1000, '1'),
(4, 'gomitas', 200, '2'),
(8, 'pepsi', 2000, '3'),
(9, 'oreo', 600, '4'),
(11, 'jet', 500, '5'),
(12, 'mani', 1000, '6');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `id_user` int(3) NOT NULL,
  `id_product` int(3) NOT NULL,
  `cost` int(11) NOT NULL,
  `date1` datetime DEFAULT NULL,
  `paid` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `id_user`, `id_product`, `cost`, `date1`, `paid`) VALUES
(429, 1, 4, 200, '2019-11-26 07:26:13', 1),
(430, 1, 4, 200, '2019-11-26 07:29:04', 1),
(431, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(432, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(433, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(434, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(435, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(436, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(437, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(438, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(439, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(440, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(441, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(442, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(443, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(444, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(445, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(446, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(447, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(448, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(449, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(450, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(451, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(452, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(453, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(454, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(455, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(456, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(457, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(458, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(459, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(460, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(461, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(462, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(463, 1, 1, 1000, '2019-11-26 08:14:03', 1),
(464, 1, 4, 200, '2019-11-26 10:31:35', 1),
(465, 1, 4, 200, '2019-11-26 10:31:35', 1),
(466, 1, 1, 1000, '2019-11-26 10:31:35', 1),
(467, 1, 1, 1000, '2019-11-26 10:31:35', 1),
(468, 1, 1, 1000, '2019-11-26 12:04:45', 0),
(469, 1, 9, 600, '2019-11-26 12:04:45', 0),
(470, 1, 4, 200, '2019-11-26 12:04:45', 0),
(471, 1, 9, 600, '2019-11-26 12:04:45', 0),
(472, 1, 8, 2000, '2019-11-26 12:25:36', 0),
(473, 1, 9, 600, '2019-11-26 12:25:36', 0),
(474, 1, 1, 3000, '2019-11-26 14:56:33', 0),
(475, 1, 1, 1000, '2019-11-26 14:58:15', 0),
(476, 1, 11, 500, '2019-11-26 14:58:15', 0),
(477, 1, 4, 600, '2019-11-26 15:02:12', 0),
(478, 1, 1, 2000, '2019-11-26 15:02:12', 0),
(479, 1, 8, 2000, '2019-11-26 15:02:12', 0),
(480, 1, 4, 600, '2019-11-26 15:07:57', 0),
(481, 1, 8, 6000, '2019-11-26 15:07:57', 0),
(482, 1, 1, 2000, '2019-11-26 15:07:57', 0),
(483, 1, 4, 600, '2019-11-26 15:15:02', 0),
(484, 1, 1, 4000, '2019-11-26 15:15:02', 0),
(485, 1, 8, 4000, '2019-11-26 15:15:02', 0),
(486, 1, 1, 2000, '2019-11-26 15:17:40', 0),
(487, 1, 9, 1200, '2019-11-26 15:17:40', 0),
(488, 1, 4, 600, '2019-11-26 15:17:40', 0),
(489, 1, 12, 4000, '2019-11-26 15:17:40', 0),
(490, 1, 4, 600, '2019-11-26 15:22:53', 0),
(491, 1, 1, 1000, '2019-11-26 15:22:53', 0),
(492, 1, 9, 1200, '2019-11-26 15:22:53', 0),
(493, 1, 4, 600, '2019-11-26 15:25:57', 0),
(494, 1, 11, 1000, '2019-11-26 15:25:57', 0),
(495, 1, 4, 400, '2019-11-26 15:27:06', 0),
(496, 1, 12, 2000, '2019-11-26 15:27:06', 0),
(497, 1, 1, 1000, '2019-11-26 15:27:06', 0),
(498, 1, 4, 400, '2019-11-26 15:31:04', 0),
(499, 1, 1, 1000, '2019-11-26 15:31:04', 0),
(500, 1, 1, 1000, '2019-11-26 15:31:04', 0),
(501, 1, 1, 2000, '2019-11-26 15:32:34', 0),
(502, 1, 4, 400, '2019-11-26 15:32:34', 0),
(503, 1, 8, 6000, '2019-11-26 15:32:34', 0),
(504, 1, 4, 800, '2019-11-26 16:01:30', 0),
(505, 1, 1, 3000, '2019-11-26 16:01:30', 0),
(506, 1, 11, 1000, '2019-11-26 16:01:30', 0),
(507, 1, 4, 800, '2019-11-26 16:19:31', 0),
(508, 1, 1, 3000, '2019-11-26 16:19:31', 0),
(509, 1, 11, 1000, '2019-11-26 16:19:31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `finger` varchar(200) DEFAULT NULL,
  `password` varchar(25) DEFAULT NULL,
  `debt` int(6) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `document`, `email`, `finger`, `password`, `debt`) VALUES
(1, 'nicola di candia', '1127058284', 'nicola.dicandia@wiedii.co', NULL, 'admin1', 67300),
(2, 'Monica Gallo  ', '119812738123', 'monicandreagf@gmail.com', NULL, NULL, 0),
(3, 'Elena Jaimes', '1127659284', 'elenajaimes@gmail.com', NULL, NULL, 0),
(11, 'Brayam Mora', '12087276536', 'brayam.mora@wiedii.co', NULL, NULL, 0),
(14, 'David vera contreras', '19283746', 'david.luis@gmail.com', NULL, NULL, 0),
(18, 'nestor moya ', '28371872361', 'nestor.moya@wiedii.co', NULL, NULL, 0),
(19, 'Andres Carrillo', '327486237846', 'andregay@gmail.com', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_purchase_user` (`id_user`),
  ADD KEY `fk_purchase_product` (`id_product`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=443;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=510;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `fk_purchase_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_purchase_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
