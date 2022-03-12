-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 15, 2021 at 10:45 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `final_year`
--

-- --------------------------------------------------------

--
-- Table structure for table `class_rooms`
--

CREATE TABLE `class_rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `class_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`course_id`)),
  `setting_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `class_rooms`
--

INSERT INTO `class_rooms` (`id`, `class_name`, `department_id`, `course_id`, `setting_id`, `created_at`, `updated_at`) VALUES
(1, 'IT level 2', 2, '[\"10\",\"13\"]', 1, '2021-11-18 13:49:32', '2021-11-18 13:49:32'),
(2, 'ET a', 3, '[\"10\"]', 1, '2021-11-19 04:01:22', '2021-11-19 04:01:22'),
(3, 'meg', 18, '[\"21\"]', 14, '2021-12-15 15:16:13', '2021-12-15 15:16:13');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_credit` int(10) UNSIGNED NOT NULL,
  `hours_per_week` int(10) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `setting_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_name`, `course_credit`, `hours_per_week`, `department_id`, `level_id`, `setting_id`, `semester_id`, `room_id`, `created_at`, `updated_at`) VALUES
(5, 'ICT304', 'java', 20, 10, 2, 4, 1, 1, 2, '2021-11-12 12:06:20', '2021-11-12 12:06:20'),
(6, 'ICT301', 'networking', 15, 7, 2, 4, 1, 1, 1, '2021-11-12 12:07:18', '2021-12-15 14:19:54'),
(7, 'ICT390', 'NETWORKING', 5, 7, 2, 4, 1, 1, 2, '2021-11-12 12:29:02', '2021-12-15 14:23:50'),
(8, 'ICTM', 'PHP', 10, 5, 2, 5, 1, 2, 1, '2021-11-12 12:30:29', '2021-11-25 10:28:30'),
(9, 'ICT314', 'LINUX', 10, 5, 2, 6, 1, 1, 5, '2021-11-12 12:31:51', '2021-11-25 10:29:59'),
(10, 'ET384', 'net', 10, 5, 3, 6, 1, 1, 4, '2021-11-12 14:39:37', '2021-11-25 10:30:31'),
(11, 'ict316', 'linux server', 10, 5, 3, 3, 1, 1, 4, '2021-11-14 13:32:11', '2021-11-25 10:30:20'),
(14, 'ICT401', 'web', 10, 5, 2, 5, 1, 2, 5, '2021-11-24 18:56:10', '2021-11-25 10:30:42'),
(16, 'ICT301', 'oracle', 10, 5, 2, 4, 1, 1, 2, '2021-11-24 19:28:39', '2021-11-25 10:28:02'),
(17, 'ICT132', 'advanced php', 10, 5, 2, 3, 1, 1, 1, '2021-11-24 19:51:57', '2021-11-25 10:27:47'),
(18, 'ICT304', 'java', 20, 10, 2, 6, 1, 1, 2, '2021-11-24 19:57:32', '2021-11-25 10:27:37'),
(19, 'ICT304', 'java', 20, 5, 2, 6, 1, 1, 2, '2021-11-24 20:30:13', '2021-11-25 10:27:18'),
(20, 'ET304', 'ELECTRONIC MECHANICAL', 10, 5, 3, 9, 1, 1, 4, '2021-12-07 10:15:37', '2021-12-07 10:27:46'),
(21, 'ME201', 'megatronic 5', 10, 5, 18, 8, 14, 1, 1, '2021-12-15 14:47:04', '2021-12-15 14:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `course_lectures`
--

CREATE TABLE `course_lectures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `assigned` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_lectures`
--

INSERT INTO `course_lectures` (`id`, `user_id`, `course_id`, `assigned`, `created_at`, `updated_at`) VALUES
(1, 31, 5, 1, '2021-11-25 07:24:58', '2021-11-25 07:24:58'),
(2, 34, 7, 1, '2021-11-25 07:25:39', '2021-11-25 07:25:39');

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE `days` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `days`
--

INSERT INTO `days` (`id`, `name`, `short_name`, `created_at`, `updated_at`) VALUES
(1, 'Monday', 'Mon', NULL, NULL),
(2, 'Tuesday', 'Tue', NULL, NULL),
(3, 'Wednesday', 'Wed', NULL, NULL),
(4, 'Thursday', 'Thur', NULL, NULL),
(5, 'Friday', 'Fri', NULL, NULL),
(6, 'Saturday', 'Sat', NULL, NULL),
(7, 'Sunday', 'Sun', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `abbr` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setting_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `abbr`, `description`, `setting_id`, `created_at`, `updated_at`) VALUES
(2, 'IT', 'Informatioonn Technology', 1, '2021-11-10 11:37:24', '2021-11-10 11:37:24'),
(3, 'ET', 'electronic', 1, '2021-11-10 16:50:22', '2021-11-10 16:50:22'),
(13, 'RE', 'Renewable Energy', 1, '2021-11-10 18:22:03', '2021-11-10 18:22:03'),
(18, 'ME', 'Mechatronic', 14, '2021-11-29 16:11:25', '2021-11-29 16:11:25'),
(19, 'ICT', 'information Communicatio Technology', 14, '2021-11-29 16:22:54', '2021-11-29 16:22:54');

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
-- Table structure for table `hod_assignemnts`
--

CREATE TABLE `hod_assignemnts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `hod_assignemnts`
--

INSERT INTO `hod_assignemnts` (`id`, `user_id`, `department_id`, `created_at`, `updated_at`) VALUES
(2, 9, 2, '2021-11-19 07:41:02', '2021-11-19 07:41:02'),
(3, 19, 13, '2021-11-20 16:43:32', '2021-11-20 16:43:32');

-- --------------------------------------------------------

--
-- Table structure for table `lecture_assignments`
--

CREATE TABLE `lecture_assignments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lecture_assignments`
--

INSERT INTO `lecture_assignments` (`id`, `user_id`, `department_id`, `level_id`, `created_at`, `updated_at`) VALUES
(1, 31, 2, 4, '2021-11-20 17:24:09', '2021-11-20 17:24:09'),
(2, 34, 2, 5, '2021-11-22 08:33:05', '2021-11-22 08:33:05'),
(3, 39, 13, 3, '2021-11-22 13:45:41', '2021-11-22 13:45:41'),
(4, 41, 2, 3, '2021-12-14 11:43:15', '2021-12-14 11:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `setting_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `levels`
--

INSERT INTO `levels` (`id`, `level_name`, `department_id`, `setting_id`, `created_at`, `updated_at`) VALUES
(3, 'level 5', 2, 1, '2021-11-15 11:59:12', '2021-11-15 14:27:28'),
(4, 'level 6', 2, 1, '2021-11-15 12:01:36', '2021-11-15 12:01:36'),
(5, 'level 3', 13, 1, '2021-11-15 12:02:12', '2021-11-15 12:02:12'),
(6, 'level 3', 13, 1, '2021-11-15 12:48:42', '2021-11-15 12:48:42'),
(8, 'level 6', 18, 14, '2021-11-29 16:21:36', '2021-11-29 16:21:36'),
(9, 'level 4', 3, 1, '2021-12-07 10:14:57', '2021-12-07 10:14:57'),
(10, 'level 6', 3, 1, '2021-12-08 15:59:54', '2021-12-08 15:59:54');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2021_11_10_080449_create_settings_table', 2),
(10, '2021_11_10_131926_create_departments_table', 3),
(14, '2021_11_11_145356_create_courses_table', 6),
(15, '2021_11_12_131830_create_rooms_table', 7),
(16, '2021_11_14_110954_create_levels_table', 8),
(19, '2021_11_18_143159_create_class_rooms_table', 9),
(20, '2021_11_19_084258_create_hod_assignemnts_table', 10),
(21, '2021_11_19_155532_create_lecture_assignments_table', 11),
(22, '2021_11_21_095327_create_days_table', 12),
(24, '2021_11_22_083712_create_course_lectures_table', 13),
(26, '2021_11_22_135040_create_student_infos_table', 14),
(31, '2021_11_23_084502_add_level_id_to_courses_table', 15),
(33, '2021_11_25_102813_add_room_status_to_courses_table', 16),
(34, '2021_11_25_120855_add_room_id_to_courses_table', 17),
(35, '2021_11_28_115431_add_status_to_setting_table', 18),
(37, '2021_11_28_143531_create_timeslots_table', 19),
(38, '2021_11_29_173856_add_setting_id_migration', 20),
(39, '2021_11_29_180055_add_setting_id_to_departments', 21),
(40, '2021_11_30_103720_create_timetables_table', 22),
(41, '2021_12_07_105354_create_semesters_table', 23),
(42, '2021_12_07_115925_add_semester_id_to_course', 24),
(43, '2021_12_07_123333_add_semester_id_to_timetable', 25),
(44, '2021_12_07_145424_add_schedule_to_timetable', 26),
(45, '2021_12_14_105437_add_level_id_to_lecture_assignments', 27),
(46, '2021_12_14_142248_assigned_course_to_course_lecture', 28),
(47, '2021_12_15_154101_add_hours_per-wee_k_to_courses_table', 29),
(48, '2021_12_15_165635_add_setting_id_to_student_info', 30),
(49, '2021_12_15_171212_add_setting_id_to_classroom', 31);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lab_class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `room` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `lab_class`, `room`, `description`, `status`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Labs', 'IT Labs1', 'it class', 1, 2, '2021-11-14 07:16:32', '2021-12-08 16:00:32'),
(2, 'Labs', 'IT Labs1', 'it class', 1, 2, '2021-11-14 07:17:15', '2021-11-28 08:37:00'),
(3, 'Class', 'class 1', 'room 1', 1, 13, '2021-11-14 07:19:32', '2021-11-25 10:28:40'),
(4, 'Labs', 'ET Lab I', 'for ET lab', 1, 3, '2021-11-25 09:52:23', '2021-11-25 09:52:23'),
(5, 'Class', 'Class 2', 'for theory', 0, 2, '2021-11-25 10:29:23', '2021-11-29 15:22:51');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `Se_id` bigint(20) UNSIGNED NOT NULL,
  `semester_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`Se_id`, `semester_name`, `created_at`, `updated_at`) VALUES
(1, 'semester 1', NULL, NULL),
(2, 'semester 2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `system_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `current_session` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `term_begins` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `term_ends` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `system_name`, `status`, `current_session`, `term_begins`, `term_ends`, `created_at`, `updated_at`) VALUES
(1, 'Academic Teaching Timetable System', 0, '2020-2021', '11/25/2021', '11/11/2021', '2021-11-10 08:05:39', '2021-12-15 15:28:42'),
(13, 'Academic Teaching Timetable System', 1, '2021-2022', '11/30/2021', '11/26/2021', '2021-11-28 08:39:17', '2021-12-15 15:28:56'),
(14, 'Academic Teaching Timetable System', 0, '2023-2024', '04/18/2024', '11/30/2023', '2021-11-29 15:53:28', '2021-12-15 14:33:20');

