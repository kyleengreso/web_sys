-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: websys
-- ------------------------------------------------------
-- Server version	8.0.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `audit_trail`
--

DROP TABLE IF EXISTS `audit_trail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `audit_trail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `activity` enum('login','logout','register') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_email` (`email`),
  CONSTRAINT `fk_user_email` FOREIGN KEY (`email`) REFERENCES `user` (`email`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_trail`
--

LOCK TABLES `audit_trail` WRITE;
/*!40000 ALTER TABLE `audit_trail` DISABLE KEYS */;
INSERT INTO `audit_trail` VALUES (1,'kenroger2@gmail.com','2025-04-28 18:36:04','register'),(2,'dale@gmail.com','2025-04-28 18:37:05','register'),(3,'kenroger2@gmail.com','2025-04-28 18:41:10','login'),(4,'202280348@psu.palawan.edu.ph','2025-04-28 18:58:09','login'),(5,'laurence@gmail.com','2025-04-28 19:09:36','register'),(6,'siradz@gmail.com','2025-04-28 19:10:40','register'),(7,'siradz@gmail.com','2025-04-28 19:10:48','login');
/*!40000 ALTER TABLE `audit_trail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `mobile_number` (`mobile_number`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Kyle','Seva','Engreso','202280348@psu.palawan.edu.ph','09166265021','$2y$10$SyfFlDHpWr.px1Zr7elXuOfXN9Xmh3K5ZZ3KGRovOVlvsTVTDkYVC','2025-04-28 18:24:49'),(2,'Ken Roger','Severino','Domingo','kenroger2@gmail.com','09234123456','$2y$10$6Lp0QXs83TrvIjtlx7Dt/O9siIRhJ/LrPcEuzeTELYXQBCVGsix3G','2025-04-28 18:36:04'),(4,'Dale','Tablate','Alie','dale@gmail.com','09348572819','$2y$10$l5pc865UvaVlxAr3WOArZ.Pt0PSHKnz4wwBBnfs6LGqXJIqKE.6yi','2025-04-28 18:37:05'),(6,'Laurence','Gonzales','Tabang','laurence@gmail.com','093485827182','$2y$10$xWwxNRQ6IWB.N5ishMFCje4zfnh6DdULlam9F7VWw3RAs/LDcRW3a','2025-04-28 19:09:36'),(7,'Siradz','Mama','Sahiddin','siradz@gmail.com','093847281728','$2y$10$53dC3BFN.ZO7l7u0Gau3yeyi5RLR5.SIPbfaSwL7463iBCL1OZX8.','2025-04-28 19:10:40');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-06 21:36:33
