-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2023 at 10:47 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigadis`
--

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
-- Table structure for table `menu_headers`
--

CREATE TABLE `menu_headers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_headers`
--

INSERT INTO `menu_headers` (`id`, `name`, `num_order`, `created_at`, `updated_at`) VALUES
(1, '', 1, '2022-07-03 19:34:41', '2022-07-03 19:34:41');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menuheader_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `routeparams` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visible_conditions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_conditions` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent` int(11) NOT NULL,
  `num_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menuheader_id`, `name`, `route`, `routeparams`, `icon`, `visible_conditions`, `active_conditions`, `parent`, `num_order`, `created_at`, `updated_at`) VALUES
(1, 1, 'Dashboard', 'admin.dashboard', '', 'bi-speedometer2', '', 'Request::url() == route(\'admin.dashboard\')', 0, 1, '2022-07-03 19:34:41', '2022-07-03 19:34:41'),
(4, 1, 'Kep. Hukdis Ringan', 'admin.kephukdis.index', '{\"hukdis\":\"ringan\"}', 'bi-receipt', '', 'is_int(strpos(Request::url(), route(\'admin.kephukdis.index\'))) && Request::query(\'hukdis\') == \'ringan\'', 0, 5, '2022-09-03 03:17:43', '2023-03-12 09:11:30'),
(8, 1, 'Kep. Hukdis Sedang', 'admin.kephukdis.index', '{\"hukdis\":\"sedang\"}', 'bi-receipt', '', 'is_int(strpos(Request::url(), route(\'admin.kephukdis.index\'))) && Request::query(\'hukdis\') == \'sedang\'', 0, 6, '2022-09-03 03:17:43', '2023-03-12 09:11:37'),
(9, 1, 'Kep. Hukdis Berat', 'admin.kephukdis.index', '{\"hukdis\":\"berat\"}', 'bi-receipt', '', 'is_int(strpos(Request::url(), route(\'admin.kephukdis.index\'))) && Request::query(\'hukdis\') == \'berat\'', 0, 7, '2022-09-03 03:17:43', '2023-03-12 09:11:45'),
(18, 1, 'Kasus', 'admin.kasus.index', '', 'bi-hammer', '', 'is_int(strpos(Request::url(), route(\'admin.kasus.index\')))', 0, 2, NULL, '2023-01-06 02:34:31');

-- --------------------------------------------------------

--
-- Table structure for table `metas`
--

CREATE TABLE `metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `metas`
--

INSERT INTO `metas` (`id`, `code`, `content`, `created_at`, `updated_at`) VALUES
(1, 'description', '', '2022-07-03 19:34:41', '2022-07-03 19:34:41'),
(2, 'keywords', '', '2022-07-03 19:34:41', '2022-07-03 19:34:41'),
(3, 'author', '', '2022-07-03 19:34:41', '2022-07-03 19:34:41');

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
(5, '2022_01_31_000000_add_columns_to_users_table', 1),
(6, '2022_01_31_000000_create_menu_headers_table', 1),
(7, '2022_01_31_000000_create_menu_items_table', 1),
(8, '2022_01_31_000000_create_metas_table', 1),
(9, '2022_01_31_000000_create_permissions_table', 1),
(10, '2022_01_31_000000_create_role__permission_table', 1),
(11, '2022_01_31_000000_create_roles_table', 1),
(12, '2022_01_31_000000_create_settings_table', 1),
(13, '2022_01_31_000000_create_user_attributes_table', 1),
(14, '2022_02_03_000000_add_columns_to_permissions_table', 1),
(15, '2022_02_03_000000_create_user_accounts_table', 1),
(16, '2022_02_03_000000_create_user_avatars_table', 1),
(17, '2022_02_13_000000_create_visitors_table', 1),
(18, '2022_02_19_000000_add_columns_to_roles_table', 1),
(19, '2022_10_23_000000_create_schedules_table', 2),
(20, '2023_01_25_000000_create_periods_table', 3);

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
-- Table structure for table `periods`
--

CREATE TABLE `periods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `num_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`id`, `name`, `status`, `num_order`, `created_at`, `updated_at`) VALUES
(1, '2022', 0, 1, '2023-02-09 00:48:29', '2023-02-09 00:48:29'),
(2, '2023', 1, 2, '2023-02-09 00:48:29', '2023-02-09 00:48:29');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `default` int(11) NOT NULL,
  `num_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `code`, `default`, `num_order`, `created_at`, `updated_at`) VALUES
(1, 'Mengelola Data Role', 'Ajifatur\\FaturHelper\\Http\\Controllers\\RoleController::index', 1, 1, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(2, 'Menambah Role', 'Ajifatur\\FaturHelper\\Http\\Controllers\\RoleController::create', 1, 2, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(3, 'Mengubah Role', 'Ajifatur\\FaturHelper\\Http\\Controllers\\RoleController::edit', 1, 3, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(4, 'Menghapus Role', 'Ajifatur\\FaturHelper\\Http\\Controllers\\RoleController::delete', 1, 4, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(5, 'Mengurutkan Role', 'Ajifatur\\FaturHelper\\Http\\Controllers\\RoleController::reorder', 1, 5, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(6, 'Mengelola Data Hak Akses', 'Ajifatur\\FaturHelper\\Http\\Controllers\\PermissionController::index', 1, 11, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(7, 'Menambah Hak Akses', 'Ajifatur\\FaturHelper\\Http\\Controllers\\PermissionController::create', 1, 12, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(8, 'Mengubah Hak Akses', 'Ajifatur\\FaturHelper\\Http\\Controllers\\PermissionController::edit', 1, 13, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(9, 'Menghapus Hak Akses', 'Ajifatur\\FaturHelper\\Http\\Controllers\\PermissionController::delete', 1, 14, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(10, 'Mengurutkan Hak Akses', 'Ajifatur\\FaturHelper\\Http\\Controllers\\PermissionController::reorder', 1, 15, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(11, 'Mengganti Status Hak Akses', 'Ajifatur\\FaturHelper\\Http\\Controllers\\PermissionController::change', 1, 16, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(12, 'Mengelola Data Menu', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MenuController::index', 1, 19, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(13, 'Menambah Menu Header', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MenuHeaderController::create', 1, 20, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(14, 'Mengubah Menu Header', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MenuHeaderController::edit', 1, 21, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(15, 'Menghapus Menu Header', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MenuHeaderController::delete', 1, 22, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(16, 'Menambah Menu Item', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MenuItemController::create', 1, 23, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(17, 'Mengubah Menu Item', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MenuItemController::edit', 1, 24, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(18, 'Menghapus Menu Item', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MenuItemController::delete', 1, 25, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(19, 'Mengelola Meta', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MetaController::index', 1, 26, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(20, 'Menampilkan Lingkungan Sistem', 'Ajifatur\\FaturHelper\\Http\\Controllers\\SystemController::index', 1, 37, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(21, 'Menampilkan Database', 'Ajifatur\\FaturHelper\\Http\\Controllers\\DatabaseController::index', 1, 38, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(22, 'Menampilkan Route', 'Ajifatur\\FaturHelper\\Http\\Controllers\\RouteController::index', 1, 39, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(23, 'Mengelola Perintah Artisan', 'Ajifatur\\FaturHelper\\Http\\Controllers\\ArtisanController::index', 1, 40, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(24, 'Menampilkan Log Aktivitas', 'Ajifatur\\FaturHelper\\Http\\Controllers\\LogController::activity', 1, 41, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(25, 'Menampilkan Log Aktivitas Berdasarkan URL', 'Ajifatur\\FaturHelper\\Http\\Controllers\\LogController::activityByURL', 1, 42, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(26, 'Menampilkan Log Autentikasi', 'Ajifatur\\FaturHelper\\Http\\Controllers\\LogController::authentication', 1, 43, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(27, 'Menampilkan Data Visitor', 'Ajifatur\\FaturHelper\\Http\\Controllers\\VisitorController::index', 1, 44, '2022-07-03 19:34:41', '2023-03-05 14:50:48'),
(28, 'Mengelola Data Pengguna', 'Ajifatur\\FaturHelper\\Http\\Controllers\\UserController::index', 1, 6, '2022-09-03 03:10:45', '2022-11-30 12:13:19'),
(29, 'Menambah Pengguna', 'Ajifatur\\FaturHelper\\Http\\Controllers\\UserController::create', 1, 7, '2022-09-03 03:10:45', '2022-11-30 12:13:19'),
(30, 'Mengubah Pengguna', 'Ajifatur\\FaturHelper\\Http\\Controllers\\UserController::edit', 1, 8, '2022-09-03 03:10:45', '2022-11-30 12:13:19'),
(31, 'Menghapus Pengguna', 'Ajifatur\\FaturHelper\\Http\\Controllers\\UserController::delete', 1, 9, '2022-09-03 03:10:45', '2022-11-30 12:13:19'),
(32, 'Menghapus Pengguna Terpilih', 'Ajifatur\\FaturHelper\\Http\\Controllers\\UserController::deleteBulk', 1, 10, '2022-09-03 03:10:45', '2022-11-30 12:13:19'),
(33, 'Mengelola Data Agenda', 'Ajifatur\\FaturHelper\\Http\\Controllers\\ScheduleController::index', 1, 34, '2022-11-30 12:13:19', '2023-03-05 14:50:48'),
(34, 'Mengupdate Agenda', 'Ajifatur\\FaturHelper\\Http\\Controllers\\ScheduleController::update', 1, 35, '2022-11-30 12:13:19', '2023-03-05 14:50:48'),
(35, 'Menghapus Agenda', 'Ajifatur\\FaturHelper\\Http\\Controllers\\ScheduleController::delete', 1, 36, '2022-11-30 12:13:19', '2023-03-05 14:50:48'),
(36, 'Mengelola Data Periode', 'Ajifatur\\FaturHelper\\Http\\Controllers\\PeriodController::index', 1, 28, '2023-02-09 00:48:29', '2023-03-05 14:50:48'),
(37, 'Menambah Periode', 'Ajifatur\\FaturHelper\\Http\\Controllers\\PeriodController::create', 1, 29, '2023-02-09 00:48:29', '2023-03-05 14:50:48'),
(38, 'Mengubah Periode', 'Ajifatur\\FaturHelper\\Http\\Controllers\\PeriodController::edit', 1, 30, '2023-02-09 00:48:29', '2023-03-05 14:50:48'),
(39, 'Menghapus Periode', 'Ajifatur\\FaturHelper\\Http\\Controllers\\PeriodController::delete', 1, 31, '2023-02-09 00:48:29', '2023-03-05 14:50:48'),
(40, 'Mengurutkan Periode', 'Ajifatur\\FaturHelper\\Http\\Controllers\\PeriodController::reorder', 1, 32, '2023-02-09 00:48:29', '2023-03-05 14:50:48'),
(41, 'Pengaturan Periode', 'Ajifatur\\FaturHelper\\Http\\Controllers\\PeriodController::setting', 1, 33, '2023-02-09 00:48:29', '2023-03-05 14:50:48'),
(42, 'Menampilkan Pengaturan', 'Ajifatur\\FaturHelper\\Http\\Controllers\\SettingController::index', 1, 17, '2023-03-05 14:50:48', '2023-03-05 14:50:48'),
(43, 'Menampilkan Pengaturan Gambar', 'Ajifatur\\FaturHelper\\Http\\Controllers\\SettingController::image', 1, 18, '2023-03-05 14:50:48', '2023-03-05 14:50:48'),
(44, 'Menampilkan Media', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MediaController::index', 1, 27, '2023-03-05 14:50:48', '2023-03-05 14:50:48');

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
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` int(11) NOT NULL,
  `is_global` int(11) NOT NULL,
  `num_order` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `code`, `is_admin`, `is_global`, `num_order`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'super-admin', 1, 1, 1, '2022-07-03 19:34:40', '2022-07-03 19:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `role__permission`
