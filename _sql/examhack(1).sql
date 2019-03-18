-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2016 at 02:31 PM
-- Server version: 5.7.9
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `examhack`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `visible` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `parent_id`, `visible`, `created_at`, `updated_at`) VALUES
(1, 'Advanced materials', 0, 1, '2016-12-26 16:31:33', '2016-12-26 16:31:33'),
(3, 'Simple materials', 0, 1, '2016-12-27 11:43:45', '2016-12-27 11:43:45'),
(4, 'Another category', 0, 1, '2016-12-27 11:43:51', '2016-12-27 11:43:51');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `position` int(11) DEFAULT NULL,
  `menu_type` int(11) NOT NULL DEFAULT '1',
  `icon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `position`, `menu_type`, `icon`, `name`, `title`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, NULL, 'User', 'User', NULL, NULL, NULL),
(2, NULL, 0, NULL, 'Role', 'Role', NULL, NULL, NULL),
(3, 0, 1, 'fa-database', 'Category', 'Category', NULL, '2016-12-26 16:25:13', '2016-12-26 16:25:13'),
(4, 0, 1, 'fa-database', 'Papers', 'Papers', NULL, '2016-12-26 16:41:07', '2016-12-26 16:41:07'),
(5, 0, 1, 'fa-database', 'Translations', 'Translations', NULL, '2016-12-27 08:44:19', '2016-12-27 08:44:19'),
(6, 0, 1, 'fa-database', 'ManageUsers', 'Manage Users', NULL, '2016-12-27 12:12:15', '2016-12-27 12:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

DROP TABLE IF EXISTS `menu_role`;
CREATE TABLE IF NOT EXISTS `menu_role` (
  `menu_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  UNIQUE KEY `menu_role_menu_id_role_id_unique` (`menu_id`,`role_id`),
  KEY `menu_role_menu_id_index` (`menu_id`),
  KEY `menu_role_role_id_index` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_role`
--

INSERT INTO `menu_role` (`menu_id`, `role_id`) VALUES
(3, 1),
(3, 3),
(4, 1),
(4, 3),
(5, 1),
(5, 3),
(6, 1),
(6, 3);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_10_10_000000_create_menus_table', 1),
(4, '2015_10_10_000000_create_roles_table', 1),
(5, '2015_10_10_000000_update_users_table', 1),
(6, '2015_12_11_000000_create_users_logs_table', 1),
(7, '2016_03_14_000000_update_menus_table', 1),
(9, '2016_12_26_182513_create_category_table', 2),
(10, '2016_12_26_184107_create_papers_table', 3),
(11, '2016_12_27_104419_create_translations_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `papers`
--

DROP TABLE IF EXISTS `papers`;
CREATE TABLE IF NOT EXISTS `papers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `active` tinyint(4) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `papers`
--

