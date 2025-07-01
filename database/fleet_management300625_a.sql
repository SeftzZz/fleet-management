-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 30 Jun 2025 pada 07.36
-- Versi server: 10.11.10-MariaDB-log
-- Versi PHP: 8.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fleet_management280625`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `alerts`
--

CREATE TABLE `alerts` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('pending','selesai') DEFAULT 'pending',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `drivers`
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
-- Dumping data untuk tabel `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `license_number`, `phone`, `tgl_join`, `tgl_lahir`, `alamat`, `nomor_darurat`, `tgl_exp_sim`, `img_profile`, `img_sim`, `img_ktp`, `status`, `keterangan`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Jaelani Kubil', '3671102208000005', '0895-3391-69684', '2023-06-01', '2000-08-22', 'Selapajang jaya Rt.006/Rw.003 Neglasari - Tangerang', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-29 22:29:53', '2025-06-29 22:29:53'),
(2, 'Irwan', '', '', '2025-05-01', '0000-00-00', '', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-29 22:30:13', '2025-06-29 22:30:13'),
(3, 'Karsa', '1605180512740001', '0831-0708-1526', '2024-04-20', '2974-12-05', 'Dusun V Muara Kati Baru I Tiang Pumpung Kepungut', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-29 22:30:49', '2025-06-29 22:30:49'),
(4, 'Unyil (kakinya patah)', '', '', '2025-04-25', '0000-00-00', '', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-29 22:31:05', '2025-06-29 22:31:05'),
(5, 'Reja Apri', '', '', '2025-03-20', '0000-00-00', '', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-29 22:31:24', '2025-06-29 22:31:24'),
(6, 'Putra', '', '', '2025-04-07', '0000-00-00', '', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-29 22:31:40', '2025-06-29 22:31:40'),
(7, 'Riki Putra Cahya', '', '', '2024-09-10', '0000-00-00', '', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 1, '2025-06-30 06:03:15', '2025-06-30 06:07:31'),
(8, 'Riki Putra Cahya', '3603310812970003', '0831-4516-4753', '2024-09-10', '1998-12-23', '', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 1, '2025-06-30 06:07:09', '2025-06-30 06:08:49'),
(9, 'Riki Putra Cahya', '3603310812970003', '0831-4516-4753', '2024-09-10', '1998-12-23', 'Kp.Sigeung Cadas Rt.04/Rw.01 Solear - Tangerang', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-30 06:08:14', '2025-06-30 06:08:14'),
(10, 'Bambang Suteja', '3208212407870001', '0831-4516-4753', '2024-11-05', '1987-07-24', 'Jl. Kayu Manis V Baru Gg. Dadap VII No.22 Rt.006/Rw.004 Kel. Kayu Manis Kec.Mtraman', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-30 06:10:47', '2025-06-30 06:10:47'),
(11, 'Dimas Faizal', '3328152011980006', '0816-1760-0204', '2023-06-01', '1998-11-20', 'Cakung Barat, Rt.003/Rw.004 Cakung barat - Cakung', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 1, '2025-06-30 06:12:49', '2025-06-30 07:24:29'),
(12, 'Dimas Faizal', '3328152011980006', '0816-1760-0204', '2024-06-15', '1998-11-20', 'Cakung Barat, Rt.003/Rw.004 Cakung barat - Cakung', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 1, '2025-06-30 06:13:48', '2025-06-30 06:17:43'),
(13, 'Dimas Faizal', '3328152011980006', '0816-1760-0204', '2024-06-15', '1998-11-20', 'Cakung Barat, Rt.003/Rw.004 Cakung barat - Cakung', '', '0000-00-00', NULL, NULL, NULL, 'Non Aktif', NULL, 0, '2025-06-30 06:16:57', '2025-06-30 06:16:57'),
(14, 'Mohamad Rifai', '', '0814-0175-0428', '2024-11-14', '2005-10-31', 'Kp. Pabuaran Rt.02/Rw.01 Tegalsari, Tigaraksa - Tangerang', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-30 06:19:50', '2025-06-30 06:19:50'),
(15, 'Budi Stiyawan pindah', '', '', '2025-09-07', '2000-03-02', 'Kp. Tenjolaya Rt.002/Rw.013 Kel. Perbawati Kec. Sukabumi', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 1, '2025-06-30 06:21:43', '2025-06-30 06:22:48'),
(16, 'Budi Stiyawan pindah', '', '0895-3401-72487', '2025-09-07', '2000-03-02', 'Kp. Cibeurih Rt.017/Rw.005 Ds.Margaluyu Sajira- Lebak', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-30 06:22:37', '2025-06-30 06:22:37'),
(17, 'David Rizki', '3217051604960004', '0857-7213-4412', '2024-03-05', '1996-04-16', 'Kp. Tenjolaya Rt.002/Rw.013 Kel. Perbawati Kec. Sukabumi', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-30 06:24:50', '2025-06-30 06:24:50'),
(18, 'Rohedi', '3602112406950002', '0812-9588-0867', '2024-06-12', '1995-06-24', 'Kp. Sangiang Rt.002/Rw.002 Cimarga-Lebak', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-30 06:33:23', '2025-06-30 06:33:23'),
(19, 'Wisnu Muhammad', '3213031810970011', '0821-3834-7970', '2024-10-26', '1997-10-18', 'Blok Bunder Rt.034/Rw.008 Dangdeur - Subang', '', '0000-00-00', NULL, NULL, NULL, 'Non Aktif', NULL, 0, '2025-06-30 06:37:11', '2025-06-30 06:37:11'),
(20, 'Nurdin', '3602060705700007', '0857-7036-8542', '2024-08-16', '1970-05-07', 'Kp. Cirangga Rt.005/Rw.001 Cibungur - Leuwidamah', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-30 06:38:57', '2025-06-30 06:38:57'),
(21, 'Muhamad Juber', '3602121108010004', '0813-8492-1670', '2024-04-15', '2001-09-09', 'Kp. Cibokor Rt.003/Rw.006 Ds. Ciuyah Kec. Sajira', '', '0000-00-00', NULL, NULL, NULL, 'Non Aktif', NULL, 0, '2025-06-30 06:40:52', '2025-06-30 06:40:52'),
(22, 'Marta ', '3604262902840002', '', '2025-12-02', '1984-02-29', 'Kp. Pasir eurih Rt.02/Rw.06 Mekarsari, Rangkasbitung - Lebak', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-30 06:42:23', '2025-06-30 06:42:23'),
(23, 'Sugiarto', '1812051712130005', '0857-6249-2027', '2024-05-03', '1993-11-05', 'Bangun Jaya Rt.001/Rw.001 Tulang Bawang Barat', '', '0000-00-00', NULL, NULL, NULL, 'Non Aktif', NULL, 0, '2025-06-30 06:44:28', '2025-06-30 06:44:28'),
(24, 'Supriyatna', '3603320906990008', '0831-2931-0280', '2024-08-02', '1999-06-27', 'Kp. Pabuaran Rt.05/Rw.01 Ds. Tamiang Kec. Gn.Kaler', '', '0000-00-00', NULL, NULL, NULL, 'Non Aktif', NULL, 0, '2025-06-30 06:46:05', '2025-06-30 06:46:05'),
(25, 'Suherman', '', '0895-4247-23084', '2024-07-13', '2003-06-26', 'Kp.Baru Gardu Batok Rt.003/Rw.006 Margaluyu Cimarga - Lebak', '', '0000-00-00', NULL, NULL, NULL, 'Non Aktif', NULL, 0, '2025-06-30 06:48:01', '2025-06-30 06:48:01'),
(26, 'Muhamd Juber (bawaan supir 033)', '360212118010004', '', '2025-05-25', '2001-09-09', 'kp. nagrog rt. 004/rw. 001', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-30 06:50:08', '2025-06-30 06:50:08'),
(27, 'Agung Awaludin', '3602141108020001', '0838-1836-8645', '2024-04-16', '2002-08-11', 'Kp.Binaya Rt.002/Rw.002 Mekarsari - Rangkasbitung', '', '0000-00-00', NULL, NULL, NULL, 'Non Aktif', NULL, 0, '2025-06-30 06:51:35', '2025-06-30 06:51:35'),
(28, 'Agus Sopandi', '3602111103970002', '0898-3686-128', '2024-05-01', '1998-08-11', 'Kp. Lebak waru Rt.030/Rw.003 Cimarga - Lebak', '', '0000-00-00', NULL, NULL, NULL, 'Aktif', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(29, 'Mumu, (SUPIR BAWAAN MEGI 205)', '3604221710000000.0', '0838-9444-6820', '2023-06-01', '0000-00-00', 'Kp. Honje RT. 004/RW. 003, KEL. SUKA INDAH, KEC. BAROS', '0838-5468-4098', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:56', '2025-06-30 07:23:51'),
(30, 'AHMAD SARNUBI (BAWAAN CECEP SUPIR 905)', '', '', '2023-06-01', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:56', '2025-06-30 07:24:29'),
(31, 'Alek Tambunan', '', '', '2023-06-01', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(32, 'Supriatna (BAWAAN ANDI, SUPIR 604)', '3602101611970000.0', '', '2023-06-01', '0000-00-00', 'KP. CAHAYA MEKAR RT. 001/RW. 005 KEL/DESA PASINDANGAN, KEC. CILELES', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(33, 'Megi Rustiawan', '3602202401990000.0', '0838-9259-5843', '2023-06-01', '0000-00-00', 'KP. TIPAR RT 004 RW 001 LEBAK TIPAR KEC. CIOGRANG', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(34, 'Ahmad', '', '', '2023-06-01', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(35, 'Endang Mulyadi', '', '', '2023-06-01', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(36, 'Putra', '', '', '2023-06-01', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(37, 'BUGIANA (BAWAAN JULFIKAR DT. 703)', '', '', '2023-06-01', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(38, 'samsudin', '', '', '2023-06-01', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(39, 'Sigit Muhajirin', '3602141507030000.0', '0813-9886-1457', '2023-06-01', '0000-00-00', 'KP. MULIH RT.02/RW.03 DS. MEKARSARI RANGKAS BITUNG - LEBAK', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(40, 'Udin', '', '', '2023-06-01', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(41, 'Dien Pradesa', '1605180607820000.0', '0838-5426-5847', '2023-06-01', '0000-00-00', 'MUARA KATI BARU I TIANG PUMPUNG KEPUNGUT MUSI RAWAS', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(42, 'Yana Nuryana', '3602272611030000.0', '', '2023-06-01', '0000-00-00', 'KP. DUNGKUK RT. 09/ RW. 03 CIRINTEN - LEBAK', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(43, 'Abdul Wahid', '3603230911990000.0', '0881-0249-54239', '2023-06-01', '0000-00-00', 'KP. CIBADAK RT.001/RW.002 KEL. SURADITA KEC. CISAUK', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(44, 'Andi', '', '', '2023-06-01', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(45, 'WANDI ANWAR WAHYUDI', '3203030609890010.0', '0858-8243-9869', '2023-06-01', '0000-00-00', 'KP. SUKAJADI RT 001 RW 003 SUKANAGARA KAB. CIANJUR', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(46, 'Eky Apriliyana', '', '', '2023-06-01', '0000-00-00', 'KP. LEBAK PURUT RT.06/RW.03 DS. BANJARSARI KADUHEJO KAB. PANDEGLANG', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(47, 'Zulfikar', '', '', '2023-06-01', '0000-00-00', '', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(48, 'Abdul Halim', '3602180410970000.0', '', '2023-06-01', '0000-00-00', 'KP. CIGOMOK RT.10/RW.03 PADASUKA - LEBAK', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(49, 'Warsono', '3217052212910000.0', '0838 -9840-5185', '2023-06-01', '0000-00-00', 'KP.CIBUANG RT.002/RW.006 NYENANG - CIPEUNDEUY - BANDUNG BARAT', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(50, 'Sarman', '1674052808750000.0', '0813-6756-0463', '2023-06-01', '0000-00-00', 'DUSUN 1 KP. RANTAU TEMIANG BANJIT WAY KANAN', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(51, 'Aris Aerudin', '3301221505840000.0', '0881-0124-43357', '2023-06-01', '0000-00-00', 'DS. BOJONGSANA RT.02/RW.03 KEC. SURADADI - TEGAL', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(52, 'Eki Supriyadi', '3602111601010000.0', '0858-9047-4991', '2023-06-01', '0000-00-00', 'KP.TALAGASARI RT.02/RW.02 WANTISARI LEUWIDAMAR - LEBAK', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(53, 'AHMAD SAEPUDIN (SERAP)', '', '', '2023-06-01', '0000-00-00', 'KP. KADU MERNAH SABRANG RT.03/RW.07 MAJASARI - PANDEGLANG', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(54, 'Mubin', '3602131602960000.0', '0831-3491-1107', '2023-06-01', '0000-00-00', 'KP. BARU RT.04/RW.03 GUBUGAN CIBERUM MAJA - LEBAK', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(55, 'Djumadi', '3671081010650010.0', '0877-5267-7841', '2023-06-01', '0000-00-00', 'KP.SANGIANG RT.03/RW.01 DESA PERIUK KEC. PERIUK', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(56, 'Ridwan', '3602121311970000.0', '0856-7013-639', '2023-06-01', '0000-00-00', 'KP. CIBUBUR RT 002 RW 001 MARGALUYU SAJIRA KAB LEBAK', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(57, 'Hasan', '3602112308990000.0', '0857-7732-0080', '2023-06-01', '0000-00-00', 'KP. CIBATUNG RT 011 RW 004 MARGATIRTA CIMARGA', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(58, 'Sapriyadi', '1808032405880000.0', '', '2023-06-01', '0000-00-00', 'BONGLAI RT 000 RW 000 BANJIR', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:57', '2025-06-30 07:24:29'),
(59, 'Cecep', '360323060394001.0', '0823-1165-5977', '2023-06-01', '0000-00-00', 'KP. SETU RT 014 RW 005 DANGDANG CISAUK', '', NULL, NULL, NULL, NULL, NULL, NULL, 0, '2025-06-30 07:19:58', '2025-06-30 07:24:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `fuel_logs`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `galian`
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
-- Dumping data untuk tabel `galian`
--

INSERT INTO `galian` (`id`, `proyek_id`, `lokasi`, `status_lokasi`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'CIUJUNG', 'Aktif', 0, '2025-06-29 22:13:07', '2025-06-29 22:13:07'),
(2, 1, 'CIUJUNG', 'Non Aktif', 1, '2025-06-29 22:13:07', '2025-06-29 22:13:14'),
(3, 1, 'MULTIKON', 'Aktif', 0, '2025-06-29 22:13:23', '2025-06-29 22:13:23'),
(4, 1, 'MEDE', 'Aktif', 0, '2025-06-29 22:13:30', '2025-06-29 22:13:30'),
(5, 1, 'CIOMAS', 'Aktif', 0, '2025-06-29 22:13:36', '2025-06-29 22:13:36'),
(6, 1, 'TAPEN', 'Aktif', 0, '2025-06-29 22:13:43', '2025-06-29 22:13:43'),
(7, 1, 'CITERAS', 'Aktif', 0, '2025-06-29 22:13:49', '2025-06-29 22:13:49'),
(8, 1, 'SERENGSENG', 'Aktif', 0, '2025-06-29 22:13:57', '2025-06-29 22:13:57'),
(9, 1, 'C. BITUNG', 'Aktif', 0, '2025-06-29 22:14:03', '2025-06-29 22:14:03'),
(10, 1, 'BAROS', 'Aktif', 0, '2025-06-29 22:14:09', '2025-06-29 22:14:09'),
(11, 1, 'CILEGON', 'Aktif', 0, '2025-06-29 22:14:15', '2025-06-29 22:14:15'),
(12, 1, 'BOJONEGARA', 'Aktif', 0, '2025-06-29 22:14:21', '2025-06-29 22:14:21'),
(13, 1, 'KOPI', 'Aktif', 0, '2025-06-29 22:14:27', '2025-06-29 22:14:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'Super Admin', 'Super Admin'),
(2, 'Admin', 'Admin'),
(3, 'User', 'User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `incidents`
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
-- Struktur dari tabel `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `maintenance_logs`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `proyek`
--

CREATE TABLE `proyek` (
  `id` int(11) NOT NULL,
  `nama_proyek` varchar(30) NOT NULL,
  `status_proyek` varchar(10) NOT NULL,
  `tabungan` float NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `proyek`
--

INSERT INTO `proyek` (`id`, `nama_proyek`, `status_proyek`, `tabungan`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Kohod', 'Aktif', 30000, 0, '2025-06-29 22:12:55', '2025-06-29 22:12:55');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ritasi`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `routes`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabungan`
--

CREATE TABLE `tabungan` (
  `id` int(11) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `status` enum('Aktif','Non Aktif','Servis') DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tim`
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
-- Dumping data untuk tabel `tim`
--

INSERT INTO `tim` (`id`, `nama_tim`, `status_tim`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'V', 'Aktif', 0, '2025-06-29 22:17:13', '2025-06-29 22:17:13'),
(2, 'K', 'Aktif', 0, '2025-06-29 22:17:19', '2025-06-29 22:17:19'),
(3, 'G', 'Aktif', 0, '2025-06-29 22:17:23', '2025-06-29 22:17:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tim_mgmt`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `uangjalan`
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
-- Dumping data untuk tabel `uangjalan`
--

INSERT INTO `uangjalan` (`id`, `proyek_id`, `galian_id`, `uang_jalan`, `status_uangjalan`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 1, ' 900000', 'Aktif', 0, '2025-06-29 22:14:46', '2025-06-29 22:14:46'),
(2, 1, 3, '890000', 'Aktif', 0, '2025-06-29 22:14:59', '2025-06-29 22:14:59'),
(3, 1, 4, '900000', 'Aktif', 0, '2025-06-29 22:15:11', '2025-06-29 22:15:11'),
(4, 1, 5, '1050000', 'Aktif', 0, '2025-06-29 22:15:26', '2025-06-29 22:15:26'),
(5, 1, 6, '900000', 'Aktif', 0, '2025-06-29 22:15:35', '2025-06-29 22:15:35'),
(6, 1, 7, '890000', 'Aktif', 0, '2025-06-29 22:15:49', '2025-06-29 22:15:49'),
(7, 1, 8, '700000', 'Aktif', 0, '2025-06-29 22:16:02', '2025-06-29 22:16:02'),
(8, 1, 9, '980000', 'Aktif', 0, '2025-06-29 22:16:14', '2025-06-29 22:16:14'),
(9, 1, 10, '1050000', 'Aktif', 0, '2025-06-29 22:16:26', '2025-06-29 22:16:26'),
(10, 1, 11, '1140000', 'Aktif', 0, '2025-06-29 22:16:40', '2025-06-29 22:16:40'),
(11, 1, 12, '1140000', 'Aktif', 0, '2025-06-29 22:16:50', '2025-06-29 22:16:50'),
(12, 1, 13, '1100000', 'Aktif', 0, '2025-06-29 22:17:01', '2025-06-29 22:17:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `id_karyawan`) VALUES
(1, '127.0.0.1', 'admin@admin.com', '$2y$10$nU8GqgqEBLob7JjbI8nr1.BCqi3ukuX1CVQtesYLeO.hvBPFXThru', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1751242959, 1, 'Administrator', '.', 'IUWASH PLUS', '021', 0),
(2, '116.254.102.1', 'febriansyah@gmail.com', '$2y$12$z..uB2vwkSPdmwRORsK6MelTfZ1YUJoIHZp25wpmrUCxIkN66r8kW', NULL, 'febriansyah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1560495919, 1707792449, 1, 'FPP', '.', 'Konsultan', '+6289654654045', 0),
(3, '127.0.0.1', 'user01@user.com', '$2y$10$agyyRErh9zTimzQ59sVwxu3dnlFCsCRfYS0UPmxcd6hEkQ6NJOcPi', NULL, 'user01@user.com', NULL, '2655b30c346dd9773967fc18ad46c36ee1efc69a', NULL, NULL, NULL, NULL, NULL, 1552496928, 1643560394, 1, 'User', '01', NULL, '021', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users01`
--

CREATE TABLE `users01` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `role` enum('admin','operator','viewer') DEFAULT 'operator',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_groups`
--

CREATE TABLE `users_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data untuk tabel `users_groups`
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
-- Struktur dari tabel `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
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
-- Dumping data untuk tabel `vehicles`
--

INSERT INTO `vehicles` (`id`, `name`, `no_pol`, `no_pintu`, `type`, `warna`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, NULL, 'B 9056 UIU', 1, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(2, NULL, 'B 9057 UIU', 2, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(3, NULL, 'B 9061 UIU', 3, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(4, NULL, 'B 9063 UVX', 4, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(5, NULL, 'B 9065 UIU', 5, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(6, NULL, 'B 9941 UIT', 6, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(7, NULL, 'B 9942 UIT', 7, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(8, NULL, 'B 9943 UIT', 8, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(9, NULL, 'B 9947 UIT', 9, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(10, NULL, 'B 9949 UIT', 10, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(11, NULL, 'B 9417 UIU', 11, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(12, NULL, 'B 9418 UIU', 12, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(13, NULL, 'B 9419 UIU', 13, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(14, NULL, 'B 9420 UIT', 14, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(15, NULL, 'B 9442 UIU', 15, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(16, NULL, 'B 9443 UIU', 16, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(17, NULL, 'B 9445 UIU', 17, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(18, NULL, 'B 9448 UIU', 18, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(19, NULL, 'B 9464 UIU', 19, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(20, NULL, 'B 9508 UIU', 20, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(21, NULL, 'B 9441 UIU', 21, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(22, NULL, 'B 9446 UIU', 22, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(23, NULL, 'B 9447 UIU', 23, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(24, NULL, 'B 9472 UIU', 24, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(25, NULL, 'B 9473 UIU', 25, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(26, NULL, 'B 9381 UIT', 26, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(27, NULL, 'B 9383 UIT', 27, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(28, NULL, 'B 9452 UIT', 28, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(29, NULL, 'B 9453 UIT', 29, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(30, NULL, 'B 9462 UIT', 30, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(31, NULL, 'B 9754 UIU', 31, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(32, NULL, 'B 9755 UIU', 32, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(33, NULL, 'B 9756 UIU', 33, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(34, NULL, 'B 9758 UIU', 34, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(35, NULL, 'B 9773 UIU', 35, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(51, NULL, 'B 9760 UIU', 51, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(52, NULL, 'B 9765 UIU', 52, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(53, NULL, 'B 9766 UIU', 53, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(55, NULL, 'B 9118 UVX', 55, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(56, NULL, 'B 9127 UVX', 56, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(57, NULL, 'B 9103 UVX', 57, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(58, NULL, 'B 9110 UVX', 58, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(59, NULL, 'B 9553 UVX', 59, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(60, NULL, 'B 9600 UVX', 60, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(61, NULL, 'B 9136 UVX', 61, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(62, NULL, 'B 9137 UVX', 62, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(63, NULL, 'B 9139 UVX', 63, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(64, NULL, 'B 9163 UVX', 64, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(65, NULL, 'B 9165 UVX', 65, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(67, NULL, 'B 9675 UVX', 67, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(68, NULL, 'B 9677 UVX', 68, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(69, NULL, 'B 9681 UVX', 69, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(70, NULL, 'B 9716 UVX', 70, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(81, NULL, 'B 9761 UIU', 81, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(82, NULL, 'B 9762 UIU', 82, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(83, NULL, 'B 9767 UIU', 83, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(84, NULL, 'B 9768 UIU', 84, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(85, NULL, 'B 9772 UIU', 85, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(86, NULL, 'B 9776 UIU', 86, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(87, NULL, 'B 9779 UIU', 87, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(91, NULL, 'B 9117 UVX', 91, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(92, NULL, 'B 9131 UVX', 92, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(93, NULL, 'B 9134 UVX', 93, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(94, NULL, 'B 9141 UVX', 94, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(95, NULL, 'B 9142 UVX', 95, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(96, NULL, 'B 9143 UVX', 96, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(97, NULL, 'B 9145 UVX', 97, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(98, NULL, 'B 9148 UVX', 98, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(99, NULL, 'B 9149 UVX', 99, 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(101, NULL, 'B 9665 UVW', 101, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(102, NULL, 'B 9671 UVW', 102, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(103, NULL, 'B 9670 UVW', 103, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(104, NULL, 'B 9667 UVW', 104, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(105, NULL, 'B 9668 UVW', 105, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(201, NULL, 'B 9121 UVV', 201, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(202, NULL, 'B 9123 UVV', 202, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(203, NULL, 'B 9124 UVV', 203, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(204, NULL, 'B 9120 UVV', 204, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(205, NULL, 'B 9122 UVV', 205, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(301, NULL, 'B 9089 UVV', 301, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(302, NULL, 'B 9091 UVV', 302, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(303, NULL, 'B 9093 UVV', 303, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(304, NULL, 'B 9092 UVV', 304, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(305, NULL, 'B 9094 UVV', 305, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(501, NULL, 'B 9192 UVV', 501, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(502, NULL, 'B 9193 UVV', 502, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(503, NULL, 'B 9194 UVV', 503, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(504, NULL, 'B 9195 UVV', 504, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(505, NULL, 'B 9196 UVV', 505, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(506, NULL, 'B 9197 UVV', 506, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(507, NULL, 'B 9189 UVV', 507, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(508, NULL, 'B 9188 UVV', 508, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(509, NULL, 'B 9187 UVV', 509, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(510, NULL, 'B 9190 UVV', 510, 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(601, NULL, 'B 9593 UVV', 601, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(602, NULL, 'B 9592 UVV', 602, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(603, NULL, 'B 9597 UVV', 603, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(604, NULL, 'B 9591 UVV', 604, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(605, NULL, 'B 9594 UVV', 605, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(701, NULL, 'B 9590 UVV', 701, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(702, NULL, 'B 9581 UVV', 702, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(703, NULL, 'B 9596 UVV', 703, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(704, NULL, 'B 9582 UVV', 704, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(705, NULL, 'B 9580 UVV', 705, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(706, NULL, 'B 9580 UVV', 706, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(801, NULL, '', 801, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(802, NULL, '', 802, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(803, NULL, '', 803, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(805, NULL, '', 805, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(806, NULL, '', 806, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(807, NULL, '', 807, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(808, NULL, '', 808, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(809, NULL, '', 809, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(810, NULL, '', 810, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(811, NULL, '', 811, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(901, NULL, '', 901, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(902, NULL, '', 902, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(903, NULL, '', 903, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(905, NULL, '', 905, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(1077, NULL, 'B 9907 KIT', 77, '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `vehicle_documents`
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
-- Struktur dari tabel `vehicle_tracking`
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `v_doc_detail`
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
-- Struktur dari tabel `wallets`
--

CREATE TABLE `wallets` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `balance` float DEFAULT 0,
  `status_wallet` enum('Aktif','Non Aktif') NOT NULL DEFAULT 'Aktif',
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `wallets`
--

INSERT INTO `wallets` (`id`, `driver_id`, `balance`, `status_wallet`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Aktif', 0, '2025-06-29 22:29:53', '2025-06-29 22:29:53'),
(2, 2, 0, 'Aktif', 0, '2025-06-29 22:30:13', '2025-06-29 22:30:13'),
(3, 3, 0, 'Aktif', 0, '2025-06-29 22:30:49', '2025-06-29 22:30:49'),
(4, 4, 0, 'Aktif', 0, '2025-06-29 22:31:05', '2025-06-29 22:31:05'),
(5, 5, 0, 'Aktif', 0, '2025-06-29 22:31:24', '2025-06-29 22:31:24'),
(6, 6, 0, 'Aktif', 0, '2025-06-29 22:31:40', '2025-06-29 22:31:40'),
(7, 7, 0, 'Aktif', 0, '2025-06-30 06:03:15', '2025-06-30 06:03:15'),
(8, 8, 0, 'Aktif', 0, '2025-06-30 06:07:09', '2025-06-30 06:07:09'),
(9, 9, 0, 'Aktif', 0, '2025-06-30 06:08:14', '2025-06-30 06:08:14'),
(10, 10, 0, 'Aktif', 0, '2025-06-30 06:10:47', '2025-06-30 06:10:47'),
(11, 11, 0, 'Aktif', 0, '2025-06-30 06:12:49', '2025-06-30 06:12:49'),
(12, 12, 0, 'Aktif', 0, '2025-06-30 06:13:48', '2025-06-30 06:13:48'),
(13, 13, 0, 'Aktif', 0, '2025-06-30 06:16:57', '2025-06-30 06:16:57'),
(14, 14, 0, 'Aktif', 0, '2025-06-30 06:19:50', '2025-06-30 06:19:50'),
(15, 15, 0, 'Aktif', 0, '2025-06-30 06:21:43', '2025-06-30 06:21:43'),
(16, 16, 0, 'Aktif', 0, '2025-06-30 06:22:37', '2025-06-30 06:22:37'),
(17, 17, 0, 'Aktif', 0, '2025-06-30 06:24:50', '2025-06-30 06:24:50'),
(18, 18, 0, 'Aktif', 0, '2025-06-30 06:33:23', '2025-06-30 06:33:23'),
(19, 19, 0, 'Aktif', 0, '2025-06-30 06:37:11', '2025-06-30 06:37:11'),
(20, 20, 0, 'Aktif', 0, '2025-06-30 06:38:57', '2025-06-30 06:38:57'),
(21, 21, 0, 'Aktif', 0, '2025-06-30 06:40:52', '2025-06-30 06:40:52'),
(22, 22, 0, 'Aktif', 0, '2025-06-30 06:42:23', '2025-06-30 06:42:23'),
(23, 23, 0, 'Aktif', 0, '2025-06-30 06:44:28', '2025-06-30 06:44:28'),
(24, 24, 0, 'Aktif', 0, '2025-06-30 06:46:05', '2025-06-30 06:46:05'),
(25, 25, 0, 'Aktif', 0, '2025-06-30 06:48:01', '2025-06-30 06:48:01'),
(26, 26, 0, 'Aktif', 0, '2025-06-30 06:50:08', '2025-06-30 06:50:08'),
(27, 27, 0, 'Aktif', 0, '2025-06-30 06:51:35', '2025-06-30 06:51:35'),
(28, 28, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(29, 29, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(30, 30, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(31, 31, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(32, 32, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(33, 33, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(34, 34, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(35, 35, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(36, 36, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(37, 37, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(38, 38, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(39, 39, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(40, 40, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(41, 41, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(42, 42, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(43, 43, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(44, 44, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(45, 45, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(46, 46, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(47, 47, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(48, 48, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(49, 49, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(50, 50, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(51, 51, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(52, 52, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(53, 53, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(54, 54, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(55, 55, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(56, 56, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(57, 57, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(58, 58, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(59, 59, 0, 'Aktif', 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wallet_transactions`
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
-- Dumping data untuk tabel `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `wallet_id`, `transaction_type`, `amount`, `id_ritasi`, `description`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-29 22:29:53', '2025-06-29 22:29:53'),
(2, 2, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-29 22:30:13', '2025-06-29 22:30:13'),
(3, 3, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-29 22:30:49', '2025-06-29 22:30:49'),
(4, 4, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-29 22:31:05', '2025-06-29 22:31:05'),
(5, 5, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-29 22:31:24', '2025-06-29 22:31:24'),
(6, 6, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-29 22:31:40', '2025-06-29 22:31:40'),
(7, 7, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:03:15', '2025-06-30 06:03:15'),
(8, 8, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:07:09', '2025-06-30 06:07:09'),
(9, 9, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:08:14', '2025-06-30 06:08:14'),
(10, 10, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:10:47', '2025-06-30 06:10:47'),
(11, 11, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:12:49', '2025-06-30 06:12:49'),
(12, 12, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:13:48', '2025-06-30 06:13:48'),
(13, 13, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:16:57', '2025-06-30 06:16:57'),
(14, 14, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:19:50', '2025-06-30 06:19:50'),
(15, 15, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:21:43', '2025-06-30 06:21:43'),
(16, 16, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:22:37', '2025-06-30 06:22:37'),
(17, 17, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:24:50', '2025-06-30 06:24:50'),
(18, 18, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:33:23', '2025-06-30 06:33:23'),
(19, 19, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:37:11', '2025-06-30 06:37:11'),
(20, 20, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:38:57', '2025-06-30 06:38:57'),
(21, 21, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:40:52', '2025-06-30 06:40:52'),
(22, 22, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:42:23', '2025-06-30 06:42:23'),
(23, 23, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:44:28', '2025-06-30 06:44:28'),
(24, 24, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:46:05', '2025-06-30 06:46:05'),
(25, 25, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:48:01', '2025-06-30 06:48:01'),
(26, 26, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:50:08', '2025-06-30 06:50:08'),
(27, 27, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:51:35', '2025-06-30 06:51:35'),
(28, 28, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(29, 29, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(30, 30, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(31, 31, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(32, 32, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(33, 33, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(34, 34, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(35, 35, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(36, 36, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(37, 37, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(38, 38, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(39, 39, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(40, 40, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(41, 41, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(42, 42, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(43, 43, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(44, 44, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(45, 45, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(46, 46, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(47, 47, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(48, 48, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(49, 49, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(50, 50, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(51, 51, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(52, 52, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(53, 53, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(54, 54, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(55, 55, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(56, 56, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(57, 57, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(58, 58, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53'),
(59, 59, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-06-30 06:53:53', '2025-06-30 06:53:53');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alerts_ibfk_1` (`vehicle_id`);

--
-- Indeks untuk tabel `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `fuel_logs`
--
ALTER TABLE `fuel_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fuel_logs_ibfk_1` (`vehicle_id`);

--
-- Indeks untuk tabel `galian`
--
ALTER TABLE `galian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incidents_ibfk_1` (`vehicle_id`),
  ADD KEY `incidents_ibfk_2` (`driver_id`);

--
-- Indeks untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maintenance_logs_ibfk_1` (`vehicle_id`);

--
-- Indeks untuk tabel `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `ritasi`
--
ALTER TABLE `ritasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tim`
--
ALTER TABLE `tim`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tim_mgmt`
--
ALTER TABLE `tim_mgmt`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `uangjalan`
--
ALTER TABLE `uangjalan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_email` (`email`),
  ADD UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  ADD UNIQUE KEY `uc_remember_selector` (`remember_selector`),
  ADD UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`);

--
-- Indeks untuk tabel `users01`
--
ALTER TABLE `users01`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `vehicle_documents`
--
ALTER TABLE `vehicle_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_documents_ibfk_1` (`vehicle_id`);

--
-- Indeks untuk tabel `vehicle_tracking`
--
ALTER TABLE `vehicle_tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicle_tracking_ibfk_1` (`vehicle_id`);

--
-- Indeks untuk tabel `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `fuel_logs`
--
ALTER TABLE `fuel_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `galian`
--
ALTER TABLE `galian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `ritasi`
--
ALTER TABLE `ritasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tim`
--
ALTER TABLE `tim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tim_mgmt`
--
ALTER TABLE `tim_mgmt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `uangjalan`
--
ALTER TABLE `uangjalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `users01`
--
ALTER TABLE `users01`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1078;

--
-- AUTO_INCREMENT untuk tabel `vehicle_documents`
--
ALTER TABLE `vehicle_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `vehicle_tracking`
--
ALTER TABLE `vehicle_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT untuk tabel `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `alerts`
--
ALTER TABLE `alerts`
  ADD CONSTRAINT `alerts_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Ketidakleluasaan untuk tabel `fuel_logs`
--
ALTER TABLE `fuel_logs`
  ADD CONSTRAINT `fuel_logs_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Ketidakleluasaan untuk tabel `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `incidents_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`),
  ADD CONSTRAINT `incidents_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`);

--
-- Ketidakleluasaan untuk tabel `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  ADD CONSTRAINT `maintenance_logs_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Ketidakleluasaan untuk tabel `vehicle_documents`
--
ALTER TABLE `vehicle_documents`
  ADD CONSTRAINT `vehicle_documents_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);

--
-- Ketidakleluasaan untuk tabel `vehicle_tracking`
--
ALTER TABLE `vehicle_tracking`
  ADD CONSTRAINT `vehicle_tracking_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
