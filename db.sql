-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 12, 2019 at 09:56 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `prueba`
--
CREATE DATABASE IF NOT EXISTS `prueba` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `prueba`;

-- --------------------------------------------------------

--
-- Table structure for table `colores`
--

CREATE TABLE `colores` (
  `id` int(11) NOT NULL,
  `color` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `colores`
--

INSERT INTO `colores` (`id`, `color`, `descripcion`) VALUES
(1, 'primary', 'Este color es azul'),
(2, 'danger', 'este es color rojo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colores`
--
ALTER TABLE `colores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `colores`
--
ALTER TABLE `colores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Database: `wiedii-snacks`
--
CREATE DATABASE IF NOT EXISTS `wiedii-snacks` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `wiedii-snacks`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `document`, `email`) VALUES
(1, 'franco', '12345', 'franco@gmail.com'),
(2, 'Monica Gallo', '1127343346', 'monicandreagf@gmail.com'),
(3, 'Elena Jaimes', '1127659284', 'elenajaimes@gmail.com'),
(10, 'Andres', '123456789', 'andresgay@gmail.com'),
(11, 'Brayam Mora', '12087276536', 'brayam.mora@wiedii.co'),
(12, 'Luis David', '1572398467', 'holamundo@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
