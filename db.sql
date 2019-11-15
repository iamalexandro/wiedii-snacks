-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 15, 2019 at 09:39 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `wiedii-snacks`
--

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
(1, 'cocosette', 3, '1'),
(4, 'gomitas', 200, '2'),
(7, 'chocolate jet', 600, '3'),
(8, 'pepsi', 3000, '4');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(11) NOT NULL,
  `id_user` int(3) NOT NULL,
  `id_product` int(3) NOT NULL,
  `cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `id_user`, `id_product`, `cost`) VALUES
(1, 1, 1, 3),
(2, 1, 1, 3),
(3, 1, 1, 3),
(4, 1, 4, 200),
(5, 1, 4, 200),
(6, 1, 4, 200),
(7, 1, 4, 200),
(8, 1, 4, 200),
(9, 1, 4, 200),
(10, 1, 4, 200),
(11, 1, 4, 200),
(12, 1, 4, 200),
(13, 1, 4, 200),
(14, 1, 4, 200),
(15, 1, 4, 200);

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
  `debt` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `document`, `email`, `finger`, `password`, `debt`) VALUES
(1, 'nicola di candia', '123', 'nicola@gmail.com', '', 'admin1', NULL),
(2, 'Monica Gallo  ', '119812738123', 'monicandreagf@gmail.com', '', NULL, NULL),
(3, 'Elena Jaimes', '1127659284', 'elenajaimes@gmail.com', '', NULL, NULL),
(11, 'Brayam Mora', '12087276536', 'brayam.mora@wiedii.co', '', NULL, NULL),
(14, 'David vera contreras', '19283746', 'david.luis@gmail.com', '', NULL, NULL),
(18, 'nestor moya ', '28371872361', 'nestor.moya@wiedii.co', NULL, NULL, NULL),
(19, 'Andres Carrillo', '327486237846', 'andrescarrilo@gmail.com', NULL, NULL, NULL),
(21, 'duban', '34234234', 'duban@gmail.com', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `fk_purchase_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `fk_purchase_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);