-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: localhost    Database: gxb
-- ------------------------------------------------------
-- Server version	5.7.33-log

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
  `max_per_day` int(11) NOT NULL,
  `equity_gxbrate` double NOT NULL,
  `equity_price` double NOT NULL,
  `dividend_fund` int(11) NOT NULL,
  `force_update` tinyint(1) NOT NULL,
  `coins_per_yuan` smallint(6) DEFAULT NULL,
  `coin_threshold` smallint(6) DEFAULT NULL,
  `welcome` longtext COLLATE utf8mb4_unicode_ci,
  `land_price` smallint(6) DEFAULT NULL,
  `main_cell_min_price` double NOT NULL,
  `cell_min_price` double NOT NULL,
  `main_cell_min_days` smallint(6) NOT NULL,
  `cell_min_days` smallint(6) NOT NULL,
  `bid_start` smallint(6) NOT NULL,
  `bid_increment` smallint(6) NOT NULL,
  `buy_now` smallint(6) NOT NULL,
  `exchanged` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conf`
--

LOCK TABLES `conf` WRITE;
/*!40000 ALTER TABLE `conf` DISABLE KEYS */;
INSERT INTO `conf` VALUES (1,1400000000,0.08,0.02,100,100000,1000,10,45350,1,10,300,'<div>欢迎 {{username}} 成为第 {{id}} 位股东！<br><br></div><div>如何玩转达人共享宝？开启睡后管道收入！股权红利实现财富逆袭！<br><br>共享宝共享经济是指拥有闲置资源的机构或个人，将资源使用权有偿让渡给他人，让渡者获取回报，分享者通过分享他人的闲置资源创造价值。<br>一、新人福利篇<br><br>1.新人注册送20元红包<br>2.新人注册送一份股权！开启股权红利！股权可参与每日分红！<br><br>二、股东和股权篇<br><br>1.新人注册成为股东；送股权参与分红！股权越多分红越多！<br>2.股东大会；运维方与股东交流沟通的渠道！<br>3.股东话题；股东可以发表自己的意见和看法，一起探讨达人共享宝未来发展方向！<br>4.股权兑换；初始兑换比率为1000，随着股东人数的增加比率也上涨！<br>5.交换市场；股权可以自由交易！<br>6.邀请一名股东奖励100币兑换成股权参与分红！<br>7.拉新排行榜奖励大量股权！<br>三、任务与资源篇<br><br>1.平台每天更新海量任务!用户不仅可以自己做任务赚钱还可以收徒赚钱！<br>2.管道收入；推广1级好友返佣8%，推广2级好友返佣2%.真真的实现睡后管道收入实现躺赢！<br>3.推广的下线发布任务，做任务都有佣金！<br>4.火爆的小视频推广任务(完播点赞、评论、关注、收藏、转发、直播间任务)助力、砍价、投票任务……注册、下载app、电商相关、问卷调查等很多类型的任务<br>5.首页竞价；快速提高知名度！<br>6.提现简单方便；1元即可提现！<br><br>四、城市社区张贴栏篇<br>1.城市社区张贴栏 ；宣传圈粉 、 扩客引流 、店铺宣传 、公司招聘、 房屋出租 、开业庆典 !房产中介， 特色美食、 生活服务 ……<br>2.用户浏览社区张贴栏可获得金币，参与每周分红！<br>五、分红篇<br>1.做任务不仅拿现金奖励还额外奖励金币参与分红！<br>2.浏览社区张贴栏得海量金币！<br>3.金币越多分红越多！<br>六、劲爆活动篇<br>1.达人共享宝创意视频比赛:(长期有效)<br>第一名1000元<br>第二名500元<br>第三名200元<br>幸运奖50元(30名)<br>以上活动每月开奖一次！</div><div><br></div>',5000,0.5,0.05,1,20,500,200,8800,10800);
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

-- Dump completed on 2021-06-03 11:59:56
