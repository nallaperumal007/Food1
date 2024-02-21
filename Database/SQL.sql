-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2022 at 02:46 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `whatsapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant` int(11) NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_id` bigint(20) UNSIGNED NOT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extras_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extras_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extras_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variants_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variants_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variants_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_available` int(11) NOT NULL DEFAULT 1 COMMENT '1 = Yes . 2 = No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `restaurant` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Yes,2=No',
  `is_available` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Yes,2=No',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Yes,2=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) NOT NULL,
  `restaurant` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `price` varchar(255) NOT NULL,
  `active_from` varchar(255) NOT NULL,
  `active_to` varchar(255) NOT NULL,
  `limit` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryareas`
--

CREATE TABLE `deliveryareas` (
  `id` int(11) NOT NULL,
  `restaurant` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `slug` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `extras`
--

CREATE TABLE `extras` (
  `id` int(11) NOT NULL,
  `restaurant` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `slug` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `restaurant` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `item_name` text NOT NULL,
  `description` text NOT NULL,
  `item_price` float NOT NULL,
  `image` varchar(255) NOT NULL,
  `tax` float DEFAULT 0,
  `slug` text DEFAULT NULL,
  `is_available` int(11) NOT NULL DEFAULT 1,
  `has_variants` int(11) NOT NULL DEFAULT 2,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, '2021_12_20_101946_create_settings_table', 2),
(3, '2021_12_20_121616_create_categories_table', 3),
(4, '2021_12_22_072131_create_cuisines_table', 4),
(5, '2021_12_23_065134_create_menuses_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant` int(11) NOT NULL,
  `order_number` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_id` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `grand_total` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_type` int(11) NOT NULL DEFAULT 1 COMMENT '1 = Delivery , 2 = Pickup',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `building` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landmark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_charge` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `couponcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `is_notification` int(11) NOT NULL DEFAULT 1 COMMENT '1 = Unread , 2 = Read',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extras_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extras_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extras_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variants_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variants_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `variants_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `restaurant` int(11) DEFAULT NULL,
  `payment_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `public_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `secret_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encryption_key` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `environment` int(11) NOT NULL,
  `bank_name` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `restaurant`, `payment_name`, `public_key`, `secret_key`, `encryption_key`, `environment`, `bank_name`, `account_number`, `account_holder_name`, `ifsc`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'COD', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, 1, '2021-09-03 17:36:58', '2021-09-03 17:36:58'),
(2, NULL, 'RazorPay', 'rzp_test_4r8y0wDMkrUDFn', 'nEDuJlpL3x2BqHxYlQBYtrto', NULL, 1, NULL, NULL, NULL, NULL, 1, '2021-09-03 17:36:58', '2022-05-25 12:45:49'),
(3, NULL, 'Stripe', 'pk_test_51IjNgIJwZppK21ZQa6e7ZVOImwJ2auI54TD6xHici94u7DD5mhGf1oaBiDyL9mX7PbN5nt6Weap4tmGWLRIrslCu00d8QgQ3nI', 'sk_test_51IjNgIJwZppK21ZQK85uLARMdhtuuhA81PB24VDfiqSW8SXQZKrZzvbpIkigEb27zZPBMF4UEG7PK9587Xresuc000x8CdE22A', NULL, 1, NULL, NULL, NULL, NULL, 1, '2021-09-03 17:36:58', '2022-05-25 19:54:43'),
(4, NULL, 'Flutterwave', 'FLWPUBK_TEST-61c94068c4a44548a771cc7cf9548d05-X', 'FLWSECK_TEST-1140781769b7bd5cfd6b3fb6d5704017-X', 'FLWSECK_TEST863a39eb1475', 1, NULL, NULL, NULL, NULL, 1, '2021-10-22 10:58:05', '2021-09-03 18:27:02'),
(5, NULL, 'Paystack', 'pk_test_8a6a139a3bae6e41cbbbc41f4d7b65d4da9f7967', 'sk_test_6ab143b6f0c2a209373adeef55a64411c1a91ae9', NULL, 1, NULL, NULL, NULL, NULL, 1, '2021-10-22 10:58:12', '2021-09-03 18:27:02'),
(6, NULL, 'Bank transfer', NULL, NULL, NULL, 0, 'Axis Bank', '1122334455667788', 'John Doe', 'AA112233', 1, '2021-10-22 10:58:12', '2022-09-03 01:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` longtext NOT NULL,
  `features` longtext NOT NULL,
  `price` float NOT NULL,
  `item_unit` int(11) NOT NULL,
  `plan_period` varchar(255) NOT NULL,
  `order_limit` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 2 COMMENT '1=Yes,2=No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `privacypolicy`
--

