-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2021 at 07:35 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hpp_mon_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_05_01_072531_create_m_role_table', 1),
(5, '2021_05_01_073107_create_m_main_data_table', 1),
(6, '2021_05_01_073132_create_m_sun_data_table', 1),
(7, '2021_05_01_073143_create_m_wind_data_table', 1),
(8, '2021_05_01_075013_create_m_report_table', 1),
(10, '2021_07_11_231819_create_settings_table', 2),
(11, '2021_07_12_002721_create_activity_log_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `m_main_data`
--

CREATE TABLE `m_main_data` (
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_main_data`
--

INSERT INTO `m_main_data` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34),
(35),
(36),
(37),
(38),
(39),
(40),
(41),
(42),
(43),
(44),
(45),
(46),
(47),
(48),
(49),
(50),
(51),
(52),
(53),
(54);

-- --------------------------------------------------------

--
-- Table structure for table `m_report`
--

CREATE TABLE `m_report` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('Excel','PDF') COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_report` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `m_role`
--

CREATE TABLE `m_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_role`
--

INSERT INTO `m_role` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `m_sun_data`
--

CREATE TABLE `m_sun_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voltage` double NOT NULL,
  `current` double NOT NULL,
  `lux` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `main_data_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_sun_data`
--

INSERT INTO `m_sun_data` (`id`, `data_id`, `voltage`, `current`, `lux`, `created_at`, `updated_at`, `main_data_id`) VALUES
(2, 'M-1', 4.5, 3.2, 53252.3, '2021-05-02 13:37:08', NULL, 1),
(7, 'M-53', 16.2, 10.1, 88060.5, '2021-05-02 15:45:00', '2021-05-02 15:45:00', 9),
(8, 'M-83', 20.7, 7.6, 20143.6, '2021-05-09 04:44:54', '2021-05-09 04:44:54', 13),
(9, 'M-65', 11.4, 11.7, 83578.3, '2021-05-09 04:44:57', '2021-05-09 04:44:57', 14),
(11, 'M-44', 16.2, 11.3, 43463.8, '2021-05-09 04:45:03', '2021-05-09 04:45:03', 16),
(12, 'M-41', 7.9, 1.3, 43533.1, '2021-05-09 05:47:35', '2021-05-09 05:47:35', 17),
(13, 'M-53', 22.6, 11.7, 84304, '2021-05-09 05:47:37', '2021-05-09 05:47:37', 18),
(14, 'M-82', 5.4, 9.9, 3707.6, '2021-05-09 05:47:40', '2021-05-09 05:47:40', 19),
(15, 'M-9', 23.8, 6.1, 31992.1, '2021-05-09 05:47:43', '2021-05-09 05:47:43', 20),
(16, 'M-47', 4.4, 0.1, 15402.2, '2021-05-09 05:47:47', '2021-05-09 05:47:47', 21),
(17, 'M-9', 14.4, 3.9, 78971, '2021-05-09 05:47:53', '2021-05-09 05:47:53', 22),
(18, 'M-53', 13, 9, 3788, '2021-05-09 05:47:55', '2021-05-09 05:47:55', 23),
(19, 'M-90', 6.1, 1.9, 62051.6, '2021-05-09 05:47:58', '2021-05-09 05:47:58', 24),
(20, 'M-4', 8, 8.5, 73955.5, '2021-05-09 05:48:01', '2021-05-09 05:48:01', 25),
(21, 'M-33', 20.2, 7.1, 26425.4, '2021-05-09 05:48:05', '2021-05-09 05:48:05', 26),
(22, 'M-87', 7.4, 3.6, 77162.9, '2021-05-09 05:48:08', '2021-05-09 05:48:08', 27),
(23, 'M-29', 6.4, 5.7, 7360.6, '2021-05-09 05:48:11', '2021-05-09 05:48:11', 28),
(24, 'M-95', 21.4, 10.7, 89725.5, '2021-05-09 05:48:15', '2021-05-09 05:48:15', 29),
(25, 'M-29', 6.4, 2, 42959.7, '2021-05-09 05:48:18', '2021-05-09 05:48:18', 30),
(26, 'M-97', 23.9, 11.6, 26983.8, '2021-05-09 05:48:33', '2021-05-09 05:48:33', 31),
(27, 'M-20', 13, 2.8, 6099.4, '2021-05-09 05:48:36', '2021-05-09 05:48:36', 32),
(28, 'M-87', 11.3, 4.6, 7246.6, '2021-05-09 05:48:42', '2021-05-09 05:48:42', 33),
(30, 'M-21', 14.9, 8.3, 26731.2, '2021-05-09 05:48:49', '2021-05-09 05:48:49', 35),
(31, 'M-5', 21.2, 6.4, 94015, '2021-05-09 05:49:22', '2021-05-09 05:49:22', 36),
(32, 'M-68', 0.9, 2.3, 81396, '2021-05-09 05:49:24', '2021-05-09 05:49:24', 37),
(33, 'M-13', 10.8, 3.8, 71576.7, '2021-05-09 05:49:28', '2021-05-09 05:49:28', 38),
(34, 'M-36', 2, 1.3, 11580.1, '2021-05-09 05:49:31', '2021-05-09 05:49:31', 39),
(35, 'M-94', 9.5, 1.6, 32315, '2021-05-08 05:49:34', '2021-05-09 05:49:34', 40),
(36, 'M-90', 17, 9.4, 74537.2, '2021-05-09 05:49:37', '2021-05-09 05:49:37', 41),
(37, 'M-37', 5.2, 5.6, 15616.8, '2021-05-09 22:38:28', '2021-05-09 22:38:28', 48),
(38, 'M-73', 8.4, 8.9, 39550.2, '2021-05-09 23:23:59', '2021-05-09 23:23:59', 49),
(39, 'M-39', 11.5, 5.1, 36009.4, '2021-05-09 23:24:13', '2021-05-09 23:24:13', 50),
(40, 'M-57', 16.7, 3.7, 19680.9, '2021-05-10 08:15:04', '2021-05-10 08:15:04', 53),
(41, 'M-18', 20.8, 6.3, 432.2, '2021-05-10 08:38:52', '2021-05-10 08:38:52', 54);

-- --------------------------------------------------------

--
-- Table structure for table `m_wind_data`
--

CREATE TABLE `m_wind_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `data_id` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voltage` double NOT NULL,
  `current` double NOT NULL,
  `rpm` double NOT NULL,
  `wind_speed` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `main_data_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `m_wind_data`
--

INSERT INTO `m_wind_data` (`id`, `data_id`, `voltage`, `current`, `rpm`, `wind_speed`, `created_at`, `updated_at`, `main_data_id`) VALUES
(4, 'A-56', 14.4, 7.7, 61446, 47.4, '2021-05-09 09:56:19', '2021-05-09 09:56:19', 42),
(5, 'A-38', 13.2, 9.1, 301, 49.8, '2021-05-09 09:56:36', '2021-05-09 09:56:36', 43),
(6, 'A-98', 5.8, 5.3, 52243, 12, '2021-05-09 09:56:51', '2021-05-09 09:56:51', 44),
(8, 'A-70', 22.7, 7.7, 27012, 43.3, '2021-05-09 09:59:20', '2021-05-09 09:59:20', 46),
(9, 'A-48', 14.8, 11.3, 55064, 14, '2021-05-09 09:59:25', '2021-05-09 09:59:25', 47),
(10, 'A-86', 8.3, 2.5, 45518, 3.5, '2021-05-09 23:24:26', '2021-05-09 23:24:26', 51),
(11, 'A-83', 8.7, 1, 44131, 13.5, '2021-05-09 23:24:34', '2021-05-09 23:24:34', 52);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1, 'max_data_in_graph', '30'),
(2, 'delay_on_dashboard', '5');

-- --------------------------------------------------------

--
-- Table structure for table `test_chart`
--

CREATE TABLE `test_chart` (
  `id` int(11) NOT NULL,
  `tegangan` double NOT NULL,
  `arus` double NOT NULL,
  `timestamps` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_chart`
--

INSERT INTO `test_chart` (`id`, `tegangan`, `arus`, `timestamps`) VALUES
(1, 8.6, 0.3, '2021-07-21 22:36:07'),
(2, 6.7, 4.6, '2021-07-21 22:36:08'),
(3, 17.8, 4.5, '2021-07-21 22:36:10'),
(4, 9.4, 6.9, '2021-07-21 22:36:12'),
(5, 21.9, 3.4, '2021-07-21 22:36:13'),
(6, 23.2, 11.4, '2021-07-21 22:36:15'),
(7, 7.1, 11.8, '2021-07-21 22:36:17'),
(8, 9.3, 9.1, '2021-07-21 22:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default.jpg',
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `fullname`, `phone_number`, `profile_picture`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@hppmon.com', '$2y$10$1mNh/p.Uc6qz/GuPM1ntnefOjqGHeP1TLdV9XDomiM0oLO4diyLQa', 'Super Admin HPP-Monitor', '0812345678910', 'default.jpg', 1, NULL, '2021-05-01 08:05:00', '2021-05-01 08:05:00'),
(2, 'staff', 'staff@hppmon.com', '$2y$10$GJiHDptINyoPQ15LQKc3HOUkBT6RwH/GxeRMtBCSV14i.CH87K6my', 'Staff HPP-Monitoring-in', '0810987654321', 'staff.png', 2, NULL, '2021-05-01 08:05:01', '2021-05-01 08:05:01'),
(3, 'didesuruq', 'kazoso@mailinator.com', '$2y$10$cr3P7udwh8dw42/bgcKEI..jw4ZUgsv.SQ1m1VUnLKqkEpgeEE1H6', 'Ella Slater123', '718123', 'didesuruq.png', 2, NULL, '2021-05-08 15:01:11', '2021-05-08 15:34:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_main_data`
--
ALTER TABLE `m_main_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_report`
--
ALTER TABLE `m_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_report_user_id_foreign` (`user_id`);

--
-- Indexes for table `m_role`
--
ALTER TABLE `m_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_sun_data`
--
ALTER TABLE `m_sun_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_sun_data_main_data_id_foreign` (`main_data_id`);

--
-- Indexes for table `m_wind_data`
--
ALTER TABLE `m_wind_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `m_wind_data_main_data_id_foreign` (`main_data_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_chart`
--
ALTER TABLE `test_chart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `m_main_data`
--
ALTER TABLE `m_main_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `m_report`
--
ALTER TABLE `m_report`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `m_role`
--
ALTER TABLE `m_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `m_sun_data`
--
ALTER TABLE `m_sun_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `m_wind_data`
--
ALTER TABLE `m_wind_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `test_chart`
--
ALTER TABLE `test_chart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `m_report`
--
ALTER TABLE `m_report`
  ADD CONSTRAINT `m_report_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `m_sun_data`
--
ALTER TABLE `m_sun_data`
  ADD CONSTRAINT `m_sun_data_main_data_id_foreign` FOREIGN KEY (`main_data_id`) REFERENCES `m_main_data` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `m_wind_data`
--
ALTER TABLE `m_wind_data`
  ADD CONSTRAINT `m_wind_data_main_data_id_foreign` FOREIGN KEY (`main_data_id`) REFERENCES `m_main_data` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `m_role` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
