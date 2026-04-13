-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2026 at 10:55 AM
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
-- Database: `tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `absents`
--

CREATE TABLE `absents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `partial_leave` tinyint(1) DEFAULT 0,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `total_days` int(11) NOT NULL,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `reason` varchar(1000) NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `absents`
--

INSERT INTO `absents` (`id`, `user_id`, `partial_leave`, `from_date`, `to_date`, `total_days`, `from_time`, `to_time`, `reason`, `status`, `created_by`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(111, 4, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(112, 6, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(113, 8, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(114, 10, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(115, 12, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(116, 13, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(117, 14, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(118, 15, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(119, 16, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(120, 17, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(121, 18, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(122, 19, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(123, 20, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(124, 22, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(125, 23, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(126, 24, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(127, 25, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(128, 26, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(129, 27, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(130, 42, 0, '2026-03-07', '2026-03-07', 1, NULL, NULL, 'Missing Check in and Out', 'approved', NULL, NULL, NULL, '2026-03-07 02:14:21', '2026-03-07 02:14:21');

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(161) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(161) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(161) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext DEFAULT NULL,
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'New Client created.', 'New Client Ahmed Ullah shuvo created.', 'App\\Models\\Client', NULL, 1, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:20:39', '2026-01-27 11:20:39'),
(2, 'Project Assign To User', 'Assigned innodemy.com to Abid Hasan', 'App\\Models\\Project', NULL, 1, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 11:21:14', '2026-01-27 11:21:14'),
(3, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 1, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" innodemy.com\"}', NULL, '2026-01-27 11:21:14', '2026-01-27 11:21:14'),
(4, 'Project Assignee Updated', 'Assigned innodemy.com to Al Mamun', 'App\\Models\\Project', NULL, 1, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 11:30:37', '2026-01-27 11:30:37'),
(5, 'Task Created', 'Created new task Ongoing DM Service', 'App\\Models\\Project', NULL, 1, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of innodemy.com\"}', NULL, '2026-01-27 11:41:01', '2026-01-27 11:41:01'),
(6, 'New Client created.', 'New Client Yellow Shopee created.', 'App\\Models\\Client', NULL, 2, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:47:21', '2026-01-27 11:47:21'),
(7, 'New Client created.', 'New Client Fit Elegant Gym created.', 'App\\Models\\Client', NULL, 3, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:47:47', '2026-01-27 11:47:47'),
(8, 'New Client created.', 'New Client buyingbd created.', 'App\\Models\\Client', NULL, 4, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:48:00', '2026-01-27 11:48:00'),
(9, 'New Client created.', 'New Client Hurramlifestyle created.', 'App\\Models\\Client', NULL, 5, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:48:11', '2026-01-27 11:48:11'),
(10, 'New Client created.', 'New Client Sunnah Fashion created.', 'App\\Models\\Client', NULL, 6, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:48:21', '2026-01-27 11:48:21'),
(11, 'New Client created.', 'New Client The Toy Cart created.', 'App\\Models\\Client', NULL, 7, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:48:23', '2026-01-27 11:48:23'),
(12, 'New Client created.', 'New Client Fashioncraftbd created.', 'App\\Models\\Client', NULL, 8, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:49:15', '2026-01-27 11:49:15'),
(13, 'New Client created.', 'New Client Sunnah Fashion created.', 'App\\Models\\Client', NULL, 9, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:49:16', '2026-01-27 11:49:16'),
(14, 'Project Assign To User', 'Assigned Sunnah Fashion to Md. Mahim', 'App\\Models\\Project', NULL, 2, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 11:49:22', '2026-01-27 11:49:22'),
(15, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 2, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Sunnah Fashion\"}', NULL, '2026-01-27 11:49:22', '2026-01-27 11:49:22'),
(16, 'New Client created.', 'New Client Apon Mart created.', 'App\\Models\\Client', NULL, 10, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:49:28', '2026-01-27 11:49:28'),
(17, 'New Client created.', 'New Client SOR Traders created.', 'App\\Models\\Client', NULL, 11, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:49:43', '2026-01-27 11:49:43'),
(18, 'New Client created.', 'New Client Applegenbd created.', 'App\\Models\\Client', NULL, 12, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:49:55', '2026-01-27 11:49:55'),
(19, 'New Client created.', 'New Client Ecomaze Eastern created.', 'App\\Models\\Client', NULL, 13, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:50:42', '2026-01-27 11:50:42'),
(20, 'Task Created', 'Created new task ongoing', 'App\\Models\\Project', NULL, 2, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Sunnah Fashion\"}', NULL, '2026-01-27 11:54:33', '2026-01-27 11:54:33'),
(21, 'New Client created.', 'New Client Flex Leather created.', 'App\\Models\\Client', NULL, 14, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:55:49', '2026-01-27 11:55:49'),
(22, 'New Client created.', 'New Client Trustyshop created.', 'App\\Models\\Client', NULL, 15, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:56:04', '2026-01-27 11:56:04'),
(23, 'New Client created.', 'New Client Fast Bag Bazar created.', 'App\\Models\\Client', NULL, 16, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:56:17', '2026-01-27 11:56:17'),
(24, 'New Client created.', 'New Client naturalfoodhouse created.', 'App\\Models\\Client', NULL, 17, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:56:30', '2026-01-27 11:56:30'),
(25, 'New Client created.', 'New Client Powernest BD created.', 'App\\Models\\Client', NULL, 18, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:56:33', '2026-01-27 11:56:33'),
(26, 'New Client created.', 'New Client Trustyshop created.', 'App\\Models\\Client', NULL, 19, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:56:47', '2026-01-27 11:56:47'),
(27, 'New Client created.', 'New Client Shuddho Mart created.', 'App\\Models\\Client', NULL, 20, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 11:56:48', '2026-01-27 11:56:48'),
(28, 'Project Assign To User', 'Assigned Flex Leather to Abid Hasan', 'App\\Models\\Project', NULL, 3, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 11:57:21', '2026-01-27 11:57:21'),
(29, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 3, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Flex Leather\"}', NULL, '2026-01-27 11:57:21', '2026-01-27 11:57:21'),
(30, 'Task Created', 'Created new task Ongoing', 'App\\Models\\Project', NULL, 3, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Flex Leather\"}', NULL, '2026-01-27 11:57:55', '2026-01-27 11:57:55'),
(31, 'Project Assign To User', 'Assigned Trustyshop to Abid Hasan', 'App\\Models\\Project', NULL, 4, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 11:58:18', '2026-01-27 11:58:18'),
(32, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 4, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Trustyshop\"}', NULL, '2026-01-27 11:58:18', '2026-01-27 11:58:18'),
(33, 'Task Created', 'Created new task Ongoing', 'App\\Models\\Project', NULL, 4, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Trustyshop\"}', NULL, '2026-01-27 11:58:54', '2026-01-27 11:58:54'),
(34, 'Project Assign To User', 'Assigned Fast Bag Bazar to Abid Hasan', 'App\\Models\\Project', NULL, 5, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 11:59:22', '2026-01-27 11:59:22'),
(35, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 5, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Fast Bag Bazar\"}', NULL, '2026-01-27 11:59:22', '2026-01-27 11:59:22'),
(36, 'Task Created', 'Created new task Ongoing', 'App\\Models\\Project', NULL, 5, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Fast Bag Bazar\"}', NULL, '2026-01-27 12:00:13', '2026-01-27 12:00:13'),
(37, 'Project Assign To User', 'Assigned Powernest BD to Abid Hasan', 'App\\Models\\Project', NULL, 6, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:00:34', '2026-01-27 12:00:34'),
(38, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 6, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Powernest BD\"}', NULL, '2026-01-27 12:00:34', '2026-01-27 12:00:34'),
(39, 'Task Created', 'Created new task Ongoing', 'App\\Models\\Project', NULL, 6, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Powernest BD\"}', NULL, '2026-01-27 12:01:05', '2026-01-27 12:01:05'),
(40, 'Project Assignee Updated', 'Assigned Flex Leather to Md. Mahim', 'App\\Models\\Project', NULL, 3, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:02:37', '2026-01-27 12:02:37'),
(41, 'Project Assignee Updated', 'Assigned Trustyshop to Md. Mahim', 'App\\Models\\Project', NULL, 4, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:02:41', '2026-01-27 12:02:41'),
(42, 'Project Assignee Updated', 'Assigned Fast Bag Bazar to Md. Mahim', 'App\\Models\\Project', NULL, 5, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:02:46', '2026-01-27 12:02:46'),
(43, 'Project Assignee Updated', 'Assigned Powernest BD to Md. Mahim', 'App\\Models\\Project', NULL, 6, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:02:50', '2026-01-27 12:02:50'),
(44, 'Project Assignee Updated', 'Assigned Sunnah Fashion to Abid Hasan', 'App\\Models\\Project', NULL, 2, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:02:58', '2026-01-27 12:02:58'),
(45, 'Project Assignee Updated', 'Assigned innodemy.com to Md. Mahim', 'App\\Models\\Project', NULL, 1, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:03:04', '2026-01-27 12:03:04'),
(46, 'New Client created.', 'New Client Storola created.', 'App\\Models\\Client', NULL, 21, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 12:04:00', '2026-01-27 12:04:00'),
(47, 'Project Assign To User', 'Assigned Tracker to Sagor Biswas,Didarul Alam,Shafa khan,Raiyan Ahmed Akib', 'App\\Models\\Project', NULL, 7, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:04:08', '2026-01-27 12:04:08'),
(48, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 7, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Tracker\"}', NULL, '2026-01-27 12:04:08', '2026-01-27 12:04:08'),
(49, 'New Client created.', 'New Client lavogos created.', 'App\\Models\\Client', NULL, 22, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 12:04:19', '2026-01-27 12:04:19'),
(50, 'Project Assign To User', 'Assigned lavogos to Abid Hasan', 'App\\Models\\Project', NULL, 8, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:05:18', '2026-01-27 12:05:18'),
(51, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 8, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" lavogos\"}', NULL, '2026-01-27 12:05:18', '2026-01-27 12:05:18'),
(52, 'New Client created.', 'New Client khalisfood created.', 'App\\Models\\Client', NULL, 23, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 12:06:54', '2026-01-27 12:06:54'),
(53, 'Project Assign To User', 'Assigned khalisfood to Abid Hasan', 'App\\Models\\Project', NULL, 9, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:07:49', '2026-01-27 12:07:49'),
(54, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 9, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" khalisfood\"}', NULL, '2026-01-27 12:07:49', '2026-01-27 12:07:49'),
(55, 'Project Assign To User', 'Assigned Shuddho Mart to Abid Hasan', 'App\\Models\\Project', NULL, 10, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:08:10', '2026-01-27 12:08:10'),
(56, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 10, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Shuddho Mart\"}', NULL, '2026-01-27 12:08:10', '2026-01-27 12:08:10'),
(57, 'Project Assign To User', 'Assigned naturalfoodhouse to Abid Hasan', 'App\\Models\\Project', NULL, 11, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:08:30', '2026-01-27 12:08:30'),
(58, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 11, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" naturalfoodhouse\"}', NULL, '2026-01-27 12:08:30', '2026-01-27 12:08:30'),
(59, 'Project Assign To User', 'Assigned Ecomaze Eastern to Abid Hasan', 'App\\Models\\Project', NULL, 12, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:08:48', '2026-01-27 12:08:48'),
(60, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 12, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Ecomaze Eastern\"}', NULL, '2026-01-27 12:08:48', '2026-01-27 12:08:48'),
(61, 'Project Assign To User', 'Assigned Applegenbd to Abid Hasan', 'App\\Models\\Project', NULL, 13, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:09:11', '2026-01-27 12:09:11'),
(62, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 13, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Applegenbd\"}', NULL, '2026-01-27 12:09:11', '2026-01-27 12:09:11'),
(63, 'Project Assign To User', 'Assigned SOR Traders to Abid Hasan', 'App\\Models\\Project', NULL, 14, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:09:32', '2026-01-27 12:09:32'),
(64, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 14, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" SOR Traders\"}', NULL, '2026-01-27 12:09:32', '2026-01-27 12:09:32'),
(65, 'Project Assign To User', 'Assigned Apon Mart to Abid Hasan', 'App\\Models\\Project', NULL, 15, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:09:51', '2026-01-27 12:09:51'),
(66, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 15, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Apon Mart\"}', NULL, '2026-01-27 12:09:51', '2026-01-27 12:09:51'),
(67, 'Project Assign To User', 'Assigned Fashioncraftbd to Abid Hasan', 'App\\Models\\Project', NULL, 16, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:10:10', '2026-01-27 12:10:10'),
(68, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 16, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Fashioncraftbd\"}', NULL, '2026-01-27 12:10:10', '2026-01-27 12:10:10'),
(69, 'Project Assign To User', 'Assigned The Toy Cart to Abid Hasan', 'App\\Models\\Project', NULL, 17, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:10:26', '2026-01-27 12:10:26'),
(70, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 17, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" The Toy Cart\"}', NULL, '2026-01-27 12:10:26', '2026-01-27 12:10:26'),
(71, 'Project Assign To User', 'Assigned Hurramlifestyle to Abid Hasan', 'App\\Models\\Project', NULL, 18, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:10:42', '2026-01-27 12:10:42'),
(72, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 18, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Hurramlifestyle\"}', NULL, '2026-01-27 12:10:42', '2026-01-27 12:10:42'),
(73, 'Project Assign To User', 'Assigned buyingbd to Abid Hasan', 'App\\Models\\Project', NULL, 19, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:10:59', '2026-01-27 12:10:59'),
(74, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 19, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" buyingbd\"}', NULL, '2026-01-27 12:10:59', '2026-01-27 12:10:59'),
(75, 'Project Assign To User', 'Assigned Fit Elegant Gym to Abid Hasan', 'App\\Models\\Project', NULL, 20, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:12:08', '2026-01-27 12:12:08'),
(76, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 20, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Fit Elegant Gym\"}', NULL, '2026-01-27 12:12:08', '2026-01-27 12:12:08'),
(77, 'Project Assign To User', 'Assigned Yellow Shopee to Abid Hasan', 'App\\Models\\Project', NULL, 21, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:12:33', '2026-01-27 12:12:33'),
(78, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 21, 'App\\Models\\User', 22, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Yellow Shopee\"}', NULL, '2026-01-27 12:12:33', '2026-01-27 12:12:33'),
(79, 'New Client created.', 'New Client MASH created.', 'App\\Models\\Client', NULL, 24, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 12:14:32', '2026-01-27 12:14:32'),
(80, 'Project Assign To User', 'Assigned mashlifestyle to Shamim Ahmmed', 'App\\Models\\Project', NULL, 22, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:15:38', '2026-01-27 12:15:38'),
(81, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 22, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" mashlifestyle\"}', NULL, '2026-01-27 12:15:38', '2026-01-27 12:15:38'),
(82, 'New Client created.', 'New Client Hasibul Hasan created.', 'App\\Models\\Client', NULL, 25, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 12:17:26', '2026-01-27 12:17:26'),
(83, 'Project Assign To User', 'Assigned qualitypackagingltd to Pavel Mahmud,Shamim Ahmmed', 'App\\Models\\Project', NULL, 23, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:18:20', '2026-01-27 12:18:20'),
(84, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 23, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" qualitypackagingltd\"}', NULL, '2026-01-27 12:18:20', '2026-01-27 12:18:20'),
(85, 'New Client created.', 'New Client Sabbir Hossain created.', 'App\\Models\\Client', NULL, 26, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 12:20:32', '2026-01-27 12:20:32'),
(86, 'Project Assign To User', 'Assigned basantoshop to Shamim Ahmmed', 'App\\Models\\Project', NULL, 24, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:21:15', '2026-01-27 12:21:15'),
(87, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 24, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" basantoshop\"}', NULL, '2026-01-27 12:21:15', '2026-01-27 12:21:15'),
(88, 'New Client created.', 'New Client Masud created.', 'App\\Models\\Client', NULL, 27, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 12:25:01', '2026-01-27 12:25:01'),
(89, 'New Client created.', 'New Client Ahmed Foysal created.', 'App\\Models\\Client', NULL, 28, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 12:26:48', '2026-01-27 12:26:48'),
(90, 'Project Assign To User', 'Assigned Flydropbd to Shafa khan', 'App\\Models\\Project', NULL, 25, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:27:35', '2026-01-27 12:27:35'),
(91, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 25, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Flydropbd\"}', NULL, '2026-01-27 12:27:35', '2026-01-27 12:27:35'),
(92, 'Project Assign To User', 'Assigned Haat Bazaar to Shamim Ahmmed', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:27:37', '2026-01-27 12:27:37'),
(93, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Haat Bazaar\"}', NULL, '2026-01-27 12:27:38', '2026-01-27 12:27:38'),
(94, 'New Client created.', 'New Client Rakib created.', 'App\\Models\\Client', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 12:29:07', '2026-01-27 12:29:07'),
(95, 'Project Assign To User', 'Assigned edhakamartbd to Shamim Ahmmed', 'App\\Models\\Project', NULL, 27, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:30:07', '2026-01-27 12:30:07'),
(96, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 27, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" edhakamartbd\"}', NULL, '2026-01-27 12:30:07', '2026-01-27 12:30:07'),
(97, 'New Client created.', 'New Client Rafiqul Islam created.', 'App\\Models\\Client', NULL, 30, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 12:31:35', '2026-01-27 12:31:35'),
(98, 'Project Assign To User', 'Assigned Storola Archive to Sagor Biswas,Ahnaf Shoumik,Didarul Alam,Shafa khan,Raiyan Ahmed Akib', 'App\\Models\\Project', NULL, 28, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:35:14', '2026-01-27 12:35:14'),
(99, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 28, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Archive\"}', NULL, '2026-01-27 12:35:14', '2026-01-27 12:35:14'),
(100, 'Project Assign To User', 'Assigned Storola Tracker to Sagor Biswas,Ahnaf Shoumik,Didarul Alam,Shafa khan,Raiyan Ahmed Akib', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:40:05', '2026-01-27 12:40:05'),
(101, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Tracker\"}', NULL, '2026-01-27 12:40:05', '2026-01-27 12:40:05'),
(102, 'Project Assign To User', 'Assigned Storola TagBuckets to Sagor Biswas,Ahnaf Shoumik,Didarul Alam,Shafa khan,Raiyan Ahmed Akib', 'App\\Models\\Project', NULL, 30, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:41:29', '2026-01-27 12:41:29'),
(103, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 30, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola TagBuckets\"}', NULL, '2026-01-27 12:41:29', '2026-01-27 12:41:29'),
(104, 'Project Assign To User', 'Assigned Storola Academy to Sagor Biswas,Ahnaf Shoumik,Didarul Alam,Shafa khan,Raiyan Ahmed Akib', 'App\\Models\\Project', NULL, 31, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:42:41', '2026-01-27 12:42:41'),
(105, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 31, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Academy\"}', NULL, '2026-01-27 12:42:41', '2026-01-27 12:42:41'),
(106, 'Project Assign To User', 'Assigned Storola Business to Sagor Biswas,Ahnaf Shoumik,Didarul Alam,Shafa khan,Raiyan Ahmed Akib', 'App\\Models\\Project', NULL, 32, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:44:07', '2026-01-27 12:44:07'),
(107, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 32, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Business\"}', NULL, '2026-01-27 12:44:07', '2026-01-27 12:44:07'),
(108, 'Project Assign To User', 'Assigned Storola LP Builder to Sagor Biswas,Ahnaf Shoumik,Didarul Alam,Shafa khan,Raiyan Ahmed Akib', 'App\\Models\\Project', NULL, 33, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:46:10', '2026-01-27 12:46:10'),
(109, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 33, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola LP Builder\"}', NULL, '2026-01-27 12:46:10', '2026-01-27 12:46:10'),
(110, 'Project Assign To User', 'Assigned Storola Fraud Checker to Sagor Biswas,Ahnaf Shoumik,Didarul Alam,Shafa khan,Raiyan Ahmed Akib', 'App\\Models\\Project', NULL, 34, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:47:35', '2026-01-27 12:47:35'),
(111, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 34, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Fraud Checker\"}', NULL, '2026-01-27 12:47:35', '2026-01-27 12:47:35'),
(112, 'Task Created', 'Created new task Ongoing DM service', 'App\\Models\\Project', NULL, 21, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Yellow Shopee\"}', NULL, '2026-01-27 12:48:00', '2026-01-27 12:48:00'),
(113, 'Project Assign To User', 'Assigned Storola Mobile to Sagor Biswas,Ahnaf Shoumik,Didarul Alam,Shafa khan,Raiyan Ahmed Akib', 'App\\Models\\Project', NULL, 35, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:48:47', '2026-01-27 12:48:47'),
(114, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 35, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Mobile\"}', NULL, '2026-01-27 12:48:47', '2026-01-27 12:48:47'),
(115, 'Task Created', 'Created new task Ongoing DM Service', 'App\\Models\\Project', NULL, 20, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Fit Elegant Gym\"}', NULL, '2026-01-27 12:49:01', '2026-01-27 12:49:01'),
(116, 'Task Created', 'Created new task Ongoing DM Service', 'App\\Models\\Project', NULL, 19, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of buyingbd\"}', NULL, '2026-01-27 12:49:55', '2026-01-27 12:49:55'),
(117, 'Project Assign To User', 'Assigned Storola Saas to Sagor Biswas,Ahnaf Shoumik,Didarul Alam,Shafa khan,Raiyan Ahmed Akib', 'App\\Models\\Project', NULL, 36, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:50:20', '2026-01-27 12:50:20'),
(118, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 36, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Saas\"}', NULL, '2026-01-27 12:50:20', '2026-01-27 12:50:20'),
(119, 'Task Created', 'Created new task Ongoing DM Service', 'App\\Models\\Project', NULL, 18, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Hurramlifestyle\"}', NULL, '2026-01-27 12:50:30', '2026-01-27 12:50:30'),
(120, 'Task Created', 'Created new task Ongoing DM Service', 'App\\Models\\Project', NULL, 16, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Fashioncraftbd\"}', NULL, '2026-01-27 12:51:07', '2026-01-27 12:51:07'),
(121, 'Task Created', 'Created new task Ongoing DM Service', 'App\\Models\\Project', NULL, 14, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of SOR Traders\"}', NULL, '2026-01-27 12:51:55', '2026-01-27 12:51:55'),
(122, 'Task Created', 'Created new task Ongoing DM Service', 'App\\Models\\Project', NULL, 13, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Applegenbd\"}', NULL, '2026-01-27 12:52:29', '2026-01-27 12:52:29'),
(123, 'Project Assign To User', 'Assigned Roomchai to Sagor Biswas,Ahnaf Shoumik,Didarul Alam,Shafa khan,Raiyan Ahmed Akib', 'App\\Models\\Project', NULL, 37, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:52:37', '2026-01-27 12:52:37'),
(124, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 37, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Roomchai\"}', NULL, '2026-01-27 12:52:37', '2026-01-27 12:52:37'),
(125, 'Task Created', 'Created new task Ongoing DM Service', 'App\\Models\\Project', NULL, 12, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Ecomaze Eastern\"}', NULL, '2026-01-27 12:52:56', '2026-01-27 12:52:56'),
(126, 'Task Created', 'Created new task Ongoing DM Service', 'App\\Models\\Project', NULL, 11, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of naturalfoodhouse\"}', NULL, '2026-01-27 12:53:50', '2026-01-27 12:53:50'),
(127, 'Task Created', 'Created new task Ongoing DM Service', 'App\\Models\\Project', NULL, 10, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Shuddho Mart\"}', NULL, '2026-01-27 12:54:14', '2026-01-27 12:54:14'),
(128, 'Task Created', 'Created new task Ongoing DM Service', 'App\\Models\\Project', NULL, 8, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of lavogos\"}', NULL, '2026-01-27 12:54:46', '2026-01-27 12:54:46'),
(129, 'Task Created', 'Created new task Ongoing DM Service', 'App\\Models\\Project', NULL, 9, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of khalisfood\"}', NULL, '2026-01-27 12:55:06', '2026-01-27 12:55:06'),
(130, 'Project Assign To User', 'Assigned stylishbd.com to Sagor Biswas,Al Mamun', 'App\\Models\\Project', NULL, 38, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 12:57:17', '2026-01-27 12:57:17'),
(131, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 38, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" stylishbd.com\"}', NULL, '2026-01-27 12:57:17', '2026-01-27 12:57:17'),
(132, 'Task Created', 'Created new task 10. Pre-order status will be shown as Pre-Order', 'App\\Models\\Project', NULL, 38, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of stylishbd.com\"}', NULL, '2026-01-27 12:59:47', '2026-01-27 12:59:47'),
(133, 'Task Created', 'Created new task 12. Pre-order Button a click korle popup (policy) Show hobe . Popup kete dile order hobe.', 'App\\Models\\Project', NULL, 38, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of stylishbd.com\"}', NULL, '2026-01-27 13:00:26', '2026-01-27 13:00:26'),
(134, 'New Client created.', 'New Client Saikat created.', 'App\\Models\\Client', NULL, 31, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 13:13:32', '2026-01-27 13:13:32'),
(135, 'Project Assign To User', 'Assigned master sound to Pavel Mahmud', 'App\\Models\\Project', NULL, 39, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 13:14:06', '2026-01-27 13:14:06'),
(136, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 39, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" master sound\"}', NULL, '2026-01-27 13:14:06', '2026-01-27 13:14:06'),
(137, 'Task Created', 'Created new task Ongoing', 'App\\Models\\Project', NULL, 39, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of master sound\"}', NULL, '2026-01-27 13:14:37', '2026-01-27 13:14:37'),
(138, 'Project Assign To User', 'Assigned Miskinbd to Pavel Mahmud', 'App\\Models\\Project', NULL, 40, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 13:15:02', '2026-01-27 13:15:02'),
(139, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 40, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Miskinbd\"}', NULL, '2026-01-27 13:15:02', '2026-01-27 13:15:02'),
(140, 'Task Created', 'Created new task 1 Dev req due', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Haat Bazaar\"}', NULL, '2026-01-27 13:15:17', '2026-01-27 13:15:17'),
(141, 'Task Created', 'Created new task Ongoing', 'App\\Models\\Project', NULL, 40, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Miskinbd\"}', NULL, '2026-01-27 13:15:31', '2026-01-27 13:15:31'),
(142, 'Project Assignee Updated', 'Assigned Haat Bazaar to Sagor Biswas', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 13:15:50', '2026-01-27 13:15:50'),
(143, 'New Client created.', 'New Client Ferdaous created.', 'App\\Models\\Client', NULL, 32, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 13:17:17', '2026-01-27 13:17:17'),
(144, 'Project Assign To User', 'Assigned SOR Trraders to Pavel Mahmud', 'App\\Models\\Project', NULL, 41, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 13:18:55', '2026-01-27 13:18:55'),
(145, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 41, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" SOR Trraders\"}', NULL, '2026-01-27 13:18:55', '2026-01-27 13:18:55'),
(146, 'Task Created', 'Created new task Website Ongoing', 'App\\Models\\Project', NULL, 41, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of SOR Trraders\"}', NULL, '2026-01-27 13:19:24', '2026-01-27 13:19:24'),
(147, 'New Client created.', 'New Client Sunny created.', 'App\\Models\\Client', NULL, 33, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 13:20:09', '2026-01-27 13:20:09'),
(148, 'Project Assign To User', 'Assigned Huramlifestyle to Pavel Mahmud', 'App\\Models\\Project', NULL, 42, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 13:20:54', '2026-01-27 13:20:54'),
(149, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 42, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Huramlifestyle\"}', NULL, '2026-01-27 13:20:54', '2026-01-27 13:20:54'),
(150, 'Task Created', 'Created new task Website Gongoing', 'App\\Models\\Project', NULL, 42, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Huramlifestyle\"}', NULL, '2026-01-27 13:21:20', '2026-01-27 13:21:20'),
(151, 'New Client created.', 'New Client Md.Mohibul Islam created.', 'App\\Models\\Client', NULL, 34, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 13:22:06', '2026-01-27 13:22:06'),
(152, 'Project Assign To User', 'Assigned Lopacollection to Pavel Mahmud', 'App\\Models\\Project', NULL, 43, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 13:22:28', '2026-01-27 13:22:28'),
(153, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 43, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Lopacollection\"}', NULL, '2026-01-27 13:22:28', '2026-01-27 13:22:28'),
(154, 'Task Created', 'Created new task Ongoin', 'App\\Models\\Project', NULL, 43, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Lopacollection\"}', NULL, '2026-01-27 13:23:29', '2026-01-27 13:23:29'),
(155, 'New Client created.', 'New Client Tanvir created.', 'App\\Models\\Client', NULL, 35, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 13:26:13', '2026-01-27 13:26:13'),
(156, 'Project Assign To User', 'Assigned Denimisia to Pavel Mahmud', 'App\\Models\\Project', NULL, 44, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 13:26:36', '2026-01-27 13:26:36'),
(157, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 44, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Denimisia\"}', NULL, '2026-01-27 13:26:36', '2026-01-27 13:26:36'),
(158, 'Task Created', 'Created new task Ongoing', 'App\\Models\\Project', NULL, 44, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Denimisia\"}', NULL, '2026-01-27 13:26:55', '2026-01-27 13:26:55'),
(159, 'New Client created.', 'New Client MD RAEES AHMED ROCKY created.', 'App\\Models\\Client', NULL, 36, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 13:28:35', '2026-01-27 13:28:35'),
(160, 'Project Assign To User', 'Assigned raeestrading to Pavel Mahmud', 'App\\Models\\Project', NULL, 45, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 13:28:58', '2026-01-27 13:28:58'),
(161, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 45, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" raeestrading\"}', NULL, '2026-01-27 13:28:58', '2026-01-27 13:28:58'),
(162, 'Task Created', 'Created new task Ongoing', 'App\\Models\\Project', NULL, 45, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of raeestrading\"}', NULL, '2026-01-27 13:29:15', '2026-01-27 13:29:15'),
(163, 'New Client created.', 'New Client Naazzo created.', 'App\\Models\\Client', NULL, 37, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-27 13:30:09', '2026-01-27 13:30:09'),
(164, 'Project Assign To User', 'Assigned Naazzo to Pavel Mahmud', 'App\\Models\\Project', NULL, 46, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-27 13:30:23', '2026-01-27 13:30:23'),
(165, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 46, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Naazzo\"}', NULL, '2026-01-27 13:30:23', '2026-01-27 13:30:23'),
(166, 'Task Created', 'Created new task Ongoing', 'App\\Models\\Project', NULL, 46, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Naazzo\"}', NULL, '2026-01-27 13:30:40', '2026-01-27 13:30:40'),
(167, 'New Client created.', 'New Client FocusDesk created.', 'App\\Models\\Client', NULL, 38, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 05:16:59', '2026-01-28 05:16:59'),
(168, 'Project Assign To User', 'Assigned focusdesk.store to Shamim Ahmmed', 'App\\Models\\Project', NULL, 47, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 05:23:06', '2026-01-28 05:23:06'),
(169, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 47, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" focusdesk.store\"}', NULL, '2026-01-28 05:23:06', '2026-01-28 05:23:06'),
(170, 'Task Created', 'Created new task order panel a  order edit page a service charge add korar option thakbe (focusdesk.store)', 'App\\Models\\Project', NULL, 47, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of focusdesk.store\"}', NULL, '2026-01-28 05:27:22', '2026-01-28 05:27:22'),
(171, 'Project Assignee Updated', 'Assigned focusdesk.store to Sagor Biswas', 'App\\Models\\Project', NULL, 47, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 05:27:50', '2026-01-28 05:27:50'),
(172, 'Task Created', 'Created new task check out page a Select Your Arrival Time and Date  a  rokom syestem korte hobe', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Haat Bazaar\"}', NULL, '2026-01-28 05:35:03', '2026-01-28 05:35:03'),
(173, 'Task Created', 'Created new task payment automation In Bkash', 'App\\Models\\Project', NULL, 38, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of stylishbd.com\"}', NULL, '2026-01-28 05:37:05', '2026-01-28 05:37:05'),
(174, 'Task Created', 'Created new task 15. Checkout page same as like - https://thailandhaul.com/checkout', 'App\\Models\\Project', NULL, 38, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of stylishbd.com\"}', NULL, '2026-01-28 05:52:19', '2026-01-28 05:52:19'),
(175, 'New Client created.', 'New Client Md. Arif Jubaer created.', 'App\\Models\\Client', NULL, 39, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 06:28:48', '2026-01-28 06:28:48'),
(176, 'Project Assign To User', 'Assigned afsanahbd to Sagor Biswas,Shamim Ahmmed', 'App\\Models\\Project', NULL, 48, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 06:30:17', '2026-01-28 06:30:17'),
(177, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 48, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" afsanahbd\"}', NULL, '2026-01-28 06:30:17', '2026-01-28 06:30:17'),
(178, 'Task Created', 'Created new task afsanahbd.storola.net site modification', 'App\\Models\\Project', NULL, 48, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of afsanahbd\"}', NULL, '2026-01-28 06:33:33', '2026-01-28 06:33:33'),
(179, 'Task Created', 'Created new task header a অর্ডার ট্র্যাকিং অপশনটি উপরের অংশে উইশলিস্ট ও কার্ট আইকনের পাশে থাকতে হবে।  সেখানে একটি সহজে চেনা যায় এমন অর্ডার ট্র্যাকিং লোগো/আইকন থাকতে হবে। স্যাম্পল লিংক: https://sanasafinaz.com/. (afsanahbd.storola.net)', 'App\\Models\\Project', NULL, 48, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of afsanahbd\"}', NULL, '2026-01-28 06:35:21', '2026-01-28 06:35:21'),
(180, 'New Client created.', 'New Client Faisal Ahmed created.', 'App\\Models\\Client', NULL, 40, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 06:37:54', '2026-01-28 06:37:54'),
(181, 'Project Assign To User', 'Assigned florvana.store to Sagor Biswas,Shamim Ahmmed', 'App\\Models\\Project', NULL, 49, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 06:38:43', '2026-01-28 06:38:43'),
(182, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 49, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" florvana.store\"}', NULL, '2026-01-28 06:38:43', '2026-01-28 06:38:43'),
(183, 'Task Created', 'Created new task Screenshot_359.png ei site er invoice hisebe pos invoice dewa ache ... etar customer phone number, addreas soho marchent phone number sob kichu er font size aro boro ar clear korte hobe ..', 'App\\Models\\Project', NULL, 49, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of florvana.store\"}', NULL, '2026-01-28 06:39:53', '2026-01-28 06:39:53'),
(184, 'New Client created.', 'New Client Yeasin Ahamed Sabuj created.', 'App\\Models\\Client', NULL, 41, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 06:43:20', '2026-01-28 06:43:20'),
(185, 'Project Assign To User', 'Assigned releva.com.bd to Sagor Biswas,Mehedi H Shuvo,Shamim Ahmmed', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 06:44:16', '2026-01-28 06:44:16'),
(186, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" releva.com.bd\"}', NULL, '2026-01-28 06:44:16', '2026-01-28 06:44:16'),
(187, 'Task Created', 'Created new task footer er information gulo bolt theke normal font a hobe', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 06:45:52', '2026-01-28 06:45:52'),
(188, 'New Client created.', 'New Client Md Hasib Howlader created.', 'App\\Models\\Client', NULL, 42, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 06:47:19', '2026-01-28 06:47:19'),
(189, 'Project Assign To User', 'Assigned betalifebd.com to Sagor Biswas,Pavel Mahmud,Shamim Ahmmed', 'App\\Models\\Project', NULL, 51, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 06:48:21', '2026-01-28 06:48:21'),
(190, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 51, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" betalifebd.com\"}', NULL, '2026-01-28 06:48:21', '2026-01-28 06:48:21'),
(191, 'Task Created', 'Created new task \"1. 1page a 3-4ta invoice print hobe  EX: pathao er moto \"', 'App\\Models\\Project', NULL, 51, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of betalifebd.com\"}', NULL, '2026-01-28 06:49:25', '2026-01-28 06:49:25'),
(192, 'Task Created', 'Created new task majhe majhe order button kaj kore na ,', 'App\\Models\\Project', NULL, 51, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of betalifebd.com\"}', NULL, '2026-01-28 06:50:07', '2026-01-28 06:50:07'),
(193, 'Task Created', 'Created new task mobile view te filter option remove hobe', 'App\\Models\\Project', NULL, 51, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of betalifebd.com\"}', NULL, '2026-01-28 06:51:04', '2026-01-28 06:51:04'),
(194, 'Project Assignee Updated', 'Assigned edhakamartbd to Sagor Biswas,Pavel Mahmud', 'App\\Models\\Project', NULL, 27, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 06:51:57', '2026-01-28 06:51:57'),
(195, 'Task Created', 'Created new task 1 page a 3-4ta invoice print hobe  ex: Pathao\"', 'App\\Models\\Project', NULL, 27, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of edhakamartbd\"}', NULL, '2026-01-28 06:53:24', '2026-01-28 06:53:24'),
(196, 'New Client created.', 'New Client A. M. Sayeed Ishtiaque created.', 'App\\Models\\Client', NULL, 43, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 06:57:11', '2026-01-28 06:57:11'),
(197, 'Project Assign To User', 'Assigned t-mart.store to Sagor Biswas,Mehedi H Shuvo,Shamim Ahmmed', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 06:58:24', '2026-01-28 06:58:24'),
(198, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" t-mart.store\"}', NULL, '2026-01-28 06:58:24', '2026-01-28 06:58:24'),
(199, 'Task Created', 'Created new task 1kg ei word gulote number ar kg/gm egulor moddhe space thakbe ... as : 1 KG', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of t-mart.store\"}', NULL, '2026-01-28 06:59:49', '2026-01-28 06:59:49'),
(200, 'Task Created', 'Created new task image e kheyal korben please,,, cart e product quantity show korbe ....', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of t-mart.store\"}', NULL, '2026-01-28 07:00:55', '2026-01-28 07:00:55'),
(201, 'Task Created', 'Created new task admin er product section e kono name er word diye search korle show kore na ... eta solve korte hobe ..', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of t-mart.store\"}', NULL, '2026-01-28 07:01:54', '2026-01-28 07:01:54'),
(202, 'Task Created', 'Created new task releva.com.bd site modification - note description: a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 07:13:07', '2026-01-28 07:13:07'),
(203, 'Task Created', 'Created new task releva.com.bd site modification - note description: a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 07:34:01', '2026-01-28 07:34:01'),
(204, 'Task Created', 'Created new task releva.com.bd site modification - note description: a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 07:35:24', '2026-01-28 07:35:24'),
(205, 'Task Created', 'Created new task releva.com.bd site modification - note description: a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 07:38:48', '2026-01-28 07:38:48');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(206, 'Task Created', 'Created new task releva.com.bd site modification - note description: a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 07:41:27', '2026-01-28 07:41:27'),
(207, 'Task Created', 'Created new task releva.com.bd site modification - note description: a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 07:42:31', '2026-01-28 07:42:31'),
(208, 'Task Created', 'Created new task releva.com.bd site modification 07- note description: a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 07:45:45', '2026-01-28 07:45:45'),
(209, 'Task Created', 'Created new task releva.com.bd site modification 08- note description: a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 07:52:23', '2026-01-28 07:52:23'),
(210, 'Task Created', 'Created new task releva.com.bd site modification 09- note description: a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 08:01:20', '2026-01-28 08:01:20'),
(211, 'Task Created', 'Created new task User Management: Admin, Manager, Inventory Staff, Accountant লগ হিস্ট্রি (কে কী আপডেট করলো)', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 08:04:26', '2026-01-28 08:04:26'),
(212, 'Task Created', 'Created new task releva.com.bd site modification 10- note description: a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 08:05:35', '2026-01-28 08:05:35'),
(213, 'Task Created', 'Created new task a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 08:06:35', '2026-01-28 08:06:35'),
(214, 'Task Created', 'Created new task a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 08:11:42', '2026-01-28 08:11:42'),
(215, 'Task Created', 'Created new task product detail page e product inage pop up open korle slide korle last image er pore slide korle direct abar first image e jabe...', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 08:14:25', '2026-01-28 08:14:25'),
(216, 'Task Created', 'Created new task a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 08:16:07', '2026-01-28 08:16:07'),
(217, 'Task Created', 'Created new task a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 08:18:25', '2026-01-28 08:18:25'),
(218, 'Task Created', 'Created new task a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 08:21:16', '2026-01-28 08:21:16'),
(219, 'Task Created', 'Created new task a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 08:23:16', '2026-01-28 08:23:16'),
(220, 'Task Created', 'Created new task a', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-01-28 08:25:03', '2026-01-28 08:25:03'),
(221, 'New Client created.', 'New Client Arif Ur Rahman Chowdhury created.', 'App\\Models\\Client', NULL, 44, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 08:29:01', '2026-01-28 08:29:01'),
(222, 'Project Assign To User', 'Assigned shukrea.com to Shamim Ahmmed', 'App\\Models\\Project', NULL, 53, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 08:29:41', '2026-01-28 08:29:41'),
(223, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 53, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" shukrea.com\"}', NULL, '2026-01-28 08:29:41', '2026-01-28 08:29:41'),
(224, 'Task Created', 'Created new task mobile menu te All category menu ta  ta dekstop veiw er moto Collapsible kore diben &amp; category gula show korbe', 'App\\Models\\Project', NULL, 53, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of shukrea.com\"}', NULL, '2026-01-28 08:32:28', '2026-01-28 08:32:28'),
(225, 'Project Assignee Updated', 'Assigned shukrea.com to Sagor Biswas', 'App\\Models\\Project', NULL, 53, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 08:32:51', '2026-01-28 08:32:51'),
(226, 'Project Assignee Updated', 'Assigned Ecomaze Eastern to Pavel Mahmud,Shamim Ahmmed', 'App\\Models\\Project', NULL, 12, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 08:44:16', '2026-01-28 08:44:16'),
(227, 'Project Assignee Updated', 'Assigned releva.com.bd to Pavel Mahmud', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 08:50:14', '2026-01-28 08:50:14'),
(228, 'Task Created', 'Created new task header er  email  ta remove hoye . site address show korbe', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Haat Bazaar\"}', NULL, '2026-01-28 09:20:04', '2026-01-28 09:20:04'),
(229, 'Task Created', 'Created new task menuber image gula Thumb Image  hobe', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Haat Bazaar\"}', NULL, '2026-01-28 09:25:14', '2026-01-28 09:25:14'),
(230, 'Task Created', 'Created new task check out  page a cupon  add korar system kore dite hobe', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Haat Bazaar\"}', NULL, '2026-01-28 09:27:24', '2026-01-28 09:27:24'),
(231, 'Task Created', 'Created new task header a my account 2 ta hoiche akta kore diben', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Haat Bazaar\"}', NULL, '2026-01-28 09:29:14', '2026-01-28 09:29:14'),
(232, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 38, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" stylishbd.com\"}', NULL, '2026-01-28 09:49:32', '2026-01-28 09:49:32'),
(233, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 24, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" basantoshop\"}', NULL, '2026-01-28 09:52:17', '2026-01-28 09:52:17'),
(234, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 23, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" qualitypackagingltd\"}', NULL, '2026-01-28 09:59:05', '2026-01-28 09:59:05'),
(235, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 22, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" mashlifestyle\"}', NULL, '2026-01-28 10:06:16', '2026-01-28 10:06:16'),
(236, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 12, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" ecomazeeastern.com\"}', NULL, '2026-01-28 10:07:36', '2026-01-28 10:07:36'),
(237, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 12, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" ecomazeeastern.com\"}', NULL, '2026-01-28 10:08:11', '2026-01-28 10:08:11'),
(238, 'Project Assign To User', 'Assigned ecomazeeastern to Al Mamun', 'App\\Models\\Project', NULL, 54, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 10:09:49', '2026-01-28 10:09:49'),
(239, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 54, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" ecomazeeastern\"}', NULL, '2026-01-28 10:09:49', '2026-01-28 10:09:49'),
(240, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 54, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" ecomazeeastern\"}', NULL, '2026-01-28 10:10:53', '2026-01-28 10:10:53'),
(241, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 54, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" ecomazeeastern\"}', NULL, '2026-01-28 10:13:53', '2026-01-28 10:13:53'),
(242, 'Invoice Created', 'Created invoice STR-20260128-000001', 'App\\Models\\Project', NULL, 54, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of ecomazeeastern\"}', NULL, '2026-01-28 10:14:36', '2026-01-28 10:14:36'),
(243, 'Invoices Printed', 'Printed 1 invoices', 'App\\Models\\Project', NULL, 54, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of ecomazeeastern\",\"count\":1}', NULL, '2026-01-28 10:14:44', '2026-01-28 10:14:44'),
(244, 'Invoice Viewed', 'Viewed invoice STR-20260128-000001', 'App\\Models\\Project', NULL, 54, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of ecomazeeastern\"}', NULL, '2026-01-28 10:14:59', '2026-01-28 10:14:59'),
(245, 'Invoices Printed', 'Printed 1 invoices', 'App\\Models\\Project', NULL, 54, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of ecomazeeastern\",\"count\":1}', NULL, '2026-01-28 10:15:14', '2026-01-28 10:15:14'),
(246, 'New Client created.', 'New Client Bullet Jahid created.', 'App\\Models\\Client', NULL, 45, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 10:23:41', '2026-01-28 10:23:41'),
(247, 'Project Assign To User', 'Assigned shefahealthcenter to Mehedi H Shuvo', 'App\\Models\\Project', NULL, 55, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 10:24:12', '2026-01-28 10:24:12'),
(248, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 55, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" shefahealthcenter\"}', NULL, '2026-01-28 10:24:12', '2026-01-28 10:24:12'),
(249, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 55, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" shefahealthcenter\"}', NULL, '2026-01-28 10:24:53', '2026-01-28 10:24:53'),
(250, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 27, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" edhakamartbd\"}', NULL, '2026-01-28 10:28:24', '2026-01-28 10:28:24'),
(251, 'New Client created.', 'New Client MM Walid Ullah created.', 'App\\Models\\Client', NULL, 46, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 10:31:00', '2026-01-28 10:31:00'),
(252, 'Project Assign To User', 'Assigned getandgobd.com to Al Mamun', 'App\\Models\\Project', NULL, 56, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 10:31:34', '2026-01-28 10:31:34'),
(253, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 56, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" getandgobd.com\"}', NULL, '2026-01-28 10:31:34', '2026-01-28 10:31:34'),
(254, 'Task Created', 'Created new task (afsanahbd.storola.net) একটি “View Size Chart” অপশন থাকবে। এই অপশনে ক্লিক করলে সাইজ চার্টের একটি ছবি ওপেন হবে। এই ছবিতে পোশাকের সাইজ সম্পর্কিত তথ্য ইমেজ ফরম্যাটে দেখানো থাকবে। পোশাকের ধরণ এবং ব্র্যান্ডভেদে সাইজ চার্ট ভিন্ন হতে পারে।', 'App\\Models\\Project', NULL, 48, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of afsanahbd\"}', NULL, '2026-01-28 10:33:16', '2026-01-28 10:33:16'),
(255, 'Task Created', 'Created new task product detail page a product   image  left &amp; right side a thakbe', 'App\\Models\\Project', NULL, 48, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of afsanahbd\"}', NULL, '2026-01-28 10:36:40', '2026-01-28 10:36:40'),
(256, 'Task Created', 'Created new task Contact Us from a  ai mail er jay number option diben', 'App\\Models\\Project', NULL, 2, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Sunnah Fashion\"}', NULL, '2026-01-28 10:43:19', '2026-01-28 10:43:19'),
(257, 'Project Assignee Updated', 'Assigned Sunnah Fashion to Sagor Biswas,Shamim Ahmmed', 'App\\Models\\Project', NULL, 2, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 10:43:47', '2026-01-28 10:43:47'),
(258, 'Invoices Printed', 'Printed 0 invoices', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of Haat Bazaar\",\"count\":0}', NULL, '2026-01-28 10:52:36', '2026-01-28 10:52:36'),
(259, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 55, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" shefahealthcenter\"}', NULL, '2026-01-28 11:20:50', '2026-01-28 11:20:50'),
(260, 'New Client created.', 'New Client Raushan Akter created.', 'App\\Models\\Client', NULL, 47, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 11:24:10', '2026-01-28 11:24:10'),
(261, 'Project Assign To User', 'Assigned edaystore.com to Shamim Ahmmed', 'App\\Models\\Project', NULL, 57, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 11:25:20', '2026-01-28 11:25:20'),
(262, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 57, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" edaystore.com\"}', NULL, '2026-01-28 11:25:20', '2026-01-28 11:25:20'),
(263, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 57, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" edaystore.com\"}', NULL, '2026-01-28 11:25:59', '2026-01-28 11:25:59'),
(264, 'New Client created.', 'New Client Sakibul Hasan Sabuj created.', 'App\\Models\\Client', NULL, 48, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 11:28:44', '2026-01-28 11:28:44'),
(265, 'Project Assign To User', 'Assigned onestbd.com to Al Mamun', 'App\\Models\\Project', NULL, 58, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 11:29:20', '2026-01-28 11:29:20'),
(266, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 58, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" onestbd.com\"}', NULL, '2026-01-28 11:29:20', '2026-01-28 11:29:20'),
(267, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 58, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" onestbd.com\"}', NULL, '2026-01-28 11:29:50', '2026-01-28 11:29:50'),
(268, 'New Client created.', 'New Client Islam Hossain created.', 'App\\Models\\Client', NULL, 49, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 11:31:00', '2026-01-28 11:31:00'),
(269, 'Project Assign To User', 'Assigned raiyanmart to Al Mamun', 'App\\Models\\Project', NULL, 59, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 11:31:38', '2026-01-28 11:31:38'),
(270, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 59, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" raiyanmart\"}', NULL, '2026-01-28 11:31:38', '2026-01-28 11:31:38'),
(271, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 59, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" raiyanmart\"}', NULL, '2026-01-28 11:33:06', '2026-01-28 11:33:06'),
(272, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 2, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Sunnah Fashion\"}', NULL, '2026-01-28 11:41:20', '2026-01-28 11:41:20'),
(273, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 3, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Flex Leather\"}', NULL, '2026-01-28 11:41:43', '2026-01-28 11:41:43'),
(274, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 4, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Trustyshop\"}', NULL, '2026-01-28 11:44:29', '2026-01-28 11:44:29'),
(275, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 5, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Fast Bag Bazar\"}', NULL, '2026-01-28 11:44:44', '2026-01-28 11:44:44'),
(276, 'New Client created.', 'New Client Sunjimul Haque created.', 'App\\Models\\Client', NULL, 50, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 11:44:46', '2026-01-28 11:44:46'),
(277, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 6, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Powernest BD\"}', NULL, '2026-01-28 11:45:01', '2026-01-28 11:45:01'),
(278, 'Project Assign To User', 'Assigned terrariumparadise.com to Shamim Ahmmed', 'App\\Models\\Project', NULL, 60, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 11:45:22', '2026-01-28 11:45:22'),
(279, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 60, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" terrariumparadise.com\"}', NULL, '2026-01-28 11:45:22', '2026-01-28 11:45:22'),
(280, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 8, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" lavogos\"}', NULL, '2026-01-28 11:45:34', '2026-01-28 11:45:34'),
(281, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 10, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Shuddho Mart\"}', NULL, '2026-01-28 11:45:52', '2026-01-28 11:45:52'),
(282, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 60, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" terrariumparadise.com\"}', NULL, '2026-01-28 11:45:55', '2026-01-28 11:45:55'),
(283, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 11, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" naturalfoodhouse\"}', NULL, '2026-01-28 11:46:13', '2026-01-28 11:46:13'),
(284, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 12, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" ecomazeeastern.com\"}', NULL, '2026-01-28 11:46:47', '2026-01-28 11:46:47'),
(285, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 14, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" SOR Traders\"}', NULL, '2026-01-28 11:47:11', '2026-01-28 11:47:11'),
(286, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 13, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Applegenbd\"}', NULL, '2026-01-28 11:47:29', '2026-01-28 11:47:29'),
(287, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 15, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Apon Mart\"}', NULL, '2026-01-28 11:47:53', '2026-01-28 11:47:53'),
(288, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 16, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Fashioncraftbd\"}', NULL, '2026-01-28 11:48:10', '2026-01-28 11:48:10'),
(289, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 17, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" The Toy Cart\"}', NULL, '2026-01-28 11:48:29', '2026-01-28 11:48:29'),
(290, 'Project Assign To User', 'Assigned sunnahfashion to Shamim Ahmmed', 'App\\Models\\Project', NULL, 61, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 11:49:00', '2026-01-28 11:49:00'),
(291, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 61, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" sunnahfashion\"}', NULL, '2026-01-28 11:49:00', '2026-01-28 11:49:00'),
(292, 'Task Created', 'Created new task Contact Us from a ai mail er jay number option diben', 'App\\Models\\Project', NULL, 61, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of sunnahfashion\"}', NULL, '2026-01-28 11:54:01', '2026-01-28 11:54:01'),
(293, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 61, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" sunnahfashion\"}', NULL, '2026-01-28 11:54:47', '2026-01-28 11:54:47'),
(294, 'New Client created.', 'New Client Sajib saha created.', 'App\\Models\\Client', NULL, 51, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 11:55:40', '2026-01-28 11:55:40'),
(295, 'Project Assign To User', 'Assigned igadgetsbd.com to Shamim Ahmmed', 'App\\Models\\Project', NULL, 62, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 11:56:06', '2026-01-28 11:56:06'),
(296, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 62, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" igadgetsbd.com\"}', NULL, '2026-01-28 11:56:06', '2026-01-28 11:56:06'),
(297, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 62, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" igadgetsbd.com\"}', NULL, '2026-01-28 11:56:31', '2026-01-28 11:56:31'),
(298, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 41, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" SOR Trraders\"}', NULL, '2026-01-28 11:57:28', '2026-01-28 11:57:28'),
(299, 'New Client created.', 'New Client priyoomart.com created.', 'App\\Models\\Client', NULL, 52, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 11:58:49', '2026-01-28 11:58:49'),
(300, 'Project Assign To User', 'Assigned priyoomart.com to Al Mamun', 'App\\Models\\Project', NULL, 63, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 11:59:33', '2026-01-28 11:59:33'),
(301, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 63, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" priyoomart.com\"}', NULL, '2026-01-28 11:59:34', '2026-01-28 11:59:34'),
(302, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 63, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" priyoomart.com\"}', NULL, '2026-01-28 12:00:22', '2026-01-28 12:00:22'),
(303, 'Project Assign To User', 'Assigned fashioncraftbd.com to Pavel Mahmud', 'App\\Models\\Project', NULL, 64, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 12:01:54', '2026-01-28 12:01:54'),
(304, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 64, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" fashioncraftbd.com\"}', NULL, '2026-01-28 12:01:54', '2026-01-28 12:01:54'),
(305, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 64, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" fashioncraftbd.com\"}', NULL, '2026-01-28 12:02:36', '2026-01-28 12:02:36'),
(306, 'New Client created.', 'New Client Md. Nurullah created.', 'App\\Models\\Client', NULL, 53, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 12:03:41', '2026-01-28 12:03:41'),
(307, 'Project Assign To User', 'Assigned binnurfoodbd to Robiul Islam', 'App\\Models\\Project', NULL, 65, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 12:04:15', '2026-01-28 12:04:15'),
(308, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 65, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" binnurfoodbd\"}', NULL, '2026-01-28 12:04:15', '2026-01-28 12:04:15'),
(309, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 65, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" binnurfoodbd\"}', NULL, '2026-01-28 12:04:53', '2026-01-28 12:04:53'),
(310, 'Project Assign To User', 'Assigned Hurramlifestyle.com to Pavel Mahmud', 'App\\Models\\Project', NULL, 66, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 12:06:22', '2026-01-28 12:06:22'),
(311, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 66, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Hurramlifestyle.com\"}', NULL, '2026-01-28 12:06:22', '2026-01-28 12:06:22'),
(312, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 66, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Hurramlifestyle.com\"}', NULL, '2026-01-28 12:06:44', '2026-01-28 12:06:44'),
(313, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 43, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Lopacollection\"}', NULL, '2026-01-28 12:07:36', '2026-01-28 12:07:36'),
(314, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 44, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Denimisia\"}', NULL, '2026-01-28 12:08:19', '2026-01-28 12:08:19'),
(315, 'New Client created.', 'New Client Chanchal Hossain created.', 'App\\Models\\Client', NULL, 54, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 12:09:44', '2026-01-28 12:09:44'),
(316, 'Project Assign To User', 'Assigned Nazzo.com to Al Mamun,Robiul Islam', 'App\\Models\\Project', NULL, 67, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 12:10:11', '2026-01-28 12:10:11'),
(317, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 67, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Nazzo.com\"}', NULL, '2026-01-28 12:10:11', '2026-01-28 12:10:11'),
(318, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 67, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Nazzo.com\"}', NULL, '2026-01-28 12:10:36', '2026-01-28 12:10:36'),
(319, 'Task Created', 'Created new task Ongoing (Information delay)', 'App\\Models\\Project', NULL, 67, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Nazzo.com\"}', NULL, '2026-01-28 12:11:01', '2026-01-28 12:11:01'),
(320, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 45, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" raeestrading\"}', NULL, '2026-01-28 12:13:18', '2026-01-28 12:13:18'),
(321, 'New Client created.', 'New Client Tipu Biswas created.', 'App\\Models\\Client', NULL, 55, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 12:14:47', '2026-01-28 12:14:47'),
(322, 'Project Assign To User', 'Assigned 66mart to Pavel Mahmud,Robiul Islam', 'App\\Models\\Project', NULL, 68, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 12:15:42', '2026-01-28 12:15:42'),
(323, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 68, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" 66mart\"}', NULL, '2026-01-28 12:15:42', '2026-01-28 12:15:42'),
(324, 'Task Created', 'Created new task Ongoing new project', 'App\\Models\\Project', NULL, 68, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of 66mart\"}', NULL, '2026-01-28 12:16:31', '2026-01-28 12:16:31'),
(325, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 68, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" 66mart\"}', NULL, '2026-01-28 12:16:43', '2026-01-28 12:16:43'),
(326, 'New Client created.', 'New Client Iftekar created.', 'App\\Models\\Client', NULL, 56, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 12:18:01', '2026-01-28 12:18:01'),
(327, 'Project Assign To User', 'Assigned modernstylebd.com to Al Mamun', 'App\\Models\\Project', NULL, 69, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 12:18:28', '2026-01-28 12:18:28'),
(328, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 69, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" modernstylebd.com\"}', NULL, '2026-01-28 12:18:28', '2026-01-28 12:18:28'),
(329, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 69, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" modernstylebd.com\"}', NULL, '2026-01-28 12:18:52', '2026-01-28 12:18:52'),
(330, 'Task Created', 'Created new task Ongoing', 'App\\Models\\Project', NULL, 69, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of modernstylebd.com\"}', NULL, '2026-01-28 12:19:03', '2026-01-28 12:19:03'),
(331, 'New Client created.', 'New Client Boshir Uddin created.', 'App\\Models\\Client', NULL, 57, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 12:20:48', '2026-01-28 12:20:48'),
(332, 'Project Assign To User', 'Assigned Dhakabdstore.com to Shamim Ahmmed,Robiul Islam', 'App\\Models\\Project', NULL, 70, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 12:21:19', '2026-01-28 12:21:19'),
(333, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 70, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Dhakabdstore.com\"}', NULL, '2026-01-28 12:21:19', '2026-01-28 12:21:19'),
(334, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 70, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Dhakabdstore.com\"}', NULL, '2026-01-28 12:21:41', '2026-01-28 12:21:41'),
(335, 'Task Created', 'Created new task Ongoing', 'App\\Models\\Project', NULL, 70, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Dhakabdstore.com\"}', NULL, '2026-01-28 12:21:49', '2026-01-28 12:21:49'),
(336, 'New Client created.', 'New Client Shathi khatun created.', 'App\\Models\\Client', NULL, 58, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 12:23:19', '2026-01-28 12:23:19'),
(337, 'Project Assign To User', 'Assigned Shoberbazar to Pavel Mahmud,Shamim Ahmmed,Robiul Islam', 'App\\Models\\Project', NULL, 71, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 12:24:06', '2026-01-28 12:24:06'),
(338, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 71, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Shoberbazar\"}', NULL, '2026-01-28 12:24:06', '2026-01-28 12:24:06'),
(339, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 71, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Shoberbazar\"}', NULL, '2026-01-28 12:24:48', '2026-01-28 12:24:48'),
(340, 'New Client created.', 'New Client Md. Sajjad Hossain created.', 'App\\Models\\Client', NULL, 59, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 12:25:52', '2026-01-28 12:25:52'),
(341, 'Project Assign To User', 'Assigned smartessentialbd.com to Al Mamun,Pavel Mahmud,Shamim Ahmmed', 'App\\Models\\Project', NULL, 72, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 12:26:44', '2026-01-28 12:26:44'),
(342, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 72, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" smartessentialbd.com\"}', NULL, '2026-01-28 12:26:44', '2026-01-28 12:26:44'),
(343, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 72, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" smartessentialbd.com\"}', NULL, '2026-01-28 12:27:12', '2026-01-28 12:27:12'),
(344, 'Task Created', 'Created new task Ongoing', 'App\\Models\\Project', NULL, 72, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of smartessentialbd.com\"}', NULL, '2026-01-28 12:27:20', '2026-01-28 12:27:20'),
(345, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 18, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Hurramlifestyle\"}', NULL, '2026-01-28 13:01:27', '2026-01-28 13:01:27'),
(346, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 19, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" buyingbd\"}', NULL, '2026-01-28 13:02:21', '2026-01-28 13:02:21'),
(347, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 20, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Fit Elegant Gym\"}', NULL, '2026-01-28 13:02:42', '2026-01-28 13:02:42'),
(348, 'Project Assignee Updated', 'Assigned edaystore.com to Pavel Mahmud', 'App\\Models\\Project', NULL, 57, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 14:27:59', '2026-01-28 14:27:59'),
(349, 'Project Assignee Updated', 'Assigned edaystore.com to Sagor Biswas', 'App\\Models\\Project', NULL, 57, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 14:28:31', '2026-01-28 14:28:31'),
(350, 'Task Created', 'Created new task site modification', 'App\\Models\\Project', NULL, 57, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of edaystore.com\"}', NULL, '2026-01-28 15:03:56', '2026-01-28 15:03:56'),
(351, 'Task Created', 'Created new task Site Modification', 'App\\Models\\Project', NULL, 57, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of edaystore.com\"}', NULL, '2026-01-28 15:32:59', '2026-01-28 15:32:59'),
(352, 'Task Created', 'Created new task Site modification', 'App\\Models\\Project', NULL, 57, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of edaystore.com\"}', NULL, '2026-01-28 16:28:01', '2026-01-28 16:28:01'),
(353, 'Task Created', 'Created new task edaystore client meeting', 'App\\Models\\Project', NULL, 57, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of edaystore.com\"}', NULL, '2026-01-28 16:28:27', '2026-01-28 16:28:27'),
(354, 'Project Assignee Updated', 'Assigned ecomazeeastern to Pavel Mahmud', 'App\\Models\\Project', NULL, 54, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 16:29:17', '2026-01-28 16:29:17'),
(355, 'Task Created', 'Created new task ecomaze client meeting', 'App\\Models\\Project', NULL, 54, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of ecomazeeastern\"}', NULL, '2026-01-28 16:29:34', '2026-01-28 16:29:34'),
(356, 'Task Created', 'Created new task ecomaze courier set and site update', 'App\\Models\\Project', NULL, 54, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of ecomazeeastern\"}', NULL, '2026-01-28 16:30:01', '2026-01-28 16:30:01'),
(357, 'Task Created', 'Created new task hurram banner design', 'App\\Models\\Project', NULL, 42, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Huramlifestyle\"}', NULL, '2026-01-28 16:30:52', '2026-01-28 16:30:52'),
(358, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 42, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Hurramliifestyle\"}', NULL, '2026-01-28 16:31:28', '2026-01-28 16:31:28'),
(359, 'Task Created', 'Created new task Hurram site building', 'App\\Models\\Project', NULL, 42, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Hurramliifestyle\"}', NULL, '2026-01-28 16:31:53', '2026-01-28 16:31:53'),
(360, 'Task Created', 'Created new task lopa collection site building', 'App\\Models\\Project', NULL, 43, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Lopacollection\"}', NULL, '2026-01-28 16:32:36', '2026-01-28 16:32:36'),
(361, 'Task Created', 'Created new task fashion craft client support', 'App\\Models\\Project', NULL, 64, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of fashioncraftbd.com\"}', NULL, '2026-01-28 16:33:20', '2026-01-28 16:33:20'),
(362, 'New Client created.', 'New Client Md. Firoz created.', 'App\\Models\\Client', NULL, 60, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-28 16:34:28', '2026-01-28 16:34:28'),
(363, 'Project Assign To User', 'Assigned Office Works to Md Firoz,Sagor Biswas,Al Mamun,S M MAHMUDUL HASAN,Mehedi H Shuvo,Pavel Mahmud,Ahnaf Shoumik,Md. Mahim,Foysal Ahmed,Shihabul Islam,Sameer,Somik Mondal,Abid Hasan,Didarul Alam,Shafa khan,Shamim Ahmmed,Robiul Islam,Umme Dipa,Pronoy Ghosh,Maynul Islam,Raiyan Ahmed Akib,Ferdous Ahmed', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 16:36:28', '2026-01-28 16:36:28'),
(364, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Office Works\"}', NULL, '2026-01-28 16:36:28', '2026-01-28 16:36:28'),
(365, 'Task Created', 'Created new task meeting with management', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-28 16:37:02', '2026-01-28 16:37:02'),
(366, 'Task Created', 'Created new task meeting with support team', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-28 16:37:41', '2026-01-28 16:37:41'),
(367, 'Task Created', 'Created new task meeting with sagor and somik bhai (bug fixing)', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-28 16:39:33', '2026-01-28 16:39:33'),
(368, 'Task Created', 'Created new task new site client communication', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-28 16:41:18', '2026-01-28 16:41:18'),
(369, 'Task Created', 'Created new task tracker dm site add', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-28 16:41:38', '2026-01-28 16:41:38'),
(370, 'Task Created', 'Created new task zennova client support, shokherapple client support', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-28 16:42:13', '2026-01-28 16:42:13'),
(371, 'Task Created', 'Created new task 1', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-28 20:01:23', '2026-01-28 20:01:23'),
(372, 'Project Assignee Updated', 'Assigned Storola Tracker to Shamim Ahmmed', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-28 20:04:15', '2026-01-28 20:04:15'),
(373, 'Task Created', 'Created new task 1', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-28 20:04:39', '2026-01-28 20:04:39'),
(374, 'Task Created', 'Created new task 2', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-28 20:04:45', '2026-01-28 20:04:45'),
(375, 'Task Created', 'Created new task 3', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-28 20:04:51', '2026-01-28 20:04:51'),
(376, 'Task Created', 'Created new task 4', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-28 20:04:56', '2026-01-28 20:04:56'),
(377, 'Task Created', 'Created new task 5', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-28 20:05:03', '2026-01-28 20:05:03'),
(378, 'Task Created', 'Created new task 6', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-28 20:05:10', '2026-01-28 20:05:10'),
(379, 'Task Created', 'Created new task 7', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-28 20:05:15', '2026-01-28 20:05:15'),
(380, 'Task Created', 'Created new task 8', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-28 20:05:20', '2026-01-28 20:05:20'),
(381, 'Task Created', 'Created new task 9', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-28 20:05:26', '2026-01-28 20:05:26'),
(382, 'Task Created', 'Created new task 10', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-28 20:05:32', '2026-01-28 20:05:32'),
(383, 'Task Created', 'Created new task 11', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-28 20:05:38', '2026-01-28 20:05:38'),
(384, 'Project Assignee Updated', 'Assigned modernstylebd.com to Robiul Islam', 'App\\Models\\Project', NULL, 69, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-29 06:55:35', '2026-01-29 06:55:35'),
(385, 'Task Created', 'Created new task client communication', 'App\\Models\\Project', NULL, 14, 'App\\Models\\User', 27, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of SOR Traders\"}', NULL, '2026-01-29 06:58:08', '2026-01-29 06:58:08'),
(386, 'New Client created.', 'New Client kayes created.', 'App\\Models\\Client', NULL, 61, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-29 07:02:28', '2026-01-29 07:02:28'),
(387, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 15, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Apon Mart\"}', NULL, '2026-01-29 07:09:22', '2026-01-29 07:09:22'),
(388, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 17, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" The Toy Cart\"}', NULL, '2026-01-29 07:09:43', '2026-01-29 07:09:43'),
(389, 'Project Assign To User', 'Assigned saddhofood to Md. Mahim,Abid Hasan,Ferdous Ahmed', 'App\\Models\\Project', NULL, 74, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-29 07:12:48', '2026-01-29 07:12:48'),
(390, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 74, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" saddhofood\"}', NULL, '2026-01-29 07:12:48', '2026-01-29 07:12:48'),
(391, 'Task Created', 'Created new task sales ad run', 'App\\Models\\Project', NULL, 74, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of saddhofood\"}', NULL, '2026-01-29 07:18:35', '2026-01-29 07:18:35'),
(392, 'Task Created', 'Created new task sales ad run', 'App\\Models\\Project', NULL, 74, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of saddhofood\"}', NULL, '2026-01-29 07:19:26', '2026-01-29 07:19:26'),
(393, 'Task Created', 'Created new task dm ongoing', 'App\\Models\\Project', NULL, 74, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of saddhofood\"}', NULL, '2026-01-29 07:19:51', '2026-01-29 07:19:51'),
(394, 'Task Created', 'Created new task sales ad-msg', 'App\\Models\\Project', NULL, 3, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Flex Leather\"}', NULL, '2026-01-29 07:25:20', '2026-01-29 07:25:20'),
(395, 'New Client created.', 'New Client Khaled Hasan created.', 'App\\Models\\Client', NULL, 62, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-29 09:31:47', '2026-01-29 09:31:47'),
(396, 'Project Assign To User', 'Assigned abonicollection to Pavel Mahmud,Shamim Ahmmed', 'App\\Models\\Project', NULL, 75, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-29 09:38:05', '2026-01-29 09:38:05'),
(397, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 75, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" abonicollection\"}', NULL, '2026-01-29 09:38:05', '2026-01-29 09:38:05'),
(398, 'Project Assignee Updated', 'Assigned Sunnah Fashion to Pavel Mahmud', 'App\\Models\\Project', NULL, 2, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-29 10:22:36', '2026-01-29 10:22:36'),
(399, 'Task Created', 'Created new task Site modification', 'App\\Models\\Project', NULL, 2, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Sunnah Fashion\"}', NULL, '2026-01-29 10:23:29', '2026-01-29 10:23:29'),
(400, 'Task Created', 'Created new task client communication', 'App\\Models\\Project', NULL, 10, 'App\\Models\\User', 27, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Shuddho Mart\"}', NULL, '2026-01-29 10:45:29', '2026-01-29 10:45:29'),
(401, 'New Client created.', 'New Client MD. Rayhan islam created.', 'App\\Models\\Client', NULL, 63, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-29 10:50:15', '2026-01-29 10:50:15'),
(402, 'Project Assign To User', 'Assigned armadio.com.bd to Shamim Ahmmed', 'App\\Models\\Project', NULL, 76, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-29 10:52:09', '2026-01-29 10:52:09'),
(403, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 76, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" armadio.com.bd\"}', NULL, '2026-01-29 10:52:09', '2026-01-29 10:52:09'),
(404, 'Task Created', 'Created new task Cancel Reserved , Chargeback  Denied  Expire  Failed  Processed  Refunded  Reversed  Voided  Waiting for Pickup  ai Order Statuse gula remove hobe', 'App\\Models\\Project', NULL, 76, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of armadio.com.bd\"}', NULL, '2026-01-29 10:56:49', '2026-01-29 10:56:49'),
(405, 'Project Assignee Updated', 'Assigned armadio.com.bd to Sagor Biswas', 'App\\Models\\Project', NULL, 76, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-29 10:57:53', '2026-01-29 10:57:53'),
(406, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 33, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola LP Builder\"}', NULL, '2026-01-29 11:58:38', '2026-01-29 11:58:38'),
(407, 'Task Created', 'Created new task Meeting with stylishbd.com', 'App\\Models\\Project', NULL, 38, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of stylishbd.com\"}', NULL, '2026-01-29 13:41:37', '2026-01-29 13:41:37'),
(408, 'Task Created', 'Created new task Meeting with Shmim', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-29 13:44:03', '2026-01-29 13:44:03'),
(409, 'Task Created', 'Created new task Meeting with Sagor vai', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-29 13:45:14', '2026-01-29 13:45:14'),
(410, 'Task Created', 'Created new task Meeting with Robiul', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-29 13:45:39', '2026-01-29 13:45:39'),
(411, 'Task Created', 'Created new task Potential client meeting (7 person)', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-29 13:46:41', '2026-01-29 13:46:41');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(412, 'Task Created', 'Created new task requirements shit Check &amp; update', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-29 13:47:04', '2026-01-29 13:47:04'),
(413, 'Task Created', 'Created new task Assaign work to support team', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-29 13:47:33', '2026-01-29 13:47:33'),
(414, 'Task Created', 'Created new task Domain purchase &amp; cloudflare add &amp; remove captcha from cloud', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-29 13:48:03', '2026-01-29 13:48:03'),
(415, 'Task Created', 'Created new task Discord &amp; Whatsapp group message check &amp; reply All days', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-29 13:48:35', '2026-01-29 13:48:35'),
(416, 'Task Created', 'Created new task Accounting Sheet update ,Leger create,Money receipt create &amp; Send', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-29 13:49:31', '2026-01-29 13:49:31'),
(417, 'Task Created', 'Created new task edaystore client support', 'App\\Models\\Project', NULL, 57, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of edaystore.com\"}', NULL, '2026-01-29 15:15:57', '2026-01-29 15:15:57'),
(418, 'Task Created', 'Created new task 66 mart theme color, layout', 'App\\Models\\Project', NULL, 68, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of 66mart\"}', NULL, '2026-01-29 15:16:42', '2026-01-29 15:16:42'),
(419, 'Task Created', 'Created new task hurram ready to live', 'App\\Models\\Project', NULL, 42, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Hurramliifestyle\"}', NULL, '2026-01-29 15:17:40', '2026-01-29 15:17:40'),
(420, 'Task Created', 'Created new task ecomaze client support', 'App\\Models\\Project', NULL, 12, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of ecomazeeastern.com\"}', NULL, '2026-01-29 15:18:14', '2026-01-29 15:18:14'),
(421, 'Task Created', 'Created new task lopa callection ready to live', 'App\\Models\\Project', NULL, 43, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Lopacollection\"}', NULL, '2026-01-29 15:18:43', '2026-01-29 15:18:43'),
(422, 'Task Created', 'Created new task fashion craft site update', 'App\\Models\\Project', NULL, 64, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of fashioncraftbd.com\"}', NULL, '2026-01-29 15:19:57', '2026-01-29 15:19:57'),
(423, 'Task Created', 'Created new task meeting with sagor bhai and ahanaf bhai ( bug fixing)', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-29 15:20:42', '2026-01-29 15:20:42'),
(424, 'Task Created', 'Created new task a', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-29 15:20:51', '2026-01-29 15:20:51'),
(425, 'Task Created', 'Created new task meeting with robiul bhai,shamim bhai, somik bhai', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-29 15:21:37', '2026-01-29 15:21:37'),
(426, 'Task Created', 'Created new task whatsapp group Text reply', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-29 15:22:19', '2026-01-29 15:22:19'),
(427, 'Task Created', 'Created new task A', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-29 16:11:49', '2026-01-29 16:11:49'),
(428, 'Task Created', 'Created new task B', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-29 16:11:55', '2026-01-29 16:11:55'),
(429, 'Task Created', 'Created new task C', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-29 16:12:00', '2026-01-29 16:12:00'),
(430, 'Task Created', 'Created new task D', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-29 16:12:05', '2026-01-29 16:12:05'),
(431, 'Task Created', 'Created new task E', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-29 16:12:12', '2026-01-29 16:12:12'),
(432, 'Task Created', 'Created new task F', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-29 16:12:18', '2026-01-29 16:12:18'),
(433, 'Task Created', 'Created new task G', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-29 16:12:23', '2026-01-29 16:12:23'),
(434, 'Task Created', 'Created new task H', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-29 16:12:31', '2026-01-29 16:12:31'),
(435, 'Task Created', 'Created new task GG', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-29 16:17:10', '2026-01-29 16:17:10'),
(436, 'Task Created', 'Created new task FF', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-29 16:17:15', '2026-01-29 16:17:15'),
(437, 'Task Created', 'Created new task DD', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-29 16:17:20', '2026-01-29 16:17:20'),
(438, 'New Client created.', 'New Client MD. Abdur Rahim created.', 'App\\Models\\Client', NULL, 64, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-30 01:38:11', '2026-01-30 01:38:11'),
(439, 'Project Assign To User', 'Assigned Zero4u.com to Pavel Mahmud,Shamim Ahmmed', 'App\\Models\\Project', NULL, 77, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-30 01:40:32', '2026-01-30 01:40:32'),
(440, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 77, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Zero4u.com\"}', NULL, '2026-01-30 01:40:32', '2026-01-30 01:40:32'),
(441, 'New Client created.', 'New Client MD Imran Mridha created.', 'App\\Models\\Client', NULL, 65, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-30 01:58:53', '2026-01-30 01:58:53'),
(442, 'Project Assign To User', 'Assigned eleven-bd.com to Shamim Ahmmed', 'App\\Models\\Project', NULL, 78, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-30 01:59:42', '2026-01-30 01:59:42'),
(443, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 78, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" eleven-bd.com\"}', NULL, '2026-01-30 01:59:42', '2026-01-30 01:59:42'),
(444, 'Project Assignee Updated', 'Assigned eleven-bd.com to Pavel Mahmud', 'App\\Models\\Project', NULL, 78, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-30 02:02:11', '2026-01-30 02:02:11'),
(445, 'New Client created.', 'New Client Md Bosihr Uddin created.', 'App\\Models\\Client', NULL, 66, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-30 13:29:16', '2026-01-30 13:29:16'),
(446, 'Task Created', 'Created new task misking site create and store setup', 'App\\Models\\Project', NULL, 40, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Miskinbd\"}', NULL, '2026-01-30 13:29:25', '2026-01-30 13:29:25'),
(447, 'Task Created', 'Created new task 66 mart site ready to live', 'App\\Models\\Project', NULL, 68, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of 66mart\"}', NULL, '2026-01-30 13:30:04', '2026-01-30 13:30:04'),
(448, 'Task Created', 'Created new task smartessential site ready to live', 'App\\Models\\Project', NULL, 72, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of smartessentialbd.com\"}', NULL, '2026-01-30 13:31:20', '2026-01-30 13:31:20'),
(449, 'Task Created', 'Created new task masteressential banner design and static banner making', 'App\\Models\\Project', NULL, 72, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of smartessentialbd.com\"}', NULL, '2026-01-30 13:31:54', '2026-01-30 13:31:54'),
(450, 'Project Assignee Updated', 'Assigned modernstylebd.com to Pavel Mahmud', 'App\\Models\\Project', NULL, 69, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-30 13:32:39', '2026-01-30 13:32:39'),
(451, 'Task Created', 'Created new task modern style site building', 'App\\Models\\Project', NULL, 69, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of modernstylebd.com\"}', NULL, '2026-01-30 13:33:15', '2026-01-30 13:33:15'),
(452, 'Task Created', 'Created new task meeting with shamim bhai, robiul bhai', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-30 13:34:03', '2026-01-30 13:34:03'),
(453, 'Task Created', 'Created new task group text reply and support help', 'App\\Models\\Project', NULL, 73, 'App\\Models\\User', 10, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Office Works\"}', NULL, '2026-01-30 13:34:22', '2026-01-30 13:34:22'),
(454, 'Task Created', 'Created new task (https://dhakabdstore.storola.net/) footer a Fb link  change korte hobe ai link diben :  https://www.facebook.com/profile.php?id=61587364791002', 'App\\Models\\Project', NULL, 70, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Dhakabdstore.com\"}', NULL, '2026-01-30 13:35:20', '2026-01-30 13:35:20'),
(455, 'Project Assignee Updated', 'Assigned Dhakabdstore.com to Sagor Biswas', 'App\\Models\\Project', NULL, 70, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-30 13:36:14', '2026-01-30 13:36:14'),
(456, 'Task Created', 'Created new task A', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-30 14:27:05', '2026-01-30 14:27:05'),
(457, 'Task Created', 'Created new task B', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-30 14:27:10', '2026-01-30 14:27:10'),
(458, 'Task Created', 'Created new task C', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-30 14:27:14', '2026-01-30 14:27:14'),
(459, 'Task Created', 'Created new task D', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-30 14:27:18', '2026-01-30 14:27:18'),
(460, 'Task Created', 'Created new task E', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-30 14:27:23', '2026-01-30 14:27:23'),
(461, 'Task Created', 'Created new task F', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-30 14:27:28', '2026-01-30 14:27:28'),
(462, 'Task Created', 'Created new task G', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-30 14:27:32', '2026-01-30 14:27:32'),
(463, 'Task Created', 'Created new task H', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-30 14:27:36', '2026-01-30 14:27:36'),
(464, 'Task Created', 'Created new task Ff', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-30 14:27:42', '2026-01-30 14:27:42'),
(465, 'Task Created', 'Created new task G', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-30 14:28:04', '2026-01-30 14:28:04'),
(466, 'Task Created', 'Created new task H', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-01-30 14:28:10', '2026-01-30 14:28:10'),
(467, 'Task Created', 'Created new task New Campaign plan', 'App\\Models\\Project', NULL, 3, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Flex Leather\"}', NULL, '2026-01-30 21:05:30', '2026-01-30 21:05:30'),
(468, 'Project Assignee Updated', 'Assigned khalisfood to Md. Mahim', 'App\\Models\\Project', NULL, 9, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-30 21:06:46', '2026-01-30 21:06:46'),
(469, 'Task Created', 'Created new task audit gtm and event manager', 'App\\Models\\Project', NULL, 9, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of khalisfood\"}', NULL, '2026-01-30 21:08:00', '2026-01-30 21:08:00'),
(470, 'Task Created', 'Created new task Gtm Setup-fb', 'App\\Models\\Project', NULL, 9, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of khalisfood\"}', NULL, '2026-01-30 21:09:02', '2026-01-30 21:09:02'),
(471, 'Task Created', 'Created new task ad run', 'App\\Models\\Project', NULL, 10, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Shuddho Mart\"}', NULL, '2026-01-30 21:09:47', '2026-01-30 21:09:47'),
(472, 'Task Created', 'Created new task client meeting', 'App\\Models\\Project', NULL, 10, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Shuddho Mart\"}', NULL, '2026-01-30 21:10:11', '2026-01-30 21:10:11'),
(473, 'Task Created', 'Created new task client meeting', 'App\\Models\\Project', NULL, 14, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of SOR Traders\"}', NULL, '2026-01-30 21:11:21', '2026-01-30 21:11:21'),
(474, 'Task Created', 'Created new task gtm setup-full', 'App\\Models\\Project', NULL, 21, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Yellow Shopee\"}', NULL, '2026-01-30 21:12:28', '2026-01-30 21:12:28'),
(475, 'Project Assignee Updated', 'Assigned SOR Traders to Md. Mahim', 'App\\Models\\Project', NULL, 14, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-30 21:13:20', '2026-01-30 21:13:20'),
(476, 'Project Assignee Updated', 'Assigned Yellow Shopee to Md. Mahim', 'App\\Models\\Project', NULL, 21, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-30 21:14:24', '2026-01-30 21:14:24'),
(477, 'Task Created', 'Created new task client meeting', 'App\\Models\\Project', NULL, 21, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Yellow Shopee\"}', NULL, '2026-01-30 21:15:18', '2026-01-30 21:15:18'),
(478, 'Task Created', 'Created new task campaign design', 'App\\Models\\Project', NULL, 74, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of saddhofood\"}', NULL, '2026-01-30 21:46:52', '2026-01-30 21:46:52'),
(479, 'Task Created', 'Created new task clietnt meeting', 'App\\Models\\Project', NULL, 14, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of SOR Traders\"}', NULL, '2026-01-30 21:52:11', '2026-01-30 21:52:11'),
(480, 'Project Assignee Updated', 'Assigned buyingbd to Md. Mahim', 'App\\Models\\Project', NULL, 19, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-30 21:52:46', '2026-01-30 21:52:46'),
(481, 'Task Created', 'Created new task client meeting', 'App\\Models\\Project', NULL, 19, 'App\\Models\\User', 12, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of buyingbd\"}', NULL, '2026-01-30 21:53:10', '2026-01-30 21:53:10'),
(482, 'New Client created.', 'New Client Sunjimul Haque created.', 'App\\Models\\Client', NULL, 67, 'App\\Models\\User', 20, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-31 09:36:24', '2026-01-31 09:36:24'),
(483, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 34, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Fraud Checker\"}', NULL, '2026-01-31 10:10:34', '2026-01-31 10:10:34'),
(484, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 35, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Mobile\"}', NULL, '2026-01-31 10:12:53', '2026-01-31 10:12:53'),
(485, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 36, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Saas\"}', NULL, '2026-01-31 10:16:33', '2026-01-31 10:16:33'),
(486, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 37, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Roomchai\"}', NULL, '2026-01-31 10:16:59', '2026-01-31 10:16:59'),
(487, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 32, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Business\"}', NULL, '2026-01-31 10:17:19', '2026-01-31 10:17:19'),
(488, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 31, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Academy\"}', NULL, '2026-01-31 10:17:43', '2026-01-31 10:17:43'),
(489, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 30, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola TagBuckets\"}', NULL, '2026-01-31 10:18:05', '2026-01-31 10:18:05'),
(490, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 25, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Flydropbd\"}', NULL, '2026-01-31 10:20:26', '2026-01-31 10:20:26'),
(491, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 35, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Mobile (Flutter App)\"}', NULL, '2026-01-31 10:21:31', '2026-01-31 10:21:31'),
(492, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 35, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Flutter App\"}', NULL, '2026-01-31 10:22:31', '2026-01-31 10:22:31'),
(493, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 55, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" shefahealthcenter\"}', NULL, '2026-01-31 10:30:23', '2026-01-31 10:30:23'),
(494, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Haat Bazaar\"}', NULL, '2026-01-31 10:31:28', '2026-01-31 10:31:28'),
(495, 'New Client created.', 'New Client Shakibul created.', 'App\\Models\\Client', NULL, 68, 'App\\Models\\User', 23, '{\"modal\":\"App\\\\Models\\\\Client\",\"data\":\"\"}', NULL, '2026-01-31 10:32:12', '2026-01-31 10:32:12'),
(496, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 65, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" binnurfoodbd\"}', NULL, '2026-01-31 10:32:45', '2026-01-31 10:32:45'),
(497, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 4, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Haat Bazaar\"}', NULL, '2026-01-31 10:32:59', '2026-01-31 10:32:59'),
(498, 'Project Assign To User', 'Assigned Timers to Al Mamun,Mehedi H Shuvo,Pavel Mahmud,Md. Mahim,Somik Mondal,Abid Hasan,Shamim Ahmmed,Umme Dipa,Ferdous Ahmed', 'App\\Models\\Project', NULL, 79, 'App\\Models\\User', 23, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-01-31 10:34:50', '2026-01-31 10:34:50'),
(499, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 79, 'App\\Models\\User', 23, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Timers\"}', NULL, '2026-01-31 10:34:50', '2026-01-31 10:34:50'),
(500, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Tracker\"}', NULL, '2026-02-01 05:06:10', '2026-02-01 05:06:10'),
(501, 'Task Created', 'Created new task test', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-02-03 00:41:24', '2026-02-03 00:41:24'),
(502, 'Task Created', 'Created new task tutyutyu', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-02-03 00:46:17', '2026-02-03 00:46:17'),
(503, 'Invoice Created', 'Created invoice STR-20260203-000002', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of Haat Bazaar\"}', NULL, '2026-02-03 01:26:00', '2026-02-03 01:26:00'),
(504, 'Invoice Approved', 'Approved invoice STR-20260203-000002', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of Haat Bazaar\"}', NULL, '2026-02-03 01:26:09', '2026-02-03 01:26:09'),
(505, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Haat Bazaar\"}', NULL, '2026-02-03 02:01:00', '2026-02-03 02:01:00'),
(506, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Haat Bazaar\"}', NULL, '2026-02-03 02:30:05', '2026-02-03 02:30:05'),
(507, 'Invoice Created', 'Created invoice STR-20260203-000003', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of Storola Tracker\"}', NULL, '2026-02-03 02:31:09', '2026-02-03 02:31:09'),
(508, 'Invoice Approved', 'Approved invoice STR-20260203-000003', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of Storola Tracker\"}', NULL, '2026-02-03 02:31:18', '2026-02-03 02:31:18'),
(509, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Tracker\"}', NULL, '2026-02-03 02:31:37', '2026-02-03 02:31:37'),
(510, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 57, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" edaystore.com\"}', NULL, '2026-02-03 02:52:08', '2026-02-03 02:52:08'),
(511, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 57, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" edaystore.com\"}', NULL, '2026-02-03 03:01:04', '2026-02-03 03:01:04'),
(512, 'Task Created', 'Created new task fdghgfh', 'App\\Models\\Project', NULL, 57, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of edaystore.com\"}', NULL, '2026-02-03 03:01:29', '2026-02-03 03:01:29'),
(513, 'Project Assign To User', 'Assigned test34 to Ahnaf Shoumik', 'App\\Models\\Project', NULL, 80, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-02-03 03:02:35', '2026-02-03 03:02:35'),
(514, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 80, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" test34\"}', NULL, '2026-02-03 03:02:35', '2026-02-03 03:02:35'),
(515, 'Task Created', 'Created new task uioiuo', 'App\\Models\\Project', NULL, 2, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Sunnah Fashion\"}', NULL, '2026-02-03 03:11:17', '2026-02-03 03:11:17'),
(516, 'Task Created', 'Created new task rtyhrt', 'App\\Models\\Project', NULL, 2, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Sunnah Fashion\"}', NULL, '2026-02-03 03:14:03', '2026-02-03 03:14:03'),
(517, 'Task Created', 'Created new task ytytuytu', 'App\\Models\\Project', NULL, 2, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Sunnah Fashion\"}', NULL, '2026-02-03 03:14:38', '2026-02-03 03:14:38'),
(518, 'Task Created', 'Created new task ytyutyu', 'App\\Models\\Project', NULL, 2, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Sunnah Fashion\"}', NULL, '2026-02-03 03:15:47', '2026-02-03 03:15:47'),
(519, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 47, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" focusdesk.store\"}', NULL, '2026-02-03 03:20:22', '2026-02-03 03:20:22'),
(520, 'Task Created', 'Created new task yuuyi', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of t-mart.store\"}', NULL, '2026-02-03 03:22:32', '2026-02-03 03:22:32'),
(521, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" t-mart.store\"}', NULL, '2026-02-03 03:24:30', '2026-02-03 03:24:30'),
(522, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" t-mart.store\"}', NULL, '2026-02-03 03:24:46', '2026-02-03 03:24:46'),
(523, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" t-mart.store\"}', NULL, '2026-02-03 03:25:04', '2026-02-03 03:25:04'),
(524, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" t-mart.store\"}', NULL, '2026-02-03 03:26:07', '2026-02-03 03:26:07'),
(525, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 2, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Sunnah Fashion\"}', NULL, '2026-02-03 03:26:44', '2026-02-03 03:26:44'),
(526, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 15, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Apon Mart\"}', NULL, '2026-02-03 03:30:41', '2026-02-03 03:30:41'),
(527, 'Invoice Created', 'Created invoice STR-20260203-000004', 'App\\Models\\Project', NULL, 15, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of Apon Mart\"}', NULL, '2026-02-03 03:31:31', '2026-02-03 03:31:31'),
(528, 'Invoice Approved', 'Approved invoice STR-20260203-000004', 'App\\Models\\Project', NULL, 15, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of Apon Mart\"}', NULL, '2026-02-03 03:31:41', '2026-02-03 03:31:41'),
(529, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 15, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Apon Mart\"}', NULL, '2026-02-03 03:31:58', '2026-02-03 03:31:58'),
(530, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 15, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Apon Mart\"}', NULL, '2026-02-03 03:32:23', '2026-02-03 03:32:23'),
(531, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 15, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Apon Mart\"}', NULL, '2026-02-03 03:32:41', '2026-02-03 03:32:41'),
(532, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 15, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Apon Mart\"}', NULL, '2026-02-03 03:34:32', '2026-02-03 03:34:32'),
(533, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 15, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Apon Mart\"}', NULL, '2026-02-03 03:34:56', '2026-02-03 03:34:56'),
(534, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 15, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Apon Mart\"}', NULL, '2026-02-03 03:37:56', '2026-02-03 03:37:56'),
(535, 'Project Assign To User', 'Assigned shafa to Ahnaf Shoumik', 'App\\Models\\Project', NULL, 81, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-02-03 03:38:29', '2026-02-03 03:38:29'),
(536, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 81, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" shafa\"}', NULL, '2026-02-03 03:38:29', '2026-02-03 03:38:29'),
(537, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 81, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" shafa\"}', NULL, '2026-02-03 03:40:29', '2026-02-03 03:40:29'),
(538, 'Invoice Created', 'Created invoice STR-20260203-000005', 'App\\Models\\Project', NULL, 81, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of shafa\"}', NULL, '2026-02-03 03:40:41', '2026-02-03 03:40:41'),
(539, 'Task Created', 'Created new task trfytrytry', 'App\\Models\\Project', NULL, 81, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of shafa\"}', NULL, '2026-02-03 03:41:02', '2026-02-03 03:41:02'),
(540, 'Task Created', 'Created new task sdfs', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-02-03 04:42:05', '2026-02-03 04:42:05'),
(541, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Tracker\"}', NULL, '2026-02-03 04:53:50', '2026-02-03 04:53:50'),
(542, 'Task Created', 'Created new task dgfd', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-02-03 05:08:55', '2026-02-03 05:08:55'),
(543, 'Task Created', 'Created new task dfgdfgdfg', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-02-03 05:11:25', '2026-02-03 05:11:25'),
(544, 'Task Created', 'Created new task rtrergf', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-02-03 05:19:02', '2026-02-03 05:19:02'),
(545, 'Task Created', 'Created new task dcsd', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-02-03 05:19:42', '2026-02-03 05:19:42'),
(546, 'Task Created', 'Created new task zxczxczx', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-02-03 05:20:08', '2026-02-03 05:20:08'),
(547, 'Task Created', 'Created new task zXCxzc', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-02-03 05:20:43', '2026-02-03 05:20:43'),
(548, 'Task Created', 'Created new task shaj', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-02-03 05:22:05', '2026-02-03 05:22:05'),
(549, 'Task Created', 'Created new task xcvxc', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-02-03 05:26:57', '2026-02-03 05:26:57'),
(550, 'Task Created', 'Created new task test', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-02-03 05:27:22', '2026-02-03 05:27:22'),
(551, 'Task Created', 'Created new task test2', 'App\\Models\\Project', NULL, 70, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Dhakabdstore.com\"}', NULL, '2026-02-03 05:28:52', '2026-02-03 05:28:52'),
(552, 'Task Created', 'Created new task fgdfg', 'App\\Models\\Project', NULL, 70, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Dhakabdstore.com\"}', NULL, '2026-02-03 05:29:29', '2026-02-03 05:29:29'),
(553, 'Task Created', 'Created new task fgfg', 'App\\Models\\Project', NULL, 70, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Dhakabdstore.com\"}', NULL, '2026-02-03 05:30:32', '2026-02-03 05:30:32'),
(554, 'Task Created', 'Created new task sdfs', 'App\\Models\\Project', NULL, 49, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of florvana.store\"}', NULL, '2026-02-03 05:31:47', '2026-02-03 05:31:47'),
(555, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Tracker\"}', NULL, '2026-02-03 05:50:44', '2026-02-03 05:50:44'),
(556, 'Project Assign To User', 'Assigned job100 to Ahnaf Shoumik', 'App\\Models\\Project', NULL, 82, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-02-03 05:51:58', '2026-02-03 05:51:58'),
(557, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 82, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" job100\"}', NULL, '2026-02-03 05:51:58', '2026-02-03 05:51:58'),
(558, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 82, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" job100\"}', NULL, '2026-02-03 05:52:23', '2026-02-03 05:52:23'),
(559, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 82, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" job100\"}', NULL, '2026-02-03 05:53:16', '2026-02-03 05:53:16'),
(560, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 82, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" job100\"}', NULL, '2026-02-03 05:53:36', '2026-02-03 05:53:36'),
(561, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" t-mart.store\"}', NULL, '2026-02-03 05:53:55', '2026-02-03 05:53:55'),
(562, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" t-mart.store\"}', NULL, '2026-02-03 05:54:52', '2026-02-03 05:54:52'),
(563, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Tracker\"}', NULL, '2026-02-03 05:55:33', '2026-02-03 05:55:33'),
(564, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" t-mart.store\"}', NULL, '2026-02-03 05:56:20', '2026-02-03 05:56:20'),
(565, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" t-mart.store\"}', NULL, '2026-02-03 05:56:33', '2026-02-03 05:56:33'),
(566, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" t-mart.store\"}', NULL, '2026-02-03 05:57:32', '2026-02-03 05:57:32'),
(567, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Tracker\"}', NULL, '2026-02-03 06:06:30', '2026-02-03 06:06:30'),
(568, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Tracker\"}', NULL, '2026-02-03 06:06:45', '2026-02-03 06:06:45'),
(569, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Tracker\"}', NULL, '2026-02-03 06:07:01', '2026-02-03 06:07:01'),
(570, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Tracker\"}', NULL, '2026-02-03 06:08:44', '2026-02-03 06:08:44'),
(571, 'Project Assign To User', 'Assigned tracker2 to Ahnaf Shoumik', 'App\\Models\\Project', NULL, 83, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-02-03 06:09:25', '2026-02-03 06:09:25'),
(572, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 83, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" tracker2\"}', NULL, '2026-02-03 06:09:25', '2026-02-03 06:09:25'),
(573, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 83, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" tracker2\"}', NULL, '2026-02-03 06:09:49', '2026-02-03 06:09:49'),
(574, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 83, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" tracker6\"}', NULL, '2026-02-03 06:11:45', '2026-02-03 06:11:45'),
(575, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 83, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" tracker2\"}', NULL, '2026-02-03 06:12:03', '2026-02-03 06:12:03'),
(576, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 83, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" tracker2\"}', NULL, '2026-02-03 06:12:13', '2026-02-03 06:12:13'),
(577, 'Project Assign To User', 'Assigned Latest Complete 10 task to Shafa khan', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-02-04 00:08:01', '2026-02-04 00:08:01'),
(578, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Latest Complete 10 task\"}', NULL, '2026-02-04 00:08:01', '2026-02-04 00:08:01'),
(579, 'Task Created', 'Created new task task 1', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-02-04 00:09:26', '2026-02-04 00:09:26'),
(580, 'Task Created', 'Created new task task 2', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-02-04 00:09:45', '2026-02-04 00:09:45'),
(581, 'Task Created', 'Created new task task 3', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-02-04 00:10:05', '2026-02-04 00:10:05'),
(582, 'Task Created', 'Created new task task 4', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-02-04 00:10:28', '2026-02-04 00:10:28'),
(583, 'Task Created', 'Created new task task 5', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-02-04 00:11:09', '2026-02-04 00:11:09'),
(584, 'Task Created', 'Created new task task 6', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-02-04 00:11:25', '2026-02-04 00:11:25'),
(585, 'Task Created', 'Created new task task 7', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-02-04 00:11:39', '2026-02-04 00:11:39'),
(586, 'Task Created', 'Created new task task 8', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-02-04 00:11:59', '2026-02-04 00:11:59'),
(587, 'Task Created', 'Created new task task 9', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-02-04 00:12:16', '2026-02-04 00:12:16'),
(588, 'Task Created', 'Created new task task 10', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-02-04 00:12:32', '2026-02-04 00:12:32'),
(589, 'Task Created', 'Created new task task 11', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-02-04 00:13:03', '2026-02-04 00:13:03'),
(590, 'Task Created', 'Created new task task 12', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-02-04 00:13:22', '2026-02-04 00:13:22'),
(591, 'Task Created', 'Created new task task 13', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-02-04 01:40:45', '2026-02-04 01:40:45'),
(592, 'Task Created', 'Created new task task 15', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-02-04 01:44:32', '2026-02-04 01:44:32'),
(593, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Latest Complete 10 task\"}', NULL, '2026-02-04 01:46:33', '2026-02-04 01:46:33'),
(594, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Latest Complete 10 task\"}', NULL, '2026-02-04 01:47:10', '2026-02-04 01:47:10'),
(595, 'Task Created', 'Created new task dgte', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-02-04 01:49:17', '2026-02-04 01:49:17'),
(596, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Tracker\"}', NULL, '2026-02-04 01:58:55', '2026-02-04 01:58:55'),
(597, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Tracker\"}', NULL, '2026-02-04 01:59:47', '2026-02-04 01:59:47'),
(598, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Tracker\"}', NULL, '2026-02-04 02:01:46', '2026-02-04 02:01:46'),
(599, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Tracker\"}', NULL, '2026-02-04 02:02:11', '2026-02-04 02:02:11'),
(600, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 26, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Haat Bazaar\"}', NULL, '2026-02-04 02:03:02', '2026-02-04 02:03:02'),
(601, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 75, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" abonicollection\"}', NULL, '2026-02-04 02:04:42', '2026-02-04 02:04:42'),
(602, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 75, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" abonicollection\"}', NULL, '2026-02-04 02:05:34', '2026-02-04 02:05:34'),
(603, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 75, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" abonicollection\"}', NULL, '2026-02-04 02:05:44', '2026-02-04 02:05:44'),
(604, 'Project Assign To User', 'Assigned test job 420 to Al Mamun', 'App\\Models\\Project', NULL, 85, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-02-04 02:07:14', '2026-02-04 02:07:14'),
(605, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 85, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" test job 420\"}', NULL, '2026-02-04 02:07:14', '2026-02-04 02:07:14'),
(606, 'Task Created', 'Created new task test task 1', 'App\\Models\\Project', NULL, 85, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of test job 420\"}', NULL, '2026-02-04 02:08:27', '2026-02-04 02:08:27'),
(607, 'Project Assign To User', 'Assigned test-01 to Ahnaf Shoumik', 'App\\Models\\Project', NULL, 86, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-02-04 06:18:30', '2026-02-04 06:18:30'),
(608, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 86, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" test-01\"}', NULL, '2026-02-04 06:18:30', '2026-02-04 06:18:30'),
(609, 'Project Assign To User', 'Assigned test02 to Ahnaf Shoumik', 'App\\Models\\Project', NULL, 87, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-02-04 06:20:17', '2026-02-04 06:20:17'),
(610, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 87, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" test02\"}', NULL, '2026-02-04 06:20:17', '2026-02-04 06:20:17'),
(611, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 87, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" test02\"}', NULL, '2026-02-04 06:21:04', '2026-02-04 06:21:04'),
(612, 'Invoice Created', 'Created invoice STR-20260204-000006', 'App\\Models\\Project', NULL, 87, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of test02\"}', NULL, '2026-02-04 06:21:49', '2026-02-04 06:21:49'),
(613, 'Invoice Approved', 'Approved invoice STR-20260204-000006', 'App\\Models\\Project', NULL, 87, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of test02\"}', NULL, '2026-02-04 06:22:01', '2026-02-04 06:22:01'),
(614, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 87, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" test02\"}', NULL, '2026-02-04 06:24:02', '2026-02-04 06:24:02'),
(615, 'Project Assign To User', 'Assigned test03 to Al Mamun', 'App\\Models\\Project', NULL, 88, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-02-04 06:25:13', '2026-02-04 06:25:13'),
(616, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 88, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" test03\"}', NULL, '2026-02-04 06:25:13', '2026-02-04 06:25:13'),
(617, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 88, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" test03\"}', NULL, '2026-02-04 06:25:29', '2026-02-04 06:25:29'),
(618, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" t-mart.store\"}', NULL, '2026-02-04 06:29:31', '2026-02-04 06:29:31'),
(619, 'Invoice Created', 'Created invoice STR-20260204-000007', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of t-mart.store\"}', NULL, '2026-02-04 06:30:22', '2026-02-04 06:30:22'),
(620, 'Invoice Approved', 'Approved invoice STR-20260204-000007', 'App\\Models\\Project', NULL, 52, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\ProjectsInvoice\",\"data\":\"of t-mart.store\"}', NULL, '2026-02-04 06:30:32', '2026-02-04 06:30:32'),
(621, 'Task Created', 'Created new task gfhfh', 'App\\Models\\Project', NULL, 49, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of florvana.store\"}', NULL, '2026-02-09 23:30:43', '2026-02-09 23:30:43'),
(622, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Latest Complete 10 task\"}', NULL, '2026-02-14 06:13:13', '2026-02-14 06:13:13'),
(623, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Tracker\"}', NULL, '2026-02-14 06:14:10', '2026-02-14 06:14:10');
INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(624, 'Task Created', 'Created new task dfgdfg', 'App\\Models\\Project', NULL, 49, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of florvana.store\"}', NULL, '2026-02-17 04:42:56', '2026-02-17 04:42:56'),
(625, 'Task Created', 'Created new task abcd', 'App\\Models\\Project', NULL, 49, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of florvana.store\"}', NULL, '2026-02-17 06:45:38', '2026-02-17 06:45:38'),
(626, 'Task Created', 'Created new task test case', 'App\\Models\\Project', NULL, 49, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of florvana.store\"}', NULL, '2026-02-17 06:49:13', '2026-02-17 06:49:13'),
(627, 'Task Created', 'Created new task test case 02', 'App\\Models\\Project', NULL, 49, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of florvana.store\"}', NULL, '2026-02-17 06:49:51', '2026-02-17 06:49:51'),
(628, 'Task Created', 'Created new task test case', 'App\\Models\\Project', NULL, 49, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of florvana.store\"}', NULL, '2026-02-17 06:50:10', '2026-02-17 06:50:10'),
(629, 'Task Created', 'Created new task 5terte', 'App\\Models\\Project', NULL, 49, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of florvana.store\"}', NULL, '2026-02-17 06:51:40', '2026-02-17 06:51:40'),
(630, 'Task Created', 'Created new task test1', 'App\\Models\\Project', NULL, 68, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of 66mart\"}', NULL, '2026-02-18 22:25:15', '2026-02-18 22:25:15'),
(631, 'Task Created', 'Created new task test case 02', 'App\\Models\\Project', NULL, 49, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of florvana.store\"}', NULL, '2026-02-18 22:45:11', '2026-02-18 22:45:11'),
(632, 'Task Created', 'Created new task test case 03', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-02-19 01:37:05', '2026-02-19 01:37:05'),
(633, 'Task Created', 'Created new task dfgdfg', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-02-19 02:08:22', '2026-02-19 02:08:22'),
(634, 'Task Created', 'Created new task test task -01', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-02-19 03:26:14', '2026-02-19 03:26:14'),
(635, 'Task Created', 'Created new task test 04', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-02-19 03:32:05', '2026-02-19 03:32:05'),
(636, 'Task Created', 'Created new task test', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-02-19 03:52:09', '2026-02-19 03:52:09'),
(637, 'Task Created', 'Created new task ttt', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-02-20 04:20:54', '2026-02-20 04:20:54'),
(638, 'Project Assign To User', 'Assigned test job 01 to Ahnaf Shoumik', 'App\\Models\\Project', NULL, 89, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-02-22 04:12:57', '2026-02-22 04:12:57'),
(639, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 89, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" test job 01\"}', NULL, '2026-02-22 04:12:57', '2026-02-22 04:12:57'),
(640, 'Project Assign To User', 'Assigned test job 02 to Abid Hasan', 'App\\Models\\Project', NULL, 90, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-02-22 04:19:20', '2026-02-22 04:19:20'),
(641, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 90, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" test job 02\"}', NULL, '2026-02-22 04:19:20', '2026-02-22 04:19:20'),
(642, 'Project Assign To User', 'Assigned test job 3 to Ahnaf Shoumik', 'App\\Models\\Project', NULL, 91, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-02-22 04:29:06', '2026-02-22 04:29:06'),
(643, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 91, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" test job 3\"}', NULL, '2026-02-22 04:29:06', '2026-02-22 04:29:06'),
(644, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 30, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola TagBuckets\"}', NULL, '2026-02-22 10:19:32', '2026-02-22 10:19:32'),
(645, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 31, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola Academy\"}', NULL, '2026-02-22 10:32:47', '2026-02-22 10:32:47'),
(646, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 33, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola LP Builder\"}', NULL, '2026-02-22 11:03:23', '2026-02-22 11:03:23'),
(647, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 33, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Storola LP Builder\"}', NULL, '2026-02-22 11:04:03', '2026-02-22 11:04:03'),
(648, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 44, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Denimisia\"}', NULL, '2026-02-22 11:05:03', '2026-02-22 11:05:03'),
(649, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 44, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Denimisia\"}', NULL, '2026-02-22 11:05:29', '2026-02-22 11:05:29'),
(650, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 44, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Denimisia\"}', NULL, '2026-02-22 11:06:05', '2026-02-22 11:06:05'),
(651, 'Task Created', 'Created new task test', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-02-25 05:33:54', '2026-02-25 05:33:54'),
(652, 'Task Created', 'Created new task test task-001', 'App\\Models\\Project', NULL, 30, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola TagBuckets\"}', NULL, '2026-03-01 05:01:42', '2026-03-01 05:01:42'),
(653, 'Task Created', 'Created new task test 004', 'App\\Models\\Project', NULL, 84, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Latest Complete 10 task\"}', NULL, '2026-03-01 05:25:17', '2026-03-01 05:25:17'),
(654, 'Project Assign To User', 'Assigned today job to Maynul Islam', 'App\\Models\\Project', NULL, 92, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-03-02 01:28:24', '2026-03-02 01:28:24'),
(655, 'Project Created', 'Created project', 'App\\Models\\Project', NULL, 92, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" today job\"}', NULL, '2026-03-02 01:28:24', '2026-03-02 01:28:24'),
(656, 'Task Created', 'Created new task test task 1', 'App\\Models\\Project', NULL, 92, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of today job\"}', NULL, '2026-03-02 01:32:47', '2026-03-02 01:32:47'),
(657, 'Task Created', 'Created new task test-1', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-03-03 05:06:38', '2026-03-03 05:06:38'),
(658, 'Task Created', 'Created new task test2', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-03-03 05:07:18', '2026-03-03 05:07:18'),
(659, 'Task Created', 'Created new task test 3', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-03-03 05:33:28', '2026-03-03 05:33:28'),
(660, 'Task Created', 'Created new task test 4', 'App\\Models\\Project', NULL, 29, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Tracker\"}', NULL, '2026-03-03 05:37:04', '2026-03-03 05:37:04'),
(661, 'Task Created', 'Created new task test 1', 'App\\Models\\Project', NULL, 34, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Fraud Checker\"}', NULL, '2026-03-05 00:11:09', '2026-03-05 00:11:09'),
(662, 'Event Created', 'Created new event Holiday general', 'App\\Models\\Event', NULL, 1, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Event\",\"data\":\"\"}', NULL, '2026-03-06 03:38:09', '2026-03-06 03:38:09'),
(663, 'Event Created', 'Created new event test holiday', 'App\\Models\\Event', NULL, 2, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Event\",\"data\":\"\"}', NULL, '2026-03-07 01:18:05', '2026-03-07 01:18:05'),
(664, 'Event Created', 'Created new event test holiday', 'App\\Models\\Event', NULL, 3, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Event\",\"data\":\"\"}', NULL, '2026-03-07 01:20:28', '2026-03-07 01:20:28'),
(665, 'Task Created', 'Created new task test', 'App\\Models\\Project', NULL, 36, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Storola Saas\"}', NULL, '2026-03-12 05:41:53', '2026-03-12 05:41:53'),
(666, 'Project Assignee Updated', 'Assigned releva.com.bd to Shafa khan', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-03-12 06:05:36', '2026-03-12 06:05:36'),
(667, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" releva.com.bd\"}', NULL, '2026-03-12 06:05:36', '2026-03-12 06:05:36'),
(668, 'Project Assignee Updated', 'Assigned releva.com.bd to Raiyan Ahmed Akib', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-03-12 06:08:19', '2026-03-12 06:08:19'),
(669, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" releva.com.bd\"}', NULL, '2026-03-12 06:08:19', '2026-03-12 06:08:19'),
(670, 'Task Created', 'Created new task rt', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-03-12 06:11:23', '2026-03-12 06:11:23'),
(671, 'Task Created', 'Created new task test', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-03-12 06:11:42', '2026-03-12 06:11:42'),
(672, 'Project Assignee Updated', 'Assigned Denimisia to Raiyan Ahmed Akib', 'App\\Models\\Project', NULL, 44, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-03-12 06:12:38', '2026-03-12 06:12:38'),
(673, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 44, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Denimisia\"}', NULL, '2026-03-12 06:12:38', '2026-03-12 06:12:38'),
(674, 'Project Assignee Updated', 'Assigned releva.com.bd to Ferdous Ahmed', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-04-05 04:36:59', '2026-04-05 04:36:59'),
(675, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" releva.com.bd\"}', NULL, '2026-04-05 04:36:59', '2026-04-05 04:36:59'),
(676, 'Task Created', 'Created new task kanban list test task 1', 'App\\Models\\Project', NULL, 50, 'App\\Models\\User', 1, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of releva.com.bd\"}', NULL, '2026-04-05 05:28:11', '2026-04-05 05:28:11'),
(677, 'Project Assignee Updated', 'Assigned Denimisia to Shafa khan', 'App\\Models\\Project', NULL, 44, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\"\"}', NULL, '2026-04-05 05:31:33', '2026-04-05 05:31:33'),
(678, 'Project Updated', 'Updated Project', 'App\\Models\\Project', NULL, 44, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Project\",\"data\":\" Denimisia\"}', NULL, '2026-04-05 05:31:33', '2026-04-05 05:31:33'),
(679, 'Task Created', 'Created new task khanban test task 2', 'App\\Models\\Project', NULL, 44, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Denimisia\"}', NULL, '2026-04-05 05:32:46', '2026-04-05 05:32:46'),
(680, 'Task Created', 'Created new task kanban test task 3', 'App\\Models\\Project', NULL, 44, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Denimisia\"}', NULL, '2026-04-05 06:13:12', '2026-04-05 06:13:12'),
(681, 'Task Created', 'Created new task test kanban task 4', 'App\\Models\\Project', NULL, 44, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Denimisia\"}', NULL, '2026-04-05 06:41:02', '2026-04-05 06:41:02'),
(682, 'Task Created', 'Created new task test kanban task 5', 'App\\Models\\Project', NULL, 44, 'App\\Models\\User', 19, '{\"modal\":\"App\\\\Models\\\\Task\",\"data\":\"of Denimisia\"}', NULL, '2026-04-05 07:02:40', '2026-04-05 07:02:40');

-- --------------------------------------------------------

--
-- Table structure for table `activity_types`
--

CREATE TABLE `activity_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `signing_in_date_time` datetime DEFAULT NULL,
  `signing_out_date_time` datetime DEFAULT NULL,
  `status` enum('late','in_time','unknown','excuse') NOT NULL DEFAULT 'unknown',
  `duration` int(11) DEFAULT NULL COMMENT 'Duration in minutes',
  `note` text DEFAULT NULL,
  `office_time` varchar(255) DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `user_id`, `signing_in_date_time`, `signing_out_date_time`, `status`, `duration`, `note`, `office_time`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(30, 19, '2026-04-06 09:48:59', '2026-04-06 09:49:20', 'late', 0, 'Office Time and Duration Not Matched', '11:00 AM - 07:00 PM', NULL, NULL, '2026-04-06 03:48:59', '2026-04-06 03:49:20'),
(31, 27, '2026-03-03 09:48:59', '2026-03-03 09:49:20', 'late', 0, 'Office Time and Duration Not Matched', '11:00 AM - 07:00 PM', NULL, NULL, '2026-04-06 03:48:59', '2026-04-06 03:49:20'),
(32, 27, '2026-03-06 09:48:59', '2026-03-06 09:49:20', 'unknown', 0, 'Office Time and Duration Not Matched', '11:00 AM - 07:00 PM', NULL, NULL, '2026-04-06 03:48:59', '2026-04-06 03:49:20'),
(33, 27, '2026-03-31 09:48:59', '2026-03-31 09:49:20', 'unknown', 0, 'Office Time and Duration Not Matched', '11:00 AM - 07:00 PM', NULL, NULL, '2026-04-06 03:48:59', '2026-04-06 03:49:20'),
(37, 1, '2026-04-07 08:52:53', '2026-04-07 08:53:25', 'late', 0, 'Office Time and Duration Not Matched', '05:00 PM - 07:00 PM', NULL, NULL, '2026-04-07 02:52:53', '2026-04-07 02:53:25');

-- --------------------------------------------------------

--
-- Table structure for table `breaks`
--

CREATE TABLE `breaks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `break_start_time` datetime NOT NULL,
  `break_back_time` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT 0 COMMENT 'Duration in seconds',
  `description` text DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `breaks`
--

INSERT INTO `breaks` (`id`, `user_id`, `break_start_time`, `break_back_time`, `duration`, `description`, `deleted_by`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5, 1, '2026-04-07 08:39:43', '2026-04-07 08:49:27', 584, NULL, NULL, NULL, '2026-04-07 02:39:43', '2026-04-07 02:49:27'),
(6, 1, '2026-04-07 08:53:02', '2026-04-07 08:53:09', 7, NULL, NULL, NULL, '2026-04-07 02:53:02', '2026-04-07 02:53:09');

-- --------------------------------------------------------

--
-- Table structure for table `call_records`
--

CREATE TABLE `call_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_name` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `call_date` datetime DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `duration` int(11) DEFAULT 0,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `recordings` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(128) DEFAULT NULL,
  `website` varchar(255) NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `email`, `phone`, `website`, `created_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`, `department_id`, `user_id`) VALUES
(1, 'Ahmed Ullah shuvo', '', '01521429678', 'http://innodemy.com', 4, NULL, '2026-01-27 11:20:39', '2026-01-27 11:20:39', NULL, 3, NULL),
(2, 'Yellow Shopee', '', NULL, '', 22, NULL, '2026-01-27 11:47:21', '2026-01-27 11:47:21', NULL, 3, NULL),
(3, 'Fit Elegant Gym', '', NULL, '', 22, NULL, '2026-01-27 11:47:47', '2026-01-27 11:47:47', NULL, 3, NULL),
(4, 'Sakil', '', '01727895571', '', 22, NULL, '2026-01-27 11:48:00', '2026-01-27 12:30:46', NULL, 3, NULL),
(5, 'Hurramlifestyle', '', NULL, '', 22, NULL, '2026-01-27 11:48:11', '2026-01-27 11:48:11', NULL, 3, NULL),
(6, 'Sunnah Fashion', '', NULL, '', 10, NULL, '2026-01-27 11:48:21', '2026-01-27 11:48:21', NULL, 3, NULL),
(7, 'The Toy Cart', '', NULL, '', 22, NULL, '2026-01-27 11:48:23', '2026-01-27 11:48:23', NULL, 3, NULL),
(8, 'MD. Galib', '', '01620148792', '', 22, NULL, '2026-01-27 11:49:15', '2026-01-27 12:33:02', NULL, 3, NULL),
(9, 'Pronab Shaha', '', '01620996815', 'http://stylishbd.com', 10, NULL, '2026-01-27 11:49:16', '2026-01-27 12:56:43', NULL, 5, NULL),
(10, 'Apon', '', '01624630580', '', 22, NULL, '2026-01-27 11:49:28', '2026-01-27 12:20:42', NULL, 3, NULL),
(11, 'SOR Traders', '', NULL, '', 22, NULL, '2026-01-27 11:49:43', '2026-01-27 11:49:43', NULL, 3, NULL),
(12, 'Showeb', '', '01795082616', '', 22, NULL, '2026-01-27 11:49:55', '2026-01-27 12:29:09', NULL, 5, NULL),
(13, 'Sadi', '', '01341635227', '', 22, NULL, '2026-01-27 11:50:42', '2026-01-27 12:31:45', NULL, 3, NULL),
(14, 'Flex Leather', '', NULL, '', 10, NULL, '2026-01-27 11:55:49', '2026-01-27 11:55:49', NULL, 3, NULL),
(15, 'Trustyshop', '', NULL, '', 10, NULL, '2026-01-27 11:56:04', '2026-01-27 11:56:04', NULL, 3, NULL),
(16, 'Md. hussain', '', '01890310298', '', 10, NULL, '2026-01-27 11:56:17', '2026-01-27 12:33:53', NULL, 3, NULL),
(17, 'Monir hossain', '', '01934351282', '', 22, NULL, '2026-01-27 11:56:30', '2026-01-27 12:37:17', NULL, 3, NULL),
(18, 'Powernest BD', '', NULL, '', 10, NULL, '2026-01-27 11:56:32', '2026-01-27 11:56:32', NULL, 3, NULL),
(19, 'Trustyshop', '', NULL, '', 10, NULL, '2026-01-27 11:56:47', '2026-01-27 11:56:47', NULL, 3, NULL),
(20, 'Shuddho Mart', '', 'Phone No', '', 22, NULL, '2026-01-27 11:56:48', '2026-01-27 11:56:48', NULL, 3, NULL),
(21, 'Storola', '', NULL, '', 1, NULL, '2026-01-27 12:04:00', '2026-01-27 12:04:00', NULL, 6, NULL),
(22, 'Mohsin', '', '01781618811', '', 22, NULL, '2026-01-27 12:04:19', '2026-01-27 12:36:20', NULL, 3, NULL),
(23, 'khalisfood', '', NULL, '', 22, NULL, '2026-01-27 12:06:54', '2026-01-27 12:06:54', NULL, 3, NULL),
(24, 'MASH', 'mashlifestylebd@gmail.com', '01999012120', 'https://mashlifestyle.storola.net/', 20, NULL, '2026-01-27 12:14:32', '2026-01-27 12:14:32', NULL, 5, NULL),
(25, 'Hasibul Hasan', 'qualitypackaging09@gmail.com', '01337-571024', 'https://qualitypackagingltd.com/', 20, NULL, '2026-01-27 12:17:26', '2026-01-27 12:17:26', NULL, 5, NULL),
(26, 'Sabbir Hossain', 'Basantoshop@gmail.com', '01837329676', 'https://basantoshop.com/', 20, NULL, '2026-01-27 12:20:32', '2026-01-27 12:20:32', NULL, 5, NULL),
(27, 'Masud', 'haatbazaar.grocery@gmail.com', '+1 (703) 533-1505', 'https://hatbazar.storola.net/', 20, NULL, '2026-01-27 12:25:01', '2026-01-27 12:25:01', NULL, 5, NULL),
(28, 'Ahmed Foysal', '', '01704866987', 'http://flydropbd.com', 4, NULL, '2026-01-27 12:26:48', '2026-01-27 12:26:48', NULL, 6, NULL),
(29, 'Rakib', 'sumivisaservice@gmail.com', '01748484182', 'https://edhakamartbd.com/', 20, NULL, '2026-01-27 12:29:07', '2026-01-27 12:29:07', NULL, 5, NULL),
(30, 'Rafiqul Islam', 'ecomazeastern.inc@gmail.com', '01770840035', 'https://ecomazeeastern.com/', 20, NULL, '2026-01-27 12:31:35', '2026-01-27 12:31:35', NULL, 5, NULL),
(31, 'Saikat', '', '880 1711-507414', '', 10, NULL, '2026-01-27 13:13:31', '2026-01-27 13:13:31', NULL, 5, NULL),
(32, 'Ferdaous', '', '0 1608-286080', '', 10, NULL, '2026-01-27 13:17:17', '2026-01-27 13:17:17', NULL, 5, NULL),
(33, 'Sunny', '', NULL, '', 10, NULL, '2026-01-27 13:20:09', '2026-01-27 13:20:09', NULL, 5, NULL),
(34, 'Md.Mohibul Islam', '', NULL, '', 10, NULL, '2026-01-27 13:22:06', '2026-01-27 13:22:06', NULL, 5, NULL),
(35, 'Tanvir', '', NULL, '', 10, NULL, '2026-01-27 13:26:13', '2026-01-27 13:26:13', NULL, 5, NULL),
(36, 'MD RAEES AHMED ROCKY', '', NULL, '', 10, NULL, '2026-01-27 13:28:35', '2026-01-27 13:28:35', NULL, 5, NULL),
(37, 'Naazzo', '', NULL, '', 10, NULL, '2026-01-27 13:30:09', '2026-01-27 13:30:09', NULL, 5, NULL),
(38, 'FocusDesk', 'Info@focuson-global.com', '01628660660', 'https://focusdesk.store/', 20, NULL, '2026-01-28 05:16:59', '2026-01-28 05:16:59', NULL, 5, NULL),
(39, 'Md. Arif Jubaer', 'theafsanah@gmail.com', '+880 1312-181385', 'https://afsanahbd.storola.net', 20, NULL, '2026-01-28 06:28:48', '2026-01-28 06:28:48', NULL, 5, NULL),
(40, 'Faisal Ahmed', 'faisalbd.biz@gmail.com', '01770966689', 'https://florvana.store/', 20, NULL, '2026-01-28 06:37:54', '2026-01-28 06:37:54', NULL, 5, NULL),
(41, 'Yeasin Ahamed Sabuj', 'relevaofficial@gmail.com', NULL, 'https://releva.com.bd/', 20, NULL, '2026-01-28 06:43:20', '2026-01-28 06:43:20', NULL, 5, NULL),
(42, 'Md Hasib Howlader', 'betalifebd@gmail.com', '01999762141', 'https://betalifebd.com/', 20, NULL, '2026-01-28 06:47:19', '2026-01-28 06:47:19', NULL, 5, NULL),
(43, 'A. M. Sayeed Ishtiaque', 'tawakkul.mart.bd@gmail.com', '01634-361238', 'http://t-mart.store', 20, NULL, '2026-01-28 06:57:11', '2026-01-28 06:57:11', NULL, 5, NULL),
(44, 'Arif Ur Rahman Chowdhury', 'care@shukrea.com', '01610-002003', 'https://shukrea.com/', 20, NULL, '2026-01-28 08:29:01', '2026-01-28 08:29:01', NULL, 5, NULL),
(45, 'Bullet Jahid', '', '01324892522', '', 4, NULL, '2026-01-28 10:23:41', '2026-01-28 10:23:41', NULL, 5, NULL),
(46, 'MM Walid Ullah', '', '01726598191', 'http://getandgobd.com', 4, NULL, '2026-01-28 10:31:00', '2026-01-28 10:31:00', NULL, 5, NULL),
(47, 'Raushan Akter', '', '01712697519', '', 4, NULL, '2026-01-28 11:24:10', '2026-01-28 11:24:10', NULL, 4, NULL),
(48, 'Sakibul Hasan Sabuj', '', '01339730757', '', 4, NULL, '2026-01-28 11:28:44', '2026-01-28 11:28:44', NULL, 4, NULL),
(49, 'Islam Hossain', '', '01974499035', 'https://raiyanmart.xyz/', 4, NULL, '2026-01-28 11:31:00', '2026-01-28 11:31:00', NULL, 4, NULL),
(50, 'Sunjimul Haque', '', '01974690912', '', 4, NULL, '2026-01-28 11:44:46', '2026-01-28 11:44:46', NULL, 4, NULL),
(51, 'Sajib saha', '', '01811443375', '', 4, NULL, '2026-01-28 11:55:40', '2026-01-28 11:55:40', NULL, 4, NULL),
(52, 'priyoomart.com', '', '01732598133', '', 4, NULL, '2026-01-28 11:58:49', '2026-01-28 11:58:49', NULL, 5, NULL),
(53, 'Md. Nurullah', '', '01794167274', '', 4, NULL, '2026-01-28 12:03:41', '2026-01-28 12:03:41', NULL, 5, NULL),
(54, 'Chanchal Hossain', '', '01706368938', '', 4, NULL, '2026-01-28 12:09:44', '2026-01-28 12:09:44', NULL, 5, NULL),
(55, 'Tipu Biswas', '', '01917386764', '', 4, NULL, '2026-01-28 12:14:47', '2026-01-28 12:14:47', NULL, 4, NULL),
(56, 'Iftekar', '', NULL, '', 4, NULL, '2026-01-28 12:18:01', '2026-01-28 12:18:01', NULL, 4, NULL),
(57, 'Boshir Uddin', '', NULL, '', 4, NULL, '2026-01-28 12:20:48', '2026-01-28 12:20:48', NULL, 4, NULL),
(58, 'Shathi khatun', '', NULL, '', 4, NULL, '2026-01-28 12:23:19', '2026-01-28 12:23:19', NULL, 4, NULL),
(59, 'Md. Sajjad Hossain', '', '01893-360908', '', 4, NULL, '2026-01-28 12:25:52', '2026-01-28 12:25:52', NULL, 4, NULL),
(60, 'Md. Firoz', '', NULL, '', 10, NULL, '2026-01-28 16:34:28', '2026-01-28 16:34:28', NULL, 5, NULL),
(61, 'kayes', '', '01706381175', 'http://saddhofood.xyz', 12, NULL, '2026-01-29 07:02:28', '2026-01-29 07:02:28', NULL, 3, NULL),
(62, 'Khaled Hasan', 'abonicollection@gmail.com', '01830990556', '', 20, NULL, '2026-01-29 09:31:47', '2026-01-29 09:31:47', NULL, 5, NULL),
(63, 'MD. Rayhan islam', '', 'MD. Rayhan islam', '', 20, NULL, '2026-01-29 10:50:15', '2026-01-29 10:50:15', NULL, 5, NULL),
(64, 'MD. Abdur Rahim', '', '01568201444', '', 20, NULL, '2026-01-30 01:38:11', '2026-01-30 01:38:11', NULL, 5, NULL),
(65, 'MD Imran Mridha', '', '01985623022', '', 20, NULL, '2026-01-30 01:58:53', '2026-01-30 01:58:53', NULL, 5, NULL),
(66, 'Md Bosihr Uddin', 'bosirweb1@gmail.com', '01726711866', '', 20, NULL, '2026-01-30 13:29:16', '2026-01-30 13:29:16', NULL, 5, NULL),
(67, 'Sunjimul Haque', '', '01974690912', 'https://terrariumparadise.com/', 20, NULL, '2026-01-31 09:36:24', '2026-01-31 09:36:24', NULL, 5, NULL),
(68, 'Shakibul', '', NULL, '', 23, NULL, '2026-01-31 10:32:12', '2026-01-31 10:32:12', NULL, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment` text NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commission_rules`
--

CREATE TABLE `commission_rules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `total_percentage` tinyint(3) UNSIGNED NOT NULL,
  `principal_percentage` tinyint(3) UNSIGNED NOT NULL,
  `secondary_percentage` tinyint(3) UNSIGNED NOT NULL,
  `priority` int(10) UNSIGNED NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commission_rule_principal_user`
--

CREATE TABLE `commission_rule_principal_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commission_rule_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commission_rule_project`
--

CREATE TABLE `commission_rule_project` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commission_rule_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commission_rule_secondary_user`
--

CREATE TABLE `commission_rule_secondary_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `commission_rule_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(170) NOT NULL,
  `description` text DEFAULT NULL,
  `color` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `description`, `color`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Creative Team', '<p>My Department is best department</p>', '#F26D52', '2023-06-12 23:11:23', '2025-09-20 00:13:15', NULL),
(3, 'Digital Marketing', '<p>My Department is best department</p>', '#52F28F', '2023-06-12 23:11:23', '2025-09-20 00:14:27', NULL),
(4, 'Sales Team', '<p>My Department is best department</p>', '#52D7F2', '2023-06-12 23:11:23', '2025-09-20 00:14:44', NULL),
(5, 'Support Team', NULL, '#3F51B5', '2025-09-20 00:14:54', '2025-09-20 00:14:54', NULL),
(6, 'App Development', NULL, '#3F51B5', '2025-09-29 22:56:29', '2026-01-26 13:14:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department_tag`
--

CREATE TABLE `department_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department_tag`
--

INSERT INTO `department_tag` (`id`, `tag_id`, `department_id`) VALUES
(1, 1, 5),
(2, 2, 5),
(3, 3, 5),
(4, 4, 5),
(5, 5, 5),
(6, 6, 5),
(7, 7, 5),
(8, 8, 5),
(9, 9, 5),
(10, 10, 5),
(11, 11, 5),
(12, 12, 5),
(13, 13, 5),
(14, 14, 5),
(15, 15, 5),
(16, 16, 5),
(17, 17, 4),
(18, 18, 4),
(19, 19, 4),
(20, 20, 4),
(21, 21, 4),
(22, 22, 4),
(23, 23, 4),
(24, 24, 4),
(25, 25, 4),
(26, 26, 4),
(27, 27, 2),
(28, 28, 2),
(29, 29, 2),
(30, 30, 2),
(31, 31, 2),
(32, 32, 2),
(33, 33, 2),
(34, 34, 2),
(35, 35, 2),
(36, 36, 2),
(37, 37, 2),
(38, 38, 2),
(39, 43, 3),
(40, 44, 3),
(41, 45, 3),
(43, 46, 3),
(44, 47, 3),
(45, 48, 3),
(46, 49, 3),
(47, 50, 3),
(48, 51, 3),
(49, 52, 3),
(50, 53, 3),
(51, 54, 3),
(52, 55, 3),
(53, 56, 6),
(54, 57, 6),
(56, 39, 6);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `type` bigint(20) UNSIGNED DEFAULT NULL,
  `added_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `amount` double NOT NULL,
  `date` datetime NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `category` int(11) NOT NULL DEFAULT 1,
  `billable` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `extensions`
--

CREATE TABLE `extensions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `source` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(161) DEFAULT NULL,
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
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `invoice_number` varchar(255) NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `total_hour` varchar(255) NOT NULL,
  `discount` double DEFAULT NULL,
  `tax_id` int(10) UNSIGNED DEFAULT NULL,
  `status` int(11) NOT NULL,
  `amount` double NOT NULL,
  `sub_total` double NOT NULL,
  `notes` text DEFAULT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `discount_type` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_clients`
--

CREATE TABLE `invoice_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_id` int(11) NOT NULL,
  `owner_type` varchar(255) NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `task_id` int(10) UNSIGNED DEFAULT NULL,
  `item_project_id` int(10) UNSIGNED DEFAULT NULL,
  `hours` varchar(255) NOT NULL,
  `task_amount` double DEFAULT NULL,
  `fix_rate` double DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_projects`
--

CREATE TABLE `invoice_projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_statuses`
--

CREATE TABLE `job_statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_statuses`
--

INSERT INTO `job_statuses` (`id`, `name`, `description`, `order`, `created_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ongoing', 'This Indicate On-Going Project', 3, 1, NULL, '2026-02-21 22:45:27', '2026-04-06 07:01:45', NULL),
(2, 'Finished', 'This Indicate Finished Project', 0, 1, NULL, '2026-02-21 22:49:22', '2026-02-21 22:49:22', NULL),
(3, 'OnHold', 'This Indicate OnHold Project', 0, 1, NULL, '2026-02-21 22:51:05', '2026-02-21 22:51:05', NULL),
(4, 'Archived', 'This Indicate Archived Project', 0, 1, NULL, '2026-02-21 23:01:39', '2026-02-21 23:01:39', NULL),
(5, 'Paid', 'This Indicate Paid Project', 1, 1, NULL, '2026-02-21 23:04:51', '2026-04-06 07:00:04', NULL),
(14, 'test', 'this is test', 2, 1, NULL, '2026-02-22 03:45:33', '2026-04-06 07:01:05', NULL),
(15, 'test2', 'we', 0, 1, NULL, '2026-04-06 07:09:15', '2026-04-06 07:09:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `job_types`
--

CREATE TABLE `job_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_types`
--

INSERT INTO `job_types` (`id`, `name`, `description`, `order`, `created_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Digital Marketing Job', 'This Indicate Digital Marketing', 0, 1, NULL, '2026-02-22 02:15:38', '2026-02-22 02:16:03', NULL),
(2, 'Ecommerce Saas', 'This Indicate Ecommerce Saas Project', 0, 1, NULL, '2026-02-22 02:16:33', '2026-02-22 02:16:33', NULL),
(3, 'Custom Software', 'This Indicate Custom Software Project', 0, 1, NULL, '2026-02-22 02:17:03', '2026-02-22 02:17:03', NULL),
(4, 'In House Development', 'This Indicate In House Development', 0, 1, NULL, '2026-02-22 02:20:03', '2026-02-22 02:20:03', NULL),
(6, 'test', NULL, 0, 1, NULL, '2026-02-22 02:52:10', '2026-02-22 02:52:23', '2026-02-22 02:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `source_id` bigint(20) UNSIGNED DEFAULT NULL,
  `stage_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `industry` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `pinterest` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(50) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `first_name`, `last_name`, `email`, `phone`, `source_id`, `stage_id`, `assigned_to`, `job_title`, `industry`, `company`, `website`, `linkedin`, `instagram`, `facebook`, `pinterest`, `city`, `state`, `zip`, `country`, `description`, `created_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Md', 'Firoz', 'admin@admin.com', NULL, NULL, NULL, NULL, 'df', NULL, 'dd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2026-01-31 10:43:29', '2026-01-31 10:43:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lead_follow_ups`
--

CREATE TABLE `lead_follow_ups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lead_id` bigint(20) UNSIGNED NOT NULL,
  `assigned_to` bigint(20) UNSIGNED DEFAULT NULL,
  `follow_up_at` datetime NOT NULL,
  `type` enum('call','email','meeting','sms','other') NOT NULL DEFAULT 'call',
  `status` enum('pending','completed','rescheduled','canceled') NOT NULL DEFAULT 'pending',
  `note` text DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_sources`
--

CREATE TABLE `lead_sources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lead_stages`
--

CREATE TABLE `lead_stages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 1,
  `color` varchar(50) NOT NULL DEFAULT 'primary',
  `description` text DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `partial_leave` tinyint(1) NOT NULL DEFAULT 0,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `total_days` int(11) NOT NULL DEFAULT 1,
  `from_time` time DEFAULT NULL,
  `to_time` time DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending','approved','rejected','swap') NOT NULL DEFAULT 'pending',
  `swap_date` date DEFAULT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `user_id`, `partial_leave`, `from_date`, `to_date`, `total_days`, `from_time`, `to_time`, `reason`, `status`, `swap_date`, `created_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, '2025-09-06', '2025-09-06', 1, '00:40:00', '14:42:00', 'nai', 'rejected', NULL, 1, 1, '2025-09-06 10:42:13', '2025-12-30 12:18:47', '2025-12-30 12:18:47'),
(2, 1, 1, '2025-09-06', '2025-09-07', 2, '22:53:00', '22:55:00', 'nai', 'pending', NULL, 1, NULL, '2025-09-06 10:54:43', '2025-09-06 11:12:26', '2025-09-06 11:12:26'),
(3, 1, 1, '2025-09-06', '2025-09-06', 1, '06:58:00', '20:03:00', 'nai', 'pending', NULL, 1, NULL, '2025-09-06 11:02:16', '2025-09-06 11:12:29', '2025-09-06 11:12:29'),
(4, 1, 1, '2025-09-07', '2025-09-10', 4, '03:46:00', '13:53:00', 'nai', 'pending', NULL, 1, 1, '2025-09-06 11:45:30', '2025-12-30 12:19:03', '2025-12-30 12:19:03'),
(5, 24, 0, '2026-01-04', '2026-01-04', 1, NULL, NULL, 'আগামী (৪/১/২০২৬) বরিবার, আমার অনার্স ৩য় বর্ষের ২য় পরীক্ষা। তাই উক্ত দিনে আমার \"ইচ্ছা থাকা সত্ত্বেও\" অফিসে উপস্থিত থাকতে পারছি না। আশা করি, আমার পরিস্থিতি বিবেচনায় উক্ত দিনের ছুটি মঞ্জুর করে Storola কর্তৃপক্ষ আমাকে সাহায্য করবে।', 'pending', NULL, 24, 1, '2026-01-02 16:09:01', '2026-01-21 09:22:52', '2026-01-21 09:22:52'),
(6, 18, 0, '2026-01-05', '2026-01-05', 1, NULL, NULL, 'fg', 'pending', NULL, 18, 1, '2026-01-03 12:41:22', '2026-01-06 08:57:48', '2026-01-06 08:57:48'),
(7, 17, 0, '2026-01-10', '2026-01-10', 1, NULL, NULL, 'I\'m going to my home in Tangail. There\'s a family function that I need to attend.', 'pending', NULL, 17, 1, '2026-01-05 14:37:06', '2026-01-21 09:22:59', '2026-01-21 09:22:59'),
(8, 19, 0, '2026-01-11', '2026-01-11', 1, NULL, NULL, 'বিষয়: ১১/০১/২০২৬ তারিখে ছুটির জন্য আবেদন\n\nপ্রতি,\nপ্রধান নির্বাহী কর্মকর্তা\nইনোলাইটিক আইটি\nহাউস # ৬৯/৩, রোড # ৭/এ, ৬ষ্ঠ তলা, ধানমন্ডি, ঢাকা-১২০৯\n\nমহোদয়,\n\nআপনার দৃষ্টি আকর্ষণ করে জানাচ্ছি যে, আগামী ১১ জানুয়ারি, ২০২৬ তারিখে (রবিবার) পারিবারিক প্রয়োজনে আমি অফিসে উপস্থিত থাকতে পারব না।\n\nআমার ইচ্ছা থাকা সত্ত্বেও উক্ত তারিখে অফিসে উপস্থিত হওয়া সম্ভব হবে না বলে দুঃখিত। পারিবারিক কারণবশত উক্ত দিনটিতে আমার উপস্থিতি প্রয়োজন।\n\nঅতএব, বিনীত অনুরোধ করছি, আমার পরিস্থিতি বিবেচনায় উক্ত দিনটির জন্য ছুটি মঞ্জুর করে আমাকে অনুগ্রহিত করবেন। আমি নিশ্চিত করছি যে, আমার অন্যান্য দায়িত্বসমূহ সময়মতো সম্পন্ন করব।\n\nআপনার সহযোগিতা ও বিবেচনার জন্য আগাম ধন্যবাদ জানাচ্ছি।\n\nবিনীত,\n\nহুসাইন মোহাম্মাদ সাঁফা খান\nসফটওয়্যার ইঞ্জিনিয়ার\nইনোলাইটিক আইটি\nযোগাযোগ নম্বর: ০১৯৬০৯৫১৬২৮\nতারিখ:৬ই জানুয়ারি, ২০২৬(২১শে পৌষ, ১৪৩২ বঙ্গাব্দ)', 'approved', NULL, 19, NULL, '2026-01-06 09:13:35', '2026-01-21 11:14:50', NULL),
(9, 24, 0, '2026-01-12', '2026-01-12', 1, NULL, NULL, 'আগামী (১১/১/২০২৬) বরিবার, আমার অনার্স ৩য় বর্ষের পরীক্ষা। তাই উক্ত দিনে আমার \"ইচ্ছা থাকা সত্ত্বেও\" অফিসে উপস্থিত থাকতে পারছি না। আশা করি, আমার পরিস্থিতি বিবেচনায় উক্ত দিনের ছুটি মঞ্জুর করে Storola কর্তৃপক্ষ আমাকে সাহায্য করবে।', 'pending', NULL, 24, 1, '2026-01-10 06:07:39', '2026-01-21 09:22:46', '2026-01-21 09:22:46'),
(10, 16, 0, '2026-01-13', '2026-01-13', 1, NULL, NULL, 'অফিস কর্তৃপক্ষের দৃষ্টি আকর্ষণ করে জানাচ্ছি যে আগামী ১৩/১/২০২৬ মঙ্গলবার পারিবারিক প্রয়োজনে আমি অফিসে উপস্থিত থাকতে পারবো না। পারিবারিক কাজের জন্য আমাকে উক্ত দিনে আমার  উপস্থিত থাকা অতি প্রয়োজন। \nঅতএব বিনীত অনুরোধ করছি আমার পরিস্থিতি বিবেচনা উত্তর দিনটির জন্য ছুটি মঞ্জুর করে আমাকে বাধিত করবেন।', 'pending', NULL, 16, 1, '2026-01-11 04:43:14', '2026-01-21 09:22:41', '2026-01-21 09:22:41'),
(11, 24, 0, '2026-01-14', '2026-01-14', 1, NULL, NULL, 'আগামী (১৪/১/২০২৬) বুধবার, আমার অনার্স ৩য় বর্ষের পরীক্ষা। তাই উক্ত দিনে আমার \"ইচ্ছা থাকা সত্ত্বেও\" অফিসে উপস্থিত থাকতে পারছি না। আশা করি, আমার পরিস্থিতি বিবেচনায় উক্ত দিনের ছুটি মঞ্জুর করে Storola কর্তৃপক্ষ আমাকে সাহায্য করবে।', 'pending', NULL, 24, 1, '2026-01-12 17:10:01', '2026-01-21 09:22:37', '2026-01-21 09:22:37'),
(12, 4, 0, '2026-01-19', '2026-01-22', 4, NULL, NULL, 'Dear Concerned,\n\nAssalamuWalaikum,\nI hope you are doing really well by the grace of Allah. I would like to request leave from January 19 to January 22 as I am planning to go on a family vacation during this period.\nI will ensure that all my responsibilities are managed in advance, and I will remain available on phone for any urgent matters if needed.\n\nKindly consider my request and grant me leave for the mentioned dates.\n\nThank you for your understanding.', 'pending', NULL, 4, 1, '2026-01-14 11:22:58', '2026-01-21 09:22:32', '2026-01-21 09:22:32'),
(13, 26, 0, '2026-01-18', '2026-01-19', 2, NULL, NULL, 'Going to hometown', 'pending', NULL, 26, 1, '2026-01-15 04:54:12', '2026-01-21 09:22:26', '2026-01-21 09:22:26'),
(14, 24, 0, '2026-01-19', '2026-01-19', 1, NULL, NULL, 'আগামী (১৮/১/২০২৬) বুধবার, আমার অনার্স ৩য় বর্ষের পরীক্ষা। তাই উক্ত দিনে আমার \"ইচ্ছা থাকা সত্ত্বেও\" অফিসে উপস্থিত থাকতে পারছি না। আশা করি, আমার পরিস্থিতি বিবেচনায় উক্ত দিনের ছুটি মঞ্জুর করে Storola কর্তৃপক্ষ আমাকে সাহায্য করবে।', 'pending', NULL, 24, 1, '2026-01-17 12:16:42', '2026-01-21 09:22:21', '2026-01-21 09:22:21'),
(15, 19, 0, '2026-01-21', '2026-01-21', 1, NULL, NULL, 'rtyr', 'pending', NULL, 19, 1, '2026-01-18 13:55:41', '2026-01-19 05:36:43', '2026-01-19 05:36:43'),
(16, 24, 0, '2026-01-22', '2026-01-22', 1, NULL, NULL, 'আগামী (২১/১/২০২৬) বুধবার, আমার অনার্স ৩য় বর্ষের পরীক্ষা। তাই উক্ত দিনে আমার \"ইচ্ছা থাকা সত্ত্বেও\" অফিসে উপস্থিত থাকতে পারছি না। আশা করি, আমার পরিস্থিতি বিবেচনায় উক্ত দিনের ছুটি মঞ্জুর করে Storola কর্তৃপক্ষ আমাকে সাহায্য করবে।', 'pending', NULL, 24, 1, '2026-01-20 05:48:25', '2026-01-21 09:22:00', '2026-01-21 09:22:00'),
(17, 19, 0, '2026-01-08', '2026-01-15', 8, NULL, NULL, 'testing', 'pending', NULL, 19, 1, '2026-01-21 08:33:44', '2026-01-21 08:34:34', '2026-01-21 08:34:34'),
(18, 25, 0, '2026-01-01', '2026-01-01', 1, NULL, NULL, 'Cousin Wedding Purpose Leave', 'swap', NULL, 25, NULL, '2026-01-21 11:20:54', '2026-01-21 11:26:19', NULL),
(19, 25, 0, '2026-01-03', '2026-01-03', 1, NULL, NULL, 'Cousin Wedding Purpose Leave', 'swap', NULL, 25, NULL, '2026-01-21 11:21:55', '2026-01-21 11:26:11', NULL),
(20, 25, 0, '2026-01-10', '2026-01-10', 1, NULL, NULL, 'Semester final exam purpose leave', 'approved', NULL, 25, NULL, '2026-01-21 11:24:01', '2026-01-21 11:27:01', NULL),
(21, 25, 0, '2026-01-24', '2026-01-24', 1, NULL, NULL, 'Semester Final Exam perpose Leave', 'approved', NULL, 25, NULL, '2026-01-21 11:24:43', '2026-01-21 11:26:54', NULL),
(22, 17, 0, '2026-01-10', '2026-01-10', 1, NULL, NULL, 'I\'m going to my home in Tangail. There\'s a family function that I need to attend.', 'approved', NULL, 17, NULL, '2026-01-21 11:27:29', '2026-01-21 11:30:12', NULL),
(23, 16, 0, '2026-02-20', '2026-02-21', 2, NULL, NULL, 'পারিবারিক কাজের জন্য ছুটির আবেদন', 'pending', NULL, 16, NULL, '2026-01-21 12:24:13', '2026-02-18 05:53:58', NULL),
(24, 14, 0, '2026-01-04', '2026-01-04', 1, NULL, NULL, 'Exam', 'swap', NULL, 14, NULL, '2026-01-21 12:26:28', '2026-01-22 11:45:14', NULL),
(25, 14, 0, '2026-01-18', '2026-01-18', 1, NULL, NULL, 'Exam', 'approved', NULL, 14, NULL, '2026-01-21 12:26:49', '2026-01-22 11:45:24', NULL),
(26, 14, 0, '2026-01-21', '2026-01-21', 1, NULL, NULL, 'Exam', 'approved', NULL, 14, NULL, '2026-01-21 12:27:06', '2026-01-22 11:45:31', NULL),
(27, 26, 0, '2026-01-12', '2026-01-13', 2, NULL, NULL, 'Going to Hometown', 'approved', NULL, 26, NULL, '2026-01-22 05:38:21', '2026-01-22 05:51:13', NULL),
(28, 14, 0, '2026-01-22', '2026-01-22', 1, NULL, NULL, 'Exam', 'pending', NULL, 14, 1, '2026-01-22 09:29:17', '2026-01-22 11:46:08', '2026-01-22 11:46:08'),
(29, 8, 0, '2026-01-10', '2026-01-10', 1, NULL, NULL, 'Physical Illness', 'pending', NULL, 8, NULL, '2026-01-22 13:32:04', '2026-01-22 13:32:04', NULL),
(30, 24, 0, '2025-12-11', '2025-12-11', 1, NULL, NULL, 'আমার অনার্স ৩য় বর্ষের ১ম এক্সাম, তাই (১১/১২/২০২৫) তারিখে ছুটি নেওয়া হয়েছিলো।', 'pending', NULL, 24, 1, '2026-01-27 05:16:40', '2026-01-27 05:28:44', '2026-01-27 05:28:44'),
(31, 24, 0, '2026-01-04', '2026-01-04', 1, NULL, NULL, 'আমার অনার্স ৩য় বর্ষের ২য় এক্সাম, তাই (০৪/০১/২০২৬) তারিখে ছুটি নেওয়া হয়েছিলো।', 'pending', NULL, 24, NULL, '2026-01-27 05:17:54', '2026-01-27 05:27:23', NULL),
(32, 24, 0, '2026-01-07', '2026-01-07', 1, NULL, NULL, 'আমার অনার্স ৩য় বর্ষের ৩য় এক্সাম, তাই (০৭/০১/২০২৬) তারিখে ছুটি নেওয়া হয়েছিলো।', 'pending', NULL, 24, NULL, '2026-01-27 05:18:22', '2026-01-27 05:26:57', NULL),
(33, 24, 0, '2026-01-11', '2026-01-11', 1, NULL, NULL, 'আমার অনার্স ৩য় বর্ষের ৪র্থ এক্সাম, তাই (১১/০১/২০২৬) তারিখে ছুটি নেওয়া হয়েছিলো।', 'pending', NULL, 24, NULL, '2026-01-27 05:19:13', '2026-01-27 05:28:17', NULL),
(34, 24, 0, '2026-01-14', '2026-01-14', 1, NULL, NULL, 'আমার অনার্স ৩য় বর্ষের ৫ম এক্সাম, তাই (১৪/০১/২০২৬) তারিখে ছুটি নেওয়া হয়েছিলো।', 'pending', NULL, 24, NULL, '2026-01-27 05:21:01', '2026-01-27 05:26:37', NULL),
(35, 24, 0, '2026-01-18', '2026-01-18', 1, NULL, NULL, 'আমার অনার্স ৩য় বর্ষের ৬ষ্ঠ এক্সাম, তাই (১৮/০১/২০২৬) তারিখে ছুটি নেওয়া হয়েছিলো।', 'pending', NULL, 24, NULL, '2026-01-27 05:21:55', '2026-01-27 05:26:12', NULL),
(36, 24, 0, '2026-01-21', '2026-01-21', 1, NULL, NULL, 'আমার অনার্স ৩য় বর্ষের ৭ম এক্সাম, তাই (২১/০১/২০২৬) তারিখে ছুটি নেওয়া হয়েছিলো।', 'pending', NULL, 24, NULL, '2026-01-27 05:22:21', '2026-01-27 05:24:17', NULL),
(37, 24, 0, '2026-01-29', '2026-01-29', 1, NULL, NULL, 'আমার অনার্স ৩য় বর্ষের ৮ম এক্সাম, তাই (২৯/০১/২০২৬) তারিখে ছুটি নেওয়া হবে। আমার অনার্স ৩য় বর্ষের ৮ম এক্সাম, তাই (২৯/০১/২০২৬) তারিখে ছুটি নেওয়া হবে।', 'pending', NULL, 24, NULL, '2026-01-27 05:23:01', '2026-03-01 01:18:41', NULL),
(38, 10, 0, '2026-02-05', '2026-02-05', 1, NULL, NULL, 'আমি ব্যক্তিগত কারণে আগামী 5 ফেব্রুয়ারি কিছু জরুরি কাজ মিটাতে ও পরিবারের সঙ্গে গুরুত্বপূর্ণ সময় কাটানোর জন্য ছুটি নিতে চাই। আশা করি এই সময়কালে আমার অনুপস্থিতি কোন সমস্যার সৃষ্টি করবে না।  আপনার সহযোগিতার জন্য এবং অনুমতির অপেক্ষায় থাকব।', 'pending', NULL, 10, NULL, '2026-01-29 15:56:36', '2026-01-29 15:57:16', NULL),
(39, 19, 0, '2026-02-12', '2026-02-12', 1, NULL, NULL, 'test3 Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'swap', NULL, 19, NULL, '2026-02-09 23:47:52', '2026-03-01 01:23:08', NULL),
(40, 19, 0, '2026-02-13', '2026-02-14', 2, NULL, NULL, 'test1', 'swap', NULL, 19, NULL, '2026-02-09 23:54:37', '2026-02-10 00:06:55', NULL),
(41, 19, 0, '2026-02-13', '2026-02-14', 2, NULL, NULL, 'test1', 'rejected', NULL, 19, NULL, '2026-02-09 23:54:39', '2026-02-10 00:06:48', NULL),
(42, 19, 0, '2026-02-12', '2026-02-13', 2, NULL, NULL, 'test2', 'approved', NULL, 19, NULL, '2026-02-09 23:55:14', '2026-02-10 00:06:42', NULL),
(43, 3, 0, '2026-02-11', '2026-02-12', 2, NULL, NULL, 'test-sagaor-01', 'approved', NULL, 1, 1, '2026-02-10 00:23:33', '2026-02-26 02:10:37', '2026-02-26 02:10:37'),
(44, 19, 0, '2026-02-11', '2026-02-11', 1, NULL, NULL, 'testing today', 'approved', NULL, 1, 1, '2026-02-10 00:38:13', '2026-02-18 06:10:38', '2026-02-18 06:10:38'),
(45, 11, 0, '2026-02-18', '2026-02-19', 2, NULL, NULL, 'tytyt', 'pending', NULL, 1, 1, '2026-02-18 05:51:31', '2026-02-18 08:26:45', '2026-02-18 08:26:45'),
(46, 19, 0, '2026-02-20', '2026-02-21', 2, NULL, NULL, 'werfwer', 'pending', NULL, 19, 19, '2026-02-18 06:28:15', '2026-02-18 08:04:44', '2026-02-18 08:04:44'),
(47, 19, 0, '2026-02-21', '2026-02-21', 1, NULL, NULL, 'asdsad', 'pending', NULL, 19, 19, '2026-02-18 06:54:33', '2026-02-18 08:07:57', '2026-02-18 08:07:57'),
(48, 1, 0, '2026-02-20', '2026-02-21', 2, NULL, NULL, 'ff', 'pending', NULL, 1, 1, '2026-02-20 04:52:45', '2026-02-20 06:18:06', '2026-02-20 06:18:06'),
(49, 1, 0, '2026-02-20', '2026-02-21', 2, NULL, NULL, 'jjj', 'pending', NULL, 1, 1, '2026-02-20 04:59:56', '2026-02-20 06:17:57', '2026-02-20 06:17:57'),
(50, 1, 0, '2026-02-20', '2026-02-21', 2, NULL, NULL, 'test', 'pending', NULL, 1, 1, '2026-02-20 05:15:11', '2026-02-20 06:17:51', '2026-02-20 06:17:51'),
(51, 1, 0, '2026-02-21', '2026-02-28', 8, NULL, NULL, 'test3', 'pending', NULL, 1, 1, '2026-02-20 05:22:05', '2026-02-20 06:17:43', '2026-02-20 06:17:43'),
(52, 1, 0, '2026-02-20', '2026-02-21', 2, NULL, NULL, 'hh', 'pending', NULL, 1, 1, '2026-02-20 06:16:06', '2026-02-20 06:17:37', '2026-02-20 06:17:37'),
(53, 3, 0, '2026-02-20', '2026-02-21', 2, NULL, NULL, 'test1', 'approved', NULL, 1, 1, '2026-02-20 06:23:15', '2026-02-26 02:07:50', '2026-02-26 02:07:50'),
(54, 1, 0, '2026-02-21', '2026-02-22', 2, NULL, NULL, 'test2', 'pending', NULL, 1, 1, '2026-02-20 06:24:30', '2026-02-20 06:33:39', '2026-02-20 06:33:39'),
(55, 1, 0, '2026-02-21', '2026-02-22', 2, NULL, NULL, 'test 2', 'pending', NULL, 1, 1, '2026-02-20 06:36:50', '2026-02-26 01:20:20', '2026-02-26 01:20:20'),
(56, 1, 0, '2026-02-20', '2026-02-21', 2, NULL, NULL, 'test 2', 'pending', NULL, 1, 1, '2026-02-20 06:38:14', '2026-02-26 01:20:27', '2026-02-26 01:20:27'),
(57, 19, 0, '2026-02-23', '2026-02-24', 2, NULL, NULL, 'shafa-test1', 'pending', NULL, 19, 19, '2026-02-20 23:19:52', '2026-02-21 02:46:14', '2026-02-21 02:46:14'),
(58, 19, 0, '2026-02-23', '2026-02-24', 2, NULL, NULL, 'test', 'approved', NULL, 19, NULL, '2026-02-21 02:46:49', '2026-02-21 02:48:10', NULL),
(59, 19, 0, '2026-02-23', '2026-02-23', 1, NULL, NULL, 'hi', 'pending', NULL, 19, 19, '2026-02-21 02:52:46', '2026-02-21 02:53:13', '2026-02-21 02:53:13'),
(60, 19, 0, '2026-02-22', '2026-02-22', 1, NULL, NULL, 'test', 'swap', '2026-02-24', 19, NULL, '2026-02-21 21:59:39', '2026-02-24 05:17:11', NULL),
(61, 3, 0, '2026-02-24', '2026-02-25', 2, NULL, NULL, 'test', 'rejected', NULL, 1, 1, '2026-02-24 05:00:02', '2026-02-24 05:17:56', '2026-02-24 05:17:56'),
(62, 27, 0, '2026-02-26', '2026-02-28', 3, NULL, NULL, 'test prurpose', 'approved', NULL, 1, NULL, '2026-02-26 01:01:54', '2026-02-26 01:01:54', NULL),
(63, 3, 0, '2026-02-25', '2026-02-25', 1, NULL, NULL, 'test', 'approved', NULL, 1, NULL, '2026-02-26 02:07:19', '2026-02-26 02:07:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leave_request_attachments`
--

CREATE TABLE `leave_request_attachments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leave_request_id` bigint(20) UNSIGNED NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_request_attachments`
--

INSERT INTO `leave_request_attachments` (`id`, `leave_request_id`, `file`, `created_at`, `updated_at`) VALUES
(1, 54, 'application_picture.jpg', '2026-02-20 06:24:30', '2026-02-20 06:24:30'),
(4, 56, 'Sig.jpg', '2026-02-20 07:34:39', '2026-02-20 07:34:39'),
(25, 58, 'application_picture.jpg', '2026-02-21 02:46:49', '2026-02-21 02:46:49'),
(26, 58, 'pic.jpg', '2026-02-21 02:46:49', '2026-02-21 02:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(161) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `collection_name` varchar(161) NOT NULL,
  `name` varchar(161) NOT NULL,
  `file_name` varchar(161) NOT NULL,
  `mime_type` varchar(161) DEFAULT NULL,
  `disk` varchar(161) NOT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `manipulations` longtext NOT NULL,
  `custom_properties` longtext NOT NULL,
  `responsive_images` longtext NOT NULL,
  `order_column` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `conversions_disk` varchar(255) DEFAULT NULL,
  `uuid` char(36) DEFAULT NULL,
  `generated_conversions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `model_type`, `model_id`, `collection_name`, `name`, `file_name`, `mime_type`, `disk`, `size`, `manipulations`, `custom_properties`, `responsive_images`, `order_column`, `created_at`, `updated_at`, `conversions_disk`, `uuid`, `generated_conversions`) VALUES
(2, 'App\\Models\\Task', 31, 'attachments', 'WhatsApp Image 2026-01-23 at 7.35.58 PM', 'WhatsApp-Image-2026-01-23-at-7.35.58-PM.jpeg', 'image/jpeg', 'public', 21129, '[]', '[]', '[]', 1, '2026-01-28 05:35:03', '2026-01-28 05:35:03', 'public', 'e148b039-c33d-40d1-8911-ce9235a3138b', '[]'),
(3, 'App\\Models\\Task', 22, 'attachments', 'arae', 'arae.JPG', 'image/jpeg', 'public', 60807, '[]', '[]', '[]', 1, '2026-01-28 05:49:36', '2026-01-28 05:49:36', 'public', '6b97bef6-b7f6-40f0-b937-d2f84aa5121a', '[]'),
(4, 'App\\Models\\Task', 34, 'attachments', 'arae', 'arae.JPG', 'image/jpeg', 'public', 20483, '[]', '[]', '[]', 1, '2026-01-28 06:33:33', '2026-01-28 06:33:33', 'public', '19fd9e49-59f0-4ca4-8102-12829210e01a', '[]'),
(5, 'App\\Models\\Task', 37, 'attachments', '144', '144.jpeg', 'image/jpeg', 'public', 140690, '[]', '[]', '[]', 1, '2026-01-28 06:45:52', '2026-01-28 06:45:52', 'public', '29d32276-f149-46c9-ab8f-eec0a0b103ea', '[]'),
(6, 'App\\Models\\Task', 42, 'attachments', 'Screenshot_355', 'Screenshot_355.png', 'image/png', 'public', 300468, '[]', '[]', '[]', 1, '2026-01-28 06:59:48', '2026-01-28 06:59:48', 'public', 'cf93d1f5-b36b-4f75-bc82-d92ff798cd92', '[]'),
(8, 'App\\Models\\Task', 43, 'attachments', 'Screenshot_356', 'Screenshot_356.png', 'image/png', 'public', 338759, '[]', '[]', '[]', 1, '2026-01-28 07:02:47', '2026-01-28 07:02:47', 'public', 'd779336d-abbb-4453-8cc6-e4d0fd6f4ec1', '[]'),
(9, 'App\\Models\\Task', 60, 'attachments', 'Screenshot_298', 'Screenshot_298.png', 'image/png', 'public', 294821, '[]', '[]', '[]', 1, '2026-01-28 08:20:23', '2026-01-28 08:20:23', 'public', '1432e4ca-b493-4b48-99ab-1676be256fd4', '[]'),
(10, 'App\\Models\\Task', 61, 'attachments', 'Screenshot_299', 'Screenshot_299.png', 'image/png', 'public', 512801, '[]', '[]', '[]', 1, '2026-01-28 08:21:16', '2026-01-28 08:21:16', 'public', '81955b73-6043-4e3c-a053-985f54ca6ccc', '[]'),
(11, 'App\\Models\\Task', 62, 'attachments', 'Screenshot_300', 'Screenshot_300.png', 'image/png', 'public', 224057, '[]', '[]', '[]', 1, '2026-01-28 08:23:55', '2026-01-28 08:23:55', 'public', '085bad36-a9c1-401c-a2c8-975242c513e9', '[]'),
(12, 'App\\Models\\Task', 63, 'attachments', 'Screenshot_301', 'Screenshot_301.png', 'image/png', 'public', 107129, '[]', '[]', '[]', 1, '2026-01-28 08:25:54', '2026-01-28 08:25:54', 'public', '46b7ecd8-daef-4322-b97c-ff81f209cafb', '[]'),
(14, 'App\\Models\\Task', 68, 'attachments', 'atarra', 'atarra.JPG', 'image/jpeg', 'public', 23805, '[]', '[]', '[]', 1, '2026-01-28 09:29:14', '2026-01-28 09:29:14', 'public', '3326fefc-70d3-4898-954b-da2e627fadbd', '[]'),
(15, 'App\\Models\\Task', 66, 'attachments', 'ar', 'ar.JPG', 'image/jpeg', 'public', 26938, '[]', '[]', '[]', 1, '2026-01-28 09:29:40', '2026-01-28 09:29:40', 'public', '9decdd89-a722-4a59-a8b4-45e9411cc561', '[]'),
(17, 'App\\Models\\Task', 65, 'attachments', 'aarae', 'aarae.JPG', 'image/jpeg', 'public', 14158, '[]', '[]', '[]', 1, '2026-01-28 09:30:54', '2026-01-28 09:30:54', 'public', 'b9141739-dd6c-4514-ba86-f32e1e4c3114', '[]'),
(18, 'App\\Models\\Task', 70, 'attachments', 'aaeae', 'aaeae.JPG', 'image/jpeg', 'public', 39747, '[]', '[]', '[]', 1, '2026-01-28 10:36:40', '2026-01-28 10:36:40', 'public', '38a35c62-73ac-47b4-8c25-d64a6df3c50b', '[]'),
(19, 'App\\Models\\Task', 71, 'attachments', 'araeea', 'araeea.JPG', 'image/jpeg', 'public', 48311, '[]', '[]', '[]', 1, '2026-01-28 10:44:09', '2026-01-28 10:44:09', 'public', '1105842e-c60d-4f40-9b85-44c78420e5d4', '[]'),
(20, 'App\\Models\\User', 10, 'users', 'profile-update-4', 'profile-update-4.png', 'image/png', 'public', 2022287, '[]', '[]', '[]', 1, '2026-01-29 15:15:18', '2026-01-29 15:15:18', 'public', 'bbb09272-6d5e-4ec7-9009-fa98c3b0114d', '[]'),
(21, 'App\\Models\\Task', 152, 'attachments', 'ararae', 'ararae.JPG', 'image/jpeg', 'public', 41311, '[]', '[]', '[]', 1, '2026-01-30 13:36:48', '2026-01-30 13:36:48', 'public', 'f9036d76-1f6b-4cb2-a137-530c2fde0a0a', '[]'),
(22, 'App\\Models\\Task', 220, 'attachments', 'pic', 'pic.jpg', 'image/jpeg', 'public', 157585, '[]', '[]', '[]', 1, '2026-02-18 22:14:11', '2026-02-18 22:14:11', 'public', 'cb6a7611-d4a1-40dc-9a36-bed47d929de3', '[]');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_05_02_101439_create_activity_types_table', 1),
(4, '2019_05_02_101619_create_clients_table', 1),
(5, '2019_05_03_043336_create_tags_table', 1),
(6, '2019_05_03_050601_create_projects_table', 1),
(7, '2019_05_03_060503_create_tasks_table', 1),
(8, '2019_05_03_072634_create_task_tags_table', 1),
(9, '2019_05_03_094616_create_time_entries_table', 1),
(10, '2019_05_22_115729_create_table_task_assignees', 1),
(11, '2019_06_11_062240_create_project_users_table', 1),
(12, '2019_06_18_093135_create_table_task_attachment', 1),
(13, '2019_06_19_045436_create_status_table', 1),
(14, '2019_06_21_124817_create_comments_table', 1),
(15, '2019_07_06_121218_create_reports_table', 1),
(16, '2019_07_08_114940_create_table_report_filters', 1),
(17, '2019_07_19_055226_populate_project_users_table', 1),
(18, '2019_08_19_000000_create_failed_jobs_table', 1),
(19, '2019_09_14_060733_create_permission_tables', 1),
(20, '2019_10_15_095114_add_salary_in_users', 1),
(21, '2020_02_19_134502_create_settings_table', 1),
(22, '2020_04_08_105133_create_departments_table', 1),
(23, '2020_04_08_115453_add_department_id_to_clients_table', 1),
(24, '2020_08_06_045725_create_taxes_table', 1),
(25, '2020_08_06_071644_create_invoices_table', 1),
(26, '2020_08_07_110611_create_invoice_items_table', 1),
(27, '2020_08_08_053928_create_media_table', 1),
(28, '2020_09_21_050626_create_report_invoices_table', 1),
(29, '2020_10_05_055541_add_discount_apply_field_to_invoice_table', 1),
(30, '2020_10_05_070445_create_invoice_projects_table', 1),
(31, '2020_10_05_070527_create_invoice_clients_table', 1),
(32, '2020_10_09_063902_add_budget_type_to_projects_table', 1),
(33, '2020_11_06_114032_add_status_feild_to_projects_table', 1),
(34, '2020_11_20_090538_add_meta_to_reports_table', 1),
(35, '2020_11_21_083148_add_calender_view_permission_to_permissions_table', 1),
(36, '2020_11_25_074504_add_group_to_setting_table', 1),
(37, '2020_12_12_092228_add_user_id_to_clients', 1),
(38, '2020_12_12_092404_add_owner_id_and_owner_type_to_users', 1),
(39, '2020_12_15_153246_add_manage_status_permission_to_permissions_table', 1),
(40, '2021_01_02_043241_remove_soft_deleted_tags_from_tags_table', 1),
(41, '2021_01_16_112850_create_expenses_table', 1),
(42, '2021_02_02_091125_change_budget_column_type_in_projects', 1),
(43, '2021_02_04_085602_remove_task_tag_entry_from_pivot_table', 1),
(44, '2021_02_12_050509_make_fields_nullable_of_projects_table', 1),
(45, '2021_02_23_051251_create_activity_log_table', 1),
(46, '2021_03_24_070000_create_notifications_table', 1),
(47, '2021_04_12_112648_create_events_table', 1),
(48, '2021_04_16_084448_add_estimate_field_to_tasks_table', 1),
(49, '2021_05_10_112220_create_user_notifications_table', 1),
(50, '2021_06_29_115255_remove_activity_log_of_users', 1),
(51, '2021_07_12_000000_add_uuid_to_failed_jobs_table', 1),
(52, '2021_07_1_103036_add_conversions_disk_column_in_media_table', 1),
(53, '2021_12_31_041836_add_order_to_status_table', 1),
(54, '2022_05_19_085808_change_column_length_table', 1),
(55, '2022_09_10_042604_add_google_recaptcha_field_in_settings', 1),
(56, '2022_09_14_040402_change_amount_field_type_in_expenses_table', 1),
(57, '2022_12_23_091932_add_event_column_to_activity_log_table', 1),
(58, '2022_12_23_091933_add_batch_uuid_column_to_activity_log_table', 1),
(59, '2023_04_01_035635_add_soft_delete_user_permission_to_permissions_table', 1),
(60, '2023_05_30_104525_assign_task_management_to_client_role', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(170) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(170) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 6),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4),
(2, 'App\\Models\\User', 8),
(2, 'App\\Models\\User', 10),
(2, 'App\\Models\\User', 11),
(2, 'App\\Models\\User', 12),
(2, 'App\\Models\\User', 13),
(2, 'App\\Models\\User', 14),
(2, 'App\\Models\\User', 15),
(2, 'App\\Models\\User', 16),
(2, 'App\\Models\\User', 17),
(2, 'App\\Models\\User', 18),
(2, 'App\\Models\\User', 19),
(2, 'App\\Models\\User', 20),
(2, 'App\\Models\\User', 22),
(2, 'App\\Models\\User', 23),
(2, 'App\\Models\\User', 24),
(2, 'App\\Models\\User', 25),
(2, 'App\\Models\\User', 26),
(2, 'App\\Models\\User', 41),
(3, 'App\\Models\\User', 27),
(3, 'App\\Models\\User', 42);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `first_notification_hour` varchar(255) DEFAULT NULL,
  `second_notification_hour` varchar(255) DEFAULT NULL,
  `third_notification_hour` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(170) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'manage_calendar_view', 'web', 'Manage Calendar View', '<p>Able to access Setting tab.</p>', '2023-06-12 23:11:21', '2023-06-12 23:11:21'),
(2, 'manage_status', 'web', 'Manage Status', '<p>Able to access Status tab.</p>', '2023-06-12 23:11:21', '2023-06-12 23:11:21'),
(3, 'archived_users', 'web', 'Archived Users', NULL, '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(4, 'manage_clients', 'web', 'Manage Clients', '<p>Visible clients tab and manage it.</p>', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(5, 'manage_projects', 'web', 'Manage Projects', '<p>Project tab visible and manage it.</p>', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(6, 'manage_all_tasks', 'web', 'Manage Tasks', '<p>All projects list comes into Project filter otherwise comes only related projects.Assignee Filter visible in task module otherwise own assigned and non-assigned.</p>', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(7, 'manage_time_entries', 'web', 'Manage Entry', '<p>User can manage own time entry.</p>', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(8, 'manage_users', 'web', 'Manage Users', '<p>User tab visible</p>', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(9, 'manage_tags', 'web', 'Manage Tags', '<p>Able to access tags tab.</p>', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(10, 'manage_activities', 'web', 'Manage Activities', '<p>Able to access Activity tab.</p>', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(11, 'manage_reports', 'web', 'Manage Reports', '<p></p>', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(12, 'manage_roles', 'web', 'Manage Roles', '<p></p>', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(13, 'manage_taxes', 'web', 'Manage Taxes', '<p>Able to access Taxes tab.</p>', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(14, 'manage_invoices', 'web', 'Manage Invoices', '<p>Able to access Invoices tab.</p>', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(15, 'manage_settings', 'web', 'Manage Settings', '<p>Able to access Setting tab.</p>', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(16, 'manage_department', 'web', 'Manage Department', NULL, '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(17, 'manage_expenses', 'web', 'Manage Expenses', NULL, '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(18, 'manage_activity_log', 'web', 'Manage Activity Log', NULL, '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(19, 'manage_events', 'web', 'Manage Events', NULL, '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(20, 'role_client', 'web', 'Role Client', '<p>Able to access Client Panel.</p>', '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(21, 'manage_leads', 'web', 'Manage Leads Management\r\n', '<p>Able to access Leads Management\n.</p>', '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(22, 'manage_lead_sources', 'web', 'Manage Leads sources\r\n', '<p>Able to access Leads sources\r\n.</p>', '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(23, 'manage_lead_stages', 'web', 'Manage Leads Stages\r\n', '<p>Able to access Leads stages\r\n.</p>', '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(24, 'manage_lead_bulk_upload', 'web', 'Manage Leads Bulk Upload\r\n', '<p>Able to access Leads stages\r\n.</p>', '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(25, 'manage_leave_requests', 'web', 'Manage Leave Requests\r\n', '<p>Able to access Leave Requests\r\n.</p>', '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(26, 'manage_task_reports', 'web', 'Manage Task Reports', '<p></p>', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(27, 'manage_absents', 'web', 'Manage Absent\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n', '<p>Able to access Absent\r\n.</p>', '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(31, 'manage_extensions', 'web', 'Manage Extensions Requests\r\n', '<p>Able to access Extensions\r\n.</p>', '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(32, 'manage_call_records', 'web', 'Manage Call Records Requests\r\n', '<p>Able to access Call Records\r\n.</p>', '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(33, 'manage_commissions', 'web', 'Manage Commissions', '<p>User Commissions Management</p>', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(34, 'manage_job_status', 'web', 'Manage Job Status', '<p>Able to access Job Status tab.</p>', '2026-02-20 23:11:21', '2026-02-20 23:11:21'),
(35, 'manage_job_type', 'web', 'Manage Job Type', '<p>Able to access Job Type tab.</p>', '2026-02-20 23:11:21', '2026-02-20 23:11:21'),
(36, 'manage_salary', 'web', 'Manage Salary', '<p>Able to access Salary tab.</p>', '2026-02-20 23:11:21', '2026-02-20 23:11:21'),
(37, 'manage_salary_acknowledgement', 'web', 'Manage Salary Acknowledgement', '<p>Able to access Salary Acknowledgement tab.</p>', '2026-02-26 23:11:21', '2026-02-26 23:11:21'),
(38, 'manage_attendence', 'web', 'Manage Attendence', '<p>Able to access Attendence Page .</p>', '2026-02-26 23:11:21', '2026-02-26 23:11:21'),
(39, 'manage_user_attendence', 'web', 'Manage User Attendence', '<p>Able to access User Attendence Report Page.</p>', '2026-02-26 23:11:21', '2026-02-26 23:11:21'),
(40, 'manage_policies', 'web', 'Manage Policy', '<p>Able to access Policy.</p>', '2023-06-12 23:11:21', '2023-06-12 23:11:21');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(170) NOT NULL,
  `client_id` int(10) UNSIGNED DEFAULT NULL,
  `description` text NOT NULL,
  `price` bigint(20) DEFAULT NULL,
  `currency` int(11) DEFAULT NULL,
  `prefix` varchar(170) NOT NULL,
  `color` varchar(255) NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `budget_type` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `domain_name` varchar(255) DEFAULT NULL,
  `job_type` tinyint(4) DEFAULT 0,
  `is_digital_marketing` int(11) DEFAULT 0,
  `is_ecommerce_saas` tinyint(1) NOT NULL DEFAULT 0,
  `is_custom_software` tinyint(1) NOT NULL DEFAULT 0,
  `is_in_house_development` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `client_id`, `description`, `price`, `currency`, `prefix`, `color`, `created_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`, `budget_type`, `status`, `domain_name`, `job_type`, `is_digital_marketing`, `is_ecommerce_saas`, `is_custom_software`, `is_in_house_development`) VALUES
(1, 'innodemy.com', 1, '', NULL, NULL, 'INNODEMY', '#3F51B5', 4, NULL, '2026-01-27 11:21:14', '2026-01-27 11:21:14', NULL, NULL, 1, 'innodemy.com', 1, 1, 0, 0, 0),
(2, 'Sunnah Fashion', 9, '', 11000, 7, 'SUNNAHFA', '#3F51B5', 10, NULL, '2026-01-27 11:49:22', '2026-02-03 03:30:52', NULL, 1, 2, 'SunnahFashion.con', 1, 1, 0, 0, 0),
(3, 'Flex Leather', 14, '', 7000, 7, 'FLEXLEAT', '#3F51B5', 10, NULL, '2026-01-27 11:57:21', '2026-01-28 11:41:43', NULL, 1, 1, NULL, 1, 1, 0, 0, 0),
(4, 'Trustyshop', 19, '', 4000, 7, 'TRUSTYSH', '#3F51B5', 10, NULL, '2026-01-27 11:58:18', '2026-01-28 11:44:29', NULL, 1, 1, NULL, 1, 1, 0, 0, 0),
(5, 'Fast Bag Bazar', 16, '', 7000, 7, 'FASTBAGB', '#3F51B5', 10, NULL, '2026-01-27 11:59:22', '2026-01-28 11:44:44', NULL, 1, 1, NULL, 1, 1, 0, 0, 0),
(6, 'Powernest BD', 18, '', 3000, 7, 'POWERNES', '#3F51B5', 10, NULL, '2026-01-27 12:00:34', '2026-01-28 11:45:01', NULL, 1, 1, NULL, 1, 1, 0, 0, 0),
(7, 'Tracker', 21, '', NULL, NULL, 'TRACKER', '#3F51B5', 1, 1, '2026-01-27 12:04:08', '2026-01-27 12:38:36', '2026-01-27 12:38:36', NULL, 1, NULL, 0, 0, 0, 0, 0),
(8, 'lavogos', 22, '', 7000, 7, 'LAVOGOS', '#3F51B5', 22, NULL, '2026-01-27 12:05:18', '2026-01-28 11:45:34', NULL, 1, 1, NULL, 1, 1, 0, 0, 0),
(9, 'khalisfood', 23, '', NULL, NULL, 'KHALISFO', '#3F51B5', 22, NULL, '2026-01-27 12:07:49', '2026-01-27 12:07:49', NULL, NULL, 1, NULL, 1, 1, 0, 0, 0),
(10, 'Shuddho Mart', 20, '', 3500, 7, 'SHUDDHOM', '#3F51B5', 22, NULL, '2026-01-27 12:08:10', '2026-01-28 11:45:52', NULL, 1, 1, NULL, 1, 1, 0, 0, 0),
(11, 'naturalfoodhouse', 17, '', 5000, 7, 'NATURALF', '#3F51B5', 22, NULL, '2026-01-27 12:08:30', '2026-01-28 11:46:13', NULL, 1, 1, NULL, 1, 1, 0, 0, 0),
(12, 'ecomazeeastern.com', 13, '', 6500, 7, 'ECOMAZEE', '#3F51B5', 22, NULL, '2026-01-27 12:08:48', '2026-01-28 11:46:47', NULL, 0, 1, NULL, 1, 1, 0, 0, 0),
(13, 'Applegenbd', 12, '', 6000, 7, 'APPLEGEN', '#3F51B5', 22, NULL, '2026-01-27 12:09:11', '2026-01-28 11:47:29', NULL, 1, 1, NULL, 1, 1, 0, 0, 0),
(14, 'SOR Traders', 11, '', 7000, 7, 'SORTRADE', '#3F51B5', 22, NULL, '2026-01-27 12:09:32', '2026-01-28 11:47:11', NULL, 1, 1, NULL, 1, 1, 0, 0, 0),
(15, 'Apon Mart', 10, '', 10000, 7, 'APONMART', '#3F51B5', 22, NULL, '2026-01-27 12:09:50', '2026-02-03 03:37:56', NULL, 1, 2, NULL, 1, 1, 0, 0, 0),
(16, 'Fashioncraftbd', 8, '', 6500, 7, 'FASHIONC', '#3F51B5', 22, NULL, '2026-01-27 12:10:10', '2026-01-28 11:48:10', NULL, 1, 1, NULL, 1, 1, 0, 0, 0),
(17, 'The Toy Cart', 7, '', 8000, 7, 'THETOYCA', '#3F51B5', 22, NULL, '2026-01-27 12:10:26', '2026-01-29 07:09:43', NULL, 1, 2, NULL, 1, 1, 0, 0, 0),
(18, 'Hurramlifestyle', 5, '', 7000, 7, 'HURRAMLI', '#3F51B5', 22, NULL, '2026-01-27 12:10:42', '2026-01-28 13:01:27', NULL, 1, 1, NULL, 1, 1, 0, 0, 0),
(19, 'buyingbd', 4, '', 5000, 7, 'BUYINGBD', '#3F51B5', 22, NULL, '2026-01-27 12:10:59', '2026-01-28 13:02:21', NULL, 1, 1, NULL, 1, 1, 0, 0, 0),
(20, 'Fit Elegant Gym', 3, '', 5000, 7, 'FITELEGA', '#3F51B5', 22, NULL, '2026-01-27 12:12:08', '2026-01-28 13:02:42', NULL, 1, 1, NULL, 1, 1, 0, 0, 0),
(21, 'Yellow Shopee', 2, '', NULL, NULL, 'YELLOWSH', '#3F51B5', 22, NULL, '2026-01-27 12:12:33', '2026-01-27 12:12:33', NULL, NULL, 1, NULL, 1, 1, 0, 0, 0),
(22, 'mashlifestyle', 24, '', 15000, 7, 'MASHLIFE', '#FFEB3B', 20, NULL, '2026-01-27 12:15:38', '2026-01-28 10:06:16', NULL, 1, 2, 'mashlifestyle.com', 0, 0, 0, 0, 0),
(23, 'qualitypackagingltd', 25, '', 15000, 7, 'QUALITYP', '#3F51B5', 20, NULL, '2026-01-27 12:18:20', '2026-01-28 09:59:05', NULL, 1, 2, 'qualitypackaging.com', 0, 0, 0, 0, 0),
(24, 'basantoshop', 26, '', 20000, 7, 'BASANTOS', '#3F51B5', 20, NULL, '2026-01-27 12:21:15', '2026-01-28 09:52:17', NULL, 1, 2, 'basantoshop.com', 0, 0, 0, 0, 0),
(25, 'Flydropbd', 28, '', 1, 7, 'FLYDROPB', '#3F51B5', 4, NULL, '2026-01-27 12:27:35', '2026-01-31 10:20:26', NULL, 1, 1, 'Flydropbd.com', 3, 0, 0, 1, 0),
(26, 'Haat Bazaar', 27, '', 30000, 7, 'HAATBAZA', '#3F51B5', 20, NULL, '2026-01-27 12:27:37', '2026-02-03 02:30:05', NULL, 1, 5, NULL, 0, 0, 0, 0, 0),
(27, 'edhakamartbd', 29, '', 15000, 7, 'EDHAKAMA', '#3F51B5', 20, NULL, '2026-01-27 12:30:07', '2026-01-28 10:28:24', NULL, 1, 1, 'edhakamartbd.com', 0, 0, 0, 0, 0),
(28, 'Storola Archive', 21, '', NULL, NULL, 'ARCHIVE', '#3F51B5', 19, NULL, '2026-01-27 12:35:14', '2026-01-27 12:35:14', NULL, NULL, 1, NULL, 0, 0, 0, 0, 0),
(29, 'Storola Tracker', 21, '', 1, 7, 'SDFWE', '#3F51B5', 1, NULL, '2026-01-27 12:40:04', '2026-02-14 06:14:10', NULL, 1, 4, NULL, 0, 0, 0, 0, 0),
(30, 'Storola TagBuckets', 21, '', 1, 7, 'STOROLAT', '#3F51B5', 1, NULL, '2026-01-27 12:41:29', '2026-02-22 10:19:32', NULL, 1, 1, 'https://tagbuckets.storola.com', 4, 0, 0, 0, 1),
(31, 'Storola Academy', 21, '', 1, 7, 'STOROLAA', '#3F51B5', 1, NULL, '2026-01-27 12:42:41', '2026-02-22 10:32:46', NULL, 1, 1, 'https://academi.storola.com', NULL, 0, 0, 0, 1),
(32, 'Storola Business', 21, '', 1, 7, 'STOROLAB', '#3F51B5', 1, NULL, '2026-01-27 12:44:07', '2026-01-31 10:17:19', NULL, 1, 1, 'https://storola.com/', 4, 0, 0, 0, 1),
(33, 'Storola LP Builder', 21, '', 1, 7, 'STOROLAL', '#3F51B5', 1, NULL, '2026-01-27 12:46:10', '2026-02-22 11:04:03', NULL, 1, 1, 'https://lp-builder.storola.com', 2, 0, 0, 0, 1),
(34, 'Storola Fraud Checker', 21, '', 1, 7, 'STOROLAF', '#3F51B5', 1, NULL, '2026-01-27 12:47:35', '2026-01-31 10:10:34', NULL, 1, 1, 'https://fraudchecker.storola.com', 4, 0, 0, 0, 1),
(35, 'Storola Flutter App', 21, '', 1, 7, 'STOROL6', '#3F51B5', 1, NULL, '2026-01-27 12:48:47', '2026-01-31 10:22:31', NULL, 1, 1, NULL, 4, 0, 0, 0, 1),
(36, 'Storola Saas', 21, '', 1, 7, 'STOROLAS', '#3F51B5', 1, NULL, '2026-01-27 12:50:19', '2026-01-31 10:16:33', NULL, 1, 1, 'https://storola.com/demos', 4, 0, 0, 0, 1),
(37, 'Roomchai', 21, '', 1, 7, 'ROOMCHAI', '#3F51B5', 1, NULL, '2026-01-27 12:52:37', '2026-01-31 10:16:59', NULL, 1, 1, 'https://roomchai.innolytic.net', 3, 0, 0, 1, 0),
(38, 'stylishbd.com', 9, '', 40000, 7, 'STYLISHB', '#3F51B5', 4, NULL, '2026-01-27 12:57:17', '2026-01-28 09:49:32', NULL, 1, 1, NULL, 0, 0, 0, 0, 0),
(39, 'master sound', 31, '', NULL, NULL, 'MASTERSO', '#3F51B5', 10, NULL, '2026-01-27 13:14:06', '2026-01-27 13:14:06', NULL, NULL, 1, NULL, 0, 0, 0, 0, 0),
(40, 'Miskinbd', 31, '', NULL, NULL, 'MISKINBD', '#3F51B5', 10, NULL, '2026-01-27 13:15:02', '2026-01-27 13:15:02', NULL, NULL, 1, NULL, 0, 0, 0, 0, 0),
(41, 'SOR Trraders', 32, '', 15000, 7, 'SORTRRAD', '#3F51B5', 10, NULL, '2026-01-27 13:18:55', '2026-01-28 11:57:28', NULL, 1, 1, NULL, 0, 0, 0, 0, 0),
(42, 'Hurramliifestyle', 33, '', 1500, 7, 'HURAMLII', '#3F51B5', 10, NULL, '2026-01-27 13:20:54', '2026-01-28 16:31:28', NULL, 1, 1, NULL, 0, 0, 0, 0, 0),
(43, 'Lopacollection', 34, '', 12000, 7, 'LOPACOLL', '#3F51B5', 10, NULL, '2026-01-27 13:22:27', '2026-01-28 12:07:36', NULL, 1, 1, NULL, 0, 0, 0, 0, 0),
(44, 'Denimisia', 35, '', 25000, 7, 'DENIMISI', '#3F51B5', 10, NULL, '2026-01-27 13:26:36', '2026-02-22 11:06:05', NULL, 1, 1, NULL, NULL, 0, 0, 0, 0),
(45, 'raeestrading', 36, '', 15000, 7, 'RAEESTRA', '#3F51B5', 10, NULL, '2026-01-27 13:28:58', '2026-01-28 12:13:18', NULL, 1, 1, NULL, 0, 0, 0, 0, 0),
(46, 'Naazzo', 37, '', NULL, NULL, 'NAAZZO', '#3F51B5', 10, NULL, '2026-01-27 13:30:23', '2026-01-27 13:30:23', NULL, NULL, 1, NULL, 0, 0, 0, 0, 0),
(47, 'focusdesk.store', 38, '', 11, 7, 'FOCUSDES', '#3F51B5', 20, NULL, '2026-01-28 05:23:06', '2026-02-03 03:20:25', NULL, 1, 2, NULL, 0, 0, 0, 0, 0),
(48, 'afsanahbd', 39, '', NULL, NULL, 'AFSANAHB', '#3F51B5', 20, NULL, '2026-01-28 06:30:16', '2026-01-28 06:30:16', NULL, NULL, 1, 'afsanahbd.com', 0, 0, 0, 0, 0),
(49, 'florvana.store', 40, '', NULL, NULL, 'FLORVANA', '#3F51B5', 20, NULL, '2026-01-28 06:38:42', '2026-01-28 06:38:42', NULL, NULL, 1, 'florvana.store', 0, 0, 0, 0, 0),
(50, 'releva.com.bd', 41, '', 1, 7, 'RELEVACO', '#3F51B5', 20, NULL, '2026-01-28 06:44:16', '2026-03-12 06:05:36', NULL, 0, 1, 'releva.com.bd', NULL, 0, 0, 0, 0),
(51, 'betalifebd.com', 42, '', NULL, NULL, 'BETALIFE', '#3F51B5', 20, NULL, '2026-01-28 06:48:21', '2026-01-28 06:48:21', NULL, NULL, 1, 'betalifebd.com', 0, 0, 0, 0, 0),
(52, 't-mart.store', 43, '', 4, 7, 'TMARTSTO', '#3F51B5', 20, 1, '2026-01-28 06:58:24', '2026-02-04 06:31:30', '2026-02-04 06:31:30', 1, 1, NULL, 0, 0, 0, 0, 0),
(53, 'shukrea.com', 44, '', NULL, NULL, 'SHUKREAC', '#3F51B5', 20, NULL, '2026-01-28 08:29:41', '2026-01-28 08:29:41', NULL, NULL, 1, 'shukrea.com', 0, 0, 0, 0, 0),
(54, 'ecomazeeastern', 13, '', 28000, 7, 'ECOMAZE', '#3F51B5', 4, NULL, '2026-01-28 10:09:49', '2026-01-28 16:30:04', NULL, 1, 2, NULL, 0, 0, 0, 0, 0),
(55, 'shefahealthcenter', 45, '', 15000, 7, 'SHEFAHEA', '#3F51B5', 4, NULL, '2026-01-28 10:24:12', '2026-01-31 10:30:23', NULL, 1, 1, NULL, 2, 0, 1, 0, 0),
(56, 'getandgobd.com', 46, '', NULL, NULL, 'GETANDGO', '#3F51B5', 4, NULL, '2026-01-28 10:31:34', '2026-01-28 10:31:34', NULL, NULL, 1, 'getandgobd.com', 0, 0, 0, 0, 0),
(57, 'edaystore.com', 47, '', 12000, 7, 'EDAYSTOR', '#3F51B5', 4, NULL, '2026-01-28 11:25:20', '2026-02-03 03:01:04', NULL, 1, 4, NULL, 0, 0, 0, 0, 0),
(58, 'onestbd.com', 48, '', 14000, 7, 'ONESTBDC', '#3F51B5', 4, NULL, '2026-01-28 11:29:20', '2026-01-28 11:29:50', NULL, 1, 2, NULL, 0, 0, 0, 0, 0),
(59, 'raiyanmart', 49, '', 15000, 7, 'RAIYANMA', '#3F51B5', 4, NULL, '2026-01-28 11:31:38', '2026-01-28 11:33:06', NULL, 1, 2, NULL, 0, 0, 0, 0, 0),
(60, 'terrariumparadise.com', 50, '', 13000, 7, 'TERRARIU', '#3F51B5', 4, NULL, '2026-01-28 11:45:22', '2026-01-28 11:45:55', NULL, 1, 2, 'terrariumparadise.com', 0, 0, 0, 0, 0),
(61, 'sunnahfashion', 6, '', 15000, 7, 'SUNNAH', '#3F51B5', 4, NULL, '2026-01-28 11:49:00', '2026-01-31 10:50:11', NULL, 1, 2, NULL, 0, 0, 0, 0, 0),
(62, 'igadgetsbd.com', 51, '', 20000, 7, 'IGADGETS', '#3F51B5', 4, NULL, '2026-01-28 11:56:06', '2026-01-28 11:56:31', NULL, 1, 2, NULL, 0, 0, 0, 0, 0),
(63, 'priyoomart.com', 52, '', 20000, 7, 'PRIYOOMA', '#3F51B5', 4, NULL, '2026-01-28 11:59:33', '2026-01-28 12:00:22', NULL, 1, 2, NULL, 0, 0, 0, 0, 0),
(64, 'fashioncraftbd.com', 8, '', 13500, 7, 'FASHION', '#3F51B5', 4, NULL, '2026-01-28 12:01:54', '2026-01-29 15:19:58', NULL, 1, 2, NULL, 0, 0, 0, 0, 0),
(65, 'binnurfoodbd', 53, '', 15000, 7, 'BINNURFO', '#3F51B5', 4, NULL, '2026-01-28 12:04:14', '2026-01-31 10:32:45', NULL, 1, 1, NULL, 2, 0, 1, 0, 0),
(66, 'Hurramlifestyle.com', 5, '', 12000, 7, 'HURRAML', '#3F51B5', 4, NULL, '2026-01-28 12:06:22', '2026-01-28 12:06:44', NULL, 1, 1, NULL, 0, 0, 0, 0, 0),
(67, 'Nazzo.com', 54, '', 20000, 7, 'NAZZOCOM', '#3F51B5', 4, NULL, '2026-01-28 12:10:11', '2026-01-28 12:10:36', NULL, 1, 1, NULL, 0, 0, 0, 0, 0),
(68, '66mart', 55, '', 13000, 7, '66MART', '#3F51B5', 4, NULL, '2026-01-28 12:15:42', '2026-01-28 12:16:43', NULL, 1, 1, NULL, 0, 0, 0, 0, 0),
(69, 'modernstylebd.com', 56, '', 13000, 7, 'MODERNST', '#3F51B5', 4, NULL, '2026-01-28 12:18:28', '2026-01-28 12:18:52', NULL, 1, 1, NULL, 0, 0, 0, 0, 0),
(70, 'Dhakabdstore.com', 57, '', 13000, 7, 'DHAKABDS', '#3F51B5', 4, NULL, '2026-01-28 12:21:19', '2026-01-28 12:21:41', NULL, 1, 1, NULL, 0, 0, 0, 0, 0),
(71, 'Shoberbazar', 58, '', 13000, 7, 'SHOBERBA', '#3F51B5', 4, NULL, '2026-01-28 12:24:06', '2026-01-28 12:24:48', NULL, 1, 1, NULL, 0, 0, 0, 0, 0),
(72, 'smartessentialbd.com', 59, '', 12000, 7, 'SMARTESS', '#3F51B5', 4, NULL, '2026-01-28 12:26:44', '2026-01-28 12:27:12', NULL, 1, 1, NULL, 0, 0, 0, 0, 0),
(73, 'Office Works', 60, '', NULL, NULL, 'OFFICEWO', '#3F51B5', 10, NULL, '2026-01-28 16:36:27', '2026-01-31 10:25:03', NULL, NULL, 2, NULL, 0, 0, 0, 0, 0),
(74, 'saddhofood', 61, '', NULL, NULL, 'SADDHOFO', '#3F51B5', 12, NULL, '2026-01-29 07:12:48', '2026-01-29 07:12:48', NULL, NULL, 1, NULL, 1, 1, 0, 0, 0),
(75, 'abonicollection', 62, '', 11, 7, 'ABONICOL', '#3F51B5', 20, NULL, '2026-01-29 09:38:05', '2026-02-04 02:05:44', NULL, 1, 1, 'abonicollection.com', 0, 0, 0, 0, 0),
(76, 'armadio.com.bd', 63, '', NULL, NULL, 'ARMADIOC', '#3F51B5', 20, NULL, '2026-01-29 10:52:09', '2026-01-29 10:52:09', NULL, NULL, 1, 'armadio.com.bd', 0, 0, 0, 0, 0),
(77, 'Zero4u.com', 64, '', NULL, NULL, 'ZERO4UCO', '#3F51B5', 20, NULL, '2026-01-30 01:40:32', '2026-01-30 01:40:32', NULL, NULL, 1, 'Zero4u.com', 0, 0, 0, 0, 0),
(78, 'eleven-bd.com', 65, '', NULL, NULL, 'ELEVENBD', '#3F51B5', 20, NULL, '2026-01-30 01:59:42', '2026-01-30 01:59:42', NULL, NULL, 1, 'eleven-bd.com', 0, 0, 0, 0, 0),
(79, 'Timers', 68, '', NULL, NULL, 'TIMERS', '#3F51B5', 23, NULL, '2026-01-31 10:34:50', '2026-01-31 10:34:50', NULL, NULL, 1, 'Timers', 2, 0, 1, 0, 0),
(80, 'test34', 28, '', NULL, NULL, 'TEST34', '#3F51B5', 1, NULL, '2026-02-03 03:02:35', '2026-02-03 03:02:35', NULL, NULL, 1, NULL, 2, 0, 1, 0, 0),
(81, 'shafa', 28, '', 1, 7, 'SHAFA', '#3F51B5', 1, NULL, '2026-02-03 03:38:29', '2026-02-03 03:41:33', NULL, 1, 2, NULL, 1, 1, 0, 0, 0),
(82, 'job100', 28, '', 1, 7, 'JOB100', '#3F51B5', 1, NULL, '2026-02-03 05:51:58', '2026-02-03 05:52:23', NULL, 1, 1, NULL, 2, 0, 1, 0, 0),
(83, 'tracker2', 43, '', 1, 7, 'TRACKER8', '#3F51B5', 1, NULL, '2026-02-03 06:09:25', '2026-02-03 06:12:03', NULL, 1, 2, NULL, 1, 1, 0, 0, 0),
(84, 'Latest Complete 10 task', 43, '', 1, 7, 'LATESTCO', '#3F51B5', 1, NULL, '2026-02-04 00:08:01', '2026-02-14 06:13:13', NULL, 1, 3, NULL, 4, 0, 0, 0, 1),
(85, 'test job 420', 28, '', NULL, NULL, 'TESTJOB4', '#3F51B5', 1, NULL, '2026-02-04 02:07:14', '2026-02-04 02:07:14', NULL, NULL, 1, NULL, 1, 1, 0, 0, 0),
(86, 'test-01', 28, '', NULL, NULL, 'TEST01', '#3F51B5', 1, 1, '2026-02-04 06:18:29', '2026-02-04 06:19:03', '2026-02-04 06:19:03', NULL, 1, NULL, 1, 1, 0, 0, 0),
(87, 'test02', 28, '', 1, 7, 'TEST02', '#3F51B5', 1, NULL, '2026-02-04 06:20:17', '2026-02-04 06:24:02', NULL, 1, 5, NULL, 2, 0, 1, 0, 0),
(88, 'test03', 43, '', 9, 7, 'TEST03', '#3F51B5', 1, 1, '2026-02-04 06:25:13', '2026-02-04 06:25:55', '2026-02-04 06:25:55', 1, 1, NULL, 1, 1, 0, 0, 0),
(89, 'test job 01', 28, '', NULL, NULL, 'TESTJOB0', '#3F51B5', 1, NULL, '2026-02-22 04:12:57', '2026-02-22 04:12:57', NULL, NULL, 1, NULL, 0, 0, 0, 0, 0),
(90, 'test job 02', 28, '', NULL, NULL, 'T5464', '#3F51B5', 1, NULL, '2026-02-22 04:19:20', '2026-02-22 04:19:20', NULL, NULL, 1, NULL, 3, 0, 0, 0, 0),
(91, 'test job 3', 28, '', NULL, NULL, 'TT3', '#3F51B5', 1, NULL, '2026-02-22 04:29:06', '2026-02-22 04:29:06', NULL, NULL, 1, NULL, 1, 0, 0, 0, 0),
(92, 'today job', 28, '', NULL, NULL, 'TODAYJOB', '#3F51B5', 1, NULL, '2026-03-02 01:28:24', '2026-03-02 01:28:24', NULL, NULL, 1, NULL, 4, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `projects_invoice`
--

CREATE TABLE `projects_invoice` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_by` bigint(20) UNSIGNED DEFAULT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `paid` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `due` bigint(20) UNSIGNED NOT NULL DEFAULT 0,
  `invoice` varchar(255) NOT NULL,
  `in_word` text DEFAULT NULL,
  `for` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects_invoice`
--

INSERT INTO `projects_invoice` (`id`, `client_id`, `project_id`, `status`, `created_by`, `deleted_by`, `price`, `paid`, `due`, `invoice`, `in_word`, `for`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 13, 54, 'pending', 4, NULL, 28000, 23000, 5000, 'STR-20260128-000001', 'Twenty Three Thousand Taka Only', NULL, '2026-01-28 10:14:36', '2026-01-28 10:14:36', NULL),
(2, 27, 26, 'approved', 1, NULL, 30000, 30000, 0, 'STR-20260203-000002', 'Thirty Thousand Taka Only', NULL, '2026-02-03 01:26:00', '2026-02-03 01:26:09', NULL),
(3, 21, 29, 'approved', 1, NULL, 1, 1, 0, 'STR-20260203-000003', 'One Taka Only', NULL, '2026-02-03 02:31:09', '2026-02-03 02:31:18', NULL),
(4, 10, 15, 'approved', 1, NULL, 10000, 10000, 0, 'STR-20260203-000004', 'Ten Thousand Taka Only', NULL, '2026-02-03 03:31:31', '2026-02-03 03:31:41', NULL),
(5, 28, 81, 'pending', 1, NULL, 1, 1, 0, 'STR-20260203-000005', 'One Taka Only', NULL, '2026-02-03 03:40:41', '2026-02-03 03:40:41', NULL),
(6, 28, 87, 'approved', 1, NULL, 1, 1, 0, 'STR-20260204-000006', 'One Taka Only', NULL, '2026-02-04 06:21:49', '2026-02-04 06:22:01', NULL),
(7, 43, 52, 'approved', 1, NULL, 4, 4, 0, 'STR-20260204-000007', 'Four Taka Only', NULL, '2026-02-04 06:30:22', '2026-02-04 06:30:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `project_user`
--

CREATE TABLE `project_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_user`
--

INSERT INTO `project_user` (`id`, `project_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 17, '2026-01-27 11:21:14', '2026-01-27 11:21:14'),
(2, 1, 4, '2026-01-27 11:30:37', '2026-01-27 11:30:37'),
(4, 3, 17, '2026-01-27 11:57:21', '2026-01-27 11:57:21'),
(5, 4, 17, '2026-01-27 11:58:18', '2026-01-27 11:58:18'),
(6, 5, 17, '2026-01-27 11:59:22', '2026-01-27 11:59:22'),
(7, 6, 17, '2026-01-27 12:00:34', '2026-01-27 12:00:34'),
(8, 3, 12, '2026-01-27 12:02:37', '2026-01-27 12:02:37'),
(9, 4, 12, '2026-01-27 12:02:41', '2026-01-27 12:02:41'),
(10, 5, 12, '2026-01-27 12:02:46', '2026-01-27 12:02:46'),
(11, 6, 12, '2026-01-27 12:02:50', '2026-01-27 12:02:50'),
(13, 1, 12, '2026-01-27 12:03:04', '2026-01-27 12:03:04'),
(18, 8, 17, '2026-01-27 12:05:18', '2026-01-27 12:05:18'),
(19, 9, 17, '2026-01-27 12:07:49', '2026-01-27 12:07:49'),
(20, 10, 17, '2026-01-27 12:08:10', '2026-01-27 12:08:10'),
(21, 11, 17, '2026-01-27 12:08:30', '2026-01-27 12:08:30'),
(22, 12, 17, '2026-01-27 12:08:48', '2026-01-27 12:08:48'),
(23, 13, 17, '2026-01-27 12:09:11', '2026-01-27 12:09:11'),
(24, 14, 17, '2026-01-27 12:09:32', '2026-01-27 12:09:32'),
(26, 16, 17, '2026-01-27 12:10:10', '2026-01-27 12:10:10'),
(28, 18, 17, '2026-01-27 12:10:42', '2026-01-27 12:10:42'),
(29, 19, 17, '2026-01-27 12:10:59', '2026-01-27 12:10:59'),
(30, 20, 17, '2026-01-27 12:12:08', '2026-01-27 12:12:08'),
(31, 21, 17, '2026-01-27 12:12:33', '2026-01-27 12:12:33'),
(37, 26, 20, '2026-01-27 12:27:37', '2026-01-27 12:27:37'),
(38, 27, 20, '2026-01-27 12:30:07', '2026-01-27 12:30:07'),
(39, 28, 11, '2026-01-27 12:35:14', '2026-01-27 12:35:14'),
(40, 28, 18, '2026-01-27 12:35:14', '2026-01-27 12:35:14'),
(41, 28, 26, '2026-01-27 12:35:14', '2026-01-27 12:35:14'),
(42, 28, 3, '2026-01-27 12:35:14', '2026-01-27 12:35:14'),
(44, 29, 11, '2026-01-27 12:40:04', '2026-01-27 12:40:04'),
(45, 29, 18, '2026-01-27 12:40:04', '2026-01-27 12:40:04'),
(46, 29, 26, '2026-01-27 12:40:04', '2026-01-27 12:40:04'),
(47, 29, 3, '2026-01-27 12:40:04', '2026-01-27 12:40:04'),
(49, 30, 11, '2026-01-27 12:41:29', '2026-01-27 12:41:29'),
(50, 30, 18, '2026-01-27 12:41:29', '2026-01-27 12:41:29'),
(51, 30, 26, '2026-01-27 12:41:29', '2026-01-27 12:41:29'),
(52, 30, 3, '2026-01-27 12:41:29', '2026-01-27 12:41:29'),
(54, 31, 11, '2026-01-27 12:42:41', '2026-01-27 12:42:41'),
(55, 31, 18, '2026-01-27 12:42:41', '2026-01-27 12:42:41'),
(56, 31, 26, '2026-01-27 12:42:41', '2026-01-27 12:42:41'),
(57, 31, 3, '2026-01-27 12:42:41', '2026-01-27 12:42:41'),
(59, 32, 11, '2026-01-27 12:44:07', '2026-01-27 12:44:07'),
(60, 32, 18, '2026-01-27 12:44:07', '2026-01-27 12:44:07'),
(61, 32, 26, '2026-01-27 12:44:07', '2026-01-27 12:44:07'),
(62, 32, 3, '2026-01-27 12:44:07', '2026-01-27 12:44:07'),
(64, 33, 11, '2026-01-27 12:46:10', '2026-01-27 12:46:10'),
(65, 33, 18, '2026-01-27 12:46:10', '2026-01-27 12:46:10'),
(66, 33, 26, '2026-01-27 12:46:10', '2026-01-27 12:46:10'),
(67, 33, 3, '2026-01-27 12:46:10', '2026-01-27 12:46:10'),
(69, 34, 11, '2026-01-27 12:47:35', '2026-01-27 12:47:35'),
(70, 34, 18, '2026-01-27 12:47:35', '2026-01-27 12:47:35'),
(71, 34, 26, '2026-01-27 12:47:35', '2026-01-27 12:47:35'),
(72, 34, 3, '2026-01-27 12:47:35', '2026-01-27 12:47:35'),
(74, 35, 11, '2026-01-27 12:48:47', '2026-01-27 12:48:47'),
(75, 35, 18, '2026-01-27 12:48:47', '2026-01-27 12:48:47'),
(76, 35, 26, '2026-01-27 12:48:47', '2026-01-27 12:48:47'),
(77, 35, 3, '2026-01-27 12:48:47', '2026-01-27 12:48:47'),
(79, 36, 11, '2026-01-27 12:50:19', '2026-01-27 12:50:19'),
(80, 36, 18, '2026-01-27 12:50:19', '2026-01-27 12:50:19'),
(81, 36, 26, '2026-01-27 12:50:19', '2026-01-27 12:50:19'),
(82, 36, 3, '2026-01-27 12:50:19', '2026-01-27 12:50:19'),
(84, 37, 11, '2026-01-27 12:52:37', '2026-01-27 12:52:37'),
(85, 37, 18, '2026-01-27 12:52:37', '2026-01-27 12:52:37'),
(86, 37, 26, '2026-01-27 12:52:37', '2026-01-27 12:52:37'),
(87, 37, 3, '2026-01-27 12:52:37', '2026-01-27 12:52:37'),
(89, 38, 4, '2026-01-27 12:57:17', '2026-01-27 12:57:17'),
(90, 38, 3, '2026-01-27 12:57:17', '2026-01-27 12:57:17'),
(91, 39, 10, '2026-01-27 13:14:06', '2026-01-27 13:14:06'),
(92, 40, 10, '2026-01-27 13:15:02', '2026-01-27 13:15:02'),
(93, 26, 3, '2026-01-27 13:15:50', '2026-01-27 13:15:50'),
(94, 41, 10, '2026-01-27 13:18:55', '2026-01-27 13:18:55'),
(95, 42, 10, '2026-01-27 13:20:54', '2026-01-27 13:20:54'),
(96, 43, 10, '2026-01-27 13:22:28', '2026-01-27 13:22:28'),
(97, 44, 10, '2026-01-27 13:26:36', '2026-01-27 13:26:36'),
(98, 45, 10, '2026-01-27 13:28:58', '2026-01-27 13:28:58'),
(99, 46, 10, '2026-01-27 13:30:23', '2026-01-27 13:30:23'),
(102, 48, 3, '2026-01-28 06:30:16', '2026-01-28 06:30:16'),
(103, 48, 20, '2026-01-28 06:30:16', '2026-01-28 06:30:16'),
(104, 49, 3, '2026-01-28 06:38:42', '2026-01-28 06:38:42'),
(105, 49, 20, '2026-01-28 06:38:42', '2026-01-28 06:38:42'),
(106, 50, 8, '2026-01-28 06:44:16', '2026-01-28 06:44:16'),
(107, 50, 3, '2026-01-28 06:44:16', '2026-01-28 06:44:16'),
(108, 50, 20, '2026-01-28 06:44:16', '2026-01-28 06:44:16'),
(109, 51, 10, '2026-01-28 06:48:21', '2026-01-28 06:48:21'),
(110, 51, 3, '2026-01-28 06:48:21', '2026-01-28 06:48:21'),
(111, 51, 20, '2026-01-28 06:48:21', '2026-01-28 06:48:21'),
(112, 27, 10, '2026-01-28 06:51:57', '2026-01-28 06:51:57'),
(113, 27, 3, '2026-01-28 06:51:57', '2026-01-28 06:51:57'),
(117, 53, 20, '2026-01-28 08:29:41', '2026-01-28 08:29:41'),
(118, 53, 3, '2026-01-28 08:32:51', '2026-01-28 08:32:51'),
(119, 12, 10, '2026-01-28 08:44:16', '2026-01-28 08:44:16'),
(120, 12, 20, '2026-01-28 08:44:16', '2026-01-28 08:44:16'),
(121, 50, 10, '2026-01-28 08:50:14', '2026-01-28 08:50:14'),
(123, 55, 8, '2026-01-28 10:24:12', '2026-01-28 10:24:12'),
(124, 56, 4, '2026-01-28 10:31:34', '2026-01-28 10:31:34'),
(127, 57, 20, '2026-01-28 11:25:20', '2026-01-28 11:25:20'),
(135, 65, 22, '2026-01-28 12:04:15', '2026-01-28 12:04:15'),
(136, 66, 10, '2026-01-28 12:06:22', '2026-01-28 12:06:22'),
(137, 67, 4, '2026-01-28 12:10:11', '2026-01-28 12:10:11'),
(138, 67, 22, '2026-01-28 12:10:11', '2026-01-28 12:10:11'),
(139, 68, 10, '2026-01-28 12:15:42', '2026-01-28 12:15:42'),
(140, 68, 22, '2026-01-28 12:15:42', '2026-01-28 12:15:42'),
(142, 70, 22, '2026-01-28 12:21:19', '2026-01-28 12:21:19'),
(143, 70, 20, '2026-01-28 12:21:19', '2026-01-28 12:21:19'),
(144, 71, 10, '2026-01-28 12:24:06', '2026-01-28 12:24:06'),
(145, 71, 22, '2026-01-28 12:24:06', '2026-01-28 12:24:06'),
(146, 71, 20, '2026-01-28 12:24:06', '2026-01-28 12:24:06'),
(147, 72, 4, '2026-01-28 12:26:44', '2026-01-28 12:26:44'),
(148, 72, 10, '2026-01-28 12:26:44', '2026-01-28 12:26:44'),
(149, 72, 20, '2026-01-28 12:26:44', '2026-01-28 12:26:44'),
(150, 57, 10, '2026-01-28 14:27:59', '2026-01-28 14:27:59'),
(151, 57, 3, '2026-01-28 14:28:31', '2026-01-28 14:28:31'),
(175, 29, 20, '2026-01-28 20:04:15', '2026-01-28 20:04:15'),
(176, 69, 22, '2026-01-29 06:55:35', '2026-01-29 06:55:35'),
(177, 74, 17, '2026-01-29 07:12:48', '2026-01-29 07:12:48'),
(178, 74, 27, '2026-01-29 07:12:48', '2026-01-29 07:12:48'),
(179, 74, 12, '2026-01-29 07:12:48', '2026-01-29 07:12:48'),
(180, 75, 10, '2026-01-29 09:38:05', '2026-01-29 09:38:05'),
(181, 75, 20, '2026-01-29 09:38:05', '2026-01-29 09:38:05'),
(183, 76, 20, '2026-01-29 10:52:09', '2026-01-29 10:52:09'),
(184, 76, 3, '2026-01-29 10:57:53', '2026-01-29 10:57:53'),
(185, 77, 10, '2026-01-30 01:40:32', '2026-01-30 01:40:32'),
(186, 77, 20, '2026-01-30 01:40:32', '2026-01-30 01:40:32'),
(187, 78, 20, '2026-01-30 01:59:42', '2026-01-30 01:59:42'),
(188, 78, 10, '2026-01-30 02:02:11', '2026-01-30 02:02:11'),
(189, 69, 10, '2026-01-30 13:32:39', '2026-01-30 13:32:39'),
(190, 70, 3, '2026-01-30 13:36:14', '2026-01-30 13:36:14'),
(191, 9, 12, '2026-01-30 21:06:46', '2026-01-30 21:06:46'),
(192, 14, 12, '2026-01-30 21:13:20', '2026-01-30 21:13:20'),
(193, 21, 12, '2026-01-30 21:14:24', '2026-01-30 21:14:24'),
(194, 19, 12, '2026-01-30 21:52:46', '2026-01-30 21:52:46'),
(195, 79, 17, '2026-01-31 10:34:50', '2026-01-31 10:34:50'),
(196, 79, 4, '2026-01-31 10:34:50', '2026-01-31 10:34:50'),
(197, 79, 27, '2026-01-31 10:34:50', '2026-01-31 10:34:50'),
(198, 79, 12, '2026-01-31 10:34:50', '2026-01-31 10:34:50'),
(199, 79, 8, '2026-01-31 10:34:50', '2026-01-31 10:34:50'),
(200, 79, 10, '2026-01-31 10:34:50', '2026-01-31 10:34:50'),
(201, 79, 20, '2026-01-31 10:34:50', '2026-01-31 10:34:50'),
(202, 79, 16, '2026-01-31 10:34:50', '2026-01-31 10:34:50'),
(203, 79, 23, '2026-01-31 10:34:50', '2026-01-31 10:34:50'),
(204, 80, 11, '2026-02-03 03:02:35', '2026-02-03 03:02:35'),
(206, 82, 11, '2026-02-03 05:51:58', '2026-02-03 05:51:58'),
(209, 85, 4, '2026-02-04 02:07:14', '2026-02-04 02:07:14'),
(211, 87, 11, '2026-02-04 06:20:17', '2026-02-04 06:20:17'),
(213, 89, 11, '2026-02-22 04:12:57', '2026-02-22 04:12:57'),
(214, 90, 17, '2026-02-22 04:19:20', '2026-02-22 04:19:20'),
(215, 91, 11, '2026-02-22 04:29:06', '2026-02-22 04:29:06'),
(216, 92, 25, '2026-03-02 01:28:24', '2026-03-02 01:28:24'),
(218, 50, 19, '2026-03-12 06:05:36', '2026-03-12 06:05:36'),
(219, 50, 26, '2026-03-12 06:08:19', '2026-03-12 06:08:19'),
(220, 44, 26, '2026-03-12 06:12:38', '2026-03-12 06:12:38'),
(221, 50, 27, '2026-04-05 04:36:59', '2026-04-05 04:36:59'),
(222, 44, 19, '2026-04-05 05:31:33', '2026-04-05 05:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `report_type` int(11) NOT NULL DEFAULT 1,
  `report_data` text DEFAULT NULL,
  `invoice_generate` tinyint(1) NOT NULL DEFAULT 0,
  `meta` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_filters`
--

CREATE TABLE `report_filters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_id` int(10) UNSIGNED NOT NULL,
  `param_type` varchar(255) NOT NULL,
  `param_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `report_invoices`
--

CREATE TABLE `report_invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_id` int(10) UNSIGNED NOT NULL,
  `report_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Admin', '<p>Admin</p>', 'web', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(2, 'Team Member', 'Team Member', '<p>Team Member</p>', 'web', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(3, 'Developer', 'Developer', '<p>Developer</p>', 'web', '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(4, 'Client', 'Client', '<p>Client</p>', 'web', '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(5, 'Tele Sales', 'Tele Sales', '', 'web', '2025-09-20 01:20:22', '2025-09-20 01:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(4, 2),
(4, 3),
(4, 5),
(5, 1),
(5, 2),
(5, 3),
(5, 5),
(6, 1),
(6, 2),
(6, 4),
(7, 1),
(7, 2),
(7, 3),
(7, 5),
(8, 1),
(9, 1),
(9, 2),
(9, 3),
(9, 5),
(10, 1),
(10, 2),
(10, 3),
(10, 5),
(11, 1),
(11, 2),
(11, 3),
(11, 5),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(18, 2),
(18, 3),
(18, 5),
(19, 1),
(20, 4),
(21, 1),
(21, 2),
(21, 3),
(21, 5),
(22, 1),
(23, 1),
(24, 1),
(24, 2),
(24, 3),
(24, 5),
(25, 1),
(25, 2),
(25, 3),
(25, 5),
(26, 1),
(26, 2),
(26, 3),
(26, 5),
(27, 1),
(27, 2),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(37, 2),
(37, 3),
(38, 1),
(38, 2),
(39, 1),
(39, 2),
(40, 1),
(40, 2);

-- --------------------------------------------------------

--
-- Table structure for table `salaries`
--

CREATE TABLE `salaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `basic_salary` decimal(10,2) DEFAULT NULL,
  `house_rent` decimal(10,2) DEFAULT NULL,
  `ta_da` decimal(10,2) DEFAULT NULL,
  `medical_allowance` decimal(10,2) DEFAULT NULL,
  `over_time` decimal(10,2) DEFAULT NULL,
  `leave_penalty` decimal(10,2) DEFAULT NULL,
  `absent_penalty` decimal(10,2) DEFAULT NULL,
  `attendece_penalty` decimal(10,2) DEFAULT 0.00,
  `other_penalty` decimal(10,2) DEFAULT NULL,
  `other_penalty_note` text DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `commission` decimal(10,2) DEFAULT NULL,
  `eid_bonus` decimal(10,2) DEFAULT NULL,
  `payable` decimal(10,2) DEFAULT NULL,
  `paid` decimal(10,2) DEFAULT NULL,
  `due` decimal(10,2) DEFAULT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `created_by` bigint(20) UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` enum('due','paid') NOT NULL DEFAULT 'due'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salaries`
--

INSERT INTO `salaries` (`id`, `user_id`, `basic_salary`, `house_rent`, `ta_da`, `medical_allowance`, `over_time`, `leave_penalty`, `absent_penalty`, `attendece_penalty`, `other_penalty`, `other_penalty_note`, `tax`, `commission`, `eid_bonus`, `payable`, `paid`, `due`, `year`, `month`, `created_by`, `deleted_at`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 1, 1, '2026-02-28 05:12:42', '2026-02-28 04:32:29', '2026-02-28 05:12:42', 'due'),
(2, 3, 60000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 60000.00, 0.00, 60000.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(3, 4, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(4, 6, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(5, 8, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(6, 10, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(7, 11, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(8, 12, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(9, 13, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(10, 14, 10000.00, 0.00, 0.00, 0.00, 0.00, 333.33, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9666.67, 0.00, 9666.67, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(11, 15, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(12, 16, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(13, 17, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(14, 18, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(15, 19, 100000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 100000.00, 0.00, 100000.00, 2026, 1, 1, '2026-02-28 04:48:58', '2026-02-28 04:32:29', '2026-02-28 04:48:58', 'due'),
(16, 20, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(17, 22, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(18, 23, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(19, 24, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(20, 25, 10000.00, 0.00, 0.00, 0.00, 0.00, 333.33, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9666.67, 0.00, 9666.67, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(21, 26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(22, 27, 30000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 30000.00, 0.00, 30000.00, 2026, 1, 1, '2026-02-28 06:28:38', '2026-02-28 04:32:29', '2026-02-28 06:28:35', 'due'),
(23, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 2, 1, '2026-03-05 00:30:28', '2026-02-28 05:13:40', '2026-03-05 00:30:28', 'due'),
(24, 3, 60000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 60000.00, 60000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(25, 4, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(26, 6, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(27, 8, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(28, 10, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(29, 11, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(30, 12, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(31, 13, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(32, 14, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(33, 15, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(34, 16, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(35, 17, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(36, 18, 10000.00, 101.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10101.00, 10101.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(37, 19, 100000.00, 10.00, 10.00, 10.00, 10.00, 10000.00, 10.00, 0.00, 10.00, 'test note', 10.00, 10.00, 10.00, 90030.00, 90030.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(38, 20, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(39, 22, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(40, 23, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(41, 24, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(42, 25, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 10000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(43, 26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(44, 27, 30000.00, 0.00, 0.00, 0.00, 0.00, 2000.00, 6000.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 22000.00, 22000.00, 0.00, 2026, 2, 1, NULL, '2026-02-28 05:13:40', '2026-04-06 04:48:25', 'paid'),
(45, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(46, 3, 60000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 60000.00, 60000.00, 0.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-04-06 01:44:40', 'paid'),
(47, 4, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(48, 6, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(49, 8, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(50, 10, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(51, 11, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(52, 12, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(53, 13, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(54, 14, 10000.00, 0.00, 0.00, 0.00, 0.00, 333.33, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9666.67, 0.00, 9666.67, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(55, 15, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(56, 16, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(57, 17, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(58, 18, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(59, 19, 100000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 100000.00, 0.00, 100000.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(60, 20, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(61, 22, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(62, 23, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(63, 24, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(64, 25, 10000.00, 0.00, 0.00, 0.00, 0.00, 333.33, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9666.67, 0.00, 9666.67, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(65, 26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 1, 1, NULL, '2026-03-05 00:31:53', '2026-03-05 00:31:53', 'due'),
(91, 1, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(92, 3, 60000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 60000.00, 0.00, 60000.00, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(93, 4, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9333.33, 0.00, 9333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(94, 6, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9333.33, 0.00, 9333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(95, 8, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9333.33, 0.00, 9333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(96, 10, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9333.33, 0.00, 9333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(97, 11, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 10000.00, 0.00, 10000.00, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(98, 12, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9333.33, 0.00, 9333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(99, 13, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9333.33, 0.00, 9333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(100, 14, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9333.33, 0.00, 9333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(101, 15, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9333.33, 0.00, 9333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(102, 16, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9333.33, 0.00, 9333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(103, 17, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9333.33, 0.00, 9333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(104, 18, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9333.33, 0.00, 9333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(105, 19, 100000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 6666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 93333.33, 0.00, 93333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(106, 20, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9333.33, 0.00, 9333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(107, 22, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9333.33, 0.00, 9333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(108, 23, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(109, 24, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(110, 25, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9333.33, 0.00, 9333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(111, 26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due'),
(112, 27, 30000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 2000.00, 100000.00, 0.00, NULL, 0.00, 0.00, 0.00, 0.00, 0.00, -72000.00, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 05:43:19', 'due'),
(113, 42, 10000.00, 0.00, 0.00, 0.00, 0.00, 0.00, 666.67, 0.00, 0.00, NULL, 0.00, 0.00, 0.00, 9333.33, 0.00, 9333.33, 2026, 3, 1, NULL, '2026-04-06 04:52:09', '2026-04-06 04:52:09', 'due');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL,
  `group` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `group`, `created_at`, `updated_at`) VALUES
(1, 'show_recaptcha', '0', 3, '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(2, 'google_recaptcha_site_key', NULL, 3, '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(3, 'google_recaptcha_secret_key', NULL, 3, '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(4, 'default_task_status', '0', 1, '2023-06-12 23:11:22', '2023-06-12 23:11:22'),
(5, 'app_name', 'Storola Tracker', 1, '2023-06-12 23:11:23', '2025-09-10 00:39:11'),
(6, 'app_logo', 'assets/img/logo-red-black.png', 1, '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(7, 'favicon', 'assets/img/favicon.png', 1, '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(8, 'company_name', 'Innolytic IT Ltd.', 1, '2023-06-12 23:11:23', '2026-01-27 07:07:44'),
(9, 'current_currency', 'inr', 1, '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(10, 'company_address', 'House# 69/3, Road# 7/A, Dhanmondi,  Dhaka, 1209', 1, '2023-06-12 23:11:23', '2025-09-08 02:45:05'),
(11, 'company_email', 'contact@storola.net', 1, '2023-06-12 23:11:23', '2025-09-08 02:45:05'),
(12, 'company_phone', '01810023549', 1, '2023-06-12 23:11:23', '2025-09-08 02:45:05'),
(13, 'working_days_of_month', '24', 1, '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(14, 'working_hours_of_day', '7', 1, '2023-06-12 23:11:23', '2026-01-27 07:07:42'),
(15, 'default_invoice_template', 'defaultTemplate', 2, '2023-06-12 23:11:23', '2023-06-12 23:11:23'),
(16, 'default_invoice_color', '#040404', 2, '2023-06-12 23:11:23', '2023-06-12 23:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `name` varchar(170) NOT NULL,
  `order` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id`, `status`, `name`, `order`, `created_at`, `updated_at`) VALUES
(1, 0, 'Pending', 1, '2023-06-12 23:11:23', '2026-02-24 02:42:59'),
(2, 1, 'Completed', 3, '2023-06-12 23:11:23', '2026-02-24 02:43:49'),
(3, 2, 'In-Progress', 2, '2025-09-06 03:44:03', '2026-02-24 02:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(170) NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=Active, 0=Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`, `is_active`) VALUES
(1, 'Site Decoration &amp; Setup', 1, NULL, '2026-01-27 09:39:53', '2026-01-27 09:39:53', NULL, 1),
(2, 'Product Upload with Graphics', 1, NULL, '2026-01-27 09:40:48', '2026-01-27 09:40:48', NULL, 1),
(3, 'Admin Panel training', 1, NULL, '2026-01-27 09:41:08', '2026-01-27 09:41:08', NULL, 1),
(4, 'Graphics Design (logo-banner-static)', 1, NULL, '2026-01-27 09:41:23', '2026-01-27 09:41:23', NULL, 1),
(5, 'Group Message Check', 1, NULL, '2026-01-27 09:41:40', '2026-01-27 09:41:40', NULL, 1),
(6, 'Client Support &amp; Training', 1, NULL, '2026-01-27 09:41:52', '2026-01-27 09:41:52', NULL, 1),
(7, 'Sheet update', 1, NULL, '2026-01-27 09:42:03', '2026-01-27 09:42:03', NULL, 1),
(8, 'Business Proposal Create', 1, NULL, '2026-01-27 09:42:15', '2026-01-27 09:42:15', NULL, 1),
(9, 'Invoice/Price Quotation', 1, NULL, '2026-01-27 09:42:34', '2026-01-27 09:42:34', NULL, 1),
(10, 'Client Meeting', 1, NULL, '2026-01-27 09:42:45', '2026-01-27 09:42:45', NULL, 1),
(11, 'Team communication', 1, NULL, '2026-01-27 09:42:56', '2026-01-27 09:42:56', NULL, 1),
(12, 'Site Modification', 1, NULL, '2026-01-27 09:43:07', '2026-01-27 09:43:07', NULL, 1),
(13, 'Issue Fixing', 1, NULL, '2026-01-27 09:44:45', '2026-01-27 09:44:45', NULL, 1),
(14, 'Site Re-check', 1, NULL, '2026-01-27 09:44:57', '2026-01-27 09:44:57', NULL, 1),
(15, 'Skill Development &amp; Training', 1, NULL, '2026-01-27 09:45:09', '2026-01-27 09:45:09', NULL, 1),
(16, 'Domain &amp; Cloudflare integration', 1, NULL, '2026-01-27 09:45:22', '2026-01-27 09:45:22', NULL, 1),
(17, 'New &amp; Previous Leads Call', 1, NULL, '2026-01-27 09:47:36', '2026-01-27 09:47:36', NULL, 1),
(18, 'New &amp; Previous Leads Chat', 1, NULL, '2026-01-27 09:47:48', '2026-01-27 09:47:48', NULL, 1),
(19, 'Client Meeting in Online', 1, NULL, '2026-01-27 09:47:59', '2026-01-27 09:47:59', NULL, 1),
(20, 'Client Visit/Meeting at Office', 1, NULL, '2026-01-27 09:48:39', '2026-01-27 09:48:39', NULL, 1),
(21, 'Client\'s Office Visit', 1, NULL, '2026-01-27 09:48:52', '2026-01-27 09:48:52', NULL, 1),
(22, 'Business Proposal Create', 1, NULL, '2026-01-27 09:49:03', '2026-01-27 09:49:03', NULL, 1),
(23, 'Lead Sheet &amp; Tracker Update', 1, NULL, '2026-01-27 09:49:15', '2026-01-27 09:49:15', NULL, 1),
(24, 'Marketing Onboard', 1, NULL, '2026-01-27 09:49:26', '2026-01-27 09:49:26', NULL, 1),
(25, 'Website Onboard', 1, NULL, '2026-01-27 09:49:38', '2026-01-27 09:49:38', NULL, 1),
(26, 'Meeting With Existing Client', 1, NULL, '2026-01-27 09:49:56', '2026-01-27 09:49:56', NULL, 1),
(27, 'Creative Design', 1, NULL, '2026-01-27 09:50:36', '2026-01-27 09:50:36', NULL, 1),
(28, 'Creative Research', 1, NULL, '2026-01-27 09:50:52', '2026-01-27 09:50:52', NULL, 1),
(29, 'Video Elements Design', 1, NULL, '2026-01-27 09:51:04', '2026-01-27 09:51:04', NULL, 1),
(30, 'UI Design', 1, NULL, '2026-01-27 09:51:21', '2026-01-27 09:51:21', NULL, 1),
(31, 'Banner Design', 1, NULL, '2026-01-27 09:51:32', '2026-01-27 09:51:32', NULL, 1),
(32, 'Customize Banner Design', 1, NULL, '2026-01-27 09:51:44', '2026-01-27 09:51:44', NULL, 1),
(33, 'Customize Logo Design', 1, NULL, '2026-01-27 09:51:55', '2026-01-27 09:51:55', NULL, 1),
(34, 'Logo Design', 1, NULL, '2026-01-27 09:52:06', '2026-01-27 09:52:06', NULL, 1),
(35, 'Content Writing', 1, NULL, '2026-01-27 09:52:18', '2026-01-27 09:52:18', NULL, 1),
(36, 'Social Media Management', 1, NULL, '2026-01-27 09:52:31', '2026-01-27 09:52:31', NULL, 1),
(37, 'Video Editing', 1, NULL, '2026-01-27 09:52:43', '2026-01-27 09:52:43', NULL, 1),
(38, 'Video Resource', 1, NULL, '2026-01-27 09:53:03', '2026-01-27 09:53:03', NULL, 1),
(39, 'Meeting with Clients', 1, NULL, '2026-01-27 09:53:48', '2026-03-12 05:26:43', NULL, 1),
(40, 'Meeting with Team', 1, NULL, '2026-01-27 09:54:00', '2026-01-27 09:54:00', NULL, 1),
(41, 'Requirement Analysis', 1, NULL, '2026-01-27 09:54:09', '2026-01-27 09:54:09', NULL, 1),
(42, 'Time estimation', 1, NULL, '2026-01-27 09:54:19', '2026-01-27 09:54:19', NULL, 1),
(43, 'Ads Run', 1, NULL, '2026-01-27 09:55:10', '2026-01-27 09:55:10', NULL, 1),
(44, 'Ads monitoring', 1, NULL, '2026-01-27 09:55:50', '2026-01-27 09:55:50', NULL, 1),
(45, 'Client communications', 1, NULL, '2026-01-27 09:56:12', '2026-01-27 09:56:12', NULL, 1),
(46, 'Ads Result Analysis', 1, NULL, '2026-01-27 09:56:50', '2026-01-27 09:56:50', NULL, 1),
(47, 'Fund management', 1, NULL, '2026-01-27 09:57:40', '2026-01-27 09:57:40', NULL, 1),
(48, 'GTM Setup', 1, NULL, '2026-01-27 09:58:13', '2026-01-27 09:58:13', NULL, 1),
(49, 'Business Manager Setup', 1, NULL, '2026-01-27 09:58:48', '2026-01-27 09:58:48', NULL, 1),
(50, 'Content Strategy', 1, NULL, '2026-01-27 09:59:15', '2026-01-27 09:59:15', NULL, 1),
(51, 'Marketing Strategy', 1, NULL, '2026-01-27 09:59:35', '2026-01-27 09:59:35', NULL, 1),
(52, 'Competitor Analysis', 1, NULL, '2026-01-27 10:00:34', '2026-01-27 10:00:34', NULL, 1),
(53, 'Ads scaling', 1, NULL, '2026-01-27 10:00:50', '2026-01-27 10:00:50', NULL, 1),
(54, 'Google Ad', 1, NULL, '2026-01-27 10:01:07', '2026-01-27 10:01:07', NULL, 1),
(55, 'Tiktok Ad', 1, NULL, '2026-01-27 10:01:26', '2026-01-27 10:01:26', NULL, 1),
(56, 'Bug Fixing', 1, NULL, '2026-01-27 10:04:07', '2026-02-17 06:57:26', NULL, 1),
(57, 'Feature implementation', 1, NULL, '2026-01-27 10:04:56', '2026-02-17 06:57:15', NULL, 1),
(59, 'dm', 10, NULL, '2026-01-27 11:54:33', '2026-01-27 11:54:33', NULL, 1),
(60, 'dm', 10, NULL, '2026-01-27 11:57:55', '2026-01-27 11:57:55', NULL, 1),
(61, 'dm', 10, NULL, '2026-01-27 11:58:54', '2026-01-27 11:58:54', NULL, 1),
(62, 'dm', 10, NULL, '2026-01-27 12:01:05', '2026-01-27 12:01:05', NULL, 1),
(63, 'bug fixing', 10, NULL, '2026-01-28 16:39:33', '2026-01-28 16:39:33', NULL, 1),
(64, 'others', 10, NULL, '2026-01-28 16:41:18', '2026-01-28 16:41:18', NULL, 1),
(65, 'others', 10, NULL, '2026-01-28 16:41:38', '2026-01-28 16:41:38', NULL, 1),
(66, 'Other site &amp; new site work,support, meeting', 20, NULL, '2026-01-30 01:34:05', '2026-01-30 01:34:05', NULL, 1),
(67, 'Task list  &amp; dev RQ update', 20, NULL, '2026-01-30 01:35:21', '2026-01-30 01:35:21', NULL, 1),
(68, 'event manager audit', 12, NULL, '2026-01-30 21:08:00', '2026-01-30 21:08:00', NULL, 1),
(69, 'pixel issue', 20, NULL, '2026-01-31 04:45:47', '2026-01-31 04:45:47', NULL, 1),
(70, 'dfgdfgdsf', 1, NULL, '2026-02-17 04:41:00', '2026-02-17 04:41:00', NULL, 1),
(71, 'dfgdfgfd', 1, NULL, '2026-02-17 04:41:06', '2026-02-17 04:41:06', NULL, 1),
(72, 'akersdfwuierrh4wio', 1, NULL, '2026-02-17 04:42:56', '2026-02-17 04:42:56', NULL, 1),
(73, 'safa tag', 1, NULL, '2026-02-17 05:34:40', '2026-03-12 05:42:50', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `project_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `due_date` date DEFAULT NULL,
  `completed_on` date DEFAULT NULL,
  `task_number` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `estimate_time` varchar(255) DEFAULT NULL,
  `estimate_time_type` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `priority`, `title`, `description`, `project_id`, `status`, `due_date`, `completed_on`, `task_number`, `created_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`, `estimate_time`, `estimate_time_type`) VALUES
(1, 'medium', 'Ongoing DM Service', '', 1, 0, '2026-02-05', NULL, 1, 4, NULL, '2026-01-27 11:41:01', '2026-01-27 11:41:01', NULL, '9', 1),
(2, 'medium', 'ongoing', '', 2, 1, '2026-02-18', '2026-02-18', 1, 10, NULL, '2026-01-27 11:54:33', '2026-02-03 03:09:22', NULL, '01:00', 0),
(3, 'medium', 'Ongoing', '', 3, 0, '2026-02-07', NULL, 1, 10, NULL, '2026-01-27 11:57:55', '2026-01-27 11:57:55', NULL, NULL, NULL),
(4, 'medium', 'Ongoing', '', 4, 0, '2026-02-07', NULL, 1, 10, NULL, '2026-01-27 11:58:54', '2026-01-27 11:58:54', NULL, NULL, NULL),
(5, 'medium', 'Ongoing', '', 5, 0, '2026-02-08', NULL, 1, 10, NULL, '2026-01-27 12:00:13', '2026-01-27 12:00:13', NULL, NULL, NULL),
(6, 'medium', 'Ongoing', '', 6, 0, '2026-02-13', NULL, 1, 10, NULL, '2026-01-27 12:01:05', '2026-01-27 12:01:05', NULL, NULL, NULL),
(7, 'medium', 'Ongoing DM service', '', 21, 0, '2026-02-22', NULL, 1, 4, NULL, '2026-01-27 12:48:00', '2026-01-27 12:48:00', NULL, NULL, NULL),
(8, 'medium', 'Ongoing DM Service', '', 20, 0, '2026-02-22', NULL, 1, 4, NULL, '2026-01-27 12:49:01', '2026-01-27 12:49:01', NULL, NULL, NULL),
(9, 'medium', 'Ongoing DM Service', '', 19, 0, '2026-02-22', NULL, 1, 4, NULL, '2026-01-27 12:49:55', '2026-01-27 12:49:55', NULL, NULL, NULL),
(10, 'medium', 'Ongoing DM Service', '', 18, 0, '2026-02-22', NULL, 1, 4, NULL, '2026-01-27 12:50:30', '2026-01-27 12:50:30', NULL, NULL, NULL),
(11, 'medium', 'Ongoing DM Service', '', 16, 0, '2026-02-20', NULL, 1, 4, NULL, '2026-01-27 12:51:07', '2026-01-27 12:51:07', NULL, NULL, NULL),
(12, 'medium', 'Ongoing DM Service', '', 14, 0, '2026-02-19', NULL, 1, 4, NULL, '2026-01-27 12:51:55', '2026-01-27 12:51:55', NULL, NULL, NULL),
(13, 'medium', 'Ongoing DM Service', '', 13, 0, '2026-02-19', NULL, 1, 4, NULL, '2026-01-27 12:52:29', '2026-01-27 12:52:29', NULL, NULL, NULL),
(14, 'medium', 'Ongoing DM Service', '', 12, 0, '2026-02-19', NULL, 1, 4, NULL, '2026-01-27 12:52:56', '2026-01-27 12:52:56', NULL, NULL, NULL),
(15, 'medium', 'Ongoing DM Service', '', 11, 0, '2026-02-18', NULL, 1, 4, NULL, '2026-01-27 12:53:50', '2026-01-27 12:53:50', NULL, NULL, NULL),
(16, 'medium', 'Ongoing DM Service', '', 10, 0, '2026-02-16', NULL, 1, 4, NULL, '2026-01-27 12:54:14', '2026-01-27 12:54:14', NULL, NULL, NULL),
(17, 'medium', 'Ongoing DM Service', '', 8, 0, '2026-02-14', NULL, 1, 4, NULL, '2026-01-27 12:54:46', '2026-01-27 12:54:46', NULL, NULL, NULL),
(18, 'medium', 'Ongoing DM Service', '', 9, 0, '2026-02-13', NULL, 1, 4, NULL, '2026-01-27 12:55:06', '2026-01-27 12:55:06', NULL, NULL, NULL),
(19, 'medium', '12. Pre-order Button a click korle popup (policy) Show hobe . Popup kete dile order hobe.', '', 38, 1, '2026-01-28', '2026-01-28', 1, 4, NULL, '2026-01-27 12:59:47', '2026-01-29 13:41:03', NULL, NULL, NULL),
(20, 'medium', '12. Pre-order Button a click korle popup (policy) Show hobe . Popup kete dile order hobe.', '', 38, 1, '2026-01-28', '2026-01-28', 2, 4, NULL, '2026-01-27 13:00:26', '2026-01-28 05:31:56', NULL, NULL, NULL),
(21, 'medium', 'Ongoing', '', 39, 0, '2026-02-05', NULL, 1, 10, NULL, '2026-01-27 13:14:37', '2026-01-27 13:15:54', NULL, NULL, NULL),
(22, 'medium', 'footer ta choto hobe. client er kache onek boro mone hocche . image a gula remove hobe &amp; order traking ta help center a jabe .like this chaldal EX: https://chaldal.com/', '', 26, 0, '2026-01-28', NULL, 1, 4, NULL, '2026-01-27 13:15:17', '2026-01-28 05:42:03', NULL, NULL, NULL),
(23, 'medium', 'Ongoing', '', 40, 0, '2026-02-05', NULL, 1, 10, NULL, '2026-01-27 13:15:31', '2026-01-27 13:15:31', NULL, NULL, NULL),
(24, 'medium', 'Website Ongoing', '', 41, 0, '2026-02-05', NULL, 1, 10, NULL, '2026-01-27 13:19:24', '2026-01-27 13:19:24', NULL, NULL, NULL),
(25, 'medium', 'Website Gongoing', '', 42, 0, '2026-02-05', NULL, 1, 10, NULL, '2026-01-27 13:21:20', '2026-01-27 13:21:20', NULL, NULL, NULL),
(26, 'medium', 'Ongoin', '', 43, 0, '2026-02-05', NULL, 1, 10, NULL, '2026-01-27 13:23:29', '2026-01-27 13:23:29', NULL, NULL, NULL),
(27, 'medium', 'Ongoing', '', 44, 0, '2026-02-03', NULL, 1, 10, NULL, '2026-01-27 13:26:55', '2026-01-31 10:48:51', NULL, NULL, NULL),
(28, 'medium', 'Ongoing', '', 45, 0, '2026-02-05', NULL, 1, 10, NULL, '2026-01-27 13:29:15', '2026-01-27 13:29:15', NULL, NULL, NULL),
(29, 'medium', 'Ongoing', '', 46, 0, '2026-02-05', NULL, 1, 10, NULL, '2026-01-27 13:30:40', '2026-01-27 13:30:40', NULL, NULL, NULL),
(30, 'medium', 'order panel a  order edit page a service charge add korar option thakbe (focusdesk.store)', '', 47, 1, '2026-02-01', '2026-02-01', 1, 20, NULL, '2026-01-28 05:27:22', '2026-02-03 03:19:56', NULL, '01:00', 0),
(31, 'medium', 'check out page a Select Your Arrival Time and Date  a  rokom syestem korte hobe', '', 26, 0, '2026-02-03', NULL, 2, 20, NULL, '2026-01-28 05:35:03', '2026-01-28 05:35:03', NULL, NULL, NULL),
(32, 'medium', 'payment automation In Bkash', '', 38, 0, '2026-02-07', NULL, 3, 4, NULL, '2026-01-28 05:37:05', '2026-01-28 05:37:05', NULL, NULL, NULL),
(33, 'medium', '15. Checkout page same as like - https://thailandhaul.com/checkout', '', 38, 1, '2026-01-31', '2026-01-31', 4, 4, NULL, '2026-01-28 05:52:19', '2026-01-29 13:40:47', NULL, NULL, NULL),
(34, 'medium', 'afsanahbd.storola.net site modification', '&lt;p&gt;&nbsp;menuber a একটি আলাদা রঙের (লাল) &ldquo;Sale&rdquo; অপশন থাকবে এবং এর ফন্ট পরিবর্তন/এডিট করার সুবিধা আমার হাতে থাকবে।&lt;/p&gt;&lt;p&gt;আমি চাইলে এই Sale লেখা যেকোনো ক্যাটাগরিতে যোগ করতে পারব&mdash;চাইলে Row আকারে বা Column আকারে।&lt;/p&gt;&lt;p&gt;যখন সেল অফার শেষ হবে, তখন এই &ldquo;Sale&rdquo; অপশনটি স্বয়ংক্রিয়ভাবে Hide (লুকানো) হয়ে যাবে।&lt;/p&gt;', 48, 0, '2026-02-03', NULL, 1, 20, NULL, '2026-01-28 06:33:33', '2026-01-28 10:36:53', NULL, NULL, NULL),
(35, 'medium', 'header a অর্ডার ট্র্যাকিং অপশনটি উপরের অংশে উইশলিস্ট ও কার্ট আইকনের পাশে থাকতে হবে।  সেখানে একটি সহজে চেনা যায় এমন অর্ডার ট্র্যাকিং লোগো/আইকন থাকতে হবে। স্যাম্পল লিংক: https://sanasafinaz.com/. (afsanahbd.storola.net)', '', 48, 0, '2026-02-03', NULL, 2, 20, NULL, '2026-01-28 06:35:21', '2026-01-28 10:37:24', NULL, NULL, NULL),
(36, 'medium', 'Screenshot_359.png ei site er invoice hisebe pos invoice dewa ache', '', 49, 1, '2026-02-02', '2026-02-19', 1, 20, NULL, '2026-01-28 06:39:53', '2026-02-18 23:44:31', NULL, '01:00', 0),
(37, 'medium', 'footer er information gulo bolt theke normal font a hobe', '', 50, 2, '2026-02-03', NULL, 1, 20, NULL, '2026-01-28 06:45:52', '2026-03-01 03:48:50', NULL, '02:00', 0),
(38, 'medium', 'page a 3-4ta invoice print hobe  EX: pathao er moto \"', '', 51, 0, '2026-02-06', NULL, 1, 20, NULL, '2026-01-28 06:49:25', '2026-01-28 06:50:23', NULL, NULL, NULL),
(39, 'medium', 'majhe majhe order button kaj kore na ,', '', 51, 0, '2026-02-06', NULL, 2, 20, NULL, '2026-01-28 06:50:07', '2026-01-28 06:50:07', NULL, NULL, NULL),
(40, 'medium', 'mobile view te filter option remove hobe', '', 51, 0, '2026-02-06', NULL, 3, 20, NULL, '2026-01-28 06:51:04', '2026-01-28 06:51:04', NULL, NULL, NULL),
(41, 'medium', '1 page a 3-4ta invoice print hobe  ex: Pathao\"', '', 27, 0, '2026-03-03', NULL, 1, 20, NULL, '2026-01-28 06:53:24', '2026-01-28 06:53:24', NULL, NULL, NULL),
(42, 'medium', '1kg ei word gulote number ar kg/gm egulor moddhe space thakbe ... as : 1 KG', '', 52, 0, '2026-02-01', NULL, 1, 20, 1, '2026-01-28 06:59:48', '2026-02-03 03:23:56', '2026-02-03 03:23:56', NULL, NULL),
(43, 'medium', 'image e kheyal korben please,,, cart e product quantity show korbe ....', '', 52, 0, '2026-02-01', NULL, 2, 20, 1, '2026-01-28 07:00:55', '2026-02-03 03:23:51', '2026-02-03 03:23:51', NULL, NULL),
(44, 'medium', 'admin er product section e kono name er word diye search korle show kore na ... eta solve korte hobe ..', '', 52, 0, '2026-02-01', NULL, 3, 20, 1, '2026-01-28 07:01:54', '2026-02-03 03:23:46', '2026-02-03 03:23:46', NULL, NULL),
(45, 'medium', 'releva.com.bd site modification 01 - note description: a', '&lt;p&gt;&lt;span style=&quot;color:rgb(0,0,0);font-size:10pt;font-family:Arial;&quot;&gt;5. site structure&lt;br&gt;১. Home / Dashboard Page&lt;br&gt;২. Shop / Products Page (filter, sort)&lt;br&gt;৩. Product Details Page&lt;br&gt;৪. Cart / Checkout Panel (side panel + full-page checkout)&lt;br&gt;৫. Thank You + Voucher Page&lt;br&gt;৬. About / Brand Story Page&lt;br&gt;৭. Contact / Support Page&lt;br&gt;৮. Privacy Policy, Terms &amp;amp; Conditions&lt;/span&gt;&lt;/p&gt;', 50, 0, '2026-02-03', NULL, 2, 20, NULL, '2026-01-28 07:13:07', '2026-03-01 04:06:50', NULL, '30', 2),
(46, 'medium', 'releva.com.bd site modification02 - note description: a', '&lt;span style=&quot;color:rgb(0,0,0);font-size:10pt;font-family:Arial;&quot;&gt;&nbsp;Voucher system overview:&lt;br&gt;-কে কে ২ ঘন্টার ভিতরে দ্বিতীয় অর্ডার করেছে&lt;br&gt;-voucher usage রিপোর্ট&lt;br&gt;-voucher থেকে কত extra sales হল (future enhancement)&lt;/span&gt;', 50, 2, '2026-02-03', NULL, 3, 20, NULL, '2026-01-28 07:34:01', '2026-03-01 04:07:23', NULL, NULL, NULL),
(47, 'medium', 'releva.com.bd site modification03 - note description: a', '&lt;div&gt;&lt;span style=&quot;font-size:16px;background-color:rgb(241,241,241);&quot;&gt;&nbsp;Smart Pop-up / Exit Intent:&lt;/span&gt;&lt;/div&gt;&lt;div&gt;&lt;span style=&quot;font-size:16px;background-color:rgb(241,241,241);&quot;&gt;কেউ site থেকে বের হতে চাইলে ছোট popup:&lt;/span&gt;&lt;/div&gt;&lt;div&gt;&lt;span style=&quot;font-size:16px;background-color:rgb(241,241,241);&quot;&gt;&ldquo;Wait! Your ৳450 voucher is still live for [Timer]&rdquo;&nbsp; (if possible)&lt;/span&gt;&lt;/div&gt;', 50, 0, '2026-02-03', NULL, 4, 20, NULL, '2026-01-28 07:35:24', '2026-01-28 07:43:33', NULL, NULL, NULL),
(48, 'medium', 'releva.com.bd site modification 04 - note description: a', '&lt;div&gt;প্রোডাক্ট পেজে Custom Size অপশন থাকবে, abar detail page e custom order name e button o thalbe add to bag button er niche...যখন কাস্টমার কোনো ড্রেস দেখবে, তখন:&lt;/div&gt;&lt;div&gt;Custom Size ফিল্ডগুলো:&lt;/div&gt;&lt;div&gt;-Height&lt;/div&gt;&lt;div&gt;-Chest&lt;/div&gt;&lt;div&gt;-Waist&lt;/div&gt;&lt;div&gt;-Hip&lt;/div&gt;&lt;div&gt;-Sleeve length&lt;/div&gt;&lt;div&gt;-অথবা একটি &ldquo;Enter Your Measurement&rdquo; টেক্সটবক্স&lt;/div&gt;&lt;div&gt;-অথবা &ldquo;Upload Measurement Photo/Paper&rdquo;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;UI উদাহরণ:&lt;/div&gt;&lt;div&gt;✔ Standard Sizes (S / M / L / XL)&lt;/div&gt;&lt;div&gt;✔ Custom Size (radio button)&lt;/div&gt;&lt;div&gt;&nbsp;&rarr; ক্লিক করলে মাপ দেওয়ার ফিল্ড খুলবে&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;&nbsp;https://drive.google.com/file/d/1haNTVOJCc_KazqO4-DJcKBj6P7SVB0RY/view?usp=sharing&nbsp; এখানে এমন কাস্টমাইজ করার অপশোন থাকবে&nbsp;&lt;/div&gt;&lt;div&gt;মডেল এর গায়ে থেকে এরো নিয়ে নাম দিয়ে ম্যানশন করা থাকতে হবে কোনটার নাম কি? kono ekta box e size gulo input kore order korte parbe or option thakbe sekhan theke nijer moto sob gulo part er size select kore order korbe .. sekhetre kono ekta option select na korle order hobe naa ... https://drive.google.com/file/d/1YY4rxRATO-44eBNQdg04nQCSpegN30dU/view?usp=sharing emon select korar option hote pare ..and select korar option kora hole eta dynamic hobe .. admin theke size gulo change kora jabe ...&nbsp;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Custom Size বাছাই করলে প্রোডাক্ট প্রাইসের সাথে extra charge অটোমেটিক যোগ হবে,&lt;/div&gt;&lt;div&gt;যেমন:&lt;/div&gt;&lt;div&gt;🧥 Dress Price = 3,000 Tk&lt;/div&gt;&lt;div&gt;➕ Custom Tailor Charge = 600 Tk&lt;/div&gt;&lt;div&gt;💰 Final Price = 3,600 Tk&lt;/div&gt;&lt;div&gt;Extra charge অ্যাডমিন প্যানেল থেকে সেট করা যাবে (যেমন ৫০০ টাকা / ৬০০ টাকা)&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Payment না করলে Order Confirm হবে না (only for custom order)&lt;/div&gt;&lt;div&gt;সিস্টেম রুল:&lt;/div&gt;&lt;div&gt;-Custom Size অর্ডার শুধুই &quot;Prepaid Mandatory&quot; হবে&lt;/div&gt;&lt;div&gt;-COD অপশন থাকবে না&lt;/div&gt;&lt;div&gt;-Payment submit না করলে:&lt;/div&gt;&lt;div&gt;-অর্ডার সাবমিট হবে না&lt;/div&gt;&lt;div&gt;-Confirm পেজে যাবে না&lt;/div&gt;&lt;div&gt;-Customer message:&lt;/div&gt;&lt;div&gt;&nbsp;&ldquo;To confirm your custom order, please complete payment first.&rdquo;&lt;/div&gt;&lt;div&gt;&lt;br&gt;&lt;/div&gt;&lt;div&gt;Required Admin Features:&lt;/div&gt;&lt;div&gt;-Custom Size Orders&lt;/div&gt;&lt;div&gt;-Extra Charge Setting&lt;/div&gt;&lt;div&gt;-Payment Verify List&lt;/div&gt;&lt;div&gt;-Pending Payment Orders&lt;/div&gt;&lt;div&gt;-Auto Cancel Settings (2 hours)&lt;/div&gt;', 50, 0, '2026-02-03', NULL, 5, 20, NULL, '2026-01-28 07:38:48', '2026-01-28 07:43:47', NULL, NULL, NULL),
(49, 'medium', 'releva.com.bd site modification 05- note description: a', '&lt;span style=&quot;color:rgb(0,0,0);font-size:10pt;font-family:Arial;&quot;&gt;Checkout &rarr; Payment Gateway (বিকাশ / নগদ / রকেট/Bank)&lt;br&gt;&ldquo;কাস্টম সাইজ নিলে পেমেন্ট না করলে অর্ডার কনফার্ম হবে না।&rdquo;&lt;br&gt;তাহলে checkout flow হবে:&lt;br&gt;-Checkout Flow:&lt;br&gt;-Customer &rarr; Add to Cart&lt;br&gt;-Cart &rarr; &ldquo;Proceed to Checkout&rdquo;&lt;br&gt;-Checkout Page &rarr; Address + Phone&lt;br&gt;-Payment Page &rarr;bKash (Gateway API),Nagad (API),Rocket (API)&lt;br&gt;Payment সফল হলে &rarr;&lt;br&gt;-অর্ডার কনফার্ম হবে&lt;br&gt;-Customer একটি রিসিপ্ট/ভাউচার পাবে&lt;br&gt;অ্যা-ডমিন &ldquo;Paid Order&rdquo; দেখতে পারবে&lt;br&gt;Payment ব্যর্থ হলে &rarr;&lt;br&gt;-অর্ডার pending থাকবে&lt;br&gt;-Pending অর্ডার ২ ঘণ্টার মধ্যে পেমেন্ট না হলে auto-cancel&lt;br&gt;-আবার panding অর্ডার যেটা থাকবে এই টা আমাদের প্যানেল এ চলে আসবে আমরা যাতে ওই Informetion টা পাই ।&lt;/span&gt;', 50, 0, '2026-02-03', NULL, 6, 20, NULL, '2026-01-28 07:41:27', '2026-01-28 07:43:57', NULL, NULL, NULL),
(50, 'medium', 'releva.com.bd site modification 06- note description: a', '&lt;span style=&quot;color:rgb(0,0,0);font-size:10pt;font-family:Arial;&quot;&gt;&nbsp;বকেয়া পেমেন্ট অটোমেটিক যাচাই&lt;br&gt;✔ bKash / Nagad API Integration&lt;br&gt;✔ Payment Status Callback&lt;br&gt;✔ Auto Verify Payment&lt;br&gt;✔ Order Status Update = &ldquo;Paid&rdquo;&lt;br&gt;যাতে কাস্টমার পেমেন্ট দিলেসিস্টেম অটোমেটিক ট্রানজেকশন verify করে&ldquo;Payment Successful&rdquo; দেখায়তারপর অর্ডার কনফার্ম হয়&lt;/span&gt;', 50, 0, '2026-02-03', NULL, 7, 20, NULL, '2026-01-28 07:42:31', '2026-01-28 07:44:18', NULL, NULL, NULL),
(51, 'medium', 'releva.com.bd site modification 07- note description: a', '&lt;span style=&quot;color:rgb(0,0,0);font-size:10pt;font-family:Arial;&quot;&gt;&lt;span style=&quot;font-size:10pt;&quot;&gt;&nbsp;&lt;/span&gt;&lt;span style=&quot;font-size:10pt;font-weight:bold;&quot;&gt;ইনভেন্টরি ও স্টক ম্যানেজমেন্ট:&lt;/span&gt;&lt;span style=&quot;font-size:10pt;&quot;&gt;&lt;br&gt;-প্রতি SKU ও সাইজ অনুযায়ী স্টক দেখাব&lt;br&gt;-রিটার্ন স্ক্যান করলে অটো স্টক ইন&lt;br&gt;-POS স্ক্যান করলে অর্ডার তৈরি + স্টক আউট&lt;br&gt;&lt;/span&gt;&lt;span style=&quot;font-size:10pt;font-weight:bold;&quot;&gt;ইনভেন্টরি রিপোর্টগুলো:&lt;/span&gt;&lt;span style=&quot;font-size:10pt;&quot;&gt;&lt;br&gt;-স্টক রিপোর্ট (SKU/রঙ/সাইজ অনুযায়ী)&lt;br&gt;-স্টক আউট লিস্ট&lt;br&gt;-কম স্টক অ্যালার্ট রিপোর্ট&lt;br&gt;-পারচেজ হিস্ট্রি রিপোর্ট&lt;br&gt;-রিটার্ন স্টক রিপোর্ট&lt;br&gt;&lt;/span&gt;&lt;span style=&quot;font-size:10pt;font-weight:bold;&quot;&gt;POS স্ক্যানার সিস্টেম&lt;/span&gt;&lt;span style=&quot;font-size:10pt;&quot;&gt;&lt;br&gt;-স্ক্যান &rarr; কুরিয়ার এন্ট্রি &rarr; স্টক আউট&lt;br&gt;-রিটার্ন স্ক্যান &rarr; স্টক ইন&lt;/span&gt;&lt;/span&gt;', 50, 0, '2026-02-03', NULL, 8, 20, NULL, '2026-01-28 07:45:45', '2026-01-28 07:45:45', NULL, NULL, NULL),
(52, 'medium', 'releva.com.bd site modification 08- note description: a', '&lt;span style=&quot;color:rgb(0,0,0);font-size:10pt;font-family:Arial;&quot;&gt;&lt;span style=&quot;font-size:10pt;&quot;&gt;&nbsp;&lt;/span&gt;&lt;span style=&quot;font-size:10pt;font-weight:bold;&quot;&gt;কুরিয়ার ম্যানেজমেন্ট:&lt;br&gt;&lt;/span&gt;&lt;span style=&quot;font-size:10pt;&quot;&gt;-SteadFast, RedX, Pathao, SA Poribohon, Paperfly ইত্যাদির API&lt;br&gt;-অটোমেটিক ট্র্যাকিং আপডেট&lt;br&gt;&lt;/span&gt;&lt;span style=&quot;font-size:10pt;font-weight:bold;&quot;&gt;কুরিয়ার রিপোর্ট&lt;/span&gt;&lt;span style=&quot;font-size:10pt;&quot;&gt;&lt;br&gt;-মোট কত পার্সেল পাঠানো হয়েছে&lt;br&gt;-কত ডেলিভারি সম্পন্ন&lt;br&gt;-কত রিটার্ন হয়েছে&lt;br&gt;-কুরিয়ার চার্জ রিপোর্ট&lt;br&gt;-কুরিয়ার অনুযায়ী পারফরম্যান্স রিপোর্ট&lt;/span&gt;&lt;/span&gt;', 50, 0, '2026-02-03', NULL, 9, 20, NULL, '2026-01-28 07:52:23', '2026-01-28 08:02:49', NULL, NULL, NULL),
(53, 'medium', 'releva.com.bd site modification 09- note description: a', '&lt;div&gt;&nbsp;অ্যাকাউন্টিং মডিউল:&lt;/div&gt;&lt;div&gt;Cash Flow System&lt;/div&gt;&lt;div&gt;-দৈনিক ক্যাশ ইন / ক্যাশ আউট (have to add)&lt;/div&gt;&lt;div&gt;-সাপ্লাইয়ার পেমেন্ট(we have)&lt;/div&gt;&lt;div&gt;-কর্মচারী বেতন(we have)&lt;/div&gt;&lt;div&gt;-অফিস খরচ(we have)&lt;/div&gt;&lt;div&gt;-মার্কেটিং খরচ(we have)&lt;/div&gt;&lt;div&gt;-অনলাইন পেমেন্ট সেটেলমেন্ট(have to add)&lt;/div&gt;&lt;div&gt;অ্যাকাউন্টিং রিপোর্ট&lt;/div&gt;&lt;div&gt;-দৈনিক ক্যাশ রিপোর্ট&lt;/div&gt;&lt;div&gt;-মাসিক লাভ-লোকসান (Profit &amp;amp; Loss)&lt;/div&gt;&lt;div&gt;-সাপ্লাইয়ার পেমেন্ট রিপোর্ট&lt;/div&gt;&lt;div&gt;-কর্মচারী বেতন রিপোর্ট&lt;/div&gt;&lt;div&gt;-মোট ব্যয় রিপোর্ট&lt;/div&gt;&lt;div&gt;-ব্যাংক ব্যালেন্স রিপোর্ট&lt;/div&gt;&lt;div&gt;-কুরিয়ার COD কত Deliver করে দিয়েছে, কত Pending&lt;/div&gt;', 50, 0, '2026-02-03', NULL, 10, 20, NULL, '2026-01-28 08:01:20', '2026-01-28 08:03:32', NULL, NULL, NULL),
(54, 'medium', 'User Management: Admin, Manager, Inventory Staff, Accountant লগ হিস্ট্রি (কে কী আপডেট করলো)', '', 50, 0, '2026-02-03', NULL, 11, 20, NULL, '2026-01-28 08:04:26', '2026-01-28 08:04:26', NULL, NULL, NULL),
(55, 'medium', 'releva.com.bd site modification 10- note description: a', '&lt;span style=&quot;color:rgb(0,0,0);font-size:10pt;font-family:Arial;&quot;&gt;&nbsp;SMS/Email Automation&lt;br&gt;-অর্ডার কনফার্ম ম্যাসেজ&lt;br&gt;-শিপড নোটিফিকেশন&lt;br&gt;-ডেলিভারি আপডেট&lt;br&gt;-কাস্টমার রিভিউ রিকোয়েস্ট&lt;/span&gt;', 50, 0, '2026-02-03', NULL, 12, 20, NULL, '2026-01-28 08:05:35', '2026-01-28 08:05:35', NULL, NULL, NULL),
(56, 'medium', 'releva.com.bd site modification 11- note description: a', 'আমরা নতুন যত অর্ডার রাখি, সব Online Sale List&ndash;এ থাকে। এরপর যে পার্সেলগুলো আমরা মেমো বের করি পাঠানোর জন্য, সেগুলো সিলেক্ট করি এবং Invoice Print Done স্টেজে পরিবর্তন করি। এরপর পার্সেল রেডি করে যখন কুরিয়ারে ডিসপ্যাচ করি, তখন Invoice Check অপশনে গিয়ে স্ক্যান করি&mdash;এতে অটোমেটিক Pathao-তে এন্ট্রি হয়ে স্টক আউট হয় এবং Delivery List&ndash;এ চলে যায়। আবার ২&ndash;৩ দিন পর কোনো কারণে পার্সেল রিটার্ন এলে, সেখান থেকে স্ক্যান করলে অটোমেটিক Return অপশনে চলে আসে।', 50, 0, '2026-02-03', NULL, 13, 20, NULL, '2026-01-28 08:06:35', '2026-01-28 08:12:19', NULL, NULL, NULL),
(57, 'medium', 'releva.com.bd site modification 12- note description: a', '&lt;span style=&quot;color:rgb(0,0,0);font-size:10pt;font-family:Arial;&quot;&gt;&lt;span style=&quot;font-size:10pt;&quot;&gt;17. All demo links are here:&lt;br&gt;- &lt;/span&gt;&lt;span style=&quot;font-size:10pt;color:rgb(17,85,204);&quot;&gt;&lt;a href=&quot;https://docs.google.com/document/d/1W_7ziPCVJYkxSvg5V2n_b8QEKvyLs1Ik-AjxiFG-aME/edit?tab=t.0&quot;&gt;https://docs.google.com/document/d/1W_7ziPCVJYkxSvg5V2n_b8QEKvyLs1Ik-AjxiFG-aME/edit?tab=t.0&lt;/a&gt;&lt;/span&gt;&lt;span style=&quot;font-size:10pt;&quot;&gt;&lt;br&gt;- &lt;/span&gt;&lt;span style=&quot;font-size:10pt;color:rgb(17,85,204);&quot;&gt;&lt;a href=&quot;https://docs.google.com/document/d/1azWrixgyRM97yYQrZKSLH2RiEUbU5RsOiHuo3o7nQh8/edit?tab=t.0&quot;&gt;https://docs.google.com/document/d/1azWrixgyRM97yYQrZKSLH2RiEUbU5RsOiHuo3o7nQh8/edit?tab=t.0&lt;/a&gt;&lt;/span&gt;&lt;span style=&quot;font-size:10pt;&quot;&gt;&lt;br&gt;- &lt;/span&gt;&lt;span style=&quot;font-size:10pt;&quot;&gt;&lt;a href=&quot;https://drive.google.com/file/d/1KcfIRTP5cDWurgNVlIbuBunFzwu9LvOE/view?usp=sharing&quot;&gt;&lt;span&gt;WhatsApp Video 2025-11-25 at 3.54.25 PM.mp4&lt;/span&gt;&lt;/a&gt;&lt;/span&gt;&lt;/span&gt;', 50, 0, '2026-02-03', NULL, 14, 20, NULL, '2026-01-28 08:11:42', '2026-01-28 08:13:06', NULL, NULL, NULL),
(58, 'medium', 'product detail page e product inage pop up open korle slide korle last image er pore slide korle direct abar first image e jabe...', '', 50, 0, '2026-02-03', NULL, 15, 20, NULL, '2026-01-28 08:14:25', '2026-01-28 08:14:25', NULL, NULL, NULL),
(59, 'medium', 'releva.com.bd site modification 13- note description: a', '&lt;span style=&quot;color:rgb(0,0,0);font-size:10pt;font-family:Arial;&quot;&gt;&lt;span style=&quot;font-size:10pt;&quot;&gt;&nbsp;Screenshot_351.png emon fature add hobe jekhane customer name number dile spin hobe and admin theke set kora coupon spin theke enroll korbe ..etacheckout e coupon box e eta use korte parbe ... ref:&lt;br&gt;&lt;/span&gt;&lt;span style=&quot;font-size:10pt;color:rgb(17,85,204);&quot;&gt;&lt;a href=&quot;https://naturalsbyrakhi.com/&quot;&gt;https://naturalsbyrakhi.com/&lt;/a&gt;&lt;/span&gt;&lt;span style=&quot;font-size:10pt;color:rgb(17,85,204);&quot;&gt;&lt;br&gt;&lt;/span&gt;&lt;span style=&quot;font-size:10pt;&quot;&gt;https://naturalsbyrakhi.com/IwY2xjawPUaBFleHRuA2FlbQIxMABicmlkETF3T3VNSXpjV3RWNnAyN25Oc3J0YwZhcHBfaWQQMjIyMDM5MTc4ODIwMDg5MgABHsRVGbhX0py8nu9zjuE_3xCHMHCWjA&lt;/span&gt;&lt;/span&gt;', 50, 2, '2026-02-03', NULL, 16, 20, NULL, '2026-01-28 08:16:07', '2026-03-01 03:19:22', NULL, NULL, NULL),
(60, 'medium', 'releva.com.bd site modification 14- note description: a', 'product listing e only add to bag button thakbe .. kono order now button thakbe na ..add to bag click korle product as like image pop up hobe and add to bag button e click korle seta bag/cart e add hobe .. er nicei view more information type lekha thakbe ar view more info te click korle detail page e cole jabe ...', 50, 0, '2026-03-02', NULL, 17, 20, NULL, '2026-01-28 08:18:25', '2026-03-01 03:40:23', NULL, NULL, NULL),
(61, 'medium', 'releva.com.bd site modification 15- note description: a', 'product cart korar pore pop up close korleo cart open thakbe ... jekhanei click koruk cart nije cross click kore off na kora porjonto open thakbe ... even aro product bag e add korleo eta open obosthay cart e add hobe ..besides ekta timer and auto generated cupon code create hobe and 2/3 min er moddhe order complete hole eta kaj korbe ... time up howar pore ar eta kaj korbe naa ...cupon ta input korar blank box ta o cart button ei thakbe ... cart button er moddhe sob product er list(name, small image, quantity , price) , total price and &ldquo;Proceed to Checkout&rdquo; button thakbe ...', 50, 0, '2026-03-02', NULL, 18, 20, NULL, '2026-01-28 08:21:16', '2026-01-28 08:21:50', NULL, NULL, NULL),
(62, 'medium', 'releva.com.bd site modification 16- note description: a', 'check out e jawar pore check out theke cart product edit korte parbe naa ..edit korte hole cart e click kore cart menu theke edit korte hobe .. cart e change korle checkout page eo cart product autometic change hoye jabe ...check out customer info te gmail mandetory hobe ...&nbsp;', 50, 2, '2026-02-02', NULL, 19, 20, NULL, '2026-01-28 08:23:16', '2026-01-28 08:24:00', NULL, NULL, NULL),
(63, 'medium', 'releva.com.bd site modification 16- note description: a', '&nbsp;thank you page e again new ar ekta cupon code show korbe and 2 hr er moddhe same number diye order korle eta applicable hobe&nbsp; and ekhaneo timer thakbe... 2 hr pore eta applicable hobe naa ... ei coupon code ta input kora hobe check out page e ... 450 tk discount thakbe and lekha thakbe &ldquo;You have 01:34:27 left to use your ৳450 voucher&rdquo; ei lekha ta... thank you page theke onno kono page e customer geleo oi timer ta header or kothao ekta suitable place e show korbe... auto sms eo eta add korar option rakhte hobe...ভাউচার জেনারেট হবে অর্ডার ID / কাস্টমার ID এর সাথে...Timer ক্যালকুলেট হবে Voucher_created_time + 2 hours ... ei coupon tao admin theke autometic generate hobe .. coupon and timer bold kore show korbe and thank you page ei related product show korbe ...', 50, 2, '2026-02-02', NULL, 20, 20, NULL, '2026-01-28 08:25:03', '2026-01-28 08:25:57', NULL, NULL, NULL),
(64, 'medium', 'mobile menu te All category menu ta  ta dekstop veiw er moto Collapsible kore diben &amp; category gula show korbe', '', 53, 0, '2026-02-07', NULL, 1, 20, NULL, '2026-01-28 08:32:28', '2026-01-28 08:32:28', NULL, NULL, NULL),
(65, 'medium', 'header er  email  ta remove hoye . site address show korbe', '', 26, 0, '2026-01-28', NULL, 3, 20, NULL, '2026-01-28 09:20:04', '2026-01-28 09:20:04', NULL, NULL, NULL),
(66, 'medium', 'menuber image gula Thumb Image  hobe', '', 26, 0, '2026-01-28', NULL, 4, 20, NULL, '2026-01-28 09:25:14', '2026-01-28 09:25:14', NULL, NULL, NULL),
(67, 'medium', 'check out  page a cupon  add korar system kore dite hobe', '', 26, 0, '2026-01-28', NULL, 5, 20, NULL, '2026-01-28 09:27:24', '2026-01-28 09:27:24', NULL, NULL, NULL),
(68, 'medium', 'header a my account 2 ta hoiche akta kore diben', '', 26, 0, '2026-01-28', NULL, 6, 20, NULL, '2026-01-28 09:29:14', '2026-01-28 09:29:14', NULL, NULL, NULL),
(69, 'medium', '(afsanahbd.storola.net) একটি “View Size Chart” অপশন থাকবে। এই অপশনে ক্লিক করলে সাইজ চার্টের একটি ছবি ওপেন হবে। এই ছবিতে পোশাকের সাইজ সম্পর্কিত তথ্য ইমেজ ফরম্যাটে দেখানো থাকবে। পোশাকের ধরণ এবং ব্র্যান্ডভেদে সাইজ চার্ট ভিন্ন হতে পারে।', '', 48, 0, '2026-02-03', NULL, 3, 20, NULL, '2026-01-28 10:33:16', '2026-01-28 10:33:16', NULL, NULL, NULL),
(70, 'medium', 'product detail page a product   image  left &amp; right side a thakbe', '', 48, 0, '2026-02-03', NULL, 4, 20, NULL, '2026-01-28 10:36:40', '2026-01-28 10:37:37', NULL, NULL, NULL),
(71, 'medium', 'Contact Us from a  ai mail er jay number option diben', '', 2, 1, '2026-02-01', '2026-02-01', 2, 20, NULL, '2026-01-28 10:43:19', '2026-01-28 11:53:32', NULL, NULL, NULL),
(72, 'medium', 'Contact Us from a ai mail er jay number option diben', '', 61, 1, '2026-02-02', '2026-02-02', 1, 4, NULL, '2026-01-28 11:54:01', '2026-01-31 10:50:11', NULL, NULL, NULL),
(73, 'medium', 'Ongoing ( Site Decoration)', '', 67, 0, '2026-02-03', NULL, 1, 4, NULL, '2026-01-28 12:11:01', '2026-01-31 10:48:31', NULL, NULL, NULL),
(74, 'medium', 'Ongoing new project', '', 68, 0, '2026-02-03', NULL, 1, 4, NULL, '2026-01-28 12:16:31', '2026-01-31 10:48:14', NULL, NULL, NULL),
(75, 'medium', 'Ongoing', '', 69, 0, '2026-02-03', NULL, 1, 4, NULL, '2026-01-28 12:19:03', '2026-01-31 10:46:28', NULL, NULL, NULL),
(76, 'medium', 'Ongoing', '', 70, 0, '2026-02-03', NULL, 1, 4, NULL, '2026-01-28 12:21:49', '2026-01-31 10:45:38', NULL, NULL, NULL),
(77, 'medium', 'Ongoing', '', 72, 0, '2026-02-03', NULL, 1, 4, NULL, '2026-01-28 12:27:20', '2026-01-31 10:44:35', NULL, NULL, NULL),
(78, 'medium', 'site modification', '&lt;p&gt;1.&nbsp; Mobile view te banner height full hobe&nbsp;&lt;br&gt;uporer gap thakbe na and mobile view te banner size ektu boro hobe&nbsp;&lt;/p&gt;', 57, 0, '2026-01-28', NULL, 1, 10, 10, '2026-01-28 15:03:56', '2026-01-28 15:32:32', '2026-01-28 15:32:32', NULL, NULL),
(79, 'medium', 'Site Modification', '&lt;p&gt;1.&nbsp; Mobile view te banner height full hobe&nbsp;&lt;br&gt;uporer gap thakbe na and mobile view te banner size ektu boro hobe&nbsp;&lt;/p&gt;', 57, 0, '2026-01-28', NULL, 2, 10, 10, '2026-01-28 15:32:59', '2026-01-28 15:33:13', '2026-01-28 15:33:13', NULL, NULL),
(80, 'medium', 'Site modification (Details in Description)', '1.&nbsp; Mobile view te banner height full hobe&nbsp;&lt;br&gt;uporer gap thakbe na and mobile view te banner size ektu boro hobe&nbsp;', 57, 1, '2026-01-29', '2026-01-29', 3, 10, NULL, '2026-01-28 16:28:01', '2026-01-31 10:18:51', NULL, NULL, NULL),
(81, 'medium', 'edaystore client meeting', '', 57, 1, '2026-01-28', '2026-01-28', 4, 10, NULL, '2026-01-28 16:28:27', '2026-01-28 16:28:30', NULL, '20', 2),
(82, 'medium', 'ecomaze client meeting', '', 54, 1, '2026-01-28', '2026-01-28', 1, 10, NULL, '2026-01-28 16:29:34', '2026-01-28 16:30:04', NULL, '20', 2),
(83, 'medium', 'ecomaze courier set and site update', '', 54, 1, '2026-01-28', '2026-01-28', 2, 10, NULL, '2026-01-28 16:30:01', '2026-01-28 16:30:03', NULL, '40', 2),
(84, 'medium', 'hurram banner design', '', 42, 1, '2026-01-28', '2026-01-28', 2, 10, NULL, '2026-01-28 16:30:52', '2026-01-28 16:31:56', NULL, '01:00', 0),
(85, 'medium', 'Hurram site building', '', 42, 1, '2026-01-28', '2026-01-28', 3, 10, NULL, '2026-01-28 16:31:53', '2026-01-28 16:31:55', NULL, '01:10', 0),
(86, 'medium', 'lopa collection site building', '', 43, 1, '2026-01-28', '2026-01-28', 2, 10, NULL, '2026-01-28 16:32:36', '2026-01-28 16:32:38', NULL, '01:50', 0),
(87, 'medium', 'fashion craft client support', '', 64, 1, '2026-01-28', '2026-01-28', 1, 10, NULL, '2026-01-28 16:33:20', '2026-01-28 16:33:22', NULL, '01:00', 0),
(88, 'medium', 'meeting with management', '', 73, 1, '2026-01-28', '2026-01-28', 1, 10, NULL, '2026-01-28 16:37:01', '2026-01-28 16:42:23', NULL, '20', 2),
(89, 'medium', 'meeting with support team', '&lt;span style=&quot;font-size:14px;&quot;&gt;meeting with robiul bhai and somik bhai, shamim bhai&lt;/span&gt;', 73, 1, '2026-01-28', '2026-01-28', 2, 10, NULL, '2026-01-28 16:37:41', '2026-01-28 16:42:22', NULL, '01:15', 0),
(90, 'medium', 'meeting with sagor and somik bhai (bug fixing)', '', 73, 1, '2026-01-28', '2026-01-28', 3, 10, NULL, '2026-01-28 16:39:33', '2026-01-28 16:42:20', NULL, '01:30', 0),
(91, 'medium', 'new site client communication', '', 73, 1, '2026-01-28', '2026-01-28', 4, 10, NULL, '2026-01-28 16:41:18', '2026-01-28 16:42:19', NULL, '40', 2),
(92, 'medium', 'tracker dm site add', '', 73, 1, '2026-01-28', '2026-01-28', 5, 10, NULL, '2026-01-28 16:41:38', '2026-01-28 16:42:18', NULL, '20', 2),
(93, 'medium', 'zennova client support, shokherapple client support', '', 73, 1, '2026-01-28', '2026-01-28', 6, 10, NULL, '2026-01-28 16:42:13', '2026-01-28 16:42:17', NULL, '50', 2),
(94, 'medium', '1', '', 29, 0, '2026-01-28', NULL, 1, 20, 20, '2026-01-28 20:01:23', '2026-01-28 20:02:51', '2026-01-28 20:02:51', NULL, NULL),
(95, 'medium', 'dev requirement task a update', '', 29, 0, '2026-01-28', NULL, 2, 20, 20, '2026-01-28 20:04:39', '2026-01-31 04:55:00', '2026-01-31 04:55:00', '02:00', 0),
(96, 'medium', '2', '', 29, 0, '2026-01-28', NULL, 3, 20, 20, '2026-01-28 20:04:45', '2026-01-31 04:55:03', '2026-01-31 04:55:03', NULL, NULL),
(97, 'medium', '3', '', 29, 0, '2026-01-28', NULL, 4, 20, 20, '2026-01-28 20:04:51', '2026-01-31 04:55:06', '2026-01-31 04:55:06', NULL, NULL),
(98, 'medium', '4', '', 29, 0, '2026-01-28', NULL, 5, 20, 20, '2026-01-28 20:04:56', '2026-01-31 04:55:08', '2026-01-31 04:55:08', NULL, NULL),
(99, 'medium', '5', '', 29, 0, '2026-01-28', NULL, 6, 20, 20, '2026-01-28 20:05:03', '2026-01-31 04:55:11', '2026-01-31 04:55:11', NULL, NULL),
(100, 'medium', '6', '', 29, 0, '2026-01-28', NULL, 7, 20, 20, '2026-01-28 20:05:10', '2026-01-31 04:55:13', '2026-01-31 04:55:13', NULL, NULL),
(101, 'medium', '7', '', 29, 0, '2026-01-28', NULL, 8, 20, 20, '2026-01-28 20:05:15', '2026-01-31 04:55:16', '2026-01-31 04:55:16', NULL, NULL),
(102, 'medium', '8', '', 29, 0, '2026-01-28', NULL, 9, 20, 20, '2026-01-28 20:05:20', '2026-01-31 04:55:19', '2026-01-31 04:55:19', NULL, NULL),
(103, 'medium', '9', '', 29, 0, '2026-01-28', NULL, 10, 20, 20, '2026-01-28 20:05:26', '2026-01-31 04:55:22', '2026-01-31 04:55:22', NULL, NULL),
(104, 'medium', '10', '', 29, 0, '2026-01-28', NULL, 11, 20, 20, '2026-01-28 20:05:32', '2026-01-31 04:55:25', '2026-01-31 04:55:25', NULL, NULL),
(105, 'medium', '11', '', 29, 0, '2026-01-28', NULL, 12, 20, 20, '2026-01-28 20:05:38', '2026-01-31 04:55:27', '2026-01-31 04:55:27', NULL, NULL),
(106, 'medium', 'client communication', '', 14, 1, '2026-01-29', '2026-01-29', 2, 27, NULL, '2026-01-29 06:58:08', '2026-01-29 06:59:23', NULL, '20', 2),
(107, 'medium', 'sales ad run', '&lt;p&gt;ABO- adset-1 -open ,$3&lt;br&gt;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;adset-2,$2- cus&amp;amp;lal(1%to2%)--vv50%&lt;br&gt;creative : script-3&nbsp;&lt;br&gt;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; script-5&lt;/p&gt;', 74, 1, '2026-01-29', '2026-01-29', 1, 12, NULL, '2026-01-29 07:18:35', '2026-01-29 14:14:30', NULL, '45', 2),
(108, 'medium', 'sales ad run', 'cbo-$5- adset-1 -open ,&lt;br&gt;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;adset-2, cus&amp;amp;lal(1%to2%)--vv50%&lt;br&gt;creative : script-3&nbsp;&lt;br&gt;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; script-5', 74, 1, '2026-01-29', '2026-01-29', 2, 12, NULL, '2026-01-29 07:19:26', '2026-01-29 11:33:50', NULL, '40', 2),
(109, 'medium', 'dm ongoing', '', 74, 0, '2026-02-28', NULL, 3, 12, NULL, '2026-01-29 07:19:51', '2026-01-29 07:19:51', NULL, NULL, NULL),
(110, 'medium', 'sales ad-msg', '&lt;p&gt;existing msg campaign - conversion location - WA&lt;/p&gt;', 3, 1, '2026-01-29', '2026-01-29', 2, 12, NULL, '2026-01-29 07:25:20', '2026-01-29 14:15:14', NULL, '45', 2),
(111, 'medium', 'Site modification', '', 2, 1, '2026-02-01', '2026-02-01', 3, 10, NULL, '2026-01-29 10:23:29', '2026-02-03 03:10:09', NULL, '01:00', 0),
(112, 'medium', 'client communication', '', 10, 1, '2026-01-29', '2026-01-29', 2, 27, NULL, '2026-01-29 10:45:29', '2026-01-29 14:15:38', NULL, '20', 2),
(113, 'medium', 'Order Statuse gula remove hobe(details in desciption)', '&lt;p&gt;Cancel Reserved&lt;/p&gt;\n\n&lt;p&gt;Chargeback&lt;/p&gt;\n\n&lt;p&gt;Denied&lt;/p&gt;\n\n&lt;p&gt;Expire&lt;/p&gt;\n\n&lt;p&gt;Failed&lt;/p&gt;\n\n&lt;p&gt;Processed&lt;/p&gt;\n\n&lt;p&gt;Refunded&lt;/p&gt;\n\n&lt;p&gt;Reversed&lt;/p&gt;\n\n&lt;p&gt;Voided&lt;/p&gt;\n\n&lt;p&gt;Waiting for Pickup&lt;/p&gt;', 76, 0, '2026-02-03', NULL, 1, 20, NULL, '2026-01-29 10:56:49', '2026-01-31 10:23:55', NULL, NULL, NULL),
(114, 'medium', 'Meeting with stylishbd.com', '', 38, 1, '2026-01-29', '2026-01-29', 5, 4, NULL, '2026-01-29 13:41:37', '2026-01-29 13:41:41', NULL, '25', 2),
(115, 'medium', 'Meeting with Shmim', '', 73, 1, '2026-01-29', '2026-01-29', 7, 4, NULL, '2026-01-29 13:44:03', '2026-01-29 13:47:43', NULL, '30', 2),
(116, 'medium', 'Meeting with Sagor vai', '', 73, 1, '2026-01-29', '2026-01-29', 8, 4, NULL, '2026-01-29 13:45:14', '2026-01-29 13:47:41', NULL, '10', 2),
(117, 'medium', 'Meeting with Robiul', '', 73, 1, '2026-01-29', '2026-01-29', 9, 4, NULL, '2026-01-29 13:45:39', '2026-01-29 13:47:40', NULL, '10', 2),
(118, 'medium', 'Potential client meeting (7 person)', '', 73, 1, '2026-01-29', '2026-01-29', 10, 4, NULL, '2026-01-29 13:46:41', '2026-01-29 13:47:38', NULL, '03:00', 0),
(119, 'medium', 'requirements shit Check &amp; update', '', 73, 1, '2026-01-29', '2026-01-29', 11, 4, NULL, '2026-01-29 13:47:04', '2026-01-29 13:47:37', NULL, '40', 2),
(120, 'medium', 'Assaign work to support team', '', 73, 1, '2026-01-29', '2026-01-29', 12, 4, NULL, '2026-01-29 13:47:33', '2026-01-29 13:47:36', NULL, '01:00', 0),
(121, 'medium', 'Domain purchase &amp; cloudflare add &amp; remove captcha from cloud', '', 73, 1, '2026-01-29', '2026-01-29', 13, 4, NULL, '2026-01-29 13:48:03', '2026-01-29 13:48:37', NULL, '50', 2),
(122, 'medium', 'Discord &amp; Whatsapp group message check &amp; reply All days', '', 73, 1, '2026-01-29', '2026-01-29', 14, 4, NULL, '2026-01-29 13:48:35', '2026-01-29 13:48:36', NULL, '01:20', 0),
(123, 'medium', 'Accounting Sheet update ,Leger create,Money receipt create &amp; Send', '', 73, 1, '2026-01-29', '2026-01-29', 15, 4, NULL, '2026-01-29 13:49:31', '2026-01-29 13:49:33', NULL, '50', 2),
(124, 'medium', 'edaystore client support', '', 57, 1, '2026-01-29', '2026-01-29', 5, 10, NULL, '2026-01-29 15:15:57', '2026-01-29 15:15:59', NULL, '30', 2),
(125, 'medium', '66 mart theme color, layout', '', 68, 1, '2026-01-29', '2026-01-29', 2, 10, NULL, '2026-01-29 15:16:42', '2026-01-29 15:16:43', NULL, '40', 2),
(126, 'medium', 'hurram ready to live', '', 42, 1, '2026-01-29', '2026-01-29', 4, 10, NULL, '2026-01-29 15:17:40', '2026-01-29 15:17:41', NULL, '02:00', 0),
(127, 'medium', 'ecomaze client support', '', 12, 1, '2026-01-29', '2026-01-29', 2, 10, NULL, '2026-01-29 15:18:14', '2026-01-29 15:18:16', NULL, '40', 2),
(128, 'medium', 'lopa callection ready to live', '', 43, 1, '2026-01-29', '2026-01-29', 3, 10, NULL, '2026-01-29 15:18:43', '2026-01-29 15:18:44', NULL, '01:30', 0),
(129, 'medium', 'fashion craft site update', '', 64, 1, '2026-01-29', '2026-01-29', 2, 10, NULL, '2026-01-29 15:19:57', '2026-01-29 15:19:58', NULL, '01:10', 0),
(130, 'medium', 'meeting with sagor bhai and ahanaf bhai ( bug fixing)', '', 73, 1, '2026-01-29', '2026-01-29', 16, 10, NULL, '2026-01-29 15:20:42', '2026-01-29 15:20:44', NULL, '02:00', 0),
(131, 'medium', 'a', '', 73, 1, '2026-01-29', '2026-01-29', 17, 10, NULL, '2026-01-29 15:20:51', '2026-01-31 10:25:03', NULL, NULL, NULL),
(132, 'medium', 'meeting with robiul bhai,shamim bhai, somik bhai', '', 73, 1, '2026-01-29', '2026-01-29', 18, 10, NULL, '2026-01-29 15:21:37', '2026-01-29 15:21:47', NULL, '45', 2),
(133, 'medium', 'whatsapp group Text reply', '', 73, 1, '2026-01-29', '2026-01-29', 19, 10, NULL, '2026-01-29 15:22:19', '2026-01-29 15:22:21', NULL, '30', 2),
(134, 'medium', 'Denmesia site work', '', 29, 1, '2026-01-29', '2026-01-29', 13, 20, NULL, '2026-01-29 16:11:49', '2026-01-30 01:35:59', NULL, '02:00', 0),
(135, 'medium', 'Meeting with somik vai', '', 29, 1, '2026-01-29', '2026-01-29', 14, 20, NULL, '2026-01-29 16:11:55', '2026-01-30 01:36:00', NULL, '15', 2),
(136, 'medium', 'Meeting with pavel', '', 29, 1, '2026-01-29', '2026-01-29', 15, 20, NULL, '2026-01-29 16:12:00', '2026-01-30 01:36:02', NULL, '25', 2),
(137, 'medium', 'Meeting with  robiul', '', 29, 1, '2026-01-29', '2026-01-29', 16, 20, NULL, '2026-01-29 16:12:05', '2026-01-30 01:36:03', NULL, '20', 2),
(138, 'medium', 'Meeting with mamun vai', '', 29, 1, '2026-01-29', '2026-01-29', 17, 20, NULL, '2026-01-29 16:12:12', '2026-01-30 01:36:04', NULL, '15', 2),
(139, 'medium', 'Smartessetianbd new site work', '', 29, 1, '2026-01-29', '2026-01-29', 18, 20, NULL, '2026-01-29 16:12:18', '2026-01-30 01:36:05', NULL, '40', 2),
(140, 'medium', 'Meeting with didar vai &amp; raiyan vai', '', 29, 1, '2026-01-29', '2026-01-29', 19, 20, NULL, '2026-01-29 16:12:23', '2026-01-30 01:36:06', NULL, '30', 2),
(141, 'medium', 'Offer buy shop site work &amp; support', '', 29, 1, '2026-01-29', '2026-01-29', 20, 20, NULL, '2026-01-29 16:12:31', '2026-01-30 01:36:07', NULL, '30', 2),
(142, 'medium', 'Other site &amp; new site work,support, meeting', '', 29, 1, '2026-01-29', '2026-01-29', 21, 20, NULL, '2026-01-29 16:17:10', '2026-01-30 01:36:09', NULL, '03:00', 0),
(143, 'medium', 'Task list  &amp; dev RQ update', '', 29, 1, '2026-01-29', '2026-01-29', 22, 20, NULL, '2026-01-29 16:17:15', '2026-01-30 01:36:10', NULL, '25', 2),
(144, 'medium', 'Wp &amp; discord message check &amp; reply', '', 29, 1, '2026-01-29', '2026-01-29', 23, 20, NULL, '2026-01-29 16:17:20', '2026-01-30 01:36:11', NULL, '02:00', 0),
(145, 'medium', 'misking site create and store setup', '', 40, 1, '2026-01-30', '2026-01-30', 2, 10, NULL, '2026-01-30 13:29:25', '2026-01-30 13:29:27', NULL, '50', 2),
(146, 'medium', '66 mart site ready to live', '', 68, 1, '2026-01-30', '2026-01-30', 3, 10, NULL, '2026-01-30 13:30:04', '2026-01-30 13:30:06', NULL, '01:10', 0),
(147, 'medium', 'smartessential site ready to live', '', 72, 1, '2026-01-30', '2026-01-30', 2, 10, NULL, '2026-01-30 13:31:20', '2026-01-30 13:31:22', NULL, '01:50', 0),
(148, 'medium', 'masteressential banner design and static banner making', '', 72, 1, '2026-01-30', '2026-01-30', 3, 10, NULL, '2026-01-30 13:31:54', '2026-01-30 13:31:55', NULL, '01:30', 0),
(149, 'medium', 'modern style site building', '', 69, 1, '2026-01-30', '2026-01-30', 2, 10, NULL, '2026-01-30 13:33:15', '2026-01-30 13:33:17', NULL, '01:10', 0),
(150, 'medium', 'meeting with shamim bhai, robiul bhai', '', 73, 1, '2026-01-30', '2026-01-30', 20, 10, NULL, '2026-01-30 13:34:03', '2026-01-30 13:34:27', NULL, '50', 2),
(151, 'medium', 'group text reply and support help', '', 73, 1, '2026-01-30', '2026-01-30', 21, 10, NULL, '2026-01-30 13:34:22', '2026-01-30 13:34:24', NULL, '40', 2),
(152, 'medium', '(https://dhakabdstore.storola.net/) footer a Fb link  change korte hobe ai link diben :  https://www.facebook.com/profile.php?id=61587364791002', '', 70, 0, '2026-02-03', NULL, 2, 20, NULL, '2026-01-30 13:35:20', '2026-01-31 10:46:12', NULL, NULL, NULL),
(153, 'medium', 'Denmesia site work full ready', '', 29, 1, '2026-01-30', '2026-01-30', 24, 20, NULL, '2026-01-30 14:27:05', '2026-01-31 04:51:05', NULL, '02:00', 0),
(154, 'medium', 'Nazzo site work', '', 29, 1, '2026-01-30', '2026-01-30', 25, 20, NULL, '2026-01-30 14:27:09', '2026-01-31 04:51:06', NULL, '02:00', 0),
(155, 'medium', 'Dhakastorebd site work', '', 29, 1, '2026-01-30', '2026-01-30', 26, 20, NULL, '2026-01-30 14:27:14', '2026-01-31 04:51:07', NULL, '02:00', 0),
(156, 'medium', 'Offerbuy shop site client support', '', 29, 1, '2026-01-30', '2026-01-30', 27, 20, NULL, '2026-01-30 14:27:18', '2026-01-31 04:51:08', NULL, '30', 2),
(157, 'medium', 'Fashionfabrics site client support', '', 29, 1, '2026-01-30', '2026-01-30', 28, 20, NULL, '2026-01-30 14:27:23', '2026-01-31 04:51:09', NULL, '30', 2),
(158, 'medium', 'Other site work &amp; meeting', '', 29, 1, '2026-01-30', '2026-01-30', 29, 20, NULL, '2026-01-30 14:27:28', '2026-01-31 04:51:11', NULL, '02:00', 0),
(159, 'medium', 'Wp &amp; discoard message check &amp; reply', '', 29, 1, '2026-01-30', '2026-01-30', 30, 20, NULL, '2026-01-30 14:27:32', '2026-01-31 04:51:12', NULL, '02:40', 0),
(160, 'medium', 'Meeting with - pavel', '', 29, 1, '2026-01-30', '2026-01-30', 31, 20, NULL, '2026-01-30 14:27:36', '2026-01-31 04:51:13', NULL, '20', 2),
(161, 'medium', 'Meeting with robiul', '', 29, 1, '2026-01-30', '2026-01-30', 32, 20, NULL, '2026-01-30 14:27:42', '2026-01-31 04:51:15', NULL, '25', 2),
(162, 'medium', 'Meeting with Sagor vai', '', 29, 1, '2026-01-30', '2026-01-30', 33, 20, NULL, '2026-01-30 14:28:04', '2026-01-31 04:51:16', NULL, '10', 2),
(163, 'medium', 'Shoberbazar site work', '', 29, 1, '2026-01-30', '2026-01-30', 34, 20, NULL, '2026-01-30 14:28:10', '2026-01-31 04:51:17', NULL, '25', 2),
(164, 'medium', 'New Campaign plan', '', 3, 1, '2026-01-30', '2026-01-30', 3, 12, NULL, '2026-01-30 21:05:30', '2026-01-30 21:05:34', NULL, '01:00', 0),
(165, 'medium', 'audit gtm and event manager', '', 9, 1, '2026-01-30', '2026-01-30', 2, 12, NULL, '2026-01-30 21:08:00', '2026-01-30 21:08:04', NULL, '01:00', 0),
(166, 'medium', 'Gtm Setup-fb', '', 9, 1, '2026-01-30', '2026-01-30', 3, 12, NULL, '2026-01-30 21:09:02', '2026-01-30 21:09:04', NULL, '02:00', 0),
(167, 'medium', 'ad run', '', 10, 1, '2026-01-30', '2026-01-30', 3, 12, NULL, '2026-01-30 21:09:47', '2026-01-30 21:09:50', NULL, '30', 2),
(168, 'medium', 'client meeting', '', 10, 1, '2026-01-30', '2026-01-30', 4, 12, NULL, '2026-01-30 21:10:11', '2026-01-30 21:10:14', NULL, '01:00', 0),
(169, 'medium', 'client meeting', '', 14, 1, '2026-01-30', '2026-01-30', 3, 12, NULL, '2026-01-30 21:11:21', '2026-01-30 21:11:23', NULL, '45', 2),
(170, 'medium', 'gtm setup-full', '', 21, 1, '2026-01-30', '2026-01-30', 2, 12, NULL, '2026-01-30 21:12:28', '2026-01-30 21:14:46', NULL, '04:00', 0),
(171, 'medium', 'client meeting', '', 21, 1, '2026-01-30', '2026-01-30', 3, 12, NULL, '2026-01-30 21:15:18', '2026-01-30 21:15:31', NULL, '01:00', 0),
(172, 'medium', 'campaign design', '', 74, 1, '2026-01-30', '2026-01-30', 4, 12, NULL, '2026-01-30 21:46:52', '2026-01-30 21:46:56', NULL, '01:00', 0),
(173, 'medium', 'clietnt meeting', '', 14, 1, '2026-01-30', '2026-01-30', 4, 12, NULL, '2026-01-30 21:52:11', '2026-01-30 21:52:14', NULL, '01:00', 0),
(174, 'medium', 'client meeting', '', 19, 1, '2026-01-30', '2026-01-30', 2, 12, NULL, '2026-01-30 21:53:10', '2026-01-30 21:53:12', NULL, '01:00', 0),
(175, 'medium', 'test', '', 29, 1, '2026-02-03', '2026-02-04', 35, 1, NULL, '2026-02-03 00:41:23', '2026-02-04 01:54:11', NULL, '01:00', 0),
(176, 'medium', 'tutyutyu', '', 29, 0, '2026-02-03', NULL, 36, 19, 1, '2026-02-03 00:46:17', '2026-02-04 01:58:23', '2026-02-04 01:58:23', NULL, NULL),
(177, 'medium', 'fdghgfh', '', 57, 0, '2026-02-03', NULL, 6, 1, NULL, '2026-02-03 03:01:29', '2026-02-03 03:01:29', NULL, NULL, NULL),
(178, 'medium', 'uioiuo', '', 2, 1, '2026-02-03', '2026-02-03', 4, 1, NULL, '2026-02-03 03:11:17', '2026-02-03 03:11:33', NULL, '01:00', 0),
(179, 'medium', 'rtyhrt', '', 2, 1, '2026-02-03', '2026-02-03', 5, 1, NULL, '2026-02-03 03:14:03', '2026-02-03 03:14:09', NULL, '2', 2),
(180, 'medium', 'ytytuytu', '', 75, 0, '2026-02-03', NULL, 1, 1, 1, '2026-02-03 03:14:38', '2026-02-04 02:03:45', '2026-02-04 02:03:45', '01:00', 0),
(181, 'medium', 'ytyutyu', '', 2, 1, '2026-02-03', '2026-02-03', 6, 1, NULL, '2026-02-03 03:15:46', '2026-02-03 03:15:59', NULL, '01:00', 0),
(182, 'medium', 'yuuyi', '', 52, 0, '2026-02-03', NULL, 4, 1, 1, '2026-02-03 03:22:32', '2026-02-03 03:23:31', '2026-02-03 03:23:31', '01:00', 0),
(183, 'medium', 'trfytrytry', '', 81, 1, '2026-02-03', '2026-02-03', 1, 1, NULL, '2026-02-03 03:41:02', '2026-02-03 03:41:33', NULL, '01:00', 0),
(184, 'high', 'sdfs', '', 29, 0, '2026-02-03', NULL, 37, 1, 1, '2026-02-03 04:42:05', '2026-02-04 01:58:40', '2026-02-04 01:58:40', '01:01', 0),
(185, 'medium', 'dgfd', '', 29, 0, '2026-02-03', NULL, 38, 19, 1, '2026-02-03 05:08:55', '2026-02-04 01:58:32', '2026-02-04 01:58:32', NULL, NULL),
(186, 'medium', 'dfgdfgdfg', '', 50, 0, '2026-02-03', NULL, 21, 19, NULL, '2026-02-03 05:11:25', '2026-02-03 05:11:25', NULL, NULL, NULL),
(187, 'medium', 'rtrergf', '', 50, 0, '2026-02-03', NULL, 22, 19, NULL, '2026-02-03 05:19:02', '2026-02-03 05:19:02', NULL, NULL, NULL),
(188, 'medium', 'dcsd', '', 50, 0, '2026-02-03', NULL, 23, 19, NULL, '2026-02-03 05:19:42', '2026-02-03 05:19:42', NULL, NULL, NULL),
(189, 'medium', 'zxczxczx', '', 50, 0, '2026-02-03', NULL, 24, 19, NULL, '2026-02-03 05:20:08', '2026-02-03 05:20:08', NULL, NULL, NULL),
(190, 'medium', 'zXCxzc', '', 50, 0, '2026-02-03', NULL, 25, 19, NULL, '2026-02-03 05:20:43', '2026-02-03 05:20:43', NULL, NULL, NULL),
(191, 'medium', 'shaj', '', 50, 0, '2026-02-03', NULL, 26, 19, NULL, '2026-02-03 05:22:05', '2026-02-03 05:22:05', NULL, NULL, NULL),
(192, 'medium', 'xcvxc', '', 50, 0, '2026-02-03', NULL, 27, 19, NULL, '2026-02-03 05:26:57', '2026-02-03 05:26:57', NULL, NULL, NULL),
(193, 'medium', 'test', '', 50, 0, '2026-02-03', NULL, 28, 19, NULL, '2026-02-03 05:27:22', '2026-02-03 05:27:22', NULL, NULL, NULL),
(194, 'medium', 'test2', '', 70, 0, '2026-02-03', NULL, 3, 19, NULL, '2026-02-03 05:28:52', '2026-02-03 05:28:52', NULL, NULL, NULL),
(195, 'medium', 'fgdfg', '', 70, 0, '2026-02-03', NULL, 4, 19, NULL, '2026-02-03 05:29:29', '2026-02-03 05:29:29', NULL, NULL, NULL),
(196, 'medium', 'fgfg', '', 70, 0, '2026-02-03', NULL, 5, 19, NULL, '2026-02-03 05:30:32', '2026-02-03 05:30:32', NULL, NULL, NULL),
(197, 'medium', 'sdfs', '', 49, 2, '2026-02-03', NULL, 2, 19, 1, '2026-02-03 05:31:46', '2026-02-19 01:25:05', '2026-02-19 01:25:05', NULL, NULL),
(198, 'medium', 'task 1', '', 84, 1, '2026-02-04', '2026-02-04', 1, 19, NULL, '2026-02-04 00:09:26', '2026-02-04 00:37:49', NULL, '01:00', 0),
(199, 'medium', 'task 2', '', 84, 1, '2026-02-04', '2026-02-04', 2, 19, NULL, '2026-02-04 00:09:45', '2026-02-04 00:41:55', NULL, '01:00', 0),
(200, 'medium', 'task 3', '', 84, 1, '2026-02-04', '2026-02-04', 3, 19, NULL, '2026-02-04 00:10:05', '2026-02-04 00:51:52', NULL, '01:00', 0),
(201, 'medium', 'task 4', '', 84, 1, '2026-02-04', '2026-02-04', 4, 19, NULL, '2026-02-04 00:10:28', '2026-02-04 01:34:05', NULL, '01:00', 0),
(202, 'medium', 'task 5', '', 84, 1, '2026-02-04', '2026-02-04', 5, 19, NULL, '2026-02-04 00:11:09', '2026-02-04 01:36:11', NULL, '01:00', 0),
(203, 'medium', 'task 6', '', 84, 1, '2026-02-04', '2026-02-04', 6, 19, NULL, '2026-02-04 00:11:25', '2026-02-04 01:36:18', NULL, '01:00', 0),
(204, 'medium', 'task 7', '', 84, 1, '2026-02-04', '2026-02-04', 7, 19, NULL, '2026-02-04 00:11:39', '2026-02-04 01:35:58', NULL, '01:00', 0),
(205, 'medium', 'task 8', '', 84, 1, '2026-02-04', '2026-02-04', 8, 19, NULL, '2026-02-04 00:11:59', '2026-02-04 01:35:53', NULL, '01:00', 0),
(206, 'medium', 'task 9', '', 84, 1, '2026-02-04', '2026-02-04', 9, 19, NULL, '2026-02-04 00:12:16', '2026-02-04 01:35:47', NULL, '01:00', 0),
(207, 'medium', 'task 10', '', 84, 1, '2026-02-04', '2026-02-04', 10, 19, NULL, '2026-02-04 00:12:32', '2026-02-04 01:35:42', NULL, '01:00', 0),
(208, 'medium', 'task 11', '', 84, 1, '2026-02-04', '2026-02-04', 11, 19, NULL, '2026-02-04 00:13:03', '2026-02-04 01:35:36', NULL, '01:00', 0),
(209, 'medium', 'task 12', '', 84, 1, '2026-02-04', '2026-02-04', 12, 19, NULL, '2026-02-04 00:13:22', '2026-02-04 01:35:27', NULL, '01:00', 0),
(210, 'medium', 'task 13', '', 84, 1, '2026-02-04', '2026-02-04', 13, 19, NULL, '2026-02-04 01:40:45', '2026-02-04 01:40:53', NULL, '01:00', 0),
(211, 'medium', 'task 15', '', 84, 0, '2026-02-04', NULL, 14, 19, 19, '2026-02-04 01:44:32', '2026-02-04 01:44:48', '2026-02-04 01:44:48', '01:00', 0),
(212, 'medium', 'test16', '', 84, 1, '2026-02-04', '2026-02-04', 15, 19, NULL, '2026-02-04 01:49:17', '2026-02-04 01:51:30', NULL, '01:00', 0),
(213, 'high', 'test task 1', '', 85, 1, '2026-02-04', '2026-02-04', 1, 1, NULL, '2026-02-04 02:08:27', '2026-02-04 02:08:37', NULL, '01:00', 0),
(214, 'medium', 'gfhfh', '', 49, 2, '2026-02-10', NULL, 3, 19, NULL, '2026-02-09 23:30:43', '2026-02-25 04:40:25', NULL, NULL, NULL),
(215, 'high', 'dfgdfg', '', 49, 0, '2026-02-17', NULL, 4, 1, NULL, '2026-02-17 04:42:56', '2026-02-17 04:42:56', NULL, NULL, NULL),
(216, 'medium', 'abcd', '', 49, 1, '2026-02-17', '2026-02-17', 5, 19, NULL, '2026-02-17 06:45:38', '2026-02-17 06:46:39', NULL, '1', 2),
(217, 'medium', 'test case', '', 49, 1, '2026-02-17', '2026-04-06', 6, 19, NULL, '2026-02-17 06:49:13', '2026-04-06 01:01:01', NULL, '01:00', 0),
(218, 'medium', 'test case 02', '', 49, 0, '2026-02-17', NULL, 7, 19, NULL, '2026-02-17 06:49:51', '2026-02-17 06:49:51', NULL, NULL, NULL),
(219, 'medium', 'test case', '', 49, 0, '2026-02-17', NULL, 8, 19, NULL, '2026-02-17 06:50:10', '2026-02-17 06:50:10', NULL, '1', 2);
INSERT INTO `tasks` (`id`, `priority`, `title`, `description`, `project_id`, `status`, `due_date`, `completed_on`, `task_number`, `created_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`, `estimate_time`, `estimate_time_type`) VALUES
(220, 'high', '5terte', 'abc', 49, 0, '2026-02-17', NULL, 9, 19, NULL, '2026-02-17 06:51:40', '2026-02-25 04:40:07', NULL, '01:00', 0),
(221, 'high', 'test1', '', 68, 0, NULL, NULL, 4, 1, NULL, '2026-02-18 22:25:15', '2026-02-18 22:25:15', NULL, '33', 2),
(222, 'medium', 'test case 02', '', 49, 0, '2026-02-19', NULL, 10, 1, NULL, '2026-02-18 22:45:11', '2026-02-19 01:34:49', NULL, NULL, NULL),
(223, 'high', 'test case 03', '', 29, 1, '2026-02-19', '2026-02-19', 39, 1, NULL, '2026-02-19 01:37:05', '2026-02-19 02:05:13', NULL, '1', 2),
(224, 'high', 'dfgdfg', '', 29, 1, '2026-02-19', '2026-02-19', 40, 1, NULL, '2026-02-19 02:08:22', '2026-02-19 03:45:40', NULL, '1', 2),
(225, 'medium', 'test task -01', '', 29, 1, '2026-02-19', '2026-02-19', 41, 1, NULL, '2026-02-19 03:26:13', '2026-02-19 04:29:15', NULL, '01:00', 0),
(226, 'medium', 'test 04', '', 29, 1, '2026-03-01', '2026-03-01', 42, 1, NULL, '2026-02-19 03:32:05', '2026-03-01 02:25:35', NULL, '06:15', 0),
(227, 'medium', 'test', '', 29, 1, '2026-02-19', '2026-02-19', 43, 1, NULL, '2026-02-19 03:52:09', '2026-02-19 04:26:37', NULL, '1', 2),
(228, 'medium', 'ttt', '', 50, 0, '2026-02-26', NULL, 29, 1, NULL, '2026-02-20 04:20:49', '2026-02-25 05:02:02', NULL, NULL, NULL),
(229, 'medium', 'test', '', 29, 1, '2026-02-25', '2026-03-03', 44, 19, NULL, '2026-02-25 05:33:53', '2026-03-03 06:34:53', NULL, '01:00', 0),
(230, 'high', 'test task-001', '', 30, 1, '2026-03-01', '2026-03-01', 1, 1, NULL, '2026-03-01 05:01:41', '2026-03-01 05:08:28', NULL, '12', 2),
(231, 'medium', 'test 004', '', 84, 0, '2026-03-01', NULL, 16, 1, 1, '2026-03-01 05:25:17', '2026-03-01 05:26:14', '2026-03-01 05:26:14', '1', 2),
(232, 'high', 'test task 1', '', 92, 0, '2026-03-02', NULL, 1, 1, 1, '2026-03-02 01:32:47', '2026-03-02 01:33:54', '2026-03-02 01:33:54', '1', 2),
(233, 'high', 'test-1', '', 29, 1, '2026-03-03', '2026-03-03', 45, 1, NULL, '2026-03-03 05:06:38', '2026-03-03 05:07:34', NULL, '01:15', 0),
(234, 'high', 'test2', '', 29, 1, '2026-03-04', '2026-03-03', 46, 1, NULL, '2026-03-03 05:07:18', '2026-03-03 05:07:31', NULL, '01:00', 0),
(235, 'high', 'test 3', '', 29, 1, '2026-03-03', NULL, 47, 1, NULL, '2026-03-03 05:33:28', '2026-03-03 05:35:21', NULL, '01:01', 0),
(236, 'high', 'test 4', '', 29, 1, '2026-03-03', NULL, 48, 1, NULL, '2026-03-03 05:37:04', '2026-03-03 06:34:31', NULL, '01:00', 0),
(237, 'high', 'test 1', '', 34, 1, '2026-03-05', '2026-04-06', 1, 1, NULL, '2026-03-05 00:11:08', '2026-04-06 01:01:44', NULL, '33', 2),
(238, 'medium', 'test', '', 36, 0, NULL, NULL, 1, 1, NULL, '2026-03-12 05:41:52', '2026-03-12 05:41:52', NULL, NULL, NULL),
(239, 'medium', 'rt', '', 50, 0, NULL, NULL, 30, 1, NULL, '2026-03-12 06:11:23', '2026-03-12 06:11:23', NULL, NULL, NULL),
(240, 'medium', 'test', '', 50, 0, NULL, NULL, 31, 1, NULL, '2026-03-12 06:11:42', '2026-03-12 06:11:42', NULL, NULL, NULL),
(241, 'high', 'kanban list test task 1', '', 50, 1, NULL, NULL, 32, 1, NULL, '2026-04-05 05:28:11', '2026-04-06 00:35:39', NULL, NULL, NULL),
(242, 'high', 'khanban test task 2', '', 44, 1, '2026-04-05', '2026-04-06', 2, 19, NULL, '2026-04-05 05:32:46', '2026-04-06 00:01:27', NULL, '01:00', 0),
(243, 'high', 'kanban test task 3', '', 44, 1, '2026-04-06', '2026-04-06', 3, 19, NULL, '2026-04-05 06:13:12', '2026-04-06 00:29:57', NULL, '01:00', 0),
(244, 'medium', 'test kanban task 4', '', 44, 1, '2026-04-05', '2026-04-05', 4, 19, NULL, '2026-04-05 06:41:02', '2026-04-05 07:48:11', NULL, '01:00', 0),
(245, 'high', 'test kanban task 5', '', 44, 1, '2026-04-05', '2026-04-06', 5, 19, NULL, '2026-04-05 07:02:40', '2026-04-06 00:54:08', NULL, '01:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `task_assignees`
--

CREATE TABLE `task_assignees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_assignees`
--

INSERT INTO `task_assignees` (`id`, `task_id`, `user_id`) VALUES
(1, 1, 4),
(2, 2, 12),
(3, 3, 17),
(4, 4, 17),
(5, 5, 17),
(6, 6, 17),
(7, 7, 17),
(8, 8, 17),
(9, 9, 17),
(10, 10, 4),
(11, 11, 4),
(12, 12, 17),
(13, 13, 17),
(14, 14, 17),
(15, 15, 17),
(16, 16, 4),
(17, 17, 17),
(18, 18, 4),
(19, 19, 3),
(20, 19, 4),
(21, 20, 4),
(22, 20, 3),
(23, 21, 10),
(24, 22, 20),
(25, 23, 10),
(26, 22, 3),
(27, 24, 10),
(28, 25, 10),
(29, 26, 10),
(30, 27, 10),
(31, 28, 10),
(32, 29, 10),
(33, 30, 20),
(34, 31, 3),
(35, 31, 20),
(36, 32, 3),
(37, 32, 4),
(38, 33, 4),
(39, 33, 3),
(40, 34, 3),
(41, 34, 20),
(42, 35, 3),
(43, 35, 20),
(44, 36, 3),
(45, 36, 20),
(46, 37, 3),
(47, 37, 8),
(49, 38, 3),
(50, 38, 10),
(51, 38, 20),
(52, 39, 3),
(53, 39, 10),
(54, 39, 20),
(55, 40, 3),
(56, 40, 10),
(57, 40, 20),
(58, 41, 3),
(59, 41, 10),
(60, 41, 20),
(70, 45, 20),
(71, 45, 8),
(72, 45, 3),
(73, 46, 3),
(74, 46, 8),
(75, 46, 20),
(76, 47, 3),
(77, 47, 8),
(78, 47, 20),
(79, 48, 20),
(80, 48, 3),
(81, 48, 8),
(82, 49, 3),
(83, 49, 8),
(84, 49, 20),
(85, 50, 3),
(86, 50, 8),
(87, 50, 20),
(88, 51, 3),
(89, 51, 8),
(90, 51, 20),
(91, 52, 3),
(92, 52, 8),
(93, 52, 20),
(94, 53, 3),
(95, 53, 8),
(96, 53, 20),
(97, 54, 3),
(98, 54, 8),
(99, 54, 20),
(100, 55, 3),
(101, 55, 8),
(102, 55, 20),
(103, 56, 20),
(104, 56, 3),
(105, 56, 8),
(106, 57, 20),
(107, 57, 3),
(108, 57, 8),
(109, 58, 3),
(110, 58, 8),
(111, 58, 20),
(112, 59, 3),
(113, 59, 8),
(114, 59, 20),
(115, 60, 3),
(116, 60, 8),
(117, 60, 20),
(118, 61, 3),
(119, 61, 8),
(120, 61, 20),
(121, 62, 3),
(122, 62, 8),
(123, 62, 20),
(124, 63, 3),
(125, 63, 8),
(126, 63, 20),
(127, 64, 20),
(128, 64, 3),
(129, 37, 10),
(130, 65, 3),
(131, 65, 20),
(132, 66, 3),
(133, 66, 20),
(134, 67, 3),
(135, 67, 20),
(136, 68, 3),
(137, 68, 20),
(138, 69, 3),
(139, 69, 20),
(140, 70, 3),
(141, 70, 20),
(142, 71, 20),
(144, 72, 20),
(146, 74, 10),
(147, 75, 4),
(148, 76, 4),
(152, 80, 3),
(153, 81, 10),
(154, 82, 10),
(155, 83, 10),
(156, 84, 10),
(157, 85, 10),
(158, 86, 10),
(159, 87, 10),
(160, 88, 10),
(161, 89, 10),
(162, 90, 10),
(163, 91, 10),
(164, 92, 10),
(165, 93, 10),
(178, 73, 22),
(179, 77, 10),
(180, 77, 20),
(181, 106, 27),
(182, 107, 17),
(184, 109, 12),
(185, 108, 27),
(186, 110, 17),
(187, 111, 3),
(188, 112, 17),
(189, 113, 20),
(190, 113, 3),
(191, 114, 4),
(192, 115, 4),
(193, 116, 4),
(194, 117, 4),
(195, 118, 4),
(196, 119, 4),
(197, 120, 4),
(198, 121, 4),
(199, 122, 4),
(200, 123, 4),
(201, 124, 10),
(202, 125, 10),
(203, 126, 10),
(204, 127, 10),
(205, 128, 10),
(206, 129, 10),
(207, 130, 10),
(208, 131, 10),
(209, 132, 10),
(210, 133, 10),
(211, 134, 20),
(212, 135, 20),
(213, 136, 20),
(214, 137, 20),
(215, 138, 20),
(216, 139, 20),
(217, 140, 20),
(218, 141, 20),
(219, 142, 20),
(220, 143, 20),
(221, 144, 20),
(222, 145, 10),
(223, 146, 10),
(224, 147, 10),
(225, 148, 10),
(226, 149, 10),
(227, 150, 10),
(228, 151, 10),
(229, 152, 20),
(230, 152, 3),
(231, 153, 20),
(232, 154, 20),
(233, 155, 20),
(234, 156, 20),
(235, 157, 20),
(236, 158, 20),
(237, 159, 20),
(238, 160, 20),
(239, 161, 20),
(240, 162, 20),
(241, 163, 20),
(242, 164, 12),
(243, 165, 12),
(244, 166, 12),
(245, 167, 12),
(246, 168, 12),
(247, 169, 12),
(248, 170, 12),
(249, 171, 12),
(250, 172, 12),
(251, 173, 12),
(252, 174, 12),
(253, 175, 19),
(255, 177, 10),
(256, 178, 1),
(257, 179, 1),
(259, 181, 1),
(261, 183, 1),
(263, 175, 18),
(266, 186, 8),
(267, 187, 20),
(268, 188, 19),
(269, 189, 10),
(270, 190, 8),
(271, 191, 20),
(272, 192, 10),
(273, 193, 8),
(274, 193, 10),
(275, 194, 22),
(276, 195, 22),
(277, 196, 22),
(279, 198, 19),
(280, 199, 19),
(281, 200, 19),
(282, 201, 19),
(283, 202, 19),
(284, 203, 19),
(285, 204, 19),
(286, 205, 19),
(287, 206, 19),
(288, 207, 19),
(289, 208, 19),
(290, 209, 19),
(291, 210, 19),
(293, 212, 19),
(294, 192, 3),
(295, 213, 1),
(296, 214, 20),
(297, 215, 1),
(298, 216, 19),
(299, 217, 19),
(300, 218, 20),
(301, 219, 20),
(302, 220, 20),
(303, 221, 10),
(304, 222, 20),
(305, 223, 18),
(306, 223, 19),
(308, 225, 11),
(309, 226, 1),
(310, 224, 11),
(311, 227, 11),
(312, 228, 1),
(313, 229, 19),
(314, 230, 19),
(317, 233, 19),
(318, 234, 19),
(319, 235, 19),
(320, 236, 1),
(321, 237, 19),
(322, 238, 1),
(323, 239, 19),
(324, 240, 26),
(325, 241, 19),
(326, 242, 19),
(327, 243, 19),
(328, 244, 19),
(329, 245, 19);

-- --------------------------------------------------------

--
-- Table structure for table `task_attachments`
--

CREATE TABLE `task_attachments` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_tags`
--

CREATE TABLE `task_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_tags`
--

INSERT INTO `task_tags` (`id`, `task_id`, `tag_id`) VALUES
(1, 1, 24),
(2, 2, 59),
(3, 3, 60),
(4, 4, 61),
(5, 5, 60),
(6, 6, 62),
(7, 7, 24),
(8, 8, 24),
(9, 9, 24),
(10, 10, 24),
(11, 11, 24),
(12, 12, 24),
(13, 13, 24),
(14, 14, 24),
(15, 15, 24),
(16, 16, 24),
(17, 17, 24),
(18, 18, 24),
(20, 20, 19),
(21, 21, 1),
(23, 23, 1),
(24, 24, 14),
(25, 25, 1),
(26, 26, 1),
(27, 27, 1),
(28, 28, 1),
(29, 29, 1),
(30, 30, 12),
(31, 31, 12),
(32, 22, 12),
(33, 19, 41),
(34, 34, 12),
(35, 35, 12),
(37, 37, 12),
(38, 38, 12),
(39, 39, 12),
(40, 40, 12),
(41, 41, 12),
(45, 45, 12),
(46, 46, 12),
(47, 47, 12),
(48, 48, 12),
(49, 49, 12),
(50, 50, 12),
(51, 51, 12),
(52, 52, 12),
(53, 53, 12),
(54, 54, 12),
(55, 55, 12),
(56, 56, 12),
(57, 57, 12),
(58, 58, 12),
(59, 59, 12),
(60, 60, 12),
(61, 62, 12),
(62, 63, 12),
(63, 64, 12),
(64, 65, 12),
(65, 66, 12),
(66, 67, 12),
(67, 68, 12),
(68, 69, 12),
(69, 71, 12),
(72, 80, 12),
(73, 81, 10),
(74, 82, 10),
(75, 83, 6),
(76, 84, 4),
(77, 85, 1),
(78, 86, 1),
(79, 87, 6),
(80, 88, 40),
(81, 89, 11),
(82, 90, 63),
(83, 91, 64),
(84, 92, 65),
(85, 93, 6),
(86, 106, 45),
(87, 107, 43),
(88, 108, 43),
(89, 110, 43),
(90, 111, 12),
(91, 113, 12),
(92, 114, 10),
(93, 115, 40),
(94, 116, 40),
(95, 117, 40),
(96, 118, 19),
(97, 119, 7),
(98, 120, 40),
(99, 121, 16),
(100, 122, 5),
(101, 123, 9),
(102, 124, 6),
(103, 125, 1),
(104, 126, 1),
(105, 127, 6),
(106, 128, 1),
(107, 129, 14),
(108, 130, 63),
(109, 132, 40),
(110, 133, 64),
(111, 134, 1),
(112, 135, 40),
(113, 136, 40),
(114, 137, 40),
(115, 138, 40),
(116, 139, 1),
(117, 140, 40),
(118, 141, 6),
(119, 142, 66),
(120, 143, 67),
(121, 144, 5),
(122, 145, 1),
(123, 146, 1),
(124, 147, 1),
(125, 148, 4),
(126, 149, 1),
(127, 150, 40),
(128, 151, 66),
(130, 164, 51),
(131, 165, 68),
(132, 166, 48),
(133, 167, 43),
(134, 168, 39),
(135, 170, 48),
(136, 171, 39),
(137, 172, 51),
(138, 173, 39),
(139, 174, 39),
(140, 153, 1),
(141, 154, 1),
(142, 155, 1),
(143, 156, 6),
(145, 157, 69),
(146, 158, 6),
(147, 159, 5),
(148, 160, 40),
(149, 161, 40),
(150, 162, 10),
(151, 163, 1),
(153, 175, 56),
(154, 179, 44),
(156, 215, 72),
(157, 216, 63),
(158, 217, 63),
(159, 219, 70),
(160, 220, 63),
(161, 221, 3),
(162, 222, 44),
(163, 36, 44),
(164, 223, 46),
(165, 224, 3),
(166, 227, 44),
(167, 229, 56),
(168, 230, 56),
(171, 233, 57),
(172, 234, 57),
(173, 235, 3),
(174, 237, 3),
(175, 238, 3),
(176, 241, 56),
(177, 242, 56),
(178, 244, 72);

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `tax` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_entries`
--

CREATE TABLE `time_entries` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `activity_type_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `duration` int(11) NOT NULL,
  `entry_type` int(11) NOT NULL DEFAULT 1,
  `note` text NOT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(170) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `set_password` tinyint(1) NOT NULL DEFAULT 0,
  `is_email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `activation_code` varchar(255) DEFAULT NULL,
  `salary` varchar(255) DEFAULT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `deleted_by` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `branch_routing_number` varchar(100) DEFAULT NULL,
  `swift_code` varchar(50) DEFAULT NULL,
  `language` varchar(255) NOT NULL DEFAULT 'en',
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `owner_type` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `role` varchar(255) DEFAULT 'user',
  `hold_account` tinyint(1) DEFAULT 0,
  `joining_date` date DEFAULT NULL,
  `office_from_time` time DEFAULT NULL,
  `office_to_time` time DEFAULT NULL,
  `weekly_holidays` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`weekly_holidays`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `email_verified_at`, `password`, `set_password`, `is_email_verified`, `is_active`, `activation_code`, `salary`, `created_by`, `deleted_by`, `remember_token`, `bank_name`, `account_name`, `account_number`, `branch_name`, `branch_routing_number`, `swift_code`, `language`, `image_path`, `created_at`, `updated_at`, `deleted_at`, `owner_id`, `owner_type`, `department_id`, `role`, `hold_account`, `joining_date`, `office_from_time`, `office_to_time`, `weekly_holidays`) VALUES
(1, 'Mr admin', 'admin@admin.com', NULL, '2026-03-12 04:59:16', '$2y$10$XD8YyNAYPMp.Z8Fxpinw7uJmwYhanX/0uXs6z9WH2N8vWZrRnJrua', 1, 1, 1, NULL, NULL, NULL, NULL, 'Sa4NZdEDBrmFN7ARjHTH6kswnyZd81xTyprgDmgo7OCrqCPbSlUfbDRux0Du', NULL, NULL, NULL, NULL, NULL, NULL, 'en', NULL, '2023-06-12 23:11:22', '2026-03-12 04:59:16', NULL, NULL, NULL, NULL, 'Admin', 0, '2026-03-04', '17:00:00', '19:00:00', '[\"1\"]'),
(3, 'Sagor Biswas', 'sagorbiswas.cse@gmail.com', '01683566215', '2026-04-06 01:43:53', '$2y$10$PjYTd2G1duqRrqugk02JVeo70BHFY9EugV52AI9O4yQ95oWS9uMhG', 1, 1, 1, '68ce49c26d05b', '60000', 1, NULL, NULL, 'The Premier Bank PLC', 'Sagor Biswas', '144 127 00000 708', 'Panthapath Branch', '235263612', NULL, 'en', NULL, '2025-09-20 00:29:22', '2026-04-06 01:43:53', NULL, NULL, NULL, 6, 'user', 1, '2026-03-01', '11:00:00', '19:00:00', '[\"1\",\"2\"]'),
(4, 'Al Mamun', 'am771683@gmail.com', '01774804846', '2026-03-06 03:25:52', '$2y$10$XMJKEXpQRlOiabP/30qqg.meeJJWSzerwYMe80PlqVfMKTqru3t7q', 1, 0, 1, '68ce5609764c2', '10000', 1, NULL, 'GnIDRk1y5oj9vcqUnheAqcThFRbZ7gTMfV2wloM6uJDfsee2OrfgVOH8rBDd', 'The Premier Bank Ltd.', 'MD.ABDULLAH AL MAMUN', '0133 12100002001', 'Bogura Branch', '235100375', NULL, 'en', NULL, '2025-09-20 01:21:45', '2026-03-06 03:25:52', NULL, NULL, NULL, 4, 'user', 0, '2026-03-01', '10:30:00', '19:00:00', '[\"1\"]'),
(6, 'S M MAHMUDUL HASAN', 'shohan.cse.sust@gmail.com', '01534257267', '2026-03-06 03:24:54', '$2y$10$jCnVTIRR.tZoKKqYCNywPuok/HNoU.OCHYGz/xas0LthdxWb1Nb0m', 0, 0, 1, '68ce638d325b2', '10000', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'en', NULL, '2025-09-20 02:19:25', '2026-03-06 03:24:54', NULL, NULL, NULL, NULL, 'Admin', 0, '2026-03-01', '17:00:00', '18:00:00', '[\"1\"]'),
(8, 'Mehedi H Shuvo', 'mehedihshuvo6689@gmail.com', '01628154257', '2026-03-06 03:23:59', '$2y$10$nyKs5EhdFG6AOpfdXrwj4ukO8hN9yUGtVoyWeH25Tee/PqccANNA6', 1, 0, 1, '68ce652d11a88', '10000', 4, NULL, 'rMSNsdQ3c0nwTpG8uFERhoLcZBbybtNIWSddW8K4tUGPemZtSJ80dEyap0HH', 'The Premier Bank PLC', 'Mehedi Hasan Shuvo', '011014200000047', 'Dhanmondi', '235261180', NULL, 'en', NULL, '2025-09-20 02:26:21', '2026-03-06 03:23:59', NULL, NULL, NULL, 4, 'user', 0, '2026-03-01', '09:30:00', '18:30:00', '[\"1\"]'),
(10, 'Pavel Mahmud', 'pavelmahmud106@gmail.com', '01540574044', '2026-03-06 03:23:24', '$2y$10$8UTlTfmIc/1IxDowIW8E7OTeY0QCJgR2d4a/cH6/oM92qPkJVR1GG', 1, 0, 1, '68ce67bb2dfcc', '10000', 4, NULL, 'a0W1aJMwqfXd7IgKSV16H2HVSyKS5FQfhHWX1CNKyIig3uJHRpBicinWHX3y', 'Premier Bank', 'Md. Sohel Rana Pavel', '011014200000046', ': Dhanmondi Branch', '0110', NULL, 'en', NULL, '2025-09-20 02:37:15', '2026-03-06 03:23:24', NULL, NULL, NULL, 5, 'user', 0, '2026-03-01', '01:00:00', '20:00:00', '[\"1\"]'),
(11, 'Ahnaf Shoumik', 'ahnafahmad2013@gmail.com', '01953593181', '2026-03-06 03:22:35', '$2y$10$eaa9chfYmHqLd8a7ea3xoOGpdf1gGW7HK9Sii6Ta28hOltssiz.8W', 1, 0, 1, '68ce68ab1a9ca', '10000', 4, NULL, 'oMggoY04lDrmUnbbxHeROxK5ZNWdx63bNCfaMa7fhYCTVcQfBSij0nmNp6FA', 'Premier Bank', 'Md Ahnaf Ahmad Shoumik', '136 121 00002223', 'RAMPURA BRANCH', '235275747', NULL, 'en', NULL, '2025-09-20 02:41:15', '2026-03-06 03:22:35', NULL, NULL, NULL, 6, 'user', 0, '2026-03-01', '11:00:00', '19:00:00', '[\"1\",\"2\"]'),
(12, 'Md. Mahim', 'mdmahim2003f@gmail.com', '01915896289', '2026-03-06 03:21:49', '$2y$10$481u3F6gP/RthmXiSXTBAeb0Zm5L0CGCQMDgO0UGJhnq.daQ7WT2a', 1, 0, 1, '68ce69c079de4', '10000', 4, NULL, 'yeacgD156GDpLszxgU1KBgUfJzbYVEpQWHfAqq3ngRPtm8TL60QmuyQ6hnkR', 'Dutch Bangla Bank Limited', 'Md. Mahim', '2801030395422', 'Bagher Bazar', '090330180', NULL, 'en', NULL, '2025-09-20 02:45:52', '2026-03-06 03:21:49', NULL, NULL, NULL, 3, 'user', 0, '2026-03-01', '01:00:00', '20:00:00', '[\"1\"]'),
(13, 'Foysal Ahmed', 'foysalxd33@gmail.com', '01700672168', '2026-03-06 03:20:58', '$2y$10$qsLUn1Jy.H3T8JI5sd3RW.jVpQelakvlFtQAWvp4MyAVe.DVe89ey', 1, 0, 1, '68ce6a255d199', '10000', 4, NULL, 'AAN1V57aI0XNarWcCcel5svLQ05uV0eOoB2IrDmvL4mnKlGpJc3hTqHQKcIU', 'PUBALI BANK PLC', 'Md.Foysal Ahmed', '0141101294931', 'University Campus Branch', '175612415', NULL, 'en', NULL, '2025-09-20 02:47:33', '2026-03-06 03:20:58', NULL, NULL, NULL, 4, 'user', 0, '2026-03-03', '10:00:00', '18:00:00', '[\"1\"]'),
(14, 'Shihabul Islam', 'mail@shihabulislam.com', '01777373436', '2026-03-06 03:20:12', '$2y$10$/j3rlhQ3hr8JKYQci516oOr5YfFnNyvcDN.uqTFXlhyUXKneP7WBG', 1, 0, 1, '68cea92d0bb04', '10000', 4, NULL, 'SyykwlTyHXmP8aQoFySW9m4g3qN653fYQVsNxBaTCXbciyDozVJ6W2Ant3fO', 'Islami Bank Bangladesh PLC', 'SHIHABUL ISLAM', '20504030200783215', 'Chatmohar, Pabna', '125760641', NULL, 'en', NULL, '2025-09-20 07:16:29', '2026-03-06 03:20:12', NULL, NULL, NULL, 2, 'user', 0, '2026-03-01', '09:30:00', '18:30:00', '[\"1\"]'),
(15, 'Sameer', 'omursameer@gmail.com', '01966483821', '2026-03-06 03:19:16', '$2y$10$OWKAw.BEU9GSVlNYzi3VwehvNsWZAR2cInFwv3KFnnb7piWf9M7Si', 1, 0, 1, '68cea97d2475e', '10000', 4, NULL, 'KbGqfEXbDD1e3RJUEtGjJzQrISzglVoLhzBE4bnLMRJJq04toNqIcDqI0u1O', 'Premier Bank', 'MD. SAMEER OMUR', '011012700002026', 'Dhanmondi Branch', '0110', NULL, 'en', NULL, '2025-09-20 07:17:49', '2026-03-06 03:19:16', NULL, NULL, NULL, 2, 'user', 0, '2026-03-01', '09:30:00', '18:30:00', '[\"1\"]'),
(16, 'Somik Mondal', 'new438829@gmail.com', '01332320898', '2026-03-06 03:18:39', '$2y$10$aAJk5QKmY.Mq5f.kozEtF.2gyIPTwNPRuCNdZSD6qJklrn/aS0SmC', 1, 0, 1, '68ceaa6578800', '10000', 4, NULL, NULL, 'The Premier Bank Ltd.', 'Somik Monda', '144-127-3481', 'pranthopoth', '235263612', NULL, 'en', NULL, '2025-09-20 07:21:41', '2026-03-06 03:18:39', NULL, NULL, NULL, 2, 'user', 0, '2026-03-01', '09:30:00', '18:30:00', '[\"1\"]'),
(17, 'Abid Hasan', 'abidhasanxmh@gmail.com', '01647339541', '2026-03-06 03:17:53', '$2y$10$.7ETmj5om8P6oKwCvRXNwuPBOXdqO1.XD.SipBT4uDmwXSxAphupy', 1, 0, 1, '68ceafb560785', '10000', 4, NULL, 'gQtln7L6y2HseYwCVmF55mRGRYuuRtWaFKFVb0o0IkPszsNp1hTSnFj4jKdS', 'Premier Bank', 'ABID HASAN', '011012700002024', 'Dhanmondi Branch', '235261180', NULL, 'en', NULL, '2025-09-20 07:44:21', '2026-03-06 03:17:53', NULL, NULL, NULL, 3, 'user', 0, '2026-03-01', '13:00:00', '20:00:00', '[\"1\"]'),
(18, 'Didarul Alam', 'didarula128@gmail.com', '01946602173', '2026-03-06 03:17:15', '$2y$10$Hlhgf4xOBu5NoLmXjVbJe.NnixJPFfJBUoYAtcXtb/DXMtkmbFFp.', 1, 0, 1, '68d001d84123d', '10000', 4, NULL, NULL, 'The Premier Bank PLC', 'Didarul Alam', '50412100003244', 'Mohammadpur SME Branch Dhaka', '235263296', NULL, 'en', NULL, '2025-09-21 07:47:04', '2026-03-06 03:17:15', NULL, NULL, NULL, 6, 'user', 0, '2026-03-03', '11:00:00', '19:00:00', '[\"1\"]'),
(19, 'Shafa khan', 'shafakhan2018@gmail.com', '01960951628', '2026-03-12 06:03:26', '$2y$10$kKonp9xhsPi/CuOyJn7nfONxp7yIAdac7AQNs7LSQBIo8UCDbCbZq', 1, 0, 1, '68d0021ba945c', '100000', 4, NULL, '0t00Ojveur20c0sfaAH6rjPPW9Wd1HUTEsRlx434uHJtGBbNut0uynDz2YuK', 'Dutch-Bangla Bank Limited (DBBL)', 'Hosain Mohammad Shafa Khan', '1931030740548', 'Pragati Sarani Branch', '090263707', NULL, 'en', NULL, '2025-09-21 07:48:11', '2026-03-12 06:03:26', NULL, NULL, NULL, 6, 'user', 0, '2026-03-01', '11:00:00', '19:00:00', '[\"1\"]'),
(20, 'Shamim Ahmmed', 'ahmmedshamim905@gmail.com', '01799018196', '2026-03-06 03:16:25', '$2y$10$TMutV9.k/ABG2ubPH96I0.Tl2xhrV9EivaepUnlntXrhcyqMv9Nf6', 1, 0, 1, '68da744640d85', '10000', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'en', NULL, '2025-09-29 05:57:58', '2026-03-06 03:16:25', NULL, NULL, NULL, 5, 'user', 0, '2026-03-01', '10:30:00', '19:30:00', '[\"1\"]'),
(22, 'Robiul Islam', 'robiulislamkhan963@gmail.com', '01575093806', '2026-03-06 03:15:50', '$2y$10$AgS8bv45hZB2Cs1fFpAAXOWil8Ym9b2BiM9ZHKb.W1tK85lq9WXRW', 1, 0, 1, '692ec3f71c804', '10000', 4, NULL, 'J2uUJ0caeaqJ4mK3JA3dCclkpgODVmWGk4BOT00IxeNfCIGobsT04ecq8w6y', NULL, NULL, NULL, NULL, NULL, NULL, 'en', NULL, '2025-12-02 04:48:23', '2026-03-06 03:15:50', NULL, NULL, NULL, 5, 'user', 0, '2026-03-01', '10:30:00', '19:30:00', '[\"1\"]'),
(23, 'Umme Dipa', 'ummedipa13@gmail.com', '01609277243', '2026-03-06 03:15:04', '$2y$10$.6Gd8trJjU5mL0ypdJ5z5OV4iG2a5LzcD8tC/rsSMptUTt.kiEWXm', 1, 0, 1, '695660d41e095', NULL, 3, NULL, NULL, 'BRAC Bank', 'Umme Khair Dipa', '1070307670001', 'BRAC Bank Mohammadpur Branch, Dhaka', '060263290', NULL, 'en', NULL, '2026-01-01 11:56:04', '2026-03-06 03:15:04', NULL, NULL, NULL, 4, 'user', 0, '2026-03-01', '09:00:00', '18:00:00', '[\"1\"]'),
(24, 'Pronoy Ghosh', 'pronoyghosh2020@gmail.com', '01743494621', '2026-03-06 03:13:36', '$2y$10$oXMb99YYSr/AUO2VxkE3meRb06EhQFsrbO0tjB/33RzK0plLoSC7q', 1, 0, 1, '695660fca1b1b', NULL, 3, NULL, 'rah4lE6it6ePAN2rNbmolTs5kWe2iE9sliETokjgZjImWDodBJwfb6Eafqpi', 'AB BANK', 'PRONOY GHOSH', '1111111447300', 'PARIL BRANCH', '020560083', NULL, 'en', NULL, '2026-01-01 11:56:44', '2026-03-06 03:13:36', NULL, NULL, NULL, 4, 'user', 0, '2026-03-01', '09:00:00', '18:00:00', '[\"1\"]'),
(25, 'Maynul Islam', 'maynulislam566@gmail.com', '01785236677', '2026-03-06 03:14:31', '$2y$10$hSdPOBFPNwpwiXMO3kzCHe4Df/51pk4.DFwYu.kVwqtq4nNrE1Ul2', 1, 0, 1, '695a09f75382a', '10000', 4, NULL, NULL, 'City Bank', 'MD Maynul Islam', '2184336380001', 'Karwan Bazar Branch', '225262531', NULL, 'en', NULL, '2026-01-04 06:34:31', '2026-03-06 03:14:31', NULL, NULL, NULL, 4, 'user', 0, '2026-03-01', '09:00:00', '18:00:00', '[\"1\"]'),
(26, 'Raiyan Ahmed Akib', 'raiyanamd89@gmail.com', '01685204713', '2026-04-05 04:33:05', '$2y$10$htB.4azX6Q2XFPfJ6tARQ.NBb7/r20KiDAyGVaRxy/LgWX9buLzL.', 1, 0, 1, '695cc7587ba91', NULL, 1, NULL, '0ORvN6hKkQOfIbZ164jyhO2B4GzNg7MJVBVgrQDPrYv16SJAjVw5u2eh54S6', 'Agrani Bank', 'Raiyan Ahmed Akib', '0200024090044', 'Shyamoli branch', '010264302', NULL, 'en', NULL, '2026-01-06 08:27:04', '2026-04-05 04:33:05', NULL, NULL, NULL, 6, 'user', 1, '2026-03-02', '11:00:00', '19:00:00', '[\"1\",\"2\"]'),
(27, 'Ferdous Ahmed', 'smfardouskhan@gmail.com', '01568261759', '2026-04-06 04:42:37', '$2y$10$QOPUqrjnTygNl0clrQhykODubmC7tGvk3wnJN5oXQjvIPwPox/Vge', 1, 0, 1, '6975d7d4aa2dc', '30000', 1, NULL, 'IxXbv3YPtzjLRdI09x2bkAu9vk08AiFIauldM7UakP1gRjQXe7ZqPlk9Wrz3', 'Premier Bank', 'MD.FERDOUS', '0133 121087', 'Karwan Bazar Branch', '12312321', NULL, 'en', NULL, '2026-01-25 08:44:04', '2026-04-06 04:42:37', NULL, NULL, NULL, 3, 'user', 0, '2026-03-03', '13:00:00', '21:00:00', '[\"1\"]'),
(42, 'Test 01', 'test01@gmail.com', NULL, '2026-03-06 03:11:15', '$2y$10$1VUDHX/Ynt9R8bxHa2cge.NKB0beXy8oIEKojKkHyNRY6HXK.7WD.', 0, 0, 1, '69a6b347b902c', '10000', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'en', NULL, '2026-03-03 04:09:11', '2026-03-06 03:11:15', NULL, NULL, NULL, 6, 'user', 0, '2026-03-03', '11:00:00', '19:00:00', '[\"1\"]'),
(43, 'test user 2', 'test2@gamil.com', '01976765432', '2026-03-03 04:56:31', '$2y$10$NLeSwFAo2tCsWs4fLXSjouGCa/bc5G/D0POSsg4.rpPqJlFSBNhOu', 0, 0, 1, '69a6bdad9f24e', '15000', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'en', NULL, '2026-03-03 04:53:33', '2026-03-03 04:56:47', '2026-03-03 04:56:47', NULL, NULL, 6, 'user', 0, '2026-03-02', '12:00:00', '20:00:00', '[\"1\"]');

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `link` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_notifications`
--

INSERT INTO `user_notifications` (`id`, `title`, `type`, `description`, `read_at`, `user_id`, `link`, `created_at`, `updated_at`) VALUES
(247, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 4, 'http://127.0.0.1:8000/absents/91', '2026-03-07 02:09:38', '2026-03-07 02:09:38'),
(248, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 6, 'http://127.0.0.1:8000/absents/92', '2026-03-07 02:09:38', '2026-03-07 02:09:38'),
(249, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 8, 'http://127.0.0.1:8000/absents/93', '2026-03-07 02:09:38', '2026-03-07 02:09:38'),
(250, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 10, 'http://127.0.0.1:8000/absents/94', '2026-03-07 02:09:38', '2026-03-07 02:09:38'),
(251, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 12, 'http://127.0.0.1:8000/absents/95', '2026-03-07 02:09:38', '2026-03-07 02:09:38'),
(252, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 13, 'http://127.0.0.1:8000/absents/96', '2026-03-07 02:09:38', '2026-03-07 02:09:38'),
(253, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 14, 'http://127.0.0.1:8000/absents/97', '2026-03-07 02:09:38', '2026-03-07 02:09:38'),
(254, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 15, 'http://127.0.0.1:8000/absents/98', '2026-03-07 02:09:38', '2026-03-07 02:09:38'),
(255, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 16, 'http://127.0.0.1:8000/absents/99', '2026-03-07 02:09:38', '2026-03-07 02:09:38'),
(256, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 17, 'http://127.0.0.1:8000/absents/100', '2026-03-07 02:09:38', '2026-03-07 02:09:38'),
(257, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 18, 'http://127.0.0.1:8000/absents/101', '2026-03-07 02:09:39', '2026-03-07 02:09:39'),
(258, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', '2026-03-07 02:10:14', 19, 'http://127.0.0.1:8000/absents/102', '2026-03-07 02:09:39', '2026-03-07 02:10:14'),
(259, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 20, 'http://127.0.0.1:8000/absents/103', '2026-03-07 02:09:39', '2026-03-07 02:09:39'),
(260, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 22, 'http://127.0.0.1:8000/absents/104', '2026-03-07 02:09:39', '2026-03-07 02:09:39'),
(261, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 23, 'http://127.0.0.1:8000/absents/105', '2026-03-07 02:09:39', '2026-03-07 02:09:39'),
(262, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 24, 'http://127.0.0.1:8000/absents/106', '2026-03-07 02:09:39', '2026-03-07 02:09:39'),
(263, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 25, 'http://127.0.0.1:8000/absents/107', '2026-03-07 02:09:39', '2026-03-07 02:09:39'),
(264, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 26, 'http://127.0.0.1:8000/absents/108', '2026-03-07 02:09:39', '2026-03-07 02:09:39'),
(265, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 27, 'http://127.0.0.1:8000/absents/109', '2026-03-07 02:09:39', '2026-03-07 02:09:39'),
(266, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 42, 'http://127.0.0.1:8000/absents/110', '2026-03-07 02:09:39', '2026-03-07 02:09:39'),
(267, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 4, 'http://127.0.0.1:8000/absents/111', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(268, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 6, 'http://127.0.0.1:8000/absents/112', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(269, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 8, 'http://127.0.0.1:8000/absents/113', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(270, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 10, 'http://127.0.0.1:8000/absents/114', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(271, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 12, 'http://127.0.0.1:8000/absents/115', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(272, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 13, 'http://127.0.0.1:8000/absents/116', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(273, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 14, 'http://127.0.0.1:8000/absents/117', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(274, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 15, 'http://127.0.0.1:8000/absents/118', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(275, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 16, 'http://127.0.0.1:8000/absents/119', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(276, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 17, 'http://127.0.0.1:8000/absents/120', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(277, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 18, 'http://127.0.0.1:8000/absents/121', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(278, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', '2026-03-07 02:14:52', 19, 'http://127.0.0.1:8000/absents/122', '2026-03-07 02:14:21', '2026-03-07 02:14:52'),
(279, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 20, 'http://127.0.0.1:8000/absents/123', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(280, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 22, 'http://127.0.0.1:8000/absents/124', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(281, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 23, 'http://127.0.0.1:8000/absents/125', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(282, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 24, 'http://127.0.0.1:8000/absents/126', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(283, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 25, 'http://127.0.0.1:8000/absents/127', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(284, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 26, 'http://127.0.0.1:8000/absents/128', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(285, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 27, 'http://127.0.0.1:8000/absents/129', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(286, 'Absent Created', 'App\\Models\\Absent', 'You have been marked absent for 2026-03-07 due to missing check-in and check-out.', NULL, 42, 'http://127.0.0.1:8000/absents/130', '2026-03-07 02:14:21', '2026-03-07 02:14:21'),
(287, 'New Project Assigned', 'App\\Models\\Project', 'You are assigned to releva.com.bd', NULL, 19, 'http://127.0.0.1:8000/projects/50', '2026-03-12 06:05:36', '2026-03-12 06:05:36'),
(288, 'New User Assigned to Project', 'App\\Models\\Project', 'Shafa khan assigned to releva.com.bd', NULL, 8, 'http://127.0.0.1:8000/projects/50', '2026-03-12 06:05:36', '2026-03-12 06:05:36'),
(289, 'New User Assigned to Project', 'App\\Models\\Project', 'Shafa khan assigned to releva.com.bd', NULL, 3, 'http://127.0.0.1:8000/projects/50', '2026-03-12 06:05:36', '2026-03-12 06:05:36'),
(290, 'New User Assigned to Project', 'App\\Models\\Project', 'Shafa khan assigned to releva.com.bd', NULL, 20, 'http://127.0.0.1:8000/projects/50', '2026-03-12 06:05:36', '2026-03-12 06:05:36'),
(291, 'New User Assigned to Project', 'App\\Models\\Project', 'Shafa khan assigned to releva.com.bd', NULL, 10, 'http://127.0.0.1:8000/projects/50', '2026-03-12 06:05:36', '2026-03-12 06:05:36'),
(292, 'New Project Assigned', 'App\\Models\\Project', 'You are assigned to releva.com.bd', NULL, 26, 'http://127.0.0.1:8000/projects/50', '2026-03-12 06:08:19', '2026-03-12 06:08:19'),
(293, 'New User Assigned to Project', 'App\\Models\\Project', 'Raiyan Ahmed Akib assigned to releva.com.bd', NULL, 8, 'http://127.0.0.1:8000/projects/50', '2026-03-12 06:08:19', '2026-03-12 06:08:19'),
(294, 'New User Assigned to Project', 'App\\Models\\Project', 'Raiyan Ahmed Akib assigned to releva.com.bd', NULL, 3, 'http://127.0.0.1:8000/projects/50', '2026-03-12 06:08:19', '2026-03-12 06:08:19'),
(295, 'New User Assigned to Project', 'App\\Models\\Project', 'Raiyan Ahmed Akib assigned to releva.com.bd', NULL, 20, 'http://127.0.0.1:8000/projects/50', '2026-03-12 06:08:19', '2026-03-12 06:08:19'),
(296, 'New User Assigned to Project', 'App\\Models\\Project', 'Raiyan Ahmed Akib assigned to releva.com.bd', NULL, 10, 'http://127.0.0.1:8000/projects/50', '2026-03-12 06:08:19', '2026-03-12 06:08:19'),
(297, 'New User Assigned to Project', 'App\\Models\\Project', 'Raiyan Ahmed Akib assigned to releva.com.bd', NULL, 19, 'http://127.0.0.1:8000/projects/50', '2026-03-12 06:08:19', '2026-03-12 06:08:19'),
(298, 'New Task Assigned', 'App\\Models\\Task', 'rt assigned to you', NULL, 19, 'http://127.0.0.1:8000/projects/50', '2026-03-12 06:11:23', '2026-03-12 06:11:23'),
(299, 'New Task Assigned', 'App\\Models\\Task', 'test assigned to you', NULL, 26, 'http://127.0.0.1:8000/projects/50', '2026-03-12 06:11:42', '2026-03-12 06:11:42'),
(300, 'New Project Assigned', 'App\\Models\\Project', 'You are assigned to Denimisia', NULL, 26, 'http://127.0.0.1:8000/projects/44', '2026-03-12 06:12:38', '2026-03-12 06:12:38'),
(301, 'New User Assigned to Project', 'App\\Models\\Project', 'Raiyan Ahmed Akib assigned to Denimisia', NULL, 10, 'http://127.0.0.1:8000/projects/44', '2026-03-12 06:12:38', '2026-03-12 06:12:38'),
(302, 'New Project Assigned', 'App\\Models\\Project', 'You are assigned to releva.com.bd', NULL, 27, 'http://127.0.0.1:8000/projects/50', '2026-04-05 04:36:59', '2026-04-05 04:36:59'),
(303, 'New User Assigned to Project', 'App\\Models\\Project', 'Ferdous Ahmed assigned to releva.com.bd', NULL, 8, 'http://127.0.0.1:8000/projects/50', '2026-04-05 04:36:59', '2026-04-05 04:36:59'),
(304, 'New User Assigned to Project', 'App\\Models\\Project', 'Ferdous Ahmed assigned to releva.com.bd', NULL, 3, 'http://127.0.0.1:8000/projects/50', '2026-04-05 04:36:59', '2026-04-05 04:36:59'),
(305, 'New User Assigned to Project', 'App\\Models\\Project', 'Ferdous Ahmed assigned to releva.com.bd', NULL, 20, 'http://127.0.0.1:8000/projects/50', '2026-04-05 04:36:59', '2026-04-05 04:36:59'),
(306, 'New User Assigned to Project', 'App\\Models\\Project', 'Ferdous Ahmed assigned to releva.com.bd', NULL, 10, 'http://127.0.0.1:8000/projects/50', '2026-04-05 04:36:59', '2026-04-05 04:36:59'),
(307, 'New User Assigned to Project', 'App\\Models\\Project', 'Ferdous Ahmed assigned to releva.com.bd', NULL, 19, 'http://127.0.0.1:8000/projects/50', '2026-04-05 04:36:59', '2026-04-05 04:36:59'),
(308, 'New User Assigned to Project', 'App\\Models\\Project', 'Ferdous Ahmed assigned to releva.com.bd', NULL, 26, 'http://127.0.0.1:8000/projects/50', '2026-04-05 04:36:59', '2026-04-05 04:36:59'),
(309, 'New Task Assigned', 'App\\Models\\Task', 'kanban list test task 1 assigned to you', NULL, 19, 'http://127.0.0.1:8000/projects/50', '2026-04-05 05:28:11', '2026-04-05 05:28:11'),
(310, 'New Project Assigned', 'App\\Models\\Project', 'You are assigned to Denimisia', NULL, 19, 'http://127.0.0.1:8000/projects/44', '2026-04-05 05:31:33', '2026-04-05 05:31:33'),
(311, 'New User Assigned to Project', 'App\\Models\\Project', 'Shafa khan assigned to Denimisia', NULL, 10, 'http://127.0.0.1:8000/projects/44', '2026-04-05 05:31:33', '2026-04-05 05:31:33'),
(312, 'New User Assigned to Project', 'App\\Models\\Project', 'Shafa khan assigned to Denimisia', NULL, 26, 'http://127.0.0.1:8000/projects/44', '2026-04-05 05:31:33', '2026-04-05 05:31:33'),
(313, 'New Task Assigned', 'App\\Models\\Task', 'kanban test task 3 assigned to you', NULL, 19, 'http://127.0.0.1:8000/projects/44', '2026-04-06 00:04:35', '2026-04-06 00:04:35'),
(314, 'New Task Assigned', 'App\\Models\\Task', 'kanban test task 3 assigned to you', NULL, 19, 'http://127.0.0.1:8000/projects/44', '2026-04-06 00:04:35', '2026-04-06 00:04:35'),
(315, 'New Task Assigned', 'App\\Models\\Task', 'kanban test task 3 assigned to you', NULL, 19, 'http://127.0.0.1:8000/projects/44', '2026-04-06 00:06:22', '2026-04-06 00:06:22'),
(316, 'New Task Assigned', 'App\\Models\\Task', 'kanban test task 3 assigned to you', NULL, 19, 'http://127.0.0.1:8000/projects/44', '2026-04-06 00:15:25', '2026-04-06 00:15:25'),
(317, 'New Task Assigned', 'App\\Models\\Task', 'kanban test task 3 assigned to you', NULL, 19, 'http://127.0.0.1:8000/projects/44', '2026-04-06 00:15:25', '2026-04-06 00:15:25'),
(318, 'New Task Assigned', 'App\\Models\\Task', 'kanban test task 3 assigned to you', NULL, 19, 'http://127.0.0.1:8000/projects/44', '2026-04-06 00:17:54', '2026-04-06 00:17:54'),
(319, 'New Task Assigned', 'App\\Models\\Task', 'kanban test task 3 assigned to you', NULL, 19, 'http://127.0.0.1:8000/projects/44', '2026-04-06 00:28:08', '2026-04-06 00:28:08'),
(320, 'Admin Change Status', 'App\\Models\\Salary', 'Admin Marked Your Salary For January/2026 As paid', NULL, 3, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 01:44:40', '2026-04-06 01:44:40'),
(321, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 3, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(322, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 4, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(323, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 6, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(324, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 8, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(325, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 10, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(326, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 11, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(327, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 12, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(328, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 13, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(329, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 14, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(330, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 15, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(331, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 16, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(332, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 17, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(333, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 18, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(334, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 19, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(335, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 20, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(336, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 22, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(337, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 23, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(338, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 24, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(339, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 25, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(340, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 26, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(341, 'Salary Marked Paid', 'App\\Models\\Salary', 'Your Salary For February/2026 Has Been Marked As Paid By Admin.', NULL, 27, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:48:25', '2026-04-06 04:48:25'),
(342, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 1, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(343, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 3, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(344, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 4, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(345, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 6, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(346, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 8, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(347, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 10, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(348, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 11, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(349, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 12, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(350, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 13, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(351, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 14, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(352, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 15, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(353, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 16, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(354, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 17, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(355, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 18, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(356, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 19, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(357, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 20, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(358, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 22, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(359, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 23, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(360, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 24, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(361, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 25, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(362, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 26, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(363, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 27, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(364, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 42, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:49:00', '2026-04-06 04:49:00'),
(365, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 1, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(366, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 3, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(367, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 4, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(368, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 6, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(369, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 8, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(370, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 10, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(371, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 11, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(372, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 12, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(373, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 13, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(374, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 14, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(375, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 15, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(376, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 16, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(377, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 17, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(378, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 18, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(379, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 19, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(380, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 20, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(381, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 22, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(382, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 23, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(383, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 24, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(384, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 25, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(385, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 26, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(386, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 27, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(387, 'Salary Generated', 'App\\Models\\Salary', 'Your Salary Has Been Generated By Admin', NULL, 42, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 04:52:09', '2026-04-06 04:52:09'),
(388, 'Salary Updated', 'App\\Models\\Salary', 'Your Salary Has Been Updated By Admin', NULL, 27, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 05:26:54', '2026-04-06 05:26:54'),
(389, 'Salary Updated', 'App\\Models\\Salary', 'Your Salary Has Been Updated By Admin', NULL, 27, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 05:27:12', '2026-04-06 05:27:12'),
(390, 'Salary Updated', 'App\\Models\\Salary', 'Your Salary Has Been Updated By Admin', NULL, 27, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 05:27:35', '2026-04-06 05:27:35'),
(391, 'Salary Updated', 'App\\Models\\Salary', 'Your Salary Has Been Updated By Admin', NULL, 27, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 05:27:47', '2026-04-06 05:27:47'),
(392, 'Salary Updated', 'App\\Models\\Salary', 'Your Salary Has Been Updated By Admin', NULL, 27, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 05:28:01', '2026-04-06 05:28:01'),
(393, 'Salary Updated', 'App\\Models\\Salary', 'Your Salary Has Been Updated By Admin', NULL, 27, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 05:37:14', '2026-04-06 05:37:14'),
(394, 'Salary Updated', 'App\\Models\\Salary', 'Your Salary Has Been Updated By Admin', NULL, 27, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 05:42:00', '2026-04-06 05:42:00'),
(395, 'Salary Updated', 'App\\Models\\Salary', 'Your Salary Has Been Updated By Admin', NULL, 27, 'http://127.0.0.1:8000/salary-acknowledgement', '2026-04-06 05:43:19', '2026-04-06 05:43:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absents`
--
ALTER TABLE `absents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `activity_types`
--
ALTER TABLE `activity_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_types_created_by_foreign` (`created_by`),
  ADD KEY `activity_types_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `breaks`
--
ALTER TABLE `breaks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_breaks_user_id` (`user_id`),
  ADD KEY `idx_breaks_break_start_time` (`break_start_time`),
  ADD KEY `idx_breaks_break_back_time` (`break_back_time`),
  ADD KEY `idx_breaks_deleted_at` (`deleted_at`);

--
-- Indexes for table `call_records`
--
ALTER TABLE `call_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_created_by_foreign` (`created_by`),
  ADD KEY `clients_deleted_by_foreign` (`deleted_by`),
  ADD KEY `clients_department_id_foreign` (`department_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_created_by_foreign` (`created_by`),
  ADD KEY `comments_task_id_foreign` (`task_id`);

--
-- Indexes for table `commission_rules`
--
ALTER TABLE `commission_rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission_rule_principal_user`
--
ALTER TABLE `commission_rule_principal_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `commission_rule_principal_user_unique` (`commission_rule_id`,`user_id`);

--
-- Indexes for table `commission_rule_project`
--
ALTER TABLE `commission_rule_project`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `commission_rule_project_unique` (`commission_rule_id`,`project_id`);

--
-- Indexes for table `commission_rule_secondary_user`
--
ALTER TABLE `commission_rule_secondary_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `commission_rule_secondary_user_unique` (`commission_rule_id`,`user_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_name_unique` (`name`);

--
-- Indexes for table `department_tag`
--
ALTER TABLE `department_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_tag_tag_id_foreign` (`tag_id`),
  ADD KEY `department_tag_department_id_foreign` (`department_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_added_by_foreign` (`added_by`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expenses_client_id_foreign` (`client_id`),
  ADD KEY `expenses_project_id_foreign` (`project_id`),
  ADD KEY `expenses_created_by_foreign` (`created_by`),
  ADD KEY `expenses_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `extensions`
--
ALTER TABLE `extensions`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `invoices_tax_id_foreign` (`tax_id`),
  ADD KEY `invoices_created_by_foreign` (`created_by`);

--
-- Indexes for table `invoice_clients`
--
ALTER TABLE `invoice_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_clients_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_clients_client_id_foreign` (`client_id`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_items_task_id_foreign` (`task_id`),
  ADD KEY `invoice_items_item_project_id_foreign` (`item_project_id`);

--
-- Indexes for table `invoice_projects`
--
ALTER TABLE `invoice_projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_projects_invoice_id_foreign` (`invoice_id`),
  ADD KEY `invoice_projects_project_id_foreign` (`project_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_statuses`
--
ALTER TABLE `job_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `job_types`
--
ALTER TABLE `job_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_source_id` (`source_id`),
  ADD KEY `idx_stage_id` (`stage_id`),
  ADD KEY `idx_assigned_to` (`assigned_to`);

--
-- Indexes for table `lead_follow_ups`
--
ALTER TABLE `lead_follow_ups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lead_sources`
--
ALTER TABLE `lead_sources`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lead_sources_created_by_index` (`created_by`),
  ADD KEY `lead_sources_deleted_by_index` (`deleted_by`);

--
-- Indexes for table `lead_stages`
--
ALTER TABLE `lead_stages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `leave_request_attachments`
--
ALTER TABLE `leave_request_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `leave_request_attachments_leave_request_id_foreign` (`leave_request_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `media_uuid_unique` (`uuid`),
  ADD KEY `media_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_prefix_unique` (`prefix`),
  ADD UNIQUE KEY `projects_name_unique` (`name`),
  ADD KEY `projects_client_id_foreign` (`client_id`),
  ADD KEY `projects_created_by_foreign` (`created_by`),
  ADD KEY `projects_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `projects_invoice`
--
ALTER TABLE `projects_invoice`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `projects_invoice_invoice_unique` (`invoice`),
  ADD KEY `projects_invoice_client_id_index` (`client_id`),
  ADD KEY `projects_invoice_project_id_index` (`project_id`),
  ADD KEY `projects_invoice_created_by_index` (`created_by`),
  ADD KEY `projects_invoice_deleted_by_index` (`deleted_by`),
  ADD KEY `projects_invoice_status_index` (`status`);

--
-- Indexes for table `project_user`
--
ALTER TABLE `project_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_user_project_id_foreign` (`project_id`),
  ADD KEY `project_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_owner_id_foreign` (`owner_id`);

--
-- Indexes for table `report_filters`
--
ALTER TABLE `report_filters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_filters_report_id_foreign` (`report_id`);

--
-- Indexes for table `report_invoices`
--
ALTER TABLE `report_invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `report_invoices_invoice_id_foreign` (`invoice_id`),
  ADD KEY `report_invoices_report_id_foreign` (`report_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `salaries`
--
ALTER TABLE `salaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status_status_unique` (`status`),
  ADD UNIQUE KEY `status_name_unique` (`name`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tags_created_by_foreign` (`created_by`),
  ADD KEY `tags_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tasks_task_number_project_id_unique` (`task_number`,`project_id`),
  ADD KEY `tasks_deleted_by_foreign` (`deleted_by`),
  ADD KEY `tasks_project_id_foreign` (`project_id`),
  ADD KEY `tasks_created_by_foreign` (`created_by`);

--
-- Indexes for table `task_assignees`
--
ALTER TABLE `task_assignees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_assignees_task_id_foreign` (`task_id`),
  ADD KEY `task_assignees_user_id_foreign` (`user_id`);

--
-- Indexes for table `task_attachments`
--
ALTER TABLE `task_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_attachments_task_id_foreign` (`task_id`);

--
-- Indexes for table `task_tags`
--
ALTER TABLE `task_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_tags_task_id_foreign` (`task_id`),
  ADD KEY `task_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `time_entries`
--
ALTER TABLE `time_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `time_entries_deleted_by_foreign` (`deleted_by`),
  ADD KEY `time_entries_task_id_foreign` (`task_id`),
  ADD KEY `time_entries_activity_type_id_foreign` (`activity_type_id`),
  ADD KEY `time_entries_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_created_by_foreign` (`created_by`),
  ADD KEY `users_deleted_by_foreign` (`deleted_by`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_notifications_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absents`
--
ALTER TABLE `absents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=683;

--
-- AUTO_INCREMENT for table `activity_types`
--
ALTER TABLE `activity_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `breaks`
--
ALTER TABLE `breaks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `call_records`
--
ALTER TABLE `call_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commission_rules`
--
ALTER TABLE `commission_rules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commission_rule_principal_user`
--
ALTER TABLE `commission_rule_principal_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commission_rule_project`
--
ALTER TABLE `commission_rule_project`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commission_rule_secondary_user`
--
ALTER TABLE `commission_rule_secondary_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department_tag`
--
ALTER TABLE `department_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `extensions`
--
ALTER TABLE `extensions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_clients`
--
ALTER TABLE `invoice_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice_projects`
--
ALTER TABLE `invoice_projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_statuses`
--
ALTER TABLE `job_statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `job_types`
--
ALTER TABLE `job_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lead_follow_ups`
--
ALTER TABLE `lead_follow_ups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_sources`
--
ALTER TABLE `lead_sources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lead_stages`
--
ALTER TABLE `lead_stages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `leave_request_attachments`
--
ALTER TABLE `leave_request_attachments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `projects_invoice`
--
ALTER TABLE `projects_invoice`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `project_user`
--
ALTER TABLE `project_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_filters`
--
ALTER TABLE `report_filters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=462;

--
-- AUTO_INCREMENT for table `report_invoices`
--
ALTER TABLE `report_invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `salaries`
--
ALTER TABLE `salaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `task_assignees`
--
ALTER TABLE `task_assignees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=330;

--
-- AUTO_INCREMENT for table `task_attachments`
--
ALTER TABLE `task_attachments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_tags`
--
ALTER TABLE `task_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_entries`
--
ALTER TABLE `time_entries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=396;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_types`
--
ALTER TABLE `activity_types`
  ADD CONSTRAINT `activity_types_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `activity_types_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `clients_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `clients_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `events_added_by_foreign` FOREIGN KEY (`added_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `expenses_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `expenses_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `expenses_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `taxes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_clients`
--
ALTER TABLE `invoice_clients`
  ADD CONSTRAINT `invoice_clients_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_clients_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_item_project_id_foreign` FOREIGN KEY (`item_project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_items_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoice_projects`
--
ALTER TABLE `invoice_projects`
  ADD CONSTRAINT `invoice_projects_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_projects_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leave_request_attachments`
--
ALTER TABLE `leave_request_attachments`
  ADD CONSTRAINT `leave_request_attachments_leave_request_id_foreign` FOREIGN KEY (`leave_request_id`) REFERENCES `leave_requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`);

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `projects_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `projects_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `project_user`
--
ALTER TABLE `project_user`
  ADD CONSTRAINT `project_user_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  ADD CONSTRAINT `project_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `report_filters`
--
ALTER TABLE `report_filters`
  ADD CONSTRAINT `report_filters_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report_invoices`
--
ALTER TABLE `report_invoices`
  ADD CONSTRAINT `report_invoices_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `report_invoices_report_id_foreign` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `tags`
--
ALTER TABLE `tags`
  ADD CONSTRAINT `tags_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tags_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tasks_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tasks_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `task_assignees`
--
ALTER TABLE `task_assignees`
  ADD CONSTRAINT `task_assignees_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `task_assignees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `task_attachments`
--
ALTER TABLE `task_attachments`
  ADD CONSTRAINT `task_attachments_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `task_tags`
--
ALTER TABLE `task_tags`
  ADD CONSTRAINT `task_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`),
  ADD CONSTRAINT `task_tags_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `time_entries`
--
ALTER TABLE `time_entries`
  ADD CONSTRAINT `time_entries_activity_type_id_foreign` FOREIGN KEY (`activity_type_id`) REFERENCES `activity_types` (`id`),
  ADD CONSTRAINT `time_entries_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `time_entries_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  ADD CONSTRAINT `time_entries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `users_deleted_by_foreign` FOREIGN KEY (`deleted_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD CONSTRAINT `user_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
