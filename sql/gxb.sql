-- MariaDB dump 10.18  Distrib 10.4.17-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: gxb
-- ------------------------------------------------------
-- Server version	10.4.17-MariaDB

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
-- Table structure for table `apply`
--

DROP TABLE IF EXISTS `apply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `applicant_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BD2F8C1F8DB60186` (`task_id`),
  KEY `IDX_BD2F8C1F97139001` (`applicant_id`),
  KEY `IDX_BD2F8C1F6BF700BD` (`status_id`),
  CONSTRAINT `FK_BD2F8C1F6BF700BD` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`),
  CONSTRAINT `FK_BD2F8C1F8DB60186` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`),
  CONSTRAINT `FK_BD2F8C1F97139001` FOREIGN KEY (`applicant_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apply`
--

LOCK TABLES `apply` WRITE;
/*!40000 ALTER TABLE `apply` DISABLE KEYS */;
INSERT INTO `apply` VALUES (3,34,69,4,'2021-02-01 20:00:23'),(4,34,67,1,'2021-02-01 20:01:54'),(5,19,4,4,'2021-02-02 12:12:21'),(6,20,4,1,'2021-02-02 12:14:16'),(26,23,4,1,'2021-02-02 12:42:34'),(27,21,4,4,'2021-02-02 12:42:50'),(28,25,4,1,'2021-02-02 12:43:20'),(29,23,72,1,'2021-02-02 13:07:17'),(30,19,72,4,'2021-02-02 13:08:46'),(32,25,72,1,'2021-02-02 13:48:04'),(33,20,72,1,'2021-02-02 13:48:26'),(34,17,4,1,'2021-02-02 20:02:38'),(35,18,4,1,'2021-02-02 20:03:01'),(36,18,4,2,'2021-02-03 12:30:53'),(37,18,4,1,'2021-02-03 12:31:00'),(38,22,4,1,'2021-02-03 15:37:22');
/*!40000 ALTER TABLE `apply` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bid`
--

DROP TABLE IF EXISTS `bid`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4AF2B3F38DB60186` (`task_id`),
  CONSTRAINT `FK_4AF2B3F38DB60186` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bid`
--

