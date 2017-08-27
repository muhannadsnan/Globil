-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2017 at 11:45 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `globil`
--

-- --------------------------------------------------------

--
-- Table structure for table `wish-list`
--

CREATE TABLE `wish-list` (
  `id` int(10) UNSIGNED NOT NULL,
  `car_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wish-list`
--

INSERT INTO `wish-list` (`id`, `car_id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 5, 1, '2017-08-09 17:05:34', '2017-08-09 17:05:34'),
(11, 37, 8, '2017-08-19 07:25:55', '2017-08-19 07:25:55'),
(12, 10, 8, '2017-08-19 12:45:47', '2017-08-19 12:45:47'),
(13, 8, 8, '2017-08-19 13:41:12', '2017-08-19 13:41:12'),
(14, 37, 1, '2017-08-27 07:34:30', '2017-08-27 07:34:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wish-list`
--
ALTER TABLE `wish-list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wish_list_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wish-list`
--
ALTER TABLE `wish-list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `wish-list`
--
ALTER TABLE `wish-list`
  ADD CONSTRAINT `wish_list_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
