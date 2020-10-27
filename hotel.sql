-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 16 Οκτ 2020 στις 13:37:32
-- Έκδοση διακομιστή: 10.4.13-MariaDB
-- Έκδοση PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `hotel`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `total_price` int(10) UNSIGNED NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `booking`
--

INSERT INTO `booking` (`booking_id`, `user_id`, `room_id`, `check_in_date`, `check_out_date`, `total_price`, `created_time`, `updated_time`) VALUES
(5, 9, 5, '2020-08-22', '2020-08-28', 2400, '2020-08-25 14:10:40', '2020-08-25 14:10:40'),
(6, 9, 2, '2020-08-21', '2020-08-22', 500, '2020-08-25 14:12:23', '2020-08-25 14:12:23'),
(7, 9, 8, '2020-08-27', '2020-08-31', 1120, '2020-08-25 20:06:02', '2020-08-25 20:06:02'),
(8, 9, 4, '2020-08-29', '2020-08-31', 500, '2020-08-28 10:52:54', '2020-08-28 10:52:54'),
(9, 10, 4, '2020-09-02', '2020-09-11', 2250, '2020-08-28 12:15:49', '2020-08-28 12:15:49'),
(10, 10, 8, '2020-09-10', '2020-09-29', 5320, '2020-08-28 12:48:21', '2020-08-28 12:48:21'),
(11, 10, 1, '2020-10-01', '2020-10-03', 700, '2020-08-28 13:06:06', '2020-08-28 13:06:06'),
(12, 11, 4, '2020-09-24', '2020-09-26', 500, '2020-08-28 13:30:32', '2020-08-28 13:30:32'),
(13, 11, 1, '2020-10-27', '2020-10-31', 1400, '2020-08-28 13:33:11', '2020-08-28 13:33:11'),
(14, 11, 6, '2020-08-22', '2020-08-29', 2240, '2020-08-28 13:54:30', '2020-08-28 13:54:30'),
(15, 11, 1, '2020-08-22', '2020-08-25', 1050, '2020-08-28 23:30:54', '2020-08-28 23:30:54'),
(16, 11, 9, '2020-12-30', '2020-12-31', 300, '2020-08-28 23:32:43', '2020-08-28 23:32:43'),
(17, 11, 4, '2020-09-16', '2020-09-18', 500, '2020-08-29 11:48:06', '2020-08-29 11:48:06'),
(18, 12, 1, '2020-09-17', '2020-09-22', 1750, '2020-08-29 16:50:37', '2020-08-29 16:50:37'),
(19, 13, 2, '2020-10-18', '2020-10-19', 500, '2020-08-31 11:54:59', '2020-08-31 11:54:59'),
(20, 13, 10, '2020-09-24', '2020-09-28', 1640, '2020-08-31 11:55:26', '2020-08-31 11:55:26');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `favorite`
--

CREATE TABLE `favorite` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `favorite`
--

INSERT INTO `favorite` (`user_id`, `room_id`, `created_time`, `updated_time`) VALUES
(9, 2, '2020-08-26 15:24:49', '2020-08-26 15:24:49'),
(9, 4, '2020-08-26 13:08:25', '2020-08-26 13:08:25'),
(9, 8, '2020-08-23 12:51:37', '2020-08-23 12:51:37'),
(10, 3, '2020-08-28 12:33:43', '2020-08-28 12:33:43'),
(11, 1, '2020-08-28 13:33:04', '2020-08-28 13:33:04'),
(11, 3, '2020-08-29 11:42:40', '2020-08-29 11:42:40'),
(11, 4, '2020-08-28 13:30:35', '2020-08-28 13:30:35'),
(11, 9, '2020-08-28 23:32:11', '2020-08-28 23:32:11'),
(12, 2, '2020-08-29 17:02:23', '2020-08-29 17:02:23'),
(12, 3, '2020-08-31 10:38:03', '2020-08-31 10:38:03'),
(13, 2, '2020-08-31 11:55:11', '2020-08-31 11:55:11');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `amount` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `review`
--

