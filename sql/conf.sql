-- MariaDB dump 10.19  Distrib 10.4.18-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: gxb
-- ------------------------------------------------------
-- Server version	10.4.18-MariaDB

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
-- Table structure for table `conf`
--

DROP TABLE IF EXISTS `conf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `equity` int(11) NOT NULL,
  `refer_reward` double NOT NULL,
  `refer_reward2` double NOT NULL,
  `refer_gxb` smallint(6) NOT NULL,
  `mainland_min_price` double NOT NULL,
  `land_min_price` double NOT NULL,
  `mainland_min_days` smallint(6) NOT NULL,
  `land_min_days` smallint(6) NOT NULL,
  `max_per_day` int(11) NOT NULL,
  `equity_gxbrate` double NOT NULL,
  `equity_price` double NOT NULL,
  `equity_price_max` double NOT NULL,
  `equity_price_min` double NOT NULL,
  `dividend_fund` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf`
--

LOCK TABLES `conf` WRITE;
/*!40000 ALTER TABLE `conf` DISABLE KEYS */;
INSERT INTO `conf` VALUES (1,99999,0.08,0.02,100,1,0.05,1,20,10000,0.001,18.88,1,0.01,100);
/*!40000 ALTER TABLE `conf` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-05-16 13:59:41