CREATE TABLE `privacypolicy` (
  `id` int(11) NOT NULL,
  `restaurant` int(11) NOT NULL,
  `privacypolicy_content` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `restaurant` int(11) NOT NULL,
  `currency` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency_position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default-logo.png',
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default-favicon.png',
  `delivery_type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timezone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `copyright` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `og_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'default-og.png',
  `facebook_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `linkedin_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `whatsapp_widget` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `whatsapp_message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `language` int(11) NOT NULL DEFAULT 1,
  `template` int(11) NOT NULL DEFAULT 1,
  `primary_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#171a29',
  `secondary_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#171a29',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `restaurant`, `currency`, `currency_position`, `logo`, `favicon`, `delivery_type`, `timezone`, `address`, `email`, `description`, `contact`, `copyright`, `website_title`, `meta_title`, `meta_description`, `og_image`, `facebook_link`, `twitter_link`, `instagram_link`, `linkedin_link`, `whatsapp_widget`, `whatsapp_message`, `item_message`, `language`, `template`, `primary_color`, `secondary_color`, `created_at`, `updated_at`) VALUES
(1, 1, '$', 'left', 'default-logo.png', 'default-favicon.png', '', 'Asia/Kolkata', '', '', '', '', '2021 @ all rights reserved', 'WhatsApp Food', '', '', 'default-og.png', '', '', '', '', '', '', '', 1, 1, '#171a29', '#171a29', NULL, '2022-08-27 06:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `systemaddons`
--

CREATE TABLE `systemaddons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `unique_identifier` varchar(255) NOT NULL,
  `version` varchar(20) NOT NULL,
  `activated` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `table_book`
--

CREATE TABLE `table_book` (
  `id` int(11) NOT NULL,
  `restaurant` int(11) NOT NULL,
  `type_of_event` varchar(255) DEFAULT NULL,
  `no_of_people` varchar(255) DEFAULT NULL,
  `date_of_event` varchar(255) DEFAULT NULL,
  `time_required` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `additional_requests` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `restaurant` int(11) NOT NULL,
  `terms_content` longtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `timings`
--

CREATE TABLE `timings` (
  `id` int(11) NOT NULL,
  `restaurant` int(11) NOT NULL,
  `day` varchar(50) NOT NULL,
  `open_time` varchar(30) NOT NULL,
  `close_time` varchar(30) NOT NULL,
  `is_always_close` tinyint(1) NOT NULL COMMENT '1 For Yes, 2 For No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `restaurant` int(11) NOT NULL,
  `plan` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `payment_id` text DEFAULT NULL,
  `screenshot` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `payment_type` int(11) NOT NULL,
  `plan_period` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 = Pending, 2 = Approved , 3 = Rejected',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(1) NOT NULL COMMENT '1=Admin,2=vendor,3=driver,4=User/Customer',
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `free_plan` int(11) NOT NULL DEFAULT 0,
  `is_delivery` tinyint(1) DEFAULT NULL COMMENT '1=Yes,2=No',
  `is_verified` tinyint(1) NOT NULL COMMENT '1=Yes,2=No',
  `is_available` tinyint(1) NOT NULL COMMENT '1=Yes,2=No',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `slug`, `email`, `mobile`, `image`, `password`, `login_type`, `type`, `description`, `token`, `otp`, `payment_id`, `plan`, `purchase_amount`, `purchase_date`, `payment_type`, `free_plan`, `is_delivery`, `is_verified`, `is_available`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin-3', 'admin@gmail.com', '1234567890', 'default.png', '$2y$10$vLrqNcEXtnIe2OZKl11gC.ie6.YpQs1QgGKTPN.h671DO/9JO7HqW', 'email', 1, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, 0, NULL, 1, 1, NULL, '2022-08-16 04:31:17', '2022-08-16 04:31:17'),
(2, 'john martin', 'john-martin', 'vendor@yopmail.com', '4646464646', 'default-logo.png', '$2y$10$ZAl9uJslQRE/2vuMoPd3H./oAvAlTw2kwrXVZYQwMk5FzPincbd/q', 'email', 2, NULL, NULL, NULL, 'pay_KNInOWzXlqYK2Y', 'Advance', '29', '2022-09-28 04:52:31pm', 2, 1, NULL, 2, 1, NULL, '2022-09-26 14:11:43', '2022-09-28 11:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `variants`
--

CREATE TABLE `variants` (
  `id` int(11) NOT NULL,
  `restaurant` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `slug` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_item_id_foreign` (`item_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deliveryareas`
--
ALTER TABLE `deliveryareas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `extras`
--
ALTER TABLE `extras`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacypolicy`
--
ALTER TABLE `privacypolicy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `systemaddons`
--
ALTER TABLE `systemaddons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_book`
--
ALTER TABLE `table_book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timings`
--
ALTER TABLE `timings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variants`
--
ALTER TABLE `variants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deliveryareas`
--
ALTER TABLE `deliveryareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extras`
--
ALTER TABLE `extras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privacypolicy`
--
ALTER TABLE `privacypolicy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `systemaddons`
--
ALTER TABLE `systemaddons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_book`
--
ALTER TABLE `table_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `timings`
--
ALTER TABLE `timings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `variants`
--
ALTER TABLE `variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
