-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: fyp_ms1
-- ------------------------------------------------------
-- Server version	8.0.29-0ubuntu0.20.04.3

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coordinator`
--

DROP TABLE IF EXISTS `coordinator`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coordinator` (
  `emp_id` varchar(10) NOT NULL,
  `academic_year` varchar(9) NOT NULL DEFAULT '2019-2020',
  KEY `emp_id_idx` (`emp_id`),
  CONSTRAINT `employee_id` FOREIGN KEY (`emp_id`) REFERENCES `lecturer` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coordinator`
--

LOCK TABLES `coordinator` WRITE;
/*!40000 ALTER TABLE `coordinator` DISABLE KEYS */;
INSERT INTO `coordinator` VALUES ('m3456','2019-2020');
/*!40000 ALTER TABLE `coordinator` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lecturer`
--

DROP TABLE IF EXISTS `lecturer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lecturer` (
  `emp_id` varchar(10) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `expertise` varchar(105) NOT NULL,
  `profile` varchar(15) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`emp_id`),
  UNIQUE KEY `emp_id_UNIQUE` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lecturer`
--

LOCK TABLES `lecturer` WRITE;
/*!40000 ALTER TABLE `lecturer` DISABLE KEYS */;
INSERT INTO `lecturer` VALUES ('12345','Edwin Ireri','ereri@gmail.com','0746792699','System Administration',NULL,'2022-04-22 12:58:57'),('b4567','Dr Joseph','joseph@gmail.com','0745869214','System admin',NULL,'2022-05-27 10:47:06'),('m3456','Zackary Kirori','zackarykirori@gmail.com','0746792699','Machine Learning',NULL,'2022-04-22 12:59:05'),('n4567','Dr. Karani','karani@gmail.com','0704554585','Network Architecture',NULL,'2022-04-22 12:59:37'),('o4567','Dr. Ephantus','ephatus@gmail.com','0718525285','Programming',NULL,'2022-04-22 12:59:37'),('p4567','Dr. Kinyanjui','kinyanjui@gmail.com','0790574524','Calculus',NULL,'2022-04-22 12:59:37');
/*!40000 ALTER TABLE `lecturer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `category` int NOT NULL,
  `student` varchar(30) NOT NULL,
  `supervisor` varchar(10) DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `complete_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`),
  KEY `reg_no_idx` (`student`),
  KEY `id_idx` (`category`),
  KEY `empid_idx` (`supervisor`),
  CONSTRAINT `empid` FOREIGN KEY (`supervisor`) REFERENCES `lecturer` (`emp_id`),
  CONSTRAINT `id` FOREIGN KEY (`category`) REFERENCES `project_categories` (`id`),
  CONSTRAINT `reg_no` FOREIGN KEY (`student`) REFERENCES `student` (`reg_no`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,'Final Year Management Systemm','It helps manage all the final year projects amen.',1,'CT101/G/4493/18','12345',1,NULL),(8,'Church Management System','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.',2,'CT101/G/4561/18','m3456',1,'2022-04-09 23:41:57'),(9,'Abuse and harrasment reporting system','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.',2,'CT101/G/4933/18','n4567',1,'2022-03-23 10:24:43'),(12,'Library Management System','lorem ipsum dorem isit',1,'CT101/G/5023/18','o4567',0,NULL),(13,'Plant Disease Recognition and Mitigation','lorem ipsum',6,'CT101/G/3221/17','p4567',1,'2022-04-09 12:44:27'),(14,'Pack house Management Systems','A management system that helps with the day to day operations of production store.',3,'CT101/G/4573/18','o4567',0,NULL),(15,'Affffff Innnn','AI',1,'CT101/G/5000/18','12345',0,NULL);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project_categories`
--

DROP TABLE IF EXISTS `project_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `project_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_categories`
--

