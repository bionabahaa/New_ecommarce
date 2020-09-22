-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2020 at 11:04 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_ecommarce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(225) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `photo`, `password`, `created_at`, `updated_at`) VALUES
(1, 'bian bahaa', 'bian@gmail.com', NULL, '$2y$10$NIrlCqojB51A8ESFmmBTIOzzoB/tBIqjR8TYEmJ4F4KStDdE6d3Au', '2020-09-12 23:05:22', '2020-09-12 23:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `abbr` varchar(10) NOT NULL,
  `local` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `direction` enum('rtl','ltr') NOT NULL DEFAULT 'rtl',
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `abbr`, `local`, `name`, `direction`, `active`, `created_at`, `updated_at`) VALUES
(3, 'ar', NULL, 'اللغه العربيه', 'rtl', 1, '2020-09-14 20:14:49', '2020-09-14 20:31:56'),
(4, 'en', NULL, 'English', 'ltr', 1, '2020-09-16 19:30:12', '2020-09-16 19:30:12'),
(5, 'fr', NULL, 'french', 'ltr', 1, '2020-09-16 19:30:29', '2020-09-20 22:48:03'),
(6, 'ES', NULL, 'spanish', 'ltr', 1, '2020-09-20 22:47:52', '2020-09-20 22:47:52');

-- --------------------------------------------------------

--
-- Table structure for table `main_categories`
--

CREATE TABLE `main_categories` (
  `id` int(11) NOT NULL,
  `translation_lang` varchar(255) NOT NULL,
  `translation_of` int(11) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `photo` varchar(150) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `main_categories`
--

INSERT INTO `main_categories` (`id`, `translation_lang`, `translation_of`, `name`, `slug`, `photo`, `active`, `created_at`, `updated_at`) VALUES
(9, 'en', 8, 'clothes', 'clothes', 'images/maincategories/22zrMzgeSrw7XnrUcVuGksU300MWwEjzhH54JGF0.jpeg', 1, NULL, NULL),
(10, 'ar', 0, 'احذيه', 'احذيه', 'images/maincategories/t1YkEEQHgL8BKDivHuOw4xVB8nEzo3MMAKWgkQQR.png', 0, NULL, '2020-09-22 10:25:09'),
(11, 'en', 10, 'choes', 'choes', 'images/maincategories/t1YkEEQHgL8BKDivHuOw4xVB8nEzo3MMAKWgkQQR.png', 1, NULL, NULL),
(13, 'en', 12, 'sdsd', 'sdsd', 'images/maincategories/lq2Z4onl8ktrITeZRh481hzy7sDtY6ETzXwsKIo8.png', 1, NULL, NULL),
(15, 'en', 14, 'aSAS', 'fredreferererwrf', 'images/maincategories/QVyvoteiUceAa52yGlU8BNaCpSOqiTw692ZSpr06.png', 1, NULL, '2020-09-20 22:42:36'),
(17, 'en', 16, 'choes', 'choes', 'images/maincategories/pGxJQJ3HS2roGSZcHZe58JJDWM7cuz045oSuuxfM.png', 1, NULL, NULL),
(18, 'fr', 16, 'choesss', 'choesss', 'images/maincategories/pGxJQJ3HS2roGSZcHZe58JJDWM7cuz045oSuuxfM.png', 1, NULL, NULL),
(19, 'ES', 16, 'choesssdsffdfrewrf', 'choesssdsffdfrewrf', 'images/maincategories/pGxJQJ3HS2roGSZcHZe58JJDWM7cuz045oSuuxfM.png', 1, NULL, NULL),
(21, 'en', 20, 'cloths', 'cloths', 'images/maincategories/WXXP4hQhfWhtqFtKRlDQzaXFBCIygZrtKJGQEmjJ.png', 1, NULL, NULL),
(22, 'fr', 20, 'cloths', 'cloths', 'images/maincategories/WXXP4hQhfWhtqFtKRlDQzaXFBCIygZrtKJGQEmjJ.png', 1, NULL, NULL),
(23, 'ES', 20, 'cloths', 'cloths', 'images/maincategories/WXXP4hQhfWhtqFtKRlDQzaXFBCIygZrtKJGQEmjJ.png', 1, NULL, NULL),
(28, 'ar', 0, 'ملابس', 'ملابس', 'images/maincategories/sGds8Meu2j3FyFL692aqLIN4dgyJrrIK6sMoZ7pg.png', 1, NULL, NULL),
(29, 'en', 28, 'cloths', 'cloths', 'images/maincategories/sGds8Meu2j3FyFL692aqLIN4dgyJrrIK6sMoZ7pg.png', 1, NULL, NULL),
(30, 'fr', 28, 'cloths', 'cloths', 'images/maincategories/sGds8Meu2j3FyFL692aqLIN4dgyJrrIK6sMoZ7pg.png', 1, NULL, NULL),
(31, 'ES', 28, 'cloths', 'cloths', 'images/maincategories/sGds8Meu2j3FyFL692aqLIN4dgyJrrIK6sMoZ7pg.png', 1, NULL, NULL);

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
(4, '2020_09_12_124131_create_admins_table', 1);

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
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `translation_lang` varchar(255) NOT NULL,
  `translation_of` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `slug` varchar(150) DEFAULT NULL,
  `photo` varchar(150) DEFAULT NULL,
  `active` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `logo` varchar(200) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `logo`, `mobile`, `address`, `email`, `password`, `category_id`, `active`, `created_at`, `updated_at`) VALUES
(7, 'happy new yearssssssssssss', 'images/vendors/lbqKZgVbNKrMolE0EhPcNPOcKuXH3CM3EI3MLV7j.png', '01015310570', 'أبحث هنا', 'admin123@gmail.com', '123456789', 10, 1, '2020-09-21 23:02:12', '2020-09-22 11:19:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_categories`
--
ALTER TABLE `main_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `main_categories`
--
ALTER TABLE `main_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