-- --------------------------------------------------------

--
-- Table structure for table `student_infos`
--

CREATE TABLE `student_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `regno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `class_rooms_id` bigint(20) UNSIGNED NOT NULL,
  `setting_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_infos`
--

INSERT INTO `student_infos` (`id`, `user_id`, `regno`, `phone_number`, `department_id`, `level_id`, `class_rooms_id`, `setting_id`, `created_at`, `updated_at`) VALUES
(1, 38, '18rp01492', '+250784647287', 2, 4, 1, 1, '2021-11-22 12:57:34', '2021-11-22 12:57:34');

-- --------------------------------------------------------

--
-- Table structure for table `timeslots`
--

CREATE TABLE `timeslots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `from` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timeslots`
--

INSERT INTO `timeslots` (`id`, `from`, `to`, `created_at`, `updated_at`) VALUES
(1, '06:00', '06:50', '2021-11-28 13:00:49', '2021-11-28 13:00:49'),
(3, '07:00', '07:50', '2021-11-28 13:02:39', '2021-11-28 13:02:39'),
(4, '08:00', '08:50', '2021-11-28 13:37:01', '2021-11-28 13:37:01'),
(5, '09:00', '09:50', '2021-11-28 13:41:47', '2021-11-28 13:41:47'),
(6, '10:00', '10:50', '2021-11-28 13:41:56', '2021-11-28 13:41:56'),
(7, '11:00', '11:50', '2021-11-28 13:42:07', '2021-11-28 13:42:07'),
(8, '12:00', '12:50', '2021-11-28 13:42:16', '2021-11-28 13:42:16'),
(9, '13:00', '13:50', '2021-11-28 13:42:35', '2021-11-28 13:42:35'),
(10, '14:00', '14:50', '2021-11-28 13:42:45', '2021-11-28 13:42:45'),
(11, '15:00', '15:50', '2021-12-07 11:47:19', '2021-12-07 11:47:19'),
(12, '16:00', '16:50', '2021-11-28 13:43:22', '2021-11-28 13:43:22'),
(14, '17:00', '17:50', '2021-11-28 14:58:07', '2021-11-28 14:58:07');