LOCK TABLES `project_categories` WRITE;
/*!40000 ALTER TABLE `project_categories` DISABLE KEYS */;
INSERT INTO `project_categories` VALUES (1,'Web App'),(2,'Android App'),(3,'Desktop App'),(4,'Artificial Intelligence'),(6,'Human Computer Interface');
/*!40000 ALTER TABLE `project_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student` (
  `reg_no` varchar(30) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phone_no` varchar(15) NOT NULL,
  `course` varchar(50) NOT NULL DEFAULT 'Bsc. Computer Science',
  `school` varchar(50) NOT NULL DEFAULT 'School of Pure And Applied Sciences',
  `department` varchar(45) NOT NULL DEFAULT 'Mathematics and Computer Science',
  `profile` varchar(15) DEFAULT 'avatar-st.png',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`reg_no`),
  UNIQUE KEY `reg_no` (`reg_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES ('CT101/G/3221/17','Frank Malombe','frankmalombe@gmail.com','0704554585','Bsc. Computer Science','School of Pure And Applied Sciences','Mathematics and Computer Science','avatar-st.png','2022-04-14 14:42:56'),('CT101/G/4493/18','Ian Macharia','ianmacharia@gmail.com','0746792699','Bsc. Computer Science','School of Pure And Applied Sciences','Mathematics and Computer Science',NULL,'2022-03-16 09:58:26'),('CT101/G/4561/18','John Kabiru','johnkabiru@gmail.com','0746792699','Bsc. Computer Science','School of Pure And Applied Sciences','Mathematics and Computer Science','avatar-st.png','2022-05-02 12:19:48'),('CT101/G/4573/18','Joseph Kinuthia','josephkinuthia@gmail.com','0798431498','Bsc. Computer Science','School of Pure And Applied Sciences','Mathematics and Computer Science','avatar-st.png','2022-05-26 11:26:56'),('CT101/G/4933/18','Lary Tumaini','larytumaini@gmail.com','0746792698','Bsc. Computer Science','School of Pure And Applied Sciences','Mathematics and Computer Science','avatar-st.png','2022-04-29 12:25:02'),('CT101/G/5000/18','John Doe','johndoe@gmail.com','0745896231','Bsc. Computer Science','School of Pure And Applied Sciences','Mathematics and Computer Science','avatar-st.png','2022-05-27 10:51:25'),('CT101/G/5023/18','James Muriithi','muriithijames@gmail.com','0789152672','Bsc. Computer Science','School of Pure And Applied Sciences','Mathematics and Computer Science',NULL,'2022-03-23 12:58:17');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload`
--

DROP TABLE IF EXISTS `upload`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `upload` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `project_id` int NOT NULL,
  `category` int NOT NULL,
  `approved` int NOT NULL DEFAULT '0',
  `upload_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`category`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `id_idx` (`project_id`),
  KEY `upload_cat_idx` (`category`),
  CONSTRAINT `project_id` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`),
  CONSTRAINT `upload_cat` FOREIGN KEY (`category`) REFERENCES `upload_category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload`
--

LOCK TABLES `upload` WRITE;
/*!40000 ALTER TABLE `upload` DISABLE KEYS */;
INSERT INTO `upload` VALUES (3,'469fff0ad9.pdf',1,1,1,'2022-04-25 17:02:56'),(8,'b99d316f92.zip',8,1,2,'2022-04-26 15:02:35'),(9,'f85c6bfe27.zip',1,2,1,'2022-04-26 15:06:24'),(11,'f85c6bfe27.zip',8,2,0,'2022-05-06 12:38:27'),(12,'e01ed17da4.docx',8,3,1,'2022-05-07 17:57:00');
/*!40000 ALTER TABLE `upload` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `upload_category`
--

DROP TABLE IF EXISTS `upload_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `upload_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(65) NOT NULL,
  `description` varchar(500) NOT NULL,
  `start_date` date NOT NULL,
  `deadline` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `upload_category`
--

LOCK TABLES `upload_category` WRITE;
/*!40000 ALTER TABLE `upload_category` DISABLE KEYS */;
INSERT INTO `upload_category` VALUES (1,'chapter 1','Lorem ipsum dorem isit','2022-04-01','2022-04-24'),(2,'chapter 2','Lorem ipsum dorem','2022-04-25','2022-05-01'),(3,'chapter 3','Lorem ipsum','2022-01-07','2022-05-21'),(4,'chapter 4','Lorem ipsum','2022-01-01','2022-05-05'),(5,'Final Report','All the chapters combined','2022-01-07','2022-05-31'),(6,'chapter 5','Lorem ipsum','0000-00-00','2022-04-06'),(7,'Concept Paper 2019-2022','Give in the concept paper','2022-01-09','2022-06-01');
/*!40000 ALTER TABLE `upload_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `username` varchar(30) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(32) DEFAULT NULL,
  `otp` int DEFAULT NULL,
  `level` int NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `token_UNIQUE` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('12345','$2y$10$1dXhDkf7tZNJL5zft6jYlOt80RJe4kwowr61v3vemp.r9VTwu6Lhm','e7185655f1a327d87b6deccfba5efbfb',918206,2,1),('b4567',NULL,NULL,NULL,2,1),('CT101/G/3221/17','$2y$10$NvmQPJL4i9GjLHfAXqSrOuoIQMmZk3ztmg2RFqgj1Y8rMKXPB6ENi','dfc21a66e7501b42ab2a1c865e6ecd38',562490,3,1),('CT101/G/4493/18','$2y$10$6XIhTHZFxYCMiQgSIWMQDOqvG9yPWZ979w9Ia7U9FLs.rDqmBufSC','1f837df59fd02777dd33916c6f9b8eee',332997,3,1),('CT101/G/4561/18','$2y$10$r86DNGUJWSb1aD6PBGpNyOxvJqzUwHivJ8zEb97TNzMZrTm98Bx5q','174a48b5f2c694d3d85e9f6f47e8543e',515969,3,1),('CT101/G/4573/18',NULL,'0380d729b3f8d8559ce9ba4cab1e0e98',562481,3,1),('CT101/G/4933/18','$2y$10$eYVTqHDII4ru1XVgZpb2XOFw/Uv83TZooISRk1sFfAUxxbYouSQ4m','be5be3dec82e52e4ad1ece318dc2c88b',861756,3,1),('CT101/G/5000/18',NULL,NULL,NULL,3,1),('CT101/G/5023/18',NULL,NULL,NULL,3,1),('m3456','$2y$10$/sekwZomjenmHGWHLrfVEOHUl/BHq94N7lQGPwOid5QtNTbbGFewW','9ae759eb20990263ee1966803f117271',298684,1,1),('n4567','$2y$10$5piO72t5On8hYP/yuvMvte1GvNI8j9ZzLSHZCN8i1YQneZ8NFy9nW','52d31a771bbcbbd40038290804db61cb',498043,2,1);
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

-- Dump completed on 2022-05-28 14:25:53
