-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2025 at 07:11 PM
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
  `tempat_lahir` varchar(80) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `nomor_darurat` varchar(20) DEFAULT NULL,
  `tgl_exp_sim` varchar(10) DEFAULT NULL,
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

INSERT INTO `drivers` (`id`, `name`, `nik`, `license_number`, `phone`, `tgl_join`, `tgl_keluar`, `tgl_lahir`, `tempat_lahir`, `alamat`, `nomor_darurat`, `tgl_exp_sim`, `img_profile`, `img_sim`, `img_ktp`, `status`, `keterangan`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'Ahmad Dani', '1802040806700000', '', '0859-6305-1895', '24/06/2024', '29/10/2024', '08/06/1970', 'Fajar bulan', 'Dusun 1 Rt.001/Rw.001 Fajar bulan Kec. Gunung Sugih', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(2, 'Karna Rahayu', '3503201403900000', '', '0822-9944-9701', '29/10/2024', '12/12/2024', '14/03/1990', 'Tangerang', 'Kp. Rancagong Rt.004/Rw.007 Rancagong - Legok', '', '00/00/0000', '', '', '', 'Aktif', 'Tidak diperbolehkan jalan Indikasi membawa uang jalan 1 rit 1.005.000 , Mobil di parkirkan di pool', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(3, 'Imam Soib', '1801171503910000', '', '0821-2855-6144', '05/08/2024', '09/12/2024', ' 15/03/199', 'Candirejo', 'Dusun IV Candirejo Rt.001/Rw.007 Titiwangi - Candipuro', '', '00/00/0000', '', '', '', 'Aktif', 'Supir Kabur, Mobil ditinggalin di Pom Sangiang, BAWA UJ 1 RIT 1.005.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(4, 'Wawan (SEREP)', '3671011202790000', '', '0858-1945-4623', '16/04/2024', '17/02/2025', ' 12/12/197', 'Tangerang', 'Buaran Kandang Besar Rt.001/Rw.006 Babakan - Tangerang', '', '00/00/0000', '', '', '', 'Aktif', 'Supir lama, Turun serep dan resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(5, 'aldi ', '', '', '', '20/03/2025', '01/06/2025', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'kabur', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(6, 'Hendi', '3201202010930000', '', '0858-8825-6722', '15/07/2024', '17/11/2024', ' 20/10/199', 'Bogor', 'Kp. Gosali Rt.001/Rw.007 Desa Bangun Jaya Cigudeg', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(7, 'Wandi Hermanto (SUPIR BARU)', '1305171811060000', '', '', '24/11/2024', '13/12/2024', ' 18/11/200', 'Gadur', 'Rambahan II Rt.000/Rw.000 Nyiur Melambai Pelangai Kec. Ranah pesisir', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(8, 'Jajang', '', '', '0831-9447-9264', '01/11/2024', '20/02/2025', ' 06/02/200', 'Lebak', 'Kp. Narongtong Rt.007/Rw.003 Ds. Gununganten Cimarga-Lebak', '', '00/00/0000', '', '', '', 'Aktif', 'Dipecat, ninggalin mobil di multikon, bawa uj 1 rit 855.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(9, 'rohman', '', '', '', '07/04/2025', '25/05/2025', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'oplos ban kiri depan 1, sudah di tangkap ban sudah di kembalikan, supir di pecat', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(10, 'muamad', '', '', '', '25/05/2025', '23/06/2025', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(11, 'Sunarman Ginting', '3201200305960000', '', '0895-1837-7286', '15/06/2024', '19/12/2024', ' 05/11/199', 'Bogor', 'Kp. Sabrang Tengah Rt.015/Rw.005 Gorowong Parung panjang', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(12, 'RIPA', '3602132808020000', '', '085890544241', '09/01/2025', '14/01/2024', ' 28/08/200', 'LEBAK', 'Kp. Papanggo Rt.001/Rw. 004 Mekarsari Kec. Rangkasbitung', '', '00/00/0000', '', '', '', 'Aktif', 'laka di lampu merah 800.000, uang jalan 1 rit ciomas 300.000 (SUDAH GANTI RUGI) ', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(13, 'AAT', '3602182111910000', '', '', '27/01/2025', '17/02/2025', ' 21/11/199', 'LEBAK', 'KP. BABAKAN BAMBONSEENG RT 3/RW LEBAK RANGKAS BITUNG', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(14, 'Ghozi Dika Pratama', '3603200210000000', '', '0838-9993-0888', '08/10/2024', '07/10/2024', ' 02/10/200', 'Jakarta', 'Perum Graha Citra Blok C9/8 Rt.011/Rw.001 Palasari-legok', '', '00/00/0000', '', '', '', 'Aktif', 'UNIT TURUN MESIN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(15, 'Angga', '3601110506010002', '', '0859-6045-2780', '04/03/2024', '12/10/2024', ' 05/06/200', 'Pandeglang', 'Kp. Babakan Kanas Rt.003/Rw.006 Kadubera Kec. Picung', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN', 0, '2025-07-01 08:00:00', '2025-07-02 21:11:05'),
(16, 'Aldi Winata Ardana S', '3602142906060000', '', '0838-3492-5334', '13/07/2024', '28/03/2025', ' 29/06/200', 'Lebak', 'Kp. Kadongdong Rt.005/Rw.003 Nameng-Rangkas', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(17, 'rio', '', '', '', '', '10/04/2025', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(18, 'Romdhoni', '3201200107950010', '', '0857-1894-2998', '23/07/2024', '16/12/2024', ' 01/07/199', 'Bogor', 'Kp. Ciawian Rt.001/Rw.004 Kel. Gerowongan Kec. Parung Panjang', '', '00/00/0000', '', '', '', 'Aktif', 'Supir bawa 013 karna 025 turun mesin. Supir Kabur bawa UJ 1 rit 1.005.000. Mobil di tinggal di Jatake tgl 16/12/2024, NGOPLOS 2 BB', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(19, 'Fauzan Adim', '31799830971824900', '', '0856-9345-3814', '10/10/2024', '19/11/2024', ' 09/07/200', 'Serang', 'Kp. Cisalam Rt.01/Rw.01 Cisalam- Baros', '', '00/00/0000', '', '', '', 'Aktif', 'Dipecat', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(20, 'Egi Rahmat Hidayat (SUPIR BARU)', '3604080811980000', '', '0877-1191-5166', '22/11/2024', '', ' 08/11/199', 'Serang', 'Link Baru I Rt.005/Rw.004 Ds. Lebak gede Kec. Pulo Merak- Cilegon', '', '00/00/0000', '', '', '', 'Aktif', 'Suoir kena narkoba, jadi di Rehabilitasi.', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(21, 'irwan', '', '', '', '01/05/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(22, 'Karsa', '1605180512740000', '', '0831-0708-1526', '20/04/2024', '', ' 05/12/197', 'Musi Rawas', 'Dusun V Muara Kati Baru I Tiang Pumpung Kepungut', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(23, 'M Lutpi Aldiansyah', '3217050209040000', '', '0838-4116-2534', '19/09/2024', '11/12/2024', ' 02/09/200', 'Bandung', 'Kp. Cipendeuy Rt.003/Rw.002 Kab. Bandung Barat', '', '00/00/0000', '', '', '', 'Aktif', 'supir ninggalin mobil di Kohod, speedometer dan eccu hilang, BAWA UJ 1 RIT 1.005.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(24, 'Mulyono', '3173051408690010', '', '0857-1027-0885', '', '31/10/2024', ' 14/08/196', 'Jakarta', 'Jl. Murni Rt.016/Rw.002 Kembangan - Jakarta barat', '', '00/00/0000', '', '', '', 'Aktif', 'Supir Lama dan Bawa kabur UJ 2 rit, dan ninggalin mobil di pom sangiang', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(25, 'Ahmad Saepudin', '3604251810010000', '', '0838-2414-6414', '31/10/2024', '21/12/2024', '18/10/2001', 'Serang', 'Kp. Parigi Rt.003/Rw.001 Ds.Nanggung Kopo', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(26, 'Khasan Hidayat', '3604252505990000', '', '0881-0257-45017', '22/10/2024', '03/11/2024', ' 25/05/199', 'Serang', 'Kp. Kabayan Rt.006/Rw.002 Mekarbaru - Kopo', '', '00/00/0000', '', '', '', 'Aktif', 'Ninggalin mobil di cisoka', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(27, 'M Febriansyah', '3203200203000000', '', '0838-9088-0093', '20/10/2024', '', ' 02/03/200', 'Tangerang', 'Kp. Candu Rt.03/Rw.01 Serdang wetan Legok-Tangerang', '', '00/00/0000', '', '', '', 'Aktif', 'Unit perbaikan masuk tgl 4 Nov 2024. 20 oktober (009) dan pindah unit tgl 4 Nov 2024 (018)', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(28, 'Caca', '3217082012030010', '', '0831-3461-0805', '09/04/2025', '10/04/2025', ' 20/12/200', 'PURWAKARTA', 'Kp. Jatiajar Rt 4/Rw 3 Sukatani, Purwakarta', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(29, 'Andi Muhammad Anwar Satriawan Langkong', '3603200110900000', '', '0831-4945-1690', '', '01/11/2024', ' 01/10/199', 'Makasar', 'Cikande Permai 010/17 Rt.002/Rw.008 Cikande-Serang', '', '00/00/0000', '', '', '', 'Aktif', 'Supir Lama, SUDAH 2 TAHUN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(30, 'Nahromi', '3602110307020000', '', '0881-0101-10522', '12/12/2024', '04/01/2025', ' 03/07/200', 'Lebak', 'Kp. Bantar jaya Rt.004/Rw.002 Jayamanik - Cimarga', '', '00/00/0000', '', '', '', 'Aktif', '7 oktober 2024 - 11 Desember 2024 (004) dan Supir menjual perisai mobil dan sudah ganti rugi sebesar 1jt', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(31, 'rian', '', '', '', '15/04/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(32, 'Jaelani Kubil', '3671102208000000', '', '0895-3391-69684', '01/06/2023', '', ' 22/08/200', 'Tangerang', 'Selapajang jaya Rt.006/Rw.003 Neglasari - Tangerang', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(33, 'Muhamad Rizal (SUPIR SEREP)', '3172012803020000', '', '', '02/12/2024', '', ' 28/03/200', 'Lebak', 'Kp. Salahaur Rt.03/Rw.11 Cijoro Lebak Rangkasbitung - Lebak', '', '00/00/0000', '', '', '', 'Aktif', 'Ninggalin unit di galian, dan variasi 020 di maling', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(34, 'Nurmansyah ', '3201180110810000', '', '0822-4610-6507', '05/03/2024', '25/09/2024', ' 01/10/198', 'Jakarta', 'Kp. Pasir Nangka Rt.01/Rw.02 Cipinang Rumpin Kab. Bogor', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(35, 'Maryusin', '', '', '0856-9158-6730', '28/09/2024', '17/12/2024', ' 06/05/197', 'Bogor', 'Kp.Sukasirna Rt.02/Rw.04 Tenjo-Bogor', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(36, 'Rohimin', '3602111010990000', '', '0819-9883-6146', '05/09/2024', '02/12/2024', ' 10/10/199', 'Lebak', 'Kp. Lebak Wru Rt.002/Rw.003 Cimarga', '', '00/00/0000', '', '', '', 'Aktif', 'Bawa kabur UJ 1 RIT 014, 855.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(37, 'Nur Yuda Aditya Putra (SUPIR BARU)', '3404090909000000', '', '0813-1430-4312', '17/12/2024', '21/12/2024', ' 09/09/200', 'Sleman', 'Jontro Rt.003/Rw.017 Gayamharjo - Prambanan', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(38, 'Sapari (SUPIR SERAP)', '1809010608740000', '', '', '24/11/2024', '13/12/2024', ' 06/08/198', 'Gunung Raja Lub', 'Taman Rejo, Rt.002/Rw.005 Bernung. Gedong tataan - pesawaran , Lampung', '', '00/00/0000', '', '', '', 'Aktif', 'Supir sering mengancam dan Jadi provokator', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(39, 'Dimas', '3603221011020000', '', '085890544241', '09/01/2025', '13/01/2025', ' 28/08/200', 'Tanggerang', 'Kp. Pagedangan Rt. 004/Rw. 001 Cicalangka Kec. Pagedangan', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(40, 'Topan', '', '', '', '08/02/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(41, 'Aco', '3601190402800000', '', '', '15-04-2024', '26/10/2024', '04-02-0198', 'Tangerang', 'Kp. Kukulu Rt.002/Rw.005 Mandalasari-Kaduhejo', '', '', '', '', '', 'Aktif', 'Laka Nabrak pembatas jalan di sepatan', 0, '2025-07-01 08:00:00', '2025-07-02 20:26:38'),
(42, 'Jaenudin (SUPIR BARU)', '3603200402810000', '', '0838-7149-7936', '04/11/2024', '12/12/2024', ' 04/02/198', 'Tangerang', 'Kp. Kemuning Rt.004/Rw.001 Kemuning-Legok', '', '00/00/0000', '', '', '', 'Aktif', 'Tidak diperbolehkan jalan Indikasi membawa uang jalan 1 rit, 1.005.000 Mobil di parkirkan di pool', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(43, 'Unyil (kakinya patah)', '', '', '', '25/04/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(44, 'Warnen', '', '', '', '19/04/2024', '23/12/2024', ' 24/11/196', 'Bandarlampung', 'Jl. diponegoro Gg. Batugajah, Kupangteba - Bandar lampung', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(45, 'AJI', '3603171810050000', '', '0838-7491-8910', '15/06/2024', '20/02/2025', ' 18/10/200', 'Tangerang', 'Kp. Tegal Rt.002/Rw.005 Kec.Curug Kab. Tangerang', '', '00/00/0000', '', '', '', 'Aktif', 'Dipecat, ninggalin mobil di multikon, bawa uj 1 rit 855.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(46, 'reja apri', '', '', '', '20/03/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(47, 'Keke Zakariya', '3216142603970000', '', '', '06/06/2024', '07/10/2024', ' 26/03/199', 'Bekasi', 'Kavling Bermis, Rt.007/Rw.004 Kel.Cisauk Kec. Cisauk - Tangerang', '', '00/00/0000', '', '', '', 'Aktif', 'Mobil ditinggal di buangan', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(48, 'Jamaludin Wijaya (SUPIR BARU)', '3603311801020000', '', '0812-9855-0932', '09/10/2024', '05/12/2024', ' 18/01/200', 'Tangerang', 'Kp.Cisereh Rt.02/Rw.01 Cisereh Tigaraksa-Tangerang', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(49, 'muhamad robi', '', '', '', '15/04/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(50, 'Agas Wahyu Saputra', '3604222106630000', '', '0852-1561-2514', '23/09/2024', '07/01/2025', ' 21/08/200', 'Serang', 'Kp. Sumur Peuteu Rt.008/Rw.002 Baros - Serang', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(51, 'Aminudin', '3603322710030000', '', '0857-1641-1827', '21/03/2024', '30/08/2024', ' 27/10/200', 'Tangerang', 'Kp. Babakan Rt.004/Rw.001 Tamiang - Gn. Kaler', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(52, 'M Rihan Saputra', '3603171709040000', '', '0889-7627-5722', '07/09/2024', '11/12/2024', ' 17/09/200', 'Tangerang', 'Kp. Kadu Jaya Rt.02/Rw.01 Kadu Jaya Curug - Tangerang', '', '00/00/0000', '', '', '', 'Aktif', 'supir ninggalin mobil di Kohod, speedometer dan eccu hilang, BAWA UJ 1 RIT 1.005.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(53, 'Afrizal (SUPIR BARU)', '1571022508650040', '', '', '28/11/2024', '02/12/2024', ' 25/08/196', 'Padang', 'Jl. Cendrawasih Rt.002/Rw.000 Kel. Pasir putih Kec. Jambi Selatan', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(54, 'Aep Alpiansyah (SUPIR 002)', '', '', '0857-1945-4623', '10-12-2024', '', '20-03-0200', 'Tangerang', 'Kp. Jeungjing Rt.004/Rw.003 Cisoka - Tangerang', '', '', '', '', '', 'Aktif', 'Supir ini jaminannya supir 005 a/n Wawan / Dewa 03 AGUSTUS 24 (002) DAN PINDAH UNIT BARU 10 DESEMBER 2024 (030)', 0, '2025-07-01 08:00:00', '2025-07-02 20:28:04'),
(55, 'putra', '', '', '', '07/04/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(56, 'Didin Wahyuni', '', '', '', '01/06/2024', '09/09/2024', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(57, 'Riki Putra Cahya', '3603310812970003', '', '0831-4516-4753', '10/09/2024', '04/11/2024', '23/12/1998', 'Tangerang', 'Kp.Sigeung Cadas Rt.04/Rw.01 Solear - Tangerang', '', '00/00/0000', '', '', '', 'Aktif', 'SUPIR MENGHILANGKAN SPEEDO DAN ELEKTRIK, KASBON UJ 350.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(58, 'Bambang Suteja', '3208212407870001', '', '', '05/11/2024', '25/12/2024', '24/07/1987', 'Kuningan', 'Jl. Kayu Manis V Baru Gg. Dadap VII No.22 Rt.006/Rw.004 Kel. Kayu Manis Kec.Mtraman', '', '00/00/0000', '', '', '', 'Aktif', 'Supir pindahan dari Team V', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(59, 'Dimas Faizal', '3328152011980006', '', '0816-1760-0204', '15/06/2024', '04/11/2024', '20/11/1998', 'Tegal', 'Cakung Barat, Rt.003/Rw.004 Cakung barat - Cakung', '', '00/00/0000', '', '', '', 'Aktif', 'KABUR BAWA UANG JALAN 855.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(60, 'Mohamad Rifai', '', '', '0814-0175-0428', '14/11/2024', '05/04/2025', '31/10/2005', 'Tangerang', 'Kp. Pabuaran Rt.02/Rw.01 Tegalsari, Tigaraksa - Tangerang', '', '00/00/0000', '', '', '', 'Aktif', 'KLAIM BAN STIP GIGA 1pc MELEDAK POSISI BITUNG TGL 29/12/2024', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(61, 'Budi Stiyawan pindah', '', '', '0895-3401-72487', '05/04/2025', '', '02/03/2000', 'Lebak', 'Kp. Cibeurih Rt.017/Rw.005 Ds.Margaluyu Sajira- Lebak', '', '00/00/0000', '', '', '', 'Aktif', '-', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(62, 'David Rizki', '3217051604960004', '', '0857-7213-4412', '05/03/2024', '05/04/2025', '16/04/1996', 'Bandung', 'Kp. Tenjolaya Rt.002/Rw.013 Kel. Perbawati Kec. Sukabumi', '', '00/00/0000', '', '', '', 'Aktif', '-', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(63, 'Rohedi', '3602112406950002', '', '0812-9588-0867', '12/06/2024', '12/12/2024', '24/06/1995', 'Lebak', 'Kp. Sangiang Rt.002/Rw.002 Cimarga-Lebak', '', '00/00/0000', '', '', '', 'Aktif', 'OPLOS BD 2 , BB 1, KASBON UJ 570.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(64, 'Wisnu Muhammad', '3213031810970011', '', '0821-3834-7970', '26/10/2024', '05/04/2025', '18/10/1997', 'Subang', 'Blok Bunder Rt.034/Rw.008 Dangdeur - Subang', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(65, 'Nurdin', '3602060705700007', '', '0857-7036-8542', '16/08/2024', '05/04/2024', '07/05/1970', 'Lebak', 'Kp. Cirangga Rt.005/Rw.001 Cibungur - Leuwidamah', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(66, 'Muhamad Juber', '3602121108010004', '', '0813-8492-1670', '15/04/2024', '07/12/2024', '09/09/2001', 'Lebak', 'Kp. Cibokor Rt.003/Rw.006 Ds. Ciuyah Kec. Sajira', '', '00/00/0000', '', '', '', 'Aktif', 'BAWA UANG JALAN 1 RIT 1.000.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(67, 'Marta ', '3604262902840002', '', '', '23/01/2025', '05/04/2024', '29/02/1984', 'Serang', 'Kp. Pasir eurih Rt.02/Rw.06 Mekarsari, Rangkasbitung - Lebak', '', '00/00/0000', '', '', '', 'Aktif', '02 Desember - 22 januari 2025 (031) & pindah unit (053) 23 januari 2025', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(68, 'muhammad refal', '', '', '', '', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(69, 'Sugiarto', '1812051712130005', '', '0857-6249-2027', '03/05/2024', '01/11/2024', '05/11/1993', 'Bogor', 'Bangun Jaya Rt.001/Rw.001 Tulang Bawang Barat', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(70, 'Supriyatna', '3603320906990008', '', '0831-2931-0280', '04/11/2024', '-', '27/06/1999', 'Tangerang', 'Kp. Pabuaran Rt.05/Rw.01 Ds. Tamiang Kec. Gn.Kaler', '', '00/00/0000', '', '', '', 'Aktif', '02/08/2024  - 03/11/2024 (031) DAN PINDAH UNIT TANGGAL 4 NOV 2024 (055) dan Nabrak buntut talenta tgl 25/10/2024 di Kohod (031), di pecat', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(71, 'Suherman', '', '', '0895-4247-23084', '13/07/2024', '05/04/2025', '26/06/2003', 'Lebak', 'Kp.Baru Gardu Batok Rt.003/Rw.006 Margaluyu Cimarga - Lebak', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(72, 'Muhamd Juber (bawaan supir 033)', '360212118010004', '', '', '25/05/2025', '', '09/09/2001', 'Lebak', 'kp. nagrog rt. 004/rw. 001', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(73, 'Jumyati', '3202040911680003', '', '0856-9275-1865', '16/04/2024', '', '09/11/1968', 'Sukabumi', 'Kp. Pangkalan Rt.03/Rw.03 Bojonggaling - Bantargadung Sukabumi', '', '00/00/0000', '', '', '', 'Aktif', '-', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(74, 'Arif Hidayat', '3604252503800001', '', '', '16/04/2024', '07/11/2024', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(75, 'Rama Hidayat', '', '', '', '10/02/2025', '05/04/2024', '01/09/1998', 'Lembak', 'Kadu Beureum Rt.2/1 Prabugantungan Cileles-Lembak', '', '00/00/0000', '', '', '', 'Aktif', 'kabur sudah di tangkap', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(76, 'Ernadi', '3604250505830002', '', '0812-8624-8525', '29/06/2024', '05/04/2025', '05/05/1983', 'Lampung', 'Kp. Parung Rt.017/Rw.004 Cikasungka - Solear', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(77, 'Mulyadi', '3603063012640002', '', '0853-7964-4092', '16/04/2024', '', '30/12/1964', 'Tangerang', 'Kp. Ketileng Rt.003/Rw.001 Talok, Kresek', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(78, 'Muhamad Daelani', '-', '', '0814-0164-6621', '20/11/2023', '16/09/2024', '06/02/2001', 'Lebak', 'Kp.Cisampang Rt.07/Rw.02 Cisampang - Gunung Kencana - Lebak', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(79, 'Hamami', '3201202205920001', '', '0859-5969-7441', '17/09/2024', '05/04/2025', '22/05/1992', 'Bogor', 'Kp. Cikabon Rt.01/Rw.06 Parung Panjang - Bogor', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(80, 'Tedi', '3201181502040001', '', '0814-0168-8470', '22/07/2024', '01/11/2024', '15/02/2004', 'Bogor', 'Kp. Pabuaran Rt.001/Rw.004 Kec.Kertajaya Kec.Rumpin', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(81, 'Wandi', '', '', '0831-7137-8984', '13/07/2024', '14/11/2024', '15/03/1995', 'Bogor', 'Kp. Pasir Kalong Rt.01/Rw.04 Cigudeg - Kab. Bogor', '', '00/00/0000', '', '', '', 'Aktif', 'SUPIR NINGGALIN MOBIL, BAWA KABUR SPEEDOMETER ECCU, BAWA KABUR UANG JALAN 855.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(82, 'Suhendi (SUPIR BARU)', '', '', '', '25/11/2024', '30/11/2024', '25/10/2006', 'Tangerang', 'Kp.Sibadak Rt.003/Rw.005 Caringin Kec. Cisoka', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(83, 'Muhamad Satibi', '', '', '', '21/01/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '2 November 2024 - 20 Januari 2025 ( 064) & Pindah unit tanggal 21 januari 2025 (065)', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(84, 'Riki Rianto', '3602140212910004', '', '0858-1931-9637', '16/04/2024', '05/04/2025', '02/12/1991', 'Lebak', 'Kp. Kaduang Rt.03/Rw.03 Ds.Mekarsari Rangkas Bitung - Lebak', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(85, 'Muhamad Halwaludin', '3201152709000005', '', '0896-5390-9546', '05/04/2025', '', '27/09/1997', 'Bogor', 'Bogor Cibanteng Proyek Rt.03/Rw.04 Ciampea', '', '00/00/0000', '', '', '', 'Aktif', '16 april 2024 - 04 april 2025 (061) - pindah unit 068 tanggal 05 april 2025', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(86, 'Agung Awaludin', '3602141108020001', '', '0838-1836-8645', '16/04/2024', '05/04/2025', '11/08/2002', 'Lebak', 'Kp.Binaya Rt.002/Rw.002 Mekarsari - Rangkasbitung', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(87, 'Arman Romi Wijaya', ' ', '', '0822-7906-8659', '05/04/2025', '', '01/10/1998', 'Berhen', 'Dusun 14 sindang Anom Rt.02/Rw.001 Sekampung Udik - Lampung timur', '', '00/00/0000', '', '', '', 'Aktif', '8 november 2024 - 09 feb 2025 (059) | pindah unit baru (085) tanggal 10 feb 2025 - 04 april 2025 | pindah unit 068 tanggal 05 april 2025', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(88, 'Misja (SERAP)', '3201180110810002', '', '0838-5117-6250', '25/09/2024', '18/11/2024', '24/03/2005', 'Serang', 'Kp. Pabuaran Tegal Rt.03/Rw.09 Cikande - Serang', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(89, 'Ferdi', '3603320805070006', '', '0831-4624-6576', '19/11/2024', '05/04/2025', '08/05/2006', 'Tangerang', 'Kp. Pabuaran Rt.05/Rw.01 Tamiang Kec. Gn.Kaler', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(90, 'unyil, hilman', '', '', '', '06/04/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(91, 'Dedi Mahardi', '-', '', '0859-2002-3999', '29/08/2024', '', '03/11/1978', 'Lebak', 'Kp. Sengkol Rt.002/Rw.002 Ds.Pasarkeong Cibadak - Lebak', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(92, 'Asep', '3201201502010003', '', '0857-8178-7161', '18/07/2024', '13/11/2024', '15/02/2001', 'Bogor', 'Kp. Ciawian Rt.010/Rw.004 Goworong - Parung panjang', '', '00/00/0000', '', '', '', 'Aktif', 'SUPIR NINGGALIN MOBIL, kasbon uj 300.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(93, 'Gebol', '', '', '', '15/11/2024', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(94, 'Ma mur', '3201220806840008', '', '0857-7713-0848', '16/04/2024', '05/04/2025', '08/06/1984', 'Bogor', 'Kp. Raganis Rt.003/Rw.001 Cintamanik - Cigudeg', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:03'),
(95, 'Maman Firdaus (SERAP)', '', '', '0857-7066-0848', '18/10/2024', '06/04/2025', '15-16-2003', 'Bogor', 'Kp. Pasir gintung Rt.3/Rw.2 Batu Tulis Nanggung - Bogor', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(96, 'Kiki Anggriana', '3602133012950002', '', '0831-8281-9499', '10/09/2024', '30/11/2024', '22/11/1995', 'Lebak', 'Kp. Kabayan Ater Rt.004/Rw.002 Mekarbaru - Kopo', '', '00/00/0000', '', '', '', 'Aktif', 'BAWA KABUR UANG JALAN 1.000.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(97, 'Ari Silaban', '36033001010940012', '', '', '16/04/2024', '25/07/2024', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(98, 'Masud', '', '', '0856-9436-1923', '10/08/2024', '19/11/2024', '03/04/1992', 'Serang', 'Kp. Babakan cikonengf Rt.001/Rw.002 Maraya - Sajira', '', '00/00/0000', '', '', '', 'Aktif', 'SUPIR BAWA UANG JALAN 1 RIT, 780.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(99, 'Hendi', '3604250707980006', '', '0838-4744-6060', '16/04/2024', '23/12/2024', '07/07/1998', 'Serang', 'Kp. Tegal Rt.002/Rw.005 Kec.Curug Kab. Tangerang', '', '00/00/0000', '', '', '', 'Aktif', 'BAWA KABUR UANG JALAN + KASBON : 1.400.000 ( SUDAH DI TANGKAP)', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(100, 'Rizal Wiguna', '', '', '', '06/06/2024', '24/09/2024', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(101, 'Nurul Falah', '3603201203050005', '', '0895-3261-29498', '25/09/2024', '05/04/2025', '12/03/2005', 'Tangerang', 'Kp.Bungaok Rt.004/Rw.002 Caringin - Legok', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(102, 'Andi ', '3602122703010003', '', '0852-1343-2682', '05/04/2025', '', '23/03/2004', 'Lebak', 'Kp.Cibeurih Rt.017/Rw.005 Margaluyu-Sajira', '', '00/00/0000', '', '', '', 'Aktif', '05/06/2024 - 04 april 2025 (056) & pindah unit (086) tanggal 05 april 2025', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(103, 'Abdul Mutholib', '-', '', '0895-3521-14508', '10/01/2024', '15/11/2024', '18/08/1995', 'Pandeglang', 'Kp. Cinunggal Rt.002/Rw.004 Banjar - Pandeglang', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(104, 'Ega Novianto', '3213271711000001', '', '0814-1059-8783', '15/11/2024', '05/04/2025', '17/11/2000', 'Subang', 'Kp. Cihujung Rt.019/Rw. 004 Rawalele', '', '00/00/0000', '', '', '', 'Aktif', 'SUPIR KABUR BAWA SPEEDOMETER, ECCU & UANG JALAN 855.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(105, 'Fahri Maulida Diya Ulhaq', '3175011806010003', '', '0814-1235-1725', '29/06/2024', '17/11/2024', '18/05/2001', 'Jakarta', 'Puri Hrmoni Blok C11 Rt.019/Rw.001 Serdang - Kuloh Panongan', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(106, 'Dana (SUPIR BARU)', '3162210423020001', '', '0831-3465-4281', '26/11/2024', '', '11/10/1999', 'Lebak', 'Kp. Pariuk Nangkub Rt.001/Rw.003 Cilangkap Kec. Kalanganyar', '', '00/00/0000', '', '', '', 'Aktif', 'TIDAK USAH DI HITUNG TABUNGAN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(107, 'Adi Wahyudi (Serep)', '', '', '', '', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'SUPIR BAWA KABUR UANG JALAN 1 RIT (1.000.000). POT TABUNGAN 085 HENDI)', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(108, 'Aris', '', '', '', '10/08/2024', '05/04/2025', '05/08/1988', 'Bogor', 'Kp. Leuwi Goong Rt.012/Rw.004 Ginting Cilejit Parung - Bogor', '', '00/00/0000', '', '', '', 'Aktif', 'rsign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(109, 'Agus Sopandi', '3602111103970002', '', '0898-3686-128', '01/05/2024', '', '11/08/1998', 'Lebak', 'Kp. Lebak waru Rt.030/Rw.003 Cimarga - Lebak', '', '00/00/0000', '', '', '', 'Aktif', '-', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(110, 'Opik Baedillah', '', '', '0858-1043-9461', '10/08/2024', '17/11/2024', '05/10/1999', 'Bogor', 'Kp. Leuwi Ceuri Rt.003/Rw.007 Cigudeg - Bogor', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(111, 'Riki', '', '', '', '18/11/2024', '19/12/2024', '12/04/2004', 'Tangerang', 'Kp. Ciakar Rt.02/Rw.04 Cileles Tigaraksa - Tangerang', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(112, 'Pandi', '', '', '', '20/12/2024', '22/01/2025', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'MENINGGALKAN MOBIL DI BOGEG, 1.000.000 uj ciomas, 600.000 kasbon, di bebankan ke supir 085 hendi', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(113, 'Muhid Mulyana', '', '', '', '10/02/2025', '05/04/2025', '10/12/2001', 'Lembak', 'Kp. Cibogo Rt.04/05 Leuwidamar Kab. lembak', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(114, 'Refal', '3173071702071001', '', '0877-3375-2566', '04/06/2025', '', '17/02/2007', 'Jakarta', 'citra raya, kab. tanggerang', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(115, 'Arsani', '3602101907940002', '', '0831-3294-8130', '10/08/2024', '10/12/2024', '19/07/1984', 'Lebak', 'Kp.Cijengkol Rt.003/Rw.001 Parungkujang - Cileles', '', '00/00/0000', '', '', '', 'Aktif', 'SUPIR KABUR BAWA UANG JALAN 1 RIT, 1.000.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(116, 'Dede Jimi', '', '', '', '21/06/2024', '28/08/2024', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN. KASBON : 700.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(117, 'Rokih Saputra', '', '', '', '28/10/2024', '05/04/2025', '26/03/2000', 'Tangerang', 'Rawa Rotan Rt.007/Rw.001 Selapajang jaya - Tangerang', '', '00/00/0000', '', '', '', 'Aktif', 'resgin', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(118, 'Sudiono', '3305202712700001', '', '0822-1357-2746', '16/04/2024', '30/01/2025', '27/12/1970', 'Kebumen', 'Plarangan Rt.005/Rw.005 Ds. Plarangan Karanganyar', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(119, 'Aryani', '', '', '0857-1424-9647', '10/02/2025', '', '01/03/1995', 'Bogor', 'Kp. Barengkok Rt.01/Rw.04 Barengkok Jasinga - Bogor', '', '00/00/0000', '', '', '', 'Aktif', '16 april 2024 - 09 feb 2025 (069)- pindah unit baru (098) tanggal 10 feb 2025', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(120, 'Ahmad', '', '', '0856-6454-6214', '08/08/2024', '10/02/2025', '17/08/1994', 'Bogor', 'Bangsri Rt.002/Rw.008 Bulakamba - Brebes', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(121, 'Suryadi', '3603320312760001', '', '', '21/02/2025', '05/04/2025', '03/12/1976', 'Tangerang', 'Kp. Pasir Toge Rt 010/Rw 002 Ds. Tamiang, Kec. Gunung kaler', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(122, 'ADI SURYADI', '', '', '', '29/05/2024', '24/08/2024', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(123, 'ARIS', '', '', '', '07/04/2025', '25/04/2025', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'KABUR MENINGGALKAN MOBIL D KOHOD, UJ 1.000.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(124, 'Mumu, (SUPIR BAWAAN MEGI 205)', '3604221710000004', '', '0838-9444-6820', '03/06/2025', '', '17/10/2000', 'Serang', 'Kp. Honje RT. 004/RW. 003, KEL. SUKA INDAH, KEC. BAROS', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(125, 'ABAS ', '', '', '', '05/06/2024', '07/08/2024', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(126, 'HERI YANTO SIDABALOK', '6302153011940001', '', '0813-6299-4665', '05/09/2024', '02/12/2024', '30/11/1994', 'MEDAN', 'JL. KAWAT III G. PADI NO 18 LK 18 LK.18 TANJUNG MULYA MEDAN DELI', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN (TABUNGAN SUDAH KELUAR)', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(127, 'YANSARI (SUPIR BARU RESIGN)', '1605182702800001', '', '', '02/12/2024', '09/12/2024', '27/02/1979', 'MUARA KATI BARU', 'DUSUN IV RT.000/RW.000 MUARA KATI BARU I KEC. TIANG PUMPUNG KEPUNGUT - MUSI RAWAS SULAWESI SELATAN', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(128, 'ARSAD', '', '', '', '10/04/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(129, 'HENDRA WIJAYA ', '3603122008800024', '', '', '09/07/2024', '17/11/2024', '20/08/1980', 'TANGERANG', 'JL. PERKUTUT IV BLOK E-40 NO.5 PD SEJATERA RT 013 RW 010 KEL. KUTABARU PASARKEMIS', '', '00/00/0000', '', '', '', 'Aktif', 'KABUR BAWA UANG JALAN 1 RIT 855.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(130, 'CACANG (BATANGAN)', '', '', '', '21/11/2024', '01/03/2025', '10/12/1979', 'BANDUNG BARAT', 'KP. CINAGERANG RT.01/RW.02 KEC. CIPEUNDEUY KAB. BANDUNG BARAT', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(131, 'AHMAD SARNUBI (BAWAAN CECEP SUPIR 905)', '', '', '', '03/06/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(132, 'ENDI SUHENDI', '360214070776001', '', '', '11/09/2024', '17/11/2024', '07/07/1976', 'LEBAK', 'KP. SANGIANG RT 003 RW 004 DS. PABUARAN RANGKAS BITUNG', '', '00/00/0000', '', '', '', 'Aktif', 'BAWA KABUR UANG JALAN 1 RIT Rp. 855.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(133, 'IWAN ', '3602140503000009', '', '0838-2151-1806', '18/11/2024', '16/12/2024', '05/03/1994', 'LEBAK', 'KP. MANUNGTUNG RT 003 RW 007 BABAKAN - LEGOK', '', '00/00/0000', '', '', '', 'Aktif', 'SERAP MULAI 18 SEPT 2024 UNIT 106 DAN KABUR BAWA UJ 1 RIT 855.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(134, 'ABD SOMAD (SUPIR BARU)', '3571052707760011', '', '0851-3555-5727', '08/01/2025', '09/01/2025', '27/07/2976', 'TANGERANG', 'JL. H MUCHTAR RT.08/RW.03 KEL. DURI - KOSAMBI JAKARTA BARAT', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(135, 'Uwes Sukurni', '3674071108740002', '', '-', '17/02/2025', '01/03/2025', '11/08/1974', 'TANGERANG', 'KP. KOCEAK RT 004/RW 002 DS. KERANGGAN KEC. SETU', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(136, 'Alek Tambunan', '', '', '', '10/04/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(137, 'Sigit Yulias Setiawan', '33012208780005', '', '', '18/11/2024', '01/03/2025', '20/07/1996', 'CILACAP', 'JL. PAKURAN RT.003/RW.001 BULUPAYUNG KEC.KESUGIHAN', '', '00/00/0000', '', '', '', 'Aktif', 'resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(138, 'Supriatna (BAWAAN ANDI, SUPIR 604)', '3602101611970005', '', '', '28/05/2025', '', '16/11/1997', 'LEBAK', 'KP. CAHAYA MEKAR RT. 001/RW. 005 KEL/DESA PASINDANGAN, KEC. CILELES', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(139, 'Ardiansyah', '3603232501990002', '', '-', '17/02/2025', '26/05/2025', '25/01/1999', 'TANGERANG', 'KP NEGHONG RT 001/RW002 DS. CISAUK KEC. CISAUK', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(140, 'Sandi Nopiyana (BAWAAN ANDI, SUPIR 604)', '360210071190005', '', '085892530128', '28/05/2025', '', '97/11/1990', 'LEBAK', 'KP. CICALUNG RT 003/RW. 006', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(141, 'M. HERDIYANA', '', '', '', '16/04/2024', '18/07/2024', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(142, 'NASUHI', '', '', '', '19/07/2024', '02/09/2024', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(143, 'ASEP ', '3602040406880002', '', '', '04/09/2024', '20/12/2024', '04/06/1988', 'SUKABUMI', 'KP.GAJRAG RT 006 RW 002 DS BINTANG RESMI CIPANAS - LEBAK  ', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(144, 'Karna', '3604261008870004', '', '0852-8191-6857', '21/12/2024', '01/05/2025', '10/08/1987', 'SERANG', ' KP. MANDUNG INPRES RT.016/RW.002 DS. JUNTI KEC. JAWILAN', '', '00/00/0000', '', '', '', 'Aktif', 'KABUR, MENINGGALKAN MOBIL D CIOMAS. 1000.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(145, 'SYAHRIL', '', '', '', '21/05/2025', '04/06/2025', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(146, 'HANIK', '', '', '', '12/06/2025', '31/08/2024', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(147, 'Megi Rustiawan', '3602202401990001', '', '0838-9259-5843', '01/09/2024', '', '06/06/1998', 'LEBAK', 'KP. TIPAR RT 004 RW 001 LEBAK TIPAR KEC. CIOGRANG', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(148, 'Anda Suhanda', '3601112208880001', '', '', '04/09/2024', '', '22/06/1988', 'PANDEGLANG', 'KP. KADUBERA RT 007 RW 002 KADUBERA PICUNG - PANDEGLANG', '', '00/00/0000', '', '', '', 'Aktif', 'KABUR, KASBON UJ 950.000 + 300 ', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(149, 'Rifkiana', '', '', '', '15/04/2025', '01/05/2025', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(150, 'Ahmad', '', '', '', '02/05/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '12/04/2025 - 01 MEI 25 (504) PINDAH UNIT BARU ', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(151, 'AHMAD', '', '', '', '12/06/2024', '18/07/2024', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(152, 'Endang Mulyadi', '', '', '', '17/04/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(153, 'SAHRUL NUDIN (SEREP )', '3603322811050006', '', '', '22/11/2024', '', '28/11/2005', 'TANGERANG', 'KP. SAKEM RT.012/RW.003 DS. TAMIANG KEC. GUNUNG KALER', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(154, 'DJAENUDIN', '', '', '', '07/01/2025', '11/01/2025', '05/04/1969', 'PANDEGLANG', '', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(155, 'Muslim baru', '', '', '', '20/04/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(156, 'PANGI', '3172042506690013', '', '0838-6997-6927', '10/09/2024', '18/12/2024', '25/06/1969', 'INDRAMAYU', 'KP. CINONA RT.002/RW.011 NYALINDUNG KEC. CIPATAT', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(157, 'Pebriansyah', '3601230302990007', '', '', '26/01/2025', '', '03/02/1999', 'LAMPUNG', 'KP. CIRUKAP RT.03/RW.01 CIIBARANI CISAYA - PANDEGLANG', '', '00/00/0000', '', '', '', 'Aktif', '23 November 2024 - 25 Januari 2025 (305) dan pindah unit (304)  serta KABUR BAWA UJ 1.000.000, KASBON UJ 600.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(158, 'Putra', '', '', '', '16/04/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(159, 'ROPIYUDIN', '3604250605020002', '', '', '03/07/2024', '22/11/2024', '06/05/2002', 'SERANG', 'KP. NANGGUNG RT 010 RW 003 NANGGUNG - KOPO', '', '00/00/0000', '', '', '', 'Aktif', 'Resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(160, 'Juman', '3602060109630002', '', '0856-9252-2198', '08/04/2025', '30/05/2025', '01/09/1963', 'LEBAK', 'KP. BOJONGMANIK RT. 005/RW 002, DES. BOJONGMANIK, KEC. BOJONGMAIK', '', '00/00/0000', '', '', '', 'Aktif', 'UJ PAK BANCIN TERPAKAI 350.000, POT TABUNGAN SUPIR, KEJAIDAN MOBIL 305 D BAWA POLISI DAN SUPIR MENGALAMI STUK. RESIGN ( SALDO TABUNGAN APRIL 14 RIT, MEI 13 RIT. TOTAL : 27 RIT )', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(161, 'BUGIANA (BAWAAN JULFIKAR DT. 703)', '', '', '', '01/06/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(162, 'samsudin', '', '', '', '18/04/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(163, 'nasrul', '', '', '', '06/04/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(164, 'Jaja', '', '', '', '10/05/2024', '02/07/2024', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(165, 'dika', '', '', '', '16/06/2025', '18/06/2025', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'uj kabur 1.000.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(166, 'JULKIFLI PURBA', '1208260206900001', '', '0817-7924-4080', '18/04/2024', '10/12/2024', '02/06/1990', 'DOLOK MARAJA', 'SENOPATI STATE BLOK B9 RT.005/RW.011 BANTARGEBANG - BEKASI', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN PINDAH KERJA KE KALIMANTAN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(167, 'Beni Andika', '1305012702990002', '', '0831-1791-6158', '13/05/2024', '20/02/2025', '27/02/1999', 'SIKABU', 'BALANTI, SIKABU LUBUK ALUNG', '', '00/00/0000', '', '', '', 'Aktif', '16 April 2024 - 12 Mei 2024 (203) DAN PINDAH UNIT 505, resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(168, 'Redi Saputra', '1371112112860009', '', '0812-9753-0320', '01/04/2025', '18/05/2025', '21/12/1986', 'PADANG', 'AIR DINGIN, RT.02/RW.05 BALAI GADANG - PADANG', '', '00/00/0000', '', '', '', 'Aktif', '05/09/2024 - 31 maret  (502) dan pindah unit 505 dan KABUR, UJ 1.200.000, MENINGGALKAN MBIL D POOL', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(169, 'M. ALI WAPA', '', '', '', '05/06/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(170, 'Sigit Muhajirin', '3602141507030003', '', '0813-9886-1457', '08/09/2024', '', '09/10/2002', 'LEBAK', 'KP. MULIH RT.02/RW.03 DS. MEKARSARI RANGKAS BITUNG - LEBAK', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(171, 'Muslim', '3602182907010004', '', '0838-2296-5896', '07/09/2024', '16 pril 20', '29/07/2000', 'LEBAK', 'KP. PASIR IPIS RT.04/RW.05 KADUAGUNG BARANG CIBADAK - LEBAK', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(172, 'Udin', '', '', '', '17/04/2025', '', '25/08/2006', 'KP LEBAK PEUSAR', '', '', '00/00/0000', '', '', '', 'Aktif', ' 07/01/2025 - 16 april 2025 (302) dan pindah unit 507', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(173, 'LANDI', '1606518241280000', '', '', '14/09/2024', '09/12/2024', '24/12/1980', 'TABA KEBON', 'MUARA KATI BARU I TIANG PUMPUNG KEPUNGUT MUSI RAWAS', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN PINDAH KERJA KE KALIMANTAN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(174, 'Saepudin', '3604292003810004', '', '0838-9823-4621', '08/04/2025', '', '20/03/1981', 'SERANG', 'KP. CIKONENG RT 06/RW 03 PADARINCANG SERANG', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(175, 'SENDI MAULANA', '', '', '', '04/09/2024', '19/10/2024', '12/04/1994', 'TEGAL', 'DS. KALISALAK RT.02/RW.08 KEC. MARGASARI KABUPATEN TEGAL', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN PINDAH KERJA KE KALIMANTAN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(176, 'Taran', '3328011803720003', '', '', '20/10/2024', '28/03/2025', '', ' ', 'KALISALAK, RT02/RW.08 KEC. MARGASARI KAB. TEGAL', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(177, 'Rangga', '', '', '', '15/04/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(178, 'Dien Pradesa', '1605180607820001', '', '0838-5426-5847', '05/09/2024', '', '06/07/1982', 'MUSI RAWAS', 'MUARA KATI BARU I TIANG PUMPUNG KEPUNGUT MUSI RAWAS', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(179, 'ROYAN KUSTIWA', '', '', '0813-9846-9262', '01/04/2024', '17/09/2024', '01/03/1993', 'SUKABUMI', 'KP. CIBUNGUR I RT.04/RW.04 TELAGA MURNI - SUKABUMI', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN PINDAH KERJA KE KALIMANTAN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(180, 'Yana Nuryana', '3602272611030001', '', '', '18/09/2024', '', '07/09/2001', 'LEBAK', 'KP. DUNGKUK RT. 09/ RW. 03 CIRINTEN - LEBAK', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(181, 'SAEPUL NURJAMAN', '-', '', '0856-1905-939', '05/06/2024', '14/09/2024', '14/10/1999', 'SUKABUMI', 'KP. CINYUMPUT RT.07/RW.02 KEC.CIRAYAP - SUKABUMI', '', '00/00/0000', '', '', '', 'Aktif', '18 APRIL 2024 - 04 JUNI 2024 (101) PINDAH UNIT BARU (602) ', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(182, 'Ahmad', '3604260604010003', '', '0831-3463-2905', '15/09/2024', '', '06/04/2001', 'SERANG', 'KP. TEGAL SARI RT.07/RW.02 CEMPLANG KEC. JAWILAN', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(183, 'Edwin', '', '', '', '13/04/2025', '20/04/2025', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'KABUR MENINGGALKAN MOBIL DI BOGEK, UJ KABUR 1.000.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(184, 'ADE PRIYANTO (BAWAAN WAHID 603)', '', '', '', '29/05/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(185, 'Hari Bahtiar', '-', '', '0821-2084-4276', '05/06/2024', '01/03/2025', '22/11/2005', 'PURWAKARTA', 'KP. CINANGGERANG RT.01/RW.02 CIPENDEUY BANDUNG BARAT', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(186, 'Abdul Wahid', '3603230911990006', '', '0881-0249-54239', '10-04-2024', '', '09-11-1999', 'TANGERANG', 'KP. CIBADAK RT.001/RW.002 KEL. SURADITA KEC. CISAUK', '', '', '', '', '', 'Aktif', '10/12/2024 - 9 APRIL (103) - PINDAH UNIT 603 ', 0, '2025-07-01 08:00:00', '2025-07-02 20:05:54'),
(187, 'Bayu Pratama', '-', '', '', '06/06/2024', '28/02/2025', '24/07/1997', 'TANGERANG', 'KP. BABAKAN BARAT RT.02/RW.06 LEGOK - TANGERANG', '', '00/00/0000', '', '', '', 'Aktif', '16 APRIL 2024 - 09 mei 2024 (503) dan PINDAH UNIT (604) ', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(188, 'Andi', '', '', '', '01/03/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(189, 'Diki Wahyudi', '3603010607960001', '', '0838-1996-7200', '20/10/2024', '20/10/2024', '06/07/1996', 'TANGERANG', 'KP. CIPETEUY RT.02/RW.01 DS. TOBAT BALARAJA - TANGERANG', '', '00/00/0000', '', '', '', 'Aktif', '16 APRIL 2024 - 4 JUNI 2024  (102) dan PINDAH UNIT BARU (605) 5 JUNI 2024 dan resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(190, 'JAENAL A ', '36021152305890001', '', '0838-2928-9561', '22/10/2024', '18/02/2025', '23/05/1989', 'LEBAK', 'KP.BARU RT.002/RW.004 DS. GUBUGAN CIBEREUM KEC. MAJA', '', '00/00/0000', '', '', '', 'Aktif', 'MENINGGALKAN MOBIL DI KOHOD', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(191, 'Risman', '', '', '', '15/04/2025', '18/05/2025', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'KABUR UJ BAWA 1.200.000, MENINGGALKAN MOBIL D POOL', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(192, 'WANDI ANWAR WAHYUDI', '3203030609890012', '', '0858-8243-9869', '31/05/2025', '', '06/09/1989', 'CIANJUR', 'KP. SUKAJADI RT 001 RW 003 SUKANAGARA KAB. CIANJUR', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(193, 'Richo Jhonatan I', '1202030612920002', '', '0812-8445-2186', '11/06/2024', '', '06/12/1990', 'JAKARTA', 'PERMATA TIMUR 3 RT.01/RW.01 KEL. JATICEMPAKA - KOTA BEKASI', '', '00/00/0000', '', '', '', 'Aktif', '15 APRIL 2024 - 11 JUNI 2024 (501) DAN PINDAH UNIT BARU (701)', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(194, 'Angga', '3601110506010002', '', '0859-6045-2780', '12/06/2024', '07/04/2025', '05/06/2001', 'PANDEGLANG', 'KP. BABAKAN KANAS RT.03/RW.06 KADUBERA KEC. PICUNG', '', '00/00/0000', '', '', '', 'Aktif', '18 APRIL 2024 - 11 JUNI 2024 (302) dan PINDAH UNIT BARU (702) ', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(195, 'Eky Apriliyana', '', '', '', '08/04/2025', '', '10/04/2000', 'PANDEGLANG', 'KP. LEBAK PURUT RT.06/RW.03 DS. BANJARSARI KADUHEJO KAB. PANDEGLANG', '', '00/00/0000', '', '', '', 'Aktif', '16 april - 4 september 2024 (510) dan pindah unit baru tanggal (808) 07/09/2024 - pindah unit 702', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18');
INSERT INTO `drivers` (`id`, `name`, `nik`, `license_number`, `phone`, `tgl_join`, `tgl_keluar`, `tgl_lahir`, `tempat_lahir`, `alamat`, `nomor_darurat`, `tgl_exp_sim`, `img_profile`, `img_sim`, `img_ktp`, `status`, `keterangan`, `is_delete`, `created_at`, `updated_at`) VALUES
(196, 'EGI ADITYA', '-', '', '0838-9526-5742', '11/06/2024', '17/11/2024', '07/08/1996', 'SINDANG AGUNG', 'DUSUN 02 RT. 02/RW.02 SD. AGUNG TANJUNG RAJA - LAMPUNG UTARA', '', '00/00/0000', '', '', '', 'Aktif', 'Klaim Full Terpal 08 NOV 2024 (Resign)', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(197, 'Sanja', '3602120412930005', '', '0888-0867-9467', '18/11/2024', '13/03/2025', '10/09/1996', 'LEBAK', 'KP. SUSUKAN RT 010 DS. BUNGURMEKAR SAJIRA - LEBAK', '', '00/00/0000', '', '', '', 'Aktif', '16 SEPT 2024 - 16 NOV 2024 (202) DAN PINDAH UNIT BARU (703) dan RESIGN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(198, 'Zulfikar', '', '', '', '13/05/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(199, 'Abdul Halim', '3602180410970001', '', '', '12-06-2024', '', '04-10-1997', 'LEBAK', 'KP. CIGOMOK RT.10/RW.03 PADASUKA - LEBAK', '', '', '', '', '', 'Aktif', '16 APRIL 2024 - 11 JUNI 2024 (205) dan PINDAH UNIT BARU (704) ', 0, '2025-07-01 08:00:00', '2025-07-02 20:04:38'),
(200, 'Riski', '3602181810060001', '', '', '12/06/2024', '28/01/2025', '18/10/1999', 'LEBAK', 'KP. PASIR IPIS RT.03/RW.05 JATI MULYA - LEBAK', '', '00/00/0000', '', '', '', 'Aktif', '16 APRIL 2024 - 11 JUNI 2024 (508) dan PINDAH UNIT (706) dan AKI HILAG 2 (KABUR), KASBON UJ 1.900.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(201, 'Erwin Simanjuntak', '', '', '', '21/03/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(202, 'Warsono', '3217052212910007', '', '0838 -9840-5185', '04/09/2024', '', '22/12/1991', 'BANDUNG', 'KP.CIBUANG RT.002/RW.006 NYENANG - CIPEUNDEUY - BANDUNG BARAT', '', '00/00/0000', '', '', '', 'Aktif', '20 APRIL 2024 - 3 SEPTEMBER 2024 (304) DAN PINDAH UNIT BARU (801) ', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(203, 'Dandi Saputra', '1405022009980005', '', '', '04/09/2024', '27/04/ 202', '06/12/1990', 'JAKARTA', 'PASAR BARU, RT.02/RW.01 KECAMATAN PKL KERINCI PELALAWAN', '', '00/00/0000', '', '', '', 'Aktif', '16 APRIL (502) DAN PINDAH UNIT BARU (802) dan hitung tabungan', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(204, 'risman', '', '', '', '28/04/2025', '16/05/2025', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', 'uj kabur 1.100.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(205, 'Sarman', '1674052808750001', '', '0813-6756-0463', '04/09/2024', '', '28/08/1975', 'TAMBANG RAMBANG', 'DUSUN 1 KP. RANTAU TEMIANG BANJIT WAY KANAN', '', '00/00/0000', '', '', '', 'Aktif', '19 APRIL 2024 (103) DAN PINDAH UNIT BARU (803)', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(206, 'Aris Aerudin', '3301221505840003', '', '0881-0124-43357', '04/09/2024', '', '15/05/1984', 'CILACAP', 'DS. BOJONGSANA RT.02/RW.03 KEC. SURADADI - TEGAL', '', '00/00/0000', '', '', '', 'Aktif', '09 JULI 2024 (509) DAN PINDAH UNIT BARU (805) ', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(207, 'Rijal Saepulloh', '', '', '', '08/09/2024', '02/05/2025', '07/05/2000', 'LEBAK', 'KP. TALAGA SARI RT.02/RW.02 LEUWIDAMAR KAB. LEBAK', '', '00/00/0000', '', '', '', 'Aktif', '15 APRIL 2024 - 7 SEPT 2024 (506) DAN PINDAH UNIT BARU (806) dan UJ 950.000, KABUR, MENINGGALKAN UJ DI CIOMAS', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(208, 'riski ', '', '', '', '03/05/2025', '', '', '', '', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(209, 'Eki Supriyadi', '3602111601010001', '', '0858-9047-4991', '07/09/2024', '', '16/01/2001', 'LEBAK', 'KP.TALAGASARI RT.02/RW.02 WANTISARI LEUWIDAMAR - LEBAK', '', '00/00/0000', '', '', '', 'Aktif', '11 JUNI 2024 - 6 september 2024 (508) DAN PINDAH UNIT BARU (807) ', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(210, 'Akin', '3602120108890004', '', '0856-0101-8653', '20/03/2025', '03/05/2025', '01/08/1989', 'LEBAK', 'KP. CIKARAE RT 006 RW 002 BINTANG SARI KEC. CIPANAS', '', '00/00/0000', '', '', '', 'Aktif', '14 September 2024 - 25 Januari 2025 (106) dan pindah unit 26 Januari 2025 (303), dan pindah unit 808 serta resign', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(211, 'Heriyono', '3603200207780013', '', '0821-1227-1959', '11/09/2024', '20/05/2025', '02/07/1978', 'TANGERANG', 'KP. JAHA RT.01/RW.03 CIRARAB - TANGERANG', '', '00/00/0000', '', '', '', 'Aktif', '11 juni 2024 - 10 september 2024 (201) dan pindah unit 809 serta KABUR, UJ KABUR, MENINGGALKAN MOBIL DI CIOMAS, 2.100.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(212, 'AHMAD SAEPUDIN (SERAP)', '', '', '', '02/11/2024', '', '10/05/1995', 'SERANG', 'KP. KADU MERNAH SABRANG RT.03/RW.07 MAJASARI - PANDEGLANG', '', '00/00/0000', '', '', '', 'Aktif', '', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(213, 'Mubin', '3602131602960002', '', '0831-3491-1107', '11/09/2024', '', '16/02/1996', 'LEBAK', 'KP. BARU RT.04/RW.03 GUBUGAN CIBERUM MAJA - LEBAK', '', '00/00/0000', '', '', '', 'Aktif', 'SUPIR LAMA DAN BAWA 301 LAGI 15 APRIL 2024 - 3 SEPTEMBER 2024 DAN PINDAH UNIT (810)', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(214, 'Amiludin', '3603230106900005', '', '0896-7842-3366', '12/09/2024', '20/12/2024', '01/06/1990', 'TANGERANG', 'KP. PAGER HAUR RT.02/RW.01 PGEDANGAN - TANGERANG', '', '00/00/0000', '', '', '', 'Aktif', '03 MEI 2024 - 6 SEPT 2024 (507) dan PINDAH UNIT BARU (811) dan RESIGN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(215, 'RISANDI DEPRI', '1605182607840001', '', '', '01/03/2025', '12/05/2025', '26/07/1984', 'MUARA KATI BARU', 'SP. GEGAS TEMUAN TP KEPUNGUT MUSI RAWAS', '', '00/00/0000', '', '', '', 'Aktif', '02/10/2024 - 28 FEBRUARI 25 (101 ) PINDAH UNIT 811 dan RESIGN, KASBON PAK BANCIN 500.000', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(216, 'Djumadi', '3671081010650013', '', '0877-5267-7841', '14/05/2025', '', '10/10/1965', 'TANGERANG', 'KP.SANGIANG RT.03/RW.01 DESA PERIUK KEC. PERIUK', '', '00/00/0000', '', '', '', 'Aktif', '16 April 2024 - 3 JULI 2024 (105) DAN PINDAH UNIT (503) 4 JULI 2024 - 01 MEI 2025, PINDAH UNIT (811)', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(217, 'Ridwan', '3602121311970001', '', '0856-7013-639', '10/01/2025', '', '13/06/1997', 'LEBAK', 'KP. CIBUBUR RT 002 RW 001 MARGALUYU SAJIRA KAB LEBAK', '', '00/00/0000', '', '', '', 'Aktif', '22 APRIL 2024 - 11 JUNI 2024 (305) DAN PINDAH UNIT BARU (501) 13 JUNI 2024 - 9 JANUARI 2025, PINDAH UNIT BARU (901) ', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(218, 'Hasan', '3602112308990001', '', '0857-7732-0080', '06/01/2025', '', '23/08/1999', 'LEBAK', 'KP. CIBATUNG RT 011 RW 004 MARGATIRTA CIMARGA', '', '00/00/0000', '', '', '', 'Aktif', '13 MEI 2024 - 04 JANUARI 2025 (203) DAN PINDAH UNIT BARU (902)', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(219, 'Sapriyadi', '1808032405880002', '', '', '06/01/2025', '', '24/05/1968', 'BONGLAH', 'BONGLAI RT 000 RW 000 BANJIR', '', '00/00/0000', '', '', '', 'Aktif', '16 APRIL 2024 - 04 JANUARI 2025 (303) DAN PINDAH UNIT BARU (903) ', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
(220, 'Cecep', '360323060394001', '', '0823-1165-5977', '06/01/2025', '', '06/03/1994', 'TANGERANG', 'KP. SETU RT 014 RW 005 DANGDANG CISAUK', '', '00/00/0000', '', '', '', 'Aktif', '19 JULI 2024 - 04 JANUARI 2025 (302) DAN PINDAH UNIT BARU (905) ', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18');

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
(13, 1, 'KOPI', 'Aktif', 0, '2025-06-29 22:14:27', '2025-06-29 22:14:27'),
(14, 2, 'GROGOL', 'Aktif', 0, '2025-07-03 03:11:24', '2025-07-03 03:11:24'),
(15, 2, 'MAJA', 'Aktif', 0, '2025-07-03 03:11:31', '2025-07-03 03:11:31'),
(16, 2, 'CILAYANG', 'Aktif', 0, '2025-07-03 03:11:37', '2025-07-03 03:11:37'),
(17, 2, 'T. ABANG', 'Aktif', 0, '2025-07-03 03:11:48', '2025-07-03 03:11:48'),
(19, 2, 'TUTUL', 'Aktif', 0, '2025-07-03 03:12:48', '2025-07-03 03:12:48'),
(20, 2, 'KLP. GADING', 'Aktif', 0, '2025-07-03 03:12:55', '2025-07-03 03:12:55'),
(21, 2, 'KARET', 'Aktif', 0, '2025-07-03 03:13:02', '2025-07-03 03:13:02'),
(22, 2, 'KUNINGAN', 'Aktif', 0, '2025-07-03 03:13:09', '2025-07-03 03:13:09'),
(23, 2, 'MANGGARAI', 'Aktif', 0, '2025-07-03 03:13:15', '2025-07-03 03:13:15');

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
(2, 'Kohod', 'Aktif', 30000, 0, '2025-06-29 22:12:55', '2025-06-30 23:04:54');

-- --------------------------------------------------------

--
-- Table structure for table `ritasi`
--

CREATE TABLE `ritasi` (
  `id` int(11) NOT NULL,
  `tgl_ritasi` varchar(10) NOT NULL,
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
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ritasi`
--

INSERT INTO `ritasi` (`id`, `tgl_ritasi`, `tim_id`, `nama_tim`, `proyek_id`, `nama_proyek`, `galian_id`, `lokasi`, `vehicle_id`, `no_pol`, `jam_angkut`, `nomerdo`, `uang_jalan`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, '11/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 62, 'B 9137 UVX', '02:40', '', '1100000', 0, '2025-07-03 02:41:00', '2025-07-03 02:41:00'),
(2, '11/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 98, 'B 9148 UVX', '02:41', '', '1100000', 0, '2025-07-03 02:41:00', '2025-07-03 02:41:00'),
(3, '11/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 506, 'B 9197 UVV', '02:40', '', '1100000', 0, '2025-07-03 02:51:00', '2025-07-03 02:51:00'),
(4, '11/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 704, 'B 9582 UVV', '02:40', '', '1100000', 0, '2025-07-03 02:51:00', '2025-07-03 02:51:00'),
(5, '11/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 801, '', '02:40', '', '1100000', 0, '2025-07-03 02:51:00', '2025-07-03 02:51:00'),
(6, '11/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 811, '', '02:46', '', '1100000', 0, '2025-07-03 02:51:00', '2025-07-03 02:51:00'),
(7, '11/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 901, '', '02:46', '', '1100000', 0, '2025-07-03 02:51:00', '2025-07-03 02:51:00'),
(8, '12/04/2025', 4, 'M', 2, 'Kohod', 13, 'KOPI', 30, 'B 9462 UIT', '02:53', '', '1100000', 0, '2025-07-03 02:54:00', '2025-07-03 02:54:00'),
(9, '12/04/2025', 4, 'M', 2, 'Kohod', 13, 'KOPI', 20, 'B 9508 UIU', '02:54', '', '1100000', 0, '2025-07-03 02:54:00', '2025-07-03 02:54:00'),
(10, '12/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 33, 'B 9756 UIU', '02:55', '', '1100000', 0, '2025-07-03 02:57:00', '2025-07-03 02:57:00'),
(11, '12/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 57, 'B 9103 UVX', '02:56', '', '1100000', 0, '2025-07-03 02:57:00', '2025-07-03 02:57:00'),
(12, '12/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 86, 'B 9776 UIU', '02:56', '', '1100000', 0, '2025-07-03 02:57:00', '2025-07-03 02:57:00'),
(13, '12/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 93, 'B 9134 UVX', '02:57', '', '1100000', 0, '2025-07-03 02:57:00', '2025-07-03 02:57:00'),
(14, '12/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '02:57', '', '1050000', 0, '2025-07-03 02:58:00', '2025-07-03 02:58:00'),
(15, '12/04/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 30, 'B 9462 UIT', '03:06', '', '1050000', 0, '2025-07-03 03:06:00', '2025-07-03 03:06:00'),
(16, '12/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 501, 'B 9192 UVV', '03:05', '', '1050000', 0, '2025-07-03 03:09:00', '2025-07-03 03:09:00'),
(17, '12/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '03:07', '', '1050000', 0, '2025-07-03 03:09:00', '2025-07-03 03:09:00'),
(18, '12/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 510, 'B 9190 UVV', '03:09', '', '1100000', 0, '2025-07-03 03:14:00', '2025-07-03 03:14:00'),
(19, '12/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 704, 'B 9582 UVV', '03:13', '', '1100000', 0, '2025-07-03 03:14:00', '2025-07-03 03:14:00'),
(20, '12/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 803, '', '03:13', '', '1100000', 0, '2025-07-03 03:14:00', '2025-07-03 03:14:00'),
(21, '12/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 805, '', '03:13', '', '1100000', 0, '2025-07-03 03:14:00', '2025-07-03 03:14:00'),
(22, '12/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 811, '', '03:13', '', '1100000', 0, '2025-07-03 03:14:00', '2025-07-03 03:14:00'),
(23, '12/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 902, '', '03:13', '', '1100000', 0, '2025-07-03 03:14:00', '2025-07-03 03:14:00'),
(24, '12/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 905, '', '03:13', '', '1100000', 0, '2025-07-03 03:14:00', '2025-07-03 03:14:00'),
(25, '12/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '03:14', '', '1050000', 0, '2025-07-03 03:15:00', '2025-07-03 03:15:00'),
(26, '13/04/2025', 4, 'M', 2, 'Kohod', 13, 'KOPI', 15, 'B 9442 UIU', '03:15', '', '1100000', 0, '2025-07-03 03:15:00', '2025-07-03 03:15:00'),
(27, '13/04/2025', 4, 'M', 2, 'Kohod', 14, 'GROGOL', 20, 'B 9508 UIU', '03:16', '', '650000', 0, '2025-07-03 03:16:00', '2025-07-03 03:16:00'),
(28, '13/04/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 603, 'B 9597 UVV', '03:18', '', '980000', 0, '2025-07-03 03:18:00', '2025-07-03 03:18:00'),
(29, '13/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 62, 'B 9137 UVX', '03:18', '', '1100000', 0, '2025-07-03 03:19:00', '2025-07-03 03:19:00'),
(30, '13/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 1077, 'B 9907 KIT', '03:18', '', '1100000', 0, '2025-07-03 03:19:00', '2025-07-03 03:19:00'),
(31, '13/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 98, 'B 9148 UVX', '03:18', '', '1100000', 0, '2025-07-03 03:19:00', '2025-07-03 03:19:00'),
(32, '13/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 33, 'B 9756 UIU', '03:19', '', '900000', 0, '2025-07-03 03:20:00', '2025-07-03 03:20:00'),
(33, '13/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 55, 'B 9118 UVX', '03:19', '', '900000', 0, '2025-07-03 03:20:00', '2025-07-03 03:20:00'),
(34, '13/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 57, 'B 9103 UVX', '03:19', '', '900000', 0, '2025-07-03 03:20:00', '2025-07-03 03:20:00'),
(35, '13/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 98, 'B 9148 UVX', '03:20', '', '900000', 0, '2025-07-03 03:20:00', '2025-07-03 03:20:00'),
(36, '13/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 506, 'B 9197 UVV', '03:21', '', '1100000', 0, '2025-07-03 03:24:00', '2025-07-03 03:24:00'),
(37, '13/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 510, 'B 9190 UVV', '03:21', '', '1100000', 0, '2025-07-03 03:24:00', '2025-07-03 03:24:00'),
(38, '13/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 704, 'B 9582 UVV', '03:22', '', '1100000', 0, '2025-07-03 03:24:00', '2025-07-03 03:24:00'),
(39, '13/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 801, '', '03:22', '', '1100000', 0, '2025-07-03 03:24:00', '2025-07-03 03:24:00'),
(40, '13/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 811, '', '03:23', '', '1100000', 0, '2025-07-03 03:24:00', '2025-07-03 03:24:00'),
(41, '13/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 901, '', '03:23', '', '1100000', 0, '2025-07-03 03:24:00', '2025-07-03 03:24:00'),
(42, '13/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 902, '', '03:23', '', '1100000', 0, '2025-07-03 03:24:00', '2025-07-03 03:24:00'),
(43, '13/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 905, '', '03:23', '', '1100000', 0, '2025-07-03 03:24:00', '2025-07-03 03:24:00'),
(44, '13/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 605, 'B 9594 UVV', '03:24', '', '1050000', 0, '2025-07-03 03:25:00', '2025-07-03 03:25:00'),
(45, '13/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '03:24', '', '1050000', 0, '2025-07-03 03:25:00', '2025-07-03 03:25:00'),
(46, '13/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '03:24', '', '1050000', 0, '2025-07-03 03:25:00', '2025-07-03 03:25:00'),
(47, '13/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '03:25', '', '1050000', 0, '2025-07-03 03:25:00', '2025-07-03 03:25:00'),
(48, '02/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '03:25', '', '1050000', 0, '2025-07-03 03:26:00', '2025-07-03 03:26:00'),
(49, '02/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '03:25', '', '1050000', 0, '2025-07-03 03:26:00', '2025-07-03 03:26:00'),
(50, '02/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 704, 'B 9582 UVV', '03:25', '', '1050000', 0, '2025-07-03 03:26:00', '2025-07-03 03:26:00'),
(51, '02/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '03:25', '', '1050000', 0, '2025-07-03 03:26:00', '2025-07-03 03:26:00'),
(52, '14/04/2025', 4, 'M', 2, 'Kohod', 13, 'KOPI', 15, 'B 9442 UIU', '03:27', '', '1100000', 0, '2025-07-03 03:27:00', '2025-07-03 03:27:00'),
(53, '09/05/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 905, '', '03:29', '', '980000', 0, '2025-07-03 03:29:00', '2025-07-03 03:29:00'),
(54, '14/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 55, 'B 9118 UVX', '03:27', '', '1100000', 0, '2025-07-03 03:30:00', '2025-07-03 03:30:00'),
(55, '14/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 57, 'B 9103 UVX', '03:29', '', '1100000', 0, '2025-07-03 03:30:00', '2025-07-03 03:30:00'),
(56, '14/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 86, 'B 9776 UIU', '03:29', '', '1100000', 0, '2025-07-03 03:30:00', '2025-07-03 03:30:00'),
(57, '14/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 65, 'B 9165 UVX', '03:30', '', '1050000', 0, '2025-07-03 03:30:00', '2025-07-03 03:30:00'),
(58, '09/05/2025', 4, 'M', 2, 'Kohod', 17, 'T. ABANG', 20, 'B 9508 UIU', '03:31', '', '700000', 0, '2025-07-03 03:31:00', '2025-07-03 03:31:00'),
(59, '09/05/2025', 2, 'K', 2, 'Kohod', 17, 'T. ABANG', 1077, 'B 9907 KIT', '03:32', '', '700000', 0, '2025-07-03 03:32:00', '2025-07-03 03:32:00'),
(60, '14/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 510, 'B 9190 UVV', '03:31', '', '1100000', 0, '2025-07-03 03:33:00', '2025-07-03 03:33:00'),
(61, '14/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 905, '', '03:33', '', '1100000', 0, '2025-07-03 03:33:00', '2025-07-03 03:33:00'),
(62, '10/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '03:34', '', '1050000', 0, '2025-07-03 03:34:00', '2025-07-03 03:34:00'),
(63, '14/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 506, 'B 9197 UVV', '03:33', '', '1050000', 0, '2025-07-03 03:34:00', '2025-07-03 03:34:00'),
(64, '14/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 704, 'B 9582 UVV', '03:34', '', '1050000', 0, '2025-07-03 03:34:00', '2025-07-03 03:34:00'),
(65, '14/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '03:34', '', '1050000', 0, '2025-07-03 03:34:00', '2025-07-03 03:34:00'),
(66, '14/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '03:34', '', '1050000', 0, '2025-07-03 03:34:00', '2025-07-03 03:34:00'),
(67, '14/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '03:34', '', '1050000', 0, '2025-07-03 03:34:00', '2025-07-03 03:34:00'),
(68, '14/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '03:34', '', '1050000', 0, '2025-07-03 03:34:00', '2025-07-03 03:34:00'),
(69, '14/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '03:34', '', '1050000', 0, '2025-07-03 03:34:00', '2025-07-03 03:34:00'),
(70, '14/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '03:34', '', '1050000', 0, '2025-07-03 03:34:00', '2025-07-03 03:34:00'),
(71, '14/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '03:34', '', '1050000', 0, '2025-07-03 03:34:00', '2025-07-03 03:34:00'),
(72, '14/04/2025', 4, 'M', 2, 'Kohod', 13, 'KOPI', 15, 'B 9442 UIU', '03:35', '', '1100000', 0, '2025-07-03 03:36:00', '2025-07-03 03:36:00'),
(73, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '03:35', '', '1050000', 0, '2025-07-03 03:36:00', '2025-07-03 03:36:00'),
(74, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '03:35', '', '1050000', 0, '2025-07-03 03:36:00', '2025-07-03 03:36:00'),
(75, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '03:35', '', '1050000', 0, '2025-07-03 03:36:00', '2025-07-03 03:36:00'),
(76, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '03:35', '', '1050000', 0, '2025-07-03 03:36:00', '2025-07-03 03:36:00'),
(77, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '03:35', '', '1050000', 0, '2025-07-03 03:36:00', '2025-07-03 03:36:00'),
(78, '13/04/2025', 4, 'M', 2, 'Kohod', 14, 'GROGOL', 20, 'B 9508 UIU', '03:36', '', '650000', 0, '2025-07-03 03:36:00', '2025-07-03 03:36:00'),
(79, '14/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 58, 'B 9110 UVX', '03:36', '', '1050000', 0, '2025-07-03 03:37:00', '2025-07-03 03:37:00'),
(80, '15/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '03:36', '', '1050000', 0, '2025-07-03 03:37:00', '2025-07-03 03:37:00'),
(81, '30/04/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 501, 'B 9192 UVV', '03:39', '', '980000', 0, '2025-07-03 03:40:00', '2025-07-03 03:40:00'),
(82, '30/04/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 603, 'B 9597 UVV', '03:39', '', '980000', 0, '2025-07-03 03:40:00', '2025-07-03 03:40:00'),
(83, '30/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 33, 'B 9756 UIU', '03:41', '', '900000', 0, '2025-07-03 03:41:00', '2025-07-03 03:41:00'),
(84, '21/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 57, 'B 9103 UVX', '03:41', '', '900000', 0, '2025-07-03 03:41:00', '2025-07-03 03:41:00'),
(85, '21/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 65, 'B 9165 UVX', '03:41', '', '900000', 0, '2025-07-03 03:41:00', '2025-07-03 03:41:00'),
(86, '21/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 86, 'B 9776 UIU', '03:41', '', '900000', 0, '2025-07-03 03:41:00', '2025-07-03 03:41:00'),
(87, '30/04/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 506, 'B 9197 UVV', '03:45', '', '980000', 0, '2025-07-03 03:45:00', '2025-07-03 03:45:00'),
(88, '11/05/2025', 3, 'G', 2, 'Kohod', 19, 'TUTUL', 510, 'B 9190 UVV', '03:46', '', '925000', 0, '2025-07-03 03:46:00', '2025-07-03 03:46:00'),
(89, '21/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 98, 'B 9148 UVX', '03:48', '', '900000', 0, '2025-07-03 03:48:00', '2025-07-03 03:48:00'),
(90, '13/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 33, 'B 9756 UIU', '03:50', '', '1050000', 0, '2025-07-03 03:52:00', '2025-07-03 03:52:00'),
(91, '13/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '03:50', '', '1050000', 0, '2025-07-03 03:52:00', '2025-07-03 03:52:00'),
(92, '13/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 65, 'B 9165 UVX', '03:50', '', '1050000', 0, '2025-07-03 03:52:00', '2025-07-03 03:52:00'),
(93, '13/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '03:52', '', '1050000', 0, '2025-07-03 03:52:00', '2025-07-03 03:52:00'),
(94, '13/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 501, 'B 9192 UVV', '03:54', '', '1050000', 0, '2025-07-03 03:55:00', '2025-07-03 03:55:00'),
(95, '13/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 506, 'B 9197 UVV', '03:54', '', '1050000', 0, '2025-07-03 03:55:00', '2025-07-03 03:55:00'),
(96, '13/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '03:54', '', '1050000', 0, '2025-07-03 03:55:00', '2025-07-03 03:55:00'),
(97, '13/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '03:54', '', '1050000', 0, '2025-07-03 03:55:00', '2025-07-03 03:55:00'),
(98, '13/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 603, 'B 9597 UVV', '03:54', '', '1050000', 0, '2025-07-03 03:55:00', '2025-07-03 03:55:00'),
(99, '13/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '03:54', '', '1050000', 0, '2025-07-03 03:55:00', '2025-07-03 03:55:00'),
(100, '13/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '03:54', '', '1050000', 0, '2025-07-03 03:55:00', '2025-07-03 03:55:00'),
(101, '22/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 98, 'B 9148 UVX', '03:56', '', '900000', 0, '2025-07-03 03:56:00', '2025-07-03 03:56:00'),
(102, '14/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '03:58', '', '1050000', 0, '2025-07-03 04:01:00', '2025-07-03 04:01:00'),
(103, '14/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 58, 'B 9110 UVX', '03:58', '', '1050000', 0, '2025-07-03 04:01:00', '2025-07-03 04:01:00'),
(104, '14/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 1077, 'B 9907 KIT', '03:59', '', '1050000', 0, '2025-07-03 04:01:00', '2025-07-03 04:01:00'),
(105, '14/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '03:59', '', '1050000', 0, '2025-07-03 04:01:00', '2025-07-03 04:01:00'),
(106, '14/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 98, 'B 9148 UVX', '03:59', '', '1050000', 0, '2025-07-03 04:01:00', '2025-07-03 04:01:00'),
(107, '14/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '04:02', '', '1050000', 0, '2025-07-03 04:02:00', '2025-07-03 04:02:00'),
(108, '14/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '04:02', '', '1050000', 0, '2025-07-03 04:02:00', '2025-07-03 04:02:00'),
(109, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 501, 'B 9192 UVV', '04:03', '', '1050000', 0, '2025-07-03 04:05:00', '2025-07-03 04:05:00'),
(110, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 506, 'B 9197 UVV', '04:03', '', '1050000', 0, '2025-07-03 04:05:00', '2025-07-03 04:05:00'),
(111, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '04:03', '', '1050000', 0, '2025-07-03 04:05:00', '2025-07-03 04:05:00'),
(112, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 603, 'B 9597 UVV', '04:03', '', '1050000', 0, '2025-07-03 04:05:00', '2025-07-03 04:05:00'),
(113, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '04:03', '', '1050000', 0, '2025-07-03 04:05:00', '2025-07-03 04:05:00'),
(114, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '04:03', '', '1050000', 0, '2025-07-03 04:05:00', '2025-07-03 04:05:00'),
(115, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '04:03', '', '1050000', 0, '2025-07-03 04:05:00', '2025-07-03 04:05:00'),
(116, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '04:03', '', '1050000', 0, '2025-07-03 04:05:00', '2025-07-03 04:05:00'),
(117, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '04:03', '', '1050000', 0, '2025-07-03 04:05:00', '2025-07-03 04:05:00'),
(118, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '04:03', '', '1050000', 0, '2025-07-03 04:05:00', '2025-07-03 04:05:00'),
(119, '14/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '04:03', '', '1050000', 0, '2025-07-03 04:05:00', '2025-07-03 04:05:00'),
(120, '15/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 33, 'B 9756 UIU', '03:37', '', '1100000', 0, '2025-07-03 04:05:00', '2025-07-03 04:05:00'),
(121, '15/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 86, 'B 9776 UIU', '04:05', '', '1100000', 0, '2025-07-03 04:05:00', '2025-07-03 04:05:00'),
(122, '15/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 93, 'B 9134 UVX', '04:05', '', '1100000', 0, '2025-07-03 04:05:00', '2025-07-03 04:05:00'),
(124, '15/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '04:07', '', '1050000', 0, '2025-07-03 04:07:00', '2025-07-03 04:07:00'),
(125, '15/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 98, 'B 9148 UVX', '04:07', '', '1050000', 0, '2025-07-03 04:07:00', '2025-07-03 04:07:00'),
(126, '09/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 33, 'B 9756 UIU', '04:09', '', '1050000', 0, '2025-07-03 04:12:00', '2025-07-03 04:12:00'),
(127, '09/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '04:10', '', '1050000', 0, '2025-07-03 04:12:00', '2025-07-03 04:12:00'),
(128, '09/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '04:10', '', '1050000', 0, '2025-07-03 04:12:00', '2025-07-03 04:12:00'),
(129, '17/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '04:10', '', '1050000', 0, '2025-07-03 04:12:00', '2025-07-03 04:12:00'),
(130, '17/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 98, 'B 9148 UVX', '04:10', '', '1050000', 0, '2025-07-03 04:12:00', '2025-07-03 04:12:00'),
(131, '10/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 506, 'B 9197 UVV', '04:08', '', '1100000', 0, '2025-07-03 04:13:00', '2025-07-03 04:13:00'),
(132, '10/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 510, 'B 9190 UVV', '04:08', '', '1100000', 0, '2025-07-03 04:13:00', '2025-07-03 04:13:00'),
(133, '15/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 603, 'B 9597 UVV', '04:09', '', '1100000', 0, '2025-07-03 04:13:00', '2025-07-03 04:13:00'),
(134, '15/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 807, '', '04:12', '', '1100000', 0, '2025-07-03 04:13:00', '2025-07-03 04:13:00'),
(135, '15/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '04:14', '', '1050000', 0, '2025-07-03 04:14:00', '2025-07-03 04:14:00'),
(136, '15/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '04:14', '', '1050000', 0, '2025-07-03 04:14:00', '2025-07-03 04:14:00'),
(137, '15/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '04:14', '', '1050000', 0, '2025-07-03 04:14:00', '2025-07-03 04:14:00'),
(138, '17/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 501, 'B 9192 UVV', '04:13', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(139, '17/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 506, 'B 9197 UVV', '04:13', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(140, '17/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '04:13', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(141, '17/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '04:13', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(142, '17/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '04:13', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(143, '17/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '04:13', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(144, '14/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '04:13', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(145, '14/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '04:14', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(146, '25/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '04:14', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(147, '25/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '04:14', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(148, '25/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '04:14', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(149, '25/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '04:14', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(150, '0000-00-00', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '04:17', '', '1050000', 0, '2025-07-03 04:17:00', '2025-07-03 04:17:00'),
(151, '0000-00-00', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '04:17', '', '1050000', 0, '2025-07-03 04:17:00', '2025-07-03 04:17:00'),
(152, '0000-00-00', 4, 'M', 2, 'Kohod', 13, 'KOPI', 15, 'B 9442 UIU', '04:19', '', '1100000', 0, '2025-07-03 04:19:00', '2025-07-03 04:19:00'),
(153, '01/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 30, 'B 9462 UIT', '04:20', '', '1050000', 0, '2025-07-03 04:20:00', '2025-07-03 04:20:00'),
(154, '0000-00-00', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '04:19', '', '1050000', 0, '2025-07-03 04:20:00', '2025-07-03 04:20:00'),
(155, '0000-00-00', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '04:20', '', '1050000', 0, '2025-07-03 04:20:00', '2025-07-03 04:20:00'),
(156, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 65, 'B 9165 UVX', '04:21', '', '1050000', 0, '2025-07-03 04:22:00', '2025-07-03 04:22:00'),
(157, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 86, 'B 9776 UIU', '04:21', '', '1050000', 0, '2025-07-03 04:22:00', '2025-07-03 04:22:00'),
(158, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '04:21', '', '1050000', 0, '2025-07-03 04:22:00', '2025-07-03 04:22:00'),
(159, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 98, 'B 9148 UVX', '04:21', '', '1050000', 0, '2025-07-03 04:22:00', '2025-07-03 04:22:00'),
(160, '0000-00-00', 2, 'K', 2, 'Kohod', 13, 'KOPI', 33, 'B 9756 UIU', '04:23', '', '1100000', 0, '2025-07-03 04:25:00', '2025-07-03 04:25:00'),
(161, '0000-00-00', 2, 'K', 2, 'Kohod', 13, 'KOPI', 58, 'B 9110 UVX', '04:24', '', '1100000', 0, '2025-07-03 04:25:00', '2025-07-03 04:25:00'),
(162, '0000-00-00', 2, 'K', 2, 'Kohod', 13, 'KOPI', 98, 'B 9148 UVX', '04:25', '', '1100000', 0, '2025-07-03 04:25:00', '2025-07-03 04:25:00'),
(163, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 506, 'B 9197 UVV', '04:23', '', '1050000', 0, '2025-07-03 04:25:00', '2025-07-03 04:25:00'),
(164, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '04:23', '', '1050000', 0, '2025-07-03 04:25:00', '2025-07-03 04:25:00'),
(165, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 603, 'B 9597 UVV', '04:23', '', '1050000', 0, '2025-07-03 04:25:00', '2025-07-03 04:25:00'),
(166, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '04:23', '', '1050000', 0, '2025-07-03 04:25:00', '2025-07-03 04:25:00'),
(167, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '04:23', '', '1050000', 0, '2025-07-03 04:25:00', '2025-07-03 04:25:00'),
(168, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '04:23', '', '1050000', 0, '2025-07-03 04:25:00', '2025-07-03 04:25:00'),
(169, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '04:23', '', '1050000', 0, '2025-07-03 04:25:00', '2025-07-03 04:25:00'),
(170, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '04:23', '', '1050000', 0, '2025-07-03 04:25:00', '2025-07-03 04:25:00'),
(171, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '04:23', '', '1050000', 0, '2025-07-03 04:25:00', '2025-07-03 04:25:00'),
(172, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '04:24', '', '1050000', 0, '2025-07-03 04:25:00', '2025-07-03 04:25:00'),
(173, '0000-00-00', 2, 'K', 2, 'Kohod', 20, 'KLP. GADING', 1077, 'B 9907 KIT', '04:26', '', '800000', 0, '2025-07-03 04:26:00', '2025-07-03 04:26:00'),
(174, '21/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 33, 'B 9756 UIU', '04:27', '', '900000', 0, '2025-07-03 04:27:00', '2025-07-03 04:27:00'),
(175, '16/05/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 905, '', '04:28', '', '900000', 0, '2025-07-03 04:28:00', '2025-07-03 04:28:00'),
(176, '0000-00-00', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '04:34', '', '1050000', 0, '2025-07-03 04:34:00', '2025-07-03 04:34:00'),
(177, '0000-00-00', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '04:34', '', '1050000', 0, '2025-07-03 04:34:00', '2025-07-03 04:34:00'),
(178, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '04:26', '', '1050000', 0, '2025-07-03 04:36:00', '2025-07-03 04:36:00'),
(179, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '04:33', '', '1050000', 0, '2025-07-03 04:36:00', '2025-07-03 04:36:00'),
(180, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 107, 'B 9907 KIT', '04:35', '', '1050000', 0, '2025-07-03 04:36:00', '2025-07-03 04:36:00'),
(181, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '04:35', '', '1050000', 0, '2025-07-03 04:36:00', '2025-07-03 04:36:00'),
(182, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '04:35', '', '1050000', 0, '2025-07-03 04:36:00', '2025-07-03 04:36:00'),
(183, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 107, 'B 9907 KIT', '04:35', '', '1050000', 0, '2025-07-03 04:36:00', '2025-07-03 04:36:00'),
(184, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 86, 'B 9776 UIU', '04:35', '', '1050000', 0, '2025-07-03 04:36:00', '2025-07-03 04:36:00'),
(185, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '04:35', '', '1050000', 0, '2025-07-03 04:36:00', '2025-07-03 04:36:00'),
(186, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 98, 'B 9148 UVX', '04:35', '', '1050000', 0, '2025-07-03 04:36:00', '2025-07-03 04:36:00'),
(187, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 501, 'B 9192 UVV', '04:37', '', '1050000', 0, '2025-07-03 04:39:00', '2025-07-03 04:39:00'),
(188, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 506, 'B 9197 UVV', '04:37', '', '1050000', 0, '2025-07-03 04:39:00', '2025-07-03 04:39:00'),
(189, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '04:37', '', '1050000', 0, '2025-07-03 04:39:00', '2025-07-03 04:39:00'),
(190, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '04:37', '', '1050000', 0, '2025-07-03 04:39:00', '2025-07-03 04:39:00'),
(191, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '04:37', '', '1050000', 0, '2025-07-03 04:39:00', '2025-07-03 04:39:00'),
(192, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '04:37', '', '1050000', 0, '2025-07-03 04:39:00', '2025-07-03 04:39:00'),
(193, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '04:37', '', '1050000', 0, '2025-07-03 04:39:00', '2025-07-03 04:39:00'),
(194, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '04:37', '', '1050000', 0, '2025-07-03 04:39:00', '2025-07-03 04:39:00'),
(195, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '04:37', '', '1050000', 0, '2025-07-03 04:39:00', '2025-07-03 04:39:00'),
(196, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '04:38', '', '1050000', 0, '2025-07-03 04:39:00', '2025-07-03 04:39:00'),
(197, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '04:38', '', '1050000', 0, '2025-07-03 04:39:00', '2025-07-03 04:39:00'),
(198, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '04:38', '', '1050000', 0, '2025-07-03 04:39:00', '2025-07-03 04:39:00'),
(199, '17/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '04:38', '', '1050000', 0, '2025-07-03 04:39:00', '2025-07-03 04:39:00'),
(200, '24/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 33, 'B 9756 UIU', '04:41', '', '900000', 0, '2025-07-03 04:42:00', '2025-07-03 04:42:00'),
(201, '0000-00-00', 2, 'K', 2, 'Kohod', 15, 'MAJA', 58, 'B 9110 UVX', '04:41', '', '900000', 0, '2025-07-03 04:42:00', '2025-07-03 04:42:00'),
(202, '0000-00-00', 2, 'K', 2, 'Kohod', 15, 'MAJA', 65, 'B 9165 UVX', '04:41', '', '900000', 0, '2025-07-03 04:42:00', '2025-07-03 04:42:00'),
(203, '0000-00-00', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 30, 'B 9462 UIT', '04:43', '', '1050000', 0, '2025-07-03 04:43:00', '2025-07-03 04:43:00'),
(204, '0000-00-00', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '04:43', '', '1050000', 0, '2025-07-03 04:43:00', '2025-07-03 04:43:00'),
(205, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 506, 'B 9197 UVV', '04:38', '', '1100000', 0, '2025-07-03 04:44:00', '2025-07-03 04:44:00'),
(206, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 510, 'B 9190 UVV', '04:38', '', '1100000', 0, '2025-07-03 04:44:00', '2025-07-03 04:44:00'),
(207, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 603, 'B 9597 UVV', '04:39', '', '1100000', 0, '2025-07-03 04:44:00', '2025-07-03 04:44:00'),
(208, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 702, 'B 9581 UVV', '04:42', '', '1100000', 0, '2025-07-03 04:44:00', '2025-07-03 04:44:00'),
(209, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 704, 'B 9582 UVV', '04:42', '', '1100000', 0, '2025-07-03 04:44:00', '2025-07-03 04:44:00'),
(210, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 801, '', '04:43', '', '1100000', 0, '2025-07-03 04:44:00', '2025-07-03 04:44:00'),
(211, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 807, '', '04:43', '', '1100000', 0, '2025-07-03 04:44:00', '2025-07-03 04:44:00'),
(212, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 901, '', '04:44', '', '1100000', 0, '2025-07-03 04:44:00', '2025-07-03 04:44:00'),
(213, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 902, '', '04:44', '', '1100000', 0, '2025-07-03 04:44:00', '2025-07-03 04:44:00'),
(214, '14/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 905, '', '04:44', '', '1100000', 0, '2025-07-03 04:44:00', '2025-07-03 04:44:00'),
(215, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 605, 'B 9594 UVV', '04:45', '', '1050000', 0, '2025-07-03 04:45:00', '2025-07-03 04:45:00'),
(216, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '04:45', '', '1050000', 0, '2025-07-03 04:45:00', '2025-07-03 04:45:00'),
(217, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '04:45', '', '1050000', 0, '2025-07-03 04:45:00', '2025-07-03 04:45:00'),
(218, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '04:45', '', '1050000', 0, '2025-07-03 04:45:00', '2025-07-03 04:45:00'),
(219, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '04:45', '', '1050000', 0, '2025-07-03 04:45:00', '2025-07-03 04:45:00'),
(220, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 33, 'B 9756 UIU', '04:44', '', '1050000', 0, '2025-07-03 04:45:00', '2025-07-03 04:45:00'),
(221, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 58, 'B 9110 UVX', '04:44', '', '1050000', 0, '2025-07-03 04:45:00', '2025-07-03 04:45:00'),
(222, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '04:44', '', '1050000', 0, '2025-07-03 04:45:00', '2025-07-03 04:45:00'),
(223, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 86, 'B 9776 UIU', '04:44', '', '1050000', 0, '2025-07-03 04:45:00', '2025-07-03 04:45:00'),
(224, '0000-00-00', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 98, 'B 9148 UVX', '04:44', '', '1050000', 0, '2025-07-03 04:45:00', '2025-07-03 04:45:00'),
(225, '0000-00-00', 4, 'M', 2, 'Kohod', 13, 'KOPI', 20, 'B 9508 UIU', '04:47', '', '1100000', 0, '2025-07-03 04:47:00', '2025-07-03 04:47:00'),
(226, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 501, 'B 9192 UVV', '04:46', '', '1050000', 0, '2025-07-03 04:49:00', '2025-07-03 04:49:00'),
(227, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 506, 'B 9197 UVV', '04:46', '', '1050000', 0, '2025-07-03 04:49:00', '2025-07-03 04:49:00'),
(228, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '04:46', '', '1050000', 0, '2025-07-03 04:49:00', '2025-07-03 04:49:00'),
(229, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 603, 'B 9597 UVV', '04:46', '', '1050000', 0, '2025-07-03 04:49:00', '2025-07-03 04:49:00'),
(230, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '04:46', '', '1050000', 0, '2025-07-03 04:49:00', '2025-07-03 04:49:00'),
(231, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '04:46', '', '1050000', 0, '2025-07-03 04:49:00', '2025-07-03 04:49:00'),
(232, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '04:47', '', '1050000', 0, '2025-07-03 04:49:00', '2025-07-03 04:49:00'),
(233, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '04:47', '', '1050000', 0, '2025-07-03 04:49:00', '2025-07-03 04:49:00'),
(234, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '04:47', '', '1050000', 0, '2025-07-03 04:49:00', '2025-07-03 04:49:00'),
(235, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '04:47', '', '1050000', 0, '2025-07-03 04:49:00', '2025-07-03 04:49:00'),
(236, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '04:47', '', '1050000', 0, '2025-07-03 04:49:00', '2025-07-03 04:49:00'),
(237, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '04:47', '', '1050000', 0, '2025-07-03 04:49:00', '2025-07-03 04:49:00'),
(238, '0000-00-00', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '04:47', '', '1050000', 0, '2025-07-03 04:49:00', '2025-07-03 04:49:00'),
(239, '0000-00-00', 2, 'K', 2, 'Kohod', 13, 'KOPI', 65, 'B 9165 UVX', '04:48', '', '1100000', 0, '2025-07-03 04:49:00', '2025-07-03 04:49:00'),
(240, '0000-00-00', 2, 'K', 2, 'Kohod', 13, 'KOPI', 86, 'B 9776 UIU', '04:49', '', '1100000', 0, '2025-07-03 04:49:00', '2025-07-03 04:49:00'),
(241, '0000-00-00', 2, 'K', 2, 'Kohod', 15, 'MAJA', 93, 'B 9134 UVX', '04:50', '', '900000', 0, '2025-07-03 04:50:00', '2025-07-03 04:50:00'),
(242, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 506, 'B 9197 UVV', '04:50', '', '1100000', 0, '2025-07-03 04:51:00', '2025-07-03 04:51:00'),
(243, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 510, 'B 9190 UVV', '04:50', '', '1100000', 0, '2025-07-03 04:51:00', '2025-07-03 04:51:00'),
(244, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 801, '', '04:50', '', '1100000', 0, '2025-07-03 04:51:00', '2025-07-03 04:51:00'),
(245, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 805, '', '04:50', '', '1100000', 0, '2025-07-03 04:51:00', '2025-07-03 04:51:00'),
(246, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 807, '', '04:50', '', '1100000', 0, '2025-07-03 04:51:00', '2025-07-03 04:51:00'),
(247, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 811, '', '04:51', '', '1100000', 0, '2025-07-03 04:51:00', '2025-07-03 04:51:00'),
(248, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 901, '', '04:51', '', '1100000', 0, '2025-07-03 04:51:00', '2025-07-03 04:51:00'),
(249, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 902, '', '04:51', '', '1100000', 0, '2025-07-03 04:51:00', '2025-07-03 04:51:00'),
(250, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 903, '', '04:51', '', '1100000', 0, '2025-07-03 04:51:00', '2025-07-03 04:51:00'),
(251, '0000-00-00', 3, 'G', 2, 'Kohod', 13, 'KOPI', 905, '', '04:51', '', '1100000', 0, '2025-07-03 04:51:00', '2025-07-03 04:51:00'),
(252, '19/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 30, 'B 9462 UIT', '04:51', '', '1050000', 0, '2025-07-03 04:51:00', '2025-07-03 04:51:00'),
(253, '19/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '04:51', '', '1050000', 0, '2025-07-03 04:51:00', '2025-07-03 04:51:00'),
(254, '19/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '04:51', '', '1050000', 0, '2025-07-03 04:51:00', '2025-07-03 04:51:00'),
(255, '18/04/2025', 4, 'M', 2, 'Kohod', 13, 'KOPI', 30, 'B 9462 UIT', '04:52', '', '1100000', 0, '2025-07-03 04:52:00', '2025-07-03 04:52:00'),
(256, '18/04/2025', 4, 'M', 2, 'Kohod', 13, 'KOPI', 15, 'B 9442 UIU', '04:52', '', '1100000', 0, '2025-07-03 04:52:00', '2025-07-03 04:52:00'),
(257, '19/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '04:52', '', '1050000', 0, '2025-07-03 04:54:00', '2025-07-03 04:54:00'),
(258, '19/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '04:52', '', '1050000', 0, '2025-07-03 04:54:00', '2025-07-03 04:54:00'),
(259, '19/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 65, 'B 9165 UVX', '04:52', '', '1050000', 0, '2025-07-03 04:54:00', '2025-07-03 04:54:00'),
(260, '19/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 1077, 'B 9907 KIT', '04:52', '', '1050000', 0, '2025-07-03 04:54:00', '2025-07-03 04:54:00'),
(261, '19/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '04:53', '', '1050000', 0, '2025-07-03 04:54:00', '2025-07-03 04:54:00'),
(262, '19/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 98, 'B 9148 UVX', '04:53', '', '1050000', 0, '2025-07-03 04:54:00', '2025-07-03 04:54:00'),
(263, '18/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 33, 'B 9756 UIU', '04:53', '', '1100000', 0, '2025-07-03 04:55:00', '2025-07-03 04:55:00'),
(264, '18/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 57, 'B 9103 UVX', '04:54', '', '1100000', 0, '2025-07-03 04:55:00', '2025-07-03 04:55:00'),
(265, '18/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 98, 'B 9148 UVX', '04:55', '', '1100000', 0, '2025-07-03 04:55:00', '2025-07-03 04:55:00'),
(266, '18/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 58, 'B 9110 UVX', '04:56', '', '900000', 0, '2025-07-03 04:56:00', '2025-07-03 04:56:00'),
(267, '18/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 86, 'B 9776 UIU', '04:56', '', '900000', 0, '2025-07-03 04:56:00', '2025-07-03 04:56:00'),
(268, '19/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 501, 'B 9192 UVV', '04:55', '', '1050000', 0, '2025-07-03 04:57:00', '2025-07-03 04:57:00'),
(269, '19/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 506, 'B 9197 UVV', '04:55', '', '1050000', 0, '2025-07-03 04:57:00', '2025-07-03 04:57:00'),
(270, '19/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '04:55', '', '1050000', 0, '2025-07-03 04:57:00', '2025-07-03 04:57:00'),
(271, '19/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '04:55', '', '1050000', 0, '2025-07-03 04:57:00', '2025-07-03 04:57:00'),
(272, '19/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 603, 'B 9597 UVV', '04:55', '', '1050000', 0, '2025-07-03 04:57:00', '2025-07-03 04:57:00'),
(273, '19/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '04:55', '', '1050000', 0, '2025-07-03 04:57:00', '2025-07-03 04:57:00'),
(274, '19/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '04:55', '', '1050000', 0, '2025-07-03 04:57:00', '2025-07-03 04:57:00'),
(275, '19/05/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 86, 'B 9776 UIU', '04:57', '', '900000', 0, '2025-07-03 04:58:00', '2025-07-03 04:58:00'),
(276, '18/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 507, 'B 9189 UVV', '04:58', '', '1100000', 0, '2025-07-03 04:59:00', '2025-07-03 04:59:00'),
(277, '18/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 603, 'B 9597 UVV', '04:58', '', '1100000', 0, '2025-07-03 04:59:00', '2025-07-03 04:59:00'),
(278, '18/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 704, 'B 9582 UVV', '04:58', '', '1100000', 0, '2025-07-03 04:59:00', '2025-07-03 04:59:00'),
(279, '18/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 901, '', '04:59', '', '1100000', 0, '2025-07-03 04:59:00', '2025-07-03 04:59:00'),
(280, '18/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 902, '', '04:59', '', '1100000', 0, '2025-07-03 04:59:00', '2025-07-03 04:59:00'),
(281, '19/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '04:59', '', '1050000', 0, '2025-07-03 05:00:00', '2025-07-03 05:00:00'),
(282, '19/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '04:59', '', '1050000', 0, '2025-07-03 05:00:00', '2025-07-03 05:00:00'),
(283, '19/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '04:59', '', '1050000', 0, '2025-07-03 05:00:00', '2025-07-03 05:00:00'),
(284, '19/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '04:59', '', '1050000', 0, '2025-07-03 05:00:00', '2025-07-03 05:00:00'),
(285, '19/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '04:59', '', '1050000', 0, '2025-07-03 05:00:00', '2025-07-03 05:00:00'),
(286, '19/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '04:59', '', '1050000', 0, '2025-07-03 05:00:00', '2025-07-03 05:00:00'),
(287, '19/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '04:59', '', '1050000', 0, '2025-07-03 05:00:00', '2025-07-03 05:00:00'),
(288, '19/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '04:59', '', '1050000', 0, '2025-07-03 05:00:00', '2025-07-03 05:00:00'),
(289, '18/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '05:00', '', '1050000', 0, '2025-07-03 05:00:00', '2025-07-03 05:00:00'),
(290, '18/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 805, '', '05:01', '', '900000', 0, '2025-07-03 05:01:00', '2025-07-03 05:01:00'),
(291, '18/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 905, '', '05:01', '', '900000', 0, '2025-07-03 05:01:00', '2025-07-03 05:01:00'),
(292, '20/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 30, 'B 9462 UIT', '05:01', '', '1050000', 0, '2025-07-03 05:01:00', '2025-07-03 05:01:00'),
(293, '20/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '05:01', '', '1050000', 0, '2025-07-03 05:01:00', '2025-07-03 05:01:00'),
(294, '20/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '05:01', '', '1050000', 0, '2025-07-03 05:01:00', '2025-07-03 05:01:00'),
(295, '19/04/2025', 4, 'M', 2, 'Kohod', 13, 'KOPI', 20, 'B 9508 UIU', '05:02', '', '1100000', 0, '2025-07-03 05:02:00', '2025-07-03 05:02:00'),
(296, '19/04/2025', 4, 'M', 2, 'Kohod', 13, 'KOPI', 15, 'B 9442 UIU', '05:02', '', '1100000', 0, '2025-07-03 05:02:00', '2025-07-03 05:02:00'),
(297, '19/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 55, 'B 9118 UVX', '05:02', '', '1100000', 0, '2025-07-03 05:03:00', '2025-07-03 05:03:00'),
(298, '19/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 1077, 'B 9907 KIT', '05:03', '', '1100000', 0, '2025-07-03 05:03:00', '2025-07-03 05:03:00'),
(299, '19/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 93, 'B 9134 UVX', '05:03', '', '1100000', 0, '2025-07-03 05:03:00', '2025-07-03 05:03:00'),
(300, '20/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '05:02', '', '1050000', 0, '2025-07-03 05:03:00', '2025-07-03 05:03:00'),
(301, '20/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 58, 'B 9110 UVX', '05:02', '', '1050000', 0, '2025-07-03 05:03:00', '2025-07-03 05:03:00'),
(302, '20/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 1077, 'B 9907 KIT', '05:02', '', '1050000', 0, '2025-07-03 05:03:00', '2025-07-03 05:03:00'),
(303, '20/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '05:02', '', '1050000', 0, '2025-07-03 05:03:00', '2025-07-03 05:03:00'),
(304, '20/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 98, 'B 9148 UVX', '05:02', '', '1050000', 0, '2025-07-03 05:03:00', '2025-07-03 05:03:00'),
(305, '19/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 33, 'B 9756 UIU', '05:04', '', '900000', 0, '2025-07-03 05:05:00', '2025-07-03 05:05:00'),
(306, '19/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 58, 'B 9110 UVX', '05:04', '', '900000', 0, '2025-07-03 05:05:00', '2025-07-03 05:05:00'),
(307, '19/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 65, 'B 9165 UVX', '05:04', '', '900000', 0, '2025-07-03 05:05:00', '2025-07-03 05:05:00'),
(308, '19/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 86, 'B 9776 UIU', '05:04', '', '900000', 0, '2025-07-03 05:05:00', '2025-07-03 05:05:00'),
(309, '19/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 98, 'B 9148 UVX', '05:05', '', '900000', 0, '2025-07-03 05:05:00', '2025-07-03 05:05:00'),
(310, '20/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 501, 'B 9192 UVV', '05:04', '', '1050000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(311, '20/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '05:04', '', '1050000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(312, '20/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '05:04', '', '1050000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(313, '20/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 603, 'B 9597 UVV', '05:04', '', '1050000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(314, '20/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '05:04', '', '1050000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(315, '20/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '05:04', '', '1050000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(316, '20/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '05:04', '', '1050000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(317, '20/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '05:04', '', '1050000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(318, '20/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '05:05', '', '1050000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(319, '20/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '05:05', '', '1050000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(320, '20/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '05:05', '', '1050000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(321, '20/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '05:05', '', '1050000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(322, '20/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '05:05', '', '1050000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(323, '20/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '05:05', '', '1050000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(324, '20/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '05:05', '', '1050000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(325, '19/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 506, 'B 9197 UVV', '05:05', '', '1100000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(326, '19/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 510, 'B 9190 UVV', '05:06', '', '1100000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(327, '19/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 603, 'B 9597 UVV', '05:06', '', '1100000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(328, '19/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 701, 'B 9590 UVV', '05:06', '', '1100000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(329, '19/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 702, 'B 9581 UVV', '05:06', '', '1100000', 0, '2025-07-03 05:06:00', '2025-07-03 05:06:00'),
(330, '19/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '05:07', '', '1050000', 0, '2025-07-03 05:07:00', '2025-07-03 05:07:00'),
(331, '20/05/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 33, 'B 9756 UIU', '05:07', '', '900000', 0, '2025-07-03 05:08:00', '2025-07-03 05:08:00'),
(332, '20/05/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 65, 'B 9165 UVX', '05:07', '', '900000', 0, '2025-07-03 05:08:00', '2025-07-03 05:08:00'),
(333, '20/05/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 86, 'B 9776 UIU', '05:07', '', '900000', 0, '2025-07-03 05:08:00', '2025-07-03 05:08:00'),
(334, '19/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 507, 'B 9189 UVV', '05:08', '', '900000', 0, '2025-07-03 05:08:00', '2025-07-03 05:08:00'),
(335, '19/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 704, 'B 9582 UVV', '05:08', '', '900000', 0, '2025-07-03 05:08:00', '2025-07-03 05:08:00'),
(336, '19/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 805, '', '05:08', '', '900000', 0, '2025-07-03 05:08:00', '2025-07-03 05:08:00'),
(337, '20/04/2025', 4, 'M', 2, 'Kohod', 13, 'KOPI', 30, 'B 9462 UIT', '05:09', '', '1100000', 0, '2025-07-03 05:09:00', '2025-07-03 05:09:00'),
(338, '21/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 30, 'B 9462 UIT', '05:09', '', '1050000', 0, '2025-07-03 05:10:00', '2025-07-03 05:10:00'),
(339, '21/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '05:09', '', '1050000', 0, '2025-07-03 05:10:00', '2025-07-03 05:10:00'),
(340, '21/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '05:09', '', '1050000', 0, '2025-07-03 05:10:00', '2025-07-03 05:10:00'),
(341, '21/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 86, 'B 9776 UIU', '05:10', '', '1050000', 0, '2025-07-03 05:11:00', '2025-07-03 05:11:00'),
(342, '21/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '05:10', '', '1050000', 0, '2025-07-03 05:11:00', '2025-07-03 05:11:00'),
(343, '20/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 605, 'B 9594 UVV', '05:11', '', '1050000', 0, '2025-07-03 05:11:00', '2025-07-03 05:11:00'),
(344, '20/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '05:11', '', '1050000', 0, '2025-07-03 05:11:00', '2025-07-03 05:11:00'),
(345, '20/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 807, '', '05:12', '', '1100000', 0, '2025-07-03 05:12:00', '2025-07-03 05:12:00'),
(346, '21/04/2025', 4, 'M', 2, 'Kohod', 15, 'MAJA', 20, 'B 9508 UIU', '05:14', '', '900000', 0, '2025-07-03 05:14:00', '2025-07-03 05:14:00'),
(347, '21/04/2025', 4, 'M', 2, 'Kohod', 15, 'MAJA', 15, 'B 9442 UIU', '05:14', '', '900000', 0, '2025-07-03 05:14:00', '2025-07-03 05:14:00'),
(348, '21/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 501, 'B 9192 UVV', '05:12', '', '1050000', 0, '2025-07-03 05:14:00', '2025-07-03 05:14:00'),
(349, '21/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '05:12', '', '1050000', 0, '2025-07-03 05:14:00', '2025-07-03 05:14:00'),
(350, '21/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 603, 'B 9597 UVV', '05:12', '', '1050000', 0, '2025-07-03 05:14:00', '2025-07-03 05:14:00'),
(351, '21/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '05:12', '', '1050000', 0, '2025-07-03 05:14:00', '2025-07-03 05:14:00'),
(352, '21/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '05:13', '', '1050000', 0, '2025-07-03 05:14:00', '2025-07-03 05:14:00'),
(353, '21/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '05:13', '', '1050000', 0, '2025-07-03 05:14:00', '2025-07-03 05:14:00'),
(354, '21/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '05:13', '', '1050000', 0, '2025-07-03 05:14:00', '2025-07-03 05:14:00'),
(355, '21/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '05:13', '', '1050000', 0, '2025-07-03 05:14:00', '2025-07-03 05:14:00'),
(356, '21/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '05:13', '', '1050000', 0, '2025-07-03 05:14:00', '2025-07-03 05:14:00'),
(357, '21/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '05:13', '', '1050000', 0, '2025-07-03 05:14:00', '2025-07-03 05:14:00');
INSERT INTO `ritasi` (`id`, `tgl_ritasi`, `tim_id`, `nama_tim`, `proyek_id`, `nama_proyek`, `galian_id`, `lokasi`, `vehicle_id`, `no_pol`, `jam_angkut`, `nomerdo`, `uang_jalan`, `is_delete`, `created_at`, `updated_at`) VALUES
(358, '21/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '05:13', '', '1050000', 0, '2025-07-03 05:14:00', '2025-07-03 05:14:00'),
(359, '21/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '05:13', '', '1050000', 0, '2025-07-03 05:14:00', '2025-07-03 05:14:00'),
(360, '21/05/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 98, 'B 9148 UVX', '05:19', '', '900000', 0, '2025-07-03 05:19:00', '2025-07-03 05:19:00'),
(361, '22/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '05:21', '', '1050000', 0, '2025-07-03 05:22:00', '2025-07-03 05:22:00'),
(362, '22/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '05:21', '', '1050000', 0, '2025-07-03 05:22:00', '2025-07-03 05:22:00'),
(363, '22/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 1077, 'B 9907 KIT', '05:21', '', '1050000', 0, '2025-07-03 05:22:00', '2025-07-03 05:22:00'),
(364, '22/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 506, 'B 9197 UVV', '05:23', '', '1050000', 0, '2025-07-03 05:24:00', '2025-07-03 05:24:00'),
(365, '22/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '05:23', '', '1050000', 0, '2025-07-03 05:24:00', '2025-07-03 05:24:00'),
(366, '22/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 603, 'B 9597 UVV', '05:23', '', '1050000', 0, '2025-07-03 05:24:00', '2025-07-03 05:24:00'),
(367, '22/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '05:23', '', '1050000', 0, '2025-07-03 05:24:00', '2025-07-03 05:24:00'),
(368, '22/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '05:23', '', '1050000', 0, '2025-07-03 05:24:00', '2025-07-03 05:24:00'),
(369, '22/05/2025', 3, 'G', 2, 'Kohod', 21, 'KARET', 807, '', '05:26', '', '900000', 0, '2025-07-03 05:26:00', '2025-07-03 05:26:00'),
(370, '22/05/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 33, 'B 9756 UIU', '05:30', '', '900000', 0, '2025-07-03 05:30:00', '2025-07-03 05:30:00'),
(371, '23/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 58, 'B 9110 UVX', '05:38', '', '1050000', 0, '2025-07-03 05:39:00', '2025-07-03 05:39:00'),
(372, '23/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 65, 'B 9165 UVX', '05:38', '', '1050000', 0, '2025-07-03 05:39:00', '2025-07-03 05:39:00'),
(373, '23/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '05:38', '', '1050000', 0, '2025-07-03 05:39:00', '2025-07-03 05:39:00'),
(374, '23/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '05:43', '', '1050000', 0, '2025-07-03 05:46:00', '2025-07-03 05:46:00'),
(375, '23/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '05:43', '', '1050000', 0, '2025-07-03 05:46:00', '2025-07-03 05:46:00'),
(376, '23/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '05:43', '', '1050000', 0, '2025-07-03 05:46:00', '2025-07-03 05:46:00'),
(377, '23/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '05:43', '', '1050000', 0, '2025-07-03 05:46:00', '2025-07-03 05:46:00'),
(378, '23/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '05:43', '', '1050000', 0, '2025-07-03 05:46:00', '2025-07-03 05:46:00'),
(379, '23/05/2025', 4, 'M', 2, 'Kohod', 21, 'KARET', 30, 'B 9462 UIT', '05:47', '', '900000', 0, '2025-07-03 05:48:00', '2025-07-03 05:48:00'),
(380, '23/05/2025', 4, 'M', 2, 'Kohod', 21, 'KARET', 20, 'B 9508 UIU', '05:47', '', '900000', 0, '2025-07-03 05:48:00', '2025-07-03 05:48:00'),
(381, '23/05/2025', 2, 'K', 2, 'Kohod', 21, 'KARET', 98, 'B 9148 UVX', '05:48', '', '900000', 0, '2025-07-03 05:49:00', '2025-07-03 05:49:00'),
(382, '21/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 33, 'B 9756 UIU', '05:15', '', '900000', 0, '2025-07-03 05:51:00', '2025-07-03 05:51:00'),
(383, '21/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 55, 'B 9118 UVX', '05:15', '', '900000', 0, '2025-07-03 05:51:00', '2025-07-03 05:51:00'),
(384, '21/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 57, 'B 9103 UVX', '05:15', '', '900000', 0, '2025-07-03 05:51:00', '2025-07-03 05:51:00'),
(385, '21/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 65, 'B 9165 UVX', '05:50', '', '900000', 0, '2025-07-03 05:51:00', '2025-07-03 05:51:00'),
(386, '21/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 86, 'B 9776 UIU', '05:50', '', '900000', 0, '2025-07-03 05:51:00', '2025-07-03 05:51:00'),
(387, '21/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 93, 'B 9134 UVX', '05:51', '', '900000', 0, '2025-07-03 05:51:00', '2025-07-03 05:51:00'),
(388, '21/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 98, 'B 9148 UVX', '05:51', '', '900000', 0, '2025-07-03 05:51:00', '2025-07-03 05:51:00'),
(389, '24/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '05:51', '', '1050000', 0, '2025-07-03 05:51:00', '2025-07-03 05:51:00'),
(390, '24/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 506, 'B 9197 UVV', '05:53', '', '1050000', 0, '2025-07-03 05:54:00', '2025-07-03 05:54:00'),
(391, '24/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '05:53', '', '1050000', 0, '2025-07-03 05:54:00', '2025-07-03 05:54:00'),
(392, '24/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '05:53', '', '1050000', 0, '2025-07-03 05:54:00', '2025-07-03 05:54:00'),
(393, '24/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '05:53', '', '1050000', 0, '2025-07-03 05:54:00', '2025-07-03 05:54:00'),
(394, '24/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '05:53', '', '1050000', 0, '2025-07-03 05:54:00', '2025-07-03 05:54:00'),
(395, '24/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '05:53', '', '1050000', 0, '2025-07-03 05:54:00', '2025-07-03 05:54:00'),
(396, '24/05/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 57, 'B 9103 UVX', '05:55', '', '900000', 0, '2025-07-03 05:55:00', '2025-07-03 05:55:00'),
(397, '21/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 506, 'B 9197 UVV', '05:52', '', '900000', 0, '2025-07-03 05:55:00', '2025-07-03 05:55:00'),
(398, '21/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 603, 'B 9597 UVV', '05:53', '', '900000', 0, '2025-07-03 05:55:00', '2025-07-03 05:55:00'),
(399, '21/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 811, '', '05:55', '', '900000', 0, '2025-07-03 05:55:00', '2025-07-03 05:55:00'),
(400, '21/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 903, '', '05:55', '', '900000', 0, '2025-07-03 05:55:00', '2025-07-03 05:55:00'),
(401, '24/07/2025', 2, 'K', 2, 'Kohod', 21, 'KARET', 62, 'B 9137 UVX', '05:57', '', '900000', 0, '2025-07-03 05:57:00', '2025-07-03 05:57:00'),
(402, '25/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '05:59', '', '1050000', 0, '2025-07-03 06:00:00', '2025-07-03 06:00:00'),
(403, '25/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '05:59', '', '1050000', 0, '2025-07-03 06:00:00', '2025-07-03 06:00:00'),
(404, '25/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '06:01', '', '1050000', 0, '2025-07-03 06:01:00', '2025-07-03 06:01:00'),
(405, '21/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 507, 'B 9189 UVV', '06:00', '', '1100000', 0, '2025-07-03 06:02:00', '2025-07-03 06:02:00'),
(406, '21/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 510, 'B 9190 UVV', '06:01', '', '1100000', 0, '2025-07-03 06:02:00', '2025-07-03 06:02:00'),
(407, '21/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 704, 'B 9582 UVV', '06:01', '', '1100000', 0, '2025-07-03 06:02:00', '2025-07-03 06:02:00'),
(408, '21/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 805, '', '06:01', '', '1100000', 0, '2025-07-03 06:02:00', '2025-07-03 06:02:00'),
(409, '21/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 807, '', '06:01', '', '1100000', 0, '2025-07-03 06:02:00', '2025-07-03 06:02:00'),
(410, '21/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 901, '', '06:01', '', '1100000', 0, '2025-07-03 06:02:00', '2025-07-03 06:02:00'),
(411, '21/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 905, '', '06:01', '', '1100000', 0, '2025-07-03 06:02:00', '2025-07-03 06:02:00'),
(412, '21/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 605, 'B 9594 UVV', '06:02', '', '1050000', 0, '2025-07-03 06:03:00', '2025-07-03 06:03:00'),
(413, '21/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '06:02', '', '1050000', 0, '2025-07-03 06:03:00', '2025-07-03 06:03:00'),
(414, '21/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '06:03', '', '1050000', 0, '2025-07-03 06:03:00', '2025-07-03 06:03:00'),
(415, '25/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '06:02', '', '1050000', 0, '2025-07-03 06:04:00', '2025-07-03 06:04:00'),
(416, '25/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 603, 'B 9597 UVV', '06:02', '', '1050000', 0, '2025-07-03 06:04:00', '2025-07-03 06:04:00'),
(417, '25/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '06:02', '', '1050000', 0, '2025-07-03 06:04:00', '2025-07-03 06:04:00'),
(418, '25/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '06:02', '', '1050000', 0, '2025-07-03 06:04:00', '2025-07-03 06:04:00'),
(419, '25/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '06:02', '', '1050000', 0, '2025-07-03 06:04:00', '2025-07-03 06:04:00'),
(420, '25/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '06:02', '', '1050000', 0, '2025-07-03 06:04:00', '2025-07-03 06:04:00'),
(421, '25/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '06:02', '', '1050000', 0, '2025-07-03 06:04:00', '2025-07-03 06:04:00'),
(422, '25/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '06:02', '', '1050000', 0, '2025-07-03 06:04:00', '2025-07-03 06:04:00'),
(423, '25/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '06:02', '', '1050000', 0, '2025-07-03 06:04:00', '2025-07-03 06:04:00'),
(424, '25/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '06:02', '', '1050000', 0, '2025-07-03 06:04:00', '2025-07-03 06:04:00'),
(425, '25/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '06:03', '', '1050000', 0, '2025-07-03 06:04:00', '2025-07-03 06:04:00'),
(426, '22/04/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '06:04', '', '1050000', 0, '2025-07-03 06:04:00', '2025-07-03 06:04:00'),
(427, '22/04/2025', 4, 'M', 2, 'Kohod', 13, 'KOPI', 30, 'B 9462 UIT', '06:04', '', '1100000', 0, '2025-07-03 06:04:00', '2025-07-03 06:04:00'),
(428, '22/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 57, 'B 9103 UVX', '06:05', '', '900000', 0, '2025-07-03 06:07:00', '2025-07-03 06:07:00'),
(429, '22/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 1077, 'B 9907 KIT', '06:07', '', '900000', 0, '2025-07-03 06:07:00', '2025-07-03 06:07:00'),
(430, '22/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 98, 'B 9148 UVX', '06:07', '', '900000', 0, '2025-07-03 06:07:00', '2025-07-03 06:07:00'),
(431, '22/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '06:08', '', '1050000', 0, '2025-07-03 06:08:00', '2025-07-03 06:08:00'),
(432, '22/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 65, 'B 9165 UVX', '06:08', '', '1050000', 0, '2025-07-03 06:08:00', '2025-07-03 06:08:00'),
(433, '22/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '06:08', '', '1050000', 0, '2025-07-03 06:08:00', '2025-07-03 06:08:00'),
(434, '25/05/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 905, '', '06:14', '', '900000', 0, '2025-07-03 06:14:00', '2025-07-03 06:14:00'),
(435, '25/05/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 58, 'B 9110 UVX', '06:15', '', '900000', 0, '2025-07-03 06:15:00', '2025-07-03 06:15:00'),
(436, '22/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 506, 'B 9197 UVV', '06:10', '', '1100000', 0, '2025-07-03 06:15:00', '2025-07-03 06:15:00'),
(437, '22/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 510, 'B 9190 UVV', '06:14', '', '1100000', 0, '2025-07-03 06:15:00', '2025-07-03 06:15:00'),
(438, '22/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 603, 'B 9597 UVV', '06:14', '', '1100000', 0, '2025-07-03 06:15:00', '2025-07-03 06:15:00'),
(439, '22/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 704, 'B 9582 UVV', '06:14', '', '1100000', 0, '2025-07-03 06:15:00', '2025-07-03 06:15:00'),
(440, '22/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 807, '', '06:15', '', '1100000', 0, '2025-07-03 06:15:00', '2025-07-03 06:15:00'),
(441, '22/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '06:17', '', '1050000', 0, '2025-07-03 06:17:00', '2025-07-03 06:17:00'),
(442, '22/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '06:17', '', '1050000', 0, '2025-07-03 06:17:00', '2025-07-03 06:17:00'),
(443, '22/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '06:17', '', '1050000', 0, '2025-07-03 06:17:00', '2025-07-03 06:17:00'),
(444, '22/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '06:17', '', '1050000', 0, '2025-07-03 06:17:00', '2025-07-03 06:17:00'),
(445, '22/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '06:17', '', '1050000', 0, '2025-07-03 06:17:00', '2025-07-03 06:17:00'),
(446, '26/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '06:18', '', '1050000', 0, '2025-07-03 06:18:00', '2025-07-03 06:18:00'),
(447, '23/04/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '06:18', '', '1050000', 0, '2025-07-03 06:18:00', '2025-07-03 06:18:00'),
(448, '26/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '06:19', '', '1050000', 0, '2025-07-03 06:20:00', '2025-07-03 06:20:00'),
(449, '26/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '06:19', '', '1050000', 0, '2025-07-03 06:20:00', '2025-07-03 06:20:00'),
(450, '26/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 65, 'B 9165 UVX', '06:19', '', '1050000', 0, '2025-07-03 06:20:00', '2025-07-03 06:20:00'),
(451, '23/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 33, 'B 9756 UIU', '06:19', '', '900000', 0, '2025-07-03 06:20:00', '2025-07-03 06:20:00'),
(452, '23/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 1077, 'B 9907 KIT', '06:20', '', '900000', 0, '2025-07-03 06:20:00', '2025-07-03 06:20:00'),
(453, '23/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 86, 'B 9776 UIU', '06:20', '', '900000', 0, '2025-07-03 06:20:00', '2025-07-03 06:20:00'),
(454, '23/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '06:21', '', '1050000', 0, '2025-07-03 06:21:00', '2025-07-03 06:21:00'),
(455, '23/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 58, 'B 9110 UVX', '06:21', '', '1050000', 0, '2025-07-03 06:21:00', '2025-07-03 06:21:00'),
(456, '23/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '06:21', '', '1050000', 0, '2025-07-03 06:21:00', '2025-07-03 06:21:00'),
(457, '26/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 506, 'B 9197 UVV', '06:54', '', '1050000', 0, '2025-07-03 06:56:00', '2025-07-03 06:56:00'),
(458, '26/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '06:54', '', '1050000', 0, '2025-07-03 06:56:00', '2025-07-03 06:56:00'),
(459, '26/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '06:54', '', '1050000', 0, '2025-07-03 06:56:00', '2025-07-03 06:56:00'),
(460, '26/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '06:54', '', '1050000', 0, '2025-07-03 06:56:00', '2025-07-03 06:56:00'),
(461, '26/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '06:54', '', '1050000', 0, '2025-07-03 06:56:00', '2025-07-03 06:56:00'),
(462, '26/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '06:54', '', '1050000', 0, '2025-07-03 06:56:00', '2025-07-03 06:56:00'),
(463, '26/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '06:54', '', '1050000', 0, '2025-07-03 06:56:00', '2025-07-03 06:56:00'),
(464, '26/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '06:54', '', '1050000', 0, '2025-07-03 06:56:00', '2025-07-03 06:56:00'),
(465, '26/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '06:54', '', '1050000', 0, '2025-07-03 06:56:00', '2025-07-03 06:56:00'),
(466, '26/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '06:54', '', '1050000', 0, '2025-07-03 06:56:00', '2025-07-03 06:56:00'),
(467, '26/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '06:54', '', '1050000', 0, '2025-07-03 06:56:00', '2025-07-03 06:56:00'),
(468, '26/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '06:54', '', '1050000', 0, '2025-07-03 06:56:00', '2025-07-03 06:56:00'),
(469, '23/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 501, 'B 9192 UVV', '06:57', '', '900000', 0, '2025-07-03 07:00:00', '2025-07-03 07:00:00'),
(470, '23/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 506, 'B 9197 UVV', '06:58', '', '900000', 0, '2025-07-03 07:00:00', '2025-07-03 07:00:00'),
(471, '23/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 605, 'B 9594 UVV', '06:59', '', '900000', 0, '2025-07-03 07:00:00', '2025-07-03 07:00:00'),
(472, '23/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 807, '', '06:59', '', '900000', 0, '2025-07-03 07:00:00', '2025-07-03 07:00:00'),
(473, '23/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 905, '', '07:00', '', '900000', 0, '2025-07-03 07:00:00', '2025-07-03 07:00:00'),
(474, '27/05/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '07:00', '', '1050000', 0, '2025-07-03 07:00:00', '2025-07-03 07:00:00'),
(475, '27/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '07:01', '', '1050000', 0, '2025-07-03 07:03:00', '2025-07-03 07:03:00'),
(476, '27/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '07:01', '', '1050000', 0, '2025-07-03 07:03:00', '2025-07-03 07:03:00'),
(477, '27/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 58, 'B 9110 UVX', '07:02', '', '1050000', 0, '2025-07-03 07:03:00', '2025-07-03 07:03:00'),
(478, '27/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '07:02', '', '1050000', 0, '2025-07-03 07:03:00', '2025-07-03 07:03:00'),
(479, '27/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '07:02', '', '1050000', 0, '2025-07-03 07:03:00', '2025-07-03 07:03:00'),
(480, '24/04/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '07:03', '', '1050000', 0, '2025-07-03 07:03:00', '2025-07-03 07:03:00'),
(481, '24/04/2025', 4, 'M', 2, 'Kohod', 17, 'T. ABANG', 30, 'B 9462 UIT', '07:04', '', '700000', 0, '2025-07-03 07:04:00', '2025-07-03 07:04:00'),
(482, '27/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 506, 'B 9197 UVV', '07:04', '', '1050000', 0, '2025-07-03 07:06:00', '2025-07-03 07:06:00'),
(483, '27/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '07:04', '', '1050000', 0, '2025-07-03 07:06:00', '2025-07-03 07:06:00'),
(484, '27/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '07:04', '', '1050000', 0, '2025-07-03 07:06:00', '2025-07-03 07:06:00'),
(485, '27/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '07:04', '', '1050000', 0, '2025-07-03 07:06:00', '2025-07-03 07:06:00'),
(486, '27/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '07:04', '', '1050000', 0, '2025-07-03 07:06:00', '2025-07-03 07:06:00'),
(487, '27/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '07:05', '', '1050000', 0, '2025-07-03 07:06:00', '2025-07-03 07:06:00'),
(488, '27/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '07:05', '', '1050000', 0, '2025-07-03 07:06:00', '2025-07-03 07:06:00'),
(489, '27/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '07:05', '', '1050000', 0, '2025-07-03 07:06:00', '2025-07-03 07:06:00'),
(490, '27/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '07:05', '', '1050000', 0, '2025-07-03 07:06:00', '2025-07-03 07:06:00'),
(491, '27/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '07:05', '', '1050000', 0, '2025-07-03 07:06:00', '2025-07-03 07:06:00'),
(492, '27/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '07:05', '', '1050000', 0, '2025-07-03 07:06:00', '2025-07-03 07:06:00'),
(493, '27/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '07:05', '', '1050000', 0, '2025-07-03 07:06:00', '2025-07-03 07:06:00'),
(494, '24/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 33, 'B 9756 UIU', '07:06', '', '900000', 0, '2025-07-03 07:08:00', '2025-07-03 07:08:00'),
(495, '24/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 57, 'B 9103 UVX', '07:06', '', '900000', 0, '2025-07-03 07:08:00', '2025-07-03 07:08:00'),
(496, '24/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 98, 'B 9148 UVX', '07:08', '', '900000', 0, '2025-07-03 07:08:00', '2025-07-03 07:08:00'),
(497, '27/05/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 603, 'B 9597 UVV', '07:08', '', '980000', 0, '2025-07-03 07:08:00', '2025-07-03 07:08:00'),
(498, '24/04/2025', 2, 'K', 2, 'Kohod', 17, 'T. ABANG', 62, 'B 9137 UVX', '07:08', '', '700000', 0, '2025-07-03 07:09:00', '2025-07-03 07:09:00'),
(499, '27/05/2025', 4, 'M', 2, 'Kohod', 21, 'KARET', 20, 'B 9508 UIU', '07:09', '', '900000', 0, '2025-07-03 07:09:00', '2025-07-03 07:09:00'),
(500, '27/07/2025', 2, 'K', 2, 'Kohod', 21, 'KARET', 86, 'B 9776 UIU', '07:10', '', '900000', 0, '2025-07-03 07:10:00', '2025-07-03 07:10:00'),
(501, '24/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 65, 'B 9165 UVX', '07:10', '', '1050000', 0, '2025-07-03 07:11:00', '2025-07-03 07:11:00'),
(502, '24/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '07:11', '', '1050000', 0, '2025-07-03 07:11:00', '2025-07-03 07:11:00'),
(503, '28/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 33, 'B 9756 UIU', '07:13', '', '1050000', 0, '2025-07-03 07:15:00', '2025-07-03 07:15:00'),
(504, '28/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '07:13', '', '1050000', 0, '2025-07-03 07:15:00', '2025-07-03 07:15:00'),
(505, '28/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 58, 'B 9110 UVX', '07:13', '', '1050000', 0, '2025-07-03 07:15:00', '2025-07-03 07:15:00'),
(506, '24/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 905, '', '07:16', '', '900000', 0, '2025-07-03 07:16:00', '2025-07-03 07:16:00'),
(507, '24/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 603, 'B 9597 UVV', '07:17', '', '1050000', 0, '2025-07-03 07:21:00', '2025-07-03 07:21:00'),
(508, '24/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '07:17', '', '1050000', 0, '2025-07-03 07:21:00', '2025-07-03 07:21:00'),
(509, '24/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '07:18', '', '1050000', 0, '2025-07-03 07:21:00', '2025-07-03 07:21:00'),
(510, '24/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 704, 'B 9582 UVV', '07:21', '', '1050000', 0, '2025-07-03 07:21:00', '2025-07-03 07:21:00'),
(511, '24/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '07:21', '', '1050000', 0, '2025-07-03 07:21:00', '2025-07-03 07:21:00'),
(512, '28/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 506, 'B 9197 UVV', '07:20', '', '1050000', 0, '2025-07-03 07:22:00', '2025-07-03 07:22:00'),
(513, '28/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '07:20', '', '1050000', 0, '2025-07-03 07:22:00', '2025-07-03 07:22:00'),
(514, '28/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '07:20', '', '1050000', 0, '2025-07-03 07:22:00', '2025-07-03 07:22:00'),
(515, '28/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '07:20', '', '1050000', 0, '2025-07-03 07:22:00', '2025-07-03 07:22:00'),
(516, '28/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '07:20', '', '1050000', 0, '2025-07-03 07:22:00', '2025-07-03 07:22:00'),
(517, '28/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '07:20', '', '1050000', 0, '2025-07-03 07:22:00', '2025-07-03 07:22:00'),
(518, '28/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '07:20', '', '1050000', 0, '2025-07-03 07:22:00', '2025-07-03 07:22:00'),
(519, '28/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '07:20', '', '1050000', 0, '2025-07-03 07:22:00', '2025-07-03 07:22:00'),
(520, '28/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '07:20', '', '1050000', 0, '2025-07-03 07:22:00', '2025-07-03 07:22:00'),
(521, '28/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '07:20', '', '1050000', 0, '2025-07-03 07:22:00', '2025-07-03 07:22:00'),
(522, '28/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '07:20', '', '1050000', 0, '2025-07-03 07:22:00', '2025-07-03 07:22:00'),
(523, '28/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '07:20', '', '1050000', 0, '2025-07-03 07:22:00', '2025-07-03 07:22:00'),
(524, '28/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '07:20', '', '1050000', 0, '2025-07-03 07:22:00', '2025-07-03 07:22:00'),
(525, '28/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '07:20', '', '1050000', 0, '2025-07-03 07:22:00', '2025-07-03 07:22:00'),
(526, '28/05/2025', 2, 'K', 2, 'Kohod', 21, 'KARET', 62, 'B 9137 UVX', '07:23', '', '900000', 0, '2025-07-03 07:24:00', '2025-07-03 07:24:00'),
(527, '28/05/2025', 2, 'K', 2, 'Kohod', 21, 'KARET', 98, 'B 9148 UVX', '07:24', '', '900000', 0, '2025-07-03 07:24:00', '2025-07-03 07:24:00'),
(528, '29/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '07:26', '', '1050000', 0, '2025-07-03 07:27:00', '2025-07-03 07:27:00'),
(529, '29/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 58, 'B 9110 UVX', '07:27', '', '1050000', 0, '2025-07-03 07:27:00', '2025-07-03 07:27:00'),
(530, '29/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 506, 'B 9197 UVV', '07:28', '', '1050000', 0, '2025-07-03 07:32:00', '2025-07-03 07:32:00'),
(531, '29/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '07:28', '', '1050000', 0, '2025-07-03 07:32:00', '2025-07-03 07:32:00'),
(532, '29/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '07:28', '', '1050000', 0, '2025-07-03 07:32:00', '2025-07-03 07:32:00'),
(533, '29/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 603, 'B 9597 UVV', '07:28', '', '1050000', 0, '2025-07-03 07:32:00', '2025-07-03 07:32:00'),
(534, '29/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '07:28', '', '1050000', 0, '2025-07-03 07:32:00', '2025-07-03 07:32:00'),
(535, '29/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '07:28', '', '1050000', 0, '2025-07-03 07:32:00', '2025-07-03 07:32:00'),
(536, '29/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '07:28', '', '1050000', 0, '2025-07-03 07:32:00', '2025-07-03 07:32:00'),
(537, '29/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '07:28', '', '1050000', 0, '2025-07-03 07:32:00', '2025-07-03 07:32:00'),
(538, '29/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '07:29', '', '1050000', 0, '2025-07-03 07:32:00', '2025-07-03 07:32:00'),
(539, '29/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '07:29', '', '1050000', 0, '2025-07-03 07:32:00', '2025-07-03 07:32:00'),
(540, '29/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '07:29', '', '1050000', 0, '2025-07-03 07:32:00', '2025-07-03 07:32:00'),
(541, '29/05/2025', 4, 'M', 2, 'Kohod', 21, 'KARET', 15, 'B 9442 UIU', '07:34', '', '900000', 0, '2025-07-03 07:34:00', '2025-07-03 07:34:00'),
(542, '30/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '07:39', '', '1050000', 0, '2025-07-03 07:39:00', '2025-07-03 07:39:00'),
(543, '30/05/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 1077, 'B 9907 KIT', '07:41', '', '900000', 0, '2025-07-03 07:41:00', '2025-07-03 07:41:00'),
(544, '30/05/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 905, '', '07:43', '', '900000', 0, '2025-07-03 07:43:00', '2025-07-03 07:43:00'),
(545, '30/05/2025', 2, 'K', 2, 'Kohod', 21, 'KARET', 65, 'B 9165 UVX', '07:45', '', '900000', 0, '2025-07-03 07:45:00', '2025-07-03 07:45:00'),
(546, '31/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '07:52', '', '1050000', 0, '2025-07-03 07:55:00', '2025-07-03 07:55:00'),
(547, '31/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '07:52', '', '1050000', 0, '2025-07-03 07:55:00', '2025-07-03 07:55:00'),
(548, '31/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 58, 'B 9110 UVX', '07:52', '', '1050000', 0, '2025-07-03 07:55:00', '2025-07-03 07:55:00'),
(549, '31/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '07:52', '', '1050000', 0, '2025-07-03 07:55:00', '2025-07-03 07:55:00'),
(550, '31/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 65, 'B 9165 UVX', '07:52', '', '1050000', 0, '2025-07-03 07:55:00', '2025-07-03 07:55:00'),
(551, '31/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 1077, 'B 9907 KIT', '07:53', '', '1050000', 0, '2025-07-03 07:55:00', '2025-07-03 07:55:00'),
(552, '31/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 86, 'B 9776 UIU', '07:53', '', '1050000', 0, '2025-07-03 07:55:00', '2025-07-03 07:55:00'),
(553, '31/05/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 98, 'B 9148 UVX', '07:53', '', '1050000', 0, '2025-07-03 07:55:00', '2025-07-03 07:55:00'),
(554, '31/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 506, 'B 9197 UVV', '07:57', '', '1050000', 0, '2025-07-03 07:59:00', '2025-07-03 07:59:00'),
(555, '31/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '07:57', '', '1050000', 0, '2025-07-03 07:59:00', '2025-07-03 07:59:00'),
(556, '31/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '07:57', '', '1050000', 0, '2025-07-03 07:59:00', '2025-07-03 07:59:00'),
(557, '31/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '07:57', '', '1050000', 0, '2025-07-03 07:59:00', '2025-07-03 07:59:00'),
(558, '31/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '07:57', '', '1050000', 0, '2025-07-03 07:59:00', '2025-07-03 07:59:00'),
(559, '31/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '07:57', '', '1050000', 0, '2025-07-03 07:59:00', '2025-07-03 07:59:00'),
(560, '31/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '07:58', '', '1050000', 0, '2025-07-03 07:59:00', '2025-07-03 07:59:00'),
(561, '31/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '07:58', '', '1050000', 0, '2025-07-03 07:59:00', '2025-07-03 07:59:00'),
(562, '31/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '07:58', '', '1050000', 0, '2025-07-03 07:59:00', '2025-07-03 07:59:00'),
(563, '31/05/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '07:58', '', '1050000', 0, '2025-07-03 07:59:00', '2025-07-03 07:59:00'),
(564, '31/05/2025', 4, 'M', 2, 'Kohod', 21, 'KARET', 20, 'B 9508 UIU', '08:00', '', '900000', 0, '2025-07-03 08:00:00', '2025-07-03 08:00:00'),
(565, '31/05/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 33, 'B 9756 UIU', '08:01', '', '900000', 0, '2025-07-03 08:02:00', '2025-07-03 08:02:00'),
(566, '31/05/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 93, 'B 9134 UVX', '08:02', '', '900000', 0, '2025-07-03 08:02:00', '2025-07-03 08:02:00'),
(567, '31/05/2025', 4, 'M', 2, 'Kohod', 23, 'MANGGARAI', 15, 'B 9442 UIU', '08:04', '', '750000', 0, '2025-07-03 08:04:00', '2025-07-03 08:04:00'),
(568, '03/03/2025', 2, 'K', 2, 'Kohod', 9, 'C. BITUNG', 62, 'B 9137 UVX', '23:33', '', '980000', 0, '2025-07-02 23:33:00', '2025-07-02 23:33:00'),
(569, '10/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 501, 'B 9192 UVV', '23:50', '', '1050000', 0, '2025-07-02 23:50:00', '2025-07-02 23:50:00'),
(570, '10/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '23:50', '', '1050000', 0, '2025-07-02 23:50:00', '2025-07-02 23:50:00'),
(571, '12/03/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '23:52', '', '1050000', 0, '2025-07-02 23:52:00', '2025-07-02 23:52:00'),
(572, '13/03/2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 93, 'B 9134 UVX', '23:57', '', '890000', 0, '2025-07-02 23:57:00', '2025-07-02 23:57:00'),
(573, '13/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 510, 'B 9190 UVV', '23:58', '', '900000', 0, '2025-07-02 23:58:00', '2025-07-02 23:58:00'),
(574, '13/03/2025', 3, 'G', 2, 'Kohod', 3, 'MULTIKON', 805, '', '23:58', '', '890000', 0, '2025-07-02 23:58:00', '2025-07-02 23:58:00'),
(575, '14/03/2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 55, 'B 9118 UVX', '00:03', '', '890000', 0, '2025-07-03 00:04:00', '2025-07-03 00:04:00'),
(576, '14/03/2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 62, 'B 9137 UVX', '00:03', '', '890000', 0, '2025-07-03 00:04:00', '2025-07-03 00:04:00'),
(577, '14/03/2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 65, 'B 9165 UVX', '00:03', '', '890000', 0, '2025-07-03 00:04:00', '2025-07-03 00:04:00'),
(578, '14/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 506, 'B 9197 UVV', '00:04', '', '900000', 0, '2025-07-03 00:05:00', '2025-07-03 00:05:00'),
(579, '14/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 507, 'B 9189 UVV', '00:04', '', '900000', 0, '2025-07-03 00:05:00', '2025-07-03 00:05:00'),
(580, '14/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 701, 'B 9590 UVV', '00:05', '', '900000', 0, '2025-07-03 00:05:00', '2025-07-03 00:05:00'),
(581, '14/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 702, 'B 9581 UVV', '00:05', '', '900000', 0, '2025-07-03 00:05:00', '2025-07-03 00:05:00'),
(582, '14/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 805, '', '00:05', '', '900000', 0, '2025-07-03 00:05:00', '2025-07-03 00:05:00'),
(583, '14/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 902, '', '00:05', '', '900000', 0, '2025-07-03 00:05:00', '2025-07-03 00:05:00'),
(584, '14/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 905, '', '00:05', '', '900000', 0, '2025-07-03 00:05:00', '2025-07-03 00:05:00'),
(585, '15/03/2025', 4, 'M', 2, 'Kohod', 3, 'MULTIKON', 30, 'B 9462 UIT', '00:06', '', '890000', 0, '2025-07-03 00:06:00', '2025-07-03 00:06:00'),
(586, '15/03/2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 58, 'B 9110 UVX', '00:06', '', '890000', 0, '2025-07-03 00:07:00', '2025-07-03 00:07:00'),
(587, '15/03/2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 93, 'B 9134 UVX', '00:06', '', '890000', 0, '2025-07-03 00:07:00', '2025-07-03 00:07:00'),
(588, '15/03/2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 98, 'B 9148 UVX', '00:06', '', '890000', 0, '2025-07-03 00:07:00', '2025-07-03 00:07:00'),
(589, '15/03/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 901, '', '00:08', '', '1100000', 0, '2025-07-03 00:08:00', '2025-07-03 00:08:00'),
(590, '16/03/2025', 4, 'M', 2, 'Kohod', 13, 'KOPI', 20, 'B 9508 UIU', '00:09', '', '1100000', 0, '2025-07-03 00:09:00', '2025-07-03 00:09:00'),
(591, '16/03/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '00:10', '', '1050000', 0, '2025-07-03 00:11:00', '2025-07-03 00:11:00'),
(592, '16/03/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '00:10', '', '1050000', 0, '2025-07-03 00:11:00', '2025-07-03 00:11:00'),
(593, '16/03/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 1077, 'B 9907 KIT', '00:10', '', '1050000', 0, '2025-07-03 00:11:00', '2025-07-03 00:11:00'),
(594, '16/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '00:11', '', '1050000', 0, '2025-07-03 00:13:00', '2025-07-03 00:13:00'),
(595, '16/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '00:11', '', '1050000', 0, '2025-07-03 00:13:00', '2025-07-03 00:13:00'),
(596, '16/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '00:11', '', '1050000', 0, '2025-07-03 00:13:00', '2025-07-03 00:13:00'),
(597, '16/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 704, 'B 9582 UVV', '00:11', '', '1050000', 0, '2025-07-03 00:13:00', '2025-07-03 00:13:00'),
(598, '16/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '00:12', '', '1050000', 0, '2025-07-03 00:13:00', '2025-07-03 00:13:00'),
(599, '16/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '00:12', '', '1050000', 0, '2025-07-03 00:13:00', '2025-07-03 00:13:00'),
(600, '16/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '00:12', '', '1050000', 0, '2025-07-03 00:13:00', '2025-07-03 00:13:00'),
(601, '16/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '00:12', '', '1050000', 0, '2025-07-03 00:13:00', '2025-07-03 00:13:00'),
(602, '16/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '00:12', '', '1050000', 0, '2025-07-03 00:13:00', '2025-07-03 00:13:00'),
(603, '16/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '00:12', '', '1050000', 0, '2025-07-03 00:13:00', '2025-07-03 00:13:00'),
(604, '17/03/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 33, 'B 9756 UIU', '00:15', '', '1100000', 0, '2025-07-03 00:15:00', '2025-07-03 00:15:00'),
(605, '17/03/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 58, 'B 9110 UVX', '00:16', '', '1050000', 0, '2025-07-03 00:17:00', '2025-07-03 00:17:00'),
(606, '17/03/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 86, 'B 9776 UIU', '00:16', '', '1050000', 0, '2025-07-03 00:17:00', '2025-07-03 00:17:00'),
(607, '17/03/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '00:16', '', '1050000', 0, '2025-07-03 00:17:00', '2025-07-03 00:17:00'),
(608, '17/03/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 98, 'B 9148 UVX', '00:16', '', '1050000', 0, '2025-07-03 00:17:00', '2025-07-03 00:17:00'),
(609, '17/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '00:17', '', '1050000', 0, '2025-07-03 00:18:00', '2025-07-03 00:18:00'),
(610, '17/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '00:18', '', '1050000', 0, '2025-07-03 00:18:00', '2025-07-03 00:18:00'),
(611, '17/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '00:18', '', '1050000', 0, '2025-07-03 00:18:00', '2025-07-03 00:18:00'),
(612, '17/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 704, 'B 9582 UVV', '00:18', '', '1050000', 0, '2025-07-03 00:18:00', '2025-07-03 00:18:00'),
(613, '17/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '00:18', '', '1050000', 0, '2025-07-03 00:18:00', '2025-07-03 00:18:00'),
(614, '17/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '00:18', '', '1050000', 0, '2025-07-03 00:18:00', '2025-07-03 00:18:00'),
(615, '17/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '00:18', '', '1050000', 0, '2025-07-03 00:18:00', '2025-07-03 00:18:00'),
(616, '17/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '00:18', '', '1050000', 0, '2025-07-03 00:18:00', '2025-07-03 00:18:00'),
(617, '17/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '00:18', '', '1050000', 0, '2025-07-03 00:18:00', '2025-07-03 00:18:00'),
(618, '17/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '00:18', '', '1050000', 0, '2025-07-03 00:18:00', '2025-07-03 00:18:00'),
(619, '18/03/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 30, 'B 9462 UIT', '00:19', '', '1050000', 0, '2025-07-03 00:19:00', '2025-07-03 00:19:00'),
(620, '18/03/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '00:21', '', '1050000', 0, '2025-07-03 00:21:00', '2025-07-03 00:21:00'),
(621, '18/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '00:28', '', '1050000', 0, '2025-07-03 00:29:00', '2025-07-03 00:29:00'),
(622, '18/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '00:28', '', '1050000', 0, '2025-07-03 00:29:00', '2025-07-03 00:29:00'),
(623, '18/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '00:28', '', '1050000', 0, '2025-07-03 00:29:00', '2025-07-03 00:29:00'),
(624, '18/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '00:29', '', '1050000', 0, '2025-07-03 00:29:00', '2025-07-03 00:29:00'),
(625, '21/03/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '00:34', '', '1050000', 0, '2025-07-03 00:34:00', '2025-07-03 00:34:00'),
(626, '21/03/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 1077, 'B 9907 KIT', '00:34', '', '1050000', 0, '2025-07-03 00:34:00', '2025-07-03 00:34:00'),
(627, '22/03/2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 55, 'B 9118 UVX', '00:35', '', '900000', 0, '2025-07-03 00:35:00', '2025-07-03 00:35:00'),
(628, '22/03/2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 62, 'B 9137 UVX', '00:35', '', '900000', 0, '2025-07-03 00:35:00', '2025-07-03 00:35:00'),
(629, '22/03/2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 86, 'B 9776 UIU', '00:35', '', '900000', 0, '2025-07-03 00:35:00', '2025-07-03 00:35:00'),
(630, '22/03/2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 98, 'B 9148 UVX', '00:35', '', '900000', 0, '2025-07-03 00:35:00', '2025-07-03 00:35:00'),
(631, '22/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 506, 'B 9197 UVV', '00:37', '', '900000', 0, '2025-07-03 00:38:00', '2025-07-03 00:38:00'),
(632, '22/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 510, 'B 9190 UVV', '00:37', '', '900000', 0, '2025-07-03 00:38:00', '2025-07-03 00:38:00'),
(633, '22/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 701, 'B 9590 UVV', '00:37', '', '900000', 0, '2025-07-03 00:38:00', '2025-07-03 00:38:00'),
(634, '22/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 702, 'B 9581 UVV', '00:37', '', '900000', 0, '2025-07-03 00:38:00', '2025-07-03 00:38:00'),
(635, '22/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 801, '', '00:37', '', '900000', 0, '2025-07-03 00:38:00', '2025-07-03 00:38:00'),
(636, '22/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 803, '', '00:37', '', '900000', 0, '2025-07-03 00:38:00', '2025-07-03 00:38:00'),
(637, '22/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 811, '', '00:37', '', '900000', 0, '2025-07-03 00:38:00', '2025-07-03 00:38:00'),
(638, '22/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 903, '', '00:37', '', '900000', 0, '2025-07-03 00:38:00', '2025-07-03 00:38:00'),
(639, '23/03/2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 55, 'B 9118 UVX', '00:40', '', '900000', 0, '2025-07-03 00:41:00', '2025-07-03 00:41:00'),
(640, '23/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 510, 'B 9190 UVV', '00:41', '', '900000', 0, '2025-07-03 00:42:00', '2025-07-03 00:42:00'),
(641, '23/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 701, 'B 9590 UVV', '00:41', '', '900000', 0, '2025-07-03 00:42:00', '2025-07-03 00:42:00'),
(642, '23/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 801, '', '00:41', '', '900000', 0, '2025-07-03 00:42:00', '2025-07-03 00:42:00'),
(643, '23/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 803, '', '00:41', '', '900000', 0, '2025-07-03 00:42:00', '2025-07-03 00:42:00'),
(644, '23/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 805, '', '00:41', '', '900000', 0, '2025-07-03 00:42:00', '2025-07-03 00:42:00'),
(645, '23/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 807, '', '00:42', '', '900000', 0, '2025-07-03 00:42:00', '2025-07-03 00:42:00'),
(646, '23/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 811, '', '00:42', '', '900000', 0, '2025-07-03 00:42:00', '2025-07-03 00:42:00'),
(647, '24/03/2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 33, 'B 9756 UIU', '00:43', '', '900000', 0, '2025-07-03 00:43:00', '2025-07-03 00:43:00'),
(648, '24/03/2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 55, 'B 9118 UVX', '00:43', '', '900000', 0, '2025-07-03 00:43:00', '2025-07-03 00:43:00'),
(649, '24/03/2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 57, 'B 9103 UVX', '00:43', '', '900000', 0, '2025-07-03 00:43:00', '2025-07-03 00:43:00'),
(650, '24/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '00:44', '', '1050000', 0, '2025-07-03 00:45:00', '2025-07-03 00:45:00'),
(651, '24/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '00:44', '', '1050000', 0, '2025-07-03 00:45:00', '2025-07-03 00:45:00'),
(652, '24/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '00:44', '', '1050000', 0, '2025-07-03 00:45:00', '2025-07-03 00:45:00'),
(653, '24/03/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '00:44', '', '1050000', 0, '2025-07-03 00:45:00', '2025-07-03 00:45:00'),
(654, '24/03/2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 702, 'B 9581 UVV', '00:45', '', '900000', 0, '2025-07-03 00:45:00', '2025-07-03 00:45:00'),
(655, '07/04/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '00:47', '', '1050000', 0, '2025-07-03 00:54:00', '2025-07-03 00:54:00'),
(656, '07/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 510, 'B 9190 UVV', '00:54', '', '1100000', 0, '2025-07-03 00:56:00', '2025-07-03 00:56:00'),
(657, '07/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 801, '', '00:55', '', '1100000', 0, '2025-07-03 00:56:00', '2025-07-03 00:56:00'),
(658, '07/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 803, '', '00:55', '', '1100000', 0, '2025-07-03 00:56:00', '2025-07-03 00:56:00'),
(659, '07/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 811, '', '00:55', '', '1100000', 0, '2025-07-03 00:56:00', '2025-07-03 00:56:00'),
(660, '07/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 905, '', '00:55', '', '1100000', 0, '2025-07-03 00:56:00', '2025-07-03 00:56:00'),
(661, '07/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '00:56', '', '1050000', 0, '2025-07-03 00:56:00', '2025-07-03 00:56:00'),
(662, '08/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 86, 'B 9776 UIU', '00:57', '', '1050000', 0, '2025-07-03 00:57:00', '2025-07-03 00:57:00'),
(663, '08/04/2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 98, 'B 9148 UVX', '00:57', '', '890000', 0, '2025-07-03 00:57:00', '2025-07-03 00:57:00'),
(664, '09/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 33, 'B 9756 UIU', '01:01', '', '1050000', 0, '2025-07-03 01:02:00', '2025-07-03 01:02:00'),
(665, '09/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '01:01', '', '1050000', 0, '2025-07-03 01:02:00', '2025-07-03 01:02:00'),
(666, '09/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '01:01', '', '1050000', 0, '2025-07-03 01:02:00', '2025-07-03 01:02:00'),
(667, '09/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '01:01', '', '1050000', 0, '2025-07-03 01:02:00', '2025-07-03 01:02:00'),
(668, '09/04/2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 86, 'B 9776 UIU', '01:02', '', '1100000', 0, '2025-07-03 01:02:00', '2025-07-03 01:02:00'),
(669, '09/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 510, 'B 9190 UVV', '01:04', '', '1100000', 0, '2025-07-03 01:04:00', '2025-07-03 01:04:00'),
(670, '09/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '01:05', '', '1050000', 0, '2025-07-03 01:05:00', '2025-07-03 01:05:00'),
(671, '09/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 801, '', '01:06', '', '1100000', 0, '2025-07-03 01:06:00', '2025-07-03 01:06:00'),
(672, '09/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 803, '', '01:06', '', '1100000', 0, '2025-07-03 01:06:00', '2025-07-03 01:06:00'),
(673, '09/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 811, '', '01:06', '', '1100000', 0, '2025-07-03 01:06:00', '2025-07-03 01:06:00'),
(674, '09/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 902, '', '01:06', '', '1100000', 0, '2025-07-03 01:06:00', '2025-07-03 01:06:00'),
(675, '09/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 905, '', '01:06', '', '1100000', 0, '2025-07-03 01:06:00', '2025-07-03 01:06:00'),
(676, '10/04/2025', 4, 'M', 2, 'Kohod', 13, 'KOPI', 20, 'B 9508 UIU', '02:54', '', '1100000', 0, '2025-07-03 02:54:00', '2025-07-03 02:54:00'),
(677, '10/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '02:55', '', '1050000', 0, '2025-07-03 02:55:00', '2025-07-03 02:55:00'),
(678, '10/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '02:55', '', '1050000', 0, '2025-07-03 02:55:00', '2025-07-03 02:55:00'),
(679, '10/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 65, 'B 9165 UVX', '02:55', '', '1050000', 0, '2025-07-03 02:55:00', '2025-07-03 02:55:00'),
(680, '10/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 506, 'B 9197 UVV', '02:57', '', '1100000', 0, '2025-07-03 02:59:00', '2025-07-03 02:59:00'),
(681, '10/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 510, 'B 9190 UVV', '02:57', '', '1100000', 0, '2025-07-03 02:59:00', '2025-07-03 02:59:00'),
(682, '10/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 704, 'B 9582 UVV', '02:57', '', '1100000', 0, '2025-07-03 02:59:00', '2025-07-03 02:59:00'),
(683, '10/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 801, '', '02:57', '', '1100000', 0, '2025-07-03 02:59:00', '2025-07-03 02:59:00'),
(684, '10/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 811, '', '02:58', '', '1100000', 0, '2025-07-03 02:59:00', '2025-07-03 02:59:00'),
(685, '10/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 901, '', '02:58', '', '1100000', 0, '2025-07-03 02:59:00', '2025-07-03 02:59:00'),
(686, '10/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 902, '', '02:58', '', '1100000', 0, '2025-07-03 02:59:00', '2025-07-03 02:59:00'),
(687, '10/04/2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 905, '', '02:58', '', '1100000', 0, '2025-07-03 02:59:00', '2025-07-03 02:59:00'),
(688, '10/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '02:59', '', '1050000', 0, '2025-07-03 02:59:00', '2025-07-03 02:59:00'),
(689, '10/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '02:59', '', '1050000', 0, '2025-07-03 02:59:00', '2025-07-03 02:59:00'),
(690, '30/04/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '03:18', '', '1050000', 0, '2025-07-03 03:18:00', '2025-07-03 03:18:00'),
(691, '30/04/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '03:18', '', '1050000', 0, '2025-07-03 03:18:00', '2025-07-03 03:18:00'),
(692, '30/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 33, 'B 9756 UIU', '03:23', '', '900000', 0, '2025-07-03 03:23:00', '2025-07-03 03:23:00'),
(693, '30/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '03:23', '', '1050000', 0, '2025-07-03 03:24:00', '2025-07-03 03:24:00'),
(694, '30/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '03:23', '', '1050000', 0, '2025-07-03 03:24:00', '2025-07-03 03:24:00'),
(695, '30/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '03:23', '', '1050000', 0, '2025-07-03 03:24:00', '2025-07-03 03:24:00'),
(696, '30/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 1077, 'B 9907 KIT', '03:24', '', '900000', 0, '2025-07-03 03:24:00', '2025-07-03 03:24:00'),
(697, '30/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 98, 'B 9148 UVX', '03:24', '', '900000', 0, '2025-07-03 03:24:00', '2025-07-03 03:24:00'),
(698, '30/04/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 501, 'B 9192 UVV', '03:25', '', '980000', 0, '2025-07-03 03:26:00', '2025-07-03 03:26:00'),
(699, '30/04/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 506, 'B 9197 UVV', '03:25', '', '980000', 0, '2025-07-03 03:26:00', '2025-07-03 03:26:00'),
(700, '30/04/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 603, 'B 9597 UVV', '03:26', '', '980000', 0, '2025-07-03 03:26:00', '2025-07-03 03:26:00'),
(701, '30/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '03:27', '', '1050000', 0, '2025-07-03 03:28:00', '2025-07-03 03:28:00'),
(702, '30/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '03:27', '', '1050000', 0, '2025-07-03 03:28:00', '2025-07-03 03:28:00'),
(703, '30/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '03:27', '', '1050000', 0, '2025-07-03 03:28:00', '2025-07-03 03:28:00'),
(704, '30/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '03:27', '', '1050000', 0, '2025-07-03 03:28:00', '2025-07-03 03:28:00'),
(705, '30/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 704, 'B 9582 UVV', '03:27', '', '1050000', 0, '2025-07-03 03:28:00', '2025-07-03 03:28:00'),
(706, '30/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '03:27', '', '1050000', 0, '2025-07-03 03:28:00', '2025-07-03 03:28:00'),
(707, '30/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '03:27', '', '1050000', 0, '2025-07-03 03:28:00', '2025-07-03 03:28:00'),
(708, '29/04/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 30, 'B 9462 UIT', '03:28', '', '1050000', 0, '2025-07-03 03:29:00', '2025-07-03 03:29:00'),
(709, '29/04/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '03:28', '', '1050000', 0, '2025-07-03 03:29:00', '2025-07-03 03:29:00'),
(710, '29/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 33, 'B 9756 UIU', '03:30', '', '900000', 0, '2025-07-03 03:30:00', '2025-07-03 03:30:00'),
(711, '29/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 62, 'B 9137 UVX', '03:30', '', '900000', 0, '2025-07-03 03:30:00', '2025-07-03 03:30:00'),
(712, '29/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 98, 'B 9148 UVX', '03:30', '', '900000', 0, '2025-07-03 03:30:00', '2025-07-03 03:30:00');
INSERT INTO `ritasi` (`id`, `tgl_ritasi`, `tim_id`, `nama_tim`, `proyek_id`, `nama_proyek`, `galian_id`, `lokasi`, `vehicle_id`, `no_pol`, `jam_angkut`, `nomerdo`, `uang_jalan`, `is_delete`, `created_at`, `updated_at`) VALUES
(713, '29/04/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 501, 'B 9192 UVV', '03:31', '', '980000', 0, '2025-07-03 03:31:00', '2025-07-03 03:31:00'),
(714, '29/04/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 603, 'B 9597 UVV', '03:31', '', '980000', 0, '2025-07-03 03:31:00', '2025-07-03 03:31:00'),
(715, '29/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '03:31', '', '1050000', 0, '2025-07-03 03:32:00', '2025-07-03 03:32:00'),
(716, '29/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '03:31', '', '1050000', 0, '2025-07-03 03:32:00', '2025-07-03 03:32:00'),
(717, '29/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '03:31', '', '1050000', 0, '2025-07-03 03:32:00', '2025-07-03 03:32:00'),
(718, '29/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '03:32', '', '1050000', 0, '2025-07-03 03:32:00', '2025-07-03 03:32:00'),
(719, '28/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 55, 'B 9118 UVX', '03:33', '', '900000', 0, '2025-07-03 03:33:00', '2025-07-03 03:33:00'),
(720, '28/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 57, 'B 9103 UVX', '03:33', '', '900000', 0, '2025-07-03 03:33:00', '2025-07-03 03:33:00'),
(721, '28/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 58, 'B 9110 UVX', '03:33', '', '900000', 0, '2025-07-03 03:33:00', '2025-07-03 03:33:00'),
(722, '28/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 62, 'B 9137 UVX', '03:33', '', '900000', 0, '2025-07-03 03:33:00', '2025-07-03 03:33:00'),
(723, '28/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 65, 'B 9165 UVX', '03:33', '', '900000', 0, '2025-07-03 03:33:00', '2025-07-03 03:33:00'),
(724, '28/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 1077, 'B 9907 KIT', '03:33', '', '900000', 0, '2025-07-03 03:33:00', '2025-07-03 03:33:00'),
(725, '28/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 506, 'B 9197 UVV', '03:34', '', '900000', 0, '2025-07-03 03:34:00', '2025-07-03 03:34:00'),
(726, '28/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '03:36', '', '1050000', 0, '2025-07-03 03:36:00', '2025-07-03 03:36:00'),
(727, '28/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '03:36', '', '1050000', 0, '2025-07-03 03:36:00', '2025-07-03 03:36:00'),
(728, '28/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '03:36', '', '1050000', 0, '2025-07-03 03:36:00', '2025-07-03 03:36:00'),
(729, '28/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '03:36', '', '1050000', 0, '2025-07-03 03:36:00', '2025-07-03 03:36:00'),
(730, '28/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '03:36', '', '1050000', 0, '2025-07-03 03:36:00', '2025-07-03 03:36:00'),
(731, '28/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '03:36', '', '1050000', 0, '2025-07-03 03:36:00', '2025-07-03 03:36:00'),
(732, '28/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '03:36', '', '1050000', 0, '2025-07-03 03:36:00', '2025-07-03 03:36:00'),
(733, '28/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 702, 'B 9581 UVV', '03:37', '', '900000', 0, '2025-07-03 03:37:00', '2025-07-03 03:37:00'),
(734, '28/04/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 704, 'B 9582 UVV', '03:37', '', '980000', 0, '2025-07-03 03:38:00', '2025-07-03 03:38:00'),
(735, '28/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '03:39', '', '1050000', 0, '2025-07-03 03:39:00', '2025-07-03 03:39:00'),
(736, '28/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '03:39', '', '1050000', 0, '2025-07-03 03:39:00', '2025-07-03 03:39:00'),
(737, '28/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '03:39', '', '1050000', 0, '2025-07-03 03:39:00', '2025-07-03 03:39:00'),
(738, '28/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '03:39', '', '1050000', 0, '2025-07-03 03:39:00', '2025-07-03 03:39:00'),
(739, '28/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 905, '', '03:39', '', '900000', 0, '2025-07-03 03:40:00', '2025-07-03 03:40:00'),
(740, '27/04/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '03:58', '', '1050000', 0, '2025-07-03 03:59:00', '2025-07-03 03:59:00'),
(741, '27/04/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '03:58', '', '1050000', 0, '2025-07-03 03:59:00', '2025-07-03 03:59:00'),
(742, '27/04/2025', 4, 'M', 2, 'Kohod', 17, 'T. ABANG', 30, 'B 9462 UIT', '03:59', '', '700000', 0, '2025-07-03 03:59:00', '2025-07-03 03:59:00'),
(743, '27/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 55, 'B 9118 UVX', '03:59', '', '900000', 0, '2025-07-03 04:00:00', '2025-07-03 04:00:00'),
(744, '27/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 1077, 'B 9907 KIT', '04:00', '', '900000', 0, '2025-07-03 04:00:00', '2025-07-03 04:00:00'),
(745, '27/04/2025', 2, 'K', 2, 'Kohod', 9, 'C. BITUNG', 98, 'B 9148 UVX', '04:01', '', '980000', 0, '2025-07-03 04:01:00', '2025-07-03 04:01:00'),
(746, '27/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 501, 'B 9192 UVV', '04:03', '', '900000', 0, '2025-07-03 04:03:00', '2025-07-03 04:03:00'),
(747, '27/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 506, 'B 9197 UVV', '04:03', '', '900000', 0, '2025-07-03 04:03:00', '2025-07-03 04:03:00'),
(748, '27/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 507, 'B 9189 UVV', '04:02', '', '900000', 0, '2025-07-03 04:03:00', '2025-07-03 04:03:00'),
(749, '27/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 702, 'B 9581 UVV', '04:02', '', '900000', 0, '2025-07-03 04:03:00', '2025-07-03 04:03:00'),
(750, '27/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 807, '', '04:02', '', '900000', 0, '2025-07-03 04:03:00', '2025-07-03 04:03:00'),
(751, '27/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 905, '', '04:02', '', '900000', 0, '2025-07-03 04:03:00', '2025-07-03 04:03:00'),
(752, '27/04/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 603, 'B 9597 UVV', '04:03', '', '980000', 0, '2025-07-03 04:04:00', '2025-07-03 04:04:00'),
(753, '27/04/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 704, 'B 9582 UVV', '04:03', '', '980000', 0, '2025-07-03 04:04:00', '2025-07-03 04:04:00'),
(754, '27/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 605, 'B 9594 UVV', '04:06', '', '1050000', 0, '2025-07-03 04:06:00', '2025-07-03 04:06:00'),
(755, '27/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '04:06', '', '1050000', 0, '2025-07-03 04:06:00', '2025-07-03 04:06:00'),
(756, '27/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '04:06', '', '1050000', 0, '2025-07-03 04:06:00', '2025-07-03 04:06:00'),
(757, '27/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '04:06', '', '1050000', 0, '2025-07-03 04:06:00', '2025-07-03 04:06:00'),
(758, '27/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '04:06', '', '1050000', 0, '2025-07-03 04:06:00', '2025-07-03 04:06:00'),
(759, '26/04/2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '04:07', '', '1050000', 0, '2025-07-03 04:07:00', '2025-07-03 04:07:00'),
(760, '26/04/2025', 2, 'K', 2, 'Kohod', 9, 'C. BITUNG', 33, 'B 9756 UIU', '04:07', '', '980000', 0, '2025-07-03 04:09:00', '2025-07-03 04:09:00'),
(761, '26/04/2025', 2, 'K', 2, 'Kohod', 9, 'C. BITUNG', 57, 'B 9103 UVX', '04:08', '', '980000', 0, '2025-07-03 04:09:00', '2025-07-03 04:09:00'),
(762, '26/04/2025', 2, 'K', 2, 'Kohod', 9, 'C. BITUNG', 58, 'B 9110 UVX', '04:08', '', '980000', 0, '2025-07-03 04:09:00', '2025-07-03 04:09:00'),
(763, '26/04/2025', 2, 'K', 2, 'Kohod', 9, 'C. BITUNG', 86, 'B 9776 UIU', '04:09', '', '980000', 0, '2025-07-03 04:09:00', '2025-07-03 04:09:00'),
(764, '26/04/2025', 2, 'K', 2, 'Kohod', 9, 'C. BITUNG', 98, 'B 9148 UVX', '04:08', '', '980000', 0, '2025-07-03 04:09:00', '2025-07-03 04:09:00'),
(765, '26/04/2025', 2, 'K', 2, 'Kohod', 17, 'T. ABANG', 65, 'B 9165 UVX', '04:09', '', '700000', 0, '2025-07-03 04:09:00', '2025-07-03 04:09:00'),
(766, '26/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '04:10', '', '1050000', 0, '2025-07-03 04:10:00', '2025-07-03 04:10:00'),
(767, '26/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 506, 'B 9197 UVV', '04:10', '', '900000', 0, '2025-07-03 04:12:00', '2025-07-03 04:12:00'),
(768, '26/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 702, 'B 9581 UVV', '04:12', '', '900000', 0, '2025-07-03 04:12:00', '2025-07-03 04:12:00'),
(769, '26/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 807, '', '04:12', '', '900000', 0, '2025-07-03 04:12:00', '2025-07-03 04:12:00'),
(770, '26/04/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 507, 'B 9189 UVV', '04:13', '', '980000', 0, '2025-07-03 04:14:00', '2025-07-03 04:14:00'),
(771, '26/04/2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 905, '', '04:13', '', '980000', 0, '2025-07-03 04:14:00', '2025-07-03 04:14:00'),
(772, '26/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '04:15', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(773, '26/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '04:15', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(774, '26/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '04:15', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(775, '26/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '04:15', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(776, '26/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '04:15', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(777, '26/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '04:15', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(778, '26/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '04:15', '', '1050000', 0, '2025-07-03 04:16:00', '2025-07-03 04:16:00'),
(779, '25/04/2025', 4, 'M', 2, 'Kohod', 17, 'T. ABANG', 20, 'B 9508 UIU', '04:16', '', '700000', 0, '2025-07-03 04:17:00', '2025-07-03 04:17:00'),
(780, '25/04/2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 55, 'B 9118 UVX', '04:33', '', '900000', 0, '2025-07-03 04:33:00', '2025-07-03 04:33:00'),
(781, '25/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 58, 'B 9110 UVX', '04:35', '', '1050000', 0, '2025-07-03 04:35:00', '2025-07-03 04:35:00'),
(782, '25/04/2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 86, 'B 9776 UIU', '04:35', '', '1050000', 0, '2025-07-03 04:35:00', '2025-07-03 04:35:00'),
(783, '25/04/2025', 2, 'K', 2, 'Kohod', 17, 'T. ABANG', 1077, 'B 9907 KIT', '04:35', '', '700000', 0, '2025-07-03 04:35:00', '2025-07-03 04:35:00'),
(784, '25/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 501, 'B 9192 UVV', '04:36', '', '900000', 0, '2025-07-03 04:36:00', '2025-07-03 04:36:00'),
(785, '25/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 701, 'B 9590 UVV', '04:36', '', '900000', 0, '2025-07-03 04:36:00', '2025-07-03 04:36:00'),
(786, '25/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '04:38', '', '1050000', 0, '2025-07-03 04:38:00', '2025-07-03 04:38:00'),
(787, '25/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '04:38', '', '1050000', 0, '2025-07-03 04:38:00', '2025-07-03 04:38:00'),
(788, '25/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 704, 'B 9582 UVV', '04:38', '', '1050000', 0, '2025-07-03 04:38:00', '2025-07-03 04:38:00'),
(789, '25/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '04:37', '', '1050000', 0, '2025-07-03 04:38:00', '2025-07-03 04:38:00'),
(790, '25/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '04:38', '', '1050000', 0, '2025-07-03 04:38:00', '2025-07-03 04:38:00'),
(791, '25/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '04:38', '', '1050000', 0, '2025-07-03 04:38:00', '2025-07-03 04:38:00'),
(792, '25/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '04:38', '', '1050000', 0, '2025-07-03 04:38:00', '2025-07-03 04:38:00'),
(793, '25/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '04:38', '', '1050000', 0, '2025-07-03 04:38:00', '2025-07-03 04:38:00'),
(794, '25/04/2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '04:38', '', '1050000', 0, '2025-07-03 04:38:00', '2025-07-03 04:38:00'),
(795, '25/04/2025', 3, 'G', 2, 'Kohod', 19, 'TUTUL', 603, 'B 9597 UVV', '04:39', '', '925000', 0, '2025-07-03 04:39:00', '2025-07-03 04:39:00'),
(796, '25/04/2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 605, 'B 9594 UVV', '04:39', '', '900000', 0, '2025-07-03 04:39:00', '2025-07-03 04:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `ritasi2`
--

CREATE TABLE `ritasi2` (
  `id` int(11) NOT NULL,
  `tgl_ritasi` varchar(10) NOT NULL,
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
  `is_delete` int(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ritasi2`
--

INSERT INTO `ritasi2` (`id`, `tgl_ritasi`, `tim_id`, `nama_tim`, `proyek_id`, `nama_proyek`, `galian_id`, `lokasi`, `vehicle_id`, `no_pol`, `jam_angkut`, `nomerdo`, `uang_jalan`, `is_delete`, `created_at`, `updated_at`) VALUES
(3, '03-03-2025', 2, 'K', 2, 'Kohod', 9, 'C. BITUNG', 62, 'B 9137 UVX', '23:33', '', '980000', 0, '2025-07-02 23:33:18', '2025-07-02 23:33:18'),
(4, '10-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 501, 'B 9192 UVV', '23:50', '', '1050000', 0, '2025-07-02 23:50:43', '2025-07-02 23:50:43'),
(5, '10-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '23:50', '', '1050000', 0, '2025-07-02 23:50:43', '2025-07-02 23:50:43'),
(6, '12-03-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '23:52', '', '1050000', 0, '2025-07-02 23:52:32', '2025-07-02 23:52:32'),
(7, '13-03-2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 93, 'B 9134 UVX', '23:57', '', '890000', 0, '2025-07-02 23:57:49', '2025-07-02 23:57:49'),
(8, '13-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 510, 'B 9190 UVV', '23:58', '', ' 900000', 0, '2025-07-02 23:58:32', '2025-07-02 23:58:32'),
(9, '13-03-2025', 3, 'G', 2, 'Kohod', 3, 'MULTIKON', 805, '', '23:58', '', '890000', 0, '2025-07-02 23:58:53', '2025-07-02 23:58:53'),
(10, '14-03-2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 55, 'B 9118 UVX', '00:03', '', '890000', 0, '2025-07-03 00:04:02', '2025-07-03 00:04:02'),
(11, '14-03-2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 62, 'B 9137 UVX', '00:03', '', '890000', 0, '2025-07-03 00:04:02', '2025-07-03 00:04:02'),
(12, '14-03-2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 65, 'B 9165 UVX', '00:03', '', '890000', 0, '2025-07-03 00:04:02', '2025-07-03 00:04:02'),
(13, '14-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 506, 'B 9197 UVV', '00:04', '', ' 900000', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(14, '14-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 507, 'B 9189 UVV', '00:04', '', ' 900000', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(15, '14-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 701, 'B 9590 UVV', '00:05', '', ' 900000', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(16, '14-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 702, 'B 9581 UVV', '00:05', '', ' 900000', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(17, '14-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 805, '', '00:05', '', ' 900000', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(18, '14-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 902, '', '00:05', '', ' 900000', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(19, '14-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 905, '', '00:05', '', ' 900000', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(20, '15-03-2025', 4, 'M', 2, 'Kohod', 3, 'MULTIKON', 30, 'B 9462 UIT', '00:06', '', '890000', 0, '2025-07-03 00:06:26', '2025-07-03 00:06:26'),
(21, '15-03-2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 58, 'B 9110 UVX', '00:06', '', '890000', 0, '2025-07-03 00:07:22', '2025-07-03 00:07:22'),
(22, '15-03-2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 93, 'B 9134 UVX', '00:06', '', '890000', 0, '2025-07-03 00:07:22', '2025-07-03 00:07:22'),
(23, '15-03-2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 98, 'B 9148 UVX', '00:06', '', '890000', 0, '2025-07-03 00:07:22', '2025-07-03 00:07:22'),
(24, '15-03-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 901, '', '00:08', '', '1100000', 0, '2025-07-03 00:08:56', '2025-07-03 00:08:56'),
(25, '16-03-2025', 4, 'M', 2, 'Kohod', 13, 'KOPI', 20, 'B 9508 UIU', '00:09', '', '1100000', 0, '2025-07-03 00:09:37', '2025-07-03 00:09:37'),
(26, '16-03-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '00:10', '', '1050000', 0, '2025-07-03 00:11:10', '2025-07-03 00:11:10'),
(27, '16-03-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '00:10', '', '1050000', 0, '2025-07-03 00:11:10', '2025-07-03 00:11:10'),
(28, '16-03-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 1077, 'B 9907 KIT', '00:10', '', '1050000', 0, '2025-07-03 00:11:10', '2025-07-03 00:11:10'),
(29, '16-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '00:11', '', '1050000', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(30, '16-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '00:11', '', '1050000', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(31, '16-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '00:11', '', '1050000', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(32, '16-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 704, 'B 9582 UVV', '00:11', '', '1050000', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(33, '16-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '00:12', '', '1050000', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(34, '16-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '00:12', '', '1050000', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(35, '16-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '00:12', '', '1050000', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(36, '16-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '00:12', '', '1050000', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(37, '16-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '00:12', '', '1050000', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(38, '16-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '00:12', '', '1050000', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(39, '17-03-2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 33, 'B 9756 UIU', '00:15', '', '1100000', 0, '2025-07-03 00:15:18', '2025-07-03 00:15:18'),
(40, '17-03-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 58, 'B 9110 UVX', '00:16', '', '1050000', 0, '2025-07-03 00:17:04', '2025-07-03 00:17:04'),
(41, '17-03-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 86, 'B 9776 UIU', '00:16', '', '1050000', 0, '2025-07-03 00:17:04', '2025-07-03 00:17:04'),
(42, '17-03-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '00:16', '', '1050000', 0, '2025-07-03 00:17:04', '2025-07-03 00:17:04'),
(43, '17-03-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 98, 'B 9148 UVX', '00:16', '', '1050000', 0, '2025-07-03 00:17:04', '2025-07-03 00:17:04'),
(44, '17-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '00:17', '', '1050000', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(45, '17-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '00:18', '', '1050000', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(46, '17-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '00:18', '', '1050000', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(47, '17-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 704, 'B 9582 UVV', '00:18', '', '1050000', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(48, '17-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '00:18', '', '1050000', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(49, '17-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '00:18', '', '1050000', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(50, '17-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '00:18', '', '1050000', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(51, '17-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '00:18', '', '1050000', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(52, '17-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '00:18', '', '1050000', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(53, '17-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 905, '', '00:18', '', '1050000', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(54, '18-03-2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 30, 'B 9462 UIT', '00:19', '', '1050000', 0, '2025-07-03 00:19:58', '2025-07-03 00:19:58'),
(55, '18-03-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '00:21', '', '1050000', 0, '2025-07-03 00:21:26', '2025-07-03 00:21:26'),
(56, '18-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '00:28', '', '1050000', 0, '2025-07-03 00:29:12', '2025-07-03 00:29:12'),
(57, '18-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '00:28', '', '1050000', 0, '2025-07-03 00:29:12', '2025-07-03 00:29:12'),
(58, '18-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '00:28', '', '1050000', 0, '2025-07-03 00:29:12', '2025-07-03 00:29:12'),
(59, '18-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '00:29', '', '1050000', 0, '2025-07-03 00:29:12', '2025-07-03 00:29:12'),
(60, '21-03-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '00:34', '', '1050000', 0, '2025-07-03 00:34:13', '2025-07-03 00:34:13'),
(61, '21-03-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 1077, 'B 9907 KIT', '00:34', '', '1050000', 0, '2025-07-03 00:34:13', '2025-07-03 00:34:13'),
(62, '22-03-2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 55, 'B 9118 UVX', '00:35', '', ' 900000', 0, '2025-07-03 00:35:54', '2025-07-03 00:35:54'),
(63, '22-03-2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 62, 'B 9137 UVX', '00:35', '', ' 900000', 0, '2025-07-03 00:35:54', '2025-07-03 00:35:54'),
(64, '22-03-2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 86, 'B 9776 UIU', '00:35', '', ' 900000', 0, '2025-07-03 00:35:54', '2025-07-03 00:35:54'),
(65, '22-03-2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 98, 'B 9148 UVX', '00:35', '', ' 900000', 0, '2025-07-03 00:35:54', '2025-07-03 00:35:54'),
(66, '22-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 506, 'B 9197 UVV', '00:37', '', ' 900000', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(67, '22-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 510, 'B 9190 UVV', '00:37', '', ' 900000', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(68, '22-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 701, 'B 9590 UVV', '00:37', '', ' 900000', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(69, '22-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 702, 'B 9581 UVV', '00:37', '', ' 900000', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(70, '22-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 801, '', '00:37', '', ' 900000', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(71, '22-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 803, '', '00:37', '', ' 900000', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(72, '22-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 811, '', '00:37', '', ' 900000', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(73, '22-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 903, '', '00:37', '', ' 900000', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(74, '23-03-2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 55, 'B 9118 UVX', '00:40', '', ' 900000', 0, '2025-07-03 00:41:01', '2025-07-03 00:41:01'),
(75, '23-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 510, 'B 9190 UVV', '00:41', '', ' 900000', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(76, '23-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 701, 'B 9590 UVV', '00:41', '', ' 900000', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(77, '23-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 801, '', '00:41', '', ' 900000', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(78, '23-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 803, '', '00:41', '', ' 900000', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(79, '23-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 805, '', '00:41', '', ' 900000', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(80, '23-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 807, '', '00:42', '', ' 900000', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(81, '23-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 811, '', '00:42', '', ' 900000', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(82, '24-03-2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 33, 'B 9756 UIU', '00:43', '', ' 900000', 0, '2025-07-03 00:43:56', '2025-07-03 00:43:56'),
(83, '24-03-2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 55, 'B 9118 UVX', '00:43', '', ' 900000', 0, '2025-07-03 00:43:56', '2025-07-03 00:43:56'),
(84, '24-03-2025', 2, 'K', 2, 'Kohod', 1, 'CIUJUNG', 57, 'B 9103 UVX', '00:43', '', ' 900000', 0, '2025-07-03 00:43:56', '2025-07-03 00:43:56'),
(85, '24-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '00:44', '', '1050000', 0, '2025-07-03 00:45:21', '2025-07-03 00:45:21'),
(86, '24-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '00:44', '', '1050000', 0, '2025-07-03 00:45:21', '2025-07-03 00:45:21'),
(87, '24-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '00:44', '', '1050000', 0, '2025-07-03 00:45:21', '2025-07-03 00:45:21'),
(88, '24-03-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '00:44', '', '1050000', 0, '2025-07-03 00:45:21', '2025-07-03 00:45:21'),
(89, '24-03-2025', 3, 'G', 2, 'Kohod', 1, 'CIUJUNG', 702, 'B 9581 UVV', '00:45', '', ' 900000', 0, '2025-07-03 00:45:33', '2025-07-03 00:45:33'),
(90, '07-04-2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '00:47', '', '1050000', 0, '2025-07-03 00:54:25', '2025-07-03 00:54:25'),
(91, '07-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 510, 'B 9190 UVV', '00:54', '', '1100000', 0, '2025-07-03 00:56:01', '2025-07-03 00:56:01'),
(92, '07-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 801, '', '00:55', '', '1100000', 0, '2025-07-03 00:56:02', '2025-07-03 00:56:02'),
(93, '07-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 803, '', '00:55', '', '1100000', 0, '2025-07-03 00:56:02', '2025-07-03 00:56:02'),
(94, '07-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 811, '', '00:55', '', '1100000', 0, '2025-07-03 00:56:02', '2025-07-03 00:56:02'),
(95, '07-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 905, '', '00:55', '', '1100000', 0, '2025-07-03 00:56:02', '2025-07-03 00:56:02'),
(96, '07-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '00:56', '', '1050000', 0, '2025-07-03 00:56:14', '2025-07-03 00:56:14'),
(97, '08-04-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 86, 'B 9776 UIU', '00:57', '', '1050000', 0, '2025-07-03 00:57:27', '2025-07-03 00:57:27'),
(98, '08-04-2025', 2, 'K', 2, 'Kohod', 3, 'MULTIKON', 98, 'B 9148 UVX', '00:57', '', '890000', 0, '2025-07-03 00:57:27', '2025-07-03 00:57:27'),
(99, '09-04-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 33, 'B 9756 UIU', '01:01', '', '1050000', 0, '2025-07-03 01:02:21', '2025-07-03 01:02:21'),
(100, '09-04-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '01:01', '', '1050000', 0, '2025-07-03 01:02:21', '2025-07-03 01:02:21'),
(101, '09-04-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '01:01', '', '1050000', 0, '2025-07-03 01:02:21', '2025-07-03 01:02:21'),
(102, '09-04-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '01:01', '', '1050000', 0, '2025-07-03 01:02:21', '2025-07-03 01:02:21'),
(103, '09-04-2025', 2, 'K', 2, 'Kohod', 13, 'KOPI', 86, 'B 9776 UIU', '01:02', '', '1100000', 0, '2025-07-03 01:02:21', '2025-07-03 01:02:21'),
(104, '09-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 510, 'B 9190 UVV', '01:04', '', '1100000', 0, '2025-07-03 01:04:49', '2025-07-03 01:04:49'),
(105, '09-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '01:05', '', '1050000', 0, '2025-07-03 01:05:56', '2025-07-03 01:05:56'),
(106, '09-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 801, '', '01:06', '', '1100000', 0, '2025-07-03 01:06:49', '2025-07-03 01:06:49'),
(107, '09-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 803, '', '01:06', '', '1100000', 0, '2025-07-03 01:06:49', '2025-07-03 01:06:49'),
(108, '09-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 811, '', '01:06', '', '1100000', 0, '2025-07-03 01:06:49', '2025-07-03 01:06:49'),
(109, '09-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 902, '', '01:06', '', '1100000', 0, '2025-07-03 01:06:49', '2025-07-03 01:06:49'),
(110, '09-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 905, '', '01:06', '', '1100000', 0, '2025-07-03 01:06:49', '2025-07-03 01:06:49'),
(111, '10-04-2025', 4, 'M', 2, 'Kohod', 13, 'KOPI', 20, 'B 9508 UIU', '02:54', '', '1100000', 0, '2025-07-03 02:54:52', '2025-07-03 02:54:52'),
(112, '10-04-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '02:55', '', '1050000', 0, '2025-07-03 02:55:56', '2025-07-03 02:55:56'),
(113, '10-04-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '02:55', '', '1050000', 0, '2025-07-03 02:55:56', '2025-07-03 02:55:56'),
(114, '10-04-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 65, 'B 9165 UVX', '02:55', '', '1050000', 0, '2025-07-03 02:55:56', '2025-07-03 02:55:56'),
(115, '10-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 506, 'B 9197 UVV', '02:57', '', '1100000', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(116, '10-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 510, 'B 9190 UVV', '02:57', '', '1100000', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(117, '10-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 704, 'B 9582 UVV', '02:57', '', '1100000', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(118, '10-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 801, '', '02:57', '', '1100000', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(119, '10-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 811, '', '02:58', '', '1100000', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(120, '10-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 901, '', '02:58', '', '1100000', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(121, '10-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 902, '', '02:58', '', '1100000', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(122, '10-04-2025', 3, 'G', 2, 'Kohod', 13, 'KOPI', 905, '', '02:58', '', '1100000', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(123, '10-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '02:59', '', '1050000', 0, '2025-07-03 02:59:51', '2025-07-03 02:59:51'),
(124, '10-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '02:59', '', '1050000', 0, '2025-07-03 02:59:51', '2025-07-03 02:59:51'),
(125, '30-04-2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '03:18', '', '1050000', 0, '2025-07-03 03:18:46', '2025-07-03 03:18:46'),
(126, '30-04-2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '03:18', '', '1050000', 0, '2025-07-03 03:18:46', '2025-07-03 03:18:46'),
(127, '30-04-2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 33, 'B 9756 UIU', '03:23', '', '900000', 0, '2025-07-03 03:23:17', '2025-07-03 03:23:17'),
(128, '30-04-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 55, 'B 9118 UVX', '03:23', '', '1050000', 0, '2025-07-03 03:24:13', '2025-07-03 03:24:13'),
(129, '30-04-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 57, 'B 9103 UVX', '03:23', '', '1050000', 0, '2025-07-03 03:24:13', '2025-07-03 03:24:13'),
(130, '30-04-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 62, 'B 9137 UVX', '03:23', '', '1050000', 0, '2025-07-03 03:24:13', '2025-07-03 03:24:13'),
(131, '30-04-2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 1077, 'B 9907 KIT', '03:24', '', '900000', 0, '2025-07-03 03:24:59', '2025-07-03 03:24:59'),
(132, '30-04-2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 98, 'B 9148 UVX', '03:24', '', '900000', 0, '2025-07-03 03:24:59', '2025-07-03 03:24:59'),
(133, '30-04-2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 501, 'B 9192 UVV', '03:25', '', '980000', 0, '2025-07-03 03:26:42', '2025-07-03 03:26:42'),
(134, '30-04-2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 506, 'B 9197 UVV', '03:25', '', '980000', 0, '2025-07-03 03:26:42', '2025-07-03 03:26:42'),
(135, '30-04-2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 603, 'B 9597 UVV', '03:26', '', '980000', 0, '2025-07-03 03:26:42', '2025-07-03 03:26:42'),
(136, '30-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '03:27', '', '1050000', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(137, '30-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '03:27', '', '1050000', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(138, '30-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '03:27', '', '1050000', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(139, '30-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 702, 'B 9581 UVV', '03:27', '', '1050000', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(140, '30-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 704, 'B 9582 UVV', '03:27', '', '1050000', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(141, '30-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '03:27', '', '1050000', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(142, '30-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '03:27', '', '1050000', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(143, '29-04-2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 30, 'B 9462 UIT', '03:28', '', '1050000', 0, '2025-07-03 03:29:24', '2025-07-03 03:29:24'),
(144, '29-04-2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '03:28', '', '1050000', 0, '2025-07-03 03:29:24', '2025-07-03 03:29:24'),
(145, '29-04-2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 33, 'B 9756 UIU', '03:30', '', '900000', 0, '2025-07-03 03:30:36', '2025-07-03 03:30:36'),
(146, '29-04-2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 62, 'B 9137 UVX', '03:30', '', '900000', 0, '2025-07-03 03:30:36', '2025-07-03 03:30:36'),
(147, '29-04-2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 98, 'B 9148 UVX', '03:30', '', '900000', 0, '2025-07-03 03:30:36', '2025-07-03 03:30:36'),
(148, '29-04-2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 501, 'B 9192 UVV', '03:31', '', '980000', 0, '2025-07-03 03:31:40', '2025-07-03 03:31:40'),
(149, '29-04-2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 603, 'B 9597 UVV', '03:31', '', '980000', 0, '2025-07-03 03:31:40', '2025-07-03 03:31:40'),
(150, '29-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '03:31', '', '1050000', 0, '2025-07-03 03:32:06', '2025-07-03 03:32:06'),
(151, '29-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '03:31', '', '1050000', 0, '2025-07-03 03:32:06', '2025-07-03 03:32:06'),
(152, '29-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '03:31', '', '1050000', 0, '2025-07-03 03:32:06', '2025-07-03 03:32:06'),
(153, '29-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '03:32', '', '1050000', 0, '2025-07-03 03:32:06', '2025-07-03 03:32:06'),
(154, '28-04-2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 55, 'B 9118 UVX', '03:33', '', '900000', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(155, '28-04-2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 57, 'B 9103 UVX', '03:33', '', '900000', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(156, '28-04-2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 58, 'B 9110 UVX', '03:33', '', '900000', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(157, '28-04-2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 62, 'B 9137 UVX', '03:33', '', '900000', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(158, '28-04-2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 65, 'B 9165 UVX', '03:33', '', '900000', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(159, '28-04-2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 1077, 'B 9907 KIT', '03:33', '', '900000', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(160, '28-04-2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 506, 'B 9197 UVV', '03:34', '', '900000', 0, '2025-07-03 03:34:27', '2025-07-03 03:34:27'),
(161, '28-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '03:36', '', '1050000', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(162, '28-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '03:36', '', '1050000', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(163, '28-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 701, 'B 9590 UVV', '03:36', '', '1050000', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(164, '28-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '03:36', '', '1050000', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(165, '28-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '03:36', '', '1050000', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(166, '28-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '03:36', '', '1050000', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(167, '28-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '03:36', '', '1050000', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(168, '28-04-2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 702, 'B 9581 UVV', '03:37', '', '900000', 0, '2025-07-03 03:37:28', '2025-07-03 03:37:28'),
(169, '28-04-2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 704, 'B 9582 UVV', '03:37', '', '980000', 0, '2025-07-03 03:38:30', '2025-07-03 03:38:30'),
(170, '28-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '03:39', '', '1050000', 0, '2025-07-03 03:39:46', '2025-07-03 03:39:46'),
(171, '28-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '03:39', '', '1050000', 0, '2025-07-03 03:39:46', '2025-07-03 03:39:46'),
(172, '28-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '03:39', '', '1050000', 0, '2025-07-03 03:39:46', '2025-07-03 03:39:46'),
(173, '28-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '03:39', '', '1050000', 0, '2025-07-03 03:39:46', '2025-07-03 03:39:46'),
(174, '28-04-2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 905, '', '03:39', '', '900000', 0, '2025-07-03 03:40:06', '2025-07-03 03:40:06'),
(175, '27-04-2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 20, 'B 9508 UIU', '03:58', '', '1050000', 0, '2025-07-03 03:59:14', '2025-07-03 03:59:14'),
(176, '27-04-2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '03:58', '', '1050000', 0, '2025-07-03 03:59:14', '2025-07-03 03:59:14'),
(177, '27-04-2025', 4, 'M', 2, 'Kohod', 17, 'T. ABANG', 30, 'B 9462 UIT', '03:59', '', '700000', 0, '2025-07-03 03:59:30', '2025-07-03 03:59:30'),
(178, '27-04-2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 55, 'B 9118 UVX', '03:59', '', '900000', 0, '2025-07-03 04:00:59', '2025-07-03 04:00:59'),
(179, '27-04-2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 1077, 'B 9907 KIT', '04:00', '', '900000', 0, '2025-07-03 04:00:59', '2025-07-03 04:00:59'),
(180, '27-04-2025', 2, 'K', 2, 'Kohod', 9, 'C. BITUNG', 98, 'B 9148 UVX', '04:01', '', '980000', 0, '2025-07-03 04:01:44', '2025-07-03 04:01:44'),
(181, '27-04-2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 501, 'B 9192 UVV', '04:03', '', '900000', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(182, '27-04-2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 506, 'B 9197 UVV', '04:03', '', '900000', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(183, '27-04-2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 507, 'B 9189 UVV', '04:02', '', '900000', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(184, '27-04-2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 702, 'B 9581 UVV', '04:02', '', '900000', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(185, '27-04-2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 807, '', '04:02', '', '900000', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(186, '27-04-2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 905, '', '04:02', '', '900000', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(187, '27-04-2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 603, 'B 9597 UVV', '04:03', '', '980000', 0, '2025-07-03 04:04:09', '2025-07-03 04:04:09'),
(188, '27-04-2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 704, 'B 9582 UVV', '04:03', '', '980000', 0, '2025-07-03 04:04:09', '2025-07-03 04:04:09'),
(189, '27-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 605, 'B 9594 UVV', '04:06', '', '1050000', 0, '2025-07-03 04:06:19', '2025-07-03 04:06:19'),
(190, '27-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '04:06', '', '1050000', 0, '2025-07-03 04:06:19', '2025-07-03 04:06:19'),
(191, '27-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '04:06', '', '1050000', 0, '2025-07-03 04:06:19', '2025-07-03 04:06:19'),
(192, '27-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '04:06', '', '1050000', 0, '2025-07-03 04:06:19', '2025-07-03 04:06:19'),
(193, '27-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '04:06', '', '1050000', 0, '2025-07-03 04:06:19', '2025-07-03 04:06:19'),
(194, '26-04-2025', 4, 'M', 2, 'Kohod', 5, 'CIOMAS', 15, 'B 9442 UIU', '04:07', '', '1050000', 0, '2025-07-03 04:07:33', '2025-07-03 04:07:33'),
(195, '26-04-2025', 2, 'K', 2, 'Kohod', 9, 'C. BITUNG', 33, 'B 9756 UIU', '04:07', '', '980000', 0, '2025-07-03 04:09:21', '2025-07-03 04:09:21'),
(196, '26-04-2025', 2, 'K', 2, 'Kohod', 9, 'C. BITUNG', 57, 'B 9103 UVX', '04:08', '', '980000', 0, '2025-07-03 04:09:21', '2025-07-03 04:09:21'),
(197, '26-04-2025', 2, 'K', 2, 'Kohod', 9, 'C. BITUNG', 58, 'B 9110 UVX', '04:08', '', '980000', 0, '2025-07-03 04:09:21', '2025-07-03 04:09:21'),
(198, '26-04-2025', 2, 'K', 2, 'Kohod', 9, 'C. BITUNG', 86, 'B 9776 UIU', '04:09', '', '980000', 0, '2025-07-03 04:09:21', '2025-07-03 04:09:21'),
(199, '26-04-2025', 2, 'K', 2, 'Kohod', 9, 'C. BITUNG', 98, 'B 9148 UVX', '04:08', '', '980000', 0, '2025-07-03 04:09:21', '2025-07-03 04:09:21'),
(200, '26-04-2025', 2, 'K', 2, 'Kohod', 17, 'T. ABANG', 65, 'B 9165 UVX', '04:09', '', '700000', 0, '2025-07-03 04:09:57', '2025-07-03 04:09:57'),
(201, '26-04-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 93, 'B 9134 UVX', '04:10', '', '1050000', 0, '2025-07-03 04:10:27', '2025-07-03 04:10:27'),
(202, '26-04-2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 506, 'B 9197 UVV', '04:10', '', '900000', 0, '2025-07-03 04:12:27', '2025-07-03 04:12:27'),
(203, '26-04-2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 702, 'B 9581 UVV', '04:12', '', '900000', 0, '2025-07-03 04:12:27', '2025-07-03 04:12:27'),
(204, '26-04-2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 807, '', '04:12', '', '900000', 0, '2025-07-03 04:12:27', '2025-07-03 04:12:27'),
(205, '26-04-2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 507, 'B 9189 UVV', '04:13', '', '980000', 0, '2025-07-03 04:14:16', '2025-07-03 04:14:16'),
(206, '26-04-2025', 3, 'G', 2, 'Kohod', 9, 'C. BITUNG', 905, '', '04:13', '', '980000', 0, '2025-07-03 04:14:17', '2025-07-03 04:14:17'),
(207, '26-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 801, '', '04:15', '', '1050000', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(208, '26-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 803, '', '04:15', '', '1050000', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(209, '26-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '04:15', '', '1050000', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(210, '26-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '04:15', '', '1050000', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(211, '26-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '04:15', '', '1050000', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(212, '26-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '04:15', '', '1050000', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(213, '26-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '04:15', '', '1050000', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(214, '25-04-2025', 4, 'M', 2, 'Kohod', 17, 'T. ABANG', 20, 'B 9508 UIU', '04:16', '', '700000', 0, '2025-07-03 04:17:01', '2025-07-03 04:17:01'),
(215, '25-04-2025', 2, 'K', 2, 'Kohod', 15, 'MAJA', 55, 'B 9118 UVX', '04:33', '', '900000', 0, '2025-07-03 04:33:54', '2025-07-03 04:33:54'),
(216, '25-04-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 58, 'B 9110 UVX', '04:35', '', '1050000', 0, '2025-07-03 04:35:11', '2025-07-03 04:35:11'),
(217, '25-04-2025', 2, 'K', 2, 'Kohod', 5, 'CIOMAS', 86, 'B 9776 UIU', '04:35', '', '1050000', 0, '2025-07-03 04:35:11', '2025-07-03 04:35:11'),
(218, '25-04-2025', 2, 'K', 2, 'Kohod', 17, 'T. ABANG', 1077, 'B 9907 KIT', '04:35', '', '700000', 0, '2025-07-03 04:35:40', '2025-07-03 04:35:40'),
(219, '25-04-2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 501, 'B 9192 UVV', '04:36', '', '900000', 0, '2025-07-03 04:36:57', '2025-07-03 04:36:57'),
(220, '25-04-2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 701, 'B 9590 UVV', '04:36', '', '900000', 0, '2025-07-03 04:36:57', '2025-07-03 04:36:57'),
(221, '25-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 507, 'B 9189 UVV', '04:38', '', '1050000', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(222, '25-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 510, 'B 9190 UVV', '04:38', '', '1050000', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(223, '25-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 704, 'B 9582 UVV', '04:38', '', '1050000', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(224, '25-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 805, '', '04:37', '', '1050000', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(225, '25-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 807, '', '04:38', '', '1050000', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(226, '25-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 811, '', '04:38', '', '1050000', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(227, '25-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 901, '', '04:38', '', '1050000', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(228, '25-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 902, '', '04:38', '', '1050000', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(229, '25-04-2025', 3, 'G', 2, 'Kohod', 5, 'CIOMAS', 903, '', '04:38', '', '1050000', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(230, '25-04-2025', 3, 'G', 2, 'Kohod', 19, 'TUTUL', 603, 'B 9597 UVV', '04:39', '', '925000', 0, '2025-07-03 04:39:15', '2025-07-03 04:39:15'),
(231, '25-04-2025', 3, 'G', 2, 'Kohod', 15, 'MAJA', 605, 'B 9594 UVV', '04:39', '', '900000', 0, '2025-07-03 04:39:54', '2025-07-03 04:39:54');

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

--
-- Dumping data for table `tim_mgmt`
--

INSERT INTO `tim_mgmt` (`id`, `tim_id`, `nama_tim`, `driver_id`, `nama_supir`, `vehicle_id`, `no_pol`, `no_pintu`, `status_tim_mgmt`, `is_delete`, `created_at`, `updated_at`) VALUES
(3, 4, 'M', 41, 'Aco', 23, 'B 9447 UIU', '023', 'Non Aktif', 0, '2025-07-02 20:27:13', '2025-07-02 20:27:13'),
(4, 4, 'M', 54, 'Aep Alpiansyah (SUPI', 30, 'B 9462 UIT', '030', 'Aktif', 0, '2025-07-02 20:28:34', '2025-07-02 20:28:34'),
(5, 4, 'M', 53, 'Afrizal (SUPIR BARU)', 30, 'B 9462 UIT', '030', 'Non Aktif', 0, '2025-07-02 20:33:04', '2025-07-02 20:33:04'),
(6, 4, 'M', 50, 'Agas Wahyu Saputra', 28, 'B 9452 UIT', '028', 'Non Aktif', 0, '2025-07-02 20:58:48', '2025-07-02 20:58:48'),
(7, 4, 'M', 1, 'Ahmad Dani', 1, 'B 9056 UIU', '001', 'Non Aktif', 0, '2025-07-02 20:59:44', '2025-07-02 20:59:44'),
(8, 4, 'M', 45, 'AJI', 26, 'B 9381 UIT', '026', 'Non Aktif', 0, '2025-07-02 21:01:52', '2025-07-02 21:01:52'),
(9, 4, 'M', 16, 'Aldi Winata Ardana S', 12, 'B 9418 UIU', '012', 'Non Aktif', 0, '2025-07-02 21:02:58', '2025-07-02 21:02:58'),
(10, 4, 'M', 51, 'Aminudin', 29, 'B 9453 UIT', '029', 'Non Aktif', 0, '2025-07-02 21:03:37', '2025-07-02 21:03:37'),
(11, 4, 'M', 29, 'Andi Muhammad Anwar ', 19, 'B 9464 UIU', '019', 'Non Aktif', 0, '2025-07-02 21:07:39', '2025-07-02 21:07:39'),
(12, 4, 'M', 19, 'Fauzan Adim', 14, 'B 9420 UIT', '014', 'Non Aktif', 0, '2025-07-02 21:15:05', '2025-07-02 21:15:05'),
(13, 4, 'M', 14, 'Ghozi Dika Pratama', 10, 'B 9949 UIT', '010', 'Non Aktif', 0, '2025-07-02 21:15:42', '2025-07-02 21:15:42'),
(14, 4, 'M', 3, 'Imam Soib', 3, 'B 9061 UIU', '003', 'Non Aktif', 0, '2025-07-02 21:18:32', '2025-07-02 21:18:32'),
(15, 4, 'M', 32, 'Jaelani Kubil', 20, 'B 9508 UIU', '020', 'Aktif', 0, '2025-07-02 21:18:58', '2025-07-02 21:18:58'),
(16, 4, 'M', 8, 'Jajang', 7, 'B 9942 UIT', '007', 'Non Aktif', 0, '2025-07-02 21:19:29', '2025-07-02 21:19:29'),
(17, 4, 'M', 22, 'Karsa', 15, 'B 9442 UIU', '015', 'Aktif', 0, '2025-07-02 21:20:22', '2025-07-02 21:20:22'),
(18, 4, 'M', 47, 'Keke Zakariya', 27, 'B 9383 UIT', '027', 'Non Aktif', 0, '2025-07-02 21:20:49', '2025-07-02 21:20:49'),
(19, 4, 'M', 26, 'Khasan Hidayat', 18, 'B 9448 UIU', '018', 'Non Aktif', 0, '2025-07-02 21:21:09', '2025-07-02 21:21:09'),
(20, 4, 'M', 23, 'M Lutpi Aldiansyah', 16, 'B 9443 UIU', '016', 'Non Aktif', 0, '2025-07-02 21:21:45', '2025-07-02 21:21:45'),
(21, 4, 'M', 24, 'Mulyono', 17, 'B 9445 UIU', '017', 'Non Aktif', 0, '2025-07-02 21:37:24', '2025-07-02 21:37:24'),
(22, 4, 'M', 30, 'Nahromi', 19, 'B 9464 UIU', '019', 'Non Aktif', 0, '2025-07-02 21:37:58', '2025-07-02 21:37:58'),
(23, 4, 'M', 34, 'Nurmansyah ', 21, 'B 9441 UIU', '021', 'Non Aktif', 0, '2025-07-02 21:44:00', '2025-07-02 21:44:00'),
(24, 4, 'M', 36, 'Rohimin', 22, 'B 9446 UIU', '022', 'Non Aktif', 0, '2025-07-02 21:44:24', '2025-07-02 21:44:24'),
(25, 4, 'M', 18, 'Romdhoni', 13, 'B 9419 UIU', '013', 'Non Aktif', 0, '2025-07-02 21:44:44', '2025-07-02 21:44:44'),
(26, 4, 'M', 11, 'Sunarman Ginting', 8, 'B 9943 UIT', '008', 'Non Aktif', 0, '2025-07-02 21:44:57', '2025-07-02 21:44:57'),
(27, 4, 'M', 44, 'Warnen', 24, 'B 9472 UIU', '024', 'Non Aktif', 0, '2025-07-02 21:45:18', '2025-07-02 21:45:18'),
(28, 4, 'M', 4, 'Wawan (SEREP)', 5, 'B 9065 UIU', '005', 'Non Aktif', 0, '2025-07-02 21:45:35', '2025-07-02 21:45:35'),
(29, 2, 'K', 56, 'Didin Wahyuni', 32, 'B 9755 UIU', '032', 'Non Aktif', 0, '2025-07-02 21:48:22', '2025-07-02 21:48:22'),
(30, 2, 'K', 56, 'Riki Putra Cahya', 32, 'B 9755 UIU', '032', 'Non Aktif', 0, '2025-07-02 21:48:34', '2025-07-02 21:48:34'),
(31, 2, 'K', 58, 'Bambang Suteja', 32, 'B 9755 UIU', '032', 'Non Aktif', 0, '2025-07-02 21:49:37', '2025-07-02 21:49:37'),
(32, 2, 'K', 59, 'Dimas Faizal', 33, 'B 9756 UIU', '033', 'Non Aktif', 0, '2025-07-02 21:50:04', '2025-07-02 21:50:04'),
(33, 2, 'K', 60, 'Mohamad Rifai', 33, 'B 9756 UIU', '033', 'Non Aktif', 0, '2025-07-02 21:50:19', '2025-07-02 21:50:19'),
(34, 2, 'K', 61, 'Budi Stiyawan pindah', 94, 'B 9141 UVX', '094', 'Non Aktif', 0, '2025-07-02 21:51:28', '2025-07-02 21:51:28'),
(35, 2, 'K', 61, 'Budi Stiyawan pindah', 33, 'B 9756 UIU', '033', 'Aktif', 0, '2025-07-02 21:51:39', '2025-07-02 21:51:39'),
(36, 2, 'K', 62, 'David Rizki', 34, 'B 9758 UIU', '034', 'Non Aktif', 0, '2025-07-02 21:52:00', '2025-07-02 21:52:00'),
(37, 2, 'K', 63, 'Rohedi', 35, 'B 9773 UIU', '035', 'Non Aktif', 0, '2025-07-02 21:52:19', '2025-07-02 21:52:19'),
(38, 2, 'K', 64, 'Wisnu Muhammad', 51, 'B 9760 UIU', '051', 'Non Aktif', 0, '2025-07-02 21:52:35', '2025-07-02 21:52:35'),
(39, 2, 'K', 65, 'Nurdin', 52, 'B 9765 UIU', '052', 'Non Aktif', 0, '2025-07-02 21:52:56', '2025-07-02 21:52:56'),
(40, 2, 'K', 66, 'Muhamad Juber', 53, 'B 9766 UIU', '053', 'Non Aktif', 0, '2025-07-02 21:53:15', '2025-07-02 21:53:15'),
(41, 2, 'K', 67, 'Marta ', 31, 'B 9754 UIU', '031', 'Non Aktif', 0, '2025-07-02 21:54:02', '2025-07-02 21:54:02'),
(42, 2, 'K', 67, 'Marta ', 53, 'B 9766 UIU', '053', 'Non Aktif', 0, '2025-07-02 21:54:21', '2025-07-02 21:54:21'),
(43, 2, 'K', 69, 'Sugiarto', 55, 'B 9118 UVX', '055', 'Non Aktif', 0, '2025-07-02 21:54:45', '2025-07-02 21:54:45'),
(44, 2, 'K', 70, 'Supriyatna', 31, 'B 9118 UVX', '031', 'Non Aktif', 0, '2025-07-02 21:54:56', '2025-07-02 21:54:56'),
(45, 2, 'K', 70, 'Supriyatna', 55, 'B 9118 UVX', '055', 'Aktif', 0, '2025-07-02 21:57:09', '2025-07-02 21:57:09'),
(46, 2, 'K', 71, 'Suherman', 57, 'B 9103 UVX', '057', 'Non Aktif', 0, '2025-07-02 21:57:46', '2025-07-02 21:57:46'),
(47, 2, 'K', 72, 'Muhamd Juber (bawaan', 57, 'B 9103 UVX', '057', 'Aktif', 0, '2025-07-02 21:57:59', '2025-07-02 21:57:59'),
(48, 2, 'K', 73, 'Jumyati', 58, 'B 9110 UVX', '058', 'Aktif', 0, '2025-07-02 21:58:10', '2025-07-02 21:58:10'),
(49, 2, 'K', 74, 'Arif Hidayat', 59, 'B 9553 UVX', '059', 'Non Aktif', 0, '2025-07-02 21:59:01', '2025-07-02 21:59:01'),
(50, 2, 'K', 75, 'Rama Hidayat', 59, 'B 9553 UVX', '059', 'Non Aktif', 0, '2025-07-02 21:59:17', '2025-07-02 21:59:17'),
(51, 2, 'K', 76, 'Ernadi', 60, 'B 9600 UVX', '060', 'Non Aktif', 0, '2025-07-02 21:59:43', '2025-07-02 21:59:43'),
(52, 2, 'K', 77, 'Mulyadi', 62, 'B 9137 UVX', '062', 'Aktif', 0, '2025-07-02 22:00:02', '2025-07-02 22:00:02'),
(53, 2, 'K', 78, 'Muhamad Daelani', 63, 'B 9139 UVX', '063', 'Non Aktif', 0, '2025-07-02 22:00:24', '2025-07-02 22:00:24'),
(54, 2, 'K', 79, 'Hamami', 63, 'B 9139 UVX', '063', 'Non Aktif', 0, '2025-07-02 22:00:36', '2025-07-02 22:00:36'),
(55, 2, 'K', 80, 'Tedi', 64, 'B 9163 UVX', '064', 'Non Aktif', 0, '2025-07-02 22:00:49', '2025-07-02 22:00:49'),
(56, 2, 'K', 81, 'Wandi', 65, 'B 9165 UVX', '065', 'Non Aktif', 0, '2025-07-02 22:01:18', '2025-07-02 22:01:18'),
(57, 2, 'K', 82, 'Suhendi (SUPIR BARU)', 65, 'B 9165 UVX', '065', 'Non Aktif', 0, '2025-07-02 22:01:49', '2025-07-02 22:01:49'),
(58, 2, 'K', 83, 'Muhamad Satibi', 64, 'B 9163 UVX', '064', 'Non Aktif', 0, '2025-07-02 22:04:59', '2025-07-02 22:04:59'),
(59, 2, 'K', 83, 'Muhamad Satibi', 65, 'B 9165 UVX', '065', 'Aktif', 0, '2025-07-02 22:05:23', '2025-07-02 22:05:23'),
(60, 2, 'K', 84, 'Riki Rianto', 67, 'B 9675 UVX', '067', 'Non Aktif', 0, '2025-07-02 22:05:41', '2025-07-02 22:05:41'),
(61, 2, 'K', 85, 'Muhamad Halwaludin', 61, 'B 9136 UVX', '061', 'Non Aktif', 0, '2025-07-02 22:06:07', '2025-07-02 22:06:07'),
(62, 2, 'K', 86, 'Agung Awaludin', 68, 'B 9677 UVX', '068', 'Non Aktif', 0, '2025-07-02 22:08:06', '2025-07-02 22:08:06'),
(63, 2, 'K', 87, 'Arman Romi Wijaya', 59, 'B 9553 UVX', '059', 'Non Aktif', 0, '2025-07-02 22:08:22', '2025-07-02 22:08:22'),
(64, 2, 'K', 87, 'Arman Romi Wijaya', 85, 'B 9772 UIU', '085', 'Non Aktif', 0, '2025-07-02 22:08:35', '2025-07-02 22:08:35'),
(65, 2, 'K', 88, 'Misja (SERAP)', 70, 'B 9716 UVX', '070', 'Non Aktif', 0, '2025-07-02 22:09:33', '2025-07-02 22:09:33'),
(66, 2, 'K', 89, 'Ferdi', 70, 'B 9716 UVX', '070', 'Non Aktif', 0, '2025-07-02 22:09:46', '2025-07-02 22:09:46'),
(67, 2, 'K', 91, 'Dedi Mahardi', 1077, 'B 9907 KIT', '077', 'Aktif', 0, '2025-07-02 22:10:12', '2025-07-02 22:10:12'),
(68, 2, 'K', 92, 'Asep', 81, 'B 9761 UIU', '081', 'Non Aktif', 0, '2025-07-02 22:10:32', '2025-07-02 22:10:32'),
(69, 2, 'K', 94, 'Ma mur', 82, 'B 9762 UIU', '082', 'Non Aktif', 0, '2025-07-02 22:10:54', '2025-07-02 22:10:54'),
(70, 2, 'K', 95, 'Maman Firdaus (SERAP', 82, 'B 9762 UIU', '082', 'Non Aktif', 0, '2025-07-02 22:11:06', '2025-07-02 22:11:06'),
(71, 2, 'K', 96, 'Kiki Anggriana', 83, 'B 9767 UIU', '083', 'Non Aktif', 0, '2025-07-02 22:11:20', '2025-07-02 22:11:20'),
(72, 2, 'K', 97, 'Ari Silaban', 84, 'B 9768 UIU', '084', 'Non Aktif', 0, '2025-07-02 22:11:36', '2025-07-02 22:11:36'),
(73, 2, 'K', 98, 'Masud', 84, 'B 9768 UIU', '084', 'Non Aktif', 0, '2025-07-02 22:12:01', '2025-07-02 22:12:01'),
(74, 2, 'K', 99, 'Hendi', 85, 'B 9772 UIU', '085', 'Non Aktif', 0, '2025-07-02 22:12:23', '2025-07-02 22:12:23'),
(75, 2, 'K', 100, 'Rizal Wiguna', 86, 'B 9776 UIU', '086', 'Non Aktif', 0, '2025-07-02 22:12:35', '2025-07-02 22:12:35'),
(76, 2, 'K', 101, 'Nurul Falah', 86, 'B 9776 UIU', '086', 'Non Aktif', 0, '2025-07-02 22:12:48', '2025-07-02 22:12:48'),
(77, 2, 'K', 102, 'Andi ', 56, 'B 9127 UVX', '056', 'Non Aktif', 0, '2025-07-02 22:13:04', '2025-07-02 22:13:04'),
(78, 2, 'K', 102, 'Andi ', 86, 'B 9776 UIU', '086', 'Aktif', 0, '2025-07-02 22:13:22', '2025-07-02 22:13:22'),
(79, 2, 'K', 103, 'Abdul Mutholib', 87, 'B 9779 UIU', '087', 'Non Aktif', 0, '2025-07-02 22:13:37', '2025-07-02 22:13:37'),
(80, 2, 'K', 104, 'Ega Novianto', 87, 'B 9779 UIU', '087', 'Non Aktif', 0, '2025-07-02 22:14:09', '2025-07-02 22:14:09'),
(81, 2, 'K', 105, 'Fahri Maulida Diya U', 91, 'B 9117 UVX', '091', 'Non Aktif', 0, '2025-07-02 22:14:25', '2025-07-02 22:14:25'),
(82, 2, 'K', 106, 'Dana (SUPIR BARU)', 91, 'B 9117 UVX', '091', 'Non Aktif', 0, '2025-07-02 22:14:37', '2025-07-02 22:14:37'),
(83, 2, 'K', 107, 'Adi Wahyudi (Serep)', 91, 'B 9117 UVX', '091', 'Non Aktif', 0, '2025-07-02 22:14:53', '2025-07-02 22:14:53'),
(84, 2, 'K', 108, 'Aris', 92, 'B 9131 UVX', '092', 'Non Aktif', 0, '2025-07-02 22:15:13', '2025-07-02 22:15:13'),
(85, 2, 'K', 109, 'Agus Sopandi', 93, 'B 9134 UVX', '093', 'Aktif', 0, '2025-07-02 22:15:24', '2025-07-02 22:15:24'),
(86, 2, 'K', 110, 'Opik Baedillah', 95, 'B 9142 UVX', '095', 'Non Aktif', 0, '2025-07-02 22:15:38', '2025-07-02 22:15:38'),
(87, 2, 'K', 111, 'Riki', 95, 'B 9142 UVX', '095', 'Non Aktif', 0, '2025-07-02 22:15:53', '2025-07-02 22:15:53'),
(88, 2, 'K', 115, 'Arsani', 96, 'B 9143 UVX', '096', 'Non Aktif', 0, '2025-07-02 22:17:25', '2025-07-02 22:17:25'),
(89, 2, 'K', 116, 'Dede Jimi', 97, 'B 9145 UVX', '097', 'Non Aktif', 0, '2025-07-02 22:17:38', '2025-07-02 22:17:38'),
(90, 2, 'K', 117, 'Rokih Saputra', 97, 'B 9145 UVX', '097', 'Non Aktif', 0, '2025-07-02 22:17:52', '2025-07-02 22:17:52'),
(91, 2, 'K', 118, 'Sudiono', 98, 'B 9148 UVX', '098', 'Non Aktif', 0, '2025-07-02 22:18:06', '2025-07-02 22:18:06'),
(92, 2, 'K', 119, 'Aryani', 69, 'B 9681 UVX', '069', 'Non Aktif', 0, '2025-07-02 22:18:18', '2025-07-02 22:18:18'),
(93, 2, 'K', 119, 'Aryani', 98, 'B 9148 UVX', '098', 'Aktif', 0, '2025-07-02 22:18:29', '2025-07-02 22:18:29'),
(94, 2, 'K', 150, 'Ahmad', 99, 'B 9149 UVX', '099', 'Non Aktif', 0, '2025-07-02 22:19:21', '2025-07-02 22:19:21'),
(95, 2, 'K', 121, 'Suryadi', 99, 'B 9149 UVX', '099', 'Non Aktif', 0, '2025-07-02 22:19:36', '2025-07-02 22:19:36'),
(96, 3, 'G', 122, 'ADI SURYADI', 101, 'B 9665 UVW', '101', 'Non Aktif', 0, '2025-07-02 22:22:37', '2025-07-02 22:22:37'),
(97, 3, 'G', 125, 'ABAS ', 102, 'B 9671 UVW', '102', 'Non Aktif', 0, '2025-07-02 23:07:22', '2025-07-02 23:07:22'),
(98, 3, 'G', 126, 'HERI YANTO SIDABALOK', 103, 'B 9670 UVW', '103', 'Non Aktif', 0, '2025-07-02 23:07:35', '2025-07-02 23:07:35'),
(99, 3, 'G', 129, 'HENDRA WIJAYA ', 105, 'B 9668 UVW', '105', 'Non Aktif', 0, '2025-07-02 23:07:53', '2025-07-02 23:07:53'),
(100, 3, 'G', 132, 'ENDI SUHENDI', 201, 'B 9121 UVV', '201', 'Non Aktif', 0, '2025-07-02 23:08:11', '2025-07-02 23:08:11'),
(101, 3, 'G', 133, 'IWAN ', 201, 'B 9121 UVV', '201', 'Non Aktif', 0, '2025-07-02 23:08:34', '2025-07-02 23:08:34'),
(102, 3, 'G', 137, 'Sigit Yulias Setiawa', 202, 'B 9123 UVV', '202', 'Non Aktif', 0, '2025-07-02 23:08:49', '2025-07-02 23:08:49'),
(103, 3, 'G', 139, 'Ardiansyah', 203, 'B 9124 UVV', '203', 'Non Aktif', 0, '2025-07-02 23:09:00', '2025-07-02 23:09:00'),
(104, 3, 'G', 141, 'M. HERDIYANA', 204, 'B 9120 UVV', '204', 'Non Aktif', 0, '2025-07-02 23:09:13', '2025-07-02 23:09:13'),
(105, 3, 'G', 146, 'HANIK', 205, 'B 9122 UVV', '205', 'Non Aktif', 0, '2025-07-02 23:09:32', '2025-07-02 23:09:32'),
(106, 3, 'G', 148, 'Anda Suhanda', 301, 'B 9089 UVV', '301', 'Non Aktif', 0, '2025-07-02 23:09:51', '2025-07-02 23:09:51'),
(107, 3, 'G', 151, 'AHMAD', 302, 'B 9091 UVV', '302', 'Non Aktif', 0, '2025-07-02 23:10:07', '2025-07-02 23:10:07'),
(108, 3, 'G', 154, 'DJAENUDIN', 303, 'B 9093 UVV', '303', 'Non Aktif', 0, '2025-07-02 23:10:21', '2025-07-02 23:10:21'),
(109, 3, 'G', 156, 'PANGI', 304, 'B 9092 UVV', '304', 'Non Aktif', 0, '2025-07-02 23:10:33', '2025-07-02 23:10:33'),
(110, 3, 'G', 159, 'ROPIYUDIN', 305, 'B 9094 UVV', '305', 'Non Aktif', 0, '2025-07-02 23:10:50', '2025-07-02 23:10:50'),
(111, 3, 'G', 162, 'samsudin', 501, 'B 9192 UVV', '501', 'Aktif', 0, '2025-07-02 23:11:05', '2025-07-02 23:11:05'),
(112, 3, 'G', 163, 'nasrul', 502, 'B 9193 UVV', '502', 'Non Aktif', 0, '2025-07-02 23:11:16', '2025-07-02 23:11:16'),
(113, 3, 'G', 164, 'Jaja', 505, 'B 9196 UVV', '505', 'Non Aktif', 0, '2025-07-02 23:11:30', '2025-07-02 23:11:30'),
(114, 3, 'G', 166, 'JULKIFLI PURBA', 504, 'B 9195 UVV', '504', 'Non Aktif', 0, '2025-07-02 23:11:41', '2025-07-02 23:11:41'),
(115, 3, 'G', 167, 'Beni Andika', 203, 'B 9124 UVV', '203', 'Non Aktif', 0, '2025-07-02 23:12:08', '2025-07-02 23:12:08'),
(116, 3, 'G', 167, 'Beni Andika', 505, 'B 9196 UVV', '505', 'Non Aktif', 0, '2025-07-02 23:12:21', '2025-07-02 23:12:21'),
(117, 3, 'G', 168, 'Redi Saputra', 502, 'B 9193 UVV', '502', 'Non Aktif', 0, '2025-07-02 23:12:53', '2025-07-02 23:12:53'),
(118, 3, 'G', 168, 'Redi Saputra', 505, 'B 9196 UVV', '505', 'Non Aktif', 0, '2025-07-02 23:13:03', '2025-07-02 23:13:03'),
(119, 3, 'G', 170, 'Sigit Muhajirin', 506, 'B 9197 UVV', '506', 'Aktif', 0, '2025-07-02 23:13:18', '2025-07-02 23:13:18'),
(120, 3, 'G', 171, 'Muslim', 507, 'B 9189 UVV', '507', 'Non Aktif', 0, '2025-07-02 23:13:31', '2025-07-02 23:13:31'),
(121, 3, 'G', 172, 'Udin', 302, 'B 9091 UVV', '302', 'Non Aktif', 0, '2025-07-02 23:13:48', '2025-07-02 23:13:48'),
(122, 3, 'G', 172, 'Udin', 507, 'B 9189 UVV', '507', 'Aktif', 0, '2025-07-02 23:13:58', '2025-07-02 23:13:58'),
(123, 3, 'G', 173, 'LANDI', 508, 'B 9188 UVV', '508', 'Non Aktif', 0, '2025-07-02 23:14:13', '2025-07-02 23:14:13'),
(124, 3, 'G', 175, 'SENDI MAULANA', 509, 'B 9187 UVV', '509', 'Non Aktif', 0, '2025-07-02 23:14:24', '2025-07-02 23:14:24'),
(125, 3, 'G', 178, 'Dien Pradesa', 510, 'B 9190 UVV', '510', 'Aktif', 0, '2025-07-02 23:14:38', '2025-07-02 23:14:38'),
(126, 3, 'G', 179, 'ROYAN KUSTIWA', 601, 'B 9593 UVV', '601', 'Non Aktif', 0, '2025-07-02 23:14:50', '2025-07-02 23:14:50'),
(127, 3, 'G', 181, 'SAEPUL NURJAMAN', 101, 'B 9665 UVW', '101', 'Non Aktif', 0, '2025-07-02 23:15:04', '2025-07-02 23:15:04'),
(128, 3, 'G', 181, 'SAEPUL NURJAMAN', 602, 'B 9592 UVV', '602', 'Non Aktif', 0, '2025-07-02 23:15:14', '2025-07-02 23:15:14'),
(129, 3, 'G', 185, 'Hari Bahtiar', 603, 'B 9597 UVV', '603', 'Non Aktif', 0, '2025-07-02 23:15:30', '2025-07-02 23:15:30'),
(130, 3, 'G', 186, 'Abdul Wahid', 103, 'B 9670 UVW', '103', 'Non Aktif', 0, '2025-07-02 23:15:43', '2025-07-02 23:15:43'),
(131, 3, 'G', 186, 'Abdul Wahid', 603, 'B 9597 UVV', '603', 'Aktif', 0, '2025-07-02 23:15:52', '2025-07-02 23:15:52'),
(132, 3, 'G', 187, 'Bayu Pratama', 604, 'B 9591 UVV', '604', 'Non Aktif', 0, '2025-07-02 23:16:03', '2025-07-02 23:16:03'),
(133, 3, 'G', 189, 'Diki Wahyudi', 102, 'B 9671 UVW', '102', 'Non Aktif', 0, '2025-07-02 23:16:26', '2025-07-02 23:16:26'),
(134, 3, 'G', 189, 'Diki Wahyudi', 605, 'B 9594 UVV', '605', 'Non Aktif', 0, '2025-07-02 23:16:41', '2025-07-02 23:16:41'),
(135, 3, 'G', 192, 'WANDI ANWAR WAHYUDI', 102, 'B 9671 UVW', '102', 'Non Aktif', 0, '2025-07-02 23:17:16', '2025-07-02 23:17:16'),
(136, 3, 'G', 192, 'WANDI ANWAR WAHYUDI', 703, 'B 9596 UVV', '703', 'Non Aktif', 0, '2025-07-02 23:17:31', '2025-07-02 23:17:31'),
(137, 3, 'G', 192, 'WANDI ANWAR WAHYUDI', 605, 'B 9594 UVV', '605', 'Aktif', 0, '2025-07-02 23:17:43', '2025-07-02 23:17:43'),
(138, 3, 'G', 193, 'Richo Jhonatan I', 501, 'B 9192 UVV', '501', 'Non Aktif', 0, '2025-07-02 23:17:55', '2025-07-02 23:17:55'),
(139, 3, 'G', 193, 'Richo Jhonatan I', 701, 'B 9590 UVV', '701', 'Aktif', 0, '2025-07-02 23:18:07', '2025-07-02 23:18:07'),
(140, 3, 'G', 15, 'Angga', 302, 'B 9091 UVV', '302', 'Non Aktif', 0, '2025-07-02 23:18:31', '2025-07-02 23:18:31'),
(141, 3, 'G', 15, 'Angga', 702, 'B 9581 UVV', '702', 'Non Aktif', 0, '2025-07-02 23:18:44', '2025-07-02 23:18:44'),
(142, 3, 'G', 195, 'Eky Apriliyana', 510, 'B 9190 UVV', '510', 'Non Aktif', 0, '2025-07-02 23:18:58', '2025-07-02 23:18:58'),
(143, 3, 'G', 195, 'Eky Apriliyana', 808, '', '808', 'Non Aktif', 0, '2025-07-02 23:19:11', '2025-07-02 23:19:11'),
(144, 3, 'G', 195, 'Eky Apriliyana', 702, 'B 9581 UVV', '702', 'Aktif', 0, '2025-07-02 23:19:21', '2025-07-02 23:19:21'),
(145, 3, 'G', 196, 'EGI ADITYA', 703, 'B 9596 UVV', '703', 'Non Aktif', 0, '2025-07-02 23:19:35', '2025-07-02 23:19:35'),
(146, 3, 'G', 197, 'Sanja', 202, 'B 9123 UVV', '202', 'Non Aktif', 0, '2025-07-02 23:19:48', '2025-07-02 23:19:48'),
(147, 3, 'G', 197, 'Sanja', 703, 'B 9596 UVV', '703', 'Non Aktif', 0, '2025-07-02 23:20:05', '2025-07-02 23:20:05'),
(148, 3, 'G', 199, 'Abdul Halim', 205, 'B 9122 UVV', '205', 'Non Aktif', 0, '2025-07-02 23:20:19', '2025-07-02 23:20:19'),
(149, 3, 'G', 199, 'Abdul Halim', 704, 'B 9582 UVV', '704', 'Aktif', 0, '2025-07-02 23:20:31', '2025-07-02 23:20:31'),
(150, 3, 'G', 200, 'Riski', 508, 'B 9188 UVV', '508', 'Non Aktif', 0, '2025-07-02 23:20:47', '2025-07-02 23:20:47'),
(151, 3, 'G', 200, 'Riski', 706, 'B 9580 UVV', '706', 'Non Aktif', 0, '2025-07-02 23:21:03', '2025-07-02 23:21:03'),
(152, 3, 'G', 202, 'Warsono', 304, 'B 9092 UVV', '304', 'Non Aktif', 0, '2025-07-02 23:21:19', '2025-07-02 23:21:19'),
(153, 3, 'G', 202, 'Warsono', 801, '', '801', 'Aktif', 0, '2025-07-02 23:21:34', '2025-07-02 23:21:34'),
(154, 3, 'G', 203, 'Dandi Saputra', 502, 'B 9193 UVV', '502', 'Non Aktif', 0, '2025-07-02 23:21:47', '2025-07-02 23:21:47'),
(155, 3, 'G', 203, 'Dandi Saputra', 802, '', '802', 'Non Aktif', 0, '2025-07-02 23:22:01', '2025-07-02 23:22:01'),
(156, 3, 'G', 205, 'Sarman', 103, 'B 9670 UVW', '103', 'Non Aktif', 0, '2025-07-02 23:22:19', '2025-07-02 23:22:19'),
(157, 3, 'G', 205, 'Sarman', 803, '', '803', 'Aktif', 0, '2025-07-02 23:22:32', '2025-07-02 23:22:32'),
(158, 3, 'G', 206, 'Aris Aerudin', 509, 'B 9187 UVV', '509', 'Non Aktif', 0, '2025-07-02 23:22:47', '2025-07-02 23:22:47'),
(159, 3, 'G', 206, 'Aris Aerudin', 805, '', '805', 'Aktif', 0, '2025-07-02 23:22:57', '2025-07-02 23:22:57'),
(160, 3, 'G', 207, 'Rijal Saepulloh', 506, 'B 9197 UVV', '506', 'Non Aktif', 0, '2025-07-02 23:23:10', '2025-07-02 23:23:10'),
(161, 3, 'G', 207, 'Rijal Saepulloh', 806, '', '806', 'Non Aktif', 0, '2025-07-02 23:23:21', '2025-07-02 23:23:21'),
(162, 3, 'G', 209, 'Eki Supriyadi', 508, 'B 9188 UVV', '508', 'Non Aktif', 0, '2025-07-02 23:23:37', '2025-07-02 23:23:37'),
(163, 3, 'G', 209, 'Eki Supriyadi', 807, '', '807', 'Aktif', 0, '2025-07-02 23:23:50', '2025-07-02 23:23:50'),
(164, 3, 'G', 210, 'Akin', 303, 'B 9093 UVV', '303', 'Non Aktif', 0, '2025-07-02 23:24:08', '2025-07-02 23:24:08'),
(165, 3, 'G', 210, 'Akin', 303, 'B 9093 UVV', '303', 'Non Aktif', 0, '2025-07-02 23:24:21', '2025-07-02 23:24:21'),
(166, 3, 'G', 210, 'Akin', 808, '', '808', 'Non Aktif', 0, '2025-07-02 23:24:32', '2025-07-02 23:24:32'),
(167, 3, 'G', 211, 'Heriyono', 201, 'B 9121 UVV', '201', 'Non Aktif', 0, '2025-07-02 23:24:44', '2025-07-02 23:24:44'),
(168, 3, 'G', 211, 'Heriyono', 809, '', '809', 'Non Aktif', 0, '2025-07-02 23:24:57', '2025-07-02 23:24:57'),
(169, 3, 'G', 213, 'Mubin', 301, 'B 9089 UVV', '301', 'Non Aktif', 0, '2025-07-02 23:25:14', '2025-07-02 23:25:14'),
(170, 3, 'G', 214, 'Amiludin', 507, 'B 9189 UVV', '507', 'Non Aktif', 0, '2025-07-02 23:28:34', '2025-07-02 23:28:34'),
(171, 3, 'G', 214, 'Amiludin', 811, '', '811', 'Non Aktif', 0, '2025-07-02 23:28:47', '2025-07-02 23:28:47'),
(172, 3, 'G', 215, 'RISANDI DEPRI', 101, 'B 9665 UVW', '101', 'Non Aktif', 0, '2025-07-02 23:29:05', '2025-07-02 23:29:05'),
(173, 3, 'G', 215, 'RISANDI DEPRI', 811, '', '811', 'Non Aktif', 0, '2025-07-02 23:29:17', '2025-07-02 23:29:17'),
(174, 3, 'G', 216, 'Djumadi', 105, 'B 9668 UVW', '105', 'Non Aktif', 0, '2025-07-02 23:29:33', '2025-07-02 23:29:33'),
(175, 3, 'G', 216, 'Djumadi', 503, 'B 9194 UVV', '503', 'Non Aktif', 0, '2025-07-02 23:29:47', '2025-07-02 23:29:47'),
(176, 3, 'G', 216, 'Djumadi', 811, '', '811', 'Aktif', 0, '2025-07-02 23:30:00', '2025-07-02 23:30:00'),
(177, 3, 'G', 217, 'Ridwan', 305, 'B 9094 UVV', '305', 'Non Aktif', 0, '2025-07-02 23:30:20', '2025-07-02 23:30:20'),
(178, 3, 'G', 217, 'Ridwan', 501, 'B 9192 UVV', '501', 'Non Aktif', 0, '2025-07-02 23:30:38', '2025-07-02 23:30:38'),
(179, 3, 'G', 217, 'Ridwan', 901, '', '901', 'Aktif', 0, '2025-07-02 23:30:49', '2025-07-02 23:30:49'),
(180, 3, 'G', 218, 'Hasan', 203, 'B 9124 UVV', '203', 'Non Aktif', 0, '2025-07-02 23:31:06', '2025-07-02 23:31:06'),
(181, 3, 'G', 218, 'Hasan', 902, '', '902', 'Aktif', 0, '2025-07-02 23:31:22', '2025-07-02 23:31:22'),
(182, 3, 'G', 219, 'Sapriyadi', 903, '', '903', 'Aktif', 0, '2025-07-02 23:31:34', '2025-07-02 23:31:34'),
(183, 3, 'G', 220, 'Cecep', 302, 'B 9091 UVV', '302', 'Non Aktif', 0, '2025-07-02 23:31:52', '2025-07-02 23:31:52'),
(184, 3, 'G', 220, 'Cecep', 905, '', '905', 'Aktif', 0, '2025-07-02 23:32:03', '2025-07-02 23:32:03');

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
(12, 1, 13, '1100000', 'Aktif', 0, '2025-06-29 22:17:01', '2025-06-29 22:17:01'),
(13, 2, 14, '650000', 'Aktif', 0, '2025-07-03 03:13:45', '2025-07-03 03:13:45'),
(14, 2, 15, '900000', 'Aktif', 0, '2025-07-03 03:13:59', '2025-07-03 03:13:59'),
(15, 2, 16, '900000', 'Aktif', 0, '2025-07-03 03:14:13', '2025-07-03 03:14:13'),
(16, 2, 17, '700000', 'Aktif', 0, '2025-07-03 03:14:47', '2025-07-03 03:14:47'),
(17, 2, 19, '925000', 'Aktif', 0, '2025-07-03 03:15:01', '2025-07-03 03:15:01'),
(18, 2, 20, '800000', 'Aktif', 0, '2025-07-03 03:15:17', '2025-07-03 03:15:17'),
(19, 2, 21, '900000', 'Aktif', 0, '2025-07-03 03:15:39', '2025-07-03 03:15:39'),
(20, 2, 22, '900000', 'Aktif', 0, '2025-07-03 03:15:51', '2025-07-03 03:15:51'),
(21, 2, 23, '750000', 'Aktif', 0, '2025-07-03 03:16:03', '2025-07-03 03:16:03');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`, `is_delete`) VALUES
(1, '127.0.0.1', 'admin@admin.com', '$2y$10$nU8GqgqEBLob7JjbI8nr1.BCqi3ukuX1CVQtesYLeO.hvBPFXThru', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1751463821, 1, 'Administrator', '.', 'IUWASH PLUS', '021', 0),
(2, '116.254.102.1', 'febriansyah@gmail.com', '$2y$10$WD51BcoApR2tqkhp/4/qjuewsj.pUvS85ycoGI4wJvYBfU128xTjy', NULL, 'febriansyah@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1560495919, 1707792449, 1, 'FPP', '.', 'Konsultan', '+6289654654045', 0),
(3, '127.0.0.1', 'user01@user.com', '$2y$10$agyyRErh9zTimzQ59sVwxu3dnlFCsCRfYS0UPmxcd6hEkQ6NJOcPi', NULL, 'user01@user.com', NULL, '2655b30c346dd9773967fc18ad46c36ee1efc69a', NULL, NULL, NULL, NULL, NULL, 1552496928, 1643560394, 1, 'User', '01', NULL, '021', 0);

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
  `no_pintu` varchar(5) NOT NULL,
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
(1, NULL, 'B 9056 UIU', '001', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-07-02 21:24:30'),
(2, NULL, 'B 9057 UIU', '002', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(3, NULL, 'B 9061 UIU', '003', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(4, NULL, 'B 9063 UVX', '004', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(5, NULL, 'B 9065 UIU', '005', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(6, NULL, 'B 9941 UIT', '006', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(7, NULL, 'B 9942 UIT', '007', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(8, NULL, 'B 9943 UIT', '008', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(9, NULL, 'B 9947 UIT', '009', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(10, NULL, 'B 9949 UIT', '010', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(11, NULL, 'B 9417 UIU', '011', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(12, NULL, 'B 9418 UIU', '012', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(13, NULL, 'B 9419 UIU', '013', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(14, NULL, 'B 9420 UIT', '014', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(15, NULL, 'B 9442 UIU', '015', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(16, NULL, 'B 9443 UIU', '016', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(17, NULL, 'B 9445 UIU', '017', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(18, NULL, 'B 9448 UIU', '018', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(19, NULL, 'B 9464 UIU', '019', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(20, NULL, 'B 9508 UIU', '020', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(21, NULL, 'B 9441 UIU', '021', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(22, NULL, 'B 9446 UIU', '022', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(23, NULL, 'B 9447 UIU', '023', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(24, NULL, 'B 9472 UIU', '024', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(25, NULL, 'B 9473 UIU', '025', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(26, NULL, 'B 9381 UIT', '026', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(27, NULL, 'B 9383 UIT', '027', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(28, NULL, 'B 9452 UIT', '028', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(29, NULL, 'B 9453 UIT', '029', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(30, NULL, 'B 9462 UIT', '030', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(31, NULL, 'B 9754 UIU', '031', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(32, NULL, 'B 9755 UIU', '032', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(33, NULL, 'B 9756 UIU', '033', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(34, NULL, 'B 9758 UIU', '034', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(35, NULL, 'B 9773 UIU', '035', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(51, NULL, 'B 9760 UIU', '051', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(52, NULL, 'B 9765 UIU', '052', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(53, NULL, 'B 9766 UIU', '053', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(55, NULL, 'B 9118 UVX', '055', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(56, NULL, 'B 9127 UVX', '056', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(57, NULL, 'B 9103 UVX', '057', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(58, NULL, 'B 9110 UVX', '058', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(59, NULL, 'B 9553 UVX', '059', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(60, NULL, 'B 9600 UVX', '060', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(61, NULL, 'B 9136 UVX', '061', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(62, NULL, 'B 9137 UVX', '062', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(63, NULL, 'B 9139 UVX', '063', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(64, NULL, 'B 9163 UVX', '064', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(65, NULL, 'B 9165 UVX', '065', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(67, NULL, 'B 9675 UVX', '067', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(68, NULL, 'B 9677 UVX', '068', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(69, NULL, 'B 9681 UVX', '069', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(70, NULL, 'B 9716 UVX', '070', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(81, NULL, 'B 9761 UIU', '081', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(82, NULL, 'B 9762 UIU', '082', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(83, NULL, 'B 9767 UIU', '083', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(84, NULL, 'B 9768 UIU', '084', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(85, NULL, 'B 9772 UIU', '085', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(86, NULL, 'B 9776 UIU', '086', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(87, NULL, 'B 9779 UIU', '087', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(91, NULL, 'B 9117 UVX', '091', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(92, NULL, 'B 9131 UVX', '092', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(93, NULL, 'B 9134 UVX', '093', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(94, NULL, 'B 9141 UVX', '094', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(95, NULL, 'B 9142 UVX', '095', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(96, NULL, 'B 9143 UVX', '096', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(97, NULL, 'B 9145 UVX', '097', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(98, NULL, 'B 9148 UVX', '098', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(99, NULL, 'B 9149 UVX', '099', 'FM 260 JD', 'HIJAU', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(101, NULL, 'B 9665 UVW', '101', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(102, NULL, 'B 9671 UVW', '102', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(103, NULL, 'B 9670 UVW', '103', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(104, NULL, 'B 9667 UVW', '104', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(105, NULL, 'B 9668 UVW', '105', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(201, NULL, 'B 9121 UVV', '201', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(202, NULL, 'B 9123 UVV', '202', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(203, NULL, 'B 9124 UVV', '203', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(204, NULL, 'B 9120 UVV', '204', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(205, NULL, 'B 9122 UVV', '205', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(301, NULL, 'B 9089 UVV', '301', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(302, NULL, 'B 9091 UVV', '302', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(303, NULL, 'B 9093 UVV', '303', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(304, NULL, 'B 9092 UVV', '304', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(305, NULL, 'B 9094 UVV', '305', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(501, NULL, 'B 9192 UVV', '501', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(502, NULL, 'B 9193 UVV', '502', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(503, NULL, 'B 9194 UVV', '503', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(504, NULL, 'B 9195 UVV', '504', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(505, NULL, 'B 9196 UVV', '505', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(506, NULL, 'B 9197 UVV', '506', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(507, NULL, 'B 9189 UVV', '507', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(508, NULL, 'B 9188 UVV', '508', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(509, NULL, 'B 9187 UVV', '509', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(510, NULL, 'B 9190 UVV', '510', 'GIGA FVZ N', 'PUTIH', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(601, NULL, 'B 9593 UVV', '601', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(602, NULL, 'B 9592 UVV', '602', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(603, NULL, 'B 9597 UVV', '603', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(604, NULL, 'B 9591 UVV', '604', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(605, NULL, 'B 9594 UVV', '605', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(701, NULL, 'B 9590 UVV', '701', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(702, NULL, 'B 9581 UVV', '702', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(703, NULL, 'B 9596 UVV', '703', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(704, NULL, 'B 9582 UVV', '704', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(705, NULL, 'B 9580 UVV', '705', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(706, NULL, 'B 9580 UVV', '706', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(801, NULL, '', '801', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(802, NULL, '', '802', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(803, NULL, '', '803', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(805, NULL, '', '805', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(806, NULL, '', '806', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(807, NULL, '', '807', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(808, NULL, '', '808', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(809, NULL, '', '809', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(810, NULL, '', '810', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(811, NULL, '', '811', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(901, NULL, '', '901', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(902, NULL, '', '902', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(903, NULL, '', '903', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(905, NULL, '', '905', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41'),
(1077, NULL, 'B 9907 KIT', '077', '', '', 'Aktif', 0, '2025-06-29 03:00:08', '2025-06-29 03:01:41');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_documents`
--

CREATE TABLE `vehicle_documents` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `doc_type` varchar(50) DEFAULT NULL,
  `doc_number` varchar(100) DEFAULT NULL,
  `expiry_date` varchar(10) DEFAULT NULL,
  `file_url` text DEFAULT NULL,
  `status` enum('Aktif','Non Aktif') DEFAULT NULL,
  `is_delete` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle_documents`
--

INSERT INTO `vehicle_documents` (`id`, `vehicle_id`, `doc_type`, `doc_number`, `expiry_date`, `file_url`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1077, 'STNK', '1234567890', '12-12-2026', NULL, 'Aktif', 0, '2025-07-02 15:12:42', '2025-07-02 15:12:42');

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

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `driver_id`, `balance`, `status_wallet`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(2, 2, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(3, 3, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(4, 4, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(5, 5, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(6, 6, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(7, 7, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(8, 8, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(9, 9, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(10, 10, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(11, 11, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(12, 12, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(13, 13, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(14, 14, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(15, 15, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(16, 16, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(17, 17, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(18, 18, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(19, 19, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(20, 20, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(21, 21, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(22, 22, 120000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:07:33'),
(23, 23, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(24, 24, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(25, 25, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(26, 26, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(27, 27, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(28, 28, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(29, 29, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(30, 30, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(31, 31, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(32, 32, 180000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:17:01'),
(33, 33, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(34, 34, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(35, 35, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(36, 36, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(37, 37, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(38, 38, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(39, 39, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(40, 40, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(41, 41, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(42, 42, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(43, 43, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(44, 44, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(45, 45, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(46, 46, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(47, 47, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(48, 48, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(49, 49, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(50, 50, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(51, 51, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(52, 52, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(53, 53, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(54, 54, 120000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 03:59:30'),
(55, 55, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(56, 56, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(57, 57, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(58, 58, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(59, 59, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(60, 60, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(61, 61, 180000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:09:21'),
(62, 62, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(63, 63, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(64, 64, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(65, 65, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(66, 66, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(67, 67, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(68, 68, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(69, 69, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(70, 70, 390000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:33:54'),
(71, 71, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(72, 72, 210000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:09:21'),
(73, 73, 150000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:35:11'),
(74, 74, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(75, 75, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(76, 76, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(77, 77, 240000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 03:33:35'),
(78, 78, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(79, 79, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(80, 80, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(81, 81, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(82, 82, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(83, 83, 120000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:09:57'),
(84, 84, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(85, 85, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(86, 86, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(87, 87, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(88, 88, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(89, 89, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(90, 90, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(91, 91, 180000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:35:40'),
(92, 92, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(93, 93, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(94, 94, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(95, 95, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(96, 96, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(97, 97, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(98, 98, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(99, 99, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(100, 100, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(101, 101, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(102, 102, 180000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:35:11'),
(103, 103, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(104, 104, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(105, 105, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(106, 106, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(107, 107, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(108, 108, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(109, 109, 120000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:10:27'),
(110, 110, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(111, 111, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(112, 112, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(113, 113, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(114, 114, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(115, 115, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(116, 116, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(117, 117, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(118, 118, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(119, 119, 240000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:09:21'),
(120, 120, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(121, 121, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(122, 122, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(123, 123, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(124, 124, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(125, 125, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(126, 126, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(127, 127, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(128, 128, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(129, 129, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(130, 130, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(131, 131, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(132, 132, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(133, 133, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(134, 134, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(135, 135, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(136, 136, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(137, 137, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(138, 138, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(139, 139, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(140, 140, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(141, 141, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(142, 142, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(143, 143, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(144, 144, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(145, 145, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(146, 146, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(147, 147, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(148, 148, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(149, 149, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(150, 150, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(151, 151, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(152, 152, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(153, 153, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(154, 154, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(155, 155, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(156, 156, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(157, 157, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(158, 158, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(159, 159, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(160, 160, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(161, 161, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(162, 162, 150000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:36:57'),
(163, 163, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(164, 164, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(165, 165, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(166, 166, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(167, 167, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(168, 168, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(169, 169, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(170, 170, 210000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:12:27'),
(171, 171, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(172, 172, 240000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:38:38'),
(173, 173, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(174, 174, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(175, 175, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(176, 176, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(177, 177, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(178, 178, 330000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:38:38'),
(179, 179, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(180, 180, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(181, 181, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(182, 182, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(183, 183, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(184, 184, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(185, 185, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(186, 186, 120000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:39:15'),
(187, 187, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(188, 188, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(189, 189, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(190, 190, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(191, 191, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(192, 192, 60000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:39:54'),
(193, 193, 330000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:36:57'),
(194, 194, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(195, 195, 270000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:12:27'),
(196, 196, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(197, 197, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(198, 198, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(199, 199, 210000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:38:38'),
(200, 200, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(201, 201, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(202, 202, 330000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:16:07'),
(203, 203, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(204, 204, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(205, 205, 300000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:16:07'),
(206, 206, 300000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:38:38'),
(207, 207, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(208, 208, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(209, 209, 210000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:38:38'),
(210, 210, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(211, 211, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(212, 212, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(213, 213, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(214, 214, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(215, 215, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(216, 216, 360000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:38:38'),
(217, 217, 210000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:38:38'),
(218, 218, 270000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:38:38'),
(219, 219, 240000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:38:38'),
(220, 220, 300000, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-03 04:14:17');

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
(1, 1, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(2, 2, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(3, 3, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(4, 4, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(5, 5, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(6, 6, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(7, 7, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(8, 8, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(9, 9, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(10, 10, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(11, 11, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(12, 12, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(13, 13, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(14, 14, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(15, 15, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(16, 16, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(17, 17, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(18, 18, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(19, 19, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(20, 20, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(21, 21, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(22, 22, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(23, 23, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(24, 24, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(25, 25, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(26, 26, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(27, 27, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(28, 28, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(29, 29, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(30, 30, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(31, 31, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(32, 32, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(33, 33, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(34, 34, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(35, 35, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(36, 36, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(37, 37, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(38, 38, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(39, 39, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(40, 40, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(41, 41, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(42, 42, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(43, 43, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(44, 44, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(45, 45, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(46, 46, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(47, 47, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(48, 48, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(49, 49, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(50, 50, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(51, 51, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(52, 52, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(53, 53, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(54, 54, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(55, 55, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(56, 56, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(57, 57, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(58, 58, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(59, 59, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(60, 60, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(61, 61, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(62, 62, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(63, 63, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(64, 64, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(65, 65, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(66, 66, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(67, 67, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(68, 68, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(69, 69, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(70, 70, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(71, 71, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(72, 72, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(73, 73, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(74, 74, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(75, 75, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(76, 76, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(77, 77, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(78, 78, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(79, 79, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(80, 80, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(81, 81, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(82, 82, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(83, 83, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(84, 84, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(85, 85, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(86, 86, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(87, 87, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(88, 88, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(89, 89, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(90, 90, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(91, 91, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(92, 92, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(93, 93, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(94, 94, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(95, 95, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(96, 96, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(97, 97, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(98, 98, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(99, 99, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(100, 100, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(101, 101, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(102, 102, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(103, 103, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(104, 104, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(105, 105, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(106, 106, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(107, 107, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(108, 108, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(109, 109, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(110, 110, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(111, 111, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(112, 112, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(113, 113, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(114, 114, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(115, 115, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(116, 116, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(117, 117, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(118, 118, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(119, 119, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(120, 120, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(121, 121, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(122, 122, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(123, 123, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(124, 124, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(125, 125, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(126, 126, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(127, 127, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(128, 128, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(129, 129, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(130, 130, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(131, 131, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(132, 132, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(133, 133, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(134, 134, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(135, 135, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(136, 136, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(137, 137, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(138, 138, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(139, 139, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(140, 140, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(141, 141, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(142, 142, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(143, 143, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(144, 144, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(145, 145, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(146, 146, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(147, 147, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(148, 148, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(149, 149, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(150, 150, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(151, 151, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(152, 152, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(153, 153, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(154, 154, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(155, 155, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(156, 156, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(157, 157, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(158, 158, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(159, 159, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(160, 160, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(161, 161, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(162, 162, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(163, 163, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(164, 164, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(165, 165, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(166, 166, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(167, 167, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(168, 168, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(169, 169, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(170, 170, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(171, 171, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(172, 172, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(173, 173, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(174, 174, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(175, 175, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(176, 176, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(177, 177, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(178, 178, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(179, 179, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(180, 180, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(181, 181, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(182, 182, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(183, 183, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(184, 184, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(185, 185, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(186, 186, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(187, 187, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(188, 188, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(189, 189, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(190, 190, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(191, 191, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(192, 192, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(193, 193, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(194, 194, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(195, 195, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(196, 196, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(197, 197, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(198, 198, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(199, 199, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(200, 200, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(201, 201, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(202, 202, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(203, 203, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(204, 204, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(205, 205, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(206, 206, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(207, 207, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(208, 208, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(209, 209, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(210, 210, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(211, 211, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(212, 212, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(213, 213, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(214, 214, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(215, 215, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(216, 216, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(217, 217, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(218, 218, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(219, 219, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(220, 220, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(221, 77, 'credit', 30000, 3, 'Tabungan DO -', 'belum', 0, '2025-07-02 23:33:18', '2025-07-02 23:33:18'),
(222, 77, 'debit', 980000, 3, 'Uang Jalan DO -', 'belum', 0, '2025-07-02 23:33:18', '2025-07-02 23:33:18'),
(223, 162, 'credit', 30000, 4, 'Tabungan DO -', 'belum', 0, '2025-07-02 23:50:43', '2025-07-02 23:50:43'),
(224, 162, 'debit', 1050000, 4, 'Uang Jalan DO -', 'belum', 0, '2025-07-02 23:50:43', '2025-07-02 23:50:43'),
(225, 220, 'credit', 30000, 5, 'Tabungan DO -', 'belum', 0, '2025-07-02 23:50:43', '2025-07-02 23:50:43'),
(226, 220, 'debit', 1050000, 5, 'Uang Jalan DO -', 'belum', 0, '2025-07-02 23:50:43', '2025-07-02 23:50:43'),
(227, 70, 'credit', 30000, 6, 'Tabungan DO -', 'belum', 0, '2025-07-02 23:52:32', '2025-07-02 23:52:32'),
(228, 70, 'debit', 1050000, 6, 'Uang Jalan DO -', 'belum', 0, '2025-07-02 23:52:32', '2025-07-02 23:52:32'),
(229, 109, 'credit', 30000, 7, 'Tabungan DO -', 'belum', 0, '2025-07-02 23:57:49', '2025-07-02 23:57:49'),
(230, 109, 'debit', 890000, 7, 'Uang Jalan DO -', 'belum', 0, '2025-07-02 23:57:49', '2025-07-02 23:57:49'),
(231, 178, 'credit', 30000, 8, 'Tabungan DO -', 'belum', 0, '2025-07-02 23:58:32', '2025-07-02 23:58:32'),
(232, 178, 'debit', 900000, 8, 'Uang Jalan DO -', 'belum', 0, '2025-07-02 23:58:32', '2025-07-02 23:58:32'),
(233, 206, 'credit', 30000, 9, 'Tabungan DO -', 'belum', 0, '2025-07-02 23:58:53', '2025-07-02 23:58:53'),
(234, 206, 'debit', 890000, 9, 'Uang Jalan DO -', 'belum', 0, '2025-07-02 23:58:53', '2025-07-02 23:58:53'),
(235, 70, 'credit', 30000, 10, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:04:02', '2025-07-03 00:04:02'),
(236, 70, 'debit', 890000, 10, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:04:02', '2025-07-03 00:04:02'),
(237, 77, 'credit', 30000, 11, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:04:02', '2025-07-03 00:04:02'),
(238, 77, 'debit', 890000, 11, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:04:02', '2025-07-03 00:04:02'),
(239, 83, 'credit', 30000, 12, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:04:02', '2025-07-03 00:04:02'),
(240, 83, 'debit', 890000, 12, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:04:02', '2025-07-03 00:04:02'),
(241, 170, 'credit', 30000, 13, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(242, 170, 'debit', 900000, 13, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(243, 172, 'credit', 30000, 14, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(244, 172, 'debit', 900000, 14, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(245, 193, 'credit', 30000, 15, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(246, 193, 'debit', 900000, 15, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(247, 195, 'credit', 30000, 16, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(248, 195, 'debit', 900000, 16, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(249, 206, 'credit', 30000, 17, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(250, 206, 'debit', 900000, 17, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(251, 218, 'credit', 30000, 18, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(252, 218, 'debit', 900000, 18, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(253, 220, 'credit', 30000, 19, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(254, 220, 'debit', 900000, 19, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:05:30', '2025-07-03 00:05:30'),
(255, 54, 'credit', 30000, 20, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:06:26', '2025-07-03 00:06:26'),
(256, 54, 'debit', 890000, 20, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:06:26', '2025-07-03 00:06:26'),
(257, 73, 'credit', 30000, 21, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:07:22', '2025-07-03 00:07:22'),
(258, 73, 'debit', 890000, 21, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:07:22', '2025-07-03 00:07:22'),
(259, 109, 'credit', 30000, 22, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:07:22', '2025-07-03 00:07:22'),
(260, 109, 'debit', 890000, 22, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:07:22', '2025-07-03 00:07:22'),
(261, 119, 'credit', 30000, 23, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:07:22', '2025-07-03 00:07:22'),
(262, 119, 'debit', 890000, 23, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:07:22', '2025-07-03 00:07:22'),
(263, 217, 'credit', 30000, 24, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:08:56', '2025-07-03 00:08:56'),
(264, 217, 'debit', 1100000, 24, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:08:56', '2025-07-03 00:08:56'),
(265, 32, 'credit', 30000, 25, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:09:37', '2025-07-03 00:09:37'),
(266, 32, 'debit', 1100000, 25, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:09:37', '2025-07-03 00:09:37'),
(267, 70, 'credit', 30000, 26, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:11:10', '2025-07-03 00:11:10'),
(268, 70, 'debit', 1050000, 26, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:11:10', '2025-07-03 00:11:10'),
(269, 77, 'credit', 30000, 27, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:11:10', '2025-07-03 00:11:10'),
(270, 77, 'debit', 1050000, 27, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:11:10', '2025-07-03 00:11:10'),
(271, 91, 'credit', 30000, 28, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:11:10', '2025-07-03 00:11:10'),
(272, 91, 'debit', 1050000, 28, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:11:10', '2025-07-03 00:11:10'),
(273, 172, 'credit', 30000, 29, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(274, 172, 'debit', 1050000, 29, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(275, 178, 'credit', 30000, 30, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(276, 178, 'debit', 1050000, 30, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(277, 195, 'credit', 30000, 31, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(278, 195, 'debit', 1050000, 31, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(279, 199, 'credit', 30000, 32, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(280, 199, 'debit', 1050000, 32, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(281, 206, 'credit', 30000, 33, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(282, 206, 'debit', 1050000, 33, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(283, 209, 'credit', 30000, 34, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(284, 209, 'debit', 1050000, 34, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(285, 216, 'credit', 30000, 35, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(286, 216, 'debit', 1050000, 35, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(287, 218, 'credit', 30000, 36, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(288, 218, 'debit', 1050000, 36, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(289, 219, 'credit', 30000, 37, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(290, 219, 'debit', 1050000, 37, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(291, 220, 'credit', 30000, 38, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(292, 220, 'debit', 1050000, 38, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:13:04', '2025-07-03 00:13:04'),
(293, 61, 'credit', 30000, 39, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:15:18', '2025-07-03 00:15:18'),
(294, 61, 'debit', 1100000, 39, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:15:18', '2025-07-03 00:15:18'),
(295, 73, 'credit', 30000, 40, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:17:04', '2025-07-03 00:17:04'),
(296, 73, 'debit', 1050000, 40, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:17:04', '2025-07-03 00:17:04'),
(297, 102, 'credit', 30000, 41, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:17:04', '2025-07-03 00:17:04'),
(298, 102, 'debit', 1050000, 41, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:17:04', '2025-07-03 00:17:04'),
(299, 109, 'credit', 30000, 42, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:17:04', '2025-07-03 00:17:04'),
(300, 109, 'debit', 1050000, 42, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:17:04', '2025-07-03 00:17:04'),
(301, 119, 'credit', 30000, 43, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:17:04', '2025-07-03 00:17:04'),
(302, 119, 'debit', 1050000, 43, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:17:04', '2025-07-03 00:17:04'),
(303, 172, 'credit', 30000, 44, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(304, 172, 'debit', 1050000, 44, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(305, 193, 'credit', 30000, 45, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(306, 193, 'debit', 1050000, 45, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(307, 195, 'credit', 30000, 46, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(308, 195, 'debit', 1050000, 46, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(309, 199, 'credit', 30000, 47, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(310, 199, 'debit', 1050000, 47, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(311, 202, 'credit', 30000, 48, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(312, 202, 'debit', 1050000, 48, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(313, 205, 'credit', 30000, 49, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(314, 205, 'debit', 1050000, 49, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(315, 206, 'credit', 30000, 50, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(316, 206, 'debit', 1050000, 50, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(317, 209, 'credit', 30000, 51, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(318, 209, 'debit', 1050000, 51, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(319, 218, 'credit', 30000, 52, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(320, 218, 'debit', 1050000, 52, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(321, 220, 'credit', 30000, 53, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(322, 220, 'debit', 1050000, 53, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:18:56', '2025-07-03 00:18:56'),
(323, 54, 'credit', 30000, 54, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:19:58', '2025-07-03 00:19:58'),
(324, 54, 'debit', 1050000, 54, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:19:58', '2025-07-03 00:19:58'),
(325, 70, 'credit', 30000, 55, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:21:26', '2025-07-03 00:21:26'),
(326, 70, 'debit', 1050000, 55, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:21:26', '2025-07-03 00:21:26'),
(327, 178, 'credit', 30000, 56, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:29:12', '2025-07-03 00:29:12'),
(328, 178, 'debit', 1050000, 56, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:29:12', '2025-07-03 00:29:12'),
(329, 216, 'credit', 30000, 57, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:29:12', '2025-07-03 00:29:12'),
(330, 216, 'debit', 1050000, 57, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:29:12', '2025-07-03 00:29:12'),
(331, 217, 'credit', 30000, 58, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:29:12', '2025-07-03 00:29:12'),
(332, 217, 'debit', 1050000, 58, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:29:12', '2025-07-03 00:29:12'),
(333, 219, 'credit', 30000, 59, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:29:12', '2025-07-03 00:29:12'),
(334, 219, 'debit', 1050000, 59, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:29:12', '2025-07-03 00:29:12'),
(335, 72, 'credit', 30000, 60, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:34:13', '2025-07-03 00:34:13'),
(336, 72, 'debit', 1050000, 60, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:34:13', '2025-07-03 00:34:13'),
(337, 91, 'credit', 30000, 61, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:34:13', '2025-07-03 00:34:13'),
(338, 91, 'debit', 1050000, 61, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:34:13', '2025-07-03 00:34:13'),
(339, 70, 'credit', 30000, 62, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:35:54', '2025-07-03 00:35:54'),
(340, 70, 'debit', 900000, 62, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:35:54', '2025-07-03 00:35:54'),
(341, 77, 'credit', 30000, 63, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:35:54', '2025-07-03 00:35:54'),
(342, 77, 'debit', 900000, 63, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:35:54', '2025-07-03 00:35:54'),
(343, 102, 'credit', 30000, 64, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:35:54', '2025-07-03 00:35:54'),
(344, 102, 'debit', 900000, 64, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:35:54', '2025-07-03 00:35:54'),
(345, 119, 'credit', 30000, 65, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:35:54', '2025-07-03 00:35:54'),
(346, 119, 'debit', 900000, 65, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:35:54', '2025-07-03 00:35:54'),
(347, 170, 'credit', 30000, 66, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(348, 170, 'debit', 900000, 66, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(349, 178, 'credit', 30000, 67, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(350, 178, 'debit', 900000, 67, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(351, 193, 'credit', 30000, 68, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(352, 193, 'debit', 900000, 68, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(353, 195, 'credit', 30000, 69, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(354, 195, 'debit', 900000, 69, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(355, 202, 'credit', 30000, 70, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(356, 202, 'debit', 900000, 70, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(357, 205, 'credit', 30000, 71, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(358, 205, 'debit', 900000, 71, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(359, 216, 'credit', 30000, 72, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(360, 216, 'debit', 900000, 72, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(361, 219, 'credit', 30000, 73, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(362, 219, 'debit', 900000, 73, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:38:04', '2025-07-03 00:38:04'),
(363, 70, 'credit', 30000, 74, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:41:01', '2025-07-03 00:41:01'),
(364, 70, 'debit', 900000, 74, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:41:01', '2025-07-03 00:41:01'),
(365, 178, 'credit', 30000, 75, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(366, 178, 'debit', 900000, 75, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(367, 193, 'credit', 30000, 76, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(368, 193, 'debit', 900000, 76, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(369, 202, 'credit', 30000, 77, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(370, 202, 'debit', 900000, 77, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(371, 205, 'credit', 30000, 78, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(372, 205, 'debit', 900000, 78, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(373, 206, 'credit', 30000, 79, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(374, 206, 'debit', 900000, 79, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(375, 209, 'credit', 30000, 80, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(376, 209, 'debit', 900000, 80, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(377, 216, 'credit', 30000, 81, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(378, 216, 'debit', 900000, 81, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:42:18', '2025-07-03 00:42:18'),
(379, 61, 'credit', 30000, 82, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:43:56', '2025-07-03 00:43:56'),
(380, 61, 'debit', 900000, 82, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:43:56', '2025-07-03 00:43:56'),
(381, 70, 'credit', 30000, 83, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:43:56', '2025-07-03 00:43:56'),
(382, 70, 'debit', 900000, 83, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:43:56', '2025-07-03 00:43:56'),
(383, 72, 'credit', 30000, 84, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:43:56', '2025-07-03 00:43:56'),
(384, 72, 'debit', 900000, 84, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:43:56', '2025-07-03 00:43:56'),
(385, 193, 'credit', 30000, 85, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:45:21', '2025-07-03 00:45:21'),
(386, 193, 'debit', 1050000, 85, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:45:21', '2025-07-03 00:45:21'),
(387, 202, 'credit', 30000, 86, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:45:21', '2025-07-03 00:45:21'),
(388, 202, 'debit', 1050000, 86, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:45:21', '2025-07-03 00:45:21'),
(389, 205, 'credit', 30000, 87, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:45:21', '2025-07-03 00:45:21'),
(390, 205, 'debit', 1050000, 87, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:45:21', '2025-07-03 00:45:21'),
(391, 219, 'credit', 30000, 88, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:45:21', '2025-07-03 00:45:21'),
(392, 219, 'debit', 1050000, 88, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:45:21', '2025-07-03 00:45:21'),
(393, 195, 'credit', 30000, 89, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:45:33', '2025-07-03 00:45:33'),
(394, 195, 'debit', 900000, 89, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:45:33', '2025-07-03 00:45:33'),
(395, 32, 'credit', 30000, 90, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:54:25', '2025-07-03 00:54:25'),
(396, 32, 'debit', 1050000, 90, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:54:25', '2025-07-03 00:54:25'),
(397, 178, 'credit', 30000, 91, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:56:02', '2025-07-03 00:56:02'),
(398, 178, 'debit', 1100000, 91, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:56:02', '2025-07-03 00:56:02'),
(399, 202, 'credit', 30000, 92, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:56:02', '2025-07-03 00:56:02'),
(400, 202, 'debit', 1100000, 92, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:56:02', '2025-07-03 00:56:02'),
(401, 205, 'credit', 30000, 93, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:56:02', '2025-07-03 00:56:02'),
(402, 205, 'debit', 1100000, 93, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:56:02', '2025-07-03 00:56:02'),
(403, 216, 'credit', 30000, 94, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:56:02', '2025-07-03 00:56:02'),
(404, 216, 'debit', 1100000, 94, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:56:02', '2025-07-03 00:56:02'),
(405, 220, 'credit', 30000, 95, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:56:02', '2025-07-03 00:56:02'),
(406, 220, 'debit', 1100000, 95, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:56:02', '2025-07-03 00:56:02'),
(407, 193, 'credit', 30000, 96, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:56:14', '2025-07-03 00:56:14'),
(408, 193, 'debit', 1050000, 96, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:56:14', '2025-07-03 00:56:14'),
(409, 102, 'credit', 30000, 97, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:57:27', '2025-07-03 00:57:27'),
(410, 102, 'debit', 1050000, 97, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:57:27', '2025-07-03 00:57:27'),
(411, 119, 'credit', 30000, 98, 'Tabungan DO -', 'belum', 0, '2025-07-03 00:57:27', '2025-07-03 00:57:27'),
(412, 119, 'debit', 890000, 98, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 00:57:27', '2025-07-03 00:57:27'),
(413, 61, 'credit', 30000, 99, 'Tabungan DO -', 'belum', 0, '2025-07-03 01:02:21', '2025-07-03 01:02:21'),
(414, 61, 'debit', 1050000, 99, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 01:02:21', '2025-07-03 01:02:21'),
(415, 70, 'credit', 30000, 100, 'Tabungan DO -', 'belum', 0, '2025-07-03 01:02:21', '2025-07-03 01:02:21'),
(416, 70, 'debit', 1050000, 100, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 01:02:21', '2025-07-03 01:02:21'),
(417, 72, 'credit', 30000, 101, 'Tabungan DO -', 'belum', 0, '2025-07-03 01:02:21', '2025-07-03 01:02:21'),
(418, 72, 'debit', 1050000, 101, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 01:02:21', '2025-07-03 01:02:21'),
(419, 77, 'credit', 30000, 102, 'Tabungan DO -', 'belum', 0, '2025-07-03 01:02:21', '2025-07-03 01:02:21'),
(420, 77, 'debit', 1050000, 102, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 01:02:21', '2025-07-03 01:02:21'),
(421, 102, 'credit', 30000, 103, 'Tabungan DO -', 'belum', 0, '2025-07-03 01:02:21', '2025-07-03 01:02:21'),
(422, 102, 'debit', 1100000, 103, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 01:02:21', '2025-07-03 01:02:21'),
(423, 178, 'credit', 30000, 104, 'Tabungan DO -', 'belum', 0, '2025-07-03 01:04:49', '2025-07-03 01:04:49'),
(424, 178, 'debit', 1100000, 104, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 01:04:49', '2025-07-03 01:04:49'),
(425, 193, 'credit', 30000, 105, 'Tabungan DO -', 'belum', 0, '2025-07-03 01:05:56', '2025-07-03 01:05:56'),
(426, 193, 'debit', 1050000, 105, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 01:05:56', '2025-07-03 01:05:56'),
(427, 202, 'credit', 30000, 106, 'Tabungan DO -', 'belum', 0, '2025-07-03 01:06:49', '2025-07-03 01:06:49'),
(428, 202, 'debit', 1100000, 106, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 01:06:49', '2025-07-03 01:06:49'),
(429, 205, 'credit', 30000, 107, 'Tabungan DO -', 'belum', 0, '2025-07-03 01:06:49', '2025-07-03 01:06:49'),
(430, 205, 'debit', 1100000, 107, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 01:06:49', '2025-07-03 01:06:49'),
(431, 216, 'credit', 30000, 108, 'Tabungan DO -', 'belum', 0, '2025-07-03 01:06:49', '2025-07-03 01:06:49'),
(432, 216, 'debit', 1100000, 108, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 01:06:49', '2025-07-03 01:06:49'),
(433, 218, 'credit', 30000, 109, 'Tabungan DO -', 'belum', 0, '2025-07-03 01:06:49', '2025-07-03 01:06:49'),
(434, 218, 'debit', 1100000, 109, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 01:06:49', '2025-07-03 01:06:49'),
(435, 220, 'credit', 30000, 110, 'Tabungan DO -', 'belum', 0, '2025-07-03 01:06:49', '2025-07-03 01:06:49'),
(436, 220, 'debit', 1100000, 110, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 01:06:49', '2025-07-03 01:06:49'),
(437, 32, 'credit', 30000, 111, 'Tabungan DO -', 'belum', 0, '2025-07-03 02:54:52', '2025-07-03 02:54:52'),
(438, 32, 'debit', 1100000, 111, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 02:54:52', '2025-07-03 02:54:52'),
(439, 70, 'credit', 30000, 112, 'Tabungan DO -', 'belum', 0, '2025-07-03 02:55:56', '2025-07-03 02:55:56'),
(440, 70, 'debit', 1050000, 112, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 02:55:56', '2025-07-03 02:55:56'),
(441, 72, 'credit', 30000, 113, 'Tabungan DO -', 'belum', 0, '2025-07-03 02:55:56', '2025-07-03 02:55:56'),
(442, 72, 'debit', 1050000, 113, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 02:55:56', '2025-07-03 02:55:56'),
(443, 83, 'credit', 30000, 114, 'Tabungan DO -', 'belum', 0, '2025-07-03 02:55:56', '2025-07-03 02:55:56'),
(444, 83, 'debit', 1050000, 114, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 02:55:56', '2025-07-03 02:55:56'),
(445, 170, 'credit', 30000, 115, 'Tabungan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(446, 170, 'debit', 1100000, 115, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(447, 178, 'credit', 30000, 116, 'Tabungan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(448, 178, 'debit', 1100000, 116, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(449, 199, 'credit', 30000, 117, 'Tabungan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(450, 199, 'debit', 1100000, 117, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(451, 202, 'credit', 30000, 118, 'Tabungan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(452, 202, 'debit', 1100000, 118, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(453, 216, 'credit', 30000, 119, 'Tabungan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(454, 216, 'debit', 1100000, 119, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(455, 217, 'credit', 30000, 120, 'Tabungan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(456, 217, 'debit', 1100000, 120, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(457, 218, 'credit', 30000, 121, 'Tabungan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(458, 218, 'debit', 1100000, 121, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(459, 220, 'credit', 30000, 122, 'Tabungan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(460, 220, 'debit', 1100000, 122, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 02:59:27', '2025-07-03 02:59:27'),
(461, 193, 'credit', 30000, 123, 'Tabungan DO -', 'belum', 0, '2025-07-03 02:59:51', '2025-07-03 02:59:51'),
(462, 193, 'debit', 1050000, 123, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 02:59:51', '2025-07-03 02:59:51'),
(463, 205, 'credit', 30000, 124, 'Tabungan DO -', 'belum', 0, '2025-07-03 02:59:51', '2025-07-03 02:59:51'),
(464, 205, 'debit', 1050000, 124, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 02:59:51', '2025-07-03 02:59:51'),
(465, 32, 'credit', 30000, 125, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:18:46', '2025-07-03 03:18:46'),
(466, 32, 'debit', 1050000, 125, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:18:46', '2025-07-03 03:18:46'),
(467, 22, 'credit', 30000, 126, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:18:46', '2025-07-03 03:18:46'),
(468, 22, 'debit', 1050000, 126, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:18:46', '2025-07-03 03:18:46'),
(469, 61, 'credit', 30000, 127, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:23:17', '2025-07-03 03:23:17'),
(470, 61, 'debit', 900000, 127, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:23:17', '2025-07-03 03:23:17'),
(471, 70, 'credit', 30000, 128, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:24:13', '2025-07-03 03:24:13'),
(472, 70, 'debit', 1050000, 128, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:24:13', '2025-07-03 03:24:13'),
(473, 72, 'credit', 30000, 129, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:24:13', '2025-07-03 03:24:13'),
(474, 72, 'debit', 1050000, 129, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:24:13', '2025-07-03 03:24:13'),
(475, 77, 'credit', 30000, 130, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:24:13', '2025-07-03 03:24:13'),
(476, 77, 'debit', 1050000, 130, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:24:13', '2025-07-03 03:24:13'),
(477, 91, 'credit', 30000, 131, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:24:59', '2025-07-03 03:24:59');
INSERT INTO `wallet_transactions` (`id`, `wallet_id`, `transaction_type`, `amount`, `id_ritasi`, `description`, `status`, `is_delete`, `created_at`, `updated_at`) VALUES
(478, 91, 'debit', 900000, 131, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:24:59', '2025-07-03 03:24:59'),
(479, 119, 'credit', 30000, 132, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:24:59', '2025-07-03 03:24:59'),
(480, 119, 'debit', 900000, 132, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:24:59', '2025-07-03 03:24:59'),
(481, 162, 'credit', 30000, 133, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:26:42', '2025-07-03 03:26:42'),
(482, 162, 'debit', 980000, 133, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:26:42', '2025-07-03 03:26:42'),
(483, 170, 'credit', 30000, 134, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:26:42', '2025-07-03 03:26:42'),
(484, 170, 'debit', 980000, 134, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:26:42', '2025-07-03 03:26:42'),
(485, 186, 'credit', 30000, 135, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:26:42', '2025-07-03 03:26:42'),
(486, 186, 'debit', 980000, 135, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:26:42', '2025-07-03 03:26:42'),
(487, 172, 'credit', 30000, 136, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(488, 172, 'debit', 1050000, 136, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(489, 178, 'credit', 30000, 137, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(490, 178, 'debit', 1050000, 137, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(491, 193, 'credit', 30000, 138, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(492, 193, 'debit', 1050000, 138, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(493, 195, 'credit', 30000, 139, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(494, 195, 'debit', 1050000, 139, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(495, 199, 'credit', 30000, 140, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(496, 199, 'debit', 1050000, 140, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(497, 202, 'credit', 30000, 141, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(498, 202, 'debit', 1050000, 141, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(499, 206, 'credit', 30000, 142, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(500, 206, 'debit', 1050000, 142, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:28:07', '2025-07-03 03:28:07'),
(501, 54, 'credit', 30000, 143, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:29:24', '2025-07-03 03:29:24'),
(502, 54, 'debit', 1050000, 143, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:29:24', '2025-07-03 03:29:24'),
(503, 22, 'credit', 30000, 144, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:29:24', '2025-07-03 03:29:24'),
(504, 22, 'debit', 1050000, 144, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:29:24', '2025-07-03 03:29:24'),
(505, 61, 'credit', 30000, 145, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:30:36', '2025-07-03 03:30:36'),
(506, 61, 'debit', 900000, 145, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:30:36', '2025-07-03 03:30:36'),
(507, 77, 'credit', 30000, 146, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:30:36', '2025-07-03 03:30:36'),
(508, 77, 'debit', 900000, 146, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:30:36', '2025-07-03 03:30:36'),
(509, 119, 'credit', 30000, 147, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:30:36', '2025-07-03 03:30:36'),
(510, 119, 'debit', 900000, 147, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:30:36', '2025-07-03 03:30:36'),
(511, 162, 'credit', 30000, 148, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:31:40', '2025-07-03 03:31:40'),
(512, 162, 'debit', 980000, 148, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:31:40', '2025-07-03 03:31:40'),
(513, 186, 'credit', 30000, 149, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:31:40', '2025-07-03 03:31:40'),
(514, 186, 'debit', 980000, 149, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:31:40', '2025-07-03 03:31:40'),
(515, 206, 'credit', 30000, 150, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:32:06', '2025-07-03 03:32:06'),
(516, 206, 'debit', 1050000, 150, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:32:06', '2025-07-03 03:32:06'),
(517, 216, 'credit', 30000, 151, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:32:06', '2025-07-03 03:32:06'),
(518, 216, 'debit', 1050000, 151, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:32:06', '2025-07-03 03:32:06'),
(519, 217, 'credit', 30000, 152, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:32:06', '2025-07-03 03:32:06'),
(520, 217, 'debit', 1050000, 152, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:32:06', '2025-07-03 03:32:06'),
(521, 218, 'credit', 30000, 153, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:32:06', '2025-07-03 03:32:06'),
(522, 218, 'debit', 1050000, 153, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:32:06', '2025-07-03 03:32:06'),
(523, 70, 'credit', 30000, 154, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(524, 70, 'debit', 900000, 154, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(525, 72, 'credit', 30000, 155, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(526, 72, 'debit', 900000, 155, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(527, 73, 'credit', 30000, 156, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(528, 73, 'debit', 900000, 156, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(529, 77, 'credit', 30000, 157, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(530, 77, 'debit', 900000, 157, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(531, 83, 'credit', 30000, 158, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(532, 83, 'debit', 900000, 158, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(533, 91, 'credit', 30000, 159, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(534, 91, 'debit', 900000, 159, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:33:35', '2025-07-03 03:33:35'),
(535, 170, 'credit', 30000, 160, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:34:27', '2025-07-03 03:34:27'),
(536, 170, 'debit', 900000, 160, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:34:27', '2025-07-03 03:34:27'),
(537, 172, 'credit', 30000, 161, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(538, 172, 'debit', 1050000, 161, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(539, 178, 'credit', 30000, 162, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(540, 178, 'debit', 1050000, 162, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(541, 193, 'credit', 30000, 163, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(542, 193, 'debit', 1050000, 163, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(543, 202, 'credit', 30000, 164, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(544, 202, 'debit', 1050000, 164, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(545, 205, 'credit', 30000, 165, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(546, 205, 'debit', 1050000, 165, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(547, 206, 'credit', 30000, 166, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(548, 206, 'debit', 1050000, 166, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(549, 209, 'credit', 30000, 167, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(550, 209, 'debit', 1050000, 167, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:36:22', '2025-07-03 03:36:22'),
(551, 195, 'credit', 30000, 168, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:37:28', '2025-07-03 03:37:28'),
(552, 195, 'debit', 900000, 168, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:37:28', '2025-07-03 03:37:28'),
(553, 199, 'credit', 30000, 169, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:38:30', '2025-07-03 03:38:30'),
(554, 199, 'debit', 980000, 169, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:38:30', '2025-07-03 03:38:30'),
(555, 216, 'credit', 30000, 170, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:39:46', '2025-07-03 03:39:46'),
(556, 216, 'debit', 1050000, 170, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:39:46', '2025-07-03 03:39:46'),
(557, 217, 'credit', 30000, 171, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:39:46', '2025-07-03 03:39:46'),
(558, 217, 'debit', 1050000, 171, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:39:46', '2025-07-03 03:39:46'),
(559, 218, 'credit', 30000, 172, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:39:46', '2025-07-03 03:39:46'),
(560, 218, 'debit', 1050000, 172, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:39:46', '2025-07-03 03:39:46'),
(561, 219, 'credit', 30000, 173, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:39:46', '2025-07-03 03:39:46'),
(562, 219, 'debit', 1050000, 173, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:39:46', '2025-07-03 03:39:46'),
(563, 220, 'credit', 30000, 174, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:40:06', '2025-07-03 03:40:06'),
(564, 220, 'debit', 900000, 174, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:40:06', '2025-07-03 03:40:06'),
(565, 32, 'credit', 30000, 175, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:59:14', '2025-07-03 03:59:14'),
(566, 32, 'debit', 1050000, 175, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:59:14', '2025-07-03 03:59:14'),
(567, 22, 'credit', 30000, 176, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:59:14', '2025-07-03 03:59:14'),
(568, 22, 'debit', 1050000, 176, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:59:14', '2025-07-03 03:59:14'),
(569, 54, 'credit', 30000, 177, 'Tabungan DO -', 'belum', 0, '2025-07-03 03:59:30', '2025-07-03 03:59:30'),
(570, 54, 'debit', 700000, 177, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 03:59:30', '2025-07-03 03:59:30'),
(571, 70, 'credit', 30000, 178, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:00:59', '2025-07-03 04:00:59'),
(572, 70, 'debit', 900000, 178, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:00:59', '2025-07-03 04:00:59'),
(573, 91, 'credit', 30000, 179, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:00:59', '2025-07-03 04:00:59'),
(574, 91, 'debit', 900000, 179, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:00:59', '2025-07-03 04:00:59'),
(575, 119, 'credit', 30000, 180, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:01:44', '2025-07-03 04:01:44'),
(576, 119, 'debit', 980000, 180, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:01:44', '2025-07-03 04:01:44'),
(577, 162, 'credit', 30000, 181, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(578, 162, 'debit', 900000, 181, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(579, 170, 'credit', 30000, 182, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(580, 170, 'debit', 900000, 182, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(581, 172, 'credit', 30000, 183, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(582, 172, 'debit', 900000, 183, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(583, 195, 'credit', 30000, 184, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(584, 195, 'debit', 900000, 184, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(585, 209, 'credit', 30000, 185, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(586, 209, 'debit', 900000, 185, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(587, 220, 'credit', 30000, 186, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(588, 220, 'debit', 900000, 186, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:03:11', '2025-07-03 04:03:11'),
(589, 186, 'credit', 30000, 187, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:04:09', '2025-07-03 04:04:09'),
(590, 186, 'debit', 980000, 187, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:04:09', '2025-07-03 04:04:09'),
(591, 199, 'credit', 30000, 188, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:04:09', '2025-07-03 04:04:09'),
(592, 199, 'debit', 980000, 188, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:04:09', '2025-07-03 04:04:09'),
(593, 192, 'credit', 30000, 189, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:06:19', '2025-07-03 04:06:19'),
(594, 192, 'debit', 1050000, 189, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:06:19', '2025-07-03 04:06:19'),
(595, 202, 'credit', 30000, 190, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:06:19', '2025-07-03 04:06:19'),
(596, 202, 'debit', 1050000, 190, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:06:19', '2025-07-03 04:06:19'),
(597, 205, 'credit', 30000, 191, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:06:19', '2025-07-03 04:06:19'),
(598, 205, 'debit', 1050000, 191, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:06:19', '2025-07-03 04:06:19'),
(599, 216, 'credit', 30000, 192, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:06:19', '2025-07-03 04:06:19'),
(600, 216, 'debit', 1050000, 192, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:06:19', '2025-07-03 04:06:19'),
(601, 219, 'credit', 30000, 193, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:06:19', '2025-07-03 04:06:19'),
(602, 219, 'debit', 1050000, 193, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:06:19', '2025-07-03 04:06:19'),
(603, 22, 'credit', 30000, 194, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:07:33', '2025-07-03 04:07:33'),
(604, 22, 'debit', 1050000, 194, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:07:33', '2025-07-03 04:07:33'),
(605, 61, 'credit', 30000, 195, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:09:21', '2025-07-03 04:09:21'),
(606, 61, 'debit', 980000, 195, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:09:21', '2025-07-03 04:09:21'),
(607, 72, 'credit', 30000, 196, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:09:21', '2025-07-03 04:09:21'),
(608, 72, 'debit', 980000, 196, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:09:21', '2025-07-03 04:09:21'),
(609, 73, 'credit', 30000, 197, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:09:21', '2025-07-03 04:09:21'),
(610, 73, 'debit', 980000, 197, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:09:21', '2025-07-03 04:09:21'),
(611, 102, 'credit', 30000, 198, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:09:21', '2025-07-03 04:09:21'),
(612, 102, 'debit', 980000, 198, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:09:21', '2025-07-03 04:09:21'),
(613, 119, 'credit', 30000, 199, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:09:21', '2025-07-03 04:09:21'),
(614, 119, 'debit', 980000, 199, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:09:21', '2025-07-03 04:09:21'),
(615, 83, 'credit', 30000, 200, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:09:57', '2025-07-03 04:09:57'),
(616, 83, 'debit', 700000, 200, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:09:57', '2025-07-03 04:09:57'),
(617, 109, 'credit', 30000, 201, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:10:27', '2025-07-03 04:10:27'),
(618, 109, 'debit', 1050000, 201, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:10:27', '2025-07-03 04:10:27'),
(619, 170, 'credit', 30000, 202, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:12:27', '2025-07-03 04:12:27'),
(620, 170, 'debit', 900000, 202, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:12:27', '2025-07-03 04:12:27'),
(621, 195, 'credit', 30000, 203, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:12:27', '2025-07-03 04:12:27'),
(622, 195, 'debit', 900000, 203, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:12:27', '2025-07-03 04:12:27'),
(623, 209, 'credit', 30000, 204, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:12:27', '2025-07-03 04:12:27'),
(624, 209, 'debit', 900000, 204, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:12:27', '2025-07-03 04:12:27'),
(625, 172, 'credit', 30000, 205, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:14:17', '2025-07-03 04:14:17'),
(626, 172, 'debit', 980000, 205, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:14:17', '2025-07-03 04:14:17'),
(627, 220, 'credit', 30000, 206, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:14:17', '2025-07-03 04:14:17'),
(628, 220, 'debit', 980000, 206, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:14:17', '2025-07-03 04:14:17'),
(629, 202, 'credit', 30000, 207, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(630, 202, 'debit', 1050000, 207, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(631, 205, 'credit', 30000, 208, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(632, 205, 'debit', 1050000, 208, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(633, 206, 'credit', 30000, 209, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(634, 206, 'debit', 1050000, 209, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(635, 216, 'credit', 30000, 210, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(636, 216, 'debit', 1050000, 210, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(637, 217, 'credit', 30000, 211, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(638, 217, 'debit', 1050000, 211, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(639, 218, 'credit', 30000, 212, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(640, 218, 'debit', 1050000, 212, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(641, 219, 'credit', 30000, 213, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(642, 219, 'debit', 1050000, 213, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:16:07', '2025-07-03 04:16:07'),
(643, 32, 'credit', 30000, 214, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:17:01', '2025-07-03 04:17:01'),
(644, 32, 'debit', 700000, 214, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:17:01', '2025-07-03 04:17:01'),
(645, 70, 'credit', 30000, 215, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:33:54', '2025-07-03 04:33:54'),
(646, 70, 'debit', 900000, 215, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:33:54', '2025-07-03 04:33:54'),
(647, 73, 'credit', 30000, 216, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:35:11', '2025-07-03 04:35:11'),
(648, 73, 'debit', 1050000, 216, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:35:11', '2025-07-03 04:35:11'),
(649, 102, 'credit', 30000, 217, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:35:11', '2025-07-03 04:35:11'),
(650, 102, 'debit', 1050000, 217, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:35:11', '2025-07-03 04:35:11'),
(651, 91, 'credit', 30000, 218, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:35:40', '2025-07-03 04:35:40'),
(652, 91, 'debit', 700000, 218, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:35:40', '2025-07-03 04:35:40'),
(653, 162, 'credit', 30000, 219, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:36:57', '2025-07-03 04:36:57'),
(654, 162, 'debit', 900000, 219, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:36:57', '2025-07-03 04:36:57'),
(655, 193, 'credit', 30000, 220, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:36:57', '2025-07-03 04:36:57'),
(656, 193, 'debit', 900000, 220, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:36:57', '2025-07-03 04:36:57'),
(657, 172, 'credit', 30000, 221, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(658, 172, 'debit', 1050000, 221, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(659, 178, 'credit', 30000, 222, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(660, 178, 'debit', 1050000, 222, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(661, 199, 'credit', 30000, 223, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(662, 199, 'debit', 1050000, 223, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(663, 206, 'credit', 30000, 224, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(664, 206, 'debit', 1050000, 224, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(665, 209, 'credit', 30000, 225, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(666, 209, 'debit', 1050000, 225, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(667, 216, 'credit', 30000, 226, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(668, 216, 'debit', 1050000, 226, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(669, 217, 'credit', 30000, 227, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(670, 217, 'debit', 1050000, 227, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(671, 218, 'credit', 30000, 228, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(672, 218, 'debit', 1050000, 228, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(673, 219, 'credit', 30000, 229, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(674, 219, 'debit', 1050000, 229, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:38:38', '2025-07-03 04:38:38'),
(675, 186, 'credit', 30000, 230, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:39:15', '2025-07-03 04:39:15'),
(676, 186, 'debit', 925000, 230, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:39:15', '2025-07-03 04:39:15'),
(677, 192, 'credit', 30000, 231, 'Tabungan DO -', 'belum', 0, '2025-07-03 04:39:54', '2025-07-03 04:39:54'),
(678, 192, 'debit', 900000, 231, 'Uang Jalan DO -', 'belum', 0, '2025-07-03 04:39:54', '2025-07-03 04:39:54');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `fuel_logs`
--
ALTER TABLE `fuel_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galian`
--
ALTER TABLE `galian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=797;

--
-- AUTO_INCREMENT for table `ritasi2`
--
ALTER TABLE `ritasi2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `uangjalan`
--
ALTER TABLE `uangjalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vehicle_tracking`
--
ALTER TABLE `vehicle_tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

--
-- AUTO_INCREMENT for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=679;

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
