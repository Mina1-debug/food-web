-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2021 at 04:16 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `corner_inn_tmp`
--

-- --------------------------------------------------------

--
-- Table structure for table `accompaniment`
--

CREATE TABLE `accompaniment` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `food_item` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accompaniment`
--

INSERT INTO `accompaniment` (`id`, `name`, `image`, `food_item`, `added_by`, `date_created`) VALUES
(2, 'Lightsoup with meat', 'accompaniment_1623348675.jpg', 3, 1, '2021-06-10 18:11:15'),
(3, 'Gizzard', 'accompaniment_', 4, 1, '2021-06-13 12:53:49'),
(6, 'Chicken', '', 6, 1, '2021-06-14 15:32:17'),
(8, 'Pepper and Tilapia', '', 6, 1, '2021-06-15 11:23:56'),
(9, 'Pepper and Tilapia', '', 2, 1, '2021-06-15 11:33:10'),
(10, 'ayoyo soup', '', 8, 1, '2021-06-16 13:09:31'),
(11, 'groundnut soup', '', 8, 1, '2021-06-16 13:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `image`, `added_by`, `date_created`) VALUES
(2, 'Banku', 'food_1623347504.jpg', 1, '2021-06-10 17:51:44'),
(3, 'Fufu', 'food_1623348631.jpg', 1, '2021-06-10 18:10:31'),
(4, 'Kelewele', 'food_1623588731.jpg', 1, '2021-06-13 12:52:11'),
(6, 'Jollof rice', 'food_1623684698.jfif', 1, '2021-06-14 15:31:38'),
(7, 'Rice', 'food_1623756353.jpg', 1, '2021-06-15 11:25:53'),
(8, 'tuo zaafi', 'food_1623848948.jpg', 1, '2021-06-16 13:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `food_payment`
--

CREATE TABLE `food_payment` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `amount` decimal(10,0) NOT NULL,
  `food_id` int(11) NOT NULL,
  `accompaniment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_payment`
--

INSERT INTO `food_payment` (`id`, `name`, `contact`, `amount`, `food_id`, `accompaniment_id`, `user_id`, `date_created`) VALUES
(1, NULL, NULL, '10', 3, 2, 2, '2021-06-10 18:11:45'),
(2, NULL, NULL, '10', 2, 1, 2, '2021-06-15 18:25:51'),
(3, NULL, NULL, '10', 2, 1, 2, '2021-06-15 10:52:57'),
(4, NULL, NULL, '50', 4, 3, 2, '2021-06-18 13:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(32) NOT NULL,
  `profile_image` text NOT NULL,
  `role` enum('Waiter','Admin') NOT NULL DEFAULT 'Waiter',
  `added_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `profile_image`, `role`, `added_by`, `date_created`) VALUES
(1, 'Mina', 'Dankwah', 'mina_dankwah', '827ccb0eea8a706c4c34a16891f84e7b', '', 'Admin', 0, '2021-06-10 09:43:16'),
(2, 'Akua', 'Anim', 'akua_anim', '827ccb0eea8a706c4c34a16891f84e7b', '1623318748.JPG', 'Waiter', 1, '2021-06-10 09:52:28'),
(3, 'Josh', 'Anim', 'josh_anim', '827ccb0eea8a706c4c34a16891f84e7b', '', 'Waiter', 1, '2021-06-15 16:08:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accompaniment`
--
ALTER TABLE `accompaniment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_payment`
--
ALTER TABLE `food_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accompaniment`
--
ALTER TABLE `accompaniment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `food_payment`
--
ALTER TABLE `food_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
