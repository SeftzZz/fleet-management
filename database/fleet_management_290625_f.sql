-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2025 at 07:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fleet_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('pending','selesai') DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `vehicle_id`, `type`, `message`, `status`, `created_at`) VALUES
(1, 1, 'Overheating', 'Mesin kendaraan terlalu panas', 'pending', '2025-05-08 05:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `license_number` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `tgl_join` date DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nomor_darurat` varchar(20) DEFAULT NULL,
  `tgl_exp_sim` date DEFAULT NULL,
  `img_profile` text DEFAULT NULL,
  `img_sim` text DEFAULT NULL,
  `img_ktp` text DEFAULT NULL,
  `status` enum('Aktif','Non Aktif') DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `license_number`, `phone`, `tgl_join`, `tgl_lahir`, `alamat`, `nomor_darurat`, `tgl_exp_sim`, `img_profile`, `img_sim`, `img_ktp`, `status`, `keterangan`, `is_delete`, `created_at`, `updated_at`) VALUES
(14, 'Ahmad Dani', '1802040806700004', '085963051895', '2025-06-19', '2025-06-19', 'Dusun 1 Rt.001/Rw.001 Fajar bulan Kec. Gunung Sugih', '085963051895', '2025-06-21', 'placeholder.png', 'placeholder.png', 'placeholder.png', 'Aktif', '', 0, '2025-06-19 06:03:16', '2025-06-24 16:37:48'),
(15, 'Karna Rahayu', '1802040806700004', '085963051895', '2025-06-19', '2025-06-19', 'Kp. Rancagong Rt.004/Rw.007 Rancagong - Legok', '085963051895', '2025-06-21', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-19 06:04:34', '2025-06-19 06:04:34'),
(16, 'Imam Soib', '1802040806700004', '085963051895', '2025-06-19', '2025-06-19', 'Dusun IV Candirejo Rt.001/Rw.007 Titiwangi - Candipuro', '085963051895', '2025-06-19', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-19 06:04:53', '2025-06-19 06:04:53'),
(17, 'Hendi', '1802040806700004', '085963051895', '2025-06-19', '2025-06-19', 'Kp. Gosali Rt.001/Rw.007 Desa Bangun Jaya Cigudeg', '085963051895', '2025-06-19', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-19 06:05:17', '2025-06-19 06:05:17'),
(18, 'Driver K 1', '1802040806700004', '085963051895', '2025-06-19', '2025-06-19', 'Driver K 1', '085963051895', '2025-06-19', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-19 14:45:03', '2025-06-19 14:45:03'),
(19, 'Driver K 2', '1802040806700004', '085963051895', '2025-06-19', '2025-06-19', 'Driver K 2', '085963051895', '2025-06-19', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-19 14:45:22', '2025-06-19 14:45:22'),
(20, 'Driver KMP 1', '1802040806700004', '085963051895', '2025-06-20', '2025-06-20', 'Alamat satu', '085963051895', '2025-06-20', '', '', '', 'Aktif', NULL, 0, '2025-06-20 13:40:39', '2025-06-20 13:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `drivers2`
--

CREATE TABLE `drivers2` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `license_number` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `tgl_join` date DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nomor_darurat` varchar(20) DEFAULT NULL,
  `tgl_exp_sim` date DEFAULT NULL,
  `img_profile` text DEFAULT NULL,
  `img_sim` text DEFAULT NULL,
  `img_ktp` text DEFAULT NULL,
  `status` enum('Aktif','Non Aktif') DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers2`
--

INSERT INTO `drivers2` (`id`, `name`, `license_number`, `phone`, `tgl_join`, `tgl_lahir`, `alamat`, `nomor_darurat`, `tgl_exp_sim`, `img_profile`, `img_sim`, `img_ktp`, `status`, `keterangan`, `is_delete`, `created_at`, `updated_at`) VALUES
(14, 'Ahmad Dani', '1802040806700004', '085963051895', '2025-06-19', '2025-06-19', 'Dusun 1 Rt.001/Rw.001 Fajar bulan Kec. Gunung Sugih', '085963051895', '2025-06-21', '', '', '', 'Aktif', '', 0, '2025-06-19 06:03:16', '2025-06-24 09:24:11'),
(15, 'Karna Rahayu', '1802040806700004', '085963051895', '2025-06-19', '2025-06-19', 'Kp. Rancagong Rt.004/Rw.007 Rancagong - Legok', '085963051895', '2025-06-21', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-19 06:04:34', '2025-06-19 06:04:34'),
(16, 'Imam Soib', '1802040806700004', '085963051895', '2025-06-19', '2025-06-19', 'Dusun IV Candirejo Rt.001/Rw.007 Titiwangi - Candipuro', '085963051895', '2025-06-19', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-19 06:04:53', '2025-06-19 06:04:53'),
(17, 'Hendi', '1802040806700004', '085963051895', '2025-06-19', '2025-06-19', 'Kp. Gosali Rt.001/Rw.007 Desa Bangun Jaya Cigudeg', '085963051895', '2025-06-19', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-19 06:05:17', '2025-06-19 06:05:17'),
(18, 'Driver K 1', '1802040806700004', '085963051895', '2025-06-19', '2025-06-19', 'Driver K 1', '085963051895', '2025-06-19', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-19 14:45:03', '2025-06-19 14:45:03'),
(19, 'Driver K 2', '1802040806700004', '085963051895', '2025-06-19', '2025-06-19', 'Driver K 2', '085963051895', '2025-06-19', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-19 14:45:22', '2025-06-19 14:45:22'),
(20, 'Driver KMP 1', '1802040806700004', '085963051895', '2025-06-20', '2025-06-20', 'Alamat satu', '085963051895', '2025-06-20', '', '', '', 'Aktif', NULL, 0, '2025-06-20 13:40:39', '2025-06-20 13:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `fuel_logs`
--

CREATE TABLE `fuel_logs` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `fuel_type` varchar(30) DEFAULT NULL,
  `liters` float DEFAULT NULL,
  `price_per_liter` float DEFAULT NULL,
  `total_cost` float DEFAULT NULL,
  `fuel_date` date DEFAULT NULL,
  `odometer` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fuel_logs`
--

INSERT INTO `fuel_logs` (`id`, `vehicle_id`, `fuel_type`, `liters`, `price_per_liter`, `total_cost`, `fuel_date`, `odometer`) VALUES
(1, 1, 'Premium', 50, 10000, 500000, '2025-05-07', 5050);

-- --------------------------------------------------------

--
-- Table structure for table `galian`
--

CREATE TABLE `galian` (
  `id` int(11) NOT NULL,
  `proyek_id` int(11) NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `status_lokasi` varchar(10) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `galian`
--

INSERT INTO `galian` (`id`, `proyek_id`, `lokasi`, `status_lokasi`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ciujug', 'Aktif', 0, '2025-06-10 08:30:40', '2025-06-10 08:30:40'),
(2, 1, 'Multikon', 'Aktif', 0, '2025-06-11 09:41:39', '2025-06-11 09:41:39'),
(3, 1, 'Tapen', 'Aktif', 0, '2025-06-10 08:31:15', '2025-06-10 08:31:15'),
(4, 1, 'Mede', 'Aktif', 0, '2025-06-10 08:31:15', '2025-06-10 08:31:15'),
(5, 1, 'Ciomas', 'Aktif', 0, '2025-06-11 10:04:47', '2025-06-11 10:04:47'),
(6, 1, 'Citeras', 'Aktif', 0, '2025-06-11 11:01:49', '2025-06-11 11:01:49'),
(7, 1, 'Serengseng', 'Aktif', 0, '2025-06-11 11:02:25', '2025-06-11 11:02:25'),
(8, 1, 'C. Bitung', 'Aktif', 0, '2025-06-11 11:02:42', '2025-06-11 11:02:42'),
(9, 1, 'Baros', 'Aktif', 0, '2025-06-29 23:29:26', '2025-06-29 23:30:44'),
(10, 1, 'Cilegon', 'Aktif', 0, '2025-06-11 11:03:13', '2025-06-11 11:03:13'),
(11, 1, 'Bojonegara', 'Aktif', 0, '2025-06-11 12:28:42', '2025-06-11 12:28:42'),
(12, 1, 'Kopi', 'Aktif', 0, '2025-06-20 13:55:41', '2025-06-20 13:55:41'),
(13, 1, 'Grogol', 'Aktif', 0, '2025-06-30 00:06:13', '2025-06-30 00:06:13'),
(14, 1, 'Maja', 'Aktif', 0, '2025-06-30 00:07:12', '2025-06-30 00:07:12'),
(15, 1, 'Cilayang', 'Aktif', 0, '2025-06-30 00:07:58', '2025-06-30 00:07:58'),
(16, 1, 'T. Abang', 'Aktif', 0, '2025-06-30 00:08:43', '2025-06-30 00:08:43'),
(17, 1, 'Tutul', 'Aktif', 0, '2025-06-30 00:09:23', '2025-06-30 00:09:23'),
(18, 1, 'Klp Gading', 'Aktif', 0, '2025-06-30 00:10:05', '2025-06-30 00:10:05'),
(19, 1, 'Karet', 'Aktif', 0, '2025-06-30 00:10:43', '2025-06-30 00:10:43'),
(20, 1, 'Kuningan', 'Aktif', 0, '2025-06-30 00:11:22', '2025-06-30 00:11:22'),
(21, 1, 'Manggarai', 'Aktif', 0, '2025-06-30 00:12:04', '2025-06-30 00:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `galian01`
--

CREATE TABLE `galian01` (
  `id` int(11) NOT NULL,
  `proyek_id` int(11) NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `status_lokasi` varchar(10) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `galian01`
--

INSERT INTO `galian01` (`id`, `proyek_id`, `lokasi`, `status_lokasi`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ciujug', 'Aktif', 0, '2025-06-10 08:30:40', '2025-06-10 08:30:40'),
(2, 1, 'Multikon', 'Aktif', 0, '2025-06-11 09:41:39', '2025-06-11 09:41:39'),
(3, 1, 'Tapen', 'Aktif', 0, '2025-06-10 08:31:15', '2025-06-10 08:31:15'),
(4, 1, 'Mede', 'Aktif', 0, '2025-06-10 08:31:15', '2025-06-10 08:31:15'),
(5, 1, 'Ciomas', 'Aktif', 0, '2025-06-11 10:04:47', '2025-06-11 10:04:47'),
(6, 1, 'Citeras', 'Aktif', 0, '2025-06-11 11:01:49', '2025-06-11 11:01:49'),
(7, 1, 'Serengseng', 'Aktif', 0, '2025-06-11 11:02:25', '2025-06-11 11:02:25'),
(8, 1, 'C. Bitung', 'Aktif', 0, '2025-06-11 11:02:42', '2025-06-11 11:02:42'),
(9, 1, 'Baros', 'Aktif', 0, '2025-06-29 23:29:26', '2025-06-29 23:30:44'),
(10, 1, 'Cilegon', 'Aktif', 0, '2025-06-11 11:03:13', '2025-06-11 11:03:13'),
(11, 1, 'Bojonegara', 'Aktif', 0, '2025-06-11 12:28:42', '2025-06-11 12:28:42'),
(12, 1, 'Kopi', 'Aktif', 0, '2025-06-20 13:55:41', '2025-06-20 13:55:41'),
(13, 1, 'Grogol', 'Aktif', 0, '2025-06-30 00:06:13', '2025-06-30 00:06:13'),
(14, 1, 'Maja', 'Aktif', 0, '2025-06-30 00:07:12', '2025-06-30 00:07:12'),
(15, 1, 'Cilayang', 'Aktif', 0, '2025-06-30 00:07:58', '2025-06-30 00:07:58'),
(16, 1, 'T. Abang', 'Aktif', 0, '2025-06-30 00:08:43', '2025-06-30 00:08:43'),
(17, 1, 'Tutul', 'Aktif', 0, '2025-06-30 00:09:23', '2025-06-30 00:09:23'),
(18, 1, 'Klp Gading', 'Aktif', 0, '2025-06-30 00:10:05', '2025-06-30 00:10:05'),
(19, 1, 'Karet', 'Aktif', 0, '2025-06-30 00:10:43', '2025-06-30 00:10:43'),
(20, 1, 'Kuningan', 'Aktif', 0, '2025-06-30 00:11:22', '2025-06-30 00:11:22'),
(21, 1, 'Manggarai', 'Aktif', 0, '2025-06-30 00:12:04', '2025-06-30 00:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'Super Admin', 'Super Admin'),
(2, 'Admin', 'Admin'),
(3, 'User', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `incident_date` datetime DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `severity` enum('ringan','sedang','parah') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(8, '127.0.0.1', 'admin', 1751159307),
(9, '127.0.0.1', 'admin@admin.com', 1751206059),
(10, '127.0.0.1', 'admin@admin.com', 1751206070),
(11, '127.0.0.1', 'admin@admin.com', 1751206085),
(12, '127.0.0.1', 'spradmin@admin.com', 1751206106),
(13, '127.0.0.1', 'spradmin@admin.com', 1751206119),
(14, '127.0.0.1', 'spradmin@admin.com', 1751206167),
(16, '127.0.0.1', 'spradmin@admin.com', 1751206908);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_logs`
--

CREATE TABLE `maintenance_logs` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `service_type` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `cost` float DEFAULT NULL,
  `odometer` float DEFAULT NULL,
  `service_date` date DEFAULT NULL,
  `next_service_due` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `maintenance_logs`
--

INSERT INTO `maintenance_logs` (`id`, `vehicle_id`, `service_type`, `description`, `cost`, `odometer`, `service_date`, `next_service_due`) VALUES
(1, 1, 'Service Berkala', 'Penggantian oli mesin', 500000, 5000, '2025-05-07', '2025-06-07');

-- --------------------------------------------------------

--
-- Table structure for table `proyek`
--

CREATE TABLE `proyek` (
  `id` int(11) NOT NULL,
  `nama_proyek` varchar(30) NOT NULL,
  `status_proyek` varchar(10) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `proyek`
--

INSERT INTO `proyek` (`id`, `nama_proyek`, `status_proyek`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Kohod', 'Aktif', 0, '2025-06-10 15:29:29', '2025-06-10 15:29:29'),
(2, 'Tj. Burung', 'Aktif', 0, '2025-06-10 08:29:51', '2025-06-10 08:29:51'),
(3, 'Sumber Baru', 'Aktif', 0, '2025-06-11 09:55:47', '2025-06-11 09:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `proyek01`
--

CREATE TABLE `proyek01` (
  `id` int(11) NOT NULL,
  `nama_proyek` varchar(30) NOT NULL,
  `status_proyek` varchar(10) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `proyek01`
--

INSERT INTO `proyek01` (`id`, `nama_proyek`, `status_proyek`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Kohod', 'Aktif', 0, '2025-06-10 15:29:29', '2025-06-10 15:29:29'),
(2, 'Tj. Burung', 'Aktif', 0, '2025-06-10 08:29:51', '2025-06-10 08:29:51'),
(3, 'Sumber Baru', 'Aktif', 0, '2025-06-11 09:55:47', '2025-06-11 09:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `ritasi`
--

CREATE TABLE `ritasi` (
  `id` int(11) NOT NULL,
  `tgl_ritasi` date NOT NULL,
  `tim_id` int(11) NOT NULL,
  `nama_tim` varchar(10) NOT NULL,
  `proyek_id` int(11) NOT NULL,
  `nama_proyek` varchar(30) NOT NULL,
  `galian_id` int(11) NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `no_pol` varchar(10) NOT NULL,
  `jam_angkut` varchar(5) NOT NULL,
  `nomerdo` varchar(8) NOT NULL,
  `uang_jalan` varchar(10) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ritasi`
--

INSERT INTO `ritasi` (`id`, `tgl_ritasi`, `tim_id`, `nama_tim`, `proyek_id`, `nama_proyek`, `galian_id`, `lokasi`, `vehicle_id`, `no_pol`, `jam_angkut`, `nomerdo`, `uang_jalan`, `is_delete`, `created_at`, `updated_at`) VALUES
(48, '2025-06-27', 1, 'G', 1, 'Kohod', 12, 'Galian KMP', 4, 'B 9760 UIU', '13:58', '11111', '1000000', 0, '2025-06-20 13:58:13', '2025-06-20 13:58:13'),
(49, '2025-06-27', 1, 'G', 1, 'Kohod', 12, 'Galian KMP', 7, 'B KMP 1', '13:58', '222222', '1000000', 0, '2025-06-20 13:58:13', '2025-06-20 13:58:13'),
(50, '2025-06-20', 1, 'G', 1, 'Kohod', 12, 'Galian KMP', 4, 'B 9760 UIU', '13:58', '33333', '1000000', 0, '2025-06-20 13:59:59', '2025-06-20 13:59:59'),
(51, '2025-06-20', 1, 'G', 1, 'Kohod', 9, 'Baros', 4, 'B 9760 UIU', '15:46', '12312312', '1050000', 0, '2025-06-20 15:47:03', '2025-06-20 15:47:03'),
(52, '2025-06-20', 1, 'G', 1, 'Kohod', 9, 'Baros', 3, 'B 9131 UVX', '15:46', '23423423', '1050000', 0, '2025-06-20 15:47:03', '2025-06-20 15:47:03'),
(53, '2025-06-20', 1, 'G', 1, 'Kohod', 9, 'Baros', 2, 'B 9668 UVW', '15:46', '34534534', '1050000', 0, '2025-06-20 15:47:03', '2025-06-20 15:47:03'),
(54, '2025-06-26', 1, 'G', 1, 'Kohod', 9, 'Baros', 1, 'B 9120 UVV', '05:00', '45645645', '1050000', 0, '2025-06-20 15:47:03', '2025-06-26 06:26:33'),
(55, '2025-06-20', 1, 'G', 1, 'Kohod', 12, 'Galian KMP', 7, 'B KMP 1', '15:47', '56756756', '1000000', 0, '2025-06-20 15:47:39', '2025-06-20 15:47:39'),
(56, '2025-06-20', 1, 'G', 1, 'Kohod', 12, 'Galian KMP', 4, 'B 9760 UIU', '15:47', '78978978', '1000000', 0, '2025-06-20 15:47:39', '2025-06-20 15:47:39'),
(57, '2025-06-20', 1, 'G', 1, 'Kohod', 12, 'Galian KMP', 3, 'B 9131 UVX', '15:48', '89089089', '1000000', 0, '2025-06-20 15:47:39', '2025-06-25 21:02:15'),
(58, '2025-06-20', 1, 'G', 1, 'Kohod', 12, 'Galian KMP', 2, 'B 9668 UVW', '15:47', '131313', '1000000', 0, '2025-06-20 15:47:39', '2025-06-20 15:47:39'),
(59, '2025-06-28', 1, 'G', 1, 'Kohod', 12, 'Galian KMP', 1, 'B 9120 UVV', '15:47', '3123123', '1000000', 0, '2025-06-20 15:47:39', '2025-06-20 15:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `start_point` varchar(100) DEFAULT NULL,
  `end_point` varchar(100) DEFAULT NULL,
  `planned_distance` float DEFAULT NULL,
  `actual_distance` float DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `vehicle_id`, `start_point`, `end_point`, `planned_distance`, `actual_distance`, `start_time`, `end_time`, `is_delete`) VALUES
(1, 1, 'Jakarta', 'Bandung', 150, 145, '2025-06-09 07:11:33', '2025-06-09 07:11:33', 0),
(2, 1, 'Jakarta', 'Bogor', 90, 95, '2025-06-09 07:11:38', '2025-06-09 07:11:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tabungan`
--

CREATE TABLE `tabungan` (
  `id` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `status` enum('Aktif','Non Aktif','Servis') DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabungan`
--

INSERT INTO `tabungan` (`id`, `amount`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 30000, 'Aktif', 0, '2025-06-18 06:00:00', '2025-06-18 06:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tim`
--

CREATE TABLE `tim` (
  `id` int(11) NOT NULL,
  `nama_tim` varchar(10) NOT NULL,
  `status_tim` varchar(10) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tim`
--

INSERT INTO `tim` (`id`, `nama_tim`, `status_tim`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'G', 'Aktif', 0, NULL, NULL),
(2, 'K', 'Aktif', 0, NULL, NULL),
(3, 'M', 'Aktif', 0, NULL, NULL),
(4, 'B', 'Aktif', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tim_mgmt`
--

CREATE TABLE `tim_mgmt` (
  `id` int(11) NOT NULL,
  `tim_id` int(11) NOT NULL,
  `nama_tim` varchar(10) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `nama_supir` varchar(20) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `no_pol` varchar(10) NOT NULL,
  `no_pintu` varchar(5) NOT NULL,
  `status_tim_mgmt` varchar(10) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tim_mgmt`
--

INSERT INTO `tim_mgmt` (`id`, `tim_id`, `nama_tim`, `driver_id`, `nama_supir`, `vehicle_id`, `no_pol`, `no_pintu`, `status_tim_mgmt`, `is_delete`, `created_at`, `updated_at`) VALUES
(6, 1, 'G', 17, 'Hendi', 4, 'B 9760 UIU', '51', 'Aktif', 0, '2025-06-19 06:05:28', '2025-06-19 06:05:28'),
(7, 1, 'G', 16, 'Imam Soib', 3, 'B 9131 UVX', '92', 'Aktif', 0, '2025-06-19 06:05:35', '2025-06-19 06:05:35'),
(8, 1, 'G', 15, 'Karna Rahayu', 2, 'B 9668 UVW', '105', 'Aktif', 0, '2025-06-25 09:12:01', '2025-06-25 09:12:01'),
(9, 1, 'G', 14, 'Ahmad Dani', 1, 'B 9120 UVV', '204', 'Aktif', 0, '2025-06-19 06:05:50', '2025-06-19 06:05:50'),
(10, 2, 'K', 18, 'Driver K 1', 5, 'B RI 3', '3', 'Aktif', 0, '2025-06-19 14:45:55', '2025-06-19 14:45:55'),
(11, 2, 'K', 19, 'Driver K 2', 6, 'B RI 4', '4', 'Aktif', 0, '2025-06-19 14:46:02', '2025-06-19 14:46:02'),
(12, 2, 'K', 20, 'Driver KMP 1', 7, 'B KMP 1', '1', 'Non Aktif', 0, '2025-06-20 13:46:21', '2025-06-20 13:46:21'),
(13, 1, 'G', 20, 'Driver KMP 1', 7, 'B KMP 1', '1', 'Non Aktif', 0, '2025-06-25 09:07:18', '2025-06-25 09:07:18'),
(14, 3, 'M', 20, 'Driver KMP 1', 7, 'B KMP 1', '1', 'Non Aktif', 0, '2025-06-20 15:45:24', '2025-06-25 09:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `uangjalan`
--

CREATE TABLE `uangjalan` (
  `id` int(11) NOT NULL,
  `proyek_id` int(11) NOT NULL,
  `galian_id` int(11) NOT NULL,
  `uang_jalan` varchar(10) NOT NULL,
  `status_uangjalan` varchar(10) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `uangjalan`
--

INSERT INTO `uangjalan` (`id`, `proyek_id`, `galian_id`, `uang_jalan`, `status_uangjalan`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 1, ' 900000 ', 'Aktif', 0, '2025-06-29 23:58:05', '2025-06-29 23:58:05'),
(2, 1, 2, '890000', 'Aktif', 0, '2025-06-29 23:59:28', '2025-06-29 23:59:28'),
(3, 1, 4, '900000', 'Aktif', 0, '2025-06-29 23:59:57', '2025-06-29 23:59:57'),
(4, 1, 5, '1050000', 'Aktif', 0, '2025-06-30 00:00:18', '2025-06-30 00:00:18'),
(5, 1, 3, '900000', 'Aktif', 0, '2025-06-30 00:00:37', '2025-06-30 00:00:37'),
(6, 1, 6, '890000', 'Aktif', 0, '2025-06-30 00:00:54', '2025-06-30 00:00:54'),
(7, 1, 7, '700000', 'Aktif', 0, '2025-06-30 00:01:11', '2025-06-30 00:01:11'),
(8, 1, 8, '980000', 'Aktif', 0, '2025-06-30 00:01:30', '2025-06-30 00:01:30'),
(9, 1, 9, '1050000', 'Aktif', 0, '2025-06-30 00:02:11', '2025-06-30 00:02:11'),
(10, 1, 10, '1140000', 'Aktif', 0, '2025-06-30 00:02:37', '2025-06-30 00:02:37'),
(11, 1, 11, '1140000', 'Aktif', 0, '2025-06-30 00:02:54', '2025-06-30 00:02:54'),
(12, 1, 12, '1100000', 'Aktif', 0, '2025-06-30 00:05:04', '2025-06-30 00:05:04'),
(13, 1, 13, '650000', 'Aktif', 0, '2025-06-30 00:06:42', '2025-06-30 00:06:42'),
(14, 1, 14, '900000', 'Aktif', 0, '2025-06-30 00:07:29', '2025-06-30 00:07:29'),
(15, 1, 15, '900000', 'Aktif', 0, '2025-06-30 00:08:16', '2025-06-30 00:08:16'),
(16, 1, 17, '925000', 'Aktif', 0, '2025-06-30 00:09:40', '2025-06-30 00:09:40'),
(17, 1, 18, '800000', 'Aktif', 0, '2025-06-30 00:10:24', '2025-06-30 00:10:24'),
(18, 1, 19, '900000', 'Aktif', 0, '2025-06-30 00:11:01', '2025-06-30 00:11:01'),
(19, 1, 20, '900000', 'Aktif', 0, '2025-06-30 00:11:39', '2025-06-30 00:11:39'),
(20, 1, 21, '750000', 'Aktif', 0, '2025-06-30 00:12:20', '2025-06-30 00:12:20');

-- --------------------------------------------------------

--
-- Table structure for table `uangjalan01`
--

CREATE TABLE `uangjalan01` (
  `id` int(11) NOT NULL,
  `proyek_id` int(11) NOT NULL,
  `galian_id` int(11) NOT NULL,
  `uang_jalan` varchar(10) NOT NULL,
  `status_uangjalan` varchar(10) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `uangjalan01`
--

INSERT INTO `uangjalan01` (`id`, `proyek_id`, `galian_id`, `uang_jalan`, `status_uangjalan`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 1, ' 900000 ', 'Aktif', 0, '2025-06-29 23:58:05', '2025-06-29 23:58:05'),
(2, 1, 2, '890000', 'Aktif', 0, '2025-06-29 23:59:28', '2025-06-29 23:59:28'),
(3, 1, 4, '900000', 'Aktif', 0, '2025-06-29 23:59:57', '2025-06-29 23:59:57'),
(4, 1, 5, '1050000', 'Aktif', 0, '2025-06-30 00:00:18', '2025-06-30 00:00:18'),
(5, 1, 3, '900000', 'Aktif', 0, '2025-06-30 00:00:37', '2025-06-30 00:00:37'),
(6, 1, 6, '890000', 'Aktif', 0, '2025-06-30 00:00:54', '2025-06-30 00:00:54'),
(7, 1, 7, '700000', 'Aktif', 0, '2025-06-30 00:01:11', '2025-06-30 00:01:11'),
(8, 1, 8, '980000', 'Aktif', 0, '2025-06-30 00:01:30', '2025-06-30 00:01:30'),
(9, 1, 9, '1050000', 'Aktif', 0, '2025-06-30 00:02:11', '2025-06-30 00:02:11'),
(10, 1, 10, '1140000', 'Aktif', 0, '2025-06-30 00:02:37', '2025-06-30 00:02:37'),
(11, 1, 11, '1140000', 'Aktif', 0, '2025-06-30 00:02:54', '2025-06-30 00:02:54'),
(12, 1, 12, '1100000', 'Aktif', 0, '2025-06-30 00:05:04', '2025-06-30 00:05:04'),
(13, 1, 13, '650000', 'Aktif', 0, '2025-06-30 00:06:42', '2025-06-30 00:06:42'),
(14, 1, 14, '900000', 'Aktif', 0, '2025-06-30 00:07:29', '2025-06-30 00:07:29'),
(15, 1, 15, '900000', 'Aktif', 0, '2025-06-30 00:08:16', '2025-06-30 00:08:16'),
(16, 1, 17, '925000', 'Aktif', 0, '2025-06-30 00:09:40', '2025-06-30 00:09:40'),
(17, 1, 18, '800000', 'Aktif', 0, '2025-06-30 00:10:24', '2025-06-30 00:10:24'),
(18, 1, 19, '900000', 'Aktif', 0, '2025-06-30 00:11:01', '2025-06-30 00:11:01'),
(19, 1, 20, '900000', 'Aktif', 0, '2025-06-30 00:11:39', '2025-06-30 00:11:39'),
(20, 1, 21, '750000', 'Aktif', 0, '2025-06-30 00:12:20', '2025-06-30 00:12:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `is_delete` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `is_delete`) VALUES
(1, '127.0.0.1', 'sadmin@admin.com', '$2y$10$LGBrRitcFzvV1XSC1ZJlcuXFD9vtF/4jwfauy5VTMPVg7eqmaC2wi', NULL, 'sadmin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1751207153, 1, 'Super', 'Administrator', 'Karya Majujaya Perkasa', '021', 0),
(2, '116.254.102.1', 'febriansyah@gmail.com', '$2y$10$WD51BcoApR2tqkhp/4/qjuewsj.pUvS85ycoGI4wJvYBfU128xTjy', NULL, 'febriansyah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1560495919, 1751207042, 1, 'FPP', '.', 'Karya Majujaya Perkasa', '+6289654654045', 0),
(3, '127.0.0.1', 'user01@user.com', '$2y$10$BgKOegJPKQKv2gsnAG3jauIltDRZCbz3u4Gv2.plsj76or54l/unO', NULL, 'user01@user.com', NULL, '2655b30c346dd9773967fc18ad46c36ee1efc69a', NULL, NULL, NULL, NULL, NULL, 1552496928, 1751207071, 1, 'User', '01', 'Karya Majujaya Perkasa', '021', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_01`
--

CREATE TABLE `users_01` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `role` enum('admin','operator','viewer') DEFAULT 'operator',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_01`
--

INSERT INTO `users_01` (`id`, `name`, `email`, `password_hash`, `role`, `created_at`) VALUES
(1, 'Admin User', 'kmp.group58@gmail.com', '7c222fb2927d828af22f592134e8932480637c0d', 'admin', '2025-05-08 05:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 2),
(4, 4, 2),
(5, 5, 3),
(6, 6, 3),
(7, 7, 3),
(8, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `no_pol` varchar(10) NOT NULL,
  `no_pintu` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `warna` varchar(20) DEFAULT NULL,
  `no_rangka` varchar(17) DEFAULT NULL,
  `no_mesin` varchar(12) DEFAULT NULL,
  `status` enum('Aktif','Non Aktif','Servis') DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `name`, `no_pol`, `no_pintu`, `type`, `warna`, `no_rangka`, `no_mesin`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, NULL, 'B 9056 UIU', 1, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 23:44:53', '2025-06-29 23:44:53'),
(2, NULL, 'B 9057 UIU', 2, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(3, NULL, 'B 9061 UIU', 3, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(4, NULL, 'B 9063 UVX', 4, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(5, NULL, 'B 9065 UIU', 5, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(6, NULL, 'B 9941 UIT', 6, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(7, NULL, 'B 9942 UIT', 7, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(8, NULL, 'B 9943 UIT', 8, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(9, NULL, 'B 9947 UIT', 9, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(10, NULL, 'B 9949 UIT', 10, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(11, NULL, 'B 9417 UIU', 11, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(12, NULL, 'B 9418 UIU', 12, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(13, NULL, 'B 9419 UIU', 13, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(14, NULL, 'B 9420 UIT', 14, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(15, NULL, 'B 9442 UIU', 15, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(16, NULL, 'B 9443 UIU', 16, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(17, NULL, 'B 9445 UIU', 17, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(18, NULL, 'B 9448 UIU', 18, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(19, NULL, 'B 9464 UIU', 19, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(20, NULL, 'B 9508 UIU', 20, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(21, NULL, 'B 9441 UIU', 21, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(22, NULL, 'B 9446 UIU', 22, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(23, NULL, 'B 9447 UIU', 23, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(24, NULL, 'B 9472 UIU', 24, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(25, NULL, 'B 9473 UIU', 25, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(26, NULL, 'B 9381 UIT', 26, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(27, NULL, 'B 9383 UIT', 27, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(28, NULL, 'B 9452 UIT', 28, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(29, NULL, 'B 9453 UIT', 29, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(30, NULL, 'B 9462 UIT', 30, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(31, NULL, 'B 9754 UIU', 31, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(32, NULL, 'B 9755 UIU', 32, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(33, NULL, 'B 9756 UIU', 33, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(34, NULL, 'B 9758 UIU', 34, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(35, NULL, 'B 9773 UIU', 35, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(51, NULL, 'B 9760 UIU', 51, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(52, NULL, 'B 9765 UIU', 52, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(53, NULL, 'B 9766 UIU', 53, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(55, NULL, 'B 9118 UVX', 55, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(56, NULL, 'B 9127 UVX', 56, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(57, NULL, 'B 9103 UVX', 57, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(58, NULL, 'B 9110 UVX', 58, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(59, NULL, 'B 9553 UVX', 59, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(60, NULL, 'B 9600 UVX', 60, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(61, NULL, 'B 9136 UVX', 61, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(62, NULL, 'B 9137 UVX', 62, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(63, NULL, 'B 9139 UVX', 63, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(64, NULL, 'B 9163 UVX', 64, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(65, NULL, 'B 9165 UVX', 65, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(67, NULL, 'B 9675 UVX', 67, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(68, NULL, 'B 9677 UVX', 68, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(69, NULL, 'B 9681 UVX', 69, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(70, NULL, 'B 9716 UVX', 70, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(81, NULL, 'B 9761 UIU', 81, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(82, NULL, 'B 9762 UIU', 82, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(83, NULL, 'B 9767 UIU', 83, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(84, NULL, 'B 9768 UIU', 84, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(85, NULL, 'B 9772 UIU', 85, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(86, NULL, 'B 9776 UIU', 86, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(87, NULL, 'B 9779 UIU', 87, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(91, NULL, 'B 9117 UVX', 91, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(92, NULL, 'B 9131 UVX', 92, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(93, NULL, 'B 9134 UVX', 93, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(94, NULL, 'B 9141 UVX', 94, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(95, NULL, 'B 9142 UVX', 95, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(96, NULL, 'B 9143 UVX', 96, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(97, NULL, 'B 9145 UVX', 97, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(98, NULL, 'B 9148 UVX', 98, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(99, NULL, 'B 9149 UVX', 99, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(101, NULL, 'B 9665 UVW', 101, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(102, NULL, 'B 9671 UVW', 102, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(103, NULL, 'B 9670 UVW', 103, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(104, NULL, 'B 9667 UVW', 104, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(105, NULL, 'B 9668 UVW', 105, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(201, NULL, 'B 9121 UVV', 201, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(202, NULL, 'B 9123 UVV', 202, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(203, NULL, 'B 9124 UVV', 203, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(204, NULL, 'B 9120 UVV', 204, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(205, NULL, 'B 9122 UVV', 205, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(301, NULL, 'B 9089 UVV', 301, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(302, NULL, 'B 9091 UVV', 302, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(303, NULL, 'B 9093 UVV', 303, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(304, NULL, 'B 9092 UVV', 304, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(305, NULL, 'B 9094 UVV', 305, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(501, NULL, 'B 9192 UVV', 501, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(502, NULL, 'B 9193 UVV', 502, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(503, NULL, 'B 9194 UVV', 503, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(504, NULL, 'B 9195 UVV', 504, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(505, NULL, 'B 9196 UVV', 505, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(506, NULL, 'B 9197 UVV', 506, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(507, NULL, 'B 9189 UVV', 507, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(508, NULL, 'B 9188 UVV', 508, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(509, NULL, 'B 9187 UVV', 509, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(510, NULL, 'B 9190 UVV', 510, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(601, NULL, 'B 9593 UVV', 601, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(602, NULL, 'B 9592 UVV', 602, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(603, NULL, 'B 9597 UVV', 603, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(604, NULL, 'B 9591 UVV', 604, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(605, NULL, 'B 9594 UVV', 605, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(701, NULL, 'B 9590 UVV', 701, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(702, NULL, 'B 9581 UVV', 702, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(703, NULL, 'B 9596 UVV', 703, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(704, NULL, 'B 9582 UVV', 704, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(705, NULL, 'B 9580 UVV', 705, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(706, NULL, 'B 9580 UVV', 706, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(801, NULL, '', 801, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(802, NULL, '', 802, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(803, NULL, '', 803, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(805, NULL, '', 805, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(806, NULL, '', 806, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(807, NULL, '', 807, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(808, NULL, '', 808, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(809, NULL, '', 809, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(810, NULL, '', 810, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(811, NULL, '', 811, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(901, NULL, '', 901, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(902, NULL, '', 902, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(903, NULL, '', 903, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(905, NULL, '', 905, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(1077, NULL, 'B 9907 KIT', 77, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles01`
--

CREATE TABLE `vehicles01` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `no_pol` varchar(10) NOT NULL,
  `no_pintu` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `warna` varchar(20) DEFAULT NULL,
  `no_rangka` varchar(17) DEFAULT NULL,
  `no_mesin` varchar(12) DEFAULT NULL,
  `status` enum('Aktif','Non Aktif','Servis') DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles01`
--

INSERT INTO `vehicles01` (`id`, `name`, `no_pol`, `no_pintu`, `type`, `warna`, `no_rangka`, `no_mesin`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, NULL, 'B 9056 UIU', 1, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 23:44:53', '2025-06-29 23:44:53'),
(2, NULL, 'B 9057 UIU', 2, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(3, NULL, 'B 9061 UIU', 3, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(4, NULL, 'B 9063 UVX', 4, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(5, NULL, 'B 9065 UIU', 5, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(6, NULL, 'B 9941 UIT', 6, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(7, NULL, 'B 9942 UIT', 7, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(8, NULL, 'B 9943 UIT', 8, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(9, NULL, 'B 9947 UIT', 9, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(10, NULL, 'B 9949 UIT', 10, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(11, NULL, 'B 9417 UIU', 11, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(12, NULL, 'B 9418 UIU', 12, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(13, NULL, 'B 9419 UIU', 13, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(14, NULL, 'B 9420 UIT', 14, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(15, NULL, 'B 9442 UIU', 15, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(16, NULL, 'B 9443 UIU', 16, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(17, NULL, 'B 9445 UIU', 17, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(18, NULL, 'B 9448 UIU', 18, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(19, NULL, 'B 9464 UIU', 19, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(20, NULL, 'B 9508 UIU', 20, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(21, NULL, 'B 9441 UIU', 21, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(22, NULL, 'B 9446 UIU', 22, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(23, NULL, 'B 9447 UIU', 23, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(24, NULL, 'B 9472 UIU', 24, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(25, NULL, 'B 9473 UIU', 25, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(26, NULL, 'B 9381 UIT', 26, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(27, NULL, 'B 9383 UIT', 27, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(28, NULL, 'B 9452 UIT', 28, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(29, NULL, 'B 9453 UIT', 29, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(30, NULL, 'B 9462 UIT', 30, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(31, NULL, 'B 9754 UIU', 31, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(32, NULL, 'B 9755 UIU', 32, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(33, NULL, 'B 9756 UIU', 33, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(34, NULL, 'B 9758 UIU', 34, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(35, NULL, 'B 9773 UIU', 35, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(51, NULL, 'B 9760 UIU', 51, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(52, NULL, 'B 9765 UIU', 52, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(53, NULL, 'B 9766 UIU', 53, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(55, NULL, 'B 9118 UVX', 55, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(56, NULL, 'B 9127 UVX', 56, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(57, NULL, 'B 9103 UVX', 57, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(58, NULL, 'B 9110 UVX', 58, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(59, NULL, 'B 9553 UVX', 59, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(60, NULL, 'B 9600 UVX', 60, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(61, NULL, 'B 9136 UVX', 61, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(62, NULL, 'B 9137 UVX', 62, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(63, NULL, 'B 9139 UVX', 63, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(64, NULL, 'B 9163 UVX', 64, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(65, NULL, 'B 9165 UVX', 65, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(67, NULL, 'B 9675 UVX', 67, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(68, NULL, 'B 9677 UVX', 68, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(69, NULL, 'B 9681 UVX', 69, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(70, NULL, 'B 9716 UVX', 70, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(81, NULL, 'B 9761 UIU', 81, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(82, NULL, 'B 9762 UIU', 82, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(83, NULL, 'B 9767 UIU', 83, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(84, NULL, 'B 9768 UIU', 84, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(85, NULL, 'B 9772 UIU', 85, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(86, NULL, 'B 9776 UIU', 86, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(87, NULL, 'B 9779 UIU', 87, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(91, NULL, 'B 9117 UVX', 91, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(92, NULL, 'B 9131 UVX', 92, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(93, NULL, 'B 9134 UVX', 93, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(94, NULL, 'B 9141 UVX', 94, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(95, NULL, 'B 9142 UVX', 95, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(96, NULL, 'B 9143 UVX', 96, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(97, NULL, 'B 9145 UVX', 97, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(98, NULL, 'B 9148 UVX', 98, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(99, NULL, 'B 9149 UVX', 99, 'FM 260 JD', 'HIJAU', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(101, NULL, 'B 9665 UVW', 101, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(102, NULL, 'B 9671 UVW', 102, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(103, NULL, 'B 9670 UVW', 103, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(104, NULL, 'B 9667 UVW', 104, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(105, NULL, 'B 9668 UVW', 105, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(201, NULL, 'B 9121 UVV', 201, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(202, NULL, 'B 9123 UVV', 202, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(203, NULL, 'B 9124 UVV', 203, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(204, NULL, 'B 9120 UVV', 204, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(205, NULL, 'B 9122 UVV', 205, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(301, NULL, 'B 9089 UVV', 301, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(302, NULL, 'B 9091 UVV', 302, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(303, NULL, 'B 9093 UVV', 303, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(304, NULL, 'B 9092 UVV', 304, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(305, NULL, 'B 9094 UVV', 305, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(501, NULL, 'B 9192 UVV', 501, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(502, NULL, 'B 9193 UVV', 502, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(503, NULL, 'B 9194 UVV', 503, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(504, NULL, 'B 9195 UVV', 504, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(505, NULL, 'B 9196 UVV', 505, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(506, NULL, 'B 9197 UVV', 506, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(507, NULL, 'B 9189 UVV', 507, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(508, NULL, 'B 9188 UVV', 508, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(509, NULL, 'B 9187 UVV', 509, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(510, NULL, 'B 9190 UVV', 510, 'GIGA FVZ N', 'PUTIH', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(601, NULL, 'B 9593 UVV', 601, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(602, NULL, 'B 9592 UVV', 602, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(603, NULL, 'B 9597 UVV', 603, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(604, NULL, 'B 9591 UVV', 604, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(605, NULL, 'B 9594 UVV', 605, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(701, NULL, 'B 9590 UVV', 701, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(702, NULL, 'B 9581 UVV', 702, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(703, NULL, 'B 9596 UVV', 703, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(704, NULL, 'B 9582 UVV', 704, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(705, NULL, 'B 9580 UVV', 705, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(706, NULL, 'B 9580 UVV', 706, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(801, NULL, '', 801, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(802, NULL, '', 802, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(803, NULL, '', 803, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(805, NULL, '', 805, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(806, NULL, '', 806, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(807, NULL, '', 807, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(808, NULL, '', 808, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(809, NULL, '', 809, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(810, NULL, '', 810, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(811, NULL, '', 811, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(901, NULL, '', 901, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(902, NULL, '', 902, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(903, NULL, '', 903, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(905, NULL, '', 905, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(1077, NULL, 'B 9907 KIT', 77, '', '', NULL, NULL, 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_documents`
--

CREATE TABLE `vehicle_documents` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `doc_type` varchar(50) DEFAULT NULL,
  `doc_number` varchar(100) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `file_url` text DEFAULT NULL,
  `status` enum('Aktif','Non Aktif') DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_tracking`
--

CREATE TABLE `vehicle_tracking` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `speed` float DEFAULT NULL,
  `direction` varchar(10) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_tracking`
--

INSERT INTO `vehicle_tracking` (`id`, `vehicle_id`, `latitude`, `longitude`, `speed`, `direction`, `timestamp`) VALUES
(1, 1, -6.1751000, 106.8650000, 60.5, 'utara', '2025-05-08 05:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `v_doc_detail`
--

CREATE TABLE `v_doc_detail` (
  `id` int(11) DEFAULT NULL,
  `name` text DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `doc_type` varchar(100) DEFAULT NULL,
  `doc_number` varchar(100) DEFAULT NULL,
  `expiry_date` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `is_delete` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `balance` float DEFAULT 0,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `driver_id`, `balance`, `is_delete`, `created_at`, `updated_at`) VALUES
(8, 14, 140000, 0, '2025-06-19 06:03:16', '2025-06-24 17:43:23'),
(9, 15, 150000, 0, '2025-06-19 06:04:34', '2025-06-24 17:41:59'),
(10, 16, 60000, 0, '2025-06-19 06:04:53', '2025-06-20 15:47:39'),
(11, 17, 110000, 0, '2025-06-19 06:05:17', '2025-06-28 17:33:41'),
(12, 18, 0, 0, '2025-06-19 14:45:03', '2025-06-19 14:46:29'),
(13, 19, 0, 0, '2025-06-19 14:45:22', '2025-06-19 14:46:29'),
(14, 20, 90000, 0, '2025-06-20 13:40:39', '2025-06-24 10:34:03'),
(15, 21, 0, 0, '2025-06-24 10:21:58', '2025-06-24 10:21:58');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` int(11) NOT NULL,
  `wallet_id` int(11) NOT NULL,
  `transaction_type` enum('credit','debit') NOT NULL,
  `amount` float NOT NULL,
  `id_ritasi` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('belum','sudah') DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `wallet_id`, `transaction_type`, `amount`, `id_ritasi`, `description`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(12, 8, 'debit', 0, NULL, 'Initial balance', 'belum', 0, '2025-06-19 06:03:16', '2025-06-23 00:27:28'),
(13, 9, 'debit', 0, NULL, 'Initial balance', 'belum', 0, '2025-06-19 06:04:34', '2025-06-19 06:04:34'),
(14, 10, 'debit', 0, NULL, 'Initial balance', 'sudah', 0, '2025-06-19 06:04:53', '2025-06-24 11:11:43'),
(15, 11, 'debit', 0, NULL, 'Initial balance', 'sudah', 0, '2025-06-19 06:05:17', '2025-06-24 11:21:59'),
(42, 12, 'debit', 0, NULL, 'Initial balance', 'belum', 0, '2025-06-19 14:45:03', '2025-06-19 14:45:03'),
(43, 13, 'debit', 0, NULL, 'Initial balance', 'belum', 0, '2025-06-19 14:45:22', '2025-06-19 14:45:22'),
(62, 14, 'debit', 0, NULL, 'Initial balance', 'sudah', 0, '2025-06-20 13:40:39', '2025-06-24 11:01:34'),
(63, 11, 'credit', 30000, 48, 'Tabungan DO - 11111', 'sudah', 0, '2025-06-20 13:58:13', '2025-06-24 11:21:59'),
(64, 11, 'debit', 1000000, 48, 'Uang Jalan DO - 11111', 'sudah', 0, '2025-06-20 13:58:13', '2025-06-24 11:21:59'),
(65, 14, 'credit', 30000, 49, 'Tabungan DO - 222222', 'sudah', 0, '2025-06-20 13:58:13', '2025-06-24 11:01:34'),
(66, 14, 'debit', 1000000, 49, 'Uang Jalan DO - 222222', 'sudah', 0, '2025-06-20 13:58:13', '2025-06-24 11:01:34'),
(67, 11, 'credit', 30000, 50, 'Tabungan DO - 33333', 'sudah', 0, '2025-06-20 13:59:59', '2025-06-24 11:21:59'),
(68, 11, 'debit', 1000000, 50, 'Uang Jalan DO - 33333', 'sudah', 0, '2025-06-20 13:59:59', '2025-06-24 11:21:59'),
(69, 11, 'credit', 30000, 51, 'Tabungan DO - 123123123', 'sudah', 0, '2025-06-20 15:47:03', '2025-06-24 11:21:59'),
(70, 11, 'debit', 1050000, 51, 'Uang Jalan DO - 123123123', 'sudah', 0, '2025-06-20 15:47:03', '2025-06-24 11:21:59'),
(71, 10, 'credit', 30000, 52, 'Tabungan DO - 234234234', 'sudah', 0, '2025-06-20 15:47:03', '2025-06-24 11:11:43'),
(72, 10, 'debit', 1050000, 52, 'Uang Jalan DO - 234234234', 'sudah', 0, '2025-06-20 15:47:03', '2025-06-24 11:11:43'),
(73, 9, 'credit', 30000, 53, 'Tabungan DO - 345345345', 'belum', 0, '2025-06-20 15:47:03', '2025-06-20 15:47:03'),
(74, 9, 'debit', 1050000, 53, 'Uang Jalan DO - 345345345', 'belum', 0, '2025-06-20 15:47:03', '2025-06-20 15:48:43'),
(75, 8, 'credit', 30000, 54, 'Tabungan DO - 456456456', 'belum', 0, '2025-06-20 15:47:03', '2025-06-23 00:27:28'),
(76, 8, 'debit', 1050000, 54, 'Uang Jalan DO - 456456456', 'belum', 0, '2025-06-20 15:47:03', '2025-06-23 00:27:28'),
(77, 14, 'credit', 30000, 55, 'Tabungan DO - 567567567', 'sudah', 0, '2025-06-20 15:47:39', '2025-06-24 11:01:34'),
(78, 14, 'debit', 1000000, 55, 'Uang Jalan DO - 567567567', 'sudah', 0, '2025-06-20 15:47:39', '2025-06-24 11:01:34'),
(79, 11, 'credit', 30000, 56, 'Tabungan DO - 789789789', 'sudah', 0, '2025-06-20 15:47:39', '2025-06-24 11:21:59'),
(80, 11, 'debit', 1000000, 56, 'Uang Jalan DO - 789789789', 'sudah', 0, '2025-06-20 15:47:39', '2025-06-24 11:21:59'),
(81, 10, 'credit', 30000, 57, 'Tabungan DO - 890890890', 'sudah', 0, '2025-06-20 15:47:39', '2025-06-24 11:11:43'),
(82, 10, 'debit', 1000000, 57, 'Uang Jalan DO - 890890890', 'sudah', 0, '2025-06-20 15:47:39', '2025-06-24 11:11:43'),
(83, 9, 'credit', 30000, 58, 'Tabungan DO - 131313', 'belum', 0, '2025-06-20 15:47:39', '2025-06-20 15:47:39'),
(84, 9, 'debit', 1000000, 58, 'Uang Jalan DO - 131313', 'sudah', 0, '2025-06-20 15:47:39', '2025-06-23 02:22:23'),
(85, 8, 'credit', 30000, 59, 'Tabungan DO - 3123123', 'belum', 0, '2025-06-20 15:47:39', '2025-06-23 00:27:28'),
(86, 8, 'debit', 1000000, 59, 'Uang Jalan DO - 3123123', 'sudah', 0, '2025-06-20 15:47:39', '2025-06-23 02:22:23'),
(87, 15, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-24 10:21:58', '2025-06-24 10:21:58'),
(88, 14, 'credit', 30000, 60, 'Tabungan DO - 41379', 'sudah', 0, '2025-06-24 10:34:03', '2025-06-24 11:01:34'),
(89, 14, 'debit', 1050000, 60, 'Uang Jalan DO - 41379', 'sudah', 0, '2025-06-24 10:34:03', '2025-06-24 11:01:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alerts_ibfk_1` (`vehicle_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers2`
--
ALTER TABLE `drivers2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuel_logs`
--
ALTER TABLE `fuel_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fuel_logs_ibfk_1` (`vehicle_id`);

--
-- Indexes for table `galian`
--
ALTER TABLE `galian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galian01`
--
ALTER TABLE `galian01`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incidents_ibfk_1` (`vehicle_id`),
  ADD KEY `incidents_ibfk_2` (`driver_id`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenance_logs_ibfk_1` (`vehicle_id`);

--
-- Indexes for table `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `proyek01`
--
ALTER TABLE `proyek01`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ritasi`
--
ALTER TABLE `ritasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim`
--
ALTER TABLE `tim`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim_mgmt`
--
ALTER TABLE `tim_mgmt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uangjalan`
--
ALTER TABLE `uangjalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uangjalan01`
--
ALTER TABLE `uangjalan01`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`);

--
-- Indexes for table `users_01`
--
ALTER TABLE `users_01`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles01`
--
ALTER TABLE `vehicles01`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_documents`
--
ALTER TABLE `vehicle_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_documents_ibfk_1` (`vehicle_id`);

--
-- Indexes for table `vehicle_tracking`
--
ALTER TABLE `vehicle_tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_tracking_ibfk_1` (`vehicle_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `drivers2`
--
ALTER TABLE `drivers2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `fuel_logs`
--
ALTER TABLE `fuel_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `galian`
--
ALTER TABLE `galian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `galian01`
--
ALTER TABLE `galian01`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `proyek01`
--
ALTER TABLE `proyek01`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ritasi`
--
ALTER TABLE `ritasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tim`
--
ALTER TABLE `tim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tim_mgmt`
--
ALTER TABLE `tim_mgmt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `uangjalan`
--
ALTER TABLE `uangjalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `uangjalan01`
--
ALTER TABLE `uangjalan01`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users_01`
--
ALTER TABLE `users_01`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1078;

--
-- AUTO_INCREMENT for table `vehicles01`
--
ALTER TABLE `vehicles01`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1078;

--
-- AUTO_INCREMENT for table `vehicle_documents`
--
ALTER TABLE `vehicle_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicle_tracking`
--
ALTER TABLE `vehicle_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alerts`
--
ALTER TABLE `alerts`
  ADD CONSTRAINT `alerts_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Constraints for table `fuel_logs`
--
ALTER TABLE `fuel_logs`
  ADD CONSTRAINT `fuel_logs_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Constraints for table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `incidents_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`),
  ADD CONSTRAINT `incidents_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`);

--
-- Constraints for table `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  ADD CONSTRAINT `maintenance_logs_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Constraints for table `vehicle_documents`
--
ALTER TABLE `vehicle_documents`
  ADD CONSTRAINT `vehicle_documents_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Constraints for table `vehicle_tracking`
--
ALTER TABLE `vehicle_tracking`
  ADD CONSTRAINT `vehicle_tracking_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
