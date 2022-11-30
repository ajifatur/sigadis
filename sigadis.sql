-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2022 at 04:05 AM
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
(2, 1, 'Surat Panggilan', 'admin.surat-panggilan.index', '', 'bi-mailbox', '', 'is_int(strpos(Request::url(), route(\'admin.surat-panggilan.index\')))', 0, 2, NULL, '2022-07-04 04:17:45'),
(3, 1, 'Berita Acara Pemeriksaan', 'admin.berita-acara-pemeriksaan.index', '', 'bi-lightning', '', 'is_int(strpos(Request::url(), route(\'admin.berita-acara-pemeriksaan.index\')))', 0, 3, NULL, '2022-09-03 03:14:04'),
(4, 1, 'Keputusan Hukdis Ringan', NULL, '', 'bi-receipt', '', 'Request::url() == route(\'admin.dashboard\')', 0, 4, '2022-09-03 03:17:43', '2022-09-03 03:17:43'),
(5, 1, 'Teguran Lisan', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 4, 5, '2022-09-03 03:19:39', '2022-09-03 03:19:39'),
(6, 1, 'Teguran Tertulis', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 4, 6, '2022-09-03 03:20:29', '2022-09-03 03:20:29'),
(7, 1, 'Pernyataan Tidak Puas Secara Tertulis', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 4, 7, '2022-09-03 03:21:14', '2022-09-03 03:21:36'),
(8, 1, 'Keputusan Hukdis Sedang', NULL, '', 'bi-receipt', '', 'Request::url() == route(\'admin.dashboard\')', 0, 4, '2022-09-03 03:17:43', '2022-09-03 03:17:43'),
(9, 1, 'Keputusan Hukdis Berat', NULL, '', 'bi-receipt', '', 'Request::url() == route(\'admin.dashboard\')', 0, 4, '2022-09-03 03:17:43', '2022-09-03 03:17:43'),
(10, 1, 'Pemotongan Tunjangan Kinerja 25% Selama 6 Bulan', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 8, 8, '2022-09-03 03:23:24', '2022-09-03 03:23:24'),
(11, 1, 'Pemotongan Tunjangan Kinerja 25% Selama 9 Bulan', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 8, 9, '2022-09-03 03:24:18', '2022-09-03 03:24:18'),
(12, 1, 'Pemotongan Tunjangan Kinerja 25% Selama 12 Bulan', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 8, 10, '2022-09-03 03:25:13', '2022-09-03 03:25:13'),
(13, 1, 'Penurunan Jabatan Setingkat Lebih Rendah Selama 12 Bulan', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 9, 11, '2022-09-03 03:26:22', '2022-09-03 03:26:22'),
(14, 1, 'Pembebasan dari Jabatan Menjadi Jabatan Pelaksana Selama 12 Bulan', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 9, 12, '2022-09-03 03:27:28', '2022-09-03 03:27:28'),
(15, 1, 'Pemberhentian Dengan Hormat Tidak Atas Permintaan Sendiri Sebagai PNS', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 9, 13, '2022-09-03 03:28:40', '2022-09-03 03:28:40'),
(16, 1, 'Penurunan Kelas Jabatan Bagi PNS yang Menduduki Jabatan Pelaksana', NULL, '', 'bi-circle', '', 'Request::url() == route(\'admin.dashboard\')', 9, 14, '2022-09-03 03:29:31', '2022-09-03 03:29:31'),
(17, 1, 'Surat Panggilan untuk Menerima Keputusan Hukdis', NULL, '', 'bi-envelope-dash', '', 'Request::url() == route(\'admin.dashboard\')', 0, 15, '2022-09-03 03:31:04', '2022-09-03 03:31:04');

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
(18, '2022_02_19_000000_add_columns_to_roles_table', 1);

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
(1, 'Mengelola Data Role', 'RoleController::index', 1, 1, '2022-07-03 19:34:41', '2022-07-03 19:34:41'),
(2, 'Menambah Role', 'RoleController::create', 1, 2, '2022-07-03 19:34:41', '2022-07-03 19:34:41'),
(3, 'Mengubah Role', 'RoleController::edit', 1, 3, '2022-07-03 19:34:41', '2022-07-03 19:34:41'),
(4, 'Menghapus Role', 'RoleController::delete', 1, 4, '2022-07-03 19:34:41', '2022-07-03 19:34:41'),
(5, 'Mengurutkan Role', 'RoleController::reorder', 1, 5, '2022-07-03 19:34:41', '2022-07-03 19:34:41'),
(6, 'Mengelola Data Hak Akses', 'PermissionController::index', 1, 11, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(7, 'Menambah Hak Akses', 'PermissionController::create', 1, 12, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(8, 'Mengubah Hak Akses', 'PermissionController::edit', 1, 13, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(9, 'Menghapus Hak Akses', 'PermissionController::delete', 1, 14, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(10, 'Mengurutkan Hak Akses', 'PermissionController::reorder', 1, 15, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(11, 'Mengganti Status Hak Akses', 'PermissionController::change', 1, 16, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(12, 'Mengelola Data Menu', 'MenuController::index', 1, 17, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(13, 'Menambah Menu Header', 'MenuHeaderController::create', 1, 18, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(14, 'Mengubah Menu Header', 'MenuHeaderController::edit', 1, 19, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(15, 'Menghapus Menu Header', 'MenuHeaderController::delete', 1, 20, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(16, 'Menambah Menu Item', 'MenuItemController::create', 1, 21, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(17, 'Mengubah Menu Item', 'MenuItemController::edit', 1, 22, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(18, 'Menghapus Menu Item', 'MenuItemController::delete', 1, 23, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(19, 'Mengelola Meta', 'MetaController::index', 1, 24, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(20, 'Menampilkan Lingkungan Sistem', 'SystemController::index', 1, 25, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(21, 'Menampilkan Database', 'DatabaseController::index', 1, 26, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(22, 'Menampilkan Route', 'RouteController::index', 1, 27, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(23, 'Mengelola Perintah Artisan', 'ArtisanController::index', 1, 28, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(24, 'Menampilkan Log Aktivitas', 'LogController::activity', 1, 29, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(25, 'Menampilkan Log Aktivitas Berdasarkan URL', 'LogController::activityByURL', 1, 30, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(26, 'Menampilkan Log Autentikasi', 'LogController::authentication', 1, 31, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(27, 'Menampilkan Data Visitor', 'VisitorController::index', 1, 32, '2022-07-03 19:34:41', '2022-09-03 03:10:45'),
(28, 'Mengelola Data Pengguna', 'UserController::index', 1, 6, '2022-09-03 03:10:45', '2022-09-03 03:10:45'),
(29, 'Menambah Pengguna', 'UserController::create', 1, 7, '2022-09-03 03:10:45', '2022-09-03 03:10:45'),
(30, 'Mengubah Pengguna', 'UserController::edit', 1, 8, '2022-09-03 03:10:45', '2022-09-03 03:10:45'),
(31, 'Menghapus Pengguna', 'UserController::delete', 1, 9, '2022-09-03 03:10:45', '2022-09-03 03:10:45'),
(32, 'Menghapus Pengguna Terpilih', 'UserController::deleteBulk', 1, 10, '2022-09-03 03:10:45', '2022-09-03 03:10:45');

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
(1, 32);

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
(16, 'show_brand', '0', '2022-09-03 03:10:45', '2022-09-03 03:11:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_berita_acara_pemeriksaan`
--

CREATE TABLE `tbl_berita_acara_pemeriksaan` (
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
-- Dumping data for table `tbl_berita_acara_pemeriksaan`
--

INSERT INTO `tbl_berita_acara_pemeriksaan` (`id`, `hari`, `tanggal`, `pemeriksa`, `wewenang`, `terlapor`, `pasal`, `ayat`, `huruf`, `angka`, `qna`, `created_at`, `updated_at`) VALUES
(6, 4, '2022-08-04', 1, 1, '199705262022031008', 1, 2, '3', 4, '{\"pertanyaan\":[\"Siapa?\"],\"jawaban\":[\"YNTKTS\"]}', '2022-08-04 01:44:27', '2022-09-03 03:40:25');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_surat_panggilan`
--

CREATE TABLE `tbl_surat_panggilan` (
  `id` int(11) NOT NULL,
  `panggilan` int(11) NOT NULL,
  `terlapor` varchar(255) NOT NULL,
  `menghadap_kepada` varchar(255) NOT NULL,
  `hari` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `tempat` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `pelanggaran` text NOT NULL,
  `atasan` int(11) NOT NULL,
  `ttd` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_surat_panggilan`
--

INSERT INTO `tbl_surat_panggilan` (`id`, `panggilan`, `terlapor`, `menghadap_kepada`, `hari`, `tanggal`, `jam`, `tempat`, `status`, `pelanggaran`, `atasan`, `ttd`, `created_at`, `updated_at`) VALUES
(4, 1, '199705262022031008', '132308402', 3, '2022-08-03', '12:00:00', 'Sekretariat Kepegawaian', 1, 'Kode Etik ASN', 1, '132308402', '2022-08-03 02:33:20', '2022-08-03 02:33:20'),
(5, 2, '199705262022031008', '132308158', 3, '2022-08-10', '13:00:00', 'Sekretariat Kepegawaian', 2, 'Kode Etik ASN', 1, '132308158', '2022-08-03 03:57:54', '2022-08-03 04:02:05');

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
(1, 1, 'Admin', 'admin@admin.com', 'admin@admin.com', NULL, '$2y$10$DdFLeYLynqwb9FG89JY3v.FgGke7LAiAOVjXEBEHdRFm/WXkylxdu', NULL, 'uHRwq9JVxwNXwSHY8mDhgMBvM8TwSZBnbZ8EvfXu', NULL, 1, '2022-10-10 01:23:22', '2022-07-03 19:34:41', '2022-10-10 01:23:22');

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
(13, 1, '127.0.0.1', '{\"type\":\"Desktop\",\"family\":\"Unknown\",\"model\":\"\",\"grade\":\"\"}', '{\"name\":\"Opera 91.0.4516\",\"family\":\"Opera\",\"version\":\"91.0.4516\",\"engine\":\"Blink\"}', '{\"name\":\"Windows 10\",\"family\":\"Windows\",\"version\":\"10\"}', '', '2022-10-10 01:23:37', '2022-10-10 01:23:37');

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_berita_acara_pemeriksaan`
--
ALTER TABLE `tbl_berita_acara_pemeriksaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_surat_panggilan`
--
ALTER TABLE `tbl_surat_panggilan`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `metas`
--
ALTER TABLE `metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_berita_acara_pemeriksaan`
--
ALTER TABLE `tbl_berita_acara_pemeriksaan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_surat_panggilan`
--
ALTER TABLE `tbl_surat_panggilan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
