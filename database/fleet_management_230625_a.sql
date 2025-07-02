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
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `alerts_ibfk_1` (`vehicle_id`),
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
  `tgl_exp_sim` date DEFAULT NULL,
  `img_profile` text COLLATE utf8mb4_general_ci,
  `img_sim` text COLLATE utf8mb4_general_ci,
  `img_ktp` text COLLATE utf8mb4_general_ci,
  `status` enum('Aktif','Non Aktif') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `keterangan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drivers`
--

LOCK TABLES `drivers` WRITE;
/*!40000 ALTER TABLE `drivers` DISABLE KEYS */;
INSERT INTO `drivers` VALUES (14,'Ahmad Dani','1802040806700004','085963051895','2025-06-19','2025-06-19','Dusun 1 Rt.001/Rw.001 Fajar bulan Kec. Gunung Sugih','085963051895','2025-06-21','','','','Aktif',NULL,0,'2025-06-19 06:03:16','2025-06-19 06:03:16'),(15,'Karna Rahayu','1802040806700004','085963051895','2025-06-19','2025-06-19','Kp. Rancagong Rt.004/Rw.007 Rancagong - Legok','085963051895','2025-06-21',NULL,NULL,NULL,'Aktif',NULL,0,'2025-06-19 06:04:34','2025-06-19 06:04:34'),(16,'Imam Soib','1802040806700004','085963051895','2025-06-19','2025-06-19','Dusun IV Candirejo Rt.001/Rw.007 Titiwangi - Candipuro','085963051895','2025-06-19',NULL,NULL,NULL,'Aktif',NULL,0,'2025-06-19 06:04:53','2025-06-19 06:04:53'),(17,'Hendi','1802040806700004','085963051895','2025-06-19','2025-06-19','Kp. Gosali Rt.001/Rw.007 Desa Bangun Jaya Cigudeg','085963051895','2025-06-19',NULL,NULL,NULL,'Aktif',NULL,0,'2025-06-19 06:05:17','2025-06-19 06:05:17'),(18,'Driver K 1','1802040806700004','085963051895','2025-06-19','2025-06-19','Driver K 1','085963051895','2025-06-19',NULL,NULL,NULL,'Aktif',NULL,0,'2025-06-19 14:45:03','2025-06-19 14:45:03'),(19,'Driver K 2','1802040806700004','085963051895','2025-06-19','2025-06-19','Driver K 2','085963051895','2025-06-19',NULL,NULL,NULL,'Aktif',NULL,0,'2025-06-19 14:45:22','2025-06-19 14:45:22'),(20,'Driver KMP 1','1802040806700004','085963051895','2025-06-20','2025-06-20','Alamat satu','085963051895','2025-06-20','','','','Aktif',NULL,0,'2025-06-20 13:40:39','2025-06-20 13:40:39');
/*!40000 ALTER TABLE `drivers` ENABLE KEYS */;
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
  KEY `fuel_logs_ibfk_1` (`vehicle_id`),
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galian`
--

LOCK TABLES `galian` WRITE;
/*!40000 ALTER TABLE `galian` DISABLE KEYS */;
INSERT INTO `galian` VALUES (1,1,'Ciujug','Aktif',0,'2025-06-10 08:30:40','2025-06-10 08:30:40'),(2,1,'Multikon','Aktif',0,'2025-06-11 09:41:39','2025-06-11 09:41:39'),(3,1,'Tapen','Aktif',0,'2025-06-10 08:31:15','2025-06-10 08:31:15'),(4,1,'Mede','Aktif',0,'2025-06-10 08:31:15','2025-06-10 08:31:15'),(5,1,'Ciomas','Aktif',0,'2025-06-11 10:04:47','2025-06-11 10:04:47'),(6,1,'Citeras','Aktif',0,'2025-06-11 11:01:49','2025-06-11 11:01:49'),(7,1,'Serengseng','Aktif',0,'2025-06-11 11:02:25','2025-06-11 11:02:25'),(8,1,'C. Bitung','Aktif',0,'2025-06-11 11:02:42','2025-06-11 11:02:42'),(9,1,'Baros','Aktif',0,'2025-06-11 11:02:56','2025-06-11 11:02:56'),(10,1,'Cilegon','Aktif',0,'2025-06-11 11:03:13','2025-06-11 11:03:13'),(11,1,'Bojonegara','Aktif',0,'2025-06-11 12:28:42','2025-06-11 12:28:42'),(12,4,'Galian KMP','Aktif',0,'2025-06-20 13:55:41','2025-06-20 13:55:41');
/*!40000 ALTER TABLE `galian` ENABLE KEYS */;
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
  KEY `incidents_ibfk_1` (`vehicle_id`),
  KEY `incidents_ibfk_2` (`driver_id`),
  CONSTRAINT `incidents_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`),
  CONSTRAINT `incidents_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `incidents`
