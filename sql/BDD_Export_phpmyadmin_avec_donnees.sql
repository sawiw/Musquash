-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 12 avr. 2022 à 16:34
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `musquash_test_commun`
--

-- --------------------------------------------------------

--
-- Structure de la table `authentification`
--

CREATE TABLE `authentification` (
  `mail_authentification` varchar(30) NOT NULL,
  `mdp_authentification` varchar(50) DEFAULT NULL,
  `login_authentification` varchar(30) DEFAULT NULL,
  `role_authentification` varchar(15) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `valide_authentification` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `authentification`
--

INSERT INTO `authentification` (`mail_authentification`, `mdp_authentification`, `login_authentification`, `role_authentification`, `id_utilisateur`, `valide_authentification`) VALUES
('azaze@zaeaze', 'iwJ&O86HR=', 'azeaze', 'utilisateur', 7, 0),
('erwannsuard@gmail.com', 'coucou123', 'erwanndu34', 'utilisateur', 1, 1),
('florence.chanoni@gmail.com', '7(CSà95bar', 'FloFloLaPlusBelle', 'utilisateur', 3, 0),
('professeurlautre@musquash.fr', '12345678', 'ProfesseurLautre', 'prof', 6, 1),
('proflegentil@musquash.fr', '12345678', 'ProfLeGentil', 'prof', 5, 1),
('sgirard34@gmail.com', 'D\"RidrP\"_', 'Sami34', 'utilisateur', 2, 0),
('tpacchiana@gmail.com', 'thomas345', 'ThomasLeBoss', 'utilisateur', 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `casier`
--

CREATE TABLE `casier` (
  `id_casier` int(11) NOT NULL,
  `type_location` varchar(10) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `casier`
--

INSERT INTO `casier` (`id_casier`, `type_location`, `id_utilisateur`) VALUES
(1, 'seance', 6),
(2, 'semaine', 2);

-- --------------------------------------------------------

--
-- Structure de la table `cours_squash_collectif`
--

CREATE TABLE `cours_squash_collectif` (
  `groupe_cours_squash_collectif` tinyint(11) DEFAULT NULL,
  `horaire_cours_squash_collectif` datetime DEFAULT NULL,
  `id_cours_squash_collectif` int(11) NOT NULL,
  `id_prof` int(11) NOT NULL,
  `id_terrain` tinyint(4) NOT NULL,
  `cours_squash_collectif_nombre_participants_max` tinyint(4) DEFAULT NULL,
  `cours_squash_collectif_nombre_participants_actuel` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cours_squash_collectif`
--

INSERT INTO `cours_squash_collectif` (`groupe_cours_squash_collectif`, `horaire_cours_squash_collectif`, `id_cours_squash_collectif`, `id_prof`, `id_terrain`, `cours_squash_collectif_nombre_participants_max`, `cours_squash_collectif_nombre_participants_actuel`) VALUES
(4, '2022-05-02 18:00:00', 1, 5, 1, 10, 0),
(4, '2022-05-09 18:00:00', 2, 5, 1, 10, 0),
(4, '2022-05-16 18:00:00', 3, 5, 1, 10, 0),
(4, '2022-05-23 18:00:00', 4, 5, 1, 10, 0),
(4, '2022-05-30 18:00:00', 5, 5, 1, 10, 0),
(4, '2022-06-06 18:00:00', 6, 5, 1, 10, 0),
(4, '2022-06-13 18:00:00', 7, 5, 1, 10, 0),
(2, '2022-05-04 15:00:00', 8, 6, 1, 10, 0),
(2, '2022-05-11 15:00:00', 9, 6, 1, 10, 0),
(2, '2022-05-18 15:00:00', 10, 6, 1, 10, 0),
(2, '2022-05-25 15:00:00', 11, 6, 1, 10, 0),
(2, '2022-06-01 15:00:00', 12, 6, 1, 10, 0),
(2, '2022-06-08 15:00:00', 13, 6, 1, 10, 0),
(2, '2022-06-15 15:00:00', 14, 6, 1, 10, 0),
(3, '2022-05-04 16:00:00', 15, 6, 1, 10, 0),
(3, '2022-05-11 16:00:00', 16, 6, 1, 10, 0),
(3, '2022-05-18 16:00:00', 17, 6, 1, 10, 0),
(3, '2022-05-25 16:00:00', 18, 6, 1, 10, 0),
(3, '2022-06-01 16:00:00', 19, 6, 1, 10, 0),
(3, '2022-06-08 16:00:00', 20, 6, 1, 10, 0),
(3, '2022-06-15 16:00:00', 21, 6, 1, 10, 0),
(1, '2022-05-03 19:00:00', 97, 6, 1, 6, 3),
(4, '2022-05-05 09:00:00', 98, 5, 1, 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `formule`
--

CREATE TABLE `formule` (
  `id_formule` int(11) NOT NULL,
  `nom_formule` varchar(30) DEFAULT NULL,
  `prix_formule` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `materiel_achat` (
  `id_materiel_achat` int(11) NOT NULL,
  `designation_materiel_achat` varchar(30) DEFAULT NULL,
  `quantite_materiel_achat` int(11) DEFAULT NULL,
  `tarif_materiel_achat` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `materiel_achat`
--

INSERT INTO `materiel_achat` (`id_materiel_achat`, `designation_materiel_achat`, `quantite_materiel_achat`, `tarif_materiel_achat`) VALUES
(1, 'raquette', 50, 325),
(2, 'balle', 100, 12),
(3, 'serviette', 100, 38),
(4, 'chaussure', 26, 146),
(5, 'cardiofrequence-metre', 20, 98);

-- --------------------------------------------------------

--
-- Structure de la table `materiel_location`
--

CREATE TABLE `materiel_location` (
  `id_materiel_location` int(11) NOT NULL,
  `designation_materiel_location` varchar(30) DEFAULT NULL,
  `quantite_materiel_location` int(11) DEFAULT NULL,
  `tarif_materiel_location` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `materiel_location`
--

INSERT INTO `materiel_location` (`id_materiel_location`, `designation_materiel_location`, `quantite_materiel_location`, `tarif_materiel_location`) VALUES
(71, 'Balle de squash', 200, 4.99),
(88, 'Raquette', 50, 19.99);

-- --------------------------------------------------------

--
-- Structure de la table `planning_reservation`
--

CREATE TABLE `planning_reservation` (
  `horaire_planning_reservation` datetime NOT NULL,
  `type_reservation` varchar(20) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_terrain` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `planning_reservation`
--

INSERT INTO `planning_reservation` (`horaire_planning_reservation`, `type_reservation`, `id_utilisateur`, `id_terrain`) VALUES
('2022-04-12 15:00:00', 'utilisateur', 3, 4),
('2022-04-17 12:00:00', 'prof', 6, 6);

-- --------------------------------------------------------

--
-- Structure de la table `prof`
--

CREATE TABLE `prof` (
  `sport_prof` varchar(15) NOT NULL,
  `specialite_gym_prof` varchar(20) DEFAULT NULL,
  `id_prof` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `prof`
--

INSERT INTO `prof` (`sport_prof`, `specialite_gym_prof`, `id_prof`) VALUES
('squash', NULL, 5),
('squash', NULL, 6),
('gym', 'cardio', 18),
('gym', 'stretching', 22);

-- --------------------------------------------------------

--
-- Structure de la table `promo_formule`
--

CREATE TABLE `promo_formule` (
  `id_promo_formule` int(11) NOT NULL,
  `pourcentage_promotion` int(11) NOT NULL,
  `date_promotion` date DEFAULT NULL,
  `duree_promotion` int(11) DEFAULT NULL,
  `id_formule` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `promo_formule`
--

INSERT INTO `promo_formule` (`id_promo_formule`, `pourcentage_promotion`, `date_promotion`, `duree_promotion`, `id_formule`) VALUES
(1, 10, '2022-04-21', 6, 1),
(2, 10, '2022-04-19', 3, 5);

-- --------------------------------------------------------

--
-- Structure de la table `terrain`
--

CREATE TABLE `terrain` (
  `prix_location` float DEFAULT NULL,
  `id_terrain` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `nom_utilisateur` varchar(30) DEFAULT NULL,
  `prenom_utilisateur` varchar(30) DEFAULT NULL,
  `date_naissance` date DEFAULT NULL,
  `groupe_utilisateur` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `date_naissance`, `groupe_utilisateur`) VALUES
(1, 'Suard', 'Erwann', '1991-12-01', NULL),
(2, 'Girard', 'Sami', '1990-11-11', NULL),
(3, 'Chanoni', 'Florence', '1997-06-12', NULL),
(4, 'Pacchiana', 'Thomas', '2003-04-21', NULL),
(5, 'Prof', 'LeGentil', '1990-01-12', NULL),
(6, 'Professeur', 'Lautre', '1987-04-10', NULL),
(7, 'azeaze', 'azeaze', '2001-01-29', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_cours_squash_collectif`
--

CREATE TABLE `utilisateur_cours_squash_collectif` (
  `id_utilisateur` int(11) NOT NULL,
  `id_cours_squash_collectif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur_cours_squash_collectif`
--

INSERT INTO `utilisateur_cours_squash_collectif` (`id_utilisateur`, `id_cours_squash_collectif`) VALUES
(1, 2),
(3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_formule`
--

CREATE TABLE `utilisateur_formule` (
  `id_utilisateur` int(11) NOT NULL,
  `id_formule` int(11) NOT NULL,
  `date_adhesion` date DEFAULT NULL,
  `duree_mois` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur_formule`
--

INSERT INTO `utilisateur_formule` (`id_utilisateur`, `id_formule`, `date_adhesion`, `duree_mois`) VALUES
(4, 2, '2022-05-10', 12),
(5, 3, '2022-04-22', 6);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_materiel_achat`
--

CREATE TABLE `utilisateur_materiel_achat` (
  `date_achat` date NOT NULL,
  `quantite_achat` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_materiel_achat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur_materiel_achat`
--

INSERT INTO `utilisateur_materiel_achat` (`date_achat`, `quantite_achat`, `id_utilisateur`, `id_materiel_achat`) VALUES
('2022-04-24', 1, 2, 1),
('2022-04-27', 10, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_materiel_location`
--

CREATE TABLE `utilisateur_materiel_location` (
  `date_location` date NOT NULL,
  `duree` int(11) DEFAULT NULL,
  `quantite_location` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_materiel_location` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur_materiel_location`
--

INSERT INTO `utilisateur_materiel_location` (`date_location`, `duree`, `quantite_location`, `id_utilisateur`, `id_materiel_location`) VALUES
('2022-03-15', 6, 2, 4, 88),
('2022-04-29', 3, 5, 3, 71);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `authentification`
--
ALTER TABLE `authentification`
  ADD PRIMARY KEY (`mail_authentification`),
  ADD KEY `fk_utilisateur` (`id_utilisateur`);

--
-- Index pour la table `casier`
--
ALTER TABLE `casier`
  ADD PRIMARY KEY (`id_casier`),
  ADD KEY `fk_casier` (`id_utilisateur`);

--
-- Index pour la table `cours_squash_collectif`
--
ALTER TABLE `cours_squash_collectif`
  ADD PRIMARY KEY (`id_cours_squash_collectif`),
  ADD KEY `fk_prof` (`id_prof`),
  ADD KEY `fk_terrain` (`id_terrain`);

--
-- Index pour la table `formule`
--
ALTER TABLE `formule`
  ADD PRIMARY KEY (`id_formule`);

--
-- Index pour la table `materiel_achat`
--
ALTER TABLE `materiel_achat`
  ADD PRIMARY KEY (`id_materiel_achat`);

--
-- Index pour la table `materiel_location`
--
ALTER TABLE `materiel_location`
  ADD PRIMARY KEY (`id_materiel_location`);

--
-- Index pour la table `planning_reservation`
--
ALTER TABLE `planning_reservation`
  ADD PRIMARY KEY (`horaire_planning_reservation`,`type_reservation`,`id_utilisateur`,`id_terrain`),
  ADD KEY `fk_utilisateur` (`id_utilisateur`),
  ADD KEY `fk_terrain` (`id_terrain`);

--
-- Index pour la table `prof`
--
ALTER TABLE `prof`
  ADD PRIMARY KEY (`id_prof`);

--
-- Index pour la table `promo_formule`
--
ALTER TABLE `promo_formule`
  ADD PRIMARY KEY (`id_promo_formule`),
  ADD KEY `fk_formule` (`id_formule`);

--
-- Index pour la table `terrain`
--
ALTER TABLE `terrain`
  ADD PRIMARY KEY (`id_terrain`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- Index pour la table `utilisateur_cours_squash_collectif`
--
ALTER TABLE `utilisateur_cours_squash_collectif`
  ADD PRIMARY KEY (`id_utilisateur`,`id_cours_squash_collectif`),
  ADD KEY `fk_cours_squash_collectif` (`id_cours_squash_collectif`);

--
-- Index pour la table `utilisateur_formule`
--
ALTER TABLE `utilisateur_formule`
  ADD PRIMARY KEY (`id_utilisateur`,`id_formule`),
  ADD KEY `fk_formule` (`id_formule`);

--
-- Index pour la table `utilisateur_materiel_achat`
--
ALTER TABLE `utilisateur_materiel_achat`
  ADD PRIMARY KEY (`date_achat`,`id_utilisateur`,`id_materiel_achat`),
  ADD KEY `fk_utilisateur` (`id_utilisateur`),
  ADD KEY `fk_materiel_achat` (`id_materiel_achat`);

--
-- Index pour la table `utilisateur_materiel_location`
--
ALTER TABLE `utilisateur_materiel_location`
  ADD PRIMARY KEY (`date_location`,`id_utilisateur`,`id_materiel_location`),
  ADD KEY `fk_materiel_loaction` (`id_materiel_location`),
  ADD KEY `fk_utilisateur` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