--

CREATE TABLE `role__permission` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role__permission`
--

INSERT INTO `role__permission` (`role_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `started_at` datetime NOT NULL,
  `ended_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `code`, `content`, `created_at`, `updated_at`) VALUES
(1, 'name', 'SIGADIS', '2022-07-03 19:34:41', '2022-07-03 19:37:53'),
(2, 'tagline', 'Sistem Informasi Penegakan Disiplin dan Etika Pegawai', '2022-07-03 19:34:41', '2022-07-03 19:37:53'),
(3, 'timezone', 'Asia/Jakarta', '2022-07-03 19:34:41', '2022-07-03 19:37:53'),
(4, 'address', 'Kampus Sekaran, Gunungpati', '2022-07-03 19:34:41', '2022-07-03 19:37:53'),
(5, 'city', 'Semarang', '2022-07-03 19:34:41', '2022-07-03 19:37:53'),
(6, 'email', 'mail@unnes.ac.id', '2022-07-03 19:34:41', '2022-07-03 19:37:53'),
(7, 'phone_number', '0', '2022-07-03 19:34:41', '2022-07-03 19:37:53'),
(8, 'whatsapp', '0', '2022-07-03 19:34:41', '2022-07-03 19:37:53'),
(9, 'instagram', NULL, '2022-07-03 19:34:41', '2022-07-03 19:37:53'),
(10, 'youtube', NULL, '2022-07-03 19:34:41', '2022-07-03 19:37:53'),
(11, 'facebook', NULL, '2022-07-03 19:34:41', '2022-07-03 19:37:53'),
(12, 'twitter', NULL, '2022-07-03 19:34:41', '2022-07-03 19:37:53'),
(13, 'google_maps', '', '2022-07-03 19:34:41', '2022-07-03 19:34:41'),
(14, 'google_tag_manager', '', '2022-07-03 19:34:41', '2022-07-03 19:34:41'),
(15, 'theme', 'default', '2022-07-03 19:34:41', '2022-07-03 19:34:41'),
(16, 'show_brand', '0', '2022-09-03 03:10:45', '2022-09-03 03:11:41'),
(17, 'brand_name', 'Kepegawaian UNNES', '2022-11-30 12:13:19', '2022-11-30 16:00:38'),
(18, 'brand_url', 'https://buhk.unnes.ac.id', '2022-11-30 12:13:19', '2022-11-30 16:00:38'),
(19, 'brand_visibility', '0', '2022-11-30 12:13:19', '2022-11-30 16:00:38'),
(20, 'period_alias', 'Periode', '2023-02-09 00:48:29', '2023-02-09 00:48:29'),
(21, 'period_visibility', '0', '2023-02-09 00:48:29', '2023-02-09 00:48:29'),
(22, 'icon', '2023-03-05-21-55-44.png', '2023-03-05 14:50:48', '2023-03-05 14:55:44'),
(23, 'logo', '', '2023-03-05 14:50:48', '2023-03-05 14:50:48'),
(24, 'size', 'small', '2023-03-05 14:50:48', '2023-03-12 09:12:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bap`
--

