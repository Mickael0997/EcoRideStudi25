-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 20 fév. 2025 à 20:16
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `ecoride`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenom`, `email`, `mot_de_passe`) VALUES
(1, 'GARCIA', 'José', 'jose.garcia@example.com', 'josegarciaecoride');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id_avis` int(11) NOT NULL,
  `id_auteur` int(11) NOT NULL,
  `commentaire` varchar(255) DEFAULT NULL,
  `note` int(11) DEFAULT NULL CHECK (`note` between 1 and 5),
  `statut` varchar(50) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_conducteur` int(11) NOT NULL,
  `id_covoiturage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id_avis`, `id_auteur`, `commentaire`, `note`, `statut`, `id_utilisateur`, `id_conducteur`, `id_covoiturage`) VALUES
(4, 4, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 4, 3, 2),
(5, 5, 'Conduite sécurisée et agréable.', 4, 'approuvé', 5, 3, 2),
(6, 6, 'Ponctuel et sympathique.', 5, 'approuvé', 6, 3, 2),
(7, 7, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 7, 4, 3),
(8, 8, 'Conduite sécurisée et agréable.', 4, 'approuvé', 8, 4, 3),
(9, 9, 'Ponctuel et sympathique.', 5, 'approuvé', 9, 4, 3),
(13, 13, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 13, 6, 5),
(14, 14, 'Conduite sécurisée et agréable.', 4, 'approuvé', 14, 6, 5),
(15, 15, 'Ponctuel et sympathique.', 5, 'approuvé', 15, 6, 5),
(16, 32, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 32, 7, 6),
(17, 33, 'Conduite sécurisée et agréable.', 4, 'approuvé', 33, 7, 6),
(18, 34, 'Ponctuel et sympathique.', 5, 'approuvé', 34, 7, 6),
(19, 35, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 35, 8, 7),
(20, 36, 'Conduite sécurisée et agréable.', 4, 'approuvé', 36, 8, 7),
(21, 37, 'Ponctuel et sympathique.', 5, 'approuvé', 37, 8, 7),
(22, 38, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 38, 9, 8),
(23, 39, 'Conduite sécurisée et agréable.', 4, 'approuvé', 39, 9, 8),
(24, 40, 'Ponctuel et sympathique.', 5, 'approuvé', 40, 9, 8),
(25, 41, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 41, 10, 9),
(26, 1, 'Conduite sécurisée et agréable.', 4, 'approuvé', 1, 10, 9),
(27, 2, 'Ponctuel et sympathique.', 5, 'approuvé', 2, 10, 9),
(28, 3, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 3, 11, 10),
(29, 4, 'Conduite sécurisée et agréable.', 4, 'approuvé', 4, 11, 10),
(30, 5, 'Ponctuel et sympathique.', 5, 'approuvé', 5, 11, 10),
(31, 6, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 6, 12, 11),
(32, 7, 'Conduite sécurisée et agréable.', 4, 'approuvé', 7, 12, 11),
(33, 8, 'Ponctuel et sympathique.', 5, 'approuvé', 8, 12, 11),
(37, 12, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 12, 14, 13),
(38, 13, 'Conduite sécurisée et agréable.', 4, 'approuvé', 13, 14, 13),
(39, 14, 'Ponctuel et sympathique.', 5, 'approuvé', 14, 14, 13),
(40, 15, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 15, 15, 14),
(41, 32, 'Conduite sécurisée et agréable.', 4, 'approuvé', 32, 15, 14),
(42, 33, 'Ponctuel et sympathique.', 5, 'approuvé', 33, 15, 14),
(43, 34, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 34, 1, 15),
(44, 35, 'Conduite sécurisée et agréable.', 4, 'approuvé', 35, 1, 15),
(45, 36, 'Ponctuel et sympathique.', 5, 'approuvé', 36, 1, 15),
(46, 37, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 37, 1, 16),
(47, 38, 'Conduite sécurisée et agréable.', 4, 'approuvé', 38, 1, 16),
(48, 39, 'Ponctuel et sympathique.', 5, 'approuvé', 39, 1, 16),
(49, 40, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 40, 1, 17),
(50, 41, 'Conduite sécurisée et agréable.', 4, 'approuvé', 41, 1, 17),
(51, 1, 'Ponctuel et sympathique.', 5, 'approuvé', 1, 1, 17),
(52, 2, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 2, 1, 18),
(53, 3, 'Conduite sécurisée et agréable.', 4, 'approuvé', 3, 1, 18),
(54, 4, 'Ponctuel et sympathique.', 5, 'approuvé', 4, 1, 18),
(55, 5, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 5, 1, 19),
(56, 6, 'Conduite sécurisée et agréable.', 4, 'approuvé', 6, 1, 19),
(57, 7, 'Ponctuel et sympathique.', 5, 'approuvé', 7, 1, 19),
(58, 8, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 8, 1, 20),
(59, 9, 'Conduite sécurisée et agréable.', 4, 'approuvé', 9, 1, 20),
(60, 10, 'Ponctuel et sympathique.', 5, 'approuvé', 10, 1, 20),
(61, 11, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 11, 1, 21),
(62, 12, 'Conduite sécurisée et agréable.', 4, 'approuvé', 12, 1, 21),
(63, 13, 'Ponctuel et sympathique.', 5, 'approuvé', 13, 1, 21),
(64, 14, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 14, 1, 22),
(65, 15, 'Conduite sécurisée et agréable.', 4, 'approuvé', 15, 1, 22),
(66, 32, 'Ponctuel et sympathique.', 5, 'approuvé', 32, 1, 22),
(67, 33, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 33, 1, 23),
(68, 34, 'Conduite sécurisée et agréable.', 4, 'approuvé', 34, 1, 23),
(69, 35, 'Ponctuel et sympathique.', 5, 'approuvé', 35, 1, 23),
(70, 36, 'Très bon conducteur, trajet agréable.', 5, 'approuvé', 36, 1, 24),
(71, 37, 'Conduite sécurisée et agréable.', 4, 'approuvé', 37, 1, 24),
(72, 38, 'Ponctuel et sympathique.', 5, 'approuvé', 38, 1, 24);

-- --------------------------------------------------------

--
-- Structure de la table `conducteur`
--

CREATE TABLE `conducteur` (
  `id_conducteur` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `conducteur`
--

INSERT INTO `conducteur` (`id_conducteur`, `id_utilisateur`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 32),
(17, 33),
(18, 34),
(19, 35),
(20, 36),
(21, 37),
(22, 38),
(23, 39),
(24, 40),
(25, 41);

-- --------------------------------------------------------

--
-- Structure de la table `covoiturage`
--

CREATE TABLE `covoiturage` (
  `id_covoiturage` int(11) NOT NULL,
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
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `covoiturage`
--

INSERT INTO `covoiturage` (`id_covoiturage`, `date_depart`, `heure_depart`, `lieu_depart`, `date_arrivee`, `heure_arrivee`, `lieu_arrivee`, `statut`, `nb_place`, `prix_par_personne`, `id_voiture`, `id_utilisateur`) VALUES
(2, '2025-02-02', '14:00:00', 'Paris', '2025-02-02', '16:30:00', 'Rouen', 'Complet', 4, 10, 4, 4),
(3, '2025-02-03', '09:00:00', 'Nice', '2025-02-03', '12:30:00', 'Toulouse', 'Actif', 2, 20, 5, 5),
(5, '2025-02-02', '14:00:00', 'Paris', '2025-02-02', '16:30:00', 'Rouen', 'Complet', 4, 10, 4, 4),
(6, '2025-02-03', '09:00:00', 'Nice', '2025-02-03', '12:30:00', 'Toulouse', 'Actif', 2, 20, 5, 5),
(7, '2025-02-04', '10:00:00', 'Bordeaux', '2025-02-04', '13:00:00', 'Nantes', 'Actif', 4, 18, 6, 6),
(8, '2025-02-05', '07:00:00', 'Lille', '2025-02-05', '10:00:00', 'Strasbourg', 'Actif', 3, 22, 7, 7),
(9, '2025-02-01', '15:00:00', 'Nantes', '2025-02-01', '15:00:00', 'Brest', 'Complet', 3, 44, 16, 3),
(10, '2025-02-03', '18:00:00', 'Rennes', '2025-02-03', '21:00:00', 'Strasbourg', 'Actif', 1, 40, 7, 7),
(11, '2025-02-05', '18:00:00', 'Bordeaux', '2025-02-05', '14:00:00', 'Nantes', 'Actif', 4, 18, 5, 41),
(13, '2025-02-09', '16:00:00', 'Montpellier', '2025-02-09', '18:00:00', 'Bordeaux', 'Complet', 1, 25, 16, 9),
(14, '2025-02-11', '20:00:00', 'Toulouse', '2025-02-11', '08:00:00', 'Orléans', 'Complet', 2, 24, 18, 3),
(15, '2025-02-13', '20:00:00', 'Rouen', '2025-02-13', '22:00:00', 'Bordeaux', 'Complet', 4, 40, 11, 9),
(16, '2025-02-15', '10:00:00', 'Montpellier', '2025-02-15', '12:00:00', 'Toulon', 'Actif', 3, 41, 18, 35),
(17, '2025-02-17', '19:00:00', 'Paris', '2025-02-17', '10:00:00', 'Toulouse', 'Complet', 4, 12, 7, 13),
(18, '2025-02-19', '15:00:00', 'Toulouse', '2025-02-19', '22:00:00', 'Orléans', 'Complet', 4, 40, 18, 15),
(19, '2025-02-21', '14:00:00', 'Lyon', '2025-02-21', '08:00:00', 'Rennes', 'Actif', 4, 12, 17, 12),
(20, '2025-02-23', '10:00:00', 'Rouen', '2025-02-23', '11:00:00', 'Montpellier', 'Actif', 4, 20, 13, 9),
(21, '2025-02-25', '09:00:00', 'Strasbourg', '2025-02-25', '22:00:00', 'Brest', 'Complet', 1, 41, 12, 8),
(22, '2025-02-27', '16:00:00', 'Bordeaux', '2025-02-27', '21:00:00', 'Paris', 'Actif', 2, 11, 1, 12),
(23, '2025-03-01', '10:00:00', 'Lille', '2025-03-01', '15:00:00', 'Brest', 'Complet', 3, 13, 9, 38),
(24, '2025-03-03', '20:00:00', 'Marseille', '2025-03-03', '09:00:00', 'Paris', 'Actif', 2, 43, 18, 33),
(25, '2025-03-05', '17:00:00', 'Paris', '2025-03-05', '22:00:00', 'Lille', 'Complet', 3, 37, 18, 34),
(26, '2025-03-07', '19:00:00', 'Lille', '2025-03-07', '21:00:00', 'Rennes', 'Complet', 3, 40, 14, 2),
(27, '2025-03-09', '17:00:00', 'Orléans', '2025-03-09', '16:00:00', 'Lille', 'Complet', 2, 21, 4, 15),
(28, '2025-03-11', '08:00:00', 'Paris', '2025-03-11', '12:00:00', 'Montpellier', 'Complet', 4, 22, 5, 36),
(29, '2025-03-13', '20:00:00', 'Lille', '2025-03-13', '14:00:00', 'Montpellier', 'Actif', 3, 19, 1, 3),
(30, '2025-03-15', '19:00:00', 'Lyon', '2025-03-15', '15:00:00', 'Lille', 'Actif', 4, 49, 2, 6),
(31, '2025-03-17', '07:00:00', 'Bordeaux', '2025-03-17', '09:00:00', 'Montpellier', 'Complet', 2, 37, 17, 38),
(32, '2025-03-19', '08:00:00', 'Toulon', '2025-03-19', '14:00:00', 'Strasbourg', 'Complet', 3, 29, 17, 9),
(33, '2025-03-21', '10:00:00', 'Marseille', '2025-03-21', '10:00:00', 'Strasbourg', 'Complet', 4, 14, 6, 14),
(34, '2025-03-23', '18:00:00', 'Perpignan', '2025-03-23', '14:00:00', 'Paris', 'Actif', 2, 43, 16, 7),
(35, '2025-03-25', '19:00:00', 'Toulon', '2025-03-25', '10:00:00', 'Brest', 'Actif', 2, 42, 13, 35),
(36, '2025-03-27', '12:00:00', 'Paris', '2025-03-27', '15:00:00', 'Perpignan', 'Actif', 1, 41, 15, 14),
(37, '2025-03-29', '20:00:00', 'Perpignan', '2025-03-29', '13:00:00', 'Strasbourg', 'Complet', 1, 27, 11, 35),
(38, '2025-03-31', '20:00:00', 'Rouen', '2025-03-31', '12:00:00', 'Strasbourg', 'Complet', 2, 33, 14, 6),
(39, '2025-04-02', '14:00:00', 'Toulouse', '2025-04-02', '19:00:00', 'Montpellier', 'Actif', 4, 19, 17, 8),
(40, '2025-04-04', '09:00:00', 'Perpignan', '2025-04-04', '14:00:00', 'Montpellier', 'Complet', 3, 22, 10, 9),
(41, '2025-04-06', '17:00:00', 'Toulouse', '2025-04-06', '12:00:00', 'Paris', 'Complet', 1, 13, 11, 15),
(42, '2025-04-08', '18:00:00', 'Nantes', '2025-04-08', '11:00:00', 'Lyon', 'Complet', 2, 17, 11, 9),
(43, '2025-04-10', '20:00:00', 'Brest', '2025-04-10', '12:00:00', 'Bordeaux', 'Complet', 1, 29, 3, 36),
(44, '2025-04-12', '06:00:00', 'Montpellier', '2025-04-12', '19:00:00', 'Lyon', 'Actif', 3, 27, 1, 4),
(45, '2025-04-14', '08:00:00', 'Orléans', '2025-04-14', '17:00:00', 'Marseille', 'Complet', 1, 50, 13, 4),
(46, '2025-04-16', '17:00:00', 'Lyon', '2025-04-16', '22:00:00', 'Strasbourg', 'Actif', 1, 43, 12, 1),
(47, '2025-04-18', '17:00:00', 'Lyon', '2025-04-18', '20:00:00', 'Toulouse', 'Complet', 2, 38, 16, 32),
(48, '2025-04-20', '13:00:00', 'Lille', '2025-04-20', '11:00:00', 'Paris', 'Complet', 2, 25, 13, 4),
(49, '2025-04-22', '20:00:00', 'Orléans', '2025-04-22', '20:00:00', 'Rennes', 'Actif', 2, 43, 15, 36),
(50, '2025-04-24', '15:00:00', 'Rennes', '2025-04-24', '20:00:00', 'Nice', 'Actif', 1, 35, 4, 36),
(51, '2025-04-26', '18:00:00', 'Toulouse', '2025-04-26', '17:00:00', 'Nice', 'Complet', 4, 34, 11, 11),
(52, '2025-04-28', '18:00:00', 'Rennes', '2025-04-28', '12:00:00', 'Nantes', 'Complet', 3, 42, 18, 15),
(53, '2025-04-30', '14:00:00', 'Bordeaux', '2025-04-30', '20:00:00', 'Strasbourg', 'Complet', 1, 29, 11, 4),
(54, '2025-05-02', '07:00:00', 'Brest', '2025-05-02', '17:00:00', 'Bordeaux', 'Actif', 3, 38, 9, 32),
(55, '2025-05-04', '19:00:00', 'Rennes', '2025-05-04', '12:00:00', 'Nantes', 'Actif', 2, 34, 3, 40),
(56, '2025-05-06', '16:00:00', 'Toulon', '2025-05-06', '16:00:00', 'Bordeaux', 'Actif', 1, 24, 9, 38),
(57, '2025-05-08', '09:00:00', 'Orléans', '2025-05-08', '20:00:00', 'Bordeaux', 'Complet', 2, 41, 15, 5),
(58, '2025-05-10', '10:00:00', 'Lille', '2025-05-10', '10:00:00', 'Strasbourg', 'Complet', 2, 19, 13, 40),
(59, '2025-05-12', '14:00:00', 'Marseille', '2025-05-12', '18:00:00', 'Toulon', 'Actif', 3, 24, 18, 4),
(60, '2025-05-14', '10:00:00', 'Lyon', '2025-05-14', '20:00:00', 'Bordeaux', 'Complet', 3, 28, 11, 14),
(61, '2025-05-16', '11:00:00', 'Toulouse', '2025-05-16', '15:00:00', 'Lyon', 'Actif', 3, 21, 18, 6),
(62, '2025-05-18', '18:00:00', 'Perpignan', '2025-05-18', '17:00:00', 'Marseille', 'Complet', 4, 14, 2, 37),
(63, '2025-05-20', '20:00:00', 'Bordeaux', '2025-05-20', '09:00:00', 'Brest', 'Complet', 3, 32, 12, 5),
(64, '2025-05-22', '10:00:00', 'Orléans', '2025-05-22', '15:00:00', 'Toulon', 'Complet', 1, 21, 5, 40),
(65, '2025-05-24', '07:00:00', 'Nantes', '2025-05-24', '18:00:00', 'Bordeaux', 'Complet', 3, 44, 14, 3),
(66, '2025-05-26', '20:00:00', 'Lille', '2025-05-26', '14:00:00', 'Toulon', 'Actif', 2, 12, 10, 5),
(67, '2025-05-28', '19:00:00', 'Nice', '2025-05-28', '20:00:00', 'Nantes', 'Actif', 4, 40, 2, 38),
(68, '2025-05-30', '06:00:00', 'Nantes', '2025-05-30', '21:00:00', 'Brest', 'Complet', 4, 45, 17, 37),
(69, '2025-06-01', '13:00:00', 'Paris', '2025-06-01', '15:00:00', 'Perpignan', 'Actif', 4, 29, 6, 3),
(70, '2025-06-03', '17:00:00', 'Lyon', '2025-06-03', '18:00:00', 'Rouen', 'Complet', 4, 39, 13, 14),
(71, '2025-06-05', '20:00:00', 'Toulon', '2025-06-05', '10:00:00', 'Perpignan', 'Actif', 4, 11, 9, 36),
(72, '2025-06-07', '14:00:00', 'Perpignan', '2025-06-07', '08:00:00', 'Orléans', 'Complet', 1, 17, 1, 15),
(73, '2025-06-09', '07:00:00', 'Orléans', '2025-06-09', '10:00:00', 'Brest', 'Complet', 2, 18, 11, 5),
(74, '2025-06-11', '18:00:00', 'Lyon', '2025-06-11', '19:00:00', 'Orléans', 'Complet', 2, 45, 4, 14),
(75, '2025-06-13', '20:00:00', 'Nantes', '2025-06-13', '21:00:00', 'Paris', 'Complet', 4, 45, 17, 10),
(76, '2025-06-15', '16:00:00', 'Rennes', '2025-06-15', '20:00:00', 'Brest', 'Actif', 3, 46, 11, 4),
(77, '2025-06-17', '20:00:00', 'Toulon', '2025-06-17', '09:00:00', 'Marseille', 'Complet', 2, 12, 14, 9),
(78, '2025-06-19', '09:00:00', 'Lille', '2025-06-19', '14:00:00', 'Brest', 'Complet', 2, 33, 9, 7),
(79, '2025-06-21', '13:00:00', 'Strasbourg', '2025-06-21', '10:00:00', 'Rennes', 'Actif', 2, 45, 13, 14),
(80, '2025-06-23', '10:00:00', 'Lyon', '2025-06-23', '19:00:00', 'Brest', 'Complet', 3, 10, 18, 12),
(81, '2025-06-25', '08:00:00', 'Toulouse', '2025-06-25', '10:00:00', 'Lille', 'Actif', 3, 20, 11, 35),
(82, '2025-06-27', '15:00:00', 'Rennes', '2025-06-27', '21:00:00', 'Nantes', 'Complet', 3, 19, 18, 33),
(83, '2025-06-29', '07:00:00', 'Rouen', '2025-06-29', '19:00:00', 'Paris', 'Complet', 4, 38, 16, 41),
(84, '2025-07-01', '20:00:00', 'Toulon', '2025-07-01', '09:00:00', 'Nantes', 'Actif', 2, 33, 4, 2),
(85, '2025-07-03', '08:00:00', 'Bordeaux', '2025-07-03', '19:00:00', 'Perpignan', 'Actif', 4, 32, 9, 41),
(86, '2025-07-05', '08:00:00', 'Brest', '2025-07-05', '18:00:00', 'Bordeaux', 'Actif', 2, 23, 2, 38),
(87, '2025-07-07', '12:00:00', 'Bordeaux', '2025-07-07', '11:00:00', 'Strasbourg', 'Actif', 3, 50, 2, 41),
(88, '2025-07-09', '15:00:00', 'Perpignan', '2025-07-09', '11:00:00', 'Lille', 'Complet', 3, 50, 3, 14),
(89, '2025-07-11', '19:00:00', 'Montpellier', '2025-07-11', '10:00:00', 'Toulon', 'Complet', 2, 19, 10, 7),
(90, '2025-07-13', '16:00:00', 'Toulon', '2025-07-13', '09:00:00', 'Orléans', 'Complet', 2, 11, 6, 6),
(91, '2025-07-15', '10:00:00', 'Nice', '2025-07-15', '13:00:00', 'Lille', 'Actif', 1, 33, 15, 10),
(92, '2025-07-17', '16:00:00', 'Perpignan', '2025-07-17', '14:00:00', 'Brest', 'Complet', 4, 35, 9, 14),
(93, '2025-07-19', '15:00:00', 'Montpellier', '2025-07-19', '14:00:00', 'Toulon', 'Actif', 3, 29, 5, 37),
(94, '2025-07-21', '15:00:00', 'Strasbourg', '2025-07-21', '10:00:00', 'Orléans', 'Complet', 1, 39, 5, 3),
(95, '2025-07-23', '10:00:00', 'Lyon', '2025-07-23', '08:00:00', 'Paris', 'Complet', 4, 26, 16, 38),
(96, '2025-07-25', '10:00:00', 'Nice', '2025-07-25', '17:00:00', 'Lille', 'Actif', 3, 41, 14, 5),
(97, '2025-07-27', '11:00:00', 'Montpellier', '2025-07-27', '16:00:00', 'Marseille', 'Complet', 1, 15, 17, 3),
(98, '2025-07-29', '10:00:00', 'Rouen', '2025-07-29', '10:00:00', 'Toulon', 'Actif', 4, 36, 18, 39),
(99, '2025-02-01', '09:00:00', 'Perpignan', '2025-02-01', '19:00:00', 'Marseille', 'Complet', 2, 44, 5, 36),
(100, '2025-02-03', '19:00:00', 'Nantes', '2025-02-03', '12:00:00', 'Rouen', 'Actif', 3, 15, 9, 40),
(101, '2025-02-05', '06:00:00', 'Lyon', '2025-02-05', '20:00:00', 'Strasbourg', 'Complet', 1, 16, 12, 13),
(102, '2025-02-07', '15:00:00', 'Montpellier', '2025-02-07', '21:00:00', 'Perpignan', 'Complet', 1, 41, 2, 36),
(103, '2025-02-09', '13:00:00', 'Toulouse', '2025-02-09', '17:00:00', 'Nice', 'Actif', 3, 47, 17, 35),
(104, '2025-02-11', '13:00:00', 'Rennes', '2025-02-11', '14:00:00', 'Strasbourg', 'Actif', 4, 34, 16, 6),
(105, '2025-02-13', '19:00:00', 'Montpellier', '2025-02-13', '13:00:00', 'Lille', 'Complet', 2, 31, 13, 11),
(106, '2025-02-15', '16:00:00', 'Bordeaux', '2025-02-15', '13:00:00', 'Marseille', 'Complet', 1, 17, 18, 36),
(107, '2025-02-17', '17:00:00', 'Strasbourg', '2025-02-17', '21:00:00', 'Lille', 'Actif', 4, 42, 13, 7),
(108, '2025-02-19', '09:00:00', 'Strasbourg', '2025-02-19', '08:00:00', 'Marseille', 'Actif', 4, 34, 11, 37),
(109, '2025-02-21', '06:00:00', 'Montpellier', '2025-02-21', '15:00:00', 'Marseille', 'Complet', 1, 18, 10, 12),
(110, '2025-02-23', '20:00:00', 'Marseille', '2025-02-23', '17:00:00', 'Toulouse', 'Complet', 1, 46, 1, 2),
(111, '2025-02-25', '07:00:00', 'Marseille', '2025-02-25', '08:00:00', 'Toulon', 'Complet', 3, 14, 1, 7),
(112, '2025-02-27', '12:00:00', 'Toulon', '2025-02-27', '13:00:00', 'Rouen', 'Actif', 2, 35, 13, 10),
(113, '2025-03-01', '11:00:00', 'Strasbourg', '2025-03-01', '11:00:00', 'Nantes', 'Complet', 1, 13, 2, 40),
(114, '2025-03-03', '09:00:00', 'Brest', '2025-03-03', '08:00:00', 'Marseille', 'Actif', 1, 36, 6, 13),
(115, '2025-03-05', '19:00:00', 'Toulouse', '2025-03-05', '20:00:00', 'Toulon', 'Complet', 2, 26, 9, 14),
(116, '2025-03-07', '14:00:00', 'Toulouse', '2025-03-07', '20:00:00', 'Montpellier', 'Complet', 3, 23, 10, 4),
(117, '2025-03-09', '09:00:00', 'Toulon', '2025-03-09', '11:00:00', 'Orléans', 'Actif', 2, 49, 2, 5),
(118, '2025-03-11', '15:00:00', 'Lyon', '2025-03-11', '08:00:00', 'Lille', 'Complet', 4, 15, 4, 33),
(119, '2025-03-13', '18:00:00', 'Nice', '2025-03-13', '08:00:00', 'Toulouse', 'Actif', 3, 45, 12, 37),
(120, '2025-03-15', '18:00:00', 'Paris', '2025-03-15', '21:00:00', 'Nantes', 'Actif', 4, 16, 17, 6),
(121, '2025-03-17', '07:00:00', 'Lille', '2025-03-17', '22:00:00', 'Marseille', 'Complet', 1, 19, 17, 37),
(122, '2025-03-19', '20:00:00', 'Rouen', '2025-03-19', '20:00:00', 'Toulouse', 'Actif', 2, 13, 6, 37),
(123, '2025-03-21', '20:00:00', 'Nantes', '2025-03-21', '14:00:00', 'Paris', 'Actif', 2, 29, 5, 39),
(124, '2025-03-23', '12:00:00', 'Rouen', '2025-03-23', '22:00:00', 'Brest', 'Actif', 4, 33, 6, 38),
(125, '2025-03-25', '11:00:00', 'Lyon', '2025-03-25', '08:00:00', 'Rouen', 'Actif', 2, 28, 17, 2),
(126, '2025-03-27', '20:00:00', 'Lyon', '2025-03-27', '22:00:00', 'Rennes', 'Complet', 2, 49, 2, 36),
(127, '2025-03-29', '08:00:00', 'Paris', '2025-03-29', '09:00:00', 'Rouen', 'Complet', 4, 13, 13, 38),
(128, '2025-03-31', '15:00:00', 'Nantes', '2025-03-31', '08:00:00', 'Paris', 'Complet', 3, 27, 9, 33),
(129, '2025-04-02', '11:00:00', 'Montpellier', '2025-04-02', '11:00:00', 'Nantes', 'Actif', 1, 18, 13, 36),
(130, '2025-04-04', '19:00:00', 'Toulon', '2025-04-04', '12:00:00', 'Bordeaux', 'Actif', 4, 10, 18, 15),
(131, '2025-04-06', '11:00:00', 'Rouen', '2025-04-06', '14:00:00', 'Orléans', 'Complet', 1, 27, 1, 4),
(132, '2025-04-08', '18:00:00', 'Lille', '2025-04-08', '16:00:00', 'Paris', 'Actif', 4, 21, 17, 14),
(133, '2025-04-10', '17:00:00', 'Montpellier', '2025-04-10', '08:00:00', 'Nice', 'Actif', 1, 50, 15, 15),
(134, '2025-04-12', '14:00:00', 'Bordeaux', '2025-04-12', '11:00:00', 'Strasbourg', 'Complet', 2, 24, 12, 34),
(135, '2025-04-14', '11:00:00', 'Orléans', '2025-04-14', '11:00:00', 'Bordeaux', 'Actif', 2, 26, 10, 11),
(136, '2025-04-16', '14:00:00', 'Paris', '2025-04-16', '22:00:00', 'Marseille', 'Complet', 4, 49, 11, 41),
(137, '2025-04-18', '20:00:00', 'Orléans', '2025-04-18', '15:00:00', 'Lille', 'Actif', 1, 35, 5, 10),
(138, '2025-04-20', '18:00:00', 'Strasbourg', '2025-04-20', '08:00:00', 'Nice', 'Complet', 1, 29, 16, 3),
(139, '2025-04-22', '11:00:00', 'Rouen', '2025-04-22', '22:00:00', 'Lyon', 'Actif', 1, 10, 9, 15),
(140, '2025-04-24', '09:00:00', 'Perpignan', '2025-04-24', '15:00:00', 'Orléans', 'Complet', 4, 22, 2, 11),
(141, '2025-04-26', '15:00:00', 'Nice', '2025-04-26', '18:00:00', 'Nantes', 'Complet', 3, 12, 18, 3),
(142, '2025-04-28', '19:00:00', 'Rennes', '2025-04-28', '18:00:00', 'Rouen', 'Actif', 3, 12, 16, 37),
(143, '2025-04-30', '12:00:00', 'Marseille', '2025-04-30', '09:00:00', 'Paris', 'Actif', 1, 30, 17, 3),
(144, '2025-05-02', '19:00:00', 'Rennes', '2025-05-02', '12:00:00', 'Lyon', 'Actif', 4, 44, 5, 6),
(145, '2025-05-04', '20:00:00', 'Strasbourg', '2025-05-04', '11:00:00', 'Orléans', 'Complet', 1, 49, 5, 34),
(146, '2025-05-06', '09:00:00', 'Brest', '2025-05-06', '16:00:00', 'Marseille', 'Actif', 2, 38, 15, 4),
(147, '2025-05-08', '18:00:00', 'Paris', '2025-05-08', '10:00:00', 'Bordeaux', 'Actif', 1, 28, 18, 36),
(148, '2025-05-10', '12:00:00', 'Strasbourg', '2025-05-10', '12:00:00', 'Lille', 'Actif', 1, 34, 14, 35),
(149, '2025-05-12', '12:00:00', 'Bordeaux', '2025-05-12', '17:00:00', 'Paris', 'Complet', 3, 39, 2, 33),
(150, '2025-05-14', '08:00:00', 'Bordeaux', '2025-05-14', '13:00:00', 'Orléans', 'Actif', 4, 49, 15, 36),
(151, '2025-05-16', '17:00:00', 'Lyon', '2025-05-16', '13:00:00', 'Strasbourg', 'Actif', 2, 34, 7, 9),
(152, '2025-05-18', '20:00:00', 'Nice', '2025-05-18', '18:00:00', 'Nantes', 'Actif', 2, 17, 7, 13),
(153, '2025-05-20', '17:00:00', 'Strasbourg', '2025-05-20', '11:00:00', 'Toulon', 'Actif', 3, 12, 2, 39),
(154, '2025-05-22', '18:00:00', 'Lyon', '2025-05-22', '10:00:00', 'Lille', 'Complet', 2, 10, 2, 6),
(155, '2025-05-24', '18:00:00', 'Toulouse', '2025-05-24', '21:00:00', 'Strasbourg', 'Actif', 3, 47, 3, 32),
(156, '2025-05-26', '20:00:00', 'Lille', '2025-05-26', '17:00:00', 'Paris', 'Actif', 3, 21, 4, 35),
(157, '2025-05-28', '15:00:00', 'Rouen', '2025-05-28', '14:00:00', 'Orléans', 'Actif', 2, 19, 11, 38),
(158, '2025-05-30', '13:00:00', 'Toulouse', '2025-05-30', '13:00:00', 'Perpignan', 'Actif', 2, 24, 5, 15),
(159, '2025-06-01', '06:00:00', 'Nice', '2025-06-01', '12:00:00', 'Toulon', 'Actif', 3, 14, 3, 8),
(160, '2025-06-03', '18:00:00', 'Lyon', '2025-06-03', '11:00:00', 'Rouen', 'Actif', 2, 14, 17, 10),
(161, '2025-06-05', '13:00:00', 'Orléans', '2025-06-05', '12:00:00', 'Strasbourg', 'Actif', 3, 40, 4, 9),
(162, '2025-06-07', '07:00:00', 'Rouen', '2025-06-07', '09:00:00', 'Perpignan', 'Actif', 4, 20, 9, 41),
(163, '2025-06-09', '17:00:00', 'Nice', '2025-06-09', '11:00:00', 'Nantes', 'Complet', 3, 47, 7, 10),
(164, '2025-06-11', '06:00:00', 'Brest', '2025-06-11', '15:00:00', 'Lille', 'Actif', 4, 22, 4, 34),
(165, '2025-06-13', '06:00:00', 'Toulon', '2025-06-13', '12:00:00', 'Strasbourg', 'Actif', 1, 27, 3, 34),
(166, '2025-06-15', '10:00:00', 'Montpellier', '2025-06-15', '09:00:00', 'Toulon', 'Actif', 3, 34, 5, 39),
(167, '2025-06-17', '10:00:00', 'Toulouse', '2025-06-17', '20:00:00', 'Nice', 'Complet', 3, 27, 7, 39),
(168, '2025-06-19', '10:00:00', 'Strasbourg', '2025-06-19', '11:00:00', 'Orléans', 'Actif', 3, 12, 7, 8),
(169, '2025-06-21', '07:00:00', 'Bordeaux', '2025-06-21', '12:00:00', 'Montpellier', 'Actif', 2, 28, 1, 36),
(170, '2025-06-23', '18:00:00', 'Rouen', '2025-06-23', '08:00:00', 'Toulon', 'Actif', 2, 41, 12, 15),
(171, '2025-06-25', '15:00:00', 'Toulouse', '2025-06-25', '10:00:00', 'Marseille', 'Actif', 4, 15, 9, 12),
(172, '2025-06-27', '08:00:00', 'Toulouse', '2025-06-27', '08:00:00', 'Nice', 'Complet', 4, 37, 1, 4),
(173, '2025-06-29', '08:00:00', 'Brest', '2025-06-29', '21:00:00', 'Rouen', 'Complet', 4, 26, 17, 15),
(174, '2025-07-01', '08:00:00', 'Rennes', '2025-07-01', '09:00:00', 'Marseille', 'Complet', 4, 26, 6, 12),
(175, '2025-07-03', '15:00:00', 'Orléans', '2025-07-03', '08:00:00', 'Strasbourg', 'Actif', 4, 47, 17, 11),
(176, '2025-07-05', '14:00:00', 'Nantes', '2025-07-05', '17:00:00', 'Strasbourg', 'Complet', 2, 38, 6, 3),
(177, '2025-07-07', '10:00:00', 'Rouen', '2025-07-07', '19:00:00', 'Paris', 'Complet', 4, 20, 16, 10),
(178, '2025-07-09', '10:00:00', 'Rouen', '2025-07-09', '09:00:00', 'Strasbourg', 'Complet', 4, 46, 17, 37),
(179, '2025-07-11', '09:00:00', 'Marseille', '2025-07-11', '12:00:00', 'Bordeaux', 'Complet', 2, 32, 7, 33),
(180, '2025-07-13', '20:00:00', 'Toulouse', '2025-07-13', '14:00:00', 'Marseille', 'Complet', 1, 37, 14, 8),
(181, '2025-07-15', '16:00:00', 'Nantes', '2025-07-15', '18:00:00', 'Paris', 'Complet', 1, 12, 15, 33),
(182, '2025-07-17', '12:00:00', 'Paris', '2025-07-17', '13:00:00', 'Lyon', 'Actif', 1, 12, 3, 32),
(183, '2025-07-19', '12:00:00', 'Brest', '2025-07-19', '12:00:00', 'Paris', 'Actif', 1, 30, 17, 40),
(184, '2025-07-21', '10:00:00', 'Rouen', '2025-07-21', '22:00:00', 'Bordeaux', 'Complet', 3, 42, 4, 10),
(185, '2025-07-23', '18:00:00', 'Nantes', '2025-07-23', '08:00:00', 'Montpellier', 'Actif', 1, 41, 6, 35),
(186, '2025-07-25', '06:00:00', 'Montpellier', '2025-07-25', '10:00:00', 'Lille', 'Actif', 4, 33, 16, 33),
(187, '2025-07-27', '14:00:00', 'Toulouse', '2025-07-27', '22:00:00', 'Bordeaux', 'Actif', 1, 44, 18, 6),
(188, '2025-07-29', '06:00:00', 'Brest', '2025-07-29', '22:00:00', 'Lille', 'Actif', 1, 29, 10, 39),
(189, '2025-02-01', '19:00:00', 'Strasbourg', '2025-02-01', '14:00:00', 'Montpellier', 'Complet', 2, 42, 1, 3),
(190, '2025-02-03', '18:00:00', 'Lille', '2025-02-03', '14:00:00', 'Paris', 'Actif', 2, 42, 15, 9),
(191, '2025-02-05', '12:00:00', 'Rouen', '2025-02-05', '21:00:00', 'Nantes', 'Complet', 2, 21, 6, 37),
(193, '2025-02-09', '17:00:00', 'Brest', '2025-02-09', '14:00:00', 'Marseille', 'Actif', 4, 40, 12, 15),
(194, '2025-02-11', '17:00:00', 'Perpignan', '2025-02-11', '09:00:00', 'Nice', 'Complet', 2, 19, 11, 9),
(195, '2025-02-13', '06:00:00', 'Toulon', '2025-02-13', '14:00:00', 'Nice', 'Complet', 1, 38, 5, 3),
(196, '2025-02-15', '18:00:00', 'Bordeaux', '2025-02-15', '21:00:00', 'Toulouse', 'Actif', 4, 13, 6, 34),
(197, '2025-02-17', '08:00:00', 'Brest', '2025-02-17', '13:00:00', 'Lille', 'Complet', 2, 29, 6, 11),
(198, '2025-02-19', '12:00:00', 'Lyon', '2025-02-19', '21:00:00', 'Toulon', 'Actif', 3, 18, 11, 35),
(199, '2025-02-21', '20:00:00', 'Lille', '2025-02-21', '12:00:00', 'Lyon', 'Complet', 1, 15, 5, 9),
(200, '2025-02-23', '07:00:00', 'Toulouse', '2025-02-23', '12:00:00', 'Lille', 'Complet', 2, 38, 16, 38),
(201, '2025-02-25', '16:00:00', 'Bordeaux', '2025-02-25', '22:00:00', 'Toulouse', 'Actif', 2, 46, 17, 38),
(202, '2025-02-27', '09:00:00', 'Rennes', '2025-02-27', '11:00:00', 'Montpellier', 'Complet', 4, 36, 18, 7),
(203, '2025-03-01', '20:00:00', 'Montpellier', '2025-03-01', '11:00:00', 'Perpignan', 'Complet', 4, 28, 4, 39),
(204, '2025-03-03', '07:00:00', 'Lyon', '2025-03-03', '17:00:00', 'Montpellier', 'Complet', 2, 33, 2, 35),
(205, '2025-03-05', '13:00:00', 'Montpellier', '2025-03-05', '17:00:00', 'Toulouse', 'Actif', 2, 42, 9, 11),
(206, '2025-03-07', '06:00:00', 'Orléans', '2025-03-07', '19:00:00', 'Lille', 'Actif', 3, 23, 14, 2),
(207, '2025-03-09', '19:00:00', 'Bordeaux', '2025-03-09', '11:00:00', 'Strasbourg', 'Complet', 2, 38, 1, 37),
(208, '2025-03-11', '18:00:00', 'Lille', '2025-03-11', '10:00:00', 'Montpellier', 'Complet', 4, 25, 2, 3),
(209, '2025-03-13', '14:00:00', 'Toulon', '2025-03-13', '12:00:00', 'Bordeaux', 'Actif', 4, 41, 18, 40),
(210, '2025-03-15', '15:00:00', 'Marseille', '2025-03-15', '13:00:00', 'Brest', 'Actif', 4, 22, 1, 35),
(211, '2025-03-17', '15:00:00', 'Paris', '2025-03-17', '15:00:00', 'Lille', 'Actif', 3, 42, 1, 39),
(212, '2025-03-19', '10:00:00', 'Marseille', '2025-03-19', '12:00:00', 'Orléans', 'Complet', 1, 45, 1, 40),
(213, '2025-03-21', '08:00:00', 'Perpignan', '2025-03-21', '21:00:00', 'Bordeaux', 'Complet', 4, 23, 14, 6),
(214, '2025-03-23', '20:00:00', 'Nantes', '2025-03-23', '09:00:00', 'Strasbourg', 'Actif', 1, 38, 5, 5),
(215, '2025-03-25', '19:00:00', 'Toulon', '2025-03-25', '18:00:00', 'Toulouse', 'Complet', 2, 47, 1, 6),
(216, '2025-03-27', '15:00:00', 'Toulon', '2025-03-27', '18:00:00', 'Marseille', 'Complet', 3, 48, 1, 2),
(217, '2025-03-29', '16:00:00', 'Toulon', '2025-03-29', '18:00:00', 'Montpellier', 'Actif', 3, 14, 11, 12),
(218, '2025-03-31', '14:00:00', 'Bordeaux', '2025-03-31', '10:00:00', 'Rennes', 'Complet', 1, 21, 16, 5),
(219, '2025-04-02', '18:00:00', 'Toulon', '2025-04-02', '21:00:00', 'Lille', 'Complet', 3, 14, 3, 4),
(220, '2025-04-04', '18:00:00', 'Bordeaux', '2025-04-04', '22:00:00', 'Brest', 'Actif', 3, 15, 2, 7),
(221, '2025-04-06', '11:00:00', 'Rennes', '2025-04-06', '10:00:00', 'Nantes', 'Complet', 3, 27, 15, 34),
(222, '2025-04-08', '11:00:00', 'Orléans', '2025-04-08', '17:00:00', 'Toulon', 'Actif', 4, 14, 6, 32),
(223, '2025-04-10', '11:00:00', 'Rouen', '2025-04-10', '13:00:00', 'Toulouse', 'Actif', 3, 24, 16, 1),
(224, '2025-04-12', '06:00:00', 'Montpellier', '2025-04-12', '17:00:00', 'Paris', 'Complet', 4, 12, 3, 4),
(225, '2025-04-14', '14:00:00', 'Rouen', '2025-04-14', '08:00:00', 'Nice', 'Actif', 2, 42, 12, 6),
(226, '2025-04-16', '06:00:00', 'Nice', '2025-04-16', '10:00:00', 'Marseille', 'Complet', 1, 33, 16, 14),
(227, '2025-04-18', '08:00:00', 'Strasbourg', '2025-04-18', '20:00:00', 'Rouen', 'Complet', 2, 43, 18, 14),
(228, '2025-04-20', '17:00:00', 'Toulouse', '2025-04-20', '18:00:00', 'Toulon', 'Complet', 1, 12, 6, 7),
(229, '2025-04-22', '12:00:00', 'Rennes', '2025-04-22', '17:00:00', 'Nice', 'Complet', 1, 44, 7, 10),
(230, '2025-04-24', '09:00:00', 'Perpignan', '2025-04-24', '22:00:00', 'Toulon', 'Actif', 3, 49, 3, 14),
(231, '2025-04-26', '14:00:00', 'Rennes', '2025-04-26', '13:00:00', 'Orléans', 'Complet', 3, 50, 14, 1),
(232, '2025-04-28', '19:00:00', 'Rennes', '2025-04-28', '21:00:00', 'Toulon', 'Complet', 3, 43, 1, 12),
(233, '2025-04-30', '16:00:00', 'Rennes', '2025-04-30', '12:00:00', 'Perpignan', 'Actif', 4, 22, 5, 11),
(234, '2025-05-02', '07:00:00', 'Nantes', '2025-05-02', '17:00:00', 'Marseille', 'Complet', 3, 50, 3, 5),
(235, '2025-05-04', '17:00:00', 'Nantes', '2025-05-04', '20:00:00', 'Nice', 'Actif', 1, 43, 16, 41),
(236, '2025-05-06', '20:00:00', 'Orléans', '2025-05-06', '22:00:00', 'Marseille', 'Complet', 1, 30, 5, 37),
(237, '2025-05-08', '06:00:00', 'Montpellier', '2025-05-08', '13:00:00', 'Strasbourg', 'Actif', 4, 28, 17, 14),
(238, '2025-05-10', '07:00:00', 'Strasbourg', '2025-05-10', '17:00:00', 'Orléans', 'Complet', 4, 13, 1, 5),
(239, '2025-05-12', '09:00:00', 'Rennes', '2025-05-12', '10:00:00', 'Nantes', 'Actif', 2, 13, 7, 36),
(240, '2025-05-14', '16:00:00', 'Toulouse', '2025-05-14', '21:00:00', 'Nice', 'Complet', 1, 20, 13, 33),
(241, '2025-05-16', '16:00:00', 'Toulon', '2025-05-16', '08:00:00', 'Orléans', 'Complet', 4, 36, 9, 13),
(242, '2025-05-18', '12:00:00', 'Strasbourg', '2025-05-18', '18:00:00', 'Lille', 'Actif', 2, 41, 5, 15),
(243, '2025-05-20', '14:00:00', 'Paris', '2025-05-20', '18:00:00', 'Montpellier', 'Actif', 3, 47, 10, 34),
(244, '2025-05-22', '08:00:00', 'Marseille', '2025-05-22', '10:00:00', 'Nantes', 'Actif', 3, 40, 5, 39),
(245, '2025-05-24', '10:00:00', 'Nice', '2025-05-24', '15:00:00', 'Lille', 'Complet', 2, 41, 17, 10),
(246, '2025-05-26', '18:00:00', 'Rouen', '2025-05-26', '08:00:00', 'Toulon', 'Complet', 1, 19, 5, 32),
(247, '2025-05-28', '20:00:00', 'Toulon', '2025-05-28', '18:00:00', 'Montpellier', 'Complet', 1, 19, 18, 14),
(248, '2025-05-30', '20:00:00', 'Strasbourg', '2025-05-30', '15:00:00', 'Montpellier', 'Actif', 1, 11, 15, 37),
(249, '2025-06-01', '11:00:00', 'Bordeaux', '2025-06-01', '16:00:00', 'Orléans', 'Complet', 4, 44, 11, 14),
(250, '2025-06-03', '15:00:00', 'Orléans', '2025-06-03', '13:00:00', 'Nantes', 'Actif', 2, 12, 16, 38),
(251, '2025-06-05', '10:00:00', 'Montpellier', '2025-06-05', '11:00:00', 'Nantes', 'Actif', 2, 42, 5, 10),
(252, '2025-06-07', '07:00:00', 'Perpignan', '2025-06-07', '18:00:00', 'Rouen', 'Actif', 4, 35, 12, 41),
(253, '2025-06-09', '11:00:00', 'Montpellier', '2025-06-09', '10:00:00', 'Brest', 'Complet', 3, 19, 4, 9),
(254, '2025-06-11', '18:00:00', 'Lille', '2025-06-11', '14:00:00', 'Toulouse', 'Actif', 3, 46, 13, 35),
(255, '2025-06-13', '15:00:00', 'Marseille', '2025-06-13', '10:00:00', 'Paris', 'Actif', 2, 17, 2, 15),
(256, '2025-06-15', '17:00:00', 'Orléans', '2025-06-15', '10:00:00', 'Lyon', 'Complet', 1, 25, 16, 35),
(257, '2025-06-17', '07:00:00', 'Rennes', '2025-06-17', '12:00:00', 'Nice', 'Complet', 3, 29, 6, 12),
(258, '2025-06-19', '11:00:00', 'Toulouse', '2025-06-19', '11:00:00', 'Paris', 'Actif', 2, 37, 3, 10),
(259, '2025-06-21', '09:00:00', 'Brest', '2025-06-21', '10:00:00', 'Nice', 'Complet', 1, 33, 16, 10),
(260, '2025-06-23', '07:00:00', 'Toulouse', '2025-06-23', '21:00:00', 'Bordeaux', 'Complet', 2, 10, 17, 33),
(261, '2025-06-25', '08:00:00', 'Nice', '2025-06-25', '20:00:00', 'Lille', 'Actif', 3, 14, 4, 14),
(262, '2025-06-27', '18:00:00', 'Bordeaux', '2025-06-27', '19:00:00', 'Lyon', 'Actif', 1, 32, 1, 35),
(263, '2025-06-29', '14:00:00', 'Lyon', '2025-06-29', '12:00:00', 'Brest', 'Actif', 3, 27, 3, 15),
(264, '2025-07-01', '07:00:00', 'Rennes', '2025-07-01', '22:00:00', 'Paris', 'Actif', 1, 49, 15, 13),
(265, '2025-07-03', '16:00:00', 'Lyon', '2025-07-03', '12:00:00', 'Perpignan', 'Complet', 4, 18, 9, 38),
(266, '2025-07-05', '12:00:00', 'Rennes', '2025-07-05', '13:00:00', 'Lille', 'Complet', 1, 43, 9, 14),
(267, '2025-07-07', '16:00:00', 'Nantes', '2025-07-07', '18:00:00', 'Bordeaux', 'Complet', 4, 24, 9, 8),
(268, '2025-07-09', '20:00:00', 'Bordeaux', '2025-07-09', '10:00:00', 'Nice', 'Actif', 2, 42, 3, 3),
(269, '2025-07-11', '19:00:00', 'Bordeaux', '2025-07-11', '10:00:00', 'Nice', 'Complet', 3, 32, 12, 36),
(270, '2025-07-13', '06:00:00', 'Rennes', '2025-07-13', '11:00:00', 'Montpellier', 'Actif', 2, 26, 10, 3),
(271, '2025-07-15', '15:00:00', 'Montpellier', '2025-07-15', '18:00:00', 'Rennes', 'Actif', 2, 15, 12, 39),
(272, '2025-07-17', '19:00:00', 'Brest', '2025-07-17', '14:00:00', 'Bordeaux', 'Actif', 4, 50, 4, 3),
(273, '2025-07-19', '20:00:00', 'Paris', '2025-07-19', '20:00:00', 'Marseille', 'Actif', 1, 44, 16, 6),
(274, '2025-07-21', '20:00:00', 'Toulouse', '2025-07-21', '22:00:00', 'Rouen', 'Actif', 4, 23, 10, 8),
(275, '2025-07-23', '11:00:00', 'Nantes', '2025-07-23', '15:00:00', 'Rouen', 'Actif', 2, 20, 7, 32),
(276, '2025-07-25', '19:00:00', 'Orléans', '2025-07-25', '15:00:00', 'Nice', 'Complet', 1, 30, 3, 1),
(277, '2025-07-27', '08:00:00', 'Nantes', '2025-07-27', '08:00:00', 'Orléans', 'Actif', 3, 34, 11, 35),
(278, '2025-07-29', '10:00:00', 'Rouen', '2025-07-29', '09:00:00', 'Marseille', 'Complet', 2, 15, 1, 38),
(279, '2025-02-20', '20:00:00', 'Montargis', '2025-02-21', '02:00:00', 'Nîmes', 'En attente', 3, 15, 20, 44),
(280, '2025-02-21', '10:30:00', 'Nîmes', '2025-02-21', '17:00:00', 'Montargis', 'En attente', 3, 15, 20, 44);

-- --------------------------------------------------------

--
-- Structure de la table `credit`
--

CREATE TABLE `credit` (
  `id_credit` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `solde` int(11) NOT NULL DEFAULT 20
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `credit`
--

INSERT INTO `credit` (`id_credit`, `id_utilisateur`, `solde`) VALUES
(1, 1, 17),
(2, 4, 20),
(3, 6, 20),
(4, 10, 20),
(5, 12, 20),
(6, 15, 20),
(7, 36, 20),
(8, 37, 20),
(9, 38, 20),
(10, 2, 20),
(11, 5, 20),
(12, 8, 23),
(13, 11, 20),
(14, 13, 20),
(15, 34, 20),
(16, 35, 20),
(17, 39, 20),
(18, 40, 20),
(19, 41, 20),
(20, 3, 20),
(21, 7, 20),
(22, 9, 20),
(23, 14, 20),
(24, 32, 20),
(25, 33, 20),
(32, 44, 18);

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `id_employe` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id_employe`, `pseudo`, `email`, `mot_de_passe`, `nom`, `prenom`, `telephone`, `adresse`, `date_naissance`) VALUES
(111, 'jdoe', 'jdoe@example.com', 'ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f', 'Doe', 'John', '0123456789', '123 Rue Exemple, Paris', '1980-01-01'),
(222, 'asmith', 'asmith@example.com', 'c6ba91b90d922e159893f46c387e5dc1b3dc5c101a5a4522f03b987177a24a91', 'Smith', 'Alice', '0987654321', '456 Avenue Exemple, Lyon', '1985-05-15');

