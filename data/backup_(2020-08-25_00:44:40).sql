-- MariaDB dump 10.17  Distrib 10.4.13-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: CacheServices
-- ------------------------------------------------------
-- Server version	10.4.13-MariaDB-1:10.4.13+maria~bionic

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
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3102 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (3001,'Titre de l\'article N: 1','Content de l\'article N: 1 ','15.jpg','2020-09-11 14:37:37',0),(3002,'Titre de l\'article N: 2','Content de l\'article N: 2 ','12.jpg','2021-02-21 22:56:56',0),(3003,'Titre de l\'article N: 3','Content de l\'article N: 3 ','11.jpg','2019-06-15 20:47:47',0),(3004,'Titre de l\'article N: 4','Content de l\'article N: 4 ','16.jpg','2020-05-27 18:44:44',1),(3005,'Titre de l\'article N: 5','Content de l\'article N: 5 ','13.jpg','2020-01-17 20:17:17',1),(3006,'Titre de l\'article N: 6','Content de l\'article N: 6 ','10.jpg','2020-11-25 04:38:38',0),(3007,'Titre de l\'article N: 7','Content de l\'article N: 7 ','12.jpg','2020-05-15 08:37:37',1),(3008,'Titre de l\'article N: 8','Content de l\'article N: 8 ','17.jpg','2021-11-15 03:04:04',0),(3009,'Titre de l\'article N: 9','Content de l\'article N: 9 ','12.jpg','2021-06-11 07:26:26',0),(3010,'Titre de l\'article N: 10','Content de l\'article N: 10 ','16.jpg','2019-06-16 03:28:28',0),(3011,'Titre de l\'article N: 11','Content de l\'article N: 11 ','18.jpg','2021-12-16 19:38:38',0),(3012,'Titre de l\'article N: 12','Content de l\'article N: 12 ','10.jpg','2019-08-28 02:56:56',0),(3013,'Titre de l\'article N: 13','Content de l\'article N: 13 ','21.jpg','2020-06-17 02:31:31',1),(3014,'Titre de l\'article N: 14','Content de l\'article N: 14 ','13.jpg','2020-02-11 20:58:58',1),(3015,'Titre de l\'article N: 15','Content de l\'article N: 15 ','21.jpg','2019-11-02 19:16:16',0),(3016,'Titre de l\'article N: 16','Content de l\'article N: 16 ','20.jpg','2020-04-26 01:15:15',1),(3017,'Titre de l\'article N: 17','Content de l\'article N: 17 ','16.jpg','2020-10-05 16:32:32',0),(3018,'Titre de l\'article N: 18','Content de l\'article N: 18 ','14.jpg','2021-02-27 07:09:09',0),(3019,'Titre de l\'article N: 19','Content de l\'article N: 19 ','13.jpg','2021-09-09 08:01:01',0),(3020,'Titre de l\'article N: 20','Content de l\'article N: 20 ','15.jpg','2019-04-02 05:22:22',0),(3021,'Titre de l\'article N: 21','Content de l\'article N: 21 ','11.jpg','2020-05-27 01:55:55',1),(3022,'Titre de l\'article N: 22','Content de l\'article N: 22 ','20.jpg','2019-05-28 22:24:24',0),(3023,'Titre de l\'article N: 23','Content de l\'article N: 23 ','20.jpg','2021-08-23 22:07:07',0),(3024,'Titre de l\'article N: 24','Content de l\'article N: 24 ','14.jpg','2019-10-13 08:52:52',0),(3025,'Titre de l\'article N: 25','Content de l\'article N: 25 ','10.jpg','2020-02-24 23:39:39',1),(3026,'Titre de l\'article N: 26','Content de l\'article N: 26 ','12.jpg','2019-11-13 22:06:06',0),(3027,'Titre de l\'article N: 27','Content de l\'article N: 27 ','14.jpg','2021-03-06 14:42:42',0),(3028,'Titre de l\'article N: 28','Content de l\'article N: 28 ','10.jpg','2020-03-25 15:22:22',1),(3029,'Titre de l\'article N: 29','Content de l\'article N: 29 ','18.jpg','2021-12-25 04:34:34',0),(3030,'Titre de l\'article N: 30','Content de l\'article N: 30 ','21.jpg','2020-04-30 10:18:18',1),(3031,'Titre de l\'article N: 31','Content de l\'article N: 31 ','18.jpg','2019-05-31 19:32:32',0),(3032,'Titre de l\'article N: 32','Content de l\'article N: 32 ','13.jpg','2020-01-07 03:15:15',1),(3033,'Titre de l\'article N: 33','Content de l\'article N: 33 ','17.jpg','2020-01-15 19:24:24',1),(3034,'Titre de l\'article N: 34','Content de l\'article N: 34 ','16.jpg','2020-01-31 17:01:00',1),(3035,'Titre de l\'article N: 35','Content de l\'article N: 35 ','13.jpg','2019-02-04 14:58:58',0),(3036,'Titre de l\'article N: 36','Content de l\'article N: 36 ','20.jpg','2021-01-20 12:10:10',0),(3037,'Titre de l\'article N: 37','Content de l\'article N: 37 ','18.jpg','2019-06-28 14:22:22',0),(3038,'Titre de l\'article N: 38','Content de l\'article N: 38 ','20.jpg','2021-03-14 23:53:53',0),(3039,'Titre de l\'article N: 39','Content de l\'article N: 39 ','15.jpg','2019-11-28 16:46:46',0),(3040,'Titre de l\'article N: 40','Content de l\'article N: 40 ','15.jpg','2020-12-17 23:53:53',0),(3041,'Titre de l\'article N: 41','Content de l\'article N: 41 ','12.jpg','2019-11-21 15:03:03',0),(3042,'Titre de l\'article N: 42','Content de l\'article N: 42 ','15.jpg','2021-04-06 02:21:21',0),(3043,'Titre de l\'article N: 43','Content de l\'article N: 43 ','15.jpg','2020-01-21 09:36:36',1),(3044,'Titre de l\'article N: 44','Content de l\'article N: 44 ','20.jpg','2020-10-02 18:33:33',0),(3045,'Titre de l\'article N: 45','Content de l\'article N: 45 ','13.jpg','2021-02-25 19:59:59',0),(3046,'Titre de l\'article N: 46','Content de l\'article N: 46 ','14.jpg','2021-09-26 15:05:05',0),(3047,'Titre de l\'article N: 47','Content de l\'article N: 47 ','11.jpg','2021-06-19 15:35:35',0),(3048,'Titre de l\'article N: 48','Content de l\'article N: 48 ','17.jpg','2020-12-04 00:44:44',0),(3049,'Titre de l\'article N: 49','Content de l\'article N: 49 ','10.jpg','2021-02-28 23:17:17',0),(3050,'Titre de l\'article N: 50','Content de l\'article N: 50 ','13.jpg','2020-05-24 08:09:09',1),(3051,'Titre de l\'article N: 51','Content de l\'article N: 51 ','14.jpg','2021-09-27 17:01:01',0),(3052,'Titre de l\'article N: 52','Content de l\'article N: 52 ','12.jpg','2019-03-25 10:43:43',0),(3053,'Titre de l\'article N: 53','Content de l\'article N: 53 ','11.jpg','2019-12-13 21:27:27',0),(3054,'Titre de l\'article N: 54','Content de l\'article N: 54 ','14.jpg','2021-12-28 16:56:56',0),(3055,'Titre de l\'article N: 55','Content de l\'article N: 55 ','18.jpg','2020-10-09 02:13:13',0),(3056,'Titre de l\'article N: 56','Content de l\'article N: 56 ','18.jpg','2020-12-25 10:38:38',0),(3057,'Titre de l\'article N: 57','Content de l\'article N: 57 ','21.jpg','2021-08-05 14:40:40',0),(3058,'Titre de l\'article N: 58','Content de l\'article N: 58 ','10.jpg','2020-09-28 14:57:57',0),(3059,'Titre de l\'article N: 59','Content de l\'article N: 59 ','20.jpg','2021-09-16 09:28:28',0),(3060,'Titre de l\'article N: 60','Content de l\'article N: 60 ','19.jpg','2020-05-31 17:17:17',1),(3061,'Titre de l\'article N: 61','Content de l\'article N: 61 ','18.jpg','2021-10-23 22:44:44',0),(3062,'Titre de l\'article N: 62','Content de l\'article N: 62 ','19.jpg','2019-04-24 09:11:11',0),(3063,'Titre de l\'article N: 63','Content de l\'article N: 63 ','10.jpg','2019-11-25 10:36:36',0),(3064,'Titre de l\'article N: 64','Content de l\'article N: 64 ','13.jpg','2019-06-09 23:38:38',0),(3065,'Titre de l\'article N: 65','Content de l\'article N: 65 ','13.jpg','2020-02-03 15:54:54',1),(3066,'Titre de l\'article N: 66','Content de l\'article N: 66 ','11.jpg','2020-12-12 04:20:20',0),(3067,'Titre de l\'article N: 67','Content de l\'article N: 67 ','11.jpg','2021-01-16 23:50:50',0),(3068,'Titre de l\'article N: 68','Content de l\'article N: 68 ','21.jpg','2021-04-08 22:03:03',0),(3069,'Titre de l\'article N: 69','Content de l\'article N: 69 ','17.jpg','2021-06-26 13:58:58',0),(3070,'Titre de l\'article N: 70','Content de l\'article N: 70 ','17.jpg','2019-06-15 15:29:29',0),(3071,'Titre de l\'article N: 71','Content de l\'article N: 71 ','17.jpg','2021-02-22 18:53:53',0),(3072,'Titre de l\'article N: 72','Content de l\'article N: 72 ','11.jpg','2020-09-21 18:12:12',0),(3073,'Titre de l\'article N: 73','Content de l\'article N: 73 ','10.jpg','2019-02-22 05:03:03',0),(3074,'Titre de l\'article N: 74','Content de l\'article N: 74 ','10.jpg','2019-03-12 15:16:16',0),(3075,'Titre de l\'article N: 75','Content de l\'article N: 75 ','10.jpg','2021-10-16 05:02:02',0),(3076,'Titre de l\'article N: 76','Content de l\'article N: 76 ','12.jpg','2019-11-12 20:21:21',0),(3077,'Titre de l\'article N: 77','Content de l\'article N: 77 ','20.jpg','2020-11-26 01:07:07',0),(3078,'Titre de l\'article N: 78','Content de l\'article N: 78 ','15.jpg','2021-01-21 03:31:31',0),(3079,'Titre de l\'article N: 79','Content de l\'article N: 79 ','17.jpg','2020-10-28 16:40:40',0),(3080,'Titre de l\'article N: 80','Content de l\'article N: 80 ','12.jpg','2020-07-28 03:54:54',0),(3081,'Titre de l\'article N: 81','Content de l\'article N: 81 ','21.jpg','2019-02-18 13:41:41',0),(3082,'Titre de l\'article N: 82','Content de l\'article N: 82 ','14.jpg','2021-05-25 23:41:41',0),(3083,'Titre de l\'article N: 83','Content de l\'article N: 83 ','14.jpg','2021-11-12 00:09:09',0),(3084,'Titre de l\'article N: 84','Content de l\'article N: 84 ','17.jpg','2021-09-20 10:18:18',0),(3085,'Titre de l\'article N: 85','Content de l\'article N: 85 ','10.jpg','2021-02-09 20:11:11',0),(3086,'Titre de l\'article N: 86','Content de l\'article N: 86 ','11.jpg','2020-05-25 12:31:31',1),(3087,'Titre de l\'article N: 87','Content de l\'article N: 87 ','18.jpg','2020-04-30 17:19:19',1),(3088,'Titre de l\'article N: 88','Content de l\'article N: 88 ','15.jpg','2021-08-11 06:18:18',0),(3089,'Titre de l\'article N: 89','Content de l\'article N: 89 ','13.jpg','2019-02-09 09:08:08',0),(3090,'Titre de l\'article N: 90','Content de l\'article N: 90 ','15.jpg','2020-10-12 11:56:56',0),(3091,'Titre de l\'article N: 91','Content de l\'article N: 91 ','14.jpg','2021-06-26 10:35:35',0),(3092,'Titre de l\'article N: 92','Content de l\'article N: 92 ','11.jpg','2020-10-03 11:21:21',0),(3093,'Titre de l\'article N: 93','Content de l\'article N: 93 ','18.jpg','2020-06-09 07:45:45',1),(3094,'Titre de l\'article N: 94','Content de l\'article N: 94 ','20.jpg','2019-05-28 00:47:47',0),(3095,'Titre de l\'article N: 95','Content de l\'article N: 95 ','10.jpg','2021-10-31 17:32:32',0),(3096,'Titre de l\'article N: 96','Content de l\'article N: 96 ','11.jpg','2019-05-06 07:36:36',0),(3097,'Titre de l\'article N: 97','Content de l\'article N: 97 ','12.jpg','2019-10-17 09:17:17',0),(3098,'Titre de l\'article N: 98','Content de l\'article N: 98 ','14.jpg','2021-02-19 05:51:51',0),(3099,'Titre de l\'article N: 99','Content de l\'article N: 99 ','21.jpg','2019-08-08 01:49:49',0),(3100,'Titre de l\'article N: 100','Content de l\'article N: 100 ','10.jpg','2021-12-17 06:43:43',0),(3101,'Titre de l\'article N: 101','Content de l\'article N: 101','10.jpg','2020-08-17 00:00:00',1);
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
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
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20200815124722','2020-08-15 12:47:34',536),('DoctrineMigrations\\Version20200817100615','2020-08-17 10:06:33',765);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-24 23:44:43