INSERT INTO `papers` (`id`, `name`, `text`, `category_id`, `active`, `created_at`, `updated_at`) VALUES
(1, '2014 paper', '<p>Some text here which i can fully edit, <strong>add styling</strong> or <span style="font-size:26px">anything i want</span>.</p>\r\n\r\n<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n\r\n<div>\r\n<h2>Why do we use it?</h2>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n</div>\r\n', 1, 1, '2016-12-26 16:41:45', '2016-12-27 11:50:03');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('code@zilvinas.pro', 'bad45a5aa2341d2d743be3e142bf5e8a09362a9dd0824a7d3a105b7deb13bf1e', '2016-12-27 08:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`) VALUES
(1, 'Creator', '2016-12-26 16:13:59', '2016-12-26 16:20:45'),
(0, 'User', '2016-12-26 16:13:59', '2016-12-26 16:13:59'),
(3, 'Administrator', '2016-12-26 16:21:28', '2016-12-26 16:21:28');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
CREATE TABLE IF NOT EXISTS `translations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `translations`
--

INSERT INTO `translations` (`id`, `slug`, `text`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'site-title', 'Examhack', '2016-12-27 08:44:45', '2016-12-27 08:44:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'fshock', 'code@zilvinas.pro', '$2y$10$2zvw8R/YxFHrxD/0fJAIceG/QGsiIESGszgMNwPOyHx06R5wrv3wC', 'tkJmJOg749TlyuNTRQjTLxbNPqcNUrCwWad4bMaBXELjfKAE7PBewdyWcoyZ', '2016-12-26 16:14:12', '2016-12-27 11:59:47'),
(2, 0, 'test_user', 'puopis@gmail.com', '$2y$10$iVxvhv2aXtC44GgJ5UHI8eTq9v36/dXzGb10fRCyNkJWwJ3h/JsXO', '2V8zLbj4xQRpvgJCCeoHLbnN8nibeWQ0bWbK5qzMKa2RPh3OvSYJfLeHuxx1', '2016-12-26 18:11:00', '2016-12-27 12:22:51'),
(3, 3, 'examhack', 'admin@examhack.com', '$2y$10$3CFZqOfFUAtk9SS7kKBt8.c0MuScx4lf1N1P8LaYhXzUeVnrqJx3K', 'XVr1xGr7e3tloCfVhQRnzueMvEhYgW5nIwGl4HIzTYiqJA8FZq4bi87QdU6z', '2016-12-27 11:59:42', '2016-12-27 12:07:43');

-- --------------------------------------------------------

--
-- Table structure for table `users_logs`
--

DROP TABLE IF EXISTS `users_logs`;
CREATE TABLE IF NOT EXISTS `users_logs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action_model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_logs`
--

INSERT INTO `users_logs` (`id`, `user_id`, `action`, `action_model`, `action_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'created', 'category', 1, '2016-12-26 16:31:33', '2016-12-26 16:31:33'),
(2, 1, 'created', 'category', 2, '2016-12-26 16:35:14', '2016-12-26 16:35:14'),
(3, 1, 'deleted', 'category', 2, '2016-12-26 16:39:38', '2016-12-26 16:39:38'),
(4, 1, 'created', 'papers', 1, '2016-12-26 16:41:45', '2016-12-26 16:41:45'),
(5, 1, 'updated', 'users', 1, '2016-12-26 18:10:02', '2016-12-26 18:10:02'),
(6, 2, 'updated', 'users', 2, '2016-12-26 18:12:00', '2016-12-26 18:12:00'),
(7, 2, 'updated', 'users', 2, '2016-12-26 19:18:24', '2016-12-26 19:18:24'),
(8, 1, 'updated', 'users', 1, '2016-12-26 19:53:06', '2016-12-26 19:53:06'),
(9, 1, 'updated', 'users', 1, '2016-12-26 19:55:29', '2016-12-26 19:55:29'),
(10, 2, 'updated', 'users', 2, '2016-12-26 20:04:57', '2016-12-26 20:04:57'),
(11, 1, 'updated', 'users', 1, '2016-12-26 20:06:39', '2016-12-26 20:06:39'),
(12, 1, 'updated', 'users', 1, '2016-12-26 20:11:07', '2016-12-26 20:11:07'),
(13, 1, 'updated', 'users', 1, '2016-12-26 20:11:12', '2016-12-26 20:11:12'),
(14, 1, 'updated', 'users', 1, '2016-12-26 20:12:37', '2016-12-26 20:12:37'),
(15, 2, 'updated', 'users', 1, '2016-12-27 08:22:42', '2016-12-27 08:22:42'),
(16, 2, 'updated', 'users', 2, '2016-12-27 08:22:45', '2016-12-27 08:22:45'),
(17, 1, 'updated', 'users', 2, '2016-12-27 08:25:29', '2016-12-27 08:25:29'),
(18, 1, 'updated', 'users', 1, '2016-12-27 08:25:31', '2016-12-27 08:25:31'),
(19, 1, 'created', 'translations', 1, '2016-12-27 08:44:45', '2016-12-27 08:44:45'),
(20, 1, 'updated', 'users', 1, '2016-12-27 09:26:47', '2016-12-27 09:26:47'),
(21, 1, 'updated', 'users', 1, '2016-12-27 09:27:05', '2016-12-27 09:27:05'),
(22, 1, 'updated', 'users', 1, '2016-12-27 09:27:09', '2016-12-27 09:27:09'),
(23, 1, 'updated', 'users', 1, '2016-12-27 09:27:31', '2016-12-27 09:27:31'),
(24, 1, 'updated', 'users', 1, '2016-12-27 09:27:56', '2016-12-27 09:27:56'),
(25, 1, 'updated', 'users', 1, '2016-12-27 09:28:25', '2016-12-27 09:28:25'),
(26, 1, 'updated', 'users', 1, '2016-12-27 09:28:27', '2016-12-27 09:28:27'),
(27, 1, 'updated', 'users', 1, '2016-12-27 09:31:09', '2016-12-27 09:31:09'),
(28, 1, 'updated', 'users', 1, '2016-12-27 09:31:12', '2016-12-27 09:31:12'),
(29, 1, 'updated', 'users', 1, '2016-12-27 09:31:24', '2016-12-27 09:31:24'),
(30, 1, 'updated', 'users', 1, '2016-12-27 09:31:29', '2016-12-27 09:31:29'),
(31, 1, 'updated', 'users', 1, '2016-12-27 09:31:35', '2016-12-27 09:31:35'),
(32, 1, 'updated', 'users', 1, '2016-12-27 09:41:22', '2016-12-27 09:41:22'),
(33, 1, 'updated', 'users', 2, '2016-12-27 09:42:10', '2016-12-27 09:42:10'),
(34, 1, 'updated', 'users', 1, '2016-12-27 09:59:09', '2016-12-27 09:59:09'),
(35, 1, 'updated', 'users', 1, '2016-12-27 10:41:05', '2016-12-27 10:41:05'),
(36, 1, 'updated', 'users', 1, '2016-12-27 10:49:01', '2016-12-27 10:49:01'),
(37, 1, 'updated', 'users', 1, '2016-12-27 11:40:17', '2016-12-27 11:40:17'),
(38, 1, 'created', 'category', 3, '2016-12-27 11:43:45', '2016-12-27 11:43:45'),
(39, 1, 'created', 'category', 4, '2016-12-27 11:43:51', '2016-12-27 11:43:51'),
(40, 1, 'updated', 'papers', 1, '2016-12-27 11:50:03', '2016-12-27 11:50:03'),
(41, 1, 'created', 'users', 3, '2016-12-27 11:59:42', '2016-12-27 11:59:42'),
(42, 1, 'updated', 'users', 1, '2016-12-27 11:59:47', '2016-12-27 11:59:47'),
(43, 3, 'updated', 'users', 3, '2016-12-27 12:07:43', '2016-12-27 12:07:43'),
(44, 1, 'updated', 'users', 2, '2016-12-27 12:22:13', '2016-12-27 12:22:13'),
(45, 1, 'updated', 'users', 2, '2016-12-27 12:22:35', '2016-12-27 12:22:35'),
(46, 1, 'updated', 'users', 2, '2016-12-27 12:22:51', '2016-12-27 12:22:51');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
