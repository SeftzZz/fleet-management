-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 02, 2025 at 01:37 PM
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
-- Database: `fleet_management_020725`
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
(15, 'Angga', '3601110506010000', '', '0859-6045-2780', '04/03/2024', '12/10/2024', ' 05/06/200', 'Pandeglang', 'Kp. Babakan Kanas Rt.003/Rw.006 Kadubera Kec. Picung', '', '00/00/0000', '', '', '', 'Aktif', 'RESIGN', 0, '2025-07-01 08:00:00', '2025-07-02 20:29:18'),
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

--
-- Dumping data for table `tim_mgmt`
--

INSERT INTO `tim_mgmt` (`id`, `tim_id`, `nama_tim`, `driver_id`, `nama_supir`, `vehicle_id`, `no_pol`, `no_pintu`, `status_tim_mgmt`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 3, 'G', 199, 'Abdul Halim', 704, 'B 9582 UVV', '704', 'Aktif', 0, '2025-07-02 20:21:59', '2025-07-02 20:21:59'),
(2, 3, 'G', 186, 'Abdul Wahid', 603, 'B 9597 UVV', '603', 'Aktif', 0, '2025-07-02 20:23:02', '2025-07-02 20:23:02'),
(3, 4, 'M', 41, 'Aco', 23, 'B 9447 UIU', '23', 'Non Aktif', 0, '2025-07-02 20:27:13', '2025-07-02 20:27:13'),
(4, 4, 'M', 54, 'Aep Alpiansyah (SUPI', 30, 'B 9462 UIT', '30', 'Aktif', 0, '2025-07-02 20:28:34', '2025-07-02 20:28:34'),
(5, 4, 'M', 53, 'Afrizal (SUPIR BARU)', 30, 'B 9462 UIT', '30', 'Non Aktif', 0, '2025-07-02 20:33:04', '2025-07-02 20:33:04');

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
(1, '127.0.0.1', 'admin@admin.com', '$2y$10$nU8GqgqEBLob7JjbI8nr1.BCqi3ukuX1CVQtesYLeO.hvBPFXThru', NULL, 'admin@admin.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1268889823, 1751457337, 1, 'Administrator', '.', 'IUWASH PLUS', '021', 0),
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
(22, 22, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(23, 23, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(24, 24, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(25, 25, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(26, 26, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(27, 27, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(28, 28, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(29, 29, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(30, 30, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(31, 31, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(32, 32, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
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
(54, 54, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(55, 55, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(56, 56, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(57, 57, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(58, 58, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(59, 59, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(60, 60, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(61, 61, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(62, 62, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(63, 63, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(64, 64, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(65, 65, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(66, 66, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(67, 67, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(68, 68, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(69, 69, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(70, 70, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(71, 71, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(72, 72, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(73, 73, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(74, 74, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(75, 75, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(76, 76, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(77, 77, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(78, 78, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(79, 79, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(80, 80, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(81, 81, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(82, 82, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(83, 83, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(84, 84, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(85, 85, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(86, 86, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(87, 87, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(88, 88, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(89, 89, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(90, 90, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(91, 91, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
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
(102, 102, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(103, 103, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(104, 104, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(105, 105, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(106, 106, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(107, 107, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(108, 108, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(109, 109, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(110, 110, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(111, 111, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(112, 112, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(113, 113, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(114, 114, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(115, 115, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(116, 116, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(117, 117, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(118, 118, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(119, 119, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
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
(162, 162, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(163, 163, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(164, 164, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(165, 165, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(166, 166, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(167, 167, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(168, 168, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(169, 169, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(170, 170, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(171, 171, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(172, 172, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(173, 173, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(174, 174, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(175, 175, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(176, 176, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(177, 177, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(178, 178, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(179, 179, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(180, 180, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(181, 181, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(182, 182, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(183, 183, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(184, 184, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(185, 185, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(186, 186, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(187, 187, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(188, 188, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(189, 189, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(190, 190, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(191, 191, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(192, 192, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(193, 193, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(194, 194, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(195, 195, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(196, 196, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(197, 197, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(198, 198, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(199, 199, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(200, 200, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(201, 201, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(202, 202, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(203, 203, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(204, 204, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(205, 205, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(206, 206, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(207, 207, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(208, 208, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(209, 209, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(210, 210, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(211, 211, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(212, 212, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(213, 213, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(214, 214, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(215, 215, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(216, 216, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(217, 217, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(218, 218, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(219, 219, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00'),
(220, 220, 0, 'Aktif', 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00');

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
(220, 220, 'debit', 0, NULL, 'Initial balance', NULL, 0, '2025-07-01 08:00:00', '2025-07-01 08:00:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;

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
