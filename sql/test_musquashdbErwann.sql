-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : mer. 13 avr. 2022 à 14:03
-- Version du serveur : 10.6.5-MariaDB
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `test_musquashdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `authentification`
--

DROP TABLE IF EXISTS `authentification`;
CREATE TABLE IF NOT EXISTS `authentification` (
  `mail_authentification` varchar(30) NOT NULL,
  `mdp_authentification` varchar(50) DEFAULT NULL,
  `login_authentification` varchar(30) DEFAULT NULL,
  `role_authentification` varchar(15) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `valide_authentification` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`mail_authentification`),
  KEY `fk_utilisateur_authentification` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `authentification`
--

INSERT INTO `authentification` (`mail_authentification`, `mdp_authentification`, `login_authentification`, `role_authentification`, `id_utilisateur`, `valide_authentification`) VALUES
('samigirard@lemail.com', 'zefzeg545ergh', 'samisami', 'utilisateur', 1, 1),
('erwannsuard@gmail.com', '12345678', 'erwanndu34', 'utilisateur', 2, 1),
('peranico@lemail.com', '25468azdwfe', 'nicoo', 'utilisateur', 3, 1),
('soupaarthur@lemail.com', '524zaaaaaaz', 'arthurent', 'utilisateur', 4, 1),
('profmr@lemail.com', '54a566a4dqsf45', 'leprofdesquash', 'prof', 5, 1),
('profmme@lemail.com', 'a7a8z4d5q4sf', 'laprofdegym', 'prof', 6, 1),
('pierreroger@lemail.com', 'aaaaaaaaaaa', 'aaaaaaaa', 'utilisateur', 7, 0),
('enfant@truc.fr', '12345678', 'lenfant', 'utilisateur', 8, 1),
('suard3@yahoo.fr', 'mei34mei34', 'Cathy', 'utilisateur', 9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `casier`
--

DROP TABLE IF EXISTS `casier`;
CREATE TABLE IF NOT EXISTS `casier` (
  `id_casier` int(11) NOT NULL,
  `type_location` varchar(10) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_casier`),
  KEY `fk_utilisateur_casier` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `cours_squash_collectif`
--

