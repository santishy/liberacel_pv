-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: anas_system
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.20.04.2

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
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'DISEÑO','2021-10-17 13:20:59','2021-10-17 13:20:59'),(2,'CARGADORES TIPO ORIGINAL','2021-10-17 13:21:07','2021-10-19 19:19:50'),(3,'MICA VIDRIO','2021-10-17 13:22:27','2021-10-17 13:22:27'),(4,'MICA FULL GLUE','2021-10-17 13:22:46','2021-10-17 13:22:46'),(5,'MICA D','2021-10-17 13:22:50','2021-10-17 13:22:50'),(6,'ACCESORIOS','2021-10-17 13:23:02','2021-10-17 13:23:02'),(7,'UNIVERSAL CELULAR','2021-10-19 18:53:32','2021-10-19 18:53:32'),(8,'1HORA','2021-10-22 17:08:12','2021-10-22 17:08:12'),(9,'CARGADORES GENERICOS','2021-10-22 17:40:37','2021-10-22 17:40:37'),(10,'AUDIFONOS','2021-10-24 13:26:15','2021-10-24 13:26:15'),(12,'BOCINA','2021-10-25 13:33:01','2021-10-25 13:33:01'),(13,'UNIVERSAL TABLET','2021-10-25 14:21:54','2021-10-25 14:21:54'),(14,'GIRATORIA','2021-10-25 16:17:25','2021-10-25 16:17:25'),(16,'MT LIDER ACCESORIOS','2021-10-27 13:20:53','2021-10-27 13:20:53'),(17,'USO RUDO CELULAR','2021-10-29 17:58:00','2021-10-29 17:58:00'),(18,'MICA RELOJ','2021-10-30 14:13:20','2021-10-30 14:13:20'),(19,'CHIP','2021-11-01 17:40:14','2021-11-01 17:40:14'),(20,'TPU','2021-11-03 19:25:41','2021-11-03 19:25:41'),(21,'MICA TABLETA','2021-11-04 14:10:58','2021-11-04 14:10:58'),(22,'SERVICIOS','2021-11-04 19:52:06','2021-11-04 19:52:06'),(23,'MICA CAMARA','2021-12-20 17:36:39','2021-12-20 17:36:39'),(24,'PRODUCTOS A CONSUMO','2022-05-13 14:16:47','2022-05-13 14:16:47'),(25,'MICA DE CERAMICA','2022-12-19 17:13:18','2022-12-19 17:13:18'),(26,'EXTENSIBLES','2022-12-20 11:52:35','2022-12-20 11:52:35'),(27,'CARTERA CELULAR PROMO','2023-06-29 12:28:19','2023-06-29 12:28:19'),(28,'BRACITOS TABLET','2023-06-29 14:19:39','2023-06-29 14:19:39'),(29,'FOLIOS','2023-07-03 13:44:00','2023-07-03 13:44:00'),(30,'FOLIOS F6','2023-07-05 19:50:36','2023-07-05 19:50:36'),(31,'ACCESORIOS O REFAS  DE SUPERCELL- JORGE','2023-07-05 19:52:21','2023-07-05 19:52:52'),(32,'ACCESORIOS O REFAS DE LIBERACELL- CHAVO','2023-07-05 19:52:44','2023-07-05 19:52:44');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `assigned_price` enum('retail_price','wholesale_price','distributor_price') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_phone_number_unique` (`phone_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commissions`
--

DROP TABLE IF EXISTS `commissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `commissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `fast_sale_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commissions_fast_sale_id_foreign` (`fast_sale_id`),
  CONSTRAINT `commissions_fast_sale_id_foreign` FOREIGN KEY (`fast_sale_id`) REFERENCES `fast_sales` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commissions`
--

