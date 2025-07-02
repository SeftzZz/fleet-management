-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 02, 2025 at 07:48 AM
-- Server version: 10.11.10-MariaDB-log
-- PHP Version: 8.3.21

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

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `license_number` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `tgl_join` varchar(10) DEFAULT NULL,
  `tgl_keluar` varchar(10) NOT NULL,
  `tgl_lahir` varchar(10) DEFAULT NULL,
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

INSERT INTO `drivers` (`id`, `name`, `nik`, `license_number`, `phone`, `tgl_join`, `tgl_keluar`, `tgl_lahir`, `alamat`, `nomor_darurat`, `tgl_exp_sim`, `img_profile`, `img_sim`, `img_ktp`, `status`, `keterangan`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad Dani', '1802040806700004', '', '0859-6305-1895', '24-06-2024', '29-10-2024', 'Fajar bula', 'Dusun 1 Rt.001/Rw.001 Fajar bulan Kec. Gunung Sugih', '', '0000-00-00', '', '', '', 'Non Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(2, 'Karna Rahayu', '3503201403900009', '', '0822-9944-9701', '29-10-2024', '12-12-2024', 'Tangerang,', 'Kp. Rancagong Rt.004/Rw.007 Rancagong - Legok', '', '0000-00-00', '', '', '', 'Non Aktif', 'Tidak diperbolehkan jalan Indikasi membawa uang jalan 1 rit 1.005.000 , Mobil di parkirkan di pool', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(3, 'Imam Soib', '1801171503910009', '', '0821-2855-6144', '05-08-2024', '09-12-2024', 'Candirejo,', 'Dusun IV Candirejo Rt.001/Rw.007 Titiwangi - Candipuro', '', '0000-00-00', '', '', '', 'Non Aktif', 'Supir Kabur, Mobil ditinggalin di Pom Sangiang, BAWA UJ 1 RIT 1.005.000', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(4, 'Wawan (SEREP)', '3671011202790005', '', '0858-1945-4623', 'Supir lama', 'Turun sere', 'Tangerang,', 'Buaran Kandang Besar Rt.001/Rw.006 Babakan - Tangerang', '', '0000-00-00', '', '', '', 'Non Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(5, 'aldi ', '', '', '', '20-03-2025', '01-06-2025', '', '', '', '0000-00-00', '', '', '', 'Non Aktif', 'kabur', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(6, 'Hendi', '3201202010930003', '', '0858-8825-6722', '15-07-2024', '17-11-2024', 'Bogor, 20-', 'Kp. Gosali Rt.001/Rw.007 Desa Bangun Jaya Cigudeg', '', '0000-00-00', '', '', '', 'Non Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(7, 'Wandi Hermanto (SUPIR BARU)', '1305171811060001', '', '', '24-11-2024', '13-12-2024', 'Gadur, 18-', 'Rambahan II Rt.000/Rw.000 Nyiur Melambai Pelangai Kec. Ranah pesisir', '', '0000-00-00', '', '', '', 'Non Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(8, 'Jajang', '-', '', '0831-9447-9264', '01-11-2024', '20-02-2025', 'Lebak, 06-', 'Kp. Narongtong Rt.007/Rw.003 Ds. Gununganten Cimarga-Lebak', '', '0000-00-00', '', '', '', 'Non Aktif', 'Dipecat, ninggalin mobil di multikon, bawa uj 1 rit 855.000', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(9, 'rohman', '', '', '', '07-04-2025', '25-05-2025', '', '', '', '0000-00-00', '', '', '', 'Non Aktif', 'oplos ban kiri depan 1, sudah di tangkap ban sudah di kembalikan, supir di pecat', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(10, 'muamad', '', '', '', '25-05-2025', '23-06-2025', '', '', '', '0000-00-00', '', '', '', 'Non Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(11, 'Sunarman Ginting', '3201200305960005', '', '0895-1837-7286', '15-06-2024', '19-12-2024', 'Bogor, 05-', 'Kp. Sabrang Tengah Rt.015/Rw.005 Gorowong Parung panjang', '', '0000-00-00', '', '', '', 'Non Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(12, 'RIPA', '3602132808020003', '', '85890544241', '09-01-2025', '14-01-2024', 'LEBAK, 28-', 'Kp. Papanggo Rt.001/Rw. 004 Mekarsari Kec. Rangkasbitung', '', '0000-00-00', '', '', '', 'Non Aktif', 'laka di lampu merah 800.000, uang jalan 1 rit ciomas 300.000 (SUDAH GANTI RUGI) ', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(13, 'AAT', '3602182111910002', '', '', '27-01-2025', '17-02-2025', 'LEBAK, 21-', 'KP. BABAKAN BAMBONSEENG RT 3/RW LEBAK RANGKAS BITUNG', '', '0000-00-00', '', '', '', 'Non Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(14, 'Ghozi Dika Pratama', '3603200210000002', '', '0838-9993-0888', '08-10-2024', '07-10-2024', 'Jakarta, 0', 'Perum Graha Citra Blok C9/8 Rt.011/Rw.001 Palasari-legok', '', '0000-00-00', '', '', '', 'Non Aktif', 'UNIT TURUN MESIN', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(15, 'Angga', '3601110506010002', '', '0859-6045-2780', '04-03-2024', '12-10-2024', 'Pandeglang', 'Kp. Babakan Kanas Rt.003/Rw.006 Kadubera Kec. Picung', '', '0000-00-00', '', '', '', 'Non Aktif', 'RESIGN', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(16, 'Aldi Winata Ardana S', '3602142906060005', '', '0838-3492-5334', '13-07-2024', '28-03-2025', 'Lebak, 29-', 'Kp. Kadongdong Rt.005/Rw.003 Nameng-Rangkas', '', '0000-00-00', '', '', '', 'Non Aktif', 'RESIGN', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(17, 'rio', '', '', '', '', '10-04-2025', '', '', '', '0000-00-00', '', '', '', 'Non Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(18, 'Romdhoni', '3201200107950013', '', '0857-1894-2998', '23-07-2024', '16-12-2024', 'Bogor, 01-', 'Kp. Ciawian Rt.001/Rw.004 Kel. Gerowongan Kec. Parung Panjang', '', '0000-00-00', '', '', '', 'Non Aktif', 'Supir bawa 013 karna 025 turun mesin. Supir Kabur bawa UJ 1 rit 1.005.000. Mobil di tinggal di Jatake tgl 16/12/2024, NGOPLOS 2 BB', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(19, 'Fauzan Adim', '31799830971824913', '', '0856-9345-3814', '10-10-2024', '19-11-2024', 'Serang, 09', 'Kp. Cisalam Rt.01/Rw.01 Cisalam- Baros', '', '0000-00-00', '', '', '', 'Non Aktif', 'Dipecat', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(20, 'Egi Rahmat Hidayat (SUPIR BARU)', '3604080811980001', '', '0877-1191-5166', '22-11-2024', '', 'Serang, 08', 'Link Baru I Rt.005/Rw.004 Ds. Lebak gede Kec. Pulo Merak- Cilegon', '', '0000-00-00', '', '', '', 'Non Aktif', 'Suoir kena narkoba, jadi di Rehabilitasi.', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(21, 'irwan', '', '', '', '01-05-2025', '', '', '', '', '0000-00-00', '', '', '', 'Non Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(22, 'Karsa', '1605180512740001', '', '0831-0708-1526', '20-04-2024', '', 'Musi Rawas', 'Dusun V Muara Kati Baru I Tiang Pumpung Kepungut', '', '0000-00-00', '', '', '', 'Non Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(23, 'M Lutpi Aldiansyah', '3217050209040003', '', '0838-4116-2534', '19-09-2024', '11-12-2024', 'Bandung, 0', 'Kp. Cipendeuy Rt.003/Rw.002 Kab. Bandung Barat', '', '0000-00-00', '', '', '', 'Non Aktif', 'supir ninggalin mobil di Kohod, speedometer dan eccu hilang, BAWA UJ 1 RIT 1.005.000', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(24, 'Mulyono', '3173051408690014', '', '0857-1027-0885', 'Supir Lama', '31-10-2024', 'Jakarta, 1', 'Jl. Murni Rt.016/Rw.002 Kembangan - Jakarta barat', '', '0000-00-00', '', '', '', 'Non Aktif', 'Bawa kabur UJ 2 rit, dan ninggalin mobil di pom sangiang', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(25, 'Ahmad Saepudin', '3604251810010002', '', '0838-2414-6414', '31-10-2024', '21-12-2024', 'Serang,18-', 'Kp. Parigi Rt.003/Rw.001 Ds.Nanggung Kopo', '', '0000-00-00', '', '', '', 'Non Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(26, 'Khasan Hidayat', '3604252505990002', '', '0881-0257-45017', '22-10-2024', '03-11-2024', 'Serang, 25', 'Kp. Kabayan Rt.006/Rw.002 Mekarbaru - Kopo', '', '0000-00-00', '', '', '', 'Non Aktif', 'Ninggalin mobil di cisoka', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(27, 'M Febriansyah', '3203200203000002', '', '0838-9088-0093', '20-10-2024', '-', 'Tangerang,', 'Kp. Candu Rt.03/Rw.01 Serdang wetan Legok-Tangerang', '', '0000-00-00', '', '', '', 'Non Aktif', 'Unit perbaikan masuk tgl 4 Nov 2024. 20 oktober (009) dan pindah unit tgl 4 Nov 2024 (018)', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(28, 'Caca', '3217082012030011', '', '0831-3461-0805', '09-04-2025', '10-04-2025', 'PURWAKARTA', 'Kp. Jatiajar Rt 4/Rw 3 Sukatani, Purwakarta', '', '0000-00-00', '', '', '', 'Non Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(29, 'Andi Muhammad Anwar Satriawan Langkong', '3603200110900007', '', '0831-4945-1690', 'Supir Lama', '01-11-2024', 'Makasar, 0', 'Cikande Permai 010/17 Rt.002/Rw.008 Cikande-Serang', '', '0000-00-00', '', '', '', 'Non Aktif', '-', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(30, 'Nahromi', '3602110307020006', '', '0881-0101-10522', '7 oktober ', '04-01-2025', 'Lebak, 03-', 'Kp. Bantar jaya Rt.004/Rw.002 Jayamanik - Cimarga', '', '0000-00-00', '', '', '', 'Non Aktif', 'Supir menjual perisai mobil dan sudah ganti rugi sebesar 1jt', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(31, 'rian', '', '', '', '15-04-2025', '', '', '', '', '0000-00-00', '', '', '', 'Non Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(32, 'Jaelani Kubil', '3671102208000005', '', '0895-3391-69684', '01-06-2023', '-', 'Tangerang,', 'Selapajang jaya Rt.006/Rw.003 Neglasari - Tangerang', '', '0000-00-00', '', '', '', 'Non Aktif', '-', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(33, 'Muhamad Rizal (SUPIR SEREP)', '3172012803020001', '', '', '02-12-2024', '', 'Lebak, 28-', 'Kp. Salahaur Rt.03/Rw.11 Cijoro Lebak Rangkasbitung - Lebak', '', '0000-00-00', '', '', '', 'Non Aktif', 'Ninggalin unit di galian, dan variasi 020 di maling', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(34, 'Nurmansyah ', '3201180110810002', '', '0822-4610-6507', '05-03-2024', '25-09-2024', 'Jakarta, 0', 'Kp. Pasir Nangka Rt.01/Rw.02 Cipinang Rumpin Kab. Bogor', '', '0000-00-00', '', '', '', 'Non Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(35, 'Maryusin', '', '', '0856-9158-6730', '28-09-2024', '17-12-2024', 'Bogor, 06-', 'Kp.Sukasirna Rt.02/Rw.04 Tenjo-Bogor', '', '0000-00-00', '', '', '', 'Non Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(36, 'Rohimin', '3602111010990002', '', '0819-9883-6146', '05-09-2024', '02-12-2024', 'Lebak, 10-', 'Kp. Lebak Wru Rt.002/Rw.003 Cimarga', '', '0000-00-00', '', '', '', 'Non Aktif', 'Bawa kabur UJ 1 RIT 014, 855.000', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(37, 'Nur Yuda Aditya Putra (SUPIR BARU)', '3404090909000004', '', '0813-1430-4312', '17-12-2024', '21-12-2024', 'Sleman, 09', 'Jontro Rt.003/Rw.017 Gayamharjo - Prambanan', '', '0000-00-00', '', '', '', 'Non Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(38, 'Sapari (SUPIR SERAP)', '1809010608740005', '', '', '24-11-2024', '13-12-2024', 'Gunung Raj', 'Taman Rejo, Rt.002/Rw.005 Bernung. Gedong tataan - pesawaran , Lampung', '', '0000-00-00', '', '', '', 'Non Aktif', 'Supir sering mengancam dan Jadi provokator', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(39, 'Dimas', '3603221011020005', '', '85890544241', '09-01-2025', '13-01-2025', 'Tanggerang', 'Kp. Pagedangan Rt. 004/Rw. 001 Cicalangka Kec. Pagedangan', '', '0000-00-00', '', '', '', 'Non Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(40, 'Topan', '', '', '', '08-02-2025', '', '', '', '', '0000-00-00', '', '', '', 'Non Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(41, 'Aco', '3601190402800005', '', '', '15-04-2024', '26-10-2024', 'Tangerang,', 'Kp. Kukulu Rt.002/Rw.005 Mandalasari-Kaduhejo', '', '0000-00-00', '', '', '', 'Non Aktif', 'Laka Nabrak pembatas jalan di sepatan', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(42, 'Jaenudin (SUPIR BARU)', '3603200402810008', '', '0838-7149-7936', '04-11-2024', '12-12-2024', 'Tangerang,', 'Kp. Kemuning Rt.004/Rw.001 Kemuning-Legok', '', '0000-00-00', '', '', '', 'Non Aktif', 'Tidak diperbolehkan jalan Indikasi membawa uang jalan 1 rit, 1.005.000 Mobil di parkirkan di pool', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(43, 'Unyil (kakinya patah)', '', '', '', '25-04-2025', '', '', '', '', '0000-00-00', '', '', '', 'Non Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(44, 'Warnen', '', '', '', '19-04-2024', '23-12-2024', 'Bandarlamp', 'Jl. diponegoro Gg. Batugajah, Kupangteba - Bandar lampung', '', '0000-00-00', '', '', '', 'Non Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(45, ' ', ' ', '', '', '', '', '', '', '', '0000-00-00', '', '', '', 'Non Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(46, 'AJI', '3603171810050008', '', '0838-7491-8910', '15-06-2024', '20-02-2025', 'Tangerang,', 'Kp. Tegal Rt.002/Rw.005 Kec.Curug Kab. Tangerang', '', '0000-00-00', '', '', '', 'Non Aktif', 'Dipecat, ninggalin mobil di multikon, bawa uj 1 rit 855.000', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(47, 'reja apri', '', '', '', '20-03-2025', '', '', '', '', '0000-00-00', '', '', '', 'Non Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(48, 'Keke Zakariya', '3216142603970001', '', '', '06-06-2024', '07-10-2024', 'Bekasi, 26', 'Kavling Bermis, Rt.007/Rw.004 Kel.Cisauk Kec. Cisauk - Tangerang', '', '0000-00-00', '', '', '', 'Non Aktif', 'Mobil ditinggal di buangan', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(49, 'Jamaludin Wijaya (SUPIR BARU)', '3603311801020003', '', '0812-9855-0932', '09-10-2024', '05-12-2024', 'Tangerang,', 'Kp.Cisereh Rt.02/Rw.01 Cisereh Tigaraksa-Tangerang', '', '0000-00-00', '', '', '', 'Non Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(50, 'muhamad robi', '', '', '', '15-04-2025', '', '', '', '', '0000-00-00', '', '', '', 'Non Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(51, 'Agas Wahyu Saputra', '3604222106630001', '', '0852-1561-2514', '23-09-2024', '07-01-2025', 'Serang, 21', 'Kp. Sumur Peuteu Rt.008/Rw.002 Baros - Serang', '', '0000-00-00', '', '', '', 'Non Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(52, 'Aminudin', '3603322710030004', '', '0857-1641-1827', '21-03-2024', '30-08-2024', 'Tangerang,', 'Kp. Babakan Rt.004/Rw.001 Tamiang - Gn. Kaler', '', '0000-00-00', '', '', '', 'Non Aktif', '-', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(53, 'M Rihan Saputra', '3603171709040006', '', '0889-7627-5722', '07-09-2024', '11-12-2024', 'Tangerang,', 'Kp. Kadu Jaya Rt.02/Rw.01 Kadu Jaya Curug - Tangerang', '', '0000-00-00', '', '', '', 'Non Aktif', 'supir ninggalin mobil di Kohod, speedometer dan eccu hilang, BAWA UJ 1 RIT 1.005.000', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(54, '', '', '', '', '', '', '', '', '', '0000-00-00', '', '', '', 'Non Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(55, 'Afrizal (SUPIR BARU)', '1571022508650041', '', '', '28-11-2024', '02-12-2024', 'Padang, 25', 'Jl. Cendrawasih Rt.002/Rw.000 Kel. Pasir putih Kec. Jambi Selatan', '', '0000-00-00', '', '', '', 'Non Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(56, 'Aep Alpiansyah (SUPIR 002)', '-', '', '0857-1945-4623', '10-12-2024', '', 'Tangerang,', 'Kp. Jeungjing Rt.004/Rw.003 Cisoka - Tangerang', '', '0000-00-00', '', '', '', 'Non Aktif', 'Supir ini jaminannya supir 005 a/n Wawan / Dewa 03 AGUSTUS 24 (002) DAN PINDAH UNIT BARU 10 DESEMBER 2024 (030)', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(57, 'putra', '', '', '', '07-04-2025', '', '', '', '', '0000-00-00', '', '', '', 'Non Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00');

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
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `proyek`
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
-- Dumping data for table `proyek`
--

INSERT INTO `proyek` (`id`, `nama_proyek`, `status_proyek`, `tabungan`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Kohod', 'Non Aktif', 30000, 0, '2025-06-29 22:12:55', '2025-06-30 23:04:54'),
(2, 'Kohod', 'Aktif', 45000, 0, '2025-06-30 23:04:54', '2025-06-30 23:04:54');

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
(1, 'V', 'Aktif', 0, '2025-06-29 22:17:13', '2025-06-29 22:17:13'),
(2, 'K', 'Aktif', 0, '2025-06-29 22:17:19', '2025-06-29 22:17:19'),
(3, 'G', 'Aktif', 0, '2025-06-29 22:17:23', '2025-06-29 22:17:23'),
(4, 'M', 'Aktif', 0, '2025-06-30 22:47:45', '2025-06-30 22:47:45');

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
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `is_delete`) VALUES
(1, '127.0.0.1', 'admin@admin.com', '$2y$10$nU8GqgqEBLob7JjbI8nr1.BCqi3ukuX1CVQtesYLeO.hvBPFXThru', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1751432698, 1, 'Administrator', '.', 'IUWASH PLUS', '021', 0),
(2, '116.254.102.1', 'febriansyah@gmail.com', '$2y$12$z..uB2vwkSPdmwRORsK6MelTfZ1YUJoIHZp25wpmrUCxIkN66r8kW', NULL, 'febriansyah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1560495919, 1707792449, 1, 'FPP', '.', 'Konsultan', '+6289654654045', 0),
(3, '127.0.0.1', 'user01@user.com', '$2y$10$agyyRErh9zTimzQ59sVwxu3dnlFCsCRfYS0UPmxcd6hEkQ6NJOcPi', NULL, 'user01@user.com', NULL, '2655b30c346dd9773967fc18ad46c36ee1efc69a', NULL, NULL, NULL, NULL, NULL, 1552496928, 1643560394, 1, 'User', '01', NULL, '021', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users01`
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
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

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
  `status` enum('Aktif','Non Aktif','Servis') DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
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
  `status_wallet` enum('Aktif','Non Aktif') NOT NULL DEFAULT 'Aktif',
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
-- Indexes for table `users01`
--
ALTER TABLE `users01`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `fuel_logs`
--
ALTER TABLE `fuel_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galian`
--
ALTER TABLE `galian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenance_logs`
--
ALTER TABLE `maintenance_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `proyek`
--
ALTER TABLE `proyek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ritasi`
--
ALTER TABLE `ritasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tim`
--
ALTER TABLE `tim`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tim_mgmt`
--
ALTER TABLE `tim_mgmt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uangjalan`
--
ALTER TABLE `uangjalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users01`
--
ALTER TABLE `users01`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `vehicle_documents`
--
ALTER TABLE `vehicle_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_tracking`
--
ALTER TABLE `vehicle_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
