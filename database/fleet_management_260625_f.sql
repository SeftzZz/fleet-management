-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2025 at 03:11 PM
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
(9, 1, 'Baros', 'Aktif', 0, '2025-06-11 11:02:56', '2025-06-11 11:02:56'),
(10, 1, 'Cilegon', 'Aktif', 0, '2025-06-11 11:03:13', '2025-06-11 11:03:13'),
(11, 1, 'Bojonegara', 'Aktif', 0, '2025-06-11 12:28:42', '2025-06-11 12:28:42'),
(12, 4, 'Galian KMP', 'Aktif', 0, '2025-06-20 13:55:41', '2025-06-20 13:55:41');

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
(6, '127.0.0.1', 'asdf', 1750851055);

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
(3, 'Sumber Baru', 'Non Aktif', 0, '2025-06-11 09:55:47', '2025-06-11 09:55:47'),
(4, 'Proyek KMP', 'Aktif', 0, '2025-06-20 13:55:22', '2025-06-20 13:55:22');

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
(48, '2025-06-20', 1, 'G', 4, 'Proyek KMP', 12, 'Galian KMP', 4, 'B 9760 UIU', '13:58', '11111', '1000000', 0, '2025-06-20 13:58:13', '2025-06-20 13:58:13'),
(49, '2025-06-20', 1, 'G', 4, 'Proyek KMP', 12, 'Galian KMP', 7, 'B KMP 1', '13:58', '222222', '1000000', 0, '2025-06-20 13:58:13', '2025-06-20 13:58:13'),
(50, '2025-06-21', 1, 'G', 4, 'Proyek KMP', 12, 'Galian KMP', 4, 'B 9760 UIU', '13:58', '33333', '1000000', 0, '2025-06-20 13:59:59', '2025-06-20 13:59:59'),
(51, '2025-06-20', 1, 'G', 1, 'Kohod', 9, 'Baros', 4, 'B 9760 UIU', '15:46', '12312312', '1050000', 0, '2025-06-20 15:47:03', '2025-06-20 15:47:03'),
(52, '2025-06-20', 1, 'G', 1, 'Kohod', 9, 'Baros', 3, 'B 9131 UVX', '15:46', '23423423', '1050000', 0, '2025-06-20 15:47:03', '2025-06-20 15:47:03'),
(53, '2025-06-20', 1, 'G', 1, 'Kohod', 9, 'Baros', 2, 'B 9668 UVW', '15:46', '34534534', '1050000', 0, '2025-06-20 15:47:03', '2025-06-20 15:47:03'),
(54, '2025-06-26', 1, 'G', 1, 'Kohod', 9, 'Baros', 1, 'B 9120 UVV', '05:00', '45645645', '1050000', 0, '2025-06-20 15:47:03', '2025-06-26 06:26:33'),
(55, '2025-06-20', 1, 'G', 4, 'Proyek KMP', 12, 'Galian KMP', 7, 'B KMP 1', '15:47', '56756756', '1000000', 0, '2025-06-20 15:47:39', '2025-06-20 15:47:39'),
(56, '2025-06-20', 1, 'G', 4, 'Proyek KMP', 12, 'Galian KMP', 4, 'B 9760 UIU', '15:47', '78978978', '1000000', 0, '2025-06-20 15:47:39', '2025-06-20 15:47:39'),
(57, '2025-06-20', 1, 'G', 4, 'Proyek KMP', 12, 'Galian KMP', 3, 'B 9131 UVX', '15:48', '89089089', '1000000', 0, '2025-06-20 15:47:39', '2025-06-25 21:02:15'),
(58, '2025-06-20', 1, 'G', 4, 'Proyek KMP', 12, 'Galian KMP', 2, 'B 9668 UVW', '15:47', '131313', '1000000', 0, '2025-06-20 15:47:39', '2025-06-20 15:47:39'),
(59, '2025-06-20', 1, 'G', 4, 'Proyek KMP', 12, 'Galian KMP', 1, 'B 9120 UVV', '15:47', '3123123', '1000000', 0, '2025-06-20 15:47:39', '2025-06-20 15:47:39');

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
(1, 1, 1, '900000', 'Non Aktif', 0, '2025-06-11 12:27:22', '2025-06-15 01:55:03'),
(2, 1, 2, '890000', 'Aktif', 0, '2025-06-10 14:46:58', '2025-06-10 15:30:22'),
(3, 1, 3, '900000', 'Aktif', 0, '2025-06-10 11:03:06', '2025-06-10 14:49:36'),
(4, 1, 4, '900000', 'Aktif', 0, '2025-06-10 11:03:06', '2025-06-10 11:03:06'),
(5, 1, 5, '1050000', 'Aktif', 0, '2025-06-10 14:30:46', '2025-06-10 14:30:46'),
(6, 1, 6, '890000', 'Aktif', 0, '2025-06-11 11:04:40', '2025-06-11 11:04:40'),
(7, 1, 7, '700000', 'Aktif', 0, '2025-06-11 11:06:39', '2025-06-11 11:06:39'),
(8, 1, 8, '950000', 'Aktif', 0, '2025-06-11 11:55:21', '2025-06-11 11:55:21'),
(9, 1, 9, '1050000', 'Aktif', 0, '2025-06-11 12:27:04', '2025-06-11 12:27:04'),
(10, 1, 10, '1140000', 'Aktif', 0, '2025-06-11 12:28:11', '2025-06-11 12:28:11'),
(11, 1, 11, '1140000', 'Aktif', 0, '2025-06-11 12:28:58', '2025-06-11 12:28:58'),
(12, 1, 1, '950000', 'Non Aktif', 1, '2025-06-15 01:46:34', '2025-06-15 01:54:53'),
(13, 1, 1, '950000', 'Aktif', 0, '2025-06-15 01:55:03', '2025-06-15 01:55:03'),
(14, 4, 12, '800000', 'Non Aktif', 0, '2025-06-20 13:55:56', '2025-06-20 13:56:56'),
(15, 4, 12, '1000000', 'Aktif', 0, '2025-06-20 13:56:56', '2025-06-20 13:56:56');

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
  `id_karyawan` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `id_karyawan`) VALUES
