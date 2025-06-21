-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: fleet_management
-- ------------------------------------------------------
-- Server version	8.0.42-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `alerts`
--

DROP TABLE IF EXISTS `alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alerts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` int NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_general_ci,
  `status` enum('pending','selesai') COLLATE utf8mb4_general_ci DEFAULT 'pending',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `vehicle_id` (`vehicle_id`),
  CONSTRAINT `alerts_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alerts`
--

LOCK TABLES `alerts` WRITE;
/*!40000 ALTER TABLE `alerts` DISABLE KEYS */;
INSERT INTO `alerts` VALUES (1,1,'Overheating','Mesin kendaraan terlalu panas','pending','2025-05-08 05:14:32');
/*!40000 ALTER TABLE `alerts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drivers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `license_number` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_join` date DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `nomor_darurat` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `img_profile` text COLLATE utf8mb4_general_ci,
  `img_sim` text COLLATE utf8mb4_general_ci,
  `status` enum('Aktif','Non Aktif') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drivers`
--

LOCK TABLES `drivers` WRITE;
/*!40000 ALTER TABLE `drivers` DISABLE KEYS */;
INSERT INTO `drivers` VALUES (1,'Risandi Depri','AB123456789','08123456789','2025-01-01',NULL,NULL,NULL,NULL,NULL,'Aktif',0,'2025-05-08 05:14:13','2025-06-16 00:30:44'),(2,'Wandi Anwar Wahyudi','AB123456700','08123456788','2025-02-01',NULL,NULL,NULL,NULL,NULL,'Aktif',0,'2025-05-08 05:14:13','2025-06-16 00:30:44'),(3,'Cacang','AB123456700','08123456787','2025-03-01',NULL,NULL,NULL,NULL,NULL,'Aktif',0,'2025-05-08 05:14:13','2025-06-16 00:30:44'),(4,'Karna','AB123456700','08123456786','2025-04-01',NULL,NULL,NULL,NULL,NULL,'Aktif',0,'2025-05-08 05:14:13','2025-06-16 00:30:44'),(5,'Wisnu Muhammad','AB123456700','08123456785','2025-05-01',NULL,NULL,NULL,NULL,NULL,'Aktif',0,'2025-05-08 05:14:13','2025-06-16 00:30:44'),(6,'Aris','AB123456700','08123456784','2025-06-01',NULL,NULL,NULL,NULL,NULL,'Aktif',0,'2025-05-08 05:14:13','2025-06-16 00:30:44'),(13,'Driver 1','123123123','123123123','2025-06-16','1994-02-16','Jl. Swadaya','08988442211',NULL,NULL,'Aktif',0,'2025-06-16 01:12:43','2025-06-16 01:12:43');
/*!40000 ALTER TABLE `drivers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `drivers2`
--

DROP TABLE IF EXISTS `drivers2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `drivers2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `license_number` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('aktif','tidak aktif') COLLATE utf8mb4_general_ci DEFAULT 'aktif',
  `assigned_vehicle_id` int DEFAULT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drivers2`
--

LOCK TABLES `drivers2` WRITE;
/*!40000 ALTER TABLE `drivers2` DISABLE KEYS */;
INSERT INTO `drivers2` VALUES (1,'John Doe','AB123456789','08123456789','aktif',NULL,0,'2025-05-08 05:14:13','2025-05-08 05:14:13');
/*!40000 ALTER TABLE `drivers2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_logs`
--

DROP TABLE IF EXISTS `fuel_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fuel_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` int NOT NULL,
  `fuel_type` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `liters` float DEFAULT NULL,
  `price_per_liter` float DEFAULT NULL,
  `total_cost` float DEFAULT NULL,
  `fuel_date` date DEFAULT NULL,
  `odometer` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_id` (`vehicle_id`),
  CONSTRAINT `fuel_logs_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuel_logs`
--

LOCK TABLES `fuel_logs` WRITE;
/*!40000 ALTER TABLE `fuel_logs` DISABLE KEYS */;
INSERT INTO `fuel_logs` VALUES (1,1,'Premium',50,10000,500000,'2025-05-07',5050);
/*!40000 ALTER TABLE `fuel_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galian`
--

DROP TABLE IF EXISTS `galian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galian` (
  `id` int NOT NULL AUTO_INCREMENT,
  `proyek_id` int NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `status_lokasi` varchar(10) NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galian`
--

LOCK TABLES `galian` WRITE;
/*!40000 ALTER TABLE `galian` DISABLE KEYS */;
INSERT INTO `galian` VALUES (1,1,'Ciujug','Aktif',0,'2025-06-10 08:30:40','2025-06-10 08:30:40'),(2,1,'Multikon','Aktif',0,'2025-06-11 09:41:39','2025-06-11 09:41:39'),(3,1,'Tapen','Aktif',0,'2025-06-10 08:31:15','2025-06-10 08:31:15'),(4,1,'Mede','Aktif',0,'2025-06-10 08:31:15','2025-06-10 08:31:15'),(5,1,'Ciomas','Aktif',0,'2025-06-11 10:04:47','2025-06-11 10:04:47'),(6,1,'Citeras','Aktif',0,'2025-06-11 11:01:49','2025-06-11 11:01:49'),(7,1,'Serengseng','Aktif',0,'2025-06-11 11:02:25','2025-06-11 11:02:25'),(8,1,'C. Bitung','Aktif',0,'2025-06-11 11:02:42','2025-06-11 11:02:42'),(9,1,'Baros','Aktif',0,'2025-06-11 11:02:56','2025-06-11 11:02:56'),(10,1,'Cilegon','Aktif',0,'2025-06-11 11:03:13','2025-06-11 11:03:13'),(11,1,'Bojonegara','Aktif',0,'2025-06-11 12:28:42','2025-06-11 12:28:42');
/*!40000 ALTER TABLE `galian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galian2`
--

DROP TABLE IF EXISTS `galian2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `galian2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `proyek_id` int NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `status_lokasi` varchar(10) NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galian2`
--

LOCK TABLES `galian2` WRITE;
/*!40000 ALTER TABLE `galian2` DISABLE KEYS */;
INSERT INTO `galian2` VALUES (1,1,'Ciujug','Aktif',0,'2025-06-10 08:30:40','2025-06-10 08:30:40'),(2,1,'Multikon','Aktif',0,'2025-06-10 08:31:15','2025-06-11 07:34:04'),(3,1,'Tapen','Aktif',0,'2025-06-10 08:31:15','2025-06-10 08:31:15'),(4,1,'Mede','Aktif',0,'2025-06-10 08:31:15','2025-06-10 08:31:15'),(5,1,'Ciomas','Aktif',0,'2025-06-11 07:33:41','2025-06-11 07:33:41');
/*!40000 ALTER TABLE `galian2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `incidents`
--

DROP TABLE IF EXISTS `incidents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `incidents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` int NOT NULL,
  `driver_id` int NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `incident_date` datetime DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `severity` enum('ringan','sedang','parah') COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_id` (`vehicle_id`),
  KEY `driver_id` (`driver_id`),
  CONSTRAINT `incidents_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`),
  CONSTRAINT `incidents_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incidents`
--

LOCK TABLES `incidents` WRITE;
/*!40000 ALTER TABLE `incidents` DISABLE KEYS */;
INSERT INTO `incidents` VALUES (1,1,1,'Kecelakaan ringan di jalan raya','2025-05-07 10:00:00','Jl. Merdeka, Jakarta','ringan');
/*!40000 ALTER TABLE `incidents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `maintenance_logs`
--

DROP TABLE IF EXISTS `maintenance_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `maintenance_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` int NOT NULL,
  `service_type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `cost` float DEFAULT NULL,
  `odometer` float DEFAULT NULL,
  `service_date` date DEFAULT NULL,
  `next_service_due` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_id` (`vehicle_id`),
  CONSTRAINT `maintenance_logs_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `maintenance_logs`
--

LOCK TABLES `maintenance_logs` WRITE;
/*!40000 ALTER TABLE `maintenance_logs` DISABLE KEYS */;
INSERT INTO `maintenance_logs` VALUES (1,1,'Service Berkala','Penggantian oli mesin',500000,5000,'2025-05-07','2025-06-07');
/*!40000 ALTER TABLE `maintenance_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyek`
--

DROP TABLE IF EXISTS `proyek`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proyek` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_proyek` varchar(30) NOT NULL,
  `status_proyek` varchar(10) NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyek`
--

LOCK TABLES `proyek` WRITE;
/*!40000 ALTER TABLE `proyek` DISABLE KEYS */;
INSERT INTO `proyek` VALUES (1,'Kohod','Aktif',0,'2025-06-10 15:29:29','2025-06-10 15:29:29'),(2,'Tj. Burung','Aktif',0,'2025-06-10 08:29:51','2025-06-10 08:29:51'),(3,'Sumber Baru','Non Aktif',0,'2025-06-11 09:55:47','2025-06-11 09:55:47');
/*!40000 ALTER TABLE `proyek` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ritasi`
--

DROP TABLE IF EXISTS `ritasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ritasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tgl_ritasi` date NOT NULL,
  `tim_id` int NOT NULL,
  `nama_tim` varchar(10) NOT NULL,
  `proyek_id` int NOT NULL,
  `nama_proyek` varchar(30) NOT NULL,
  `galian_id` int NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `vehicle_id` int NOT NULL,
  `no_pol` varchar(10) NOT NULL,
  `jam_angkut` varchar(5) NOT NULL,
  `nomerdo` varchar(8) NOT NULL,
  `uang_jalan` varchar(10) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ritasi`
--

LOCK TABLES `ritasi` WRITE;
/*!40000 ALTER TABLE `ritasi` DISABLE KEYS */;
INSERT INTO `ritasi` VALUES (1,'2024-10-01',1,'G',1,'Kohod',1,'Ciujug',1,'B 9120 UVV','02:20','35428','900000',0,'2025-06-10 08:38:17','2025-06-13 10:56:05'),(2,'2024-10-01',1,'G',1,'Kohod',1,'Ciujug',1,'B 9120 UVV','02:26','35493','900000',0,'2025-06-10 08:38:17','2025-06-13 22:19:08'),(3,'2025-06-12',2,'K',1,'Kohod',5,'Ciomas',2,'B 9668 UVW','16:11','12345','1050000',0,'2025-06-14 16:11:31','2025-06-14 16:11:31'),(4,'2025-06-15',2,'K',1,'Kohod',1,'Ciujug',4,'B 9760 UIU','02:28','12345','950000',0,'2025-06-15 02:28:37','2025-06-15 02:28:37'),(24,'2025-06-16',1,'G',1,'Kohod',9,'Baros',4,'B 9760 UIU','02:01','897456','1050000',0,'2025-06-16 02:01:14','2025-06-16 02:01:14');
/*!40000 ALTER TABLE `ritasi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ritasi2`
--

DROP TABLE IF EXISTS `ritasi2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ritasi2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tgl_ritasi` date NOT NULL,
  `tim_id` int NOT NULL,
  `nama_tim` varchar(10) NOT NULL,
  `proyek_id` int NOT NULL,
  `nama_proyek` varchar(30) NOT NULL,
  `galian_id` int NOT NULL,
  `lokasi` varchar(30) NOT NULL,
  `vehicle_id` int NOT NULL,
  `no_pol` varchar(10) NOT NULL,
  `jam_angkut` varchar(5) NOT NULL,
  `nomerdo` varchar(8) NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ritasi2`
--

LOCK TABLES `ritasi2` WRITE;
/*!40000 ALTER TABLE `ritasi2` DISABLE KEYS */;
INSERT INTO `ritasi2` VALUES (1,'2024-10-01',1,'G',1,'Kohod',1,'Ciujug',1,'B 9120 UVV','02:20','35428',0,'2025-06-10 08:38:17','2025-06-13 10:56:05'),(2,'2024-10-01',1,'G',1,'Kohod',1,'Ciujug',2,'B 9668 UVW','2:26 ','35493',0,'2025-06-10 08:38:17','2025-06-13 11:07:35');
/*!40000 ALTER TABLE `ritasi2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `routes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` int NOT NULL,
  `start_point` varchar(100) DEFAULT NULL,
  `end_point` varchar(100) DEFAULT NULL,
  `planned_distance` float DEFAULT NULL,
  `actual_distance` float DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routes`
--

LOCK TABLES `routes` WRITE;
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;
INSERT INTO `routes` VALUES (1,1,'Jakarta','Bandung',150,145,'2025-06-09 07:11:33','2025-06-09 07:11:33',0),(2,1,'Jakarta','Bogor',90,95,'2025-06-09 07:11:38','2025-06-09 07:11:38',0);
/*!40000 ALTER TABLE `routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `routes2`
--

DROP TABLE IF EXISTS `routes2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `routes2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` int NOT NULL,
  `start_point` varchar(100) DEFAULT NULL,
  `end_point` varchar(100) DEFAULT NULL,
  `planned_distance` float DEFAULT NULL,
  `actual_distance` float DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routes2`
--

LOCK TABLES `routes2` WRITE;
/*!40000 ALTER TABLE `routes2` DISABLE KEYS */;
INSERT INTO `routes2` VALUES (1,1,'Jakarta','Bandung',150,145,'2025-06-09 07:11:33','2025-06-09 07:11:33',0),(2,1,'Jakarta','Bogor',90,95,'2025-06-09 07:11:38','2025-06-09 07:11:38',0);
/*!40000 ALTER TABLE `routes2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tabungan`
--

DROP TABLE IF EXISTS `tabungan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabungan` (
  `id` int DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `status` enum('Aktif','Non Aktif','Servis') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabungan`
--

LOCK TABLES `tabungan` WRITE;
/*!40000 ALTER TABLE `tabungan` DISABLE KEYS */;
INSERT INTO `tabungan` VALUES (1,30000,'Aktif',0,'2025-06-16 01:12:43','2025-06-16 01:26:40');
/*!40000 ALTER TABLE `tabungan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tim`
--

DROP TABLE IF EXISTS `tim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tim` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_tim` varchar(10) NOT NULL,
  `status_tim` varchar(10) NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tim`
--

LOCK TABLES `tim` WRITE;
/*!40000 ALTER TABLE `tim` DISABLE KEYS */;
INSERT INTO `tim` VALUES (1,'G','Aktif',0,NULL,NULL),(2,'K','Aktif',0,NULL,NULL),(3,'M','Aktif',0,NULL,NULL),(4,'B','Aktif',0,NULL,NULL);
/*!40000 ALTER TABLE `tim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tim_mgmt`
--

DROP TABLE IF EXISTS `tim_mgmt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tim_mgmt` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tim_id` int NOT NULL,
  `nama_tim` varchar(10) NOT NULL,
  `driver_id` int NOT NULL,
  `nama_supir` varchar(10) NOT NULL,
  `vehicle_id` int NOT NULL,
  `no_pol` varchar(10) NOT NULL,
  `no_pintu` varchar(5) NOT NULL,
  `status_tim_mgmt` varchar(10) NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tim_mgmt`
--

LOCK TABLES `tim_mgmt` WRITE;
/*!40000 ALTER TABLE `tim_mgmt` DISABLE KEYS */;
INSERT INTO `tim_mgmt` VALUES (1,1,'G',3,'Cacang',1,'B 9120 UVV','204','Non Aktif',0,'2025-06-15 04:06:58','2025-06-15 04:39:20'),(2,1,'G',5,'Wisnu Muha',1,'B 9120 UVV','204','Aktif',0,'2025-06-15 04:39:20','2025-06-15 04:39:20'),(3,2,'K',5,'Wisnu Muha',4,'B 9760 UIU','51','Non Aktif',0,'2025-06-12 17:22:16','2025-06-15 04:39:20'),(4,1,'G',1,'Risandi De',3,'B 9131 UVX','92','Aktif',0,'2025-06-15 22:06:27','2025-06-15 22:06:27'),(5,1,'G',13,'Driver 1',4,'B 9760 UIU','51','Aktif',0,'2025-06-16 02:01:00','2025-06-16 02:01:00');
/*!40000 ALTER TABLE `tim_mgmt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tim_mgmt2`
--

DROP TABLE IF EXISTS `tim_mgmt2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tim_mgmt2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tim_id` int NOT NULL,
  `nama_tim` varchar(10) NOT NULL,
  `driver_id` int NOT NULL,
  `nama_supir` varchar(10) NOT NULL,
  `vehicle_id` int NOT NULL,
  `no_pol` varchar(10) NOT NULL,
  `no_pintu` varchar(5) NOT NULL,
  `status_tim_mgmt` varchar(10) NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tim_mgmt2`
--

LOCK TABLES `tim_mgmt2` WRITE;
/*!40000 ALTER TABLE `tim_mgmt2` DISABLE KEYS */;
INSERT INTO `tim_mgmt2` VALUES (1,1,'G',3,'Cacang',2,'B 9668 UVW','105','Aktif',0,'2025-06-12 17:10:02','2025-06-12 17:10:02'),(2,1,'G',4,'Karna',1,'B 9120 UVV','204','Aktif',0,'2025-06-12 17:21:52','2025-06-12 17:21:52'),(3,2,'K',5,'Wisnu Muha',4,'B 9760 UIU','51','Aktif',0,'2025-06-12 17:22:16','2025-06-12 17:22:16');
/*!40000 ALTER TABLE `tim_mgmt2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uangjalan`
--

DROP TABLE IF EXISTS `uangjalan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uangjalan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `proyek_id` int NOT NULL,
  `galian_id` int NOT NULL,
  `uang_jalan` varchar(10) NOT NULL,
  `status_uangjalan` varchar(10) NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uangjalan`
--

LOCK TABLES `uangjalan` WRITE;
/*!40000 ALTER TABLE `uangjalan` DISABLE KEYS */;
INSERT INTO `uangjalan` VALUES (1,1,1,'900000','Non Aktif',0,'2025-06-11 12:27:22','2025-06-15 01:55:03'),(2,1,2,'890000','Aktif',0,'2025-06-10 14:46:58','2025-06-10 15:30:22'),(3,1,3,'900000','Aktif',0,'2025-06-10 11:03:06','2025-06-10 14:49:36'),(4,1,4,'900000','Aktif',0,'2025-06-10 11:03:06','2025-06-10 11:03:06'),(5,1,5,'1050000','Aktif',0,'2025-06-10 14:30:46','2025-06-10 14:30:46'),(6,1,6,'890000','Aktif',0,'2025-06-11 11:04:40','2025-06-11 11:04:40'),(7,1,7,'700000','Aktif',0,'2025-06-11 11:06:39','2025-06-11 11:06:39'),(8,1,8,'950000','Aktif',0,'2025-06-11 11:55:21','2025-06-11 11:55:21'),(9,1,9,'1050000','Aktif',0,'2025-06-11 12:27:04','2025-06-11 12:27:04'),(10,1,10,'1140000','Aktif',0,'2025-06-11 12:28:11','2025-06-11 12:28:11'),(11,1,11,'1140000','Aktif',0,'2025-06-11 12:28:58','2025-06-11 12:28:58'),(12,1,1,'950000','Non Aktif',1,'2025-06-15 01:46:34','2025-06-15 01:54:53'),(13,1,1,'950000','Aktif',0,'2025-06-15 01:55:03','2025-06-15 01:55:03');
/*!40000 ALTER TABLE `uangjalan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `uangjalan2`
--

DROP TABLE IF EXISTS `uangjalan2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `uangjalan2` (
  `id` int NOT NULL AUTO_INCREMENT,
  `proyek_id` int NOT NULL,
  `galian_id` int NOT NULL,
  `uang_jalan` varchar(10) NOT NULL,
  `status_uangjalan` varchar(10) NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uangjalan2`
--

LOCK TABLES `uangjalan2` WRITE;
/*!40000 ALTER TABLE `uangjalan2` DISABLE KEYS */;
INSERT INTO `uangjalan2` VALUES (1,1,1,'900000','Aktif',0,'2025-06-11 12:27:22','2025-06-11 12:27:22'),(2,1,2,'890000','Aktif',0,'2025-06-10 14:46:58','2025-06-10 15:30:22'),(3,1,3,'900000','Aktif',0,'2025-06-10 11:03:06','2025-06-10 14:49:36'),(4,1,4,'900000','Aktif',0,'2025-06-10 11:03:06','2025-06-10 11:03:06'),(5,1,5,'1050000','Aktif',0,'2025-06-10 14:30:46','2025-06-10 14:30:46'),(6,1,6,'890000','Aktif',0,'2025-06-11 11:04:40','2025-06-11 11:04:40'),(7,1,7,'700000','Aktif',0,'2025-06-11 11:06:39','2025-06-11 11:06:39'),(8,1,8,'950000','Aktif',0,'2025-06-11 11:55:21','2025-06-11 11:55:21'),(9,1,9,'1050000','Aktif',0,'2025-06-11 12:27:04','2025-06-11 12:27:04'),(10,1,10,'1140000','Aktif',0,'2025-06-11 12:28:11','2025-06-11 12:28:11'),(11,1,11,'1140000','Aktif',0,'2025-06-11 12:28:58','2025-06-11 12:28:58');
/*!40000 ALTER TABLE `uangjalan2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` enum('admin','operator','viewer') COLLATE utf8mb4_general_ci DEFAULT 'operator',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin User','admin@company.com','hashed_password_example','admin','2025-05-08 05:14:34');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_documents`
--

DROP TABLE IF EXISTS `vehicle_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle_documents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` int NOT NULL,
  `doc_type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `doc_number` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `file_url` text COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id`),
  KEY `vehicle_id` (`vehicle_id`),
  CONSTRAINT `vehicle_documents_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_documents`
--

LOCK TABLES `vehicle_documents` WRITE;
/*!40000 ALTER TABLE `vehicle_documents` DISABLE KEYS */;
INSERT INTO `vehicle_documents` VALUES (1,1,'STNK','STNK123456','2026-05-07','https://example.com/file.pdf');
/*!40000 ALTER TABLE `vehicle_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle_tracking`
--

DROP TABLE IF EXISTS `vehicle_tracking`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle_tracking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `vehicle_id` int NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `speed` float DEFAULT NULL,
  `direction` varchar(10) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `vehicle_id` (`vehicle_id`),
  CONSTRAINT `vehicle_tracking_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_tracking`
--

LOCK TABLES `vehicle_tracking` WRITE;
/*!40000 ALTER TABLE `vehicle_tracking` DISABLE KEYS */;
INSERT INTO `vehicle_tracking` VALUES (1,1,-6.1751000,106.8650000,60.5,'utara','2025-05-08 05:14:17');
/*!40000 ALTER TABLE `vehicle_tracking` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `no_pol` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `no_pintu` int NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `warna` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('Aktif','Non Aktif','Servis') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (1,'B 9120 UVV',204,'GIGA FVZ N','Putih','Aktif',0,'2025-05-08 05:14:10','2025-06-10 09:30:14'),(2,'B 9668 UVW',105,'GIGA FVZ N','Putih','Aktif',0,'2025-05-08 05:14:10','2025-06-10 09:30:14'),(3,'B 9131 UVX',92,'FM 260 JD','Hijau','Aktif',0,'2025-05-08 05:14:10','2025-06-12 09:25:13'),(4,'B 9760 UIU',51,'FM 260 JD','Hijau','Aktif',0,'2025-05-08 05:14:10','2025-06-12 09:20:33');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles_old01`
--

DROP TABLE IF EXISTS `vehicles_old01`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicles_old01` (
  `id` int NOT NULL AUTO_INCREMENT,
  `plate_number` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `vin` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `brand` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `model` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `year` int DEFAULT NULL,
  `status` enum('aktif','non aktif','servis') COLLATE utf8mb4_general_ci DEFAULT 'aktif',
  `odometer` float DEFAULT '0',
  `assigned_driver_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles_old01`
--

LOCK TABLES `vehicles_old01` WRITE;
/*!40000 ALTER TABLE `vehicles_old01` DISABLE KEYS */;
INSERT INTO `vehicles_old01` VALUES (1,'B 9120 UVV\n','1HGBH41JXMN109186','SUV','Toyota','Fortuner',2020,'aktif',5000,NULL,'2025-05-08 05:14:10','2025-06-10 09:24:34');
/*!40000 ALTER TABLE `vehicles_old01` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallet_transactions`
--

DROP TABLE IF EXISTS `wallet_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wallet_transactions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `wallet_id` int NOT NULL,
  `transaction_type` enum('credit','debit') NOT NULL,
  `amount` float NOT NULL,
  `description` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_wallet_transactions_wallet` (`wallet_id`),
  CONSTRAINT `fk_wallet_transactions_wallet` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallet_transactions`
--

LOCK TABLES `wallet_transactions` WRITE;
/*!40000 ALTER TABLE `wallet_transactions` DISABLE KEYS */;
INSERT INTO `wallet_transactions` VALUES (3,6,'credit',0,'Initial balance','2025-06-16 01:12:43','2025-06-16 01:12:43'),(4,6,'credit',30000,'Tabungan DO - 897456','2025-06-16 02:01:14','2025-06-16 02:01:14'),(10,6,'credit',30000,'Tabungan DO - 897456','2025-06-16 02:13:33','2025-06-16 02:13:33'),(11,6,'debit',1050000,'Uang Jalan DO - 897456','2025-06-16 02:13:33','2025-06-16 02:13:33');
/*!40000 ALTER TABLE `wallet_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wallets` (
  `id` int NOT NULL AUTO_INCREMENT,
  `driver_id` int NOT NULL,
  `balance` float DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_wallets_driver` (`driver_id`),
  CONSTRAINT `fk_wallets_driver` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (6,13,60000,'2025-06-16 02:13:33','2025-06-16 02:13:33');
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-06-16  2:16:27
