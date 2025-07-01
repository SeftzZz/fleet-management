-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2025 at 12:24 PM
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
  `created_at` datetime DEFAULT current_timestamp()
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
  `status` enum('aktif','tidak aktif') DEFAULT 'aktif',
  `assigned_vehicle_id` int(11) DEFAULT NULL,
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `license_number`, `phone`, `status`, `assigned_vehicle_id`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'AB123456789', '08123456789', 'aktif', NULL, 0, '2025-05-08 05:14:13', '2025-05-08 05:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `drivers2`
--

CREATE TABLE `drivers2` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `license_number` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` enum('aktif','tidak aktif') DEFAULT 'aktif',
  `assigned_vehicle_id` int(11) DEFAULT NULL,
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drivers2`
--

INSERT INTO `drivers2` (`id`, `name`, `license_number`, `phone`, `status`, `assigned_vehicle_id`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'AB123456789', '08123456789', 'aktif', NULL, 0, '2025-05-08 05:14:13', '2025-05-08 05:14:13');

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
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `galian`
--

INSERT INTO `galian` (`id`, `proyek_id`, `lokasi`, `status_lokasi`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'Ciujug', 'aktif', 0, '2025-06-10 08:30:40', '2025-06-10 08:30:40'),
(2, 1, 'Multikon', 'aktif', 0, '2025-06-10 08:31:15', '2025-06-10 08:31:15'),
(3, 1, 'Tapen', 'aktif', 0, '2025-06-10 08:31:15', '2025-06-10 08:31:15'),
(4, 1, 'Mede', 'aktif', 0, '2025-06-10 08:31:15', '2025-06-10 08:31:15'),
(5, 1, 'Ciomas', 'aktif', 0, '2025-06-10 08:31:15', '2025-06-10 08:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `galian2`
--

CREATE TABLE `galian2` (
  `id` int(11) NOT NULL,
  `proyek_id` int(11) NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `status_lokasi` varchar(10) NOT NULL,
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `proyek`
--

INSERT INTO `proyek` (`id`, `nama_proyek`, `status_proyek`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Kohod', 'Aktif', 0, '2025-06-10 15:29:29', '2025-06-10 15:29:29'),
(2, 'Tj. Burung', 'Aktif', 0, '2025-06-10 08:29:51', '2025-06-10 08:29:51'),
(3, 'Sumber Baru', 'Aktif', 0, '2025-06-10 16:43:55', '2025-06-10 16:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `ritasi`
--

CREATE TABLE `ritasi` (
  `id` int(11) NOT NULL,
  `tgl_ritasi` date NOT NULL,
  `tim_id` int(11) NOT NULL,
  `proyek_id` int(11) NOT NULL,
  `galian_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `jam_angkut` varchar(5) NOT NULL,
  `nomerdo` varchar(8) NOT NULL,
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ritasi`
--

INSERT INTO `ritasi` (`id`, `tgl_ritasi`, `tim_id`, `proyek_id`, `galian_id`, `vehicle_id`, `jam_angkut`, `nomerdo`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, '2024-10-01', 1, 1, 1, 1, '02:20', '35428', 0, '2025-06-10 08:38:17', '2025-06-10 10:07:19'),
(2, '2024-10-01', 1, 1, 1, 2, '02:26', '35493', 0, '2025-06-10 08:38:17', '2025-06-10 17:09:15');

-- --------------------------------------------------------

--
-- Table structure for table `ritasi2`
--

CREATE TABLE `ritasi2` (
  `id` int(11) NOT NULL,
  `tgl_ritasi` date NOT NULL,
  `tim_id` int(11) NOT NULL,
  `proyek_id` int(11) NOT NULL,
  `galian_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `jam_angkut` varchar(5) NOT NULL,
  `nomerdo` varchar(8) NOT NULL,
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ritasi2`
--

INSERT INTO `ritasi2` (`id`, `tgl_ritasi`, `tim_id`, `proyek_id`, `galian_id`, `vehicle_id`, `jam_angkut`, `nomerdo`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, '2024-10-01', 1, 1, 1, 1, '02:20', '35428', 0, '2025-06-10 08:38:17', '2025-06-10 08:38:17'),
(2, '2024-10-01', 1, 1, 1, 2, '02:26', '35493', 0, '2025-06-10 08:38:17', '2025-06-10 10:02:16');

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
  `is_delete` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `vehicle_id`, `start_point`, `end_point`, `planned_distance`, `actual_distance`, `start_time`, `end_time`, `is_delete`) VALUES
(1, 1, 'Jakarta', 'Bandung', 150, 145, '2025-06-09 07:11:33', '2025-06-09 07:11:33', 0),
(2, 1, 'Jakarta', 'Bogor', 90, 95, '2025-06-09 07:11:38', '2025-06-09 07:11:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `routes2`
--

CREATE TABLE `routes2` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `start_point` varchar(100) DEFAULT NULL,
  `end_point` varchar(100) DEFAULT NULL,
  `planned_distance` float DEFAULT NULL,
  `actual_distance` float DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `is_delete` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `routes2`
--

INSERT INTO `routes2` (`id`, `vehicle_id`, `start_point`, `end_point`, `planned_distance`, `actual_distance`, `start_time`, `end_time`, `is_delete`) VALUES
(1, 1, 'Jakarta', 'Bandung', 150, 145, '2025-06-09 07:11:33', '2025-06-09 07:11:33', 0),
(2, 1, 'Jakarta', 'Bogor', 90, 95, '2025-06-09 07:11:38', '2025-06-09 07:11:38', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tim`
--

CREATE TABLE `tim` (
  `id` int(11) NOT NULL,
  `nama_tim` varchar(10) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `status_tim` varchar(10) NOT NULL,
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tim`
--

INSERT INTO `tim` (`id`, `nama_tim`, `vehicle_id`, `driver_id`, `status_tim`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'G', 1, 0, 'aktif', 0, '2025-06-10 08:52:31', '2025-06-10 08:52:31'),
(2, 'G', 2, 0, 'aktif', 0, '2025-06-10 08:52:31', '2025-06-10 08:52:31');

-- --------------------------------------------------------

--
-- Table structure for table `uangjalan`
--

CREATE TABLE `uangjalan` (
  `id` int(11) NOT NULL,
  `galian_id` int(11) NOT NULL,
  `uang_jalan` varchar(10) NOT NULL,
  `status_uangjalan` varchar(10) NOT NULL,
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `uangjalan`
--

INSERT INTO `uangjalan` (`id`, `galian_id`, `uang_jalan`, `status_uangjalan`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, '900000', 'Non Aktif', 0, '2025-06-10 16:59:00', '2025-06-10 16:59:00'),
(2, 2, '890000', 'Aktif', 0, '2025-06-10 14:46:58', '2025-06-10 15:30:22'),
(3, 3, '900000', 'Aktif', 0, '2025-06-10 11:03:06', '2025-06-10 14:49:36'),
(4, 4, '900000', 'Aktif', 0, '2025-06-10 11:03:06', '2025-06-10 11:03:06'),
(5, 5, '1050000', 'Aktif', 0, '2025-06-10 14:30:46', '2025-06-10 14:30:46');

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
  `no_pintu` int(5) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `warna` varchar(20) DEFAULT NULL,
  `status` enum('aktif','non aktif','servis') DEFAULT 'aktif',
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `no_pol`, `no_pintu`, `type`, `warna`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'B 9120 UVV', 204, 'GIGA FVZ N', 'Putih', 'aktif', 0, '2025-05-08 05:14:10', '2025-06-10 09:30:14'),
(2, 'B 9668 UVW', 105, 'GIGA FVZ N', 'Putih', 'aktif', 0, '2025-05-08 05:14:10', '2025-06-10 09:30:14');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles_old01`
--

CREATE TABLE `vehicles_old01` (
  `id` int(11) NOT NULL,
  `plate_number` varchar(20) NOT NULL,
  `vin` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `status` enum('aktif','non aktif','servis') DEFAULT 'aktif',
  `odometer` float DEFAULT 0,
  `assigned_driver_id` int(11) DEFAULT NULL,
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles_old01`
--

INSERT INTO `vehicles_old01` (`id`, `plate_number`, `vin`, `type`, `brand`, `model`, `year`, `status`, `odometer`, `assigned_driver_id`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'B 9120 UVV\n', '1HGBH41JXMN109186', 'SUV', 'Toyota', 'Fortuner', 2020, 'aktif', 5000, NULL, 0, '2025-05-08 05:14:10', '2025-06-10 09:24:34');

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
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_tracking`
--

INSERT INTO `vehicle_tracking` (`id`, `vehicle_id`, `latitude`, `longitude`, `speed`, `direction`, `timestamp`) VALUES
(1, 1, -6.1751000, 106.8650000, 60.5, 'utara', '2025-05-08 05:14:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

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
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `galian`
--
ALTER TABLE `galian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galian2`
--
ALTER TABLE `galian2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

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
-- Indexes for table `ritasi2`
--
ALTER TABLE `ritasi2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes2`
--
ALTER TABLE `routes2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tim`
--
ALTER TABLE `tim`
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
-- Indexes for table `vehicles_old01`
--
ALTER TABLE `vehicles_old01`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_documents`
--
ALTER TABLE `vehicle_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

--
-- Indexes for table `vehicle_tracking`
--
ALTER TABLE `vehicle_tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_id` (`vehicle_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `drivers2`
--
ALTER TABLE `drivers2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `fuel_logs`
--
ALTER TABLE `fuel_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `galian`
--
ALTER TABLE `galian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `galian2`
--
ALTER TABLE `galian2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ritasi2`
--
ALTER TABLE `ritasi2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `routes2`
--
ALTER TABLE `routes2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tim`
--
ALTER TABLE `tim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `uangjalan`
--
ALTER TABLE `uangjalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles_old01`
--
ALTER TABLE `vehicles_old01`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