(1, '127.0.0.1', 'admin@admin.com', '$2y$10$nU8GqgqEBLob7JjbI8nr1.BCqi3ukuX1CVQtesYLeO.hvBPFXThru', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1750928082, 1, 'Administrator', '.', 'IUWASH PLUS', '021', 0),
(2, '116.254.102.1', 'febriansyah@gmail.com', '$2y$12$z..uB2vwkSPdmwRORsK6MelTfZ1YUJoIHZp25wpmrUCxIkN66r8kW', NULL, 'febriansyah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1560495919, 1707792449, 1, 'FPP', '.', 'Konsultan', '+6289654654045', 0),
(3, '127.0.0.1', 'user01@user.com', '$2y$10$agyyRErh9zTimzQ59sVwxu3dnlFCsCRfYS0UPmxcd6hEkQ6NJOcPi', NULL, 'user01@user.com', NULL, '2655b30c346dd9773967fc18ad46c36ee1efc69a', NULL, NULL, NULL, NULL, NULL, 1552496928, 1643560394, 1, 'User', '01', NULL, '021', 0);

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
(1, NULL, 'B 9120 UVV', 204, 'GIGA FVZ N', 'Putih', '', '', 'Aktif', 0, '2025-05-08 05:14:10', '2025-06-25 10:14:15'),
(2, NULL, 'B 9668 UVW', 105, 'GIGA FVZ N', 'Putih', '', '', 'Aktif', 0, '2025-05-08 05:14:10', '2025-06-10 09:30:14'),
(3, NULL, 'B 9131 UVX', 92, 'FM 260 JD', 'Hijau', '', '', 'Aktif', 0, '2025-05-08 05:14:10', '2025-06-12 09:25:13'),
(4, NULL, 'B 9760 UIU', 51, 'FM 260 JD', 'Hijau', '', '', 'Aktif', 0, '2025-05-08 05:14:10', '2025-06-12 09:20:33'),
(5, NULL, 'B RI 3', 3, 'FM 260 JD', 'Hitam', '', '', 'Aktif', 0, '2025-06-19 14:45:37', '2025-06-19 14:45:37'),
(6, NULL, 'B RI 4', 4, 'GIGA FVZ N', 'Hitam', '', '', 'Aktif', 0, '2025-06-19 14:45:45', '2025-06-19 14:45:45'),
(7, NULL, 'B KMP 1', 1, 'FM 260 JD', 'Hitam', '', '', 'Aktif', 0, '2025-06-20 13:35:44', '2025-06-20 13:35:44');

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
(8, 14, 60000, 0, '2025-06-19 06:03:16', '2025-06-20 15:47:39'),
(9, 15, 60000, 0, '2025-06-19 06:04:34', '2025-06-20 15:47:39'),
(10, 16, 60000, 0, '2025-06-19 06:04:53', '2025-06-20 15:47:39'),
(11, 17, 120000, 0, '2025-06-19 06:05:17', '2025-06-20 15:47:39'),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

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
