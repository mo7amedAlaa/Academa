-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 15, 2024 at 02:21 AM
-- Server version: 8.0.40-0ubuntu0.24.04.1
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academa`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'Teaching & Academics', NULL, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(2, 'Marketing & Sales', NULL, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(3, 'Development', NULL, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(4, 'Design', NULL, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(5, 'Personal Development', NULL, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(6, 'Lifestyle', NULL, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(7, 'Business', NULL, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(8, 'Health & Fitness', NULL, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(9, 'Language Learning', 1, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(10, 'Science & Mathematics', 1, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(11, 'Test Prep', 1, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(12, 'Education for Children', 1, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(13, 'Digital Marketing', 2, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(14, 'Sales Strategies', 2, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(15, 'Branding', 2, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(16, 'Social Media Marketing', 2, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(17, 'Web Development', 3, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(18, 'Mobile Development', 3, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(19, 'Data Science', 3, '2024-11-28 23:04:08', '2024-11-28 23:04:08'),
(20, 'Game Development', 3, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(21, 'Graphic Design', 4, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(22, 'UI/UX Design', 4, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(23, 'Animation', 4, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(24, 'Product Design', 4, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(25, 'Leadership', 5, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(26, 'Productivity', 5, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(27, 'Stress Management', 5, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(28, 'Time Management', 5, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(29, 'Cooking', 6, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(30, 'Health & Fitness', 6, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(31, 'Travel', 6, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(32, 'Home Improvement', 6, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(33, 'Entrepreneurship', 7, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(34, 'Leadership & Management', 7, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(35, 'Finance & Accounting', 7, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(36, 'Negotiation Skills', 7, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(37, 'Yoga', 8, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(38, 'Weight Loss', 8, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(39, 'Nutrition', 8, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(40, 'Mental Health', 8, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(41, 'English', 9, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(42, 'Spanish', 9, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(43, 'French', 9, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(44, 'Mandarin', 9, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(45, 'Physics', 10, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(46, 'Chemistry', 10, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(47, 'Biology', 10, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(48, 'Mathematics', 10, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(49, 'GRE', 11, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(50, 'GMAT', 11, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(51, 'SAT', 11, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(52, 'TOEFL', 11, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(53, 'Math for Kids', 12, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(54, 'Science for Kids', 12, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(55, 'Reading for Kids', 12, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(56, 'Language for Kids', 12, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(57, 'SEO', 13, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(58, 'PPC Advertising', 13, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(59, 'Content Marketing', 13, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(60, 'Email Marketing', 13, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(61, 'Sales Psychology', 14, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(62, 'Lead Generation', 14, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(63, 'Sales Funnels', 14, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(64, 'Cold Calling', 14, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(65, 'Branding for Startups', 15, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(66, 'Personal Branding', 15, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(67, 'Brand Strategy', 15, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(68, 'Logo Design', 15, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(69, 'Facebook Ads', 16, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(70, 'Instagram Ads', 16, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(71, 'LinkedIn Ads', 16, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(72, 'Twitter Ads', 16, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(73, 'Frontend Development', 17, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(74, 'Backend Development', 17, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(75, 'Full Stack Development', 17, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(76, 'Web Frameworks', 17, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(77, 'iOS Development', 18, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(78, 'Android Development', 18, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(79, 'Cross-platform Development', 18, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(80, 'React Native', 18, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(81, 'Machine Learning', 19, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(82, 'Data Analysis', 19, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(83, 'Artificial Intelligence', 19, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(84, 'Deep Learning', 19, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(85, 'Adobe Photoshop', 20, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(86, 'Illustrator', 20, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(87, 'Logo Design', 20, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(88, 'Packaging Design', 20, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(89, 'User Research', 21, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(90, 'Wireframing', 21, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(91, 'Prototyping', 21, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(92, 'Interaction Design', 21, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(93, '2D Animation', 22, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(94, '3D Animation', 22, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(95, 'Motion Graphics', 22, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(96, 'Character Animation', 22, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(97, 'Leadership', 23, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(98, 'Public Speaking', 23, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(99, 'Productivity', 23, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(100, 'Time Management', 23, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(101, 'Baking', 24, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(102, 'Healthy Recipes', 24, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(103, 'Cooking for Beginners', 24, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(104, 'International Cuisine', 24, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(105, 'Yoga', 25, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(106, 'Weight Loss', 25, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(107, 'Mental Health', 25, '2024-11-28 23:04:09', '2024-11-28 23:04:09'),
(108, 'Nutrition', 25, '2024-11-28 23:04:09', '2024-11-28 23:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint UNSIGNED NOT NULL,
  `instructor_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `price` decimal(10,2) DEFAULT NULL,
  `discount` double DEFAULT NULL,
  `max_students` int DEFAULT NULL,
  `duration_hours` int NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `isFree` tinyint(1) DEFAULT '0',
  `category_id` bigint UNSIGNED NOT NULL,
  `level_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_levels`
