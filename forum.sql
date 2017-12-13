-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 13, 2017 at 09:34 
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `chatter_categories`
--

CREATE TABLE `chatter_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatter_categories`
--

INSERT INTO `chatter_categories` (`id`, `parent_id`, `order`, `name`, `color`, `slug`, `created_at`, `updated_at`) VALUES
(5, NULL, 1, 'Fast Moving Consumer Goods', '#3498DB', 'fmcg', NULL, NULL),
(6, NULL, 2, 'Oil and Gas', '#2ECC71', 'oil_and_gas', NULL, NULL),
(7, NULL, 3, 'Financial Services', '#9B59B6', 'financial_services', NULL, NULL),
(8, NULL, 4, 'Information Technology', '#E67E22', 'information_technology', NULL, NULL),
(9, NULL, 1, 'Media', '#3498DB', 'media', NULL, NULL),
(10, NULL, 2, 'Telecommunications', '#2ECC71', 'telecommunications', NULL, NULL),
(11, NULL, 3, 'Consulting', '#9B59B6', 'consulting', NULL, NULL),
(12, NULL, 4, 'Non-Profit', '#E67E22', 'non_profit', NULL, NULL),
(13, NULL, 1, 'Construction', '#3498DB', 'construction', NULL, NULL),
(14, NULL, 2, 'Pharmaceuticals', '#2ECC71', 'pharmaceuticals', NULL, NULL),
(15, NULL, 3, 'Hospitality/Tourism', '#9B59B6', 'hospitality_tourism', NULL, NULL),
(16, NULL, 4, 'Electricity/Energy', '#E67E22', 'information_technology', NULL, NULL),
(17, NULL, 1, 'Aviation', '#3498DB', 'aviation', NULL, NULL),
(18, NULL, 2, 'Agriculture', '#2ECC71', 'agriculture', NULL, NULL),
(19, NULL, 3, 'Government', '#9B59B6', 'government', NULL, NULL),
(20, NULL, 4, 'Insurance', '#E67E22', 'insurance', NULL, NULL),
(21, NULL, 1, 'Transportation', '#3498DB', 'transportation', NULL, NULL),
(22, NULL, 2, 'Advertising', '#2ECC71', 'advertising', NULL, NULL),
(23, NULL, 3, 'Beauty', '#9B59B6', 'beauty', NULL, NULL),
(24, NULL, 4, 'Health Care', '#E67E22', 'health_care', NULL, NULL),
(25, NULL, 1, 'Fashion', '#3498DB', 'fashion', NULL, NULL),
(26, NULL, 2, 'Education', '#2ECC71', 'education', NULL, NULL),
(27, NULL, 3, 'Food Processing', '#9B59B6', 'food_processing', NULL, NULL),
(28, NULL, 4, 'Waste Disposal', '#E67E22', 'waste_disposal', NULL, NULL),
(29, NULL, 1, 'Franchising', '#3498DB', 'franchising', NULL, NULL),
(30, NULL, 2, 'Wholesale/Retail Sales', '#2ECC71', 'wholesale_retail_sales', NULL, NULL),
(31, NULL, 3, 'Waste Management', '#9B59B6', 'waste_mgt', NULL, NULL),
(32, NULL, 4, 'Mass Media', '#E67E22', 'mass_media', NULL, NULL),
(33, NULL, 1, 'Conulting', '#3498DB', 'consulting', NULL, NULL),
(34, NULL, 2, 'Legal Services', '#2ECC71', 'legal_services', NULL, NULL),
(35, NULL, 3, 'Public Health', '#9B59B6', 'public_health', NULL, NULL),
(36, NULL, 4, 'Gambling', '#E67E22', 'gambling', NULL, NULL),
(37, NULL, 1, 'Mining', '#3498DB', 'mining', NULL, NULL),
(38, NULL, 2, 'Overseas Remittances/Forex', '#2ECC71', 'overseas_remittances_forex', NULL, NULL),
(39, 1, 3, 'Haulage/Logostics', '#9B59B6', 'haulage_logistics', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chatter_discussion`
--

CREATE TABLE `chatter_discussion` (
  `id` int(10) UNSIGNED NOT NULL,
  `chatter_category_id` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `sticky` tinyint(1) NOT NULL DEFAULT '0',
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `answered` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '#232629'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatter_discussion`
--

INSERT INTO `chatter_discussion` (`id`, `chatter_category_id`, `title`, `user_id`, `sticky`, `views`, `answered`, `created_at`, `updated_at`, `slug`, `color`) VALUES
(2, 5, 'Hello', 1, 0, 0, 0, '2017-12-12 08:37:57', '2017-12-12 08:37:57', 'hello', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `chatter_post`
--

CREATE TABLE `chatter_post` (
  `id` int(10) UNSIGNED NOT NULL,
  `chatter_discussion_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `markdown` tinyint(1) NOT NULL DEFAULT '0',
  `locked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatter_post`
--

INSERT INTO `chatter_post` (`id`, `chatter_discussion_id`, `user_id`, `body`, `created_at`, `updated_at`, `markdown`, `locked`) VALUES
(2, 2, 1, '<p>tbghrbhgbrbghrhghrhghrbghbrhbgrgr</p>', '2017-12-12 08:37:57', '2017-12-12 08:37:57', 0, 0),
(3, 2, 1, '<p><img src="https://cnet4.cbsistatic.com/img/QJcTT2ab-sYWwOGrxJc0MXSt3UI=/2011/10/27/a66dfbb7-fdc7-11e2-8c7c-d4ae52e62bcc/android-wallpaper5_2560x1600_1.jpg" alt="" width="80" height="80" />hfhfhfhfhfhfhfhfhfhfhbvhrbbgverger</p>', '2017-12-12 15:50:01', '2017-12-12 15:50:01', 0, 0),
(4, 2, 1, '<blockquote style="text-align: center;"><ul><li><strong><em><br></em></strong></li><li><strong><em>fd bl tb</em></strong></li><li><strong><em>rbltmr</em></strong></li><li><strong><em>bre</em></strong></li><li><strong><em>ffffff</em></strong><br></li></ul></blockquote>', '2017-12-13 07:20:35', '2017-12-13 07:20:35', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `chatter_user_discussion`
--

CREATE TABLE `chatter_user_discussion` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `discussion_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chatter_user_discussion`
--

INSERT INTO `chatter_user_discussion` (`user_id`, `discussion_id`) VALUES
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_07_29_171118_create_chatter_categories_table', 1),
(4, '2016_07_29_171118_create_chatter_discussion_table', 1),
(5, '2016_07_29_171118_create_chatter_post_table', 1),
(6, '2016_07_29_171128_create_foreign_keys', 1),
(7, '2016_08_02_183143_add_slug_field_for_discussions', 1),
(8, '2016_08_03_121747_add_color_row_to_chatter_discussions', 1),
(9, '2017_01_16_121747_add_markdown_and_lock_to_chatter_posts', 1),
(10, '2017_01_16_121747_create_chatter_user_discussion_pivot_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ifeanyi Osinakayah', 'ifeanyiosinakayah15@gmail.com', '$2y$10$lhHI2MYm2xNTt6OKyv1s/ev2zki7uLVOTVSEJRzYRF7L9DMQdi7Li', NULL, '2017-12-12 07:53:02', '2017-12-12 07:53:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chatter_categories`
--
ALTER TABLE `chatter_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chatter_discussion`
--
ALTER TABLE `chatter_discussion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chatter_discussion_slug_unique` (`slug`),
  ADD KEY `chatter_discussion_chatter_category_id_foreign` (`chatter_category_id`),
  ADD KEY `chatter_discussion_user_id_foreign` (`user_id`);

--
-- Indexes for table `chatter_post`
--
ALTER TABLE `chatter_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chatter_post_chatter_discussion_id_foreign` (`chatter_discussion_id`),
  ADD KEY `chatter_post_user_id_foreign` (`user_id`);

--
-- Indexes for table `chatter_user_discussion`
--
ALTER TABLE `chatter_user_discussion`
  ADD PRIMARY KEY (`user_id`,`discussion_id`),
  ADD KEY `chatter_user_discussion_user_id_index` (`user_id`),
  ADD KEY `chatter_user_discussion_discussion_id_index` (`discussion_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chatter_categories`
--
ALTER TABLE `chatter_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `chatter_discussion`
--
ALTER TABLE `chatter_discussion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `chatter_post`
--
ALTER TABLE `chatter_post`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `chatter_discussion`
--
ALTER TABLE `chatter_discussion`
  ADD CONSTRAINT `chatter_discussion_chatter_category_id_foreign` FOREIGN KEY (`chatter_category_id`) REFERENCES `chatter_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chatter_discussion_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chatter_post`
--
ALTER TABLE `chatter_post`
  ADD CONSTRAINT `chatter_post_chatter_discussion_id_foreign` FOREIGN KEY (`chatter_discussion_id`) REFERENCES `chatter_discussion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `chatter_post_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `chatter_user_discussion`
--
ALTER TABLE `chatter_user_discussion`
  ADD CONSTRAINT `chatter_user_discussion_discussion_id_foreign` FOREIGN KEY (`discussion_id`) REFERENCES `chatter_discussion` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chatter_user_discussion_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