-- --------------------------------------------------------

--
-- Table structure for table `timetables`
--

CREATE TABLE `timetables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `timetable_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `level_id` bigint(20) UNSIGNED NOT NULL,
  `semester_id` bigint(20) UNSIGNED NOT NULL,
  `setting_id` bigint(20) UNSIGNED NOT NULL,
  `schedule` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `timetables`
--

INSERT INTO `timetables` (`id`, `timetable_name`, `department_id`, `level_id`, `semester_id`, `setting_id`, `schedule`, `created_at`, `updated_at`) VALUES
(1, 'timetable level 5', 2, 3, 1, 1, '[[\"-\",\"-\",\"-\",\"-\",\"B\",\"458\",\"458\",\"458\",\"458\"],[\"-\",\"-\",\"-\",\"-\",\"R\",\"-\",\"-\",\"-\",\"-\"],[\"-\",\"-\",\"-\",\"-\",\"E\",\"-\",\"-\",\"-\",\"-\"],[\"-\",\"-\",\"-\",\"458\",\"A\",\"-\",\"-\",\"-\",\"-\"],[\"-\",\"-\",\"-\",\"458\",\"458\",\"-\",\"-\",\"-\",\"-\"]]', '2021-11-30 11:25:42', '2021-11-30 11:25:42'),
(7, 'level 5', 2, 3, 1, 1, '[[\"-\",\"-\",\"-\",\"ICT301\",\"-\",\"-\",\"ICT132\",\"L\",\"ICT301\",\"ICT301\",\"-\",\"-\"],[\"-\",\"ICT132\",\"-\",\"-\",\"ICT301\",\"ICT301\",\"ICT301\",\"U\",\"ICT301\",\"-\",\"-\",\"-\"],[\"-\",\"ICT301\",\"-\",\"ICT132\",\"ICT132\",\"-\",\"-\",\"ICT132\",\"-\",\"-\",\"-\",\"-\"],[\"-\",\"ICT132\",\"ICT132\",\"ICT301\",\"-\",\"-\",\"-\",\"C\",\"-\",\"-\",\"-\",\"-\"],[\"-\",\"ICT301\",\"-\",\"ICT132\",\"-\",\"ICT301\",\"-\",\"ICT301\",\"-\",\"-\",\"ICT301\",\"ICT132\"]]', '2021-12-08 11:18:32', '2021-12-08 11:18:32'),
(8, 'level 6', 2, 4, 1, 1, '[[\"-\",\"-\",\"-\",\"-\",\"ICT390\",\"ICT304\",\"-\",\"L\",\"ICT390\",\"ICT390\",\"ICT301\",\"ICT301\"],[\"-\",\"ICT390\",\"ICT301\",\"-\",\"-\",\"-\",\"-\",\"U\",\"ICT301\",\"-\",\"-\",\"-\"],[\"ICT304\",\"ICT304\",\"-\",\"-\",\"ICT301\",\"-\",\"-\",\"ICT301\",\"-\",\"-\",\"ICT304\",\"ICT304\"],[\"-\",\"ICT304\",\"ICT304\",\"-\",\"-\",\"ICT390\",\"ICT301\",\"C\",\"-\",\"ICT301\",\"-\",\"-\"],[\"-\",\"-\",\"ICT301\",\"ICT390\",\"-\",\"-\",\"-\",\"H\",\"-\",\"-\",\"-\",\"-\"]]', '2021-12-08 12:45:42', '2021-12-15 14:22:49'),
(9, 'level 4', 3, 9, 1, 1, '[[\"-\",\"-\",\"-\",\"-\",\"-\",\"-\",\"-\",\"L\",\"-\",\"-\",\"-\",\"-\"],[\"-\",\"-\",\"-\",\"-\",\"-\",\"-\",\"-\",\"U\",\"-\",\"-\",\"-\",\"-\"],[\"ET304\",\"-\",\"-\",\"ET304\",\"ET304\",\"-\",\"-\",\"N\",\"-\",\"-\",\"-\",\"-\"],[\"-\",\"-\",\"ET304\",\"ET304\",\"-\",\"-\",\"-\",\"C\",\"-\",\"-\",\"-\",\"-\"],[\"-\",\"-\",\"-\",\"-\",\"-\",\"-\",\"-\",\"H\",\"-\",\"-\",\"-\",\"-\"]]', '2021-12-13 19:17:54', '2021-12-15 14:11:49'),
(12, 'level 6 mega', 18, 8, 1, 14, '[[\"-\",\"-\",\"-\",\"-\",\"-\",\"ME201\",\"ME201\",\"L\",\"-\",\"-\",\"-\",\"-\"],[\"-\",\"-\",\"-\",\"-\",\"-\",\"-\",\"-\",\"U\",\"-\",\"-\",\"-\",\"-\"],[\"-\",\"-\",\"-\",\"ME201\",\"-\",\"-\",\"-\",\"N\",\"-\",\"-\",\"-\",\"-\"],[\"-\",\"-\",\"-\",\"-\",\"-\",\"-\",\"-\",\"C\",\"-\",\"-\",\"-\",\"-\"],[\"-\",\"-\",\"-\",\"ME201\",\"-\",\"-\",\"-\",\"H\",\"-\",\"-\",\"-\",\"ME201\"]]', '2021-12-15 14:47:39', '2021-12-15 14:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'student',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'NDACYAYISENGA', 'admin@admin.com', 'academic', NULL, '$2y$10$swXGD5yJ1wlRGEKdHP4cBufYjTk5.SSFSfq.os708PEfwwWtNc/3C', NULL, '2021-11-07 14:10:12', '2021-11-30 06:28:16'),
(9, 'Fabrice', 'christina@gmail.com', 'hod', NULL, '$2y$10$UDpzBqNgBBavHnj/jn6Pk.VqO6uhg9.z/Xi3qsOGTaJYfPcsmTE4u', NULL, '2021-11-19 07:41:00', '2021-11-29 21:22:36'),
(13, 'clair M GIRIMPUHWE', 'royalfabrice1234@gmail.com', 'lecture', NULL, '$2y$10$OvCzRolVUZEiIsRn/4m1leu4KV/nB5i6xtmfe3N2t24wGUvBnjNki', NULL, '2021-11-20 16:22:44', '2021-11-20 16:22:44'),
(19, 'muvandimwe', 'muvandimwe@gmail.com', 'hod', NULL, '$2y$10$8AKDDeMXw5Yl4.VM4nCAceXX.3uOCSsR7FUsiXQifkzFGonjYOlXC', NULL, '2021-11-20 16:43:31', '2021-11-20 16:43:31'),
(31, 'claire', 'claire@gmail.com', 'lecture', NULL, '$2y$10$.1iZcaKCH4cOe77rtW/SA.q3vOB.70d4ZrvglnnKx/hIlfWY/q5fW', NULL, '2021-11-20 17:24:08', '2021-11-20 17:24:08'),
(34, 'bertin', 'bertin@gmail.com', 'lecture', NULL, '$2y$10$ITqoBZbWXJaoDLvRXAHztuzmO3aUSuybxc1sTe2eyvBArHjxmgBBW', NULL, '2021-11-22 08:33:04', '2021-11-22 08:33:04'),
(38, 'charlotte', 'charlotte@gmail.com', 'student', NULL, '$2y$10$I0/R6icy6n/Hco6CZKXio.BwY2N1zKb7X4BCQhiDHoKq0v0rILYoa', NULL, '2021-11-22 12:57:34', '2021-11-22 12:57:34'),
(39, 'Mucyo Alcade', 'alcade@gmail.com', 'lecture', NULL, '$2y$10$xhIVmYu/g6i60PjX.HhWG.nF1iU9DzbVGw29nw4VeSscwHG7msawO', NULL, '2021-11-22 13:45:41', '2021-11-22 13:45:41'),
(41, 'thierry', 'thierry@gmail.com', 'lecture', NULL, '$2y$10$yemlACYTO6uUSaBhn99Ll.M.886NxPwr7vmJVEHWyHHUw1rLOOaba', NULL, '2021-12-14 11:43:15', '2021-12-14 11:43:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class_rooms`
--
ALTER TABLE `class_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_rooms_department_id_foreign` (`department_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_department_id_foreign` (`department_id`);

--
-- Indexes for table `course_lectures`
--
ALTER TABLE `course_lectures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_lectures_user_id_foreign` (`user_id`),
  ADD KEY `course_lectures_course_id_foreign` (`course_id`);

--
-- Indexes for table `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `hod_assignemnts`
--
ALTER TABLE `hod_assignemnts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hod_assignemnts_user_id_foreign` (`user_id`),
  ADD KEY `hod_assignemnts_department_id_foreign` (`department_id`);

--
-- Indexes for table `lecture_assignments`
--
ALTER TABLE `lecture_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecture_assignments_user_id_foreign` (`user_id`),
  ADD KEY `lecture_assignments_department_id_foreign` (`department_id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `levels_department_id_foreign` (`department_id`),
  ADD KEY `levels_setting_id_foreign` (`setting_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`Se_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_infos`
--
ALTER TABLE `student_infos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_infos_user_id_foreign` (`user_id`),
  ADD KEY `student_infos_department_id_foreign` (`department_id`),
  ADD KEY `student_infos_level_id_foreign` (`level_id`),
  ADD KEY `student_infos_class_rooms_id_foreign` (`class_rooms_id`);

--
-- Indexes for table `timeslots`
--
ALTER TABLE `timeslots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timetables`
--
ALTER TABLE `timetables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timetables_department_id_foreign` (`department_id`),
  ADD KEY `timetables_level_id_foreign` (`level_id`),
  ADD KEY `timetables_setting_id_foreign` (`setting_id`);

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
-- AUTO_INCREMENT for table `class_rooms`
--
ALTER TABLE `class_rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `course_lectures`
--
ALTER TABLE `course_lectures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hod_assignemnts`
--
ALTER TABLE `hod_assignemnts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lecture_assignments`
--
ALTER TABLE `lecture_assignments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `Se_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `student_infos`
--
ALTER TABLE `student_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `timeslots`
--
ALTER TABLE `timeslots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `timetables`
--
ALTER TABLE `timetables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `class_rooms`
--
ALTER TABLE `class_rooms`
  ADD CONSTRAINT `class_rooms_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_lectures`
--
ALTER TABLE `course_lectures`
  ADD CONSTRAINT `course_lectures_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `course_lectures_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hod_assignemnts`
--
ALTER TABLE `hod_assignemnts`
  ADD CONSTRAINT `hod_assignemnts_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hod_assignemnts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lecture_assignments`
--
ALTER TABLE `lecture_assignments`
  ADD CONSTRAINT `lecture_assignments_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lecture_assignments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `levels`
--
ALTER TABLE `levels`
  ADD CONSTRAINT `levels_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `levels_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `student_infos`
--
ALTER TABLE `student_infos`
  ADD CONSTRAINT `student_infos_class_rooms_id_foreign` FOREIGN KEY (`class_rooms_id`) REFERENCES `class_rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_infos_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_infos_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `student_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `timetables`
--
ALTER TABLE `timetables`
  ADD CONSTRAINT `timetables_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `timetables_level_id_foreign` FOREIGN KEY (`level_id`) REFERENCES `levels` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `timetables_setting_id_foreign` FOREIGN KEY (`setting_id`) REFERENCES `settings` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
