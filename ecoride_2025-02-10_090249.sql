-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: ecoride
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

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
-- Table structure for table `avis`
--

DROP TABLE IF EXISTS `avis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avis` (
  `id_avis` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(255) DEFAULT NULL,
  `note` int(11) DEFAULT NULL CHECK (`note` between 1 and 5),
  `statut` varchar(50) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_covoiturage` int(11) NOT NULL,
  PRIMARY KEY (`id_avis`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_covoiturage` (`id_covoiturage`),
  CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE,
  CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_covoiturage`) REFERENCES `covoiturage` (`id_covoiturage`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avis`
--

/*!40000 ALTER TABLE `avis` DISABLE KEYS */;
INSERT INTO `avis` VALUES (1,'Trajet agréable, chauffeur sympathique.',5,'Publié',2,1),(2,'Chauffeur ponctuel, mais voiture pas très propre.',3,'Publié',3,2),(3,'Parfait, trajet rapide et confortable.',4,'Publié',4,3),(4,'Trajet agréable, chauffeur sympathique.',5,'Publié',2,1),(5,'Chauffeur ponctuel, mais voiture pas très propre.',3,'Publié',3,2),(6,'Parfait, trajet rapide et confortable.',4,'Publié',4,3),(7,'Très bon trajet, chauffeur agréable.',5,'Publié',5,4),(8,'Chauffeur très professionnel.',4,'Publié',6,5),(9,'Voyage agréable, chauffeur sympathique.',5,'Publié',1,2),(10,'Chauffeur ponctuel et agréable.',4,'Publié',2,3),(11,'Trajet rapide et confortable.',5,'Publié',3,4),(12,'Chauffeur très sympathique.',5,'Publié',4,5),(13,'Très bon trajet, chauffeur professionnel.',4,'Publié',5,1),(14,'Voyage agréable, chauffeur ponctuel.',5,'Publié',6,2),(15,'Chauffeur très agréable.',4,'Publié',7,3),(16,'Trajet rapide et agréable.',5,'Publié',1,4),(17,'Chauffeur très professionnel.',4,'Publié',2,5),(18,'Voyage agréable, chauffeur sympathique.',5,'Publié',3,1),(19,'Chauffeur ponctuel et agréable.',4,'Publié',4,2),(20,'Trajet rapide et confortable.',5,'Publié',5,3),(21,'Chauffeur très sympathique.',5,'Publié',6,4),(22,'Très bon trajet, chauffeur professionnel.',4,'Publié',7,5),(23,'Voyage agréable, chauffeur ponctuel.',5,'Publié',1,3),(24,'Chauffeur très agréable.',4,'Publié',2,4),(25,'Trajet rapide et agréable.',5,'Publié',3,5),(26,'Chauffeur très professionnel.',4,'Publié',4,1),(27,'Voyage agréable, chauffeur sympathique.',5,'Publié',5,2),(28,'Chauffeur ponctuel et agréable.',4,'Publié',6,3),(29,'Trajet rapide et confortable.',5,'Publié',7,4),(30,'Chauffeur très sympathique.',5,'Publié',1,5),(31,'Très bon trajet, chauffeur professionnel.',4,'Publié',2,1),(32,'Voyage agréable, chauffeur ponctuel.',5,'Publié',3,2),(33,'Chauffeur très agréable.',4,'Publié',4,3),(34,'Trajet rapide et agréable.',5,'Publié',5,4),(35,'Chauffeur très professionnel.',4,'Publié',6,5),(36,'Voyage agréable, chauffeur sympathique.',5,'Publié',7,1);
/*!40000 ALTER TABLE `avis` ENABLE KEYS */;

--
-- Table structure for table `avisclients`
--

DROP TABLE IF EXISTS `avisclients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avisclients` (
  `id_avis` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `note` int(11) DEFAULT NULL CHECK (`note` between 1 and 5),
  `commentaire` varchar(255) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_avis`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `avisclients_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avisclients`
--

/*!40000 ALTER TABLE `avisclients` DISABLE KEYS */;
INSERT INTO `avisclients` VALUES (1,'Tom',5,'Super voyage, je recommande sans modération !!',1),(2,'Laure',5,'Voyage très agréable, je recommande.',1),(3,'Pierre',5,'Véhicule propre et silencieux, ça fait un bien fou.',1);
/*!40000 ALTER TABLE `avisclients` ENABLE KEYS */;

--
-- Table structure for table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration` (
  `id_configuration` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id_configuration`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration`
--

/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` VALUES (1,'Configuration 1'),(2,'Configuration 2'),(3,'Configuration 3');
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;

--
-- Table structure for table `covoiturage`
--

DROP TABLE IF EXISTS `covoiturage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `covoiturage` (
  `id_covoiturage` int(11) NOT NULL AUTO_INCREMENT,
  `date_depart` date NOT NULL,
  `heure_depart` time NOT NULL,
  `lieu_depart` varchar(50) NOT NULL,
  `date_arrivee` date NOT NULL,
  `heure_arrivee` time NOT NULL,
  `lieu_arrivee` varchar(50) NOT NULL,
  `statut` varchar(50) DEFAULT NULL,
  `nb_place` int(11) DEFAULT NULL,
  `prix_par_personne` float DEFAULT NULL,
  `id_voiture` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_covoiturage`),
  KEY `id_voiture` (`id_voiture`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `covoiturage_ibfk_1` FOREIGN KEY (`id_voiture`) REFERENCES `voiture` (`id_voiture`) ON DELETE CASCADE,
  CONSTRAINT `covoiturage_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=279 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `covoiturage`
--

/*!40000 ALTER TABLE `covoiturage` DISABLE KEYS */;
INSERT INTO `covoiturage` VALUES (1,'2025-02-01','08:30:00','Lyon','2025-02-01','11:30:00','Marseille','Actif',3,15.5,1,1),(2,'2025-02-02','14:00:00','Paris','2025-02-02','16:30:00','Rouen','Complet',4,10,4,4),(3,'2025-02-03','09:00:00','Nice','2025-02-03','12:30:00','Toulouse','Actif',2,20,5,5),(4,'2025-02-01','08:30:00','Lyon','2025-02-01','11:30:00','Marseille','Actif',3,15.5,1,1),(5,'2025-02-02','14:00:00','Paris','2025-02-02','16:30:00','Rouen','Complet',4,10,4,4),(6,'2025-02-03','09:00:00','Nice','2025-02-03','12:30:00','Toulouse','Actif',2,20,5,5),(7,'2025-02-04','10:00:00','Bordeaux','2025-02-04','13:00:00','Nantes','Actif',4,18,6,6),(8,'2025-02-05','07:00:00','Lille','2025-02-05','10:00:00','Strasbourg','Actif',3,22,7,7),(9,'2025-02-01','15:00:00','Nantes','2025-02-01','15:00:00','Brest','Complet',3,44,16,3),(10,'2025-02-03','18:00:00','Rennes','2025-02-03','21:00:00','Strasbourg','Actif',1,40,7,7),(11,'2025-02-05','18:00:00','Bordeaux','2025-02-05','14:00:00','Nantes','Actif',4,18,5,41),(12,'2025-02-07','07:00:00','Perpignan','2025-02-07','22:00:00','Lille','Actif',1,15,10,1),(13,'2025-02-09','16:00:00','Montpellier','2025-02-09','18:00:00','Bordeaux','Complet',1,25,16,9),(14,'2025-02-11','20:00:00','Toulouse','2025-02-11','08:00:00','Orléans','Complet',2,24,18,3),(15,'2025-02-13','20:00:00','Rouen','2025-02-13','22:00:00','Bordeaux','Complet',4,40,11,9),(16,'2025-02-15','10:00:00','Montpellier','2025-02-15','12:00:00','Toulon','Actif',3,41,18,35),(17,'2025-02-17','19:00:00','Paris','2025-02-17','10:00:00','Toulouse','Complet',4,12,7,13),(18,'2025-02-19','15:00:00','Toulouse','2025-02-19','22:00:00','Orléans','Complet',4,41,18,15),(19,'2025-02-21','14:00:00','Lyon','2025-02-21','08:00:00','Rennes','Actif',4,12,17,12),(20,'2025-02-23','10:00:00','Rouen','2025-02-23','11:00:00','Montpellier','Actif',4,20,13,9),(21,'2025-02-25','09:00:00','Strasbourg','2025-02-25','22:00:00','Brest','Complet',4,41,12,8),(22,'2025-02-27','16:00:00','Bordeaux','2025-02-27','21:00:00','Paris','Actif',2,11,1,12),(23,'2025-03-01','10:00:00','Lille','2025-03-01','15:00:00','Brest','Complet',3,13,9,38),(24,'2025-03-03','20:00:00','Marseille','2025-03-03','09:00:00','Paris','Actif',2,43,18,33),(25,'2025-03-05','17:00:00','Paris','2025-03-05','22:00:00','Lille','Complet',3,37,18,34),(26,'2025-03-07','19:00:00','Lille','2025-03-07','21:00:00','Rennes','Complet',3,40,14,2),(27,'2025-03-09','17:00:00','Orléans','2025-03-09','16:00:00','Lille','Complet',2,21,4,15),(28,'2025-03-11','08:00:00','Paris','2025-03-11','12:00:00','Montpellier','Complet',4,22,5,36),(29,'2025-03-13','20:00:00','Lille','2025-03-13','14:00:00','Montpellier','Actif',3,19,1,3),(30,'2025-03-15','19:00:00','Lyon','2025-03-15','15:00:00','Lille','Actif',4,49,2,6),(31,'2025-03-17','07:00:00','Bordeaux','2025-03-17','09:00:00','Montpellier','Complet',2,37,17,38),(32,'2025-03-19','08:00:00','Toulon','2025-03-19','14:00:00','Strasbourg','Complet',3,29,17,9),(33,'2025-03-21','10:00:00','Marseille','2025-03-21','10:00:00','Strasbourg','Complet',4,14,6,14),(34,'2025-03-23','18:00:00','Perpignan','2025-03-23','14:00:00','Paris','Actif',2,43,16,7),(35,'2025-03-25','19:00:00','Toulon','2025-03-25','10:00:00','Brest','Actif',2,42,13,35),(36,'2025-03-27','12:00:00','Paris','2025-03-27','15:00:00','Perpignan','Actif',1,41,15,14),(37,'2025-03-29','20:00:00','Perpignan','2025-03-29','13:00:00','Strasbourg','Complet',1,27,11,35),(38,'2025-03-31','20:00:00','Rouen','2025-03-31','12:00:00','Strasbourg','Complet',2,33,14,6),(39,'2025-04-02','14:00:00','Toulouse','2025-04-02','19:00:00','Montpellier','Actif',4,19,17,8),(40,'2025-04-04','09:00:00','Perpignan','2025-04-04','14:00:00','Montpellier','Complet',3,22,10,9),(41,'2025-04-06','17:00:00','Toulouse','2025-04-06','12:00:00','Paris','Complet',1,13,11,15),(42,'2025-04-08','18:00:00','Nantes','2025-04-08','11:00:00','Lyon','Complet',2,17,11,9),(43,'2025-04-10','20:00:00','Brest','2025-04-10','12:00:00','Bordeaux','Complet',1,29,3,36),(44,'2025-04-12','06:00:00','Montpellier','2025-04-12','19:00:00','Lyon','Actif',3,27,1,4),(45,'2025-04-14','08:00:00','Orléans','2025-04-14','17:00:00','Marseille','Complet',1,50,13,4),(46,'2025-04-16','17:00:00','Lyon','2025-04-16','22:00:00','Strasbourg','Actif',1,43,12,1),(47,'2025-04-18','17:00:00','Lyon','2025-04-18','20:00:00','Toulouse','Complet',2,38,16,32),(48,'2025-04-20','13:00:00','Lille','2025-04-20','11:00:00','Paris','Complet',2,25,13,4),(49,'2025-04-22','20:00:00','Orléans','2025-04-22','20:00:00','Rennes','Actif',2,43,15,36),(50,'2025-04-24','15:00:00','Rennes','2025-04-24','20:00:00','Nice','Actif',1,35,4,36),(51,'2025-04-26','18:00:00','Toulouse','2025-04-26','17:00:00','Nice','Complet',4,34,11,11),(52,'2025-04-28','18:00:00','Rennes','2025-04-28','12:00:00','Nantes','Complet',3,42,18,15),(53,'2025-04-30','14:00:00','Bordeaux','2025-04-30','20:00:00','Strasbourg','Complet',1,29,11,4),(54,'2025-05-02','07:00:00','Brest','2025-05-02','17:00:00','Bordeaux','Actif',3,38,9,32),(55,'2025-05-04','19:00:00','Rennes','2025-05-04','12:00:00','Nantes','Actif',2,34,3,40),(56,'2025-05-06','16:00:00','Toulon','2025-05-06','16:00:00','Bordeaux','Actif',1,24,9,38),(57,'2025-05-08','09:00:00','Orléans','2025-05-08','20:00:00','Bordeaux','Complet',2,41,15,5),(58,'2025-05-10','10:00:00','Lille','2025-05-10','10:00:00','Strasbourg','Complet',2,19,13,40),(59,'2025-05-12','14:00:00','Marseille','2025-05-12','18:00:00','Toulon','Actif',3,24,18,4),(60,'2025-05-14','10:00:00','Lyon','2025-05-14','20:00:00','Bordeaux','Complet',3,28,11,14),(61,'2025-05-16','11:00:00','Toulouse','2025-05-16','15:00:00','Lyon','Actif',3,21,18,6),(62,'2025-05-18','18:00:00','Perpignan','2025-05-18','17:00:00','Marseille','Complet',4,14,2,37),(63,'2025-05-20','20:00:00','Bordeaux','2025-05-20','09:00:00','Brest','Complet',3,32,12,5),(64,'2025-05-22','10:00:00','Orléans','2025-05-22','15:00:00','Toulon','Complet',1,21,5,40),(65,'2025-05-24','07:00:00','Nantes','2025-05-24','18:00:00','Bordeaux','Complet',3,44,14,3),(66,'2025-05-26','20:00:00','Lille','2025-05-26','14:00:00','Toulon','Actif',2,12,10,5),(67,'2025-05-28','19:00:00','Nice','2025-05-28','20:00:00','Nantes','Actif',4,40,2,38),(68,'2025-05-30','06:00:00','Nantes','2025-05-30','21:00:00','Brest','Complet',4,45,17,37),(69,'2025-06-01','13:00:00','Paris','2025-06-01','15:00:00','Perpignan','Actif',4,29,6,3),(70,'2025-06-03','17:00:00','Lyon','2025-06-03','18:00:00','Rouen','Complet',4,39,13,14),(71,'2025-06-05','20:00:00','Toulon','2025-06-05','10:00:00','Perpignan','Actif',4,11,9,36),(72,'2025-06-07','14:00:00','Perpignan','2025-06-07','08:00:00','Orléans','Complet',1,17,1,15),(73,'2025-06-09','07:00:00','Orléans','2025-06-09','10:00:00','Brest','Complet',2,18,11,5),(74,'2025-06-11','18:00:00','Lyon','2025-06-11','19:00:00','Orléans','Complet',2,45,4,14),(75,'2025-06-13','20:00:00','Nantes','2025-06-13','21:00:00','Paris','Complet',4,45,17,10),(76,'2025-06-15','16:00:00','Rennes','2025-06-15','20:00:00','Brest','Actif',3,46,11,4),(77,'2025-06-17','20:00:00','Toulon','2025-06-17','09:00:00','Marseille','Complet',2,12,14,9),(78,'2025-06-19','09:00:00','Lille','2025-06-19','14:00:00','Brest','Complet',2,33,9,7),(79,'2025-06-21','13:00:00','Strasbourg','2025-06-21','10:00:00','Rennes','Actif',2,45,13,14),(80,'2025-06-23','10:00:00','Lyon','2025-06-23','19:00:00','Brest','Complet',3,10,18,12),(81,'2025-06-25','08:00:00','Toulouse','2025-06-25','10:00:00','Lille','Actif',3,20,11,35),(82,'2025-06-27','15:00:00','Rennes','2025-06-27','21:00:00','Nantes','Complet',3,19,18,33),(83,'2025-06-29','07:00:00','Rouen','2025-06-29','19:00:00','Paris','Complet',4,38,16,41),(84,'2025-07-01','20:00:00','Toulon','2025-07-01','09:00:00','Nantes','Actif',2,33,4,2),(85,'2025-07-03','08:00:00','Bordeaux','2025-07-03','19:00:00','Perpignan','Actif',4,32,9,41),(86,'2025-07-05','08:00:00','Brest','2025-07-05','18:00:00','Bordeaux','Actif',2,23,2,38),(87,'2025-07-07','12:00:00','Bordeaux','2025-07-07','11:00:00','Strasbourg','Actif',3,50,2,41),(88,'2025-07-09','15:00:00','Perpignan','2025-07-09','11:00:00','Lille','Complet',3,50,3,14),(89,'2025-07-11','19:00:00','Montpellier','2025-07-11','10:00:00','Toulon','Complet',2,19,10,7),(90,'2025-07-13','16:00:00','Toulon','2025-07-13','09:00:00','Orléans','Complet',2,11,6,6),(91,'2025-07-15','10:00:00','Nice','2025-07-15','13:00:00','Lille','Actif',1,33,15,10),(92,'2025-07-17','16:00:00','Perpignan','2025-07-17','14:00:00','Brest','Complet',4,35,9,14),(93,'2025-07-19','15:00:00','Montpellier','2025-07-19','14:00:00','Toulon','Actif',3,29,5,37),(94,'2025-07-21','15:00:00','Strasbourg','2025-07-21','10:00:00','Orléans','Complet',1,39,5,3),(95,'2025-07-23','10:00:00','Lyon','2025-07-23','08:00:00','Paris','Complet',4,26,16,38),(96,'2025-07-25','10:00:00','Nice','2025-07-25','17:00:00','Lille','Actif',3,41,14,5),(97,'2025-07-27','11:00:00','Montpellier','2025-07-27','16:00:00','Marseille','Complet',1,15,17,3),(98,'2025-07-29','10:00:00','Rouen','2025-07-29','10:00:00','Toulon','Actif',4,36,18,39),(99,'2025-02-01','09:00:00','Perpignan','2025-02-01','19:00:00','Marseille','Complet',2,44,5,36),(100,'2025-02-03','19:00:00','Nantes','2025-02-03','12:00:00','Rouen','Actif',3,15,9,40),(101,'2025-02-05','06:00:00','Lyon','2025-02-05','20:00:00','Strasbourg','Complet',1,16,12,13),(102,'2025-02-07','15:00:00','Montpellier','2025-02-07','21:00:00','Perpignan','Complet',1,41,2,36),(103,'2025-02-09','13:00:00','Toulouse','2025-02-09','17:00:00','Nice','Actif',3,47,17,35),(104,'2025-02-11','13:00:00','Rennes','2025-02-11','14:00:00','Strasbourg','Actif',4,34,16,6),(105,'2025-02-13','19:00:00','Montpellier','2025-02-13','13:00:00','Lille','Complet',2,31,13,11),(106,'2025-02-15','16:00:00','Bordeaux','2025-02-15','13:00:00','Marseille','Complet',1,17,18,36),(107,'2025-02-17','17:00:00','Strasbourg','2025-02-17','21:00:00','Lille','Actif',4,42,13,7),(108,'2025-02-19','09:00:00','Strasbourg','2025-02-19','08:00:00','Marseille','Actif',4,34,11,37),(109,'2025-02-21','06:00:00','Montpellier','2025-02-21','15:00:00','Marseille','Complet',1,18,10,12),(110,'2025-02-23','20:00:00','Marseille','2025-02-23','17:00:00','Toulouse','Complet',1,46,1,2),(111,'2025-02-25','07:00:00','Marseille','2025-02-25','08:00:00','Toulon','Complet',3,14,1,7),(112,'2025-02-27','12:00:00','Toulon','2025-02-27','13:00:00','Rouen','Actif',2,35,13,10),(113,'2025-03-01','11:00:00','Strasbourg','2025-03-01','11:00:00','Nantes','Complet',1,13,2,40),(114,'2025-03-03','09:00:00','Brest','2025-03-03','08:00:00','Marseille','Actif',1,36,6,13),(115,'2025-03-05','19:00:00','Toulouse','2025-03-05','20:00:00','Toulon','Complet',2,26,9,14),(116,'2025-03-07','14:00:00','Toulouse','2025-03-07','20:00:00','Montpellier','Complet',3,23,10,4),(117,'2025-03-09','09:00:00','Toulon','2025-03-09','11:00:00','Orléans','Actif',2,49,2,5),(118,'2025-03-11','15:00:00','Lyon','2025-03-11','08:00:00','Lille','Complet',4,15,4,33),(119,'2025-03-13','18:00:00','Nice','2025-03-13','08:00:00','Toulouse','Actif',3,45,12,37),(120,'2025-03-15','18:00:00','Paris','2025-03-15','21:00:00','Nantes','Actif',4,16,17,6),(121,'2025-03-17','07:00:00','Lille','2025-03-17','22:00:00','Marseille','Complet',1,19,17,37),(122,'2025-03-19','20:00:00','Rouen','2025-03-19','20:00:00','Toulouse','Actif',2,13,6,37),(123,'2025-03-21','20:00:00','Nantes','2025-03-21','14:00:00','Paris','Actif',2,29,5,39),(124,'2025-03-23','12:00:00','Rouen','2025-03-23','22:00:00','Brest','Actif',4,33,6,38),(125,'2025-03-25','11:00:00','Lyon','2025-03-25','08:00:00','Rouen','Actif',2,28,17,2),(126,'2025-03-27','20:00:00','Lyon','2025-03-27','22:00:00','Rennes','Complet',2,49,2,36),(127,'2025-03-29','08:00:00','Paris','2025-03-29','09:00:00','Rouen','Complet',4,13,13,38),(128,'2025-03-31','15:00:00','Nantes','2025-03-31','08:00:00','Paris','Complet',3,27,9,33),(129,'2025-04-02','11:00:00','Montpellier','2025-04-02','11:00:00','Nantes','Actif',1,18,13,36),(130,'2025-04-04','19:00:00','Toulon','2025-04-04','12:00:00','Bordeaux','Actif',4,10,18,15),(131,'2025-04-06','11:00:00','Rouen','2025-04-06','14:00:00','Orléans','Complet',1,27,1,4),(132,'2025-04-08','18:00:00','Lille','2025-04-08','16:00:00','Paris','Actif',4,21,17,14),(133,'2025-04-10','17:00:00','Montpellier','2025-04-10','08:00:00','Nice','Actif',1,50,15,15),(134,'2025-04-12','14:00:00','Bordeaux','2025-04-12','11:00:00','Strasbourg','Complet',2,24,12,34),(135,'2025-04-14','11:00:00','Orléans','2025-04-14','11:00:00','Bordeaux','Actif',2,26,10,11),(136,'2025-04-16','14:00:00','Paris','2025-04-16','22:00:00','Marseille','Complet',4,49,11,41),(137,'2025-04-18','20:00:00','Orléans','2025-04-18','15:00:00','Lille','Actif',1,35,5,10),(138,'2025-04-20','18:00:00','Strasbourg','2025-04-20','08:00:00','Nice','Complet',1,29,16,3),(139,'2025-04-22','11:00:00','Rouen','2025-04-22','22:00:00','Lyon','Actif',1,10,9,15),(140,'2025-04-24','09:00:00','Perpignan','2025-04-24','15:00:00','Orléans','Complet',4,22,2,11),(141,'2025-04-26','15:00:00','Nice','2025-04-26','18:00:00','Nantes','Complet',3,12,18,3),(142,'2025-04-28','19:00:00','Rennes','2025-04-28','18:00:00','Rouen','Actif',3,12,16,37),(143,'2025-04-30','12:00:00','Marseille','2025-04-30','09:00:00','Paris','Actif',1,30,17,3),(144,'2025-05-02','19:00:00','Rennes','2025-05-02','12:00:00','Lyon','Actif',4,44,5,6),(145,'2025-05-04','20:00:00','Strasbourg','2025-05-04','11:00:00','Orléans','Complet',1,49,5,34),(146,'2025-05-06','09:00:00','Brest','2025-05-06','16:00:00','Marseille','Actif',2,38,15,4),(147,'2025-05-08','18:00:00','Paris','2025-05-08','10:00:00','Bordeaux','Actif',1,28,18,36),(148,'2025-05-10','12:00:00','Strasbourg','2025-05-10','12:00:00','Lille','Actif',1,34,14,35),(149,'2025-05-12','12:00:00','Bordeaux','2025-05-12','17:00:00','Paris','Complet',3,39,2,33),(150,'2025-05-14','08:00:00','Bordeaux','2025-05-14','13:00:00','Orléans','Actif',4,49,15,36),(151,'2025-05-16','17:00:00','Lyon','2025-05-16','13:00:00','Strasbourg','Actif',2,34,7,9),(152,'2025-05-18','20:00:00','Nice','2025-05-18','18:00:00','Nantes','Actif',2,17,7,13),(153,'2025-05-20','17:00:00','Strasbourg','2025-05-20','11:00:00','Toulon','Actif',3,12,2,39),(154,'2025-05-22','18:00:00','Lyon','2025-05-22','10:00:00','Lille','Complet',2,10,2,6),(155,'2025-05-24','18:00:00','Toulouse','2025-05-24','21:00:00','Strasbourg','Actif',3,47,3,32),(156,'2025-05-26','20:00:00','Lille','2025-05-26','17:00:00','Paris','Actif',3,21,4,35),(157,'2025-05-28','15:00:00','Rouen','2025-05-28','14:00:00','Orléans','Actif',2,19,11,38),(158,'2025-05-30','13:00:00','Toulouse','2025-05-30','13:00:00','Perpignan','Actif',2,24,5,15),(159,'2025-06-01','06:00:00','Nice','2025-06-01','12:00:00','Toulon','Actif',3,14,3,8),(160,'2025-06-03','18:00:00','Lyon','2025-06-03','11:00:00','Rouen','Actif',2,14,17,10),(161,'2025-06-05','13:00:00','Orléans','2025-06-05','12:00:00','Strasbourg','Actif',3,40,4,9),(162,'2025-06-07','07:00:00','Rouen','2025-06-07','09:00:00','Perpignan','Actif',4,20,9,41),(163,'2025-06-09','17:00:00','Nice','2025-06-09','11:00:00','Nantes','Complet',3,47,7,10),(164,'2025-06-11','06:00:00','Brest','2025-06-11','15:00:00','Lille','Actif',4,22,4,34),(165,'2025-06-13','06:00:00','Toulon','2025-06-13','12:00:00','Strasbourg','Actif',1,27,3,34),(166,'2025-06-15','10:00:00','Montpellier','2025-06-15','09:00:00','Toulon','Actif',3,34,5,39),(167,'2025-06-17','10:00:00','Toulouse','2025-06-17','20:00:00','Nice','Complet',3,27,7,39),(168,'2025-06-19','10:00:00','Strasbourg','2025-06-19','11:00:00','Orléans','Actif',3,12,7,8),(169,'2025-06-21','07:00:00','Bordeaux','2025-06-21','12:00:00','Montpellier','Actif',2,28,1,36),(170,'2025-06-23','18:00:00','Rouen','2025-06-23','08:00:00','Toulon','Actif',2,41,12,15),(171,'2025-06-25','15:00:00','Toulouse','2025-06-25','10:00:00','Marseille','Actif',4,15,9,12),(172,'2025-06-27','08:00:00','Toulouse','2025-06-27','08:00:00','Nice','Complet',4,37,1,4),(173,'2025-06-29','08:00:00','Brest','2025-06-29','21:00:00','Rouen','Complet',4,26,17,15),(174,'2025-07-01','08:00:00','Rennes','2025-07-01','09:00:00','Marseille','Complet',4,26,6,12),(175,'2025-07-03','15:00:00','Orléans','2025-07-03','08:00:00','Strasbourg','Actif',4,47,17,11),(176,'2025-07-05','14:00:00','Nantes','2025-07-05','17:00:00','Strasbourg','Complet',2,38,6,3),(177,'2025-07-07','10:00:00','Rouen','2025-07-07','19:00:00','Paris','Complet',4,20,16,10),(178,'2025-07-09','10:00:00','Rouen','2025-07-09','09:00:00','Strasbourg','Complet',4,46,17,37),(179,'2025-07-11','09:00:00','Marseille','2025-07-11','12:00:00','Bordeaux','Complet',2,32,7,33),(180,'2025-07-13','20:00:00','Toulouse','2025-07-13','14:00:00','Marseille','Complet',1,37,14,8),(181,'2025-07-15','16:00:00','Nantes','2025-07-15','18:00:00','Paris','Complet',1,12,15,33),(182,'2025-07-17','12:00:00','Paris','2025-07-17','13:00:00','Lyon','Actif',1,12,3,32),(183,'2025-07-19','12:00:00','Brest','2025-07-19','12:00:00','Paris','Actif',1,30,17,40),(184,'2025-07-21','10:00:00','Rouen','2025-07-21','22:00:00','Bordeaux','Complet',3,42,4,10),(185,'2025-07-23','18:00:00','Nantes','2025-07-23','08:00:00','Montpellier','Actif',1,41,6,35),(186,'2025-07-25','06:00:00','Montpellier','2025-07-25','10:00:00','Lille','Actif',4,33,16,33),(187,'2025-07-27','14:00:00','Toulouse','2025-07-27','22:00:00','Bordeaux','Actif',1,44,18,6),(188,'2025-07-29','06:00:00','Brest','2025-07-29','22:00:00','Lille','Actif',1,29,10,39),(189,'2025-02-01','19:00:00','Strasbourg','2025-02-01','14:00:00','Montpellier','Complet',2,42,1,3),(190,'2025-02-03','18:00:00','Lille','2025-02-03','14:00:00','Paris','Actif',2,42,15,9),(191,'2025-02-05','12:00:00','Rouen','2025-02-05','21:00:00','Nantes','Complet',2,21,6,37),(192,'2025-02-07','14:00:00','Paris','2025-02-07','12:00:00','Montpellier','Complet',2,40,7,1),(193,'2025-02-09','17:00:00','Brest','2025-02-09','14:00:00','Marseille','Actif',4,40,12,15),(194,'2025-02-11','17:00:00','Perpignan','2025-02-11','09:00:00','Nice','Complet',2,19,11,9),(195,'2025-02-13','06:00:00','Toulon','2025-02-13','14:00:00','Nice','Complet',1,38,5,3),(196,'2025-02-15','18:00:00','Bordeaux','2025-02-15','21:00:00','Toulouse','Actif',4,13,6,34),(197,'2025-02-17','08:00:00','Brest','2025-02-17','13:00:00','Lille','Complet',2,29,6,11),(198,'2025-02-19','12:00:00','Lyon','2025-02-19','21:00:00','Toulon','Actif',3,18,11,35),(199,'2025-02-21','20:00:00','Lille','2025-02-21','12:00:00','Lyon','Complet',1,15,5,9),(200,'2025-02-23','07:00:00','Toulouse','2025-02-23','12:00:00','Lille','Complet',2,38,16,38),(201,'2025-02-25','16:00:00','Bordeaux','2025-02-25','22:00:00','Toulouse','Actif',2,46,17,38),(202,'2025-02-27','09:00:00','Rennes','2025-02-27','11:00:00','Montpellier','Complet',4,36,18,7),(203,'2025-03-01','20:00:00','Montpellier','2025-03-01','11:00:00','Perpignan','Complet',4,28,4,39),(204,'2025-03-03','07:00:00','Lyon','2025-03-03','17:00:00','Montpellier','Complet',2,33,2,35),(205,'2025-03-05','13:00:00','Montpellier','2025-03-05','17:00:00','Toulouse','Actif',2,42,9,11),(206,'2025-03-07','06:00:00','Orléans','2025-03-07','19:00:00','Lille','Actif',3,23,14,2),(207,'2025-03-09','19:00:00','Bordeaux','2025-03-09','11:00:00','Strasbourg','Complet',2,38,1,37),(208,'2025-03-11','18:00:00','Lille','2025-03-11','10:00:00','Montpellier','Complet',4,25,2,3),(209,'2025-03-13','14:00:00','Toulon','2025-03-13','12:00:00','Bordeaux','Actif',4,41,18,40),(210,'2025-03-15','15:00:00','Marseille','2025-03-15','13:00:00','Brest','Actif',4,22,1,35),(211,'2025-03-17','15:00:00','Paris','2025-03-17','15:00:00','Lille','Actif',3,42,1,39),(212,'2025-03-19','10:00:00','Marseille','2025-03-19','12:00:00','Orléans','Complet',1,45,1,40),(213,'2025-03-21','08:00:00','Perpignan','2025-03-21','21:00:00','Bordeaux','Complet',4,23,14,6),(214,'2025-03-23','20:00:00','Nantes','2025-03-23','09:00:00','Strasbourg','Actif',1,38,5,5),(215,'2025-03-25','19:00:00','Toulon','2025-03-25','18:00:00','Toulouse','Complet',2,47,1,6),(216,'2025-03-27','15:00:00','Toulon','2025-03-27','18:00:00','Marseille','Complet',3,48,1,2),(217,'2025-03-29','16:00:00','Toulon','2025-03-29','18:00:00','Montpellier','Actif',3,14,11,12),(218,'2025-03-31','14:00:00','Bordeaux','2025-03-31','10:00:00','Rennes','Complet',1,21,16,5),(219,'2025-04-02','18:00:00','Toulon','2025-04-02','21:00:00','Lille','Complet',3,14,3,4),(220,'2025-04-04','18:00:00','Bordeaux','2025-04-04','22:00:00','Brest','Actif',3,15,2,7),(221,'2025-04-06','11:00:00','Rennes','2025-04-06','10:00:00','Nantes','Complet',3,27,15,34),(222,'2025-04-08','11:00:00','Orléans','2025-04-08','17:00:00','Toulon','Actif',4,14,6,32),(223,'2025-04-10','11:00:00','Rouen','2025-04-10','13:00:00','Toulouse','Actif',3,24,16,1),(224,'2025-04-12','06:00:00','Montpellier','2025-04-12','17:00:00','Paris','Complet',4,12,3,4),(225,'2025-04-14','14:00:00','Rouen','2025-04-14','08:00:00','Nice','Actif',2,42,12,6),(226,'2025-04-16','06:00:00','Nice','2025-04-16','10:00:00','Marseille','Complet',1,33,16,14),(227,'2025-04-18','08:00:00','Strasbourg','2025-04-18','20:00:00','Rouen','Complet',2,43,18,14),(228,'2025-04-20','17:00:00','Toulouse','2025-04-20','18:00:00','Toulon','Complet',1,12,6,7),(229,'2025-04-22','12:00:00','Rennes','2025-04-22','17:00:00','Nice','Complet',1,44,7,10),(230,'2025-04-24','09:00:00','Perpignan','2025-04-24','22:00:00','Toulon','Actif',3,49,3,14),(231,'2025-04-26','14:00:00','Rennes','2025-04-26','13:00:00','Orléans','Complet',3,50,14,1),(232,'2025-04-28','19:00:00','Rennes','2025-04-28','21:00:00','Toulon','Complet',3,43,1,12),(233,'2025-04-30','16:00:00','Rennes','2025-04-30','12:00:00','Perpignan','Actif',4,22,5,11),(234,'2025-05-02','07:00:00','Nantes','2025-05-02','17:00:00','Marseille','Complet',3,50,3,5),(235,'2025-05-04','17:00:00','Nantes','2025-05-04','20:00:00','Nice','Actif',1,43,16,41),(236,'2025-05-06','20:00:00','Orléans','2025-05-06','22:00:00','Marseille','Complet',1,30,5,37),(237,'2025-05-08','06:00:00','Montpellier','2025-05-08','13:00:00','Strasbourg','Actif',4,28,17,14),(238,'2025-05-10','07:00:00','Strasbourg','2025-05-10','17:00:00','Orléans','Complet',4,13,1,5),(239,'2025-05-12','09:00:00','Rennes','2025-05-12','10:00:00','Nantes','Actif',2,13,7,36),(240,'2025-05-14','16:00:00','Toulouse','2025-05-14','21:00:00','Nice','Complet',1,20,13,33),(241,'2025-05-16','16:00:00','Toulon','2025-05-16','08:00:00','Orléans','Complet',4,36,9,13),(242,'2025-05-18','12:00:00','Strasbourg','2025-05-18','18:00:00','Lille','Actif',2,41,5,15),(243,'2025-05-20','14:00:00','Paris','2025-05-20','18:00:00','Montpellier','Actif',3,47,10,34),(244,'2025-05-22','08:00:00','Marseille','2025-05-22','10:00:00','Nantes','Actif',3,40,5,39),(245,'2025-05-24','10:00:00','Nice','2025-05-24','15:00:00','Lille','Complet',2,41,17,10),(246,'2025-05-26','18:00:00','Rouen','2025-05-26','08:00:00','Toulon','Complet',1,19,5,32),(247,'2025-05-28','20:00:00','Toulon','2025-05-28','18:00:00','Montpellier','Complet',1,19,18,14),(248,'2025-05-30','20:00:00','Strasbourg','2025-05-30','15:00:00','Montpellier','Actif',1,11,15,37),(249,'2025-06-01','11:00:00','Bordeaux','2025-06-01','16:00:00','Orléans','Complet',4,44,11,14),(250,'2025-06-03','15:00:00','Orléans','2025-06-03','13:00:00','Nantes','Actif',2,12,16,38),(251,'2025-06-05','10:00:00','Montpellier','2025-06-05','11:00:00','Nantes','Actif',2,42,5,10),(252,'2025-06-07','07:00:00','Perpignan','2025-06-07','18:00:00','Rouen','Actif',4,35,12,41),(253,'2025-06-09','11:00:00','Montpellier','2025-06-09','10:00:00','Brest','Complet',3,19,4,9),(254,'2025-06-11','18:00:00','Lille','2025-06-11','14:00:00','Toulouse','Actif',3,46,13,35),(255,'2025-06-13','15:00:00','Marseille','2025-06-13','10:00:00','Paris','Actif',2,17,2,15),(256,'2025-06-15','17:00:00','Orléans','2025-06-15','10:00:00','Lyon','Complet',1,25,16,35),(257,'2025-06-17','07:00:00','Rennes','2025-06-17','12:00:00','Nice','Complet',3,29,6,12),(258,'2025-06-19','11:00:00','Toulouse','2025-06-19','11:00:00','Paris','Actif',2,37,3,10),(259,'2025-06-21','09:00:00','Brest','2025-06-21','10:00:00','Nice','Complet',1,33,16,10),(260,'2025-06-23','07:00:00','Toulouse','2025-06-23','21:00:00','Bordeaux','Complet',2,10,17,33),(261,'2025-06-25','08:00:00','Nice','2025-06-25','20:00:00','Lille','Actif',3,14,4,14),(262,'2025-06-27','18:00:00','Bordeaux','2025-06-27','19:00:00','Lyon','Actif',1,32,1,35),(263,'2025-06-29','14:00:00','Lyon','2025-06-29','12:00:00','Brest','Actif',3,27,3,15),(264,'2025-07-01','07:00:00','Rennes','2025-07-01','22:00:00','Paris','Actif',1,49,15,13),(265,'2025-07-03','16:00:00','Lyon','2025-07-03','12:00:00','Perpignan','Complet',4,18,9,38),(266,'2025-07-05','12:00:00','Rennes','2025-07-05','13:00:00','Lille','Complet',1,43,9,14),(267,'2025-07-07','16:00:00','Nantes','2025-07-07','18:00:00','Bordeaux','Complet',4,24,9,8),(268,'2025-07-09','20:00:00','Bordeaux','2025-07-09','10:00:00','Nice','Actif',2,42,3,3),(269,'2025-07-11','19:00:00','Bordeaux','2025-07-11','10:00:00','Nice','Complet',3,32,12,36),(270,'2025-07-13','06:00:00','Rennes','2025-07-13','11:00:00','Montpellier','Actif',2,26,10,3),(271,'2025-07-15','15:00:00','Montpellier','2025-07-15','18:00:00','Rennes','Actif',2,15,12,39),(272,'2025-07-17','19:00:00','Brest','2025-07-17','14:00:00','Bordeaux','Actif',4,50,4,3),(273,'2025-07-19','20:00:00','Paris','2025-07-19','20:00:00','Marseille','Actif',1,44,16,6),(274,'2025-07-21','20:00:00','Toulouse','2025-07-21','22:00:00','Rouen','Actif',4,23,10,8),(275,'2025-07-23','11:00:00','Nantes','2025-07-23','15:00:00','Rouen','Actif',2,20,7,32),(276,'2025-07-25','19:00:00','Orléans','2025-07-25','15:00:00','Nice','Complet',1,30,3,1),(277,'2025-07-27','08:00:00','Nantes','2025-07-27','08:00:00','Orléans','Actif',3,34,11,35),(278,'2025-07-29','10:00:00','Rouen','2025-07-29','09:00:00','Marseille','Complet',2,15,1,38);
/*!40000 ALTER TABLE `covoiturage` ENABLE KEYS */;

--
-- Table structure for table `historiquevoyages`
--

DROP TABLE IF EXISTS `historiquevoyages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historiquevoyages` (
  `id_historique` int(11) NOT NULL AUTO_INCREMENT,
  `depart` varchar(50) NOT NULL,
  `arrivee` varchar(50) NOT NULL,
  `duree` varchar(50) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_historique`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `historiquevoyages_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historiquevoyages`
--

/*!40000 ALTER TABLE `historiquevoyages` DISABLE KEYS */;
INSERT INTO `historiquevoyages` VALUES (1,'Paris','Marseille','9h',1),(2,'Marseille','Montpellier','3h',1),(3,'Montpellier','Toulouse','3h',1),(4,'Toulouse','Paris','8h',1),(5,'Paris','Orleans','3h',1);
/*!40000 ALTER TABLE `historiquevoyages` ENABLE KEYS */;

--
-- Table structure for table `marque`
--

DROP TABLE IF EXISTS `marque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marque` (
  `id_marque` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id_marque`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marque`
--

/*!40000 ALTER TABLE `marque` DISABLE KEYS */;
INSERT INTO `marque` VALUES (1,'Peugeot'),(2,'Renault'),(3,'Citroën'),(4,'BMW'),(5,'Mercedes'),(6,'Toyota'),(7,'Honda'),(8,'Audi'),(9,'Volkswagen'),(10,'Nissan'),(11,'Ford'),(12,'Kia'),(13,'Hyundai'),(14,'Mazda'),(15,'Skoda'),(16,'Fiat'),(17,'Lancia'),(18,'Alfa Romeo'),(19,'Opel'),(20,'Tesla');
/*!40000 ALTER TABLE `marque` ENABLE KEYS */;

--
-- Table structure for table `parametre`
--

DROP TABLE IF EXISTS `parametre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `parametre` (
  `id_parametre` int(11) NOT NULL AUTO_INCREMENT,
  `propriete` varchar(50) NOT NULL,
  `valeur` varchar(50) NOT NULL,
  `id_configuration` int(11) NOT NULL,
  PRIMARY KEY (`id_parametre`),
  KEY `id_configuration` (`id_configuration`),
  CONSTRAINT `parametre_ibfk_1` FOREIGN KEY (`id_configuration`) REFERENCES `configuration` (`id_configuration`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parametre`
--

/*!40000 ALTER TABLE `parametre` DISABLE KEYS */;
/*!40000 ALTER TABLE `parametre` ENABLE KEYS */;

--
-- Table structure for table `preferences`
--

DROP TABLE IF EXISTS `preferences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preferences` (
  `id_preference` int(11) NOT NULL AUTO_INCREMENT,
  `fumeur` varchar(10) NOT NULL,
  `animaux` varchar(10) NOT NULL,
  `trajets` varchar(50) NOT NULL,
  `pause` varchar(10) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_preference`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `preferences_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preferences`
--

/*!40000 ALTER TABLE `preferences` DISABLE KEYS */;
INSERT INTO `preferences` VALUES (1,'Non','Non','Long','Oui',1),(2,'Oui','Oui','Court','Non',2),(3,'Non','Non','Long','Oui',3);
/*!40000 ALTER TABLE `preferences` ENABLE KEYS */;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'Admin'),(2,'Chauffeur'),(3,'Passager'),(4,'Les deux'),(9,'Admin'),(10,'Chauffeur'),(11,'Passager'),(12,'Les deux');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `photo` blob DEFAULT NULL,
  `pseudo` varchar(50) NOT NULL,
  `id_configuration` int(11) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `pseudo` (`pseudo`),
  KEY `id_configuration` (`id_configuration`),
  KEY `id_role` (`id_role`),
  CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`id_configuration`) REFERENCES `configuration` (`id_configuration`) ON DELETE SET NULL,
  CONSTRAINT `utilisateur_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES (1,'Dupont','Jean','jean.dupont@example.com','0601020304','12 rue des Lilas','1985-06-15',0x2E2E2F6173736574732F706572736F6E61312E6A7067,'JeanD',1,2),(2,'Martin','Sophie','sophie.martin@example.com','0605060708','34 avenue des Champs','1990-09-22',0x2E2E2F6173736574732F706572736F6E61322E6A7067,'SophieM',2,3),(3,'Durand','Paul','paul.durand@example.com','0611121314','78 boulevard Haussmann','1980-12-10',0x2E2E2F6173736574732F706572736F6E61332E6A7067,'PaulD',3,4),(4,'Morel','Claire','claire.morel@example.com','0620212223','56 place Bellecour','1995-01-30',NULL,'ClaireM',1,2),(5,'Lemoine','Antoine','antoine.lemoine@example.com','0630313233','23 rue Lafayette','1988-03-12',NULL,'AntoineL',1,3),(6,'Rousseau','Emma','emma.rousseau@example.com','0640414243','89 rue de Rivoli','1992-07-14',NULL,'EmmaR',2,2),(7,'Petit','Lucas','lucas.petit@example.com','0650515253','17 cours Mirabeau','1987-11-05',NULL,'LucasP',3,4),(8,'Blanc','Alice','alice.blanc@example.com','0660616263','45 quai Voltaire','1991-04-18',NULL,'AliceB',1,3),(9,'Garnier','Nicolas','nicolas.garnier@example.com','0670717273','65 avenue Montaigne','1989-02-25',NULL,'NicolasG',2,4),(10,'Bernard','Chloe','chloe.bernard@example.com','0680818283','19 place de la Concorde','1993-06-08',NULL,'ChloeB',3,2),(11,'Fontaine','Julien','julien.fontaine@example.com','0690919293','52 rue de la Paix','1986-10-11',NULL,'JulienF',2,3),(12,'Barbier','Manon','manon.barbier@example.com','0603040506','90 rue Saint-Honoré','1994-08-19',NULL,'ManonB',1,2),(13,'Perrot','Thomas','thomas.perrot@example.com','0617080910','28 rue Saint-Lazare','1990-05-03',NULL,'ThomasP',3,3),(14,'Boucher','Laura','laura.boucher@example.com','0623060708','74 rue Oberkampf','1992-12-20',NULL,'LauraB',2,4),(15,'Masson','Hugo','hugo.masson@example.com','0634080912','11 rue Lepic','1984-09-16',NULL,'HugoM',1,2),(32,'Marie','Bernard','mariebernard1@example.com','0628700771','46 rue de Marseille','2002-02-04',NULL,'MarieBernard1',2,4),(33,'Julien','Martin','julienmartin2@example.com','0671631844','8 rue de Strasbourg','1994-02-04',NULL,'JulienMartin2',2,4),(34,'Hugo','Rousseau','hugorousseau3@example.com','0620825975','47 rue de Strasbourg','2001-02-04',NULL,'HugoRousseau3',1,3),(35,'Thomas','Petit','thomaspetit4@example.com','0654070573','16 rue de Nantes','2005-02-04',NULL,'ThomasPetit4',2,3),(36,'Claire','Garcia','clairegarcia5@example.com','0634628502','51 rue de Nantes','1992-02-04',NULL,'ClaireGarcia5',3,2),(37,'Alice','Rousseau','alicerousseau6@example.com','0645448024','45 rue de Marseille','2005-02-04',NULL,'AliceRousseau6',3,2),(38,'Antoine','Moreau','antoinemoreau7@example.com','0695893628','2 rue de Lyon','2001-02-04',NULL,'AntoineMoreau7',3,2),(39,'Manon','Petit','manonpetit8@example.com','0667327403','98 rue de Bordeaux','2000-02-04',NULL,'ManonPetit8',3,3),(40,'Manon','Rousseau','manonrousseau9@example.com','0655570340','89 rue de Lille','1995-02-04',NULL,'ManonRousseau9',3,3),(41,'Léa','Fournier','léafournier10@example.com','0668269390','81 rue de Strasbourg','1997-02-04',NULL,'LéaFournier10',2,3);
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;

--
-- Table structure for table `voiture`
--

DROP TABLE IF EXISTS `voiture`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voiture` (
  `id_voiture` int(11) NOT NULL AUTO_INCREMENT,
  `modele` varchar(50) NOT NULL,
  `immatriculation` varchar(50) NOT NULL,
  `energie` varchar(50) DEFAULT NULL,
  `couleur` varchar(50) DEFAULT NULL,
  `date_premiere_immatriculation` date DEFAULT NULL,
  `id_marque` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_voiture`),
  UNIQUE KEY `immatriculation` (`immatriculation`),
  KEY `id_marque` (`id_marque`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `voiture_ibfk_1` FOREIGN KEY (`id_marque`) REFERENCES `marque` (`id_marque`) ON DELETE CASCADE,
  CONSTRAINT `voiture_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voiture`
--

/*!40000 ALTER TABLE `voiture` DISABLE KEYS */;
INSERT INTO `voiture` VALUES (1,'208','AA-123-BB','Essence','Rouge','2015-03-20',1,1),(2,'Clio','CC-456-DD','Diesel','Bleue','2018-05-10',2,2),(3,'C4','EE-789-FF','Hybride','Noire','2020-01-15',3,3),(4,'X1','GG-123-HH','Essence','Blanche','2017-07-25',4,4),(5,'A-Class','II-456-JJ','Électrique','Grise','2022-11-05',5,5),(6,'208','KK-789-LL','Essence','Rouge','2015-03-20',1,6),(7,'Clio','MM-123-NN','Diesel','Bleue','2018-05-10',2,7),(9,'Peugeot 208','2CE2914','Essence','Rouge','2016-02-04',4,32),(10,'Peugeot 208','BB5BBCA','Essence','Rouge','2022-02-04',2,33),(11,'Volkswagen Golf','8DBE10D','Essence','Rouge','2017-02-04',4,34),(12,'Toyota Yaris','0847A37','Essence','Rouge','2021-02-04',9,35),(13,'BMW Série 1','B70A412','Essence','Rouge','2019-02-04',11,36),(14,'Ford Fiesta','402EFB9','Essence','Rouge','2023-02-04',4,37),(15,'Fiat 500','F566263','Essence','Rouge','2018-02-04',6,38),(16,'Volkswagen Golf','1159ACC','Essence','Rouge','2022-02-04',11,39),(17,'Renault Clio','4E911DF','Essence','Rouge','2015-02-04',11,40),(18,'Peugeot 208','A8B45A0','Essence','Rouge','2024-02-04',6,41);
/*!40000 ALTER TABLE `voiture` ENABLE KEYS */;

--
-- Table structure for table `voyages`
--

DROP TABLE IF EXISTS `voyages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `voyages` (
  `id_voyage` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` int(11) NOT NULL,
  `kilometres` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_voyage`),
  KEY `id_utilisateur` (`id_utilisateur`),
  CONSTRAINT `voyages_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `voyages`
--

/*!40000 ALTER TABLE `voyages` DISABLE KEYS */;
INSERT INTO `voyages` VALUES (1,27,3100,1),(2,15,1500,2),(3,30,5000,3);
/*!40000 ALTER TABLE `voyages` ENABLE KEYS */;

--
-- Dumping routines for database 'ecoride'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-02-10  9:03:02
