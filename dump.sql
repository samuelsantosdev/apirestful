-- MySQL dump 10.13  Distrib 5.5.8, for Win32 (x86)
--
-- Host: localhost    Database: apirestful
-- ------------------------------------------------------
-- Server version	5.5.8

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(100) NOT NULL,
  `Pass` varchar(100) NOT NULL,
  `SecretKey` varchar(100) NOT NULL,
  `ApiKey` varchar(100) NOT NULL,
  `Active` bit(1) DEFAULT b'1',
  `DateInserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Removed` bit(1) DEFAULT b'0',
  `Root` bit(1) DEFAULT b'0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
INSERT INTO `account` VALUES (1,'ass@asd.com','7979b96e46af78519c705240d2c9b538','C7473C8C-D4FB-40D4-B621-AADEF3B3E9BA','f1186a92778d25e85282fba242a6e316','','2016-08-25 21:08:50','','');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `accountmethod`
--

DROP TABLE IF EXISTS `accountmethod`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accountmethod` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `AccountId` int(11) NOT NULL,
  `Method` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `AccountId` (`AccountId`),
  CONSTRAINT `accountmethod_ibfk_1` FOREIGN KEY (`AccountId`) REFERENCES `account` (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accountmethod`
--

LOCK TABLES `accountmethod` WRITE;
/*!40000 ALTER TABLE `accountmethod` DISABLE KEYS */;
/*!40000 ALTER TABLE `accountmethod` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `token` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Token` varchar(100) NOT NULL,
  `RefreshToken` varchar(100) NOT NULL,
  `LastActivity` datetime DEFAULT NULL,
  `AccountId` int(11) NOT NULL,
  `Active` bit(1) DEFAULT b'1',
  PRIMARY KEY (`Id`),
  KEY `AccountId` (`AccountId`),
  CONSTRAINT `token_ibfk_1` FOREIGN KEY (`AccountId`) REFERENCES `account` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `token`
--

LOCK TABLES `token` WRITE;
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
INSERT INTO `token` VALUES (1,'87B20FE0-7837-4B73-9D23-723E812DC32F','046d2e64425609dadad6c5ebf23acea6','2016-08-25 23:59:56',1,'\0'),(2,'9218DEAD-9C8E-4DCD-B1C7-D0ABCB4D011A','41224210727d1427447cf9778099089e','2016-08-26 00:49:58',1,'');
/*!40000 ALTER TABLE `token` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-25 20:17:24