--

LOCK TABLES `incidents` WRITE;
/*!40000 ALTER TABLE `incidents` DISABLE KEYS */;
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
  KEY `maintenance_logs_ibfk_1` (`vehicle_id`),
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyek`
--

LOCK TABLES `proyek` WRITE;
/*!40000 ALTER TABLE `proyek` DISABLE KEYS */;
INSERT INTO `proyek` VALUES (1,'Kohod','Aktif',0,'2025-06-10 15:29:29','2025-06-10 15:29:29'),(2,'Tj. Burung','Aktif',0,'2025-06-10 08:29:51','2025-06-10 08:29:51'),(3,'Sumber Baru','Non Aktif',0,'2025-06-11 09:55:47','2025-06-11 09:55:47'),(4,'Proyek KMP','Aktif',0,'2025-06-20 13:55:22','2025-06-20 13:55:22');
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
  `uang_jalan` varchar(10) NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ritasi`
--

LOCK TABLES `ritasi` WRITE;
/*!40000 ALTER TABLE `ritasi` DISABLE KEYS */;
INSERT INTO `ritasi` VALUES (48,'2025-06-20',1,'G',4,'Proyek KMP',12,'Galian KMP',4,'B 9760 UIU','13:58','11111','1000000',0,'2025-06-20 13:58:13','2025-06-20 13:58:13'),(49,'2025-06-20',1,'G',4,'Proyek KMP',12,'Galian KMP',7,'B KMP 1','13:58','222222','1000000',0,'2025-06-20 13:58:13','2025-06-20 13:58:13'),(50,'2025-06-21',1,'G',4,'Proyek KMP',12,'Galian KMP',4,'B 9760 UIU','13:58','33333','1000000',0,'2025-06-20 13:59:59','2025-06-20 13:59:59'),(51,'2025-06-20',1,'G',1,'Kohod',9,'Baros',4,'B 9760 UIU','15:46','12312312','1050000',0,'2025-06-20 15:47:03','2025-06-20 15:47:03'),(52,'2025-06-20',1,'G',1,'Kohod',9,'Baros',3,'B 9131 UVX','15:46','23423423','1050000',0,'2025-06-20 15:47:03','2025-06-20 15:47:03'),(53,'2025-06-20',1,'G',1,'Kohod',9,'Baros',2,'B 9668 UVW','15:46','34534534','1050000',0,'2025-06-20 15:47:03','2025-06-20 15:47:03'),(54,'2025-06-20',1,'G',1,'Kohod',9,'Baros',1,'B 9120 UVV','15:46','45645645','1050000',0,'2025-06-20 15:47:03','2025-06-20 15:47:03'),(55,'2025-06-20',1,'G',4,'Proyek KMP',12,'Galian KMP',7,'B KMP 1','15:47','56756756','1000000',0,'2025-06-20 15:47:39','2025-06-20 15:47:39'),(56,'2025-06-20',1,'G',4,'Proyek KMP',12,'Galian KMP',4,'B 9760 UIU','15:47','78978978','1000000',0,'2025-06-20 15:47:39','2025-06-20 15:47:39'),(57,'2025-06-20',1,'G',4,'Proyek KMP',12,'Galian KMP',3,'B 9131 UVX','15:47','89089089','1000000',0,'2025-06-20 15:47:39','2025-06-20 15:47:39'),(58,'2025-06-20',1,'G',4,'Proyek KMP',12,'Galian KMP',2,'B 9668 UVW','15:47','131313','1000000',0,'2025-06-20 15:47:39','2025-06-20 15:47:39'),(59,'2025-06-20',1,'G',4,'Proyek KMP',12,'Galian KMP',1,'B 9120 UVV','15:47','3123123','1000000',0,'2025-06-20 15:47:39','2025-06-20 15:47:39');
/*!40000 ALTER TABLE `ritasi` ENABLE KEYS */;
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
-- Table structure for table `tabungan`
--