-- --------------------------------------------------------

--
-- Structure de la table `historiquevoyages`
--

CREATE TABLE `historiquevoyages` (
  `id_historique` int(11) NOT NULL,
  `depart` varchar(50) NOT NULL,
  `arrivee` varchar(50) NOT NULL,
  `duree` varchar(50) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `statut` varchar(50) DEFAULT NULL,
  `avis_donné` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `historiquevoyages`
--

INSERT INTO `historiquevoyages` (`id_historique`, `depart`, `arrivee`, `duree`, `id_utilisateur`, `statut`, `avis_donné`) VALUES
(1, 'Paris', 'Marseille', '9h', 1, NULL, 0),
(2, 'Marseille', 'Montpellier', '3h', 1, NULL, 0),
(3, 'Montpellier', 'Toulouse', '3h', 1, NULL, 0),
(4, 'Toulouse', 'Paris', '8h', 1, NULL, 0),
(5, 'Paris', 'Orleans', '3h', 1, NULL, 0),
(6, 'Lyon', 'Marseille', '3 heures 0 minutes', 1, 'terminé', 0),
(7, 'Marseille', 'Lyon', '3 heures 0 minutes', 1, 'terminé', 0),
(8, 'Perpignan', 'Lille', '15 heures 0 minutes', 1, 'terminé', 0),
(9, 'Paris', 'Montpellier', '2 heures 0 minutes', 1, 'terminé', 0);

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `id_marque` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id_marque`, `libelle`) VALUES
(1, 'Peugeot'),
(2, 'Renault'),
(3, 'Citroën'),
(4, 'BMW'),
(5, 'Mercedes'),
(6, 'Toyota'),
(7, 'Honda'),
(8, 'Audi'),
(9, 'Volkswagen'),
(10, 'Nissan'),
(11, 'Ford'),
(12, 'Kia'),
(13, 'Hyundai'),
(14, 'Mazda'),
(15, 'Skoda'),
(16, 'Fiat'),
(17, 'Lancia'),
(18, 'Alfa Romeo'),
(19, 'Opel'),
(20, 'Tesla');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `nom`, `prenom`, `email`, `message`, `date`) VALUES
(1, 'Paul', 'Pierre', 'paul-pierre@exemple.com', 'Hello, c&#039;est un test', '2025-02-10 10:55:30');

-- --------------------------------------------------------

--
-- Structure de la table `parametre`
--

CREATE TABLE `parametre` (
  `id_parametre` int(11) NOT NULL,
  `propriete` varchar(50) NOT NULL,
  `valeur` varchar(50) NOT NULL,
  `id_configuration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `passager`
--

CREATE TABLE `passager` (
  `id_passager` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_covoiturage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `passager`
--

INSERT INTO `passager` (`id_passager`, `id_utilisateur`, `id_covoiturage`) VALUES
(1, 2, 0),
(2, 5, 0),
(3, 8, 0),
(4, 11, 0),
(5, 13, 0),
(6, 34, 0),
(7, 35, 0),
(8, 39, 0),
(9, 40, 0),
(10, 41, 0),
(16, 1, 21),
(17, 1, 21),
(18, 1, 21);

-- --------------------------------------------------------

--
-- Structure de la table `preferences`
--

CREATE TABLE `preferences` (
  `id_preference` int(11) NOT NULL,
  `fumeur` varchar(10) NOT NULL,
  `animaux` varchar(10) NOT NULL,
  `trajets` varchar(50) NOT NULL,
  `pause` varchar(10) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `preferences`
--

INSERT INTO `preferences` (`id_preference`, `fumeur`, `animaux`, `trajets`, `pause`, `id_utilisateur`) VALUES
(1, 'Non', 'Non', 'Long', 'Oui', 1),
(2, 'Oui', 'Oui', 'Court', 'Non', 2),
(3, 'Non', 'Non', 'Long', 'Oui', 3),
(4, 'Non', 'Oui', 'Court', 'Oui', 4),
(5, 'Oui', 'Oui', 'Long', 'Oui', 5),
(6, 'Non', 'Non', 'Long', 'Oui', 6),
(7, 'Non', 'Oui', 'Long', 'Non', 7),
(8, 'Non', 'Non', 'Court', 'Non', 8),
(9, 'Oui', 'Non', 'Long', 'Oui', 9),
(10, 'Oui', 'Oui', 'Long', 'Oui', 10),
(11, 'Non', 'Non', 'Long', 'Non', 11),
(12, 'Non', 'Non', 'Long', 'Non', 12),
(13, 'Non', 'Oui', 'Long', 'Oui', 13),
(14, 'Oui', 'Non', 'Court', 'Oui', 14),
(15, 'Non', 'Non', 'Court', 'Non', 15),
(16, 'Non', 'Non', 'Court', 'Oui', 2);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `libelle`) VALUES
(1, 'Admin'),
(2, 'Conducteur'),
(3, 'Passager'),
(4, 'Les deux'),
(13, 'Les deux');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telephone` varchar(50) DEFAULT NULL,
  `adresse` varchar(50) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `photo` blob DEFAULT NULL,
  `pseudo` varchar(50) NOT NULL,
  `id_role` int(11) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('utilisateur','employe') NOT NULL DEFAULT 'utilisateur'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `email`, `telephone`, `adresse`, `date_naissance`, `photo`, `pseudo`, `id_role`, `mot_de_passe`, `role`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@example.com', '0601020304', '12 rue des Lilas', '1985-06-15', 0x2e2e2f6173736574732f756e2e6a7067, 'JeanD', 4, 'mdp12345', 'utilisateur'),
(2, 'Martin', 'Sophie', 'sophie.martin@example.com', '0605060708', '34 avenue des Champs', '1990-09-22', 0x2e2e2f6173736574732f646575782e6a7067, 'SophieM', 3, 'mdp23456', 'utilisateur'),
(3, 'Durand', 'Paul', 'paul.durand@example.com', '0611121314', '78 boulevard Haussmann', '1980-12-10', 0x2e2e2f6173736574732f74726f69732e6a7067, 'PaulD', 4, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(4, 'Morel', 'Claire', 'claire.morel@example.com', '0620212223', '56 place Bellecour', '1995-01-30', 0x2e2e2f6173736574732f717561747472652e6a7067, 'ClaireM', 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(5, 'Lemoine', 'Antoine', 'antoine.lemoine@example.com', '0630313233', '23 rue Lafayette', '1988-03-12', 0x2e2e2f6173736574732f63696e712e6a7067, 'AntoineL', 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(6, 'Rousseau', 'Emma', 'emma.rousseau@example.com', '0640414243', '89 rue de Rivoli', '1992-07-14', 0x2e2e2f6173736574732f7369782e6a7067, 'EmmaR', 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(7, 'Petit', 'Lucas', 'lucas.petit@example.com', '0650515253', '17 cours Mirabeau', '1987-11-05', 0x2e2e2f6173736574732f736570742e6a7067, 'LucasP', 4, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(8, 'Blanc', 'Alice', 'alice.blanc@example.com', '0660616263', '45 quai Voltaire', '1991-04-18', 0x2e2e2f6173736574732f687569742e6a7067, 'AliceB', 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(9, 'Garnier', 'Nicolas', 'nicolas.garnier@example.com', '0670717273', '65 avenue Montaigne', '1989-02-25', 0x2e2e2f6173736574732f6e6575662e6a7067, 'NicolasG', 4, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(10, 'Bernard', 'Chloe', 'chloe.bernard@example.com', '0680818283', '19 place de la Concorde', '1993-06-08', 0x2e2e2f6173736574732f6469782e6a7067, 'ChloeB', 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(11, 'Fontaine', 'Julien', 'julien.fontaine@example.com', '0690919293', '52 rue de la Paix', '1986-10-11', 0x2e2e2f6173736574732f6f6e7a652e6a7067, 'JulienF', 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(12, 'Barbier', 'Manon', 'manon.barbier@example.com', '0603040506', '90 rue Saint-Honoré', '1994-08-19', 0x2e2e2f6173736574732f646f757a652e6a7067, 'ManonB', 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(13, 'Perrot', 'Thomas', 'thomas.perrot@example.com', '0617080910', '28 rue Saint-Lazare', '1990-05-03', 0x2e2e2f6173736574732f747265697a652e6a7067, 'ThomasP', 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(14, 'Boucher', 'Laura', 'laura.boucher@example.com', '0623060708', '74 rue Oberkampf', '1992-12-20', 0x2e2e2f6173736574732f717561746f727a652e6a7067, 'LauraB', 4, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(15, 'Masson', 'Hugo', 'hugo.masson@example.com', '0634080912', '11 rue Lepic', '1984-09-16', 0x2e2e2f6173736574732f7175696e7a652e6a7067, 'HugoM', 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(32, 'Marie', 'Bernard', 'mariebernard1@example.com', '0628700771', '46 rue de Marseille', '2002-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'MarieBernard1', 4, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(33, 'Julien', 'Martin', 'julienmartin2@example.com', '0671631844', '8 rue de Strasbourg', '1994-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'JulienMartin2', 4, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(34, 'Hugo', 'Rousseau', 'hugorousseau3@example.com', '0620825975', '47 rue de Strasbourg', '2001-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'HugoRousseau3', 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(35, 'Thomas', 'Petit', 'thomaspetit4@example.com', '0654070573', '16 rue de Nantes', '2005-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'ThomasPetit4', 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(36, 'Claire', 'Garcia', 'clairegarcia5@example.com', '0634628502', '51 rue de Nantes', '1992-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'ClaireGarcia5', 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(37, 'Alice', 'Rousseau', 'alicerousseau6@example.com', '0645448024', '45 rue de Marseille', '2005-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'AliceRousseau6', 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(38, 'Antoine', 'Moreau', 'antoinemoreau7@example.com', '0695893628', '2 rue de Lyon', '2001-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'AntoineMoreau7', 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(39, 'Manon', 'Petit', 'manonpetit8@example.com', '0667327403', '98 rue de Bordeaux', '2000-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'ManonPetit8', 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(40, 'Manon', 'Rousseau', 'manonrousseau9@example.com', '0655570340', '89 rue de Lille', '1995-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'ManonRousseau9', 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(41, 'Léa', 'Fournier', 'léafournier10@example.com', '0668269390', '81 rue de Strasbourg', '1997-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'LéaFournier10', 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0', 'utilisateur'),
(44, 'TESTEUR', 'Patrick', 'patrik.patrak@exemple.com', '0123456789', '1 rue pierre le silencieux', '1998-02-20', NULL, 'Patrik', 2, '$2y$10$vQh1LiI09Q0.8m3Hw5bRuuiyCFn1IHPZjqKJ/fHMHMH3RNGNa0Dzm', 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `voiture`
--

CREATE TABLE `voiture` (
  `id_voiture` int(11) NOT NULL,
  `modele` varchar(50) NOT NULL,
  `immatriculation` varchar(50) NOT NULL,
  `energie` varchar(50) DEFAULT NULL,
  `couleur` varchar(50) DEFAULT NULL,
  `date_premiere_immatriculation` date DEFAULT NULL,
  `id_marque` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voiture`
--

INSERT INTO `voiture` (`id_voiture`, `modele`, `immatriculation`, `energie`, `couleur`, `date_premiere_immatriculation`, `id_marque`, `id_utilisateur`) VALUES
(1, '208', 'AA-123-BB', 'Essence', 'Rouge', '2015-03-20', 1, 1),
(2, 'Clio', 'CC-456-DD', 'Diesel', 'Bleue', '2018-05-10', 2, 2),
(3, 'C4', 'EE-789-FF', 'Hybride', 'Noire', '2020-01-15', 3, 3),
(4, 'X1', 'GG-123-HH', 'Essence', 'Blanche', '2017-07-25', 4, 4),
(5, 'A-Class', 'II-456-JJ', 'Électrique', 'Grise', '2022-11-05', 5, 5),
(6, '208', 'KK-789-LL', 'Essence', 'Rouge', '2015-03-20', 1, 6),
(7, 'Clio', 'MM-123-NN', 'Électrique', 'Bleue', '2018-05-10', 2, 7),
(9, '2008', 'CE-291-CL', 'Essence', 'Rouge', '2016-02-04', 1, 32),
(10, '3008', 'BB-555-CA', 'Électrique', 'Rouge', '2022-02-04', 1, 33),
(11, 'Passat', 'DB-110-DB', 'Essence', 'Rouge', '2017-02-04', 9, 34),
(12, 'Yaris', 'AA-123-AA', 'Électrique', 'Rouge', '2021-02-04', 6, 35),
(13, 'Série 3', 'BB-123-BB', 'Hybride', 'Rouge', '2019-02-04', 4, 36),
(14, 'Fiesta', 'CC-123-CC', 'Essence', 'Rouge', '2023-02-04', 11, 37),
(15, 'XL 500', 'DD-123-DD', 'Électrique', 'Rouge', '2018-02-04', 16, 38),
(16, 'Golf', 'EE-123-EE', 'Essence', 'Rouge', '2022-02-04', 9, 39),
(17, 'Capture', 'FF-123-FF', 'Électrique', 'Rouge', '2015-02-04', 2, 40),
(18, '208', 'GG-123-GG', 'Électrique', 'Rouge', '2024-02-04', 1, 41),
(19, 'Clio V', 'AA-234-AA', 'Electrique', 'Verte', '2024-01-01', 2, 2),
(20, '5008', 'PP-123-PP', 'Diesel', 'Bleu', '2024-02-01', 1, 44);

-- --------------------------------------------------------

--
-- Structure de la table `voyages`
--

CREATE TABLE `voyages` (
  `id_voyage` int(11) NOT NULL,
  `nombre` int(11) NOT NULL,
  `kilometres` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voyages`
--

INSERT INTO `voyages` (`id_voyage`, `nombre`, `kilometres`, `id_utilisateur`) VALUES
(1, 27, 3100, 1),
(2, 15, 1500, 2),
(3, 30, 5000, 3);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id_avis`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_conducteur` (`id_conducteur`),
  ADD KEY `id_covoiturage` (`id_covoiturage`),
  ADD KEY `avis_ibfk_4` (`id_auteur`);

--
-- Index pour la table `conducteur`
--
ALTER TABLE `conducteur`
  ADD PRIMARY KEY (`id_conducteur`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `covoiturage`
--
ALTER TABLE `covoiturage`
  ADD PRIMARY KEY (`id_covoiturage`),
  ADD KEY `id_voiture` (`id_voiture`),
  ADD KEY `covoiturage_ibfk_2_new` (`id_utilisateur`);

--
-- Index pour la table `credit`
--
ALTER TABLE `credit`
  ADD PRIMARY KEY (`id_credit`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id_employe`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `historiquevoyages`
--
ALTER TABLE `historiquevoyages`
  ADD PRIMARY KEY (`id_historique`),
  ADD KEY `historiquevoyages_ibfk_1_new` (`id_utilisateur`);

--
-- Index pour la table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`id_marque`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parametre`
--
ALTER TABLE `parametre`
  ADD PRIMARY KEY (`id_parametre`),
  ADD KEY `parametre_ibfk_1_new` (`id_configuration`);

--
-- Index pour la table `passager`
--
ALTER TABLE `passager`
  ADD PRIMARY KEY (`id_passager`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id_preference`),
  ADD KEY `preferences_ibfk_1_new` (`id_utilisateur`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD KEY `utilisateur_ibfk_2_new` (`id_role`);

--
-- Index pour la table `voiture`
--
ALTER TABLE `voiture`
  ADD PRIMARY KEY (`id_voiture`),
  ADD UNIQUE KEY `immatriculation` (`immatriculation`),
  ADD KEY `id_marque` (`id_marque`),
  ADD KEY `voiture_ibfk_2_new` (`id_utilisateur`);

--
-- Index pour la table `voyages`
--
ALTER TABLE `voyages`
  ADD PRIMARY KEY (`id_voyage`),
  ADD KEY `voyages_ibfk_1_new` (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id_avis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT pour la table `conducteur`
--
ALTER TABLE `conducteur`
  MODIFY `id_conducteur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `covoiturage`
--
ALTER TABLE `covoiturage`
  MODIFY `id_covoiturage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT pour la table `credit`
--
ALTER TABLE `credit`
  MODIFY `id_credit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id_employe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=223;

--
-- AUTO_INCREMENT pour la table `historiquevoyages`
--
ALTER TABLE `historiquevoyages`
  MODIFY `id_historique` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `marque`
--
ALTER TABLE `marque`
  MODIFY `id_marque` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `parametre`
--
ALTER TABLE `parametre`
  MODIFY `id_parametre` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `passager`
--
ALTER TABLE `passager`
  MODIFY `id_passager` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id_preference` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `voiture`
--
ALTER TABLE `voiture`
  MODIFY `id_voiture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `voyages`
--
ALTER TABLE `voyages`
  MODIFY `id_voyage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_covoiturage`) REFERENCES `covoiturage` (`id_covoiturage`) ON DELETE CASCADE,
  ADD CONSTRAINT `avis_ibfk_3_new` FOREIGN KEY (`id_conducteur`) REFERENCES `conducteur` (`id_conducteur`) ON DELETE CASCADE,
  ADD CONSTRAINT `avis_ibfk_4` FOREIGN KEY (`id_auteur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `avis_ibfk_5` FOREIGN KEY (`id_conducteur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `conducteur`
--
ALTER TABLE `conducteur`
  ADD CONSTRAINT `conducteur_ibfk_1_new` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `covoiturage`
--
ALTER TABLE `covoiturage`
  ADD CONSTRAINT `covoiturage_ibfk_1` FOREIGN KEY (`id_voiture`) REFERENCES `voiture` (`id_voiture`) ON DELETE CASCADE,
  ADD CONSTRAINT `covoiturage_ibfk_2_new` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `credit`
--
ALTER TABLE `credit`
  ADD CONSTRAINT `credit_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `historiquevoyages`
--
ALTER TABLE `historiquevoyages`
  ADD CONSTRAINT `historiquevoyages_ibfk_1_new` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `parametre`
--
ALTER TABLE `parametre`
  ADD CONSTRAINT `parametre_ibfk_1_new` FOREIGN KEY (`id_configuration`) REFERENCES `conducteur` (`id_conducteur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `passager`
--
ALTER TABLE `passager`
  ADD CONSTRAINT `passager_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE,
  ADD CONSTRAINT `passager_ibfk_1_new` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `preferences`
--
ALTER TABLE `preferences`
  ADD CONSTRAINT `preferences_ibfk_1_new` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_2_new` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE;

--
-- Contraintes pour la table `voiture`
--
ALTER TABLE `voiture`
  ADD CONSTRAINT `voiture_ibfk_1` FOREIGN KEY (`id_marque`) REFERENCES `marque` (`id_marque`) ON DELETE CASCADE,
  ADD CONSTRAINT `voiture_ibfk_2_new` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `voyages`
--
ALTER TABLE `voyages`
  ADD CONSTRAINT `voyages_ibfk_1_new` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
