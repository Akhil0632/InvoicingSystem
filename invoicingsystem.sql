-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 10:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoicingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_code` varchar(255) NOT NULL,
  `invoice_date` datetime NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `notes` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `vat_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_code`, `invoice_date`, `customer_name`, `customer_address`, `notes`, `total_amount`, `vat_amount`, `discount_amount`, `grand_total`, `created_at`, `updated_at`) VALUES
(1, 'INV-67651BAC4404B', '2024-12-20 07:24:28', 'John Doe', 'Kodungallur, Thrissur', 'Advance 500 paid', 950.00, 47.50, 197.00, 800.50, '2024-12-20 01:54:28', '2024-12-20 01:54:28'),
(2, 'INV-676538125FE2E', '2024-12-20 09:25:38', 'Mike Tyson', 'Edapally, Ernakulam', 'Full paid', 1000.00, 50.00, 150.00, 900.00, '2024-12-20 03:55:38', '2024-12-20 03:55:38'),
(3, 'INV-67653BB7670E6', '2024-12-20 09:41:11', 'Chris Evans', 'Chalakkudy, Thrissur', 'Nothing paid', 1350.00, 67.50, 200.00, 1217.50, '2024-12-20 04:11:11', '2024-12-20 04:11:11'),
(4, 'INV-67653C3C40D04', '2024-12-20 09:43:24', 'Jane Smith', 'Vyitilla, Ernakulam', 'Half amount paid', 1625.00, 81.25, 300.00, 1406.25, '2024-12-20 04:13:24', '2024-12-20 04:13:24'),
(5, 'INV-67653D127688C', '2024-12-20 09:46:58', 'Emma Watson', 'Mala, Thrissur', 'Advance 200 paid', 800.00, 40.00, 100.00, 740.00, '2024-12-20 04:16:58', '2024-12-20 04:16:58');

-- --------------------------------------------------------

--
-- Table structure for table `invoices_services`
--

CREATE TABLE `invoices_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `invoice_id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) DEFAULT NULL,
  `hours` int(11) DEFAULT NULL,
  `hourly_rate` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices_services`
--

INSERT INTO `invoices_services` (`id`, `invoice_id`, `service_name`, `hours`, `hourly_rate`, `amount`, `created_at`, `updated_at`) VALUES
(1, 1, 'Football', 3, 150.00, 450.00, '2024-12-20 01:54:28', '2024-12-20 01:54:28'),
(2, 1, 'Badminton', 1, 100.00, 100.00, '2024-12-20 01:54:28', '2024-12-20 01:54:28'),
(3, 1, 'Cricket', 2, 200.00, 400.00, '2024-12-20 01:54:28', '2024-12-20 01:54:28'),
(4, 2, 'Badminton', 1, 100.00, 100.00, '2024-12-20 03:55:38', '2024-12-20 03:55:38'),
(5, 2, 'Swimming Pool', 3, 200.00, 600.00, '2024-12-20 03:55:38', '2024-12-20 03:55:38'),
(6, 2, 'Football', 2, 150.00, 300.00, '2024-12-20 03:55:39', '2024-12-20 03:55:39'),
(7, 3, 'Swimming Pool', 2, 200.00, 400.00, '2024-12-20 04:11:11', '2024-12-20 04:11:11'),
(8, 3, 'Tennis', 1, 125.00, 125.00, '2024-12-20 04:11:12', '2024-12-20 04:11:12'),
(9, 3, 'Cricket', 3, 175.00, 525.00, '2024-12-20 04:11:12', '2024-12-20 04:11:12'),
(10, 3, 'Football', 2, 150.00, 300.00, '2024-12-20 04:11:12', '2024-12-20 04:11:12'),
(11, 4, 'Football', 4, 150.00, 600.00, '2024-12-20 04:13:24', '2024-12-20 04:13:24'),
(12, 4, 'Cricket', 2, 175.00, 350.00, '2024-12-20 04:13:24', '2024-12-20 04:13:24'),
(13, 4, 'Swimming Pool', 1, 200.00, 200.00, '2024-12-20 04:13:25', '2024-12-20 04:13:25'),
(14, 4, 'Tennis', 3, 125.00, 375.00, '2024-12-20 04:13:26', '2024-12-20 04:13:26'),
(15, 4, 'Badminton', 1, 100.00, 100.00, '2024-12-20 04:13:26', '2024-12-20 04:13:26'),
(16, 5, 'Swimming Pool', 4, 200.00, 800.00, '2024-12-20 04:16:58', '2024-12-20 04:16:58');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(30, '2014_10_12_000000_create_users_table', 1),
(31, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(32, '2019_08_19_000000_create_failed_jobs_table', 1),
(33, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(34, '2024_12_17_163406_create_invoices_table', 1),
(35, '2024_12_19_062545_create_invoices_services_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_code_unique` (`invoice_code`);

--
-- Indexes for table `invoices_services`
--
ALTER TABLE `invoices_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoices_services_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `invoices_services`
--
ALTER TABLE `invoices_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices_services`
--
ALTER TABLE `invoices_services`
  ADD CONSTRAINT `invoices_services_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