LOCK TABLES `commissions` WRITE;
/*!40000 ALTER TABLE `commissions` DISABLE KEYS */;
INSERT INTO `commissions` VALUES (1,5.00,1,'2023-07-07 15:00:19','2023-07-07 15:00:19'),(2,5.00,2,'2023-07-16 12:53:01','2023-07-16 12:53:01'),(3,5.00,3,'2023-07-16 12:54:13','2023-07-16 12:54:13');
/*!40000 ALTER TABLE `commissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `creditables`
--

DROP TABLE IF EXISTS `creditables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `creditables` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `credit_id` bigint unsigned NOT NULL,
  `creditable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `creditable_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `creditables_creditable_type_creditable_id_index` (`creditable_type`,`creditable_id`),
  KEY `creditables_credit_id_foreign` (`credit_id`),
  CONSTRAINT `creditables_credit_id_foreign` FOREIGN KEY (`credit_id`) REFERENCES `credits` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `creditables`
--

LOCK TABLES `creditables` WRITE;
/*!40000 ALTER TABLE `creditables` DISABLE KEYS */;
/*!40000 ALTER TABLE `creditables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credits`
--

DROP TABLE IF EXISTS `credits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `credits` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','paid','overdue') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `credits_client_id_foreign` (`client_id`),
  CONSTRAINT `credits_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credits`
--

LOCK TABLES `credits` WRITE;
/*!40000 ALTER TABLE `credits` DISABLE KEYS */;
/*!40000 ALTER TABLE `credits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer_bonuses`
--

DROP TABLE IF EXISTS `customer_bonuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer_bonuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `accumulated_points` int NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customer_bonuses_phone_number_unique` (`phone_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer_bonuses`
--

LOCK TABLES `customer_bonuses` WRITE;
/*!40000 ALTER TABLE `customer_bonuses` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_bonuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `expenses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `concept` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fast_sale_product_bonus`
--

DROP TABLE IF EXISTS `fast_sale_product_bonus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fast_sale_product_bonus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_bonus_id` bigint unsigned DEFAULT NULL,
  `fast_sale_id` bigint unsigned DEFAULT NULL,
  `qty` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fast_sale_product_bonus_product_bonus_id_foreign` (`product_bonus_id`),
  KEY `fast_sale_product_bonus_fast_sale_id_foreign` (`fast_sale_id`),
  CONSTRAINT `fast_sale_product_bonus_fast_sale_id_foreign` FOREIGN KEY (`fast_sale_id`) REFERENCES `fast_sales` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fast_sale_product_bonus_product_bonus_id_foreign` FOREIGN KEY (`product_bonus_id`) REFERENCES `product_bonuses` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fast_sale_product_bonus`
--

LOCK TABLES `fast_sale_product_bonus` WRITE;
/*!40000 ALTER TABLE `fast_sale_product_bonus` DISABLE KEYS */;
INSERT INTO `fast_sale_product_bonus` VALUES (1,1,1,1,NULL,NULL),(2,1,2,1,NULL,NULL),(3,1,3,1,NULL,NULL);
/*!40000 ALTER TABLE `fast_sale_product_bonus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fast_sales`
--

DROP TABLE IF EXISTS `fast_sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fast_sales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `total` double(8,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','cancelled','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `concepts` json DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `customer_bonus_id` bigint unsigned DEFAULT NULL,
  `electronic_money_discount` double(8,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `fast_sales_user_id_foreign` (`user_id`),
  KEY `fast_sales_customer_bonus_id_foreign` (`customer_bonus_id`),
  CONSTRAINT `fast_sales_customer_bonus_id_foreign` FOREIGN KEY (`customer_bonus_id`) REFERENCES `customer_bonuses` (`id`) ON DELETE SET NULL,
  CONSTRAINT `fast_sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fast_sales`
--

LOCK TABLES `fast_sales` WRITE;
/*!40000 ALTER TABLE `fast_sales` DISABLE KEYS */;
INSERT INTO `fast_sales` VALUES (1,350.00,'completed','[{\"qty\": \"1\", \"price\": \"350\", \"description\": \"FOLIO 1029\", \"product_bonus_id\": 1}]',2,'2023-07-07 15:00:01','2023-07-07 15:00:19',NULL,0.00),(2,1.00,'completed','[{\"qty\": \"1\", \"price\": \"1\", \"description\": \"1111111\", \"product_bonus_id\": 1}]',2,'2023-07-16 12:52:18','2023-07-16 12:53:01',NULL,0.00),(3,1.00,'completed','[{\"qty\": \"1\", \"price\": \"1\", \"description\": \"222222\", \"product_bonus_id\": 1}]',2,'2023-07-16 12:54:08','2023-07-16 12:54:13',NULL,0.00);
/*!40000 ALTER TABLE `fast_sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventories`
--

DROP TABLE IF EXISTS `inventories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventories`
--

LOCK TABLES `inventories` WRITE;
/*!40000 ALTER TABLE `inventories` DISABLE KEYS */;
INSERT INTO `inventories` VALUES (1,'CHUPIKCELL','HIDALGO 15 A , CENTRO, SAHUAYO, MICH. C.P 59000','2023-06-29 12:00:57','2023-07-13 17:05:04');
/*!40000 ALTER TABLE `inventories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_product`
--

DROP TABLE IF EXISTS `inventory_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventory_product` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint unsigned NOT NULL,
  `inventory_id` bigint unsigned DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventory_product_product_id_foreign` (`product_id`),
  KEY `inventory_product_inventory_id_foreign` (`inventory_id`),
  CONSTRAINT `inventory_product_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`),
  CONSTRAINT `inventory_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_product`
--

LOCK TABLES `inventory_product` WRITE;
/*!40000 ALTER TABLE `inventory_product` DISABLE KEYS */;
INSERT INTO `inventory_product` VALUES (1,206,1,92,NULL,NULL),(2,294,1,39,NULL,NULL),(3,293,1,106,NULL,NULL),(4,295,1,268,NULL,NULL),(5,296,1,866,NULL,NULL),(6,4,1,97,NULL,NULL),(7,280,1,103,NULL,NULL),(8,2,1,850,NULL,NULL),(9,5,1,520,NULL,NULL),(10,262,1,29,NULL,NULL),(11,111,1,42,NULL,NULL),(12,112,1,70,NULL,NULL),(13,87,1,9,NULL,NULL),(14,215,1,1,NULL,NULL),(15,88,1,1,NULL,NULL),(16,91,1,1,NULL,NULL),(17,214,1,1,NULL,NULL),(18,150,1,3,NULL,NULL),(19,220,1,5,NULL,NULL),(20,284,1,4,NULL,NULL),(21,279,1,3,NULL,NULL),(22,218,1,4,NULL,NULL),(23,219,1,2,NULL,NULL),(24,213,1,2,NULL,NULL),(25,216,1,2,NULL,NULL),(26,217,1,2,NULL,NULL),(27,127,1,3,NULL,NULL),(28,126,1,2,NULL,NULL),(29,297,1,1,NULL,NULL),(30,298,1,15,NULL,NULL),(31,85,1,0,NULL,NULL),(32,128,1,6,NULL,NULL),(33,290,1,0,NULL,NULL),(34,289,1,1,NULL,NULL),(35,272,1,1,NULL,NULL),(36,158,1,5,NULL,NULL),(37,278,1,1,NULL,NULL),(38,275,1,4,NULL,NULL),(39,287,1,2,NULL,NULL),(40,242,1,1,NULL,NULL),(41,95,1,1,NULL,NULL),(42,300,1,2,NULL,NULL),(43,232,1,1,NULL,NULL),(44,263,1,1,NULL,NULL),(45,264,1,3,NULL,NULL),(46,204,1,30,NULL,NULL),(47,102,1,3,NULL,NULL),(48,261,1,3,NULL,NULL),(49,3,1,3,NULL,NULL),(50,108,1,3,NULL,NULL),(51,109,1,1,NULL,NULL),(52,110,1,1,NULL,NULL),(53,187,1,1,NULL,NULL),(54,190,1,1,NULL,NULL),(55,189,1,0,NULL,NULL),(56,105,1,1,NULL,NULL),(57,103,1,3,NULL,NULL),(58,192,1,54,NULL,NULL),(59,164,1,1,NULL,NULL),(60,165,1,2,NULL,NULL),(61,166,1,2,NULL,NULL),(62,167,1,2,NULL,NULL),(63,168,1,2,NULL,NULL),(64,174,1,3,NULL,NULL),(65,178,1,1,NULL,NULL),(66,179,1,2,NULL,NULL),(67,180,1,4,NULL,NULL),(68,182,1,4,NULL,NULL),(69,76,1,5,NULL,NULL),(70,274,1,2,NULL,NULL),(71,260,1,0,NULL,NULL),(72,198,1,7,NULL,NULL),(73,79,1,12,NULL,NULL),(74,301,1,1,NULL,NULL),(75,114,1,7,NULL,NULL),(76,277,1,22,NULL,NULL),(77,194,1,35,NULL,NULL),(78,208,1,8,NULL,NULL),(79,209,1,5,NULL,NULL),(80,210,1,5,NULL,NULL),(81,205,1,5,NULL,NULL),(82,197,1,58,NULL,NULL),(83,244,1,1,NULL,NULL),(84,245,1,0,NULL,NULL),(85,251,1,1,NULL,NULL),(86,252,1,2,NULL,NULL),(87,1,1,32,NULL,NULL),(88,25,1,101,NULL,NULL),(89,26,1,23,NULL,NULL),(90,27,1,296,NULL,NULL),(91,28,1,314,NULL,NULL),(92,29,1,9,NULL,NULL),(93,30,1,107,NULL,NULL),(94,31,1,33,NULL,NULL),(95,32,1,0,NULL,NULL),(96,255,1,6,NULL,NULL),(97,302,1,0,NULL,NULL),(98,303,1,0,NULL,NULL),(99,281,1,8,NULL,NULL),(100,282,1,14,NULL,NULL),(101,257,1,5,NULL,NULL),(102,162,1,8,NULL,NULL),(103,82,1,4,NULL,NULL),(104,163,1,3,NULL,NULL),(105,256,1,1,NULL,NULL),(106,132,1,1,NULL,NULL),(107,133,1,2,NULL,NULL),(108,134,1,1,NULL,NULL),(109,135,1,3,NULL,NULL),(110,137,1,1,NULL,NULL),(111,138,1,2,NULL,NULL),(112,139,1,2,NULL,NULL),(113,140,1,5,NULL,NULL),(114,141,1,1,NULL,NULL),(115,142,1,3,NULL,NULL),(116,143,1,3,NULL,NULL),(117,144,1,0,NULL,NULL),(118,145,1,5,NULL,NULL),(119,146,1,1,NULL,NULL),(120,147,1,2,NULL,NULL),(121,148,1,1,NULL,NULL),(122,149,1,9,NULL,NULL),(123,151,1,9,NULL,NULL),(124,152,1,3,NULL,NULL),(125,153,1,6,NULL,NULL),(126,154,1,9,NULL,NULL),(127,155,1,6,NULL,NULL),(128,156,1,12,NULL,NULL),(129,157,1,0,NULL,NULL),(130,160,1,3,NULL,NULL),(131,200,1,1,NULL,NULL),(132,6,1,1,NULL,NULL),(133,9,1,3,NULL,NULL),(134,7,1,3,NULL,NULL),(135,8,1,1,NULL,NULL),(136,10,1,3,NULL,NULL),(137,19,1,2,NULL,NULL),(138,13,1,4,NULL,NULL),(139,16,1,4,NULL,NULL),(140,18,1,1,NULL,NULL),(141,20,1,1,NULL,NULL),(142,14,1,3,NULL,NULL),(143,17,1,4,NULL,NULL),(144,21,1,2,NULL,NULL),(145,12,1,2,NULL,NULL),(146,53,1,1,NULL,NULL),(147,57,1,1,NULL,NULL),(148,59,1,0,NULL,NULL),(149,61,1,2,NULL,NULL),(150,60,1,2,NULL,NULL),(151,63,1,2,NULL,NULL),(152,33,1,1,NULL,NULL),(153,66,1,2,NULL,NULL),(154,67,1,6,NULL,NULL),(155,68,1,2,NULL,NULL),(156,69,1,2,NULL,NULL),(157,70,1,7,NULL,NULL),(158,71,1,8,NULL,NULL),(159,72,1,1,NULL,NULL),(160,74,1,2,NULL,NULL),(161,73,1,1,NULL,NULL),(162,115,1,1,NULL,NULL),(163,35,1,2,NULL,NULL),(164,36,1,3,NULL,NULL),(165,37,1,3,NULL,NULL),(166,39,1,3,NULL,NULL),(167,40,1,0,NULL,NULL),(168,38,1,0,NULL,NULL),(169,304,1,7,NULL,NULL),(170,41,1,5,NULL,NULL),(171,42,1,0,NULL,NULL),(172,43,1,1,NULL,NULL),(173,305,1,3,NULL,NULL),(174,45,1,8,NULL,NULL),(175,46,1,4,NULL,NULL),(176,47,1,2,NULL,NULL),(177,48,1,0,NULL,NULL),(178,116,1,0,NULL,NULL),(179,49,1,9,NULL,NULL),(180,52,1,4,NULL,NULL),(181,51,1,2,NULL,NULL),(182,50,1,4,NULL,NULL),(183,306,1,2,NULL,NULL),(184,276,1,3,NULL,NULL),(185,129,1,2,NULL,NULL),(186,124,1,2,NULL,NULL),(187,122,1,2,NULL,NULL),(188,125,1,0,NULL,NULL),(189,118,1,1,NULL,NULL),(190,62,1,0,NULL,NULL),(191,307,1,0,NULL,NULL),(192,308,1,0,NULL,NULL),(193,309,1,0,NULL,NULL),(194,310,1,2,NULL,NULL),(195,15,1,1,NULL,NULL),(196,311,1,0,NULL,NULL),(197,312,1,2,NULL,NULL),(198,313,1,0,NULL,NULL),(199,314,1,0,NULL,NULL),(200,315,1,0,NULL,NULL),(201,316,1,4,NULL,NULL),(202,317,1,0,NULL,NULL),(203,318,1,1,NULL,NULL),(204,319,1,1,NULL,NULL),(205,34,1,3,NULL,NULL),(206,65,1,2,NULL,NULL),(207,236,1,3,NULL,NULL),(208,44,1,0,NULL,NULL),(209,64,1,2,NULL,NULL),(210,58,1,0,NULL,NULL),(211,56,1,2,NULL,NULL),(212,320,1,2,NULL,NULL),(213,199,1,2,NULL,NULL),(214,321,1,2,NULL,NULL);
/*!40000 ALTER TABLE `inventory_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2014_10_12_200000_add_two_factor_columns_to_users_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2020_10_16_151657_create_products_table',1),(6,'2020_10_20_150743_create_purchases_table',1),(7,'2020_10_20_151804_create_product_purchase_table',1),(8,'2020_11_12_231807_create_clients_table',1),(9,'2020_11_26_001038_create_categories_table',1),(10,'2020_11_26_003325_add_category_to_products_table',1),(11,'2020_12_09_002323_create_sales_table',1),(12,'2020_12_09_003959_create_product_sale_table',1),(13,'2021_03_19_000114_create_permission_tables',1),(14,'2021_04_19_190936_create_inventories_table',1),(15,'2021_04_19_192548_create_inventory_product_table',1),(16,'2021_05_28_235334_add_inventory_to_users_table',1),(17,'2021_08_10_131032_add_inventory_to_purchases_table',1),(18,'2021_08_12_175037_add_inventory_to_sales_table',1),(19,'2021_08_25_172202_create_tickets_table',1),(20,'2021_10_28_173028_add_image_to_products_table',1),(21,'2021_12_01_115558_create_fast_sales_table',1),(22,'2022_01_31_190525_create_commissions_table',1),(23,'2022_03_17_175402_create_product_bonuses_table',1),(24,'2022_04_27_113256_create_customer_bonuses_table',1),(25,'2022_04_27_115449_add_customer_bonus_to_fast_sales_table',1),(26,'2022_05_11_135508_create_fast_sale_product_bonus_table',1),(27,'2022_05_31_180011_create_settings_table',1),(28,'2022_06_20_191700_add_electronic_money_discount_to_fast_sales_table',1),(29,'2022_10_13_120040_add_status_columns_to_product_bonuses_table',1),(30,'2022_10_27_224823_add_username_columns_to_users_table',1),(31,'2022_11_08_172353_create_expenses_table',1),(32,'2022_12_19_140047_create_refunds_table',1),(33,'2023_06_20_125522_create_credits_table',1),(34,'2023_06_20_172649_create_creditables_table',1),(35,'2023_06_20_172943_add_payment_type_to_sales_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_permissions`
--

LOCK TABLES `model_has_permissions` WRITE;
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `model_has_roles`
--

LOCK TABLES `model_has_roles` WRITE;
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` VALUES (1,'App\\Models\\User',1),(1,'App\\Models\\User',2),(1,'App\\Models\\User',3),(2,'App\\Models\\User',4);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'create product','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(2,'view product','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(3,'delete product','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(4,'edit product','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(5,'create user','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(6,'view user','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(7,'view users','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(8,'delete user','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(9,'edit user','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(10,'create purchase','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(11,'view purchase','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(12,'view purchases','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(13,'delete purchase','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(14,'edit purchase','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(15,'create sale','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(16,'view sale','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(17,'view sales','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(18,'delete sale','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(19,'edit sale','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(20,'create client','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(21,'view client','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(22,'view clients','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(23,'delete client','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(24,'edit client','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(25,'create category','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(26,'view category','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(27,'delete category','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(28,'create warehouse','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(29,'view warehouse','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(30,'view warehouses','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(31,'delete warehouse','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(32,'edit warehouse','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(33,'edit stock','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(34,'empty stock','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(35,'view stock','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(36,'create role','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(37,'view roles','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(38,'view role','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(39,'delete role','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(40,'edit role','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(41,'edit ticket','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(42,'create fast sale','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(43,'view fast sale','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(44,'view fast sales','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(45,'edit fast sale','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(46,'delete fast sale product','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(47,'cancel fast sale','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(48,'view user commissions','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(49,'edit user commission','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(50,'create expense','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(51,'view expense','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(52,'view expenses','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(53,'edit expense','web','2023-06-29 12:00:58','2023-06-29 12:00:58'),(54,'delete expense','web','2023-06-29 12:00:58','2023-06-29 12:00:58');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_bonuses`
--

DROP TABLE IF EXISTS `product_bonuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_bonuses` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_bonuses_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_bonuses`
--

LOCK TABLES `product_bonuses` WRITE;
/*!40000 ALTER TABLE `product_bonuses` DISABLE KEYS */;
INSERT INTO `product_bonuses` VALUES (1,'FOLIOS F6',1,'2023-07-07 14:59:04','2023-07-07 14:59:04',1);
/*!40000 ALTER TABLE `product_bonuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_purchase`
--

DROP TABLE IF EXISTS `product_purchase`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_purchase` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `qty` int NOT NULL DEFAULT '0',
  `purchase_price` double(8,2) DEFAULT NULL,
  `product_id` bigint unsigned NOT NULL,
  `purchase_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_purchase_product_id_foreign` (`product_id`),
  KEY `product_purchase_purchase_id_foreign` (`purchase_id`),
  CONSTRAINT `product_purchase_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_purchase_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=277 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_purchase`
--

LOCK TABLES `product_purchase` WRITE;
/*!40000 ALTER TABLE `product_purchase` DISABLE KEYS */;
INSERT INTO `product_purchase` VALUES (1,92,19.00,206,1,NULL,NULL),(2,39,20.00,294,1,NULL,NULL),(3,106,53.00,293,1,NULL,NULL),(13,134,15.00,295,2,NULL,NULL),(14,433,6.00,296,2,NULL,NULL),(15,99,65.00,4,3,NULL,NULL),(16,103,10.00,280,3,NULL,NULL),(17,1001,6.00,2,4,NULL,NULL),(18,534,17.00,5,4,NULL,NULL),(19,52,55.00,262,5,NULL,NULL),(20,41,60.00,111,5,NULL,NULL),(21,70,80.00,112,5,NULL,NULL),(22,1,6.00,2,6,NULL,NULL),(23,9,25.00,87,7,NULL,NULL),(24,1,45.00,215,7,NULL,NULL),(25,1,45.00,88,7,NULL,NULL),(26,1,40.00,91,7,NULL,NULL),(27,1,45.00,214,7,NULL,NULL),(28,3,30.00,150,7,NULL,NULL),(29,5,45.00,220,7,NULL,NULL),(30,5,90.00,284,7,NULL,NULL),(31,3,56.00,279,7,NULL,NULL),(32,4,45.00,218,7,NULL,NULL),(33,2,45.00,219,7,NULL,NULL),(34,2,45.00,213,7,NULL,NULL),(35,1,45.00,216,7,NULL,NULL),(36,2,45.00,217,8,NULL,NULL),(37,3,21.00,127,9,NULL,NULL),(38,2,33.00,126,9,NULL,NULL),(39,3,120.00,297,10,NULL,NULL),(40,15,200.00,298,11,NULL,NULL),(41,1,20.00,85,12,NULL,NULL),(42,7,136.50,128,12,NULL,NULL),(43,2,155.00,290,12,NULL,NULL),(44,1,120.00,289,12,NULL,NULL),(45,2,131.00,272,12,NULL,NULL),(46,1,83.00,158,12,NULL,NULL),(47,1,0.00,278,12,NULL,NULL),(48,1,0.00,275,12,NULL,NULL),(49,2,230.00,287,12,NULL,NULL),(50,1,4.00,242,12,NULL,NULL),(51,1,280.00,95,12,NULL,NULL),(52,2,110.00,300,13,NULL,NULL),(53,1,180.00,232,14,NULL,NULL),(54,2,155.00,263,15,NULL,NULL),(55,3,196.50,264,15,NULL,NULL),(56,31,45.00,204,16,NULL,NULL),(57,3,15.00,102,17,NULL,NULL),(58,3,55.00,261,17,NULL,NULL),(59,3,45.00,3,17,NULL,NULL),(60,3,60.00,108,17,NULL,NULL),(61,1,60.00,109,17,NULL,NULL),(62,1,60.00,110,17,NULL,NULL),(63,2,107.00,187,18,NULL,NULL),(64,2,119.00,190,18,NULL,NULL),(65,1,119.00,189,18,NULL,NULL),(66,1,60.00,105,19,NULL,NULL),(67,3,70.00,103,19,NULL,NULL),(68,54,53.00,192,20,NULL,NULL),(69,1,39.00,164,21,NULL,NULL),(70,2,39.00,165,21,NULL,NULL),(71,2,39.00,166,21,NULL,NULL),(72,2,49.00,167,21,NULL,NULL),(73,2,59.00,168,21,NULL,NULL),(74,3,59.00,174,21,NULL,NULL),(75,1,39.00,178,21,NULL,NULL),(76,2,39.00,179,21,NULL,NULL),(77,4,49.00,180,21,NULL,NULL),(78,4,59.00,182,21,NULL,NULL),(79,5,10.00,76,22,NULL,NULL),(80,3,84.00,274,23,NULL,NULL),(81,1,10.00,260,23,NULL,NULL),(82,12,10.00,198,23,NULL,NULL),(83,7,4.00,79,23,NULL,NULL),(84,2,20.00,301,24,NULL,NULL),(85,7,35.00,114,25,NULL,NULL),(86,27,30.00,277,26,NULL,NULL),(87,18,40.00,194,26,NULL,NULL),(89,18,40.00,194,27,NULL,NULL),(90,9,60.00,208,28,NULL,NULL),(91,5,85.00,209,28,NULL,NULL),(92,5,85.00,210,28,NULL,NULL),(93,9,15.00,205,29,NULL,NULL),(94,122,1.00,197,29,NULL,NULL),(95,2,80.00,244,30,NULL,NULL),(96,1,150.00,245,30,NULL,NULL),(97,2,80.00,251,30,NULL,NULL),(98,2,150.00,252,30,NULL,NULL),(99,27,60.00,1,31,NULL,NULL),(100,70,60.00,25,31,NULL,NULL),(101,18,60.00,26,31,NULL,NULL),(102,315,60.00,27,31,NULL,NULL),(103,328,60.00,28,31,NULL,NULL),(104,34,60.00,29,31,NULL,NULL),(105,78,65.00,30,31,NULL,NULL),(106,25,70.00,31,31,NULL,NULL),(107,7,75.00,32,31,NULL,NULL),(108,6,150.00,255,31,NULL,NULL),(109,1,39.50,302,32,NULL,NULL),(110,3,1.00,303,32,NULL,NULL),(111,8,65.00,281,33,NULL,NULL),(112,14,65.00,282,33,NULL,NULL),(113,3,4.00,257,34,NULL,NULL),(114,4,12.50,162,35,NULL,NULL),(115,3,25.00,82,35,NULL,NULL),(116,3,25.00,163,36,NULL,NULL),(117,2,4.00,257,36,NULL,NULL),(118,1,1.00,256,36,NULL,NULL),(119,5,12.50,162,37,NULL,NULL),(120,1,25.00,82,37,NULL,NULL),(121,1,28.00,132,38,NULL,NULL),(122,2,48.00,133,38,NULL,NULL),(123,1,30.00,134,38,NULL,NULL),(124,3,50.00,135,38,NULL,NULL),(125,1,48.00,137,38,NULL,NULL),(126,2,52.00,138,38,NULL,NULL),(127,2,28.00,139,38,NULL,NULL),(128,6,18.00,140,38,NULL,NULL),(129,3,48.00,141,38,NULL,NULL),(130,3,47.00,142,38,NULL,NULL),(131,3,35.00,143,38,NULL,NULL),(132,2,60.00,144,38,NULL,NULL),(133,5,32.00,145,38,NULL,NULL),(134,1,28.00,146,38,NULL,NULL),(135,2,69.00,147,38,NULL,NULL),(136,2,35.00,148,38,NULL,NULL),(137,9,10.00,149,39,NULL,NULL),(138,3,15.00,151,39,NULL,NULL),(139,1,20.00,152,39,NULL,NULL),(140,2,17.00,153,39,NULL,NULL),(141,3,49.00,154,39,NULL,NULL),(142,2,57.00,155,39,NULL,NULL),(143,4,30.00,156,39,NULL,NULL),(144,1,49.00,157,40,NULL,NULL),(145,4,83.00,158,40,NULL,NULL),(146,3,90.00,160,40,NULL,NULL),(147,2,30.00,200,41,NULL,NULL),(148,1,30.00,6,42,NULL,NULL),(149,3,70.00,9,42,NULL,NULL),(150,3,65.00,7,42,NULL,NULL),(151,1,30.00,8,42,NULL,NULL),(152,3,70.00,10,42,NULL,NULL),(153,7,120.00,19,42,NULL,NULL),(154,4,65.00,13,42,NULL,NULL),(155,4,58.00,16,42,NULL,NULL),(156,3,60.00,18,42,NULL,NULL),(157,1,65.00,20,42,NULL,NULL),(158,3,120.00,14,42,NULL,NULL),(159,4,120.00,17,42,NULL,NULL),(160,2,120.00,21,42,NULL,NULL),(161,2,70.00,12,42,NULL,NULL),(162,3,39.00,53,42,NULL,NULL),(163,3,28.00,57,42,NULL,NULL),(165,2,70.00,59,42,NULL,NULL),(166,2,170.00,61,42,NULL,NULL),(167,2,100.00,60,42,NULL,NULL),(168,3,33.00,63,42,NULL,NULL),(171,3,58.00,33,42,NULL,NULL),(174,2,1.00,303,42,NULL,NULL),(175,2,30.00,66,42,NULL,NULL),(176,6,30.00,67,42,NULL,NULL),(177,2,30.00,68,42,NULL,NULL),(178,1,30.00,69,42,NULL,NULL),(179,7,65.00,70,42,NULL,NULL),(180,10,65.00,71,42,NULL,NULL),(181,2,65.00,72,42,NULL,NULL),(182,2,53.00,74,42,NULL,NULL),(183,1,65.00,73,42,NULL,NULL),(184,1,20.00,115,42,NULL,NULL),(185,7,17.50,35,43,NULL,NULL),(186,4,24.50,36,43,NULL,NULL),(187,4,17.50,37,43,NULL,NULL),(188,5,59.00,39,43,NULL,NULL),(189,6,66.00,40,43,NULL,NULL),(190,2,38.00,38,44,NULL,NULL),(191,1,38.00,304,45,NULL,NULL),(192,7,38.00,304,46,NULL,NULL),(193,5,13.00,41,47,NULL,NULL),(194,1,18.50,42,47,NULL,NULL),(195,1,24.50,43,47,NULL,NULL),(196,1,39.50,302,47,NULL,NULL),(197,1,38.00,305,48,NULL,NULL),(199,8,11.00,45,49,NULL,NULL),(200,8,14.50,46,49,NULL,NULL),(201,3,21.00,47,49,NULL,NULL),(202,4,37.00,48,49,NULL,NULL),(203,2,37.00,116,49,NULL,NULL),(204,11,17.00,49,49,NULL,NULL),(205,4,39.00,52,49,NULL,NULL),(206,2,49.00,51,49,NULL,NULL),(207,5,22.00,50,49,NULL,NULL),(208,1,48.50,306,50,NULL,NULL),(209,1,48.50,306,51,NULL,NULL),(210,2,98.00,276,51,NULL,NULL),(211,1,98.00,276,52,NULL,NULL),(212,2,25.00,129,53,NULL,NULL),(213,2,33.00,124,53,NULL,NULL),(214,2,22.00,122,54,NULL,NULL),(215,4,9.00,125,54,NULL,NULL),(216,1,35.00,118,55,NULL,NULL),(217,1,65.00,4,56,NULL,NULL),(218,1,6.00,2,56,NULL,NULL),(219,1,17.00,5,56,NULL,NULL),(220,1,130.00,62,57,NULL,NULL),(222,1,81.50,307,59,NULL,NULL),(223,4,81.50,307,60,NULL,NULL),(224,1,100.00,308,61,NULL,NULL),(225,1,100.00,309,62,NULL,NULL),(226,1,130.00,310,63,NULL,NULL),(229,1,65.00,15,64,NULL,NULL),(230,1,120.00,311,65,NULL,NULL),(231,1,75.00,312,66,NULL,NULL),(232,1,75.00,313,67,NULL,NULL),(233,1,85.00,314,68,NULL,NULL),(234,1,120.00,315,69,NULL,NULL),(235,1,80.00,316,70,NULL,NULL),(236,1,75.00,317,71,NULL,NULL),(237,1,57.00,318,72,NULL,NULL),(238,1,248.00,319,73,NULL,NULL),(239,3,14.50,34,74,NULL,NULL),(240,2,75.00,65,75,NULL,NULL),(241,4,8.00,236,76,NULL,NULL),(242,1,38.00,44,77,NULL,NULL),(243,1,24.50,43,77,NULL,NULL),(244,1,18.50,42,77,NULL,NULL),(245,1,33.50,305,77,NULL,NULL),(246,1,57.00,318,77,NULL,NULL),(247,1,248.00,319,77,NULL,NULL),(248,3,38.00,44,78,NULL,NULL),(249,2,24.50,43,78,NULL,NULL),(250,2,18.50,42,78,NULL,NULL),(251,2,33.50,305,78,NULL,NULL),(252,1,57.00,318,78,NULL,NULL),(253,1,248.00,319,78,NULL,NULL),(254,2,130.00,310,79,NULL,NULL),(255,3,130.00,62,79,NULL,NULL),(256,2,100.00,64,79,NULL,NULL),(257,2,100.00,308,79,NULL,NULL),(258,2,75.00,312,79,NULL,NULL),(259,1,33.00,58,79,NULL,NULL),(260,2,35.00,56,79,NULL,NULL),(261,2,28.00,57,79,NULL,NULL),(262,6,70.00,31,80,NULL,NULL),(263,9,60.00,29,80,NULL,NULL),(264,19,60.00,25,80,NULL,NULL),(265,15,17.00,5,81,NULL,NULL),(266,2,17.00,5,82,NULL,NULL),(267,2,17.00,5,83,NULL,NULL),(268,6,6.00,2,84,NULL,NULL),(269,23,70.00,31,85,NULL,NULL),(270,37,60.00,28,85,NULL,NULL),(271,9,65.00,30,85,NULL,NULL),(272,30,17.00,5,85,NULL,NULL),(273,3,85.00,308,86,NULL,NULL),(274,2,25.00,320,87,NULL,NULL),(275,2,28.00,199,88,NULL,NULL),(276,2,28.00,321,89,NULL,NULL);
/*!40000 ALTER TABLE `product_purchase` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_sale`
--

DROP TABLE IF EXISTS `product_sale`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `product_sale` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `qty` int NOT NULL DEFAULT '0',
  `sale_price` double(8,2) DEFAULT NULL,
  `product_id` bigint unsigned NOT NULL,
  `sale_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_sale_product_id_foreign` (`product_id`),
  KEY `product_sale_sale_id_foreign` (`sale_id`),
  CONSTRAINT `product_sale_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `product_sale_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=442 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_sale`
--

LOCK TABLES `product_sale` WRITE;
/*!40000 ALTER TABLE `product_sale` DISABLE KEYS */;
INSERT INTO `product_sale` VALUES (1,1,40.00,2,1,NULL,NULL),(3,1,75.00,302,2,NULL,NULL),(4,1,300.00,303,2,NULL,NULL),(5,1,180.00,284,3,NULL,NULL),(6,1,95.00,302,4,NULL,NULL),(8,1,80.00,5,4,NULL,NULL),(9,1,120.00,25,4,NULL,NULL),(10,1,170.00,4,4,NULL,NULL),(11,1,100.00,38,5,NULL,NULL),(12,1,40.00,2,5,NULL,NULL),(13,5,40.00,2,6,NULL,NULL),(14,1,180.00,30,6,NULL,NULL),(15,1,120.00,25,6,NULL,NULL),(16,1,80.00,5,6,NULL,NULL),(17,1,150.00,262,6,NULL,NULL),(18,1,40.00,2,7,NULL,NULL),(19,1,80.00,5,7,NULL,NULL),(20,1,160.00,28,8,NULL,NULL),(21,1,60.00,46,9,NULL,NULL),(22,1,180.00,30,10,NULL,NULL),(23,1,40.00,2,11,NULL,NULL),(24,1,150.00,27,12,NULL,NULL),(25,1,40.00,2,12,NULL,NULL),(26,1,40.00,2,13,NULL,NULL),(27,1,160.00,28,13,NULL,NULL),(28,1,90.00,48,14,NULL,NULL),(29,1,30.00,197,14,NULL,NULL),(30,1,50.00,205,15,NULL,NULL),(31,2,40.00,2,15,NULL,NULL),(32,1,125.00,244,16,NULL,NULL),(33,1,75.00,35,17,NULL,NULL),(34,1,100.00,262,18,NULL,NULL),(35,1,50.00,205,19,NULL,NULL),(36,1,180.00,30,20,NULL,NULL),(37,1,30.00,197,21,NULL,NULL),(38,1,100.00,262,22,NULL,NULL),(40,1,100.00,157,23,NULL,NULL),(41,1,250.00,62,24,NULL,NULL),(42,1,90.00,262,25,NULL,NULL),(43,1,100.00,262,26,NULL,NULL),(44,1,170.00,187,27,NULL,NULL),(45,1,170.00,187,28,NULL,NULL),(46,1,40.00,2,29,NULL,NULL),(47,1,180.00,30,30,NULL,NULL),(48,1,40.00,2,31,NULL,NULL),(49,1,150.00,27,32,NULL,NULL),(50,1,40.00,2,33,NULL,NULL),(51,1,90.00,48,34,NULL,NULL),(52,1,50.00,205,35,NULL,NULL),(53,1,160.00,28,36,NULL,NULL),(54,1,40.00,2,37,NULL,NULL),(56,1,160.00,28,38,NULL,NULL),(57,1,40.00,2,39,NULL,NULL),(58,1,100.00,38,40,NULL,NULL),(59,1,200.00,31,41,NULL,NULL),(60,1,160.00,28,42,NULL,NULL),(61,1,30.00,197,43,NULL,NULL),(62,1,40.00,2,44,NULL,NULL),(63,1,200.00,31,45,NULL,NULL),(64,1,170.00,30,45,NULL,NULL),(65,1,40.00,2,46,NULL,NULL),(66,1,100.00,1,46,NULL,NULL),(67,1,150.00,27,47,NULL,NULL),(68,1,80.00,5,47,NULL,NULL),(69,1,75.00,43,47,NULL,NULL),(70,1,50.00,162,47,NULL,NULL),(71,1,40.00,2,48,NULL,NULL),(72,1,30.00,197,49,NULL,NULL),(73,1,100.00,208,50,NULL,NULL),(74,1,60.00,46,51,NULL,NULL),(75,1,180.00,30,52,NULL,NULL),(76,1,100.00,262,52,NULL,NULL),(77,2,50.00,205,53,NULL,NULL),(78,1,30.00,197,54,NULL,NULL),(79,1,300.00,303,55,NULL,NULL),(80,2,30.00,197,56,NULL,NULL),(81,1,160.00,28,57,NULL,NULL),(84,1,60.00,49,58,NULL,NULL),(85,1,80.00,5,59,NULL,NULL),(87,2,100.00,262,60,NULL,NULL),(88,1,40.00,2,61,NULL,NULL),(89,1,40.00,2,62,NULL,NULL),(90,1,30.00,197,63,NULL,NULL),(91,1,50.00,205,63,NULL,NULL),(92,1,40.00,2,64,NULL,NULL),(93,1,180.00,30,64,NULL,NULL),(94,1,40.00,2,65,NULL,NULL),(95,1,80.00,63,66,NULL,NULL),(96,1,180.00,30,67,NULL,NULL),(97,1,40.00,2,68,NULL,NULL),(98,1,170.00,29,69,NULL,NULL),(99,1,150.00,27,70,NULL,NULL),(100,1,40.00,2,70,NULL,NULL),(101,1,130.00,72,71,NULL,NULL),(102,1,40.00,2,72,NULL,NULL),(103,1,230.00,272,73,NULL,NULL),(104,1,270.00,290,75,NULL,NULL),(105,1,270.00,290,74,NULL,NULL),(107,1,200.00,290,76,NULL,NULL),(108,1,40.00,2,77,NULL,NULL),(109,1,160.00,28,77,NULL,NULL),(110,1,40.00,2,78,NULL,NULL),(111,1,80.00,5,78,NULL,NULL),(112,1,80.00,57,79,NULL,NULL),(113,1,40.00,2,80,NULL,NULL),(114,1,160.00,18,80,NULL,NULL),(115,1,40.00,2,81,NULL,NULL),(116,1,160.00,28,82,NULL,NULL),(117,1,150.00,28,83,NULL,NULL),(118,1,40.00,2,84,NULL,NULL),(119,1,100.00,28,85,NULL,NULL),(120,1,70.00,42,86,NULL,NULL),(121,1,40.00,2,87,NULL,NULL),(122,1,160.00,28,87,NULL,NULL),(123,1,50.00,205,88,NULL,NULL),(124,1,150.00,27,90,NULL,NULL),(125,1,150.00,27,89,NULL,NULL),(126,1,40.00,2,91,NULL,NULL),(127,1,160.00,28,91,NULL,NULL),(128,1,40.00,2,92,NULL,NULL),(129,1,80.00,5,93,NULL,NULL),(136,1,40.00,2,98,NULL,NULL),(137,1,90.00,48,99,NULL,NULL),(138,1,170.00,29,100,NULL,NULL),(139,1,50.00,205,101,NULL,NULL),(140,1,40.00,2,102,NULL,NULL),(141,1,160.00,28,102,NULL,NULL),(142,1,270.00,290,103,NULL,NULL),(143,1,100.00,262,104,NULL,NULL),(144,1,40.00,2,105,NULL,NULL),(145,1,40.00,2,106,NULL,NULL),(146,1,80.00,5,107,NULL,NULL),(147,1,40.00,2,108,NULL,NULL),(148,1,180.00,30,108,NULL,NULL),(149,1,40.00,2,109,NULL,NULL),(150,1,40.00,2,110,NULL,NULL),(151,1,40.00,2,111,NULL,NULL),(152,1,120.00,39,112,NULL,NULL),(153,1,40.00,2,113,NULL,NULL),(154,1,40.00,2,114,NULL,NULL),(155,1,80.00,5,115,NULL,NULL),(156,1,40.00,2,116,NULL,NULL),(157,1,100.00,44,117,NULL,NULL),(158,1,30.00,2,118,NULL,NULL),(159,1,40.00,2,119,NULL,NULL),(160,1,40.00,2,120,NULL,NULL),(161,1,90.00,48,121,NULL,NULL),(162,1,200.00,31,122,NULL,NULL),(163,1,70.00,42,123,NULL,NULL),(164,1,160.00,316,124,NULL,NULL),(165,1,30.00,197,125,NULL,NULL),(166,1,200.00,31,126,NULL,NULL),(167,1,100.00,262,126,NULL,NULL),(168,1,150.00,27,127,NULL,NULL),(169,1,40.00,2,127,NULL,NULL),(170,1,120.00,71,128,NULL,NULL),(171,1,40.00,2,129,NULL,NULL),(172,1,40.00,2,130,NULL,NULL),(173,1,150.00,27,131,NULL,NULL),(174,1,40.00,2,132,NULL,NULL),(175,1,160.00,28,132,NULL,NULL),(176,1,150.00,27,133,NULL,NULL),(177,1,40.00,2,133,NULL,NULL),(178,1,60.00,140,134,NULL,NULL),(179,1,180.00,30,135,NULL,NULL),(180,1,80.00,5,136,NULL,NULL),(181,1,240.00,128,137,NULL,NULL),(182,1,100.00,304,138,NULL,NULL),(183,1,30.00,197,139,NULL,NULL),(184,1,160.00,274,140,NULL,NULL),(185,2,80.00,5,141,NULL,NULL),(186,1,150.00,277,141,NULL,NULL),(187,1,160.00,33,142,NULL,NULL),(188,1,40.00,2,143,NULL,NULL),(189,1,40.00,2,144,NULL,NULL),(190,1,120.00,277,144,NULL,NULL),(191,2,40.00,2,145,NULL,NULL),(192,1,160.00,29,145,NULL,NULL),(193,1,80.00,5,146,NULL,NULL),(194,2,100.00,262,147,NULL,NULL),(195,2,200.00,31,147,NULL,NULL),(196,1,150.00,277,147,NULL,NULL),(197,1,150.00,277,148,NULL,NULL),(198,1,100.00,44,148,NULL,NULL),(199,1,120.00,25,149,NULL,NULL),(200,1,40.00,2,150,NULL,NULL),(201,1,40.00,2,151,NULL,NULL),(202,1,40.00,2,152,NULL,NULL),(203,1,65.00,148,153,NULL,NULL),(204,1,200.00,194,154,NULL,NULL),(205,1,160.00,28,155,NULL,NULL),(206,1,120.00,25,156,NULL,NULL),(207,1,250.00,62,157,NULL,NULL),(208,1,120.00,25,158,NULL,NULL),(209,1,230.00,245,159,NULL,NULL),(210,1,30.00,197,160,NULL,NULL),(211,1,40.00,2,161,NULL,NULL),(212,1,250.00,297,162,NULL,NULL),(213,1,40.00,2,163,NULL,NULL),(214,1,150.00,27,163,NULL,NULL),(215,1,30.00,197,164,NULL,NULL),(216,1,40.00,2,165,NULL,NULL),(217,1,40.00,2,166,NULL,NULL),(218,1,160.00,28,166,NULL,NULL),(219,1,110.00,25,167,NULL,NULL),(221,2,40.00,2,169,NULL,NULL),(222,1,170.00,29,169,NULL,NULL),(223,1,40.00,2,170,NULL,NULL),(224,1,170.00,64,171,NULL,NULL),(225,1,30.00,197,172,NULL,NULL),(226,1,40.00,2,173,NULL,NULL),(227,1,150.00,28,174,NULL,NULL),(228,1,30.00,197,175,NULL,NULL),(229,1,30.00,2,176,NULL,NULL),(230,1,150.00,27,177,NULL,NULL),(231,1,40.00,2,178,NULL,NULL),(232,1,150.00,27,178,NULL,NULL),(233,1,40.00,2,179,NULL,NULL),(234,1,40.00,2,180,NULL,NULL),(235,1,70.00,42,181,NULL,NULL),(236,1,200.00,31,182,NULL,NULL),(237,1,190.00,190,183,NULL,NULL),(238,1,30.00,197,184,NULL,NULL),(239,1,30.00,197,185,NULL,NULL),(240,1,100.00,44,186,NULL,NULL),(241,1,40.00,2,187,NULL,NULL),(242,1,160.00,28,187,NULL,NULL),(243,1,40.00,2,188,NULL,NULL),(244,1,40.00,2,189,NULL,NULL),(245,1,100.00,262,190,NULL,NULL),(246,1,200.00,31,191,NULL,NULL),(247,1,130.00,27,192,NULL,NULL),(248,1,130.00,28,192,NULL,NULL),(249,1,30.00,2,192,NULL,NULL),(250,1,160.00,53,193,NULL,NULL),(251,1,45.00,236,193,NULL,NULL),(252,1,40.00,2,194,NULL,NULL),(253,1,60.00,49,195,NULL,NULL),(254,1,100.00,262,196,NULL,NULL),(255,1,70.00,47,197,NULL,NULL),(256,1,100.00,262,198,NULL,NULL),(257,1,180.00,30,198,NULL,NULL),(258,1,170.00,4,198,NULL,NULL),(259,1,80.00,262,199,NULL,NULL),(260,1,40.00,2,200,NULL,NULL),(261,1,180.00,30,200,NULL,NULL),(262,1,30.00,197,201,NULL,NULL),(263,1,170.00,29,202,NULL,NULL),(264,1,180.00,30,203,NULL,NULL),(265,1,40.00,2,204,NULL,NULL),(266,1,80.00,5,205,NULL,NULL),(267,1,40.00,2,206,NULL,NULL),(268,1,150.00,27,207,NULL,NULL),(269,1,60.00,46,208,NULL,NULL),(270,1,80.00,5,209,NULL,NULL),(271,1,30.00,197,210,NULL,NULL),(272,1,40.00,2,211,NULL,NULL),(273,1,160.00,28,212,NULL,NULL),(274,1,170.00,29,212,NULL,NULL),(275,1,40.00,2,213,NULL,NULL),(276,1,30.00,2,214,NULL,NULL),(277,1,40.00,2,215,NULL,NULL),(278,1,120.00,25,215,NULL,NULL),(279,1,40.00,2,216,NULL,NULL),(280,1,65.00,50,217,NULL,NULL),(281,1,150.00,28,218,NULL,NULL),(282,1,40.00,2,219,NULL,NULL),(283,1,90.00,37,220,NULL,NULL),(284,1,200.00,31,221,NULL,NULL),(285,1,150.00,312,222,NULL,NULL),(286,1,40.00,2,223,NULL,NULL),(287,1,40.00,2,224,NULL,NULL),(288,1,190.00,189,225,NULL,NULL),(289,1,40.00,2,226,NULL,NULL),(290,1,150.00,27,227,NULL,NULL),(291,1,40.00,2,227,NULL,NULL),(292,1,160.00,28,228,NULL,NULL),(293,1,80.00,5,229,NULL,NULL),(294,1,250.00,62,229,NULL,NULL),(295,1,30.00,197,230,NULL,NULL),(296,1,80.00,5,231,NULL,NULL),(297,1,200.00,31,231,NULL,NULL),(298,1,80.00,5,232,NULL,NULL),(299,1,80.00,5,233,NULL,NULL),(300,1,30.00,197,234,NULL,NULL),(301,1,160.00,28,235,NULL,NULL),(302,1,40.00,2,235,NULL,NULL),(303,1,40.00,2,236,NULL,NULL),(304,1,30.00,197,237,NULL,NULL),(305,1,40.00,2,238,NULL,NULL),(306,1,100.00,262,238,NULL,NULL),(307,1,40.00,2,239,NULL,NULL),(308,1,40.00,2,240,NULL,NULL),(309,1,75.00,43,240,NULL,NULL),(310,1,160.00,28,241,NULL,NULL),(311,1,250.00,62,242,NULL,NULL),(312,1,40.00,2,243,NULL,NULL),(313,1,40.00,2,244,NULL,NULL),(314,1,200.00,31,244,NULL,NULL),(315,1,40.00,2,245,NULL,NULL),(316,1,160.00,28,246,NULL,NULL),(317,2,200.00,31,247,NULL,NULL),(318,1,40.00,2,247,NULL,NULL),(319,1,40.00,2,248,NULL,NULL),(320,3,40.00,2,249,NULL,NULL),(323,1,100.00,262,250,NULL,NULL),(324,1,160.00,28,250,NULL,NULL),(325,1,40.00,2,251,NULL,NULL),(326,1,160.00,28,251,NULL,NULL),(327,1,40.00,2,252,NULL,NULL),(328,1,30.00,197,254,NULL,NULL),(329,1,30.00,197,253,NULL,NULL),(330,1,30.00,197,255,NULL,NULL),(331,1,160.00,28,257,NULL,NULL),(332,1,160.00,28,258,NULL,NULL),(333,1,160.00,28,256,NULL,NULL),(334,1,160.00,28,259,NULL,NULL),(335,1,40.00,2,259,NULL,NULL),(336,1,80.00,5,259,NULL,NULL),(337,1,200.00,31,259,NULL,NULL),(338,1,180.00,30,260,NULL,NULL),(339,1,200.00,31,260,NULL,NULL),(340,1,100.00,1,261,NULL,NULL),(341,1,40.00,2,262,NULL,NULL),(342,1,40.00,2,264,NULL,NULL),(343,1,40.00,2,263,NULL,NULL),(344,1,160.00,28,263,NULL,NULL),(345,1,150.00,28,265,NULL,NULL),(346,1,100.00,85,266,NULL,NULL),(347,1,115.00,204,267,NULL,NULL),(348,1,70.00,42,268,NULL,NULL),(349,1,80.00,5,269,NULL,NULL),(350,1,160.00,28,270,NULL,NULL),(351,1,40.00,2,271,NULL,NULL),(352,1,250.00,297,272,NULL,NULL),(353,1,150.00,27,273,NULL,NULL),(354,1,80.00,5,273,NULL,NULL),(355,1,110.00,59,274,NULL,NULL),(356,1,40.00,2,275,NULL,NULL),(357,1,40.00,2,276,NULL,NULL),(358,1,170.00,29,277,NULL,NULL),(359,1,180.00,30,278,NULL,NULL),(360,1,200.00,31,279,NULL,NULL),(361,1,90.00,58,280,NULL,NULL),(363,1,60.00,35,282,NULL,NULL),(364,1,150.00,27,283,NULL,NULL),(365,1,160.00,28,283,NULL,NULL),(366,1,150.00,27,284,NULL,NULL),(367,1,170.00,29,284,NULL,NULL),(368,4,40.00,2,284,NULL,NULL),(369,1,80.00,5,284,NULL,NULL),(370,1,30.00,197,284,NULL,NULL),(371,1,70.00,35,285,NULL,NULL),(372,1,160.00,28,285,NULL,NULL),(373,2,80.00,5,286,NULL,NULL),(374,1,50.00,205,287,NULL,NULL),(375,1,160.00,28,288,NULL,NULL),(376,1,40.00,2,288,NULL,NULL),(377,1,20.00,2,289,NULL,NULL),(378,1,40.00,2,290,NULL,NULL),(379,1,40.00,2,291,NULL,NULL),(380,1,40.00,2,292,NULL,NULL),(381,1,40.00,2,293,NULL,NULL),(382,2,50.00,205,294,NULL,NULL),(383,1,170.00,29,295,NULL,NULL),(384,1,80.00,5,295,NULL,NULL),(385,1,180.00,30,296,NULL,NULL),(386,1,50.00,205,297,NULL,NULL),(387,1,90.00,116,298,NULL,NULL),(388,1,160.00,28,299,NULL,NULL),(389,1,150.00,27,300,NULL,NULL),(390,1,70.00,35,301,NULL,NULL),(391,1,40.00,2,302,NULL,NULL),(392,1,40.00,2,303,NULL,NULL),(393,1,160.00,316,303,NULL,NULL),(394,1,120.00,39,303,NULL,NULL),(395,1,150.00,27,304,NULL,NULL),(396,1,160.00,28,305,NULL,NULL),(397,1,40.00,2,305,NULL,NULL),(398,1,160.00,28,306,NULL,NULL),(399,1,160.00,28,307,NULL,NULL),(400,1,150.00,27,308,NULL,NULL),(401,1,150.00,27,309,NULL,NULL),(402,1,250.00,62,310,NULL,NULL),(403,1,40.00,2,310,NULL,NULL),(404,1,40.00,2,311,NULL,NULL),(406,1,80.00,5,312,NULL,NULL),(407,1,150.00,18,313,NULL,NULL),(408,1,150.00,277,314,NULL,NULL),(409,1,160.00,28,314,NULL,NULL),(410,1,40.00,2,315,NULL,NULL),(420,1,180.00,30,316,NULL,NULL),(421,1,80.00,5,317,NULL,NULL),(422,1,150.00,4,318,NULL,NULL),(423,2,40.00,2,318,NULL,NULL),(424,1,60.00,301,318,NULL,NULL),(425,1,30.00,197,318,NULL,NULL),(426,1,35.00,260,318,NULL,NULL),(427,1,30.00,197,319,NULL,NULL),(428,1,30.00,197,320,NULL,NULL),(429,1,40.00,2,321,NULL,NULL),(430,1,150.00,27,322,NULL,NULL),(431,3,1.00,308,323,NULL,NULL),(432,1,40.00,2,324,NULL,NULL),(433,1,30.00,197,325,NULL,NULL),(434,1,150.00,27,326,NULL,NULL),(435,1,160.00,53,327,NULL,NULL),(436,1,40.00,2,328,NULL,NULL),(437,1,40.00,2,329,NULL,NULL),(438,1,70.00,262,329,NULL,NULL),(439,1,30.00,197,330,NULL,NULL),(441,1,80.00,5,332,NULL,NULL);
/*!40000 ALTER TABLE `product_sale` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `retail_price` double(8,2) NOT NULL,
  `wholesale_price` double(8,2) NOT NULL,
  `distributor_price` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` bigint unsigned DEFAULT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '/images/not-found.png',
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_sku_unique` (`sku`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=322 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'DISEÑO 100','DIS100',100.00,90.00,60.00,'2021-10-17 13:28:39','2021-11-07 10:36:43',1,'/storage/images/ebcd9090-01f9-4cec-bc15-01d900446e15.jpg'),(2,'MICA VIDRIO','MIVI',40.00,35.00,6.00,'2021-10-18 17:50:08','2023-06-29 13:00:15',3,'/images/not-found.png'),(3,'PROTECTOR UNIVERSAL CELULAR','3501',100.00,90.00,45.00,'2021-10-19 18:56:24','2021-11-07 13:40:51',7,'/images/not-found.png'),(4,'MICA FULL GLUE','MIFULL',170.00,165.00,65.00,'2021-10-19 19:11:21','2023-06-29 14:53:13',4,'/images/not-found.png'),(5,'MICA D','MID',80.00,80.00,17.00,'2021-10-19 19:12:50','2023-06-29 14:53:29',5,'/images/not-found.png'),(6,'CABLE TIPO C HUAWEI','1213',100.00,90.00,30.00,'2021-10-19 19:22:32','2023-06-05 12:34:45',2,'/images/not-found.png'),(7,'CABLE TIPO C MOTOROLA','1214',100.00,90.00,45.00,'2021-10-19 19:24:47','2023-07-07 16:37:03',2,'/images/not-found.png'),(8,'CABLE TIPO C SAMSUNG','1215',100.00,90.00,30.00,'2021-10-19 19:29:17','2023-06-05 12:55:24',2,'/images/not-found.png'),(9,'CABLE TIPO C A TIPO C HUAWEI','1216',120.00,110.00,50.00,'2021-10-19 19:30:48','2023-07-07 12:53:29',2,'/images/not-found.png'),(10,'CABLE TIPO C A TIPO C MOTOROLA','1217',120.00,110.00,45.00,'2021-10-19 19:32:38','2023-07-07 16:38:34',2,'/images/not-found.png'),(11,'CABLE TIPO C A TIPO C SAMSUNG','1218',120.00,110.00,45.00,'2021-10-19 19:33:02','2023-07-07 16:39:10',2,'/images/not-found.png'),(12,'CABLE TIPO C A 3.5 SAMSUNG','1219',130.00,120.00,45.00,'2021-10-19 19:34:49','2023-07-07 16:39:57',2,'/images/not-found.png'),(13,'CARGADOR TIPO C HUAWEI','1220',150.00,140.00,65.00,'2021-10-19 19:35:39','2023-06-05 12:40:22',2,'/images/not-found.png'),(14,'CARGADOR TIPO C A TIPO C HUAWEI','1221',200.00,190.00,120.00,'2021-10-19 19:37:03','2023-06-05 12:48:50',2,'/images/not-found.png'),(15,'CARGADOR TIPO C LG','1222',160.00,150.00,65.00,'2021-10-19 19:39:45','2023-07-07 16:42:22',2,'/images/not-found.png'),(16,'CARGADOR TIPO C MOTOROLA','1223',160.00,150.00,58.00,'2021-10-19 19:40:10','2023-06-05 12:42:33',2,'/images/not-found.png'),(17,'CARGADOR TIPO C A TIPO C MOTOROLA 30w','1224',200.00,190.00,120.00,'2021-10-19 19:40:49','2023-06-05 12:57:08',2,'/images/not-found.png'),(18,'CARGADOR TIPO C SAMSUNG','1225',160.00,150.00,60.00,'2021-10-19 19:41:36','2023-06-05 12:43:36',2,'/images/not-found.png'),(19,'COMBO TIPO C A TIPO C SAMSUNG 25w','1226',200.00,190.00,120.00,'2021-10-19 19:42:40','2023-07-08 14:04:16',2,'/images/not-found.png'),(20,'CARGADOR TIPO C XIAOMI','1227',160.00,150.00,65.00,'2021-10-19 19:53:16','2023-06-05 12:44:45',2,'/images/not-found.png'),(21,'CARGADOR TIPO C A TIPO C XIAOMI 30w','1228',200.00,190.00,120.00,'2021-10-19 19:54:05','2023-06-05 12:59:55',2,'/images/not-found.png'),(22,'DISEÑO 70','DIS70',70.00,60.00,50.00,'2021-10-22 15:11:02','2021-10-22 15:19:29',1,'/images/not-found.png'),(23,'DISEÑO 80','DIS80',80.00,70.00,50.00,'2021-10-22 15:12:37','2021-11-05 19:17:13',1,'/images/not-found.png'),(24,'DISEÑO 90','DIS90',90.00,80.00,50.00,'2021-10-22 15:13:23','2021-11-05 19:54:58',1,'/images/not-found.png'),(25,'DISEÑO 120','DIS120',120.00,110.00,60.00,'2021-10-22 16:17:46','2021-10-22 16:17:46',1,'/images/not-found.png'),(26,'DISEÑO 130','DIS130',130.00,120.00,60.00,'2021-10-22 16:18:19','2021-11-05 19:55:46',1,'/images/not-found.png'),(27,'DISEÑO 150','DIS150',150.00,140.00,60.00,'2021-10-22 16:18:47','2021-11-05 20:00:58',1,'/images/not-found.png'),(28,'DISEÑO 160','DIS160',160.00,150.00,60.00,'2021-10-22 16:21:54','2021-11-05 20:01:40',1,'/images/not-found.png'),(29,'DISEÑO 170','DIS170',170.00,160.00,60.00,'2021-10-22 16:22:35','2021-11-05 20:02:12',1,'/images/not-found.png'),(30,'DISEÑO 180','DIS180',180.00,170.00,65.00,'2021-10-22 16:23:34','2021-11-05 20:02:31',1,'/images/not-found.png'),(31,'DISEÑO 200','DIS200',200.00,190.00,70.00,'2021-10-22 16:24:03','2021-11-05 20:02:49',1,'/images/not-found.png'),(32,'DISEÑO 220','DIS220',220.00,210.00,75.00,'2021-10-22 16:24:48','2021-11-05 20:03:24',1,'/images/not-found.png'),(33,'COMBO IPHONE USB 5W','1207',150.00,140.00,58.00,'2021-10-22 16:48:12','2023-07-07 13:53:03',2,'/images/not-found.png'),(34,'CABLE SENCILLO TIPO C 3A','CAB251 - CAB237',60.00,50.00,14.50,'2021-10-22 17:10:34','2023-07-11 17:39:59',8,'/images/not-found.png'),(35,'CABLE TIPO C 1M BLANCO Y NEGRO','CAB184',70.00,60.00,17.50,'2021-10-22 17:11:50','2023-06-05 18:24:18',8,'/images/not-found.png'),(36,'CABLE TIPO C 2M NEGRO Y BLANCO','CAB185',75.00,65.00,24.50,'2021-10-22 17:12:35','2023-06-05 18:25:10',8,'/images/not-found.png'),(37,'CABLE TIPO C A TIPO C 3A','CAB252',90.00,80.00,17.50,'2021-10-22 17:14:04','2023-07-11 12:54:03',8,'/images/not-found.png'),(38,'CARGADOR TIPO C CUBO Y CABLE NEGRO Y BLANCO','GAR080',100.00,90.00,38.00,'2021-10-22 17:16:34','2023-06-05 18:27:03',8,'/images/not-found.png'),(39,'TURBOCARGADOR TIPO C 3.0 CUBO Y CABLE','GAR092',130.00,120.00,59.00,'2021-10-22 17:17:35','2023-06-05 18:47:14',8,'/images/not-found.png'),(40,'TURBOCARGADOR PD TIPO C A TIPO C 3A','GAR147',160.00,150.00,66.00,'2021-10-22 17:18:39','2023-06-05 18:49:25',8,'/images/not-found.png'),(41,'CABLE SENCILLO IPHONE','CAB238',60.00,50.00,13.00,'2021-10-22 17:19:16','2023-07-11 12:59:34',8,'/images/not-found.png'),(42,'CABLE IPHONE 1M','CAB179',70.00,60.00,18.50,'2021-10-22 17:19:59','2023-07-11 13:00:57',8,'/images/not-found.png'),(43,'CABLE IPHONE 2M','CAB206',75.00,65.00,24.50,'2021-10-22 17:20:44','2023-07-11 13:01:22',8,'/images/not-found.png'),(44,'CARGADOR IPHONE CUBO Y CABLE','GAR088',100.00,90.00,38.00,'2021-10-22 17:24:34','2023-06-05 18:54:09',8,'/images/not-found.png'),(45,'CABLE V8 SENCILLO NEGRO Y BLANCO','CAB236',60.00,50.00,11.00,'2021-10-22 17:25:43','2023-06-05 18:55:54',8,'/images/not-found.png'),(46,'CABLE V8 1M NEGRO Y BLANCO','CAB177',65.00,55.00,14.50,'2021-10-22 17:27:06','2023-06-05 18:56:40',8,'/images/not-found.png'),(47,'CABLE V8 2M NEGRO Y BLANCO','CAB178',70.00,60.00,21.00,'2021-10-22 17:27:52','2023-06-05 18:57:17',8,'/images/not-found.png'),(48,'CARGADOR V8 CUBO Y CALE NEGRO Y BLANCO','GAR064',90.00,80.00,37.00,'2021-10-22 17:28:49','2023-06-05 18:58:34',8,'/images/not-found.png'),(49,'CUBO 1A 1HORA ENTRADA USB','GAR063-1484',60.00,50.00,17.00,'2021-10-22 17:32:12','2023-07-11 18:07:13',8,'/images/not-found.png'),(50,'CARGADOR PARA AUTO 2.4 SIN CABLE','GAR128',65.00,55.00,22.00,'2021-10-22 17:33:15','2023-07-11 13:33:07',8,'/images/not-found.png'),(51,'TURBOCARGADOR AUTO 3.OA CON CABLE TIPO C','GAR116',120.00,110.00,49.00,'2021-10-22 17:34:07','2023-07-11 14:27:33',8,'/images/not-found.png'),(52,'CARGADOR PARA AUTO DE CARGA RAPIDA CON CABLE V8','GAR089',80.00,70.00,39.00,'2021-10-22 17:34:58','2023-06-05 19:18:16',8,'/images/not-found.png'),(53,'CABLE TIPO APPLE LIGHTNING A 3.5','1200',160.00,150.00,40.00,'2021-10-22 17:40:12','2023-07-07 17:37:43',2,'/images/not-found.png'),(54,'CABLE GENERICO LIGHTNING A 3.5 MRC','1470',150.00,140.00,75.00,'2021-10-22 17:41:44','2021-11-07 12:33:50',9,'/images/not-found.png'),(55,'CABLE GENERICO CON CONTROL DE VOLUMEN LIGTHNING A 3.5','1471',190.00,180.00,100.00,'2021-10-22 17:42:44','2021-11-07 12:34:08',9,'/images/not-found.png'),(56,'CABLE TIPO APPLE IPHONE 4G','1201',70.00,60.00,28.00,'2021-10-22 17:44:45','2023-07-13 17:34:38',2,'/images/not-found.png'),(57,'CABLE TIPO APPLE LIGHTNING 1M','1202',80.00,70.00,52.00,'2021-10-22 17:45:42','2023-07-13 17:35:10',2,'/images/not-found.png'),(58,'CABLE TIPO APPLE LIGHTNING 2M','1203',90.00,80.00,36.00,'2021-10-22 17:46:32','2023-07-13 17:32:03',2,'/images/not-found.png'),(59,'CABLE TIPO C A LIGHTNING 1M','1204',140.00,130.00,70.00,'2021-10-22 17:48:00','2023-07-13 16:39:46',2,'/images/not-found.png'),(60,'CARGADOR APPLE WATCH 2 EN 1','1205',170.00,160.00,100.00,'2021-10-22 17:50:30','2023-07-10 13:05:13',2,'/images/not-found.png'),(61,'CARGADOR MAGNETICO PARA IPHONE','1206',290.00,280.00,170.00,'2021-10-22 17:55:30','2023-06-05 16:57:14',2,'/images/not-found.png'),(62,'COMBO IPHONE 20W TIPO C','1208',250.00,240.00,70.00,'2021-10-22 18:10:58','2023-07-13 17:30:12',2,'/images/not-found.png'),(63,'CUBO TIPO APPLE PARA IPHONE 5w','1209',80.00,70.00,33.00,'2021-10-22 18:12:32','2023-06-05 17:02:05',2,'/images/not-found.png'),(64,'CUBO TIPO APPLE TIPO C 20 W','1210',170.00,160.00,85.00,'2021-10-22 18:14:58','2023-07-13 17:30:37',2,'/images/not-found.png'),(65,'CUBO TIPO APPLE PARA IPAD 12W','1211',185.00,175.00,75.00,'2021-10-22 18:16:13','2023-07-07 18:02:43',2,'/images/not-found.png'),(66,'CABLE V8 HUAWEI','1229',80.00,70.00,30.00,'2021-10-22 18:17:04','2023-07-07 15:35:33',2,'/images/not-found.png'),(67,'CABLE V8 MOTOROLA','1230',80.00,70.00,30.00,'2021-10-22 18:17:49','2023-07-07 15:37:10',2,'/images/not-found.png'),(68,'CABLE V8 SAMSUNG','1231',80.00,70.00,30.00,'2021-10-22 18:18:38','2023-07-07 15:37:35',2,'/images/not-found.png'),(69,'CABLE V8 XIAOMI','1232',80.00,70.00,30.00,'2021-10-22 18:19:20','2023-07-07 18:19:02',2,'/images/not-found.png'),(70,'CARGADOR V8 HUAWEI','1233',130.00,120.00,65.00,'2021-10-22 18:23:41','2023-06-05 17:30:41',2,'/images/not-found.png'),(71,'CARGADOR V8 LG','1234',120.00,110.00,65.00,'2021-10-22 18:27:05','2023-06-05 17:31:40',2,'/images/not-found.png'),(72,'CARGADOR V8 MOTOROLA','1235',130.00,120.00,65.00,'2021-10-22 18:28:42','2023-06-05 18:19:45',2,'/images/not-found.png'),(73,'CARGADOR V8 XIAOMI','1237',130.00,120.00,65.00,'2021-10-22 18:29:28','2023-07-07 15:47:13',2,'/images/not-found.png'),(74,'CARGADOR V8 SAMSUNG','1236',130.00,120.00,53.00,'2021-10-22 18:30:07','2023-06-05 18:20:46',2,'/images/not-found.png'),(75,'CARGADOR MAGNETICO SAMSUNG NEGRO Y BLANCO','1212',350.00,340.00,235.00,'2021-10-22 18:31:05','2021-11-10 17:24:58',2,'/images/not-found.png'),(76,'CARGADOR PARA AUTO NK 6101','1466',50.00,35.00,10.00,'2021-10-24 12:17:37','2021-10-25 19:43:51',9,'/images/not-found.png'),(77,'CUBO ELEGATE','1467',120.00,90.00,40.00,'2021-10-24 12:27:07','2021-10-25 19:53:51',9,'/images/not-found.png'),(78,'AUXILIAR 3M','1469',80.00,70.00,30.00,'2021-10-24 12:42:28','2021-11-07 12:32:54',9,'/images/not-found.png'),(79,'ADAPTADOR DE SIM','1801',40.00,35.00,4.00,'2021-10-24 12:59:53','2023-06-29 16:53:45',6,'/images/not-found.png'),(80,'BOLSAS PARA AGUA','1802',80.00,70.00,15.00,'2021-10-24 13:05:37','2021-11-07 12:39:10',6,'/images/not-found.png'),(81,'POP SOCKET40','1803',40.00,40.00,10.00,'2021-10-24 13:11:14','2021-11-07 12:40:38',6,'/images/not-found.png'),(82,'POP SOCKET65','1804',65.00,60.00,25.00,'2021-10-24 13:12:05','2021-11-07 12:43:39',6,'/images/not-found.png'),(83,'POP SOCKET70','1805',70.00,60.00,30.00,'2021-10-24 13:12:44','2021-11-07 12:44:33',6,'/images/not-found.png'),(84,'PROTECTOR DE CABLE','1810',50.00,40.00,5.00,'2021-10-24 13:14:44','2021-11-07 12:45:04',6,'/images/not-found.png'),(85,'TRIPIE CHICO','1811',100.00,85.00,20.00,'2021-10-24 13:16:31','2021-11-07 12:45:31',6,'/images/not-found.png'),(86,'LAMPARA LED','1812',80.00,70.00,25.00,'2021-10-24 13:18:08','2021-11-07 12:45:57',6,'/images/not-found.png'),(87,'AUDIFONOS 3.5','2501',120.00,100.00,25.00,'2021-10-24 13:26:49','2021-11-07 12:56:41',10,'/images/not-found.png'),(88,'AUDIFONOS 3.5 SONY','2502',150.00,130.00,45.00,'2021-10-24 13:29:53','2021-11-04 19:44:14',10,'/images/not-found.png'),(89,'AUDIFONOS 3.5 J5','2503',60.00,50.00,10.00,'2021-10-24 13:35:40','2021-11-07 13:00:19',10,'/images/not-found.png'),(91,'AUDIFONOS DEPORTIVOS BLUETOOTH','2504',150.00,135.00,40.00,'2021-10-24 13:44:40','2021-11-07 13:00:49',10,'/images/not-found.png'),(92,'AUDIFONOS TIPO C','2505',150.00,135.00,70.00,'2021-10-24 13:48:31','2021-11-07 13:01:03',10,'/images/not-found.png'),(93,'AUDIFONOS LIGHTNING IPHONE X','2506',160.00,150.00,59.00,'2021-10-24 13:54:16','2023-06-06 10:45:05',8,'/images/not-found.png'),(94,'AUDIFONOS HIBRIDOS','2507',220.00,200.00,100.00,'2021-10-24 13:55:44','2021-11-07 13:04:02',10,'/images/not-found.png'),(95,'AUDIFONOS DIADEMA SONY MDR-XB950BT','2508',500.00,480.00,280.00,'2021-10-24 14:12:25','2021-11-07 13:06:50',10,'/images/not-found.png'),(96,'AUDIFONOS DIADEMA LINK BITS ML005','2509',490.00,470.00,250.00,'2021-10-24 14:32:39','2021-11-07 13:21:28',10,'/images/not-found.png'),(97,'AUDIFONOS DIADEMA WIRELES K2','2510',380.00,360.00,150.00,'2021-10-24 14:33:21','2021-11-07 13:22:12',10,'/images/not-found.png'),(98,'BOCINA LAMPARA','5001',250.00,200.00,130.00,'2021-10-25 13:37:01','2021-11-04 14:55:24',12,'/images/not-found.png'),(99,'BOCINA BALON','5002',250.00,200.00,140.00,'2021-10-25 13:37:45','2021-11-04 14:55:44',12,'/images/not-found.png'),(100,'BOCINA BAÑERA','5003',150.00,100.00,50.00,'2021-10-25 13:39:09','2021-11-04 14:56:05',12,'/images/not-found.png'),(101,'LLAVECITA PARA CELULAR','1813',15.00,10.00,4.00,'2021-10-25 13:43:51','2021-10-25 13:43:51',6,'/images/not-found.png'),(102,'PROTECTOR UNIVERSAL CELULAR GOMA','3502',50.00,50.00,15.00,'2021-10-25 14:02:45','2021-11-07 13:41:11',7,'/images/not-found.png'),(103,'CARTERA UNIVERSAL TABLET 8\"','3702',150.00,140.00,70.00,'2021-10-25 14:34:29','2023-06-29 16:16:20',13,'/images/not-found.png'),(105,'CARTERA UNIVERSAL TABLET 7\"','3701',140.00,135.00,60.00,'2021-10-25 14:38:19','2023-06-29 16:15:41',13,'/images/not-found.png'),(106,'ARAÑA 7-8\"','3703',160.00,150.00,85.00,'2021-10-25 15:11:31','2021-11-07 13:47:48',13,'/images/not-found.png'),(107,'ARAÑA 9-10\"','3704',190.00,180.00,85.00,'2021-10-25 15:14:06','2021-11-07 13:48:06',13,'/images/not-found.png'),(108,'GIRATORIA SAMSUNG T110','3801',170.00,140.00,60.00,'2021-10-25 16:18:53','2021-10-25 16:18:53',14,'/images/not-found.png'),(109,'GIRATORIA SAMSUNG T530','3802',170.00,140.00,60.00,'2021-10-25 16:20:48','2021-10-25 16:20:48',14,'/images/not-found.png'),(110,'GIRATORIA IPAD 2-3-4','3803',170.00,140.00,60.00,'2021-10-25 16:21:15','2021-10-25 16:21:15',14,'/images/not-found.png'),(111,'MICA TABLETA 7-8\" 120','MITAB120',120.00,110.00,60.00,'2021-10-25 16:46:05','2021-11-07 12:25:50',21,'/images/not-found.png'),(112,'MICA TABLETA 9-10\" 150','MITAB150',150.00,135.00,80.00,'2021-10-25 16:50:30','2021-11-07 12:28:06',21,'/images/not-found.png'),(113,'MICA TABLETA  12\" 190','MITAB190',190.00,180.00,80.00,'2021-10-25 16:51:45','2021-11-07 12:28:33',21,'/images/not-found.png'),(114,'CABLE GENERICO TIPO C A 3.5','1472',80.00,70.00,35.00,'2021-10-25 18:57:01','2023-06-29 17:26:50',9,'/images/not-found.png'),(115,'CABLE TIPO ORIGINAL NOTE 3 3.0','1241',130.00,120.00,25.00,'2021-10-25 18:59:43','2023-07-07 15:53:11',2,'/images/not-found.png'),(116,'CARGADOR V8 2.4 A','GAR124',100.00,80.00,37.00,'2021-10-25 19:24:19','2023-07-03 17:49:50',8,'/images/not-found.png'),(117,'CABLE MAGNETIVO V8-TC-IP','CAB001',150.00,90.00,30.00,'2021-10-25 19:25:49','2021-10-25 19:25:49',8,'/images/not-found.png'),(118,'CUBO 2 ENTRADAS USB 2.1 A','GAR077',90.00,80.00,35.00,'2021-10-25 19:28:55','2023-06-06 10:46:37',8,'/images/not-found.png'),(119,'CUBO 1 ENTRADA USB 2.4 A','GAR129',100.00,90.00,45.00,'2021-10-25 19:29:52','2021-10-25 19:29:52',8,'/images/not-found.png'),(120,'CABLE GENERICO LIGTHING A 3.5 NCY','1473',150.00,135.00,35.00,'2021-10-25 19:33:26','2021-11-07 12:35:57',9,'/images/not-found.png'),(121,'CARGADOR V8 NCY','1474',70.00,55.00,15.00,'2021-10-25 19:33:57','2021-11-07 12:36:20',9,'/images/not-found.png'),(122,'MULTICARGADOR','1480',60.00,50.00,22.00,'2021-10-25 19:35:28','2023-07-02 12:16:59',8,'/images/not-found.png'),(123,'PLUGIN USB 1 PUERTO','1475',50.00,40.00,10.00,'2021-10-25 19:37:37','2021-11-07 12:36:44',9,'/images/not-found.png'),(124,'RECEPTOR BLUETOOTH','PJ069- 1477',130.00,120.00,33.00,'2021-10-25 19:56:19','2023-07-11 14:20:43',8,'/images/not-found.png'),(125,'AUXILIAR 1M','1468',50.00,40.00,9.00,'2021-10-26 17:42:46','2022-09-25 10:27:51',9,'/images/not-found.png'),(126,'AUDIFONOS 3.5 EXTRA BASS','AUT111',80.00,70.00,33.00,'2021-10-26 18:40:41','2023-06-05 19:30:23',8,'/images/not-found.png'),(127,'AUDIFONOS 3.5 MM','AUT122',75.00,65.00,21.00,'2021-10-26 18:42:54','2023-06-05 19:31:04',8,'/images/not-found.png'),(128,'BATERIA DE RESPALDO 10,000 MAH','GAR140',240.00,230.00,136.50,'2021-10-26 18:45:32','2023-06-05 19:20:25',8,'/images/not-found.png'),(129,'SOPORTE MAGNETICO','PJ093-1478',100.00,90.00,25.00,'2021-10-26 18:55:05','2023-07-11 16:37:50',8,'/images/not-found.png'),(130,'AUDIFONOS 3.5 AKG','2511',100.00,90.00,35.00,'2021-10-26 19:02:40','2023-06-05 19:31:49',8,'/images/not-found.png'),(131,'OTG V8','1814',35.00,35.00,6.00,'2021-10-26 19:42:33','2021-11-07 12:48:36',6,'/images/not-found.png'),(132,'CABLE TIPO C','4000',70.00,60.00,28.00,'2021-10-27 13:30:33','2023-08-09 17:47:56',16,'/images/not-found.png'),(133,'CABLE TIPO C LED','4001',80.00,70.00,35.00,'2021-10-27 13:31:24','2023-08-09 17:48:34',16,'/images/not-found.png'),(134,'CABLE TIPO C 2M 2.1A','4002',80.00,70.00,30.00,'2021-10-27 13:32:23','2023-08-09 17:50:47',16,'/images/not-found.png'),(135,'CARGADOR TIPO C 2.1A','4003',135.00,125.00,50.00,'2021-10-27 13:35:58','2021-11-07 13:55:54',16,'/images/not-found.png'),(136,'CABLE IPHONE 4G','4004',60.00,50.00,20.00,'2021-10-27 13:36:29','2022-05-30 15:53:14',16,'/images/not-found.png'),(137,'CABLE LIGHTNING LED','4005',80.00,70.00,48.00,'2021-10-27 13:38:31','2023-08-09 17:51:31',16,'/images/not-found.png'),(138,'CARGADOR LIGHTNING 2.1 A','4006',135.00,125.00,52.00,'2021-10-27 13:39:54','2021-11-07 13:57:04',16,'/images/not-found.png'),(139,'CARGADOR V3','4007',65.00,55.00,28.00,'2021-10-27 13:43:03','2021-11-07 13:57:19',16,'/images/not-found.png'),(140,'CABLE V8','4008',60.00,50.00,18.00,'2021-10-27 13:53:02','2021-11-07 13:58:17',16,'/images/not-found.png'),(141,'CABLE V8 LED','4009',80.00,70.00,48.00,'2021-10-27 13:53:45','2023-08-09 17:53:14',16,'/images/not-found.png'),(142,'CARGADOR V8 2.1A','4011',120.00,110.00,47.00,'2021-10-27 13:55:34','2023-08-09 17:54:04',16,'/images/not-found.png'),(143,'CABLE TAB SAMSUNG','4012',75.00,65.00,35.00,'2021-10-27 14:52:51','2021-11-07 14:11:35',16,'/images/not-found.png'),(144,'CARGADOR TAB SAMSUNG','4013',135.00,1135.00,60.00,'2021-10-27 14:53:31','2021-11-07 14:12:04',16,'/images/not-found.png'),(145,'CARGADOR A460','4014',90.00,75.00,32.00,'2021-10-27 15:08:27','2021-11-07 14:12:35',16,'/images/not-found.png'),(146,'CARGADOR NOKIA 6101','4015',65.00,55.00,28.00,'2021-10-27 15:13:55','2021-11-07 14:13:42',16,'/images/not-found.png'),(147,'CLAVIJA 3.0 NEGRO Y BLANCO','4016',100.00,90.00,69.00,'2021-10-27 15:14:31','2023-08-09 17:56:08',16,'/images/not-found.png'),(148,'CARGADOR UNIVERSAL','4018',65.00,65.00,35.00,'2021-10-27 15:14:59','2021-11-07 14:33:03',16,'/images/not-found.png'),(149,'PLUGIN V8','4019',70.00,70.00,10.00,'2021-10-27 15:15:53','2021-11-07 14:33:54',16,'/images/not-found.png'),(150,'AUDIFONOS 3.5','4020',90.00,80.00,30.00,'2021-10-27 15:16:24','2021-11-07 14:34:38',16,'/images/not-found.png'),(151,'OTG V8','4021',35.00,35.00,15.00,'2021-10-27 15:16:53','2023-08-09 18:00:20',16,'/images/not-found.png'),(152,'OTG TIPO C','4022',65.00,55.00,20.00,'2021-10-27 15:17:25','2021-11-07 14:36:12',16,'/images/not-found.png'),(153,'LECTOR MEMORIA MICRO SD HUMO','4023',40.00,40.00,17.00,'2021-10-27 15:17:58','2021-11-07 14:36:32',16,'/images/not-found.png'),(154,'MICA LIQUIDA 2ML','4024',150.00,135.00,49.00,'2021-10-27 15:21:07','2021-11-07 14:36:51',16,'/images/not-found.png'),(155,'SOPORTE PARA CELULAR VENTOSA','4025',120.00,110.00,57.00,'2021-10-27 15:22:02','2022-11-27 11:51:50',16,'/images/not-found.png'),(156,'SOPORTE PARA CELULAR VENTILA - BASE PARA AUTO','4026',85.00,75.00,30.00,'2021-10-27 15:23:03','2022-05-30 15:55:22',16,'/images/not-found.png'),(157,'SOPORTE PARA CELULAR MAGNETICO','4027',100.00,70.00,49.00,'2021-10-27 15:25:07','2021-10-27 15:25:07',16,'/images/not-found.png'),(158,'SOPORTE PARA CELULAR BICI','4028',150.00,140.00,83.00,'2021-10-27 15:29:27','2021-11-07 14:38:55',16,'/images/not-found.png'),(159,'RECEPTOR BLUETOOTH','4029',150.00,140.00,59.00,'2021-10-27 15:30:03','2021-11-07 14:40:42',16,'/images/not-found.png'),(160,'TRANSMISOR BLUETOOTH','4030',160.00,160.00,90.00,'2021-10-27 15:31:57','2021-11-07 14:40:58',16,'/images/not-found.png'),(161,'POP SOCKET DISEÑO','4031',40.00,40.00,10.00,'2021-10-27 15:32:39','2021-11-07 14:45:24',16,'/images/not-found.png'),(162,'POP SOCKET LISO NEGRO Y BLANCO','4032',50.00,50.00,12.50,'2021-10-27 15:39:13','2021-11-07 14:45:53',16,'/images/not-found.png'),(163,'POP SOCKET METAL NEGRO - PLATA-ROJO-AZUL-ROSA','4034',60.00,55.00,25.00,'2021-10-27 16:20:23','2021-11-07 14:47:27',16,'/images/not-found.png'),(164,'FUNDA HORIZONTAL 3.5\"','4037',70.00,70.00,39.00,'2021-10-27 16:22:29','2021-11-07 14:48:03',16,'/images/not-found.png'),(165,'FUNDA HORIZONTAL 4.3\" (S2)','4038',70.00,70.00,39.00,'2021-10-27 16:23:08','2021-11-07 14:49:21',16,'/images/not-found.png'),(166,'FUNDA HORIZONTAL 4.8\" (S3)','4039',100.00,90.00,39.00,'2021-10-27 16:24:31','2021-11-07 14:50:11',16,'/images/not-found.png'),(167,'FUNDA HORIZONTAL 5.0\" (G530)','4040',110.00,100.00,49.00,'2021-10-27 16:25:14','2021-11-07 14:50:28',16,'/images/not-found.png'),(168,'FUNDA HORIZONTAL 5.5\" (NOTE 1)','4041',110.00,110.00,59.00,'2021-10-27 16:27:41','2021-11-07 14:51:41',16,'/images/not-found.png'),(174,'FUNDA HORIZONTAL 5.7\" (NOTE.3)','4042',110.00,110.00,59.00,'2021-10-27 16:42:11','2021-11-07 14:52:08',16,'/images/not-found.png'),(175,'FUNDA HORIZONTAL 6.0\"','4043',120.00,120.00,59.00,'2021-10-27 16:49:19','2021-11-07 14:52:30',16,'/images/not-found.png'),(176,'FUNDA HORIZONTAL 6.3\"','4044',125.00,125.00,59.00,'2021-10-27 16:49:49','2021-11-07 14:52:51',16,'/images/not-found.png'),(177,'FUNDA VERTICAL 3.5\"','4045',70.00,70.00,39.00,'2021-10-27 16:50:29','2021-11-07 14:53:08',16,'/images/not-found.png'),(178,'FUNDA VERTICAL 4.3\" (S2)','4046',70.00,70.00,39.00,'2021-10-27 16:51:10','2021-11-07 14:53:34',16,'/images/not-found.png'),(179,'FUNDA VERTICAL 4.8\" (S3)','4047',100.00,90.00,39.00,'2021-10-27 17:02:35','2021-11-07 14:53:55',16,'/images/not-found.png'),(180,'FUNDA VERTICAL 5.0\" (G530)','4048',110.00,100.00,49.00,'2021-10-27 17:03:58','2021-11-07 14:54:14',16,'/images/not-found.png'),(182,'FUNDA VERTICAL 5.5\" (NOTE 1)','4049',110.00,110.00,59.00,'2021-10-27 17:08:45','2021-11-07 14:54:33',16,'/images/not-found.png'),(183,'FUNDA VERTICAL 5.7 (NOTE 3)','4050',110.00,110.00,59.00,'2021-10-27 17:09:33','2021-11-07 14:54:53',16,'/images/not-found.png'),(184,'FUNDA VERTICAL 6.0\"','4051',120.00,120.00,59.00,'2021-10-27 17:13:04','2021-11-07 14:55:10',16,'/images/not-found.png'),(185,'FUNDA VERTICAL 6.3\"','4052',125.00,125.00,59.00,'2021-10-27 17:14:01','2021-11-07 14:55:35',16,'/images/not-found.png'),(186,'FUNDA DEPORTIVA PARA EL BRAZO','4053',120.00,100.00,45.00,'2021-10-27 17:15:20','2021-11-08 10:11:50',16,'/images/not-found.png'),(187,'NICE DUAL FUNDA PARA TABLET 7\"','4054',170.00,160.00,107.00,'2021-10-27 17:17:02','2021-11-08 10:34:50',16,'/images/not-found.png'),(188,'NICE DUAL FUNDA PARA TABLET 8\"','4055',170.00,160.00,107.00,'2021-10-27 17:19:36','2021-11-08 10:13:41',16,'/images/not-found.png'),(189,'NICE DUAL FUNDA PARA TABLET  10\"','4057',190.00,190.00,119.00,'2021-10-27 17:20:45','2021-11-09 14:41:12',16,'/images/not-found.png'),(190,'NICE DUAL FUNDA PARA TABLET 9\"','4056',190.00,190.00,119.00,'2021-10-27 17:23:28','2021-11-09 14:36:35',16,'/images/not-found.png'),(191,'DISEÑO 50','DIS50',50.00,40.00,20.00,'2021-10-27 18:43:34','2021-10-27 18:43:34',1,'/images/not-found.png'),(192,'USO RUDO CELULAR','USO RUDO',100.00,95.00,53.00,'2021-10-29 18:08:03','2023-06-29 16:18:43',17,'/images/not-found.png'),(194,'MICA RELOJ','1300',150.00,135.00,40.00,'2021-10-30 14:16:26','2021-11-07 12:29:03',18,'/images/not-found.png'),(196,'CHIP S/N PAQUETE DE $50','3901',20.00,20.00,1.00,'2021-11-01 17:41:10','2021-11-01 19:49:52',19,'/images/not-found.png'),(197,'CHIP LADA 353 PAQUETE $50','3902',30.00,20.00,1.00,'2021-11-01 17:41:55','2023-06-29 18:45:51',19,'/images/not-found.png'),(198,'LECTOR DE MEMORIA','1815',30.00,30.00,10.00,'2021-11-01 17:52:11','2021-11-07 12:49:02',6,'/images/not-found.png'),(199,'CABLE V8 2M','4058',65.00,65.00,28.00,'2021-11-01 18:13:45','2023-08-09 17:57:36',16,'/images/not-found.png'),(200,'CABLE UNIVERSAL V8/LIGTHNING/TIPO C','4059',100.00,90.00,30.00,'2021-11-01 18:21:31','2021-11-09 14:48:26',16,'/images/not-found.png'),(201,'SOPORTE PARA MOTO RESISTENTE AL AGUA MEDIANA','4060',170.00,160.00,39.00,'2021-11-01 18:49:31','2021-11-09 14:50:34',16,'/images/not-found.png'),(202,'SOPORTE PARA MOTO RESISTENTE AL AGUA GRANDE','4061',190.00,180.00,59.00,'2021-11-01 18:55:02','2021-11-09 14:51:32',16,'/images/not-found.png'),(204,'CARTERA UNIVERSAL','3505',115.00,110.00,45.00,'2021-11-03 18:59:08','2023-06-29 16:08:49',7,'/images/not-found.png'),(205,'CHIP ACTIVATAE PAQUETE $100','3903',50.00,50.00,15.00,'2021-11-03 19:23:30','2023-07-05 19:48:40',19,'/images/not-found.png'),(206,'TPU','6001',50.00,40.00,19.00,'2021-11-03 19:26:57','2021-11-04 14:57:26',20,'/images/not-found.png'),(208,'FUNDA AIR PODS 100','1816',100.00,100.00,60.00,'2021-11-04 19:36:09','2023-06-29 17:46:39',6,'/images/not-found.png'),(209,'FUNDA AIRPODS 160','1817',160.00,160.00,85.00,'2021-11-04 19:36:38','2023-06-29 17:47:44',6,'/images/not-found.png'),(210,'FUNDA AIRPODS 170','1818',170.00,170.00,85.00,'2021-11-04 19:38:01','2023-06-29 17:49:15',6,'/images/not-found.png'),(211,'RELOJ T500 PLUS','1819',570.00,550.00,320.00,'2021-11-04 19:38:41','2022-08-25 18:24:03',6,'/images/not-found.png'),(212,'AUDIFONOS INPODS 12','2519',260.00,250.00,85.00,'2021-11-04 19:39:29','2022-12-21 11:58:38',10,'/images/not-found.png'),(213,'AUDIFONOS 3.5 ADIDAS','2512',150.00,130.00,45.00,'2021-11-04 19:40:14','2021-11-04 19:40:14',10,'/images/not-found.png'),(214,'AUDIFONOS 3.5 JBL','2513',150.00,135.00,45.00,'2021-11-04 19:45:07','2021-11-07 13:25:37',10,'/images/not-found.png'),(215,'AUDIFONOS 3.5  BOSE','2514',150.00,135.00,45.00,'2021-11-04 19:45:48','2021-11-07 13:25:56',10,'/images/not-found.png'),(216,'AUDIFONOS 3.5 BEATS AUDIO','2515',150.00,135.00,45.00,'2021-11-04 19:46:50','2021-11-07 13:35:55',10,'/images/not-found.png'),(217,'AUDIFONOS 3.5 MOTOROLA','2516',150.00,135.00,45.00,'2021-11-04 19:47:25','2021-11-07 13:36:31',10,'/images/not-found.png'),(218,'AUDIFONOS 3.5 SAMSUNG','AKG - 2517',150.00,135.00,45.00,'2021-11-04 19:47:57','2023-07-11 14:03:58',10,'/images/not-found.png'),(219,'AUDOFONOS 3.5 LG','2518',150.00,135.00,45.00,'2021-11-04 19:48:28','2021-11-07 13:39:20',10,'/images/not-found.png'),(220,'AUDIFONOS 3.5 GENERICOS DE PASTILLA','2520',100.00,90.00,45.00,'2021-11-04 19:51:17','2021-11-04 19:51:17',10,'/images/not-found.png'),(221,'CREACION DE CUENTA ICLOUD','6200',70.00,70.00,1.00,'2021-11-04 19:53:48','2021-11-04 19:53:48',22,'/images/not-found.png'),(222,'CREACION DE CUENTA GOOGLE','6201',40.00,40.00,1.00,'2021-11-04 19:54:16','2021-11-04 19:54:16',22,'/images/not-found.png'),(223,'CREACION DE CUENTA AMAZON','6202',70.00,70.00,1.00,'2021-11-04 19:54:42','2021-11-04 19:54:42',22,'/images/not-found.png'),(224,'SERVICIO TECNICO 10','6203',10.00,10.00,1.00,'2021-11-04 19:55:36','2021-11-04 19:55:36',22,'/images/not-found.png'),(225,'SERVICIO TECNICO 20','6204',20.00,20.00,1.00,'2021-11-04 19:56:33','2021-11-04 19:56:33',22,'/images/not-found.png'),(226,'SEVICIO TECNICO 30','6205',30.00,30.00,1.00,'2021-11-04 19:57:03','2021-11-04 19:57:03',22,'/images/not-found.png'),(227,'SERVICIO TECNICO 40','6206',40.00,40.00,1.00,'2021-11-04 19:57:34','2021-11-04 19:57:34',22,'/images/not-found.png'),(228,'SERVICIO TECNICO 50','6207',50.00,50.00,1.00,'2021-11-04 19:58:01','2021-11-04 19:58:01',22,'/images/not-found.png'),(229,'RECUPERACION DE CUENTA ICLOUD','6208',150.00,150.00,1.00,'2021-11-04 19:58:37','2021-11-04 19:58:37',22,'/images/not-found.png'),(230,'RECUPERACION DE CUENTA GOOGLE','6209',70.00,70.00,1.00,'2021-11-04 19:59:04','2021-11-04 19:59:04',22,'/images/not-found.png'),(231,'RECUPERACION DE CUENTA SAMSUNG','6210',100.00,100.00,1.00,'2021-11-04 19:59:27','2021-11-04 19:59:27',22,'/images/not-found.png'),(232,'AUDIFONOS AIRPODS PRO','2521',450.00,420.00,180.00,'2021-11-05 11:42:04','2021-11-05 11:42:04',10,'/images/not-found.png'),(233,'MASSKING IPLAY BANG RECHARGEABLE BATTERY (400 PUF)','1820',350.00,340.00,240.00,'2021-11-05 12:25:36','2023-01-20 15:38:20',6,'/images/not-found.png'),(234,'MINI VENTILADOR','1821',90.00,80.00,40.00,'2021-11-05 12:30:13','2021-11-05 12:30:13',6,'/images/not-found.png'),(235,'CONTROL PARA CELULAR BLUETOOTH','1822',380.00,350.00,200.00,'2021-11-05 14:50:20','2021-11-05 14:50:20',6,'/images/not-found.png'),(236,'CABLE AUXILIAR 1 1/2','1481 AUX-1HR',45.00,35.00,8.00,'2021-11-07 11:57:34','2023-07-11 13:08:43',8,'/images/not-found.png'),(238,'TRIPIE GRANDE','4063',250.00,240.00,129.00,'2021-11-09 14:53:55','2021-11-09 14:58:12',16,'/images/not-found.png'),(239,'CASE ANTI-IMPACTO UNIVERSAL','4064',100.00,90.00,25.00,'2021-11-09 15:00:23','2021-11-09 15:00:23',16,'/images/not-found.png'),(240,'BASTON SELFIE BLUETOOTH','4065',150.00,140.00,60.00,'2021-11-09 15:04:18','2021-11-09 15:04:18',16,'/images/not-found.png'),(241,'LAPIZ TOUCH UNIVERSAL STYLUS','1823',160.00,150.00,160.00,'2021-12-04 13:38:06','2022-01-13 14:20:12',6,'/images/not-found.png'),(242,'AUDIFONOS DIADEMA CAT STN-28','2522',350.00,340.00,4.00,'2021-12-06 15:42:07','2022-10-13 17:28:24',10,'/images/not-found.png'),(243,'AUDIFONOS LIGTHING IPH X AERPODS','2523',480.00,480.00,480.00,'2021-12-06 15:46:23','2022-02-04 15:38:19',10,'/storage/images/2e3fadaf-3003-4b0a-a3ed-0ae6f8666ee0.jpg'),(244,'MEMORIA MICRO SD DE 32GB','1824',125.00,120.00,80.00,'2021-12-06 15:56:48','2023-06-29 18:04:09',6,'/images/not-found.png'),(245,'MEMORIA MICRO SD 64 GB','1825',230.00,220.00,150.00,'2021-12-06 15:58:48','2023-06-29 18:04:58',6,'/images/not-found.png'),(246,'MEMORIA MICRO SD 128 GB','1826',450.00,440.00,0.00,'2021-12-06 16:01:45','2021-12-06 16:01:45',6,'/images/not-found.png'),(247,'MEMORIA MICRO SD 264 GB','1827',0.00,0.00,0.00,'2021-12-06 16:04:37','2021-12-06 16:04:37',6,'/images/not-found.png'),(248,'MEMORIA MICRO SD 16 GB','1828',0.00,0.00,0.00,'2021-12-06 16:05:24','2021-12-06 16:05:24',6,'/images/not-found.png'),(249,'MEMORIA USB 8 GB','1830',0.00,0.00,0.00,'2021-12-06 16:06:53','2021-12-06 16:06:53',6,'/images/not-found.png'),(250,'MEMORIA USB 16 GB','1831',0.00,0.00,0.00,'2021-12-06 16:07:30','2021-12-06 16:07:30',6,'/images/not-found.png'),(251,'MEMORIA USB 32 GB','1832',125.00,120.00,80.00,'2021-12-06 16:08:16','2023-06-29 18:05:49',6,'/images/not-found.png'),(252,'MEMORIA USB 64 GB','1833',230.00,220.00,150.00,'2021-12-06 16:10:01','2023-06-29 18:06:16',6,'/images/not-found.png'),(253,'MASKKING IPLAY MAX (2500 PUFS)','1834',260.00,250.00,110.00,'2021-12-15 17:29:14','2022-11-23 18:18:43',6,'/images/not-found.png'),(254,'MICA DE CRISTAL DE CAMARA TRASERA','1301',150.00,140.00,40.00,'2021-12-20 17:37:38','2023-06-29 17:36:24',23,'/images/not-found.png'),(255,'DISEÑO 250','DIS250',250.00,240.00,150.00,'2021-12-29 15:21:11','2021-12-29 15:21:11',1,'/images/not-found.png'),(256,'POP SOKET FIGURAS DISEÑO (CORAZON, ESTRELLA,ETC)','4035',70.00,65.00,1.00,'2021-12-29 15:52:34','2022-08-31 11:53:11',16,'/images/not-found.png'),(257,'POP SOKET AGUA','4036',65.00,60.00,4.00,'2021-12-29 15:54:39','2021-12-29 15:54:39',16,'/images/not-found.png'),(258,'ADAPTADOR IPHONE AUXILIAR','1601',220.00,210.00,42.00,'2022-01-09 12:18:51','2022-01-09 12:18:51',2,'/images/not-found.png'),(259,'RELOJ INTELIGENTE SMART WATCH T200 PLUS WATCH 7 (FIT PRO)','1835',620.00,610.00,200.00,'2022-02-01 15:32:28','2022-02-01 15:32:28',6,'/storage/images/9a81869c-3540-43b7-9ae5-20db31a902d1.jpg'),(260,'ADAPTADOR DE CLAVIJA','1836',35.00,35.00,10.00,'2022-02-07 14:39:19','2022-02-07 14:39:19',6,'/storage/images/e280c668-b869-47ee-a6e6-17a161f2a8f3.jpg'),(261,'CASE UNIVERSAL DE CELULAR','3507',130.00,120.00,55.00,'2022-02-11 17:30:09','2022-02-11 17:30:09',7,'/images/not-found.png'),(262,'MICA DE PRIVACIDAD','MIPRI',100.00,90.00,55.00,'2022-02-24 18:32:17','2023-07-03 14:44:33',3,'/images/not-found.png'),(263,'AUDIFONOS BLUETOOTH','AUT114',350.00,340.00,188.00,'2022-03-22 18:59:56','2023-08-08 18:45:11',8,'/images/not-found.png'),(264,'AUDIFONO INALAMBRICO','AUT119',390.00,380.00,196.50,'2022-03-22 19:02:15','2022-03-22 19:02:15',8,'/images/not-found.png'),(265,'AUDIFONOS DIADEMA STN28','2525',400.00,420.00,200.00,'2022-03-25 16:49:53','2022-03-25 16:49:53',10,'/images/not-found.png'),(266,'AUDIFONOS DIADEMA POP IT JST806E','2526',400.00,420.00,200.00,'2022-03-25 16:50:47','2022-03-25 16:50:47',10,'/images/not-found.png'),(267,'inpods pro','2524',500.00,480.00,0.00,'2022-04-11 16:25:41','2022-04-11 16:25:41',10,'/images/not-found.png'),(268,'FUNDA AIRPODS PRO LISO','1837',150.00,140.00,0.00,'2022-04-11 16:29:42','2022-04-11 16:29:42',6,'/images/not-found.png'),(269,'CABLE TIPO APPLE LIGTHNING A 3.5','MMX62ZM',220.00,200.00,42.00,'2022-05-11 12:47:51','2022-05-11 12:47:51',8,'/images/not-found.png'),(270,'BOCINA NECNON CON MICROFONO (PINGUINO, BÚHO)','BOCNEC',680.00,650.00,0.00,'2022-05-13 14:25:45','2022-05-13 14:25:45',24,'/images/not-found.png'),(271,'BOCINA DOG DE COLORES','BOCDOG',450.00,420.00,0.00,'2022-05-13 14:29:06','2022-05-13 14:29:06',24,'/images/not-found.png'),(272,'SOPORTE PARA CELULAR CON CARGA INALAMBRICA','GAR157',230.00,220.00,131.00,'2022-05-19 13:22:26','2023-06-29 15:04:27',8,'/images/not-found.png'),(273,'AUDIFONOS CAT BLUETOOTH','AUTCAT',380.00,370.00,0.00,'2022-05-20 15:07:09','2022-10-13 17:27:52',24,'/images/not-found.png'),(274,'PLUGIN IPHONE TIPO C A LIGHTNING','1239',160.00,150.00,84.00,'2022-07-02 10:55:11','2023-06-29 16:29:25',2,'/images/not-found.png'),(275,'AUDIFONOS DISNEY','0460',390.00,380.00,0.00,'2022-07-16 13:14:16','2022-10-13 17:27:10',24,'/images/not-found.png'),(276,'CARGADOR INALAMBRICO 1 HORA','GAR151',190.00,180.00,98.00,'2022-07-27 17:19:31','2023-07-11 13:49:03',8,'/images/not-found.png'),(277,'MICA INDIVIDUAL PARA CAMARA COLORS','1302',150.00,140.00,30.00,'2022-08-31 15:35:03','2022-08-31 15:37:06',23,'/images/not-found.png'),(278,'AUDIFONOS DIADEMA MOREKA-29','2527',440.00,430.00,0.00,'2022-09-29 18:11:33','2022-10-13 17:35:49',10,'/images/not-found.png'),(279,'AUDIFONOS SAMSUNG TIPO C','2528',180.00,170.00,56.00,'2022-10-04 13:38:04','2022-10-04 13:38:04',10,'/images/not-found.png'),(280,'MICE DE CERAMICA','MICE',60.00,50.00,10.00,'2022-12-19 17:16:32','2022-12-19 17:16:32',25,'/images/not-found.png'),(281,'EXTENSIBLES TIE-DYE','7000',180.00,170.00,65.00,'2022-12-20 12:02:15','2022-12-20 12:02:15',26,'/images/not-found.png'),(282,'EXTENSIBLES CON PROTECTOR DE PANTALLA LISOS','7001',200.00,190.00,65.00,'2022-12-20 12:07:42','2022-12-20 12:07:42',26,'/images/not-found.png'),(283,'FUNDA AIRPODS DISEÑO','1838',180.00,170.00,60.00,'2023-01-12 12:52:16','2023-01-12 12:52:16',6,'/images/not-found.png'),(284,'AUDIFONOS 3.5 SAMSUNG ORIGINAL','2529',180.00,170.00,90.00,'2023-01-23 11:20:39','2023-06-29 13:51:18',10,'/images/not-found.png'),(285,'BRACITOS IPAD','3705',380.00,370.00,200.00,'2023-01-27 18:53:02','2023-01-27 18:53:02',13,'/images/not-found.png'),(286,'BRACITOS SAMSUNG HUAWEI','3706',350.00,340.00,200.00,'2023-01-27 18:53:34','2023-01-27 18:53:34',13,'/images/not-found.png'),(287,'AUDIFONOS BLUETHOOT BOSE 951BT','2530',380.00,370.00,230.00,'2023-01-30 11:16:55','2023-01-30 11:16:55',10,'/images/not-found.png'),(288,'AUDIFONOS BLUETHOOT BUDS+','2531',370.00,360.00,220.00,'2023-01-30 11:23:11','2023-01-30 11:23:11',10,'/images/not-found.png'),(289,'BATERIA DE RESPALDO 5,000 mAh','GAR103',170.00,180.00,120.00,'2023-03-27 12:22:01','2023-03-27 12:22:01',8,'/images/not-found.png'),(290,'BATERIA DE RESPALDO 10,000 mAh CON 4 CABLES CON SALIDAS V8,IP, Y TIPO C','GAR148',270.00,260.00,155.00,'2023-03-27 12:28:35','2023-06-05 19:24:29',8,'/images/not-found.png'),(291,'CARGADOR TIPO C A TIPO C SAMSUNG 65W','1238',300.00,290.00,85.00,'2023-03-27 13:02:43','2023-03-27 13:58:45',2,'/images/not-found.png'),(292,'AUDIFONOS BLUETOOTH GALAXY BUDS2 AKG E6S','2532',220.00,230.00,85.00,'2023-03-27 13:32:33','2023-03-27 13:32:33',10,'/images/not-found.png'),(293,'USO RUDO PROMO','6002',70.00,60.00,53.00,'2023-06-29 12:24:24','2023-06-29 12:24:24',17,'/images/not-found.png'),(294,'CARTERA CELULAR PROMO','6003',35.00,30.00,20.00,'2023-06-29 12:29:49','2023-06-29 12:29:49',27,'/images/not-found.png'),(295,'MICA D PROMO','6004',60.00,50.00,15.00,'2023-06-29 12:34:41','2023-06-29 12:34:41',5,'/images/not-found.png'),(296,'MICA VIDRIO PROMO','6005',30.00,20.00,6.00,'2023-06-29 12:35:44','2023-06-29 12:35:44',3,'/images/not-found.png'),(297,'AUDIFONOS CHUPON LIGHTNING','2533',250.00,240.00,120.00,'2023-06-29 14:03:18','2023-06-29 14:03:18',10,'/images/not-found.png'),(298,'BRACITOS TABLET','3880',350.00,340.00,200.00,'2023-06-29 14:22:38','2023-06-29 14:22:38',28,'/images/not-found.png'),(299,'NBHG-DRAGON','2540',720.00,600.00,450.00,'2023-06-29 14:55:38','2023-06-29 14:55:38',10,'/images/not-found.png'),(300,'DISEÑO PERSONALIZADO','12020',170.00,160.00,110.00,'2023-06-29 14:57:24','2023-06-29 15:01:45',1,'/images/not-found.png'),(301,'CARGADOR V8','1476',60.00,50.00,20.00,'2023-06-29 17:04:47','2023-06-29 17:04:47',9,'/images/not-found.png'),(302,'CABLE 1 HORA TIPO C A LIGHTNING','CAB258',95.00,85.00,39.50,'2023-06-29 18:56:58','2023-07-11 13:03:31',8,'/images/not-found.png'),(303,'COMBO IPHONE DOBLE ENTRADA TIPO C 35W','1240',300.00,290.00,130.00,'2023-06-29 18:58:07','2023-07-07 14:49:00',2,'/images/not-found.png'),(304,'CARGADOR TIPO C CUBO Y CABLE CAJA BLANCA','GAR142',120.00,100.00,38.00,'2023-07-01 12:40:56','2023-07-11 12:55:06',8,'/images/not-found.png'),(305,'CARGADOR IPHONE CUBO Y CABLE CAJA BLANCA','GAR143',120.00,110.00,33.50,'2023-07-02 11:59:58','2023-07-03 17:42:48',8,'/images/not-found.png'),(306,'CABLE MAGNETICO','CAB253',100.00,90.00,48.50,'2023-07-02 12:06:53','2023-07-02 12:06:53',8,'/images/not-found.png'),(307,'TURBO CARGADOR PD 20W Y CABLE IP TIPO C A IPHONE','GAR154 GAR155',160.00,150.00,81.50,'2023-07-03 17:46:48','2023-07-03 17:46:48',8,'/images/not-found.png'),(308,'CUBO TIPO APPLE TIPO C 25 W','1242',180.00,170.00,85.00,'2023-07-07 13:36:11','2023-07-13 17:30:54',2,'/images/not-found.png'),(309,'CUBO TIPO APPLE  2 PUERTOS  C + C 35W','1243',220.00,200.00,100.00,'2023-07-07 13:44:01','2023-07-07 13:47:09',2,'/images/not-found.png'),(310,'COMBO IPHONE UNA ENTRADA TIPO C 35 W','1244',270.00,260.00,98.00,'2023-07-07 14:41:31','2023-07-13 17:29:48',2,'/images/not-found.png'),(311,'COMBO TIPO C A TIPO C SAMSUNG 45W','1245',220.00,210.00,120.00,'2023-07-10 12:32:57','2023-07-10 12:32:57',2,'/images/not-found.png'),(312,'CABLE TIPO C A LIGHTNING 2M','1246',150.00,140.00,39.00,'2023-07-10 12:59:08','2023-07-13 17:31:20',2,'/images/not-found.png'),(313,'CABLE .TIPO APPLE TIPO C A TIPO C DE  1M','1247',150.00,140.00,75.00,'2023-07-10 13:02:33','2023-07-10 13:02:33',2,'/images/not-found.png'),(314,'CABLE .TIPO APPLE TIPO C A TIPO C DE  2M','1248',160.00,150.00,85.00,'2023-07-10 13:03:32','2023-07-10 13:03:32',2,'/images/not-found.png'),(315,'CARGADOR APPLE WATCH 3 EN 1','1249',200.00,190.00,120.00,'2023-07-10 13:06:00','2023-07-10 13:06:00',2,'/images/not-found.png'),(316,'TURBO TIPO C A TIPO C 20W','GAR153',160.00,150.00,80.00,'2023-07-11 12:58:51','2023-07-11 12:58:51',8,'/images/not-found.png'),(317,'CTURBO CARGADOR TIPO C PD 25W  SOLO CLAVIJA','GAR201',155.00,145.00,75.00,'2023-07-11 13:24:07','2023-07-11 13:24:07',8,'/images/not-found.png'),(318,'TURBO AUTO TIPO C A TIPO C','GAR156',150.00,140.00,57.00,'2023-07-11 13:39:29','2023-07-11 13:39:29',8,'/images/not-found.png'),(319,'BATERIA 20,000MAH 1HORA','GAR117',360.00,350.00,248.00,'2023-07-11 13:44:04','2023-07-11 13:44:04',8,'/images/not-found.png'),(320,'CARGADOR V8 1AMP','4017',70.00,60.00,25.00,'2023-08-09 12:53:59','2023-08-09 12:53:59',16,'/images/not-found.png'),(321,'CABLE LIGHTNING 1M','4010',70.00,60.00,28.00,'2023-08-09 13:00:19','2023-08-09 13:04:01',16,'/images/not-found.png');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `purchases` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `total` double(8,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inventory_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `purchases_user_id_foreign` (`user_id`),
  KEY `purchases_inventory_id_foreign` (`inventory_id`),
  CONSTRAINT `purchases_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `purchases_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `purchases`
--

LOCK TABLES `purchases` WRITE;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
INSERT INTO `purchases` VALUES (1,8146.00,'completed',3,'2023-06-29 12:22:12','2023-06-29 12:31:43',1),(2,4608.00,'completed',3,'2023-06-29 12:37:07','2023-06-29 12:48:33',1),(3,7465.00,'completed',3,'2023-06-29 12:49:00','2023-06-29 12:49:53',1),(4,15084.00,'completed',3,'2023-06-29 12:50:21','2023-06-29 12:51:14',1),(5,10920.00,'completed',3,'2023-06-29 12:51:36','2023-06-29 12:52:40',1),(6,6.00,'completed',3,'2023-06-29 12:58:47','2023-06-29 12:59:34',1),(7,1738.00,'completed',3,'2023-06-29 13:29:05','2023-06-29 13:38:28',1),(8,90.00,'completed',3,'2023-06-29 13:43:12','2023-06-29 13:43:29',1),(9,129.00,'completed',3,'2023-06-29 13:46:15','2023-06-29 13:46:48',1),(10,360.00,'completed',3,'2023-06-29 14:03:49','2023-06-29 14:04:00',1),(11,3000.00,'completed',3,'2023-06-29 14:24:31','2023-06-29 14:24:42',1),(12,2494.50,'completed',3,'2023-06-29 14:35:10','2023-06-29 14:48:22',1),(13,220.00,'completed',3,'2023-06-29 15:02:11','2023-06-29 15:02:26',1),(14,180.00,'completed',3,'2023-06-29 15:05:36','2023-06-29 15:05:47',1),(15,899.50,'completed',3,'2023-06-29 15:06:01','2023-06-29 15:06:41',1),(16,1395.00,'completed',3,'2023-06-29 16:08:04','2023-06-29 16:08:19',1),(17,645.00,'completed',3,'2023-06-29 16:09:06','2023-06-29 16:10:56',1),(18,571.00,'completed',3,'2023-06-29 16:11:14','2023-06-29 16:12:02',1),(19,270.00,'completed',3,'2023-06-29 16:16:32','2023-06-29 16:16:52',1),(20,2862.00,'completed',3,'2023-06-29 16:18:58','2023-06-29 16:19:11',1),(21,1137.00,'completed',3,'2023-06-29 16:19:25','2023-06-29 16:21:58',1),(22,50.00,'completed',3,'2023-06-29 16:22:57','2023-06-29 16:33:04',1),(23,410.00,'completed',3,'2023-06-29 16:34:03','2023-06-29 16:41:35',1),(24,40.00,'completed',2,'2023-06-29 17:08:08','2023-06-29 17:08:15',1),(25,245.00,'completed',2,'2023-06-29 17:27:19','2023-06-29 17:27:37',1),(26,1530.00,'completed',2,'2023-06-29 17:31:57','2023-06-29 17:34:10',1),(27,720.00,'completed',2,'2023-06-29 17:37:53','2023-06-29 17:38:02',1),(28,1390.00,'completed',2,'2023-06-29 17:50:32','2023-06-29 17:51:05',1),(29,257.00,'completed',2,'2023-06-29 17:54:41','2023-06-29 17:55:38',1),(30,770.00,'completed',2,'2023-06-29 18:06:40','2023-06-29 18:08:50',1),(31,55765.00,'completed',2,'2023-06-29 18:22:57','2023-06-29 18:28:26',1),(32,42.50,'completed',2,'2023-06-29 18:58:39','2023-06-29 18:59:07',1),(33,1430.00,'completed',3,'2023-06-30 10:41:28','2023-06-30 10:42:33',1),(34,12.00,'completed',3,'2023-06-30 10:49:01','2023-06-30 10:50:39',1),(35,125.00,'completed',3,'2023-06-30 10:51:23','2023-06-30 10:52:33',1),(36,84.00,'completed',3,'2023-06-30 10:53:36','2023-06-30 10:55:01',1),(37,87.50,'completed',3,'2023-06-30 10:56:03','2023-06-30 10:57:02',1),(38,1526.00,'completed',2,'2023-07-01 11:00:06','2023-07-01 11:19:28',1),(39,570.00,'completed',2,'2023-07-01 12:00:23','2023-07-01 12:04:23',1),(40,651.00,'completed',2,'2023-07-01 12:06:11','2023-07-01 12:07:04',1),(41,60.00,'completed',2,'2023-07-01 12:08:04','2023-07-01 12:08:22',1),(42,6384.00,'completed',2,'2023-07-01 12:09:15','2023-07-01 12:30:02',1),(43,981.50,'completed',2,'2023-07-01 12:34:10','2023-07-01 12:36:57',1),(44,76.00,'completed',2,'2023-07-01 12:37:51','2023-07-01 12:38:04',1),(45,0.00,'completed',2,'2023-07-01 12:40:56','2023-07-01 12:40:56',1),(46,266.00,'completed',2,'2023-07-02 11:52:07','2023-07-02 11:52:20',1),(47,147.50,'completed',2,'2023-07-02 11:54:11','2023-07-02 11:56:28',1),(48,0.00,'completed',2,'2023-07-02 11:59:58','2023-07-02 11:59:58',1),(49,1040.00,'completed',2,'2023-07-02 12:00:08','2023-07-02 12:05:35',1),(50,0.00,'completed',2,'2023-07-02 12:06:53','2023-07-02 12:06:53',1),(51,244.50,'completed',2,'2023-07-02 12:07:10','2023-07-02 12:07:36',1),(52,98.00,'completed',2,'2023-07-02 12:14:13','2023-07-02 12:14:18',1),(53,116.00,'completed',2,'2023-07-02 12:14:43','2023-07-02 12:15:10',1),(54,80.00,'completed',2,'2023-07-02 12:15:37','2023-07-02 12:16:10',1),(55,35.00,'completed',2,'2023-07-02 12:17:46','2023-07-02 12:17:52',1),(56,88.00,'completed',3,'2023-07-03 14:07:43','2023-07-03 14:08:08',1),(57,130.00,'completed',3,'2023-07-03 14:35:09','2023-07-03 14:35:18',1),(58,0.00,'cancelled',1,'2023-07-03 17:25:50','2023-07-03 17:29:59',NULL),(59,0.00,'completed',2,'2023-07-03 17:46:48','2023-07-03 17:46:49',1),(60,326.00,'completed',2,'2023-07-03 17:46:59','2023-07-03 17:47:12',1),(61,0.00,'completed',2,'2023-07-07 13:36:11','2023-07-07 13:36:11',1),(62,0.00,'completed',2,'2023-07-07 13:44:01','2023-07-07 13:44:01',1),(63,0.00,'completed',2,'2023-07-07 14:41:31','2023-07-07 14:41:32',1),(64,65.00,'completed',2,'2023-07-07 15:03:12','2023-07-07 19:47:59',1),(65,0.00,'completed',2,'2023-07-10 12:32:57','2023-07-10 12:32:57',1),(66,0.00,'completed',2,'2023-07-10 12:59:08','2023-07-10 12:59:08',1),(67,0.00,'completed',2,'2023-07-10 13:02:33','2023-07-10 13:02:33',1),(68,0.00,'completed',2,'2023-07-10 13:03:32','2023-07-10 13:03:32',1),(69,0.00,'completed',2,'2023-07-10 13:06:00','2023-07-10 13:06:00',1),(70,0.00,'completed',2,'2023-07-11 12:58:51','2023-07-11 12:58:51',1),(71,0.00,'completed',2,'2023-07-11 13:24:07','2023-07-11 13:24:07',1),(72,0.00,'completed',2,'2023-07-11 13:39:29','2023-07-11 13:39:29',1),(73,0.00,'completed',2,'2023-07-11 13:44:04','2023-07-11 13:44:04',1),(74,43.50,'completed',2,'2023-07-11 17:40:55','2023-07-11 17:41:09',1),(75,150.00,'completed',2,'2023-07-11 18:20:37','2023-07-11 18:20:47',1),(76,32.00,'completed',2,'2023-07-11 18:26:33','2023-07-11 18:26:43',1),(77,0.00,'pending',3,'2023-07-12 12:11:24','2023-07-12 12:11:24',NULL),(78,572.00,'completed',3,'2023-07-12 12:16:43','2023-07-12 12:24:02',1),(79,1359.00,'completed',2,'2023-07-13 17:09:22','2023-07-13 17:13:01',1),(80,2100.00,'completed',2,'2023-07-14 19:19:08','2023-07-14 19:21:20',1),(81,255.00,'completed',2,'2023-07-14 19:31:46','2023-07-14 19:31:56',1),(82,34.00,'completed',2,'2023-07-14 19:34:50','2023-07-14 19:35:07',1),(83,34.00,'completed',2,'2023-07-14 19:36:10','2023-07-14 19:36:31',1),(84,36.00,'completed',2,'2023-07-16 12:49:10','2023-07-16 12:50:29',1),(85,4925.00,'completed',2,'2023-07-24 14:43:07','2023-07-24 14:45:23',1),(86,255.00,'completed',2,'2023-08-09 12:46:55','2023-08-09 12:47:10',1),(87,50.00,'completed',2,'2023-08-09 12:55:43','2023-08-09 12:55:51',1),(88,56.00,'completed',2,'2023-08-09 17:39:02','2023-08-09 17:39:14',1),(89,56.00,'completed',2,'2023-08-09 17:43:47','2023-08-09 17:43:55',1);
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refunds`
--

DROP TABLE IF EXISTS `refunds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `refunds` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `amount` double(8,2) NOT NULL DEFAULT '0.00',
  `user_id` bigint unsigned NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `products` json NOT NULL,
  `refundable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `refundable_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refunds`
--

LOCK TABLES `refunds` WRITE;
/*!40000 ALTER TABLE `refunds` DISABLE KEYS */;
/*!40000 ALTER TABLE `refunds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_has_permissions`
--

LOCK TABLES `role_has_permissions` WRITE;
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` VALUES (2,2),(7,2),(10,2),(11,2),(15,2),(16,2),(19,2),(20,2),(21,2),(22,2),(24,2),(26,2),(35,2),(42,2),(43,2),(45,2),(46,2),(47,2),(50,2),(53,2);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','web','2023-06-29 12:00:57','2023-06-29 12:00:57'),(2,'VENDEDOR','web','2023-07-03 14:58:41','2023-07-03 14:58:41'),(3,'VENTAS','web','2023-07-03 15:04:14','2023-07-03 15:04:14');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sales` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `total` double(8,2) NOT NULL DEFAULT '0.00',
  `status` enum('pending','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `client_id` bigint unsigned DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inventory_id` bigint unsigned DEFAULT NULL,
  `payment_type` enum('cash','credit') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  PRIMARY KEY (`id`),
  KEY `sales_client_id_foreign` (`client_id`),
  KEY `sales_user_id_foreign` (`user_id`),
  KEY `sales_inventory_id_foreign` (`inventory_id`),
  CONSTRAINT `sales_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE SET NULL,
  CONSTRAINT `sales_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `sales_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=333 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (1,40.00,'completed',NULL,3,'2023-06-29 12:54:23','2023-06-29 12:54:31',1,'cash'),(2,375.00,'completed',NULL,3,'2023-06-29 13:00:40','2023-06-29 19:00:59',1,'cash'),(3,180.00,'completed',NULL,2,'2023-06-29 19:02:01','2023-06-29 19:02:10',1,'cash'),(4,465.00,'completed',NULL,3,'2023-07-03 14:12:51','2023-07-03 14:28:17',1,'cash'),(5,140.00,'completed',NULL,3,'2023-07-03 14:36:57','2023-07-03 14:37:32',1,'cash'),(6,730.00,'completed',NULL,3,'2023-07-03 14:42:01','2023-07-03 14:43:46',1,'cash'),(7,120.00,'completed',NULL,3,'2023-07-03 14:48:17','2023-07-03 14:48:38',1,'cash'),(8,160.00,'completed',NULL,4,'2023-07-03 18:12:16','2023-07-03 18:12:18',1,'cash'),(9,60.00,'completed',NULL,4,'2023-07-04 10:39:05','2023-07-04 10:39:14',1,'cash'),(10,180.00,'completed',NULL,4,'2023-07-04 11:18:13','2023-07-04 11:18:18',1,'cash'),(11,40.00,'completed',NULL,4,'2023-07-04 11:21:45','2023-07-04 11:21:47',1,'cash'),(12,190.00,'completed',NULL,4,'2023-07-04 13:28:27','2023-07-04 13:28:35',1,'cash'),(13,200.00,'completed',NULL,4,'2023-07-04 14:08:59','2023-07-04 14:09:13',1,'cash'),(14,120.00,'completed',NULL,4,'2023-07-05 11:00:26','2023-07-05 11:01:13',1,'cash'),(15,130.00,'completed',NULL,2,'2023-07-05 19:49:03','2023-07-05 19:49:26',1,'cash'),(16,125.00,'completed',NULL,4,'2023-07-06 10:13:47','2023-07-06 10:13:54',1,'cash'),(17,75.00,'completed',NULL,4,'2023-07-06 11:10:46','2023-07-06 11:10:56',1,'cash'),(18,100.00,'completed',NULL,4,'2023-07-06 11:47:18','2023-07-06 11:47:20',1,'cash'),(19,50.00,'completed',NULL,4,'2023-07-06 13:41:21','2023-07-06 13:41:23',1,'cash'),(20,180.00,'completed',NULL,4,'2023-07-06 15:05:21','2023-07-06 15:05:23',1,'cash'),(21,30.00,'completed',NULL,4,'2023-07-07 11:09:46','2023-07-07 11:10:12',1,'cash'),(22,100.00,'completed',NULL,4,'2023-07-07 11:10:33','2023-07-07 11:10:35',1,'cash'),(23,100.00,'completed',NULL,4,'2023-07-07 11:48:03','2023-07-07 12:10:33',1,'cash'),(24,250.00,'completed',NULL,4,'2023-07-07 12:52:40','2023-07-07 12:52:54',1,'cash'),(25,90.00,'completed',NULL,4,'2023-07-07 13:03:43','2023-07-07 13:04:07',1,'cash'),(26,100.00,'completed',NULL,4,'2023-07-07 13:16:27','2023-07-07 13:16:29',1,'cash'),(27,0.00,'pending',NULL,4,'2023-07-07 14:33:40','2023-07-07 14:33:40',1,'cash'),(28,170.00,'completed',NULL,3,'2023-07-07 14:35:27','2023-07-07 14:35:47',1,'cash'),(29,40.00,'completed',NULL,3,'2023-07-07 14:36:38','2023-07-07 14:36:45',1,'cash'),(30,180.00,'completed',NULL,3,'2023-07-07 14:47:15','2023-07-07 14:47:23',1,'cash'),(31,40.00,'completed',NULL,3,'2023-07-07 14:51:54','2023-07-07 14:52:18',1,'cash'),(32,150.00,'completed',NULL,3,'2023-07-07 15:07:50','2023-07-07 15:07:52',1,'cash'),(33,40.00,'completed',NULL,3,'2023-07-07 16:11:05','2023-07-07 16:25:08',1,'cash'),(34,90.00,'completed',NULL,3,'2023-07-07 16:39:53','2023-07-07 16:39:57',1,'cash'),(35,50.00,'completed',NULL,3,'2023-07-07 17:15:05','2023-07-07 17:15:09',1,'cash'),(36,160.00,'completed',NULL,3,'2023-07-07 17:59:56','2023-07-07 17:59:58',1,'cash'),(37,40.00,'completed',NULL,3,'2023-07-07 18:57:51','2023-07-07 18:57:53',1,'cash'),(38,160.00,'completed',NULL,3,'2023-07-07 18:59:38','2023-07-07 19:01:49',1,'cash'),(39,40.00,'completed',NULL,4,'2023-07-09 11:54:02','2023-07-09 11:54:05',1,'cash'),(40,100.00,'completed',NULL,4,'2023-07-09 12:30:09','2023-07-09 12:31:06',1,'cash'),(41,200.00,'completed',NULL,4,'2023-07-09 12:37:48','2023-07-09 12:38:17',1,'cash'),(42,160.00,'completed',NULL,4,'2023-07-09 12:55:04','2023-07-09 12:55:15',1,'cash'),(43,30.00,'completed',NULL,4,'2023-07-09 13:49:10','2023-07-09 13:49:14',1,'cash'),(44,40.00,'completed',NULL,4,'2023-07-09 14:04:32','2023-07-09 14:04:36',1,'cash'),(45,370.00,'completed',NULL,4,'2023-07-09 14:35:11','2023-07-09 14:37:02',1,'cash'),(46,140.00,'completed',NULL,4,'2023-07-09 14:55:23','2023-07-09 14:55:33',1,'cash'),(47,355.00,'completed',NULL,4,'2023-07-09 15:06:14','2023-07-09 15:09:31',1,'cash'),(48,40.00,'completed',NULL,4,'2023-07-10 11:54:36','2023-07-10 11:54:38',1,'cash'),(49,30.00,'completed',NULL,4,'2023-07-10 13:50:25','2023-07-10 13:50:28',1,'cash'),(50,100.00,'completed',NULL,2,'2023-07-10 14:45:15','2023-07-10 14:45:21',1,'cash'),(51,60.00,'completed',NULL,4,'2023-07-10 15:18:06','2023-07-10 15:18:14',1,'cash'),(52,280.00,'completed',NULL,4,'2023-07-10 15:22:06','2023-07-10 15:22:23',1,'cash'),(53,100.00,'completed',NULL,4,'2023-07-10 15:29:05','2023-07-10 15:29:09',1,'cash'),(54,30.00,'completed',NULL,4,'2023-07-10 15:29:44','2023-07-10 15:29:47',1,'cash'),(55,300.00,'completed',NULL,2,'2023-07-10 16:37:04','2023-07-10 16:37:13',1,'cash'),(56,60.00,'completed',NULL,2,'2023-07-10 16:49:10','2023-07-10 16:49:21',1,'cash'),(57,160.00,'completed',NULL,4,'2023-07-10 16:59:16','2023-07-10 16:59:18',1,'cash'),(58,60.00,'completed',NULL,4,'2023-07-10 17:06:25','2023-07-10 17:07:00',1,'cash'),(59,80.00,'completed',NULL,4,'2023-07-10 17:36:51','2023-07-10 17:36:54',1,'cash'),(60,200.00,'completed',NULL,4,'2023-07-10 17:45:46','2023-07-10 17:46:02',1,'cash'),(61,40.00,'completed',NULL,4,'2023-07-10 17:46:09','2023-07-10 17:46:11',1,'cash'),(62,40.00,'completed',NULL,3,'2023-07-11 10:26:30','2023-07-11 10:27:46',1,'cash'),(63,80.00,'completed',NULL,3,'2023-07-11 10:28:25','2023-07-11 10:28:36',1,'cash'),(64,220.00,'completed',NULL,4,'2023-07-11 10:53:25','2023-07-11 10:53:54',1,'cash'),(65,40.00,'completed',NULL,3,'2023-07-11 14:07:03','2023-07-11 14:07:07',1,'cash'),(66,80.00,'completed',NULL,4,'2023-07-11 15:33:26','2023-07-11 15:33:28',1,'cash'),(67,180.00,'completed',NULL,4,'2023-07-11 15:40:50','2023-07-11 15:40:52',1,'cash'),(68,40.00,'completed',NULL,4,'2023-07-11 15:46:23','2023-07-11 15:46:43',1,'cash'),(69,170.00,'completed',NULL,4,'2023-07-11 17:20:47','2023-07-11 17:20:49',1,'cash'),(70,190.00,'completed',NULL,4,'2023-07-11 17:22:04','2023-07-11 17:22:24',1,'cash'),(71,130.00,'completed',NULL,2,'2023-07-11 18:10:32','2023-07-11 18:10:37',1,'cash'),(72,40.00,'completed',NULL,2,'2023-07-11 18:30:29','2023-07-11 18:30:36',1,'cash'),(73,230.00,'completed',NULL,4,'2023-07-11 18:53:12','2023-07-11 18:53:21',1,'cash'),(74,0.00,'pending',NULL,4,'2023-07-12 10:31:22','2023-07-12 10:31:22',1,'cash'),(75,0.00,'pending',NULL,4,'2023-07-12 10:31:22','2023-07-12 10:31:22',1,'cash'),(76,200.00,'completed',NULL,4,'2023-07-12 10:31:55','2023-07-12 10:33:56',1,'cash'),(77,200.00,'completed',NULL,4,'2023-07-12 11:15:51','2023-07-12 12:51:41',1,'cash'),(78,120.00,'completed',NULL,4,'2023-07-12 13:48:51','2023-07-12 13:49:04',1,'cash'),(79,80.00,'completed',NULL,4,'2023-07-12 13:51:22','2023-07-12 13:51:24',1,'cash'),(80,200.00,'completed',NULL,4,'2023-07-12 16:26:46','2023-07-12 16:28:31',1,'cash'),(81,40.00,'completed',NULL,4,'2023-07-12 17:10:04','2023-07-12 17:10:06',1,'cash'),(82,160.00,'completed',NULL,4,'2023-07-12 17:27:02','2023-07-12 17:27:04',1,'cash'),(83,150.00,'completed',NULL,4,'2023-07-12 18:02:35','2023-07-12 18:02:43',1,'cash'),(84,40.00,'completed',NULL,4,'2023-07-12 18:11:34','2023-07-12 18:11:39',1,'cash'),(85,100.00,'completed',NULL,4,'2023-07-12 18:20:41','2023-07-12 18:21:14',1,'cash'),(86,70.00,'completed',NULL,2,'2023-07-12 18:35:51','2023-07-12 18:35:56',1,'cash'),(87,200.00,'completed',NULL,2,'2023-07-12 18:39:38','2023-07-12 18:40:08',1,'cash'),(88,50.00,'completed',NULL,2,'2023-07-12 18:57:45','2023-07-12 18:57:56',1,'cash'),(89,150.00,'completed',NULL,3,'2023-07-13 12:42:16','2023-07-13 12:42:41',1,'cash'),(90,0.00,'pending',NULL,3,'2023-07-13 12:42:16','2023-07-13 12:42:16',1,'cash'),(91,200.00,'completed',NULL,4,'2023-07-13 15:08:15','2023-07-13 15:08:25',1,'cash'),(92,40.00,'completed',NULL,4,'2023-07-13 15:43:39','2023-07-13 15:43:41',1,'cash'),(93,80.00,'completed',NULL,4,'2023-07-13 16:11:10','2023-07-13 16:11:12',1,'cash'),(98,40.00,'pending',NULL,2,'2023-07-13 16:59:56','2023-07-13 17:00:36',1,'cash'),(99,90.00,'completed',NULL,2,'2023-07-13 18:57:41','2023-07-13 19:00:38',1,'cash'),(100,170.00,'completed',NULL,4,'2023-07-14 11:15:29','2023-07-14 11:15:34',1,'cash'),(101,50.00,'completed',NULL,4,'2023-07-14 12:37:11','2023-07-14 12:37:15',1,'cash'),(102,200.00,'completed',NULL,3,'2023-07-14 14:34:49','2023-07-14 14:35:20',1,'cash'),(103,270.00,'completed',NULL,3,'2023-07-14 14:42:54','2023-07-14 14:43:00',1,'cash'),(104,100.00,'completed',NULL,4,'2023-07-14 15:05:44','2023-07-14 15:05:47',1,'cash'),(105,40.00,'completed',NULL,4,'2023-07-14 15:58:57','2023-07-14 15:58:58',1,'cash'),(106,40.00,'completed',NULL,4,'2023-07-14 16:37:36','2023-07-14 16:37:40',1,'cash'),(107,80.00,'completed',NULL,4,'2023-07-14 17:25:59','2023-07-14 17:32:52',1,'cash'),(108,220.00,'completed',NULL,4,'2023-07-14 18:37:38','2023-07-14 18:38:47',1,'cash'),(109,40.00,'completed',NULL,4,'2023-07-14 18:52:56','2023-07-14 18:52:58',1,'cash'),(110,40.00,'completed',NULL,4,'2023-07-14 18:57:26','2023-07-14 18:57:29',1,'cash'),(111,40.00,'completed',NULL,4,'2023-07-16 11:13:20','2023-07-16 11:13:57',1,'cash'),(112,120.00,'completed',NULL,4,'2023-07-16 11:26:24','2023-07-16 11:26:40',1,'cash'),(113,40.00,'completed',NULL,4,'2023-07-16 11:29:47','2023-07-16 11:29:49',1,'cash'),(114,40.00,'completed',NULL,4,'2023-07-16 11:42:03','2023-07-16 11:42:07',1,'cash'),(115,80.00,'completed',NULL,4,'2023-07-16 12:36:17','2023-07-16 12:36:26',1,'cash'),(116,40.00,'completed',NULL,4,'2023-07-16 12:39:35','2023-07-16 12:39:44',1,'cash'),(117,100.00,'completed',NULL,4,'2023-07-16 12:50:42','2023-07-16 12:50:45',1,'cash'),(118,0.00,'pending',NULL,2,'2023-07-16 12:55:58','2023-07-16 12:55:58',1,'cash'),(119,40.00,'completed',NULL,4,'2023-07-16 13:15:57','2023-07-16 13:15:59',1,'cash'),(120,40.00,'completed',NULL,4,'2023-07-16 13:47:56','2023-07-16 13:47:58',1,'cash'),(121,90.00,'completed',NULL,4,'2023-07-16 14:10:54','2023-07-16 14:10:56',1,'cash'),(122,200.00,'completed',NULL,4,'2023-07-17 11:12:50','2023-07-17 11:12:56',1,'cash'),(123,70.00,'completed',NULL,4,'2023-07-17 12:16:26','2023-07-17 12:16:28',1,'cash'),(124,160.00,'completed',NULL,4,'2023-07-17 12:26:24','2023-07-17 12:26:27',1,'cash'),(125,30.00,'completed',NULL,4,'2023-07-17 12:40:13','2023-07-17 12:40:15',1,'cash'),(126,300.00,'completed',NULL,3,'2023-07-17 14:21:38','2023-07-17 14:23:31',1,'cash'),(127,190.00,'completed',NULL,3,'2023-07-17 14:41:02','2023-07-17 14:41:20',1,'cash'),(128,120.00,'completed',NULL,3,'2023-07-17 14:56:36','2023-07-17 14:56:43',1,'cash'),(129,40.00,'completed',NULL,4,'2023-07-17 16:09:52','2023-07-17 16:09:54',1,'cash'),(130,40.00,'completed',NULL,4,'2023-07-17 17:21:22','2023-07-17 17:21:24',1,'cash'),(131,150.00,'completed',NULL,4,'2023-07-17 18:25:05','2023-07-17 18:25:08',1,'cash'),(132,200.00,'completed',NULL,4,'2023-07-18 10:52:32','2023-07-18 10:52:43',1,'cash'),(133,190.00,'completed',NULL,3,'2023-07-18 11:29:08','2023-07-18 11:29:27',1,'cash'),(134,60.00,'completed',NULL,4,'2023-07-18 11:52:57','2023-07-18 11:52:59',1,'cash'),(135,180.00,'completed',NULL,4,'2023-07-18 12:27:53','2023-07-18 12:27:56',1,'cash'),(136,80.00,'completed',NULL,4,'2023-07-18 13:29:42','2023-07-18 13:29:48',1,'cash'),(137,240.00,'completed',NULL,3,'2023-07-18 14:34:21','2023-07-18 14:34:24',1,'cash'),(138,100.00,'completed',NULL,3,'2023-07-18 14:36:40','2023-07-18 14:36:51',1,'cash'),(139,30.00,'completed',NULL,4,'2023-07-18 15:54:42','2023-07-18 15:54:44',1,'cash'),(140,160.00,'completed',NULL,4,'2023-07-18 16:51:59','2023-07-18 16:52:03',1,'cash'),(141,310.00,'completed',NULL,4,'2023-07-18 17:44:46','2023-07-18 17:45:11',1,'cash'),(142,160.00,'completed',NULL,4,'2023-07-18 18:00:24','2023-07-18 18:00:34',1,'cash'),(143,40.00,'completed',NULL,4,'2023-07-18 18:02:41','2023-07-18 18:02:43',1,'cash'),(144,160.00,'completed',NULL,4,'2023-07-18 18:25:26','2023-07-18 18:30:36',1,'cash'),(145,240.00,'completed',NULL,4,'2023-07-18 18:49:45','2023-07-18 18:50:21',1,'cash'),(146,80.00,'completed',NULL,4,'2023-07-19 12:05:12','2023-07-19 12:05:14',1,'cash'),(147,750.00,'completed',NULL,4,'2023-07-19 12:12:39','2023-07-19 12:16:54',1,'cash'),(148,250.00,'completed',NULL,4,'2023-07-19 12:20:28','2023-07-19 12:20:52',1,'cash'),(149,120.00,'completed',NULL,4,'2023-07-19 12:48:00','2023-07-19 12:48:02',1,'cash'),(150,40.00,'completed',NULL,4,'2023-07-19 13:08:51','2023-07-19 13:09:00',1,'cash'),(151,40.00,'completed',NULL,4,'2023-07-19 15:20:22','2023-07-19 15:20:23',1,'cash'),(152,40.00,'completed',NULL,4,'2023-07-19 16:58:38','2023-07-19 16:58:40',1,'cash'),(153,65.00,'completed',NULL,4,'2023-07-19 17:38:22','2023-07-19 17:38:26',1,'cash'),(154,200.00,'completed',NULL,4,'2023-07-19 17:55:11','2023-07-19 17:55:26',1,'cash'),(155,160.00,'completed',NULL,4,'2023-07-19 18:38:44','2023-07-19 18:38:51',1,'cash'),(156,120.00,'completed',NULL,4,'2023-07-19 18:54:09','2023-07-19 18:54:57',1,'cash'),(157,250.00,'completed',NULL,3,'2023-07-20 11:50:16','2023-07-20 11:50:19',1,'cash'),(158,120.00,'completed',NULL,4,'2023-07-20 12:15:54','2023-07-20 12:15:55',1,'cash'),(159,230.00,'completed',NULL,4,'2023-07-20 15:37:11','2023-07-20 15:37:13',1,'cash'),(160,30.00,'completed',NULL,4,'2023-07-20 16:30:47','2023-07-20 16:30:50',1,'cash'),(161,40.00,'completed',NULL,4,'2023-07-20 16:45:15','2023-07-20 16:45:16',1,'cash'),(162,250.00,'completed',NULL,4,'2023-07-20 18:19:23','2023-07-20 18:19:31',1,'cash'),(163,190.00,'completed',NULL,4,'2023-07-21 11:11:25','2023-07-21 11:11:35',1,'cash'),(164,30.00,'completed',NULL,4,'2023-07-21 11:41:10','2023-07-21 11:41:12',1,'cash'),(165,40.00,'completed',NULL,4,'2023-07-21 12:22:59','2023-07-21 12:23:01',1,'cash'),(166,200.00,'completed',NULL,4,'2023-07-21 12:37:49','2023-07-21 12:38:13',1,'cash'),(167,110.00,'completed',NULL,4,'2023-07-21 13:02:54','2023-07-21 13:03:05',1,'cash'),(168,40.00,'pending',NULL,2,'2023-07-21 14:47:05','2023-07-21 14:48:13',1,'cash'),(169,250.00,'completed',NULL,3,'2023-07-21 14:52:45','2023-07-21 14:53:26',1,'cash'),(170,40.00,'completed',NULL,4,'2023-07-21 15:05:54','2023-07-21 15:05:56',1,'cash'),(171,170.00,'completed',NULL,4,'2023-07-21 17:41:35','2023-07-21 17:41:37',1,'cash'),(172,30.00,'completed',NULL,4,'2023-07-21 18:42:52','2023-07-21 18:42:54',1,'cash'),(173,40.00,'completed',NULL,4,'2023-07-21 18:45:26','2023-07-21 18:45:28',1,'cash'),(174,150.00,'completed',NULL,4,'2023-07-21 18:53:33','2023-07-21 18:53:40',1,'cash'),(175,30.00,'completed',NULL,4,'2023-07-23 11:30:01','2023-07-23 11:30:02',1,'cash'),(176,30.00,'completed',NULL,4,'2023-07-23 11:42:52','2023-07-23 11:43:02',1,'cash'),(177,150.00,'completed',NULL,4,'2023-07-23 11:52:34','2023-07-23 11:52:36',1,'cash'),(178,190.00,'completed',NULL,4,'2023-07-23 11:55:55','2023-07-23 11:58:03',1,'cash'),(179,40.00,'completed',NULL,4,'2023-07-23 12:12:58','2023-07-23 12:13:00',1,'cash'),(180,40.00,'completed',NULL,4,'2023-07-23 12:25:11','2023-07-23 12:25:13',1,'cash'),(181,70.00,'completed',NULL,4,'2023-07-23 13:32:42','2023-07-23 13:33:06',1,'cash'),(182,200.00,'completed',NULL,4,'2023-07-23 13:43:21','2023-07-23 13:43:44',1,'cash'),(183,190.00,'completed',NULL,4,'2023-07-23 14:56:32','2023-07-23 14:56:37',1,'cash'),(184,30.00,'completed',NULL,4,'2023-07-24 10:01:56','2023-07-24 10:02:00',1,'cash'),(185,30.00,'completed',NULL,4,'2023-07-24 10:58:57','2023-07-24 10:59:00',1,'cash'),(186,100.00,'completed',NULL,4,'2023-07-24 11:40:57','2023-07-24 11:41:04',1,'cash'),(187,200.00,'completed',NULL,4,'2023-07-24 11:49:46','2023-07-24 11:49:59',1,'cash'),(188,40.00,'completed',NULL,4,'2023-07-24 11:53:11','2023-07-24 11:53:12',1,'cash'),(189,40.00,'completed',NULL,4,'2023-07-24 12:24:28','2023-07-24 12:24:30',1,'cash'),(190,100.00,'completed',NULL,4,'2023-07-24 12:52:08','2023-07-24 12:52:11',1,'cash'),(191,200.00,'completed',NULL,4,'2023-07-24 12:53:34','2023-07-24 12:53:35',1,'cash'),(192,290.00,'completed',NULL,4,'2023-07-24 13:14:39','2023-07-24 13:16:17',1,'cash'),(193,205.00,'completed',NULL,4,'2023-07-24 13:47:24','2023-07-24 13:47:53',1,'cash'),(194,40.00,'completed',NULL,2,'2023-07-24 14:59:38','2023-07-24 14:59:50',1,'cash'),(195,60.00,'completed',NULL,2,'2023-07-24 15:00:03','2023-07-24 15:00:08',1,'cash'),(196,100.00,'completed',NULL,2,'2023-07-24 15:00:23','2023-07-24 15:00:31',1,'cash'),(197,70.00,'completed',NULL,2,'2023-07-24 15:02:34','2023-07-24 15:02:36',1,'cash'),(198,450.00,'completed',NULL,2,'2023-07-24 15:04:03','2023-07-24 15:04:42',1,'cash'),(199,80.00,'completed',NULL,4,'2023-07-24 16:02:05','2023-07-24 16:02:21',1,'cash'),(200,220.00,'completed',NULL,4,'2023-07-24 18:22:26','2023-07-24 18:22:36',1,'cash'),(201,30.00,'completed',NULL,4,'2023-07-24 18:27:07','2023-07-24 18:27:09',1,'cash'),(202,170.00,'completed',NULL,4,'2023-07-24 18:27:38','2023-07-24 18:27:47',1,'cash'),(203,180.00,'completed',NULL,4,'2023-07-25 10:10:39','2023-07-25 10:10:41',1,'cash'),(204,40.00,'completed',NULL,4,'2023-07-25 11:26:42','2023-07-25 11:26:50',1,'cash'),(205,80.00,'completed',NULL,4,'2023-07-25 12:34:22','2023-07-25 12:34:24',1,'cash'),(206,40.00,'completed',NULL,2,'2023-07-25 13:29:27','2023-07-25 13:29:29',1,'cash'),(207,150.00,'completed',NULL,2,'2023-07-25 13:34:44','2023-07-25 13:34:45',1,'cash'),(208,60.00,'completed',NULL,4,'2023-07-26 10:03:41','2023-07-26 10:03:54',1,'cash'),(209,80.00,'completed',NULL,4,'2023-07-26 10:38:56','2023-07-26 10:38:58',1,'cash'),(210,30.00,'completed',NULL,4,'2023-07-26 10:41:56','2023-07-26 10:45:11',1,'cash'),(211,40.00,'completed',NULL,4,'2023-07-26 10:50:09','2023-07-26 10:50:17',1,'cash'),(212,330.00,'completed',NULL,4,'2023-07-26 11:38:16','2023-07-26 11:38:45',1,'cash'),(213,40.00,'completed',NULL,4,'2023-07-26 12:55:14','2023-07-26 12:55:16',1,'cash'),(214,30.00,'completed',NULL,4,'2023-07-26 13:26:45','2023-07-26 13:27:03',1,'cash'),(215,160.00,'completed',NULL,4,'2023-07-26 13:43:08','2023-07-26 13:43:16',1,'cash'),(216,40.00,'completed',NULL,3,'2023-07-26 14:45:35','2023-07-26 14:45:37',1,'cash'),(217,65.00,'completed',NULL,3,'2023-07-26 14:50:32','2023-07-26 14:50:36',1,'cash'),(218,150.00,'completed',NULL,4,'2023-07-26 15:33:12','2023-07-26 15:33:28',1,'cash'),(219,40.00,'completed',NULL,4,'2023-07-26 16:03:00','2023-07-26 16:03:02',1,'cash'),(220,90.00,'completed',NULL,4,'2023-07-26 17:00:54','2023-07-26 17:00:59',1,'cash'),(221,200.00,'completed',NULL,4,'2023-07-26 18:16:59','2023-07-26 18:17:00',1,'cash'),(222,150.00,'completed',NULL,4,'2023-07-27 11:09:37','2023-07-27 11:09:39',1,'cash'),(223,40.00,'completed',NULL,4,'2023-07-27 11:11:28','2023-07-27 11:11:29',1,'cash'),(224,40.00,'completed',NULL,4,'2023-07-27 12:36:56','2023-07-27 12:36:57',1,'cash'),(225,190.00,'completed',NULL,4,'2023-07-27 12:47:30','2023-07-27 12:47:46',1,'cash'),(226,40.00,'completed',NULL,4,'2023-07-27 13:17:42','2023-07-27 13:17:43',1,'cash'),(227,190.00,'completed',NULL,4,'2023-07-27 13:24:26','2023-07-27 13:24:35',1,'cash'),(228,160.00,'completed',NULL,4,'2023-07-27 13:27:30','2023-07-27 13:27:32',1,'cash'),(229,330.00,'completed',NULL,2,'2023-07-27 13:57:26','2023-07-27 13:58:38',1,'cash'),(230,30.00,'completed',NULL,4,'2023-07-27 15:17:40','2023-07-27 15:17:42',1,'cash'),(231,280.00,'completed',NULL,4,'2023-07-27 18:09:14','2023-07-27 18:09:23',1,'cash'),(232,80.00,'completed',NULL,4,'2023-07-27 18:09:30','2023-07-27 18:09:32',1,'cash'),(233,80.00,'completed',NULL,4,'2023-07-27 18:49:22','2023-07-27 18:49:40',1,'cash'),(234,30.00,'completed',NULL,4,'2023-07-28 10:32:57','2023-07-28 10:32:58',1,'cash'),(235,200.00,'completed',NULL,4,'2023-07-28 11:13:44','2023-07-28 11:13:51',1,'cash'),(236,40.00,'completed',NULL,4,'2023-07-28 11:35:57','2023-07-28 11:35:59',1,'cash'),(237,30.00,'completed',NULL,4,'2023-07-28 11:39:43','2023-07-28 11:39:45',1,'cash'),(238,140.00,'completed',NULL,4,'2023-07-28 13:07:23','2023-07-28 13:07:32',1,'cash'),(239,40.00,'completed',NULL,4,'2023-07-28 13:30:06','2023-07-28 13:30:08',1,'cash'),(240,115.00,'completed',NULL,4,'2023-07-28 13:43:15','2023-07-28 13:43:33',1,'cash'),(241,160.00,'completed',NULL,4,'2023-07-30 10:11:06','2023-07-30 10:11:31',1,'cash'),(242,250.00,'completed',NULL,4,'2023-07-30 11:19:07','2023-07-30 11:19:10',1,'cash'),(243,40.00,'completed',NULL,4,'2023-07-30 11:23:44','2023-07-30 11:23:45',1,'cash'),(244,240.00,'completed',NULL,4,'2023-07-30 12:08:51','2023-07-30 12:08:57',1,'cash'),(245,40.00,'completed',NULL,4,'2023-07-30 12:26:04','2023-07-30 12:28:50',1,'cash'),(246,160.00,'completed',NULL,4,'2023-07-30 12:37:07','2023-07-30 12:37:09',1,'cash'),(247,440.00,'completed',NULL,4,'2023-07-30 12:54:28','2023-07-30 12:55:19',1,'cash'),(248,40.00,'completed',NULL,4,'2023-07-30 13:05:20','2023-07-30 13:05:24',1,'cash'),(249,120.00,'completed',NULL,4,'2023-07-30 13:38:41','2023-07-30 13:41:12',1,'cash'),(250,260.00,'completed',NULL,3,'2023-07-31 10:11:00','2023-07-31 10:25:47',1,'cash'),(251,200.00,'completed',NULL,3,'2023-07-31 11:36:49','2023-07-31 11:37:07',1,'cash'),(252,40.00,'completed',NULL,3,'2023-07-31 11:46:45','2023-07-31 11:46:47',1,'cash'),(253,0.00,'pending',NULL,3,'2023-07-31 13:39:36','2023-07-31 13:39:36',1,'cash'),(254,0.00,'pending',NULL,3,'2023-07-31 13:39:36','2023-07-31 13:39:36',1,'cash'),(255,30.00,'completed',NULL,3,'2023-07-31 13:39:49','2023-07-31 13:39:52',1,'cash'),(256,0.00,'pending',NULL,3,'2023-07-31 14:39:03','2023-07-31 14:39:03',1,'cash'),(257,0.00,'pending',NULL,3,'2023-07-31 14:39:03','2023-07-31 14:39:03',1,'cash'),(258,0.00,'pending',NULL,3,'2023-07-31 14:39:03','2023-07-31 14:39:03',1,'cash'),(259,480.00,'completed',NULL,3,'2023-07-31 14:39:16','2023-07-31 14:40:03',1,'cash'),(260,380.00,'completed',NULL,3,'2023-07-31 15:27:53','2023-07-31 15:28:14',1,'cash'),(261,100.00,'completed',NULL,3,'2023-07-31 15:52:33','2023-07-31 15:52:36',1,'cash'),(262,0.00,'pending',NULL,3,'2023-07-31 17:36:12','2023-07-31 17:36:12',1,'cash'),(263,200.00,'completed',NULL,3,'2023-07-31 17:36:12','2023-07-31 17:37:36',1,'cash'),(264,0.00,'pending',NULL,3,'2023-07-31 17:36:12','2023-07-31 17:36:12',1,'cash'),(265,150.00,'completed',NULL,3,'2023-07-31 19:17:18','2023-07-31 19:19:09',1,'cash'),(266,100.00,'completed',NULL,4,'2023-08-01 11:32:52','2023-08-01 11:32:55',1,'cash'),(267,115.00,'completed',NULL,4,'2023-08-01 16:02:15','2023-08-01 16:02:17',1,'cash'),(268,70.00,'completed',NULL,4,'2023-08-01 16:02:30','2023-08-01 16:02:32',1,'cash'),(269,80.00,'completed',NULL,4,'2023-08-01 16:25:53','2023-08-01 16:25:55',1,'cash'),(270,160.00,'completed',NULL,4,'2023-08-01 16:29:01','2023-08-01 16:29:03',1,'cash'),(271,40.00,'completed',NULL,4,'2023-08-01 17:57:58','2023-08-01 17:57:59',1,'cash'),(272,250.00,'completed',NULL,2,'2023-08-01 18:47:33','2023-08-01 18:48:31',1,'cash'),(273,230.00,'completed',NULL,2,'2023-08-01 18:55:54','2023-08-01 19:04:05',1,'cash'),(274,110.00,'completed',NULL,4,'2023-08-02 10:10:23','2023-08-02 10:12:54',1,'cash'),(275,40.00,'completed',NULL,4,'2023-08-02 12:29:26','2023-08-02 12:29:27',1,'cash'),(276,40.00,'completed',NULL,4,'2023-08-02 12:29:31','2023-08-02 12:29:32',1,'cash'),(277,170.00,'completed',NULL,4,'2023-08-02 14:03:23','2023-08-02 14:03:24',1,'cash'),(278,180.00,'completed',NULL,4,'2023-08-02 15:11:09','2023-08-02 15:11:13',1,'cash'),(279,200.00,'completed',NULL,4,'2023-08-02 15:18:49','2023-08-02 15:18:51',1,'cash'),(280,90.00,'completed',NULL,2,'2023-08-02 15:46:16','2023-08-02 15:46:18',1,'cash'),(282,60.00,'completed',NULL,2,'2023-08-02 16:13:09','2023-08-02 16:13:20',1,'cash'),(283,310.00,'completed',NULL,2,'2023-08-02 16:13:44','2023-08-02 16:14:36',1,'cash'),(284,590.00,'completed',NULL,2,'2023-08-03 15:18:39','2023-08-03 15:22:41',1,'cash'),(285,230.00,'completed',NULL,2,'2023-08-03 15:45:18','2023-08-03 15:46:50',1,'cash'),(286,160.00,'completed',NULL,4,'2023-08-03 16:16:26','2023-08-03 17:04:29',1,'cash'),(287,50.00,'completed',NULL,4,'2023-08-03 18:25:59','2023-08-03 18:26:00',1,'cash'),(288,200.00,'completed',NULL,4,'2023-08-03 18:37:58','2023-08-03 18:38:08',1,'cash'),(289,20.00,'completed',NULL,4,'2023-08-04 10:28:28','2023-08-04 10:28:56',1,'cash'),(290,40.00,'completed',NULL,4,'2023-08-04 10:29:28','2023-08-04 10:29:33',1,'cash'),(291,0.00,'pending',NULL,4,'2023-08-04 10:29:28','2023-08-04 10:29:28',1,'cash'),(292,40.00,'completed',NULL,4,'2023-08-04 11:09:56','2023-08-04 11:09:58',1,'cash'),(293,40.00,'completed',NULL,4,'2023-08-04 11:44:52','2023-08-04 11:44:54',1,'cash'),(294,100.00,'completed',NULL,4,'2023-08-04 11:57:56','2023-08-04 11:58:04',1,'cash'),(295,250.00,'completed',NULL,4,'2023-08-04 12:54:51','2023-08-04 12:55:21',1,'cash'),(296,180.00,'completed',NULL,4,'2023-08-06 13:16:52','2023-08-06 13:16:57',1,'cash'),(297,50.00,'completed',NULL,4,'2023-08-06 13:17:13','2023-08-06 13:17:16',1,'cash'),(298,90.00,'completed',NULL,4,'2023-08-06 13:17:30','2023-08-06 13:20:20',1,'cash'),(299,160.00,'completed',NULL,4,'2023-08-06 13:20:37','2023-08-06 13:20:39',1,'cash'),(300,150.00,'completed',NULL,4,'2023-08-06 13:20:45','2023-08-06 13:20:47',1,'cash'),(301,70.00,'completed',NULL,4,'2023-08-06 13:20:59','2023-08-06 13:21:01',1,'cash'),(302,40.00,'completed',NULL,4,'2023-08-06 13:21:10','2023-08-06 13:21:12',1,'cash'),(303,320.00,'completed',NULL,4,'2023-08-06 13:27:35','2023-08-06 13:34:21',1,'cash'),(304,150.00,'completed',NULL,4,'2023-08-06 13:41:24','2023-08-06 13:41:26',1,'cash'),(305,200.00,'completed',NULL,4,'2023-08-06 13:49:50','2023-08-06 13:49:58',1,'cash'),(306,160.00,'completed',NULL,4,'2023-08-06 14:07:54','2023-08-06 14:07:55',1,'cash'),(307,160.00,'completed',NULL,4,'2023-08-06 14:09:21','2023-08-06 14:09:22',1,'cash'),(308,150.00,'completed',NULL,4,'2023-08-06 14:09:57','2023-08-06 14:10:02',1,'cash'),(309,150.00,'completed',NULL,4,'2023-08-06 14:43:05','2023-08-06 14:43:16',1,'cash'),(310,290.00,'completed',NULL,4,'2023-08-07 11:59:48','2023-08-07 12:02:08',1,'cash'),(311,40.00,'completed',NULL,4,'2023-08-07 12:42:07','2023-08-07 12:42:08',1,'cash'),(312,80.00,'completed',NULL,4,'2023-08-07 13:01:27','2023-08-07 13:48:07',1,'cash'),(313,150.00,'completed',NULL,2,'2023-08-07 13:55:40','2023-08-07 13:55:52',1,'cash'),(314,310.00,'completed',NULL,4,'2023-08-07 13:56:49','2023-08-07 13:57:04',1,'cash'),(315,200.00,'completed',NULL,3,'2023-08-07 14:25:45','2023-08-07 14:27:11',1,'cash'),(316,180.00,'completed',NULL,4,'2023-08-07 16:02:23','2023-08-07 17:59:51',1,'cash'),(317,80.00,'completed',NULL,4,'2023-08-07 18:01:17','2023-08-07 18:01:30',1,'cash'),(318,355.00,'completed',NULL,2,'2023-08-08 19:27:44','2023-08-08 19:36:26',1,'cash'),(319,30.00,'completed',NULL,2,'2023-08-08 19:39:42','2023-08-08 19:39:43',1,'cash'),(320,30.00,'completed',NULL,2,'2023-08-08 19:40:09','2023-08-08 19:40:20',1,'cash'),(321,40.00,'completed',NULL,4,'2023-08-09 11:02:06','2023-08-09 11:02:08',1,'cash'),(322,150.00,'completed',NULL,4,'2023-08-09 12:06:23','2023-08-09 12:06:25',1,'cash'),(323,3.00,'completed',NULL,2,'2023-08-09 12:45:12','2023-08-09 12:47:39',1,'cash'),(324,40.00,'completed',NULL,4,'2023-08-09 15:05:56','2023-08-09 15:05:59',1,'cash'),(325,30.00,'completed',NULL,4,'2023-08-09 15:23:41','2023-08-09 15:23:43',1,'cash'),(326,150.00,'completed',NULL,4,'2023-08-09 15:42:12','2023-08-09 15:42:19',1,'cash'),(327,160.00,'completed',NULL,4,'2023-08-09 15:50:35','2023-08-09 15:50:37',1,'cash'),(328,40.00,'completed',NULL,4,'2023-08-09 16:47:30','2023-08-09 16:47:32',1,'cash'),(329,110.00,'completed',NULL,2,'2023-08-09 17:16:47','2023-08-09 17:19:01',1,'cash'),(330,30.00,'completed',NULL,2,'2023-08-09 17:28:03','2023-08-09 17:28:06',1,'cash'),(332,80.00,'completed',NULL,2,'2023-08-09 18:12:07','2023-08-09 18:12:37',1,'cash');
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `settings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'precio_punto','0',1,'2023-06-29 12:00:58','2023-06-29 12:00:58');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tickets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `footer` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tickets`
--

LOCK TABLES `tickets` WRITE;
/*!40000 ALTER TABLE `tickets` DISABLE KEYS */;
INSERT INTO `tickets` VALUES (1,'CHUPIKCELL','HIDALGO 15 A , CENTRO, SAHUAYO, MICH. C.P 59000','3531073878','CHUPIKCELL.... AGRADECE TU PREFERENCIA!!!\nHORARIO CORRIDO \nLUNES A VIERNES 10:00 AM A 7:00 PM\nDOMINGO 10:00AM A 3:00PM',NULL,'2023-06-29 12:00:57','2023-07-07 15:12:35');
/*!40000 ALTER TABLE `tickets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `inventory_id` bigint unsigned DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`),
  KEY `users_inventory_id_foreign` (`inventory_id`),
  CONSTRAINT `users_inventory_id_foreign` FOREIGN KEY (`inventory_id`) REFERENCES `inventories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Santiago Martín OE','admin@saeseg.app',NULL,'$2y$10$/zEUeJem9ZoNqpdwmhZFduJXeb8ruLSfrVKCfnd245fdo7cZZ2bvu',NULL,NULL,NULL,'2023-06-29 12:00:57','2023-06-29 12:00:57',NULL,'admin'),(2,'Ana Franco','ana@gmail.com',NULL,'$2y$10$5/DfavZSyAUIMf0f/8dKvu9MS3pnt3yH.FbzQsG4PT5eFGCuS.nua',NULL,NULL,NULL,'2023-06-29 12:02:23','2023-06-29 12:02:23',NULL,'any'),(3,'JONATHAN','chupipak15@gmail.com',NULL,'$2y$10$rXxj.HW40sLwURHcMr47yebJ7z9iwE/5fGABxvw7EVzq6CtHnDmxi',NULL,NULL,NULL,'2023-06-29 12:20:27','2023-06-29 12:20:27',NULL,'jona'),(4,'MARLEN','jonathan@gmail.com',NULL,'$2y$10$xZrMeCCOABupbvBJzdHZQOk0VDknGJhywgQ/80L.1W5cxQ9WVmT8q',NULL,NULL,NULL,'2023-07-03 15:05:24','2023-07-03 15:05:24',1,'MARLEN');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-08-10  0:48:43
