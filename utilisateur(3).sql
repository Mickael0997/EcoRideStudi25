-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 11 fév. 2025 à 20:55
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
  `id_configuration` int(11) DEFAULT NULL,
  `id_role` int(11) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `email`, `telephone`, `adresse`, `date_naissance`, `photo`, `pseudo`, `id_configuration`, `id_role`, `mot_de_passe`) VALUES
(1, 'Dupont', 'Jean', 'jean.dupont@example.com', '0601020304', '12 rue des Lilas', '1985-06-15', 0x2e2e2f6173736574732f756e2e706e67, 'JeanD', 1, 2, 'mdp12345'),
(2, 'Martin', 'Sophie', 'sophie.martin@example.com', '0605060708', '34 avenue des Champs', '1990-09-22', 0x2e2e2f6173736574732f646575782e706e67, 'SophieM', 2, 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(3, 'Durand', 'Paul', 'paul.durand@example.com', '0611121314', '78 boulevard Haussmann', '1980-12-10', 0x2e2e2f6173736574732f74726f69732e706e67, 'PaulD', 3, 4, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(4, 'Morel', 'Claire', 'claire.morel@example.com', '0620212223', '56 place Bellecour', '1995-01-30', 0x2e2e2f6173736574732f717561747472652e706e67, 'ClaireM', 1, 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(5, 'Lemoine', 'Antoine', 'antoine.lemoine@example.com', '0630313233', '23 rue Lafayette', '1988-03-12', 0x2e2e2f6173736574732f63696e712e706e67, 'AntoineL', 1, 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(6, 'Rousseau', 'Emma', 'emma.rousseau@example.com', '0640414243', '89 rue de Rivoli', '1992-07-14', 0x2e2e2f6173736574732f7369782e706e67, 'EmmaR', 2, 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(7, 'Petit', 'Lucas', 'lucas.petit@example.com', '0650515253', '17 cours Mirabeau', '1987-11-05', 0x2e2e2f6173736574732f736570742e706e67, 'LucasP', 3, 4, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(8, 'Blanc', 'Alice', 'alice.blanc@example.com', '0660616263', '45 quai Voltaire', '1991-04-18', 0x2e2e2f6173736574732f687569742e6a7067, 'AliceB', 1, 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(9, 'Garnier', 'Nicolas', 'nicolas.garnier@example.com', '0670717273', '65 avenue Montaigne', '1989-02-25', 0x2e2e2f6173736574732f6e6575662e6a7067, 'NicolasG', 2, 4, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(10, 'Bernard', 'Chloe', 'chloe.bernard@example.com', '0680818283', '19 place de la Concorde', '1993-06-08', 0x2e2e2f6173736574732f6469782e6a7067, 'ChloeB', 3, 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(11, 'Fontaine', 'Julien', 'julien.fontaine@example.com', '0690919293', '52 rue de la Paix', '1986-10-11', 0x2e2e2f6173736574732f6f6e7a652e6a7067, 'JulienF', 2, 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(12, 'Barbier', 'Manon', 'manon.barbier@example.com', '0603040506', '90 rue Saint-Honoré', '1994-08-19', 0x2e2e2f6173736574732f646f757a652e6a7067, 'ManonB', 1, 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(13, 'Perrot', 'Thomas', 'thomas.perrot@example.com', '0617080910', '28 rue Saint-Lazare', '1990-05-03', 0x2e2e2f6173736574732f747265697a652e6a7067, 'ThomasP', 3, 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(14, 'Boucher', 'Laura', 'laura.boucher@example.com', '0623060708', '74 rue Oberkampf', '1992-12-20', 0x2e2e2f6173736574732f717561746f727a652e6a7067, 'LauraB', 2, 4, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(15, 'Masson', 'Hugo', 'hugo.masson@example.com', '0634080912', '11 rue Lepic', '1984-09-16', 0x2e2e2f6173736574732f7175696e7a652e6a7067, 'HugoM', 1, 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(32, 'Marie', 'Bernard', 'mariebernard1@example.com', '0628700771', '46 rue de Marseille', '2002-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'MarieBernard1', 2, 4, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(33, 'Julien', 'Martin', 'julienmartin2@example.com', '0671631844', '8 rue de Strasbourg', '1994-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'JulienMartin2', 2, 4, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(34, 'Hugo', 'Rousseau', 'hugorousseau3@example.com', '0620825975', '47 rue de Strasbourg', '2001-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'HugoRousseau3', 1, 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(35, 'Thomas', 'Petit', 'thomaspetit4@example.com', '0654070573', '16 rue de Nantes', '2005-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'ThomasPetit4', 2, 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(36, 'Claire', 'Garcia', 'clairegarcia5@example.com', '0634628502', '51 rue de Nantes', '1992-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'ClaireGarcia5', 3, 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(37, 'Alice', 'Rousseau', 'alicerousseau6@example.com', '0645448024', '45 rue de Marseille', '2005-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'AliceRousseau6', 3, 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(38, 'Antoine', 'Moreau', 'antoinemoreau7@example.com', '0695893628', '2 rue de Lyon', '2001-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'AntoineMoreau7', 3, 2, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(39, 'Manon', 'Petit', 'manonpetit8@example.com', '0667327403', '98 rue de Bordeaux', '2000-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'ManonPetit8', 3, 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(40, 'Manon', 'Rousseau', 'manonrousseau9@example.com', '0655570340', '89 rue de Lille', '1995-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'ManonRousseau9', 3, 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0'),
(41, 'Léa', 'Fournier', 'léafournier10@example.com', '0668269390', '81 rue de Strasbourg', '1997-02-04', 0x2e2e2f6173736574732f736570742e706e67, 'LéaFournier10', 2, 3, 'ed9dd5dbb3262c8b5c3b614676e00a04246eeafb8f7048ab1af5853f1a2c8ab0');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD KEY `id_configuration` (`id_configuration`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`id_configuration`) REFERENCES `configuration` (`id_configuration`) ON DELETE SET NULL,
  ADD CONSTRAINT `utilisateur_ibfk_2` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
