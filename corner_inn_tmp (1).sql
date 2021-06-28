-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2021 at 08:38 PM
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
(10, 'ayoyo soup', '', 8, 1, '2021-06-16 13:09:31'),
(11, 'groundnut soup', '', 8, 1, '2021-06-16 13:10:06'),
(12, 'wele and shito', '', 9, 1, '2021-06-21 15:24:38');

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
(8, 'tuo zaafi', 'food_1623848948.jpg', 1, '2021-06-16 13:09:08'),
(9, 'waakye', 'food_1624288613.jfif', 1, '2021-06-21 15:16:53');

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
(4, NULL, NULL, '50', 4, 3, 2, '2021-06-18 13:49:01'),
(5, NULL, NULL, '16', 3, 2, 3, '2021-06-19 18:13:23'),
(6, NULL, NULL, '5', 2, 9, 2, '2021-06-22 10:51:08'),
(7, NULL, NULL, '5', 3, 2, 2, '2021-06-22 11:08:10'),
(8, NULL, NULL, '5', 3, 2, 2, '2021-06-22 11:08:10'),
(9, NULL, NULL, '5', 3, 2, 2, '2021-06-22 11:08:20'),
(10, NULL, NULL, '5', 3, 2, 2, '2021-06-22 11:08:45'),
(11, NULL, NULL, '5', 3, 2, 2, '2021-06-22 11:10:24'),
(12, NULL, NULL, '5', 4, 3, 2, '2021-06-22 11:11:06'),
(13, NULL, NULL, '5', 2, 9, 2, '2021-06-22 11:14:51'),
(14, NULL, NULL, '5', 3, 2, 2, '2021-06-22 11:17:22'),
(15, NULL, NULL, '5', 3, 2, 2, '2021-06-22 12:44:10'),
(16, NULL, NULL, '5', 3, 2, 2, '2021-06-22 12:46:10'),
(17, NULL, NULL, '5', 3, 2, 2, '2021-06-22 13:04:36'),
(18, NULL, NULL, '5', 3, 2, 2, '2021-06-22 13:06:04'),
(19, NULL, NULL, '5', 3, 2, 2, '2021-06-22 13:16:20'),
(20, NULL, NULL, '5', 3, 2, 2, '2021-06-22 13:23:48'),
(21, NULL, NULL, '6', 3, 2, 2, '2021-06-22 13:25:28'),
(22, NULL, NULL, '6', 3, 2, 2, '2021-06-22 13:27:21'),
(23, NULL, NULL, '6', 3, 2, 2, '2021-06-22 13:44:03'),
(24, NULL, NULL, '6', 3, 2, 2, '2021-06-22 13:44:29'),
(25, 'Joshua', '233546308417', '6', 3, 2, 2, '2021-06-22 13:58:52'),
(26, 'Joshua', '233546308417', '6', 3, 2, 2, '2021-06-22 13:59:37'),
(27, 'Mina', '233596328742', '10', 4, 3, 2, '2021-06-22 14:01:06'),
(28, 'Mina', '233596328742', '10', 4, 3, 2, '2021-06-22 14:02:08'),
(29, 'Mina', '233596328742', '5', 2, 9, 2, '2021-06-22 14:15:19'),
(30, 'Mina', '233596328742', '5', 3, 2, 2, '2021-06-22 14:18:44'),
(31, 'Mark Larbi', '233208310231', '20', 4, 3, 2, '2021-06-22 17:42:12'),
(32, 'Petrina', '0502526102', '6', 2, 9, 2, '2021-06-28 09:59:14'),
(33, 'Nii Odoi', '0502526102', '7', 3, 2, 2, '2021-06-28 14:49:26'),
(34, 'Nii Odoi', '0502526102', '10', 3, 2, 2, '2021-06-28 14:49:42'),
(35, 'Nii', '0502526102', '8', 2, 9, 2, '2021-06-28 14:50:04');

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
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('Male','Female') NOT NULL DEFAULT 'Male',
  `profile_image` text NOT NULL,
  `role` enum('Waiter','Admin') NOT NULL DEFAULT 'Waiter',
  `added_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `password`, `date_of_birth`, `gender`, `profile_image`, `role`, `added_by`, `date_created`) VALUES
(1, 'Mina', 'Dankwah', 'mina_dankwah', '827ccb0eea8a706c4c34a16891f84e7b', '2001-10-10', 'Female', 'user_1624872175.jpg', 'Admin', 0, '2021-06-10 09:43:16'),
(2, 'Akua', 'Anim', 'akua_anim', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'Female', '1623318748.JPG', 'Waiter', 1, '2021-06-10 09:52:28'),
(3, 'Josh', 'Anim', 'josh_anim', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'Male', '', 'Waiter', 1, '2021-06-15 16:08:59'),
(4, 'alex', 'Dan', 'alex_ty', '827ccb0eea8a706c4c34a16891f84e7b', NULL, 'Male', '', 'Waiter', 1, '2021-06-21 15:26:12');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `food_payment`
--
ALTER TABLE `food_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
