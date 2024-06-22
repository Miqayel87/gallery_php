-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 22, 2024 at 07:11 PM
-- Server version: 8.2.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=233 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`, `created_at`) VALUES
(213, '171908186966771b8dd9b62-free-images.jpg', '2024-06-22 18:44:29'),
(214, '171908186966771b8dd9b62-free-images.jpg', '2024-06-22 18:44:29'),
(215, '171908200866771c18ec585-7ea8a318d5e4441089e95d1241f82d38.webp', '2024-06-22 18:46:48'),
(216, '171908200866771c18ec585-7ea8a318d5e4441089e95d1241f82d38.webp', '2024-06-22 18:46:48'),
(217, '171908204066771c38a9e81-Mbappe_UEFA_5e57847bb6.webp', '2024-06-22 18:47:20'),
(218, '171908204066771c38a9e81-Mbappe_UEFA_5e57847bb6.webp', '2024-06-22 18:47:20'),
(219, '171908211566771c8343dc5-gratisography-cyber-kitty-800x525.jpg', '2024-06-22 18:48:35'),
(220, '171908211566771c8343dc5-gratisography-cyber-kitty-800x525.jpg', '2024-06-22 18:48:35'),
(221, '171908214366771c9f0528a-360_F_55365335_ee3l7sVif1jKItoXzthbdAPw7KcjeJT9.jpg', '2024-06-22 18:49:03'),
(222, '171908214366771c9f0528a-360_F_55365335_ee3l7sVif1jKItoXzthbdAPw7KcjeJT9.jpg', '2024-06-22 18:49:03'),
(223, '171908220766771cdfded83-small+white+fluffy+dog+smiling+at+the+camera+in+close-up-min.jpg', '2024-06-22 18:50:07'),
(224, '171908220766771cdfded83-small+white+fluffy+dog+smiling+at+the+camera+in+close-up-min.jpg', '2024-06-22 18:50:07'),
(225, '171908231566771d4b0b208-MV5BMTQ3ZGIzNjMtYWJhMC00MDRhLTgyYWItMjBjNzM0MTIzM2JlXkEyXkFqcGdeQWRvb2xpbmhk._V1_.jpg', '2024-06-22 18:51:55'),
(226, '171908231566771d4b0b208-MV5BMTQ3ZGIzNjMtYWJhMC00MDRhLTgyYWItMjBjNzM0MTIzM2JlXkEyXkFqcGdeQWRvb2xpbmhk._V1_.jpg', '2024-06-22 18:51:55'),
(227, '171908239966771d9f95951-wallpapersden.com_abstract-wave-grey-duotone_2560x1435.jpg', '2024-06-22 18:53:19'),
(228, '171908239966771d9f95951-wallpapersden.com_abstract-wave-grey-duotone_2560x1435.jpg', '2024-06-22 18:53:19'),
(229, '171908245366771dd59b0a1-wp5901315.jpg', '2024-06-22 18:54:13'),
(230, '171908245366771dd59b0a1-wp5901315.jpg', '2024-06-22 18:54:13'),
(231, '171908249766771e0174971-360_F_55365335_ee3l7sVif1jKItoXzthbdAPw7KcjeJT9.jpg', '2024-06-22 18:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `user_id`, `post_id`, `created_at`) VALUES
(187, 20, 65, '2024-06-22 18:53:37'),
(188, 20, 67, '2024-06-22 18:53:39'),
(191, 18, 69, '2024-06-22 18:55:23'),
(192, 18, 68, '2024-06-22 18:55:26'),
(193, 18, 67, '2024-06-22 18:55:27'),
(194, 18, 65, '2024-06-22 18:55:28'),
(195, 18, 71, '2024-06-22 18:55:32');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `image_id` bigint UNSIGNED NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`),
  KEY `posts_ibfk_2` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `user_id`, `image_id`, `created_at`) VALUES
(64, 'Photo', 18, 214, '2024-06-22 18:44:29'),
(65, 'Spain FC', 18, 216, '2024-06-22 18:46:49'),
(66, 'Mbappe', 18, 218, '2024-06-22 18:47:20'),
(67, 'Cat', 19, 220, '2024-06-22 18:48:35'),
(68, 'Bear', 19, 222, '2024-06-22 18:49:03'),
(69, 'Dog', 19, 224, '2024-06-22 18:50:07'),
(70, 'Tom and Jerry', 20, 226, '2024-06-22 18:51:55'),
(71, 'Abstraction', 20, 228, '2024-06-22 18:53:19'),
(72, 'Mountains', 20, 230, '2024-06-22 18:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `image_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `date_of_birth`, `password`, `image_id`, `created_at`) VALUES
(18, 'Mikayel', '2002-05-08', '$2y$10$nkzK88m9GDYFYnRozHJPCusMupINSl58LZotg6aO72E73EZ8JM3W6', NULL, '2024-06-22 18:40:23'),
(19, 'Kristine', '2001-03-26', '$2y$10$DcPWkbH8Wa/fa3BuPg1bbeMtIS6e5/Kybc0CUyo6.0jrIL5UAtzHi', NULL, '2024-06-22 18:41:47'),
(20, 'Tom', '2004-09-07', '$2y$10$Q4YPdGRrwA0xpZR2wpvd9O1HvTzCAa4AMhaaBt.H2aag6SDll91bO', NULL, '2024-06-22 18:43:08');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
