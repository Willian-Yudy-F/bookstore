-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for osx10.10 (x86_64)
--
-- Host: localhost    Database: advanced_web
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'The Psychology of Money','Morgan Housel','Finance','Explores how ego, preconceived notions, and pride influence financial decisions more than complex math.','book1.jpg'),(2,'Rich Dad Poor Dad','Robert Kiyosaki','Finance','The classic primer on the difference between working for money and having your money work for you.','book2.jpg'),(3,'The Millionaire Next Door','Thomas J. Stanley',NULL,'A data-driven look at how the truly wealthy in America actually live (hint: it’s not in mansions).','book3.jpg'),(4,'Think and Grow Rich','Napoleon Hill','Self-Help','The grandfather of personal development; focuses on the psychological power of desire and persistence.','book4.jpg'),(5,'The Richest Man in Babylon','George S. Clason','Finance','Financial advice told through ancient parables, emphasizing the \"pay yourself first\" principle.','book5.jpg'),(6,'Your Money or Your Life','Vicki Robin','Finance','A transformative guide that helps you view money as \"life energy\" to achieve true independence.','book6.jpg'),(7,'Secrets of the Millionaire Mind','T. Harv Eker',NULL,'Identifies your \"money blueprint\" and provides declarations to reset your mind for success.','book7.jpg'),(8,'I Will Teach You to Be Rich','Ramit Sethi',NULL,'A practical, no-guilt 6-week program for \"rich life\" automation and conscious spending.','book8.jpg'),(9,'The Total Money Makeover','Dave Ramsey',NULL,'A straightforward, aggressive plan to get out of debt and build a solid emergency fund.','book9.jpg'),(10,'Atomic Habits','James Clear','Self-Help','While not strictly about finance, it’s vital for building the small daily habits that lead to wealth.','book10.jpg'),(11,'Financial Freedom','Grant Sabatier','Finance','A roadmap to making more money in less time to reach \"time liberty\" as fast as possible.','book11.jpg'),(12,'The Simple Path to Wealth','JL Collins',NULL,'Born from letters to his daughter, this book advocates for low-cost index fund investing.','book12.jpg'),(13,'Die With Zero','Bill Perkins',NULL,'A counter-intuitive approach to optimizing life experiences over just hoarding cash.','book13.jpg'),(14,'Money: Master the Game','Tony Robbins',NULL,'Interviews with the world’s greatest investors condensed into a 7-step blueprint.','book14.jpg'),(15,'The Almanac of Naval Ravikant','Eric Jorgenson',NULL,'A collection of Naval’s wisdom on building wealth through leverage and specific knowledge.','book15.jpg'),(16,'Broke Millennial','Erin Lowry',NULL,'A relatable guide for young adults to get their financial sh*t together, from debt to investing.','book16.jpg'),(17,'The 4-Hour Workweek','Timothy Ferriss',NULL,'Challenges the \"deferred-life plan\" and teaches how to design a lifestyle of luxury now.','book17.jpg'),(18,'Playing with FIRE','Scott Rieckens',NULL,'Documents the journey into the Financial Independence, Retire Early (FIRE) movement.','book18.jpg'),(19,'Profit First','Mike Michalowicz',NULL,'Essential for entrepreneurs; flips the accounting formula to ensure the business stays healthy.','book19.jpg'),(20,'Mindset','Carol S. Dweck','Self-Help','The definitive book on \"growth vs. fixed\" mindsets, which is the foundation of all financial growth.','book20.jpg');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `favorites`
--

DROP TABLE IF EXISTS `favorites`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `favorites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_favorite` (`user_id`,`book_id`),
  KEY `book_id` (`book_id`),
  CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `favorites`
--

LOCK TABLES `favorites` WRITE;
/*!40000 ALTER TABLE `favorites` DISABLE KEYS */;
/*!40000 ALTER TABLE `favorites` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `book_id` (`book_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,5,6,5,'the best','2026-04-19 23:31:50');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Willian','futemawillian.aud@gmail.com','$2y$10$LPQ63IuDmCYX.LBJK2f8Hu/KvpRo2EF1DhBZVGJXslSW/2JFd1LtS'),(2,'Luiza','taro@perfeito.com','$2y$10$LjkTFy95rZlHwiW0hkuyqeCeh4r4gRezL0dr1shgnSj1OmOWlr87G'),(3,'Willian Futema','15160@ait.com','$2y$10$vjyO0ix02x5AwIMYXz2EB.Si6HS8FsOnZBtCbfwejMW3UARvslFT6'),(6,'Test User','test@test.com','$2y$10$c/G8e4.UHUUAm9/l8aoBtOPwjokljjZ8UGSG00eIUGVPFUNa4lUfK');
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

-- Dump completed on 2026-04-20 10:00:18