CREATE TABLE `tbl_bap` (
  `id` int(11) NOT NULL,
  `kasus_id` int(11) NOT NULL,
  `pelanggaran_id` int(11) NOT NULL,
  `terlapor` varchar(255) NOT NULL,
  `terlapor_json` text NOT NULL,
  `tanggal` date NOT NULL,
  `pemeriksa` int(11) NOT NULL,
  `wewenang` int(11) NOT NULL,
  `surat_perintah` varchar(255) DEFAULT NULL,
  `qna` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bap`
--

INSERT INTO `tbl_bap` (`id`, `kasus_id`, `pelanggaran_id`, `terlapor`, `terlapor_json`, `tanggal`, `pemeriksa`, `wewenang`, `surat_perintah`, `qna`, `created_at`, `updated_at`) VALUES
(7, 3, 69, '130935363', '{\"nama\":\"Dra. ENDANG RETNO WINARTI, M. Pd.\",\"nip\":\"195909191981032003\",\"pangkat\":\"IV\\/b - Pembina Tk. I\",\"jabatan\":\"Lektor Kepala\",\"unit\":\"UNNES - FMIPA-Pendidikan Matematika\"}', '2023-01-14', 1, 2, '0001', '{\"pertanyaan\":[\"Mengapa?\",\"Kapan?\"],\"jawaban\":[\"Menyebarkan berita hoax\",\"Kemarin\"]}', '2023-01-13 20:11:36', '2023-01-13 21:53:47'),
(9, 5, 49, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengembang sistem informasi\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '2023-02-23', 2, 1, '', '{\"pertanyaan\":[\"Apa?\",\"Siapa?\"],\"jawaban\":[\"Apa\",\"Siapa\"]}', '2023-02-09 02:28:48', '2023-02-09 02:30:02'),
(10, 6, 56, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengembang sistem informasi\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '2023-02-23', 1, 1, '', '{\"pertanyaan\":[\"Siapa?\"],\"jawaban\":[\"Saya\"]}', '2023-02-09 16:13:23', '2023-02-09 16:13:23'),
(11, 7, 1, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengolah Data Kepegawaian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '2023-03-17', 1, 1, '', '{\"pertanyaan\":[\"Siapa?\"],\"jawaban\":[\"Saya\"]}', '2023-03-12 09:02:19', '2023-03-12 09:02:19');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hukdis`
--

CREATE TABLE `tbl_hukdis` (
  `id` int(11) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tmt` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_hukdis`
--

INSERT INTO `tbl_hukdis` (`id`, `jenis_id`, `nama`, `tmt`, `created_at`, `updated_at`) VALUES
(1, 1, 'Teguran Lisan', 0, NULL, NULL),
(2, 1, 'Teguran Tertulis', 0, NULL, NULL),
(3, 1, 'Pernyataan Tidak Puas Secara Tertulis', 0, NULL, NULL),
(4, 2, 'Pemotongan Tunjangan Kinerja sebesar 25% (dua puluh lima persen) selama 6 (enam) bulan', 1, NULL, NULL),
(5, 2, 'Pemotongan Tunjangan Kinerja sebesar 25% (dua puluh lima persen) selama 9 (sembilan) bulan', 1, NULL, NULL),
(6, 2, 'Pemotongan Tunjangan Kinerja sebesar 25% (dua puluh lima persen) selama 12 (dua belas) bulan', 1, NULL, NULL),
(7, 3, 'Penurunan Jabatan Setingkat Lebih Rendah Selama 12 (dua belas) bulan', 1, NULL, NULL),
(8, 3, 'Pembebasan dari Jabatannya Menjadi Jabatan Pelaksana Selama 12 (dua belas) bulan', 1, NULL, NULL),
(9, 3, 'Pemberhentian dengan Hormat Tidak Atas Permintaan Sendiri sebagai Pegawai Negeri Sipil', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis`
--

CREATE TABLE `tbl_jenis` (
  `id` int(11) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jenis`
--

INSERT INTO `tbl_jenis` (`id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Ringan', NULL, NULL),
(2, 'Sedang', NULL, NULL),
(3, 'Berat', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kasus`
--

CREATE TABLE `tbl_kasus` (
  `id` int(11) NOT NULL,
  `terduga` varchar(255) NOT NULL,
  `terduga_nip` varchar(255) DEFAULT NULL,
  `terduga_nama` varchar(255) DEFAULT NULL,
  `dugaan_pelanggaran` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kasus`
--

INSERT INTO `tbl_kasus` (`id`, `terduga`, `terduga_nip`, `terduga_nama`, `dugaan_pelanggaran`, `created_at`, `updated_at`) VALUES
(6, '199705262022031008', '199705262022031008', 'Fathurrahman Prasetyo Aji, S.Pd.', 'Menyebarkan hoax', '2023-02-09 16:08:03', '2023-02-09 16:08:03'),
(7, '199705262022031008', '199705262022031008', 'Fathurrahman Prasetyo Aji, S.Pd.', 'Kode etik ASN', '2023-03-12 08:26:43', '2023-03-12 08:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kephukdis`
--

CREATE TABLE `tbl_kephukdis` (
  `id` int(11) NOT NULL,
  `kasus_id` int(11) NOT NULL,
  `pelanggaran_id` int(11) NOT NULL,
  `hukdis_id` int(11) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `terlapor` varchar(255) NOT NULL,
  `terlapor_json` text NOT NULL,
  `tmt` date DEFAULT NULL,
  `tukin` int(11) DEFAULT NULL,
  `tmt_pengembalian` date DEFAULT NULL,
  `jabatan_setelah_diturunkan` varchar(255) DEFAULT NULL,
  `keputusan` int(11) NOT NULL,
  `dugaan_pelanggaran` varchar(255) NOT NULL,
  `tanggal_pelanggaran` date DEFAULT NULL,
  `tanggal_ditetapkan` date NOT NULL,
  `tempat_ditetapkan` varchar(255) NOT NULL,
  `nama_pejabat` varchar(255) NOT NULL,
  `nip_pejabat` varchar(20) NOT NULL,
  `jabatan_pejabat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kephukdis`
--

INSERT INTO `tbl_kephukdis` (`id`, `kasus_id`, `pelanggaran_id`, `hukdis_id`, `nomor`, `terlapor`, `terlapor_json`, `tmt`, `tukin`, `tmt_pengembalian`, `jabatan_setelah_diturunkan`, `keputusan`, `dugaan_pelanggaran`, `tanggal_pelanggaran`, `tanggal_ditetapkan`, `tempat_ditetapkan`, `nama_pejabat`, `nip_pejabat`, `jabatan_pejabat`, `created_at`, `updated_at`) VALUES
(6, 6, 56, 7, '002/II/HK/2023', '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengembang sistem informasi\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '2023-04-01', NULL, NULL, 'Staff', 2, 'Menyebarkan hoax', '2023-01-03', '2023-03-03', 'Semarang', 'Prof. Dr. S Martono, M.Si.', '196603081989011001', 'Rektor', '2023-02-09 16:18:20', '2023-02-09 18:46:42'),
(7, 5, 49, 3, '001/II/HK/2023', '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengembang sistem informasi\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', NULL, NULL, NULL, NULL, 1, 'Kode etik ASN', '2023-02-12', '2023-02-10', 'Jakarta', 'Dyah Ismayani', '000000000000000000', 'Kepala Biro SDM', '2023-02-09 18:48:07', '2023-02-09 18:48:53'),
(10, 7, 1, 2, '003/II/HK/2023', '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengolah Data Kepegawaian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', NULL, NULL, NULL, NULL, 1, 'Kode etik ASN', '2023-03-30', '2023-03-31', 'Jakarta', 'Prof. Dr. S Martono, M.Si.', '196603081989011001', 'Rektor', '2023-03-12 09:40:50', '2023-03-12 09:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kl`
--

CREATE TABLE `tbl_kl` (
  `id` int(11) NOT NULL,
  `jenis` int(11) NOT NULL,
  `pasal` varchar(4) NOT NULL,
  `huruf` varchar(4) NOT NULL,
  `angka` varchar(4) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kl`
--

INSERT INTO `tbl_kl` (`id`, `jenis`, `pasal`, `huruf`, `angka`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, '3', 'a', '', 'Setia dan taat sepenuhnya kepada Pancasila, Undang-Undang Dasar Negara Republik Indonesia Tahun 1945, Negara Kesatuan Republik Indonesia, dan Pemerintah', NULL, NULL),
(2, 1, '3', 'b', '', 'Menjaga persatuan dan kesatuan bangsa', NULL, NULL),
(3, 1, '3', 'c', '', 'Melaksanakan kebijakan yang ditetapkan oleh pejabat pemerintah yang berwenang', NULL, NULL),
(4, 1, '3', 'd', '', 'Menaati ketentuan perundang-undangan', NULL, NULL),
(5, 1, '3', 'e', '', 'Melaksanakan tugas kedinasan dengan penuh pengabdian, kejujuran, kesadaran, dan tanggung jawab', NULL, NULL),
(6, 1, '3', 'f', '', 'Menunjukkan integritas dan keteladanan dalam sikap, perilaku, ucapan, dan tindakan kepada setiap orang, baik di dalam maupun di luar kedinasan', NULL, NULL),
(7, 1, '3', 'g', '', 'Menyimpan rahasia jabatan dan hanya dapat mengemukakan rahasia jabatan sesuai dengan ketentuan perundang-undangan', NULL, NULL),
(8, 1, '3', 'h', '', 'Bersedia ditempatkan di seluruh wilayah Negara Kesatuan Republik Indonesia', NULL, NULL),
(9, 1, '4', 'a', '', 'Menghadiri dan mengucapkan sumpah/janji PNS', NULL, NULL),
(10, 1, '4', 'b', '', 'Menghadiri dan mengucapkan sumpah/janji jabatan', NULL, NULL),
(11, 1, '4', 'c', '', 'Mengutamakan kepentingan negara daripada kepentingan pribadi, seseorang, dan/atau golongan', NULL, NULL),
(12, 1, '4', 'd', '', 'Melaporkan dengan segera kepada atasannya apabila mengetahui ada hal yang dapat membahayakan keamanan negara atau merugikan keuangan negara', NULL, NULL),
(13, 1, '4', 'e', '', 'Melaporkan harta kekayaan kepada pejabat yang berwenang sesuai dengan ketentuan perundang-undangan', NULL, NULL),
(14, 1, '4', 'f', '', 'Masuk Kerja dan menaati ketentuan jam kerja\r\n', NULL, NULL),
(15, 1, '4', 'g', '', 'Menggunakan dan memelihara barang milik negara dengan sebaik-baiknya', NULL, NULL),
(16, 1, '4', 'h', '', 'Memberikan kesempatan kepada bawahan untuk mengembangkan kompetensi', NULL, NULL),
(17, 1, '4', 'i', '', 'Menolak segala bentuk pemberian yang berkaitan dengan tugas dan fungsi kecuali penghasilan sesuai dengan ketentuan peraturan perundang-undangan', NULL, NULL),
(18, 2, '5', 'a', '', 'Menyalahgunakan wewenang', NULL, NULL),
(19, 2, '5', 'b', '', 'Menjadi perantara untuk mendapatkan keuntungan pribadi dan/atau orang lain dengan menggunakan kewenangan orang lain yang diduga terjadi konflik kepentingan dengan jabatan', NULL, NULL),
(20, 2, '5', 'c', '', 'Menjadi pegawai atau bekerja untuk negara lain', NULL, NULL),
(21, 2, '5', 'd', '', 'Bekerja pada lembaga atau organisasi internasional tanpa izin atau tanpa ditugaskan oleh Pejabat Pembina Kepegawaian', NULL, NULL),
(22, 2, '5', 'e', '', 'Bekerja pada perusahaan asing, konsultan asing, atau lembaga swadaya masyarakat asing kecuali ditugaskan oleh Pejabat Pembina Kepegawaian', NULL, NULL),
(23, 2, '5', 'f', '', 'Memiliki, menjual, membeli, menggadaikan, menyewakan, atau meminjamkan barang baik bergerak atau tidak bergerak, dokumen, atau surat berharga milik negara secara tidak sah', NULL, NULL),
(24, 2, '5', 'g', '', 'Melakukan pungutan di luar ketentuan', NULL, NULL),
(25, 2, '5', 'h', '', 'Melakukan kegiatan yang merugikan negara', NULL, NULL),
(26, 2, '5', 'i', '', 'Bertindak sewenang-wenang terhadap bawahan', NULL, NULL),
(27, 2, '5', 'j', '', 'Menghalangi berjalannya tugas kedinasan', NULL, NULL),
(28, 2, '5', 'k', '', 'Menerima hadiah yang berhubungan dengan jabatan dan/atau pekerjaan', NULL, NULL),
(29, 2, '5', 'l', '', 'Meminta sesuatu yang berhubungan dengan jabatan', NULL, NULL),
(30, 2, '5', 'm', '', 'Melakukan tindakan atau tidak melakukan tindakan yang dapat mengakibatkan kerugian bagi yang dilayani', NULL, NULL),
(31, 2, '5', 'n', '1', 'Memberikan dukungan kepada calon Presiden/Wakil Presiden, calon Kepala Daerah/Wakil Kepala Daerah, calon anggota Dewan Perwakilan Rakyat, calon anggota Dewan Perwakilan Daerah, atau calon anggota Dewan Perwakilan Rakyat Daerah; dengan cara: Ikut kampanye', NULL, NULL),
(32, 2, '5', 'n', '2', 'Memberikan dukungan kepada calon Presiden/Wakil Presiden, calon Kepala Daerah/Wakil Kepala Daerah, calon anggota Dewan Perwakilan Rakyat, calon anggota Dewan Perwakilan Daerah, atau calon anggota Dewan Perwakilan Rakyat Daerah; dengan cara: Menjadi peserta kampanye dengan menggunakan atribut partai atau atribut PNS', NULL, NULL),
(33, 2, '5', 'n', '3', 'Memberikan dukungan kepada calon Presiden/Wakil Presiden, calon Kepala Daerah/Wakil Kepala Daerah, calon anggota Dewan Perwakilan Rakyat, calon anggota Dewan Perwakilan Daerah, atau calon anggota Dewan Perwakilan Rakyat Daerah; dengan cara: Sebagai peserta kampanye dengan mengerahkan PNS lain', NULL, NULL),
(34, 2, '5', 'n', '4', 'Memberikan dukungan kepada calon Presiden/Wakil Presiden, calon Kepala Daerah/Wakil Kepala Daerah, calon anggota Dewan Perwakilan Rakyat, calon anggota Dewan Perwakilan Daerah, atau calon anggota Dewan Perwakilan Rakyat Daerah; dengan cara: Sebagai peserta kampanye dengan menggunakan fasilitas negara', NULL, NULL),
(35, 2, '5', 'n', '5', 'Memberikan dukungan kepada calon Presiden/Wakil Presiden, calon Kepala Daerah/Wakil Kepala Daerah, calon anggota Dewan Perwakilan Rakyat, calon anggota Dewan Perwakilan Daerah, atau calon anggota Dewan Perwakilan Rakyat Daerah; dengan cara: Membuat keputusan dan/atau tindakan yang menguntungkan atau merugikan salah satu pasangan calon sebelum, selama, dan sesudah masa kampanye', NULL, NULL),
(36, 2, '5', 'n', '6', 'Memberikan dukungan kepada calon Presiden/Wakil Presiden, calon Kepala Daerah/Wakil Kepala Daerah, calon anggota Dewan Perwakilan Rakyat, calon anggota Dewan Perwakilan Daerah, atau calon anggota Dewan Perwakilan Rakyat Daerah; dengan cara: Mengadakan kegiatan yang mengarah kepada keberpihakan terhadap pasangan calon yang menjadi peserta pemilu sebelum, selama, dan sesudah masa kampanye meliputi pertemuan, ajakan, himbauan, seruan, atau pemberian barang kepada PNS dalam lingkungan unit kerjanya, anggota keluarga, dan masyarakat', NULL, NULL),
(37, 2, '5', 'n', '7', 'Memberikan dukungan kepada calon Presiden/Wakil Presiden, calon Kepala Daerah/Wakil Kepala Daerah, calon anggota Dewan Perwakilan Rakyat, calon anggota Dewan Perwakilan Daerah, atau calon anggota Dewan Perwakilan Rakyat Daerah; dengan cara: Memberikan surat dukungan disertai fotokopi Kartu Tanda Penduduk atau Surat Keterangan Tanda Penduduk', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kpts`
--

CREATE TABLE `tbl_kpts` (
  `id` int(11) NOT NULL,
  `kasus_id` int(11) NOT NULL,
  `pelanggaran_id` int(11) NOT NULL,
  `terlapor` varchar(255) NOT NULL,
  `terlapor_json` text NOT NULL,
  `keputusan` int(11) NOT NULL,
  `tanggal_ditetapkan` date NOT NULL,
  `tempat_ditetapkan` varchar(255) NOT NULL,
  `atasan` varchar(255) NOT NULL,
  `atasan_json` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_kpts`
--

INSERT INTO `tbl_kpts` (`id`, `kasus_id`, `pelanggaran_id`, `terlapor`, `terlapor_json`, `keputusan`, `tanggal_ditetapkan`, `tempat_ditetapkan`, `atasan`, `atasan_json`, `created_at`, `updated_at`) VALUES
(3, 5, 49, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengembang sistem informasi\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', 1, '2023-02-24', 'Jakarta', '132308158', '{\"nama\":\"SITI MURSIDAH, S.Pd., M.Si.\",\"nip\":\"197710262005022001\",\"pangkat\":\"IV\\/a - Pembina\",\"jabatan\":\"Koordinator Bagian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN\"}', '2023-02-09 07:22:35', '2023-02-09 07:25:49'),
(4, 6, 56, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengembang sistem informasi\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', 2, '2023-02-24', 'Semarang', '132308158', '{\"nama\":\"SITI MURSIDAH, S.Pd., M.Si.\",\"nip\":\"197710262005022001\",\"pangkat\":\"IV\\/a - Pembina\",\"jabatan\":\"Koordinator Bagian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN\"}', '2023-02-09 16:16:57', '2023-02-09 16:16:57'),
(5, 7, 1, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengolah Data Kepegawaian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', 1, '2023-03-22', 'Jakarta', '132308158', '{\"nama\":\"SITI MURSIDAH, S.Pd., M.Si.\",\"nip\":\"197710262005022001\",\"pangkat\":\"IV\\/a - Pembina\",\"jabatan\":\"Koordinator Bagian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN\"}', '2023-03-12 09:20:03', '2023-03-12 09:20:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lhp`
--

CREATE TABLE `tbl_lhp` (
  `id` int(11) NOT NULL,
  `kasus_id` int(11) NOT NULL,
  `pelanggaran_id` int(11) NOT NULL,
  `hukdis_id` int(11) NOT NULL,
  `terlapor` varchar(255) NOT NULL,
  `terlapor_json` text NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tempat_surat` varchar(255) NOT NULL,
  `penerima_surat` varchar(255) NOT NULL,
  `penerima_surat_json` text NOT NULL,
  `tempat_penerima_surat` varchar(255) NOT NULL,
  `tanggal_pemeriksaan` date NOT NULL,
  `pelapor` varchar(255) NOT NULL,
  `pelapor_json` text NOT NULL,
  `status_pelapor` int(11) NOT NULL,
  `laporan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_lhp`
--

INSERT INTO `tbl_lhp` (`id`, `kasus_id`, `pelanggaran_id`, `hukdis_id`, `terlapor`, `terlapor_json`, `tanggal_surat`, `tempat_surat`, `penerima_surat`, `penerima_surat_json`, `tempat_penerima_surat`, `tanggal_pemeriksaan`, `pelapor`, `pelapor_json`, `status_pelapor`, `laporan`, `created_at`, `updated_at`) VALUES
(2, 5, 49, 3, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengembang sistem informasi\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '2023-02-24', 'Semarang', '132094313', '{\"nama\":\"WIDI WIDAYAT, S. Pd.\",\"nip\":\"196803011995071001\",\"pangkat\":\"IV\\/b - Pembina Tk. I\",\"jabatan\":\"Kepala Biro Umum Hukum dan Kepegawaian\",\"unit\":\"UNNES - BUHK\"}', 'Semarang', '2023-02-23', '132308158', '{\"nama\":\"SITI MURSIDAH, S.Pd., M.Si.\",\"nip\":\"197710262005022001\",\"pangkat\":\"IV\\/a - Pembina\",\"jabatan\":\"Koordinator Bagian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN\"}', 2, '', '2023-02-09 06:25:29', '2023-02-09 06:25:29'),
(3, 6, 56, 3, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengembang sistem informasi\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '2023-02-24', 'Semarang', '131813655', '{\"nama\":\"Prof. Dr. S Martono, M.Si.\",\"nip\":\"196603081989011001\",\"pangkat\":\"IV\\/c - Pembina Utama Muda\",\"jabatan\":\"Profesor (Rektor)\",\"unit\":\"UNNES - FE-Manajemen\"}', 'Semarang', '2023-02-23', '132308158', '{\"nama\":\"SITI MURSIDAH, S.Pd., M.Si.\",\"nip\":\"197710262005022001\",\"pangkat\":\"IV\\/a - Pembina\",\"jabatan\":\"Koordinator Bagian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN\"}', 1, '', '2023-02-09 16:16:22', '2023-02-09 16:16:22'),
(4, 7, 1, 2, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengolah Data Kepegawaian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '2023-03-21', 'Semarang', '132094313', '{\"nama\":\"WIDI WIDAYAT, S. Pd.\",\"nip\":\"196803011995071001\",\"pangkat\":\"IV\\/b - Pembina Tk. I\",\"jabatan\":\"Kepala Biro Umum Hukum dan Kepegawaian\",\"unit\":\"UNNES - BUHK\"}', 'Semarang', '2023-03-17', '132308158', '{\"nama\":\"SITI MURSIDAH, S.Pd., M.Si.\",\"nip\":\"197710262005022001\",\"pangkat\":\"IV\\/a - Pembina\",\"jabatan\":\"Koordinator Bagian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN\"}', 1, '', '2023-03-12 09:06:59', '2023-03-12 09:06:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggaran`
--

CREATE TABLE `tbl_pelanggaran` (
  `id` int(11) NOT NULL,
  `kl_id` int(11) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pelanggaran`
--

INSERT INTO `tbl_pelanggaran` (`id`, `kl_id`, `jenis_id`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Berdampak negatif pada unit kerja, instansi, dan/atau negara', NULL, NULL),
(2, 2, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(3, 2, 3, 'Berdampak negatif pada negara', NULL, NULL),
(4, 3, 1, 'Berdampak negatif pada unit kerja', NULL, NULL),
(5, 3, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(6, 3, 3, 'Berdampak negatif pada negara', NULL, NULL),
(7, 4, 1, 'Berdampak negatif pada unit kerja', NULL, NULL),
(8, 4, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(9, 4, 3, 'Berdampak negatif pada negara', NULL, NULL),
(10, 5, 1, 'Berdampak negatif pada unit kerja', NULL, NULL),
(11, 5, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(12, 5, 3, 'Berdampak negatif pada negara', NULL, NULL),
(13, 6, 1, 'Berdampak negatif pada unit kerja', NULL, NULL),
(14, 6, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(15, 6, 3, 'Berdampak negatif pada negara', NULL, NULL),
(16, 7, 1, 'Berdampak negatif pada unit kerja', NULL, NULL),
(17, 7, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(18, 7, 3, 'Berdampak negatif pada negara', NULL, NULL),
(19, 8, 1, 'Berdampak negatif pada unit kerja', NULL, NULL),
(20, 8, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(21, 8, 3, 'Berdampak negatif pada negara', NULL, NULL),
(22, 9, 2, 'Tanpa alasan yang sah', NULL, NULL),
(23, 10, 2, 'Tanpa alasan yang sah', NULL, NULL),
(24, 11, 1, 'Berdampak negatif pada unit kerja', NULL, NULL),
(25, 11, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(26, 11, 3, 'Berdampak negatif pada negara dan/atau pemerintah', NULL, NULL),
(27, 12, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(28, 12, 3, 'Berdampak negatif pada negara dan/atau pemerintah', NULL, NULL),
(29, 13, 2, 'Dilakukan pejabat administrator dan pejabat fungsional', NULL, NULL),
(30, 13, 3, 'Dilakukan pejabat pimpinan tinggi dan pejabat lainnya', NULL, NULL),
(31, 14, 1, 'Tidak masuk kerja tanpa alasan yang sah secara kumulatif selama 3 hari kerja dalam 1 tahun', NULL, NULL),
(32, 14, 1, 'Tidak masuk kerja tanpa alasan yang sah secara kumulatif selama 4-6 hari kerja dalam 1 tahun', NULL, NULL),
(33, 14, 1, 'Tidak masuk kerja tanpa alasan yang sah secara kumulatif selama 7-10 hari kerja dalam 1 tahun', NULL, NULL),
(34, 14, 2, 'Tidak masuk kerja tanpa alasan yang sah secara kumulatif selama 11-13 hari kerja dalam 1 tahun', NULL, NULL),
(35, 14, 2, 'Tidak masuk kerja tanpa alasan yang sah secara kumulatif selama 14-16 hari kerja dalam 1 tahun', NULL, NULL),
(36, 14, 2, 'Tidak masuk kerja tanpa alasan yang sah secara kumulatif selama 17-20 hari kerja dalam 1 tahun', NULL, NULL),
(37, 14, 3, 'Tidak masuk kerja tanpa alasan yang sah secara kumulatif selama 21-24 hari kerja dalam 1 tahun', NULL, NULL),
(38, 14, 3, 'Tidak masuk kerja tanpa alasan yang sah secara kumulatif selama 25-27 hari kerja dalam 1 tahun', NULL, NULL),
(39, 14, 3, 'Tidak masuk kerja tanpa alasan yang sah secara kumulatif selama 28 hari kerja atau lebih dalam 1 tahun', NULL, NULL),
(40, 14, 3, 'Tidak masuk kerja tanpa alasan yang sah secara terus-menerus selama 10 hari kerja', NULL, NULL),
(41, 15, 1, 'Berdampak negatif pada unit kerja', NULL, NULL),
(42, 15, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(43, 16, 1, 'Berdampak negatif pada unit kerja', NULL, NULL),
(44, 16, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(45, 17, 3, NULL, NULL, NULL),
(46, 18, 3, NULL, NULL, NULL),
(47, 19, 3, NULL, NULL, NULL),
(48, 20, 3, NULL, NULL, NULL),
(49, 21, 3, NULL, NULL, NULL),
(50, 22, 3, NULL, NULL, NULL),
(51, 23, 1, 'Berdampak negatif pada unit kerja', NULL, NULL),
(52, 23, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(53, 23, 3, 'Berdampak negatif pada negara dan/atau pemerintah', NULL, NULL),
(54, 24, 2, 'Berdampak negatif pada unit kerja dan/atau instansi', NULL, NULL),
(55, 24, 3, 'Berdampak negatif pada negara dan/atau pemerintah', NULL, NULL),
(56, 25, 1, 'Berdampak negatif pada unit kerja', NULL, NULL),
(57, 25, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(58, 26, 1, 'Berdampak negatif pada unit kerja', NULL, NULL),
(59, 26, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(60, 27, 1, 'Berdampak negatif pada unit kerja', NULL, NULL),
(61, 27, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(62, 28, 3, NULL, NULL, NULL),
(63, 29, 3, NULL, NULL, NULL),
(64, 30, 2, 'Berdampak negatif pada instansi', NULL, NULL),
(65, 32, 2, NULL, NULL, NULL),
(66, 33, 3, NULL, NULL, NULL),
(67, 34, 3, NULL, NULL, NULL),
(68, 35, 3, NULL, NULL, NULL),
(69, 36, 3, NULL, NULL, NULL),
(70, 37, 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_spmk`
--

CREATE TABLE `tbl_spmk` (
  `id` int(11) NOT NULL,
  `kasus_id` int(11) NOT NULL,
  `pelanggaran_id` int(11) NOT NULL,
  `hukdis_id` int(11) NOT NULL,
  `terlapor` varchar(255) NOT NULL,
  `terlapor_json` text NOT NULL,
  `tanggal_surat` date NOT NULL,
  `tempat_surat` varchar(255) NOT NULL,
  `tempat_penerima_surat` varchar(255) NOT NULL,
  `menghadap_kepada` varchar(255) NOT NULL,
  `menghadap_kepada_json` text NOT NULL,
  `tanggal_menghadap` date NOT NULL,
  `jam_menghadap` time NOT NULL,
  `tempat_menghadap` varchar(255) NOT NULL,
  `atasan` varchar(255) NOT NULL,
  `atasan_json` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_spmk`
--

INSERT INTO `tbl_spmk` (`id`, `kasus_id`, `pelanggaran_id`, `hukdis_id`, `terlapor`, `terlapor_json`, `tanggal_surat`, `tempat_surat`, `tempat_penerima_surat`, `menghadap_kepada`, `menghadap_kepada_json`, `tanggal_menghadap`, `jam_menghadap`, `tempat_menghadap`, `atasan`, `atasan_json`, `created_at`, `updated_at`) VALUES
(3, 5, 49, 8, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengembang sistem informasi\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '2023-03-11', 'Semarang', 'Semarang', '132308158', '{\"nama\":\"SITI MURSIDAH, S.Pd., M.Si.\",\"nip\":\"197710262005022001\",\"pangkat\":\"IV\\/a - Pembina\",\"jabatan\":\"Koordinator Bagian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN\"}', '2023-03-13', '10:00:00', 'Gedung H Rektorat', '132308158', '{\"nama\":\"SITI MURSIDAH, S.Pd., M.Si.\",\"nip\":\"197710262005022001\",\"pangkat\":\"IV\\/a - Pembina\",\"jabatan\":\"Koordinator Bagian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN\"}', '2023-02-09 15:36:22', '2023-02-09 15:40:49'),
(4, 6, 56, 3, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengembang sistem informasi\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '2023-03-06', 'Semarang', 'Semarang', '132094313', '{\"nama\":\"WIDI WIDAYAT, S. Pd.\",\"nip\":\"196803011995071001\",\"pangkat\":\"IV\\/b - Pembina Tk. I\",\"jabatan\":\"Kepala Biro Umum Hukum dan Kepegawaian\",\"unit\":\"UNNES - BUHK\"}', '2023-03-07', '14:30:00', 'Gedung H Rektorat', '132308158', '{\"nama\":\"SITI MURSIDAH, S.Pd., M.Si.\",\"nip\":\"197710262005022001\",\"pangkat\":\"IV\\/a - Pembina\",\"jabatan\":\"Koordinator Bagian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN\"}', '2023-02-09 16:19:09', '2023-02-09 16:19:09'),
(5, 7, 1, 2, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengolah Data Kepegawaian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '2023-04-03', 'Semarang', 'Semarang', '132094313', '{\"nama\":\"WIDI WIDAYAT, S. Pd.\",\"nip\":\"196803011995071001\",\"pangkat\":\"IV\\/b - Pembina Tk. I\",\"jabatan\":\"Kepala Biro Umum Hukum dan Kepegawaian\",\"unit\":\"UNNES - BUHK\"}', '2023-04-01', '11:00:00', 'Gedung H Rektorat', '132308158', '{\"nama\":\"SITI MURSIDAH, S.Pd., M.Si.\",\"nip\":\"197710262005022001\",\"pangkat\":\"IV\\/a - Pembina\",\"jabatan\":\"Koordinator Bagian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN\"}', '2023-03-12 09:46:14', '2023-03-12 09:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_panggilan`
--

CREATE TABLE `tbl_surat_panggilan` (
  `id` int(11) NOT NULL,
  `kasus_id` int(11) NOT NULL,
  `panggilan` int(11) NOT NULL,
  `terlapor` varchar(255) NOT NULL,
  `terlapor_json` text NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `menghadap_kepada` varchar(255) NOT NULL,
  `menghadap_kepada_json` text NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `pelanggaran` text NOT NULL,
  `status_atasan` int(11) NOT NULL,
  `atasan` varchar(255) NOT NULL,
  `atasan_json` text NOT NULL,
  `tanggal_surat` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_surat_panggilan`
--

INSERT INTO `tbl_surat_panggilan` (`id`, `kasus_id`, `panggilan`, `terlapor`, `terlapor_json`, `nomor`, `menghadap_kepada`, `menghadap_kepada_json`, `tanggal`, `jam`, `tempat`, `status`, `pelanggaran`, `status_atasan`, `atasan`, `atasan_json`, `tanggal_surat`, `created_at`, `updated_at`) VALUES
(7, 4, 1, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengembang sistem informasi\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '', '132094313', '{\"nama\":\"WIDI WIDAYAT, S. Pd.\",\"nip\":\"196803011995071001\",\"pangkat\":\"IV\\/b - Pembina Tk. I\",\"jabatan\":\"Kepala Biro Umum Hukum dan Kepegawaian\",\"unit\":\"UNNES - BUHK\"}', '2022-12-01', '10:55:00', 'Ruang Kepala BUHK', 1, 'Kode etik ASN', 1, '132094313', '{\"nama\":\"WIDI WIDAYAT, S. Pd.\",\"nip\":\"196803011995071001\",\"pangkat\":\"IV\\/b - Pembina Tk. I\",\"jabatan\":\"Kepala Biro Umum Hukum dan Kepegawaian\",\"unit\":\"UNNES - BUHK\"}', '2022-11-28', '2022-11-30 16:34:18', '2022-11-30 16:57:49'),
(9, 3, 1, '130935363', '{\"nama\":\"Dra. ENDANG RETNO WINARTI, M. Pd.\",\"nip\":\"195909191981032003\",\"pangkat\":\"IV\\/b - Pembina Tk. I\",\"jabatan\":\"Lektor Kepala\",\"unit\":\"UNNES - FMIPA-Pendidikan Matematika\"}', '', '130815346', '{\"nama\":\"Prof. Dr. Kartono, M. Si.\",\"nip\":\"195602221980031002\",\"pangkat\":\"IV\\/d - Pembina Utama Madya\",\"jabatan\":\"Profesor (Ketua Program Studi S2)\",\"unit\":\"UNNES - FMIPA-Pendidikan Matematika\"}', '2023-01-18', '12:00:00', 'Rektorat', 1, 'Orasek', 1, '130815346', '{\"nama\":\"Prof. Dr. Kartono, M. Si.\",\"nip\":\"195602221980031002\",\"pangkat\":\"IV\\/d - Pembina Utama Madya\",\"jabatan\":\"Profesor (Ketua Program Studi S2)\",\"unit\":\"UNNES - FMIPA-Pendidikan Matematika\"}', '2023-01-14', '2023-01-13 18:19:41', '2023-01-13 18:19:41'),
(10, 4, 2, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengembang sistem informasi\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '', '132094313', '{\"nama\":\"WIDI WIDAYAT, S. Pd.\",\"nip\":\"196803011995071001\",\"pangkat\":\"IV\\/b - Pembina Tk. I\",\"jabatan\":\"Kepala Biro Umum Hukum dan Kepegawaian\",\"unit\":\"UNNES - BUHK\"}', '2023-01-21', '13:00:00', 'Ruang Kepala BUHK', 2, 'Kode etik ASN', 1, '132094313', '{\"nama\":\"WIDI WIDAYAT, S. Pd.\",\"nip\":\"196803011995071001\",\"pangkat\":\"IV\\/b - Pembina Tk. I\",\"jabatan\":\"Kepala Biro Umum Hukum dan Kepegawaian\",\"unit\":\"UNNES - BUHK\"}', '2023-01-14', '2023-01-13 20:21:03', '2023-01-13 20:21:03'),
(12, 5, 1, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengembang sistem informasi\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '', '132308158', '{\"nama\":\"SITI MURSIDAH, S.Pd., M.Si.\",\"nip\":\"197710262005022001\",\"pangkat\":\"IV\\/a - Pembina\",\"jabatan\":\"Koordinator Bagian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN\"}', '2023-02-23', '09:00:00', 'Gedung H Rektorat', 1, 'Kode etik ASN', 1, '132308158', '{\"nama\":\"SITI MURSIDAH, S.Pd., M.Si.\",\"nip\":\"197710262005022001\",\"pangkat\":\"IV\\/a - Pembina\",\"jabatan\":\"Koordinator Bagian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN\"}', '2023-02-09', '2023-02-09 02:18:49', '2023-02-09 02:18:49'),
(13, 6, 1, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengolah Data Kepegawaian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '001/SP/I/2023', '132094313', '{\"nama\":\"WIDI WIDAYAT, S. Pd.\",\"nip\":\"196803011995071001\",\"pangkat\":\"IV\\/b - Pembina Tk. I\",\"jabatan\":\"Kepala Biro Umum Hukum dan Kepegawaian\",\"unit\":\"UNNES - BUHK\"}', '2023-02-24', '14:00:00', 'Ruang Kepala BUHK', 1, 'Hoax', 1, '132308158', '{\"nama\":\"SITI MURSIDAH, S.Pd., M.Si.\",\"nip\":\"197710262005022001\",\"pangkat\":\"IV\\/a - Pembina\",\"jabatan\":\"Koordinator Bagian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN\"}', '2023-02-09', '2023-02-09 16:12:03', '2023-02-13 16:15:18'),
(16, 7, 1, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengolah Data Kepegawaian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '003/SP/I/2023', '132094313', '{\"nama\":\"WIDI WIDAYAT, S. Pd.\",\"nip\":\"196803011995071001\",\"pangkat\":\"IV\\/b - Pembina Tk. I\",\"jabatan\":\"Kepala Biro Umum Hukum dan Kepegawaian\",\"unit\":\"UNNES - BUHK\"}', '2023-03-17', '10:00:00', 'Ruang Kepala BUHK', 1, 'Kode etik ASN', 1, '132308158', '{\"nama\":\"SITI MURSIDAH, S.Pd., M.Si.\",\"nip\":\"197710262005022001\",\"pangkat\":\"IV\\/a - Pembina\",\"jabatan\":\"Koordinator Bagian\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN\"}', '2023-03-13', '2023-03-12 08:45:18', '2023-03-12 08:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tembusan`
--

CREATE TABLE `tbl_tembusan` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tembusan`
--

INSERT INTO `tbl_tembusan` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Rektor UNNES', NULL, NULL),
(2, 'Wakil Rektor Bid. Akademik UNNES', NULL, NULL),
(3, 'Wakil Rektor Bid. Umum dan Keuangan UNNES', NULL, NULL),
(4, 'Wakil Rektor Bid. Kemahasiswaan UNNES', NULL, NULL),
(5, 'Wakil Rektor Bid. Perencanaan dan Kerja Sama UNNES', NULL, NULL),
(6, 'Kepala BAKK UNNES', NULL, NULL),
(7, 'Kepala BUHK UNNES', NULL, NULL),
(8, 'Kepala BPK UNNES', NULL, NULL),
(9, 'Dekan FIP UNNES', NULL, NULL),
(10, 'Dekan FBS UNNES', NULL, NULL),
(11, 'Dekan FIS UNNES', NULL, NULL),
(12, 'Dekan FMIPA UNNES', NULL, NULL),
(13, 'Dekan FT UNNES', NULL, NULL),
(14, 'Dekan FIK UNNES', NULL, NULL),
(15, 'Dekan FE UNNES', NULL, NULL),
(16, 'Dekan FH UNNES', NULL, NULL),
(17, 'Ketua Majelis Wali Amanat UNNES', '2023-03-12 08:36:45', '2023-03-12 08:36:45'),
(18, 'Deputi Bidang Sistem Informasi Kepegawaian Badan Kepegawaian Negara di Jakarta', '2023-03-12 09:26:27', '2023-03-12 09:26:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tembusan_surat`
--

CREATE TABLE `tbl_tembusan_surat` (
  `id` int(11) NOT NULL,
  `tembusan_id` int(11) NOT NULL,
  `table_id` int(11) NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tembusan_surat`
--

INSERT INTO `tbl_tembusan_surat` (`id`, `tembusan_id`, `table_id`, `table_name`, `created_at`, `updated_at`) VALUES
(6, 17, 16, 'tbl_surat_panggilan', '2023-03-12 08:58:55', '2023-03-12 08:58:55'),
(7, 1, 16, 'tbl_surat_panggilan', '2023-03-12 08:58:55', '2023-03-12 08:58:55'),
(12, 1, 4, 'tbl_lhp', '2023-03-12 09:08:48', '2023-03-12 09:08:48'),
(13, 3, 4, 'tbl_lhp', '2023-03-12 09:08:48', '2023-03-12 09:08:48'),
(16, 1, 5, 'tbl_kpts', '2023-03-12 09:20:11', '2023-03-12 09:20:11'),
(17, 3, 5, 'tbl_kpts', '2023-03-12 09:20:11', '2023-03-12 09:20:11'),
(20, 1, 10, 'tbl_kephukdis', '2023-03-12 09:40:57', '2023-03-12 09:40:57'),
(21, 18, 10, 'tbl_kephukdis', '2023-03-12 09:40:57', '2023-03-12 09:40:57'),
(23, 1, 5, 'tbl_spmk', '2023-03-12 09:46:22', '2023-03-12 09:46:22'),
(24, 3, 5, 'tbl_spmk', '2023-03-12 09:46:22', '2023-03-12 09:46:22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tim_pemeriksa`
--

CREATE TABLE `tbl_tim_pemeriksa` (
  `id` int(11) NOT NULL,
  `bap_id` int(11) NOT NULL,
  `pemeriksa` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_tim_pemeriksa`
--

INSERT INTO `tbl_tim_pemeriksa` (`id`, `bap_id`, `pemeriksa`, `created_at`, `updated_at`) VALUES
(8, 6, '132308402', '2022-09-03 03:41:02', '2022-09-03 03:41:02'),
(9, 6, '132308158', '2022-09-03 03:41:02', '2022-09-03 03:41:02'),
(10, 7, '130815346', '2023-01-13 20:11:36', '2023-01-13 20:11:36'),
(11, 8, '132094313', '2023-01-13 20:22:39', '2023-01-13 20:22:39'),
(12, 8, '132308158', '2023-01-13 20:22:39', '2023-01-13 20:22:39'),
(13, 8, '132318267', '2023-01-13 20:22:39', '2023-01-13 20:22:39'),
(17, 9, '132308158', '2023-02-09 02:28:48', '2023-02-09 02:28:48'),
(18, 9, '132318267', '2023-02-09 02:28:48', '2023-02-09 02:28:48'),
(19, 10, '132308158', '2023-02-09 16:13:23', '2023-02-09 16:13:23'),
(20, 11, '132308158', '2023-03-12 09:02:19', '2023-03-12 09:02:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `access_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `last_visit` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `access_token`, `avatar`, `status`, `last_visit`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'admin@admin.com', 'admin@admin.com', NULL, '$2y$10$DdFLeYLynqwb9FG89JY3v.FgGke7LAiAOVjXEBEHdRFm/WXkylxdu', NULL, 'uHRwq9JVxwNXwSHY8mDhgMBvM8TwSZBnbZ8EvfXu', NULL, 1, '2023-03-12 08:14:38', '2022-07-03 19:34:41', '2023-03-12 08:14:38');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `provider_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_attributes`
--

CREATE TABLE `user_attributes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `birthdate` date NOT NULL,
  `gender` varchar(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dial_code` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_avatars`
--

CREATE TABLE `user_avatars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE `visitors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `browser` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `platform` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `user_id`, `ip_address`, `device`, `browser`, `platform`, `location`, `created_at`, `updated_at`) VALUES
(1, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 88.0.4412\",\"family\":\"Opera\",\"version\":\"88.0.4412\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-07-03 19:35:52', '2022-07-03 19:35:52'),
(2, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 88.0.4412\",\"family\":\"Opera\",\"version\":\"88.0.4412\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-07-07 01:30:17', '2022-07-07 01:30:17'),
(3, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 88.0.4412\",\"family\":\"Opera\",\"version\":\"88.0.4412\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-07-07 01:30:36', '2022-07-07 01:30:36'),
(4, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 88.0.4412\",\"family\":\"Opera\",\"version\":\"88.0.4412\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-07-12 04:03:10', '2022-07-12 04:03:10'),
(5, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 88.0.4412\",\"family\":\"Opera\",\"version\":\"88.0.4412\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-07-14 01:31:24', '2022-07-14 01:31:24'),
(6, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 89.0.4447\",\"family\":\"Opera\",\"version\":\"89.0.4447\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-08-01 00:36:17', '2022-08-01 00:36:17'),
(7, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 89.0.4447\",\"family\":\"Opera\",\"version\":\"89.0.4447\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-08-01 03:47:16', '2022-08-01 03:47:16'),
(8, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 89.0.4447\",\"family\":\"Opera\",\"version\":\"89.0.4447\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-08-03 01:09:45', '2022-08-03 01:09:45'),
(9, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 89.0.4447\",\"family\":\"Opera\",\"version\":\"89.0.4447\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-08-04 00:52:34', '2022-08-04 00:52:34'),
(10, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 89.0.4447\",\"family\":\"Opera\",\"version\":\"89.0.4447\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-08-08 02:08:49', '2022-08-08 02:08:49'),
(11, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 90.0.4480\",\"family\":\"Opera\",\"version\":\"90.0.4480\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-09-03 03:03:15', '2022-09-03 03:03:15'),
(12, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Microsoft Edge 104.0.1293\",\"family\":\"Microsoft Edge\",\"version\":\"104.0.1293\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-09-03 03:34:05', '2022-09-03 03:34:05'),
(13, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 91.0.4516\",\"family\":\"Opera\",\"version\":\"91.0.4516\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-10-10 01:23:37', '2022-10-10 01:23:37'),
(14, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 93\",\"family\":\"Opera\",\"version\":\"93\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-11-30 11:53:20', '2022-11-30 11:53:20'),
(15, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 93\",\"family\":\"Opera\",\"version\":\"93\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-12-01 03:26:45', '2022-12-01 03:26:45'),
(16, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 93\",\"family\":\"Opera\",\"version\":\"93\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-12-06 01:12:11', '2022-12-06 01:12:11'),
(17, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 94\",\"family\":\"Opera\",\"version\":\"94\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2023-01-05 06:42:58', '2023-01-05 06:42:58'),
(18, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 94\",\"family\":\"Opera\",\"version\":\"94\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2023-01-06 02:33:09', '2023-01-06 02:33:09'),
(19, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 94\",\"family\":\"Opera\",\"version\":\"94\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2023-01-06 02:33:33', '2023-01-06 02:33:33'),
(20, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 94\",\"family\":\"Opera\",\"version\":\"94\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2023-01-13 18:07:59', '2023-01-13 18:07:59'),
(21, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 94\",\"family\":\"Opera\",\"version\":\"94\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2023-02-09 00:29:11', '2023-02-09 00:29:11'),
(22, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 94\",\"family\":\"Opera\",\"version\":\"94\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2023-02-09 00:49:43', '2023-02-09 00:49:43'),
(23, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 94\",\"family\":\"Opera\",\"version\":\"94\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2023-02-09 00:57:54', '2023-02-09 00:57:54'),
(24, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 94\",\"family\":\"Opera\",\"version\":\"94\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2023-02-09 13:56:55', '2023-02-09 13:56:55'),
(25, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 95\",\"family\":\"Opera\",\"version\":\"95\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2023-02-13 16:11:17', '2023-02-13 16:11:17'),
(26, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 95\",\"family\":\"Opera\",\"version\":\"95\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2023-03-05 14:51:08', '2023-03-05 14:51:08'),
(27, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 95\",\"family\":\"Opera\",\"version\":\"95\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2023-03-12 08:14:43', '2023-03-12 08:14:43');

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
-- Indexes for table `menu_headers`
--
ALTER TABLE `menu_headers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metas`
--
ALTER TABLE `metas`
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
-- Indexes for table `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_bap`
--
ALTER TABLE `tbl_bap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_hukdis`
--
ALTER TABLE `tbl_hukdis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_jenis`
--
ALTER TABLE `tbl_jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kasus`
--
ALTER TABLE `tbl_kasus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kephukdis`
--
ALTER TABLE `tbl_kephukdis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kl`
--
ALTER TABLE `tbl_kl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_kpts`
--
ALTER TABLE `tbl_kpts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_lhp`
--
ALTER TABLE `tbl_lhp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pelanggaran`
--
ALTER TABLE `tbl_pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_spmk`
--
ALTER TABLE `tbl_spmk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_surat_panggilan`
--
ALTER TABLE `tbl_surat_panggilan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tembusan`
--
ALTER TABLE `tbl_tembusan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tembusan_surat`
--
ALTER TABLE `tbl_tembusan_surat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_tim_pemeriksa`
--
ALTER TABLE `tbl_tim_pemeriksa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_attributes`
--
ALTER TABLE `user_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_avatars`
--
ALTER TABLE `user_avatars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitors`
--
ALTER TABLE `visitors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_headers`
--
ALTER TABLE `menu_headers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `metas`
--
ALTER TABLE `metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_bap`
--
ALTER TABLE `tbl_bap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_hukdis`
--
ALTER TABLE `tbl_hukdis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_jenis`
--
ALTER TABLE `tbl_jenis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_kasus`
--
ALTER TABLE `tbl_kasus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_kephukdis`
--
ALTER TABLE `tbl_kephukdis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_kl`
--
ALTER TABLE `tbl_kl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_kpts`
--
ALTER TABLE `tbl_kpts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_lhp`
--
ALTER TABLE `tbl_lhp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_pelanggaran`
--
ALTER TABLE `tbl_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_spmk`
--
ALTER TABLE `tbl_spmk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_surat_panggilan`
--
ALTER TABLE `tbl_surat_panggilan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_tembusan`
--
ALTER TABLE `tbl_tembusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_tembusan_surat`
--
ALTER TABLE `tbl_tembusan_surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_tim_pemeriksa`
--
ALTER TABLE `tbl_tim_pemeriksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_attributes`
--
ALTER TABLE `user_attributes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_avatars`
--
ALTER TABLE `user_avatars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitors`
--
ALTER TABLE `visitors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
