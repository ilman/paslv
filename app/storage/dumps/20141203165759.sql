-- MySQL dump 10.13  Distrib 5.5.27, for Win32 (x86)
--
-- Host: localhost    Database: paslv
-- ------------------------------------------------------
-- Server version	5.5.27

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `company_id` int(11) unsigned NOT NULL,
  `client_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `client_title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `client_address` text COLLATE utf8_unicode_ci NOT NULL,
  `client_phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `client_id_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `client_id_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `client_id_expired` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receipts_user_id_index` (`user_id`),
  KEY `receipts_client_id_index` (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,0,0,'Amir Miftahudin 1','Surveyor','Kebon Jeruk','5321735','','','0000-00-00','2014-11-29 09:55:00','2014-11-29 10:01:08',NULL),(2,0,0,'asdad','','','','','','0000-00-00','2014-11-29 10:01:21','2014-11-29 10:01:26','2014-11-29 10:01:26');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `company_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `company_address` text COLLATE utf8_unicode_ci NOT NULL,
  `company_phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `company_fax` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receipts_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,0,'Perseorangan','','','','0000-00-00 00:00:00','0000-00-00 00:00:00',NULL),(2,0,'Kencana Sewu 1','ASDASDAD','12313','12313','2014-11-29 12:01:15','2014-11-29 12:01:34','2014-11-29 12:01:34'),(3,0,'zxczc','asdada','123123','123123','2014-12-03 08:52:32','2014-12-03 08:52:39','2014-12-03 08:52:39');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contracts`
--

DROP TABLE IF EXISTS `contracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contracts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `contract_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `client_json` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `subclient_json` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `company_json` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `content_json` text COLLATE utf8_unicode_ci NOT NULL,
  `employee_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receipts_user_id_index` (`user_id`),
  KEY `receipts_client_id_index` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=COMPACT;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contracts`
--

LOCK TABLES `contracts` WRITE;
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
/*!40000 ALTER TABLE `contracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `invoices`
--

DROP TABLE IF EXISTS `invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `client_id` int(10) unsigned NOT NULL DEFAULT '0',
  `invoice_number` varchar(20) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `invoice_amount` int(20) NOT NULL,
  `invoice_amount_text` text NOT NULL,
  `invoice_text` text NOT NULL,
  `employee_name` varchar(30) NOT NULL,
  `status` enum('default','active') NOT NULL DEFAULT 'default',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `invoices`
--

LOCK TABLES `invoices` WRITE;
/*!40000 ALTER TABLE `invoices` DISABLE KEYS */;
INSERT INTO `invoices` VALUES (1,1,0,'0','',1321322,'Satu Juta Tiga Ratus Dua Puluh Satu Ribu Tiga Ratus Dua Puluh Dua ','test','susi','default','2014-11-26 10:13:18','2014-11-26 03:13:18',NULL),(2,1,0,'0','',0,'','','','default','2014-11-26 03:17:22','2014-11-26 03:17:22',NULL),(3,1,0,'INV/PAS/2014/3','qweqwe',1234567,'Satu Juta Dua Ratus Tiga Puluh Empat Ribu Lima Ratus Enam Puluh Tujuh ','test','ilman','default','2014-11-26 18:05:12','2014-11-26 11:05:12',NULL),(4,1,0,'INV/PAS/2014/4','',345000,'Tiga Ratus Empat Puluh Lima Ribu ','','','default','2014-11-26 18:05:54','2014-11-26 11:05:54',NULL),(5,1,0,'INV/PAS/2014/5','',0,'','','','default','2014-11-26 10:20:47','2014-11-26 03:20:47',NULL),(7,1,1,'','',0,'','','','default','2014-11-27 09:31:43','2014-11-26 12:02:02','2014-11-26 12:02:02'),(8,1,0,'INV/PAS/2014/6','sdfafasfads',1222,'Seribu Dua Ratus Dua Puluh Dua ','asdadsadasdasd','fdgdfgdg','default','2014-11-26 21:54:56','2014-11-26 21:54:56',NULL),(9,1,0,'INV/PAS/2014/9','kencana sewu 1',1900000,'Satu Juta Sembilan Ratus Ribu ','sdfsfsdf\r\nsdfdsf\r\nsdf\r\nsdfs\r\ndf','susi','default','2014-11-28 19:50:26','2014-11-28 12:50:26',NULL),(10,1,0,'INV/PAS/2014/9','kencana sewu',1900000,'Satu Juta Sembilan Ratus Ribu ','sdfsfsdf\r\nsdfdsf\r\nsdf\r\nsdfs\r\ndf','susi','default','2014-11-27 00:06:35','2014-11-27 00:06:35',NULL),(11,1,0,'0','',0,'','','','default','2014-11-27 08:46:28','2014-11-27 08:46:28',NULL),(12,1,0,'INV/PAS/2014/12','asdasdas',12313,'Dua Belas Ribu Tiga Ratus Tiga Belas ','adasdasd','asdadasd','default','2014-11-28 12:50:48','2014-11-28 12:50:48',NULL);
/*!40000 ALTER TABLE `invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kwitansi`
--

DROP TABLE IF EXISTS `kwitansi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kwitansi` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `client_id` int(10) unsigned NOT NULL DEFAULT '0',
  `kwitansi_number` varchar(20) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `kwitansi_amount` int(20) NOT NULL,
  `kwitansi_amount_text` text NOT NULL,
  `kwitansi_text` text NOT NULL,
  `employee_name` varchar(30) NOT NULL,
  `status` enum('default','active') NOT NULL DEFAULT 'default',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kwitansi`
--

LOCK TABLES `kwitansi` WRITE;
/*!40000 ALTER TABLE `kwitansi` DISABLE KEYS */;
INSERT INTO `kwitansi` VALUES (1,1,0,'INV/PAS/2014/1','ilman',2313123,'Dua Juta Tiga Ratus Tiga Belas Ribu Seratus Dua Puluh Tiga ','asdsadasdsad','asdadad','default','2014-11-28 13:11:15','2014-11-28 13:11:15',NULL);
/*!40000 ALTER TABLE `kwitansi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_11_27_081731_create_receipt_table',1),('2014_11_27_081829_create_receipt_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipts`
--

DROP TABLE IF EXISTS `receipts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receipts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `client_id` int(11) unsigned NOT NULL,
  `receipt_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('receive','give') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'receive',
  `client_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `client_address` text COLLATE utf8_unicode_ci NOT NULL,
  `employee_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `content_json` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receipts_user_id_index` (`user_id`),
  KEY `receipts_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipts`
--

LOCK TABLES `receipts` WRITE;
/*!40000 ALTER TABLE `receipts` DISABLE KEYS */;
INSERT INTO `receipts` VALUES (1,0,0,'INV/PAS/2014/1','give','maulana','asdasd','ilman','[{\"desc\":\"<p>asaasdads<\\/p>\",\"note\":\"zxczc\"}]','2014-11-27 08:50:28','2014-11-27 09:47:41',NULL);
/*!40000 ALTER TABLE `receipts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `receipts2`
--

DROP TABLE IF EXISTS `receipts2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `receipts2` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '1',
  `client_id` int(10) unsigned DEFAULT NULL,
  `receipt_number` varchar(50) DEFAULT NULL,
  `receive_from` varchar(50) DEFAULT NULL,
  `given_to` varchar(50) DEFAULT NULL,
  `content_json` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `receipts2`
--

LOCK TABLES `receipts2` WRITE;
/*!40000 ALTER TABLE `receipts2` DISABLE KEYS */;
/*!40000 ALTER TABLE `receipts2` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-03 23:58:01