DROP TABLE IF EXISTS `tabungan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tabungan` (
  `id` int DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `status` enum('Aktif','Non Aktif','Servis') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tabungan`
--

LOCK TABLES `tabungan` WRITE;
/*!40000 ALTER TABLE `tabungan` DISABLE KEYS */;
INSERT INTO `tabungan` VALUES (1,30000,'Aktif',0,'2025-06-18 06:00:00','2025-06-18 06:00:00');
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
  `nama_supir` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `vehicle_id` int NOT NULL,
  `no_pol` varchar(10) NOT NULL,
  `no_pintu` varchar(5) NOT NULL,
  `status_tim_mgmt` varchar(10) NOT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tim_mgmt`
--

LOCK TABLES `tim_mgmt` WRITE;
/*!40000 ALTER TABLE `tim_mgmt` DISABLE KEYS */;
INSERT INTO `tim_mgmt` VALUES (6,1,'G',17,'Hendi',4,'B 9760 UIU','51','Aktif',0,'2025-06-19 06:05:28','2025-06-19 06:05:28'),(7,1,'G',16,'Imam Soib',3,'B 9131 UVX','92','Aktif',0,'2025-06-19 06:05:35','2025-06-19 06:05:35'),(8,1,'G',15,'Karna Raha',2,'B 9668 UVW','105','Aktif',0,'2025-06-19 06:05:42','2025-06-19 06:05:42'),(9,1,'G',14,'Ahmad Dani',1,'B 9120 UVV','204','Aktif',0,'2025-06-19 06:05:50','2025-06-19 06:05:50'),(10,2,'K',18,'Driver K 1',5,'B RI 3','3','Aktif',0,'2025-06-19 14:45:55','2025-06-19 14:45:55'),(11,2,'K',19,'Driver K 2',6,'B RI 4','4','Aktif',0,'2025-06-19 14:46:02','2025-06-19 14:46:02'),(12,2,'K',20,'Driver KMP 1',7,'B KMP 1','1','Non Aktif',0,'2025-06-20 13:46:21','2025-06-20 13:46:21'),(13,1,'G',20,'Driver KMP 1',7,'B KMP 1','1','Non Aktif',0,'2025-06-20 15:45:16','2025-06-20 15:45:16'),(14,3,'M',20,'Driver KMP 1',7,'B KMP 1','1','Aktif',0,'2025-06-20 15:45:24','2025-06-20 15:45:24');
/*!40000 ALTER TABLE `tim_mgmt` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `uangjalan`
--

LOCK TABLES `uangjalan` WRITE;
/*!40000 ALTER TABLE `uangjalan` DISABLE KEYS */;
INSERT INTO `uangjalan` VALUES (1,1,1,'900000','Non Aktif',0,'2025-06-11 12:27:22','2025-06-15 01:55:03'),(2,1,2,'890000','Aktif',0,'2025-06-10 14:46:58','2025-06-10 15:30:22'),(3,1,3,'900000','Aktif',0,'2025-06-10 11:03:06','2025-06-10 14:49:36'),(4,1,4,'900000','Aktif',0,'2025-06-10 11:03:06','2025-06-10 11:03:06'),(5,1,5,'1050000','Aktif',0,'2025-06-10 14:30:46','2025-06-10 14:30:46'),(6,1,6,'890000','Aktif',0,'2025-06-11 11:04:40','2025-06-11 11:04:40'),(7,1,7,'700000','Aktif',0,'2025-06-11 11:06:39','2025-06-11 11:06:39'),(8,1,8,'950000','Aktif',0,'2025-06-11 11:55:21','2025-06-11 11:55:21'),(9,1,9,'1050000','Aktif',0,'2025-06-11 12:27:04','2025-06-11 12:27:04'),(10,1,10,'1140000','Aktif',0,'2025-06-11 12:28:11','2025-06-11 12:28:11'),(11,1,11,'1140000','Aktif',0,'2025-06-11 12:28:58','2025-06-11 12:28:58'),(12,1,1,'950000','Non Aktif',1,'2025-06-15 01:46:34','2025-06-15 01:54:53'),(13,1,1,'950000','Aktif',0,'2025-06-15 01:55:03','2025-06-15 01:55:03'),(14,4,12,'800000','Non Aktif',0,'2025-06-20 13:55:56','2025-06-20 13:56:56'),(15,4,12,'1000000','Aktif',0,'2025-06-20 13:56:56','2025-06-20 13:56:56');
/*!40000 ALTER TABLE `uangjalan` ENABLE KEYS */;
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
INSERT INTO `users` VALUES (1,'Admin User','kmp.group58@gmail.com','7c222fb2927d828af22f592134e8932480637c0d','admin','2025-05-08 05:14:34');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `v_doc_detail`
--

DROP TABLE IF EXISTS `v_doc_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `v_doc_detail` (
  `id` int DEFAULT NULL,
  `name` text,
  `vehicle_id` int DEFAULT NULL,
  `doc_type` varchar(100) DEFAULT NULL,
  `doc_number` varchar(100) DEFAULT NULL,
  `expiry_date` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `is_delete` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `v_doc_detail`
--

LOCK TABLES `v_doc_detail` WRITE;
/*!40000 ALTER TABLE `v_doc_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `v_doc_detail` ENABLE KEYS */;
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
  `status` enum('Aktif','Non Aktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_documents_ibfk_1` (`vehicle_id`),
  CONSTRAINT `vehicle_documents_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle_documents`
--

LOCK TABLES `vehicle_documents` WRITE;
/*!40000 ALTER TABLE `vehicle_documents` DISABLE KEYS */;
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
  `timestamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_tracking_ibfk_1` (`vehicle_id`),
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
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_pol` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `no_pintu` int NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `warna` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` enum('Aktif','Non Aktif','Servis') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (1,NULL,'B 9120 UVV',204,'GIGA FVZ N','Putih','Aktif',0,'2025-05-08 05:14:10','2025-06-10 09:30:14'),(2,NULL,'B 9668 UVW',105,'GIGA FVZ N','Putih','Aktif',0,'2025-05-08 05:14:10','2025-06-10 09:30:14'),(3,NULL,'B 9131 UVX',92,'FM 260 JD','Hijau','Aktif',0,'2025-05-08 05:14:10','2025-06-12 09:25:13'),(4,NULL,'B 9760 UIU',51,'FM 260 JD','Hijau','Aktif',0,'2025-05-08 05:14:10','2025-06-12 09:20:33'),(5,NULL,'B RI 3',3,'FM 260 JD','Hitam','Aktif',0,'2025-06-19 14:45:37','2025-06-19 14:45:37'),(6,NULL,'B RI 4',4,'GIGA FVZ N','Hitam','Aktif',0,'2025-06-19 14:45:45','2025-06-19 14:45:45'),(7,NULL,'B KMP 1',1,'FM 260 JD','Hitam','Aktif',0,'2025-06-20 13:35:44','2025-06-20 13:35:44');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
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
  `id_ritasi` int DEFAULT NULL,
  `description` text,
  `status` enum('belum','sudah') CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallet_transactions`
--

LOCK TABLES `wallet_transactions` WRITE;
/*!40000 ALTER TABLE `wallet_transactions` DISABLE KEYS */;
INSERT INTO `wallet_transactions` VALUES (12,8,'debit',0,NULL,'Initial balance','belum',0,'2025-06-19 06:03:16','2025-06-23 00:27:28'),(13,9,'debit',0,NULL,'Initial balance','belum',0,'2025-06-19 06:04:34','2025-06-19 06:04:34'),(14,10,'debit',0,NULL,'Initial balance','belum',0,'2025-06-19 06:04:53','2025-06-19 06:04:53'),(15,11,'debit',0,NULL,'Initial balance','belum',0,'2025-06-19 06:05:17','2025-06-19 06:05:17'),(42,12,'debit',0,NULL,'Initial balance','belum',0,'2025-06-19 14:45:03','2025-06-19 14:45:03'),(43,13,'debit',0,NULL,'Initial balance','belum',0,'2025-06-19 14:45:22','2025-06-19 14:45:22'),(62,14,'debit',0,NULL,'Initial balance','belum',0,'2025-06-20 13:40:39','2025-06-20 13:40:39'),(63,11,'credit',30000,48,'Tabungan DO - 11111','sudah',0,'2025-06-20 13:58:13','2025-06-20 13:58:13'),(64,11,'debit',1000000,48,'Uang Jalan DO - 11111','sudah',0,'2025-06-20 13:58:13','2025-06-23 02:22:23'),(65,14,'credit',30000,49,'Tabungan DO - 222222','belum',0,'2025-06-20 13:58:13','2025-06-23 00:08:58'),(66,14,'debit',1000000,49,'Uang Jalan DO - 222222','sudah',0,'2025-06-20 13:58:13','2025-06-23 02:22:23'),(67,11,'credit',30000,50,'Tabungan DO - 33333','belum',0,'2025-06-20 13:59:59','2025-06-20 13:59:59'),(68,11,'debit',1000000,50,'Uang Jalan DO - 33333','belum',0,'2025-06-20 13:59:59','2025-06-20 13:59:59'),(69,11,'credit',30000,51,'Tabungan DO - 123123123','belum',0,'2025-06-20 15:47:03','2025-06-20 15:47:03'),(70,11,'debit',1050000,51,'Uang Jalan DO - 123123123','belum',0,'2025-06-20 15:47:03','2025-06-20 15:48:43'),(71,10,'credit',30000,52,'Tabungan DO - 234234234','belum',0,'2025-06-20 15:47:03','2025-06-20 15:47:03'),(72,10,'debit',1050000,52,'Uang Jalan DO - 234234234','belum',0,'2025-06-20 15:47:03','2025-06-20 15:48:43'),(73,9,'credit',30000,53,'Tabungan DO - 345345345','belum',0,'2025-06-20 15:47:03','2025-06-20 15:47:03'),(74,9,'debit',1050000,53,'Uang Jalan DO - 345345345','belum',0,'2025-06-20 15:47:03','2025-06-20 15:48:43'),(75,8,'credit',30000,54,'Tabungan DO - 456456456','belum',0,'2025-06-20 15:47:03','2025-06-23 00:27:28'),(76,8,'debit',1050000,54,'Uang Jalan DO - 456456456','belum',0,'2025-06-20 15:47:03','2025-06-23 00:27:28'),(77,14,'credit',30000,55,'Tabungan DO - 567567567','belum',0,'2025-06-20 15:47:39','2025-06-23 00:08:58'),(78,14,'debit',1000000,55,'Uang Jalan DO - 567567567','sudah',0,'2025-06-20 15:47:39','2025-06-23 02:22:23'),(79,11,'credit',30000,56,'Tabungan DO - 789789789','belum',0,'2025-06-20 15:47:39','2025-06-20 15:47:39'),(80,11,'debit',1000000,56,'Uang Jalan DO - 789789789','sudah',0,'2025-06-20 15:47:39','2025-06-23 02:22:23'),(81,10,'credit',30000,57,'Tabungan DO - 890890890','belum',0,'2025-06-20 15:47:39','2025-06-20 15:47:39'),(82,10,'debit',1000000,57,'Uang Jalan DO - 890890890','sudah',0,'2025-06-20 15:47:39','2025-06-23 02:22:23'),(83,9,'credit',30000,58,'Tabungan DO - 131313','belum',0,'2025-06-20 15:47:39','2025-06-20 15:47:39'),(84,9,'debit',1000000,58,'Uang Jalan DO - 131313','sudah',0,'2025-06-20 15:47:39','2025-06-23 02:22:23'),(85,8,'credit',30000,59,'Tabungan DO - 3123123','belum',0,'2025-06-20 15:47:39','2025-06-23 00:27:28'),(86,8,'debit',1000000,59,'Uang Jalan DO - 3123123','sudah',0,'2025-06-20 15:47:39','2025-06-23 02:22:23');
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
  `is_delete` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wallets`
--

LOCK TABLES `wallets` WRITE;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` VALUES (8,14,60000,0,'2025-06-19 06:03:16','2025-06-20 15:47:39'),(9,15,60000,0,'2025-06-19 06:04:34','2025-06-20 15:47:39'),(10,16,60000,0,'2025-06-19 06:04:53','2025-06-20 15:47:39'),(11,17,120000,0,'2025-06-19 06:05:17','2025-06-20 15:47:39'),(12,18,0,0,'2025-06-19 14:45:03','2025-06-19 14:46:29'),(13,19,0,0,'2025-06-19 14:45:22','2025-06-19 14:46:29'),(14,20,60000,0,'2025-06-20 13:40:39','2025-06-20 15:47:39');
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

-- Dump completed on 2025-06-23 22:37:46