DROP TABLE IF EXISTS `cours_squash_collectif`;
CREATE TABLE IF NOT EXISTS `cours_squash_collectif` (
  `groupe_cours_squash_collectif` int(11) DEFAULT NULL,
  `horaire_cours_squash_collectif` datetime DEFAULT NULL,
  `id_cours_squash_collectif` int(11) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `id_terrain` tinyint(4) NOT NULL,
  `cours_squash_collectif_nombre_participants_max` tinyint(4) DEFAULT NULL,
  `cours_squash_collectif_nombre_participants_actuel` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_cours_squash_collectif`),
  KEY `fk_prof_cours_squash_collectif` (`id_prof`),
  KEY `fk_terrain_cours_squash_collectif` (`id_terrain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `cours_squash_collectif`
--

INSERT INTO `cours_squash_collectif` (`groupe_cours_squash_collectif`, `horaire_cours_squash_collectif`, `id_cours_squash_collectif`, `id_prof`, `id_terrain`, `cours_squash_collectif_nombre_participants_max`, `cours_squash_collectif_nombre_participants_actuel`) VALUES
(4, '2022-05-02 18:00:00', 1, 5, 1, 10, 10),
(4, '2022-05-09 18:00:00', 2, 5, 1, 10, 5),
(4, '2022-05-16 18:00:00', 3, 5, 1, 10, 1),
(4, '2022-05-23 18:00:00', 4, 5, 1, 10, 2),
(4, '2022-05-30 18:00:00', 5, 5, 1, 10, 5),
(4, '2022-06-06 18:00:00', 6, 5, 1, 10, 8),
(4, '2022-06-13 18:00:00', 7, 5, 1, 10, 0),
(2, '2022-05-04 15:00:00', 8, 6, 1, 10, 0),
(2, '2022-05-11 15:00:00', 9, 6, 1, 10, 0),
(2, '2022-05-18 15:00:00', 10, 6, 1, 10, 0),
(2, '2022-05-25 15:00:00', 11, 6, 1, 10, 0),
(2, '2022-06-01 15:00:00', 12, 6, 1, 10, 0),
(4, '2022-05-03 18:00:00', 13, 5, 2, 10, 7),
(4, '2022-05-09 18:00:00', 50, 5, 2, 10, 5);

-- --------------------------------------------------------

--
-- Structure de la table `formule`
--

DROP TABLE IF EXISTS `formule`;
CREATE TABLE IF NOT EXISTS `formule` (
  `id_formule` int(11) NOT NULL,
  `nom_formule` varchar(30) DEFAULT NULL,
  `prix_formule` float DEFAULT NULL,
  PRIMARY KEY (`id_formule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `formule`
--

INSERT INTO `formule` (`id_formule`, `nom_formule`, `prix_formule`) VALUES
(1, 'Squash cours collectif', 39.99),
(2, 'Squash cours individuel', 59.99),
(3, 'Squash location terrain', 17.99),
(4, 'Gym', 14.99),
(5, 'Muscu', 14.99);

-- --------------------------------------------------------

--
-- Structure de la table `materiel_achat`
--

DROP TABLE IF EXISTS `materiel_achat`;
CREATE TABLE IF NOT EXISTS `materiel_achat` (
  `id_materiel_achat` int(11) NOT NULL,
  `designation_materiel_achat` varchar(30) DEFAULT NULL,
  `quantite_materiel_achat` int(11) DEFAULT NULL,
  `tarif_materiel_achat` float DEFAULT NULL,
  PRIMARY KEY (`id_materiel_achat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `materiel_location`
--

DROP TABLE IF EXISTS `materiel_location`;
CREATE TABLE IF NOT EXISTS `materiel_location` (
  `id_materiel_location` int(11) NOT NULL,
  `designation_materiel_location` varchar(30) DEFAULT NULL,
  `quantite_materiel_location` int(11) DEFAULT NULL,
  `tarif_materiel_location` float DEFAULT NULL,
  PRIMARY KEY (`id_materiel_location`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `planning_reservation`
--

DROP TABLE IF EXISTS `planning_reservation`;
CREATE TABLE IF NOT EXISTS `planning_reservation` (
  `horaire_planning_reservation` datetime NOT NULL,
  `type_reservation` varchar(20) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_terrain` tinyint(4) NOT NULL,
  `cours_individuel_bloque` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`horaire_planning_reservation`,`type_reservation`,`id_utilisateur`,`id_terrain`),
  KEY `fk_utilisateur_planning_reservation` (`id_utilisateur`),
  KEY `fk_terrain_planning_reservation` (`id_terrain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `planning_reservation`
--

INSERT INTO `planning_reservation` (`horaire_planning_reservation`, `type_reservation`, `id_utilisateur`, `id_terrain`, `cours_individuel_bloque`) VALUES
('2022-05-06 09:00:00', 'ReservationTerrain', 2, 1, 1),
('2022-05-03 12:00:00', 'ReservationTerrain', 2, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `prof`
--

DROP TABLE IF EXISTS `prof`;
CREATE TABLE IF NOT EXISTS `prof` (
  `sport_prof` varchar(15) NOT NULL,
  `specialite_gym_prof` varchar(20) DEFAULT NULL,
  `id_prof` int(11) NOT NULL,
  PRIMARY KEY (`id_prof`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `prof`
--

INSERT INTO `prof` (`sport_prof`, `specialite_gym_prof`, `id_prof`) VALUES
('squash', NULL, 5),
('squash', NULL, 6);

-- --------------------------------------------------------

--
-- Structure de la table `promo_formule`
--

DROP TABLE IF EXISTS `promo_formule`;
CREATE TABLE IF NOT EXISTS `promo_formule` (
  `id_promo_formule` int(11) NOT NULL,
  `pourcentage_promotion` int(11) NOT NULL,
  `date_promotion` date DEFAULT NULL,
  `duree_promotion` int(11) DEFAULT NULL,
  `id_formule` int(11) NOT NULL,
  PRIMARY KEY (`id_promo_formule`),
  KEY `fk_formule_promo_formule` (`id_formule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `terrain`
--

DROP TABLE IF EXISTS `terrain`;
CREATE TABLE IF NOT EXISTS `terrain` (
  `prix_location` float DEFAULT NULL,
  `id_terrain` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_terrain`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `terrain`
--

INSERT INTO `terrain` (`prix_location`, `id_terrain`) VALUES
(14.99, 1),
(14.99, 2),
(14.99, 3),
(14.99, 4),
(14.99, 5),
(14.99, 6);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom_utilisateur` varchar(30) DEFAULT NULL,
  `prenom_utilisateur` varchar(30) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `groupe_utilisateur` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `date_naissance`, `groupe_utilisateur`) VALUES
(1, 'Girard', 'Sami', '2001-01-29', 1),
(2, 'Suard', 'Erwann', '1991-12-01', 4),
(3, 'Péra', 'Nicolas', '1978-04-12', 1),
(4, 'Soupa', 'Arthur', '2002-01-01', 2),
(5, 'Prof', 'Monsieur', '1985-01-01', NULL),
(6, 'Prof', 'Madame', '1978-02-22', NULL),
(7, 'Pierre', 'Roger', '1995-03-03', 1),
(8, 'Enfant', 'Lepetit', '2014-12-01', 1),
(9, 'Suard', 'Catherine', '1965-05-26', 4);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_cours_squash_collectif`
--

DROP TABLE IF EXISTS `utilisateur_cours_squash_collectif`;
CREATE TABLE IF NOT EXISTS `utilisateur_cours_squash_collectif` (
  `id_utilisateur` int(11) NOT NULL,
  `id_cours_squash_collectif` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_cours_squash_collectif`),
  KEY `fk_cours_squash_collectif_utilisateur_cours_squash_collectif` (`id_cours_squash_collectif`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateur_cours_squash_collectif`
--

INSERT INTO `utilisateur_cours_squash_collectif` (`id_utilisateur`, `id_cours_squash_collectif`) VALUES
(2, 1),
(2, 2),
(2, 3);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_formule`
--

DROP TABLE IF EXISTS `utilisateur_formule`;
CREATE TABLE IF NOT EXISTS `utilisateur_formule` (
  `id_utilisateur` int(11) NOT NULL,
  `id_formule` int(11) NOT NULL,
  `date_adhesion` date DEFAULT NULL,
  `duree_mois` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`,`id_formule`),
  KEY `fk_formule_utilisateur_formule` (`id_formule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateur_formule`
--

INSERT INTO `utilisateur_formule` (`id_utilisateur`, `id_formule`, `date_adhesion`, `duree_mois`) VALUES
(2, 1, '2022-04-11', 3),
(9, 1, '2022-04-12', 12);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_materiel_achat`
--

DROP TABLE IF EXISTS `utilisateur_materiel_achat`;
CREATE TABLE IF NOT EXISTS `utilisateur_materiel_achat` (
  `date_achat` date NOT NULL,
  `quantite_achat` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_materiel_achat` int(11) NOT NULL,
  PRIMARY KEY (`date_achat`,`id_utilisateur`,`id_materiel_achat`),
  KEY `fk_utilisateur_utilisateur_materiel_achat` (`id_utilisateur`),
  KEY `fk_materiel_achat_utilisateur_materiel_achat` (`id_materiel_achat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_materiel_location`
--

DROP TABLE IF EXISTS `utilisateur_materiel_location`;
CREATE TABLE IF NOT EXISTS `utilisateur_materiel_location` (
  `date_location` date NOT NULL,
  `duree` int(11) DEFAULT NULL,
  `quantite_location` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_materiel_location` int(11) NOT NULL,
  PRIMARY KEY (`date_location`,`id_utilisateur`,`id_materiel_location`),
  KEY `fk_materiel_loaction_utilisateur_materiel_location` (`id_materiel_location`),
  KEY `fk_utilisateur_utilisateur_materiel_location` (`id_utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
