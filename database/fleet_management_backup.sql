/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.6.21-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: fleet_management
-- ------------------------------------------------------
-- Server version	10.6.21-MariaDB-0ubuntu0.22.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
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
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('pending','selesai') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
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
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `drivers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `license_number` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` enum('aktif','tidak aktif') DEFAULT 'aktif',
  `assigned_vehicle_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `drivers`
--

LOCK TABLES `drivers` WRITE;
/*!40000 ALTER TABLE `drivers` DISABLE KEYS */;
INSERT INTO `drivers` VALUES (1,'John Doe','AB123456789','08123456789','aktif',NULL,'2025-05-08 05:14:13','2025-05-08 05:14:13');
/*!40000 ALTER TABLE `drivers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuel_logs`
--

DROP TABLE IF EXISTS `fuel_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `fuel_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `fuel_type` varchar(30) DEFAULT NULL,
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
-- Table structure for table `incidents`
--

DROP TABLE IF EXISTS `incidents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `incidents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `incident_date` datetime DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `severity` enum('ringan','sedang','parah') DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `maintenance_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `service_type` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
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
-- Table structure for table `routes`
--

DROP TABLE IF EXISTS `routes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `routes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `start_point` varchar(100) DEFAULT NULL,
  `end_point` varchar(100) DEFAULT NULL,
  `planned_distance` float DEFAULT NULL,
  `actual_distance` float DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_id` (`vehicle_id`),
  CONSTRAINT `routes_ibfk_1` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `routes`
--

LOCK TABLES `routes` WRITE;
/*!40000 ALTER TABLE `routes` DISABLE KEYS */;
INSERT INTO `routes` VALUES (1,1,'Jakarta','Bandung',150,145,'2025-05-07 08:00:00','2025-05-07 11:00:00');
/*!40000 ALTER TABLE `routes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password_hash` varchar(255) DEFAULT NULL,
  `role` enum('admin','operator','viewer') DEFAULT 'operator',
  `created_at` datetime DEFAULT current_timestamp(),
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
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle_documents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `doc_type` varchar(50) DEFAULT NULL,
  `doc_number` varchar(100) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `file_url` text DEFAULT NULL,
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
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicle_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_id` int(11) NOT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `speed` float DEFAULT NULL,
  `direction` varchar(10) DEFAULT NULL,
  `timestamp` datetime DEFAULT current_timestamp(),
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
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plate_number` varchar(20) NOT NULL,
  `vin` varchar(100) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `status` enum('aktif','tidak aktif','servis') DEFAULT 'aktif',
  `odometer` float DEFAULT 0,
  `assigned_driver_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (1,'B 1234 XYZ','1HGBH41JXMN109186','SUV','Toyota','Fortuner',2020,'aktif',5000,NULL,'2025-05-08 05:14:10','2025-05-08 05:14:10');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-13 20:01:45
