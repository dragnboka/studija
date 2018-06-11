-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2018 at 12:47 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studija`
--

-- --------------------------------------------------------

--
-- Table structure for table `experiments`
--

CREATE TABLE `experiments` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `radio` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vreme` time NOT NULL,
  `komentar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experiments`
--

INSERT INTO `experiments` (`id`, `subject_id`, `task_id`, `radio`, `vreme`, `komentar`, `deleted_at`) VALUES
(1, 2, 1, 'milan pantovic', '12:21:00', 'wqwq', NULL),
(2, 2, 1, 'milan pantovic', '12:22:00', 'w', NULL),
(3, 2, 1, 'milan pantovic', '12:34:00', 'sd', NULL),
(4, 2, 2, 'milan pantovic', '12:12:00', 'w', NULL),
(5, 2, 2, 'milan pantovic', '12:12:00', '12', NULL),
(6, 2, 2, 'milan pantovic', '13:13:00', 'dssd', NULL),
(9, 20, 4, 'milan pantovic', '12:12:00', 'bvbv', NULL),
(11, 20, 1, 'milan pantovic', '12:12:00', '12', NULL),
(12, 2, 3, 'milan pantovic', '12:12:00', 'dobar', NULL),
(13, 2, 6, 'milan pantovic', '12:12:00', 'dobar', NULL),
(14, 1, 1, 'milan pantovic', '14:13:00', 'ewe', NULL),
(15, 1, 1, 'milan pantovic', '09:12:00', '12', NULL),
(16, 1, 1, 'milan pantovic', '09:01:00', NULL, NULL),
(17, 1, 1, 'milan pantovic', '12:12:00', NULL, NULL),
(18, 23, 9, 'milan pantovic', '12:12:00', NULL, NULL),
(19, 3, 3, 'milan pantovic', '12:12:00', NULL, NULL),
(20, 30, 17, 'milan pantovic', '12:12:00', NULL, '2018-06-11 07:33:42'),
(21, 30, 18, 'milan pantovic', '12:13:00', NULL, '2018-06-11 07:33:42'),
(22, 30, 19, 'milan pantovic', '14:13:00', NULL, '2018-06-11 07:33:42'),
(23, 30, 10, 'milan pantovic', '12:32:00', NULL, '2018-06-11 07:33:42'),
(24, 1, 2, 'mehmed memo', '12:32:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `study_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `study_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'grupa 1', '2018-05-24 21:27:17', '2018-06-10 13:34:44'),
(2, 1, 'grupa2', '2018-05-24 21:27:17', '2018-05-24 21:27:17'),
(3, 2, 'petko', '2018-05-24 21:27:58', '2018-05-24 21:27:58'),
(4, 2, 'bokan', '2018-05-24 21:27:58', '2018-05-24 21:27:58'),
(5, 3, 'treca gupa', '2018-06-06 20:09:02', '2018-06-06 20:09:02'),
(6, 4, 'ne', '2018-06-06 20:10:19', '2018-06-06 20:10:19'),
(7, 3, 'nova', '2018-06-06 20:18:15', '2018-06-06 20:18:15'),
(8, 5, 'depresiona', '2018-06-10 21:33:42', '2018-06-10 21:59:47'),
(9, 6, 'oboleli', '2018-06-10 21:38:10', '2018-06-10 21:38:10'),
(10, 6, 'zdravi malo ne', '2018-06-10 21:38:10', '2018-06-10 21:38:10'),
(11, 1, 'grupa3', '2018-06-10 21:59:14', '2018-06-10 21:59:14'),
(12, 5, 'gaita2', '2018-06-10 22:00:09', '2018-06-10 22:00:09'),
(13, 7, 'dsds', '2018-06-11 07:05:48', '2018-06-11 07:05:48'),
(14, 7, '232', '2018-06-11 07:05:48', '2018-06-11 07:05:48'),
(15, 7, 'd', '2018-06-11 07:05:48', '2018-06-11 07:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `group_subject`
--

CREATE TABLE `group_subject` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_subject`
--

INSERT INTO `group_subject` (`id`, `group_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 4, 3, NULL, NULL),
(3, 1, 1, NULL, NULL),
(4, 1, 7, NULL, NULL),
(5, 2, 8, NULL, NULL),
(6, 3, 9, NULL, NULL),
(7, 4, 10, NULL, NULL),
(8, 1, 11, NULL, NULL),
(9, 1, 12, NULL, NULL),
(10, 3, 12, NULL, NULL),
(11, 4, 13, NULL, NULL),
(12, 4, 14, NULL, NULL),
(18, 1, 19, NULL, NULL),
(19, 3, 19, NULL, NULL),
(20, 5, 19, NULL, NULL),
(22, 6, 20, NULL, NULL),
(23, 1, 20, NULL, NULL),
(24, 3, 20, NULL, NULL),
(25, 3, 2, NULL, NULL),
(26, 2, 21, NULL, NULL),
(27, 1, 22, NULL, NULL),
(28, 8, 23, NULL, NULL),
(29, 12, 24, NULL, NULL),
(30, 12, 25, NULL, NULL),
(31, 6, 26, NULL, NULL),
(32, 7, 27, NULL, NULL),
(33, 8, 28, NULL, NULL),
(34, 9, 29, NULL, NULL),
(35, 13, 30, NULL, NULL),
(36, 9, 30, NULL, NULL);

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
(3, '2018_05_08_095845_create_studies_table', 1),
(4, '2018_05_08_100006_create_tasks_table', 1),
(5, '2018_05_08_122459_create_groups_table', 1),
(6, '2018_05_09_123828_create_subjets_table', 1),
(7, '2018_05_09_123942_create_study_subject_table', 1),
(8, '2018_05_09_145702_create_group_subject_table', 1),
(9, '2018_05_09_231748_create_experiments_table', 1),
(10, '2018_05_16_141235_add_admin_to_users_table', 1),
(11, '2018_05_24_141604_create_subject_task_comment_table', 1);

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
-- Table structure for table `studies`
--

CREATE TABLE `studies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `studies`
--

INSERT INTO `studies` (`id`, `name`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'milanov', 'milanov', NULL, '2018-05-24 21:27:17', '2018-06-10 21:52:01'),
(2, 'Milan Pantovic', 'Milan-Pantovic', NULL, '2018-05-24 21:27:58', '2018-05-24 21:27:58'),
(3, 'treca sreca', 'treca-sreca', NULL, '2018-06-06 20:09:02', '2018-06-08 06:34:23'),
(4, 'cetvrta', 'cetvrta', NULL, '2018-06-06 20:10:19', '2018-06-09 22:13:30'),
(5, 'gait and depresionana', 'gait-and-depresionana', NULL, '2018-06-10 21:33:42', '2018-06-10 21:59:47'),
(6, 'nova studija prva', 'nova-studija-prva', NULL, '2018-06-10 21:38:10', '2018-06-10 21:39:43'),
(7, 'zavrsna proba', 'zavrsna-proba', '2018-06-11 07:35:48', '2018-06-11 07:05:48', '2018-06-11 07:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `study_subject`
--

CREATE TABLE `study_subject` (
  `id` int(10) UNSIGNED NOT NULL,
  `study_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `study_subject`
--

INSERT INTO `study_subject` (`id`, `study_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(2, 2, 3, NULL, NULL),
(3, 1, 1, NULL, NULL),
(4, 1, 7, NULL, NULL),
(5, 1, 8, NULL, NULL),
(6, 2, 9, NULL, NULL),
(7, 2, 10, NULL, NULL),
(8, 1, 11, NULL, NULL),
(9, 1, 12, NULL, NULL),
(10, 2, 12, NULL, NULL),
(11, 2, 13, NULL, NULL),
(12, 2, 14, NULL, NULL),
(13, 1, 19, NULL, NULL),
(14, 2, 19, NULL, NULL),
(15, 3, 19, NULL, NULL),
(17, 4, 20, NULL, NULL),
(18, 1, 20, NULL, NULL),
(19, 2, 20, NULL, NULL),
(20, 2, 2, NULL, NULL),
(21, 1, 21, NULL, NULL),
(22, 1, 3, NULL, NULL),
(23, 1, 22, NULL, NULL),
(24, 5, 23, NULL, NULL),
(25, 5, 24, NULL, NULL),
(26, 5, 25, NULL, NULL),
(27, 4, 26, NULL, NULL),
(28, 3, 27, NULL, NULL),
(29, 5, 28, NULL, NULL),
(30, 6, 29, NULL, NULL),
(31, 7, 30, NULL, NULL),
(32, 6, 30, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(10) UNSIGNED NOT NULL,
  `ime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `srednje` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rodjen` date NOT NULL,
  `pol` varchar(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komentar` text COLLATE utf8mb4_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `ime`, `prezime`, `srednje`, `rodjen`, `pol`, `komentar`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Milanea', 'Pantovica', 'Mikia', '2018-05-29', 'm', 'saasas', NULL, '2018-05-25 07:26:53', '2018-06-11 07:52:04'),
(2, 'dragan', 'bokan', 'xxx', '2018-05-30', 'm', 'xcc', NULL, '2018-05-25 07:28:43', '2018-05-25 07:28:43'),
(3, 'dragan', 'pantovic', 'xz', '2018-05-29', 'm', 'xz', NULL, '2018-05-25 07:53:17', '2018-05-25 07:53:17'),
(7, 'dragan', 'bokan', 'dragance', '2018-06-06', 'm', 'ds', NULL, '2018-06-05 17:01:20', '2018-06-05 17:01:20'),
(8, 'dragan', 'bokan', 'dragance', '2018-05-29', 'm', NULL, NULL, '2018-06-05 17:01:57', '2018-06-05 17:01:57'),
(9, 'Jamala', 'jama', 'ne', '1955-06-01', 'f', 'sa', NULL, '2018-06-05 17:02:45', '2018-06-05 17:02:45'),
(10, 'Milan Pantovic', 'pantovic', 'miki', '2018-05-30', 'm', 'm', NULL, '2018-06-05 17:05:29', '2018-06-05 17:05:29'),
(11, 'milos', 'vasic', 'misa', '2018-06-05', 'm', NULL, NULL, '2018-06-05 19:47:32', '2018-06-05 19:47:32'),
(12, 'marko', 'trifunovic', 'gobi', '2018-07-04', 'm', 'don morave', NULL, '2018-06-05 20:35:04', '2018-06-05 20:35:04'),
(13, 'nikola', 'miinic', 'snezana', '1990-05-30', 'm', 'zubar', NULL, '2018-06-05 22:19:15', '2018-06-05 22:19:15'),
(14, 'nikola', 'pavlovic', 'miroslav', '1990-06-20', 'm', 'nista', NULL, '2018-06-05 22:20:20', '2018-06-05 22:20:20'),
(19, 'dobar', 'los', 'zao', '1957-06-05', 'm', 'sabac', NULL, '2018-06-06 21:03:25', '2018-06-06 21:03:25'),
(20, 'puza', 'debil', 'tijana', '2018-06-28', 'm', 'sa', NULL, '2018-06-06 21:39:50', '2018-06-06 21:39:50'),
(21, 'nikola', 'nikolic', 'nidza', '1965-06-03', 'm', NULL, NULL, '2018-06-09 21:36:58', '2018-06-09 21:36:58'),
(22, 'mozes', 'ti', 'to', '2018-06-19', 'm', NULL, NULL, '2018-06-10 15:10:57', '2018-06-10 15:10:57'),
(23, 'markoa', 'basa', 'mare', '2018-05-30', 'm', NULL, NULL, '2018-06-10 21:46:42', '2018-06-10 21:49:10'),
(25, 'Van Galen', 'Edi Van', 'Show Me', '2018-06-20', 'm', NULL, NULL, '2018-06-10 22:30:28', '2018-06-10 22:30:28'),
(26, 'Van Galen', 'Dajk Dear', 'No Res', '2018-06-14', 'm', 'pije dobro lekove', NULL, '2018-06-10 22:32:09', '2018-06-10 22:32:09'),
(27, 'Method', 'Man', 'Redman', '2018-06-27', 'm', 'sa', NULL, '2018-06-10 22:38:31', '2018-06-10 22:38:31'),
(28, 'Elane Fon', 'Klickov', 'Rusija', '2018-06-07', 'f', 'pala kad pila vodu', NULL, '2018-06-10 23:01:21', '2018-06-10 23:01:21'),
(29, 'Ian Fon', 'Right', 'Donator', '2018-05-30', 'm', 'v', NULL, '2018-06-10 23:24:46', '2018-06-10 23:24:46'),
(30, 'Emira', 'Bekrica', 'Don', '2018-06-06', 'm', 'dobar je', '2018-06-11 07:33:41', '2018-06-11 07:11:19', '2018-06-11 07:33:41');

-- --------------------------------------------------------

--
-- Table structure for table `subject_task_comment`
--

CREATE TABLE `subject_task_comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `komentar` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subject_task_comment`
--

INSERT INTO `subject_task_comment` (`id`, `subject_id`, `task_id`, `komentar`, `created_at`, `updated_at`) VALUES
(1, 20, 6, 'bvbvv', NULL, NULL),
(2, 28, 9, 'dobar dan', NULL, NULL),
(4, 3, 3, 'dobar', NULL, NULL),
(5, 30, 17, 'asa', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `study_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `study_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 1, 'prvi', '2018-05-24 21:27:17', '2018-06-10 13:34:44'),
(2, 1, 'drugi', '2018-05-24 21:27:17', '2018-05-24 21:27:17'),
(3, 2, 'milance', '2018-05-24 21:27:58', '2018-05-24 21:27:58'),
(4, 2, 'dragance', '2018-05-24 21:27:58', '2018-05-24 21:27:58'),
(5, 3, 'treci task', '2018-06-06 20:09:02', '2018-06-06 20:09:02'),
(6, 4, 'da', '2018-06-06 20:10:19', '2018-06-06 20:10:19'),
(7, 3, 'novi', '2018-06-06 20:18:14', '2018-06-06 20:18:14'),
(8, 2, 'bokance', '2018-05-24 21:27:58', '2018-05-24 21:27:58'),
(9, 5, 'gaita', '2018-06-10 21:33:42', '2018-06-10 21:59:47'),
(10, 6, 'provera', '2018-06-10 21:38:10', '2018-06-10 21:38:10'),
(13, 1, 'treci', '2018-06-10 21:59:14', '2018-06-10 21:59:14'),
(14, 5, 'gait2', '2018-06-10 22:00:09', '2018-06-10 22:00:09'),
(15, 2, 'trifce', '2018-06-10 23:23:30', '2018-06-10 23:23:30'),
(16, 2, 'pelic', '2018-06-10 23:23:30', '2018-06-10 23:23:30'),
(17, 7, 'dve grupe', '2018-06-11 07:05:48', '2018-06-11 07:05:48'),
(18, 7, 'jos dve', '2018-06-11 07:05:48', '2018-06-11 07:05:48'),
(19, 7, 'sasa', '2018-06-11 07:10:53', '2018-06-11 07:10:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `ime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prezime` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ime`, `prezime`, `email`, `admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'milan', 'pantovic', 'milan@gmail.com', 1, '$2y$10$bTvBNbMlxKVYYYNpVc0cM.B2J5AD2Sp/BRaodLLUb4864H65W0ck6', '5GwCp0peNb5unrDoSqrQPG05LFKgcYJzI3TQ3i59ISRFPYtRaPlzm3VoA4JJ', '2018-05-24 21:06:58', '2018-06-11 06:36:28'),
(2, 'Kobe Anderson', 'Felton Gibson PhD', 'rogahn.dock@example.org', 0, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'mfyO8MFY5h', '2018-06-10 14:34:11', '2018-06-10 15:02:13'),
(3, 'Dr. Jacques Schneider PhD', 'Prof. Meredith Cruickshank I', 'herzog.mercedes@example.org', 0, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'BFApbVbB8o', '2018-06-10 14:34:11', '2018-06-10 14:34:11'),
(4, 'Ms. Jada Powlowski III', 'Alicia Crooks', 'margaret.hayes@example.org', 0, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', '4hV3WOpfnj', '2018-06-10 14:34:11', '2018-06-10 15:02:21'),
(5, 'Kiana Schmitt PhD', 'Ivah Jaskolski', 'kgreenholt@example.net', 0, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', '6swzZrSAWQ', '2018-06-10 14:34:11', '2018-06-10 14:34:11'),
(6, 'Imelda Feest', 'Cristopher Douglas', 'ujerde@example.net', 0, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'o7E6tLv20A', '2018-06-10 14:34:11', '2018-06-10 14:34:11'),
(7, 'May Koepp Sr.', 'Jerry Sporer', 'marion.blanda@example.org', 0, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', '6kvHQAzjm7', '2018-06-10 14:34:11', '2018-06-10 14:34:11'),
(8, 'Prof. Krystal Renner', 'Lisandro Schumm', 'lkilback@example.com', 0, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'b7idFIpotk', '2018-06-10 14:34:11', '2018-06-10 14:34:11'),
(9, 'Janet Upton', 'Susanna Auer', 'reilly.akeem@example.net', 0, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'p3l7ppSHyd', '2018-06-10 14:34:11', '2018-06-10 14:34:11'),
(10, 'Dr. Raleigh Ankunding', 'Manuela Fritsch', 'hilpert.kyle@example.com', 0, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'KH7XpTC7Uv', '2018-06-10 14:34:11', '2018-06-10 14:34:11'),
(11, 'Prof. Zola Wintheiser', 'Ward Mante IV', 'veronica30@example.net', 0, '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', 'P5Xc7NrtRc', '2018-06-10 14:34:11', '2018-06-10 14:34:11'),
(12, 'dragan', 'bokan', 'draganbokan@gmail.com', 0, '$2y$10$BoBBePLHtZWESCSShfLY6efu0pi5RevLzChKzTsLhM9o.sBx6SFfW', 'UrYjiTuHqv3UgOnAZ0wKyELngMD17WHnFieIVUX2vOJdEVZpbbH8ckmOI53w', '2018-06-10 15:03:39', '2018-06-10 15:03:39'),
(13, 'mehmed', 'memo', 'memo@gmail.com', 0, '$2y$10$jASaAX0cg5RehwYfy1E37eE.qwmLibPaFa5KatsAXeh3COoOsTxr2', NULL, '2018-06-11 08:45:17', '2018-06-11 08:45:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `experiments`
--
ALTER TABLE `experiments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_subject`
--
ALTER TABLE `group_subject`
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
-- Indexes for table `studies`
--
ALTER TABLE `studies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `study_subject`
--
ALTER TABLE `study_subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject_task_comment`
--
ALTER TABLE `subject_task_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `experiments`
--
ALTER TABLE `experiments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `group_subject`
--
ALTER TABLE `group_subject`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `studies`
--
ALTER TABLE `studies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `study_subject`
--
ALTER TABLE `study_subject`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `subject_task_comment`
--
ALTER TABLE `subject_task_comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