CREATE TABLE `review` (
  `review_id` int(10) UNSIGNED NOT NULL,
  `room_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `rate` int(10) UNSIGNED NOT NULL,
  `comment` varchar(250) DEFAULT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `review`
--

INSERT INTO `review` (`review_id`, `room_id`, `user_id`, `rate`, `comment`, `created_time`, `updated_time`) VALUES
(1, 2, 9, 3, 'This is a test review!!', '2020-08-23 14:38:20', '2020-08-23 14:38:20'),
(2, 7, 9, 3, 'test review now', '2020-08-24 11:37:03', '2020-08-24 11:37:03'),
(3, 7, 9, 5, 'another test for 5stars', '2020-08-24 11:37:36', '2020-08-24 11:37:36'),
(8, 7, 9, 3, 'transaction test', '2020-08-24 13:02:12', '2020-08-24 13:02:12'),
(9, 7, 9, 3, 'more testing', '2020-08-24 13:03:06', '2020-08-24 13:03:06'),
(10, 1, 9, 5, 'testing for update review', '2020-08-24 13:07:27', '2020-08-24 13:07:27'),
(11, 1, 9, 3, 'new test to see if avg stars will become lower than 5', '2020-08-24 13:08:06', '2020-08-24 13:08:06'),
(12, 2, 9, 5, 'updating the stars', '2020-08-24 21:57:23', '2020-08-24 21:57:23'),
(13, 1, 9, 4, 'testttt', '2020-08-24 22:07:22', '2020-08-24 22:07:22'),
(14, 2, 9, 4, 'ajax review test', '2020-08-26 15:26:47', '2020-08-26 15:26:47'),
(18, 2, 9, 4, 'append please', '2020-08-26 15:50:39', '2020-08-26 15:50:39'),
(19, 4, 9, 3, 'amazing hotel test', '2020-08-28 10:53:10', '2020-08-28 10:53:10'),
(20, 4, 9, 5, 'new one', '2020-08-28 10:53:53', '2020-08-28 10:53:53'),
(21, 4, 10, 4, 'new user testing', '2020-08-28 12:15:37', '2020-08-28 12:15:37'),
(22, 3, 10, 3, 'csrf test', '2020-08-28 12:33:56', '2020-08-28 12:33:56'),
(23, 8, 10, 3, 'testing csrf', '2020-08-28 12:48:10', '2020-08-28 12:48:10'),
(24, 3, 10, 5, 'yes test', '2020-08-28 13:05:43', '2020-08-28 13:05:43'),
(25, 4, 10, 2, 'a test', '2020-08-28 13:24:39', '2020-08-28 13:24:39'),
(26, 4, 11, 5, 'amazing new user test with changing register.php', '2020-08-28 13:30:50', '2020-08-28 13:30:50'),
(27, 1, 11, 3, 'testing', '2020-08-28 13:33:01', '2020-08-28 13:33:01'),
(28, 6, 11, 5, 'a review to test', '2020-08-28 13:45:32', '2020-08-28 13:45:32'),
(29, 6, 11, 3, 'testing something', '2020-08-28 13:54:24', '2020-08-28 13:54:24'),
(30, 9, 11, 3, 'test', '2020-08-28 23:31:57', '2020-08-28 23:31:57'),
(31, 9, 11, 5, 'fix stars', '2020-08-28 23:32:54', '2020-08-28 23:32:54'),
(32, 6, 11, 4, 'new test', '2020-08-28 23:40:30', '2020-08-28 23:40:30'),
(33, 3, 11, 5, 'TESTING AGAIN', '2020-08-29 11:42:35', '2020-08-29 11:42:35'),
(34, 4, 10, 3, 'testing', '2020-08-29 15:51:59', '2020-08-29 15:51:59'),
(35, 2, 12, 5, 'panagos testing', '2020-08-29 16:01:05', '2020-08-29 16:01:05'),
(36, 5, 12, 3, 'nice test', '2020-08-31 10:39:10', '2020-08-31 10:39:10'),
(37, 2, 13, 5, 'last test', '2020-08-31 11:54:46', '2020-08-31 11:54:46'),
(38, 10, 13, 2, 'good one', '2020-08-31 11:55:36', '2020-08-31 11:55:36');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `room`
--

CREATE TABLE `room` (
  `room_id` int(10) UNSIGNED NOT NULL,
  `type_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL,
  `city` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `photo_url` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `count_of_guests` int(10) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `address` varchar(250) CHARACTER SET utf8 NOT NULL,
  `location_lat` decimal(10,7) NOT NULL,
  `location_long` decimal(10,7) NOT NULL,
  `description_short` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `description_long` text COLLATE utf8_unicode_ci NOT NULL,
  `parking` tinyint(1) NOT NULL,
  `wifi` tinyint(1) NOT NULL,
  `pet_friendly` tinyint(1) NOT NULL,
  `avg_reviews` decimal(10,7) DEFAULT NULL,
  `count_reviews` int(10) UNSIGNED DEFAULT 0,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `room`
--

INSERT INTO `room` (`room_id`, `type_id`, `name`, `city`, `area`, `photo_url`, `count_of_guests`, `price`, `address`, `location_lat`, `location_long`, `description_short`, `description_long`, `parking`, `wifi`, `pet_friendly`, `avg_reviews`, `count_reviews`, `created_time`, `updated_time`) VALUES
(1, 1, 'Hilton Hotel', 'Athens', 'Zwgrafou', 'room-1.jpg', 1, 350, 'Vasilis Sofeias 38', '37.9767030', '23.7504170', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n\r\nVestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.', 1, 1, 0, '3.7500000', 4, '2020-05-28 20:15:36', '2020-08-28 13:33:01'),
(2, 2, 'Megali Vretania Hotel', 'Athens', 'Syntagma', 'room-2.jpg', 2, 500, 'Vasilis Olgas, 115', '37.9765250', '23.7353970', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 1, 1, 0, '4.3333000', 6, '2020-05-28 20:15:36', '2020-08-31 11:54:46'),
(3, 3, 'Apollo Hotel', 'Athens', 'Kentro', 'room-3.jpg', 3, 420, 'Achilleos 10', '37.9853780', '23.7199320', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 1, 1, 1, '4.3333000', 3, '2020-05-28 20:15:36', '2020-08-29 11:42:35'),
(4, 2, 'Oscar Hotel', 'Athens', 'Kentro', 'room-4.jpg', 2, 250, 'Filadelfias 25', '37.9973410', '23.7219820', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 0, 1, 0, '3.6667000', 6, '2020-05-28 20:15:36', '2020-08-29 15:51:59'),
(5, 2, 'Anatolia Hotel', 'Thessaloniki', 'Kentro', 'room-5.jpg', 2, 400, 'Lagkada 13', '40.6477560', '22.9342730', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 1, 1, 1, '3.0000000', 1, '2020-05-28 20:15:36', '2020-08-31 10:39:10'),
(6, 3, 'Nea Metropolis Hotel', 'Thessaloniki', 'Kentro', 'room-6.jpg', 3, 320, 'Siggrou 22', '40.6446290', '22.9409210', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 0, 1, 0, '4.0000000', 3, '2020-05-28 20:15:36', '2020-08-28 23:40:30'),
(7, 2, 'Airotel Galaxy Hotel', 'Kavala', 'Kentro', 'room-7.jpg', 2, 170, 'El. Venizelou 27', '40.9431210', '24.4100360', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 1, 1, 1, '3.5000000', 4, '2020-05-28 20:15:36', '2020-08-24 13:03:06'),
(8, 4, 'Egnatia City Hotel', 'Kavala', 'Kentro', 'room-8.jpg', 4, 280, '7is Merarchias 139', '40.9479970', '24.3874950', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.', 1, 1, 0, '3.0000000', 1, '2020-05-28 20:15:36', '2020-08-28 12:48:10'),
(9, 2, 'Villa Manos Hotel Santorini', 'Santorini', 'Xwra', 'room-9.jpg', 2, 300, 'Karterados', '36.4131770', '25.4478070', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.', 0, 1, 0, '4.0000000', 2, '2020-05-28 20:15:36', '2020-08-28 23:32:54'),
(10, 3, 'Volcano View Hotel Santorini', 'Santorini', 'Xwra', 'room-10.jpg', 3, 410, 'Fira', '36.4006410', '25.4377640', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.', 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.\r\n', 1, 1, 0, '2.0000000', 1, '2020-05-28 20:15:36', '2020-08-31 11:55:36');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `room_type`
--

CREATE TABLE `room_type` (
  `type_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `room_type`
--

INSERT INTO `room_type` (`type_id`, `title`) VALUES
(1, 'Single Room'),
(2, 'Double Room'),
(3, 'Triple Room'),
(4, 'Fourfold Room');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `user`
--

CREATE TABLE `user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` text CHARACTER SET utf8mb4 NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `password`, `created_time`, `updated_time`) VALUES
(1, 'hotel_admin', 'hotel_admin@collegelink.gr', '', '2020-05-28 20:15:35', '2020-05-28 20:15:35'),
(3, 'george', 'apo@apo.gr', '$2y$10$MqdIHL6rik/igs4e6iopcOgyRDq2xVALQ588U2Fg5JH5wXMUFsJg2', '2020-08-19 10:57:17', '2020-08-19 10:57:17'),
(5, 'magkakos', 'yesman@hotmail.gr', '$2y$10$CKhv.CbAkk1GSyJWoHk7m.5O.AKn6UT9MWwa/yoQRTlGrshXo7gBK', '2020-08-19 11:42:05', '2020-08-19 11:42:05'),
(6, 'magkakossss', 'boom@hotmail.gr', '$2y$10$elR0f3OffKcQ6zY5Q2SOVO4z9GieCwJ5FZSVMe909XGY2M9PPmB1C', '2020-08-19 12:14:18', '2020-08-19 12:14:18'),
(7, 'dghdfg', 'ghdffg@fgd/gr', '$2y$10$lYXm//dBforvMiyGXgP6J.st9V8/PAphgl5WVJC6xLSTkLGf8A9qK', '2020-08-19 13:10:34', '2020-08-19 13:10:34'),
(9, 'testnew', 'tester@totest.gr', '$2y$10$jrftRrFtLtTnhmcGq6k/9Oon7a8ZXSMoBNSO.XtvOZn2.oreX/YF6', '2020-08-22 11:18:32', '2020-08-22 11:18:32'),
(10, 'george', 'apo@apoapoapo.gr', '$2y$10$fLOIWonbiH7Zz/xugjoKsu9g.xfF//jbENEZS1lEwTmaMpACHCnqS', '2020-08-28 11:38:40', '2020-08-28 11:38:40'),
(11, 'Auser', 'fff@gr.gr', '$2y$10$5ZTRDODn/qH/InoDc/Wh5.U.Ea/T2/fjCb1Jl5.r0VTxikpl3NaQu', '2020-08-28 13:29:04', '2020-08-28 13:29:04'),
(12, 'panagoulhs', 'pan@pan.gr', '$2y$10$vR.lQ.9AuieDZ3mRz99duOBq3vJquzYkSdmXJDnRidopuluanafFq', '2020-08-29 15:59:38', '2020-08-29 15:59:38'),
(13, 'ValidFormTester', 'valid@mail.com', '$2y$10$CJmJAGgq9HHz502iSc7mjOxfarWfYaa3gFMtOSCEv.AWDmEuAbAfe', '2020-08-31 11:54:05', '2020-08-31 11:54:05');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_booking__room_idx` (`room_id`),
  ADD KEY `fk_booking__user_idx` (`user_id`);

--
-- Ευρετήρια για πίνακα `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`user_id`,`room_id`),
  ADD KEY `fk_favorite__room_idx` (`room_id`);

--
-- Ευρετήρια για πίνακα `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `fk_payment__booking` (`booking_id`);

--
-- Ευρετήρια για πίνακα `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_review__room_idx` (`room_id`),
  ADD KEY `fk_review__user_idx` (`user_id`);

--
-- Ευρετήρια για πίνακα `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `fk_room__room_type_idx` (`type_id`),
  ADD KEY `idx_city__price` (`city`,`price`);

--
-- Ευρετήρια για πίνακα `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Ευρετήρια για πίνακα `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT για πίνακα `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT για πίνακα `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT για πίνακα `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT για πίνακα `room_type`
--
ALTER TABLE `room_type`
  MODIFY `type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT για πίνακα `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `fk_booking__room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_booking__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `fk_favorite__room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_favorite__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment__booking` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`booking_id`) ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `fk_review__room` FOREIGN KEY (`room_id`) REFERENCES `room` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_review__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Περιορισμοί για πίνακα `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_room__room_type` FOREIGN KEY (`type_id`) REFERENCES `room_type` (`type_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
