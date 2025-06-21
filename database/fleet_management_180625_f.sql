-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2025 at 02:51 PM
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
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `license_number`, `phone`, `tgl_join`, `tgl_lahir`, `alamat`, `nomor_darurat`, `tgl_exp_sim`, `img_profile`, `img_sim`, `img_ktp`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Risandi Depri', 'AB123456789', '08123456789', '2025-01-01', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Aktif', 0, '2025-05-08 05:14:13', '2025-06-18 12:07:22'),
(2, 'Wandi Anwar Wahyudi', 'AB123456700', '08123456788', '2025-02-01', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Aktif', 0, '2025-05-08 05:14:13', '2025-06-16 00:30:44'),
(3, 'Cacang', 'AB123456700', '08123456787', '2025-03-01', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Aktif', 0, '2025-05-08 05:14:13', '2025-06-16 00:30:44'),
(4, 'Karna', 'AB123456700', '08123456786', '2025-04-01', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Aktif', 0, '2025-05-08 05:14:13', '2025-06-16 00:30:44'),
(5, 'Wisnu Muhammad', 'AB123456700', '08123456785', '2025-05-01', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Aktif', 0, '2025-05-08 05:14:13', '2025-06-16 00:30:44'),
(6, 'Aris', 'AB123456700', '08123456784', '2025-06-01', NULL, NULL, NULL, NULL, NULL, NULL, '', 'Aktif', 0, '2025-05-08 05:14:13', '2025-06-16 00:30:44'),
(13, 'Driver 1', 'ABC12345', '081234567890', '2025-06-02', '2000-05-24', 'Jl. Swadaya', '081209876543', '2026-01-01', 'IMG-20210211-WA0004.jpg', 'IMG-20210617-WA0005.jpg', 'IMG-20211002-WA0005.jpg', 'Aktif', 0, '2025-06-16 01:12:43', '2025-06-18 18:54:00');

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
(11, 1, 'Bojonegara', 'Aktif', 0, '2025-06-11 12:28:42', '2025-06-11 12:28:42');

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

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`id`, `vehicle_id`, `driver_id`, `description`, `incident_date`, `location`, `severity`) VALUES
(1, 1, 1, 'Kecelakaan ringan di jalan raya', '2025-05-07 10:00:00', 'Jl. Merdeka, Jakarta', 'ringan');

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
(3, 'Sumber Baru', 'Non Aktif', 0, '2025-06-11 09:55:47', '2025-06-11 09:55:47');

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
(1, '2024-10-01', 1, 'G', 1, 'Kohod', 1, 'Ciujug', 1, 'B 9120 UVV', '02:20', '35428', '900000', 0, '2025-06-10 08:38:17', '2025-06-13 10:56:05'),
(2, '2024-10-01', 1, 'G', 1, 'Kohod', 1, 'Ciujug', 1, 'B 9120 UVV', '02:26', '35493', '900000', 0, '2025-06-10 08:38:17', '2025-06-13 22:19:08'),
(3, '2025-06-12', 2, 'K', 1, 'Kohod', 5, 'Ciomas', 2, 'B 9668 UVW', '16:11', '12345', '1050000', 0, '2025-06-14 16:11:31', '2025-06-14 16:11:31'),
(4, '2025-06-15', 2, 'K', 1, 'Kohod', 1, 'Ciujug', 4, 'B 9760 UIU', '02:28', '12345', '950000', 0, '2025-06-15 02:28:37', '2025-06-15 02:28:37'),
(24, '2025-06-16', 1, 'G', 1, 'Kohod', 9, 'Baros', 4, 'B 9760 UIU', '02:01', '897456', '1050000', 0, '2025-06-16 02:01:14', '2025-06-16 02:01:14');

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
(1, 30000, 'Aktif', 0, '2025-06-16 01:12:43', '2025-06-16 01:26:40');

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
  `nama_supir` varchar(10) NOT NULL,
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
(1, 1, 'G', 3, 'Cacang', 1, 'B 9120 UVV', '204', 'Non Aktif', 0, '2025-06-15 04:06:58', '2025-06-15 04:39:20'),
(2, 1, 'G', 5, 'Wisnu Muha', 1, 'B 9120 UVV', '204', 'Aktif', 0, '2025-06-15 04:39:20', '2025-06-15 04:39:20'),
(3, 2, 'K', 5, 'Wisnu Muha', 4, 'B 9760 UIU', '51', 'Non Aktif', 0, '2025-06-12 17:22:16', '2025-06-15 04:39:20'),
(4, 1, 'G', 1, 'Risandi De', 3, 'B 9131 UVX', '92', 'Aktif', 0, '2025-06-15 22:06:27', '2025-06-15 22:06:27'),
(5, 1, 'G', 13, 'Driver 1', 4, 'B 9760 UIU', '51', 'Aktif', 0, '2025-06-16 02:01:00', '2025-06-16 02:01:00');

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
(13, 1, 1, '950000', 'Aktif', 0, '2025-06-15 01:55:03', '2025-06-15 01:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `role` enum('admin','operator','viewer') DEFAULT 'operator',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password_hash`, `role`, `created_at`) VALUES
(1, 'Admin User', 'admin@company.com', 'hashed_password_example', 'admin', '2025-05-08 05:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `no_pol` varchar(10) NOT NULL,
  `no_pintu` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `warna` varchar(20) DEFAULT NULL,
  `status` enum('Aktif','Non Aktif','Servis') DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `no_pol`, `no_pintu`, `type`, `warna`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'B 9120 UVV', 204, 'GIGA FVZ N', 'Putih', 'Aktif', 0, '2025-05-08 05:14:10', '2025-06-10 09:30:14'),
(2, 'B 9668 UVW', 105, 'GIGA FVZ N', 'Putih', 'Aktif', 0, '2025-05-08 05:14:10', '2025-06-10 09:30:14'),
(3, 'B 9131 UVX', 92, 'FM 260 JD', 'Hijau', 'Aktif', 0, '2025-05-08 05:14:10', '2025-06-12 09:25:13'),
(4, 'B 9760 UIU', 51, 'FM 260 JD', 'Hijau', 'Aktif', 0, '2025-05-08 05:14:10', '2025-06-12 09:20:33');

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
  `file_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_documents`
--

INSERT INTO `vehicle_documents` (`id`, `vehicle_id`, `doc_type`, `doc_number`, `expiry_date`, `file_url`) VALUES
(1, 1, 'STNK', 'STNK123456', '2026-05-07', 'https://example.com/file.pdf');

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
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `balance` float DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `driver_id`, `balance`, `created_at`, `updated_at`) VALUES
(6, 13, 60000, '2025-06-16 02:13:33', '2025-06-16 02:13:33');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

CREATE TABLE `wallet_transactions` (
  `id` int(11) NOT NULL,
  `wallet_id` int(11) NOT NULL,
  `transaction_type` enum('credit','debit') NOT NULL,
  `amount` float NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `wallet_id`, `transaction_type`, `amount`, `description`, `created_at`, `updated_at`) VALUES
(3, 6, 'credit', 0, 'Initial balance', '2025-06-16 01:12:43', '2025-06-16 01:12:43'),
(4, 6, 'credit', 30000, 'Tabungan DO - 897456', '2025-06-16 02:01:14', '2025-06-16 02:01:14'),
(10, 6, 'credit', 30000, 'Tabungan DO - 897456', '2025-06-16 02:13:33', '2025-06-16 02:13:33'),
(11, 6, 'debit', 1050000, 'Uang Jalan DO - 897456', '2025-06-16 02:13:33', '2025-06-16 02:13:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fuel_logs`
--
ALTER TABLE `fuel_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galian`
--
ALTER TABLE `galian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_documents`
--
ALTER TABLE `vehicle_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_tracking`
--
ALTER TABLE `vehicle_tracking`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `fuel_logs`
--
ALTER TABLE `fuel_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `galian`
--
ALTER TABLE `galian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- AUTO_INCREMENT for table `ritasi`
--
ALTER TABLE `ritasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `uangjalan`
--
ALTER TABLE `uangjalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vehicle_documents`
--
ALTER TABLE `vehicle_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle_tracking`
--
ALTER TABLE `vehicle_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alerts`
--
ALTER TABLE `alerts`
  ADD CONSTRAINT `alerts_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles2` (`id`);

--
-- Constraints for table `fuel_logs`
--
ALTER TABLE `fuel_logs`
  ADD CONSTRAINT `fuel_logs_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles2` (`id`);

--
-- Constraints for table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `incidents_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles2` (`id`),
  ADD CONSTRAINT `incidents_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `drivers3` (`id`);

--
-- Constraints for table `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  ADD CONSTRAINT `maintenance_logs_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles2` (`id`);

--
-- Constraints for table `vehicle_documents`
--
ALTER TABLE `vehicle_documents`
  ADD CONSTRAINT `vehicle_documents_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles2` (`id`);

--
-- Constraints for table `vehicle_tracking`
--
ALTER TABLE `vehicle_tracking`
  ADD CONSTRAINT `vehicle_tracking_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles2` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