LOCK TABLES `bid` WRITE;
/*!40000 ALTER TABLE `bid` DISABLE KEYS */;
/*!40000 ALTER TABLE `bid` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'下载APP','download'),(2,'账号注册','register'),(3,'认证绑卡','authen'),(4,'电商相关','ecomm'),(5,'简单关注','follow'),(6,'简单转发','forward'),(7,'投票/砍价','poll'),(8,'推广引流','promo'),(9,'其它任务','other'),(10,'推广引流',''),(17,'下载APP1',NULL),(18,'test',''),(19,'test1','t1'),(20,'string','string');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `config`
--

DROP TABLE IF EXISTS `config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` double NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `config`
--

LOCK TABLES `config` WRITE;
/*!40000 ALTER TABLE `config` DISABLE KEYS */;
INSERT INTO `config` VALUES (1,'GXB数量',879755,'quantityGXB'),(2,'推广一级奖励',0.08,'referReward'),(3,'推广二级奖励',0.02,'referReward2'),(4,'推广GXB奖励',100,'referGXB'),(5,'主城起步价',1,'mainlandMinPrice'),(6,'领地起步价',0.05,'landMinPrice'),(7,'主城最低天数',10,'mainlandMinDays'),(8,'领地最低天数',20,'landMinDays'),(9,'股权每日最大兑换数量',31531644,'maxPerDay'),(10,'股权交易价格',0.2,'exchangePirce');
/*!40000 ALTER TABLE `config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dividend`
--

DROP TABLE IF EXISTS `dividend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dividend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `total` double NOT NULL,
  `share` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dividend`
--

LOCK TABLES `dividend` WRITE;
/*!40000 ALTER TABLE `dividend` DISABLE KEYS */;
/*!40000 ALTER TABLE `dividend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20210120040510','2021-01-20 04:05:28',102),('DoctrineMigrations\\Version20210120075943','2021-01-20 07:59:52',101),('DoctrineMigrations\\Version20210120104615','2021-01-20 10:46:24',94),('DoctrineMigrations\\Version20210120105615','2021-01-20 10:56:24',384),('DoctrineMigrations\\Version20210120105922','2021-01-20 10:59:29',325),('DoctrineMigrations\\Version20210120110155','2021-01-20 11:02:03',91),('DoctrineMigrations\\Version20210120112955','2021-01-20 11:30:02',275),('DoctrineMigrations\\Version20210120113447','2021-01-20 11:34:54',301),('DoctrineMigrations\\Version20210120113926','2021-01-20 11:39:32',318),('DoctrineMigrations\\Version20210120114436','2021-01-20 11:44:42',453),('DoctrineMigrations\\Version20210120115130','2021-01-20 11:51:37',99),('DoctrineMigrations\\Version20210120120441','2021-01-20 12:04:46',145),('DoctrineMigrations\\Version20210120121103','2021-01-20 12:11:09',38),('DoctrineMigrations\\Version20210120124724','2021-01-20 12:48:04',222),('DoctrineMigrations\\Version20210120153034','2021-01-20 15:30:41',345),('DoctrineMigrations\\Version20210120161946','2021-01-20 16:19:52',121),('DoctrineMigrations\\Version20210120162303','2021-01-20 17:25:42',310),('DoctrineMigrations\\Version20210120164236','2021-01-20 17:35:10',554),('DoctrineMigrations\\Version20210120175643','2021-01-20 17:56:50',554),('DoctrineMigrations\\Version20210120182045','2021-01-20 18:20:48',62),('DoctrineMigrations\\Version20210120182342','2021-01-20 18:24:11',39),('DoctrineMigrations\\Version20210121015504','2021-01-21 01:55:10',80),('DoctrineMigrations\\Version20210121020114','2021-01-21 02:01:20',109),('DoctrineMigrations\\Version20210121021540','2021-01-21 02:15:44',41),('DoctrineMigrations\\Version20210121062133','2021-01-21 06:21:44',41),('DoctrineMigrations\\Version20210121062807','2021-01-21 06:28:14',40),('DoctrineMigrations\\Version20210121064200','2021-01-21 06:42:04',45),('DoctrineMigrations\\Version20210121070321','2021-01-21 07:03:25',113),('DoctrineMigrations\\Version20210121070746','2021-01-21 07:07:50',179),('DoctrineMigrations\\Version20210123025525','2021-01-23 02:55:53',139),('DoctrineMigrations\\Version20210123025743','2021-01-23 02:58:39',138),('DoctrineMigrations\\Version20210123083822','2021-01-23 08:38:27',68),('DoctrineMigrations\\Version20210123195218','2021-01-23 19:52:24',69),('DoctrineMigrations\\Version20210125094123','2021-01-25 09:41:42',207),('DoctrineMigrations\\Version20210126025432','2021-01-26 02:54:43',41),('DoctrineMigrations\\Version20210126042348','2021-01-26 04:24:03',576),('DoctrineMigrations\\Version20210127050512','2021-01-27 05:05:23',701),('DoctrineMigrations\\Version20210127061406','2021-01-27 06:20:49',71),('DoctrineMigrations\\Version20210127062724','2021-01-27 06:27:29',336),('DoctrineMigrations\\Version20210127102534','2021-01-27 10:25:37',38),('DoctrineMigrations\\Version20210201092415','2021-02-01 09:25:54',54),('DoctrineMigrations\\Version20210201092524','2021-02-01 09:27:26',51),('DoctrineMigrations\\Version20210201101949','2021-02-01 10:19:57',229),('DoctrineMigrations\\Version20210201103442','2021-02-01 10:34:50',60),('DoctrineMigrations\\Version20210201115233','2021-02-01 11:52:38',52),('DoctrineMigrations\\Version20210202061054','2021-02-02 06:11:01',54),('DoctrineMigrations\\Version20210202061722','2021-02-02 06:17:29',317),('DoctrineMigrations\\Version20210219002733','2021-02-19 00:27:48',281),('DoctrineMigrations\\Version20210219003942','2021-02-19 00:39:48',917),('DoctrineMigrations\\Version20210219004425','2021-02-19 00:44:33',742);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `equity`
--

DROP TABLE IF EXISTS `equity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `equity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `ratio` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `equity`
--

LOCK TABLES `equity` WRITE;
/*!40000 ALTER TABLE `equity` DISABLE KEYS */;
/*!40000 ALTER TABLE `equity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finance`
--

DROP TABLE IF EXISTS `finance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `finance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `amount` double NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CE28EAE0A76ED395` (`user_id`),
  CONSTRAINT `FK_CE28EAE0A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finance`
--

LOCK TABLES `finance` WRITE;
/*!40000 ALTER TABLE `finance` DISABLE KEYS */;
/*!40000 ALTER TABLE `finance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guide`
--

DROP TABLE IF EXISTS `guide`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guide` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `figure_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CA9EC7358DB60186` (`task_id`),
  CONSTRAINT `FK_CA9EC7358DB60186` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guide`
--

LOCK TABLES `guide` WRITE;
/*!40000 ALTER TABLE `guide` DISABLE KEYS */;
/*!40000 ALTER TABLE `guide` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `land`
--

DROP TABLE IF EXISTS `land`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `land` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A800D5D87E3C61F9` (`owner_id`),
  CONSTRAINT `FK_A800D5D87E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `land`
--

LOCK TABLES `land` WRITE;
/*!40000 ALTER TABLE `land` DISABLE KEYS */;
/*!40000 ALTER TABLE `land` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `land_post`
--

DROP TABLE IF EXISTS `land_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `land_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `land_id` int(11) DEFAULT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `days` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C97E57441994904A` (`land_id`),
  KEY `IDX_C97E57447E3C61F9` (`owner_id`),
  CONSTRAINT `FK_C97E57441994904A` FOREIGN KEY (`land_id`) REFERENCES `land` (`id`),
  CONSTRAINT `FK_C97E57447E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `land_post`
--

LOCK TABLES `land_post` WRITE;
/*!40000 ALTER TABLE `land_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `land_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `land_trade`
--

DROP TABLE IF EXISTS `land_trade`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `land_trade` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `land_id` int(11) DEFAULT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `buyer_id` int(11) DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9C31CD491994904A` (`land_id`),
  KEY `IDX_9C31CD498DE820D9` (`seller_id`),
  KEY `IDX_9C31CD496C755722` (`buyer_id`),
  CONSTRAINT `FK_9C31CD491994904A` FOREIGN KEY (`land_id`) REFERENCES `land` (`id`),
  CONSTRAINT `FK_9C31CD496C755722` FOREIGN KEY (`buyer_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_9C31CD498DE820D9` FOREIGN KEY (`seller_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `land_trade`
--

LOCK TABLES `land_trade` WRITE;
/*!40000 ALTER TABLE `land_trade` DISABLE KEYS */;
/*!40000 ALTER TABLE `land_trade` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `level`
--

DROP TABLE IF EXISTS `level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `task_least` int(11) NOT NULL,
  `post_fee` decimal(3,2) NOT NULL,
  `withdraw_fee` decimal(3,2) NOT NULL,
  `sticky_fee` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `level`
--

LOCK TABLES `level` WRITE;
/*!40000 ALTER TABLE `level` DISABLE KEYS */;
/*!40000 ALTER TABLE `level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `node`
--

DROP TABLE IF EXISTS `node`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `node` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` time NOT NULL,
  `body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `node`
--

LOCK TABLES `node` WRITE;
/*!40000 ALTER TABLE `node` DISABLE KEYS */;
INSERT INTO `node` VALUES (2,'a','00:00:00','111');
/*!40000 ALTER TABLE `node` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `platform`
--

DROP TABLE IF EXISTS `platform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `platform` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `platform`
--

LOCK TABLES `platform` WRITE;
/*!40000 ALTER TABLE `platform` DISABLE KEYS */;
INSERT INTO `platform` VALUES (1,'全部'),(2,'安卓'),(3,'苹果'),(8,'string'),(15,'安卓1');
/*!40000 ALTER TABLE `platform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `report`
--

DROP TABLE IF EXISTS `report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_C42F77848DB60186` (`task_id`),
  CONSTRAINT `FK_C42F77848DB60186` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `report`
--

LOCK TABLES `report` WRITE;
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
/*!40000 ALTER TABLE `report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (1,'待提交',NULL),(2,'审核中',NULL),(3,'不合格',NULL),(4,'已完成',NULL);
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tag`
--

DROP TABLE IF EXISTS `tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tag`
--

LOCK TABLES `tag` WRITE;
/*!40000 ALTER TABLE `tag` DISABLE KEYS */;
INSERT INTO `tag` VALUES (1,'趣省钱','save'),(2,'急速审核',NULL),(3,'趣省钱',''),(10,'趣省钱1',NULL),(11,'急速审核1',NULL),(12,'t1','t2'),(13,'name1',NULL),(14,'name2',NULL);
/*!40000 ALTER TABLE `tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner_id` int(11) NOT NULL,
  `sticky` tinyint(1) DEFAULT NULL,
  `recommended` tinyint(1) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `platform_id` int(11) NOT NULL,
  `showdays` int(11) NOT NULL,
  `approvedays` int(11) NOT NULL,
  `applydays` int(11) NOT NULL,
  `prepaid` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `approved` tinyint(1) NOT NULL,
  `bid_position` int(11) DEFAULT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_527EDB2512469DE2` (`category_id`),
  KEY `IDX_527EDB257E3C61F9` (`owner_id`),
  KEY `IDX_527EDB25FFE6496F` (`platform_id`),
  CONSTRAINT `FK_527EDB2512469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_527EDB257E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  CONSTRAINT `FK_527EDB25FFE6496F` FOREIGN KEY (`platform_id`) REFERENCES `platform` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task`
--

LOCK TABLES `task` WRITE;
/*!40000 ALTER TABLE `task` DISABLE KEYS */;
INSERT INTO `task` VALUES (7,'test','test',5.5,'sdafdsaf',64,0,1,1,2,0,0,0,55,100,'0000-00-00 00:00:00',0,NULL,NULL,NULL),(14,'t2','t2',123,'t2',10,0,1,1,2,5,2,1,55,5,'0000-00-00 00:00:00',0,NULL,NULL,NULL),(16,'test2','test2',5.5,'sdafdsaf',17,1,0,17,15,0,0,0,55,100,'0000-00-00 00:00:00',0,NULL,NULL,NULL),(17,'t3','t3',122,'t3',4,1,0,1,1,3,3,1,55,10,'2021-01-23 08:46:52',0,NULL,NULL,NULL),(18,'t4','t4',123,'t4',4,1,0,1,1,1,1,1,55,1,'2021-01-23 17:20:53',0,NULL,NULL,NULL),(19,'t5','t5',0,'string',4,1,1,1,1,0,0,0,0,0,'2021-01-23 18:13:25',0,NULL,NULL,NULL),(20,'t6','t6',0,'string',6,1,1,1,1,0,0,0,0,0,'2021-01-23 18:14:26',0,NULL,NULL,NULL),(21,'tt2','tt2',123,'tt2',4,1,0,1,1,1,1,1,55,1,'2021-01-24 03:53:31',0,4,NULL,NULL),(22,'tt3','tt3',123,'tt3',4,1,0,1,1,1,1,1,55,1,'2021-01-24 04:00:35',0,3,NULL,NULL),(23,'string','string',0,'string',10,1,1,2,1,0,0,0,0,0,'2021-01-24 04:35:51',0,2,NULL,NULL),(25,'1','1',1,'1',4,1,1,1,1,1,1,1,1,1,'2021-01-28 20:09:41',0,NULL,NULL,NULL),(27,'1','1',1,'1',4,NULL,NULL,2,2,1,1,1,1,1,'2021-02-01 18:25:46',0,NULL,NULL,NULL),(28,'1','1',1,'1',4,0,0,2,2,1,1,1,1,1,'2021-02-01 18:27:02',0,NULL,NULL,NULL),(29,'3','3',3,'3',4,0,0,2,3,3,33,3,3,3,'2021-02-01 18:36:44',0,NULL,NULL,NULL),(30,'4','4',4,'4',4,0,0,4,3,4,4,4,4,4,'2021-02-01 18:37:41',0,NULL,NULL,NULL),(31,'4','4',4,'4',4,0,0,4,3,4,4,4,4,4,'2021-02-01 18:38:01',0,NULL,NULL,NULL),(33,'4','4',4,'',4,0,0,4,3,4,4,4,4,4,'2021-02-01 18:49:24',0,NULL,NULL,NULL),(34,'4','4',4,'1',4,0,0,4,1,4,4,4,4,4,'2021-02-01 18:49:38',1,4,NULL,NULL),(35,'1','1',1,'1',4,0,0,2,3,1,1,1,1,1,'2021-02-02 01:17:18',1,NULL,NULL,NULL);
/*!40000 ALTER TABLE `task` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `task_tag`
--

DROP TABLE IF EXISTS `task_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `task_tag` (
  `task_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`task_id`,`tag_id`),
  KEY `IDX_6C0B4F048DB60186` (`task_id`),
  KEY `IDX_6C0B4F04BAD26311` (`tag_id`),
  CONSTRAINT `FK_6C0B4F048DB60186` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_6C0B4F04BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `task_tag`
--

LOCK TABLES `task_tag` WRITE;
/*!40000 ALTER TABLE `task_tag` DISABLE KEYS */;
INSERT INTO `task_tag` VALUES (7,1),(7,2),(14,1),(16,1),(19,1),(20,1),(20,2),(23,2),(34,1),(34,2);
/*!40000 ALTER TABLE `task_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nick` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance_topup` double DEFAULT NULL,
  `balance_task` double DEFAULT NULL,
  `gxb` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (4,'admin','[\"ROLE_ADMIN\"]','$argon2id$v=19$m=65536,t=4,p=1$5ZzUu7a+RqvIej6V/nm0EQ$ZJEK3TON2q+3d8Wv9uTEWCuISbKkRlskTHJRfKDoD5M','11','25.jpg','11',0,0,0,'2021-02-02 05:04:37'),(6,'a1','[]','111','a1',NULL,'13011111111',NULL,NULL,NULL,NULL),(10,'u1','[\"string\"]','$argon2id$v=19$m=65536,t=4,p=1$2XJMb44QHE6TLEjXIYEKBQ$UboFknsS06I72F62i6PLp1khbZdSPP7i7MXCfTJPyxs','u1','25.jpg','u1',0,0,0,'2021-01-28 03:44:29'),(17,'admin1','[\"ROLE_ADMIN\",\"ROLE_USER\"]','$argon2id$v=19$m=65536,t=4,p=1$KwuNEB1jfiKYQ7CvTBJi8A$DP8nI0tSdTBzNHsdLidAGszXH3smzu8faJmf383MrGg','sdf',NULL,'dasf',0,0,0,NULL),(18,'u2','[]','111','u2','/home/al/w/b.gxb/public/uploads/files/grash.png','111',NULL,NULL,NULL,NULL),(19,'u3','[]','$argon2id$v=19$m=65536,t=4,p=1$o0I86KkD7vhKDojQBcREeA$2BUIcJjiE7oEbrM7rGRrr85nEZEQxC9iJciPKMjakgI','u3','df','111',NULL,NULL,NULL,NULL),(20,'u4','[]','$argon2id$v=19$m=65536,t=4,p=1$Mx2tRdo9DHNePPsEzRCxQw$0k/TubL6l4z2JLtJ1pAB38x0K1FtluzJYHo78OAGoXE','u4',NULL,'13011111111',NULL,NULL,NULL,NULL),(21,'u5','[]','$argon2id$v=19$m=65536,t=4,p=1$qi310ngO6XWFZV1vhdYTUw$Ur28aVBOEt/CGmqfH2QdAxybnJF9ISknqBTdPKjhEiE','u5',NULL,'13011111111',0,0,NULL,NULL),(22,'u6','[]','$argon2id$v=19$m=65536,t=4,p=1$gu9NaN1pZgOBxPm7p6Zdhw$U1EbGZ/6S4dy8zd29VGwUk7F+aiOhKFfYpZNo/TCtTg','u666',NULL,'11111',111,111,1,NULL),(23,'u7','[]','$argon2id$v=19$m=65536,t=4,p=1$ggjMuWczlpJF0v5GwphPww$DUxjBPuXca6/1oxBnsJ5EYCChydo2QWA/hhEfSRwn9c','u7',NULL,'13011111111',0,0,0,NULL),(24,'u8','[]','$argon2id$v=19$m=65536,t=4,p=1$DYIieHC7eRr5FVXRHcWgCg$1KD4Yg14gNg4Lpis0fusWiUkFcQlI1Y9g4MJSSu31h4','u8','/home/al/w/b.gxb/public/uploads/files/25.jpg','13011111111',0,0,0,NULL),(25,'u9','[]','$argon2id$v=19$m=65536,t=4,p=1$25gLAxntEJobRpVOJCOUjw$t7G1fi6C7JPIMfphVqcKicVAShdL0jM+Z2TK3eolKNY','u9','./img/avatar.png','13011111111',0,0,0,NULL),(26,'uu1','[]','$argon2id$v=19$m=65536,t=4,p=1$uaCdRyA3gJnvDK9cLgqqeg$PLKRptjpdz47LcY82o5mGxUJhEs6fMQsM2N10L51y7E','uu1','/home/al/w/b.gxb/public/uploads/files/z.png','111',0,0,0,NULL),(27,'f1','[]','111','f1',NULL,'111',0,0,0,NULL),(30,'f3','[]','f3',NULL,NULL,'1111',0,0,0,NULL),(31,'a','[]','a',NULL,NULL,'a',0,0,0,NULL),(32,'f4','[]','111',NULL,NULL,'111',0,0,0,NULL),(34,'f6','[]','111',NULL,NULL,'111',0,0,0,NULL),(36,'f7','[]','111',NULL,NULL,'111',0,0,0,NULL),(37,'f9','[]','111',NULL,NULL,'111',0,0,0,NULL),(38,'f10','[]','111',NULL,NULL,'111',0,0,0,NULL),(39,'f11','[]','111',NULL,NULL,'111',0,0,0,NULL),(40,'f12','[]','$argon2id$v=19$m=65536,t=4,p=1$0TI1FwvTV4f8osLhNzYmWg$mG/cPn8rIE8aXFUHLTL8y9itajoEzF3zjB3nwaDI+80',NULL,NULL,'111',0,0,0,NULL),(41,'f13','[]','$argon2id$v=19$m=65536,t=4,p=1$PIKlWpyy/6Tru8wxzUkHog$Nl2poTWtNgK1wIObgK7pShxi4OEkTT/IOnRqeQxkKzc',NULL,NULL,'111',0,0,0,NULL),(42,'f14','[]','$argon2id$v=19$m=65536,t=4,p=1$SU1CWxFE6lptTOCceOTVDA$yFE4+JemmU8MahXDTZWNmVznxGvmWpNFIuZmBz7dTrw',NULL,NULL,'111',0,0,0,NULL),(44,'f15','[]','$argon2id$v=19$m=65536,t=4,p=1$/bBZZctEjWHMTwCR7KvSPg$3DAn3A1zG9DrCo6FsEeUb9xwA/MSlN7WcJgF9YsNBG0',NULL,NULL,'111',0,0,0,NULL),(49,'f16','[]','$argon2id$v=19$m=65536,t=4,p=1$2cr9PkrupMaykgb47NDm+g$m8tYW6SHLrM6+BC9ZLi18a/t0cmZ5TFYfNhG8N7gI1A',NULL,NULL,'111',0,0,0,NULL),(50,'f17','[]','$argon2id$v=19$m=65536,t=4,p=1$SV423M5B0UJVy3NOfF02lQ$WSHQo+1iCRE4uXXvfNh+EZXTSWeWRGm2WSWbBv+M2fI',NULL,NULL,'111',0,0,0,NULL),(51,'f18','[]','$argon2id$v=19$m=65536,t=4,p=1$ILDd9xa5RydKkhVjV3kvSg$UKKL6XFATYTV9gXJHHFWLtUb4TEW8881hbt8qw+4XpU',NULL,NULL,'11',0,0,0,NULL),(53,'f20','[]','$argon2id$v=19$m=65536,t=4,p=1$+rkcW4k49r9zbnt57rJswA$68/PsTIV5Db/br0f7jF4C6m/ojKKr7F036YZV2Q54bI',NULL,NULL,'1',0,0,0,NULL),(54,'f21','[]','$argon2id$v=19$m=65536,t=4,p=1$C7fiWbIfkfPiI1Oh9pd1bA$BsUz81dO6fuM2dJmucf781fI93tK47ku78JoZbO5j5Q',NULL,NULL,'1',0,0,0,NULL),(55,'f22','[]','$argon2id$v=19$m=65536,t=4,p=1$sc1zCuCW3VG1r7VPVOZMng$Ss6QpI8ets9KCYOiykZITtMB0UD2/7DhJQtvn/wd5uw',NULL,NULL,'1',0,0,0,NULL),(56,'f23','[]','$argon2id$v=19$m=65536,t=4,p=1$B2MRf3wK+nP00qbtcSy1Tw$Qez/jlrNojJkekquIlmmyyg3Fc8aig0NSwjWGLvwUOM',NULL,NULL,'111',0,0,0,NULL),(57,'f24','[]','$argon2id$v=19$m=65536,t=4,p=1$CCTDJhTo0bYj6OdSfb2y6A$VWipcSfT5DW86vfHGaiBzMEPyUNUZaESUMUiMbut7ik',NULL,NULL,'1',0,0,0,NULL),(58,'f25','[]','$argon2id$v=19$m=65536,t=4,p=1$gLRmTpF718p8J53jv4yccg$mnR0Jv940VtXUm6SCwtx49c0pPcS/JXp93S8QiRLWkc',NULL,NULL,'1',0,0,0,NULL),(60,'f26','[]','$argon2id$v=19$m=65536,t=4,p=1$6buQO+m79kMfywDdJ3lM3Q$Vpmed/Kb6rHsIbSCwb+J3+XGpM/SB4Zi7kQhvvB8Ppw',NULL,NULL,'11',0,0,0,NULL),(62,'f27','[]','$argon2id$v=19$m=65536,t=4,p=1$NQ843uRvLGmwpaL4D1H4bA$aLmww00yoTOBp/VRhWSEUie5i/exWzcRNSVcsbI/1Xo',NULL,NULL,'11',0,0,0,NULL),(63,'f28','[]','$argon2id$v=19$m=65536,t=4,p=1$zf32POd0Exr8p8knlJMrQg$QsZ2Q3A96Ey9iyd7+Y5405DHe0mRZAa0qG2/FFOR7X4',NULL,'/img/avatar.png','1',0,0,0,NULL),(64,'f29','[]','$argon2id$v=19$m=65536,t=4,p=1$X4vyfd2P465aP3sMKSbKgQ$vqPzlRMJ0W0roNP3ym38+HvtK1cSUnLtwOQQjbbU0k8',NULL,'25.jpg','111',0,0,0,'2021-01-27 10:48:21'),(65,'f30','[]','$argon2id$v=19$m=65536,t=4,p=1$kOwfQhgELx/HTHE+AWrgeQ$4Zf8fhYuRSA2PCLgf8HdZPXWUrHOWrll17tmYtbeb2A',NULL,NULL,'111222',0,0,0,NULL),(66,'f31','[]','$argon2id$v=19$m=65536,t=4,p=1$dBmf695ydQA8aGqYBuVAEQ$Cl/CuEr6UF7IMWfTx5NIZ2CQW4ekO8OidD6YwM7yGoM',NULL,NULL,'11',0,0,0,NULL),(67,'f32','[]','$argon2id$v=19$m=65536,t=4,p=1$/DJhkUhOfKiEYgWqVcnRzQ$KgV4f1EgAuw4MjbSTEpvrlFQSb59D7gxdfLk69lv/k4',NULL,'25.jpg','111',0,0,0,'2021-01-27 10:25:51'),(69,'f33','[]','$argon2id$v=19$m=65536,t=4,p=1$2lgYl/hPrrx0I9sutC14Hw$0iuLWNc90LOR+zpNvyY7dU99Ju05Bum67nPxU38yjag',NULL,'25.jpg','11',0,0,0,'2021-01-27 10:26:47'),(71,'f34','[]','$argon2id$v=19$m=65536,t=4,p=1$dBoD1HtDXXRMvVcVAXwSgQ$Zq8Bo8Ip2okjRVnfkPBh5BI4In/wNVHRJwZLEbCJcTY',NULL,'grash.png','111',0,0,0,'2021-01-27 10:39:55'),(72,'d','[]','$argon2id$v=19$m=65536,t=4,p=1$5dRnf67LKY1JKeVVyAbD9g$QgWUtEb7Z9STCeeZnhQS67nAjGCMT17hmIt9KQRCYHM',NULL,'6017de6cefb5a_25.jpg','1',0,0,0,'2021-02-01 10:56:44'),(73,'string','[]','$argon2id$v=19$m=65536,t=4,p=1$+EDrULVbrXYTZI2W1i2Q5Q$UURaSfk5sSV2LOhCtQUUMS0yZ/zP9tLTljpzVaucN1s','string','../../../img/avatar.png','string',0,0,0,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vip`
--

DROP TABLE IF EXISTS `vip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid_id` int(11) DEFAULT NULL,
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `days` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4B076C22534B549B` (`uid_id`),
  CONSTRAINT `FK_4B076C22534B549B` FOREIGN KEY (`uid_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vip`
--

LOCK TABLES `vip` WRITE;
/*!40000 ALTER TABLE `vip` DISABLE KEYS */;
/*!40000 ALTER TABLE `vip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `work`
--

DROP TABLE IF EXISTS `work`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `work` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apply_id` int(11) DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_534E68804DDCCBDE` (`apply_id`),
  CONSTRAINT `FK_534E68804DDCCBDE` FOREIGN KEY (`apply_id`) REFERENCES `apply` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work`
--

LOCK TABLES `work` WRITE;
/*!40000 ALTER TABLE `work` DISABLE KEYS */;
/*!40000 ALTER TABLE `work` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-19 18:40:02