--

CREATE TABLE `course_levels` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_levels`
--

INSERT INTO `course_levels` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Beginner', 'Beginner', '2024-11-28 23:04:18', '2024-11-28 23:04:18'),
(2, 'Intermediate', 'Intermediate', '2024-12-03 20:57:44', '2024-12-03 20:57:44'),
(3, 'Advanced', 'Advanced', '2024-12-03 20:57:44', '2024-12-03 20:57:44'),
(4, 'Expert', 'Expert', '2024-12-03 20:58:29', '2024-12-03 20:58:29');

-- --------------------------------------------------------

--
-- Table structure for table `course_registrations`
--

CREATE TABLE `course_registrations` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `progress_percentage` int NOT NULL DEFAULT '0',
  `registration_date` date NOT NULL DEFAULT '2024-11-29',
  `expired_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience_years` int DEFAULT NULL,
  `experience_card` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int DEFAULT NULL,
  `ssn` bigint NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `instructor_id` bigint UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_type` enum('video','image','link','quiz','practice') COLLATE utf8mb4_unicode_ci NOT NULL,
  `media` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int UNSIGNED DEFAULT NULL,
  `is_public` tinyint(1) DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(80, '0001_01_01_000000_create_users_table', 1),
(81, '0001_01_01_000001_create_cache_table', 1),
(82, '2024_11_16_124000_create_categories_table', 1),
(83, '2024_11_16_124324_create_students_table', 1),
(84, '2024_11_16_124408_create_instructors_table', 1),
(85, '2024_11_16_124558_create_course_levels_table', 1),
(86, '2024_11_16_124625_create_courses_table', 1),
(88, '2024_11_16_124728_create_favorites_table', 1),
(89, '2024_11_16_124746_create_reviews_table', 1),
(90, '2024_11_16_124808_create_certificates_table', 1),
(91, '2024_11_16_124944_create_payments_table', 1),
(92, '2024_11_16_132500_create_course_registrations_table', 1),
(93, '2024_11_23_132138_create_personalize__table', 1),
(94, '2024_11_26_104202_create_permission_tables', 1),
(95, '2024_11_29_001120_create_personal_access_tokens_table', 1),
(98, '2024_11_16_124649_create_lessons_table', 2),
(99, '2024_12_08_131653_create_notifications_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(3, 'App\\Models\\User', 51),
(3, 'App\\Models\\User', 52),
(2, 'App\\Models\\User', 53),
(2, 'App\\Models\\User', 54),
(2, 'App\\Models\\User', 55),
(2, 'App\\Models\\User', 56),
(3, 'App\\Models\\User', 57),
(2, 'App\\Models\\User', 58),
(3, 'App\\Models\\User', 59),
(2, 'App\\Models\\User', 60),
(2, 'App\\Models\\User', 61),
(3, 'App\\Models\\User', 62),
(3, 'App\\Models\\User', 63),
(2, 'App\\Models\\User', 64),
(3, 'App\\Models\\User', 65),
(3, 'App\\Models\\User', 66),
(3, 'App\\Models\\User', 67),
(3, 'App\\Models\\User', 68),
(3, 'App\\Models\\User', 70),
(2, 'App\\Models\\User', 73),
(2, 'App\\Models\\User', 74),
(3, 'App\\Models\\User', 78),
(2, 'App\\Models\\User', 79),
(3, 'App\\Models\\User', 80),
(2, 'App\\Models\\User', 81);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `student_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` enum('pending','completed','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'manage users', 'web', '2024-11-28 23:04:24', '2024-11-28 23:04:24'),
(2, 'manage courses', 'web', '2024-11-28 23:04:24', '2024-11-28 23:04:24'),
(3, 'add to cart', 'web', '2024-11-28 23:04:24', '2024-11-28 23:04:24'),
(4, 'add to favorites', 'web', '2024-11-28 23:04:24', '2024-11-28 23:04:24'),
(5, 'checkout', 'web', '2024-11-28 23:04:24', '2024-11-28 23:04:24'),
(6, 'view instructors', 'web', '2024-11-28 23:04:24', '2024-11-28 23:04:24'),
(7, 'manage instructors', 'web', '2024-11-28 23:04:24', '2024-11-28 23:04:24'),
(8, 'manage categories', 'web', '2024-11-28 23:04:24', '2024-11-28 23:04:24'),
(9, 'view dashboard', 'web', '2024-11-28 23:04:24', '2024-11-28 23:04:24');

-- --------------------------------------------------------

--
-- Table structure for table `personalize`
--

CREATE TABLE `personalize` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `course_id` bigint UNSIGNED DEFAULT NULL,
  `instructor_id` bigint UNSIGNED DEFAULT NULL,
  `rating` int NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2024-11-28 23:04:24', '2024-11-28 23:04:24'),
(2, 'instructor', 'web', '2024-11-28 23:04:24', '2024-11-28 23:04:24'),
(3, 'student', 'web', '2024-11-28 23:04:24', '2024-11-28 23:04:24');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(5, 1),
(7, 1),
(8, 1),
(9, 1),
(2, 2),
(6, 2),
(3, 3),
(4, 3),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('IGIXA6CoUnGzVWkDdtV1jgT9D9LaC45faX96LT4Y', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRUoyT1F4anVKanlpelNjYmg0M3lkUUJEMmpBaDFEajVyN2ZadEpMeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3NldHRpbmdzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NDoiY2FydCI7YToxOntpOjc4O2E6MDp7fX19', 1734135692),
('lIi5vPpU1wn8ewjduv8aZLoqcvACmKqvIHfjNxlr', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRENiNHFCZUJaMDU2NHlPbVhKQzVmT0xCbGlNR1h4Q3lRbDAwanpwNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1734229139);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `interests_field` bigint UNSIGNED DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `is_premium` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `certificates_course_id_foreign` (`course_id`),
  ADD KEY `certificates_student_id_foreign` (`student_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_category_id_foreign` (`category_id`),
  ADD KEY `courses_instructor_id_foreign` (`instructor_id`),
  ADD KEY `courses_level_id_foreign` (`level_id`);

--
-- Indexes for table `course_levels`
--
ALTER TABLE `course_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_registrations`
--
ALTER TABLE `course_registrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_registrations_student_id_foreign` (`student_id`),
  ADD KEY `course_registrations_course_id_foreign` (`course_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `favorites_course_id_foreign` (`course_id`),
  ADD KEY `favorites_student_id_foreign` (`student_id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructors_user_id_foreign` (`user_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lessons_course_id_foreign` (`course_id`),
  ADD KEY `lessons_instructor_id_foreign` (`instructor_id`);

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
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_course_id_foreign` (`course_id`),
  ADD KEY `payments_student_id_foreign` (`student_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personalize`
--
ALTER TABLE `personalize`
  ADD PRIMARY KEY (`id`),
  ADD KEY `personalize_user_id_foreign` (`user_id`),
  ADD KEY `personalize_category_id_foreign` (`category_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_course_id_foreign` (`course_id`),
  ADD KEY `reviews_instructor_id_foreign` (`instructor_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `students_user_id_foreign` (`user_id`),
  ADD KEY `students_interests_field_foreign` (`interests_field`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `course_levels`
--
ALTER TABLE `course_levels`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course_registrations`
--
ALTER TABLE `course_registrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `personalize`
--
ALTER TABLE `personalize`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `certificates`
--
ALTER TABLE `certificates`
  ADD CONSTRAINT `certificates_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `certificates_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `course_levels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `course_registrations`
--
ALTER TABLE `course_registrations`
  ADD CONSTRAINT `course_registrations_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_registrations_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favorites_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `instructors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lessons_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payments_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `personalize`
--
ALTER TABLE `personalize`
  ADD CONSTRAINT `personalize_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `personalize_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_instructor_id_foreign` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_interests_field_foreign` FOREIGN KEY (`interests_field`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `students_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
