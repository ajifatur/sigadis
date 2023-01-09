-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2023 at 08:30 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

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
(3, 1, 'Berita Acara Pemeriksaan', 'admin.bap.index', '', 'bi-lightning', '', 'is_int(strpos(Request::url(), route(\'admin.bap.index\')))', 0, 4, NULL, '2022-11-30 13:38:51'),
(4, 1, 'Keputusan Hukdis Ringan', NULL, '', 'bi-receipt', '', 'Request::url() == route(\'admin.dashboard\')', 0, 5, '2022-09-03 03:17:43', '2022-11-30 13:38:51'),
(5, 1, 'Teguran Lisan', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 4, 5, '2022-09-03 03:19:39', '2022-09-03 03:19:39'),
(6, 1, 'Teguran Tertulis', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 4, 6, '2022-09-03 03:20:29', '2022-09-03 03:20:29'),
(7, 1, 'Pernyataan Tidak Puas Secara Tertulis', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 4, 7, '2022-09-03 03:21:14', '2022-09-03 03:21:36'),
(8, 1, 'Keputusan Hukdis Sedang', NULL, '', 'bi-receipt', '', 'Request::url() == route(\'admin.dashboard\')', 0, 6, '2022-09-03 03:17:43', '2022-11-30 13:38:51'),
(9, 1, 'Keputusan Hukdis Berat', NULL, '', 'bi-receipt', '', 'Request::url() == route(\'admin.dashboard\')', 0, 7, '2022-09-03 03:17:43', '2022-11-30 13:38:51'),
(10, 1, 'Pemotongan Tunjangan Kinerja 25% Selama 6 Bulan', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 8, 8, '2022-09-03 03:23:24', '2022-09-03 03:23:24'),
(11, 1, 'Pemotongan Tunjangan Kinerja 25% Selama 9 Bulan', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 8, 9, '2022-09-03 03:24:18', '2022-09-03 03:24:18'),
(12, 1, 'Pemotongan Tunjangan Kinerja 25% Selama 12 Bulan', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 8, 10, '2022-09-03 03:25:13', '2022-09-03 03:25:13'),
(13, 1, 'Penurunan Jabatan Setingkat Lebih Rendah Selama 12 Bulan', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 9, 11, '2022-09-03 03:26:22', '2022-09-03 03:26:22'),
(14, 1, 'Pembebasan dari Jabatan Menjadi Jabatan Pelaksana Selama 12 Bulan', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 9, 12, '2022-09-03 03:27:28', '2022-09-03 03:27:28'),
(15, 1, 'Pemberhentian Dengan Hormat Tidak Atas Permintaan Sendiri Sebagai PNS', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 9, 13, '2022-09-03 03:28:40', '2022-09-03 03:28:40'),
(16, 1, 'Penurunan Kelas Jabatan Bagi PNS yang Menduduki Jabatan Pelaksana', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 9, 14, '2022-09-03 03:29:31', '2022-09-03 03:29:31'),
(17, 1, 'Surat Panggilan untuk Menerima Keputusan Hukdis', NULL, '', 'bi-envelope-dash', '', 'Request::url() == route(\'admin.dashboard\')', 0, 8, '2022-09-03 03:31:04', '2022-11-30 13:38:51'),
(18, 1, 'Kasus', 'admin.terduga.index', '', 'bi-hammer', '', 'is_int(strpos(Request::url(), route(\'admin.terduga.index\')))', 0, 2, NULL, '2023-01-06 02:34:31');

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
(19, '2022_10_23_000000_create_schedules_table', 2);

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
(12, 'Mengelola Data Menu', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MenuController::index', 1, 17, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(13, 'Menambah Menu Header', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MenuHeaderController::create', 1, 18, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(14, 'Mengubah Menu Header', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MenuHeaderController::edit', 1, 19, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(15, 'Menghapus Menu Header', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MenuHeaderController::delete', 1, 20, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(16, 'Menambah Menu Item', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MenuItemController::create', 1, 21, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(17, 'Mengubah Menu Item', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MenuItemController::edit', 1, 22, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(18, 'Menghapus Menu Item', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MenuItemController::delete', 1, 23, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(19, 'Mengelola Meta', 'Ajifatur\\FaturHelper\\Http\\Controllers\\MetaController::index', 1, 24, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(20, 'Menampilkan Lingkungan Sistem', 'Ajifatur\\FaturHelper\\Http\\Controllers\\SystemController::index', 1, 28, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(21, 'Menampilkan Database', 'Ajifatur\\FaturHelper\\Http\\Controllers\\DatabaseController::index', 1, 29, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(22, 'Menampilkan Route', 'Ajifatur\\FaturHelper\\Http\\Controllers\\RouteController::index', 1, 30, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(23, 'Mengelola Perintah Artisan', 'Ajifatur\\FaturHelper\\Http\\Controllers\\ArtisanController::index', 1, 31, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(24, 'Menampilkan Log Aktivitas', 'Ajifatur\\FaturHelper\\Http\\Controllers\\LogController::activity', 1, 32, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(25, 'Menampilkan Log Aktivitas Berdasarkan URL', 'Ajifatur\\FaturHelper\\Http\\Controllers\\LogController::activityByURL', 1, 33, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(26, 'Menampilkan Log Autentikasi', 'Ajifatur\\FaturHelper\\Http\\Controllers\\LogController::authentication', 1, 34, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(27, 'Menampilkan Data Visitor', 'Ajifatur\\FaturHelper\\Http\\Controllers\\VisitorController::index', 1, 35, '2022-07-03 19:34:41', '2022-11-30 12:13:19'),
(28, 'Mengelola Data Pengguna', 'Ajifatur\\FaturHelper\\Http\\Controllers\\UserController::index', 1, 6, '2022-09-03 03:10:45', '2022-11-30 12:13:19'),
(29, 'Menambah Pengguna', 'Ajifatur\\FaturHelper\\Http\\Controllers\\UserController::create', 1, 7, '2022-09-03 03:10:45', '2022-11-30 12:13:19'),
(30, 'Mengubah Pengguna', 'Ajifatur\\FaturHelper\\Http\\Controllers\\UserController::edit', 1, 8, '2022-09-03 03:10:45', '2022-11-30 12:13:19'),
(31, 'Menghapus Pengguna', 'Ajifatur\\FaturHelper\\Http\\Controllers\\UserController::delete', 1, 9, '2022-09-03 03:10:45', '2022-11-30 12:13:19'),
(32, 'Menghapus Pengguna Terpilih', 'Ajifatur\\FaturHelper\\Http\\Controllers\\UserController::deleteBulk', 1, 10, '2022-09-03 03:10:45', '2022-11-30 12:13:19'),
(33, 'Mengelola Data Agenda', 'Ajifatur\\FaturHelper\\Http\\Controllers\\ScheduleController::index', 1, 25, '2022-11-30 12:13:19', '2022-11-30 12:13:19'),
(34, 'Mengupdate Agenda', 'Ajifatur\\FaturHelper\\Http\\Controllers\\ScheduleController::update', 1, 26, '2022-11-30 12:13:19', '2022-11-30 12:13:19'),
(35, 'Menghapus Agenda', 'Ajifatur\\FaturHelper\\Http\\Controllers\\ScheduleController::delete', 1, 27, '2022-11-30 12:13:19', '2022-11-30 12:13:19');

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
(1, 35);

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
(19, 'brand_visibility', '0', '2022-11-30 12:13:19', '2022-11-30 16:00:38');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bap`
--

CREATE TABLE `tbl_bap` (
  `id` int(11) NOT NULL,
  `hari` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `pemeriksa` int(11) NOT NULL,
  `wewenang` int(11) NOT NULL,
  `terlapor` varchar(255) NOT NULL,
  `pasal` int(11) NOT NULL,
  `ayat` int(11) NOT NULL,
  `huruf` varchar(4) NOT NULL,
  `angka` int(11) NOT NULL,
  `qna` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_bap`
--

INSERT INTO `tbl_bap` (`id`, `hari`, `tanggal`, `pemeriksa`, `wewenang`, `terlapor`, `pasal`, `ayat`, `huruf`, `angka`, `qna`, `created_at`, `updated_at`) VALUES
(6, 4, '2022-08-04', 1, 1, '199705262022031008', 1, 2, '3', 4, '{\"pertanyaan\":[\"Siapa?\",\"Ehe?\"],\"jawaban\":[\"YNTKTS\",\"Oho\"]}', '2022-08-04 01:44:27', '2022-11-30 17:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hukdis`
--

CREATE TABLE `tbl_hukdis` (
  `id` int(11) NOT NULL,
  `jenis_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_hukdis`
--

INSERT INTO `tbl_hukdis` (`id`, `jenis_id`, `nama`, `created_at`, `updated_at`) VALUES
(1, 1, 'Teguran lisan', NULL, NULL),
(2, 1, 'Teguran tertulis', NULL, NULL),
(3, 1, 'Pernyataan tidak puas secara tertulis', NULL, NULL),
(4, 2, 'Pemotongan tunjangan kinerja sebesar 25% selama 6 bulan', NULL, NULL),
(5, 2, 'Pemotongan tunjangan kinerja sebesar 25% selama 9 bulan', NULL, NULL),
(6, 2, 'Pemotongan tunjangan kinerja sebesar 25% selama 12 bulan', NULL, NULL),
(7, 3, 'Penurunan jabatan setingkat lebih rendah selama 12 bulan', NULL, NULL),
(8, 3, 'Pembebasan dari jabatannya menjadi jabatan pelaksana selama 12 bulan', NULL, NULL),
(9, 3, 'Pemberhentian dengan hormat tidak atas permintaan sendiri sebagai PNS', NULL, NULL);

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
-- Table structure for table `tbl_surat_panggilan`
--

CREATE TABLE `tbl_surat_panggilan` (
  `id` int(11) NOT NULL,
  `terduga_id` int(11) NOT NULL,
  `panggilan` int(11) NOT NULL,
  `terlapor` varchar(255) NOT NULL,
  `terlapor_json` text NOT NULL,
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

INSERT INTO `tbl_surat_panggilan` (`id`, `terduga_id`, `panggilan`, `terlapor`, `terlapor_json`, `menghadap_kepada`, `menghadap_kepada_json`, `tanggal`, `jam`, `tempat`, `status`, `pelanggaran`, `status_atasan`, `atasan`, `atasan_json`, `tanggal_surat`, `created_at`, `updated_at`) VALUES
(7, 4, 1, '199705262022031008', '{\"nama\":\"Fathurrahman Prasetyo Aji, S.Pd.\",\"nip\":\"199705262022031008\",\"pangkat\":\"III\\/a - Penata Muda\",\"jabatan\":\"Pengembang sistem informasi\",\"unit\":\"BUHK - BAGIAN HUKUM DAN KEPEGAWAIAN - SUB BAGIAN PENDIDIK\"}', '132094313', '{\"nama\":\"WIDI WIDAYAT, S. Pd.\",\"nip\":\"196803011995071001\",\"pangkat\":\"IV\\/b - Pembina Tk. I\",\"jabatan\":\"Kepala Biro Umum Hukum dan Kepegawaian\",\"unit\":\"UNNES - BUHK\"}', '2022-12-01', '10:55:00', 'Ruang Kepala BUHK', 1, 'Kode etik ASN', 1, '132094313', '{\"nama\":\"WIDI WIDAYAT, S. Pd.\",\"nip\":\"196803011995071001\",\"pangkat\":\"IV\\/b - Pembina Tk. I\",\"jabatan\":\"Kepala Biro Umum Hukum dan Kepegawaian\",\"unit\":\"UNNES - BUHK\"}', '2022-11-28', '2022-11-30 16:34:18', '2022-11-30 16:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_terduga`
--

CREATE TABLE `tbl_terduga` (
  `id` int(11) NOT NULL,
  `terduga` varchar(255) NOT NULL,
  `terduga_nip` varchar(255) DEFAULT NULL,
  `terduga_nama` varchar(255) DEFAULT NULL,
  `dugaan_pelanggaran` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_terduga`
--

INSERT INTO `tbl_terduga` (`id`, `terduga`, `terduga_nip`, `terduga_nama`, `dugaan_pelanggaran`, `created_at`, `updated_at`) VALUES
(3, '130935363', '195909191981032003', 'Dra. ENDANG RETNO WINARTI, M. Pd.', 'Orasek', '2022-11-30 14:08:00', '2022-11-30 14:12:28'),
(4, '199705262022031008', '199705262022031008', 'Fathurrahman Prasetyo Aji, S.Pd.', 'Kode etik sebagai ASN', '2022-11-30 14:13:01', '2022-11-30 14:13:01');

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
(9, 6, '132308158', '2022-09-03 03:41:02', '2022-09-03 03:41:02');

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
(1, 1, 'Admin', 'admin@admin.com', 'admin@admin.com', NULL, '$2y$10$DdFLeYLynqwb9FG89JY3v.FgGke7LAiAOVjXEBEHdRFm/WXkylxdu', NULL, 'uHRwq9JVxwNXwSHY8mDhgMBvM8TwSZBnbZ8EvfXu', NULL, 1, '2023-01-06 02:33:30', '2022-07-03 19:34:41', '2023-01-06 02:33:30');

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
(19, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 94\",\"family\":\"Opera\",\"version\":\"94\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2023-01-06 02:33:33', '2023-01-06 02:33:33');

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
-- Indexes for table `tbl_kl`
--
ALTER TABLE `tbl_kl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pelanggaran`
--
ALTER TABLE `tbl_pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_surat_panggilan`
--
ALTER TABLE `tbl_surat_panggilan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_terduga`
--
ALTER TABLE `tbl_terduga`
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_bap`
--
ALTER TABLE `tbl_bap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT for table `tbl_kl`
--
ALTER TABLE `tbl_kl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tbl_pelanggaran`
--
ALTER TABLE `tbl_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_surat_panggilan`
--
ALTER TABLE `tbl_surat_panggilan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_terduga`
--
ALTER TABLE `tbl_terduga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_tim_pemeriksa`
--
ALTER TABLE `tbl_tim_pemeriksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
